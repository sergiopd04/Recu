<?php
include("connection.php");
$con = connection();

// Variables para paginación
$limit = 10; // Número de registros por página
$page = isset($_GET['page']) ? $_GET['page'] : 1; // Página actual, por defecto es 1

// Consulta para obtener el total de registros
$totalRecords = $con->query("SELECT COUNT(*) AS total FROM pacientes")->fetchColumn();
$totalPages = ceil($totalRecords / $limit); // Total de páginas

// Calcular el offset
$offset = ($page - 1) * $limit;

// Consulta para obtener los registros de la página actual
$sql = "SELECT * FROM pacientes LIMIT :limit OFFSET :offset";
$query = $con->prepare($sql);
$query->bindValue(':limit', $limit, PDO::PARAM_INT);
$query->bindValue(':offset', $offset, PDO::PARAM_INT);
$query->execute();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users CRUD</title>
</head>

<body>

<h3>Nuevo paciente</h3>
    <form method="POST" action="create_patient.php">
        <input type="text" name="sip" placeholder="SIP" required>
        <input type="text" name="dni" placeholder="DNI" required>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido1" placeholder="Apellido1" required>
        <input type="text" name="apellido2" placeholder="Apellido2" required>
        <input type="text" name="telefono" placeholder="Teléfono" required>
        <input type="date" name="fecha_nacimiento" placeholder="Fecha de nacimiento" required>
        <input type="text" name="localidad" placeholder="Localidad" required>
        <input type="text" name="calle" placeholder="Calle" required>
        <input type="text" name="numero" placeholder="Número" required>
        <input type="text" name="piso" placeholder="Piso">
        <input type="text" name="puerta" placeholder="Puerta">
        
        <button type="submit">Crear paciente</button>
    </form>

    <div>
        <h2>Usuarios registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>SIP</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellido 1</th>
                    <th>Apellido 2</th>
                    <th>TLF</th>
                    <th>Sexo</th>
                    <th>Fecha nacimiento</th>
                    <th>Localidad</th>
                    <th>Calle</th>
                    <th>Número</th>
                    <th>Piso</th>
                    <th>Puerta</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $query->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['sip'] ?></td>
                        <td><?= $row['dni'] ?></td>
                        <td><?= $row['nombre'] ?></td>
                        <td><?= $row['apellido1'] ?></td>
                        <td><?= $row['apellido2'] ?></td>
                        <td><?= $row['telefono'] ?></td>
                        <td><?= $row['sexo'] ?></td>
                        <td><?= $row['fecha_nacimiento'] ?></td>
                        <td><?= $row['localidad'] ?></td>
                        <td><?= $row['calle'] ?></td>
                        <td><?= $row['numero'] ?></td>
                        <td><?= $row['puerta'] ?></td>
                        <td><?= $row['piso'] ?></td>
                        <td><button><a href="update.php?id=<?= $row['id'] ?>" >Editar</a></button></td>
                        <td><button><a href="delete_user.php?id=<?= $row['id'] ?>">Eliminar</a></button></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Paginador -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="index.php?page=<?= $page - 1 ?>" class="arrow">&lt;</a>
            <?php endif; ?>

            <?php if ($totalPages <= 3): ?>
                <!-- Si hay menos de 4 páginas, mostrar todos los enlaces -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="index.php?page=<?= $i ?>" <?php if ($i === $page) echo "class='active'" ?>><?= $i ?></a>
                <?php endfor; ?>
            <?php else: ?>
                <!-- Si hay 4 o más páginas -->
                <?php if ($page <= 2): ?>
                    <!-- Mostrar los primeros 3 enlaces -->
                    <?php for ($i = 1; $i <= 3; $i++): ?>
                        <a href="index.php?page=<?= $i ?>" <?php if ($i === $page) echo "class='active'" ?>><?= $i ?></a>
                    <?php endfor; ?>
                    <span>...</span>
                    <a href="index.php?page=<?= $totalPages ?>" class="arrow">>></a>
                <?php elseif ($page >= $totalPages - 1): ?>
                    <!-- Mostrar los últimos 3 enlaces -->
                    <a href="index.php?page=1" class="arrow"><<</a>
                    <span>...</span>
                    <?php for ($i = $totalPages - 2; $i <= $totalPages; $i++): ?>
                        <a href="index.php?page=<?= $i ?>" <?php if ($i === $page) echo "class='active'" ?>><?= $i ?></a>
                    <?php endfor; ?>
                <?php else: ?>
                    <!-- Mostrar enlaces intermedios -->
                    <a href="index.php?page=1" class="arrow"><<</a>
                    <span>...</span>
                    <?php for ($i = $page - 1; $i <= $page + 1; $i++): ?>
                        <a href="index.php?page=<?= $i ?>" <?php if ($i === $page) echo "class='active'" ?>><?= $i ?></a>
                    <?php endfor; ?>
                    <span>...</span>
                    <a href="index.php?page=<?= $totalPages ?>" class="arrow">>></a>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($page < $totalPages): ?>
                <a href="index.php?page=<?= $page + 1 ?>" class="arrow">&gt;</a>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>