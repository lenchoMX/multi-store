<button {{ $attributes->merge(['class' => 'btn btn-send-minimal']) }}>
    {{ $slot ?? 'Enviar' }}
</button>