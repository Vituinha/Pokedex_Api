<?php
include '../dbSql.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $usuario_id = isset($_GET['usuario_id']) ? (int)$_GET['usuario_id'] : null;
    $nome_item = isset($_GET['nome_item']) ? $_GET['nome_item'] : '';
    $nome_pokemon = isset($_GET['nome_pokemon']) ? $_GET['nome_pokemon'] : '';
    $nivel_pokemon = isset($_GET['nivel_pokemon']) ? (int)$_GET['nivel_pokemon'] : null;
    $tipo_pokemon = isset($_GET['tipo_pokemon']) ? $_GET['tipo_pokemon'] : '';
    $data_captura = isset($_GET['data_captura']) ? $_GET['data_captura'] : '';

    try {
        $pdo = getDbConnection();

        $query_itens = "SELECT i.id, i.nome, i.descricao, ui.quantidade
                        FROM usuario_itens ui
                        JOIN itens i ON ui.item_id = i.id
                        WHERE ui.usuario_id = :usuario_id";

        if ($nome_item) {
            $query_itens .= " AND i.nome LIKE :nome_item";
        }

        $query_pokemons = "SELECT p.id, p.nome, p.numero, t.nome AS tipo, up.nivel, up.data_captura
                           FROM usuario_pokemons up
                           JOIN pokemons p ON up.pokemon_id = p.id
                           LEFT JOIN tipos t ON p.tipo_id = t.id
                           WHERE up.usuario_id = :usuario_id";

        if ($nome_pokemon) {
            $query_pokemons .= " AND p.nome LIKE :nome_pokemon";
        }
        if ($nivel_pokemon !== null) {
            $query_pokemons .= " AND up.nivel = :nivel_pokemon";
        }
        if ($tipo_pokemon) {
            $query_pokemons .= " AND t.nome LIKE :tipo_pokemon";
        }
        if ($data_captura) {
            $query_pokemons .= " AND DATE(up.data_captura) = :data_captura";
        }

        $stmt_itens = $pdo->prepare($query_itens);
        $stmt_itens->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        if ($nome_item) {
            $stmt_itens->bindValue(':nome_item', '%' . $nome_item . '%');
        }
        $stmt_itens->execute();

        $stmt_pokemons = $pdo->prepare($query_pokemons);
        $stmt_pokemons->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        if ($nome_pokemon) {
            $stmt_pokemons->bindValue(':nome_pokemon', '%' . $nome_pokemon . '%');
        }
        if ($nivel_pokemon !== null) {
            $stmt_pokemons->bindValue(':nivel_pokemon', $nivel_pokemon, PDO::PARAM_INT);
        }
        if ($tipo_pokemon) {
            $stmt_pokemons->bindValue(':tipo_pokemon', '%' . $tipo_pokemon . '%');
        }
        if ($data_captura) {
            $stmt_pokemons->bindValue(':data_captura', $data_captura);
        }
        $stmt_pokemons->execute();

        $itens = $stmt_itens->fetchAll(PDO::FETCH_ASSOC);
        $pokemons = $stmt_pokemons->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "itens" => $itens,
            "pokemons" => $pokemons
        ]);
    } catch (PDOException $e) {
        echo json_encode(["erro" => "Erro ao consultar os dados: " . $e->getMessage()]);
    }
}
?>
