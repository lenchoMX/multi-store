<button {{ $attributes->merge(['class' => 'btn btn-open-business']) }}>
    {{ $slot ?? 'Abrir' }}
</button>