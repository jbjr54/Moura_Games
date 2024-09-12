<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
</head>
<body>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moura_games";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Comando SQL para listagem dos registros
$consulta = "SELECT * FROM tb_produtos ORDER BY ID DESC";

// Guarda dados retornados em um array (matriz)
$result = $conn->query($consulta);

// Verifica se a consulta foi bem-sucedida
if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}
?>


<section class="containerGL">
    <div class="product-grid">
        <?php
        // Caso o banco de dados retorne 1 linha ou mais, inicia uma estrutura de repetição para listar
        if ($result->num_rows > 0) {
            // Escreve os dados do Array (matriz) e a cada volta no loop do while escreve um registro na tela
            while ($row = $result->fetch_assoc()) 
            {
        ?>
                <div class="card">
                    <div class="card-type"><?php echo $row["TIPO"]; ?></div> <!-- Adicionando a classe card-type -->
                        <img class="card-img-top" src="<?php echo "../../../moura_games/assets/img/cards/" . $row["FOTO"]; ?>" alt="Card image">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $row["PRODUTO"]; ?></h4>
                            <p class="card-text"><?php echo $row["DESCRICAO"]; ?></p>
                            <p class="card-price"><?php echo "R$ " . number_format($row["VALOR"], 2, ',', '.'); ?></p> <!-- Adicionando a classe card-price -->
                            <button type="button" class="btn btn-primary" onclick="pegarId(<?php echo $row['ID']; ?>)"><i class="fa-solid fa-gears"></i> Abrir configurações</button>
                        </div>
                    </div>
                
                <?php
            }

        } 
        else 
        {
            // Em caso de tabela vazia, exibe mensagem
            echo "<p>Nenhuma informação retornada do Banco de Dados.</p>";
        }
        // Fechar conexão com o Banco de Dados
        $conn->close();
        ?>
    </div>
    </div>    
</section>
</body>
</html>
<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel"><i class="fa-solid fa-gears"></i> Editar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- O conteúdo do formulário será carregado aqui -->
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-success" onclick="enviarFormulario()"><i class="fa-solid fa-check"></i> Salvar configurações</button>
            <button type="button" class="btn btn-outline-danger" onclick="deletarFormulario()"><i class="fa-solid fa-trash"></i> Deletar jogo</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>