<form action="{{ url('users') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" required>
    </div>

    <div>
        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" required>
    </div>

    <div>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" required>
    </div>

    <div>
        <label for="photo">Photo</label><br>
        <input type="file" name="photo[]" id="photo" multiple>
    </div>

    <div>
        <label for="role">Role</label><br>
        <select name="role_id" id="role" required>
            <option value="">Select Role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>





    <div style="margin-top: 10px;">
        <button type="submit">Create User</button>
    </div>
</form>
