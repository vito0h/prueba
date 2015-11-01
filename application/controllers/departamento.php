<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departamento extends CI_Controller {

    function Principal(){

        parent::controller();

    }

    public function __construct()
    {

        parent::__construct();


    }

    public function index(){

        $result = $this->departamento_model->obtener_departamentos();

        $data=array('query' =>$result,
            'usuario' =>$this->session->userdata('usuario')
        );
        $this->load->view('cabezera',$data);
        $this->load->view('departamento_detalles');
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

    public function insertar_depto(){

        //obtener los tipos de deptos
        $listadoTipoDeptos = $this->tipo_depto->obtener_tipo_departamentos(); //creamos variable listadoTipoDeptos guardamos todos los tipo departamentos

        //obtener los edificios(id)
        $listadoEdificios= $this->edificio_model->obtener_edificios(); //creamos variable listadoEdificio guardamos todos los edificios


        $data = array( 'usuario' =>$this->session->userdata('usuario'),
            'tipo_depto' => $listadoTipoDeptos,
            'edificios' =>$listadoEdificios,
        ); //array que contiene las 2 objetos , para accedder a los objetos se accede en la vista por e nombre definido dentro del array  'nombre'=>$consulta


        $this->form_validation->set_rules('id_edificio', 'Edificio', 'required');
        $this->form_validation->set_rules('n_piso', 'Numero de piso', 'required');
        $this->form_validation->set_rules('n_depto', 'Numero de departamento', 'required');
        $this->form_validation->set_rules('codigo_tipo', 'Codigo tipo departamento', 'required');
        $this->form_validation->set_rules('precio', 'Precio', 'required');
        $this->form_validation->set_rules('precio_extra', 'Precio Extra', 'required');
        $this->form_validation->set_rules('descrip', 'Descripcion', 'required');

        if($this->form_validation->run()==false)
        {
            $this->load->view('cabezera',$data);
            $this->load->view("agregar_departamento"); // vista es el cuerpo que carga para que se visualize.
        }
        else{
            $id_edi=set_value('id_edificio');
            $n_piso=set_value('n_piso');
            $n_dpto=set_value('n_depto');
            $cod_tipo=set_value('codigo_tipo');
            $precio=set_value('precio');
            $pre_extra=set_value('precio_extra');
            $descripcion=set_value('descrip');

            $this->departamento_model->insert_depto($id_edi,$n_piso,$n_dpto,$cod_tipo,$precio,$pre_extra,$descripcion);

            $result = $this->departamento_model->obtener_departamentos();

            $data=array('query' =>$result,
                'usuario' =>$this->session->userdata('usuario')
            );
            $this->load->view('cabezera',$data);
            $this->load->view('departamento_detalles');


        }

    }

    public function editar_depto($id) //para cargar los datos en la vista de modificar 1
    {
        $this->is_logged_in();
        $result = $this->departamento_model->obtener_depto($id);
        $edif = $this->edificio_model->obtener_edificios();
        $tipodep = $this->tipo_depto->obtener_tipo_departamentos();

        $this->form_validation->set_rules('id','ID','');
        $this->form_validation->set_rules('id_edi', 'Nombre Edificio', 'required');
        $this->form_validation->set_rules('pis_dep', 'Número Piso', 'required|numeric');
        $this->form_validation->set_rules('num_dep', 'Número Departamento', 'required');
        $this->form_validation->set_rules('tip_dep', 'Tipo Departamento', 'required');
        $this->form_validation->set_rules('pre_dep', 'Precio', 'required|numeric');
        $this->form_validation->set_rules('ext_dep', 'Precio Extra', 'required');
        $this->form_validation->set_rules('des_dep', 'Descripción', '');

        if ($this->form_validation->run() == FALSE)
        {
            $data = array('usuario'=>$this->session->userdata('usuario'),
                'query'=>$result,
                'edif'=>$edif,
                'tipodep'=>$tipodep
            );

            $this->load->view('cabezera',$data);
            $this->load->view('modificar_depto'); //areglar problema de cargar datos validarlos y que no los vuelva a cargar

        }
        else
        {
            $id = set_value('id');
            $id_edi = set_value('id_edi');
            $pis_dep = set_value('pis_dep');
            $num_dep = set_value('num_dep');
            $tip_dep = set_value('tip_dep');
            $pre_dep = set_value('pre_dep');
            $ext_dep = set_value('ext_dep');
            $des_dep = set_value('des_dep');

            $result = $this->departamento_model->update_depto($id,$id_edi,$pis_dep,$num_dep,$tip_dep,$pre_dep,$ext_dep,$des_dep);

            if($result){
                $result = $this->departamento_model->obtener_departamentos();

                $data=array('query' =>$result,
                    'usuario' =>$this->session->userdata('usuario')
                );
                $this->load->view('cabezera',$data);
                $this->load->view('departamento_detalles');
            }
            else{ // si falla lo mandamos a cualquier vista.. solo por mientras hasta definir bien a que vista

                $this->load->view('header');
                $this->load->view('login_view');

            }
        }
    }


    //busqueda especial de departamentos en la vista de la visita
    public function buscar_departamentos(){

        $this->load->view('cabezera_visita');

        $this->form_validation->set_rules('tipo_dep', 'Tipo Departamento', '');
        $this->form_validation->set_rules('fec_lleg', 'Fecha Llegada', '');
        $this->form_validation->set_rules('fec_sal', 'Fecha Salida', '');


        if ($this->form_validation->run() == FALSE){
            redirect('login');
        }
        else{
            $tipo_dep = set_value('tipo_dep');
            $fec_lleg = set_value('fec_lleg');
            $fec_sal = set_value('fec_sal');

            $tipo_d = $this->tipo_depto->obtener_tipo_departamentos();


            if($tipo_dep==0 and $fec_lleg==null and $fec_sal==null){
                redirect('visita');
            }

            // busqueda de tipo departamento solo seleccionando el tipo
            if($tipo_dep!=0 and $fec_lleg==null and $fec_sal==null){
                $result = $this->tipo_depto->datos_departamentos($tipo_dep);
                $i=0;
                foreach ($result as $item) {
                    $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                    $i++;
                }
                $data = array('lista_departamentos' => $result,
                    'fotos'=>$fotos,
                    'tipo_d' => $tipo_d,
                    'mensaje' => "",
                    'fechallegada' => "",
                    'fechasalida' => "");
                $this->load->view('cabezera_visita');
                $this->load->view('deptovisita_detalles',$data);
            }
            // fin if de busqueda solo con el tipo departamento


            //busqueda especial SOLO con las fechas
            if($tipo_dep==0 and $fec_lleg!=null and $fec_sal!=null and isset($_POST['condiciones'])=="especial"){

                $this->departamento_model->eliminar_filtro_departamento();

                $fecha_auxiliar_llegada= date("Y-m-d");
                $fecha_auxiliar_llegada=$fec_lleg;

                //variable que guarda la fecha de llegada + 1;
                $fecha_auxiliar_ida= strtotime ( '+1 day' , strtotime ( $fecha_auxiliar_llegada ) ) ;
                $fecha_auxiliar_ida = date ( 'Y-m-d' , $fecha_auxiliar_ida );

                while ($fecha_auxiliar_ida <= $fec_sal){
                    $deptos_disponibles = $this->departamento_model->deptos_disponibles_fecha($fecha_auxiliar_llegada,$fecha_auxiliar_ida);

                    foreach ($deptos_disponibles as $item){

                        $this->departamento_model->insertar_filtro_departamento($item['ID_DEPARTAMENTO'],																													$item['ID_EDIFICIO'],
                            $item['NUMERO_PISO'],
                            $item['NUMERO_DEPARTAMENTO'],
                            $item['CODIGO_TIPO'],
                            $item['PRECIO'],
                            $item['PRECIO_EXTRA'],
                            $item['DESCRIPCION'],
                            $fecha_auxiliar_llegada,
                            $fecha_auxiliar_ida);


                    }

                    $fecha_auxiliar_llegada=$fecha_auxiliar_ida;
                    $fecha_auxiliar_ida= strtotime ( '+1 day' , strtotime ( $fecha_auxiliar_llegada ) ) ;
                    $fecha_auxiliar_ida = date ( 'Y-m-d' , $fecha_auxiliar_ida );

                }



                $deptos = $this->departamento_model->consultar_filtro_departamento();
                $this->departamento_model->eliminar_filtro_departamento();


                if($deptos==null){
                    $lista_d = $this->departamento_model->obtener_departamentos();
                    $i=0;
                    foreach ($lista_d as $item) {
                        $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                        $i++;
                    }
                    $data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "No hay departamentos disponibles en ese período.");

                    $this->load->view('cabezera_visita');
                    $this->load->view('deptovisita_detalles',$data);
                }
                else{
                    $i=0;
                    foreach ($deptos as $item) {
                        $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                        $i++;
                    }
                    $data = array('lista_departamentos' => $deptos,'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "",
                        'fechallegada' => $fec_lleg,
                        'fechasalida' => $fec_sal);


                    $this->load->view('cabezera_visita');
                    $this->load->view('deptovisita_detalles_especial',$data);
                }
            }
            //fin busqueda especial SOLO con las fechas

            //busqueda normal SOLO con las fechas
            if($tipo_dep==0 and $fec_lleg!=null and $fec_sal!=null and isset($_POST['condiciones'])!="especial"){

                $deptos = $this->departamento_model->deptos_disponibles_fecha($fec_lleg,$fec_sal);

                if($deptos==null){
                    $lista_d = $this->departamento_model->obtener_departamentos();
                    $i=0;
                    foreach ($lista_d as $item) {
                        $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                        $i++;
                    }
                    $data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "No hay departamentos disponibles en ese período.");

                    $this->load->view('cabezera_visita');
                    $this->load->view('deptovisita_detalles',$data);
                }
                else{
                    $i=0;
                    foreach ($deptos as $item) {
                        $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                        $i++;
                    }
                    $data = array('lista_departamentos' => $deptos,'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "",
                        'fechallegada' => $fec_lleg,
                        'fechasalida' => $fec_sal);
                    $this->load->view('cabezera_visita');
                    $this->load->view('deptovisita_detalles',$data);
                }
            }
            // fin de la busqueda normal SOLO con las fechas


            //busqueda especial con TODOS los filtros
            if($tipo_dep!=0 and $fec_lleg!=null and $fec_sal!=null and isset($_POST['condiciones'])=="especial"){

                //elimino elementos de la tabla auxiliar en base de datos
                $this->departamento_model->eliminar_filtro_departamento();

                //creacion de variables de tipo fecha auxiliares
                $fecha_auxiliar_llegada= date("Y-m-d");
                $fecha_auxiliar_llegada=$fec_lleg;

                //variable que guarda la fecha de llegada + 1;
                $fecha_auxiliar_ida= strtotime ( '+1 day' , strtotime ( $fecha_auxiliar_llegada ) ) ;
                $fecha_auxiliar_ida = date ( 'Y-m-d' , $fecha_auxiliar_ida );

                while ($fecha_auxiliar_ida <= $fec_sal){


                    $deptos_disponibles = $this->departamento_model->deptos_disponibles_fechatipo($tipo_dep,$fec_lleg,$fec_sal);

                    foreach ($deptos_disponibles as $item){

                        $this->departamento_model->insertar_filtro_departamento($item['ID_DEPARTAMENTO'],																													$item['ID_EDIFICIO'],
                            $item['NUMERO_PISO'],
                            $item['NUMERO_DEPARTAMENTO'],
                            $item['CODIGO_TIPO'],
                            $item['PRECIO'],
                            $item['PRECIO_EXTRA'],
                            $item['DESCRIPCION'],
                            $fecha_auxiliar_llegada,
                            $fecha_auxiliar_ida);


                    }
                    $fecha_auxiliar_llegada=$fecha_auxiliar_ida;
                    $fecha_auxiliar_ida= strtotime ( '+1 day' , strtotime ( $fecha_auxiliar_llegada ) ) ;
                    $fecha_auxiliar_ida = date ( 'Y-m-d' , $fecha_auxiliar_ida );

                    $deptos = $this->departamento_model->consultar_filtro_departamento();
                    $this->departamento_model->eliminar_filtro_departamento();



                    if($deptos==null){
                        $lista_d = $this->departamento_model->obtener_departamentos();
                        $i=0;
                        foreach ($lista_d as $item) {
                            $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                            $i++;
                        }
                        $data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
                            'tipo_d' => $tipo_d,
                            'mensaje' => "No hay departamentos disponibles en ese período.",
                            'fechallegada' => "",
                            'fechasalida' => "");
                        $this->load->view('cabezera_visita');
                        $this->load->view('deptovisita_detalles',$data);
                    }
                    else{
                        $i=0;
                        foreach ($deptos as $item) {
                            $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                            $i++;
                        }
                        $data = array('lista_departamentos' => $deptos,'fotos'=>$fotos,
                            'tipo_d' => $tipo_d,
                            'mensaje' => "",
                            'fechallegada' => $fec_lleg,
                            'fechasalida' => $fec_sal);
                        $this->load->view('cabezera_visita');
                        $this->load->view('deptovisita_detalles_especial',$data);
                    }
                }
            }
            // fin busqueda especial con todos los filtros

            //busqueda normal con todas los filtros
            if($tipo_dep!=0 and $fec_lleg!=null and $fec_sal!=null and isset($_POST['condiciones'])!="especial"){

                $deptos = $this->departamento_model->deptos_disponibles_fechatipo($tipo_dep,$fec_lleg,$fec_sal);

                if($deptos==null){
                    $lista_d = $this->departamento_model->obtener_departamentos();
                    $i=0;
                    foreach ($lista_d as $item) {
                        $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                        $i++;
                    }
                    $data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "No hay departamentos disponibles en ese período.",
                        'fechallegada' => "",
                        'fechasalida' => "");
                    $this->load->view('cabezera_visita');
                    $this->load->view('deptovisita_detalles',$data);
                }
                else{
                    $i=0;
                    foreach ($deptos as $item) {
                        $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                        $i++;
                    }
                    $data = array('lista_departamentos' => $deptos,'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "",
                        'fechallegada' => $fec_lleg,
                        'fechasalida' => $fec_sal);
                    $this->load->view('cabezera_visita');
                    $this->load->view('deptovisita_detalles',$data);
                }
            }
            // fin busqueda normal con todos los filtros



            if(($fec_lleg!=null and $fec_sal==null) or ($fec_lleg==null and $fec_sal!=null)){
                $lista_d = $this->departamento_model->obtener_departamentos();
                $i=0;
                foreach ($lista_d as $item) {
                    $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                    $i++;
                }
                $data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
                    'tipo_d' => $tipo_d,
                    'mensaje' => "Debes ingresar ambas fechas para realizar la búsqueda.",
                    'fechallegada' => "",
                    'fechasalida' => "");
                $this->load->view('cabezera_visita');
                $this->load->view('deptovisita_detalles',$data);
            }
        }

    }


    public function buscar_departamentos_user(){

        $this->is_logged_in();

        $this->form_validation->set_rules('tipo_dep', 'Tipo Departamento', '');
        $this->form_validation->set_rules('fec_lleg', 'Fecha Llegada', '');
        $this->form_validation->set_rules('fec_sal', 'Fecha Salida', '');

        if ($this->form_validation->run() == FALSE){
            redirect('login/inicio');
        }
        else{
            $user=$this->session->userdata('usuario');
            $cont=$this->carrito_model->contador_badge($user);
            $datasession=array('usuario' => $this->session->userdata('usuario'),
                'cont'=>$cont);

            $tipo_dep = set_value('tipo_dep');
            $fec_lleg = set_value('fec_lleg');
            $fec_sal = set_value('fec_sal');
			

            $tipo_d = $this->tipo_depto->obtener_tipo_departamentos();

            if($tipo_dep==0 and $fec_lleg==null and $fec_sal==null){
                redirect('login/inicio');
            }

            //Busqueda de departamentos solo seleccionando el tipo
            if($tipo_dep!=0 and $fec_lleg==null and $fec_sal==null){
                
				$result = $this->tipo_depto->datos_departamentos($tipo_dep);
                $i=0;
                foreach ($result as $item) {
                    $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                    $i++;
                }
                $data = array('lista_departamentos' => $result,'fotos'=>$fotos,
                    'tipo_d' => $tipo_d,
                    'mensaje' => "",
                    'fechallegada' => "",
                    'fechasalida' => "");
                $this->load->view('cabezera_cliente',$datasession);
                $this->load->view('deptocliente_detalles',$data);
            }
            // fin if de busqueda solo con el tipo departamento


            //busqueda especial solo con las fechas!!
            if($tipo_dep==0 and $fec_lleg!=null and $fec_sal!=null and isset($_POST['condicion'])=="especial"){
				
				
				$this->departamento_model->eliminar_filtro_departamento();

                $fecha_auxiliar_llegada= date("Y-m-d");
                $fecha_auxiliar_llegada=$fec_lleg;

                //variable que guarda la fecha de llegada + 1;
                $fecha_auxiliar_ida= strtotime ( '+1 day' , strtotime ( $fecha_auxiliar_llegada ) ) ;
                $fecha_auxiliar_ida = date ( 'Y-m-d' , $fecha_auxiliar_ida );

                while ($fecha_auxiliar_ida <= $fec_sal){
                    $deptos_disponibles = $this->departamento_model->deptos_disponibles_fecha($fecha_auxiliar_llegada,$fecha_auxiliar_ida);

                    foreach ($deptos_disponibles as $item){

                        $this->departamento_model->insertar_filtro_departamento($item['ID_DEPARTAMENTO'],																													$item['ID_EDIFICIO'],
                            $item['NUMERO_PISO'],
                            $item['NUMERO_DEPARTAMENTO'],
                            $item['CODIGO_TIPO'],
                            $item['PRECIO'],
                            $item['PRECIO_EXTRA'],
                            $item['DESCRIPCION'],
                            $fecha_auxiliar_llegada,
                            $fecha_auxiliar_ida);


                    }

                    $fecha_auxiliar_llegada=$fecha_auxiliar_ida;
                    $fecha_auxiliar_ida= strtotime ( '+1 day' , strtotime ( $fecha_auxiliar_llegada ) ) ;
                    $fecha_auxiliar_ida = date ( 'Y-m-d' , $fecha_auxiliar_ida );

                }

                $deptos = $this->departamento_model->consultar_filtro_departamento();
                $this->departamento_model->eliminar_filtro_departamento();


                if($deptos==null){
                    $lista_d = $this->departamento_model->obtener_departamentos();
                    $i=0;
                    foreach ($lista_d as $item) {
                        $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                        $i++;
                    }
                    $data = array('lista_departamentos' => $lista_d,
                        'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "No hay departamentos disponibles en ese período.");
                    $this->load->view('cabezera_cliente',$datasession);
                    $this->load->view('deptocliente_detalles',$data);
                }
                else{
                    $i=0;
                    foreach ($deptos as $item) {
                        $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                        $i++;
                    }
                    $data = array('lista_departamentos' => $deptos,
                        'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "",
                        'fechallegada' => $fec_lleg,
                        'fechasalida' => $fec_sal);
                    $this->load->view('cabezera_cliente',$datasession);
                    $this->load->view('deptocliente_detalles_especial',$data);
                }
            }
            //fin busqueda especial solo con las fechas!!

            
            //busqueda normal solo con las fechas!!
            if($tipo_dep==0 and $fec_lleg!=null and $fec_sal!=null and isset($_POST['condicion'])!="especial"){
				
				// creacion de variables tipo fecha para mandar a la consulta con la hora corresponei4n
				$fecha_hora_llegada= date("Y-m-d H:i:s");
                $fecha_hora_llegada=$fec_lleg;
				
				$fecha_hora_salida= date("Y-m-d H:i:s");
                $fecha_hora_salida=$fec_sal;
				
			
                $fecha_hora_llegada= strtotime ( '+15 hour' , strtotime ( $fec_lleg ) ) ;
                $fecha_hora_llegada = date ( 'Y-m-d H:i:s' , $fecha_hora_llegada );
				
				$fecha_hora_salida= strtotime ( '+12 hour' , strtotime ( $fec_sal ) ) ;
                $fecha_hora_salida = date ( 'Y-m-d H:i:s' , $fecha_hora_salida );

				$deptos = $this->departamento_model->deptos_disponibles_fecha($fecha_hora_llegada,$fecha_hora_salida);

                if($deptos==null){
                    $lista_d = $this->departamento_model->obtener_departamentos();
                    $i=0;
                    foreach ($lista_d as $item) {
                      $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                      $i++;
                    }
                    $data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
                                  'tipo_d' => $tipo_d,
                                  'mensaje' => "No hay departamentos disponibles en ese período.");
                    $this->load->view('cabezera_cliente',$datasession);
                    $this->load->view('deptocliente_detalles',$data);
                }
                else{
                    $i=0;
                    foreach ($deptos as $item) {
                      $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                      $i++;
                    }
                    $data = array('lista_departamentos' => $deptos,'fotos'=>$fotos,
                                  'tipo_d' => $tipo_d,
                                  'mensaje' => "",
                                  'fechallegada' => $fec_lleg,
                                  'fechasalida' => $fec_sal);
                    $this->load->view('cabezera_cliente',$datasession);
                    $this->load->view('deptocliente_detalles',$data);
                }
            }
            //fin busqueda normal solo con las fechas!!
            

            //busqueda especial con todos los filtros
            if($tipo_dep!=0 and $fec_lleg!=null and $fec_sal!=null and isset($_POST['condicion'])=="especial"){
				
                //elimino elementos de la tabla auxiliar en base de datos
                $this->departamento_model->eliminar_filtro_departamento();

                //creacion de variables de tipo fecha auxiliares
                $fecha_auxiliar_llegada= date("Y-m-d");
                $fecha_auxiliar_llegada=$fec_lleg;

                //variable que guarda la fecha de llegada + 1;
                $fecha_auxiliar_ida= strtotime ( '+1 day' , strtotime ( $fecha_auxiliar_llegada ) ) ;
                $fecha_auxiliar_ida = date ( 'Y-m-d' , $fecha_auxiliar_ida );

                while ($fecha_auxiliar_ida <= $fec_sal){


                    $deptos_disponibles = $this->departamento_model->deptos_disponibles_fechatipo($tipo_dep,$fec_lleg,$fec_sal);

                    foreach ($deptos_disponibles as $item){

                        $this->departamento_model->insertar_filtro_departamento($item['ID_DEPARTAMENTO'],																										$item['ID_EDIFICIO'],
                            $item['NUMERO_PISO'],
                            $item['NUMERO_DEPARTAMENTO'],
                            $item['CODIGO_TIPO'],
                            $item['PRECIO'],
                            $item['PRECIO_EXTRA'],
                            $item['DESCRIPCION'],
                            $fecha_auxiliar_llegada,
                            $fecha_auxiliar_ida);


                    }
                    $fecha_auxiliar_llegada=$fecha_auxiliar_ida;
                    $fecha_auxiliar_ida= strtotime ( '+1 day' , strtotime ( $fecha_auxiliar_llegada ) ) ;
                    $fecha_auxiliar_ida = date ( 'Y-m-d' , $fecha_auxiliar_ida );

                    $deptos = $this->departamento_model->consultar_filtro_departamento();
                    $this->departamento_model->eliminar_filtro_departamento();

                    if($deptos==null){
                        $lista_d = $this->departamento_model->obtener_departamentos();
                        $i=0;
                        foreach ($lista_d as $item) {
                            $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                            $i++;
                        }
                        $data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
                            'tipo_d' => $tipo_d,
                            'mensaje' => "No hay departamentos disponibles en ese período.",
                            'fechallegada' => "",
                            'fechasalida' => "");
                        $this->load->view('cabezera_cliente',$datasession);
                        $this->load->view('deptocliente_detalles',$data);
                    }
                    else{
                        $i=0;
                        foreach ($deptos as $item) {
                            $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                            $i++;
                        }
                        $data = array('lista_departamentos' => $deptos,'fotos'=>$fotos,
                            'tipo_d' => $tipo_d,
                            'mensaje' => "",
                            'fechallegada' => $fec_lleg,
                            'fechasalida' => $fec_sal);
                        $this->load->view('cabezera_cliente',$datasession);
                        $this->load->view('deptocliente_detalles_especial',$data);
                    }
                }
            }
            //fin busqueda especial con todos los filtros

            //busqueda normal con todos los filtros
            if($tipo_dep!=0 and $fec_lleg!=null and $fec_sal!=null and isset($_POST['condicion'])!="especial"){
				
				// creacion de variables tipo fecha para mandar a la consulta con la hora corresponei4n
				$fecha_hora_llegada= date("Y-m-d H:i:s");
                $fecha_hora_llegada=$fec_lleg;
				
				$fecha_hora_salida= date("Y-m-d H:i:s");
                $fecha_hora_salida=$fec_sal;
				
			
                $fecha_hora_llegada= strtotime ( '+15 hour' , strtotime ( $fec_lleg ) ) ;
                $fecha_hora_llegada = date ( 'Y-m-d H:i:s' , $fecha_hora_llegada );
				
				$fecha_hora_salida= strtotime ( '+12 hour' , strtotime ( $fec_sal ) ) ;
                $fecha_hora_salida = date ( 'Y-m-d H:i:s' , $fecha_hora_salida );	

                $deptos = $this->departamento_model->deptos_disponibles_fechatipo($tipo_dep,$fecha_hora_llegada,$fecha_hora_salida);

                if($deptos==null){
                    $lista_d = $this->departamento_model->obtener_departamentos();
                    $i=0;
                    foreach ($lista_d as $item) {
                        $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                        $i++;
                    }
                    $data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "No hay departamentos disponibles en ese período.",
                        'fechallegada' => "",
                        'fechasalida' => "");
                    $this->load->view('cabezera_cliente',$datasession);
                    $this->load->view('deptocliente_detalles',$data);
                }
                else{
                    $i=0;
                    foreach ($deptos as $item) {
                        $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                        $i++;
                    }
                    $data = array('lista_departamentos' => $deptos,'fotos'=>$fotos,
                        'tipo_d' => $tipo_d,
                        'mensaje' => "",
                        'fechallegada' => $fec_lleg,
                        'fechasalida' => $fec_sal);
                    $this->load->view('cabezera_cliente',$datasession);
                    $this->load->view('deptocliente_detalles',$data);
                }
            }
            //fin busqueda normal con todos los filtros



            if(($fec_lleg!=null and $fec_sal==null) or ($fec_lleg==null and $fec_sal!=null)){

                $lista_d = $this->departamento_model->obtener_departamentos();
                $i=0;
                foreach ($lista_d as $item) {
                    $fotos[$i]=$this->foto_model->buscar_foto_departamento($item['ID_DEPARTAMENTO']);
                    $i++;
                }
                $data = array('lista_departamentos' => $lista_d,'fotos'=>$fotos,
                    'tipo_d' => $tipo_d,
                    'mensaje' => "Debes ingresar ambas fechas para realizar la búsqueda.",
                    'fechallegada' => "",
                    'fechasalida' => "");
                $this->load->view('cabezera_cliente',$datasession);
                $this->load->view('deptocliente_detalles',$data);
            }
        }

    }

}