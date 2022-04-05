<?php include 'mysqli.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/all.min.css">
    <title>CRUD</title>
</head>

<body>
    <div class="container">
        <div class="row my-2">
            <a href="create.php" class="btn btn-success col-1">Lisamine</a>
        </div>
        <!-- tabeli osa -->
        <div class="row">
            <?php
            $sql = 'SELECT * FROM simple_small';
            $res = $kl->dbGetArray($sql);
            if ($res !== false) {
            ?>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Nimi</th>
                            <th>Sünniaeg</th>
                            <th>Palk</th>
                            <th>Pikkus</th>
                            <th>Lisatud</th>
                            <th>Muuda</th>
                            <th>Kustuta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($res as $key => $val) {
                        ?>
                            <tr>
                                <td><?php echo $val['name']; ?></td>
                                <td><?php echo $val['birth']; ?></td>
                                <td><?php echo $val['salary']; ?></td>
                                <td><?php echo $val['height']; ?></td>
                                <td><?php echo $val['added']; ?></td>
                                <td class="text-center"><i class="fa-solid fa-person-booth"></i></td>
                                <td class="text-center"><i class="fa-solid fa-person-circle-minus"></i></td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            <?php
            }
            ?>
        </div>
        <i class="fa-solid fa-trash-can"></i>
        <i class="fa-solid fa-apple-whole"></i>
        <a class="fa-solid fa-user-slash"></a>
        <i class="fa-thin fa-user-slash"></i>
        <i class="fa-solid fa-person-circle-plus"></i>
        <i class="fa-solid fa-person-circle-minus"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>