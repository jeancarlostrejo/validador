<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>

    <?php

    use Ferre\Validador\models\Validator;

    $validator1 = new Validator("11/11/2011");
    $validator2 = new Validator(45);

    $validator1
        ->isNumber()
        ->isEmail()
        ->isUrl()
        ->contains(["google", "www"])
        ->isDate();

    $validator2
        ->isNumber()
        ->minLength(3)
        ->contains(["google", "www"])
        ->isDate();

    if (count($validator1->getErrors()) > 0) {

        echo "Hay un error en validator 1";

        foreach ($validator1->getErrors() as $error) {
            echo "<div> {$error['value']}: {$error['text']}</div>";
        }
    }

    if (count($validator2->getErrors()) > 0) {

        echo "Hay un error en validator 2";

        foreach ($validator2->getErrors() as $error) {
            echo "<div> {$error['value']}: {$error['text']}</div>";
        }
    }
    ?>
</body>
</html>
