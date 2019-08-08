<!doctype html>
<!-- [if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif] -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>EAQ Checker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="Check if there's data in EAQ repository" content="The HTML5 Herald">
        <meta name="Gabriel Oliveira" content="EAQ Checker">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div id="wrapper">
            <h1>Monitoramento de RAWDATA enviados para a EAQ</h1>
            <div id="row">
                <h2>Date and Time</h2>
                <h2>Not Sent, & Less than 1Mb = <?php include_once('checkingEaq.php'); echo $lesser ?></h2>
            </div>
<?php
    include_once('checkingEaq.php');
    foreach ($eaq_measures as $key => $value) {
?>
            <div id="data-row">
                <h3><?php echo $value['date']; ?></h3>
                <h3><?php echo $value['value']; ?></h3>
                <div class="<?php echo ($value['value'] != 0) ? 'red' : 'green'; ?>">
                    <div class="<?php echo ($value['value'] != 0) ? 'close icon' : 'check icon'; ?>"></div>
                </div>
            </div>
<?php
}
?>
        </div>
        <script src="main.js"></script>
    </body>
</html>

