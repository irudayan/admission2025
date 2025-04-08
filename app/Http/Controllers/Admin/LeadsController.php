<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    $user = auth()->user();
    $assignedName = User::select('id', 'name')->get();
    if (auth()->id() == 1) {

        $leads = Leads::with('products', 'user','assign')->get();
    } elseif (auth()->id() == 2) {

        $leads = Leads::with('products', 'user','assign')
        ->where('assigned_name', $user->id)->get();
    }else {

        $leads = Leads::with('products', 'user', 'assign')
        ->where('user_id', $user->id)
        ->orWhere('assigned_name', $user->id)
        ->get();

    }
    $products = Products::all();
    $selectedProducts = [];
    $assignedName = User::select('id', 'name')->distinct()->get();


        return view('admin.leads.index', compact('leads','products','selectedProducts','assignedName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', '!=', 'superadmin')->get(); // Exclude superadmin
        $products = Products::all();


        return view('admin.leads.create', compact('products', 'assignedName'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // // Validate the request

    $request->validate([
        'name' => 'required|string|max:255',
        'mobile' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:1000',
        'status' => 'required|in:New,Demo,Quotation,Pending,Done,Cancel',
        'source' => 'required|string|max:255',
       'assigned_name' => 'nullable|exists:users,id', // Ensure assigned_name exists in users table
        'purpose' => 'nullable|string',
        'remarks' => 'nullable|string',
        'product_ids' => 'required|array',
        'product_ids.*' => 'exists:products,id',
    ]);

    // Create the lead
    $lead = Leads::create([
        'user_id' => auth()->id(),
        'name' => $request->name,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'address' => $request->address,
        'status' => $request->status,
        'source' => $request->source,
        'assigned_name' => $request->assigned_name, // Save assigned_name
        'purpose' => $request->purpose,
        'remarks' => $request->remarks,
    ]);

    // Attach products to the lead
    $lead->products()->sync($request->input('product_ids', []));

        return redirect()->route('admin.leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leads $lead)
    {
        $products = $lead->products()->select('name', 'pivot.price')->get();
        return view('admin.leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leads $lead)
    {
        $products = Products::all();
        $selectedProducts = $lead->products->pluck('id')->toArray();
        $assignedName = User::select('id', 'name')->distinct()->get();

    return view('admin.leads.edit', compact('lead', 'products', 'selectedProducts', 'assignedName'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leads $lead )
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required|string',
            'source' => 'required|string',
            'assigned_name' => 'nullable|exists:users,id', // Ensure assigned_name exists
            'product_ids' => 'required|array', // Ensure product_ids is an array
            'product_ids.*' => 'exists:products,id', // Ensure each product_id exists in the products table
            'remarks' => 'nullable|string',
        ]);

       // Ensure the assigned_name is updated properly

    $validatedData['user_id'] = $request->assigned_name;
        // Update the lead with validated data
        $lead->update($validatedData);

        // Sync the products (many-to-many relationship)
        $lead->products()->sync($request->input('product_ids', []));
        // Sync many-to-many relation


        return redirect()->route('admin.leads.index')->with('success', 'Lead updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leads $lead)
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted successfully.');
    }


public function getLeadProducts($id)
{
    $lead = Leads::with('products')->findOrFail($id);

    return response()->json([
        'success' => true,
        'products' => $lead->products->pluck('id') // Get only product IDs
    ]);
}


}
