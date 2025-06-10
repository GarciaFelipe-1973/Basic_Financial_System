<?php
session_start();
require_once("conexao.php");

if (isset($_GET['id'])) {
    $categoria_id = (int)$_GET['id'];

    $sql = "SELECT * FROM movimentacao WHERE categoria_id = $categoria_id";
    $resultado = mysqli_query($conn, $sql);

    if (!$resultado) {
        die("Erro na consulta: " . mysqli_error($conn));
    }
} else {
    echo "ID da categoria não fornecido.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transações - Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h4>Transações - Categoria <?php echo $categoria_id; ?></h4>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($transacao = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?php echo $transacao['id']; ?></td>
                        <td><?php echo $transacao['descricao']; ?></td>
                        <td><?php echo $transacao['valor']; ?></td>
                        <td><?php echo $transacao['data_da_transacao']; ?></td>
                        <td>
                            <a href="editar-transacao.php?id=<?php echo $transacao['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <form action="acoes.php" method="POST" style="display:inline;">
                                <input type="hidden" name="delete_usuario" value="<?php echo $transacao['id']; ?>">
                                <button type="submit" name="excluir-transacao" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta transação?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>