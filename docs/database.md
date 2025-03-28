# Base de Datos - Multi-Store

## Proceso
- La estructura de la base de datos se define en `draft.yml` usando Laravel Shift Blueprint.
- Los comandos `php artisan blueprint:build` generan migraciones y modelos automáticamente.
- Cambios manuales en migraciones o modelos se hacen solo si Blueprint no cubre un caso específico.

## Esquema Actual (draft.yml)
```yaml
models:
  Theme:
    name: string unique
    description: text nullable
    css_file: string nullable
    layout_file: string
    timestamps: true
    relationships:
      hasMany: Store
  Store:
    name: string
    store_url: string unique
    email: string nullable
    whatsapp: string nullable
    theme_id: foreign:themes nullable
    settings: json nullable
    timestamps: true
    relationships:
      belongsTo: Theme
      hasMany: StoreProduct
  Product:
    slug: string unique
    name: string
    description: text nullable
    timestamps: true
    relationships:
      hasMany: StoreProduct
  StoreProduct:
    store_id: foreign:stores
    product_id: foreign:products
    price: decimal:10,2
    stock: integer default:0
    is_active: boolean default:true
    timestamps: true
    relationships:
      belongsTo: Store, Product