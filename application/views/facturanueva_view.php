<div class="container">
    <form class="form-horizontal" role="form" id="datos_factura">
        <div class="form-group row">
            <label for="nombre_cliente" class="col-md-1 control-label">Cliente</label>
            <div class="col-md-3">
                <input type="text" class="form-control input-sm" id="nombre_cliente" placeholder="Selecciona un cliente" required>
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
                <input type="text" class="form-control input-sm" id="fecha" value="<?php echo date("d/m/Y");?>" readonly>
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
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-search"></span> Agregar productos
                </button>
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-print"></span> Imprimir
                </button>
            </div>
        </div>
    </form>
</div>