<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand mx-auto d-flex align-items-center" href="{{ route('home') }}">
        <img src="/svg/store.svg" alt="Logo" width="30" height="24"> 
        {{ env('APP_NAME') }}
    </a>
    <div class="btn-group">
        <button type="button" class="btn btn-dark" data-bs-toggle="offcanvas" data-bs-target="#offcanvasStart"
            aria-controls="offcanvasStart">
            <x-icons.cart />
            <span class="badge bg-success">{{ $cartItems['products_quantity'] }}</span>
        </button>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvasLg"
        aria-controls="navbarOffcanvasLg">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<x-minimal.offcanvasCartItems />
<x-minimal.offcanvasMenu />
