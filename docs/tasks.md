# Tareas - Multi-Store

## Tareas Pendientes
1. **Ajustar `CartController` al `draft.yml`**
   - Estado: Pendiente.
   - Detalle: Alinear nombres (`store_products`), usar estructura `Cart`/`CartItem`, y completar funcionalidades (invitados, abandonos).
   - Próximo paso: Reescribir métodos y agregar lógica de abandono.

2. **Ajustar jobs al `draft.yml`**
   - Estado: Pendiente.
   - Detalle: Alinear `SendAbandonedCartEmail` y `SendOrderConfirmationEmail` al `draft.yml`.
   - Próximo paso: Crear `AbandonedCartReminder` y `OrderConfirmation` en `app/Mail`.

3. **Configurar middleware de detección de tiendas**
   - Estado: Pendiente.
   - Próximo paso: Implementar `DetectStore` en `bootstrap/app.php`.

4. **Implementar vistas base con Bootstrap y SweetAlert2**
   - Estado: Pendiente.
   - Próximo paso: Crear `layouts/minimal.blade.php` y vistas dinámicas como `cart.show.{theme}`.

5. **Implementar API de códigos postales**
   - Estado: Pendiente.
   - Detalle: Crear controlador para consultar direcciones vía API y guardarlas en `Address`.
   - Próximo paso: Diseñar endpoint y lógica de integración.

6. **Definir rutas y controladores**
   - Estado: Pendiente.
   - Detalle: Crear rutas para listar tiendas, productos y categorías, y controladores para manejar consultas.
   - Próximo paso: Definir rutas en `routes/api.php` y crear `StoreController`, `StoreProductController`.

## Tareas Completadas
1. **Estructurar proyecto y documentación**
   - Fecha: 28/03/2025.
   - Resultado: Creados `README.md`, `/docs`, y `draft.yml` inicial.

2. **Definir `draft.yml` robusto y escalable**
   - Fecha: 28/03/2025.
   - Resultado: `draft.yml` con todas las tablas y relaciones.

3. **Generar migraciones y modelos con Blueprint**
   - Fecha: 13/04/2025.
   - Resultado: Migraciones y modelos generados con `php artisan blueprint:build`.

4. **Poblar base de datos con datos de prueba**
   - Fecha: 13/04/2025.
   - Resultado: `product.sql` corregido y ejecutado con `php artisan migrate:fresh --seed`. Relaciones verificadas en `tinker`.