# Documentación de Modelos

Este archivo documenta los modelos del proyecto multi-tienda en Laravel, generados con Laravel Shift Blueprint desde `draft.yml`.

---

## User
Representa a los usuarios de cada tienda, con datos aislados por `store_id`.

- **Campos**:
  - `store_id`: ID de la tienda (foreign key a `stores`).
  - `given_name`: Nombre.
  - `family_name`: Apellido.
  - `email`: Correo electrónico (único por tienda).
  - `phone`: Teléfono (opcional).
  - `password`: Contraseña hasheada.
  - `trust_score`: Entero (0-100, default: 50). Puntaje de confiabilidad.
  - `risk_level`: Enum ('low', 'medium', 'high', default: 'low').
  - `last_risk_update`: Timestamp (opcional).

- **Relaciones**:
  - `belongsTo: Store`
  - `hasMany: Cart, Order`
  - `belongsToMany: Address` (via `address_user`)

- **Lógica específica**:
  - Clave única: `['store_id', 'email']`.
  - `trust_score` y `risk_level` se actualizan según compras y análisis externo.

---

## Store
Representa una tienda en el sistema.

- **Campos**:
  - `name`: Nombre de la tienda.
  - `store_url`: URL única.
  - `email`: Correo (opcional).
  - `whatsapp`: Teléfono (opcional).
  - `theme_id`: ID del tema (foreign key a `themes`, opcional).
  - `currency_id`: ID de la moneda (foreign key a `currencies`, opcional).

- **Relaciones**:
  - `hasMany: User, StoreProduct, CategoryStore, Cart, Order, Coupon, Discount`
  - `belongsTo: Theme, Currency`

- **Lógica específica**:
  - Verificado en `tinker`: `Store::find(1)->storeProducts` devuelve productos.

---

## StoreProduct
Representa un producto específico de una tienda, con precio y stock propios.

- **Campos**:
  - `store_id`: ID de la tienda.
  - `product_id`: ID del producto.
  - `image_id`: ID de la imagen (opcional).
  - `description_id`: ID de la descripción (opcional).
  - `short_description_id`: ID de la descripción corta (opcional).
  - `price`: Precio específico.
  - `currency_id`: ID de la moneda.
  - `stock`: Inventario (default: 999).
  - `is_active`: Booleano (default: true).
  - `view`, `rating_value`, `review_count`, `comment_count`: Estadísticas (default: 0).
  - `primary_category_store_id`: Categoría principal (opcional).

- **Relaciones**:
  - `belongsTo: Store, Product, Image, Description, ShortDescription, Currency`
  - `belongsToMany: CategoryStore` (via `category_store_store_product`)
  - `hasMany: CartItem, OrderItem`

- **Lógica específica**:
  - Verificado en `tinker`: `StoreProduct::find(1)->categoryStores` devuelve categorías.

---

## Product
Producto genérico, compartido entre tiendas.

- **Campos**:
  - `slug`: Identificador único.
  - `name`: Nombre.
  - `price`: Precio base.
  - `brand_id`: ID de la marca (opcional).

- **Relaciones**:
  - `belongsTo: Brand`
  - `belongsToMany: Feature`
  - `hasMany: Description, ShortDescription, Image, StoreProduct`

---

## CategoryStore
Categoría específica de una tienda.

- **Campos**:
  - `store_id`: ID de la tienda.
  - `category_id`: ID de la categoría.
  - `parent_id`: ID de categoría padre (opcional).

- **Relaciones**:
  - `belongsTo: Store, Category`
  - `belongsToMany: StoreProduct` (via `category_store_store_product`)

---

## Cart
Carrito de compras, para usuarios o invitados.

- **Campos**:
  - `user_id`: ID del usuario (opcional).
  - `store_id`: ID de la tienda.
  - `session_id`: Identificador de sesión (opcional).

- **Relaciones**:
  - `belongsTo: User, Store`
  - `hasMany: CartItem`

---

## Order
Órden de compra.

- **Campos**:
  - `store_id`: ID de la tienda.
  - `user_id`: ID del usuario (opcional).
  - `shipping_address_id`: ID de la dirección (opcional).
  - `order_number`: Número único.
  - `order_date`: Fecha.
  - `total_amount`: Total.
  - `order_status_id`: Estado.

- **Relaciones**:
  - `belongsTo: Store, User, Address, OrderStatus`
  - `hasMany: OrderItem`

---

## Coupon
Cupón de descuento.

- **Campos**:
  - `code`: Código único.
  - `store_id`: ID de la tienda.
  - `type`: Enum ('percentage', 'fixed').
  - `value`: Valor del descuento.
  - `is_active`: Booleano (default: true).

- **Relaciones**:
  - `belongsTo: Store`

---

## Discount
Descuento general.

- **Campos**:
  - `store_id`: ID de la tienda.
  - `type`: Enum ('percentage', 'fixed').
  - `value`: Valor.
  - `is_active`: Booleano (default: true).

- **Relaciones**:
  - `belongsTo: Store`
  - `belongsToMany: Product` (via `discount_product`)