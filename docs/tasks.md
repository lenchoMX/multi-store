# Tareas - Multi-Store

## Tareas Pendientes
1. **Generar migraciones y modelos con Blueprint**
   - Estado: Pendiente.
   - Próximo paso: Ejecutar `php artisan blueprint:build` con el `draft.yml` actualizado.
2. **Ajustar `CartController` al `draft.yml`**
   - Estado: Pendiente.
   - Detalle: Alinear nombres (ej. `store_products` vs `product_stores`) y completar funcionalidades (pago real, invitados, abandonos).
   - Próximo paso: Actualizar métodos y agregar lógica de abandono.
3. **Ajustar jobs al `draft.yml`**
   - Estado: Pendiente.
   - Detalle: Alinear `SendAbandonedCartEmail` y `SendOrderConfirmationEmail` al `draft.yml` y crear clases de correo.
   - Próximo paso: Crear `AbandonedCartReminder` y `OrderConfirmation` en `app/Mail`.
4. **Configurar middleware de detección de tiendas**
   - Estado: Pendiente.
   - Próximo paso: Implementar `DetectStore` en `bootstrap/app.php`.
5. **Implementar vistas base con Bootstrap y SweetAlert2**
   - Estado: Pendiente.
   - Próximo paso: Crear `layouts/minimal.blade.php` y vistas dinámicas como `cart.show.{theme}`.

## Tareas Completadas
- **Estructurar proyecto y documentación**
  - Fecha: 28/03/2025.
  - Resultado: Creados `README.md`, `/docs`, y `draft.yml` inicial.
- **Definir `draft.yml` robusto y escalable**
  - Fecha: 28/03/2025.
  - Resultado: `draft.yml` consolidado como fuente principal tras analizar borradores.