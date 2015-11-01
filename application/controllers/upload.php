<?php
class Upload extends CI_Controller {
	
	function index($id){
		$data=array(
                    'usuario' =>$this->session->userdata('usuario')
                );

			$data2=array('id_departamento'=>$id);

            $this->load->view('cabezera',$data);
            $this->load->view('cargar_fotos',$data2);
	}
	
	function do_upload($id_departamento)
	{
		
			$count = 0;
		    $exito = 0;
		    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
			    foreach ($_FILES['files']['name'] as $i => $name) {
				    if (strlen($_FILES['files']['name'][$i]) > 1) {
					    if (move_uploaded_file($_FILES['files']['tmp_name'][$i],'./img/'.$name)) {
					    	$count++;
					    	$exito = 1;
						    	$tama=$this->foto_model->todas_fotos();
							    $id_foto=count($tama)+1;
							    $foto=$name;
							    $result=$this->foto_model->agregar_foto($id_foto,$foto);
							    $ingreso=$this->foto_model->enlazar_foto($id_departamento,$id_foto);
					    }
				    }
			    }
		    }
		

		    if($ingreso){
                $result = $this->departamento_model->obtener_departamentos();

                $data=array('query' =>$result,
                    'usuario' =>$this->session->userdata('usuario')
                );
                $this->load->view('cabezera',$data);
                $this->load->view('departamento_detalles');
            }
            else{ // si falla lo mandamos a cualquier vista.. solo por mientras hasta definir bien a que vista
            	$data=array('query' =>$result,
                    'usuario' =>$this->session->userdata('usuario')
                );
                $this->load->view('cabezera',$data);
                $this->load->view('cabezera_cuerpo');

            }
	}

}


?>