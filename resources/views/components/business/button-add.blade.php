<button {{ $attributes->merge(['class' => 'btn btn-add-business']) }}>
    {{ $slot ?? 'Agregar' }}
</button>