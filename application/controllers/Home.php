<?php
/**
 * Created by PhpStorm.
 * User: Ferdynand
 * Date: 3/3/18
 * Time: 12:37 PM
 */

class Home extends CI_Controller
{
    function index(){
        $this->load->view('head_view');
        $this->load->view('home_view');
        $this->load->view('footer_view');
    }

}