<?php
	class ModeloProductos{

		var $codigo;
		var $nombre;
		var $valor;
		var $cantidad;
        var $observaciones;
        var $imagen;
		var $fk_proveedor;

		function __construct($codigo, $nombre, $valor, $cantidad, $observaciones, $imagen, $fk_proveedor){
			$this->codigo=$codigo;
			$this->nombre=$nombre;
			$this->valor=$valor;
            $this->cantidad=$cantidad;
            $this->observaciones=$observaciones;
            $this->imagen=$imagen;
			$this->fk_proveedor=$fk_proveedor;
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

		function setvalor($valor){
			$this->valor=$valor;
		}
		function getvalor(){
			return $this->valor;
        }

		function setcantidad($cantidad){
			$this->cantidad=$cantidad;
		}
		function getcantidad(){
			return $this->cantidad;
        }

		function setobservaciones($observaciones){
			$this->observaciones=$observaciones;
		}
		function getobservaciones(){
			return $this->observaciones;
        }

		function setimagen($imagen){
			$this->imagen=$imagen;
		}
		function getimagen(){
			return $this->imagen;
        }

		function setfk_proveedor($fk_proveedor){
			$this->fk_proveedor=$fk_proveedor;
		}
		function getfk_proveedor(){
			return $this->fk_proveedor;
        }
		
    }

?>


        