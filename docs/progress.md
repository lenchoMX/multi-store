# Progreso del Proyecto - Multi-Store

Este documento resume el estado actual del proyecto multi-tienda y los próximos pasos, actualizado al 13 de abril de 2025.

## Estado Actual
- **Base de Datos**:
  - Migraciones generadas con `php artisan blueprint:build` desde `draft.yml`.
  - Tablas creadas: `stores`, `store_products`, `category_stores`, `products`, `users`, `carts`, `orders`, `coupons`, `discounts`, `addresses`, etc.
  - Datos de prueba poblados con `product.sql`:
    - Tiendas: `DepositoDeChelas` (ID 1), `My Store` (ID 2).
    - Productos: Corona, Victoria, Pacifico con precios por tienda (ej. $10 vs. $299 para Corona).
    - Categorías: Cerveza Clara, Retornable, etc.
    - Usuarios: Juan (ID 1), María (ID 2), con direcciones.
    - Carritos: Para usuarios e invitados.
    - Órdenes: Ejemplos para Juan y María.
    - Cupones: `DESC10` (10%), `FIXED50` ($50).
    - Descuentos: 15% en Corona para `DepositoDeChelas`.
  - `checkout_id` en `addresses` listo para integración con API de riesgos.

- **Modelos y Relaciones**:
  - Modelos generados por Blueprint: `Store`, `StoreProduct`, `CategoryStore`, `User`, etc.
  - Relaciones verificadas en `tinker`:
    - `Store::find(1)->storeProducts`: Devuelve `StoreProduct` IDs 1, 2, 3.
    - `StoreProduct::find(1)->categoryStores`: Devuelve categorías (Cerveza Clara, Retornable).
  - Nombres de relaciones (`storeProducts`, `categoryStores`) mantenidos para evitar conflictos con Blueprint.

- **Correcciones**:
  - Resuelto error de sintaxis en `product.sql` (eliminado separador `-------`).
  - Confirmado que no hay duplicados en `store_products`.

## Próximos Pasos
1. **Definir Rutas**:
   - Crear rutas en `routes/api.php` o `routes/web.php` para listar tiendas, productos y categorías.
   - Ejemplo:
```bash
Route::get('/stores', [StoreController::class, 'index']);
Route::prefix('stores/{store}')->group(function () {
    Route::get('/products', [StoreProductController::class, 'index']);
});
```

2. **Crear Controladores**:
   - Implementar `StoreController` y `StoreProductController` para manejar consultas.
   - Usar relaciones `storeProducts` y `categoryStores`.

3. **Probar Rutas**:
   - Verificar endpoints con Postman o navegador.

4. **Implementar Vistas**:
   - Crear vistas dinámicas (`products/index/{theme}.blade.php`) usando temas (`minimal`, `business`, `creative`).

5. **Integrar API de Códigos Postales**:
   - Diseñar controlador para consultar direcciones y vincular `checkout_id`.

## Problemas Conocidos
- Ninguno. La base de datos y relaciones son estables.

## Notas
- Continuar usando nombres generados por Blueprint (`storeProducts`, `categoryStores`).
- Actualizar `product.sql` según nuevas funcionalidades.
- Documentar cada paso en los archivos Markdown correspondientes.