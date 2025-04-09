# Gestión de Riesgos y Optimizaciones

Este archivo documenta la lógica de actualización del riesgo de los usuarios y las optimizaciones implementadas en el proyecto multi-tienda.

## Lógica de Actualización del Riesgo

### Campos Relevantes
- `risk_level`: Enum ('low', 'medium', 'high'). Nivel de riesgo del usuario.
- `trust_score`: Entero (0-100). Puntaje de confiabilidad del usuario.
- `last_risk_update`: Timestamp. Fecha de la última actualización del riesgo.

### Reglas de Actualización
1. **Inicialización**:
   - `trust_score = 50`, `risk_level = 'low'`, `last_risk_update = null`.

2. **Eventos que afectan el `trust_score`**:
   - Compra confiable: +10 puntos (máximo 100).
   - Comportamiento riesgoso: -15 puntos (mínimo 0).
   - Verificación exitosa (WhatsApp, email): +5 puntos.
   - Inactividad prolongada (6 meses): -5 puntos.

3. **Ajuste del `risk_level`**:
   - `trust_score > 80`: `risk_level = 'low'`
   - `trust_score entre 50 y 80`: `risk_level = 'medium'`
   - `trust_score < 50`: `risk_level = 'high'`

4. **Integración con `multi-store-checkout`**:
   - Se envían datos del usuario y su historial a `multi-store-checkout`.
   - `multi-store-checkout` devuelve un nuevo `trust_score` y `risk_level`.

5. **Uso del Riesgo**:
   - Usuarios con `risk_level = 'low'` o `trust_score > 80` reciben promociones y descuentos.
   - Usuarios con `risk_level = 'high'` o `trust_score < 50` no reciben promociones y podrían requerir verificaciones adicionales.

## Optimizaciones

1. **Caching**:
   - Usar Redis o Memcached para cachear productos, categorías y perfiles de usuario.
   - Duración del caché: 10 minutos para datos dinámicos.

2. **Colas**:
   - Usar Laravel Horizon o RabbitMQ para procesar tareas asíncronas (envío de emails, actualización de riesgo, análisis de `multi-store-checkout`).

3. **Índices en la base de datos**:
   - Añadir índices a `store_id`, `user_id`, `email` en tablas relevantes.

4. **Llamadas a API asíncronas**:
   - Procesar solicitudes a `multi-store-checkout` mediante colas para evitar retrasos.

5. **Particionamiento de datos**:
   - Particionar tablas grandes como `orders` y `user_history` por `store_id` o fechas.

6. **Pruebas y monitoreo**:
   - Usar pruebas unitarias y de integración.
   - Monitorear con Laravel Telescope o New Relic.