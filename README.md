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
