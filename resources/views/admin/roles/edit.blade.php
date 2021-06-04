<x-admin-master>
    @section('title', 'Edit Role Permissions')
    @section('content')

    <div class="col-sm-3">
        <div class="row">
            <div class="form-group">
                <label for="roleName">Name</label>
                <input type="text" name="role" id="role" value="{{$role->name}}" class="form-control">
            </div>
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
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td>{{$permission->slug}}</td>
                                    <td>
                                        <input type="checkbox" name="permission" id="permission"
                                        @foreach ($role->permissions as $rolePermission)
                                            @if ($rolePermission->name == $permission->name)
                                                checked
                                            @endif
                                        @endforeach>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-admin-master>
