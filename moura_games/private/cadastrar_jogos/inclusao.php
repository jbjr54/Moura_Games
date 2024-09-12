<?php
    //chama arquivo externo do conexão com o Banco de Dados.
    include("../../php/conexao.php");

            //Recebe os dodos do formulário no método Post e guarda nas seguintes variáveis.
            $produto = $_POST["produto"];
            $tipo = $_POST["tipo"];
            $plataforma = $_POST["plataforma"];
            $descricao = $_POST["descricao"];
            $foto = $_FILES["foto"];
            $valor = $_POST["valor"];
            $target_dir = "../../assets/img/cards/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
            // Verifica se é uma imagem ou fake
            if(isset($_POST["submit"])) 
            {
              $check = getimagesize($_FILES["foto"]["tmp_name"]);
              if($check !== false) {
                echo "Imagem válida - " . $check["mime"] . ".";
                $uploadOk = 1;
              } else {
                echo "Arquivo não contém uma imagem valida.";
                $uploadOk = 0;
              }
            }
            
            // Verifica se o arquivo já existe.
            if (file_exists($target_file)) 
            {
              echo "Arquivo de imagem já existente, por favor escolha outro.";
              $uploadOk = 0;
            }
            
            // Verifica tamanho do arquivo.
            if ($_FILES["foto"]["size"] > 500000) 
            {
              echo "O arquivo de imagem excede tamanho máximo permitido de 50Mb.";
              $uploadOk = 0;
            }
            
            // aceita apenas os arquivos com as extensões abaixo.
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) 
            {
              echo "Somente extensões .JPG, .JPEG, .PNG & .GIF são permitidos.";
              $uploadOk = 0;
            }
            
            // Verifica de tem algum problema no upload
            if ($uploadOk == 0) 
            {
              echo "Seu arquivo não será enviado, corrija o erro e tente novamente.";

            // se estiver ok, entao segue enviando a imagem.
            } 
            else 
            {
              if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                echo "A foto". htmlspecialchars( basename( $_FILES["foto"]["name"])). " Foi enviado com sucesso.";
                $foto=$_FILES["foto"]["name"];
                // Insere os dados no banco
                $sql = "INSERT INTO moura_games.tb_produtos (produto, tipo, plataforma, descricao, foto, valor) VALUES ('$produto', '$tipo', '$plataforma', '$descricao', '$foto','$valor')";
            
                    if ($conn->query($sql) === TRUE) 
                        {
                            $status = "Registro Salvo com Sucesso !";
                    
                            // include("./listar_prod.php"); //chamar o arquivo PHP que lista os registros retornados do Banco de Dados.
                        } 
                        else // Se o Banco de Dados não conseguir registrar o formulário, aparece a seguinte mensagem de erro.
                        {
                            echo "Erro ao cadastrar registro no baco de Dados.";
                            
                        }

                    } 
                    else 
                    {
                        echo "Houve um erro ao enviar seu arquivo.";
                        
                    }
            }

?>   

            
