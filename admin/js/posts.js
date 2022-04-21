// DataTables
$(document).ready(function() {
    $('#posts').DataTable( {
        responsive: true,
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrando _MENU_ registros",
            paginate: {
                first:      "Primera",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "&Uacuteltima"
            },
            info:"Mostrando de _START_ a _END_ de _TOTAL_ elementos",
            infoFiltered:"(filtrado de _MAX_ entradas en total)",
        },
        "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
    });
} );
