<div class="container">
    <h1>POS</h1>
    <form class="container">
        <!--<hr class="style1">
        <h1>Cabecera</h1>

        <hr class="style2">
        <h1>Detalle</h1>-->
        <!--
        <div class="row">
            <div class="col-xs-6 form-group">
                <label for="idproducto">Producto</label>
                <input class="form-control" type="text" id="idproducto" name="idproducto" placeholder="Codigo de Producto">
            </div>
            <div class="col-xs-6 form-group">
                <label for="nombreproducto">Nombre Producto</label>
                <input class="form-control" type="text" id="nombreproducto" name="nombreproducto" placeholder="Nombre de Producto">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 form-group">
                <label for="cantidad">Cantidad</label>
                <input class="form-control" type="text" id="cantidad" name="cantidad" placeholder="Cantida de Producto">
            </div>

            <div class="col-xs-6 form-group">
                <label for="subtotalprd">SubTotal</label>
                <input class="form-control" type="text" id="subtotalprd" name="subtotalprd" placeholder="Subtotal de Producto">
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 form-group">
                <label for="ivaprd">Iva</label>
                <input class="form-control" type="text" id="ivaprd" name="ivaprd" placeholder="Iva de Producto">
            </div>

            <div class="col-xs-6 form-group">
                <label for="totalprd">Total</label>
                <input class="form-control" type="text" id="totalprd" name="totalprd" placeholder="Total de Producto">
            </div>
        </div> <-->
    </form>


    <br />
    <br />
    <hr class="style2">
    <table id="table_id" class="table table-stripe table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Iva</th>
            <th>Total</th>
            <th>Observacion</th>
            <th style="width:125px;">Action </p></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($facturas as $factura){?>
            <tr>
                <td><?php echo $factura['id']; ?></td>
                <td><?php echo $factura['nombre']; ?></td>
                <td><?php echo $factura['fecha']; ?></td>
                <td><?php echo $factura['iva']; ?></td>
                <td><?php echo $factura['total']; ?></td>
                <td><?php echo $factura['observacion']; ?></td>
                <td>
                    <a href="<?php echo base_url(); ?>Factura/editar_factura/<?php echo $factura['id']; ?>"><i class="glyphicon glyphicon-pencil" ></i></a>
                    <a href="<?php echo base_url(); ?>Factura/eliminar_factura/<?php echo $factura['id']; ?>"><i class="glyphicon glyphicon-remove"></i>
                </td>
            </tr>
        <?php } ?>

        </tbody>
        <tfoot>
        <tr>
            <th>Producto</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Costo</th>
            <th>Observacion</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>



    <a class="btn btn-primary" href="<?php echo base_url(); ?>Factura/nueva_factura" role="button">Nueva Factura</a>


    <!-- Modal -->

</div>