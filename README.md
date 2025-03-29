# Multi-Store Laravel Project

## Descripción
Sistema de multitiendas en Laravel 11 para unificar la gestión de tiendas en línea bajo un solo código base. Cada tienda opera en su dominio (ej. `tienda1.com`) con datos independientes por usuario.

### Tecnologías
- **Framework**: Laravel 11.
- **Frontend**: Bootstrap 5.3 (o la versión más reciente).
- **Alertas**: SweetAlert2.
- **Base de datos**: MySQL/PostgreSQL.
- **Herramienta**: Laravel Shift Blueprint.

## Estructura
Ver `docs/structure.md`.

## Flujo de trabajo
Ver `docs/workflow.md`.

## Tareas y estado
Ver `docs/tasks.md`.

## Decisiones de diseño
Ver `docs/design-decisions.md`.

## Notas
- El `draft.yml` es la fuente principal de la base de datos.
- Los usuarios tienen cuentas por tienda para mantener datos separados.