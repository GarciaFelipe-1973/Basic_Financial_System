<?php
session_start();
require_once("../conexao.php");

if (isset($_GET['mes_id'])) {
    $mes_id = $_GET['mes_id'];

    $sql = "SELECT * FROM movimentacao WHERE mes_id = $mes_id"; 
    $movimentacoes = mysqli_query($conn, $sql);

    $sqlMes = "SELECT * FROM cadastro_mes WHERE id = $mes_id";
    $resultMes = mysqli_query($conn, $sqlMes);
    $mes = mysqli_fetch_assoc($resultMes);

    if ($mes) {
        $mes_ano = strtotime($mes['mes_ano']);
        $mes_nome = date("F Y", $mes_ano); // Usando date() em vez de strftime()
    } else {
        $mes_nome = "Mês e Ano Não Encontrados";
    }
} else {
    $sql = "SELECT * FROM movimentacao";
    $movimentacoes = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimentações do Mês</title>
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
                            Movimentações do Mês - <?= $mes_nome ?> 
                            <a href="/controle_financeiro/index.php" class="btn btn-light float-end"> <i class="bi bi-arrow-return-left"></i></a>
                            <a href="create-movimentacao.php?mes_id=<?= $mes_id ?>" class="btn btn-dark float-end" style="margin-right: 10px;">Adicionar Movimentação</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Data</th>
                                    <th>Categoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($movimentacoes) > 0) : ?>
                                    <?php foreach ($movimentacoes as $movimentacao): ?>
                                        <tr>
                                            <td><?php echo $movimentacao['descricao']; ?></td>
                                            <td><?php echo $movimentacao['tipo']; ?></td>
                                            <td><?php echo $movimentacao['valor']; ?></td>
                                            <td><?php echo $movimentacao['data_da_transacao']; ?></td>
                                            <td><?php echo $movimentacao['categoria_id']; ?></td>
                                            <td>
                                                <a href="edit-movimentacao.php?id=<?php echo $movimentacao['id']; ?>&mes_id=<?php echo $mes_id; ?>" class="btn btn-success">Editar</a>
                                                <form action="../acoes.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="id" value="<?php echo $movimentacao['id']; ?>">
                                                    <input type="hidden" name="mes_id" value="<?php echo $mes_id; ?>"> <!-- Passando mes_id -->
                                                    <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_transacao" class="btn btn-danger">Excluir</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Não há movimentações para este mês.</td>
                                    </tr>
                                <?php endif; ?>
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
