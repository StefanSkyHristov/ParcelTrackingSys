<form action="{{route('parcel.destroy', $parcel->id)}}" method="post">
    @csrf
    @method('DELETE')

    <div class="modal fade" id="deleteModal{{$parcel->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Delete parcel: {{$parcel->tracking_number}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <label id="status_label" for="status_selection">Are you sure you want to delete this parcel?</label>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Yes</button>
            </div>
        </div>
        </div>
    </div>
</form>
