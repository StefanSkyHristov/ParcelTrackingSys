<x-admin-master>
    @section('title', 'Track the progress of your Shipment')
    @section('content')

    @if (Session::has('not_found_message'))
        <div class="alert alert-danger">{{Session::get('not_found_message')}}</div>
    @endif
    <div class="container">
        <br/>
        <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <form action="{{route('parcel.progress')}}" method="POST" enctype="multipart/form-data" class="card card-sm">
                        @csrf
                        <div class="card-body row no-gutters align-items-center">
                            <div class="col-auto">
                                <i class="fas fa-search h4 text-body"></i>
                            </div>
                            <!--end of col-->
                            <div class="col">
                                <input class="form-control form-control-lg form-control-borderless" type="search" name="tracking_number" placeholder="Search topics or keywords">
                            </div>
                            <!--end of col-->
                            <div class="col-auto">
                                <button class="btn btn-lg btn-success" type="submit">Search</button>
                            </div>
                            <!--end of col-->
                        </div>
                    </form>
                </div>
                <!--end of col-->
            </div>
    </div>
    @endsection
</x-admin-master>
