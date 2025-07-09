<?php
include 'functions.php';
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
$pdo = connect_to_db();

$sql = 'DELETE FROM todo_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:todo_read.php");
exit();
