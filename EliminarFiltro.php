<?php
// Incluir el archivo de conexión (si es necesario)
include('conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumno eliminado</title>
    
    <!-- Link al CSS de Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Listado de Estudiantes Después de Eliminar</h2>

        
<?php

// Verificar si se ha enviado el formulario por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];

        // Verificar que existe el ID
        $queryLocalizar= "SELECT count(id) as numID FROM alumnos WHERE id=$id";
        $resultadoLocalizar = mysqli_query($conexion, $queryLocalizar);


        // Verificar si la consulta fue exitosa
        if ($resultadoLocalizar) {
            $datosAlumno = mysqli_fetch_assoc($resultadoLocalizar);
            $numAlumnos=(int) $datosAlumno['numID'];
            // si existe el resultado igual a 1, puedo eliminarlo:
            if($numAlumnos == 1){
                
                $queryDelete = "DELETE FROM alumnos WHERE id=$id";
                $resultadoBorrar = mysqli_query($conexion, $queryDelete);
            
                // Si la query ha ido bien, muestro un mensaje para indicarlo.

                if ($resultadoBorrar){
                    echo "<div class='container mt-4'>
                        <h2>El usuario se ha borrado correctamente</h2>
                    </div>";
                }else{
                    echo "<div class='container mt-4'>
                <h2>Se ha localizado pero no se ha podido borrar</h2>
              </div>";
                }
            }else{
                echo "<div class='container mt-4'>
                <h2>El numero de alumnos no es el indicado. (Si me interesa borrar de uno en uno)</h2>
              </div>";
            }

            ?>
            <div class="card-body">

                <div class="mb-3">
                    <a href="leerTodos.php" class="btn btn-primary">Ver alumnos</a>
                </div>

                <div class="mb-3">
                    <a href="opciones.php" class="btn btn-primary">Volver</a>
                </div>
            </div>
            <?php
        }else{
            echo "<div class='container mt-4'>
                <h2>No se ha localizado el id</h2>
              </div>";
        }
    }
}

      

?>
<!-- Scripts de Bootstrap -->
     <!-- Agregar el script de Bootstrap 5 desde el CDN al final del body -->
     <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
