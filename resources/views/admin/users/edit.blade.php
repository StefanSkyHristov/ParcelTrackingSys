<x-admin-master>
    @section('title', 'Edit user details')
    @section('content')

    @if (Session::has('updated_message'))
        <div class="alert alert-success">{{Session::get('updated_message')}}</div>
    @endif
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
        <div class="col-md-12">
            <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mx-2">
                    <div class="col-md-3">
                        @if ($user->avatar == null)
                            <div class="image">
                                <img src="{{asset('storage/images/AdminLTELogo.png')}}" alt="" class="img-thumbnail rounded-circle">
                            </div>
                        @else
                            <div class="image">
                                <img src="{{$user->avatar}}" alt="" class="img-thumbnail rounded-circle">
                            </div>
                        @endif
                        <input type="file" name="avatar" id="avatar">
                    </div>
                    <div class="col-md-9">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <div class="col-lg-6">
                                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <div class="col-lg-6">
                                    <input type="text" name="username" id="username" value="{{$user->username}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="col-lg-6">
                                    <input type="text" name="email" id="email" value="{{$user->email}}" class="form-control">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row mx-auto">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>

        @if (Auth::user()->hasRole('Administrator'))
            <div class="card-body">
                <div class="card shadow">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>
                                            <input type="checkbox"
                                            @foreach ($user->roles as $userRole)
                                                @if ($userRole->slug == $role->slug)
                                                    checked
                                                    disabled
                                                @endif
                                            @endforeach>
                                        </td>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            <form action="{{route('users.attach', $user->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="role" id="role" value="{{$role->id}}">
                                                <button type="submit" class="btn btn-primary"
                                                @if ($user->roles->contains($role))
                                                    disabled
                                                @endif>Attach</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('users.detach', $user->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="role" id="role" value="{{$role->id}}">
                                                <button type="submit" class="btn btn-danger"
                                                @if (!$user->roles->contains($role))
                                                    disabled
                                                @endif>Detach</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Status</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    @endsection
</x-admin-master>
