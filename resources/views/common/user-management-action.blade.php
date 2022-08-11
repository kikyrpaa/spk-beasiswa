<button type="button" class="btn btn-dark" title="Change Password" data-toggle="modal" data-target="#changePasswordOtherUserModal"
    data-item-name="{{ $itemName }}" data-item-id="{{ $itemId }}">
    <span class="ul-btn__icon">
    <i class="nav-icon i-Lock-2 "></i>
    </span>
</button>
@include('common.edit-delete-action',[ 'itemId' => $itemId, 'itemName' => $itemName, 'editUrl' => $editUrl])

<div id="changePasswordOtherUserModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="changePasswordOtherUserModal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ $changePasswordUrl }}" method="POST">

                <div class="modal-body">
                    {{ csrf_field() }}
                    <label>Please type new password for user <strong><span id="itemNameText"></span></strong> below:</label>
                    <br/>
                    <label for="newPassword" class="col-sm-6 col-form-label">New Password:</label>
                    <div class="col-sm-12">
                        <input id="newPassword" type="password" class="form-control" name="new_password"
                                placeholder="New Password" required>
                    </div>
                    <label for="retypeNewPassword" class="col-sm-6 col-form-label">Retype New Password:</label>
                    <div class="col-sm-12">
                        <input id="retypeNewPassword" type="password" class="form-control" name="retype_new_password"
                                placeholder="Retype New Password" required>
                    </div>
                </div>
                <div class="modal-footer">
                        <input id="itemId" type="hidden" name="id"/>
                        <input id="itemName" type="hidden" name="name"/>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">

$(function() {
    console.log('asasas');
    $('#changePasswordOtherUserModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var itemId = button.data('item-id') // Extract info from data-* attributes
        var itemName = button.data('item-name') // Extract info from data-* attributes

        $('#itemNameText').text(itemName);
        $('#itemName').val(itemName);
        $('#itemId').val(itemId);
    })

})

</script>
