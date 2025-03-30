<button {{ $attributes->merge(['class' => 'btn btn-add-creative']) }}>
    {{ $slot ?? 'Agregar' }}
</button>