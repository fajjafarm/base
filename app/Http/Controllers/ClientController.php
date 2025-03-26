<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index()
    {
        
        $clients = Client::all();
       
        return view('clients.index', compact('clients'));
        
        
    }
    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string',
            'company_post_code' => 'required|string|max:20',
            'client_contact' => 'required|string|max:255',
            'client_phone' => 'required|string|max:20',
            'client_email' => 'required|email|unique:clients,client_email',
            'company_website' => 'nullable|url',
            'vat_number' => 'nullable|string|max:20',
            'company_registration_number' => 'nullable|string|max:20',
            'company_description' => 'nullable|string',
        ]);

        $client = new Client;
        $client->client_id = Str::ulid(); // Generate ULID
        $client->fill($validatedData);
        $client->save();

        return redirect()->back()->with('success', 'Client added successfully.');
    }
}