<button {{ $attributes->merge(['class' => 'btn btn-open-minimal']) }}>
    {{ $slot ?? 'Abrir' }}
</button>