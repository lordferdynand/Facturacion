<div class="container">
    <h1>Listado de Clientes</h1>
    <button class="btn btn-success" onclick="agregar_cliente()"><i class="glyphicon gliphycon-plus"></i>Agregar Cliente </button>
    <br />
    <br />
    <table id="table_id" class="table table-stripe table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Primer Nombre</th>
                <th>Segundo Nombre</th>
                <th>Direccion</th>
                <th>Nit</th>
                <th style="width:125px;">Action </p></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente){?>
            <tr>
                <td><?php echo $cliente->id;?></td>
                <td><?php echo $cliente->primernombre;?></td>
                <td><?php echo $cliente->segundonombre;?></td>
                <td><?php echo $cliente->direccion;?></td>
                <td><?php echo $cliente->nit;?></td>
                <td>
                    <button class="btn btn-warning" onclick="modificar_cliente(<?php echo $cliente->id; ?>)"><i class="glyphicon glyphicon-pencil"></i> </button>
                    <button class="btn btn-warning" onclick="eliminar_cliente(<?php echo $cliente->id; ?>)"><i class="glyphicon glyphicon-remove"></i> </button>
                </td>
            </tr>
            <?php } ?>

        </tbody>
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Primer Nombre</th>
                <th>Segundo Nombre</th>
                <th>Direccion</th>
                <th>Nit</th>
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
                    <h3 class="modal-title">Ingreso de Clientes</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="form_cliente" class="form-horizontal">
                        <input type="hidden" value="" name="cliente_id"/>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Primer Nombre</label>
                                <div class="col-md-9">
                                    <input name="primernombre" placeholder="Primer Nombre" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Segundo Nombre</label>
                                <div class="col-md-9">
                                    <input name="segundonombre" placeholder="Segundo Nombre" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Direccion</label>
                                <div class="col-md-9">
                                    <input name="direccion" placeholder="Direccion" class="form-control" type="text">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Nit</label>
                                <div class="col-md-9">
                                    <input name="nit" placeholder="Nit" class="form-control" type="text">

                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

</div>