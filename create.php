<?php include 'mysqli.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.13.1/jquery-ui.min.css">
    <title>CRUD</title>
</head>

<body>
    <div class="container">
        <div class="row my-2">
            <!-- veebivorm lisamiseks -->

            <div class="col-sm-12 col-lg-6 mx-auto">
                <h3>Uue isiku lisamine</h3>
                <form action="" method="post">
                    <div class="mb-2">
                        <input type="text" name="name" placeholder="Sisesta nimi" class="form-control">
                    </div>
                    <div class="mb-2">
                        <input type="text" id="birth" name="birth" placeholder="Vali kuupäev" class="form-control">
                    </div>
                    <div class="mb-2">
                        <input type="number" name="salary" placeholder="Sisesta palganumber" class="form-control">
                    </div>
                    <div class="mb-2">
                        <input type="number" name="height" placeholder="Pikkus meetrites 0.00-9.99" class="form-control">
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