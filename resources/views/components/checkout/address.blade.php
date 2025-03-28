<div>
    <div class="row g-3">
        <div class="col-sm-6">
            <label for="firstName" class="form-label">First name</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
                Valid first name is required.
            </div>
        </div>

        <div class="col-sm-6">
            <label for="lastName" class="form-label">Last name</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
                Valid last name is required.
            </div>
        </div>

        <div class="col-6">
            <label for="email" class="form-label">Email <span class="text-body-secondary">(Optional)</span></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
            <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
            </div>
        </div>

        <div class="col-6">
            <label for="phone" class="form-label">Telefono<span class="text-body-secondary">(Optional)</span></label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="">
            <div class="invalid-feedback">
                Please enter a valid phone address for shipping updates.
            </div>
        </div>

        <div class="col-12">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" class="form-control border-success" id="address" name="address" 
                placeholder="Calle y número" {{ old('address') }} {{-- required --}}>
            <div class="invalid-feedback">
                Por favor introduzca su direccion de envio.
            </div>
        </div>

        <div class="col-md-6">
            <label for="zip" class="form-label">Código postal</label>
            <input type="text" class="form-control border-success" id="zip" placeholder="00000"
                wire:model="searchTerm" wire:keydown='search' {{-- required --}}>
            <div class="invalid-feedback">
                Por favor introduzca su codigo postal.
            </div>
        </div>

        <div class="col-md-6">
            <label for="state" class="form-label">Estado</label>
            <select class="form-select border-success" id="state" {{-- required --}}>
                <option value="">Seleccionar...</option>
                {{-- @foreach ($posts['states'] as $post)
                    <option {{ count($posts['states']) == 1 ? 'selected' : '' }} value="{{ $post['state_id'] }}">
                        {{ $post['state'] }}
                    </option>
                @endforeach --}}
            </select>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>

        <div class="col-md-6">
            <label for="state" class="form-label">Colonia</label>
            <select class="form-select border-success" id="state" {{-- required --}}>
                <option value="">Seleccionar...</option>
                {{-- @foreach ($posts['townships'] as $post)
                    <option {{ count($posts['townships']) == 1 ? 'selected' : '' }}
                        value="{{ $post['township_id'] }}">
                        {{ $post['township'] }}
                    </option>
                @endforeach --}}
            </select>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>

        <div class="col-md-6">
            <label for="state" class="form-label">Municipio ó Delegación</label>
            <select class="form-select border-success" id="state" {{-- required --}}>
                <option value="">Seleccionar...</option>
                {{-- @foreach ($posts['townships'] as $post)
                    <option {{ count($posts['townships']) == 1 ? 'selected' : '' }}
                        value="{{ $post['township_id'] }}">
                        {{ $post['township'] }}
                    </option>
                @endforeach --}}
            </select>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>


    </div>
</div>
