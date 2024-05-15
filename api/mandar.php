<?php
include_once "../config/conexao.php";
include_once "../config/constantes.php";
include_once "../func/func.php";

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"]; 
    $numero = $_POST["numero"]; 
    $mensagem = $_POST["mensagem"];

    // Valide os dados conforme necessário

    try {
        // Conecta ao banco de dados usando PDO
        $conexao = conectar();

        // Prepara a consulta SQL para inserir um novo registro na tabela contato
        $query = "INSERT INTO contato (nome, numero, mensagem) VALUES (:nome, :numero, :mensagem)";
        $stmt = $conexao->prepare($query);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":numero", $numero);
        $stmt->bindParam(":mensagem", $mensagem);

        // Executa a consulta
        $stmt->execute();

        // Redireciona de volta para a página principal ou para onde desejar após a inserção
        header("Location: ../index.php?status=success");
        exit();
    } catch (PDOException $e) {
        // Em caso de erro, você pode tratar de acordo com suas necessidades
        echo "Erro ao inserir registro: " . $e->getMessage();
    }
} else {
    // Se o formulário não foi submetido, redireciona de volta para a página principal
    header("Location: ../index.php");
    exit();
}
?>
