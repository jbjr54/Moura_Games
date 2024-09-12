<?php
session_start();
include("conexao.php"); // Verifique o caminho correto para o arquivo de conexão

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validações básicas
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        header("Location: ../register.php?error=emptyfields");
        exit();
    }

    if ($password !== $confirm_password) {
        header("Location: ../register.php?error=passwordsdonotmatch");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register.php?error=invalidemail");
        exit();
    }

    // Verificar se o usuário ou e-mail já existe
    $sql = "SELECT * FROM moura_games.tb_clientes WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        header("Location: ../register.php?error=useroremailexists");
        exit();
    }

    mysqli_stmt_close($stmt);

    // Processar o upload da foto de perfil
    $profile_picture = 'default-avatar.png'; // Valor padrão

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
        $fileName = $_FILES['profile_picture']['name'];
        $fileSize = $_FILES['profile_picture']['size'];
        $fileType = $_FILES['profile_picture']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadFileDir = '../uploads/';
            $dest_path = $uploadFileDir . $fileName;

            // Verificar se o arquivo já existe
            if (file_exists($dest_path)) {
                $fileName = time() . '-' . $fileName;
                $dest_path = $uploadFileDir . $fileName;
            }

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $profile_picture = $fileName;
            } else {
                header("Location: ../register.php?error=fileuploadfailed");
                exit();
            }
        } else {
            header("Location: ../register.php?error=invalidfiletype");
            exit();
        }
    }

    // Inserir novo usuário no banco de dados
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO moura_games.tb_clientes (username, email, password, profile_picture) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die("Erro na preparação da consulta: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashed_password, $profile_picture);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../register.php?success=registered");
    } else {
        header("Location: ../register.php?error=registrationfailed");
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../register.php");
    exit();
}
?>
