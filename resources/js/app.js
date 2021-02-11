require('./bootstrap');

$('#datatables').DataTable({
    stateSave: true,
});
$('#input-category').select2({ tags: true });
$('#input-district').select2({ tags: true });
