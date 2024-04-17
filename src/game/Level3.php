<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Numbers</title>
    <link rel="stylesheet" href="levelStyle.css">
    <script src="../features/cancel.js"></script>
</head>
<body>
    <div class="container">
        <h1>Game Level 3</h1>
        <h2>Order 6 numbers in ascending order</h2>
        <form action="level3_response.php" method="post">
            <?php
                $numbers = [];
                for ($i = 0; $i < 6; $i++) {
                    $numbers[] = rand(0, 100);
                }
                $sortedNumbers = selectMinimum($numbers);
                echo implode('  ', $numbers);
            ?>
                <br><br>
                <?php
                    for ($i = 0; $i < 6; $i++) {
                    echo "<label for='result{$i}'></label>";
                    echo "<input type='text' id='result{$i}' name='result[]'>";
                    echo "<input type='hidden' id='answer{$i}' value='$sortedNumbers[$i]' name='answer[]'";
                    echo "<br><br>";
                    }   
                ?>
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="confirmQuit()">Cancel</button>
        </form>
        <?php
            function selectMinimum($arr) {
                $n = count($arr);
                for ($i = 0; $i < $n - 1; $i++) {
                    $min_index = $i;
                    for ($j = $i + 1; $j < $n; $j++){
                        if ($arr[$j] < $arr[$min_index]){
                            $min_index = $j;
                        }
                    }
                    $temp = $arr[$min_index];
                    $arr[$min_index] = $arr[$i];
                    $arr[$i] = $temp;
                }

                return $arr;
            }
            /*if (isset($_POST['submit'])) {
                // Process the submitted result here
                $userResults = $_POST['result'];
                $numbers = selectMinimum($userResults);

                // Game logic to determine outcome
                $correct = false;
                for ($i = 0; $i < count($userResults); $i++) {
                    if ($userResults[$i] != $numbers[$i]) {
                        $correct = false;
                        break;
                    }
                    $correct = true;
                }
                if ($correct == true) {
        ?>
                    <h1>Congratulations!</h1>
                    <button onclick="window.location.href = 'Level4.php';">Next Level</button>
                    <button onclick="confirmQuit()">Cancel</button>
                    <?php
                } else {
                    header("Location: GameOver.html");
                    exit;
                }
            }*/
        ?>
    </div>
</body>
</html>
