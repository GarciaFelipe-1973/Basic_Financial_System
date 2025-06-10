<?php
session_start();
require_once('../conexao.php');

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
} else {
    $movimentacaoId = mysqli_real_escape_string($conn, $_GET['id']);
    $sqlMovimentacao = "SELECT * FROM movimentacao WHERE id = '{$movimentacaoId}'";
    $queryMovimentacao = mysqli_query($conn, $sqlMovimentacao);
    if (mysqli_num_rows($queryMovimentacao) > 0) {
        $movimentacao = mysqli_fetch_array($queryMovimentacao);
    } else {
        echo "<script>alert('Movimentação não encontrada'); window.location.href='index.php';</script>";
        exit();
    }
    
    $sqlCategorias = "SELECT * FROM categoria";
    $queryCategorias = mysqli_query($conn, $sqlCategorias);
    $categorias = mysqli_fetch_all($queryCategorias, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar - Movimentação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/controle_financeiro.css">
</head>
<body style="background-color: black;">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Editar Movimentação <i class="bi bi-card-list"></i>
                            <a href="/controle_financeiro/movimentacoes/list-movimentacao.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if ($movimentacao): ?>
                            <form action="../acoes.php" method="POST">
                            <input type="hidden" name="id" value="<?= $movimentacao['id']; ?>">
                            <input type="hidden" name="mes_id" value="<?= $movimentacao['mes_id']; ?>">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição</label>
                                <input type="text" name="txtDescricao" id="descricao" class="form-control" value="<?= $movimentacao['descricao']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="valor" class="form-label">Valor</label>
                                <input type="number" name="txtValor" id="valor" class="form-control" step="0.01" value="<?= $movimentacao['valor']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="data" class="form-label">Data</label>
                                <input type="date" name="txtData" id="data" class="form-control" value="<?= date('Y-m-d', strtotime($movimentacao['data_da_transacao'])); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoria</label>
                                <select name="txtCategoria" id="categoria" class="form-select" required>
                                    <option value="">Selecione uma Categoria</option>
                                    <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id']; ?>" <?= $categoria['id'] == $movimentacao['categoria_id'] ? 'selected' : ''; ?>>
                                        <?= $categoria['nome']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select name="txtTipo" id="tipo" class="form-select" required>
                                    <option value="Entrada" <?= $movimentacao['tipo'] == 'Entrada' ? 'selected' : ''; ?>>Entrada</option>
                                    <option value="Saida" <?= $movimentacao['tipo'] == 'Saida' ? 'selected' : ''; ?>>Saída</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="edit_transacao" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                        <?php else: ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Movimentação não encontrada
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
