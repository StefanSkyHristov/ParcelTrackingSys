<x-admin-master>
    @section('title', 'Add new Branch')
    @section('content')
        <div class="col-md-12">
            <div class="row">
                @if (session()->has('created_message'))
                    <div class="alert alert-success">{{session('created_message')}}</div>
                @endif
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5>Create Branch</h5>
                </div>

                @foreach ($errors->all() as $error)
                {{ $error }}
                @endforeach

                <form action="{{route('branch.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <label for="name">Branch Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-4">
                                <label for="address">Branch Address</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>

                            <div class="col-4 mx-auto">
                                <label for="email">Email address</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>

                            <div class="col-4">
                                <label for="contact">Branch contact</label>
                                <input type="text" name="contact" id="contact" class="form-control">
                            </div>

                            <div class="col-4 mt-3">
                                <label for="city">Branch City</label>
                                <input type="text" name="city" id="city" class="form-control">
                            </div>

                            <div class="col-4 mt-3">
                                <label for="city">Branch Country</label>
                                <input type="text" name="country" id="country" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row mx-auto">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
