<x-layout>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <form method="POST" action="{{ $action == 'create' ? route('products.store') : route('products.update', $product->id) }}">
                @csrf
                @if ($action == 'edit') @method('PUT') @endif
                <div class="card mt-5">
                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
                            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                            @error('stock') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                    </div>

                    @if ($action != 'show')
                        <div class="card-footer text-center">
                            <button class="btn btn-primary">
                                {{ $action == 'create' ? 'Create' : 'Update' }}
                            </button>
                        </div>
                    @endif

                </div>
            </form>
        </div>
    </div>

    @if ($action == 'show')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.getElementsByClassName('form-control');
            for (const input of inputs)  input.disabled = true;
        });
    </script>
    @endif

</x-layout>