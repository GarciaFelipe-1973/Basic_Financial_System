<?php
session_start();
require_once("../conexao.php");

$sql = "SELECT * FROM categoria";
$categorias = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/controle_financeiro.css">

</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Lista de Categorias <i class="bi bi-card-list"></i>
                            <a href="/controle_financeiro/index.php" class="btn btn-ligth float-end"><i class="bi bi-arrow-return-left"></i></a>
                            <a href="create-categoria.php" class="btn btn-dark float-end" style="margin-right: 10px;">Adicionar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php include('../mensagem.php'); ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categorias as $categoria): ?>
                                    <tr>
                                        <td><?php echo $categoria['nome']; ?></td>
                                        <td>
                                            <a href="edit-categoria.php?id=<?php echo $categoria['id']; ?>" class="btn btn-success">Editar</a>
                                            <form action="../acoes.php" method="POST" class="d-inline">
                                                <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
                                                <button onclick="return confirm('Tem certeza que deseja excluir?')" name="delete_categoria" type="submit" class="btn btn-danger">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>