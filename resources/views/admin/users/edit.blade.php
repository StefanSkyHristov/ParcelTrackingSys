<x-admin-master>
    @section('title', 'Edit user details')
    @section('content')

    @if (Session::has('updated_message'))
        <div class="alert alert-success">{{Session::get('updated_message')}}</div>
    @endif
        <div class="col-md-12">
            <form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mx-2">
                    <div class="col-md-3">
                        @if (!$user->avatar)
                            <img src="{{asset('storage/images/avatar.png')}}" alt="" class="img-thumbnail rounded-circle">
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
    @endsection
</x-admin-master>
