<x-admin-master>
    @section('title', 'View all User accounts')
    @section('content')

    @if (Session::has('deleted_message'))
        <div class="alert alert-success">{{Session::get('deleted_message')}}</div>
    @endif

    <div class="card-body">
        <div class="card shadow">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User Email</th>
                            <th>User Avatar</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <td>
                                   <img src="{{$user->avatar}}" alt="" width="60px" height="60px">
                                </td>
                                <td>{{$user->created_at->diffForHumans()}}</td>
                                <td>{{$user->updated_at->diffForHumans()}}</td>
                                <td>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal{{$user->id}}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @include('admin.users.deleteUserModal')
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>User Email</th>
                            <th>User Avatar</th>
                            <th>Created On</th>
                            <th>Updated On</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="d-flex">
            <div class="mx-auto">
                {{$users->links()}}
            </div>
        </div>
    </div>
    @endsection
</x-admin-master>
