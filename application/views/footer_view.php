
</body>
<script>

    $(document).ready(function () {

        $( "#nit" ).autocomplete({
            source: function( request, response ) {
                $.ajax( {
                    url: "findClienteByNit/",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                } );
            },
            minLength: 2,
            select: function( event, ui ) {
                //console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );
                $('#id_cliente').val(ui.item.id);
                $('#nombre_cliente').val(ui.item.primernombre);
                $('#nombre_cliente2').val(ui.item.segundonombre);
                $('#tel1').val(ui.item.telefono);
                $('#mail').val(ui.item.email);
                $('#direccion').val(ui.item.direccion);
                event.preventDefault();
            }
        } );


        $("#descripcion").autocomplete({
            source: function( request, response ) {
                $.ajax( {
                    url: "findProductByDesc/",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function( data ) {
                        response(data);
                    }
                } );
            },
            minLength: 2,
            select: function( event, ui ) {

                console.log( "Selected: " + ui.item.nombre + " aka " + ui.item.id );
                $("#producto_id").val(ui.item.id);
                $("#descripcion").val(ui.item.nombre);
                $("#precioprd").val(ui.item.precio);
            }
        } );


        /*$("#descripcion").autocomplete({
           source:availableTags
        });*/

    });
</script>
</html>