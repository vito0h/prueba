<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edificio extends CI_Controller {

    function Principal(){
        
        parent::controller();

    }

    public function __construct()
    {
      
        parent::__construct();

       
    }

    public function index(){

    
        $result = $this->edificio_model->obtener_edificios();

        $data=array('query' =>$result,
                    'usuario' =>$this->session->userdata('usuario')
                    );
        $this->load->view('cabezera',$data);
        $this->load->view('edificio_detalles');
    }

    function is_logged_in(){//para validar que usuario tiene acceso , aun no se implemente..

        $is_logged_in = $this->session->userdata('is_logged_in');
        $rol = $this->session->userdata('rol');
        $user =$this->session->userdata('usuario');

        if(!isset($is_logged_in) || $is_logged_in !=true ){

            redirect('login/index');
            die();

        }
    }

    public function agregar_edificio()
    {
        $this->form_validation->set_rules('nombre_edi', 'Nombre Edificio', 'required');
        $this->form_validation->set_rules('numero', 'Numero edificio ', 'required|numeric');
        $this->form_validation->set_rules('direccion', 'Direccion', 'required');
        $this->form_validation->set_rules('rut_admin',' Administrador','required');
        $this->form_validation->set_rules('fono_conserjeria', 'Telefono Conserjeria', 'required|numeric');
        $this->form_validation->set_rules('ciudad', 'ciudad', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');

        $result = $this->edificio_model->obtener_administradores();

        $data=array('administradores' =>$result,
                    'usuario' =>$this->session->userdata('usuario')
                    );

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('cabezera',$data);
            $this->load->view('agregar_edificio',$data);
        }
        else
        {
            $nombre_edi= set_value('nombre_edi');
            $numero = set_value('numero');
            $direccion= set_value('direccion');
            $rut_admin = set_value('rut_admin');
            $fono_conserjeria = set_value('fono_conserjeria');
            $ciudad = set_value('ciudad');
            $descripcion = set_value('descripcion');

            $result = $this->edificio_model->insert_edificio($nombre_edi,$numero,$direccion,$rut_admin,$fono_conserjeria,$ciudad,$descripcion);

            if($result)
            {
                $result = $this->edificio_model->obtener_edificios();
                $data=array('query' =>$result,
                           'usuario' =>$this->session->userdata('usuario')
                           );
                $this->load->view('cabezera',$data);
                $this->load->view('edificio_detalles');
            }
            else // si falla lo mandamos a cualquier vista.. solo por mientras hasta definir bien a que vista
            {
                $data = array('mensaje'=>"Ocurrió un error al insertar los datos");
                $this->load->view('welcome_message',$data);
            }
        }

    }

    public function editar_Edificio($id) //para cargar los datos en la vista de modificar 1
    {
        $this->is_logged_in();
        $result = $this->edificio_model->obtener_edificio($id);
        $admins = $this->edificio_model->obtener_administradores();

        $this->form_validation->set_rules('id','ID','');
        $this->form_validation->set_rules('nom_edi', 'Nombre Edificio', 'required');
        $this->form_validation->set_rules('num_edi', 'Numero', 'required|numeric');
        $this->form_validation->set_rules('dir_edi', 'Dirección', 'required');
        $this->form_validation->set_rules('adm_edi', 'Administrador', 'required');
        $this->form_validation->set_rules('tel_edi', 'Teléfono Conserjería', 'required|numeric');
        $this->form_validation->set_rules('ciu_edi', 'Ciudad', 'required');
        $this->form_validation->set_rules('des_edi', 'Descripción', '');

        if ($this->form_validation->run() == FALSE)
        {
            $data = array('usuario'=>$this->session->userdata('usuario'),
                'query'=>$result,
                'admins'=>$admins
            );

            $this->load->view('cabezera',$data);
            $this->load->view('modificar_edificio'); //areglar problema de cargar datos validarlos y que no los vuelva a cargar

        }
        else
        {
            $id = set_value('id');
            $nom_edi = set_value('nom_edi');
            $num_edi = set_value('num_edi');
            $dir_edi = set_value('dir_edi');
            $adm_edi = set_value('adm_edi');
            $tel_edi = set_value('tel_edi');
            $ciu_edi = set_value('ciu_edi');
            $des_edi = set_value('des_edi');

            $result = $this->edificio_model->update_edificio($id,$nom_edi,$num_edi,$dir_edi,$adm_edi,$tel_edi,$ciu_edi,$des_edi);

            if($result){
                $result = $this->edificio_model->obtener_edificios();

                $data=array('query' =>$result,
                    'usuario' =>$this->session->userdata('usuario')
                );
                $this->load->view('cabezera',$data);
                $this->load->view('edificio_detalles');
            }
            else{ // si falla lo mandamos a cualquier vista.. solo por mientras hasta definir bien a que vista

                $this->load->view('header');
                $this->load->view('login_view');

            }
        }
    }


}