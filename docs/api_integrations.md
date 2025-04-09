# Integraciones con APIs

Este archivo documenta las integraciones con sistemas externos a través de APIs, específicamente con `multi-store-checkout` para análisis de riesgos.

## Integración con `multi-store-checkout`

### Propósito
El sistema `multi-store` envía datos de usuarios y transacciones al sistema `multi-store-checkout` para realizar un análisis de riesgo. Esto permite identificar usuarios o transacciones riesgosas y tomar decisiones como exigir autenticación adicional o restringir promociones.

### Endpoint
- **URL**: `https://multi-store-checkout/api/check-risk`
- **Método**: POST
- **Autenticación**: API Key (pendiente de definir, por ejemplo, en el header `Authorization: Bearer <token>`).

### Datos enviados
`multi-store` envía un payload con los datos actuales del usuario, su historial y detalles de la transacción. Ejemplo de estructura:

- `user_id`: ID del usuario en `multi-store`.
- `current_email`: Email actual del usuario.
- `current_phone`: Teléfono actual del usuario.
- `current_address_id`: ID de la dirección actual del usuario.
- `history`: Historial de datos del usuario (de la tabla `user_history`):
  - `emails`: Lista de emails históricos.
  - `phones`: Lista de teléfonos históricos.
  - `addresses`: Lista de `address_id` históricos.
- `transaction`: Detalles de la transacción actual:
  - `order_id`: ID del pedido.
  - `total_amount`: Monto total.
  - `store_id`: ID de la tienda.

**Ejemplo de payload**:
```json
{
  "user_id": 1,
  "current_email": "user@example.com",
  "current_phone": "555-1234",
  "current_address_id": 456,
  "history": {
    "emails": ["olduser@example.com"],
    "phones": ["555-5678"],
    "addresses": [123]
  },
  "transaction": {
    "order_id": 1001,
    "total_amount": 150.50,
    "store_id": 2
  }
}
```

### Respuesta esperada
`multi-store-checkout` devuelve un JSON con el resultado del análisis de riesgo:

- `is_risky`: Booleano que indica si la transacción o usuario es riesgoso.
- `risk_level`: Enum ('low', 'medium', 'high'). Nivel de riesgo actualizado.
- `trust_score`: Entero (0-100). Puntaje de confiabilidad actualizado.
- `details`: Detalles adicionales (opcional, para auditoría).

**Ejemplo de respuesta**:
```json
{
  "is_risky": true,
  "risk_level": "high",
  "trust_score": 30,
  "details": "Email matches known fraudulent data"
}
```

### Flujo de integración
1. Durante el proceso de checkout, `multi-store` recopila los datos del usuario y la transacción.
2. Envía una solicitud POST a `https://multi-store-checkout/api/check-risk`.
3. Recibe la respuesta y actualiza los campos `risk_level`, `trust_score` y `last_risk_update` del usuario en la tabla `user`.
4. Si `is_risky` es `true`, se toman acciones como:
   - Exigir autenticación adicional (por ejemplo, vía WhatsApp).
   - Restringir promociones o descuentos.

### Notas
- La llamada a la API debe be asíncrona (usando colas) para no retrasar la respuesta al usuario.
- Los datos históricos (`history`) aseguran que `multi-store-checkout` pueda detectar riesgos incluso si el usuario cambia su email, teléfono o dirección.