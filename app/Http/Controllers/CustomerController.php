<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $search = request()->query('search');

        return Inertia::render('Customers/Index', [
            'search' => $search,
            'customers' => Customer::query()
                ->whereBelongsTo(request()->user())
                ->when($search, fn ($query, $search) => $query
                    ->where('name', 'like', '%'.$search.'%')
                    ->orWhere('vat', 'like', '%'.$search.'%'))
                ->orderByRaw('lower(name)')
                ->simplePaginate(25)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Customers/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        Customer::create([...$request->validated(), 'user_id' => $request->user()->id]);

        return to_route('customers.index')->with('status', 'Customer created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): Response
    {
        return Inertia::render('Customers/Edit', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()->back()->with('status', 'Customer updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return to_route('customers.index')->with('status', 'Customer deleted.');
    }
}
