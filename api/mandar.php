<?php
include_once "../config/conexao.php";
include_once "../config/constantes.php";
include_once "../func/func.php";

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"]; 
    $numero = $_POST["numero"]; 


    // Valide os dados conforme necessário

    try {
        // Conecta ao banco de dados usando PDO
        $conexao = conectar();

        // Prepara a consulta SQL para inserir um novo registro na tabela teste1
        $query = "INSERT INTO contato (nome, numero) VALUES (:nome, :numero)"; // Insere a data atual como cadastro
        $stmt = $conexao->prepare($query);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":numero", $numero);


        // Executa a consulta
        $stmt->execute();

        // Redireciona de volta para a página principal ou para onde desejar após a inserção
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        // Em caso de erro, você pode tratar de acordo com suas necessidades
        echo "Erro ao inserir registro: " . $e->getMessage();
    }
} else {
    // Se o formulário não foi submetido, redireciona de volta para a página principal
    header("Location: ./index.php");
    exit();
}
?>
