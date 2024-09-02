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
    <link rel="stylesheet" href="css/style.css">
    
    
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
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
        <!-- Aquí se mostrará el calendario -->
        <div id="calendar" class="calendar"></div>

    
      
    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>
    
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/moment-timezone/main.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction/main.min.js'></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: 'controllers/eventos.php' // Archivo PHP que retornará las citas en formato JSON
            });

            calendar.render();
        });
    </script>
    <script src="assets/js/main.js"></script>
    

    </div>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>