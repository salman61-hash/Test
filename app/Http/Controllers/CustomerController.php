<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all(); // সব কাস্টমার নিয়ে আসলাম
        return view('pages.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Step 1: Validate
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|string|min:8',
            'address' => 'required|string|min:5',
            // 'photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Multiple files validation
        ]);

        // Step 2: Create new customer
        $customer = new Customer();

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;

        // Step 3: Handle multiple photo upload
        $uploadedPhotos = [];

        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $photoname = time() . '_' . uniqid() . '.' . $file->extension();

                $photoPath = public_path('photo/' . $photoname);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }

                $file->move(public_path('photo'), $photoname);
                $uploadedPhotos[] = $photoname; // Save all file names in array
            }
        }

        // Step 4: Store photo names as comma separated
        $customer->photo = !empty($uploadedPhotos) ? implode(',', $uploadedPhotos) : null;

        // Step 5: Save
        if ($customer->save()) {
            return redirect('customers')->with('success', "Customers has been registred");
        } else {
            return back()->with('error', 'Something went wrong.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('pages.customers.show',compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('pages.customers.update',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Step 1: Validate
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|string|min:8',
            'address' => 'required|string|min:5',
            // 'photo.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Multiple files validation
        ]);

        // Step 2: Create new customer
        $customer =Customer::find($id);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;

        // Step 3: Handle multiple photo upload
        $uploadedPhotos = [];

        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $file) {
                $photoname = time() . '_' . uniqid() . '.' . $file->extension();

                $photoPath = public_path('photo/' . $photoname);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }

                $file->move(public_path('photo'), $photoname);
                $uploadedPhotos[] = $photoname; // Save all file names in array
            }
        }

        // Step 4: Store photo names as comma separated
        $customer->photo = !empty($uploadedPhotos) ? implode(',', $uploadedPhotos) : null;

        // Step 5: Save
        if ($customer->save()) {
            return redirect('customers')->with('success', "Customers has been Updated");
        } else {
            return back()->with('error', 'Something went wrong.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
$customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect('customers')->with('success', "Customers has been deleted");
    }
}
