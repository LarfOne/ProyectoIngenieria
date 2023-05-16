$(document).ready(function () {
  $('#tabla').DataTable();
});

$('#tabla tbody').on('click', 'tr', function() {
  $('#tabla tbody tr.selected').removeClass('selected');
  $(this).addClass('selected');
});