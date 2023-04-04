<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PDF;
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

    public function searchClient(Request $request){

        $theUrl     = config('app.guzzle_test_url').'/api/search-client/'.$request->id;
        $response   = Http ::get($theUrl)->collect();
        // return $response;
        return view('project.add-invoice', ['clients' => $response]);


    }

     public function getInvoices(){

        $theUrl     = config('app.guzzle_test_url').'/api/invoice/';
        $invoices   = Http ::get($theUrl)->collect();
        // return $clients;
        return view('project.invoices', ['invoices' => $invoices]);
    }

    public function storeInvoice(Request $request){
        {
            // Validate the form data
            $validatedData = $request->validate([
                'equipment_serial_numbers.*' => 'required',
                'equipments.*' => 'required',
                'quantities.*' => 'required',
            ]);

            // Create an array to hold the items and quantities
            $items = [];

            // Loop through the items and quantities and add them to the array
            foreach ($validatedData['items'] as $key => $item) {
                $quantity = $validatedData['quantities'][$key];
                $items[] = [
                    'equipment_serial_numbers' => $equipment_serial_number,
                    'equipments' => $equipment,
                    'quantity' => $quantity,
                ];
            }

            // Submit the data to the external API
            // $response = Http::post('https://example.com/api/data', $data);
            $response = Http::post(config('app.guzzle_test_url').'/api/client/', $items);

            // Redirect the user back to the form with a success message
            return redirect('/form')->with('success', 'Form submitted successfully!');
        }
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

     public function printClientPDF($id){
        $theUrl = config('app.guzzle_test_url').'/api/export_client_pdf/'.$id;
        $pdf = Http ::get($theUrl)->collect();
        return $pdf;
     }

    //  public function createPDF($id) {
    //     // retreive all records from db
    //     // $data = Employee::all();
    //     // share data to view
    //     $theUrl = config('app.guzzle_test_url').'/api/export_client_pdf/'.$id;
    //     $data = Http ::get($theUrl)->collect();
    //     view()->share('employee',$data);
    //     $pdf = PDF::loadView('pdf_view', [$data]);
    //     // download PDF file with download method
    //     return $pdf->download('pdf_file.pdf');
    //   }



    // Login controller
    // public function login(Request $request)
    // {
    //     try {
    //         $response = Http::post(config('app.guzzle_test_url').'/api/login/', [
    //             'email' => $request->email,
    //             'password' => $request->password,
    //         ]);

    //         if ($response->ok()) {
    //             $data = json_decode($response->getBody(), true);
    //             session()->put(['user' => $data['user']]);
    //             return redirect('/Dashboards/Default');
    //         } else {
    //             return "error";
    //         }
    //     } catch (RequestException $e) {
    //         // Handle request exception
    //         return redirect('/')->withErrors(['Invalid credentials']);
    //     }
    // }

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
        return $response;
    } else {
        return "Error";
    }
}

}


