<?php
include_once "../config/conexao.php";
include_once "../config/constantes.php";
include_once "../func/func.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {


        // Conecta ao banco de dados
        $conexao = conectar();

        // Recebe os dados do formulário
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];

        // Verifica se uma nova imagem foi enviada
        if ($_FILES['imagem']['size'] > 0) {
            // Define o diretório onde a imagem será salva
            $diretorio = "../img/";

            // Gera um nome único para a imagem
            $nomeImagem = uniqid() . '-' . $_FILES['imagem']['name'];

            // Move a imagem para o diretório de destino
            move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio . $nomeImagem);

            // Atualiza a informação da imagem no banco de dados
            $sqlImagem = "UPDATE produto SET imagem = :imagem WHERE id = :id";
            $stmtImagem = $conexao->prepare($sqlImagem);
            $stmtImagem->bindParam(':imagem', $nomeImagem);
            $stmtImagem->bindParam(':id', $id);
            $stmtImagem->execute();
        }

        // Atualiza as informações do produto no banco de dados
        $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':id', $id);
        $resultado = $stmt->execute();

        // Verifica se a atualização foi bem-sucedida
        if ($resultado) {
            // Redireciona de volta para a página de produtos com uma mensagem de sucesso
            header("Location: ../adm.php?page=produto");
            exit();
        } else {
            // Se a atualização falhar, redireciona com uma mensagem de erro
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