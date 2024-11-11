Pokedex API
A Pokedex API é uma aplicação que permite gerenciar Pokémon, itens e suas interações em uma plataforma de RPG, fornecendo endpoints para criação e consulta de Pokémon, itens e as listas pessoais de usuários. A API oferece funcionalidades para que os usuários possam criar suas próprias listas de itens e Pokémon, consultar essas listas e filtrar os resultados conforme diferentes parâmetros.

Funcionalidades da API
1. Criação de Pokémon, Itens e Evoluções
A API permite que os usuários adicionem Pokémon, itens e evoluções à base de dados.

Adicionar Pokémon: Permite adicionar um novo Pokémon à base de dados.
Adicionar Item: Permite adicionar novos itens à base de dados.
Adicionar Evolução: Permite adicionar evoluções entre os Pokémons.
2. Listar Itens e Pokémons de um Usuário
Os usuários podem obter suas listas pessoais de itens e Pokémons, com suporte para filtragem de dados.

Filtragem por Nome do Item
Filtragem por Nome do Pokémon
Filtragem por Nível de Pokémon
Filtragem por Tipo de Pokémon
Filtragem por Data de Captura do Pokémon
3. Relatório de Pokémon e Itens do Usuário
A API permite que os usuários consultem seus itens e Pokémons com filtros avançados.

Endpoints da API
1. POST /api/adicionar_lista.php
Adiciona Pokémon e itens às listas pessoais dos usuários.

Parâmetros de Requisição:
usuario_itens: Adiciona um item à lista do usuário.

usuario_id (int): ID do usuário.
item_id (int): ID do item.
quantidade (int): Quantidade do item.
usuario_pokemons: Adiciona um Pokémon à lista do usuário.

usuario_id (int): ID do usuário.
pokemon_id (int): ID do Pokémon.
nivel (int): Nível do Pokémon.
Exemplo de Requisição para Adicionar um Item:
bash
Copiar código
POST /api/adicionar_lista.php
Content-Type: application/json

{
  "usuario_itens": {
    "usuario_id": 1,
    "item_id": 3,
    "quantidade": 5
  }
}
Exemplo de Requisição para Adicionar um Pokémon:
bash
Copiar código
POST /api/adicionar_lista.php
Content-Type: application/json

{
  "usuario_pokemons": {
    "usuario_id": 1,
    "pokemon_id": 25,
    "nivel": 5
  }
}
Exemplo de Resposta:
json
Copiar código
{
  "message": "Item adicionado à lista com sucesso!"
}
2. GET /api/obter_lista.php
Retorna a lista de itens e Pokémons de um usuário, com filtros para refinar a busca.

Parâmetros de Requisição:
usuario_id (int): ID do usuário (obrigatório).
nome_item (string): Filtro pelo nome do item.
nome_pokemon (string): Filtro pelo nome do Pokémon.
nivel_pokemon (int): Filtro pelo nível do Pokémon.
tipo_pokemon (string): Filtro pelo tipo do Pokémon.
data_captura (date): Filtro pela data de captura do Pokémon (formato YYYY-MM-DD).
Exemplo de Requisição para Filtrar Itens por Nome:
bash
Copiar código
GET /api/obter_lista.php?usuario_id=1&nome_item=poke
Exemplo de Requisição para Filtrar Pokémons por Nome e Nível:
bash
Copiar código
GET /api/obter_lista.php?usuario_id=1&nome_pokemon=bulba&nivel_pokemon=16
Exemplo de Resposta:
json
Copiar código
{
  "itens": [
    {
      "id": 1,
      "nome": "Poke Bola",
      "descricao": "Usada para capturar Pokémon.",
      "quantidade": 5
    }
  ],
  "pokemons": [
    {
      "id": 25,
      "nome": "Charmander",
      "numero": 4,
      "tipo": "Fogo",
      "nivel": 5,
      "data_captura": "2024-11-11 10:00:00"
    }
  ]
}
Tecnologias Utilizadas
PHP: Backend da API.
SQLite: Banco de dados para armazenar Pokémon, itens, evoluções e dados dos usuários.
PDO (PHP Data Objects): Interface para interagir com o banco de dados e proteger contra SQL Injection.
JSON: Formato de troca de dados entre a API e os clientes.
Estrutura do Banco de Dados
Tabelas Principais:
usuarios: Contém informações dos usuários, como id, email, username e senha.
itens: Contém os itens disponíveis na plataforma, com id, nome e descricao.
pokemons: Contém os Pokémons da primeira geração, com id, nome, numero e tipo_id.
tipos: Contém os tipos de Pokémon, como "Fogo", "Água", "Planta", etc.
evolucoes: Define as relações de evolução entre os Pokémons.
usuario_itens: Relaciona os itens com os usuários e suas quantidades.
usuario_pokemons: Relaciona os Pokémons com os usuários, incluindo o nível e a data de captura.
Como Rodar Localmente
Pré-requisitos:
PHP (versão 7 ou superior)
SQLite para o banco de dados
Servidor web como o Apache ou o Nginx (opcional, pode usar o PHP embutido)
Passos para Execução:
Clone o repositório para o seu computador:

bash
Copiar código
git clone https://github.com/seu-usuario/pokedex-api.git
Acesse a pasta do projeto:

bash
Copiar código
cd pokedex-api
Abra o terminal e inicie o servidor PHP embutido:

bash
Copiar código
php -S localhost:8000
Acesse a API em http://localhost:8000/api/.

Contribuindo
Faça um fork deste repositório.
Crie uma nova branch (git checkout -b feature/novo-recurso).
Realize as alterações e faça commit (git commit -am 'Adicionar novo recurso').
Faça push para a sua branch (git push origin feature/novo-recurso).
Envie um Pull Request para o repositório original.
