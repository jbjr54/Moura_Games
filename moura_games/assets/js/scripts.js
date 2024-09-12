function loadPagePublic(page) {
    const content = document.getElementById('content');
    fetch(`public/${page}`)
        .then(response => response.text())
        .then(data => {
            content.innerHTML = data;
        })
        .catch(error => {
            content.innerHTML = '<p>Erro ao carregar a página.</p>';
        });
}

function loadPagePrivate(page) {
    const content = document.getElementById('content');
    fetch(`private/${page}`)
        .then(response => response.text())
        .then(data => {
            content.innerHTML = data;
        })
        .catch(error => {
            content.innerHTML = '<p>Erro ao carregar a página.</p>';
        });
}

function showSection(id) {
        // Esconde todas as seções
        document.querySelectorAll('.content-section').forEach(section => {
            section.style.display = 'none';
        });

        // Mostra a seção selecionada
        const sectionToShow = document.getElementById(id);
        if (sectionToShow) {
            sectionToShow.style.display = 'block';
        }
}
    // Adiciona funcionalidade de clique para o botão do dropdown
    document.querySelectorAll('.dropbtn').forEach(dropbtn => {
        dropbtn.addEventListener('click', () => {
            const dropdownContent = dropbtn.nextElementSibling;
            dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
        });
});
    // Fecha o dropdown se o usuário clicar fora dele
    window.addEventListener('click', (event) => {
        if (!event.target.matches('.dropbtn')) {
            const dropdowns = document.querySelectorAll('.dropdown-content');
            dropdowns.forEach(dropdown => {
                if (dropdown.style.display === 'block') {
                    dropdown.style.display = 'none';
                }
            });
        }
    });
;

function navigate(page) 
{
  const content = document.getElementById('content');
  if (page === 'cadastrar') 
  {
      content.innerHTML = `
<div class="container_jogos">
    <section>
        <h2>Cadastrar Produto</h2>
        <form id="ProdForm">
            <label for="produto">Produto:</label>
            <input type="text" id="produto" name="produto" placeholder="Digite o nome do produto aqui..." required><br>
            
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="GAME">JOGOS</option>
                <option value="ARCADE">ARCADES</option>
                <option value="CONSOLE">CONSOLE</option>
                <option value="BONECO">MINIATURAS</option>
                <option value="ACESSORIO">ACESSORIOS</option>
            </select><br>
            
            <label>Plataforma:</label>
            <select name="plataforma" id="plataforma">
                <option value="PSN">PLAYSTATION</option>
                <option value="XBOX">XBOX</option>
                <option value="NINTENDO">NINTENDO</option>
                <option value="PC">PC</option>
            </select><br>
            
            <div class="container">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="4" placeholder="Digite a descrição aqui..." required></textarea>
            </div>
            
            <label for="valor">Valor:</label>
            <input type="text" id="valor" placeholder="Digite o valor aqui..." name="valor"><br>
            
            <div class="btn-container">
            <label class="file-upload">
                    <input type="file" id="foto" name="foto">
                <span>Escolha uma foto</span>
                </label>
            </div>

            <div style="text-align: center; ">
                <input class="btn btn-primary" id=wide-btn type="submit" name="cadastrar" value="Cadastrar"/>
            </div>
        </form>
    </section>
</div>

`;
      document.getElementById('ProdForm').addEventListener('submit', function(event) 
      {
          event.preventDefault();
          const formData = new FormData(this);
          fetch('./cadastrar_jogos/inclusao.php', {
              method: 'POST',
              body: formData
          }).then(response => response.text()).then(data => 
          {
              alert(data);
          });
          document.getElementById("produto").value=""
          document.getElementById("tipo").value=""
          document.getElementById("plataforma").value=""
          document.getElementById("descricao").value=""
          document.getElementById("foto").value=""
          document.getElementById("valor").value=""
      });
  }
}

function pegarId(id) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `./cadastrar_jogos/alterar.php?id=${encodeURIComponent(id)}`, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById('modal-body').innerHTML = xhr.responseText;
            const myModal = new bootstrap.Modal(document.getElementById('formModal'));
            myModal.show();
        } else {
            console.error('Falha ao carregar o formulário.');
        }
    };
    xhr.send();
}
function enviarFormulario() {
    const formData = new FormData(document.querySelector('#modal-body form'));

    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../private/cadastrar_jogos/update.php', true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert('Produto atualizado com sucesso!');
                    const myModal = bootstrap.Modal.getInstance(document.getElementById('formModal'));
                    myModal.hide(); // Fecha o modal
                    location.reload(); // Atualiza a página
                } else {
                    alert('Erro ao atualizar o produto: ' + response.error);
                }
            } catch (e) {
                alert('Erro ao processar a resposta: ' + e.message);
            }
        } else {
            alert('Falha ao atualizar o produto. Status: ' + xhr.status);
        }
    };
    xhr.onerror = function () {
        alert('Erro na solicitação.');
    };
    xhr.send(formData);
}
function deletarFormulario() {
const form = document.querySelector('#modal-body form');
const formData = new FormData(form);

// Verifica se o ID está presente no FormData
if (!formData.has('id')) {
alert('ID do produto não encontrado.');
return;
}

const xhr = new XMLHttpRequest();
xhr.open('POST', './cadastrar_jogos/deletar.php', true);
xhr.onload = function () {
if (xhr.status === 200) {
    try {
        const response = JSON.parse(xhr.responseText);
        if (response.success) {
            alert('Produto deletado com sucesso!');
            const myModal = bootstrap.Modal.getInstance(document.getElementById('formModal'));
            myModal.hide(); // Fecha o modal
            location.reload(); // Atualiza a página
        } else {
            alert('Erro ao deletar o produto: ' + response.error);
        }
    } catch (e) {
        alert('Erro ao processar a resposta: ' + e.message);
    }
} else {
    alert('Falha ao deletar o produto. Status: ' + xhr.status);
}
};
xhr.onerror = function () {
alert('Erro na solicitação.');
};
xhr.send(formData);
}
