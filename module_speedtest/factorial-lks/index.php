<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    .container{
        width: 300px;
        background-color: lightblue;
        border: 2px solid yellow;
        padding: 24px;
    }
</style>
<body>

<div class="container">

<form action="">
    <label for="">Enter number of factorial :</label> <br>
    <input name="input" type="number">
</form>

<?php 

 
function facCount($input) {

    if($input == 1){
        return 1;
    }else {
        return $input * facCount($input - 1);
    }

}

$input = 5;

$result = facCount($input)

?>



    <p>=========================</p>
    <p>=========================</p>
    <p>The factorial value of: <?php echo $input ?> is <?php echo $result ?></p>

</div>    


</body>
</html>