<div>
    <div class="row g-3">

        <div class="col-sm-6">
            <label for="firstName" class="form-label">* Primer Nombre</label>
            <input type="text" class="form-control border-success" id="firstName" name="firstName"
                placeholder="Primer nombre" value="{{ old('firstName') }}" {{-- required --}} autofocus>
            @error('firstName')
                <div class="alert alert-danger" role="alert"><x-icons.alert /> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-sm-6">
            <label for="secondName" class="form-label">Segundo Nombre</label>
            <input type="text" class="form-control border-success" id="secondName" name="secondName"
                placeholder="Segundo nombre" value="{{ old('secondName') }}" {{-- required --}}>
            @error('secondName')
                <div class="alert alert-danger" role="alert"><x-icons.alert /> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-sm-6">
            <label for="surname" class="form-label">* Primer Apellido</label>
            <input type="text" class="form-control border-success" id="surname" name="surname"
                placeholder="Apellido paterno" value="{{ old('surname') }}" {{-- required --}} autofocus>
            @error('surname')
                <div class="alert alert-danger" role="alert"><x-icons.alert /> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-sm-6">
            <label for="lastName" class="form-label">* Segundo Apellido</label>
            <input type="text" class="form-control border-success" id="lastName" name="lastName"
                placeholder="Apellido materno" value="{{ old('lastName') }}" {{-- required --}}>
            @error('lastName')
                <div class="alert alert-danger" role="alert"><x-icons.alert /> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control border-success" id="email" name="email"
                placeholder="mi_email@ejemplo.com">
            @error('email')
                <div class="alert alert-danger" role="alert"><x-icons.alert /> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-6">
            <label for="phone" class="form-label">Teléfono</label>
            <input type="text" class="form-control border-success" id="phone" name="phone"
                placeholder="Teléfono de 10 dígitos">
            @error('phone')
                <div class="alert alert-danger" role="alert"><x-icons.alert /> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-12">
            <label for="address" class="form-label">Dirección</label>
            <input type="text" class="form-control border-success" name="address" id="address"
                placeholder="Calle y número" {{ old('address') }} {{-- required --}}>
            @error('street')
                <div class="alert alert-danger" role="alert"><x-icons.alert /> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-5">
            <label for="zip" class="form-label">Código postal
                <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-custom-class="custom-tooltip" data-bs-title="This top tooltip is themed via CSS variables.">
                    ?
                </button>
            </label>
            <input type="text" class="form-control border-success" id="zip" name="zip" placeholder="00000"
                wire:model="searchTerm" wire:keydown='search' {{-- required --}}>
            @error('zip')
                <div class="alert alert-danger" role="alert"><x-icons.alert /> {{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-7">
            <label for="state" class="form-label">Colonia</label>
            <select class="form-select border-success" id="suburb" name="suburb" {{-- required --}}>
                @if (isset($posts['townships']))

                    <option {{ count($posts['townships']) == 1 ? 'disabled' : '' }} value="">Seleccionar...
                    </option>

                    @foreach ($posts['townships'] as $post)
                        <option {{ count($posts['townships']) == 1 ? 'selected' : '' }}
                            value="{{ $post['township_id'] }}##{{ $post['township'] }}">
                            {{ $post['township'] }}
                        </option>
                    @endforeach
                @else
                    <option value="">Seleccionar...</option>
                @endif
            </select>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>

        <div class="col-md-6">
            <label for="state" class="form-label">Municipio ó Alcaldia</label>
            <select class="form-select border-success" id="city" name="city" {{-- required --}}>

                @if (isset($posts['cities']))
                    @foreach ($posts['cities'] as $post)
                        <option {{ count($posts['cities']) == 1 ? 'selected' : '' }} value="{{ $post['city'] }}">
                            {{ $post['city'] }}
                        </option>
                    @endforeach
                @else
                    <option value="">Seleccionar...</option>
                @endif
            </select>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>

        <div class="col-md-6">
            <label for="state" class="form-label">Estado</label>
            <select class="form-select border-success" id="state" name="state" {{-- required --}}>
                @if (isset($posts['states']))
                    @foreach ($posts['states'] as $post)
                        <option {{ count($posts['states']) == 1 ? 'selected' : '' }} value="{{ $post['state'] }}">
                            {{ $post['state'] }}
                        </option>
                    @endforeach
                @else
                    <option value="">Seleccionar...</option>
                @endif

            </select>
            <div class="invalid-feedback">
                Please provide a valid state.
            </div>
        </div>

    </div>
</div>
