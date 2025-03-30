# Vistas en Multi-Store

Este documento describe cómo están organizadas las vistas en el proyecto "multi-store". Las vistas están separadas por tema (`minimal`, `business`, `creative`) para facilitar la detección de errores y mantener los diseños consistentes.

## Estructura de Archivos de las Vistas

Las vistas y componentes están organizados en la carpeta `resources/views/`. Cada tema tiene sus propios layouts, componentes y vistas para evitar conflictos y facilitar la depuración.

```plaintext
resources/views/
├── layouts/                          // Layouts base para cada tema
│   ├── minimal.app.blade.php         // Layout para el tema minimal
│   ├── business.app.blade.php        // Layout para el tema business
│   └── creative.app.blade.php        // Layout para el tema creative
├── components/                       // Componentes organizados por tema
│   ├── minimal/                      // Componentes para el tema minimal
│   │   ├── navbar.blade.php          // Barra de navegación
│   │   ├── footer.blade.php          // Pie de página
│   │   ├── button-close.blade.php    // Botón para cerrar
│   │   ├── button-open.blade.php     // Botón para abrir
│   │   ├── button-send.blade.php     // Botón para enviar formularios
│   │   ├── button-add.blade.php      // Botón para agregar elementos
│   │   ├── button-remove.blade.php   // Botón para eliminar elementos
│   │   └── button-view.blade.php     // Botón para ver detalles
│   ├── business/                     // Componentes para el tema business
│   │   ├── header.blade.php          // Encabezado
│   │   ├── footer.blade.php          // Pie de página
│   │   ├── button-close.blade.php    // Botón para cerrar
│   │   ├── button-open.blade.php     // Botón para abrir
│   │   ├── button-send.blade.php     // Botón para enviar formularios
│   │   ├── button-add.blade.php      // Botón para agregar elementos
│   │   ├── button-remove.blade.php   // Botón para eliminar elementos
│   │   └── button-view.blade.php     // Botón para ver detalles
│   ├── creative/                     // Componentes para el tema creative
│   │   ├── header.blade.php          // Encabezado
│   │   ├── button-close.blade.php    // Botón para cerrar
│   │   ├── button-open.blade.php     // Botón para abrir
│   │   ├── button-send.blade.php     // Botón para enviar formularios
│   │   ├── button-add.blade.php      // Botón para agregar elementos
│   │   ├── button-remove.blade.php   // Botón para eliminar elementos
│   │   └── button-view.blade.php     // Botón para ver detalles
│   └── shared/                       // Componentes compartidos entre temas
│       ├── alert.blade.php           // Componente de alerta genérico
├── products/                         // Vistas relacionadas con productos
│   ├── index/                        // Lista de productos
│   │   ├── minimal.blade.php         // Vista para el tema minimal
│   │   ├── business.blade.php        // Vista para el tema business
│   │   └── creative.blade.php        // Vista para el tema creative
│   ├── show/                         // Detalle de un producto
│   │   ├── minimal.blade.php         // Vista para el tema minimal
│   │   ├── business.blade.php        // Vista para el tema business
│   │   └── creative.blade.php        // Vista para el tema creative
├── categories/                       // Vistas relacionadas con categorías
│   ├── index/                        // Lista de categorías
│   │   ├── minimal.blade.php         // Vista para el tema minimal
│   │   ├── business.blade.php        // Vista para el tema business
│   │   └── creative.blade.php        // Vista para el tema creative
│   ├── show/                         // Detalle de una categoría
│   │   ├── minimal.blade.php         // Vista para el tema minimal
│   │   ├── business.blade.php        // Vista para el tema business
│   │   └── creative.blade.php        // Vista para el tema creative
└── cart/                             // Vistas relacionadas con el carrito
    ├── show/                         // Vista del carrito
    │   ├── minimal.blade.php         // Vista para el tema minimal
    │   ├── business.blade.php        // Vista para el tema business
    │   └── creative.blade.php        // Vista para el tema creative
```

## Descripción de las secciones

### Layouts (`layouts/`)
Cada tema tiene su propio layout, que define la estructura base de las páginas (encabezado, pie de página, etc.). Los layouts incluyen los componentes específicos del tema (por ejemplo, `<x-minimal.navbar />` para el tema `minimal`).

- **`minimal.app.blade.php`**: Layout para el tema `minimal`, con un diseño limpio y minimalista.
- **`business.app.blade.php`**: Layout para el tema `business`, con un diseño más profesional y oscuro.
- **`creative.app.blade.php`**: Layout para el tema `creative`, con un diseño colorido y moderno.

### Componentes (`components/`)
Los componentes están organizados por tema para mantener los estilos y la lógica separados. Cada tema tiene componentes para botones y elementos comunes (como barras de navegación y pies de página).

- **`minimal/`**, **`business/`**, **`creative/`**: Contienen componentes específicos para cada tema.
  - **Botones**: Cada tema tiene botones personalizados (`button-close`, `button-send`, etc.) que usan clases CSS específicas (por ejemplo, `btn-close-minimal`, `btn-send-business`).
  - **Otros componentes**: Incluyen `navbar`, `footer`, `header`, etc., según el tema.
- **`shared/`**: Contiene componentes reutilizables entre temas, como alertas (`alert.blade.php`).

### Vistas (`products/`, `categories/`, `cart/`)
Las vistas están separadas por tema para facilitar la detección de errores. Cada vista extiende el layout correspondiente al tema (por ejemplo, `@extends('layouts.minimal.app')`).

- **`products/index/`**: Vistas para listar productos.
- **`products/show/`**: Vistas para mostrar los detalles de un producto.
- **`categories/index/`**: Vistas para listar categorías.
- **`categories/show/`**: Vistas para mostrar los detalles de una categoría.
- **`cart/show/`**: Vistas para mostrar el carrito de compras.

## Cómo usar las vistas

### 1. Cargar la vista según el tema
En un controlador o componente Livewire, carga la vista correspondiente al tema de la tienda:

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

### 2. Usar componentes específicos del tema
Cada vista debe usar los componentes correspondientes al tema. Por ejemplo, en `products/index/minimal.blade.php`, usa `<x-minimal.button-add />` para agregar un producto al carrito.

#### Ejemplo
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

## Agregar una nueva vista para un tema

Para agregar una nueva vista para un tema existente (por ejemplo, `minimal`):

1. **Crear la vista**:
   - Crea el archivo en la carpeta correspondiente (por ejemplo, `resources/views/products/edit/minimal.blade.php` para una vista de edición de productos).
   - Extiende el layout del tema:
     ```html
     @extends('layouts.minimal.app')

     @section('content')
         <h1>Editar Producto (Minimal)</h1>
         <!-- Contenido de la vista -->
     @endsection
     ```

2. **Actualizar el controlador o componente Livewire**:
   - Asegúrate de que el controlador o componente cargue la vista correcta:
     ```php
     return view("products.edit.{$theme}");
     ```

## Notas
- **Detección de errores**: Al tener vistas y layouts separados por tema, los errores estarán aislados. Por ejemplo, un error en `products/index/minimal.blade.php` solo afectará al tema `minimal`.
- **Escalabilidad**: Para agregar un nuevo tema, crea los layouts, componentes y vistas correspondientes (consulta `docs/themes.md` para más detalles).

## Referencias
- Para más detalles sobre los temas, consulta `docs/themes.md`.
- Para la estructura de la base de datos, consulta `docs/database.md`.