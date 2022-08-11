$(function() {
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var itemId = button.data('item-id') // Extract info from data-* attributes
        var itemName = button.data('item-name') // Extract info from data-* attributes

        $('#itemNameToBeDeletedText').text(itemName);
        $('#itemNameToBeDeleted').val(itemName);
        $('#itemIdToBeDeleted').val(itemId);
    })

})
