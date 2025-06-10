<?php
require_once("../conexao.php");

$mes_id = isset($_GET['mes_id']) ? $_GET['mes_id'] : null;

$sqlMes = "SELECT * FROM cadastro_mes WHERE id = $mes_id";
$resultMes = mysqli_query($conn, $sqlMes);
$mes = mysqli_fetch_assoc($resultMes);

$sqlCategorias = "SELECT * FROM categoria";
$resultCategorias = mysqli_query($conn, $sqlCategorias);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar - Transação</title>
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
                            Adicionar Transação <i class="bi bi-credit-card-fill"></i>
                            <a href="/controle_financeiro/movimentacoes/list-movimentacao.php?mes_id=<?= $mes_id ?>" class="btn btn-light float-end"> <i class="bi bi-arrow-return-left"></i></a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="../acoes.php" method="POST">
                        <input type="hidden" name="mes_id" value="<?= $mes_id ?>">
                            <div class="mb-3">
                                <label for="TxtDescricao">Descrição</label>
                                <input type="text" name="TxtDescricao" id="TxtDescricao" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="Categoria">Categoria</label>
                                <select name="Categoria" id="Categoria" class="form-control" required>
                                    <option value="">Selecione uma Categoria</option>
                                    <?php
                                        while ($categoria = mysqli_fetch_assoc($resultCategorias)) {
                                            echo "<option value='" . $categoria['id'] . "'>" . $categoria['nome'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="TxtTipo">Tipo</label>
                                <select name="TxtTipo" id="TxtTipo" class="form-control" required>
                                    <option value="Entrada">Entrada</option>
                                    <option value="Saida">Saída</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="DataTransacao">Data da Transação</label>
                                <input type="date" name="DataTransacao" id="DataTransacao" class="form-control" min="<?= date('Y-m-01', strtotime($mes['mes_ano'])) ?>" max="<?= date('Y-m-t', strtotime($mes['mes_ano'])) ?>" value="<?= date('Y-m-d', strtotime($mes['mes_ano'].'-01')) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="IntValor">Valor</label>
                                <input type="number" name="IntValor" id="IntValor" class="form-control" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="create_transacao" class="btn btn-dark float-end">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
