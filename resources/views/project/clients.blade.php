@php
    $html_tag_data = ["scrollspy"=>"true"];
    $title = 'Clients';
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


                            <a href="/client-form"><button type="button" class="btn btn-outline-primary btn-icon btn-icon-end w-100 w-sm-auto"
                                    id="dashboardTourButton">
                                    <i data-cs-icon="plus"></i>
                                <span>Add Client</span>
                            </button></a>

                        </div>
                        {{--  --}}
                        </div>
                    </section>

                    <!-- Hoverable Rows Start -->
                    <section class="scroll-section" id="hoverableRows">
                        {{-- <h2 class="small-title">List of Clients</h2> --}}
                        <div class="card mb-5">
                            <div class="card-body">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Client ID</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Registration Date</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $i=1; ?>
                                    <tr>

                                        @foreach ($clients as $data)


                                        <th scope="row"><?php echo $i++; ?></th>
                                        <td>{{$data['client_id'] ?? null}}</td>
                                        <td>{{$data['name'] ?? null}}</td>
                                        <td>{{$data['phone_number'] ?? null}}</td>
                                        <td>{{$data['email'] ?? null}}</td>
                                        <td>{{ Carbon\Carbon::parse($data['created_at'])->format('D, d-m-Y ') }}</td>
                                        <td><a href="">Edit</a></td>

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
