<button {{ $attributes->merge(['class' => 'btn btn-view-creative']) }}>
    {{ $slot ?? 'Ver' }}
</button>