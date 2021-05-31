<!-- Modal -->
<form action="{{route('parcel.updateStatus', $parcel->id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="modal fade" id="exampleModalCenter{{$parcel->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Update parcel: {{$parcel->tracking_number}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <label id="status_label" for="status_selection">Choose status</label>
                <select id="status_description" name="status_description" class="form-control">
                    <option selected>{{$parcel->status_description}}</option>
                    <option>Collected by Courrier</option>
                    <option>Shipped to Branch</option>
                    <option>Collected from Branch</option>
                    <option>Shipped to Address</option>
                    <option>Failed Delivery</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </div>
</form>
