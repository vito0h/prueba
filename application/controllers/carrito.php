<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrito extends CI_Controller {

    //Controlador para controlar carrito de departamentos
    function Principal(){
        parent::controller();
    }

    public function __construct(){
        parent::__construct();
    }

    public function index(){

        $this->is_logged_in();
        $user=$this->session->userdata('usuario');
        $cont=$this->carrito_model->contador_badge($user);

        $result = $this->carrito_model->obtener_deptos_carrito($user);

        $data=array('query' =>$result,
                    'usuario' =>$this->session->userdata('usuario'),
                    'cont' =>$cont);
        $this->load->view('cabezera_cliente',$data);
        $this->load->view('carrito_detalles');
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

    public function agregar_depto_carrito(){

        $this->is_logged_in();

        $this->form_validation->set_message('required','');

        $this->form_validation->set_rules('id_dep', 'Numero Depto', 'required');
        $this->form_validation->set_rules('cod_tip','Codigo Tipo','required');
        $this->form_validation->set_rules('pre_dep', 'Precio Depto', 'required');
        $this->form_validation->set_rules('pre_ext', 'Precio Extra', 'required');
        $this->form_validation->set_rules('f_lleg', 'Fecha Llegada', 'required');
        $this->form_validation->set_rules('f_sal', 'Fecha Salida', 'required');

        $user=$this->session->userdata('usuario');

        if($this->form_validation->run()==false)
        {
            $lista_d = $this->departamento_model->obtener_departamentos();
            $tipo_d = $this->tipo_depto->obtener_tipo_departamentos();
			
			 $i=0;
             foreach ($lista_d as $item) {
                  $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                  $i++;
            }
			
            $cont=$this->carrito_model->contador_badge($user);
            $datasession=array('usuario'=>$user,
                               'cont'=>$cont);

            $data=array('lista_departamentos' => $lista_d,
						'fotos' => $fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "Ingrese período de fecha para hacer una reserva",
                        'fechallegada' =>"",
                        'fechasalida' => "");
            $this->load->view('cabezera_cliente',$datasession);
            $this->load->view('deptocliente_detalles',$data);
        }
        else{
            $id_dep = set_value('id_dep');
            $cod_tip = set_value('cod_tip');
            $pre_dep = set_value('pre_dep');
            $pre_ext = set_value('pre_ext');
            $f_lleg = set_value('f_lleg');
            $f_sal = set_value('f_sal');

            $rut = $this->carrito_model->buscar_rut($user);

            $noexiste=$this->carrito_model->buscar_departamento_carrito($rut,$id_dep,$f_lleg,$f_sal);

            if($noexiste){

                //Obtengo descuento
                $aux = $this->carrito_model->buscar_dcto($id_dep);
                $dcto=0;
                foreach($aux as $item){
                    $dcto=$item['DESCUENTO'];
                }

                //Calculo precio total con dcto aplicado.
                $precio_dcto=$pre_dep*((100-$dcto)/100);

                //Calcular numero de días
                $dias=$this->carrito_model->calcular_dias_reserva($f_sal,$f_lleg);

                //Precio con dcto * cantidad de días
                $precio_totaldias=$precio_dcto*$dias;
                $result=$this->carrito_model->insert_carrito($rut,$id_dep,$pre_dep,$pre_ext,$precio_totaldias,$dcto,$f_lleg,$f_sal);
                
				if($result){
                    $lista_d = $this->departamento_model->obtener_departamentos();
                    $tipo_d = $this->tipo_depto->obtener_tipo_departamentos();
					$i=0;
					foreach ($lista_d as $item) {
                  		$fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                  	$i++;
            		}

                    $cont=$this->carrito_model->contador_badge($user);
                    $datasession=array('usuario'=>$user,
                                       'cont'=>$cont);

                    $data=array('lista_departamentos' => $lista_d,
								'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "",
                        'fechallegada' =>"",
                        'fechasalida' => "");
                    $this->load->view('cabezera_cliente',$datasession);
                    $this->load->view('deptocliente_detalles',$data);
                }
                else{
                    $lista_d = $this->departamento_model->obtener_departamentos();
                    $tipo_d = $this->tipo_depto->obtener_tipo_departamentos();
					
					$i=0;
					foreach ($lista_d as $item) {
                  		$fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                  	$i++;
            		}

					
                    $cont=$this->carrito_model->contador_badge($user);
                    $datasession=array('usuario'=>$user,
                        'cont'=>$cont);

                    $data=array('lista_departamentos' => $lista_d,
								'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "Departamento no fue ingresado correctamente.",
                        'fechallegada' =>"",
                        'fechasalida' => "");
                    $this->load->view('cabezera_cliente',$datasession);
                    $this->load->view('deptocliente_detalles',$data);
                }
            }
            else{
                $lista_d = $this->departamento_model->obtener_departamentos();
                $tipo_d = $this->tipo_depto->obtener_tipo_departamentos();
				
				foreach ($lista_d as $item) {
                  $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                  $i++;
            	}
                $cont=$this->carrito_model->contador_badge($user);
                $datasession=array('usuario'=>$user,
                                   'cont'=>$cont);

                $data=array('lista_departamentos' => $lista_d,
							'fotos'=>$fotos,
                            'tipo_d' => $tipo_d,
                            'mensaje' => "Ud. ya ha seleccionado ese departamento en esa fecha.",
                            'fechallegada' =>"",
                            'fechasalida' => "");
                $this->load->view('cabezera_cliente',$datasession);
                $this->load->view('deptocliente_detalles',$data);
            }

        }

    }

    public function agregar_personas(){

        $this->is_logged_in();

        $this->form_validation->set_rules('rut','Rut','required');
        $this->form_validation->set_rules('id_dep','ID Depto','required');
        $this->form_validation->set_rules('pre_dep','Precio','required');
        $this->form_validation->set_rules('pre_ext','Precio Extra','required');
        $this->form_validation->set_rules('dcto','Descuento','required');
        $this->form_validation->set_rules('f_lleg','Fecha Llegada','required');
        $this->form_validation->set_rules('f_sali','Fecha Salida','required');
        $this->form_validation->set_rules('npersonas','Numero de Personas','required|numeric');

        if($this->form_validation->run()==false){
            redirect('carrito/index');
        }
        else{
            $rut=set_value('rut');
            $id_dep=set_value('id_dep');
            $pre_dep=set_value('pre_dep');
            $pre_ext=set_value('pre_ext');
            $dcto=set_value('dcto');
            $f_lleg=set_value('f_lleg');
            $f_sali=set_value('f_sali');
            $npersonas=set_value('npersonas');

            //Buscar capacidad máxima de departamento
            $aux = $this->carrito_model->buscar_capacidad($id_dep);
            $capac=0;
            foreach($aux as $item){
                $capac=$item['CAPACIDAD'];
            }
            //Verificar personas extras y calcular precio
            $dif_personaextra=$npersonas-$capac;
            $precio_totalextra=0;
            if($dif_personaextra>0){
                $precio_totalextra=$dif_personaextra*$pre_ext;
            }
            //Precio para 1 día incluyendo personas extras y dcto.
            $precio_totaldia=$pre_dep+$precio_totalextra;
            $precio_totaldiadcto=$precio_totaldia*((100-$dcto)/100);

            //Calcular numero de días
            $dias=$this->carrito_model->calcular_dias_reserva($f_sali,$f_lleg);
            $subtotal=$precio_totaldiadcto*$dias;

            $result=$this->carrito_model->update_carrito($rut,$id_dep,$precio_totaldia,$npersonas,$f_lleg,$subtotal);
            if($result){
                redirect('carrito/index');
            }
            else{
                $mensaje=array('mensaje'=>"No se actualizo");
                $this->load->view(login_view,$mensaje);
            }

        }

    }


    public function agregar_reserva(){

        $this->is_logged_in();

        $this->form_validation->set_rules('sum_total',' Suma total','required');
        $this->form_validation->set_rules('rutr','Rut Cliente','required');
        //para que se puede obteer rut directo para insertarlo en tabla reserva


        if($this->form_validation->run()==false){
            redirect('carrito/index');
        }
        else{

            //insert en reserva
            $precio_total = set_value('sum_total');
            $rut=set_value('rutr');
            $idreserva= $this->carrito_model->insert_reserva($rut,$precio_total); //devuelve la id insertada

             //obtebenos datos carritos del usurio
            $user=$this->session->userdata('usuario');
            $dptos_carritos = $this->carrito_model->obtener_deptos_carrito($user);

            //recorremos foreach

            foreach($dptos_carritos as $rs)
            {
                //traer datos de l tazbla carrito

                $rut = $rs['RUT'];
                $id_depto = $rs['ID_DEPTO'];
                $precio_depto= $rs['PRECIO_DEPTO'];
                $precio_extra =$rs['PRECIO_EXTRA'];
                $precio_totaldias = $rs['PRECIO_TOTALDIAS'];
                $dcto = $rs['DCTO'];
                $numpersonas= $rs['NUMPERSONAS'];
                $f_llegada= $rs['F_LLEGADA'];
                $f_salida = $rs['F_SALIDA'];
                $subtotal = $rs['SUBTOTAL'];
				
				// creacion de variables tipo fecha para mandar a la base de datos con la hora correspondiente
				$fecha_hora_llegada= date("Y-m-d H:i:s");
                $fecha_hora_llegada=$f_llegada;
				
				$fecha_hora_salida= date("Y-m-d H:i:s");
                $fecha_hora_salida=$f_salida;
				
			
                $fecha_hora_llegada= strtotime ( '+15 hour' , strtotime ( $f_llegada ) ) ;
                $fecha_hora_llegada = date ( 'Y-m-d H:i:s' , $fecha_hora_llegada );
				
				$fecha_hora_salida= strtotime ( '+12 hour' , strtotime ( $f_salida ) ) ;
                $fecha_hora_salida = date ( 'Y-m-d H:i:s' , $fecha_hora_salida );	

                //INSERT EN RESERVA , Y CONSERVAMOS LA ID_RESERVA QUE SE INSERTO EN RESERVA PARA QUE TODOS LOS INSERT EN RESERVA_DPTO TENGAN LA MISMA ID_RESERVA
                $this->carrito_model-> insert_reserva_dpto($idreserva,$id_depto,$precio_depto,$precio_extra,$subtotal,$fecha_hora_llegada,$fecha_hora_salida);

            }
            //eliminar datos del carrito del usuariio despues de insertar en reserva_Departamento

            $this->carrito_model->delete_carrito_usuario($user);
             redirect('login/inicio'); //lo mandamos a inicio para nuevas bussquedas


            }

    }


}