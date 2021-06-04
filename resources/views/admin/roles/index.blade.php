<x-admin-master>
    @section('title', 'All Current Roles')
    @section('content')

    @if (Session::has('deleted_message'))
            <div class="alert alert-success">{{Session::get('deleted_message')}}</div>
    @elseif (Session::has('created_message'))
            <div class="alert alert-success">{{Session::get('created_message')}}</div>
    @endif

    <div class="col-sm-3">
        <div class="row">
            <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="role">Role Name</label>
                    <input type="text" name="role" id="role" class="form-control">
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
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td><a href="{{route('roles.edit', $role->id)}}">{{$role->name}}</a></td>
                                    <td>{{$role->slug}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteRoleModal{{$role->id}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @include('admin.roles.deleteRoleModal')
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
