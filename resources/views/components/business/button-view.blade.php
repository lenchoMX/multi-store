<button {{ $attributes->merge(['class' => 'btn btn-view-business']) }}>
    {{ $slot ?? 'Ver' }}
</button>