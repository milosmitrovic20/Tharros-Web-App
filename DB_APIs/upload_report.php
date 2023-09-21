<?php
require 'db_conn.php';  // Make sure this path is correct

$answers = [];
$comments = [];
for ($i = 2; $i <= 111; $i++) {
    $answer = $_POST['q' . $i] ?? null;
    $comment = $_POST['comment' . $i] ?? null;
    
    $answers[] = $answer;
    $comments[] = $comment;
}

$answersJson = json_encode($answers);
$commentsJson = json_encode($comments);

try {
    $stmt = $pdo->prepare("INSERT INTO reports (answers, comments) VALUES (:answers, :comments)");
    $stmt->bindParam(':answers', $answersJson, PDO::PARAM_STR);
    $stmt->bindParam(':comments', $commentsJson, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Report saved successfully!";
    } else {
        echo "Failed to execute statement";
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

?>
