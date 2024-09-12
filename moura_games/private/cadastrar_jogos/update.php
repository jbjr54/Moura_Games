<?php
header('Content-Type: application/json');

// Chamada de conexão com o Banco de Dados
include("../../php/conexao.php");

// Recupera os dados do POST
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$produto = isset($_POST['produto']) ? $_POST['produto'] : '';
$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$valor = isset($_POST['valor']) ? $_POST['valor'] : '';

// Lida com o upload do arquivo
$foto = isset($_POST['foto_old']) ? $_POST['foto_old'] : ''; // Default to old photo

if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
    $foto_name = basename($_FILES['foto']['name']);
    $foto_tmp = $_FILES['foto']['tmp_name'];
    $upload_dir = "../../assets/img/cards/";
    $foto_path = $upload_dir . $foto_name;

    // Verifica se o diretório de upload existe e é gravável
    if (!is_dir($upload_dir) || !is_writable($upload_dir)) {
        echo json_encode(['success' => false, 'error' => 'Diretório de upload não encontrado ou não é gravável!']);
        exit;
    }

    // Move o arquivo para o diretório
    if (!move_uploaded_file($foto_tmp, $foto_path)) {
        echo json_encode(['success' => false, 'error' => 'Falha ao mover o arquivo para o diretório de upload.']);
        exit;
    }

    // Atualiza a foto se uma nova foi enviada
    $foto = $foto_name;
}

// Atualiza o banco de dados
$sql = "UPDATE moura_games.tb_produtos SET PRODUTO=?, TIPO=?, DESCRICAO=?, FOTO=?, VALOR=? WHERE ID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $produto, $tipo, $descricao, $foto, $valor, $id);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = 'Erro ao atualizar o banco de dados: ' . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
