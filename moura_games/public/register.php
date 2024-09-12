<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - MouraGames</title>
</head>
<body>
    <main>
        <section class="container_jogos">
            <h1>Cadastrar Usuário</h1>
            <form action="php/register_process.php" method="post" enctype="multipart/form-data" class="auth-form">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Confirmar Senha:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <label for="profile_picture">Foto de Perfil:</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*">

                <button type="submit" class="auth-btn">Cadastrar</button>

                <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error-message">Erro ao cadastrar. Verifique os dados e tente novamente.</p>';
                } elseif (isset($_GET['success'])) {
                    echo '<p class="success-message">Cadastro realizado com sucesso!</p>';
                }
                ?>
            </form>
        </section>
    </main>

</body>
</html>
