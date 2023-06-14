<?php
include("connection.php");
$con = connection();

// Obtener los datos del formulario
$sip = $_POST['sip'];
$dni = $_POST['dni'];
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$telefono = $_POST['telefono'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$localidad = $_POST['localidad'];
$calle = $_POST['calle'];
$numero = $_POST['numero'];
$puerta = $_POST['puerta'];
$piso = $_POST['piso'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO pacientes (sip, dni, nombre, apellido1, apellido2, telefono, fecha_nacimiento, localidad, calle, numero, puerta, piso) 
        VALUES (:sip, :dni, :nombre, :apellido1, :apellido2, :telefono, :fecha_nacimiento, :localidad, :calle, :numero, :puerta, :piso)";
$query = $con->prepare($sql);
$query->bindParam(':sip', $sip, PDO::PARAM_STR);
$query->bindParam(':dni', $dni, PDO::PARAM_STR);
$query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$query->bindParam(':apellido1', $apellido1, PDO::PARAM_STR);
$query->bindParam(':apellido2', $apellido2, PDO::PARAM_STR);
$query->bindParam(':telefono', $telefono, PDO::PARAM_STR);
$query->bindParam(':fecha_nacimiento', $fecha_nacimiento, PDO::PARAM_STR);
$query->bindParam(':localidad', $localidad, PDO::PARAM_STR);
$query->bindParam(':calle', $calle, PDO::PARAM_STR);
$query->bindParam(':numero', $numero, PDO::PARAM_STR);
$query->bindParam(':puerta', $puerta, PDO::PARAM_STR);
$query->bindParam(':piso', $piso, PDO::PARAM_STR);
$query->execute();

// Redireccionar de vuelta a la página principal después de crear el paciente
header("Location: index.php");
exit();
?>
