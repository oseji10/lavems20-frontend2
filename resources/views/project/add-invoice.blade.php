@php
$html_tag_data = ["scrollspy"=>"true"];
$title = 'Add Invoice';
$description= 'Examples and usage guidelines for form control styles and layout options.';
$breadcrumbs = ["/"=>"Home","/Interface"=>"Interface","/Interface/Forms"=>"Forms"]
@endphp
@extends('layout',[
'html_tag_data'=>$html_tag_data,
'title'=>$title,
'description'=>$description
])

@section('css')
<link rel="stylesheet" href="{{ asset('/css/vendor/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/css/vendor/select2-bootstrap4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/css/vendor/bootstrap-datepicker3.standalone.min.css') }}" />
<link rel="stylesheet" href="{{ asset('/css/vendor/tagify.css') }}" />
@endsection

@section('js_vendor')
<script src="{{ asset('/js/cs/scrollspy.js') }}"></script>
<script src="{{ asset('/js/vendor/select2.full.min.js') }}"></script>
<script src="{{ asset('/js/vendor/datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/js/vendor/tagify.min.js') }}"></script>
@endsection

@section('js_page')
<script src="{{ asset('/js/forms/layouts.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <!-- Title Start -->

            <section class="scroll-section" id="title">
                <div class="page-title-container">
                    <h1 class="mb-0 pb-0 display-4">{{ $title }}</h1><br />
                    {{-- @include('_layout.breadcrumb',['breadcrumbs'=>$breadcrumbs]) --}}

                    <a href="/invoices"><button type="button"
                            class="btn btn-outline-primary btn-icon btn-icon-end w-100 w-sm-auto"
                            id="dashboardTourButton">
                            <i data-cs-icon="arrow-long-left"></i>
                            <span>Back To Invoices</span>
                        </button></a>

                </div>
                {{-- --}}
        </div>
        </section>
        <!-- Title End -->

        <!-- Content Start -->
        <div>
            {{-- <div class="card mb-5">
                        <div class="card-body">
                            <p class="mb-0">{{ $description }}</p>
        </div>
    </div> --}}

    <!-- Filled Start -->
    <section class="scroll-section" id="filled">
        {{-- <h2 class="small-title">Filled</h2> --}}
        <div class="card mb-5">
            <div class="card-body">

                {{-- @if (session('status'))
                                <div class="alert alert-success">
                                {{ session('status') }}
            </div>
            @endif --}}

            @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ \Session::get('success') }}</li>
                </ul>
            </div>
            @endif
            <table width="50%">
                <tr>
                    <td width="20%">
                        <h3>Client ID: </h3>
                    </td>

                    <td>
                        <h3>{{ $client_id = request()->input('clientId');}}</h3>
                    </td>
                </tr>

                <tr>
                    <td width="20%">
                        <h3>Client Name: </h3>
                    </td>
                    <td>
                        <h3>{{ $client_name = request()->input('clientName');}}</h3>
                    </td>
                </tr>
            </table>
            <br />

            <form method="POST" action="{{route('invoice.test')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="client_id" value="{{ $client_id}}">
                {{-- <input type="text" name="user_id" value="<span id='id'></span>"> --}}



                {{-- <span>Welcome, <span id="first_name"></span>!</span> --}}






                <div id="item-container">
                    <div class="item">
                        <table style="width:80%">
                            <tr>
                                <td>Equipment Serial Number</td>
                                <td style="width:40%">Equipment Name</td>
                                <td>Quantity</td>
                                <td>Cost</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="mb-3 filled"><input type="text" name="equipment_serial_numbers[]"
                                            placeholder="Equipment Serial Number" class="form-control"></div>
                                </td>
                                <td style="width:40%">
                                    <div class="mb-3 filled"><input type="text" name="equipments[]"
                                            placeholder="Equipment Name" class="form-control"></div>
                                </td>
                                <td>
                                    <div class="mb-3 filled"><input type="number" name="quantities[]"
                                            placeholder="Quantity" class="form-control"></div>
                                </td>
                                <td>
                                    <div class="mb-3 filled"><input type="number" name="costs[]" placeholder="Cost"
                                            class="form-control"></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <button class="btn btn-icon btn-icon-start btn-primary mb-1" type="button" id="add-item">
                    <i data-cs-icon="plus"></i>
                    <span>Add Item</span>
                </button>

                <button class="btn btn-lg btn-icon btn-icon-start btn-secondary mb-1" type="submit">
                    <i data-cs-icon="arrow-bottom-right"></i>
                    <span>Submit</span>
                </button>
            </form>

            <script>
                // Add new input fields when "Add Item" button is clicked
                var addItemButton = document.querySelector('#add-item');
                var itemContainer = document.querySelector('#item-container');
                addItemButton.addEventListener('click', function() {
                    var newItem = document.createElement('div');
                    newItem.className = 'item';
                    var itemCount = itemContainer.querySelectorAll('.item').length;
                    newItem.innerHTML = `
    <table style="width:80%">
      <tr>
        <td><div class="mb-3 filled"><input type="text" name="equipment_serial_numbers[${itemCount}]" placeholder="Equipment Serial Number" class="form-control"></div></td>
        <td style="width:40%"><div class="mb-3 filled"><input type="text" name="equipments[${itemCount}]" placeholder="Equipment Name" class="form-control"></div></td>
        <td><div class="mb-3 filled"><input type="number" name="quantities[${itemCount}]" placeholder="Quantity" class="form-control"></div></td>
        <td><div class="mb-3 filled"><input type="number" name="costs[${itemCount}]" placeholder="Cost" class="form-control"></div></td>
      </tr>
    </table>
  `;
                    itemContainer.appendChild(newItem);
                });
            </script>

            <!--Generate Invoice Modal -->
            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabelDefault" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelDefault">Search Client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <!-- <i data-cs-icon="close"></i> -->
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{url('search-client')}}">
                                @csrf
                                <input class="form-control" type="text"
                                    placeholder="Enter Client ID, Phone Number or Email" name="id" required />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Search Client</button>
                            {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Print Receipt Modal -->
            <div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelDefault">Print Receipt</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <!-- <i data-cs-icon="close"></i> -->
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{url('/receipt')}}">
                                @csrf
                                <input class="form-control" type="text" placeholder="Enter Invoice Number" name="id"
                                    required />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Print Receipt</button>

                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Print Site Inspection Modal -->
            <div class="modal fade" id="siteInspectionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabelDefault">Print Site Inspection Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <!-- <i data-cs-icon="close"></i> -->
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{url('/site-inspection')}}">
                                @csrf
                                <input class="form-control" type="text" placeholder="Enter Invoice Number" name="id"
                                    required />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Print </button>

                        </div>
                        </form>
                    </div>
                </div>
            </div>

                <!-- Print Release of Funds Modal -->
                <div class="modal fade" id="releaseOfFundsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabelDefault">Print Release of Funds Form</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <!-- <i data-cs-icon="close"></i> -->
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{url('/release-of-funds')}}">
                                    @csrf
                                <input class="form-control" type="text" placeholder="Enter Invoice Number" name="id" required/>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Print </button>

                            </div>
                        </form>
                        </div>
                    </div>
                </div>


        </div>
</div>
</section>

<!-- Filled End -->

<!-- Horizontal Form End -->

</div>
<!-- Content End -->
</div>

</div>
</div>
{{-- <label for="first_name">First Name:</label> --}}
{{-- <input type="text" id="first_name" name="first_name" />


<script>
const user = JSON.parse(sessionStorage.getItem('user'));
if (user) {
  const firstName = user.first_name;
  console.log(firstName); // make sure you see the first name in the console
  // Set the value of the input field to the first name
  document.getElementById('first_name').value = firstName;
} else {
  window.location.href = '/Pages/Authentication/Login';
}
</script> --}}
@endsection
