<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Multi-Store (Minimal)</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/products') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/categories') }}">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/cart') }}">Carrito</a>
                </li>
            </ul>
        </div>
    </div>
</nav>