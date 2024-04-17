<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quit The Game</title>
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
            color: #ff8400;
            margin-bottom: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #01ff3c;
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
            background-color: #1bd91b;
        }
    </style>
</head>
<body>
    <div>
        <h1>You have quit the game successfully!</h1>
        <?php
            session_start();
            if(!$_SESSION['stopInsert'] || $_SESSION['stopInsert'] == FALSE)
            {
                include('../features/score/scoreInsert.php');
                scoreInsert('incomplet');
            }
        ?>
        <button onclick="window.location.href = 'StartTheGame.php'">New Game</button>
    </div>
</body>
</html>
