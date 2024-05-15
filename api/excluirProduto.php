<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o ID do produto foi enviado
    if (isset($_POST['id'])) {
        // Inclui o arquivo de conexão com o banco de dados
        include_once "../config/conexao.php";
        include_once "../func/func.php";
        include_once "../config/constantes.php";


        // Conecta ao banco de dados
        $conexao = conectar();

        // Recebe o ID do produto a ser excluído
        $id = $_POST['id'];

        // Prepara e executa a consulta para excluir o produto
        $sql = "DELETE FROM produto WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id);
        $resultado = $stmt->execute();

        // Verifica se a exclusão foi bem-sucedida
        if ($resultado) {
            // Redireciona de volta para a página de produtos com uma mensagem de sucesso
            header("Location: ../adm.php?page=produto");
            exit();
        } else {
            // Se a exclusão falhar, redireciona com uma mensagem de erro
            header("Location: ../adm.php?page=produto");
            exit();
        }
    } else {
        // Se o ID do produto não foi enviado, redireciona com uma mensagem de erro
        header("Location: ../adm.php?page=produto");
        exit();
    }
} else {
    // Se o formulário não foi submetido corretamente, redireciona com uma mensagem de erro
    header("Location: ../adm.php?page=produto");
    exit();
}
?>