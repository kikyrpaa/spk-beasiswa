<div id="deleteModal" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong><span id="itemNameToBeDeletedText"></span></strong>?
            </div>
            <div class="modal-footer">
                <form action="{{ $deleteUrl }}" method="POST">
                    {{ csrf_field() }}
                    <input id="itemIdToBeDeleted" type="hidden" name="id"/>
                    <input id="itemNameToBeDeleted" type="hidden" name="name"/>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                </form>
            </div>
        </div>
    </div>
</div>
