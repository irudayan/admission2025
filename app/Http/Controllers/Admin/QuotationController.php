<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\Leads;
use App\Models\Products;
use PDF;
use Mail;
use App\Mail\QuotationMail;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Http; // For WhatsApp API (Interakt)
use Illuminate\Support\Facades\Storage;

class QuotationController extends Controller
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
            $leads = Leads::with('products', 'user','assign')->where('status', 'quotation')->get();
        } elseif (auth()->id() == 2) {
              // Admin sees leads assigned to them
                $leads = Leads::with('products', 'user','assign')
                ->where('assigned_name', $user->id)
                ->where('status', 'quotation')
                ->get();
        } else {
              // Regular users see only leads they created
                $leads = Leads::with('products', 'user','assign')
                ->where('user_id', $user->id)
                ->where('status', 'quotation')
                ->get();

        }
        // $leads = Leads::where('status', 'quotation')->get();
        $products = Products::all();
        $selectedProducts = [];

        return view('admin.quotations.index', compact('leads', 'products', 'selectedProducts'))
        ->with('message', $leads->isEmpty() ? 'No leads found.' : null);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quotations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            PRODUCT_ID => 'required|integer',
        ]);
        Quotation::create($request->all());
        return redirect()->route('admin.quotations.index')->with('success', 'Quotation created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function show(Quotation $quotation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function edit(Quotation $quotation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quotation $quotation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quotation  $quotation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quotation $quotation)
    {
        //
    }

public function sendQuotationEmail($leadId)
    {
        $lead = Leads::findOrFail($leadId);

         // Only selected products from product_ids


         $products = Products::whereIn('id', $lead->product_ids ?? [])->get();

        $user = Auth::user();

        $senderEmail = $user->email;
        $senderName = $user->name;

        // Generate PDF
        $pdf = PDF::loadView('admin.quotations.quotation', compact('lead', 'products'));
        $pdfPath = storage_path("app/public/quotation_{$lead->id}.pdf");
        $pdf->save($pdfPath);

        // Send Email
        Mail::to($lead->email)->send(new QuotationMail($lead, $pdfPath, $senderEmail, $senderName));

        // Send WhatsApp Message via Interakt
        $this->sendWhatsappQuotation($lead, $pdfPath); // ✅ fixed method call

        // Update lead status
        $lead->update(['mail_status' => 1]);

        return $pdf->stream("quotation_{$lead->id}.pdf");
    }

    public function sendWhatsappQuotation($lead, $pdfPath)
    {
        $accessToken = env('INTERAKT_API_KEY');
        $phoneNumber = $lead->mobile;

        // Ensure phone number has country code, e.g., +91
        if (!str_starts_with($phoneNumber, '+')) {
            $phoneNumber = '+91' . ltrim($phoneNumber, '0'); // customize based on your data
        }

        // Make sure the file is publicly accessible
        $publicPath = "public/quotation_{$lead->id}.pdf";

        if (!Storage::exists($publicPath)) {
            Storage::put($publicPath, file_get_contents($pdfPath));
        }

        $fileUrl = asset("storage/quotation_{$lead->id}.pdf");
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$accessToken}",
            'Content-Type' => 'application/json',
        ])->post('https://api.interakt.ai/v1/public/message/file', [
            "phoneNumber" => $phoneNumber,
            "type" => "media",
            "media" => [
                "urlLink" => $fileUrl,
                "fileName" => "Quotation.pdf"
            ],
            "callbackData" => "Quotation_Sent"
        ]);

        // Add this temporarily to debug:
        // dd($response->status(), $response->body());
    }
    // https://api.interakt.ai/v1/public/track/users/

}