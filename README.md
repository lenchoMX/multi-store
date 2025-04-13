# Multi-Store Laravel Project

## Descripción
Sistema de multitiendas en Laravel 12.4 para unificar la gestión de tiendas en línea bajo un solo código base. Cada tienda opera en su dominio (ej. `tienda1.com`) con datos independientes por usuario, soportando productos, categorías, carritos, órdenes, cupones y descuentos personalizados por tienda.

### Tecnologías
- **Framework**: Laravel 12.4 (versión más reciente).
- **Frontend**: Bootstrap 5.3.
- **Alertas**: SweetAlert2.
- **Base de datos**: MySQL.
- **Herramienta**: Laravel Shift Blueprint.

## Progreso Actual
- Esquema de base de datos definido con migraciones generadas por Blueprint (`stores`, `store_products`, `category_stores`, `users`, etc.).
- Datos de prueba poblados mediante `product.sql`, incluyendo:
  - Tiendas: `DepositoDeChelas`, `My Store`.
  - Productos: Corona, Victoria, Pacifico con precios por tienda.
  - Usuarios, carritos, órdenes, cupones y descuentos.
- Relaciones verificadas en `tinker`:
  - `Store::find(1)->storeProducts`: Devuelve productos de la tienda.
  - `StoreProduct::find(1)->categoryStores`: Devuelve categorías asociadas.
- Listo para implementar rutas y controladores.

Ver [progreso.md](docs/progreso.md) para más detalles.

## Estructura
Ver [docs/structure.md](docs/structure.md).

## Flujo de trabajo
Ver [docs/workflow.md](docs/workflow.md).

## Tareas y estado
Ver [docs/tasks.md](docs/tasks.md).

## Documentación y estructura de temas
Ver [docs/themes.md](docs/themes.md).

## Documentación y estructura de vistas
Ver [docs/views.md](docs/views.md).

## Decisiones de diseño
Ver [docs/design-decisions.md](docs/design-decisions.md).

## Notas
- El `draft.yml` es la fuente principal de la base de datos.
- Los usuarios tienen cuentas por tienda para mantener datos separados.

## Instalación

1. Clona el repositorio:
```bash
git clone https://github.com/lenchoMX/multi-store.git
cd multi-store
```

2. Instala las dependencias de PHP:
```bash
composer install
```

3. Instala las dependencias de JavaScript:
```bash
npm install
```

4. Copia el archivo de entorno y configúralo:
```bash
cp .env.example .env
```
Edita el archivo `.env` con tu configuración (base de datos, etc.).

5. Genera la clave de la aplicación:
```bash
php artisan key:generate
```

6. Instala Laravel Shift Blueprint:
```bash
composer require -W --dev laravel-shift/blueprint
```

7. Genera migraciones y modelos:
```bash
php artisan blueprint:build
```

8. Ejecuta las migraciones y pobla datos de prueba:
```bash
php artisan migrate:fresh --seed
```

9. Compila los assets:
```bash
npm run dev
```

## Documentación
- **Temas**: Consulta [docs/themes.md](docs/themes.md) para detalles sobre temas.
- **Vistas**: Consulta [docs/views.md](docs/views.md) para la estructura de vistas.
- **Base de datos**: Consulta [docs/database.md](docs/database.md) para el esquema.

## Contribuir
Crea un pull request o reporta un issue en el repositorio.

## Licencia
MIT