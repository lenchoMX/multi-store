<div class="card">
    <svg class="bd-placeholder-img card-img-top" width="100%" height="140" xmlns="http://www.w3.org/2000/svg"
        role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
        <title>Placeholder</title>
        <rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6"
            dy=".3em">Image cap</text>
    </svg>
    {{-- <img src="..." class="card-img-top" title="{{ $title }}"> --}}
    <div class="card-body">
        <h5 class="card-title">{{ $dataItem->name }}</h5>
        <p class="card-text">${{  $dataItem->price }}</p>
        <a href="MLM-{{ $dataItem->id }}-{{ $dataItem->slug }}.html" class="text-primary stretched-link" title="{{  $dataItem->name }}">
            ver más
        </a>
    </div>
</div>
