<div class="col-12 order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Mis poductos</span>
        <span class="badge bg-primary rounded-pill">{{$productsData['products_quantity']}}</span>
    </h4>
    <ul class="list-group mb-3">
        @foreach ($productsData['items'] as $item)
        <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
                <h6 class="my-0">{{$item['name']}}</h6>
                <small class="text-body-secondary">{{$item['quantity']}} X ${{ number_format($item['price'],2) }}</small>
            </div>
            <span class="text-body-secondary">${{ number_format($item['sub_total'],2) }}</span>
        </li>
        @endforeach
        {{-- <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
            <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
            </div>
            <span class="text-success">−$5</span>
        </li> --}}

        <li class="list-group-item d-flex justify-content-between">
            <span>Total {{-- (USD) --}}</span>
            <strong>${{$productsData['total_items']}}</strong>
        </li>
    </ul>

    {{-- <form class="card p-2">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <button type="submit" class="btn btn-secondary">Redeem</button>
        </div>
    </form> --}}
</div>
