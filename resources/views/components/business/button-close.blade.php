<button {{ $attributes->merge(['class' => 'btn btn-close-business']) }}>
    {{ $slot ?? 'Cerrar' }}
</button>