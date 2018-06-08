<?php
require 'header.php';
?>
<div class="row">
    <h2>Mantenedor de noticias</h2>
</div>
<div class="row">
    <p>
        <a href="agregar.php" class="btn btn-success">Agregar</a>
    </p>

    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha de ingreso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'bdd.php';
            $pdo = BDD::connect();
            $sql = 'SELECT * FROM noticias';
            foreach ($pdo->query($sql) as $row) {
                echo '<tr>';
                echo '<td>' . $row['titulo'] . '</td>';
                echo '<td>' . $row['desc'] . '</td>';
                echo '<td>' . $row['fecha'] . '</td>';
                echo '<td width=250>';
                echo '<a class="btn btn-success" href="modificar.php?id=' . $row['id'] . '">Modificar</a>';
                echo '&nbsp;';
                echo '<a class="btn btn-danger" href="eliminar.php?id=' . $row['id'] . '">Eliminar</a>';
                echo '</td>';
                echo '</tr>';
            }
            BDD::disconnect();
            ?>
        </tbody>
    </table>
</div>
<?php
require 'footer.php';
?>