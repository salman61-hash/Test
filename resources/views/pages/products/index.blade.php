<h2>All Products</h2>
<a href="{{ route('products.create') }}">Create New Product</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Sizes</th>
            <th>Images</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>
                @foreach ($product->sizes as $size)
                    {{ $size->size_name }},
                @endforeach
            </td>
            <td>
                @foreach ($product->images as $img)
                    <img src="{{ asset('storage/'.$img->image_path) }}" width="50">
                @endforeach
            </td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a> |
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
