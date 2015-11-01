<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tipo_departamento extends CI_Controller {

    function Principal(){
        
        parent::controller();

    }

    public function __construct()
    {
      
        parent::__construct();

       
    }

    public function index(){

    
        $result = $this->tipo_depto->obtener_tipo_departamentos();

        $data=array('query' =>$result,
                    'usuario' =>$this->session->userdata('usuario')
                    );
        $this->load->view('cabezera',$data);
        $this->load->view('tipodepartamento_detalles');
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

    public function agregar_tipo_depto(){

        $this->is_logged_in();

         $this->form_validation->set_rules('tipo_depto', 'Tipo departamento', 'required');
         $this->form_validation->set_rules('n_habitaciones', 'Numero de habitaciones', 'required|numeric');
         $this->form_validation->set_rules('n_banios', 'Numero baños', 'required|numeric');
         $this->form_validation->set_rules('capacidad', 'Capacidad', 'required|numeric');

         if ($this->form_validation->run() == FALSE)
         {

            $data=array('usuario' =>$this->session->userdata('usuario')
                    );
            
            $this->load->view('cabezera',$data);
            $this->load->view('agregar_tipo_dpto');
         }
         else
         {

            $tipo_dpto= set_value('tipo_depto');
            $n_habitaciones = set_value('n_habitaciones');
            $n_banios = set_value('n_banios');
            $capacidad = set_value('capacidad');

            $result = $this->tipo_depto->insertar_tipo_depto($tipo_dpto, $n_habitaciones, $n_banios, $capacidad);

            if($result)
            {
                //cargamos datos para mostrar vista principal para tipo departamento
                $result = $this->tipo_depto->obtener_tipo_departamentos();

                $data=array('query' =>$result,
                            'usuario' =>$this->session->userdata('usuario')
                            );
                $this->load->view('cabezera',$data);
                $this->load->view('tipodepartamento_detalles');
            }
            else // si falla lo mandamos a cualquier vista.. solo por mientras hasta definir bien a que vista
            {
                $data = array('mensaje'=>"Ocurrió un error al insertar los datos");
                $this->load->view('welcome_message',$data);

            }


         }

    }

    public function editar_tipoDepto($id) //para cargar los datos en la vista de modificar 1
    {
        $this->is_logged_in();
        $result = $this->tipo_depto->datos_tipo_depto($id);

        $data=array('query' =>$result);

        $this->form_validation->set_rules('id','ID','');
        $this->form_validation->set_rules('tipo_depto', 'Tipo departamento', 'required');
        $this->form_validation->set_rules('n_habitaciones', 'Numero de habitaciones', 'required|numeric');
        $this->form_validation->set_rules('n_banios', 'Numero baños', 'required|numeric');
        $this->form_validation->set_rules('capacidad', 'Capacidad', 'required|numeric');


        if ($this->form_validation->run() == FALSE)
        {
            $datos = array('usuario'=>$this->session->userdata('usuario'));

            $this->load->view('cabezera',$datos);
            $this->load->view('modificar_tipo_depto',$data); //areglar problema de cargar datos validarlos y que no los vuelva a cargar

        }
        else
        {
            $id = set_value('id');
            $tipo_depto = set_value('tipo_depto');
            $n_habitaciones = set_value('n_habitaciones');
            $n_banios = set_value('n_banios');
            $capacidad = set_value('capacidad');

            $result = $this->tipo_depto->update_tipo_depto($id,$tipo_depto,$n_habitaciones,$n_banios,$capacidad);

            if($result){

                $result = $this->tipo_depto->obtener_tipo_departamentos();

                $data=array('query' =>$result,
                    'usuario' =>$this->session->userdata('usuario')
                );
                $this->load->view('cabezera',$data);
                $this->load->view('tipodepartamento_detalles');
            }
            else{ // si falla lo mandamos a cualquier vista.. solo por mientras hasta definir bien a que vista

                $this->load->view('header');
                $this->load->view('login_view');

            }
        }
    }

    public function descuentos(){

        $data=array('usuario' =>$this->session->userdata('usuario'));
        $tdepto=array('tdepto'=>$this->tipo_depto->obtener_tipo_departamentos());

        $this->load->view('cabezera',$data);
        $this->load->view('descuentos_tipodepto',$tdepto);
    }

    public function aplicar_descuento(){

        $this->form_validation->set_rules('porc', 'Porcentaje', 'required|numeric');

        $data=array('usuario' =>$this->session->userdata('usuario'));
        $tdepto=array('tdepto'=>$this->tipo_depto->obtener_tipo_departamentos());

        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('cabezera',$data);
            $this->load->view('descuentos_tipodepto',$tdepto);
        }
        else
        {
            $porc=set_value('porc');
            if(isset($_POST['check'])){
                foreach($_POST['check'] as $valor){
                    $result=$this->tipo_depto->update_descuento($valor,$porc);
                    if($result==false){
                        $mensaje = array('mensaje'=>"no se actualizó");
                        $this->load->view('login_view',$mensaje);
                    }
                }
                redirect('login/inicio');
            }
            else{
                $this->load->view('cabezera',$data);
                $this->load->view('descuentos_tipodepto',$tdepto);
            }
        }
    }

}