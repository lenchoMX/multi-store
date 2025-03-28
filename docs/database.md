# Base de Datos - Multi-Store

## Proceso
- La estructura se define en `draft.yml` con Laravel Shift Blueprint.
- `php artisan blueprint:build` genera migraciones y modelos.
- Relaciones `belongsTo` son implícitas vía claves foráneas y no se duplican en `relationships`.

## Esquema Actual (draft.yml)
```yaml
models:
  User:
    name: string
    email: string unique
    password: string
    timestamps: true
    relationships:
      hasMany: Cart, Order, Comment

  Store:
    name: string
    store_url: string unique
    email: string nullable
    whatsapp: string nullable
    theme_id: id foreign:themes nullable
    currency_id: id foreign:currencies nullable
    settings: json nullable
    timestamps: true
    relationships:
      hasMany: StoreProduct, CategoryStore, Cart, Order

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
      belongsToMany: CategoryStore
      hasMany: Comment, Cart

  Description:
    product_id: id foreign:products
    description: text
    timestamps: true

  ShortDescription:
    product_id: id foreign:products
    description: string:255
    timestamps: true

  Image:
    product_id: id foreign:products
    name: string:255
    timestamps: true

  Comment:
    user_id: id foreign:users
    store_product_id: id foreign:store_products
    comment: string:255
    timestamps: true

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
    is_featured: boolean default:false
    timestamps: true
    relationships:
      belongsToMany: StoreProduct

  Feature:
    name: string
    parent_id: id nullable foreign:features
    timestamps: true
    relationships:
      belongsToMany: Product

  Cart:
    session_id: string nullable
    user_id: id foreign:users nullable
    store_id: id foreign:stores
    product_store_id: id foreign:store_products
    quantity: integer default:1
    price: decimal:8,2  # Precio al momento de agregar al carrito
    status: enum:pending,checkout,abandoned,completed default:pending
    abandoned_at: timestamp nullable
    timestamps: true
    relationships:
      belongsTo: Order  # Cada ítem del carrito pertenece a una orden cuando se procesa

  Order:
    user_id: id foreign:users nullable
    store_id: id foreign:stores
    name: string nullable
    email: string nullable
    address: string nullable
    total: decimal:8,2
    status: enum:pending,payment_pending,completed,cancelled,abandoned default:pending
    abandoned_at: timestamp nullable
    timestamps: true
    relationships:
      hasMany: Cart, OrderItem  # Order tiene ítems del carrito y detalles adicionales

  OrderItem:
    order_id: id foreign:orders
    store_product_id: id foreign:store_products
    quantity: integer
    price: decimal:8,2
    timestamps: true