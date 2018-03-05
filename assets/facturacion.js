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

function agregar_factura(){

}

