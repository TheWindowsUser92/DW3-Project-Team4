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
        <h1>Game Level 6</h1>
        <h2>Identify the smallest and largest number</h2>
        <form action="level6_response.php" method="post">
            <?php
                $numbers = [];
                for ($i = 0; $i < 6; $i++) {
                    $numbers[] = rand(0, 100);
                }
                echo implode('  ', $numbers);
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

                $smallest = selectMinimum($numbers);
                $largest = selectMaximum($numbers);
            ?>
            <br><br>
            <label for="smallest">Smallest Number:</label>
            <input type="text" id="smallest" name="smallest">
            <input type="hidden" id="smallAns" name="smallAns" value="<?php echo $smallest?>">
            <br><br>
            <label for="largest">Largest Number:</label>
            <input type="text" id="largest" name="largest">
            <input type="hidden" id="largeAns" name="largeAns" value="<?php echo $largest?>">
            <br><br>
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="confirmQuit()">Cancel</button>
        </form>
    </div>
</body>
</html>
