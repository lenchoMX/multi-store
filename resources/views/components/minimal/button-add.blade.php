<button {{ $attributes->merge(['class' => 'btn btn-add-minimal']) }}>
    {{ $slot ?? 'Agregar' }}
</button>