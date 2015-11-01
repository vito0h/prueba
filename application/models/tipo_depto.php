<?php

Class Tipo_depto extends CI_Model
{

    public function insertar_tipo_depto($tipo_depto, $n_habitaciones, $n_banios, $capacidad)
    {
        $data=array('nombre_tipo'=>$tipo_depto,'num_habitaciones'=>$n_habitaciones,'num_banios'=>$n_banios,'capacidad'=>$capacidad, 'descuento'=>0);//se crea un array con los campos
        $result = $this->db->insert('tipo_departamento',$data);// se inserta a la base de datos
        if($result==1) //devuelve  1 si se insertó correctamente la fila.
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function obtener_tipo_departamentos()
    {
        $query = $this->db->get('tipo_departamento'); //get() es el equivalente a Select * from  nombre_tabla
  		//$query = $this->db-query('select * from tipo_departamento');
        return $query->result_array();
    }

    public function datos_tipo_depto($id)
    {
    //$consulta=$this->db->get_where('tipo_departamento',array('CODIGO_TIPO'=>$id));
        $consulta = $this->db->query(" SELECT * from TIPO_DEPARTAMENTO where CODIGO_TIPO='".$id."'");
        return $consulta->result_array();
    }

    public function datos_departamentos($id)
    {
        $consulta = $this->db->query("SELECT * FROM departamento JOIN tipo_departamento ON departamento.CODIGO_TIPO='".$id."' and tipo_departamento.CODIGO_TIPO='".$id."'");
        //$consulta = $this->db->query("SELECT * from DEPARTAMENTO where CODIGO_TIPO='".$id."'");
        return $consulta->result_array();
    }

    public function datosdepartamentos($id)
    {
        $consulta = $this->db->query(" SELECT * from DEPARTAMENTO where ID_DEPARTAMENTO='".$id."'");
        return $consulta->result_array();
    }

    public function update_tipo_depto($id,$tipo_depto,$n_habitaciones,$n_banios,$capacidad)
    {
        $data=array('nombre_tipo'=>$tipo_depto,
                    'num_habitaciones'=>$n_habitaciones,
                    'num_banios'=>$n_banios,
                    'capacidad'=>$capacidad
                    );//LE DECIMOS LOS DATOS QUE VAMOS A ACTUALIZAR

        $this->db->where('CODIGO_TIPO',$id); //LE DECIMOS CUAL QUEREMOS MODIFICAR (CON LA ID)

        $result = $this->db->update('tipo_departamento',$data); //LE MANDAMOS LOS ATOS PAR QUE ACTUALIZARLOS EN LA TABLA

        if($result==1) // si actualizaco con exitó los datos
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update_descuento($tipo,$dcto)
    {
        $data=array('descuento'=>$dcto);
        $this->db->where('NOMBRE_TIPO',$tipo);
        $result = $this->db->update('tipo_departamento',$data);
        if($result==1){
            return true;
        }
        else{
            return false;
        }
    }

    function get_state()
    {
        $query = $this->db->query('SELECT id, state_name FROM state');
        return $query->result();
    }

    function get_cities_by_state ($state)
    {
        $this->db->select('id, city_name');
        $query = $this->db->get('cities');
        $cities = array();
        if($query->result()){
            foreach ($query->result() as $city) {
                $cities[$city->id] = $city->city_name;
            }
            return $cities;
        }
        else{
            return FALSE;
        }
    }
}

?>


 
 







 