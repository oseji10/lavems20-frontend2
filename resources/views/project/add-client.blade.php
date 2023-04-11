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

                    <a href="/clients"><button type="button"
                            class="btn btn-outline-primary btn-icon btn-icon-end w-100 w-sm-auto"
                            id="dashboardTourButton">
                            <i data-cs-icon="arrow-long-left"></i>
                            <span>Back To Clients</span>
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
                <input class="form-control" type="text" placeholder="Fullname" name="name" required />
            </div>

            <div class="mb-3 filled">
                <i data-cs-icon="phone"></i>
                <input class="form-control" type="text" placeholder="Phone Number" name="phone_number" required />
            </div>

            <div class="mb-3 filled">
                <i data-cs-icon="send"></i>
                <input class="form-control" placeholder="Email" name="email" required />
            </div>

            <div class="mb-3 filled">
                <textarea name="contact_address" placeholder="Contact Address" class="form-control" rows="2"
                    required></textarea>
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
                <select class="form-control" id="select2Filled2" data-placeholder="State Of Residence"
                    name="state_of_residence" required>
                    <option label="State of Residence"></option>
                    <option value="" selected="selected">- Select -</option>
                    <option value="FCT-Abuja">FCT-Abuja</option>
                    <option value="Abia">Abia</option>
                    <option value="Adamawa">Adamawa</option>
                    <option value="Akwa Ibom">Akwa Ibom</option>
                    <option value="Anambra">Anambra</option>
                    <option value="Bauchi">Bauchi</option>
                    <option value="Bayelsa">Bayelsa</option>
                    <option value="Benue">Benue</option>
                    <option value="Borno">Borno</option>
                    <option value="Cross River">Cross River</option>
                    <option value="Delta">Delta</option>
                    <option value="Ebonyi">Ebonyi</option>
                    <option value="Edo">Edo</option>
                    <option value="Ekiti">Ekiti</option>
                    <option value="Enugu">Enugu</option>
                    <option value="Gombe">Gombe</option>
                    <option value="Imo">Imo</option>
                    <option value="Jigawa">Jigawa</option>
                    <option value="Kaduna">Kaduna</option>
                    <option value="Kano">Kano</option>
                    <option value="Katsina">Katsina</option>
                    <option value="Kebbi">Kebbi</option>
                    <option value="Kogi">Kogi</option>
                    <option value="Kwara">Kwara</option>
                    <option value="Lagos">Lagos</option>
                    <option value="Nassarawa">Nassarawa</option>
                    <option value="Niger">Niger</option>
                    <option value="Ogun">Ogun</option>
                    <option value="Ondo">Ondo</option>
                    <option value="Osun">Osun</option>
                    <option value="Oyo">Oyo</option>
                    <option value="Plateau">Plateau</option>
                    <option value="Rivers">Rivers</option>
                    <option value="Sokoto">Sokoto</option>
                    <option value="Taraba">Taraba</option>
                    <option value="Yobe">Yobe</option>
                    <option value="Zamfara">Zamfara</option>
                    <option value="Outside Nigeria">Outside Nigeria</option>
                </select>

                </select>
            </div>

            <div class="mb-3 filled w-100">
                <i data-cs-icon="archive"></i>
                <select class="form-control" id="select2Filled2" data-placeholder="Nature of Business"
                    name="nature_of_business" required>
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
                <select class="form-control" id="select2Filled2" data-placeholder="Referred By" name="referred_by"
                    required>
                    <option label="Referred By"></option>
                    <option value="NIRSAL Office Area 10">NIRSAL Office Area 10</option>
                    <option value="NIRSAL Office Kubwa">NIRSAL Office Kubwa</option>
                    <option value="NIRSAL Office Bwari">NIRSAL Office Bwari</option>
                    <option value="NIRSAL Office Kuje">NIRSAL Office Kuje</option>
                    <option value="I Came Myself">I Came Myself</option>
                    <option value="Others">Others</option>
                </select>
            </div>



            <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
</div>
</section>



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




<!-- Filled End -->

<!-- Horizontal Form End -->

</div>
<!-- Content End -->
</div>

</div>
</div>
@endsection
