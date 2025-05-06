<form action="{{ url("customers/{$customer->id}") }}" method="post" enctype="multipart/form-data">
    @csrf

    @method('PUT')

    <div>
        <label for="name">Name</label><br>
        <input type="text" name="name"  value="{{$customer['name']}}" required>
    </div>

    <div>
        <label for="email">Email</label><br>
        <input type="email" name="email"  value="{{$customer['email']}}" required>
    </div>

    <div>
        <label for="phone">Phone</label><br>
        <input type="text" name="phone"  value="{{$customer['phone']}}" required>
    </div>

    <div>
        <label for="address">Address</label><br>
        <textarea name="address"   required>{{$customer['address']}}</textarea>
    </div>

    <div>
        <label for="photo">Photo</label><br>

        @if($customer->photo)
            <div style="margin: 10px 0;">
                <label>Existing Photo(s):</label><br>
                @foreach(explode(',', $customer->photo) as $photo)
                    <img src="{{ asset('photo/' . $photo) }}" alt="Customer Photo" style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px; border: 1px solid #ccc;">
                @endforeach
            </div>
        @endif

        <input type="file" name="photo[]" multiple>
    </div>


    <div style="margin-top: 10px;">
        <button type="submit">Update Customer</button>
    </div>
</form>

