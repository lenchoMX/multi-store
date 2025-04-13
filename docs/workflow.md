# Flujo de Trabajo - Multi-Store

## Proceso
1. **Definir tarea**: Identificar un punto específico (ej. "Definir rutas").
2. **Abrir chat**: Iniciar un nuevo chat con Grok para esa tarea.
3. **Implementar**:
   - Actualizar `draft.yml` para cambios en modelos o relaciones.
   - Ejecutar `php artisan blueprint:build` si aplica.
   - Ajustar migraciones, modelos, controladores o jobs al `draft.yml`.
4. **Documentar**:
   - Actualizar el `.md` correspondiente con el estado y resultado.
   - Subir cambios a GitHub (`git add .`, `git commit -m "Tarea X"`, `git push origin main`).
5. **Cerrar tarea**: Marcar como completada en `tasks.md` y definir el próximo paso.
6. **Repetir**: Abrir un nuevo chat para la siguiente tarea.

## Notas
- El `draft.yml` es la fuente principal; otros archivos se ajustan a él.
- Usar ramas en Git si se trabaja en paralelo (opcional).

## Estado Actual
- Migraciones y modelos generados con Blueprint.
- Base de datos poblada con `product.sql` y verificada en `tinker`.

## Próximo Paso
- Definir rutas y controladores para listar tiendas y productos.