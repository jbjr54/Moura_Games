<?php
session_start();
include('../php/conexao.php'); // Inclua o arquivo de conexão

// Verificar se o usuário está logado e obter as informações do usuário
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    $userId = $_SESSION['userid'];
    $sql = "SELECT username, profile_picture FROM moura_games.tb_clientes WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        die("Erro na preparação da consulta: " . mysqli_error($conn));
    }
    
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $username, $profile_picture);
    mysqli_stmt_fetch($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
    else {
        $username = null;
        $profile_picture = 'default-avatar.png';
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/estilo.css"> 
    <link rel="icon" type="image/x-icon" href="../assets/img/M_do_moura.ico">
    <script src="../assets/js/scripts.js"></script>
    <title>MouraGames</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
    <a class="navbar-brand" href="#">MouraGames</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="#home"  onclick="loadPagePrivate('../home_priv.php')"><i class="fa-solid fa-house"></i> Home </a>
            </li>                 
            <li class="nav-item">
            <a class="nav-link" href="#" onclick="loadPagePrivate('../cadastrar_jogos/config.php')">
                <i class="fa-solid fa-gamepad"></i> Jogos
            </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i> Perfil
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
                    <li><a class="dropdown-item" href="#" onclick="navigate('cadastrar')" ><i class="fab fa-get-pocket"></i> Cadastrar</a></li>
                    <li><a class="dropdown-item" href="#" onclick="loadPagePrivate('../profile.php')"><i class="fa-solid fa-address-book"></i> Perfil</a></li>
                    <li><a class="dropdown-item" href="../php/logout.php"><i class="fa-solid fa-right-to-bracket"></i> Sair</a></li>
                </ul>
            </li> 
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <li class="nav-item">
                <a class="nav-link" href="#sobre" onclick="loadPagePrivate('../sobre.php')"><i class="fa-solid fa-info-circle"></i> Sobre</a>
            </li>  
            <li class="nav-item">
                <form class="d-flex ms-2" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar jogos" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </li>
        </ul>
    </div>
</div>
</nav>
            <div id="content" class="content">
             <!-- Conteúdo dinâmico será carregado aqui -->
            </div>
    <footer class="bg-dark text-white text-center py-3 mt-3">
        <div class="container">
            <p class="mb-0">© 2024 MouraGames - Todos os direitos reservados</p>
        </div>
    </footer>
</body>
</html>
