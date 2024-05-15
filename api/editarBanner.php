<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "../config/conexao.php";
    include_once "../func/func.php";
    include_once "../config/constantes.php";

    // Conecta ao banco de dados
    $conn = conectar();

    if ($conn) {
        if (isset($_POST['id']) && isset($_POST['nome'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $imagem = "";

            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
                $diretorio = "../img/";
                $imagem_tmp = $_FILES['imagem']['tmp_name'];
                $imagem = uniqid('banner_') . '_' . $_FILES['imagem']['name'];
                move_uploaded_file($imagem_tmp, $diretorio . $imagem);
            }

            $sql = "UPDATE banner SET nome = :nome";

            if (!empty($imagem)) {
                $sql .= ", imagem = :imagem";
            }

            $sql .= " WHERE id = :id";

            // Prepara a consulta
            $stmt = $conn->prepare($sql);

            // Bind dos parâmetros
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);

            if (!empty($imagem)) {
                $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
            }

            // Executa a consulta
            $resultado = $stmt->execute();

            if ($resultado) {
                header("Location: ../adm.php?page=banner");
                exit();
            } else {
                header("Location: ../adm.php?page=banner&error=update_error");
                exit();
            }
        } else {
            header("Location: ../adm.php?page=banner&error=missing_fields");
            exit();
        }
    } else {
        header("Location: ../adm.php?page=banner&error=db_connection_error");
        exit();
    }
} else {
    header("Location: ../adm.php?page=banner&error=invalid_request");
    exit();
}
?>
