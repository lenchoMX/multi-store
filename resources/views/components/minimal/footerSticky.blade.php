<nav class="navbar sticky-bottom navbar-dark bg-dark d-block d-md-none">
    <div class="container-fluid">
        <div class="btn-group">
            <button type="button" class="btn btn-dark" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasStart" aria-controls="offcanvasStart">
                <x-icons.cart />
                <span class="badge bg-success">{{ $cartItems['products_quantity'] }}</span>
            </button>
        </div>
    </div>
</nav>
