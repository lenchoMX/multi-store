<button {{ $attributes->merge(['class' => 'btn btn-remove-minimal']) }}>
    {{ $slot ?? 'Eliminar' }}
</button>