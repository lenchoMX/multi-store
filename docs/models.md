# Documentación de Modelos
Este archivo documenta los modelos de mi proyecto multi-tienda en Laravel. Está diseñado para que tú, como IA, puedas entender rápidamente la estructura y lógica de mi trabajo.

---

## User
Representa a los usuarios de cada tienda. Cada usuario está vinculado a una tienda específica.

- **Campos**:
  - `store_id`: ID de la tienda (foreign key a `stores`).
  - `given_name`: Nombre de pila.
  - `family_name`: Apellido principal.
  - `additional_name`: Apellido adicional o nombres intermedios (opcional).
  - `email`: Correo electrónico (único por tienda).
  - `phone`: Número de teléfono (opcional).
  - `password`: Contraseña hasheada.
  - `risk_level`: Enum ('low', 'medium', 'high'). Nivel de riesgo del usuario, calculado según el `trust_score`. Default: 'low'.
  - `trust_score`: Entero (0-100). Puntaje de confiabilidad del usuario, ajustado según su comportamiento. Default: 50.
  - `last_risk_update`: Timestamp. Fecha de la última actualización del riesgo.

- **Relaciones**:
  - `belongsTo: Store`
  - `hasMany: Address, Cart, Order, Comment`

- **Lógica específica**:
  - Clave compuesta `$table->unique(['store_id', 'email'])` añadida manualmente en la migración.
  - El `risk_level` y `trust_score` se actualizan dinámicamente según las compras y el análisis de `multi-store-checkout`.

---

## Country
Almacena los códigos y nombres de países para normalizar direcciones.

- **Campos**:
  - `code`: Código ISO 3166-1 alpha-2 (2 letras, único).
  - `name`: Nombre completo del país.

- **Relaciones**:
  - `hasMany: Address`

---

## Discount
Gestiona descuentos generales aplicables a productos o tiendas.

- **Campos**:
  - `store_id`: ID de la tienda.
  - `type`: 'percentage' o 'fixed'.
  - `value`: Valor del descuento (decimal).
  - `start_date`, `end_date`: Fechas de validez.
  - `is_active`: Estado del descuento.

- **Relaciones**:
  - `belongsTo: Store`
  - `belongsToMany: Product`