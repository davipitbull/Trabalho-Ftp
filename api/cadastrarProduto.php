<?php
include_once "../config/conexao.php";
include_once "../config/constantes.php";
include_once "../func/func.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    
    // Verifica se foi enviada uma imagem
    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagem = $_FILES['imagem']['name'];
        $imagem_temp = $_FILES['imagem']['tmp_name'];

        // Caminho para o diretório de imagens
        $caminho_imagem = "../img/" . $imagem;

        // Move o arquivo para o diretório de imagens
        if(move_uploaded_file($imagem_temp, $caminho_imagem)) {
            // Conexão com o banco de dados
            $conn = conectar();

            // Prepara a consulta SQL
            $query = "INSERT INTO produto (nome, descricao, preco, imagem) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($query);

            // Executa a consulta com os parâmetros vinculados
            $stmt->bindParam(1, $nome);
            $stmt->bindParam(2, $descricao);
            $stmt->bindParam(3, $preco);
            $stmt->bindParam(4, $imagem);

            // Executa a consulta
            if($stmt->execute()) {
                header('Location: ../adm.php?page=produto');
                exit;
            } else {
                echo "Erro ao cadastrar produto.";
            }
        } else {
            echo "Erro ao mover o arquivo de imagem.";
        }
    } else {
        echo "Erro: Nenhuma imagem enviada ou ocorreu um erro no upload.";
    }
}
?>
