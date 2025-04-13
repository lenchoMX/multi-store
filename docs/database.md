# Base de Datos - Multi-Store

## Proceso
- La estructura se define en `draft.yml` con Laravel Shift Blueprint.
- `php artisan blueprint:build` genera migraciones y modelos.
- `php artisan migrate:fresh --seed` ejecuta migraciones y pobla datos de prueba con `product.sql`.

## Esquema Actual (draft.yml)
```yaml
models:
  User:
    store_id: id foreign:stores
    given_name: string
    family_name: string
    email: string unique
    phone: string nullable
    password: string
    trust_score: integer default:50
    risk_level: enum:low,medium,high default:low
    last_risk_update: timestamp nullable
    timestamps: true
    relationships:
      belongsTo: Store
      hasMany: Address, Cart, Order, Comment
      belongsToMany: Address via address_user

  Store:
    name: string
    store_url: string unique
    email: string nullable
    whatsapp: string nullable
    theme_id: id foreign:themes nullable
    currency_id: id foreign:currencies nullable
    timestamps: true
    relationships:
      hasMany: User, StoreProduct, CategoryStore, Cart, Order, Coupon, Discount

  Theme:
    name: string unique
    description: text nullable
    css_file: string nullable
    layout_file: string
    timestamps: true
    relationships:
      hasMany: Store

  Currency:
    code: string:5 unique
    name: string:50 nullable
    exchange_rate: decimal:6,2
    timestamps: true
    relationships:
      hasMany: Store, StoreProduct

  Product:
    slug: string unique
    name: string
    price: decimal:8,2
    brand_id: id foreign:brands nullable
    timestamps: true
    relationships:
      belongsTo: Brand
      belongsToMany: Feature
      hasMany: Description, ShortDescription, Image, StoreProduct

  Brand:
    name: string:99
    slug: string:255
    image: string:99 nullable
    timestamps: true
    relationships:
      hasMany: Product

  StoreProduct:
    store_id: id foreign:stores
    product_id: id foreign:products
    image_id: id foreign:images nullable
    description_id: id foreign:descriptions nullable
    short_description_id: id foreign:short_descriptions nullable
    price: decimal:8,2
    currency_id: id foreign:currencies
    stock: unsignedInteger default:999
    is_active: boolean default:true
    view: unsignedInteger default:0
    rating_value: unsignedInteger default:0
    review_count: unsignedInteger default:0
    comment_count: unsignedInteger default:0
    primary_category_store_id: id foreign:category_stores nullable
    timestamps: true
    relationships:
      belongsTo: Store, Product, Image, Description, ShortDescription, Currency
      belongsToMany: CategoryStore via category_store_store_product
      hasMany: CartItem, OrderItem

  Description:
    product_id: id foreign:products
    content: text
    timestamps: true
    relationships:
      belongsTo: Product

  ShortDescription:
    product_id: id foreign:products
    content: string:255
    timestamps: true
    relationships:
      belongsTo: Product

  Image:
    product_id: id foreign:products
    url: string:255
    timestamps: true
    relationships:
      belongsTo: Product

  Category:
    name: string:255
    slug: string:255
    timestamps: true
    relationships:
      hasMany: CategoryStore

  CategoryStore:
    store_id: id foreign:stores
    category_id: id foreign:categories
    parent_id: id nullable foreign:category_stores
    timestamps: true
    relationships:
      belongsTo: Store, Category
      belongsToMany: StoreProduct via category_store_store_product

  Feature:
    name: string
    parent_id: id nullable foreign:features
    timestamps: true
    relationships:
      belongsToMany: Product via feature_product

  Cart:
    user_id: id foreign:users nullable
    store_id: id foreign:stores
    session_id: string nullable
    timestamps: true
    relationships:
      belongsTo: User, Store
      hasMany: CartItem

  CartItem:
    cart_id: id foreign:carts
    store_product_id: id foreign:store_products
    quantity: integer default:1
    price: decimal:8,2
    timestamps: true
    relationships:
      belongsTo: Cart, StoreProduct

  Order:
    store_id: id foreign:stores
    user_id: id foreign:users nullable
    shipping_address_id: id foreign:addresses nullable
    order_number: string
    order_date: timestamp
    total_amount: decimal:8,2
    order_status_id: id foreign:order_statuses
    timestamps: true
    relationships:
      belongsTo: Store, User, Address, OrderStatus
      hasMany: OrderItem

  OrderItem:
    order_id: id foreign:orders
    product_id: id foreign:products
    quantity: integer
    unit_price: decimal:8,2
    timestamps: true
    relationships:
      belongsTo: Order, Product

  OrderStatus:
    name: string
    timestamps: true
    relationships:
      hasMany: Order

  Address:
    checkout_id: id
    postal_code: string
    address_line_1: string
    type: string
    timestamps: true
    relationships:
      belongsToMany: User via address_user

  Coupon:
    code: string unique
    store_id: id foreign:stores
    type: enum:percentage,fixed
    value: decimal:8,2
    is_active: boolean default:true
    timestamps: true
    relationships:
      belongsTo: Store

  Discount:
    store_id: id foreign:stores
    type: enum:percentage,fixed
    value: decimal:8,2
    is_active: boolean default:true
    timestamps: true
    relationships:
      belongsTo: Store
      belongsToMany: Product via discount_product
```

## Datos de Prueba
- El archivo `product.sql` pobla las tablas con datos de prueba:
  - Tiendas: `DepositoDeChelas`, `My Store`.
  - Productos: Corona, Victoria, Pacifico con precios específicos por tienda.
  - Categorías: Cerveza Clara, Retornable, etc., asignadas por tienda.
  - Usuarios: Juan, María, con direcciones vinculadas vía `address_user`.
  - Carritos: Para usuarios e invitados.
  - Órdenes: Ejemplos para Juan y María.
  - Cupones: `DESC10` (10%), `FIXED50` ($50).
  - Descuentos: 15% en Corona para `DepositoDeChelas`.
- Verificados en `tinker`:
  - `Store::find(1)->storeProducts`
  - `StoreProduct::find(1)->categoryStores`

## Notas
- `checkout_id` en `Address` es un identificador externo para gestión de riesgos.
- La relación `address_user` permite vincular múltiples direcciones a usuarios.