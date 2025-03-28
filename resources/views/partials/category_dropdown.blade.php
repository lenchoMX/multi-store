@if ($category->childCategories->count())
    <li class="nav-item dropdown dropdown-submenu">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown{{ $category->id }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $category->name }}
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $category->id }}">
            @foreach ($category->childCategories as $childCategory)
                @include('partials.category_dropdown', ['category' => $childCategory])
            @endforeach
        </ul>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link" href="#">{{ $category->name }}</a>
    </li>
@endif
