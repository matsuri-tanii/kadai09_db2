<?php
include ('funcs.php');
// 入力項目のチェック
// var_dump($_POST);
// exit();

if (
  !isset($_GET['id']) || $_GET['id'] === ''
) {
  exit('paramError');
}

$id = $_GET['id'];

// DB接続
$pdo = db_conn();

$sql = 'DELETE FROM records WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:read.php");
exit();
