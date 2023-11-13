<?php
	class ModeloProveedores{

		var $codigo;
		var $identificacion;
		var $nombre;
		var $ciudad;
        var $direccion;
        var $telefono;
        var $email;


		function __construct($codigo, $identificacion, $nombre, $ciudad, $direccion, $telefono, $email){
			$this->codigo=$codigo;
			$this->identificacion=$identificacion;
			$this->nombre=$nombre;
			$this->ciudad=$ciudad;
            $this->direccion=$direccion;
            $this->telefono=$telefono;
            $this->email=$email;
		}

		function setcodigo($codigo){
			$this->codigo=$codigo;
		}
		function getcodigo(){
			return $this->codigo;
        }

		function setidentificacion($identificacion){
			$this->identificacion=$identificacion;
		}
		function getidentificacion(){
			return $this->identificacion;
        }

		function setnombre($nombre){
			$this->nombre=$nombre;
		}
		function getnombre(){
			return $this->nombre;
        }

		function setciudad($ciudad){
			$this->ciudad=$ciudad;
		}
		function getciudad(){
			return $this->ciudad;
        }

		function setdireccion($direccion){
			$this->direccion=$direccion;
		}
		function getdireccion(){
			return $this->direccion;
        }

		function settelefono($telefono){
			$this->telefono=$telefono;
		}
		function gettelefono(){
			return $this->telefono;
        }

		function setemail($email){
			$this->email=$email;
		}
		function getemail(){
			return $this->email;
        }
		
    }

?>


        