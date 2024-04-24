console.log("cargado index");

//import {dameColumnas} from "../user/user"; Una forma
/*
import {dameColumnas} from "../user/user";
import dameColumnasNotes from "../notes/notas";
*/

$(document).ready(function() {

    var url = document.getElementById('data').dataset.url;

    $('.tabla').DataTable({
        "paging": true, // Habilitar paginación
        "processing": true,
        "serverSide": true, // Habilitar el modo de procesamiento del lado del servidor
        "ajax": {
            url: url,
            type: 'GET',
            data: function (d) {
                // Aquí se obtiene el valor de los campos de búsqueda dentro del contenedor de filtros
                d.search = {
                    title: $('#searchField_1_note').val(), // Valor de búsqueda para el título
                    content: $('#searchField_2_note').val(), // Valor de búsqueda para el contenido
                    time: $('#searchField_3_note').val(), // Valor de búsqueda para la fecha
                    name: $('#searchField_1_user').val(), // Valor de búsqueda para la fecha
                    lastName: $('#searchField_2_user').val(), // Valor de búsqueda para la fecha
                    email: $('#searchField_3_user').val(), // Valor de búsqueda para la fecha
                    birthday : $('#searchField_4_user').val(), // Valor de búsqueda para la fecha
                };
            }
        },
        "columns": dameColumnas(),
        "searching": false, // Habilitar la funcionalidad de búsqueda
        "lengthChange": true, // Desactivar la opción de cambiar la cantidad de entradas mostradas
        "language": {
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
            "infoFiltered": "(filtrado de _MAX_ entradas totales)"
        }
    });
});
