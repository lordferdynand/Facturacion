<div class="container">
    <form class="form-horizontal" role="form" id="datos_factura">
        <div class="form-group row">
            <label for="nit" class="col-md-1 control-label">Nit</label>
            <div class="col-md-3">
                <input type="text" class="form-control input-sm" id="nit" placeholder="Seleccione un Nit" required>
                <input id="id_cliente" type='hidden'>
            </div>
            <label for="tel1" class="col-md-1 control-label">Teléfono</label>
            <div class="col-md-2">
                <input type="text" class="form-control input-sm" id="tel1" placeholder="Teléfono" readonly>
            </div>
            <label for="mail" class="col-md-1 control-label">Email</label>
            <div class="col-md-3">
                <input type="text" class="form-control input-sm" id="mail" placeholder="Email" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="nombre_cliente" class="col-md-1 control-label">Cliente</label>
            <div class="col-md-3">
                <input type="text" class="form-control input-sm" id="nombre_cliente" placeholder="Selecciona un cliente" readonly>
                <input id="id_cliente" type='hidden'>
            </div>
            <label for="nombre_cliente" class="col-md-1 control-label">nombre2</label>
            <div class="col-md-2">
                <input type="text" class="form-control input-sm" id="nombre_cliente2" placeholder="Nombre2" readonly>
            </div>
            <label for="direccion" class="col-md-1 control-label">Direccion</label>
            <div class="col-md-3">
                <input type="text" class="form-control input-sm" id="direccion" placeholder="direccion" readonly>
            </div>
        </div>

        <div class="form-group row">
            <label for="empresa" class="col-md-1 control-label">Vendedor</label>
            <div class="col-md-3">
                <select class="form-control input-sm" id="id_vendedor">
                    <?php
                    $sql_vendedor=mysqli_query($con,"select * from users order by lastname");
                    while ($rw=mysqli_fetch_array($sql_vendedor)){
                        $id_vendedor=$rw["user_id"];
                        $nombre_vendedor=$rw["firstname"]." ".$rw["lastname"];
                        if ($id_vendedor==$_SESSION['user_id']){
                            $selected="selected";
                        } else {
                            $selected="";
                        }
                        ?>
                        <option value="<?php echo $id_vendedor?>" <?php echo $selected;?>><?php echo $nombre_vendedor?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <label for="tel2" class="col-md-1 control-label">Fecha</label>
            <div class="col-md-2">
                <input type="text" class="form-control input-sm" id="fechafac" value="<?php echo date("d/m/Y");?>" readonly>
            </div>
            <label for="email" class="col-md-1 control-label">Pago</label>
            <div class="col-md-3">
                <select class='form-control input-sm' id="condiciones">
                    <option value="1">Efectivo</option>
                    <option value="2">Cheque</option>
                    <option value="3">Transferencia bancaria</option>
                    <option value="4">Crédito</option>
                </select>
            </div>
        </div>


        <div class="col-md-12">
            <div class="pull-right">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoProducto">
                    <span class="glyphicon glyphicon-plus"></span> Nuevo producto
                </button>
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#nuevoCliente">
                    <span class="glyphicon glyphicon-user"></span> Nuevo cliente
                </button>
                <button type="button" class="btn btn-default" data-toggle="modal" onclick="grabaCabeceraFactura()" data-target="#myModalBuscarProductos">
                    <span class="glyphicon glyphicon-search"></span> Agregar productos
                </button>
                <a href="<?php echo base_url(); ?>Factura/generar_reporte" ><span class="glyphicon glyphicon-print"></span>Imprimir</a>
                <!--<button type="submit" class="btn btn-default" id="generarReporte">
                    <span class="glyphicon glyphicon-print"></span>Imprimir
                </button>-->
            </div>
        </div>
    </form>
    <br />
    <br />
    <hr class="style-2">

    <div class="container">
        <table id="table_id" class="table table-stripe table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Id_Producto</th>
                <th>Nombre Producto</th>
                <th>Precio Producto</th>
                <th>Cantidad Producto</th>
                <th>Total</th>
                <th style="width:125px;">Action </p></th>
            </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th>Id_Producto</th>
                    <th>Nombre Producto</th>
                    <th>Precio Producto</th>
                    <th>Cantidad Producto</th>
                    <th>Total</th>
                    <th style="width:125px;">Action </p></th>
                </tr>
            </tfoot>
        </table>
    </div>



    <!-- Modal BUSCAR PRODUCTOS-->
    <div class="modal fade bs-example-modal-lg" id="myModalBuscarProductos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Buscar productos</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="form_detalleFac" name="form_detalleFac">
                        <div class="form-group">

                            <div class="col-sm-6">
                                <label for="descripcion">Producto</label>
                                <input type="text" class="form-control typeahead" id="descripcion" placeholder="Descripcion" >
                                <input type="hidden" id="producto_id">
                            </div>
                            <div class="col-sm-6">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" id="precioprd" placeholder="precio" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="cantidad">Cantidad</label>
                                <input type="text" class="form-control" id="cantidadprd" placeholder="cantidad" onblur="calculaImporte()">
                            </div>
                            <div class="col-sm-6">
                                <label for="total">Total</label>
                                <input type="text" class="form-control" id="totalprd" placeholder="total" readonly>
                            </div>


                                <!--<button type="button" class="btn btn-default" onclick="load(1)"><span class='glyphicon glyphicon-search'></span> Buscar</button>-->

                        </div>
                    </form>
                    <div id="loader" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
                    <div class="outer_div" ></div><!-- Datos ajax Final -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="grabaDetalleFactura()">Agregar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>


</div>
<input type="hidden" id="documentoCab_id">