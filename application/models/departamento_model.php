<?php
/**
 * Created by PhpStorm.
 * User: francisco
 * Date: 12/05/15
 * Time: 21:47
 */

class Departamento_model extends CI_Model{


    function __Construct()
    {
        $this->load->database();
    }

     function obtener_departamentos()
    {

        $query = $this->db->get('departamento'); //get() es el equivalente a Select * from  nombre_tabla

        return $query->result_array();
    }

    function obtener_depto($id){
        $query = $this->db->query("SELECT * FROM departamento WHERE id_departamento='".$id."'");
        return $query->result_array();
    }

    function insert_depto($id_edi,$n_piso,$n_dpto,$cod_tipo,$precio,$pre_extra,$descripcion){

        $data=array('id_edificio'=>$id_edi,
            'numero_piso'=>$n_piso,
            'numero_departamento'=>$n_dpto,
            'codigo_tipo'=>$cod_tipo,
            'precio'=>$precio,
            'precio_extra'=>$pre_extra,
            'descripcion'=>$descripcion);//se crea un array con los campos
        $this->db->insert('departamento',$data);// se inserta ala base de datos

    }

    public function update_depto($id,$id_edi,$piso,$num,$tipo,$precio,$extra,$des){

        $data = array(
            'id_edificio'=>$id_edi,
            'numero_piso'=>$piso,
            'numero_departamento'=>$num,
            'codigo_tipo'=>$tipo,
            'precio'=>$precio,
            'precio_extra'=>$extra,
            'descripcion'=>$des,
        );

        $this->db->where('ID_DEPARTAMENTO',$id); //LE DECIMOS CUAL QUEREMOS MODIFICAR (CON LA ID)

        $result = $this->db->update('departamento',$data); //LE MANDAMOS LOS ATOS PAR QUE ACTUALIZARLOS EN LA TABLA

        if($result==1) // si actualizaco con exitó los datos
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deptos_disponibles_fecha($fecha_llegada,$fecha_salida){

        $query = $this->db->query("SELECT * FROM departamento
                                   WHERE NOT EXISTS(SELECT 1 FROM reserva_departamento
                                   WHERE reserva_departamento.id_departamento = departamento.id_departamento
                                   AND ('".$fecha_llegada."' BETWEEN reserva_departamento.FECHA_INICIO AND reserva_departamento.FECHA_FIN
                                   OR '".$fecha_salida."' BETWEEN reserva_departamento.FECHA_INICIO AND reserva_departamento.FECHA_FIN
                                   OR reserva_departamento.FECHA_INICIO BETWEEN '".$fecha_llegada."' AND '".$fecha_salida."'
                                   OR reserva_departamento.FECHA_FIN BETWEEN '".$fecha_llegada."' AND '".$fecha_salida."'))");

        return $query->result_array();

    }

    public function deptos_disponibles_fechatipo($tipo,$fecha_llegada,$fecha_salida){

        $query = $this->db->query("SELECT * FROM departamento
                                   WHERE NOT EXISTS(SELECT 1 FROM reserva_departamento
                                   WHERE reserva_departamento.id_departamento = departamento.id_departamento
                                   AND ('".$fecha_llegada."' BETWEEN reserva_departamento.FECHA_INICIO AND reserva_departamento.FECHA_FIN
                                   OR '".$fecha_salida."' BETWEEN reserva_departamento.FECHA_INICIO AND reserva_departamento.FECHA_FIN
                                   OR reserva_departamento.FECHA_INICIO BETWEEN '".$fecha_llegada."' AND '".$fecha_salida."'
                                   OR reserva_departamento.FECHA_FIN BETWEEN '".$fecha_llegada."' AND '".$fecha_salida."'))
                                   AND departamento.CODIGO_TIPO = '".$tipo."'");

        return $query->result_array();

    }
	
	//insertar elementos al filtro departamento
	public function insertar_filtro_departamento($id_depto,$id_edi,$n_piso,$n_dpto,$cod_tipo,$precio,$pre_extra,$descripcion,$fecha_inicio,$fecha_fin){

       $data=array('id_departamento'=>$id_depto,
				   'id_edificio'=>$id_edi,
            		'numero_piso'=>$n_piso,
            		'numero_departamento'=>$n_dpto,
            		'codigo_tipo'=>$cod_tipo,
            		'precio'=>$precio,
            		'precio_extra'=>$pre_extra,
            		'descripcion'=>$descripcion,
					'fecha_inicio'=>$fecha_inicio,
					'fecha_fin'=>$fecha_fin);//se crea un array con los campos
        $this->db->insert('filtro_depto',$data);// se inserta ala base de datos

    }
	
	//consultar elementos al filtro departamento
		public function consultar_filtro_departamento(){

	    $query = $this->db->get('filtro_depto'); //get() es el equivalente a Select * from  nombre_tabla
        return $query->result_array();

    }
	
	//eliminar elementos al filtro departamento
		public function eliminar_filtro_departamento(){

	        $query = $this->db->query("truncate filtro_depto");

    }
	

}