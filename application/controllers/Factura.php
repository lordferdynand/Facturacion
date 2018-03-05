<?php
/**
 * Created by PhpStorm.
 * User: Ferdynand
 * Date: 3/4/18
 * Time: 4:47 PM
 */

class Factura extends CI_Controller
{
    function index(){
        $this->load->model('factura_Model');
        $data['facturas'] = $this->factura_Model->mostrar_facturas();

        $this->load->view('head_view');
        $this->load->view('facturalist_view',$data);
        $this->load->view('footer_view');
    }

    function nueva_factura(){
        $this->load->view('head_view');
        $this->load->view('facturanueva_view');
        $this->load->view('footer_view');
    }

}