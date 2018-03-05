<?php
/**
 * Created by PhpStorm.
 * User: Ferdynand
 * Date: 3/4/18
 * Time: 10:32 AM
 */

class producto_Model extends CI_Model
{
    public function obtener_productos(){
        $query = $this->db->get('producto',10);
        return $query->result();
    }

    public function agrega_producto($data){
        $this->db->insert('producto',$data);
        return $this->db->insert_id();
    }


    public function obtener_producto($id){
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->where('id',$id);

        $query = $this->db->get();

        return $query->row();
    }

    public function actualizar_producto($id,$data){

        $this->db->where('id',$id);
        $this->db->update('producto',$data);

        return $this->db->affected_rows();

    }

    public function eliminar_producto($id){
        $this->db->where('id',$id);
        $this->db->delete('producto');

        return $this->db->affected_rows();
    }

}