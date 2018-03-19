<?php
/**
 * Created by PhpStorm.
 * User: Ferdynand
 * Date: 3/4/18
 * Time: 10:32 AM
 */

class cliente_Model extends CI_Model
{
    public function obtener_clientes(){
        $query = $this->db->get('cliente',10);
        return $query->result();
    }

    public function agrega_cliente($data){
        $this->db->insert('cliente',$data);
        return $this->db->insert_id();
    }


    public function obtener_cliente($id){
        $this->db->select('*');
        $this->db->from('cliente');
        $this->db->where('id',$id);

        $query = $this->db->get();

        return $query->row();
    }

    public function actualizar_cliente($id,$data){

        $this->db->where('id',$id);
        $this->db->update('cliente',$data);

        return $this->db->affected_rows();

    }

    public function eliminar_cliente($id){
        $this->db->where('id',$id);
        $this->db->delete('cliente');

        return $this->db->affected_rows();
    }

    public function findClienteByNit($nit){
        $this->db->select('id,nit, primernombre,segundonombre,telefono,email,direccion');
        $this->db->from('cliente');
        $this->db->like('nit',$nit);

        $query = $this->db->get();

        $arr_cliente = array();

        foreach ($query->result() as $row){
            $arr_cliente[] = array(
                'value' => $row->primernombre.' '.$row->segundonombre,
                'primernombre' => $row->primernombre,
                'nit' => $row->nit,
                'segundonombre' => $row->segundonombre,
                'telefono' => $row->telefono,
                'email' => $row->email,
                'direccion' => $row->direccion,
                'id' => $row->id,
            );
        }

        return $arr_cliente;

    }

}