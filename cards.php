<?php
include 'mysqli.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <?php
    $sql = 'SELECT * FROM simple_small';
    $res = $kl->dbGetArray($sql);
    if ($res !== false) {
    ?>
        <div class="container">
            <div class="row row-cols-auto">
            <?php 
            foreach ($res as $key => $val) {
            ?>
                <div class="col">
                    <div class="card">
                        <div class="card-header text-center"><?php echo $val['name']; ?></div>
                        <div class="card-body">
                            <p class="card-text">Sünniaeg: <?php echo $kl->dbDateToEstDate($val['birth']); ?></p>
                            <p class="card-text">Palk: <?php echo $val['salary']; ?></p>
                            <p class="card-text">Pikkus: <?php echo $val['height']; ?></p>
                        </div>
                        <div class="card-footer row g-0 row-cols-2">
                            <div class="col">
                                <div class="text-start">
                                    <a href="#" class="btn btn-primary">Delete</a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-end text-danger">
                                    <p><?php echo $kl->dbDateToEstDateClock($val['added']); ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php 
            }
                ?>
            </div>
        </div>


    <?php
    }

    ?>





</body>

</html>