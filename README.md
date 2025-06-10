# Basic Financial System

## Descrição

Este é um sistema web simples para controle financeiro pessoal, desenvolvido em PHP. Ele permite gerenciar categorias de despesas/receitas, registrar movimentações financeiras e visualizar um resumo das transações.

## Funcionalidades

- **Gerenciamento de Categorias:** Adicione, edite e liste categorias de despesas e receitas.
- **Registro de Movimentações:** Registre entradas e saídas de dinheiro, associando-as a categorias e meses.
- **Visualização de Transações:** Acompanhe suas movimentações financeiras.

## Tecnologias Utilizadas

- **Backend:** PHP
- **Banco de Dados:** MySQL
- **Frontend:** HTML, CSS

## Pré-requisitos

Para executar este projeto, você precisará de um ambiente de servidor web com suporte a PHP e MySQL. Recomenda-se o uso de:

- Servidor Web (Apache, Nginx, XAMPP, WAMP, MAMP, etc.)
- PHP (versão 7.x ou superior)
- MySQL (versão 5.x ou superior)

## Como Rodar o Projeto

Siga os passos abaixo para configurar e executar o projeto em seu ambiente local:

1.  **Clone ou Baixe o Projeto:**

    Se você estiver usando Git, clone o repositório:
    ```bash
    git clone <URL_DO_REPOSITORIO> # Substitua pela URL do seu repositório, se houver
    ```
    Caso contrário, descompacte o arquivo `controle_financeiro.zip` em um diretório de sua preferência.

2.  **Mova para o Diretório do Servidor Web:**

    Mova a pasta `controle_financeiro` (que contém os arquivos do projeto) para o diretório raiz do seu servidor web (ex: `htdocs` para Apache/XAMPP, `www` para WAMP).

    Exemplo (para XAMPP no Linux):
    ```bash
    mv /caminho/para/controle_financeiro /opt/lampp/htdocs/
    ```

3.  **Configurar o Banco de Dados MySQL:**

    a.  Acesse seu gerenciador de banco de dados (ex: phpMyAdmin, MySQL Workbench ou linha de comando).
    b.  Crie um novo banco de dados com o nome `controle_financeiro`.
    c.  Importe o arquivo `controle_financeiro.sql` (localizado na raiz do projeto) para o banco de dados recém-criado.

4.  **Configurar a Conexão com o Banco de Dados:**

    Abra o arquivo `conexao.php` (localizado na raiz do projeto) e verifique se as credenciais do banco de dados estão corretas para o seu ambiente:

    ```php
    <?php
    $host = 'localhost'; // Geralmente 'localhost'
    $usuario = 'root';   // Seu usuário do MySQL
    $senha = '';         // Sua senha do MySQL (geralmente vazia para 'root' em ambientes de desenvolvimento)
    $banco = 'controle_financeiro'; // Nome do banco de dados criado

    $conn = mysqli_connect($host, $usuario, $senha, $banco) or die('Não foi possível conectar');

    ?>
    ```
    Altere `$usuario` e `$senha` conforme necessário.

5.  **Acesse o Projeto no Navegador:**

    Após configurar o servidor web e o banco de dados, abra seu navegador e acesse:

    ```
    http://localhost/controle_financeiro/
    ```
    (O caminho pode variar dependendo de como você configurou seu servidor web).

## Estrutura do Projeto

```
controle_financeiro/
├── acoes.php
├── categorias/
│   ├── create-categoria.php
│   ├── edit-categoria.php
│   └── list-categoria.php
├── conexao.php
├── controle_financeiro.sql
├── css/
│   └── controle_financeiro.css
├── index.php
├── mensagem.php
├── meses/
│   └── create-mes.php
└── movimentacoes/
    ├── create-movimentacao.php
    ├── edit-movimentacao.php
    └── list-movimentacao.php
```

## Contribuição

Contribuições são bem-vindas! Se você deseja contribuir com este projeto, por favor, faça um fork do repositório, crie uma nova branch para suas alterações e envie um Pull Request.

## Licença

Este projeto não possui um arquivo de licença explícito. Por padrão, considere-o como "Todos os Direitos Reservados" ou entre em contato com o autor para permissões de uso.


