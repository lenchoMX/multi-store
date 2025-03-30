<button {{ $attributes->merge(['class' => 'btn btn-send-creative']) }}>
    {{ $slot ?? 'Enviar' }}
</button>