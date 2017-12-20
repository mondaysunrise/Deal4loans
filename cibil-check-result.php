<?php
session_start();
require 'scripts/session_check.php';
require 'scripts/db_init.php';
require 'scripts/functionshttps.php';
//print_r($_POST);
//print_r($_REQUEST);
require 'cibil_experian_functions.php';
$CibilScore=677;
$CibilScoreDisplay = $CibilScore;
if (!empty($CibilScore)) {
    if ($CibilScore > 450 && $CibilScore <= 600) {
        $CibilScore = $CibilScore / (6 * 2);
    } elseif ($CibilScore > 600 && $CibilScore <= 650) {
        $CibilScore = ($CibilScore / 10) - 5;
    } elseif ($CibilScore > 301 && $CibilScore <= 450) {
        $CibilScore = $CibilScore / (6 * 3);
    } elseif ($CibilScore <= 300) {
        $CibilScore = 0;
    } else {
        $CibilScore = $CibilScore / 10;
    }
}

?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<link href="https://www.deal4loans.com/css/apply-personal-loans-lp-styles-new2-11-2015.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://www.deal4loans.com/css/pl_apply-tab_styles-new11-2-2015.css" /> 
<link href="https://www.deal4loans.com/css/personal-loans-new-lp-11-2-2015.css" type="text/css" rel="stylesheet" />
<!--<link href="https://www.deal4loans.com/css/bootstrap.min.css" type="text/css" rel="stylesheet" />-->
 <link href="https://www.deal4loans.com/css/jquery-gauge.css" type="text/css" rel="stylesheet">
 <link href="https://www.deal4loans.com/css/credit-score.css" type="text/css" rel="stylesheet" />
        <style>
            .Cibil {
                position: relative;
                width: 20vw;
                height:20vw;
                box-sizing: border-box;
                margin:auto;
            }
			.clearfix{ clear:both;}
			.tp-negative-mo-100{margin-top:-160px;}
			.logo-experion{ float:right; width:30%;}
			.credit-score-experion{ float:right; width:70%;}
			
        </style>

<title>Check Credit Score</title>
<meta name="keywords" content="Check Credit Score" />
<meta name="description" content="Check Credit Score" />
<link href="https://www.deal4loans.com/css/personal-loan-styles.css" type="text/css" rel="stylesheet"  />
</head>
<body class="d4l">
<?php include "middle-menu.php"; ?>
<section>
<div class="container">
<div class="row mr-tp-70">
<div class="col-md-12"><a href="index.php" class="text12" style="color:#0080d6; font-size:14px;">Home</a> &gt;  Credit Score</div>
</div>
</div>
</section>
<div class="clearfix"></div>
<section class="credit-score">
<div>
<div class="row">
<div class="col-md-12">
<img src="new-images/experian_logo.png" alt="" class="logo-experian" />
<hr>
 </div>
</div>
<div class="row">
<div class="col-md-12 text-center customer-headline">Dear <span>Ajay Joshi</span>, Your credit score is</div>
<div class="text-center credit-score-digit"><?php echo $CibilScoreDisplay; ?></div>
</div>

<div class="row">
<div class="col-md-12">
<div class="credit-score-meter">

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
                lineWidth: 90,
                arrowWidth: 18,
                arrowColor: '#000',
                inset: false,
                value: <?php echo $CibilScore; ?>
            });
        </script>
		</div>
</div>
</div>
<div class="clearfix"></div>
<div class="row tp-negative-mo-100">
<div class="col-md-12">
<p class="text-center credit-score-light-text">Thank You for applying at <span>deal4loans.com</span></p>
<p class="text-center credit-score-medium-light-text">Yes Bank representative shall call you back soon.</p>
</div>
</div>

</div>
</section>

<?php include("footer_sub_menu.php"); ?>
</body>
</html>