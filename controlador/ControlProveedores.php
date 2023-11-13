<?php

Class ControlProveedores{

    var $objModeloProveedores;

    function __construct($objModeloProveedores){
        $this->objModeloProveedores=$objModeloProveedores;
    }

    function consultarTodos(){


        $comandoSql="select * from proveedores";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");

        $recordSet=$objControlConexion->ejecutarSelect($comandoSql);

        return $recordSet;//->fetch_array(MYSQLI_BOTH);
        
    
    }

    function consultar(){

        $codigo=$this->objModeloProveedores->getcodigo();

        $comandoSql="select * from proveedores where codigo='".$codigo."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");

        $recordSet=$objControlConexion->ejecutarSelect($comandoSql);

        return $recordSet->fetch_array(MYSQLI_BOTH);
        
    
    }

    function consultarPorIdentificacion(){

        $identificacion=$this->objModeloProveedores->getidentificacion();

        $comandoSql="select * from proveedores where identificacion='".$identificacion."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");

        $recordSet=$objControlConexion->ejecutarSelect($comandoSql);

        return $recordSet->fetch_array(MYSQLI_BOTH);
        
    
    }

    function crear(){
        $identificacion=$this->objModeloProveedores->getidentificacion();
        $nombre=$this->objModeloProveedores->getnombre();
        $ciudad=$this->objModeloProveedores->getciudad();
        $direccion=$this->objModeloProveedores->getdireccion();
        $telefono=$this->objModeloProveedores->gettelefono();
        $email=$this->objModeloProveedores->getemail();

        $comandoSql="INSERT INTO proveedores (identificacion, nombre, ciudad, direccion, telefono, email) VALUES('".$identificacion."','".$nombre."','".$ciudad."','".$direccion."','".$telefono."','".$email."')";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");
        $objControlConexion->ejecutarComandoSql($comandoSql);

        $comandoSql="select * from proveedores where identificacion='".$identificacion."'";
        $recordSet=$objControlConexion->ejecutarSelect($comandoSql);

        //Cuando cuencuentra un registro 
        if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
           
            //muestra mensaje de confirmación de Proveedor creado
            echo '
            <script>
                window.alert("Se ha creado el proveedor correctamente");
                window.location= "proveedor.php";
            </script>';

        }else{            
            //Muestra mensaje de error en caso de no lograr crear el proveedor
            echo "<script>
                    window.alert('Error, no se logró crear el proveedor')
                </script>";

            }

        $objControlConexion->cerrarBd();
    }


    function editar(){
        $codigo=$this->objModeloProveedores->getcodigo();
        $identificacion=$this->objModeloProveedores->getidentificacion();
        $nombre=$this->objModeloProveedores->getnombre();
        $ciudad=$this->objModeloProveedores->getciudad();
        $direccion=$this->objModeloProveedores->getdireccion();
        $telefono=$this->objModeloProveedores->gettelefono();
        $email=$this->objModeloProveedores->getemail();

        $comandoSql="UPDATE proveedores SET identificacion='".$identificacion."', nombre='".$nombre."', ciudad='".$ciudad."', direccion='".$direccion."', telefono='".$telefono."', email='".$email."' where codigo='".$codigo."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();

        echo "<script>
                    window.alert('Se editó correctamente');
                    window.location= 'proveedor.php';
                </script>";

    
    }

    function borrar(){
        $codigo=$this->objModeloProveedores->getcodigo();
        $comandoSql="delete from proveedores where codigo ='".$codigo."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();

    }

}
                
?>