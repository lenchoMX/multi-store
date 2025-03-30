# Base de Datos - Multi-Store

## Proceso
- La estructura se define en `draft.yml` con Laravel Shift Blueprint.
- `php artisan blueprint:build` genera migraciones y modelos.

## Esquema Actual (draft.yml)
```yaml
## Esquema Actual (draft.yml)
models:
  User:
    store_id: id foreign:stores  # Agregado para vincular usuarios a tiendas
    name: string
    surname: string
    lastname: string
    email: string
    phone: string nullable
    password: string
    timestamps: true
    relationships:
      hasMany: Address, Cart, Order, Comment

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
      hasMany: User, StoreProduct, CategoryStore, Cart, Order, Address

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
      hasMany: Comment, CartItem  # Cambié Cart por CartItem para alinearlo con una estructura más común

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
    status: enum:pending,checkout,abandoned,completed default:pending
    abandoned_at: timestamp nullable
    timestamps: true
    relationships:
      hasMany: CartItem

  CartItem:
    cart_id: id foreign:carts
    store_product_id: id foreign:store_products
    quantity: integer default:1
    price: decimal:8,2  # Precio al momento de agregar al carrito
    timestamps: true

  Order:
    user_id: id foreign:users nullable
    store_id: id foreign:stores
    address_id: id foreign:addresses nullable
    total: decimal:8,2
    status: enum:pending,payment_pending,completed,cancelled,abandoned default:pending
    abandoned_at: timestamp nullable
    guest_name: string nullable
    guest_email: string nullable
    guest_address_line_1: string nullable
    guest_address_line_2: string nullable
    guest_city: string nullable
    guest_state: string nullable
    guest_postal_code: string nullable
    guest_country: string nullable
    guest_phone: string nullable
    guest_recipient_name: string nullable
    timestamps: true
    relationships:
      hasMany: OrderItem

  OrderItem:
    order_id: id foreign:orders
    store_product_id: id foreign:store_products
    quantity: integer
    price: decimal:8,2
    timestamps: true

  Address:
    user_id: id foreign:users
    store_id: id foreign:stores
    name: string nullable
    address_line_1: string
    address_line_2: string nullable
    city: string
    state: string
    postal_code: string
    country: string
    phone: string nullable
    recipient_name: string nullable
    is_default: boolean default:false
    timestamps: true