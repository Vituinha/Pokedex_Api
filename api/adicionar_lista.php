<?php
include '../dbSql.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (isset($data['usuario_itens'])) {
        $usuario_itens = $data['usuario_itens'];
        try {
            $pdo = getDbConnection();

            $stmt = $pdo->prepare("INSERT INTO usuario_itens (usuario_id, item_id, quantidade) VALUES (:usuario_id, :item_id, :quantidade)");
            $stmt->bindValue(':usuario_id', $usuario_itens['usuario_id'], PDO::PARAM_INT);
            $stmt->bindValue(':item_id', $usuario_itens['item_id'], PDO::PARAM_INT);
            $stmt->bindValue(':quantidade', $usuario_itens['quantidade'], PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(["message" => "Item adicionado à lista com sucesso!"]);
        } catch (PDOException $e) {
            echo json_encode(["erro" => "Erro ao adicionar item à lista: " . $e->getMessage()]);
        }
    } 
    elseif (isset($data['usuario_pokemons'])) {
        $usuario_pokemons = $data['usuario_pokemons'];
        try {
            $pdo = getDbConnection();

            $stmt = $pdo->prepare("INSERT INTO usuario_pokemons (usuario_id, pokemon_id, nivel) VALUES (:usuario_id, :pokemon_id, :nivel)");
            $stmt->bindValue(':usuario_id', $usuario_pokemons['usuario_id'], PDO::PARAM_INT);
            $stmt->bindValue(':pokemon_id', $usuario_pokemons['pokemon_id'], PDO::PARAM_INT);
            $stmt->bindValue(':nivel', $usuario_pokemons['nivel'], PDO::PARAM_INT);
            $stmt->execute();

            echo json_encode(["message" => "Pokémon adicionado à lista com sucesso!"]);
        } catch (PDOException $e) {
            echo json_encode(["erro" => "Erro ao adicionar Pokémon à lista: " . $e->getMessage()]);
        }
    } 
    else {
        echo json_encode(["erro" => "Dados inválidos."]);
    }
}
?>
