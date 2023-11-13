<?php

session_start();

Class ControlUsuarios{

    var $objModeloUsuarios;

    function __construct($objModeloUsuarios){
        $this->objModeloUsuarios=$objModeloUsuarios;
    }

    function registrar(){
        $nombre=$this->objModeloUsuarios->getnombre();
        $apellido=$this->objModeloUsuarios->getapellido();
        $cedula=$this->objModeloUsuarios->getcedula();
        $correo=$this->objModeloUsuarios->getcorreo();
        $contrasena=$this->objModeloUsuarios->getcontrasena();

        $comandoSql="INSERT INTO usuarios (nombre, apellido, cedula, correo, contrasena) VALUES('".$nombre."','".$apellido."',".$cedula.",'".$correo."','".$contrasena."')";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");
        $objControlConexion->ejecutarComandoSql($comandoSql);

        $comandoSql="select * from usuarios where correo='".$correo."' and contrasena='".$contrasena."'";

        $recordSet=$objControlConexion->ejecutarSelect($comandoSql);

        //var_dump($recordSet); da información sobre ese objeto

        //Cuando cuencuentra un registro 
        if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
           
            //muestra mensaje de confirmación de registro de usuario
            echo '
            <script>
                window.alert("Se ha registrado el usuario correctamente, ahora puede ingresar al sistema");
                window.location= "login.php";
            </script>';

        }else{            
            //Muestra mensaje de error en caso de no logearse
            echo "<script>
                    window.alert('Error,no se logró crear el usuario')
                </script>";

            }

        $objControlConexion->cerrarBd();
    }

    function editar(){
        $codigo=$this->objModeloUsuarios->getcodigo();
        $nombre=$this->objModeloUsuarios->getnombre();
        $apellido=$this->objModeloUsuarios->getapellido();
        $contrasena=$this->objModeloUsuarios->getcontrasena();
        $ciudad=$this->objModeloUsuarios->getciudad();
        $sexo=$this->objModeloUsuarios->getsexo();

        $comandoSql="UPDATE usuarios SET nombre='".$nombre."', apellido='".$apellido."', contrasena='".$contrasena."', ciudad='".$ciudad."', sexo='".$sexo."' where codigo='".$codigo."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();

        echo "<script>
                    window.alert('Se editó correctamente')
                </script>";

    
    }

    function borrar(){
        $codigo=$this->objModeloUsuarios->getcodigo();
        $comandoSql="delete from usuarios where codigo ='".$codigo."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");
        $objControlConexion->ejecutarComandoSql($comandoSql);
        $objControlConexion->cerrarBd();

    }

    function consultar(){

        $codigo=$this->objModeloUsuarios->getcodigo();

        $comandoSql="select * from usuarios where codigo='".$codigo."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");

        $recordSet=$objControlConexion->ejecutarSelect($comandoSql);

        return $recordSet->fetch_array(MYSQLI_BOTH);
        
    
    }
    
    function IngresoUsuarios(){
        
        $correo = $this->objModeloUsuarios->getcorreo();
        $contrasena = $this->objModeloUsuarios->getcontrasena();

        $comandoSql="select * from usuarios where correo='".$correo."' and contrasena='".$contrasena."'";
        $objControlConexion=new ControlConexion();
        $objControlConexion->abrirBd("localhost", "root", "","varietymart");

        $recordSet=$objControlConexion->ejecutarSelect($comandoSql);

        //var_dump($recordSet); //da información sobre ese objeto

        //Cuando enciuentra un registro es porque allí esta el user y pass correctos
        if($row=$recordSet->fetch_array(MYSQLI_BOTH)){
           
            //Crea la variable de sesión
             $_SESSION["iniciarSesion"] = "ok";
             $_SESSION["codigoUsuario"] = $row["codigo"];
             $_SESSION["rolUsuario"] = $row["rol"];
             
            //redirreccionar al incio
           echo '
            <script>
                window.location = "../producto/producto.php";
            </script>';

        }else{            
            //Muestra mensaje de error en caso de no logearse
            echo "<script>
                    window.alert('Error, usuario y/o contraseña incorrectos')
                </script>";

            }
        }

    }
                
?>