
#### `docs/structure.md`
```markdown
# Estructura del Proyecto - Multi-Store

## Carpetas y Archivos
- `/app/Http/Controllers`: Controladores para tiendas, productos y carritos.
- `/app/Http/Middleware`: Middleware para detección de tiendas (Laravel 11 style).
- `/app/Models`: Modelos Eloquent generados por Blueprint (`Store`, `Theme`, etc.).
- `/config`: Archivos de configuración personalizados (ej. `multistore.php`).
- `/database/migrations`: Migraciones generadas por Blueprint desde `draft.yml`.
- `/resources/views`:
  - `/layouts`: Plantillas base por tema (`minimal.blade.php`, etc.).
  - `/components`: Componentes reutilizables por tema.
  - `/products`, `/categories`, `/cart`: Vistas dinámicas.
- `/routes`: Rutas definidas en `web.php`.
- `/docs`: Documentación del proyecto.
- `draft.yml`: Archivo principal para definir modelos y relaciones con Blueprint.

## Estado Actual
- Estructura inicial propuesta.
- `draft.yml` actualizado con esquema inicial.

## Próximo Paso
- Generar archivos base con `php artisan blueprint:build`.