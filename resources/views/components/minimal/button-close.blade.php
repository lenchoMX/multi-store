<button {{ $attributes->merge(['class' => 'btn btn-close-minimal']) }}>
    {{ $slot ?? 'Cerrar' }}
</button>