<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="navbarOffcanvasLg" aria-labelledby="navbarOffcanvasLgLabel">
    <div class="row bg-primary-subtle">
        <div class="col py-2 border border-primary mx-auto">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <a class="link-dark" href="{{-- {{ route('product.index') }} --}}">{{ env('APP_NAME') }}</a>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <a class="link-dark" href="{{-- {{ route('product.index') }} --}}">WhatsApp</a>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <a class="link-dark" href="{{-- {{ route('product.index') }} --}}">{{ env('APP_NAME') }}</a>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <a class="link-dark" href="{{-- {{ route('product.index') }} --}}">Track Order</a>
                </li>
            </ul>

            <div class="col-11 py-1 d-grid gap-2 mx-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">
                    Registro
                </button>
            </div>
            <div class="col-11 py-1 d-grid gap-2 mx-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
                    Login
                </button>
            </div>

            <x-minimal.acordion />
        </div>
    </div>
</div>

<x-minimal.login />
<x-minimal.register />