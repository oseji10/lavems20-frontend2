<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PDF;

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

    //  public function searchClient(Request $request, $id){
    //     $theUrl = config('app.guzzle_test_url'.'api/search-client/'.$request->$id);
    //     $client = Http :: get($theUrl)->collect();
    //     return $client;
    //  }


    public function searchClient(Request $request){
        $theUrl     = config('app.guzzle_test_url').'/api/search-client/';
        $response= Http::post($theUrl, [
            'id'=>$request->query,

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

     public function getInvoices(){

        $theUrl     = config('app.guzzle_test_url').'/api/invoice/';
        $invoices   = Http ::get($theUrl)->collect();
        // return $clients;
        return view('project.invoices', ['invoices' => $invoices]);


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
    public function login (Request $request){

        $response = Http::post(config('app.guzzle_test_url').'/api/login/', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->ok()) {

            $data = json_decode($response->getBody(), true);


            // return $data['user']['first_name'];
session()->put(['user' => $data['user']]);
return redirect('/Dashboards/Default');
// return $data;
            // return view('dashboard.sales', $data, $data2);
        } else {
            // return "error";
            return redirect('/')->withErrors(['Invalid credentials']);
        }


    }

}


