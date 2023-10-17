<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Calculator</title>
</head>
<body>
    <h1>Calculator</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label htmlFor="number01">
    <input type="text"  name="number01" id="number01"  className="number" placeholder="type number one..."/>
    </label>

    <select name="operator" id="operator">
        <option value="add">+</option>
        <option value="subtract">-</option>
        <option value="multiply">*</option>
        <option value="divide">/</option>
    </select>

    <label htmlFor="number02">
    <input type="text"  name="number02" id="number02"  className="number" placeholder="type number two..."/>
    </label>
    <button>Calculate</button>
    </form>

    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $number01 = filter_input(INPUT_POST, "number01", FILTER_SANITIZE_NUMBER_FLOAT);
        $number02 = filter_input(INPUT_POST, "number02", FILTER_SANITIZE_NUMBER_FLOAT);
        $operator = htmlspecialchars($_POST['operator']);

        // Errors checking
        $errors = false;

        if(empty($number01) || empty($number02) || empty($operator)) {
            echo "<div class='calc-error'> Fill in all fields </div>";
            $errors = true;
        }

        if(!is_numeric($number01) || !is_numeric($number02)) {
            echo "<div class='calc-error'> Only write numbers! </div>";
            $errors = true;
        }

        if(!$errors) {
            $value = 0;
            switch ($operator) {
                case 'add':
                    $value = $number01 + $number02;
                    break;
                case 'subtract':
                    $value = $number01 - $number02;
                    break;
                case 'multiply':
                    $value = $number01 * $number02;
                    break;
                case 'divide':
                    $value = $number01 / $number02;
                    break;
                
                default:
                echo "<div class='calc-error'> Something went wrong! </div>";
                    break;
            }

            echo "<div class='calc-result'> Result = $value </div>";
        }

    }
    ?>
</body>
</html>