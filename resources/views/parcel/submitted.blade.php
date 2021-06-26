<x-admin-master>
    @section('content')
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
                            <th>Last updated</th>
                            <th>Update Parcel Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($submittedParcels as $parcel)
                            <tr>
                                <td><a href="{{route('parcel.edit', $parcel->id)}}">{{$parcel->tracking_number}}</a></td>
                                <td>{{$parcel->sender_address}}</td>
                                <td>{{$parcel->recipient_address}}</td>
                                <td>{{$parcel->sender_contact}}</td>
                                <td>{{$parcel->recipient_contact}}</td>
                                <td>{{$parcel->status_description}}</td>
                                <td>{{$parcel->updated_by}}</td>
                                <td>{{$parcel->updated_at->diffForHumans()}}</td>
                                <td>
                                    <div class="d-flex">
                                            <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter{{$parcel->id}}">
                                            <i class="fa fa-pen"></i>
                                        </button>
                                        @include('parcel.parcelModal')

                                        @can('delete',Auth::user())
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$parcel->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @include('parcel.deleteModal')
                                        @endcan
                                    </div>
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
                            <th>Last updated</th>
                            <th>Update Parcel Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="d-flex">
            <div class="mx-auto">
                {{$submittedParcels->links()}}
            </div>
        </div>
    </div>

    @endsection

    @yield('scripts')
</x-admin-master>
