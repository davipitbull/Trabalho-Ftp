<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclui o arquivo de conexão e funções
    include_once "../config/conexao.php";
    include_once "../func/func.php";
    include_once "../config/constantes.php";


    // Conecta ao banco de dados usando PDO
    $conexao = conectar();

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conexao) {
        // Verifica se todos os campos necessários foram enviados
        if (isset($_POST['nome']) && isset($_FILES['imagem'])) {
            $nome = $_POST['nome'];
            $imagem = $_FILES['imagem'];

            // Diretório onde as imagens serão armazenadas
            $diretorio = "../img/";

            // Nome do arquivo
            $nome_arquivo = basename($imagem['name']);

            // Caminho completo do arquivo
            $caminho_arquivo = $diretorio . $nome_arquivo;

            // Verifica se o arquivo é uma imagem
            $tipo_arquivo = strtolower(pathinfo($caminho_arquivo, PATHINFO_EXTENSION));
            $permitidos = array('jpg', 'jpeg', 'png', 'gif', 'webp'); // Adiciona 'webp' aos tipos permitidos

            if (in_array($tipo_arquivo, $permitidos)) {
                // Move o arquivo para o diretório de imagens
                if (move_uploaded_file($imagem['tmp_name'], $caminho_arquivo)) {
                    try {
                        // Prepara a consulta SQL para inserir os dados do banner
                        $sql = "INSERT INTO banner (nome, imagem) VALUES (:nome, :imagem)";
                        $stmt = $conexao->prepare($sql);
                        $stmt->bindParam(':nome', $nome);
                        $stmt->bindParam(':imagem', $nome_arquivo);

                        // Executa a consulta
                        $stmt->execute();

                        echo "Banner cadastrado com sucesso!";
                        header("Location: ../adm.php?page=banner");

                    } catch (PDOException $e) {
                        echo "Erro ao cadastrar o banner: " . $e->getMessage();
                    }
                } else {
                    echo "Erro ao fazer o upload do arquivo.";
                }
            } else {
                echo "Formato de arquivo não suportado. Somente imagens JPG, JPEG, PNG, GIF e WebP são permitidas.";
            }
        } else {
            echo "Todos os campos são obrigatórios.";
        }
    } else {
        echo "Erro ao conectar ao banco de dados.";
    }
} else {
    // Redireciona para a página de erro se o formulário não foi submetido
    header("Location: ../erro.php");
    exit;
}
?>