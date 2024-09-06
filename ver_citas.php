<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Citas</title>
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

        <!-- =========== Content ========== -->
        <br>
        
        <div class="content" >
            <div class="container">
                
                <h2 class="Name">Lista de Citas</h2>
            
                <table class="row Name" id="tablaCitas">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Barbero</th>
                            <th>Servicio</th>
                            <th>Fecha de la Cita</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se mostrarán las citas -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('./api/api_get_citas.php')
                .then(response => response.json())
                .then(data => {
                    const tablaCitas = document.querySelector('#tablaCitas tbody');
                    data.forEach(cita => {
                        let row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${cita.id}</td>
                            <td>${cita.cliente}</td>
                            <td>${cita.barbero}</td>
                            <td>${cita.servicio}</td>
                            <td>${cita.fecha_cita}</td>
                            <td>${cita.estado}</td>
                        `;
                        tablaCitas.appendChild(row);
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
</body>
</html>

