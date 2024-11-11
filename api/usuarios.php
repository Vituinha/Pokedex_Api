<?php
include '../dbSql.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = isset($_GET['username']) ? $_GET['username'] : null;
    $email = isset($_GET['email']) ? $_GET['email'] : null;

    if (!$username && !$email) {
        echo json_encode(["erro" => "Você precisa informar um 'username' ou 'email'."]);
        exit;
    }

    try {
        $pdo = getDbConnection();

        if ($username) {
            $stmt = $pdo->prepare("SELECT id, email, username FROM usuarios WHERE username = :username");
            $stmt->bindParam(':username', $username);
        } else {
            $stmt = $pdo->prepare("SELECT id, email, username FROM usuarios WHERE email = :email");
            $stmt->bindParam(':email', $email);
        }

        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode($user);
        } else {
            echo json_encode(["erro" => "Usuário não encontrado."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["erro" => "Erro ao consultar o usuário: " . $e->getMessage()]);
    }
}
?>
