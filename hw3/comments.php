<?php

session_start();
if (!isset($_SESSION['csrf-token'])) {
  # code...
  $token = bin2hex(random_bytes(8));
  $_SESSION['csrf-token'] = $token;
}


$db = new SQLite3('.comments.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
// Create a table.
$db->query('CREATE TABLE IF NOT EXISTS "comments" (
  "id" INTEGER PRIMARY KEY,
  "comment" VARCHAR,
  "ip" VARCHAR,
  "added" DATETIME
)');

function S($text) {
    return htmlspecialchars($text, ENT_QUOTES);
}

// add comment if POSTed
if ( isset($_POST['comment'])&&isset($_POST['csrf-token']) ) {
  if ($_POST['csrf-token']===$_SESSION['csrf-token']) {
  // Insert data
    $db->exec('BEGIN');
    $sql = 'INSERT INTO "comments" ("comment", "ip", "added") VALUES (?, ?, datetime("now","localtime"))';
    $statement = $db->prepare($sql);
    $statement->bindValue(1, substr($_POST['comment'], 0, 70));
    $statement->bindValue(2, $_SERVER['REMOTE_ADDR']);
    $statement->execute();
  $db->exec('COMMIT');
  } 
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Write a comment</title>
</head>
<body>

    <h1>Write a comment</h1>
    <textarea form="commentForm" id="commentId" name="comment" placeholder="Add your comment..." rows="3" cols="30"></textarea>
    <form method="POST" name="commentForm" action="" id="commentForm">
        <?php
          echo "<input type='hidden' name='csrf-token' value=".$_SESSION['csrf-token'].">"
        ?>
        <input type="submit" value="Add">
    </form>
    <h2>Comments</h2>
    <ul>
    <?php

        $statement = $db->prepare('SELECT * FROM "comments" ORDER BY "added" DESC LIMIT 30');
        $result = $statement->execute();
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo '<li>['.S($row['added']).'] ('.S($row['ip']).') '.S($row['comment']).'</li>';
            echo "\n";
        }

        $db->close();

    ?>
    </ul>

</body>
</html>
