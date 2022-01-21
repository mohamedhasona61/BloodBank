<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonationRequest;

class DonationRequestController extends Controller
{
    
    public function index()
    {
        $donationRequests = DonationRequest::paginate(20);
        return view('donationRequests.index', compact('donationRequests'));
    }

    public function show($id)
    {
        $donationRequest = DonationRequest::find($id);
        return view('donationRequests.show', compact('donationRequest'));
    }


    public function destroy($id)
    {
        DonationRequest::find($id)->delete();
       
        flash()->success("Contact Message deleted successfully");
        return back();
    }
}
