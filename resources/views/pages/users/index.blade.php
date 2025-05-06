<h2>Create Users</h2>
<a href="{{ route('users.create') }}">Create New Users</a>



<table border="1" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Photo</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->password }}</td>
            <td>
                @if ($user->photo)
                    @php
                        $photos = explode(',', $user->photo);
                    @endphp
                    @foreach ($photos as $photo)
                        <img src="{{ asset('photo/' . $photo) }}" alt="User Photo" width="50">
                    @endforeach
                @endif
            </td>
            <td>{{ $user->role->name ?? 'No Role' }}</td>
            <td>
                <a href="{{ url("users/{$user->id}") }}" class="btn btn-sm btn-info">
                    Show<i class="fas fa-eye"></i>
                </a>
                <a href="{{ url("users/{$user->id}/edit") }}" class="btn btn-sm btn-warning">
                    Update<i class="fas fa-edit"></i>
                </a>
                <form action="{{ url("users/{$user->id}") }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
