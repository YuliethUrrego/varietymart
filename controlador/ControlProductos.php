<?php

Class ControlProductos{

    var $objModeloProductos;

    function __construct($objModeloProductos){
        $this->objModeloProductos=$objModeloProductos;
    }

    function consultarTodos(){


        $comandoSql="SELECT a.*, b.codigo as codigoProveedor, b.nombre as nombreProveedor FROM productos a, proveedores b WHERE a.FK_proveedor = b.codigo order by a.codigo;";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");

        $recordSet=$objControlConexion->ejecutarSelect($comandoSql);

        return $recordSet;//->fetch_array(MYSQLI_BOTH);
        
    
    }

    function consultar(){

        $codigo=$this->objModeloProductos->getcodigo();

        $comandoSql="select * from productos where codigo='".$codigo."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");

        $recordSet=$objControlConexion->ejecutarSelect($comandoSql);

        return $recordSet->fetch_array(MYSQLI_BOTH);
        
    
    }

    function crear(){
        $nombre=$this->objModeloProductos->getnombre();
        $valor=$this->objModeloProductos->getvalor();
        $cantidad=$this->objModeloProductos->getcantidad();
        $observaciones=$this->objModeloProductos->getobservaciones();
        $imagen=$this->objModeloProductos->getimagen();
        $proveedor=$this->objModeloProductos->getfk_proveedor();


        $comandoSql="INSERT INTO productos (nombre, valor, cantidad, observaciones, FK_proveedor, imagen) VALUES('".$nombre."',".$valor.",".$cantidad.",'".$observaciones."','".$proveedor."','".$imagen."')"; 
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");    
        $objControlConexion->ejecutarComandoSql($comandoSql);
        

        $comandoSql="select * from productos where nombre='".$nombre."' and valor='".$valor."' and cantidad='".$cantidad."'";
        $recordSet=$objControlConexion->ejecutarSelect($comandoSql);

        //Cuando cuencuentra un registro 
        if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
           
            //muestra mensaje de confirmación de Proveedor creado
            echo '
            <script>
                window.alert("Se ha creado el producto correctamente");
                window.location= "producto.php";
            </script>';

        }else{            
            //Muestra mensaje de error en caso de no lograr crear el proveedor
            echo "<script>
                    window.alert('Error, no se logró crear el producto')
                </script>";

            }

        $objControlConexion->cerrarBd();
    }


    function editar(){
        $codigo = $this->objModeloProductos->getcodigo();
        $nombre=$this->objModeloProductos->getnombre();
        $valor=$this->objModeloProductos->getvalor();
        $cantidad=$this->objModeloProductos->getcantidad();
        $observaciones=$this->objModeloProductos->getobservaciones();
        $imagen=$this->objModeloProductos->getimagen();
        $proveedor=$this->objModeloProductos->getfk_proveedor();

        $comandoSql="UPDATE productos SET nombre='".$nombre."', valor=".$valor.", cantidad=".$cantidad.", observaciones='".$observaciones."', imagen='".$imagen."', FK_proveedor='".$proveedor."' where codigo='".$codigo."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();

        echo "<script>
                    window.alert('Se editó correctamente');
                    window.location= 'producto.php';
                </script>";

    
    }

    function editarSinImagen(){
        $codigo = $this->objModeloProductos->getcodigo();
        $nombre=$this->objModeloProductos->getnombre();
        $valor=$this->objModeloProductos->getvalor();
        $cantidad=$this->objModeloProductos->getcantidad();
        $observaciones=$this->objModeloProductos->getobservaciones();
        $proveedor=$this->objModeloProductos->getfk_proveedor();

        $comandoSql="UPDATE productos SET nombre='".$nombre."', valor=".$valor.", cantidad=".$cantidad.", observaciones='".$observaciones."', FK_proveedor='".$proveedor."' where codigo='".$codigo."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();

        echo "<script>
                    window.alert('Se editó correctamente');
                    window.location= 'producto.php';
                </script>";

    
    }

    function borrar(){
        $codigo=$this->objModeloProductos->getcodigo();
        $comandoSql="delete from productos where codigo ='".$codigo."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();

    }

}
                
?>