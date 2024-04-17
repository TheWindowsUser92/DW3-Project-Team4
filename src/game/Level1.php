<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Letters</title>
    <link rel="stylesheet" href="levelStyle.css">
    <script src="../features/cancel.js"></script>
</head>
<body>
    <div class="container">
        <h1>Game Level 1</h1>
        <h2>Order 6 letters in alphabetical order</h2>
        <form action="level1_response.php" method="post">
            <?php
                $letters = range('a', 'z');
                shuffle($letters);
                $randomLetters = array_slice($letters, 0, 6);
                $sortedLetters = selectMinimum($randomLetters); // Sort the random letters array
                echo implode('  ', $randomLetters); // Display sorted letters to the user
            ?>
            <br><br>
            <?php
                for ($i = 0; $i < 6; $i++) {
                    echo "<label for='result{$i}'></label>";
                    echo "<input type='text' id='result{$i}' name='result[]'>";
                    echo "<input type='hidden' id='answer{$i}' value='$sortedLetters[$i]' name='answer[]'";
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
        ?>
    </div>
</body>
</html>
