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
        <h1>Game Level 5</h1>
        <h2>Identify the first (smallest) and last letter (largest)</h2>
        <form action="level5_response.php" method="post">
            <?php
                $letters = range('a', 'z');
                shuffle($letters);
                $randomLetters = array_slice($letters, 0, 6);
                echo implode('  ', $randomLetters);
            ?>
            <br><br>
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

                    return $arr[0]; // Return the smallest element
                }

                function selectMaximum($arr) {
                    $n = count($arr);
                    for ($i = 0; $i < $n - 1; $i++) {
                        $max_index = $i;
                        for ($j = $i + 1; $j < $n; $j++){
                            if ($arr[$j] > $arr[$max_index]){
                                $max_index = $j;
                            }
                        }
                        $temp = $arr[$max_index];
                        $arr[$max_index] = $arr[$i];
                        $arr[$i] = $temp;
                    }

                    return $arr[0]; // Return the largest element
                }

                $smallest = selectMinimum($randomLetters);
                $largest = selectMaximum($randomLetters);
            ?>
            <br><br>
            <label for="smallest">Smallest Letter:</label>
            <input type="text" id="smallest" name="smallest">
            <input type="hidden" id="smallAns" name="smallAns" value="<?php echo $smallest?>">
            <br><br>
            <label for="largest">Largest Letter:</label>
            <input type="text" id="largest" name="largest">
            <input type="hidden" id="largeAns" name="largeAns" value="<?php echo $largest?>">
            <br><br>
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="confirmQuit()">Cancel</button>
        </form>
    </div>
</body>
</html>
