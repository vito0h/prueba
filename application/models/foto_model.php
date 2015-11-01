<?php 

	class Foto_model extends CI_model{


		public function todas_fotos(){

			$consulta=$this->db->query("SELECT * FROM FOTO");
			return $consulta->result_array();
		}

		public function agregar_foto($id_foto,$foto){

			$data=array('id_foto'=>$id_foto,'foto'=>$foto);

			$this->db->insert('FOTO',$data);

		}

		public function enlazar_foto($id_departamento,$id_foto){

			$data=array('id_departamento'=>$id_departamento,'id_foto'=>$id_foto);

			$this->db->insert('MULTI_FOTOS',$data);
			return true;

		}


		public function buscar_foto_departamento($id_departamento){

			$consulta=$this->db->query(" SELECT * FROM FOTO WHERE ID_FOTO IN (SELECT ID_FOTO FROM MULTI_FOTOS WHERE id_departamento='".$id_departamento."')");

			return $consulta->result_array();


		}
	}
 ?>