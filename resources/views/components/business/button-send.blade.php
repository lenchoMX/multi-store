<button {{ $attributes->merge(['class' => 'btn btn-send-business']) }}>
    {{ $slot ?? 'Enviar' }}
</button>