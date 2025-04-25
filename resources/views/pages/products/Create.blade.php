<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Product Name"><br>
    <input type="number" name="price" placeholder="Price"><br>
    <textarea name="description" placeholder="Description"></textarea><br>

    <label>Select Sizes:</label><br>
    @foreach($sizes as $size)
        <input type="checkbox" name="sizes[]" value="{{ $size->id }}"> {{ $size->size_name }}
    @endforeach
    <br>

    <label>Upload Images:</label>
    <input type="file" name="images[]" multiple><br>

    <button type="submit">Create Product</button>
</form>
