$(document).ready(function(){

    var url = $('meta[name="data-url"]').attr('content');

    var table = $('#myTable').DataTable({
        "ajax": {
            "url": url,
            "type": "GET"
        },
        "columns": [ // Definir explícitamente las columnas
            {"data": "title"}, // Columna de título
            {"data": "content"} // Columna de contenido
        ]
    });
});
