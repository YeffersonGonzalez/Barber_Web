<?php 
require ("../models/models_admin.php");

include "../controllers/controller_consultas_backend.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>OSIRIS | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/fondo.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../templates/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../templates/AdminLTE-3.0.5/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../templates/AdminLTE-3.0.5/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body >
<div class="container col-6 "  id="container">
     <div class=" form-container sign-up"  >
        <form  action="loginV2.php" role="form" name="frm_registrar" id="frm_registrar" method="POST"  enctype="multipart/form-data">
                <h1>Crear Cuenta</h1>
                <?php
            $password = $_POST['txt_clave'];
            $hashedPassword = sha1($password);
            ?>
           <?php 
            if(isset($_POST["txt_Nombre"])){//verificar la existencia de envio de datos
              $nombr = $_POST["txt_Nombre"];
              $corre = $_POST["txt_correo"]; 
              $$hashedPassword = $_POST["txt_clave"];
              $rol= "3";
              $ext =""; $msgfile = ""; $logError="";
              $objDBO = new DBConfig();
              $objDBO->config();
              $objDBO->conexion();

              $ejecucion = $objDBO->Operaciones("INSERT INTO usuario( user, correo, pass, rol) 
                                                         values('$nombr', '$corre', '$hashedPassword', '$rol')  ");

              if($ejecucion){ // Tod se ejecuto correctamente
                echo "<div class='alert alert-success'>
                         ha sido creado correctamente, regrese a la pagina de inicio
                      </div>";
              }else{ // Algo paso mal
                echo "<div class='alert alert-danger'>
                         Ha ocurrido un error inexperado

                      </div>";
                
              }
              $objDBO->close();
            }
            ?>
            <input required type="text"  id="txt_Nombre" name="txt_Nombre" placeholder="Nombre">
            <input type="Email"  id="txt_correo" name="txt_correo" placeholder="Email">
            <input required type="password" id="txt_clave" name="txt_clave"  placeholder="Password"> 
            <input required type="password" id="txt_clave_repetida" name="txt_clave_repetida"  placeholder="Repetir password">
         <div class="row">
            <div class="icheck-primary">
              <input required  type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               Acepto los terminos</a>
              </label>
            </div> 
         </div>
          <button type="submit" >Registrar</button>
        </form>
        </div>
        
        <script>
        document.getElementById('frm_registrar').addEventListener('submit', function(event) {
            var clave = document.getElementById('txt_clave').value;
            var claveRepeat = document.getElementById('txt_clave_repetida').value;
            var formulario = document.getElementById('frm_registrar');
            if (!formulario.checkValidity()) {
            // Si el formulario no es válido, mostrar un mensaje de error y salir de la función
            alert('Por favor, llena todos los campos requeridos.');
            event.preventDefault();
            }
            if (clave !== claveRepeat) {
            alert('Las contraseñas no coinciden');

            event.preventDefault();
            }
        });
      </script>
      
     <div class="form-container sign-in ">
          <form  method="POST">
            <h1>Iniciar sesion</h1>
            <?php 
                if(isset($_POST["txtuser"])&& isset($_POST["txtpass"])){

                  $objDB = new ExtraerDatos();
                      $user = array(); 
                      $user = $objDB->consultaLogin($_POST["txtuser"]);
                      if($user){
                        if($user[0]["rol"]== 3) {
                          $productos = $objDB->listadoProductos($_POST["txtuser"]);
                            if($productos){
                              // Iniciar la sesión
                             session_start();
                              // Guardar los productos en la variable de sesión
                              $_SESSION['productos'] = $productos;
                        
                              ?>
                              <script> location.href="../mesa_de_servicio/productos_informes2.php" </script>
                              <?php   
                            }
                            
                      }elseif($user[0]["rol"]== 1)
                              {
                              ?>
                              <script> location.href="../mesa_de_servicio/productos_informes.php" </script>
                              <?php 
                              }
                        else{
                          echo"Su clave es incorrecta";
                       }
                      }else{echo"El usuario no exite, registrese ";}
                    }
                    
                  ?>
                  
            <input type="text" id="txtuser" name="txtuser" required  placeholder="usuario">
            <input type="password" id="txtpass" name="txtpass"  placeholder="Password">
            <button type="submit" >Iniciar</button>
          </form>
        </div>
        
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenido de vuelta!</h1>
                    <p>Ingrese sus datos personales para usar todas las funciones del sitio</p>
                    <button type="submit" class="hidden" id="login">Iniciar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Bienvenido a OSIRIS!</h1>
                    <p>Registrate y realiza las solicitudes que desees, nuestro personal se encargará del resto</p>
                    <button type="submit" class="hidden" id="register">Registrar</button>
                </div>
            </div>
        </div>

    </div>
    <script src="script.js"></script>
    <script src="../templates/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../templates/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    
</body>
</html>