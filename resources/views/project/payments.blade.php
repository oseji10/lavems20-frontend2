@php
    $html_tag_data = ["scrollspy"=>"true"];
    $title = 'Payments';
    $description = 'Examples for opt-in styling of tables (given their prevalent use in JavaScript plugins) with Bootstrap.';
    $breadcrumbs = ["/"=>"Home","/Interface"=>"Interface","/Interface/Content"=>"Content"]
@endphp
@extends('layout',[
'html_tag_data'=>$html_tag_data,
'title'=>$title,
'description'=>$description
])

@section('css')
@endsection

@section('js_vendor')
    <script src="{{ asset('/js/cs/scrollspy.js') }}"></script>
@endsection

@section('js_page')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- Title Start -->
                {{-- <section class="scroll-section" id="title">
                    <div class="page-title-container">
                        <h1 class="mb-0 pb-0 display-4">{{ $title }}</h1>
                        @include('_layout.breadcrumb',['breadcrumbs'=>$breadcrumbs])
                    </div>
                </section> --}}
                <!-- Title End -->

                <!-- Content Start -->
                {{-- <div>
                    <div class="card mb-5">
                        <div class="card-body">
                            <p class="mb-0">{{ $description }}</p>
                        </div>
                    </div> --}}

                    <section class="scroll-section" id="title">
                        <div class="page-title-container">
                            <h1 class="mb-0 pb-0 display-4">{{ $title }}</h1><br/>
                            {{-- @include('_layout.breadcrumb',['breadcrumbs'=>$breadcrumbs]) --}}


                            <button type="button" class="btn btn-outline-primary btn-icon btn-icon-end w-100 w-sm-auto"
                                    id="dashboardTourButton" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i data-cs-icon="plus"></i>
                                <span>Generate Receipt</span>
                            </button>

                        </div>
                        {{--  --}}
                        </div>
                    </section>


             <!-- Modal -->
             <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabelDefault" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelDefault">Print Receipt</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">
                            <!-- <i data-cs-icon="close"></i> -->
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{url('/receipt')}}">
                            @csrf
                        <input class="form-control" type="text" placeholder="Enter Invoice Number" name="id" required/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Print Receipt</button>
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                    </div>
                </form>
                </div>
            </div>
        </div>

                     <!--Generate Invoice Modal -->
                     <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabelDefault" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabelDefault">Search Client</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    <!-- <i data-cs-icon="close"></i> -->
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{url('search-client')}}">
                                    @csrf
                                <input class="form-control" type="text" placeholder="Enter Client ID, Phone Number or Email" name="id" required/>
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
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                            <!-- <i data-cs-icon="close"></i> -->
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{url('/receipt')}}">
                                                            @csrf
                                                        <input class="form-control" type="text" placeholder="Enter Invoice Number" name="id" required/>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                <!-- <i data-cs-icon="close"></i> -->
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{url('/site-inspection')}}">
                                @csrf
                            <input class="form-control" type="text" placeholder="Enter Invoice Number" name="id" required/>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Print</button>

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

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
                    <!-- Hoverable Rows Start -->
                    <section class="scroll-section" id="hoverableRows">
                        {{-- <h2 class="small-title">List of Clients</h2> --}}
                        <div class="card mb-5">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Invoice Number</th>
                                        <th scope="col">Client ID</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Processed Date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $i=1; ?>
                                    <tr>
                                    @foreach ($payments as $data)
                                        <th scope="row"><?php echo $i++; ?></th>
                                        <td>{{$data['invoice_number'] ?? null}}</td>
                                        <td>{{$data['client_id'] ?? null}}</td>
                                        <td style="text-transform:uppercase">{{$data['name'] ?? null}}</td>
                                        <td>{{ Carbon\Carbon::parse($data['created_at'])->format('D, d-m-Y ') }}</td>
                                        <td>
                                            <a target="_blank" href="/print_receipt?id={{$data['invoice_number']}}"><i data-cs-icon="print"></i></a>


                                            &nbsp;
                                            <a href=""><i data-cs-icon="send"></i></a>
                                            &nbsp;
                                            <a href="">Edit</a>
                                          </td>

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                    <!-- Hoverable Rows End -->







            <!-- Scrollspy End -->
        </div>
    </div>
@endsection
