<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasStart" aria-labelledby="offcanvasStartLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasStartLabel">
            <span class="text-primary">Tus productos</span>
            <span class="badge bg-primary rounded-pill">{{ $cartItems['products_quantity'] }}</span>
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if (array_key_exists('items', $cartItems))

            <x-products :productsData="$cartItems" />
            
            <div class="col-12 py-1 d-grid gap-2">
                <a href="{{ route('checkout.index') }}" class="btn btn-success">Pagar</a>
                <button type="button" class="btn btn-danger" data-bs-dismiss="offcanvas" aria-label="Close">Cerrar</button>
            </div>
        @else
            No hay productos
        @endif
    </div>
</div>
