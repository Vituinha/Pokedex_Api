<?php
include '../dbSql.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $nome = isset($_GET['nome']) ? $_GET['nome'] : '';
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
    $nivel = isset($_GET['nivel']) ? (int)$_GET['nivel'] : null;
    $evolucao = isset($_GET['evolucao']) ? (int)$_GET['evolucao'] : null;

    try {
        $pdo = getDbConnection();

        $query = "SELECT p.id, p.nome, p.numero, t.nome AS tipo, e.nivel AS nivel, ev.id AS evolucao
                  FROM pokemons p
                  LEFT JOIN tipos t ON p.tipo_id = t.id
                  LEFT JOIN evolucoes e ON p.id = e.pokemon_id
                  LEFT JOIN pokemons ev ON e.evolucao_id = ev.id
                  WHERE 1=1";

        if ($nome) {
            $query .= " AND p.nome LIKE :nome";
        }
        if ($tipo) {
            $query .= " AND t.nome LIKE :tipo";
        }
        if ($nivel !== null) {
            $query .= " AND e.nivel = :nivel";
        }
        if ($evolucao !== null) {
            $query .= " AND ev.id = :evolucao";
        }

        $stmt = $pdo->prepare($query);

        if ($nome) {
            $stmt->bindValue(':nome', '%' . $nome . '%');
        }
        if ($tipo) {
            $stmt->bindValue(':tipo', '%' . $tipo . '%');
        }
        if ($nivel !== null) {
            $stmt->bindValue(':nivel', $nivel, PDO::PARAM_INT);
        }
        if ($evolucao !== null) {
            $stmt->bindValue(':evolucao', $evolucao, PDO::PARAM_INT);
        }

        $stmt->execute();

        $pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($pokemons);
    } catch (PDOException $e) {
        echo json_encode(["erro" => "Erro ao consultar os pokémons: " . $e->getMessage()]);
    }
}
?>
