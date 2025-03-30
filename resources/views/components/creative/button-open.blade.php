<button {{ $attributes->merge(['class' => 'btn btn-open-creative']) }}>
    {{ $slot ?? 'Abrir' }}
</button>