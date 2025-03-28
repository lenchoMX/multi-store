<div id="carouselExample" class="carousel slide">
    <div class="carousel-inner">

        @php
            $count = 0;
        @endphp
        @foreach ($images as $image)
            <div class="carousel-item {{ $count == 0 ? 'active' : '' }}">
                <img src="products/{{ $image->name }}" class="d-block w-100" alt="{{ $image->name }}">
            </div>
            @php
                $count++;
            @endphp
            {{ $image->name }}
        @endforeach

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>

</div>
