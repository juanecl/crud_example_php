<?php
require 'bdd.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {
    $tituloError = null;
    $descError = null;
    $fechaError = null;

    // keep track post values
    $titulo = $_POST['titulo'];
    $desc = $_POST['desc'];
    $fecha = date("Y-m-d", time());

    $validar = true;
    if (empty($titulo)) {
        $tituloError = 'Ingrese título';
        $validar = false;
    }

    if (empty($desc)) {
        $descError = 'Ingrese descripción';
        $validar = false;
    }

    // update data
    if ($validar) {
        $pdo = BDD::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE `noticias` SET `titulo` = ?, `desc` = ?, `fecha` = ? WHERE `id` = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($titulo, $desc, $fecha, $id));
        BDD::disconnect();
        header("Location: index.php");
    }
} else {
    $pdo = BDD::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM noticias where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $titulo = $data['titulo'];
    $desc = $data['desc'];
    $fecha = $data['fecha'];

    BDD::disconnect();
}
require 'header.php';
?>


<div class="col-md-10 offset1">
    <div class="row">
        <h3>Modificar noticia</h3>
    </div>

    <form class="form-horizontal" role="form" action="modificar.php?id=<?php echo $id ?>" method="post">
        <div class="form-group <?php echo!empty($tituloError) ? 'error' : ''; ?>">
            <label for="titulo" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" value="<?php echo!empty($titulo) ? $titulo : ''; ?>">
                <?php if (!empty($tituloError)): ?>
                    <span class="help-inline"><?php echo $tituloError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="desc" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
                <textarea name="desc" placeholder="Descripción" class="form-control" rows="3"><?php echo!empty($desc) ? $desc : ''; ?></textarea>
                <?php if (!empty($descError)): ?>
                    <span class="help-inline"><?php echo $descError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Modificar</button>
                <a class="btn" href="index.php">Volver</a>
            </div>
        </div>
    </form>

</div>

<?php
require 'footer.php';
?>