# Decisiones de Diseño - Multi-Store

Este documento registra decisiones clave sobre el diseño de la base de datos y la lógica del proyecto.

## Propuesta de Campos para la Tabla de Direcciones
Para que la tabla `Address` sea robusta y escalable, adaptable a diferentes países como México (con "colonia" y "alcaldía") y otros sin esos conceptos, se definieron los siguientes campos:

- **`checkout_id`**: Identificador externo para gestión de riesgos (API de códigos postales).
- **`postal_code`**: Código postal (ej. "06500").
- **`address_line_1`**: Calle y número (ej. "Av. Insurgentes 123").
- **`address_line_2`**: Información adicional (ej. "Col. Juárez, Alcaldía Cuauhtémoc", opcional).
- **`type`**: Tipo de dirección (ej. "sepomex").

### Justificación
- `checkout_id` permite integrar con una API externa para evaluar riesgos según el código postal, afectando opciones de pago.
- Campos genéricos como `address_line_1` y `address_line_2` ofrecen flexibilidad para formatos locales.

## Solución: Usuarios por Tienda
Para que un usuario pueda registrarse en múltiples tiendas sin compartir datos, se añadió `store_id` a la tabla `User`.

- **Estructura**:
  - `id`: Identificador único.
  - `store_id`: Clave foránea a `stores`.
  - `given_name`, `family_name`, `email`, `password`: Datos del usuario.

### Ejemplo
- Registro en `tienda1.com`: `id: 1`, `store_id: 1`, `email: juan@example.com`.
- Registro en `tienda2.com`: `id: 2`, `store_id: 2`, `email: juan@example.com`.

### Justificación
- Escalabilidad: Un usuario puede tener cuentas en múltiples tiendas.
- Aislamiento: Datos (direcciones, órdenes) están separados por `store_id`.

## Invitados vs. Registrados
- **Invitados**: No tienen registro en `User`. Sus datos se guardan en `Order` con campos `guest_*`.
- **Registrados**: Tienen un registro en `User` por tienda, con direcciones en `Address`.

### Transiciones
- **Invitado a Registrado**: Órdenes previas pueden vincularse por `guest_email`.
- **Registrado a Invitado**: Una compra como invitado en otra tienda no afecta la cuenta registrada.