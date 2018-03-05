<?php
/**
 * Created by PhpStorm.
 * User: Ferdynand
 * Date: 3/4/18
 * Time: 10:19 AM
 */

class Cliente extends CI_Controller
{
    function index(){
        $this->load->model('cliente_Model');

        $data['clientes'] = $this->cliente_Model->obtener_clientes();

        $this->load->view('head_view');
        $this->load->view('cliente_view',$data);
        $this->load->view('footer_view');
    }

    public function grabar_cliente(){

        $this->load->model('cliente_Model');
        $data = array(
            'primernombre' => $this->input->post('primernombre'),
            'segundonombre' => $this->input->post('segundonombre'),
            'direccion' => $this->input->post('direccion'),
            'nit' => $this->input->post('nit')
        );

        $insert = $this->cliente_Model->agrega_cliente($data);

        echo json_encode(array('status'=>TRUE));
    }

    public function ajax_edit($id){
        $this->load->model('cliente_Model');
        $data = $this->cliente_Model->obtener_cliente($id);

        echo json_encode($data);


    }

    public function actualizar_cliente(){

        $this->load->model('cliente_Model');

        $id = $this->input->post('cliente_id');



        $data = array('primernombre' => $this->input->post('primernombre'),
                      'segundonombre' => $this->input->post('segundonombre'),
                      'direccion' => $this->input->post('direccion'),
                      'nit' => $this->input->post('nit')
        );


        $this->cliente_Model->actualizar_cliente($id,$data);

        echo json_encode(array('status'=> TRUE));

    }

    public function eliminar_cliente($id){
        $this->load->model('cliente_Model');


        $this->cliente_Model->eliminar_cliente($id);

        echo json_encode(array('status' => TRUE));
    }



}