<?php
$_REQUEST['Score']=810;
if (!empty($_REQUEST['Score'])) {
    if ($_REQUEST['Score'] > 450 && $_REQUEST['Score'] <= 600) {
        $CibilScore = $_REQUEST['Score'] / (6 * 2);
    } elseif ($_REQUEST['Score'] > 600 && $_REQUEST['Score'] <= 650) {
        $CibilScore = ($_REQUEST['Score'] / 10) - 5;
    } elseif ($_REQUEST['Score'] > 301 && $_REQUEST['Score'] <= 450) {
        $CibilScore = $_REQUEST['Score'] / (6 * 3);
    } elseif ($_REQUEST['Score'] <= 300) {
        $CibilScore = 0;
    } else {
        $CibilScore = $_REQUEST['Score'] / 10;
    }
}
?>
<!doctype html>
<html>
    <head>
        <title>jquery-gauge demo</title>
        <meta name="viewport" content="width=1024, maximum-scale=1">
        <link href="css/jquery-gauge.css" type="text/css" rel="stylesheet">
        <style>


            .Cibil {
                position: relative;
                width: 20vw;
                height: 20vw;
                box-sizing: border-box;
                float:left;
                margin:20px
            }
        </style>

    </head>
    <body>
        <div class="gauge1 Cibil"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.deal4loans.com/js/jquery-gauge.min.js"></script>
        <script>
            // second example
            $('.gauge1').gauge({
                values: {
                    0: '300',
                   100: '900'
                },
                colors: {
                    0: '#be1f24',
                    20: '#ff9935',
                    40: '#fdde12',
                    60: '#8cc43d',
                    80: '#01a14b'
                    
                },
                angles: [
                    180,
                    360
                ],
                lineWidth: 80,
                arrowWidth: 14,
                arrowColor: '#000',
                inset: false,
                value: <?php echo $CibilScore; ?>
            });
        </script>
        <p><strong>Cibil Score :</strong> <?php echo $_REQUEST['Score']; ?></p>
    </body>
</html>