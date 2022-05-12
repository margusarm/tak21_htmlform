<?php 
include 'mysqli.php';
include 'helper.php';

$error_text = ""; //veateade
$error_count = 0; //vigade loendaja
$result = false; //kas kõik ok

if(isset($_POST['birth'])){
    $kl->show($_POST);
    $name = trim($kl->getVar('name'));
    $birth = trim($kl->getVar('birth'));
    $salary = trim($kl->getVar('salary'));
    $height = trim($kl->getVar('height'));
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
        $sql = 'INSERT INTO simple_small SET
        name ='.$kl->dbFix($name).',
        birth = '.$kl->dbFix($birth).',
        salary = '.$kl->dbFix($salary).',
        height = '.$kl->dbFix($height).',
        added = NOW()';
        if($kl->dbQuery($sql)){
            $result = true;
            unset($_POST);
            header('Location: index.php');
        }else {
            $error_count++;
            $error_text = "Kirje lisamisega tekkis probleem";
        }
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
                <h3>Uue isiku lisamine</h3>
                <?php 
                if($error_count > 0){
                    ?>
                    <p class="text-danger fw-bold"><?php echo $error_text; ?></p>
                    <?php
                } else if($result) {
                    ?>
                    <p class="text-success fw-bold"> Isik lisati andmebaasi</p>
                    <?php
                }
                ?>
                <form action="create.php" method="post">
                    <div class="mb-2">
                        <input type="text" name="name" value="<?php if(isset($_POST['name'])) {echo $name;} ?>" onkeyup="charcountupdate(this.value);" placeholder="Sisesta nimi" class="form-control" required>
                        <span id="info">Max 20 märki</span>
                    </div>
                    <div class="mb-2">
                        <input type="text" id="birth" name="birth" value="<?php if(isset($_POST['birth'])) {echo $birth;} ?>" placeholder="Vali kuupäev" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <input type="number" name="salary" value="<?php if(isset($_POST['salary'])) {echo $salary;} ?>"  placeholder="Sisesta palganumber" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <input type="number" name="height" value="<?php if(isset($_POST['height'])) {echo $height;} ?>" min="0.6" max="2.76" step="0.01" placeholder="Pikkus meetrites 0.00-9.99" class="form-control" required>
                    </div>
                    <div class="mb-2 row">
                        <div class="col-6">
                            <input type="submit" value="Lisa uus isik" class="form-control btn btn-primary">
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