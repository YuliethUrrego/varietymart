<?php
	class ModeloUsuarios{

		var $codigo;
		var $nombre;
		var $apellido;
		var $cedula;
        var $correo;
        var $contrasena;
        var $ciudad;
		var $sexo;


		function __construct($codigo, $nombre, $apellido, $cedula, $correo, $contrasena, $ciudad, $sexo){
			$this->codigo=$codigo;
			$this->nombre=$nombre;
			$this->apellido=$apellido;
			$this->cedula=$cedula;
            $this->correo=$correo;
            $this->contrasena=$contrasena;
            $this->ciudad=$ciudad;
			$this->sexo=$sexo;
		}

		function setcodigo($codigo){
			$this->codigo=$codigo;
		}
		function getcodigo(){
			return $this->codigo;
        }

		function setnombre($nombre){
			$this->nombre=$nombre;
		}
		function getnombre(){
			return $this->nombre;
        }

		function setapellido($apellido){
			$this->apellido=$apellido;
		}
		function getapellido(){
			return $this->apellido;
        }

		function setcedula($cedula){
			$this->cedula=$cedula;
		}
		function getcedula(){
			return $this->cedula;
        }

		function setcorreo($correo){
			$this->correo=$correo;
		}
		function getcorreo(){
			return $this->correo;
        }

		function setcontrasena($contrasena){
			$this->contrasena=$contrasena;
		}
		function getcontrasena(){
			return $this->contrasena;
        }

		function setciudad($ciudad){
			$this->ciudad=$ciudad;
		}
		function getciudad(){
			return $this->ciudad;
        }

		function setsexo($sexo){
			$this->sexo=$sexo;
		}
		function getsexo(){
			return $this->sexo;
        }

		
    }

?>


        