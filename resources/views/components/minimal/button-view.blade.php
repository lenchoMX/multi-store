<button {{ $attributes->merge(['class' => 'btn btn-view-minimal']) }}>
    {{ $slot ?? 'Ver' }}
</button>