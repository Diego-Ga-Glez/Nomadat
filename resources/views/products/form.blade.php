<x-layout>

    <form method="POST" action="{{ $action == 'create' ? route('products.store') : route('products.update', $product->id) }}">
        @csrf
        @if ($action == 'edit') @method('PUT') @endif
        <div class="card mt-5">
            <div class="card-body">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
                    @error('name') <div>{{ $message }}</div> @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
                    @error('description') <div>{{ $message }}</div> @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
                    @error('price') <div>{{ $message }}</div> @enderror
                </div>

                <div class="form-group mt-2">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                    @error('stock') <div>{{ $message }}</div> @enderror
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

</x-layout>