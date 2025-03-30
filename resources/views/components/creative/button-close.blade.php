<button {{ $attributes->merge(['class' => 'btn btn-close-creative']) }}>
    {{ $slot ?? 'Cerrar' }}
</button>