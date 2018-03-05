<?php
/**
 * Created by PhpStorm.
 * User: Ferdynand
 * Date: 3/4/18
 * Time: 10:19 AM
 */

class Producto extends CI_Controller
{
    function index(){
        $this->load->model('producto_Model');

        $data['productos'] = $this->producto_Model->obtener_productos();

        $this->load->view('head_view');
        $this->load->view('producto_view',$data);
        $this->load->view('footer_view');
    }

    public function grabar_producto(){

        $this->load->model('producto_Model');
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'precio' => $this->input->post('precio'),
            'costo' => $this->input->post('costo'),
            'observacion' => $this->input->post('observacion')
        );

        $insert = $this->producto_Model->agrega_producto($data);

        echo json_encode(array('status'=>TRUE));
    }

    public function ajax_edit($id){
        $this->load->model('producto_Model');
        $data = $this->producto_Model->obtener_producto($id);

        echo json_encode($data);


    }

    public function actualizar_producto(){

        $this->load->model('producto_Model');

        $id = $this->input->post('producto_id');



        $data = array('primernombre' => $this->input->post('primernombre'),
                      'segundonombre' => $this->input->post('segundonombre'),
                      'direccion' => $this->input->post('direccion'),
                      'nit' => $this->input->post('nit')
        );


        $this->producto_Model->actualizar_producto($id,$data);

        echo json_encode(array('status'=> TRUE));

    }

    public function eliminar_producto($id){
        $this->load->model('producto_Model');


        $this->producto_Model->eliminar_producto($id);

        echo json_encode(array('status' => TRUE));
    }



}