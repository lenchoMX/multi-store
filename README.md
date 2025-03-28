# Multi-Store Laravel Project

## Descripción
Este proyecto es un sistema de multitiendas desarrollado en Laravel, diseñado para unificar la gestión de múltiples tiendas en línea bajo un solo código base. Cada tienda opera bajo su propio dominio (ej. `tienda1.com`, `tienda2.com`) y comparte una tabla general de productos, pero con configuraciones y precios personalizados por tienda. El carrito de compras redirige a un subdominio de checkout (ej. `checkout.tienda1.com`) que es un proyecto Laravel separado especializado en control de riesgos y gestión de envíos.

### Objetivo
- Simplificar la actualización y mantenimiento de tiendas previamente desarrolladas en PrestaShop, PHP puro y diferentes versiones de Laravel.
- Centralizar productos y permitir personalización por tienda.
- Separar la lógica de checkout en un proyecto independiente para mayor escalabilidad y seguridad.

## Estructura del Proyecto
### Proyecto 1: Multi-Store (este repositorio)
- **Base de datos**:
  - `products`: Tabla general de productos (id, name, description, etc.).
  - `site_products`: Relación entre productos y tiendas (site_id, product_id, price, etc.).
  - `sites`: Configuración de cada tienda (domain, name, theme, etc.).
- **Funcionalidad**:
  - Carga dinámica de la tienda según el dominio.
  - Carrito de compras que redirige al checkout en un subdominio.

### Proyecto 2: Checkout (futuro)
- Subdominios (`checkout.tienda1.com`, `checkout.tienda2.com`) apuntan a un solo proyecto Laravel.
- Gestiona pagos, direcciones de envío y control de riesgos.

## Estado Actual
- Borrador inicial en `draft.yml`.
- En fase de diseño de estructura y optimización.

## Tareas Pendientes
- Definir estructura completa de la base de datos.
- Implementar middleware para detección de dominios.
- Diseñar sistema de temas/configuraciones por tienda.
- Integrar redirección al checkout.

## Notas
- Este proyecto busca resolver problemas de URLs duplicadas (ej. `store.com/producto_uno.html`) mediante una tabla de productos general.
- Se planea optimizar nombres de variables, archivos y estructura de código.

## Contribuir
- Revisar `draft.yml` para sugerencias.
- Proponer mejoras en la estructura de carpetas y base de datos.