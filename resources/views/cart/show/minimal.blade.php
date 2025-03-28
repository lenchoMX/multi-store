@extends('layouts.minimal.app')

@section('title', 'Carrito')

@section('content')
    <div class="container">
        <h1 class="mb-4">Carrito de compras</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div id="cart-container">
            @if ($cartModels->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="cart-table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Imagen</th>
                                <th scope="col">Producto</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Acción</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            @foreach ($cartModels as $item)
                                <tr data-id="{{ $item->id }}">
                                    <td>
                                        <a href="{{ $item->productStore->getPrimaryCategoryUrl() }}">
                                            <img src="{{ route('images.show', $item->productStore->image->name) }}" 
                                                 alt="{{ $item->productStore->product->name }}" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 50px;">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ $item->productStore->getPrimaryCategoryUrl() }}">
                                            {{ $item->productStore->product->name }}
                                        </a>
                                    </td>
                                    <td>${{ number_format($item->productStore->price, 2) }}</td>
                                    <td>
                                        <input type="number" 
                                               class="form-control form-control-sm quantity-input" 
                                               value="{{ $item->quantity }}" 
                                               min="1" 
                                               data-id="{{ $item->id }}" 
                                               data-url="{{ route('cart.update', $item->id) }}"
                                               style="width: 80px;">
                                    </td>
                                    <td class="subtotal">${{ number_format($item->productStore->price * $item->quantity, 2) }}</td>
                                    <td>
                                        <form class="remove-cart-item" 
                                              data-id="{{ $item->id }}" 
                                              data-url="{{ route('cart.remove', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Total:</td>
                                <td id="cart-total" colspan="2" class="fw-bold">
                                    ${{ number_format($cartModels->sum(fn($item) => $item->productStore->price * $item->quantity), 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-end mt-3">
                    <a href="{{-- {{ route('checkout.show') }} --}}" class="btn btn-primary">Proceder al pago</a>
                </div>
            @else
                <p id="empty-cart-message" class="text-center">El carrito está vacío</p>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function updateCartTotal() {
                const items = document.querySelectorAll('#cart-items tr');
                let newTotal = 0;
                items.forEach(item => {
                    const price = parseFloat(item.cells[2].textContent.replace('$', '').replace(',', ''));
                    const quantity = parseInt(item.cells[3].querySelector('.quantity-input').value);
                    const subtotal = price * quantity;
                    item.cells[4].textContent = '$' + subtotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    newTotal += subtotal;
                });
                document.getElementById('cart-total').textContent = '$' + newTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                return items.length;
            }

            document.querySelectorAll('.remove-cart-item').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    const url = this.getAttribute('data-url');
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const row = this.closest('tr');

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '¿Quieres eliminar este producto del carrito?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        buttonsStyling: false,
                        customClass: {
                            confirmButton: 'btn btn-danger mx-2',
                            cancelButton: 'btn btn-secondary mx-2'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': token,
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => {
                                if (!response.ok) throw new Error('Error: ' + response.status);
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: '¡Eliminado!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        buttonsStyling: false,
                                        customClass: {
                                            confirmButton: 'btn btn-success'
                                        }
                                    }).then(() => {
                                        row.remove();
                                        const remainingItems = updateCartTotal();
                                        if (remainingItems === 0) {
                                            document.getElementById('cart-container').innerHTML = '<p id="empty-cart-message" class="text-center">El carrito está vacío</p>';
                                        }
                                    });
                                } else {
                                    Swal.fire('Error', data.message || 'No se pudo eliminar el producto', 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error', 'Ocurrió un problema: ' + error.message, 'error');
                            });
                        }
                    });
                });
            });

            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function () {
                    const id = this.getAttribute('data-id');
                    const url = this.getAttribute('data-url');
                    const quantity = parseInt(this.value);
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    if (quantity < 1) {
                        this.value = 1;
                        return;
                    }

                    fetch(url, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ quantity: quantity })
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Error: ' + response.status);
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            updateCartTotal();
                            Swal.fire({
                                title: '¡Actualizado!',
                                text: 'Cantidad actualizada correctamente',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire('Error', data.message || 'No se pudo actualizar la cantidad', 'error');
                            this.value = data.original_quantity || 1;
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Ocurrió un problema: ' + error.message, 'error');
                    });
                });
            });
        });
    </script>
@endsection