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
            'quantities.*' => 'required|numeric',
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

            return "error";
            // // Post the invoice data to the external API endpoint
            // $theUrl = config('app.guzzle_test_url') . '/api/invoice';
            // $response = Http::post($theUrl, $invoiceData);

            // // Check if the response was successful and display a message
            // if ($response->successful()) {
            //     $message = 'Invoice added successfully.';
            // } else {
            //     $message = 'There was an error adding the invoice. Please try again.';
            // }
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

     public function clientReceipt(Request $request){
        $theUrl = config('app.guzzle_test_url').'/api/receipt/'.$request->id;
        $data = Http ::get($theUrl);
        // $data = json_decode($receipt, true);
        $response = json_decode($data, true);

        foreach ($response['receipt'] as $item) {
            $invoice_number = $item['invoice_number'];
            $client_id = $item['client_id'];
            $contact_address = $item['contact_address'];
            $nature_of_business = $item['nature_of_business'];
            $client_name = $item['name'];
            $invoice_date = $item['created_at'];
            $phone_number = $item['phone_number'];
            // $quantity = $item['quantity'];
        }

        $grand_total = $response['grand_total'];
        // $data2 = $response['receipt'];
        // return $receipt;
        $pdf = new Dompdf();
        $pdf = \PDF::loadView('project.receipt', compact('data'), ['invoice_number'=>$invoice_number, 'client_id'=>$client_id, 'contact_address'=>$contact_address, 'nature_of_business'=>$nature_of_business, 'client_name'=>$client_name, 'invoice_date'=>$invoice_date, 'phone_number'=>$phone_number]);
        return $pdf->stream();
    // return $pdf->stream('my-pdf-file.pdf');
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


