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

        $this->db->select('a.id, b.primernombre as nombre,a.fecha,a.iva,a.total,a.observacion');
        $this->db->from('movimientoCab as a');
        $this->db->join('cliente as b','a.cliente_id=b.id','LEFT');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function grabaCabecera($arrdataCab){

        $this->db->insert('movimientoCab',$arrdataCab);

        return $this->db->insert_id();
    }

    public function modificaCabecera($arrdataCab,$id){
        $this->db->where('id',$id);
        $this->db->update('movimientoCab',$arrdataCab);

        return $id;
    }

    public function grabaDetalle($arrdataDet){
        $this->db->insert('movimientoDet',$arrdataDet);

        return $this->db->insert_id();
    }

    public function obtenerCabeceraFactura($movimientoCab_id){
        $this->db->select('a.id, a.cliente_id, a.fecha, a.subtotal, a.iva, a.total, b.primernombre, b.segundonombre, b.telefono,b.email, b.direccion,a.movimientocab_id');
        $this->db->from('movimientoCab a');
        $this->db->join('cliente b','a.cliente_id=b.id','LEFT');
        $this->db->where('a.id',$movimientoCab_id);

        $query = $this->db->get();

        return $query->result_array();
    }

    public function obtenerDetalleFactura($movimientoCab_id){
        $this->db->select('a.id, a.producto_id, a.cantidad, a.subtotal, a.total,a.producto_id, b.nombre, b.precio');
        $this->db->from('movimientoDet a');
        $this->db->join('producto b','a.producto_id=b.id','LEFT');
        $this->db->where('movimientoCab_id',$movimientoCab_id);

        $query = $this->db->get();

        /*$arr_result = array();

        foreach ($query->result() as $det){
            $arr_result[] = array(  'id' => $det->id,
                                    'producto_id' =>$det->producto_id,
                                    'cantidad' =>$det->cantidad,
                                    'subtotal' =>$det->subtotal,
                                    'total' => $det->total,
                                    'nombre' => $det->nombre,
                                    'precio' => $det->precio);
        }*/

        return $query->result_array();
    }

    public function eliminar_detalle($id){
        $arr_delete = array('id'=> $id);
        $this->db->delete('movimientoDet',$arr_delete);

        return $this->db->affected_rows();
    }

}