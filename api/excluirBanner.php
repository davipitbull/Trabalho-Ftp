<?php
// Verifica se o método de requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o ID do banner foi recebido
    if (isset($_POST["id"])) {
        // Inclui o arquivo de conexão com o banco de dados
        include_once "../config/conexao.php";
        include_once "../func/func.php";
        include_once "../config/constantes.php";


        // Obtém o ID do banner a ser excluído
        $id = $_POST["id"];

        // Função para excluir o banner do banco de dados
        function excluirBanner($id)
        {
            try {
                // Conecta ao banco de dados
                $conexao = conectar();

                // Prepara a consulta SQL para excluir o banner
                $sql = "DELETE FROM banner WHERE id = :id";
                $stmt = $conexao->prepare($sql);

                // Associa o parâmetro ID ao valor recebido
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                // Executa a consulta
                $stmt->execute();

                // Fecha a conexão e o statement
                $stmt->closeCursor();
                $conexao = null;
            } catch (PDOException $e) {
                // Em caso de erro, exibe uma mensagem de erro
                echo "Erro ao excluir o banner: " . $e->getMessage();
            }
        }

        // Chama a função para excluir o banner
        excluirBanner($id);

        // Redireciona de volta para a página de banners após a exclusão
        header("Location: ../adm.php?page=banner");
        exit();
    } else {
        // Se o ID do banner não foi recebido, redireciona de volta para a página de banners
        header("Location: ../adm.php?page=banner");
        exit();
    }
} else {
    // Se a requisição não for do tipo POST, redireciona de volta para a página de banners
    header("Location: ../adm.php?page=banner");
    exit();
}
?>