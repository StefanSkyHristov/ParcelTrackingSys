<x-admin-master>
    @section('title', 'View All Branches')
    @section('content')

    <div class="card-body">
        <div class="card shadow">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Branch name</th>
                            <th>Branch Address</th>
                            <th>Branch Email</th>
                            <th>Branch Contact</th>
                            <th>Branch Country</th>
                            <th>Branch City</th>
                            <th>Delete Branch</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($branches as $branch)
                            <tr>
                                <td><a href="{{route('branch.edit', $branch->id)}}">{{$branch->name}}</a></td>
                                <td>{{$branch->address}}</td>
                                <td>{{$branch->email}}</td>
                                <td>{{$branch->contact}}</td>
                                <td>{{$branch->country}}</td>
                                <td>{{$branch->city}}</td>
                                <td>
                                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$branch->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    @include('branch.deleteModal')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Branch name</th>
                            <th>Branch Address</th>
                            <th>Branch Email</th>
                            <th>Branch Contact</th>
                            <th>Branch Country</th>
                            <th>Branch City</th>
                            <th>Delete Branch</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="d-flex">
            <div class="mx-auto">
                {{$branches->links()}}
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
