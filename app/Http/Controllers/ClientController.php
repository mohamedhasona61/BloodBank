<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(20);
        return view('clients.index', compact('clients'));
    }

    public function destroy($id)
    {
        Client::find($id)->delete();
        flash()->success("Client destroyed Succefully");
        return back();
    }
}