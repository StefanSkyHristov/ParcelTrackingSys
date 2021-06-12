<x-admin-master>
    @section('title', 'Edit Branch Information')
    @section('content')

    @if (Session::has('updated_message'))
        <div class="alert alert-success">{{Session::get('updated_message')}}</div>
    @endif

    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
        <form action="{{route('branch.update', $branch->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <label for="name">Branch Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$branch->name}}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-4">
                        <label for="address">Branch Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{$branch->address}}">
                    </div>

                    <div class="col-4 mx-auto">
                        <label for="email">Email address</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{$branch->email}}">
                    </div>

                    <div class="col-4">
                        <label for="contact">Branch contact</label>
                        <input type="text" name="contact" id="contact" class="form-control" value="{{$branch->contact}}">
                    </div>

                    <div class="col-4 mt-3">
                        <label for="city">Branch City</label>
                        <input type="text" name="city" id="city" class="form-control" value="{{$branch->city}}">
                    </div>

                    <div class="col-4 mt-3">
                        <label for="city">Branch Country</label>
                        <input type="text" name="country" id="country" class="form-control" value="{{$branch->country}}">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row mx-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    @endsection
</x-admin-master>
