# Multi-Store Laravel Project

## Descripción
Sistema de multitiendas en Laravel 11 para unificar la gestión de tiendas en línea bajo un solo código base. Cada tienda opera en su dominio (ej. `tienda1.com`) con datos independientes por usuario.

### Tecnologías
- **Framework**: Laravel 12.4 (esta es la version mas reciente de laravel).
- **Frontend**: Bootstrap 5.3.
- **Alertas**: SweetAlert2.
- **Base de datos**: MySQL.
- **Herramienta**: Laravel Shift Blueprint.

## Estructura
Ver `docs/structure.md`.

## Flujo de trabajo
Ver `docs/workflow.md`.

## Tareas y estado
Ver `docs/tasks.md`.

## Documentación y estructura de temas
Ver `docs/themes.md`.

## Documentación y estructura de vistas (views)
Ver `docs/views.md`.

## Decisiones de diseño
Ver `docs/design-decisions.md`.

## Notas
- El `draft.yml` es la fuente principal de la base de datos.
- Los usuarios tienen cuentas por tienda para mantener datos separados.

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/lenchoMX/multi-store.git
   cd multi-store
   ```

2. Instala las dependencias de PHP:
    ```
    composer install
    ```

3. Instala las dependencias de JavaScript:
    ```
    npm install
    ```

4. Copia el archivo de entorno y configúralo:
    ```
    cp .env.example .env
    ```
    Edita el archivo .env con tu configuración (base de datos, etc.).

5. Genera la clave de la aplicación:
    ```
    php artisan key:generate
    ```

6. Instala Laravel Shift Blueprint:
    ```
    composer require -W --dev laravel-shift/blueprint
    ```

6. Ejecuta  blueprint:build (Laravel Shift Blueprint):
    ```
    php artisan blueprint:build
    ```

7. Ejecuta las migraciones
    ```
    php artisan migrate
    ```

8. Compila los assets:
    ```
    npm run dev
    ```
## Documentación
Temas: Consulta docs/themes.md para más detalles sobre cómo están organizados y cómo usar los temas.
Vistas: Consulta docs/views.md para más detalles sobre la estructura de las vistas y los componentes.
Estructura del Proyecto
resources/css/: Contiene los estilos de los temas (minimal.css, business.css, creative.css).
resources/views/: Contiene las vistas y componentes organizados por tema.
docs/: Contiene la documentación del proyecto (themes.md, views.md).

### Contribuir
Si deseas contribuir, por favor crea un pull request o reporta un issue en el repositorio.

### Licencia
Este proyecto está bajo la licencia: