<div class="container">
    <h1>Listado de Productos</h1>
    <button class="btn btn-success" onclick="agregar_producto()"><i class="glyphicon gliphycon-plus"></i>Agregar Producto </button>
    <br />
    <br />
    <table id="table_id" class="table table-stripe table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Costo</th>
                <th>Observacion</th>
                <th style="width:125px;">Action </p></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto){?>
            <tr>
                <td><?php echo $producto->id;?></td>
                <td><?php echo $producto->nombre;?></td>
                <td><?php echo $producto->precio;?></td>
                <td><?php echo $producto->costo;?></td>
                <td><?php echo $producto->observacion;?></td>
                <td>
                    <button class="btn btn-warning" onclick="modificar_producto(<?php echo $producto->id; ?>)"><i class="glyphicon glyphicon-pencil"></i> </button>
                    <button class="btn btn-warning" onclick="eliminar_producto(<?php echo $producto->id; ?>)"><i class="glyphicon glyphicon-remove"></i> </button>
                </td>
            </tr>
            <?php } ?>

        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Costo</th>
                <th>Observacion</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>


    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Ingreso de productos</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form_producto" class="form-horizontal">
                        <input type="hidden" value="" name="producto_id"/>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nombre Producto :</label>
                                <div class="col-md-9">
                                    <input name="nombre" placeholder="Nombre del Producto" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Precio :</label>
                                <div class="col-md-9">
                                    <input name="precio" placeholder="Precio del Prdocuto" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Costo :</label>
                                <div class="col-md-9">
                                    <input name="costo" placeholder="Costo" class="form-control" type="text">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Observacion : </label>
                                <div class="col-md-9">
                                    <input name="nit" placeholder="observacion" class="form-control" type="text">

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save_producto()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

</div>