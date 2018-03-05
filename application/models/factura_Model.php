<?php
/**
 * Created by PhpStorm.
 * User: Ferdynand
 * Date: 3/4/18
 * Time: 4:48 PM
 */

class factura_Model extends CI_Model
{
    public function mostrar_facturas(){
        $query = $this->db->get('movimientoCab',10);

        return $query->result();
    }

}