# Multi-Store Laravel Project

## Descripción
Este proyecto es un sistema de multitiendas desarrollado en Laravel, diseñado para unificar la gestión de múltiples tiendas en línea bajo un solo código base. Cada tienda opera bajo su propio dominio (ej. `tienda1.com`, `tienda2.com`) y comparte una tabla general de productos, pero con configuraciones y precios personalizados por tienda. El carrito de compras redirige a un subdominio de checkout (ej. `checkout.tienda1.com`) que es un proyecto Laravel separado especializado en control de riesgos y gestión de envíos.

### Objetivo
- Simplificar la actualización y mantenimiento de tiendas previamente desarrolladas en PrestaShop, PHP puro y diferentes versiones de Laravel.
- Centralizar productos y permitir personalización por tienda.
- Separar la lógica de checkout en un proyecto independiente para mayor escalabilidad y seguridad.

## Tecnologías
- **Framework**: Laravel (versión más reciente).
- **Frontend**: Bootstrap 5.3 (o la versión más reciente disponible).
- **Alertas**: SweetAlert2 para notificaciones interactivas.
- **Base de datos**: MySQL/PostgreSQL (según configuración).

## Estructura del Proyecto
### Proyecto 1: Multi-Store (este repositorio)
- **Base de datos**:
  - `products`: Tabla general de productos (id, slug, name, description).
  - `stores`: Configuración de cada tienda (store_url, name, theme_id, settings).
  - `store_products`: Relación entre productos y tiendas (price, stock).
  - `themes`: Temas disponibles (name, css_file, layout_file).
- **Funcionalidad**:
  - Carga dinámica de la tienda y su tema según el dominio.
  - Carrito de compras que redirige al checkout en un subdominio.

### Proyecto 2: Checkout (futuro)
- Subdominios (`checkout.tienda1.com`, `checkout.tienda2.com`) apuntan a un solo proyecto Laravel.
- Gestiona pagos, direcciones de envío y control de riesgos.

## Estado Actual
- Borrador inicial en `draft.yml`.
- En fase de diseño de estructura y optimización.

## Tareas Pendientes
- Implementar migraciones para la base de datos.
- Configurar middleware para detección de dominios y temas.
- Integrar Bootstrap 5.3 y SweetAlert2 en las vistas.
- Diseñar redirección al checkout.

## Notas
- Usa una tabla de productos general para evitar URLs duplicadas (ej. `store.com/producto-uno`).
- Los temas son escalables y se cargan dinámicamente según la tienda.

## Contribuir
- Revisar `draft.yml` para sugerencias.
- Proponer mejoras en la estructura de carpetas y base de datos.