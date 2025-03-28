# Multi-Store Laravel Project

## Descripción
Sistema de multitiendas en Laravel 11 para unificar la gestión de tiendas en línea bajo un solo código base. Cada tienda opera en su dominio (ej. `tienda1.com`) con productos compartidos y configuraciones personalizadas. El carrito redirige a un subdominio de checkout (ej. `checkout.tienda1.com`), un proyecto separado.

### Tecnologías
- **Framework**: Laravel 11.
- **Frontend**: Bootstrap 5.3 (o la versión más reciente).
- **Alertas**: SweetAlert2.
- **Base de datos**: MySQL/PostgreSQL.
- **Herramienta**: Laravel Shift Blueprint para generar modelos y migraciones desde `draft.yml`.

## Estructura
Ver `docs/structure.md`.

## Flujo de trabajo
Ver `docs/workflow.md`.

## Tareas y estado
Ver `docs/tasks.md`.

## Notas
- El `draft.yml` es la fuente principal de verdad, diseñado para ser robusto, escalable y consistente.
- Otros archivos (`CartController`, jobs, etc.) son borradores de referencia y deben ajustarse al `draft.yml`.