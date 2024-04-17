<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winner!</title>

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

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        h1 {
            color: rgb(2, 168, 35);
            margin-bottom: 20px;
        }

        

    </style>
</head>
<body>
    <div class="container">
        <h1>Congratulations!</h1>
        <?php
            session_start();
            include('../features/score/scoreInsert.php');
            scoreInsert('réussite');
            $_SESSION['stopInsert'] = TRUE;
        ?>
        <h1>You have completed all the games and won!</h1>
    </div>
</body>
</html>
