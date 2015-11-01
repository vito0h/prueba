<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {


    function Principal(){
        
        parent::controller();
    }

    public function __construct()
    {
      
        parent::__construct();
       
    }


    public function inicio(){

        //para validar la sesion
        $user = $this->session->userdata('usuario');
        $datasession = array(
                            'usuario' => $this->session->userdata('usuario'),
                            'cont' => $this->carrito_model->contador_badge($user)
                            );//hay que validar roles

        $rol = $this->session->userdata('rol');

        if($rol=="admin"){
            $this->load->view('cabezera_cuerpo');
            $this->load->view('cabezera',$datasession);
        }
        if($rol=="user"){

            $lista_d = $this->departamento_model->obtener_departamentos();
            $tipo_d = $this->tipo_depto->obtener_tipo_departamentos();
            $i=0;
            foreach ($lista_d as $item) {
              $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
              $i++;
            }

            $data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
                          'tipo_d' => $tipo_d,
                          'mensaje' => "",
                          'fechallegada' =>"",
                          'fechasalida' => "");
            $this->load->view('cabezera_cliente',$datasession);
            $this->load->view('deptocliente_detalles',$data);
        }

    }

    public function index(){

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $mensaje = array('mensaje'=>"");
            $this->load->view('login_view',$mensaje);
        }
        else 
        {
            $user=set_value('username');
            $pass=set_value('password');

            $result=$this->user->validar_sesion($user,$pass);

            if($result)
            {
                $rol=null;
                $dato_usuario = $this->user->obtener_datoUser($user,$pass);

                foreach ($dato_usuario as $item){
                    $rol=$item['ROL'];
                }
                //Para validar la sesión

                $datasession = array(
                                'usuario' => $user,
                                'is_logged_in'=> true,
                                'rol' => $rol,
                                'cont' => $this->carrito_model->contador_badge($user)
                );//Hay qe validar roles..

                $this->session->set_userdata($datasession);

                if($rol == "admin"){
                    $this->load->view('cabezera',$datasession);
                    $this->load->view('cabezera_cuerpo');
                }
                if($rol == "user"){
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
                    $this->load->view('cabezera_cliente',$datasession);
                    $this->load->view('deptocliente_detalles',$data);
                }
            }
            else
            {
                $mensaje=array('mensaje'=>"Usuario o contraseña incorrecta");
                $this->load->view('login_view',$mensaje);
               
            }
        }
    }

    public function logOut() //cierra sesion y deja datos de sesion en blanco..
    {
            // creamos un array con las variables de sesión en blanco
        $user = $this->session->userdata('usuario');
        $this->carrito_model->delete_carrito_usuario($user);
        $datasession = array('usuario_id' => '', 'is_logged_in' => '','rol'=>'','cont'=>0);
            // y eliminamos la sesión
        $this->session->unset_userdata($datasession);
            // redirigimos al controlador principal
            redirect('visita', 'refresh');
        
    } 
    

    /*Para usar javaScript*/
    function add_all(){

        #Validate entry form information
       // $this->load->model('Model_form','', TRUE);        
        $this->form_validation->set_rules('f_state', 'State', 'required');
        $this->form_validation->set_rules('f_city', 'City', 'required');
        $this->form_validation->set_rules('f_membername', 'Member Name', 'required');

        $data= array( 'states' => $this->tipo_depto>obtener_tipo_departamentos()); //gets the available groups for the dropdown

        if ($this->form_validation->run() == FALSE)
        {
              $this->load->view('cabezera');
              $this->load->view('view_form_all', $data);
        }
        else
        {
            #Add Member to Database
            $this->Model_form->add_all();
            $this->load->view('view_form_success');
        }
    }

    function get_cities($id){
         $id = $this->input->post('id',TRUE);
        header('Content-Type: application/x-json; charset=utf-8');
                echo(json_encode($this->tipo_depto->datos_departamentos($id)));
    } 

     function get_deptos($id){
         $id = $this->input->post('id',TRUE);
        header('Content-Type: application/x-json; charset=utf-8');
                echo(json_encode($this->tipo_depto->datosdepartamentos($id)));
    }   
}

