@php
    $html_tag_data = ["scrollspy"=>"true"];
    $title = 'Add Client';
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


                        <a href="/clients"><button type="button" class="btn btn-outline-primary btn-icon btn-icon-end w-100 w-sm-auto"
                                id="dashboardTourButton">
                                <i data-cs-icon="arrow-long-left"></i>
                            <span>Back To Clients</span>
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
                                <form method="post" action="{{url('/add-client')}}">
                                @csrf

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

                                    <div class="mb-3 filled">
                                        <i data-cs-icon="user"></i>
                                        <input class="form-control" type="text" placeholder="Fullname" name="name" required/>
                                    </div>

                                    <div class="mb-3 filled">
                                        <i data-cs-icon="phone"></i>
                                        <input class="form-control" type="text" placeholder="Phone Number" name="phone_number" required/>
                                    </div>

                                    <div class="mb-3 filled">
                                        <i data-cs-icon="send"></i>
                                        <input class="form-control" placeholder="Email" name="email" required/>
                                    </div>

                                    <div class="mb-3 filled">
                                        <textarea name="contact_address" placeholder="Contact Address" class="form-control" rows="2" required></textarea>
                                        <i data-cs-icon="notebook-3"></i>
                                    </div>


                                    <div class="mb-3 filled w-100">
                                        <i data-cs-icon="user"></i>
                                        <select id="select2Filled" data-placeholder="Gender" name="gender" required>
                                            <option label="&nbsp;"></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>

                                        </select>
                                    </div>

                                    {{-- <div class="mb-3 filled w-100">
                                        <i data-cs-icon="user"></i>
                                        <select id="select2Filled" data-placeholder="Gender" name="gender">
                                            <option label="&nbsp;"></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>

                                        </select>
                                    </div> --}}


                                    <div class="mb-3 filled w-100">
                                        <i data-cs-icon="file-text"></i>
                                        <select class="form-control" id="select2Filled2" data-placeholder="State Of Residence" name="state_of_residence" required>
                                            <option label="State of Residence"></option>
                                            <option value="Abia">Abia</option>
                                            <option value="Adamawa">Adamawa</option>
                                            <option value="Akwa Ibom">Akwa Ibom</option>
                                            <option value="Anambra">Anambra</option>
                                            <option value="Bauchi">Bauchi</option>
                                            <option value="Bayelsa">Bayelsa</option>
                                            <option value="Benue">Benue</option>
                                            <option value="Borno">Borno</option>

                                        </select>
                                    </div>


                                    <div class="mb-3 filled w-100">
                                        <i data-cs-icon="archive"></i>
                                        <select class="form-control" id="select2Filled2" data-placeholder="Nature of Business" name="nature_of_business" required>
                                            <option label="Nature of Business"></option>
                                            <option value="Fashion and Beauty">Fashion and Beauty</option>
                                            <option value="Textile and Apparel">Textile and Apparel</option>
                                            <option value="Arts and Entertaiment">Arts and Entertaiment</option>
                                            <option value="Agriculture and Allied Processing">Agriculture and Allied Processing</option>
                                            <option value="Automobile">Automobile</option>
                                            <option value="Telecommunication">Telecommunication</option>
                                            <option value="Media and Publishing">Media and Publishing</option>
                                            <option value="Catering and Event Management">Catering and Event Management</option>
                                            <option value="Hospitality">Hospitality</option>
                                            <option value="Healthcare">Healthcare</option>
                                            <option value="Creative Industry">Creative Industry</option>
                                            <option value="ICT">ICT</option>
                                            <option value="Logistics">Logistics</option>
                                            <option value="Others">Others</option>

                                        </select>
                                    </div>


                                    <div class="mb-3 filled w-100">
                                        <i data-cs-icon="circle"></i>
                                        <select class="form-control" id="select2Filled2" data-placeholder="EDI" name="edi_id" required>
                                            <option label="EDI"></option>
                                            <option value="Gogetit">Gogetit Investment Limited</option>
                                        <option value="Others">Others</option>

                                        </select>
                                    </div>


                                    <div class="mb-3 filled w-100">
                                        <i data-cs-icon="file-text"></i>
                                        <select class="form-control" id="select2Filled2" data-placeholder="Referred By" name="referred_by" required>
                                            <option label="Referred By"></option>
                                            <option value="NIRSAL Office Area 10">NIRSAL Office Area 10</option>
                                            <option value="NIRSAL Office Kubwa">NIRSAL Office Kubwa</option>
                                            <option value="NIRSAL Office Bwari">NIRSAL Office Bwari</option>
                                            <option value="NIRSAL Office Kuje">NIRSAL Office Kuje</option>
                                            <option value="I Came Myself">I Came Myself</option>
                                            <option value="Others">Others</option>
                                         </select>
                                    </div>


                                    {{-- <div class="mb-3 filled">
                                        <i data-cs-icon="user"></i>
                                        <input class="form-control" type="text" placeholder="EDI Name" name="edi"/>
                                    </div> --}}


{{--
                                    <div class="mb-3 filled w-100">
                                        <i data-cs-icon="tag"></i>
                                        <input id="tagsFilled" placeholder="Tags"/>
                                    </div> --}}
                                    {{-- <div class="mb-3 filled">
                                        <i data-cs-icon="calendar"></i>
                                        <input type="text" class="form-control" placeholder="Date"
                                               id="datePickerFilled"/>
                                    </div> --}}

                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </form>
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
