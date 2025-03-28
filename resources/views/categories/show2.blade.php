<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar con Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo adicional para manejar submenús */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu > .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }

        /* Asegurar que los submenús se vean correctamente */
        .dropdown-menu .dropdown-submenu .dropdown-menu {
            left: 100%;
            top: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Tu Marca</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @foreach ($categories as $category)
                        @include('partials.category_dropdown', ['category' => $category])
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    <!-- Aquí va el partial para manejar la recursividad -->
    <script id="partial-category-dropdown" type="text/x-template">
        @if ($category->childCategories->count())
            <li class="nav-item dropdown dropdown-submenu">
                <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown{{ $category->id }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $category->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $category->id }}">
                    @foreach ($category->childCategories as $childCategory)
                        @include('partials.category_dropdown', ['category' => $childCategory])
                    @endforeach
                </ul>
            </li>
        @else
            <li>
                <a class="dropdown-item" href="#">{{ $category->name }}</a>
            </li>
        @endif
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-submenu .dropdown-toggle').on("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).next('.dropdown-menu').toggle();
            });

            $(document).on("click", function(e) {
                if (!$(e.target).closest('.dropdown-menu').length) {
                    $('.dropdown-menu').hide();
                }
            });

            $('.navbar .dropdown').on('hidden.bs.dropdown', function() {
                $(this).find('.dropdown-menu').hide();
            });
        });
    </script>
</body>
</html>
