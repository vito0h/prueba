<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    function Principal(){
        parent::controller();
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){

        $result = $this->admin_model->obtener_admins();

        $data=array('query' =>$result,
            'usuario' =>$this->session->userdata('usuario')
        );
        $this->load->view('cabezera',$data);
        $this->load->view('admin_detalles');
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

    public function editar_admin()//para validar los datos en la vista modificar 2
    {
        $this->is_logged_in();

        $this->form_validation->set_rules('pass','Contraseña','required');

        if ($this->form_validation->run() == FALSE){

            $user = $this->session->userdata('usuario');

            $datoU = array('nom_user'=>$user);
            $datoUc = array('usuario'=>$user);

            $this->load->view('cabezera',$datoUc);
            $this->load->view('modificar_admin',$datoU);

        }
        else
        {
            $user = $this->session->userdata('usuario');
            $contraseña = set_value('pass');

            $result = $this->admin_model->update_admin($user,$contraseña);

            if($result){

                $data=array('usuario' =>$this->session->userdata('usuario')
                            );
                $this->load->view('cabezera',$data);
                $this->load->view('cabezera_cuerpo');
            }
            else{ // si falla lo mandamos a cualquier vista.. solo por mientras hasta definir bien a que vista

                $this->load->view('header');
                $this->load->view('login_view');

            }
        }
    }

    public function agregar_admin()
    {
        $this->form_validation->set_rules('nom_user', 'Usuario', 'required');
        $this->form_validation->set_rules('pass',' Contraseña','required');

        $data=array('usuario' =>$this->session->userdata('usuario'));

        if ($this->form_validation->run() == FALSE)
        {
            $mensaje=array('mensaje'=>"");
            $this->load->view('cabezera',$data);
            $this->load->view('agregar_admin',$mensaje);
        }
        else
        {
            $nom_user= set_value('nom_user');
            $pass= set_value('pass');

            $revisauser = $this->user->buscar_user($nom_user);

            if($revisauser){
                //si no hay un usuario con el mismo nombre, lo agrega
                $result = $this->admin_model->insert_admin($nom_user,$pass);

                if($result)
                {
                    $result = $this->admin_model->obtener_admins();

                    $data=array('query' =>$result,
                        'usuario' =>$this->session->userdata('usuario')
                    );
                    $this->load->view('cabezera',$data);
                    $this->load->view('admin_detalles');
                }
                else // si falla lo mandamos a cualquier vista.. solo por mientras hasta definir bien a que vista
                {
                    $data = array('mensaje'=>"Ocurrió un error al insertar los datos");
                    $this->load->view('welcome_message',$data);
                }
            }
            else{
                $data=array('usuario' =>$this->session->userdata('usuario'));
                $userexiste = array('mensaje'=>"Nombre de usuario ya existe");
                $this->load->view('cabezera',$data);
                $this->load->view('agregar_admin',$userexiste);
            }

        }

    }
    public function informes(){
            $data=array('usuario' =>$this->session->userdata('usuario'));
            $this->load->view('cabezera',$data);
            $this->load->view('informe_detalles');
    }
    
        public function depto_a_ocupar(){
         $result = $this->admin_model->depto_ocupar();

            $data=array('query' =>$result,
                        'usuario' =>$this->session->userdata('usuario')
                        );
            $this->load->view('cabezera',$data);
            $this->load->view('depto_ocupar_hoy');
    }
    
    public function depto_a_desocupar(){
         $result = $this->admin_model->depto_desocupar();

            $data=array('query' =>$result,
                        'usuario' =>$this->session->userdata('usuario')
                        );
            $this->load->view('cabezera',$data);
            $this->load->view('depto_desocupar_hoy');
    }
	
	public function reservas(){
            $data=array('usuario' =>$this->session->userdata('usuario'));
            $this->load->view('cabezera',$data);
            $this->load->view('reservas_detalles');
    }
	
	public function reservas_activas(){
		
			$result=$this->cliente_model->reservas_activas();
			$data=array('query' =>$result,
						'usuario' =>$this->session->userdata('usuario'));
			
			$this->load->view('cabezera',$data);
            $this->load->view('reservas_activas');
	
	}
	
	public function eliminar_reserva($id_reserva){
			
			$this->cliente_model->anular_reserva($id_reserva);
			
			$result=$this->cliente_model->reservas_activas();
			$data=array('query' =>$result,
						'usuario' =>$this->session->userdata('usuario'));
			
			$this->load->view('cabezera',$data);
            $this->load->view('reservas_activas');
	
	}





}