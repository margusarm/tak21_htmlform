<?php 
include 'mysqli.php';
include 'helper.php';

$error_text = ""; //veateade
$error_count = 0; //vigade loendaja
$result = false; //kas kõik ok

if(isset($_GET['sid']) && is_numeric($_GET['sid'])){
    $id = $_GET['sid'];
    $sql = 'SELECT * FROM simple_small WHERE id = '.$id;
    $res = $kl->dbGetArray($sql);
    if($res !== false) {
        $val = $res[0];
    }
}

if(isset($_POST['update'])){
    $kl->show($_POST);
    $name = trim($kl->getVar('name'));
    $birth = trim($kl->getVar('birth'));
    $salary = trim($kl->getVar('salary'));
    $height = trim($kl->getVar('height'));
    $id = trim($kl->getVar('sid'));
    if(strlen($name) < 2){
        $error_count++;
        $error_text = "nimi on liiga lühike";
    }
    if(strlen($name) > 20){
        $error_count++;
        $error_text = "nimi liiga pikk";
    }
    if(!validateDate($birth)){
        $error_count++;
        $error_text = "sünniaeg vigane";
    } else {
        if(isDateFuture($birth)){
            $error_count++;
            $error_text = "Sünniaeg on tulevikus";
        }
    }
    if(empty($salary) or $salary < 0 or $salary > 99999){
        $salary = 0;
    }

    if ($height < 0.6 OR $height > 2.73){
        $error_count++;
        $error_text = "Pikkus vales vahemikus";
    }
    if($error_count == 0){
        $sql = 'UPDATE simple_small SET
        name ='.$kl->dbFix($name).',
        birth = '.$kl->dbFix($birth).',
        salary = '.$kl->dbFix($salary).',
        height = '.$kl->dbFix($height).',
        added = NOW() WHERE id='.$id;
        if($kl->dbQuery($sql)){
            //$result = true;
            //unset($_POST);
            header('Location: index.php');
        }else {
            $error_count++;
            $error_text = "Kirje lisamisega tekkis probleem";
        }
    } else {
        header('Location: update.php?sid='.$id);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.13.1/jquery-ui.min.css">
    <title>CRUD</title>
    <link type="image/png" sizes="16x16" rel="icon" href="/images/icons8-poo-16.png">
</head>

<body>
    <div class="container">
        <div class="row my-2">
            <!-- veebivorm lisamiseks -->
            <div class="col-sm-12 col-lg-6 mx-auto">
                <h3>Isiku muutmine</h3>
                <?php 
                if($error_count > 0){
                    ?>
                    <p class="text-danger fw-bold"><?php echo $error_text; ?></p>
                    <?php
                }
                ?>
                <form action="update.php" method="post">
                    <div class=" row mb-2">
                        <label for="name" class="col-2 col-form-label"> Nimi</label>
                        <div class="col-10">
                            <input type="text" id="name" name="name" value="<?php if(isset($val['name'])) { echo $val['name']; } ?>" onkeyup="charcountupdate(this.value);" placeholder="Sisesta nimi" class="form-control">
                            <span id="info">Max 20 märki</span>
                        </div>

                    </div>
                    <div class="row mb-2">
                        <label for="birth" class="col-2 col-form-label">Sünniaeg</label>
                        <div class="col-10">
                            <input type="text" id="birth" name="birth" value="<?php if(isset($val['birth'])) { echo $val['birth']; } ?>" placeholder="Vali kuupäev" class="form-control">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <label for="salary" class="col-2 col-form-label">Palk</label>
                        <div class="col-10">
                            <input type="number" id="salary" name="salary" value="<?php if(isset($val['salary'])) { echo $val['salary']; } ?>" placeholder="Sisesta palganumber" class="form-control">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <label for="height" class="col-2 col-form-label">Pikkus</label>
                        <div class="col-10">
                            <input type="number" id="height" name="height" value="<?php if(isset($val['height'])) { echo $val['height']; } ?>" min="0.6" max="2.76" step="0.01"  placeholder="Pikkus meetrites 0.00-9.99" class="form-control">
                        </div>

                    </div>
                    <div class="row mb-2">
                        <input type="hidden" name="sid" value="<?php if(isset($val['id'])) { echo $val['id']; } ?>">
                        <div class="col-6">
                            <input type="submit" value="Muuda" name="update" class="form-control btn btn-primary">
                        </div>
                        <div class="col-6">
                            <a href="index.php" class="form-control btn btn-warning">Avalehele</a>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.13.1/jquery-ui.min.js"></script>
    <script src="js/datepicker-et.js"></script>
    <script src="js/helper.js"></script>
    <script>
        $(function() {
            $("#birth").datepicker({
                changeMonth: true, // Näita kuu combobox
                changeYear: true, // Näita aasta combobox
                yearRange: '-100:+1', // -100 aasta kuni +1 aasta valikud
                dateFormat: 'yy-mm-dd' // Kuupäeva vorming
            });
        });
    </script>
</body>

</html>