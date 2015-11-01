<?php

class Cliente_model extends CI_Model{


    function __Construct()
    {
        $this->load->database();
    }

    function obtener_clientes()
    {

        $query = $this->db->get('cliente'); //get() es el equivalente a Select * from  nombre_tabla

        return $query->result_array();
    }

    function insert_cliente($rut,$nom,$ape,$sexo,$fdn,$nac,$mail,$tel,$ciu,$usu,$pass){

        $data=array('rut'=>$rut,
            'nombre'=>$nom,
            'apellidos'=>$ape,
            'sexo'=>$sexo,
            'fecha_nacimiento'=>$fdn,
            'nacionalidad'=>$nac,
            'email'=>$mail,
            'telefono'=>$tel,
            'ciudad'=>$ciu,
            'usuario'=>$usu
        );//se crea un array con los campos

        $data2=array('usuario'=>$usu,
            'password'=>$pass,
            'rol'=>"user"
        );
        $result2= $this->db->insert('usuarios',$data2);
        $result= $this->db->insert('cliente',$data);// se inserta a la base de datos

        if($result==1 and $result2==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function buscar_cliente($rut){

        $result= $this->db->query("SELECT rut FROM cliente WHERE rut='".$rut."'");
        $datos=$result->num_rows();

        if($datos==0){
            return true;
        }
        else{
            return false;
        }

    }
    function obtener_historial(){
        $query = $this->db->query("select reserva.RUT,Cliente.NOMBRE,Cliente.APELLIDOS,cliente.TELEFONO,departamento.NUMERO_DEPARTAMENTO,
reserva_departamento.FECHA_INICIO,reserva_departamento.FECHA_FIN
FROM Cliente,reserva,reserva_departamento,departamento
where cliente.RUT=reserva.RUT and reserva.ID_RESERVA=reserva_departamento.ID_RESERVA
and reserva_departamento.ID_DEPARTAMENTO=departamento.ID_DEPARTAMENTO");
        return $query->result_array();
    
    }
	
	  
       function obtener_perfil($usuario){
        $query = $this->db->query("select cliente.rut,cliente.nombre,cliente.apellidos,cliente.email,cliente.telefono,
                                    cliente.ciudad,cliente.usuario
                                    from cliente,usuarios
                                    where cliente.usuario=usuarios.usuario
                                    and '".$usuario."'=usuarios.usuario");
        return $query->result_array();
    
    }
    
        public function modificar_perfil_usuario($contrasena,$usuario_antiguo){

        $data= array('password'=>$contrasena);
		
			
        $this->db->where('usuario',$usuario_antiguo); //LE DECIMOS CUAL QUEREMOS MODIFICAR (CON LA ID)

        $result = $this->db->update('usuarios',$data); //LE MANDAMOS LOS ATOS PAR QUE ACTUALIZARLOS EN LA TABLA
        
	

        if($result==1) // si actualizaco con exitó los datos
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	    public function modificar_perfil_cliente($rut,$email,$telefono,$ciudad){
            
        $data = array('rut'=>$rut,
            'email'=>$email,
            'telefono'=>$telefono,
            'ciudad'=>$ciudad,
        );
        
        
        $this->db->where('rut',$rut); //LE DECIMOS CUAL QUEREMOS MODIFICAR (CON LA ID)

        $result = $this->db->update('cliente',$data); //LE MANDAMOS LOS ATOS PAR QUE ACTUALIZARLOS EN LA TABLA
        
        

        if($result==1) // si actualizaco con exitó los datos
        {
            return true;
        }
        else
        {
            return false;
        }
    
	}
	
		   function obtener_reserva($usuario){
        $query = $this->db->query("select RESERVA.ID_RESERVA,RESERVA.RUT,reserva.PRECIO_TOTAL
									FROM RESERVA,CLIENTE,USUARIOS
									WHERE RESERVA.RUT=CLIENTE.RUT AND CLIENTE.USUARIO=USUARIOS.USUARIO
									AND USUARIOS.USUARIO='".$usuario."'");
        return $query->result_array();
    
    	}
	
	function obtener_detalle_reserva($id_reserva){
        $query = $this->db->query("select reserva_departamento.ID_DEPARTAMENTO,
DEPARTAMENTO.NUMERO_DEPARTAMENTO,
RESERVA_DEPARTAMENTO.PRECIO_DEPARTAMENTO,RESERVA_DEPARTAMENTO.PRECIO_EXTRA,
reserva_departamento.PRECIO_SUBTOTAL,RESERVA_DEPARTAMENTO.FECHA_INICIO,RESERVA_DEPARTAMENTO.FECHA_FIN
FROM RESERVA_DEPARTAMENTO,DEPARTAMENTO
WHERE ID_RESERVA='".$id_reserva."' AND DEPARTAMENTO.ID_DEPARTAMENTO=RESERVA_DEPARTAMENTO.ID_DEPARTAMENTO");
        return $query->result_array();
    
    }
	
			function reservas_activas(){
        	$query = $this->db->query("select *from reserva where estado=1");
        	return $query->result_array();
    
    	}
		
		function anular_reserva($id_reserva){
			$query = $this->db->query("delete from reserva_departamento where ID_RESERVA='".$id_reserva."'");
			$query2 = $this->db->query("delete from reserva where id_reserva='".$id_reserva."'");
			
		
		}
	

}