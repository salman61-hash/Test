<h2>Edit Product</h2>
<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <input type="text" name="name" value="{{ $product->name }}"><br>
    <input type="number" name="price" value="{{ $product->price }}"><br>
    <textarea name="description">{{ $product->description }}</textarea><br>

    <label>Select Sizes:</label><br>
    @foreach($sizes as $size)
        <input type="checkbox" name="sizes[]" value="{{ $size->id }}"
            {{ $product->sizes->contains($size->id) ? 'checked' : '' }}> {{ $size->size_name }}
    @endforeach
    <br>

    <label>Upload More Images:</label>
    <input type="file" name="images[]" multiple><br>

    <button type="submit">Update Product</button>
</form>
