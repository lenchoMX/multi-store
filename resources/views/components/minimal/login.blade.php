  <!-- Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="loginModalLabel">Inicia sesión</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">


                  @php
                      $buttons = [
                          ['color' => 'success', 'label' => 'Iniciar sesión', 'attributes' => ['type' => 'submit']],
                      ];
                  @endphp

                  <x-larastrap::form method="POST" action="{{route('user.login')}}" :buttons="$buttons">
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
