<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        $assignedName = User::select('id', 'name')->distinct()->get();

        if (auth()->id() == 1) {
            $leads = Leads::with('products', 'user')->latest()->take(7)->get();
            $totalLeads = Leads::with('products', 'user')->count();
            $newLeads = Leads::with('products', 'user')->where('status', 'New')->count();
            $demoLeads = Leads::with('products', 'user')->where('status', 'Demo')->count();
            $quotationLeads = Leads::with('products', 'user')->where('status', 'Quotation')->count();
            $pendingLeads = Leads::with('products', 'user')->where('status', 'Pending')->count();
            $doneLeads = Leads::with('products', 'user')->where('status', 'Done')->count();
            $cancelLeads = Leads::with('products', 'user')->where('status', 'Cancel')->count(); // Fixed Typo

        } elseif (auth()->id() == 2) {
            // Admin: Get only leads assigned to them
            $leads = Leads::with('products', 'user')
            ->where('assigned_name', $user->id)
            ->latest()->take(7)->get();
            $totalLeads = Leads::with('products', 'user')->where('user_id', $user->id)->count();
            $newLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'New')->count();
            $demoLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'Demo')->count();
            $quotationLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'Quotation')->count();
            $pendingLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'Pending')->count();
            $doneLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'Done')->count();
            $cancelLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'Cancel')->count(); // Fixed Typo

        } else {
            $totalLeads = Leads::with('products', 'user')->where('user_id', $user->id)->count();
            $newLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'New')->count();
            $demoLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'Demo')->count();
            $quotationLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'Quotation')->count();
            $pendingLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'Pending')->count();
            $doneLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'Done')->count();
            $cancelLeads = Leads::with('products', 'user')->where('user_id', $user->id)->where('status', 'Cancel')->count(); // Fixed Typo

            // Regular users: Get only leads they created
            $leads = Leads::with('products', 'user')
            ->where('user_id', $user->id)
            ->latest()->take(7)->get();


        }



         // Count leads based on status

    // Fetch latest 7 leads with products (assuming the relationship is set up)
    // $leads = Leads::with('products')->latest()->take(7)->get();

    // Fetch all products
    $products = Products::all();

        // Get authenticated user and their role
        $user = auth()->user();
        $role = $user->role; // Assuming the role is stored in the users table




    return view('admin.home', compact(
        'totalLeads', 'newLeads', 'demoLeads', 'quotationLeads',
        'pendingLeads', 'doneLeads', 'cancelLeads', 'leads', 'products'
    ));

    }
}
