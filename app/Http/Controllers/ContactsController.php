<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;



class ContactsController extends Controller
{
    public function index()
    {
        $contacts = ContactUs::paginate(20);
        return view('contacts.index', compact('contacts'));
    }

    public function destroy($id)
    {
        ContactUs::find($id)->delete();
       
        flash()->success("Contact Message deleted successfully");
        return back();
    }
}