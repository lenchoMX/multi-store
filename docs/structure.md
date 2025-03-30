
#### **`docs/structure.md`**
```markdown
# Estructura del Proyecto - Multi-Store

## Carpetas y Archivos
- `/app/Http/Controllers`: Controladores (ej. `CartController`, borrador a ajustar al `draft.yml`).
- `/app/Http/Middleware`: Middleware (ej. `CartMiddleware`, borrador a ajustar).
- `/app/Jobs`: Jobs (ej. `SendAbandonedCartEmail`, `SendOrderConfirmationEmail`, borradores a ajustar).
- `/app/Models`: Modelos Eloquent generados por Blueprint desde `draft.yml`.
- `/config`: Archivos de configuración personalizados (ej. `multistore.php`).
- `/database/migrations`: Migraciones generadas por Blueprint desde `draft.yml`.
- `/resources/views`:
  - `/layouts`: Plantillas base por tema (`minimal.blade.php`, etc.).
  - `/components`: Componentes reutilizables por tema.
  - `/products`, `/categories`, `/cart`: Vistas dinámicas (pendientes de implementación).
- `/routes`: Rutas definidas en `web.php`.
- `/docs`: Documentación del proyecto.
- `draft.yml`: Fuente principal de la estructura de la base de datos.

## Estado Actual
- `draft.yml` definido como base robusta y escalable.
- Otros archivos son borradores de referencia que deben alinearse al `draft.yml`.

## Próximo Paso
- Generar modelos y migraciones con Blueprint, y actualizar controladores y jobs.