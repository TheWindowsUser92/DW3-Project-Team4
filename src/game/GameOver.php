<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="../features/cancel.js"></script>
    <title>Level 1</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        div {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: #ff1100;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #929292;
            color: rgb(255, 255, 255);
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555555;
        }
    </style>
</head>

<body>
    <div>
        <h1>Game Over!</h1>
        <h1>Next time you can do it!</h1>

        <?php
            session_start();
            include('../features/score/scoreInsert.php');
            scoreInsert('échec');
            $_SESSION['stopInsert'] = TRUE;
        ?>
        <button onclick="playAgain()">Play Again</button>
        <button onclick="confirmQuit()">Cancel</button>
    </div>

    <script>
        function playAgain() {
            window.location.href = 'StartTheGame.php';
        }
    </script>
</body>
</html>
