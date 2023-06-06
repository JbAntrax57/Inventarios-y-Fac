$(document).ready(function(){
    // Envío del formulario
    $('#clientForm').submit(function(e){
        e.preventDefault();
        
        // Obtener los valores del formulario
        var documento = $('#documento').val();
        var nombres = $('#nombres').val();
        var apellidos = $('#apellidos').val();
        var direccion = $('#direccion').val();
        var telefono = $('#telefono').val();
        
        // Envío de los datos al servidor
        $.ajax({
            url: 'save_client.php',
            type: 'POST',
            data: {
                documento: documento,
                nombres: nombres,
                apellidos: apellidos,
                direccion: direccion,
                telefono: telefono
            },
            success: function(response){
                // Mostrar mensaje de éxito y limpiar formulario
                alert('Cliente agregado correctamente');
                $('#clientForm')[0].reset();
            },
            error: function(){
                // Mostrar mensaje de error
                alert('Error al agregar el cliente');
            }
        });
    });
});
