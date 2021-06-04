<x-admin-master>
    @section('title', 'View permissions')
    @section('content')

    @if (Session::has('deleted_message'))
            <div class="alert alert-success">{{Session::get('deleted_message')}}</div>
    @elseif (Session::has('created_message'))
            <div class="alert alert-success">{{Session::get('created_message')}}</div>
    @endif

    <div class="col-sm-3">
        <div class="row">
            <form action="{{route('permissions.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="permission">Permission Name</label>
                    <input type="text" name="permission" id="permission" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="card-body">
            <div class="card shadow">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Update Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->slug}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deletePermissionModal{{$permission->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @include('admin.permissions.deletePermissionModal')
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Update Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-admin-master>
