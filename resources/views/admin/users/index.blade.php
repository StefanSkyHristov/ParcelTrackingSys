<x-admin-master>
    @section('title', 'View all User accounts')
    @section('content')

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
