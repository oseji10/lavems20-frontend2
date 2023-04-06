<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
// use PDF;
use Dompdf\Dompdf;
// use Barryvdh\DomPDF\Facade;
use Illuminate\Http\Client\RequestException;

class LavemsController extends Controller
{
// public function __construct()
// {
//     $this->middleware('auth', ['except' => ['login', 'register']]);
// }


    public function getClients(){

        $theUrl     = config('app.guzzle_test_url').'/api/client/';
        $clients   = Http ::get($theUrl)->collect();
        // return $clients;
        return view('project.clients', ['clients' => $clients]);
     }

     public function addInvoice(){

        return view('project.add-invoice');
     }

    //  public function searchClient(Request $request){

    //     $theUrl = config('app.guzzle_test_url').'/api/search-client/'.$request->id;
    //     $response = Http::get($theUrl);

    //     if ($response->successful()) {
    //         return view('project.add-invoice', ['clients' => $response['client']]);
    //     } else {
    //         return redirect()->back()->withErrors(['Ooops! It appears the CLIENT does not exist. Please verify or use a different parameter']);
    //     }
    // }


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
        return view('project.invoices', ['invoices' => $invoices]);
    }

    public function getPayments(){

        $theUrl     = config('app.guzzle_test_url').'/api/subvendor_payments/';
        $payments   = Http ::get($theUrl)->collect();
        // return $clients;
        return view('project.payments', ['payments' => $payments]);
    }

    // public function storeInvoice(Request $request){
    //     {
    //         // Validate the form data
    //         $validatedData = $request->validate([
    //             'equipment_serial_numbers.*' => 'required',
    //             'equipments.*' => 'required',
    //             'quantities.*' => 'required',
    //         ]);

    //         // Create an array to hold the items and quantities
    //         $items = [];

    //         // Loop through the items and quantities and add them to the array
    //         foreach ($validatedData['items'] as $key => $item) {
    //             $quantity = $validatedData['quantities'][$key];
    //             $items[] = [
    //                 'equipment_serial_numbers' => $equipment_serial_number,
    //                 'equipments' => $equipment,
    //                 'quantity' => $quantity,
    //             ];
    //         }

    //         // Submit the data to the external API
    //         // $response = Http::post('https://example.com/api/data', $data);
    //         $response = Http::post(config('app.guzzle_test_url').'/api/client/', $items);

    //         // Redirect the user back to the form with a success message
    //         return redirect('/form')->with('success', 'Form submitted successfully!');
    //     }
    // }

    public function storeInvoice(Request $request)
    {
        // Validate the request data
        $request->validate([
            'client_id' => 'required',
            'equipment_serial_numbers.*' => 'required',
            'equipments.*' => 'required',
            'quantities.*' => 'required',
        ]);

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

            // return "error";
            // Post the invoice data to the external API endpoint
            try {
                $theUrl = config('app.guzzle_test_url') . '/api/invoice';
                $response = Http::post($theUrl, $invoiceData);


                // Check if the response was successful and display a message
                if ($response->successful()) {
                    $message = 'Invoice added successfully.';
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
        return redirect()->back()->with('message', $message);
    }



     public function showClientForm(){

        return view('project.add-client');

     }

     public function addClient(Request $request){
        $theUrl     = config('app.guzzle_test_url').'/api/client/';
        $response= Http::post($theUrl, [
            'name'=>$request->name,
            'email'=>$request->email,
            'contact_address'=>$request->contact_address,
            'phone_number'=>$request->phone_number,
            'gender'=>$request->gender,
            'state_of_residence'=>$request->state_of_residence,
            'nature_of_business'=>$request->nature_of_business,
            'edi_id'=>$request->edi_id,
            'referred_by'=>$request->referred_by,
            // 'registered_by'=>$request->registered_by
        ]);
        // return $response;

        if ($response->ok()) {
            // return back()->withInput();
            return redirect()->back()->with('success', 'Client Successfully captured');
        // return redirect()->back()->success(['Successfully captured']);

        } else {

            return redirect()->back()->withErrors(['There was an error. Please check form again']);
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




    public function login(Request $request)
{
    $response = Http::withHeaders([
        'X-CSRF-TOKEN' => $request->session()->token(),
    ])->post(config('app.guzzle_test_url').'/api/login/', [
        'email' => $request->email,
        'password' => $request->password,
        // $csrf_token = csrf_token();
    ]);

    if ($response->ok()) {
        $data = json_decode($response->getBody(), true);
                session()->put(['user' => $data['user']]);
                return redirect('/Dashboards/Default');
    } else {
        $data = json_decode($response->getBody(), true);
                // session()->put(['user' => $data['user']]);
                return redirect('/Dashboards/Default');
    }
}

}


