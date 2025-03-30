# Decisiones de Diseño - Multi-Store

Este documento registra decisiones clave sobre el diseño de la base de datos y la lógica del proyecto.

## Propuesta de Campos para la Tabla de Direcciones
Para que la tabla `Address` sea robusta y escalable, adaptable a diferentes países como México (con "colonia" y "alcaldía") y otros sin esos conceptos, se definieron los siguientes campos:

- **`address_line_1`**: Calle y número (ej. "Av. Insurgentes 123").
- **`address_line_2`**: Información adicional como colonia o alcaldía (ej. "Col. Juárez, Alcaldía Cuauhtémoc").
- **`city`**: Ciudad o municipio (ej. "Ciudad de México").
- **`state`**: Estado (ej. "CDMX").
- **`postal_code`**: Código postal (ej. "06500").
- **`country`**: País (ej. "México").
- **`phone`**: Teléfono del destinatario (ej. "55-1234-5678").
- **`recipient_name`**: Nombre de quien recibe (ej. "Juan Pérez").
- **`name`**: Identificador de la dirección (ej. "Casa").
- **`is_default`**: Indica si es la dirección predeterminada para la tienda.

### Justificación
- Campos genéricos como `address_line_1` y `address_line_2` permiten flexibilidad para formatos locales sin modificar la estructura.
- Campos adicionales (`phone`, `recipient_name`) son necesarios para la logística de entrega.

## Solución: Usuarios por Tienda
Para que un usuario pueda registrarse en múltiples tiendas sin compartir datos entre ellas, se añadió `store_id` a la tabla `User`.

- **Estructura**:
  - `id`: Identificador único.
  - `store_id`: Clave foránea a `stores`.
  - `name`, `email`, `password`: Datos del usuario.

### Ejemplo
- Registro en `tienda1.com`: `id: 1`, `store_id: 1`, `email: juan@example.com`.
- Registro en `tienda2.com`: `id: 2`, `store_id: 2`, `email: juan@example.com`.

### Justificación
- Permite escalabilidad: un usuario puede tener cuentas en tantas tiendas como desee.
- Robustez: los datos (direcciones, órdenes) están aislados por tienda mediante `store_id`.

## Invitados vs. Registrados
- **Invitados**: No tienen registro en `User`. Sus datos se guardan en `Order` con campos `guest_*`.
- **Registrados**: Tienen un registro en `User` por tienda, con direcciones en `Address`.

### Transiciones
- **Invitado a Registrado**: Las órdenes previas pueden vincularse opcionalmente por `guest_email`.
- **Registrado a Invitado**: Una compra como invitado en otra tienda no afecta su cuenta registrada.