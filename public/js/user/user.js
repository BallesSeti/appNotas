// columnas.js
console.log("Cargando user.js");
function dameColumnas() {
    return [
        { "data": "name", "searchable": true },
        { "data": "lastName", "searchable": true },
        { "data": "email", "searchable": true },
        { "data": "birthday", "searchable": true },
        {
            "data": null,
            "render": function (data, type, row) {
                // Aquí se genera el HTML para los botones de editar y eliminar
                return '<button class="editBtn" data-id="' + data.id + '">Edit</button>' +
                    '<button class="deleteBtn" data-id="' + data.id + '">Delete</button>';
            }
        }
    ];
}
function refreshTable() {
    /*    $('#tableUsers').DataTable().ajax.reload();*/
    $('#tableUsers').DataTable().draw();
}

// Evento para aplicar los filtros en los campos de búsqueda
document.querySelectorAll('.searchField').forEach(function(input) {
    input.addEventListener('keyup', refreshTable);
    input.addEventListener('change', refreshTable);
});
/*
// Evento clic para el botón de editar
document.getElementById('tableUsers').addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('editBtn')) {
        var noteId = event.target.getAttribute('data-id');
        // Aquí puedes redirigir a la página de edición de la nota
        console.log(noteId);
        window.location.href = '/notas/' + noteId + '/editar';
    }
});

// Evento clic para el botón de eliminar
document.getElementById('tableUsers').addEventListener('click', function(event) {
    if (event.target && event.target.classList.contains('deleteBtn')) {
        var noteId = event.target.getAttribute('data-id');

        if (confirm('¿Estás seguro de que deseas eliminar esta nota?')) {
            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', '/notas/' + noteId);
            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log("Success: ", xhr.responseText);
                    document.getElementById('tableNotas').DataTable.ajax.reload();
                } else {
                    console.log("Error: ", xhr.statusText);
                    document.getElementById('tableNotas').DataTable.ajax.reload();
                }
            };
            xhr.send();
        }
    }
});
*/

window.dameColumnas = dameColumnas;

//export {dameColumnas}; Es una opcion
