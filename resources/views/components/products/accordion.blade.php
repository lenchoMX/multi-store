<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Descripción
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <p class="text-muted mb-4">description: {{ $product->description }}</p>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwos" aria-expanded="false" aria-controls="collapseTwos">
                Detalles del producto
            </button>
        </h2>
        <div id="collapseTwos" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <p class="text-muted mb-4">brand: {{ $product->brand }}</p>
                <p class="text-muted mb-4">reviewCount: {{ $product->description }}</p>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Comentarios
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <p class="text-muted mb-4">reviewCount: {{ $product->comment }}</p>
            </div>
        </div>
    </div>
</div>