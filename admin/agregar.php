<?php
require 'bdd.php';

if (!empty($_POST)) {
    $tituloError = null;
    $descError = null;

    $titulo = $_POST['titulo'];
    $desc = $_POST['desc'];
    $fecha = date("Y-m-d", time());

    $validar = true;
    if (empty($titulo)) {
        $tituloError = 'Ingresa un título';
        $validar = false;
    }

    if (empty($desc)) {
        $descError = 'Ingresa una descripción';
        $validar = false;
    }

    if ($validar) {
        $pdo = BDD::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO `noticias`(`titulo`,`desc`,`fecha`) VALUES(?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($titulo, $desc, $fecha));
        BDD::disconnect();
        header("Location: index.php");
    }
}
require 'header.php';
?>

<div class="span10 offset1">
    <div class="row">
        <h3>Ingresar una noticia</h3>
    </div>
    <form class="form-horizontal" role="form" action="agregar.php" method="post">
        <div class="form-group <?php echo!empty($tituloError) ? 'error' : ''; ?>">
            <label for="titulo" class="col-sm-2 control-label">Título</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título">
                <?php if (!empty($tituloError)): ?>
                    <span class="help-inline"><?php echo $tituloError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <label for="desc" class="col-sm-2 control-label">Descripción</label>
            <div class="col-sm-10">
                <textarea name="desc" placeholder="Descripción" class="form-control" rows="3"></textarea>
                <?php if (!empty($descError)): ?>
                    <span class="help-inline"><?php echo $descError; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Agregar</button>
                <a class="btn" href="index.php">Volver</a>
            </div>
        </div>
    </form>
</div>
<?php
require 'footer.php';
?>