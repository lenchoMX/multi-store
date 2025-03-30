<button {{ $attributes->merge(['class' => 'btn btn-remove-creative']) }}>
    {{ $slot ?? 'Eliminar' }}
</button>