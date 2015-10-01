<?php
    session_start();
    require_once('modules/Sector.php');
    $name    = (isset($_SESSION['user_name']) && $_SESSION['user_name'])?$_SESSION['user_name']:'';
    $sectors = (isset($_SESSION['sectors']) && $_SESSION['sectors'] && is_array($_SESSION['sectors']))?$_SESSION['sectors']:array();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="s">

    <title>Sector select</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- jQuery validate-->
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/functions.js"></script>

</head>

<body>

    <!-- Page Content -->
    <div class="container" style="padding:10px;">

        <div class="row">
            <div class="col-md-6 jumbotron hero-spacer">
            <p class="form_title">Please enter your name and pick the Sectors you are currently involved in</p>
                <form action="actions.php" method="post" id="index_form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value=<?php print $name; ?>>
                    </div>
                    <div class="form-group">
                        <label for="sections">Sectors</label>
                        <select multiple class="form-control" id="sectors" name="sectors[]" size="10">
                        <?php
                        foreach(Sector::getSectors() as $s)
                        {
                            $name = str_repeat('&nbsp;', ($s['level']*4)).$s['name'];
                            $selected = in_array($s['id'],$sectors)?'selected':'';
                            printf("<option value='%d' %s>%s</option>",$s['id'],$selected,$name);
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <div class="checkbox">
                    <label>
                        <input type="checkbox" id="terms" name="terms" value="1"> Agree to terms
                    </label>
                    </div>
                    </div>
                    <button type="submit" name="save" value="1" class="btn btn-default">Save</button>
                </form>
            </div>
            <div class="col-md-offset-2 col-md-4">
                <h3>Ülesanne</h3>
                <p>
                    <ul>
                        <li>Kõrvalda kõik puudused index.html-ist</li>
                        <li>Lisa "Sectors" valikualas olevad kirjed andmebaasi ja lisa kood "Sectors" valiku loomiseks</li>
                        <li>"Save" nupu vajutamisel valideerida kõik sisendandmed (kõik väljad on kohustuslikud)</li>
                        <li>Salvestada kogu sisestatud info (name + sector + nõustus/ei nõustunud tingimustega) andmebaasi</li>
                        <li>Täida vorm uuesti salvestatud andmetega ning võimalda kasutajal neid muuta (üle salvestada) sessiooni eluea jooksul</li>
                    </ul>
                </p>
                <p>Märkus: "Agree to terms" checkboxi väärtust ei salvestata andmebaasi, sest kuna kõik väljad on niikuinii kohustuslikud, 
                siis tuleks sinna koguaeg üks ja see sama väärtus. Kasutaja üldjoontes peakski enne salvestamist tingimustega nõustuma.</p>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

</body>

</html>
