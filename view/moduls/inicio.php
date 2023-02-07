<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/home.css">
<div class="contenedor">


    <!-------------------------------Saludoi ---->
    <div class="notification">
        <p> Bienvenido, <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?>
                <span class="hidden-xs"><?php echo $_SESSION["apellidos"]; ?></span></span></p>
        <span class="progress"></span>
    </div>
    <div class="container">
        <div>
            <div class="container ml-4">
                <div class="col-md-6">
                    <canvas id="graphtest3" width="5" height="400"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="graphtest4" width="5" height="400"></canvas>
                </div>
            </div>
            <div class="container mt-4">
                <div class="col-md-6">
                    <canvas id="graphtest1" width="5" height="400"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="graphtest2" width="5" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="reloj">
                <span id="tiempo">00 : 00 : 00</span>
            </div> -->
</div>
<script type="text/javascript">
    let coso = document.getElementById("graphtest1").getContext("2d");
    var chart = new Chart(coso, {
        type: "line",
        data: {
            labels: ["", "", "", "","","","","",""],
            datasets: [{
                label: "Reporte de Visitas",
                backgroundColor: "rgb(133,12,12,0.2)",
                borderColor: "rgb(230,23,40)",
                data: [7,4,12,8,4,15,34,12,2],
                fill: true,
                pointBackgroundColor: "rgb(0,0,0)",
            }]
        },
        options: {
            //responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    })
    let coso2 = document.getElementById("graphtest2").getContext("2d");
    var chart = new Chart(coso2, {
        type: "bar",
        data: {
            labels: ["", "", "", ""],
            datasets: [{
                label: "Ventas Mensuales",
                backgroundColor: ["rgb(87,135,255)","rgb(246,185,36)","rgb(226,60,97)","rgb(130,59,206)"],
                borderColor: "rgb(0,0,0)",
                data: [10, 3, 8, 10]
            }]
        },
        options: {
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    })
    let coso3 = document.getElementById("graphtest3").getContext("2d");
    var chart = new Chart(coso3, {
        type: "doughnut",
        data: {
            labels: ["Productos destacados", "Productos menos vendidos", "Productos estancados", "Productos más vendidos"], //el texto de los campos del grafico
            datasets: [{
                backgroundColor: ["rgb(87,135,255,0.8)", "rgb(246,185,36, 0.8)", "rgb(226,60,97, 0.8)", "rgb(19,197,133, 0.8)"], //el color del apartado del grafico (orden segun los labels)
                borderColor: ["rgb(10,63,107)","rgb(246,185,36)","rgb(226,60,97)" ,"rgb(37,133,27)"], //el color del borde del apartado
                data: [10, 3, 8, 10]
            }],
        },
        options: {
            //responsive: true,
            maintainAspectRatio: false
        }

    })
    let coso4 = document.getElementById("graphtest4").getContext("2d");
    var chart = new Chart(coso4, {
        type: "radar",
        data: {
            labels: [
    'Computadoras',
    'Laptops',
    'Monitores',
    'Teclados',
    'Mouses',
    'Cables',
    'Routers'
  ],
  datasets: [{
    label: '',
    data: [65, 59, 70, 81, 56, 55, 40],
    fill: true,
    backgroundColor: 'rgba(255, 99, 132, 0.2)',
    borderColor: 'rgb(255, 99, 132)',
    pointBackgroundColor: 'rgb(255, 99, 132)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(255, 99, 132)'
  }, {
    label: '',
    data: [28, 90, 40, 50, 96, 27, 100],
    fill: true,
    backgroundColor: 'rgba(54, 162, 235, 0.2)',
    borderColor: 'rgb(54, 162, 235)',
    pointBackgroundColor: 'rgb(54, 162, 235)',
    pointBorderColor: '#fff',
    pointHoverBackgroundColor: '#fff',
    pointHoverBorderColor: 'rgb(54, 162, 235)'
  }]
        },
        options: {
            maintainAspectRatio: false
        }
    })
</script>