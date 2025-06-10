<?php
session_start();
require_once("./conexao.php");

$sql = "SELECT * FROM cadastro_mes";
$meses = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/controle_financeiro.css">
</head>
<body>
<div class="px-3 py-2 text-bg-dark border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                <i class="bi bi-cash-coin" style="margin-right: 15px;font-size: 22px;"></i>
                <span style="font-size: 20px;font-weight: bold;">Controle Financeiro</span>
            </a>
            <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                <li style="height: fit-content;">
                    <a href="/controle_financeiro/categorias/list-categoria.php" class="nav-link text-white" style="display: flex;align-items: center;">
                        <svg class="bi d-block mx-auto mb-1" width="24" height="24"></svg>Categorias
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Lista de Meses <i class="bi bi-card-list"></i>
                        <a href="./meses/create-mes.php" class="btn btn-dark float-end" style="margin-right: 10px;">Adicionar Mês</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                        <?php while ($mes = mysqli_fetch_array($meses)) { ?>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <?php 
                                            setlocale(LC_TIME, 'pt_BR.UTF-8');
                                            $data = DateTime::createFromFormat('Y-m-d', $mes['mes_ano']); 
                                            $mesFormatado = strftime('%B %Y', $data->getTimestamp());
                                        ?>
                                        <h5 class="card-title"><?= $mesFormatado ?></h5>
                                        <a href="./movimentacoes/list-movimentacao.php?mes_id=<?= $mes['id'] ?>" class="btn btn-primary">Ver Movimentações</a>
                                        <form action="acoes.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $mes['id'] ?>">
                                            <a href="./movimentacoes/create-movimentacao.php?mes_id=<?= $mes['id'] ?>" class="btn btn-primary">Adicionar Movimentação</a>
                                        </form>
                                        <form action="acoes.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $mes['id'] ?>">
                                            <button onclick="return confirm('Tem certeza que deseja excluir?')" name="delete_mes" type="submit" class="btn btn-danger mt-2">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
