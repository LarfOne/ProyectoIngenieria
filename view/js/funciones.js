

// Cargar jQuery
import $ from 'jquery';

// Cargar DataTables
import 'datatables.net';

// Cargar DataTables Bootstrap 4
import 'datatables.net-bs4';

// Cargar Bootstrap 4
import 'bootstrap';

// obtener el botón por su id
var btnMostrarTabla = document.getElementById('btnMostrarTabla');

// agregar evento onclick al botón
btnMostrarTabla.addEventListener('click', function() {
  mostrarTablasVentasMes();
});
function mostrarTablasVentasMes() {
  $.ajax({
    url: 'tablas-reporte.php',
    type: 'POST',
    data: {accion: 'generarTablaVentasMes'},
    dataType: 'html',
    success: function(data) {
      // Insertar la tabla en el contenedor correspondiente
      $('#tablaVentasContainer').html(data);
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}