<form action="{{ url('customers') }}" method="post" enctype="multipart/form-data">
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
        <label for="phone">Phone</label><br>
        <input type="text" name="phone" id="phone" required>
    </div>

    <div>
        <label for="address">Address</label><br>
        <textarea name="address" id="address" required></textarea>
    </div>

    <div>
        <label for="photo">Photo</label><br>
        <input type="file" name="photo[]" id="photo" multiple>
        <!-- multiple দিলে একাধিক ছবি সিলেক্ট করা যাবে -->
    </div>

    <div style="margin-top: 10px;">
        <button type="submit">Create Customer</button>
    </div>
</form>

