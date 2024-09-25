<!DOCTYPE html>
<html>
    <head>
        <title>Reflected name</title>
    </head>

    <body>

        <form method="GET" action="">
            <label>Enter your name:</label>
            <input type='text' name='name' value='<?php echo htmlspecialchars($_GET['name'],ENT_QUOTES); ?>'>
            <input type='submit'>
        </form>
        <h1 id="name"></h1>

        <script>
    var name = <?php echo json_encode($_GET['name'],JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS); ?>;
        if (name){ 
	        document.getElementById("name").textContent = 'Your name is: ' + name;
	}
	</script>


        <?php
        if (isset($_GET['name']) && strlen($_GET['name'])) {

echo "<script>alert('Dear ".json_encode($_GET['name'],JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS).", welcome to our website!');</script>\n";
	}
        ?>


    </body>
</html>

