<?php
//include 'controllers/conexion_bd.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/form.css">
    
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div>
        <div class="navigation">
            <?php 
            include "includes/lateralaside.php";
            
            ?>
        </div>
    </div>

    <!-- ========================= Main ==================== -->
    <div class="main">
    <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                    <button class="" type="submit">
                    <input class="" type="search" placeholder="Search" aria-label="Search">
                    </button>
                        
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
            </div>
        
            <br>
        <div class="box-form ">
     
     <form role="form" name="registroForm" id="registroForm" method="POST" enctype="multipart/form-data" action="api/api_registro.php" >
         
         <div>
            <br>
           <h1 class="Name">Usuario</h1><br>
           </div>
         <div class="row ">
         <div>
                    <label for="nombre" >Nombre Completo:</label>
                    <input type="text" class="casilla"  id="nombre" name="nombre" required>
                </div>

                <div>
                     <label for="email" >Correo Electrónico:</label>
                    <input type="email" class="casilla" id="email" name="email" required>
                </div>
                <div>
                    <label for="telefono" >Teléfono:</label>
                    <input type="text" class="casilla" id="telefono" name="telefono">
                </div>

                <div>
                    <label for="tipo" >Tipo de Usuario:</label>
                    <select id="tipo" name="tipo" class="casilla"required class="cardName">
                        <option value="cliente">Cliente</option>
                        <option value="barbero">Barbero</option>
                    </select>
                </div>
                
                
                <div><br>
                    <input type="submit" class=" btnv" value="Guardar">
                    <a href='index.php' class='btng' style=' text-decoration:none'>Cancelar</a>
                </div> 
                
                <div id="respuesta"></div>
       </form> <br>
     </div>





     

    </div>

    
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- ====== Script para Manejar el Formulario ====== -->
    <script>
        document.getElementById('registroForm').addEventListener('submit', function(event) {
            event.preventDefault();

            // Capturar los datos del formulario
            const nombre = document.getElementById('nombre').value;
            const email = document.getElementById('email').value;
            const telefono = document.getElementById('telefono').value;
            const tipo = document.getElementById('tipo').value;

            // Crear objeto con los datos
            const data = {
                nombre: nombre,
                email: email,
                telefono: telefono,
                tipo: tipo
            };

            // Enviar los datos a la API
            fetch('api/api_registro.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('respuesta').innerText = data.success;
                } else {
                    document.getElementById('respuesta').innerText = data.error;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
</body>

</html>
