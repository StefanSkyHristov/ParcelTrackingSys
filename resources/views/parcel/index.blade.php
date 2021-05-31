<x-admin-master>
    @section('content')
    @if (Session::has('updated_status_message'))
        <div class="alert alert-success">{{Session::get('updated_status_message')}}</div>
    @elseif (Session::has('updated_message'))
        <div class="alert alert-success">{{Session::get('updated_message')}}</div>
    @endif
    <div class="card-body">
        <div class="card shadow">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Parcel Num</th>
                            <th>From Location</th>
                            <th>To Location</th>
                            <th>Sender Contact</th>
                            <th>Recipient Contact</th>
                            <th>Status</th>
                            <th>Updated By</th>
                            <th>Update Parcel Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parcels as $parcel)
                            <tr>
                                <td><a href="{{route('parcel.edit', $parcel->id)}}">{{$parcel->tracking_number}}</a></td>
                                <td>{{$parcel->sender_address}}</td>
                                <td>{{$parcel->recipient_address}}</td>
                                <td>{{$parcel->sender_contact}}</td>
                                <td>{{$parcel->recipient_contact}}</td>
                                <td>{{$parcel->status_description}}</td>
                                <td>{{$parcel->updated_by}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$parcel->id}}">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    @include('parcel.parcelModal')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Parcel Num</th>
                            <th>From Location</th>
                            <th>To Location</th>
                            <th>Sender Contact</th>
                            <th>Recipient Contact</th>
                            <th>Status</th>
                            <th>Updated By</th>
                            <th>Update Parcel Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="d-flex">
            <div class="mx-auto">
                {{$parcels->links()}}
            </div>
        </div>
    </div>
    @endsection
</x-admin-master>

@section('scripts')
    <!-- DataTables -->
    <script>
        $(document).ready(function() {
        $('#example').DataTable();
        } );
    </script>
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
@endsection
