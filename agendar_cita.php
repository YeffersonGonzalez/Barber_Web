<?php
include 'controllers/conexion_bd.php';
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

            <form id="agendarCitaForm">
                <label for="cliente_id">Cliente:</label>
                <select id="cliente_id" name="cliente_id" required>
                    <!-- Opciones dinámicas desde la base de datos -->
                </select>

                <label for="barbero_id">Barbero:</label>
                <select id="barbero_id" name="barbero_id" required>
                    <!-- Opciones dinámicas desde la base de datos -->
                </select>

                <label for="servicio_id">Servicio:</label>
                <select id="servicio_id" name="servicio_id" required>
                    <!-- Opciones dinámicas desde la base de datos -->
                </select>
<script>
                document.addEventListener('DOMContentLoaded', function() {
    fetch('./api/api_get_clientes.php')
        .then(response => response.json())
        .then(data => {
            const clienteSelect = document.getElementById('cliente_id');
            data.forEach(cliente => {
                let option = document.createElement('option');
                option.value = cliente.id;
                option.text = cliente.nombre;
                clienteSelect.appendChild(option);
            });
        });

    fetch('./api/api_get_barberos.php')
        .then(response => response.json())
        .then(data => {
            const barberoSelect = document.getElementById('barbero_id');
            data.forEach(barbero => {
                let option = document.createElement('option');
                option.value = barbero.id;
                option.text = barbero.nombre;
                barberoSelect.appendChild(option);
            });
        });

    fetch('./api/api_get_servicios.php')
        .then(response => response.json())
        .then(data => {
            const servicioSelect = document.getElementById('servicio_id');
            data.forEach(servicio => {
                let option = document.createElement('option');
                option.value = servicio.id;
                option.text = servicio.nombre;
                servicioSelect.appendChild(option);
            });
        });
});
</script>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>

                <input type="submit" value="Agendar Cita">
            </form>

            <div id="respuesta"></div>


            
            

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        document.getElementById('agendarCitaForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const cliente_id = document.getElementById('cliente_id').value;
    const barbero_id = document.getElementById('barbero_id').value;
    const servicio_id = document.getElementById('servicio_id').value;
    const fecha = document.getElementById('fecha').value;
    const hora = document.getElementById('hora').value;

    const data = {
        cliente_id: cliente_id,
        barbero_id: barbero_id,
        servicio_id: servicio_id,
        fecha: fecha,
        hora: hora
    };

    fetch('api/api_agendarcita.php', {
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