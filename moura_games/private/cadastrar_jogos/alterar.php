<?php
    // Recebe o id para ser atualizado
    if (!isset($_GET['id'])) {
        die("ID não fornecido.");
    }
    $id = $_GET['id'];

    // Chamada de conexão com o Banco de Dados
    include("../../php/conexao.php");

    // Verifica se a conexão foi bem-sucedida
    if (!$conn) {
        die("Falha na conexão com o banco de dados.");
    }

    // Comando SQL para selecionar o produto com base no ID
    $consulta = "SELECT * FROM moura_games.tb_produtos WHERE id=?";
    $stmt = $conn->prepare($consulta);
    if (!$stmt) {
        die("Falha ao preparar a consulta: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Produto</title>
    <script>
        function atualizarProduto(event) {
            event.preventDefault(); // Evita o envio padrão do formulário

            const formData = new FormData(document.getElementById('ProdForm'));

            const xhr = new XMLHttpRequest();
            xhr.open('POST', './cadastrar_jogos/update.php', true);
            xhr.onload = function () {
                console.log(xhr.responseText); // Adicione esta linha para ver a resposta
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert('Produto atualizado com sucesso!');
                        // window.location.reload(); // Recarregamento da página, se necessário
                    } else {
                        alert('Erro ao atualizar o produto: ' + response.error);
                    }
                } else {
                    alert('Falha ao atualizar o produto.');
                }
            };
            xhr.send(formData);
        }
    </script>
</head>
<body>
<div class="container_jogos">
    <section>
        <h2>Editar Produto</h2>

        <form id="ProdForm" method="post" enctype="multipart/form-data" onsubmit="atualizarProduto(event)">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['ID']); ?>">

            <label for="produto">Produto:</label>
            <input type="text" id="produto" name="produto" placeholder="Digite o nome do produto aqui..." value="<?php echo htmlspecialchars($row['PRODUTO']); ?>" required>

            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="<?php echo htmlspecialchars($row['TIPO']); ?>" selected>
                    <?php echo htmlspecialchars($row['TIPO']); ?>
                </option>
                <option value="GAME">JOGOS</option>
                <option value="ARCADE">ARCADES</option>
                <option value="CONSOLE">CONSOLE</option>
                <option value="BONECO">MINIATURAS</option>
                <option value="ACESSORIO">ACESSORIOS</option>
            </select>

            <label for="plataforma">Plataforma:</label>
            <select name="plataforma" id="plataforma" required>
                <option value="<?php echo htmlspecialchars($row['PLATAFORMA']); ?>" selected>
                    <?php echo htmlspecialchars($row['PLATAFORMA']); ?>
                </option>
                <option value="PSN">PLAYSTATION</option>
                <option value="XBOX">XBOX</option>
                <option value="NINTENDO">NINTENDO</option>
                <option value="PC">PC</option>
            </select>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" placeholder="Digite a descrição aqui..." required><?php echo htmlspecialchars($row['DESCRICAO']); ?></textarea>

            <label for="valor">Valor:</label>
            <input type="text" id="valor" name="valor" placeholder="Digite o valor aqui..." value="<?php echo htmlspecialchars($row['VALOR']); ?>" required>

            <label for="foto">Foto:</label>
            <input class="btn btn-primary" type="file" id="foto" name="foto">

            <?php if (!empty($row['FOTO'])): ?> 
                <p>Foto atual:</p>
                <img src="../../../moura_games/assets/img/cards/<?php echo htmlspecialchars($row['FOTO']); ?>" alt="Foto atual" style="border-radius: 8%;" width="250px">
                <input type="hidden" name="foto_old" value="<?php echo htmlspecialchars($row['FOTO']); ?>">
            <?php endif; ?>
        </form>
    </section>

</div>
</body>
</html>
<?php
    } else {
        echo "Nenhuma informação retornada do Banco de Dados.";
    }
    $stmt->close();
    $conn->close();
?>
