<?php 
include 'mysqli.php';
if(isset($_GET['sid']) and is_numeric($_GET['sid'])) {
    $id = $_GET['sid'];
    $sql = 'DELETE FROM simple_small WHERE id='.$id;
    if($kl->dbQuery($sql)){
        header('Location: index.php');
    } else {
        ?>
        <p class="text-danger fw-bold">Midagi läks kustutamisega valesti</p>
        <?php
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/all.min.css">
    <title>CRUD</title>
    <link type="image/png" sizes="16x16" rel="icon" href="/images/icons8-poo-16.png">
</head>

<body>
    <div class="container">
        <div class="row my-2">
            <div class="col">
                <a href="create.php" class="btn btn-success col-3" style="max-width: 12rem;" >Lisamine</a>
                <a href="cards.php" class="btn btn-secondary col-3" style="max-width: 12rem;">Cards view</a>
            </div>
        </div>
        <!-- tabeli osa -->
        <div class="row">
            <?php
            $sql = 'SELECT * FROM simple_small, (select sum(salary) as total_salary,avg(height) as avg_height from simple_small) as totals  order by birth DESC';
            $res = $kl->dbGetArray($sql);
            if ($res !== false) {
            ?>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Jrk</th>
                            <th>Nimi</th>
                            <th class="text-center">Sünniaeg</th>
                            <th class="text-end">Palk</th>
                            <th class="text-end">Pikkus</th>
                            <th class="text-end">Lisatud</th>
                            <th>Muuda</th>
                            <th>Kustuta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $salarySum = 0;
                        $heightSum = 0;
                    
                        
                        foreach ($res as $key => $val) {
                            $salarySum += $val['salary'];
                            $heightSum += $val['height'];
                        ?>
                            <tr>
                                <td><?php echo ($key+1).'.'; ?></td>
                                <td><?php echo $val['name']; ?></td>
                                <td class="text-center"><?php echo $val['birth']; ?></td>
                                <td class="text-end"><?php echo $val['salary']; ?></td>
                                <td class="text-end"><?php echo number_format($val['height'],2,',','') ; ?></td>
                                <td class="text-end"><?php echo $kl->dbDateToEstDateClock($val['added']) ; ?></td>
                                <td class="text-center"><span class="text-danger"><?php echo $val['id']." "; ?></span><a href="update.php?sid=<?php echo $val['id']; ?>"><i class="fa-solid fa-person-booth text-primary"></i></td></a>
                                <td class="text-center"><a href="index.php?sid=<?php echo $val['id']; ?>" onclick="return confirm('Kas soovid kirje kustutada?')"><i class="fa-solid fa-person-circle-minus text-danger"></i></td></a>
                            </tr>

                        <?php
                        }
                        
                        ?>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end">Ise arvutatud</td>
                                <td class="text-end"><?php echo $salarySum; ?></td>
                                <td class="text-end"><?php echo number_format($heightSum/count($res),3,',','') ; ?></td>
                                <td colspan="3"></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end">SQL arvutatud</td>
                                <td class="text-end"><?php echo $val['total_salary']; ?></td>
                                <td class="text-end"><?php echo number_format($val['avg_height'],3,',','') ; ?></td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </tbody>

                </table>
            <?php
            }
            ?>
        </div>
        <!--
        <i class="fa-solid fa-trash-can"></i>
        <i class="fa-solid fa-apple-whole"></i>
        <a class="fa-solid fa-user-slash"></a>
        <i class="fa-thin fa-user-slash"></i>
        <i class="fa-solid fa-person-circle-plus"></i>
        <i class="fa-solid fa-person-circle-minus"></i>
        -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>