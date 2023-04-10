<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use PDF;
use Dompdf\Dompdf;
// use Barryvdh\DomPDF\Facade;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;




class LavemsController extends Controller
{
// public function __construct()
// {
//     $this->middleware('auth', ['except' => ['login', 'register']]);
// }

public function load_invoices(){
    return view('project.invoices');
}

public function allClients(){
    return view('project.clients');
}

public function previewInvoice(){
return view('project.preview-invoice');
}

public function test(Request $request){
    // Validate the request data
    // Log the input data
    Log::info($request->all());

    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pin = mt_rand(100000, 999999)
        . mt_rand(100000, 999999);
    $random_string = str_shuffle($pin);
    // Validate the request data
    $request->validate([
        'equipment_serial_numbers.*' => 'required|string',
        'equipments.*' => 'required|string',
        'quantities.*' => 'required|integer',
        'costs.*' => 'required|integer',
    ]);
    $invoice_number = $random_string;
    $clientId = $request->input('client_id');
    $equipmentSerialNumbers = $request->input('equipment_serial_numbers');
    $equipments = $request->input('equipments');
    $quantities = $request->input('quantities');
    $costs = $request->input('costs');

    $message = '';

    // Loop through the input data and create a new invoice for each item
    foreach ($equipmentSerialNumbers as $key => $equipmentSerialNumber) {
        $invoiceData = [
            'invoice_number' => $invoice_number,
            'client_id' => $clientId,
            'equipment_serial_number' => $equipmentSerialNumber,
            'equipment' => $equipments[$key],
            'quantity' => $quantities[$key],
            'cost' => $costs[$key],
        ];

        // Post the invoice data to the external API endpoint
        try {
            $theUrl = config('app.guzzle_test_url') . '/api/invoice';
            $response = Http::post($theUrl, $invoiceData);
            // Log the response from the API
            Log::info('API Response: ' . $response->getBody());

            // Check if the response was successful and display a message
            if ($response->successful()) {
                $message .= 'Invoice added successfully. Invoice Number: '.$invoice_number;
            } else {
                $message .= 'There was an error adding the invoice. Please try again. ';
            }
        } catch (\Exception $e) {
            // Log the error or display an error message
            Log::error('Error sending invoice to API: ' . $e->getMessage());
            $message .= 'There was an error adding the invoice. Please try again. ';
        }
    }

    // Redirect back with the message
    return redirect()->route('project.invoices')->with(['success' => $message]);
}



    public function getClients(){

        $theUrl     = config('app.guzzle_test_url').'/api/client/';
        $clients   = Http ::get($theUrl)->collect();
        // return $clients;
        return view('project.clients', ['clients' => $clients]);
     }

     public function addInvoice(){

        return view('project.add-invoice');
     }



    public function searchClient(Request $request){

        $theUrl     = config('app.guzzle_test_url').'/api/search-client/'.$request->id;
        $response   = Http::get($theUrl);

        if ($response->successful()) {
            $clientId = $response['client']['client_id'];
            $clientName = $response['client']['name'];
            return redirect()->route('invoice.add', ['clientId' => $clientId, 'clientName' => $clientName,  'request' => $request]);
        } else {
            return redirect()->back()->withErrors(['Ooops! It appears the CLIENT does not exist. Please verify or use a different parameter']);
        }
    }




    public function getInvoices(){

        $theUrl     = config('app.guzzle_test_url').'/api/invoice/';
        $invoices   = Http ::get($theUrl)->collect();
        // return $clients;
        return view('project.invoices', ['invoices' => $invoices['invoice']]);
    }




    public function getPayments(){

        $theUrl     = config('app.guzzle_test_url').'/api/subvendor_payments/';
        $payments   = Http ::get($theUrl)->collect();
        // return $clients;
        return view('project.payments', ['payments' => $payments]);
    }





public function storeInvoice(Request $request)
{


    // Get the input data from the request
    $clientId = $request->input('client_id');
    $equipmentSerialNumbers = $request->input('equipment_serial_numbers');
    $equipments = $request->input('equipments');
    $quantities = $request->input('quantities');

    // Loop through the input data and create a new invoice for each item
    foreach ($equipmentSerialNumbers as $key => $equipmentSerialNumber) {
        $invoiceData = [
            'client_id' => $clientId,
            'equipment_serial_number' => $equipmentSerialNumber,
            'equipment_name' => $equipments[$key],
            'quantity' => $quantities[$key],
        ];

        // Post the invoice data to the external API endpoint
        try {
            $theUrl = config('app.guzzle_test_url') . '/api/invoice';
            $response = Http::post($theUrl, $invoiceData);

            // Check if the response was successful and display a message
            if ($response->successful()) {
                $message = 'Invoice added successfully. Invoice Number: '.$response['invoice'];
            } else {
                $message = 'There was an error adding the invoice. Please try again.';
            }
        } catch (\Exception $e) {
            // Log the error or display an error message
            Log::error('Error sending invoice to API: ' . $e->getMessage());
            $message = 'There was an error adding the invoice. Please try again.';
        }
    }

    // Redirect back with the message
    return redirect()->route('project.invoices')->with(['success' => $message]);
    // return redirect()->back()->with('message', $message);
}



     public function showClientForm(){

        return view('project.add-client');

     }

//      public function addClient(Request $request)
//      {
//          $theUrl = config('app.guzzle_test_url') . '/api/client/';
//          $response = Http::post($theUrl, [
//              'name' => $request->name,
//              'email' => $request->email,
//              'contact_address' => $request->contact_address,
//              'phone_number' => $request->phone_number,
//              'gender' => $request->gender,
//              'state_of_residence' => $request->state_of_residence,
//              'nature_of_business' => $request->nature_of_business,
//              'edi_id' => $request->edi_id,
//              'referred_by' => $request->referred_by,
//             //  'token' => $request->input('_token_input'),
//          ]);
//         //  dd($response->json());
// return "Success";
//         //  if ($response->ok()) {
//         //     $client_id = $response['clients'][0]['client_id'];
//         //     $theUrl = config('app.guzzle_test_url') . '/api/client/';
//         //     $clients = Http::get($theUrl)->collect();
//         //     return redirect()->route('client.show')->with(
//         //         [
//         //             'clients' => $clients,
//         //             'success' => "Client successfully captured. Client ID is: $client_id",
//         //         ]
//         //     );
//         // } else {
//         //     return redirect()->back()->withErrors(['There was an error. Please check form again']);
//         // }

//      }


public function addClient(Request $request)
{
    $theUrl = config('app.guzzle_test_url') . '/api/client/';
    $response = Http::post($theUrl, [
        'name' => $request->name,
        'email' => $request->email,
        'contact_address' => $request->contact_address,
        'phone_number' => $request->phone_number,
        'gender' => $request->gender,
        'state_of_residence' => $request->state_of_residence,
        'nature_of_business' => $request->nature_of_business,
        'edi_id' => $request->edi_id,
        'referred_by' => $request->referred_by,
    ]);

    Log::info($response->status());
    if ($response->successful()) {
        return "Success";
    } else {
        return "Error: " . $response->status();
    }
}






 /**
 * Generates a PDF receipt for a client's invoice
 *
 * @param Request $request HTTP request object containing ID of the invoice
 * @return \Illuminate\Http\Response HTTP response object containing the PDF receipt
 */
public function clientReceipt(Request $request)
{
    // Make a GET request to an external API to get invoice data
    $theUrl = config('app.guzzle_test_url').'/api/receipt/'.$request->id;
    $response = Http::get($theUrl);

    // Check if the response is successful
    if (!$response->ok()) {
        return redirect()->back()->withErrors(['There was an error. Please check form again']);
    }

    // Decode the JSON response and check if it contains the required data
    $data = json_decode($response->body(), true);
    if (!isset($data['receipt'])) {
        return redirect()->back()->withErrors(['No data returned from the API']);
    }

    // Extract the required data from the response
    $receipts = $data['receipt'];
    $invoice_number = '';
    $client_id = '';
    $contact_address = '';
    $nature_of_business = '';
    $client_name = '';
    $invoice_date = '';
    $phone_number = '';
    foreach ($receipts as $receipt) {
        if (isset($receipt['invoice_number'])) {
            $invoice_number = $receipt['invoice_number'];
        }
        if (isset($receipt['client_id'])) {
            $client_id = $receipt['client_id'];
        }
        if (isset($receipt['contact_address'])) {
            $contact_address = $receipt['contact_address'];
        }
        if (isset($receipt['nature_of_business'])) {
            $nature_of_business = $receipt['nature_of_business'];
        }
        if (isset($receipt['name'])) {
            $client_name = $receipt['name'];
        }
        if (isset($receipt['created_at'])) {
            $invoice_date = $receipt['created_at'];
        }
        if (isset($receipt['phone_number'])) {
            $phone_number = $receipt['phone_number'];
        }
    }

    // Check if the invoice number is present
    if (empty($invoice_number)) {
        return redirect()->back()->withErrors(['Sorry! This invoice number does not exist']);
    }

    // Get the grand total from the response data
    $grand_total = $data['grand_total'];

    // Generate the PDF receipt using the extracted data
    $pdf = \PDF::loadView('project.receipt', compact('data'), ['invoice_number'=>$invoice_number, 'client_id'=>$client_id, 'contact_address'=>$contact_address, 'nature_of_business'=>$nature_of_business, 'client_name'=>$client_name, 'invoice_date'=>$invoice_date, 'phone_number'=>$phone_number]);

    // Stream the PDF to the HTTP response
    return $pdf->stream();
}


public function clientInvoice(Request $request)
{
    $invoiceNumber = $request->query('id');
    // Make a GET request to an external API to get invoice data
    $theUrl = config('app.guzzle_test_url').'/api/invoice/'.$invoiceNumber;
    $response = Http::get($theUrl);

    // Check if the response is successful
    if (!$response->ok()) {
        return redirect()->back()->withErrors(['There was an error. Please check form again']);
    }

    // Decode the JSON response and check if it contains the required data
    $data = json_decode($response->body(), true);
    if (!isset($data['invoice'])) {
        return redirect()->back()->withErrors(['No data returned from the API']);
    }

    // Extract the required data from the response
    $invoice = $data['invoice'][0];
    $client_id = $invoice['client_id'];
    $contact_address = $invoice['contact_address'];
    $nature_of_business = $invoice['nature_of_business'];
    $client_name = $invoice['name'];
    $invoice_date = $invoice['created_at'];
    $phone_number = $invoice['phone_number'];

    // Get the grand total from the response data
    $grand_total = $data['grand_total'];

    // Generate the PDF invoice using the extracted data
    $pdf = \PDF::loadView('project.invoice', compact('data'), ['invoice_number'=>$invoiceNumber, 'client_id'=>$client_id, 'contact_address'=>$contact_address, 'nature_of_business'=>$nature_of_business, 'client_name'=>$client_name, 'invoice_date'=>$invoice_date, 'phone_number'=>$phone_number, 'grand_total'=>$grand_total]);

    // Stream the PDF to the HTTP response
    return $pdf->stream();
}



public function clientReceipt2(Request $request)
{
    $invoiceNumber = $request->query('id');
    // Make a GET request to an external API to get invoice data
    $theUrl = config('app.guzzle_test_url').'/api/receipt/'.$invoiceNumber;
    $response = Http::get($theUrl);

    // Check if the response is successful
    if (!$response->ok()) {
        return redirect()->back()->withErrors(['There was an error. Please check form again']);
    }

    // Decode the JSON response and check if it contains the required data
    $data = json_decode($response->body(), true);
    if (!isset($data['invoice'])) {
        return redirect()->back()->withErrors(['No data returned from the API']);
    }

    // Extract the required data from the response
    $invoice = $data['invoice'][0];
    $client_id = $invoice['client_id'];
    $contact_address = $invoice['contact_address'];
    $nature_of_business = $invoice['nature_of_business'];
    $client_name = $invoice['name'];
    $invoice_date = $invoice['created_at'];
    $phone_number = $invoice['phone_number'];

    // Get the grand total from the response data
    $grand_total = $data['grand_total'];

    // Generate the PDF invoice using the extracted data
    $pdf = \PDF::loadView('project.receipt', compact('data'), ['invoice_number'=>$invoiceNumber, 'client_id'=>$client_id, 'contact_address'=>$contact_address, 'nature_of_business'=>$nature_of_business, 'client_name'=>$client_name, 'invoice_date'=>$invoice_date, 'phone_number'=>$phone_number, 'grand_total'=>$grand_total]);

    // Stream the PDF to the HTTP response
    return $pdf->stream();
}







public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    $response = Http::post(config('app.guzzle_test_url') . '/api/login', [
        'email' => $request->email,
        'password' => $request->password,
    ]);

    if ($response->successful()) {
        $data = $response->json();

        // Store the user data in session
        // session()->put('user', $data['user']);

        // Set the authorization token in the cookie
        // Cookie::queue('Authorization', 'Bearer ' . $data['authorisation']['token'], 60 * 24 * 30);

        return redirect('/Dashboards/Default');
    } else {
        // If the authentication fails, redirect back with error message
        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }
}


public function logout()
{
    if (Auth::check()) {
        $user = Auth::user();
        $token = Auth::tokenById($user->id);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post(config('app.guzzle_test_url').'/api/logout');

        if ($response->ok()) {
            // Clear the user's session and logout the user locally
            Auth::logout();
            session()->invalidate();
            session()->regenerateToken();
            return redirect('/Pages/Authentication/Login');
        } else {
            // Handle any error response from the API
            return back()->withErrors(['error' => 'Failed to logout']);
        }
    } else {
        // No user is authenticated, so just redirect to the login page
        return redirect('/Pages/Authentication/Login');
    }
}



}


