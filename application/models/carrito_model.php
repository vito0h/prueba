<?php

class Carrito_model extends CI_Model{

    function __Construct()
    {
        $this->load->database();
    }

    function obtener_deptos_carrito($user){

        $rut=$this->buscar_rut($user);
        $query=$this->db->query("SELECT * FROM carrito WHERE rut='".$rut."'");
        return $query->result_array();
    }

    function contador_badge($user){

        $rut = $this->buscar_rut($user);
        $query=$this->db->query("SELECT * FROM carrito WHERE rut='".$rut."'");

        return $query->num_rows();
    }

    function buscar_rut($user){
        $query=$this->db->query("SELECT rut FROM cliente WHERE usuario='".$user."'");
        $rut=null;
        foreach ($query->result_array() as $item){
            $rut=$item['rut'];
        }
        return $rut;
    }

    function buscar_capacidad($id_depto){

        $query = $this->db->query("SELECT * FROM tipo_departamento td
                                  WHERE td.codigo_tipo = (SELECT codigo_tipo FROM departamento d WHERE d.id_departamento='".$id_depto."')");

        return $query->result_array();
    }

    function calcular_dias_reserva($f_salida,$f_llegada){

        $segundos=strtotime($f_salida)-strtotime($f_llegada);
        $dif_dias=intval($segundos/60/60/24);

return $dif_dias;
}

    function delete_carrito_usuario($user){

        $rut = $this->buscar_rut($user);
        $query=$this->db->query("DELETE FROM carrito WHERE rut='".$rut."'");

    }

    function buscar_dcto($id_depto){

        $query = $this->db->query("SELECT * FROM tipo_departamento td
                                  WHERE td.codigo_tipo = (SELECT codigo_tipo FROM departamento d WHERE d.id_departamento='".$id_depto."')");

        return $query->result_array();
    }

    function insert_carrito($rut,$id_depto,$pre_depto,$pre_extra,$precio_totaldias,$dcto,$f_llegada,$f_salida){

        $data=array('rut'=>$rut,
                    'id_depto'=>$id_depto,
                    'precio_depto'=>$pre_depto,
                    'precio_extra'=>$pre_extra,
                    'precio_totaldias'=>$precio_totaldias,
                    'dcto'=>$dcto,
                    'numpersonas'=>0,
                    'f_llegada'=>$f_llegada,
                    'f_salida'=>$f_salida,
                    'subtotal'=>0);

        $result = $this->db->insert('carrito',$data);

        if($result){
            return true;
        }
        else{
            return false;
        }
    }

    function update_carrito($rut,$id_dep,$precio_totaldia,$numpersonas,$f_llegada,$subtotal){

        $result=$this->db->query("UPDATE carrito SET precio_totaldias='".$precio_totaldia."',
                                                     numpersonas='".$numpersonas."',
                                                     subtotal='".$subtotal."'
                                  WHERE rut='".$rut."' AND id_depto='".$id_dep."' AND f_llegada='".$f_llegada."'");

        if($result==1){
            return true;
        }
        else{
            return false;
        }
    }

    //Verifica que el departamento que agrego al carrito no esté repetido para el mismo período
    function buscar_departamento_carrito($rut,$id_depto,$f_llegada,$f_salida){

        $query=$this->db->query("SELECT * FROM carrito c WHERE c.id_depto='".$id_depto."'
                                AND ('".$f_llegada."' BETWEEN c.F_LLEGADA AND c.F_SALIDA
                                OR '".$f_salida."' BETWEEN c.F_LLEGADA AND c.F_SALIDA
                                OR c.F_LLEGADA BETWEEN '".$f_llegada."' AND '".$f_salida."'
                                OR c.F_SALIDA BETWEEN '".$f_llegada."' AND '".$f_salida."')
                                AND c.RUT='".$rut."'");
        $datos=$query->num_rows();

        if($datos==0){ //Si devuelve 0 se puede agregar a carrito
            return true;
        }
        else{
            return false;
        }
    }



    /*****para hacer la reserva*********/

     public function  n_elementosReserva() // para saber si la tabla reserva tiene algun registro.
     {
         $query= $this->db->query("select COUNT(*) RESERVA");

         return $query->num_rows();
     }

    public function  obtener_max_id(){ //obtenemos el ultimo id insertado en la tabla reserva


        $rs = mysql_query("SELECT MAX(ID_RESERVA) AS id FROM RESERVA");
        if ($row = mysql_fetch_row($rs)) {
            $id = trim($row[0]);
        }

            return $id;


    }

    public function  insert_reserva($rut,$precio_total)
    {
        $data=array(
                    'estado'=>1,
                    'rut'=>$rut,
                    'precio_total'=>$precio_total);

        $result = $this->db->insert('reserva',$data);

        return $id=mysql_insert_id();

    }

    public function  insert_reserva_dpto($idreserva,$id_depto,$precio_dpto,$precio_extra,$precio_subtotal,$fecha_inicio,$fecha_fin)
    {
        $data = array('id_reserva'=>$idreserva,
                      'id_departamento'=>$id_depto,
                      'precio_departamento'=>$precio_dpto,
                      'precio_extra'=>$precio_extra,
                      'precio_subtotal'=>$precio_subtotal,
                      'fecha_inicio'=>$fecha_inicio,
                      'fecha_fin'=>$fecha_fin
                    );

         $result =$this->db->insert('reserva_departamento',$data);

    }


}