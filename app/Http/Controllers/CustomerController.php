<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the customers.
     */
    public function index()
    {
        $items = Customer::select('id', 'nama_toko', 'kota', 'telepon', 'alamat', 'email', 'nama_pemilik', 'created_at')
            ->orderByDesc('id')
            ->paginate(10);

        return view('pages.customer.index', compact('items'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        return view('pages.customer.create');
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_toko'     => ['required', 'string', 'max:255'],
            'nama_pemilik'  => ['nullable', 'string', 'max:255'],
            'telepon'       => ['nullable', 'string', 'max:30'],
            'alamat'        => ['required', 'string'],
            'kota'          => ['required', 'string', 'max:100'],
            'email'         => ['nullable', 'email', 'max:255'],
        ]);

        Customer::create($validated);

        return redirect()
            ->route('customer.index')
            ->with('notification', $this->successNotification('notification.store_success', 'pages.menu.customer'));
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer)
    {
        return view('pages.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(Customer $customer)
    {
        return view('pages.customer.edit', compact('customer'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nama_toko'     => ['required', 'string', 'max:255'],
            'nama_pemilik'  => ['nullable', 'string', 'max:255'],
            'telepon'       => ['nullable', 'string', 'max:30'],
            'alamat'        => ['required', 'string'],
            'kota'          => ['required', 'string', 'max:100'],
            'email'         => ['nullable', 'email', 'max:255'],
        ]);

        $customer->update($validated);

        return redirect()
            ->route('customer.index')
            ->with('notification', $this->successNotification('notification.update_success', 'menu.customer'));
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customer.index')
            ->with('notification', $this->successNotification('notification.delete_success', 'menu.customer'));
    }
}
