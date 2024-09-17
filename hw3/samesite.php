<?php

session_set_cookie_params(['samesite' => 'lax']);

session_start();
if (!isset($_SESSION['cookie_value'])) {
  
  $authcookie = bin2hex(random_bytes(8));

  $_SESSION['cookie_value'] = $authcookie;

  setcookie("csrf-cookie", $authcookie);
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
if ( isset($_POST['comment'])&&isset($_COOKIE['csrf-cookie'])) {
  if ($_COOKIE['csrf-cookie']==$_SESSION['cookie_value']) {
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
