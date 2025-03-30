# Temas en Multi-Store

Este documento describe cómo están organizados y cómo se usan los temas en el proyecto "multi-store". Los temas permiten que cada tienda tenga un diseño personalizado (por ejemplo, `minimal`, `business`, `creative`).

## Estructura de los temas

### Estilos (CSS)
Los estilos están organizados en la carpeta `resources/css/`. Cada tema tiene su propio archivo CSS, y `app.css` importa todos los estilos.

#### Archivos CSS
Los estilos de los temas están organizados en la carpeta `resources/css/themes/`. Cada tema tiene su propio archivo CSS:

- `resources/css/app.css`: Archivo principal que importa Bootstrap, SweetAlert2 y los estilos de cada tema.
- `resources/css/themes/minimal.css`: Estilos para el tema `minimal`.
- `resources/css/themes/business.css`: Estilos para el tema `business`.
- `resources/css/themes/creative.css`: Estilos para el tema `creative`.

#### Ejemplo de archivo de tema (`minimal.css`)
```css
.theme-minimal {
    --bs-primary: #FF5733;
    --bs-btn-border-radius: 0.5rem;
}

.btn-close-minimal {
    background-color: #dc3545;
    border-color: #dc3545;
    border-radius: var(--bs-btn-border-radius);
    color: white;
}

/* Otros estilos para botones y componentes */
```

#### Colores principales por tema
| Tema      | Color Primario (`--bs-primary`) | Radio de Borde (`--bs-btn-border-radius`) |
|-----------|---------------------------------|-------------------------------------------|
| `minimal` | `#FF5733`                      | `0.5rem`                                  |
| `business`| `#3357FF`                      | `0`                                       |
| `creative`| `#FF33A1`                      | `0.25rem`                                 |

## Estructura de archivos

La estructura de archivos para los estilos de los temas es la siguiente:

```plaintext
resources/css/
├── app.css  // Archivo principal que importa Bootstrap, SweetAlert2 y los estilos de los temas
└── themes/  // Carpeta con los estilos específicos de cada tema
    ├── minimal.css  // Estilos para el tema minimal
    ├── business.css  // Estilos para el tema business
    └── creative.css  // Estilos para el tema creative
```

- **`app.css`**: Contiene las importaciones de Bootstrap, SweetAlert2, y los estilos de cada tema (`@import 'themes/minimal.css';`, etc.).
- **`themes/minimal.css`**, **`themes/business.css`**, **`themes/creative.css`**: Definen los estilos específicos de cada tema, incluyendo variables CSS (como `--bs-primary`) y clases personalizadas para botones (por ejemplo, `btn-close-minimal`, `btn-send-business`).

## Cómo usar los temas

### 1. Asignar un tema a una tienda
Cada tienda (`Store`) tiene un campo `theme` que indica qué tema usar (por ejemplo, `minimal`, `business`, `creative`). Este valor se usa para cargar el layout, las vistas, y los componentes correspondientes.

### 2. Cargar la vista y el layout correctos
En un controlador o componente Livewire, carga la vista y el layout según el tema de la tienda:

#### Ejemplo en un controlador
```php
public function index()
{
    $store = Store::find(1); // Obtener la tienda actual
    $theme = $store->theme ?? 'minimal';
    return view("products.index.{$theme}");
}
```

#### Ejemplo en un componente Livewire
```php
public function render()
{
    $store = Store::find(1); // Obtener la tienda actual
    $theme = $store->theme ?? 'minimal';
    return view("products.index.{$theme}")->layout("layouts.{$theme}.app");
}
```

### 3. Usar componentes específicos del tema
Cada tema tiene componentes personalizados para botones y otros elementos. Usa los componentes correspondientes al tema:

#### Ejemplo en una vista (`products/index/minimal.blade.php`)
```html
@extends('layouts.minimal.app')

@section('content')
    <h1>Productos (Minimal)</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Producto Ejemplo</h5>
                    <p class="card-text">Descripción del producto.</p>
                    <x-minimal.button-view>Ver Producto</x-minimal.button-view>
                    <x-minimal.button-add>Agregar al Carrito</x-minimal.button-add>
                </div>
            </div>
        </div>
    </div>
@endsection
```

### 4. Tipos de botones disponibles
Cada tema tiene los siguientes botones personalizados:

- `button-close`: Para cerrar modales, formularios, etc. (por ejemplo, `<x-minimal.button-close />`).
- `button-open`: Para abrir modales, secciones, etc.
- `button-send`: Para enviar formularios.
- `button-add`: Para agregar elementos (por ejemplo, al carrito).
- `button-remove`: Para eliminar elementos.
- `button-view`: Para ver detalles.

## Agregar un nuevo tema

Para agregar un nuevo tema (por ejemplo, `newtheme`):

1. **Crear el archivo CSS**:
   - Crea `resources/css/themes/newtheme.css`:
     ```css
     .theme-newtheme {
         --bs-primary: #123456; // Color primario para newtheme
         --bs-btn-border-radius: 0.3rem;
     }

     .btn-close-newtheme {
         background-color: #dc3545;
         border-color: #dc3545;
         border-radius: var(--bs-btn-border-radius);
         color: white;
     }

     // Definir otros botones: btn-open-newtheme, btn-send-newtheme, etc.
     ```
   - Agrega la importación en `app.css`:
     ```css
     @import 'themes/newtheme.css';
     ```

2. **Crear el layout**:
   - Crea `resources/views/layouts/newtheme.app.blade.php`:
     ```html
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Multi-Store (NewTheme)</title>
         @vite(['resources/css/app.css', 'resources/js/app.js'])
         @livewireStyles
     </head>
     <body class="theme-newtheme">
         <x-newtheme.header />
         <div class="container mt-5">
             {{ $slot }}
         </div>
         @livewireScripts
     </body>
     </html>
     ```

3. **Crear los componentes**:
   - Crea la carpeta `resources/views/components/newtheme/` y los componentes necesarios (por ejemplo, `header.blade.php`, `button-close.blade.php`, etc.).

4. **Crear las vistas**:
   - Crea las vistas para el nuevo tema (por ejemplo, `resources/views/products/index/newtheme.blade.php`).

5. **Asignar el tema a una tienda**:
   - Actualiza el campo `theme` de una tienda (`Store`) para que use `newtheme`.

## Probar los temas

Para probar los temas, sigue estos pasos:

1. **Crear una tienda con un tema específico**:
   - Crea una tienda en la base de datos y asigna un tema (por ejemplo, `minimal`):
     ```php
     $store = new Store();
     $store->name = 'Tienda de Prueba';
     $store->theme = 'minimal';
     $store->save();
     ```

2. **Cargar una vista**:
   - Visita una ruta que use el tema, como `/products`. Asegúrate de que el controlador o componente Livewire cargue la vista correcta:
     ```php
     $theme = $store->theme ?? 'minimal';
     return view("products.index.{$theme}");
     ```

3. **Verificar los estilos**:
   - Confirma que los estilos del tema se apliquen correctamente (por ejemplo, los botones deben tener los colores y bordes definidos en `minimal.css`).

4. **Cambiar el tema**:
   - Cambia el tema de la tienda (por ejemplo, a `business`) y recarga la página para verificar que los estilos y componentes se actualicen.

## Notas
- **Detección de errores**: Al tener layouts y vistas separados por tema, los errores estarán aislados. Por ejemplo, un error en `products/index/minimal.blade.php` solo afectará al tema `minimal`.
- **Rendimiento**: Usa `npm run build` para compilar los assets en producción y optimiza con PurgeCSS para eliminar CSS no utilizado.
- **Escalabilidad**: La estructura modular permite agregar nuevos temas fácilmente sin afectar los existentes.
- **Convención de nombres**: Los archivos Markdown en la carpeta `docs/` usan minúsculas con guiones (`kebab-case`), por ejemplo, `themes.md`, `views.md`.

## Referencias
- Para la estructura de las vistas, consulta `docs/views.md`.
- Para la estructura de la base de datos, consulta `docs/database.md`.```