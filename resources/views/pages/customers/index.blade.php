<h2>Create Customers</h2>
<a href="{{ route('customers.create') }}">Create New Customer</a>


<table border="1"width="900px">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Photo</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $customer)
        <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>
                @php
                    $photos = explode(',', $customer->photo); // Split multiple photos into an array
                @endphp

                @foreach($photos as $photo)
                    <img src="{{ asset('photo/' . $photo) }}" alt="{{ $customer->name }}" class="img-thumbnail" width="50" style="margin: 2px;">
                @endforeach
            </td>
            <td>{{$customer->email}}</td>
            <td>{{$customer->phone}}</td>
            <td>{{$customer->address}}</td>
            <td>
                <a href="{{ url("customers/{$customer->id}") }}" class="btn btn-sm btn-info">
                    Show <i class="fas fa-eye"></i>
                </a>
                <a href="{{ url("customers/{$customer->id}/edit") }}" class="btn btn-sm btn-info">
                    Edit <i class="fas fa-pencil-alt"></i>
                </a>

                <form action="{{ url("customers/{$customer->id}") }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

        @if($customers->isEmpty())
        <tr>
            <td colspan="7">Data Not Found</td>
        </tr>
        @endif
    </tbody>
</table>
