<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Visita extends CI_Controller {

    //controlador para el acceso de la vista de la visita
    function Principal(){
        parent::controller();
    }

    public function __construct(){
        parent::__construct();

    }

    public function index(){

        $lista_d = $this->departamento_model->obtener_departamentos();
        $tipo_d = $this->tipo_depto->obtener_tipo_departamentos();
        $i=0;
        foreach ($lista_d as $item) {
          $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
          $i++;
        }


        $data = array('lista_departamentos' => $lista_d,
                      'fotos'=>$fotos,
                      'tipo_d' => $tipo_d,
                      'mensaje' => "",
                      'fechallegada' =>"",
                      'fechasalida' => "");
        $this->load->view('cabezera_visita');
        $this->load->view('deptovisita_detalles',$data);


    }

}