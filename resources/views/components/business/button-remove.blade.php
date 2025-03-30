<button {{ $attributes->merge(['class' => 'btn btn-remove-business']) }}>
    {{ $slot ?? 'Eliminar' }}
</button>