<x-layout>
    <div class="card mt-5">
        <div class="card-header text-end">
            <a class="btn btn-primary" href="{{ route('products.create') }}" role="button">New</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered text-center">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <th>{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        
                        {{-- Acciones disponibles para cada producto: Ver, Editar, Eliminar --}}
                        <td>
                            <a class="btn btn-primary" href="{{ route('products.show', $product) }}" role="button">
                                <i class="bi bi-file-text">Show</i>
                            </a>
                            <a class="btn btn btn-warning" href="{{ route('products.edit', $product) }}" role="button">
                                <i class="bi bi-pencil">Edit</i>
                            </a>
                            <form method="POST" action="{{ route('products.destroy', $product) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger">
                                    <i class="bi bi-trash">Delete</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>

    {{-- Si hay un mensaje en sesión, mostrar un toast (notificación flotante) --}}
    @if (session('message'))
        <div class="toast-container position-fixed bottom-0 start-0 p-3">
            <div id="liveToast" class="toast {{ session('class') }}" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">{{ session('message')}} </div>
            </div>
        </div>

         {{-- Script para activar el toast al cargar la página --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const toastLiveExample = document.getElementById('liveToast');
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
                toastBootstrap.show();
            });
        </script>
    @endif

</x-layout>