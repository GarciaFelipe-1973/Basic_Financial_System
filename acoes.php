<?php
session_start();
require_once('conexao.php');


//AÇÕES DE CATEGORIA
if (isset($_POST['create_categoria'])) {
    $nome = trim($_POST['txtNome']);

    $sql = "INSERT INTO categoria (nome) VALUES('$nome')";

    mysqli_query($conn, $sql);

    header('Location: /controle_financeiro/categorias/list-categoria.php');
    exit();
}

if(isset($_POST['edit_categoria'])) {
    $id = $_POST['id'];
    $nome = trim($_POST['txtNome']);

    $sql = "UPDATE categoria SET nome = '$nome' WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Categoria atualizada com sucesso!";
        $_SESSION['type'] = 'success';

        header('Location: /controle_financeiro/categorias/list-categoria.php');
        exit;
    }
}

if(isset($_POST['delete_categoria'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM categoria WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Categoria excluida com sucesso!";
        $_SESSION['type'] = 'success';

        header('Location: /controle_financeiro/categorias/list-categoria.php');
        exit;
    }
}


//AÇÕES DE TRANSAÇÃO
if (isset($_POST['create_transacao'])) {
    $descricao = mysqli_real_escape_string($conn, trim($_POST['TxtDescricao']));
    $categoria_id = mysqli_real_escape_string($conn, $_POST['Categoria']); 
    $data_transacao = mysqli_real_escape_string($conn, $_POST['DataTransacao']);
    $tipo = mysqli_real_escape_string($conn, $_POST['TxtTipo']);
    $valor = mysqli_real_escape_string($conn, $_POST['IntValor']);
    $mes_id = $_POST['mes_id'];

    $sql_check_mes = "SELECT COUNT(*) AS count FROM cadastro_mes WHERE id = $mes_id";
    $result_check_mes = mysqli_query($conn, $sql_check_mes);
    $row_check_mes = mysqli_fetch_assoc($result_check_mes);

    if ($row_check_mes['count'] == 0) {
        $_SESSION['message'] = "Mês não encontrado!";
        $_SESSION['type'] = 'danger';
        header("Location: /controle_financeiro/index.php");
        exit();
    }

    $sql = "INSERT INTO movimentacao (descricao, categoria_id, data_da_transacao, valor, mes_id) 
            VALUES ('$descricao', '$categoria_id', '$data_transacao', '$valor', '$mes_id')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Transação adicionada com sucesso!";
        $_SESSION['type'] = 'success';

        header("Location: /controle_financeiro/movimentacoes/list-movimentacao.php?mes_id=$mes_id");
        exit();
    } else {
        $_SESSION['message'] = "Erro ao adicionar transação.";
        $_SESSION['type'] = 'danger';
    }
}

if (isset($_POST['delete_transacao'])) {
    $id = $_POST['id'];
    $mes_id = $_POST['mes_id']; // Pega o mes_id do formulário

    $sql = "DELETE FROM movimentacao WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Transação excluída com sucesso!";
        $_SESSION['type'] = 'success';

        // Redireciona para a listagem do mês correto
        header("Location: /controle_financeiro/movimentacoes/list-movimentacao.php?mes_id=$mes_id");
        exit;
    } else {
        $_SESSION['message'] = "Erro ao excluir transação!";
        $_SESSION['type'] = 'danger';
    }
}

if (isset($_POST['edit_transacao'])) {
    $id = $_POST['id']; 
    $descricao = mysqli_real_escape_string($conn, trim($_POST['txtDescricao']));  // Corrigido
    $categoria_id = mysqli_real_escape_string($conn, $_POST['txtCategoria']);  // Corrigido
    $data_transacao = mysqli_real_escape_string($conn, $_POST['txtData']);  // Corrigido
    $tipo = mysqli_real_escape_string($conn, $_POST['txtTipo']);  // Corrigido
    $valor = mysqli_real_escape_string($conn, $_POST['txtValor']);  // Corrigido

    $sql = "UPDATE movimentacao 
            SET descricao = '$descricao', 
                categoria_id = '$categoria_id', 
                data_da_transacao = '$data_transacao', 
                valor = '$valor', 
                tipo = '$tipo' 
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Transação atualizada com sucesso!";
        $_SESSION['type'] = 'success';

        // A variável mes_id precisa estar no $_POST, ou você precisa passar no formulário
        if (isset($_POST['mes_id'])) {
            $mes_id = $_POST['mes_id']; 
            header("Location: /controle_financeiro/movimentacoes/list-movimentacao.php?mes_id=$mes_id");
        } else {
            header("Location: /controle_financeiro/movimentacoes/list-movimentacao.php");
        }
        exit;
    } else {
        echo "Erro na atualização: " . mysqli_error($conn); 
    }
}



//AÇÕES DE MES
if (isset($_POST['create_mes'])) {
    $mesAno = trim($_POST['mes_ano']);

    $mesAno = $mesAno . "-01"; 

    $sql = "INSERT INTO cadastro_mes (mes_ano) VALUES('$mesAno')";

    if (mysqli_query($conn, $sql)) {
        header('Location: /controle_financeiro/index.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if (isset($_POST['delete_mes'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM cadastro_mes WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Mes excluído com sucesso!";
        $_SESSION['type'] = 'success';

        header('Location: /controle_financeiro/index.php');
        exit;
    }
}

?>