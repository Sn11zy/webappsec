<!DOCTYPE html>
<html>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);
    if (isset($queries['action'])&&$queries['action'] == 'logout') {
        header('Location: https://sn11zy.serv00.net/hw01.php');
        setcookie('__host-sessionId', '' , time() - 1,'/',null,true);
    }elseif (isset($_COOKIE['__host-sessionId'])) {
        if (strlen($_COOKIE['__host-sessionId']) == 32 && ctype_xdigit($_COOKIE['__host-sessionId'])) {
            loggedIn();
        }
    } else {
        loggedOut();
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['pword'];
    if ($username === 'user' && $password === 'pass'){
        setcookie('__host-sessionId', bin2hex(random_bytes(16)),null,'/',null,true);
        loggedIn();
    } else {
        echo '<h1> Login incorrect!</h1>';
        loggedOut();
    }
} else {
    echo '<h1> Login incorrect!<br>
          Only GET/POST methods supported.</h1>';
    http_response_code(405);
}


function loggedIn() {
    echo '<h1>Hello user</h1>
          <form action="hw01.php" method="get">
          <input type="hidden" id="action" name="action" value="logout">
          <input type="submit" value="Logout">
          </form>';
}

function loggedOut() {
    echo '<form id="login" action="/hw01.php" method="POST">
        <label for="uname">Username:</label><br>
        <input type="text" id="uname" name="uname"><br>
        <label for="pword">password:</label><br>
        <input type="text" id="pword" name="pword"><br><br>
        <input type="button" value="login" onclick = "check()">
        </form>';

}
?>
</body>
<script>
  function check() {
    const uname = document.getElementById("uname");
    const pword = document.getElementById("pword");
    if(uname.value === "" || pword.value === ""){
      alert("No username or password!")
    } else {
      document.getElementById("login").submit()
    }
  }
</script>
</html>
