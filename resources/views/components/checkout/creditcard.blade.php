<h4 class="mb-3">Métodos de pago</h4>

<div class="my-3">
    <div class="form-check">
        <input id="credit" name="paymentMethod" type="radio" class="form-check-input border-success"
            {{-- required --}}>
        <label class="form-check-label" for="credit">Tarjeta de crédito</label>
    </div>
    <div class="form-check">
        <input id="debit" name="paymentMethod" type="radio" class="form-check-input border-success"
            {{-- required --}}>
        <label class="form-check-label" for="debit">Tarjeta de dédito</label>
    </div>
    <div class="form-check">
        <input id="virtual" name="paymentMethod" type="radio" class="form-check-input border-success"
            {{-- required --}}>
        <label class="form-check-label" for="virtual">Tarjeta Virtual (CVV de un solo
            uso)</label>
    </div>
</div>


<div class="row gy-3">
    <div class="col-md-6">
        <label for="cc-name" class="form-label">Nombre en la tarjeta</label>
        <input type="text" class="form-control border-success" name="ccName" id="cc-name" placeholder="Nombre"
            {{-- required --}}>
        <small class="text-muted">Nombre completo como se muestra en la tarjeta.</small>
        <div class="invalid-feedback">
            Se requiere el nombre en la tarjeta
        </div>
    </div>

    <div class="col-md-6">
        <label for="cc-number" class="form-label">Número de Tarjeta de Crédito</label>
        <input type="text" class="form-control border-success" id="cc-number" placeholder="XXXX XXXX XXXX XXXX"
            {{-- required --}}>
        <div class="invalid-feedback">
            Se requiere número de tarjeta de crédito
        </div>
    </div>

    <div class="col-md-4">
        <label for="cc-expiration" class="form-label">Vencimiento</label>
        <div class="input-group">
            <select class="form-select border-success" aria-label="Default select example" {{-- required --}}>
                <option selected>Mes</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <div class="invalid-feedback">
                Fecha de vencimiento requerida
            </div>
            <select class="form-select border-success" aria-label="Default select example" {{-- required --}}>
                <option selected>Año</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <div class="invalid-feedback">
                Fecha de vencimiento requerida
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <label for="cc-cvv" class="form-label">CVV</label>
        <input type="text" class="form-control border-success" id="cc-cvv" placeholder="CVV" {{-- required --}}>
        <div class="invalid-feedback">
            Se requiere código de seguridad
        </div>
    </div>
</div>
