<?php
require 'bdd.php';
$id = 0;

if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];

    // delete data
    $pdo = BDD::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM `noticias` WHERE id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    BDD::disconnect();
    header("Location: index.php");
}
require 'header.php';
?>
<div class="span10 offset1">
    <div class="row">
        <h3>Eliminar noticia</h3>
    </div>

    <form class="form-horizontal" action="eliminar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <p class="alert alert-error">¿Estás seguro de eliminar la noticia <?php echo $id; ?>?</p>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">Sí</button>
                <a class="btn" href="index.php">No</a>
            </div>
        </div>

    </form>
</div>
<?php
require 'footer.php';
?>