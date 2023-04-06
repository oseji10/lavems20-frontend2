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
    <link rel="stylesheet" href="{{ asset('/css/vendor/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/select2-bootstrap4.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/bootstrap-datepicker3.standalone.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('/css/vendor/tagify.css') }}"/>
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
                        <h1 class="mb-0 pb-0 display-4">{{ $title }}</h1><br/>
                        {{-- @include('_layout.breadcrumb',['breadcrumbs'=>$breadcrumbs]) --}}


                        <a href="/invoices"><button type="button" class="btn btn-outline-primary btn-icon btn-icon-end w-100 w-sm-auto"
                                id="dashboardTourButton">
                                <i data-cs-icon="arrow-long-left"></i>
                            <span>Back To Invoices</span>
                        </button></a>

                    </div>
                    {{--  --}}
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
                            <table width="50%" >
                                <tr>
                                    <td width="20%"><h3>Client ID: </h3></td>

                                    <td><h3>{{ $client_id = request()->input('clientId');}}</h3></td>
                                </tr>

                                <tr>
                                    <td width="20%"><h3>Client Name: </h3></td>
                                    <td><h3>{{ $client_name = request()->input('clientName');}}</h3></td>
                                </tr>
                            </table>
<br/>

                            <form method="POST" action="{{route('invoice.store')}}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">


                                <div id="item-container">
                                    <table style="width: 80%">
                                        <tr>
                                            <td>Equipment Serial Number</td>
                                            <td>Equipment Name</td>
                                            <td>Equipment Quantity</td>
                                        </tr>
                                        <tr>
                                            <td><div class="mb-3 filled">
                                                {{-- <input type="hidden" value="{{$clients['client_id'] ?? null}}" name="client_id" /> --}}
                                                {{-- <input type="hidden" value="{{ $client_id = request()->input('clientId');}}" name="client_id" /> --}}
                                                <input type="hidden" value="{{ $client_id = request()->input('client_id');}}" name="client_id" />

                                                <input type="text" name="equipment_serial_numbers[]" placeholder="Equipment Serial Number" class="form-control">
                                                </div></td>
                                            <td style="width:50%"><div class="mb-3 filled">
                                                <input type="text" name="equipments[]" placeholder="Equipment Name" class="form-control">
                                                </div></td>
                                            <td><div class="mb-3 filled">
                                                <input type="number" name="quantities[]" placeholder="Quantity" class="form-control">
                                                </div></td>
                                        </tr>
                                    </table>




                                </div>
                                <button class="btn btn-icon btn-icon-start btn-primary mb-1" type="button" id="add-item">
                                    <i data-cs-icon="plus"></i>
                                    <span>Add Item</span>
                                </button>
                                {{-- <button class="btn btn-icon btn-icon-start btn-primary mb-1"type="button" id="add-item">Add Item</button> --}}

                                <button class="btn btn-lg btn-icon btn-icon-start btn-primary mb-1" type="submit">
                                    <i data-cs-icon="arrow-bottom-right"></i>
                                    <span>Submit</span>
                                </button>

                                {{-- <button type="submit">Submit</button> --}}
                              </form>

                              <script>
                                // Add new input fields when "Add Item" button is clicked
                                var addItemButton = document.querySelector('#add-item');
                                var itemContainer = document.querySelector('#item-container');

                                addItemButton.addEventListener('click', function() {
                                  var newItem = document.createElement('div');
                                  newItem.className = 'item';
                                  newItem.innerHTML = `
                                <table style="width:80%">
                                  <tr>
                                    <td><div class="mb-3 filled"><input type="text" name="equipment_serial_numbers[]" placeholder="Equipment Serial Number" class="form-control"></div></td>
                                    <td style="width:50%"><div class="mb-3 filled"><input type="text" name="equipments[]" placeholder="Equipment Name" class="form-control"></div></td>
                                    <td><div class="mb-3 filled"><input type="number" name="quantities[]" placeholder="Quantity" class="form-control"></div></td>
                                </tr>
                                </table>

                                  `;
                                  itemContainer.appendChild(newItem);
                                });
                              </script>


{{-- <script>
    // Check if the URL has a clientId parameter
    if (window.location.search.includes('clientId=')) {
        // Get the clientId value from the URL
        const clientId = new URLSearchParams(window.location.search).get('clientId');

        // Replace the current URL with one that includes the clientId
        window.history.pushState({}, '', '/project/add-invoice?clientId=' + clientId);
    }

    // Wait for the modal to be shown
    $('#myModal').on('shown.bs.modal', function () {
        // Get the clientId value from the input field in the modal
        const clientId = $('#clientId').val();

        // Replace the current URL with one that includes the clientId
        window.history.pushState({}, '', '/project/add-invoice?clientId=' + clientId);
    });
</script> --}}




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
@endsection
