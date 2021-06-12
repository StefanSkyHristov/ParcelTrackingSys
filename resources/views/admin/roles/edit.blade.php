<x-admin-master>
    @section('title', 'Edit Role Permissions')
    @section('content')

    @if (Session::has('status_updated'))
        <div class="alert alert-success">{{Session::get('status_updated')}}</div>
    @endif

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
                    <form action="{{route('roles.update', $role->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->slug}}</td>
                                        <td>
                                            <input type="checkbox" name="permissions[]" id="permissions" value="{{$permission->id}}"
                                            @if ($role->permissions->contains($permission))
                                                checked
                                                disabled
                                            @endif>
                                        </td>
                                        <td>
                                            <input type="checkbox" value="{{$permission->id}}" name="detachPermissions[]" id="detachPermissions"
                                            @if (!$role->permissions->contains($permission))
                                                checked
                                                disabled
                                            @endif>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </tfoot>
                        </table>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-admin-master>
