@props(['redirect_cart' => false, 'modalName' => 'registerModal'])
<!-- Modal -->
<div class="modal fade" id="{{$modalName}}" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="registerModalLabel">Registrarme</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                @php
                    $buttons = [
                        ['color' => 'success', 'label' => 'Iniciar sesión', 'attributes' => ['type' => 'submit']],
                    ];
                @endphp
                @if ($modalName == 'registerModal2')
                    redireccionar a cart
                @else
                    no redireccionar
                @endif


                <x-larastrap::form method="POST" action="{{ route('user.login') }}" :buttons="$buttons">
                    <x-larastrap::text name="firtsName" label="Primer Nombre" />
                    <x-larastrap::text name="secondName" label="Segundo Nombre" />
                    <x-larastrap::text name="lastName" label="Apellido Paterno" />
                    <x-larastrap::text name="lastNames" label="Apellido Materno" />
                    <x-larastrap::email name="email" label="Email" />
                    <x-larastrap::password name="password" label="Contraseña" />
                </x-larastrap::form>


            </div>
            <div class="modal-footer">
                <a href="#" class="link-success">Registrarme</a>
                <a href="#" class="link-danger">Olvide mi contraseña!</a>
            </div>
        </div>
    </div>
</div>
