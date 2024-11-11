# Pokedex API

A **Pokedex API** é uma API RESTful desenvolvida para gerenciar Pokémon, itens e suas interações. A API permite aos usuários criar suas próprias listas de Pokémons e itens, consultar essas listas e aplicar filtros para refinar as pesquisas. Além disso, a API oferece a possibilidade de adicionar novos Pokémon, itens e evoluções à base de dados.

## Funcionalidades

### 1. **Criação de Pokémon, Itens e Evoluções**
- **Adicionar Pokémon**: Permite adicionar um novo Pokémon à base de dados.
- **Adicionar Item**: Permite adicionar um novo item à base de dados.
- **Adicionar Evolução**: Permite criar relações de evolução entre Pokémons.

### 2. **Gerenciar Itens e Pokémons do Usuário**
A API permite que os usuários adicionem Pokémon e itens às suas listas pessoais. Além disso, é possível consultar as listas com filtros personalizados.

### 3. **Filtragem Avançada**
Filtre os Pokémons e itens com base nos seguintes parâmetros:
- **Pokémons**: Nome, nível, tipo, data de captura, evolução.
- **Itens**: Nome.

---

## Endpoints da API

### 1. **POST /api/adicionar_lista.php**
Este endpoint permite que um usuário adicione Pokémon e itens à sua lista pessoal.

#### Parâmetros de Requisição:
- **usuario_itens**: Para adicionar um item à lista do usuário.
  - `usuario_id` (int): ID do usuário.
  - `item_id` (int): ID do item.
  - `quantidade` (int): Quantidade do item.

- **usuario_pokemons**: Para adicionar um Pokémon à lista do usuário.
  - `usuario_id` (int): ID do usuário.
  - `pokemon_id` (int): ID do Pokémon.
  - `nivel` (int): Nível do Pokémon.

#### Exemplo de Requisição para Adicionar um Item:
```bash
POST /api/adicionar_lista.php
Content-Type: application/json

{
  "usuario_itens": {
    "usuario_id": 1,
    "item_id": 3,
    "quantidade": 5
  }
}
```

### Exemplo de Requisição para Adicionar um Pokémon:
```bash
POST /api/adicionar_lista.php
Content-Type: application/json

{
  "usuario_pokemons": {
    "usuario_id": 1,
    "pokemon_id": 25,
    "nivel": 5
  }
}
```

### Exemplo de resposta:

```json
{
  "message": "Item adicionado à lista com sucesso!"
}
```

### 2. GET /api/obter_lista.php
Este endpoint retorna os itens e Pokémons da lista de um usuário, com a possibilidade de aplicar filtros.

#### Parâmetros de Requisição:
- **usuario_id** (int): ID do usuário (obrigatório).
- **nome_item** (string): Filtro para nome do item.
- **nome_pokemon** (string): Filtro para nome do Pokémon.
- **nivel_pokemon** (int): Filtro para nível do Pokémon.
- **tipo_pokemon** (string): Filtro para tipo do Pokémon.
- **data_captura** (date): Filtro para data de captura do Pokémon (YYYY-MM-DD).

#### Exemplo de Requisição para Filtrar Itens por Nome:
```bash
GET /api/obter_lista.php?usuario_id=1&nome_item=poke
```

### Exemplo de Requisição para Filtrar Pokémons por Nome e Nível:
```bash
GET /api/obter_lista.php?usuario_id=1&nome_pokemon=bulba&nivel_pokemon=16
```

### Exemplo de Resposta:
```json
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
```

## Tecnologias Utilizadas
- **PHP**: Para o backend da API.
- **SQLite**: Banco de dados utilizado para armazenar as informações dos Pokémon, itens, usuários, etc.
- **PDO (PHP Data Objects)**: Para interagir com o banco de dados, garantindo a segurança contra SQL Injection.
- **JSON**: Para troca de dados entre o cliente e a API.

---

## Estrutura do Banco de Dados

### Tabelas Principais:
- **usuarios**: Contém informações dos usuários (ID, email, username, senha).
- **itens**: Contém os itens disponíveis (ID, nome, descrição).
- **pokemons**: Contém os Pokémons da primeira geração (ID, nome, número, tipo_id).
- **tipos**: Contém os tipos de Pokémon (Fogo, Água, Planta, etc.).
- **evolucoes**: Define as relações de evolução entre os Pokémons.
- **usuario_itens**: Relaciona os itens com os usuários e suas quantidades.
- **usuario_pokemons**: Relaciona os Pokémons com os usuários, incluindo o nível e a data de captura.

---

## Como Rodar Localmente

### Pré-requisitos:
- **PHP** (versão 7 ou superior)
- **SQLite** para o banco de dados
- **Servidor web** (opcional, pode usar o PHP embutido)

### Passos para Execução:
1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/pokedex-api.git
  ``
  
2. Acesse a pasta do projeto:
   ```bash
   cd pokedex-api
  ``
  
3. Inicie o servidor PHP embutido:
   ```bash
   php -S localhost:8000
  ``

4. Acesse a API em http://localhost:8000/api/.

## Contribuindo

1. Faça um fork deste repositório.
2. Crie uma nova branch (`git checkout -b feature/novo-recurso`).
3. Realize as alterações e faça commit (`git commit -am 'Adicionar novo recurso'`).
4. Faça push para a sua branch (`git push origin feature/novo-recurso`).
5. Envie um Pull Request para o repositório original.

---

## Licença

Distribuído sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais informações.

---

## Exemplos de Uso dos Endpoints

### 1. Adicionar um Pokémon à Lista do Usuário

**Requisição**:
```bash
POST /api/adicionar_lista.php
Content-Type: application/json

{
  "usuario_pokemons": {
    "usuario_id": 1,
    "pokemon_id": 25,
    "nivel": 5
  }
}
```

#Resposta:

```json
{
  "message": "Pokémon adicionado à lista com sucesso!"
}
```

### 2. Obter Itens e Pokémons de um Usuário com Filtros

**Requisição**:

```bash
GET /api/obter_lista.php?usuario_id=1&nome_item=poke&nome_pokemon=charmander
```

#Resposta:

```json
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
```

## Resumo de Endpoints

| Método | Endpoint                   | Descrição                                           |
|--------|----------------------------|-----------------------------------------------------|
| `POST` | `/api/adicionar_lista.php`  | Adiciona Pokémon e itens à lista do usuário.        |
| `GET`  | `/api/obter_lista.php`      | Obtém a lista de itens e Pokémons de um usuário.    |

---

Este `README.md` foi desenvolvido para proporcionar uma visão clara e objetiva sobre o funcionamento da **Pokedex API**, suas funcionalidades e como interagir com ela. As instruções são simples e as requisições de exemplo são fornecidas para facilitar o uso da API.
