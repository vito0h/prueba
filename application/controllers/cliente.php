<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente extends CI_Controller {

    function Principal(){

        parent::controller();

    }

    public function __construct()
    {

        parent::__construct();


    }

    public function index(){

    }

    function is_logged_in(){

        $is_logged_in = $this->session->userdata('is_logged_in');
        $rol = $this->session->userdata('rol');
        $user= $this->session->userdata('usuario');

        if(!isset($is_logged_in) || $is_logged_in !=true ){

            redirect('login/index');
            die();

        }
    }

    public function lista_clientes(){

        $this->is_logged_in();

        $result = $this->cliente_model->obtener_clientes();

        $data=array('query' =>$result,
            'usuario' =>$this->session->userdata('usuario')
        );
        $this->load->view('cabezera',$data);
        $this->load->view('cliente_detalles');
    }

    public function registrate(){
        $mensaje=array('mensaje'=>"");
        $this->load->view('registro_cliente',$mensaje);
    }

    public function agregar_cliente(){

        $this->form_validation->set_rules('rut_cli', 'Rut', 'required');
        $this->form_validation->set_rules('nom_cli','Nombre','required');
        $this->form_validation->set_rules('ape_cli','Apellidos','required');
        $this->form_validation->set_rules('sexo_cli','Sexo','required');
        $this->form_validation->set_rules('fdn_cli','Fecha de Nacimiento');
        $this->form_validation->set_rules('nac_cli','Nacionalidad');
        $this->form_validation->set_rules('mail_cli','E-Mail');
        $this->form_validation->set_rules('tel_cli','Teléfono');
        $this->form_validation->set_rules('ciu_cli','Ciudad');
        $this->form_validation->set_rules('user_cli','Usuario','required');
        $this->form_validation->set_rules('pass_cli','Contraseña','required');


        if ($this->form_validation->run() == FALSE)
        {
            $mensaje=array('mensaje'=>"");
            $this->load->view('registro_cliente',$mensaje);
        }
        else
        {
            $rut_cli= set_value('rut_cli');
            $nom_cli= set_value('nom_cli');
            $ape_cli= set_value('ape_cli');
            $sexo_cli= set_value('sexo_cli');
            $fdn_cli= set_value('fdn_cli');
            $nac_cli= set_value('nac_cli');
            $mail_cli= set_value('mail_cli');
            $tel_cli= set_value('tel_cli');
            $ciu_cli= set_value('ciu_cli');
            $user_cli= set_value('user_cli');
            $pass_cli= set_value('pass_cli');

            $revisarut = $this->cliente_model->buscar_cliente($rut_cli);
            $revisauser = $this->user->buscar_user($user_cli);

            if($revisarut and $revisauser){
                //agregar al loco
                $result = $this->cliente_model->insert_cliente($rut_cli,$nom_cli,$ape_cli,$sexo_cli,$fdn_cli,$nac_cli,$mail_cli,$tel_cli,$ciu_cli,$user_cli,$pass_cli);

                if($result)
                {
                    $mensaje = array('mensaje'=>"Ya estás registrado, inicia sesión!");
                    $this->load->view('login_view',$mensaje);
                }
                else // si falla lo mandamos a cualquier vista.. solo por mientras hasta definir bien a que vista
                {
                    $data = array('mensaje'=>"Ocurrió un error al insertar los datos");
                    $this->load->view('welcome_message',$data);

                }

            }
            else{
                if($revisarut==false){
                    $rutexiste = array('mensaje'=>"Ya tienes una cuenta asociada a ese rut");
                    $this->load->view('registro_cliente',$rutexiste);
                }
                else{
                    $userexiste = array('mensaje'=>"Nombre de usuario ya existe");
                    $this->load->view('registro_cliente',$userexiste);
                }
            }




        }

    }
    public function historial_arriendo(){
         $result = $this->cliente_model->obtener_historial();

            $data=array('query' =>$result,
                        'usuario' =>$this->session->userdata('usuario')
                        );
            $this->load->view('cabezera',$data);
            $this->load->view('arriendo_detalles');
    }
	
	    public function mi_perfil($usuario_antiguo) //para cargar los datos en la vista de modificar 1
    {
        $this->is_logged_in();
        $result = $this->cliente_model->obtener_perfil($usuario_antiguo);

        $this->form_validation->set_rules('rut','ID','');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('telefono', 'Telefono', 'required|numeric');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'required');
        $this->form_validation->set_rules('contrasena', 'Contraseña', 'required');

        if ($this->form_validation->run() == FALSE)
        {
			$cont=$this->carrito_model->contador_badge($usuario_antiguo);
            $data = array('usuario'=>$this->session->userdata('usuario'),
                'query'=>$result,
                 'cont' =>$cont
            );

            $this->load->view('cabezera_cliente',$data);
            $this->load->view('mi_perfil'); //areglar problema de cargar datos validarlos y que no los vuelva a cargar

        }
        else
        {
            $rut = set_value('rut');
            $email = set_value('email');
            $telefono = set_value('telefono');
            $ciudad = set_value('ciudad');
            $contrasena = set_value('contrasena');

            $result = $this->cliente_model->modificar_perfil_usuario($contrasena,$usuario_antiguo);
			$result2 = $this->cliente_model->modificar_perfil_cliente($rut,$email,$telefono,$ciudad);
            
			if($result and $result2){
                $lista_d = $this->departamento_model->obtener_departamentos();
            	$tipo_d = $this->tipo_depto->obtener_tipo_departamentos();
				$cont=$this->carrito_model->contador_badge($usuario_antiguo);
                $i=0;
                foreach ($lista_d as $item) {
                  $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                  $i++;
                }

        		$data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
							  'tipo_d' => $tipo_d,
							  'mensaje' => "",
							  'fechallegada' =>"",
							  'fechasalida' => "",
							 'cont' =>$cont);
        		$this->load->view('cabezera_visita');
        		$this->load->view('deptovisita_detalles',$data);

            }
            else{ // si falla lo mandamos a cualquier vista.. solo por mientras hasta definir bien a que vista

                $this->load->view('cabezera_cliente',$datasession);
                $this->load->view('deptocliente_detalles',$data);

            }
        }
    }
	
	public function mis_reservas($usuario){

        $this->is_logged_in();
        $user=$this->session->userdata('usuario');
        $cont=$this->carrito_model->contador_badge($user);

 		$result = $this->cliente_model->obtener_reserva($usuario);

        $data=array('query' =>$result,
                    'usuario' =>$this->session->userdata('usuario'),
                    'cont' =>$cont);


        $this->load->view('cabezera_cliente',$data);
        $this->load->view('mis_reservas');
    }
	
		public function detalle_reserva($id_reserva){

        $this->is_logged_in();
        $user=$this->session->userdata('usuario');
        $cont=$this->carrito_model->contador_badge($user);

 		$result = $this->cliente_model->obtener_detalle_reserva($id_reserva);

        $data=array('query' =>$result,
                    'usuario' =>$this->session->userdata('usuario'),
                    'cont' =>$cont);


        $this->load->view('cabezera_cliente',$data);
        $this->load->view('detalle_misreservas');
    }



}




