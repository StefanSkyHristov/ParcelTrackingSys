<x-admin-master>
    @section('title', 'Create a Parcel')
    @section('content')

        <div class="col-md-12">
            <div class="row">
                @if (session()->has('created_message'))
                    <div class="alert alert-success">{{session('created_message')}}</div>
                @endif
            </div>
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5>Fill out Parcel details</h5>
                </div>

               @foreach ($errors->all() as $error)
                {{ $error }}
               @endforeach
                <form action="{{route('parcel.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <label for="Sender_name">Sender name</label>
                                <input type="text" name="sender_name" id="sender_name" class="form-control">
                            </div>

                            <div class="col-4 mx-auto">
                                <label for="Recipient_name">Recipient name</label>
                                <input type="text" name="recipient_name" id="recipient_name" class="form-control">
                            </div>

                            <div class="col-6 mt-3">
                                <label for="Sender_address">Sender Address</label>
                                <input type="text" name="sender_address" id="sender_address" class="form-control">
                            </div>

                            <div class="col-6 mt-3">
                                <label for="Recipient_address">Recipient Address</label>
                                <input type="text" name="recipient_address" id="recipient_address" class="form-control">
                            </div>

                            <div class="col-6 mt-3">
                                <label for="Sender_contact">Sender contact</label>
                                <input type="text" name="sender_contact" id="sender_contact" class="form-control">
                            </div>

                            <div class="col-6 mt-3">
                                <label for="Recipient_contact">Recipient contact</label>
                                <input type="text" name="recipient_contact" id="recipient_contact" class="form-control">
                            </div>

                            <div class="col-md-3 mt-3">
                                <label for="deliveryType">Delivery Type</label>
                                <br>
                                <input type="checkbox" class="toggle-class" data-on="To Address" data-off="To Branch" id="delivery_type" name="delivery_type" data-onstyle="primary" data-offstyle="danger" data-toggle="toggle">
                                {{-- <select id="delivery_type" name="delivery_type" class="form-control">
                                  <option selected>Deliver to Branch</option>
                                  <option>Deliver to Address</option>
                                </select> --}}
                            </div>

                            <div class="col-6 mt-3 ml-auto">
                                <label id="branch_label" for="branch_selection">Select branch to deliver to</label>
                                <select id="branch_selection" name="branch_selection" class="form-control">
                                  <option selected>Select Branch</option>
                                  @foreach ($branches as $branch)
                                      <option value="{{$branch->id}}">{{$branch->name.",".$branch->address}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3 mt-3">
                                <label for="Parcel_weight">Parcel weight</label>
                                <input type="number" name="weight" id="weight" class="form-control">
                            </div>

                            <div class="col-3 mt-3">
                                <label for="Parcel_height">Parcel height</label>
                                <input type="number" name="height" id="height" class="form-control">
                            </div>

                            <div class="col-3 mt-3">
                                <label for="Parcel_width">Parcel width</label>
                                <input type="number" name="width" id="width" class="form-control">
                            </div>

                            <div class="col-3 mt-3">
                                <label for="Parcel_length">Parcel length</label>
                                <input type="number" name="length" id="length" class="form-control">
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    @endsection

</x-admin-master>

<script>
    $(document).ready(function() {

    $(".toggle-class").change(function() {
        // var status = $(this).prop('checked') == true ? 'To Address' : 'To Branch';
        $( "#branch_selection" ).toggle();
        $( "#branch_label" ).toggle();
    });

});
</script>

<script src="https://maps.google.com/maps/api/js?key=AIzaSyC0iKILlW7TW8aoJobwWnFiPeXExfjZjN8&libraries=places&callback=initialize" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
        });
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var senderAddress = document.getElementById('sender_address');
            var autocomplete = new google.maps.places.Autocomplete(senderAddress);

            var recipientAddress = document.getElementById('recipient_address');
            var recipientAutocomplete = new google.maps.places.Autocomplete(recipientAddress);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());
                // --------- show lat and long ---------------
                $("#lat_area").removeClass("d-none");
                $("#long_area").removeClass("d-none");
            });

            recipientAutocomplete.addDomListener('place_changed', function() {
                var recipientPlace = recipientAutocomplete.getPlace();
            });
        }
    </script>
