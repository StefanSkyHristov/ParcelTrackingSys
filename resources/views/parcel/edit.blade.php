<x-admin-master>
    @section('title', 'Edit Parcel details: '.$parcel->tracking_number)
    @section('content')

    <form action="{{route('parcel.update', $parcel->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <label for="Sender_name">Sender name</label>
                    <input type="text" name="sender_name" id="sender_name" class="form-control" value="{{$parcel->sender_name}}">
                </div>

                <div class="col-4 mx-auto">
                    <label for="Recipient_name">Recipient name</label>
                    <input type="text" name="recipient_name" id="recipient_name" class="form-control" value="{{$parcel->recipient_name}}">
                </div>

                <div class="col-6 mt-3">
                    <label for="Sender_address">Sender Address</label>
                    <input type="text" name="sender_address" id="sender_address" class="form-control" value="{{$parcel->sender_address}}">
                </div>

                <div class="col-6 mt-3">
                    <label for="Recipient_address">Recipient Address</label>
                    <input type="text" name="recipient_address" id="recipient_address" class="form-control" value="{{$parcel->recipient_address}}">
                </div>

                <div class="col-6 mt-3">
                    <label for="Sender_contact">Sender contact</label>
                    <input type="text" name="sender_contact" id="sender_contact" class="form-control" value="{{$parcel->sender_contact}}">
                </div>

                <div class="col-6 mt-3">
                    <label for="Recipient_contact">Recipient contact</label>
                    <input type="text" name="recipient_contact" id="recipient_contact" class="form-control" value="{{$parcel->recipient_contact}}">
                </div>

                <div class="col-md-3 mt-3">
                    <label for="deliveryType">Delivery Type</label>
                    <br>
                    <input type="checkbox" class="toggle-class" data-on="To Address" data-off="To Branch" id="delivery_type" name="delivery_type" data-onstyle="primary" data-offstyle="danger" data-toggle="toggle"
                    @if($parcel->delivery_type == 1) checked @endif>
                </div>

                <div class="col-6 mt-3 ml-auto">
                    <label id="branch_label" for="branch_selection">Select branch to deliver to</label>
                    <select id="branch_selection" name="branch_selection" class="form-control">
                      <option selected value="{{$parcel->branch_id}}">@if($parcel->branch_id == 0) None @else {{$parcel->branches->name.",".$parcel->branches->address}} @endif
                      </option>
                      @foreach ($branches as $branch)
                          <option value="{{$branch->id}}">{{$branch->name.",".$branch->address}}</option>
                      @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-3 mt-3">
                    <label for="Parcel_weight">Parcel weight</label>
                    <input type="number" name="weight" id="weight" class="form-control" value="{{$parcel->weight}}">
                </div>

                <div class="col-3 mt-3">
                    <label for="Parcel_height">Parcel height</label>
                    <input type="number" name="height" id="height" class="form-control" value="{{$parcel->height}}">
                </div>

                <div class="col-3 mt-3">
                    <label for="Parcel_width">Parcel width</label>
                    <input type="number" name="width" id="width" class="form-control" value="{{$parcel->width}}">
                </div>

                <div class="col-3 mt-3">
                    <label for="Parcel_length">Parcel length</label>
                    <input type="number" name="length" id="length" class="form-control" value="{{$parcel->length}}">
                </div>

            </div>

            <div class="card-footer">
                <div class="row">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
    @endsection
</x-admin-master>

<script>
        // var status = $(this).prop('checked') == true ? 'To Address' : 'To Branch';
        // If toggle button has initially been set to "To Address", show as such.
        if({{$parcel->delivery_type == 1}})
        {
            $( "#branch_selection" ).toggle();
            $( "#branch_label" ).toggle();
        }
</script>

<script>
    $(document).ready(function() {
            $(".toggle-class").change(function() {
                // var status = $(this).prop('checked') == true ? 'To Address' : 'To Branch';
                $( "#branch_selection" ).toggle();
                $( "#branch_label" ).toggle();
            });
        });
</script>
