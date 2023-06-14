<?php

include("connection.php");
$con = connection();

$id = $_GET["id"];

$sql = "DELETE FROM pacientes WHERE id=:id";
$query = $con->prepare($sql);
$query->bindParam(':id', $id);

if ($query->execute()) {
    header("Location: index.php");
    exit();
} else {
    // Manejar el caso en el que la consulta no se ejecute correctamente
}
?>