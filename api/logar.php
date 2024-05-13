<?php
include_once "../config/conexao.php";
include_once "../config/constantes.php";
include_once "../func/func.php";

$conn = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Função para gerar hash da senha
    function gerarHashSenha($senha) {
        // Você pode usar diferentes algoritmos de hash, como bcrypt ou argon2, dependendo das suas necessidades de segurança
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    // Verifique se o usuário é administrador
    $query = "SELECT * FROM adm WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['senha'])) {
        // Usuário é administrador, redireciona para adm.php e define mensagem de sucesso
        session_start();
        $_SESSION['idadm'] = $admin['idadm'];
        header('location: ../adm.php');
        exit();
    }

    // Verifique se o usuário é cliente
    $query = "SELECT * FROM usuario WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $cliente = $stmt->fetch();

    if ($cliente && password_verify($password, $cliente['senha'])) {
        // Usuário é cliente, redireciona para cliente.php e define mensagem de sucesso
        session_start();
        $_SESSION['iduser'] = $cliente['id'];
        header('location: ../index.php');
        exit();
    }

    // Se não for encontrado nenhum usuário com o email fornecido ou a senha estiver incorreta, define mensagem de erro
    session_start();
    $_SESSION['error_message'] = "Usuário ou senha incorretos!";
    header('location: login.php');
} else {
    // Se não for uma solicitação POST, redirecione de volta para a página de login com mensagem de erro
    session_start();
    $_SESSION['error_message'] = "Método de requisição inválido!";
    header('location: login.php');
}
?>
