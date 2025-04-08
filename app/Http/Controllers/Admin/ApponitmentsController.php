<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apponitments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Leads;
use App\Models\Products;
use Mail;
use App\Mail\DemoMail;
use App\Models\User;



class ApponitmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = auth()->user();

        $assignedName = User::select('id', 'name')->distinct()->get();



        if (auth()->id() == 1) {
            $leads = Leads::with('products', 'user','assign')->where('status', 'demo')->get();
        } elseif (auth()->id() == 2) {
              // Admin sees leads assigned to them
                $leads = Leads::with('products', 'user','assign')
                ->where('assigned_name', $user->id)
                ->where('status', 'demo')
                ->get();
        } else {
              // Regular users see only leads they created
                $leads = Leads::with('products', 'user','assign')
                ->where('user_id', $user->id)
                ->where('status', 'demo')
                ->get();

        }



        // $leads = Leads::where('status', 'demo')->get();
        $products = Products::all();
        $selectedProducts = [];

        return view('admin.appointments.index', compact('leads', 'products', 'selectedProducts'))
        ->with('message', $leads->isEmpty() ? 'No leads found.' : null);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apponitments  $apponitments
     * @return \Illuminate\Http\Response
     */
    public function show(Apponitments $apponitments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apponitments  $apponitments
     * @return \Illuminate\Http\Response
     */
    public function edit(Apponitments $apponitments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apponitments  $apponitments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apponitments $apponitments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apponitments  $apponitments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apponitments $apponitments)
    {
        //
    }


    public function sendDemoEmail(Request $request, $leadId)
    {
        // Validate the request
        $request->validate([
            'demo_date' => 'required|date',
            'demo_time' => 'required',
        ]);

        // Find the lead
        $lead = Leads::findOrFail($leadId);
        if (!$lead) {
            return back()->with('error', 'Lead not found.');
        }

        // Update the lead with the selected date and time
        $lead->update([
            'demo_date' => $request->input('demo_date'),
            'demo_time' => $request->input('demo_time'),
            'demo_mail_status' => 1, // Mark email as sent
        ]);

        // Get products (if needed)
        $products = Products::all();

        // Send email with date and time
        Mail::to($lead->email)->send(new DemoMail($lead, $products));

        return back()->with('success', 'Demo email sent successfully.');
    }
}
