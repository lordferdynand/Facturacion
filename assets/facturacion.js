$(document).ready(function () {
    $('#table_id').DataTable();

    });

var save_method;
var table;

function agregar_cliente(){
    save_method='add';
    $('#form_cliente')[0].reset();
    $('#modal_form').modal('show');
}

function modificar_cliente(id) {
    save_method="update";

    $("#form_cliente")[0].reset();

    $.ajax({
        url:"Cliente/ajax_edit/"+id,
        type:"GET",
        dataType:"JSON",
        success:function (data) {
            $('[name="cliente_id"]').val(data.id);
            $('[name="primernombre"]').val(data.primernombre);
            $('[name="segundonombre"]').val(data.segundonombre);
            $('[name="direccion"]').val(data.direccion);
            $('[name="nit"]').val(data.nit);

            $("#modal_form").modal("show");
            $(".modal-title").text("Editar Cliente");

        },
        error:function (jqXHR,textStatus,errorTrhown) {
            alert("Error al obtener Datos");
            
        }
    });

}

function save(){
    var url;

    if(save_method=='add'){
        url = "Cliente/grabar_cliente";
    } else {
        url = "Cliente/actualizar_cliente";
    }

    $.ajax({
        url:url,
        type:"POST",
        data:$('#form_cliente').serialize(),
        dataType:"JSON",
        success: function (datacliente) {
            $("#modal_form").modal("hide");
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al Ingresar o Actualizar Cliente');
        }

    });
}

function eliminar_cliente(id){

    if(confirm("¿Esta Seguro que desea eliminar el Cliente?")){
        $.ajax({
            url:"Cliente/eliminar_cliente/"+id,
            type:"POST",
            dataType:"JSON",
            success:function (data) {
                location.reload();
            },
            error:function (jqXHR,textStatus,errorThrown) {
                alert("Error al Eliminar Cliente");
            }

        });
    }
}


/*
* Producto
* */

function agregar_producto(){
    save_method='add';
    $('#form_producto')[0].reset();
    $('#modal_form').modal('show');
}

function modificar_producto(id) {
    save_method="update";

    $("#form_producto")[0].reset();

    $.ajax({
        url:"Producto/ajax_edit/"+id,
        type:"GET",
        dataType:"JSON",
        success:function (data) {
            $('[name="producto_id"]').val(data.id);
            $('[name="nombre"]').val(data.nombre);
            $('[name="precio"]').val(data.precio);
            $('[name="costo"]').val(data.costo);
            $('[name="observacion"]').val(data.observacion);

            $("#modal_form").modal("show");
            $(".modal-title").text("Editar Producto");

        },
        error:function (jqXHR,textStatus,errorTrhown) {
            alert("Error al obtener Datos");

        }
    });

}

function save_producto(){
    var url;

    if(save_method=='add'){
        url = "Producto/grabar_producto";
    } else {
        url = "Producto/actualizar_producto";
    }

    $.ajax({
        url:url,
        type:"POST",
        data:$('#form_producto').serialize(),
        dataType:"JSON",
        success: function (datacliente) {
            $("#modal_form").modal("hide");
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al Ingresar o Actualizar Cliente');
        }

    });
}

function eliminar_producto(id){

    if(confirm("¿Esta Seguro que desea eliminar el Producto?")){
        $.ajax({
            url:"Producto/eliminar_producto/"+id,
            type:"POST",
            dataType:"JSON",
            success:function (data) {
                location.reload();
            },
            error:function (jqXHR,textStatus,errorThrown) {
                alert("Error al Eliminar Producto");
            }

        });
    }
}

function loadFactura(){
    var q = $("#q").val();
    $("#loader").fadeIn('slow');

    $.ajax({

    })
}

function calculaImporte(){
    var cantidad = $("#cantidadprd").val();
    var precio = $("#precioprd").val();

    var importe = cantidad * precio;

    $("#totalprd").val(importe);
}

function grabaFactura() {
    grabaCabeceraFactura();
    var movimientoCab_id = $("#documentoCab_id").val();
    grabaDetalleFactura(movimientoCab_id);
}

function grabaCabeceraFactura(){
    var movimientoCab_id = $("#documentoCab_id").val();
    var cliente_id = $("#id_cliente").val();
    var fecha = $("#fechafac").val();
    var subtotal = 0;
    var iva = 0;
    var total = 0;
    var observacion = 666;
    var cabecera = [movimientoCab_id,cliente_id,fecha,subtotal,iva,total,observacion];

    $.ajax({
        url: "agregar_CabeceraFactura/",
        type:"POST",
        dataType:"JSON",
        data: {'array':JSON.stringify(cabecera)},
        success: function (data) {
            $("#documentoCab_id").val(data.id_cab);
            console.log('data es igual a :'+data.id_cab);
        }, error:function (jqXHR, textStatus, errorThrown) {
            alert("Ocurrio un error al insertar la cabecera");
        }
    });

    $('#myModalBuscarProductos').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input[type=text],textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
    })
}

function grabaDetalleFactura(){

    var movimientoCab_id = $("#documentoCab_id").val();
    var producto_id = $("#producto_id").val();
    var cantidad = $("#cantidadprd").val();
    var subtotal = 0;
    var total = $("#totalprd").val();


    var detalleFact = [movimientoCab_id,producto_id,cantidad,subtotal,total];
    $.ajax({
        url:"agregar_DetalleFactura/",
        type:"POST",
        data:{'arraydet':JSON.stringify(detalleFact)},
        dataType:"JSON",
        success: function (datadetalle) {
            $("#myModalBuscarProductos").modal("hide");

            $.ajax({
                url:"obtener_detalleFactura/"+movimientoCab_id,
                type:"POST",
                dataType:"JSON",
                success:function (dataDetalle) {
                    $('#table_id').find('tbody').children('tr').remove();
                    dataDetalle.forEach(function (t) {
                        var lnk = '<a href="'+window.location.host+'/Factura/eliminar_detalleFactura/'+t.id+'" data-id="'+t.id+'" onclick="test('+t.id+')"><i class="glyphicon glyphicon-remove"></i>';
                        var detail ='<tr></tr><td>'+t.producto_id+'</td>'+'<td>'+t.nombre+'</td>'+'<td>'+t.precio+'</td>'+'<td>'+t.cantidad+'</td>'+'<td>'+t.total+'</td>'+'<td>'+lnk+'</td>'+'</tr>';
                        $('#table_id').find('tbody').append(detail);
                    });
                }


            });

            //location.reload();

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error al Ingresar o Actualizar Cliente');
        }

    });
}

function test(id){

    var movimientoCab_id = $("#documentoCab_id").val();
    $.ajax({
        url:"eliminar_detalleFactura/"+id,
        type:"POST",
        dataType:"JSON",
        success:function (data) {
            $.ajax({
                url:"obtener_detalleFactura/"+movimientoCab_id,
                type:"POST",
                dataType:"JSON",
                success:function (dataDetalle) {
                    $('#table_id').find('tbody').children('tr').remove();
                    dataDetalle.forEach(function (t) {
                        var lnk = '<a href="'+window.location.host+'/Factura/eliminar_detalleFactura/'+t.id+'" data-id="'+t.id+'" onclick="test('+t.id+')"><i class="glyphicon glyphicon-remove"></i>';
                        var detail ='<tr></tr><td>'+t.producto_id+'</td>'+'<td>'+t.nombre+'</td>'+'<td>'+t.precio+'</td>'+'<td>'+t.cantidad+'</td>'+'<td>'+t.total+'</td>'+'<td>'+lnk+'</td>'+'</tr>';
                        $('#table_id').find('tbody').append(detail);
                    });
                }


            });

        }

    });
}



