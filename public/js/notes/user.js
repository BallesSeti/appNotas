// columnas.js
console.log("Cargando user.js");
function dameColumnas() {
    return [
        { "data": "title" },
        { "data": "content" },
        { "data": "time" },
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
