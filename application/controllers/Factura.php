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

    public function editar_factura($documentoCab_id){
        $this->load->model('factura_Model');

        $factura['cabecera'] = $this->factura_Model->obtenerCabeceraFactura($documentoCab_id);
        $factura['detalle'] = $this->factura_Model->obtenerDetalleFactura($documentoCab_id);

        $this->load->view('head_view');
        $this->load->view('facturaedit_view',$factura);
        $this->load->view('footer_view');

    }

    public function obtener_detalleFactura($movimientoCab_id){
        $this->load->model('factura_Model');


        $detalle = $this->factura_Model->obtenerDetalleFactura($movimientoCab_id);

        header("Content-Type: application/json");
        echo json_encode($detalle);


    }

    public function findClienteByNit(){

        $nit = $_GET['term'];
        $this->load->model('cliente_model');

        $clientes = $this->cliente_model->findClienteByNit($nit);

        header("Content-Type: application/json");
        echo json_encode($clientes);
    }

    public function findProductByDesc(){

        $desc = $_GET['term'];

        $this->load->model('producto_model');

        $productos = $this->producto_model->findProductByDesc($desc);

        echo json_encode($productos);
    }

    public function agregar_CabeceraFactura(){
        $this->load->model('factura_Model');

        $data = json_decode($this->input->post('array'));


        $arr_dataCab = array('tipoDocumento' => 1,
            'cliente_id' =>$data[1],
            'fecha' =>$data[2],
            'subtotal' =>$data[3],
            'iva' =>$data[4],
            'total' =>$data[5],
            'observacion' =>$data[6],
        );



        if($data[0]==""){
            $id_cabecera = $this->factura_Model->grabaCabecera($arr_dataCab);
        } else {
            $id_cabecera = $this->factura_Model->modificaCabecera($arr_dataCab,$data[0]);
        }


        $ret_status = array('status' => 'OK','id_cab'=>$id_cabecera);

        header("Content-Type: application/json");
        echo json_encode($ret_status);

    }

    public function agregar_DetalleFactura(){
        $this->load->model('factura_Model');
        $data = json_decode($this->input->post('arraydet'));
        //$producto_id = $this->input->post('precioprd');

        $arr_detalle = array('movimientocab_id' => $data[0],
                             'producto_id' => $data[1],
                             'cantidad' => $data[2],
                             'subtotal' => $data[3],
                             'total' => $data[4]);

        $id_det= $this->factura_Model->grabaDetalle($arr_detalle);

        $ret_status = array('status' => 'OK', 'id'=>$id_det);
        header("Content-Type: application/json");

        echo json_encode($ret_status);

    }

    public function eliminar_detalleFactura($id_detalle){
        $this->load->model('factura_Model');

        $rows=$this->factura_Model->eliminar_detalle($id_detalle);

        $ret_status = array('status' => 'OK', 'rows' => $rows);

        header("Content-Type: application/json");

        echo json_encode($ret_status);

    }

    public function generar_reporte(){
        $this->load->library('pdf');

        $this->pdf = new PDF();

        $this->pdf->AddPage();

        $this->pdf->AliasNbPages();

        $this->pdf->SetTitle("Lista de alumnos");
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(200,200,200);

        // Se define el formato de fuente: Arial, negritas, tamaño 9
        $this->pdf->SetFont('Arial', 'B', 9);
        /*
         * TITULOS DE COLUMNAS
         *
         * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
         */

        $this->pdf->Cell(15,7,'NUM','TBL',0,'C','1');
        $this->pdf->Cell(25,7,'PATERNO','TB',0,'L','1');
        $this->pdf->Cell(25,7,'MATERNO','TB',0,'L','1');
        $this->pdf->Cell(25,7,'NOMBRE','TB',0,'L','1');
        $this->pdf->Cell(40,7,'FECHA DE NACIMIENTO','TB',0,'C','1');
        $this->pdf->Cell(25,7,'GRADO','TB',0,'L','1');
        $this->pdf->Cell(25,7,'GRUPO','TBR',0,'C','1');
        $this->pdf->Ln(7);

        $pdf = $this->pdf->Output("Factura.pdf",'I');

    }

}