<?php
include("connection.php");
$con = connection();

$id = $_GET['id'];

$sql = "SELECT * FROM pacientes WHERE id=:id";
$query = $con->prepare($sql);
$query->bindParam(':id', $id);
$query->execute();

$row = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar los datos enviados desde el formulario de edición
    $id = $_POST['id'];
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

    $sql = "UPDATE pacientes SET sip=:sip, dni=:dni, nombre=:nombre, apellido1=:apellido1, apellido2=:apellido2, telefono=:telefono, fecha_nacimiento=:fecha_nacimiento, localidad=:localidad, calle=:calle, numero=:numero, puerta=:puerta, piso=:piso WHERE id=:id";

    $query = $con->prepare($sql);
    $query->bindParam(':sip', $sip);
    $query->bindParam(':dni', $dni);
    $query->bindParam(':nombre', $nombre);
    $query->bindParam(':apellido1', $apellido1);
    $query->bindParam(':apellido2', $apellido2);
    $query->bindParam(':telefono', $telefono);
    $query->bindParam(':fecha_nacimiento', $fecha_nacimiento);
    $query->bindParam(':localidad', $localidad);
    $query->bindParam(':calle', $calle);
    $query->bindParam(':numero', $numero);
    $query->bindParam(':puerta', $puerta);
    $query->bindParam(':piso', $piso);
    $query->bindParam(':id', $id);

    if ($query->execute()) {
        header("Location: index.php");
        exit();
    } else {
        // Manejar el caso en el que la consulta no se ejecute correctamente
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Actualizar paciente</title>
</head>
<body>
    <h2>Actualizar paciente</h2>
    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        SIP: <input type="text" name="sip" placeholder="SIP" value="<?= $row['sip']?>">
        DNI: <input type="text" name="dni" placeholder="DNI" value="<?= $row['dni']?>">
        NOMBRE: <input type="text" name="nombre" placeholder="Nombre" value="<?= $row['nombre']?>">
        APELLIDO 1: <input type="text" name="apellido1" placeholder="Apellido 1" value="<?= $row['apellido1']?>">
        APELLIDO 2:<input type="text" name="apellido2" placeholder="Apellido 2" value="<?= $row['apellido2']?>">
        TELEFONO: <input type="text" name="telefono" placeholder="Teléfono" value="<?= $row['telefono']?>">
        FECHA NACIMIENTO:<input type="text" name="fecha_nacimiento" placeholder="Fecha Nacimiento" value="<?= $row['fecha_nacimiento']?>">
        LOCALIDAD: <input type="text" name="localidad" placeholder="Localidad" value="<?= $row['localidad']?>">
        CALLE: <input type="text" name="calle" placeholder="Calle" value="<?= $row['calle']?>">
        NUMERO: <input type="text" name="numero" placeholder="Número" value="<?= $row['numero']?>">
        PISO: <input type="text" name="piso" placeholder="Piso" value="<?= $row['piso']?>">
        PUERTA: <input type="text" name="puerta" placeholder="Puerta" value="<?= $row['puerta']?>">

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>