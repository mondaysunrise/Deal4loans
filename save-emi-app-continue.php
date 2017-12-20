<?php
require 'scripts/db_init.php';
require 'scripts/functions.php';
require 'eligiblebidderPL_svemi.php';
//print_r($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$Years_In_Company = $_POST["current_experience"];//done
$Total_Experience = $_POST["total_experience"];//done
$card_vintage = $_POST["card_vintage"];//done
$ccCity = $_POST["City"];//done
$plCity = $_POST["plCity"];//done
$hlCity = $_POST["hlCity"];//done
$product_type = $_POST["product_type"];
$outstanding_amount_cc = $_POST["outstanding_amount_cc"];//done
$existing_bank_pl = $_POST["existing_bank_pl"];
$existing_la_pl = $_POST["existing_la_pl"];
$existing_roi_pl = $_POST["existing_roi_pl"];
$existing_noofemi_pl = $_POST["existing_noofemi_pl"];
$existing_tenure_pl = $_POST["existing_tenure_pl"]/12;
$existing_prepay_pl = $_POST["existing_prepay_pl"];
$plbt_income = $_POST["plbt_income"];
$plbt_companyname = $_POST["plbt_companyname"];
$Property_Loc = $_POST["Property_Loc"];
$existing_bank_hl = $_POST["existing_bank_hl"];
$existing_la_hl = $_POST["existing_la_hl"];
$existing_roi_hl = $_POST["existing_roi_hl"];
$existing_noofemi_hl = $_POST["existing_noofemi_hl"];
$existing_tenure_hl = $_POST["existing_tenure_hl"]/12;
$existing_prepay_hl = $_POST["existing_prepay_hl"];
$hlbt_income = $_POST["hlbt_income"];
$company_name = $_POST["company_name"];//done
$net_income = $_POST["net_income"];//done
$ccage = $_POST["age"];//done
$hlage = $_POST["hlage"];
$plage = $_POST["plage"];
$salary_account = $_POST["salary_account"];//done
$Primary_Acc = $salary_account;
$monthsalary = $net_income;
$Unique_Code = generateNumber(4);
if($Years_In_Company>0)
	{
		$pl_yearsincompany=$Years_In_Company;
	}
	else
	{
		$pl_yearsincompany=3;
	}

if($Total_Experience>0)
	{
		$pl_totalexperience=$Years_In_Company;
	}
	else
	{
		$pl_totalexperience=5;
	}
	
if(strlen($plbt_companyname)>2)
	{
$getCompany_Name = $plbt_companyname;}
else
	{
	$getCompany_Name = $company_name;}
	
//$PL_EMI_Amt

if($net_income>1)
	{
		$net_salary=$net_income*12;
	}
if($plbt_income>1)
	{
		$net_salary=$plbt_income*12;
	}
if($hlbt_income>1)
	{
		$net_salary=$hlbt_income*12;
	}
if($existing_la_pl=="")
	{
		$existing_la_pl=0;
	}
if($outstanding_amount_cc=="")
	{
	$outstanding_amount_cc=0;
	}
if($existing_la_hl=="")
	{
		$existing_la_hl=0;
	}
if(strlen($ccage)>1)
	{
		$age=$ccage;
	}
if(strlen($hlage)>1)
	{
		$age=$hlage;
	}

if(strlen($plage)>1)
	{
		$age=$plage;
	}

if(strlen($ccCity)>1)
	{
		$City=$ccCity;
	}
if(strlen($hlCity)>1)
	{
		$City=$hlCity;
	}

if(strlen($plCity)>1)
	{
		$City=$plCity;
	}

 if(strlen($age)>1)
       {
               $Yr = date("Y") - $age;
               $dobTime  = mktime(date("H"), date("i"), 0, date("m")  , date("d"), $Yr);
               $dob = date("Y-m-d", $dobTime);
       }
	   else
	{
		   $age=30;
		 $Yr = date("Y") - $age;
               $dobTime  = mktime(date("H"), date("i"), 0, date("m")  , date("d"), $Yr);
               $dob = date("Y-m-d", $dobTime);
	}		

$getcompany='select kotak,hdfc_bank,fullerton,citibank,barclays,standard_chartered,hdbfs,ingvyasya,bajajfinserv,icici_bank from pl_company_list where company_name="'.$getCompany_Name.'"';
//echo $getcompany;
$getcompanyresult = ExecQuery($getcompany);
$grow=mysql_fetch_array($getcompanyresult);
$recordcount = mysql_num_rows($getcompanyresult);
$hdfccategory= $grow["hdfc_bank"];
$fullertoncategory= $grow["fullerton"];
$citicategory= $grow["citibank"];
$barclayscategory= $grow["barclays"];
$stanccategory = $grow["standard_chartered"];
$hdbfscategory = $grow["hdbfs"]; 
$ingvyasyacategory = $grow["ingvyasya"]; 
$bajajfinservcategory = $grow["bajajfinserv"]; 
$icici_bankcategory = $grow["icici_bank"]; 
$Indusind = $grow["Indusind"];
$kotakcategory = $grow["kotak"];

if($existing_noofemi_hl<6) { $EMI_Paid_hl=1;} elseif($existing_noofemi_hl>=6 && $existing_noofemi_hl<9) {$EMI_Paid_hl=2;}
		elseif($existing_noofemi_hl>=9 && $existing_noofemi_hl<12) {$EMI_Paid_hl=3;}
		elseif($existing_noofemi_hl>=12) {$EMI_Paid_hl=4;}

if($existing_noofemi_pl<6) { $EMI_Paid_pl=1;} elseif($existing_noofemi_pl>=6 && $existing_noofemi_pl<9) {$EMI_Paid_pl=2;}
		elseif($existing_noofemi_pl>=9 && $existing_noofemi_pl<12) {$EMI_Paid_pl=3;}
		elseif($existing_noofemi_pl>=12) {$EMI_Paid_pl=4;}

if($existing_noofemi_hl>0 && ($existing_noofemi_pl==0 || $existing_noofemi_pl==""))
	{
		$EMI_Paid=$EMI_Paid_hl;
	}
	elseif($existing_noofemi_pl>0 && ($existing_noofemi_hl==0 || $existing_noofemi_hl==""))
	{
		$EMI_Paid=$EMI_Paid_pl;	
	}
	else
	{	
		if($existing_bank_hl>0 && $existing_bank_pl>0)
		{
			if($existing_noofemi_hl>$existing_noofemi_pl)
			{
				$EMI_Paid=$EMI_Paid_hl;
			}
			else
			{
				$EMI_Paid=$EMI_Paid_pl;	
			}
		}
		else
		{
			$EMI_Paid=0;
		}
	}

if($outstanding_amount_cc>5)
	{
	$CC_Holder=1;
	}

if(strlen($existing_bank_pl)>0 &&  strlen($existing_la_pl)>0)
	{ $flag_plbt=1; } 
if(strlen($existing_bank_hl)>0 &&  strlen($existing_la_hl)>0)
	{ $flag_hlbt=1; }
$IP = $_SERVER["HTTP_X_REAL_IP"];
//this is for CC oustanding

$enterquery="INSERT INTO `saveemicalc_tbl` ( `EMI_Paid`, `Primary_Acc`, `Net_Salary`, `DOB`, `Employment_Status`, `Loan_Amount`, `City`, `City_Other`, `Company_Name`, `CC_Holder`, `Card_Vintage`,  `dated`, Years_In_Company, Total_Experience, flag_plbt,	flag_hlbt,ip_address) VALUES ( '".$EMI_Paid."', '".$salary_account."', '".$net_salary."', '".$dob."', '1', '".$outstanding_amount_cc."', '".$City."', '".$City_Other."', '".$getCompany_Name."', '".$CC_Holder."', '".$card_vintage."',  Now(), '".$Years_In_Company."','".$Total_Experience."', '".$flag_plbt."', '".$flag_hlbt."', '".$IP."')";
//echo $enterquery;
$enterqueryresult1=ExecQuery($enterquery);
$last_inserted_id = mysql_insert_id();

//this is for PL BT
if(strlen($existing_bank_pl)>0 &&  strlen($existing_la_pl)>0)
	{
$enterquerypl="INSERT INTO `saveemicalc_tbl_pl` (saveemiid, `Net_Salary`, `DOB`, `Employment_Status`, `City`, `City_Other`, `existing_bank_pl`, `existing_la_pl`, `existing_roi_pl`, `existing_noofemi_pl`, `existing_tenure_pl`, `existing_prepay_pl`, EMI_Paid, dated, Years_In_Company,Total_Experience ) VALUES ('".$last_inserted_id."', '".$net_salary."', '".$dob."', '1', '".$City."', '".$City_Other."', '".$existing_bank_pl."', '".$existing_la_pl."', '".$existing_roi_pl."', '".$existing_noofemi_pl."', '".$existing_tenure_pl."', '".$existing_prepay_pl."', '".$EMI_Paid_pl."', Now(), '".$pl_yearsincompany."','".$pl_totalexperience."')";
	$enterqueryplresult1=ExecQuery($enterquerypl);
	$last_inserted_id_pl = mysql_insert_id();
	}

//this is for HL BT
if(strlen($existing_bank_hl)>0 &&  strlen($existing_la_hl)>0)
	{
$enterqueryhl="INSERT INTO `saveemicalc_tbl_hl` (saveemiid, `Net_Salary`, `DOB`, `Employment_Status`, `City`, `City_Other`, `existing_bank_hl`, `existing_la_hl`, `existing_tenure_hl`, `existing_prepay_hl`, `existing_roi_hl`, `existing_noofemi_hl`, EMI_Paid, Property_Loc, dated ) VALUES ('".$last_inserted_id."', '".$net_salary."', '".$dob."', '1', '".$City."', '".$City_Other."', '".$existing_bank_hl."', '".$existing_la_hl."', '".$existing_tenure_hl."', '".$existing_prepay_hl."','".$existing_roi_hl."', '".$existing_noofemi_hl."' , '".$EMI_Paid_hl."', '".$Property_Loc."', Now())";
$enterqueryhlresult1=ExecQuery($enterqueryhl);
$last_inserted_id_hl = mysql_insert_id();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Save My EMI</title>
<link href="save-my-emi-styles1.css" type="text/css" rel="stylesheet"  />   
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
$(function () {
      $(document).ready(function() {
             Highcharts.visualize = function(table, options) {
            // the categories
            options.xAxis.categories = [];
            $('tbody th', table).each( function(i) {
                options.xAxis.categories.push(this.innerHTML);
            });
               // the data series
            options.series = [];
            $('tr', table).each( function(i) {
                var tr = this;
                $('th, td', tr).each( function(j) {
                    if (j > 0) { // skip first column
                        if (i == 0) { // get the name and init the series
                            options.series[j - 1] = {
                                name: this.innerHTML,
                                data: []
                            };
                        } else { // add values
                            options.series[j - 1].data.push(parseFloat(this.innerHTML));
                        }
                    }
                });
            });    
            var chart = new Highcharts.Chart(options);
			
        }
   // alert(outstandingamountcc);
   var outstandingamountcc = <? echo $outstanding_amount_cc; ?>;
	 if(outstandingamountcc>1)
		 {
       var table = document.getElementById('datatable'),
        options = {
            chart: {
                renderTo: 'container',
                type: 'column'
            },
           
            xAxis: {
            },
            yAxis: {
                title: {
                    text: 'Interest Amount'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.y +' '+ this.x.toLowerCase();
                }
            }
        };
   
        Highcharts.visualize(table, options); 
		 }
		  
		   var existinglapl = <? echo $existing_la_pl; ?>;
		   if(existinglapl>0)
		  {
		 var tableplbt = document.getElementById('datatable_plbt'),
        options = {
            chart: {
                renderTo: 'containerplbt',
                type: 'column'
            },
            /*title: {
                text: 'Data extracted from a HTML table in the page'
            },*/
            xAxis: {
            },
            yAxis: {
                title: {
                    text: 'Interest Amount'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.y +' '+ this.x.toLowerCase();
                }
            }
        };
            Highcharts.visualize(tableplbt, options);
		  }
		    var existinglahl = <? echo $existing_la_hl; ?>;
		   if(existinglahl>0)
		  {
		 var tablehlbt = document.getElementById('datatable_hlbt'),
        options = {
            chart: {
                renderTo: 'containerhlbt',
                type: 'column'
            },            
            xAxis: {
            },
            yAxis: {
                title: {
                    text: 'Interest Amount'
                }
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.y +' '+ this.x.toLowerCase();
                }
            }
        };    
        Highcharts.visualize(tablehlbt, options);
		  }
    });
    
});
		</script>
<script src="scripts/highcharts.js"></script>
<style type="text/css">
	/* Big box with list of options */
	#ajax_listOfOptions{
		position:absolute;	/* Never change this one */
		width:250px;	/* Width of box */
		height:160px;	/* Height of box */
		overflow:auto;	/* Scrolling features */
		border:1px solid #317082;	/* Dark green border */
		background-color:#FFF;	/* White background color */
    	color: black;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		text-align:left;
		font-size:10px;
		z-index:50;
	}
	#ajax_listOfOptions div{	/* General rule for both .optionDiv and .optionDivSelected */
		margin:1px;		
		padding:1px;
		cursor:pointer;
		font-size:10px;
	}

	#ajax_listOfOptions .optionDivSelected{ /* Selected item in the list */
		background-color:#2375CB;
		color:#FFF;
	}
	#ajax_listOfOptions_iframe{
		background-color:#F00;
		position:relative;
		z-index:5;
	}
	form{
		display:inline;
	}	
.div-displaytext{ width:98%; padding:10px 0px 10px 0px; border-radius:7px; border:thin solid #feb800; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; text-indent:5px; color:#990000;}
.tool-tip-image{ width:185px; margin-top:30px; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#990000; padding:25px 10px 25px 10px; background:#eeeeee; border-radius:7px; border:#90dcef solid 1px; float:left; z-index:2px; margin-left:-5px;  }
.tool-tiparrow{ width:53px; margin:-4px auto;}
</style>
    <style type="text/css">
        .demo {
            width: 1000px;
            margin: 0px auto;
        }
        .demo h1 {
                margin:33px 0 25px;
            }
        .demo h3 {
                margin: 10px 0;
            }
        pre {
            background: #fff;
        }
        @media only screen and (max-width: 780px) {
        .demo {
                margin: 5%;
                width: 90%;
         }
        .how-use {
                float: left;
                width: 300px;
                display: none;
            }
        }
        #tabInfo {display:none;}
		.diverboxnew{width:100%; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:20px; text-align:center;}
		.diverboxnew-new{width:300px; margin:15px auto; font-family: Geneva, Arial, Helvetica, sans-serif; font-style:italic; font-size:18px; text-align:center;}
		.boxyesone{ float:left; width:100px; margin-left:15px;}
    </style>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.text11 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #005399;
	text-decoration: none; 	
}
.text9 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: normal;
	color: #697e94;
	text-decoration: none; 
}
.text9 a{
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: normal;
	color: #697e94;
	margin:0px;
	padding:0px;
	text-decoration:underline;
}
.text12 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none; 
} 
.text {
	font-family: 'Droid Serif', serif;
	font-size: 18px;
	font-weight: normal;
	font-variant: normal;
	color: #005399;
	text-decoration: none;
	font-style: italic;
	@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
	line-height: 18px;
}
.text2 {
	font-family: 'Droid Serif', serif;
	font-size: 18px;
	font-weight: normal;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none;
	font-style: italic;
	@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
}
.text3 {
	font-family: 'Droid Sans', sans-serif;
	font-size: 12px;
	font-weight: normal;
	font-variant: normal;
	color: #909faf;
	text-decoration: none;
	text-transform: uppercase;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}
a.btn:link {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
 	font-variant: normal;
	color: #588f27;
	text-decoration: none;
 	padding:5px 12px 5px 12px ;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}

a.btn:visited {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
 	font-variant: normal;
	color: #588f27;
	text-decoration: none;
 		padding:5px 12px 5px 12px ;
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}

a.btn:hover {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
	font-variant: normal;
	color: #203f5f;
	text-decoration: none;
	  	padding:5px 12px 5px 12px ;
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}
.text4 {
	font-family: 'Droid Sans', sans-serif;
	font-size: 10px;
	font-weight: bold;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none;
	text-transform: uppercase;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}
.textbox {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	color: #666;
	text-decoration: none;
	height: 18px;
	width: 153px;
	border: none;
	margin-top:7px;
	margin-left:30px;
 }
.font {
	font-family: DroidSansRegular;
	font-size: 12px;
	font-weight: normal;
	font-variant: normal;
	color: #666666;
	text-decoration: none;
	font-style: italic;	  
}
-->
</style>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.text11 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #005399;
	text-decoration: none; 	
}
.text9 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: normal;
	color: #697e94;
	text-decoration: none; 
}

.text9 a{
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9px;
	font-weight: normal;
	font-variant: normal;
	color: #697e94;
	margin:0px;
	padding:0px;
	text-decoration:underline;
}
.text12 {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none; 
} 
.text {
	font-family: 'Droid Serif', serif;
	font-size: 18px;
	font-weight: normal;
	font-variant: normal;
	color: #005399;
	text-decoration: none;
	font-style: italic;
	@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
	line-height: 18px;
}
.text2 {
	font-family: 'Droid Serif', serif;
	font-size: 18px;
	font-weight: normal;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none;
	font-style: italic;
	@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
}
.text3 {
	font-family: 'Droid Sans', sans-serif;
	font-size: 12px;
	font-weight: normal;
	font-variant: normal;
	color: #909faf;
	text-decoration: none;
	text-transform: uppercase;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}
a.btn:link {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
 	font-variant: normal;
	color: #588f27;
	text-decoration: none;
 	padding:5px 12px 5px 12px ;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}

a.btn:visited {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
 	font-variant: normal;
	color: #588f27;
	text-decoration: none;
 		padding:5px 12px 5px 12px ;
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}

a.btn:hover {
	font-family: 'Droid Sans', sans-serif;
	font-size: 14px;
	font-variant: normal;
	color: #203f5f;
	text-decoration: none;
	  	padding:5px 12px 5px 12px ;
		@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}
.text4 {
	font-family: 'Droid Sans', sans-serif;
	font-size: 10px;
	font-weight: bold;
	font-variant: normal;
	color: #ffffff;
	text-decoration: none;
	text-transform: uppercase;
	@import url(http://fonts.googleapis.com/css?family=Droid+Sans); 
}
.textbox {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 11px;
	font-weight: normal;
	color: #666;
	text-decoration: none;
	height: 18px;
	width: 153px;
	border: none;
	margin-top:7px;
	margin-left:30px;
 }

.font {
	font-family: DroidSansRegular;
	font-size: 12px;
	font-weight: normal;
	font-variant: normal;
	color: #666666;
	text-decoration: none;
	font-style: italic;	  
}
-->
</style>
<link href="source1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/mainmenu.js"></script>
<link href="source.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
<!--<script src="scripts/exporting.js"></script>-->
</head>
<body>
<?php include "top-menu.php"; ?>
<?php include "main-menu-saveemiapp.php"; ?>
<div class="myapp-save_second-wrapper"><div class="table-wrapperbxapp">
<!-------------------------------------------------------->
<?
$sequence = array('A','B','C','D','E','F','G','H','I');
if($outstanding_amount_cc>50000)
{ 

//this clause for personal loan only
$Final_Bidcc="";
$Final_Bidccarr="";
list($realbankiD,$bankID,$FinalBidder,$finalBidderName)= getBiddersList("saveemicalc_tbl",$last_inserted_id,$City);
	$Final_Bid = "";
			while (list ($key,$val) = @each($bankID)) { 
				$Final_Bid[]= $val; 
			}
			$Final_Bidccarr = "";
			while (list ($key,$val) = @each($FinalBidder)) { 
				$Final_Bidccarr[]= $val; 
			}
$Final_Bidcc=implode(",",$Final_Bidccarr);

$FinalBidder=implode(',',$FinalBidder);
$realbankiD=implode(',',$realbankiD);
/*echo "for CC <br><br>";
			print_r($Final_Bid);
			echo "<br><br>";*/

	$agepl=59;	
	require 'scripts/personal_loan_eligibility_function_form.php';
	$cc_pmemi= round($outstanding_amount_cc * (36/1200) / (1 - (pow(1/(1 + (36/1200)), 12))));;
	$totalinterest_cc = ($cc_pmemi*12)-$outstanding_amount_cc;
	$bnkarray="";
	$totalsaving_ccouttopl="";
//hdfc
if(in_array("HDFC", $Final_Bid)==1 || in_array("HDFC Bank", $Final_Bid)==1)
	{
list($hdfcinterestrate,$hdfcgetloanamout,$hdfcgetemicalc,$hdfcterm,$hdfcperlacemi)=hdfcbank($monthsalary,$PL_EMI_Amt,$getCompany_Name,$hdfccategory,$agepl,$Company_Type,$Primary_Acc);
$hdfcpl_irval=trim(str_replace("%", "", $hdfcinterestrate));
if(($hdfcpl_irval)>1 && $hdfcgetloanamout>1)
	{
$bnkarray=$hdfcpl_irval.",";
	}
	}
//icici
if(in_array("ICICI", $Final_Bid)==1 || in_array("ICICI Bank", $Final_Bid)==1)
	{
list($iciciinterestrate,$icicigetloanamout,$icicigetemicalc,$iciciterm,$iciciperlacemi)=icicibank($monthsalary,$getCompany_Name,$icici_bankcategory,$agepl,$Company_Type,$Primary_Acc);
$icicipl_irval=trim(str_replace("%", "", $iciciinterestrate));
if($icicipl_irval>1 && $icicigetemicalc>1)
	{
$bnkarray.=$icicipl_irval.",";
	}
	}
//indus
if(in_array("INDUS IND bank", $Final_Bid)==1)
	{
list($indusindrate,$indusindloanamt,$indusindemi,$indusindterm,$indusindperlacemi)=@indusindbank($monthsalary,$getCompany_Name,$Indusind,$agepl,$clubbed_emi);
$induspl_irval=trim(str_replace("%", "", $indusindrate));
if($indusindemi>1)
	{
$bnkarray.=$induspl_irval.",";
	}
	}
//fullerton
if(in_array("Fullerton", $Final_Bid)==1)
	{
list($fullertoninterestrate,$fullertongetloanamout,$fullertongetemicalc,$fullertonterm,$fullertonperlacemi,$fulfinalrate)=@fullerton($monthsalary,$PL_EMI_Amt,$getCompany_Name,$fullertoncategory,$agepl,$City);
$fullertonpl_irval=trim(str_replace("%", "", $fulfinalrate));
if($fullertongetemicalc>1)
	{
$bnkarray.=$fullertonpl_irval.",";
	}
	}
//hdbfs
if(in_array("HDBFS", $Final_Bid)==1)
	{
list($interestrate,$getloanamout,$getemicalc,$term,$Processing_Fee)= hdbfcLoans($hdbfscategory, $monthsalary, $Primary_Acc,$agepl,$PL_EMI_Amt,$Loan_Amount);
$hdbfspl_irval=trim(str_replace("%", "", $interestrate));
if($getemicalc>1)
	{
$bnkarray.=$hdbfspl_irval.",";
	}
	}
//ingvysya
if(in_array("IngVysya", $Final_Bid)==1 || in_array("ING Vysya", $Final_Bid)==1 ||  in_array("IngVysya Bank", $Final_Bid)==1)
	{
list($inginterestrate,$inggetloanamout,$inggetemicalc,$ingterm,$ingProcessing_Fee)= ingVyasyaLoans_nw($ingvyasyacategory, $monthsalary, $account_holder,$agepl,$PL_EMI_Amt,$Loan_Amount,$getCompany_Name,$Company_Type);
$ingpl_irval=trim(str_replace("%", "", $inginterestrate));
if($inggetemicalc>1)
	{
$bnkarray.=$ingpl_irval.",";
	}
	}
$bnkarray = substr(trim($bnkarray), 0, strlen(trim($bnkarray))-1); //remove the final comma sign
$bankarry = explode(',',$bnkarray);
$bnkarraysrt = min($bankarry);
if(count($bankarry)>0)
	{ ?>
		<div class="secondstage-box" style="background:#FFF;">
<div class="headtext-bxapp">Your Credit Card Outstanding can be converted into Personal Loan <br>Please compare your savings.</div>
	<? }
?>
   <table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-radius:7px; background:#FFF;">
  <tr>
    <td height="55" align="center" bgcolor="#FFFFFF" class="columntext-app"><table width="100%" border="0" cellspacing="1" cellpadding="0" style=" border-radius:7px; border:#999 solid thin;">
      <tr>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Banks </td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Loan Amount</td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Interest Rate</td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">EMI</td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Tenure</td>
        <td height="55" align="center" bgcolor="#f4f4f4" class="textdapp" width="12%">Total Saving</td>
        <td height="55" align="center" bgcolor="#f4f4f4" class="textdapp" width="12%">&nbsp;</td>
      </tr>
      <tr>
        <td height="7" colspan="7" bgcolor="#CCCCCC" class="td-bg"></td>
      </tr>
      <?
################################################################################################################################
//hdfcbank
list($exactrate,$extra) = split('[%]', $hdfcinterestrate);
if($bnkarraysrt==trim($exactrate))
	{$css_ttlsav='style="border:#FF6633 1px solid !important; height:45px;"';}else { $css_ttlsav='';}
if($exactrate<36 && $hdfcgetloanamout>0)
	{
if($hdfcgetloanamout> $outstanding_amount_cc)
	{
	$mths=$hdfcterm*12;
	$intr = $exactrate/1200;
	$hdfcgetemicalc=round($outstanding_amount_cc * $intr / (1 - (pow(1/(1 + $intr), $mths))));
	$hdfcplbt_la = $outstanding_amount_cc;
	$hdfcplbt_IR = $exactrate."%";
	}
	else
		{
		$hdfcplbt_la = $hdfcgetloanamout;
		$hdfcplbt_IR = $hdfcinterestrate;
	}
	$totalinterest_hdfcplbt = ($hdfcgetemicalc*12)-$hdfcplbt_la;
	$totalsaving_hdfcplbt = round($totalinterest_cc - $totalinterest_hdfcplbt);
	if($totalsaving_hdfcplbt>0 && ($totalinterest_cc>$totalinterest_hdfcplbt))
		{
	?>	
	<tr>
	<td colspan="7">
	<form action="save-emi-app-ccthanks.php" target="_Blank" name="cc_outstanding" method="POST">
	<input type="hidden" name="unique_code" id="unique_code" value="<? echo $last_inserted_id; ?>">
	<input type="hidden" name="cc_bidderid" id="cc_bidderid" value="<? echo $Final_Bidcc; ?>">
	<input type="hidden" name="cc_bankid" id="cc_bankid" value="4">
	<input type="hidden" name="quote_type" id="quote_type" value="cc_outstanding">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
   			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_bankname" id="cc_bankname" value="HDFC Bank"><? echo "HDFC Bank"; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_loanamount" id="cc_loanamount" value="<? echo $hdfcplbt_la; ?>">Rs. <? echo $hdfcplbt_la; ?></td>
			<td height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_interestrate" id="cc_interestrate" value="<? echo $hdfcplbt_IR; ?>"><? echo $hdfcplbt_IR; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_emi" id="cc_emi" value="<? echo $hdfcgetemicalc; ?>">Rs. <? echo $hdfcgetemicalc; ?></td>
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_term" id="cc_term" value="<? echo $hdfcterm; ?>"><? echo $hdfcterm; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text" ><input type="hidden" name="cc_totalsave" id="cc_totalsave" value="<? echo $totalsaving_hdfcplbt; ?>">Rs. <? echo $totalsaving_hdfcplbt; ?></td>
           <td height="35" align="center" bgcolor="#EFEFEF"><input name="image"  value="Submit_CChdfc" type="image" src="images/apply-savemy-app.png" width="47" height="21"  style="border:0px;" /></td>
		</tr>
		</table>
		</form>
		</td></tr>
		<?
		$totalsaving_ccouttopl[]=$totalinterest_hdfcplbt;
		$seqcountoc[]=1;
		$showquotesquerycc="INSERT INTO `saveemicalc_tbl_showquotes` (`saveemiid`, `bank_name`, `interest_rate`, `loan_amount`, `new_emi`, `tenure`, `total_saving`, `product_details`, `dated`) VALUES ('".$last_inserted_id."', 'HDFC Bank', '".$hdfcplbt_IR."', '".$hdfcplbt_la."', '".$hdfcgetemicalc."', '".$hdfcterm."', '".round($totalsaving_hdfcplbt)."', 'CC OS', Now())";
		$showquotesqueryccresult1=ExecQuery($showquotesquerycc);
		}
	}
################################################################################################################################
//icicibank START Here ########################################################################################################
//echo "ICICI  bank: ".$iciciinterestrate." - ".$icicigetloanamout." - ".$icicigetemicalc." - ".$iciciterm." - ".$iciciperlacemi."<br><br/>";
list($iciciexactrate,$extra) = split('[%]', $iciciinterestrate);
if($bnkarraysrt==trim($iciciexactrate))
	{$css_ttlsav='style="border:#FF6633 1px solid !important; height:45px;"';}else { $css_ttlsav='';}

if($iciciexactrate<36 && $icicigetloanamout>1)
	{
if($icicigetloanamout> $outstanding_amount_cc)
	{
	$mths=$iciciterm*12;
	$intr = $iciciexactrate/1200;
	$icicigetemicalc=round($outstanding_amount_cc * $intr / (1 - (pow(1/(1 + $intr), $mths))));
	$iciciplbt_la = $outstanding_amount_cc;
	$iciciplbt_IR = $iciciexactrate."%";
	}
	else
		{
		$iciciplbt_la = $icicigetloanamout;
		$iciciplbt_IR = $iciciinterestrate;
	}	
	$totalinterest_iciciplbt = ($icicigetemicalc*12)-$iciciplbt_la;
	$totalsaving_iciciplbt = round($totalinterest_cc - $totalinterest_iciciplbt);
	if($totalsaving_iciciplbt>0 && ($totalinterest_cc>$totalinterest_iciciplbt))
		{
	?>
	<tr>
	<td colspan="7">
	<form action="save-emi-app-ccthanks.php" target="_Blank" name="cc_outstanding" method="POST">
	<input type="hidden" name="unique_code" id="unique_code" value="<? echo $last_inserted_id; ?>">
	<input type="hidden" name="cc_bidderid" id="cc_bidderid" value="<? echo $Final_Bidcc; ?>">
	<input type="hidden" name="cc_bankid" id="cc_bankid" value="27">
	<input type="hidden" name="quote_type" id="quote_type" value="cc_outstanding">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
     		<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_bankname" id="cc_bankname" value="ICICI"><? echo "ICICI Bank"; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_loanamount" id="cc_loanamount" value="<? echo $iciciplbt_la; ?>">Rs. <? echo $iciciplbt_la; ?></td>
			<td height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_interestrate" id="cc_interestrate" value="<? echo $iciciplbt_IR; ?>"><? echo $iciciplbt_IR; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_emi" id="cc_emi" value="<? echo $icicigetemicalc; ?>">Rs. <? echo $icicigetemicalc; ?></td>
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_term" id="cc_term" value="<? echo $iciciterm; ?>"><? echo $iciciterm; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text" ><input type="hidden" name="cc_totalsave" id="cc_totalsave" value="<? echo $totalsaving_iciciplbt; ?>">Rs. <? echo $totalsaving_iciciplbt; ?></td>
           <td height="35" align="center" bgcolor="#EFEFEF"><input name="image"  value="Submit_CCicici" type="image" src="images/apply-savemy-app.png" width="47" height="21"  style="border:0px;" /></td>
	</tr>
		</table>
		</form>
		</td></tr>
		<?
		$totalsaving_ccouttopl[]=round($totalinterest_iciciplbt);
		$seqcountoc[]=2;
		$showquotesquerycc="INSERT INTO `saveemicalc_tbl_showquotes` (`saveemiid`, `bank_name`, `interest_rate`, `loan_amount`, `new_emi`, `tenure`, `total_saving`, `product_details`, `dated`) VALUES ('".$last_inserted_id."', 'ICICI Bank', '".$iciciplbt_IR."', '".$iciciplbt_la."', '".$icicigetemicalc."', '".$iciciterm."', '".round($totalsaving_iciciplbt)."', 'CC OS', Now())";
	$showquotesqueryccresult1=ExecQuery($showquotesquerycc);
	}
	}
//ICICI BANK END HERE####################################################################################################
//indusbank START HERE #################################################################################################
//echo "INDUS bank: ".$indusindrate." - ".$indusindloanamt." - ".$indusindemi." - ".$indusindterm." - ".$indusindperlacemi."<br><br/>";
list($indusexactrate,$extra) = split('[%]', $indusindrate);
if($bnkarraysrt==trim($indusexactrate))
	{$css_ttlsav='style="border:#FF6633 1px solid !important; height:45px;"';}else { $css_ttlsav='';}
if($indusexactrate<36 && $indusindloanamt>1)
	{
	//echo $indusindloanamt."<br>".$outstanding_amount_cc;
if($indusindloanamt > $outstanding_amount_cc)
	{
	$indusmths=$indusindterm*12;
	$indusintr = $indusexactrate/1200;
	$indusindemi=round($outstanding_amount_cc * $indusintr / (1 - (pow(1/(1 + $indusintr), $indusmths))));
	$indusindplbt_la = $outstanding_amount_cc;
	$indusindplbt_IR = $indusexactrate."%";
	}
	else
		{
		//echo "<br>here";
		$indusindplbt_la = $indusindloanamt;
		$indusindplbt_IR = $indusindrate;
	}	
	$totalinterest_indusindplbt = ($indusindemi*12)-$indusindplbt_la;
	$totalsaving_indusindplbt = round($totalinterest_cc - $totalinterest_indusindplbt);
	if($totalsaving_indusindplbt>0 && ($totalinterest_cc>$totalinterest_indusindplbt))
		{
	?>
	<tr>
	<td colspan="7">
	<form action="save-emi-app-ccthanks.php" target="_Blank" name="cc_outstanding" method="POST">
	<input type="hidden" name="unique_code" id="unique_code" value="<? echo $last_inserted_id; ?>">
	<input type="hidden" name="cc_bidderid" id="cc_bidderid" value="<? echo $Final_Bidcc; ?>">
	<input type="hidden" name="cc_bankid" id="cc_bankid" value="51">
	<input type="hidden" name="quote_type" id="quote_type" value="cc_outstanding">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		   	<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_bankname" id="cc_bankname" value="IndusInd"><? echo "INDUS Ind Bank"; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_loanamount" id="cc_loanamount" value="<? echo $indusindplbt_la; ?>">Rs. <? echo $indusindplbt_la; ?></td>
			<td  height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_interestrate" id="cc_interestrate" value="<? echo $indusindplbt_IR; ?>"><? echo $indusindplbt_IR; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_emi" id="cc_emi" value="<? echo $indusindemi; ?>">Rs. <? echo $indusindemi; ?></td>
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_term" id="cc_term" value="<? echo $indusindterm; ?>"><? echo $indusindterm; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_totalsave" id="cc_totalsave" value="<? echo $totalsaving_indusindplbt; ?>">Rs. <? echo $totalsaving_indusindplbt; ?></td>
           <td height="35" align="center" bgcolor="#EFEFEF"><input name="image"  value="Submit_CCindus" type="image" src="images/apply-savemy-app.png" width="47" height="21"  style="border:0px;" /></td>
	</tr>
		</table>
		</form>
		</td></tr>
	<? 
	$totalsaving_ccouttopl[]=round($totalinterest_indusindplbt);
	$seqcountoc[]=3;
	$showquotesquerycc="INSERT INTO `saveemicalc_tbl_showquotes` (`saveemiid`, `bank_name`, `interest_rate`, `loan_amount`, `new_emi`, `tenure`, `total_saving`, `product_details`, `dated`) VALUES ('".$last_inserted_id."', 'INDUS Ind Bank', '".$indusindplbt_IR."', '".$indusindplbt_la."', '".$indusindemi."', '".$indusindterm."', '".round($totalsaving_indusindplbt)."', 'CC OS', Now())";
	$showquotesqueryccresult1=ExecQuery($showquotesquerycc);
	}
	}
//Indusbank END HERE#########################################################################################################
//fullerton START HERE #####################################################################################################
//echo "Fullerton bank: ".$fulfinalrate." - ".$fullertongetloanamout." - ".$fullertongetemicalc." - ".$fullertonterm." - ".$fullertonperlacemi."<br><br/>";
list($fulexactrate,$extra) = split('[%]', $fulfinalrate);
if($bnkarraysrt==trim($fulexactrate))	{$css_ttlsav='style="border:#FF6633 1px solid !important; height:45px;"';}else { $css_ttlsav='';}
if($fulexactrate<36 && $fullertongetloanamout>1)
	{
if($fullertongetloanamout> $outstanding_amount_cc)
	{
	$fulmths=$fullertonterm*12;
	$fulintr = $fulexactrate/1200;
	$fullertongetemicalc=round($outstanding_amount_cc * $fulintr / (1 - (pow(1/(1 + $fulintr), $fulmths))));
	$fullertonplbt_la = $outstanding_amount_cc;
	$fullertonplbt_IR = $fulexactrate."%";
	}
	else
		{
		$fullertonplbt_la = $fullertongetloanamout;
		$fullertonplbt_IR = $fulfinalrate;
	}	
	$totalinterest_fullertonindplbt = ($fullertongetemicalc*12)-$fullertonplbt_la;
	$totalsaving_fullertondplbt = round($totalinterest_cc - $totalinterest_fullertonindplbt);
	if($totalsaving_fullertondplbt>0 && ($totalinterest_cc>$totalinterest_fullertonindplbt))
		{
	?>
	<tr>
	<td colspan="7">
	<form action="save-emi-app-ccthanks.php" target="_Blank" name="cc_outstanding" method="POST">
	<input type="hidden" name="unique_code" id="unique_code" value="<? echo $last_inserted_id; ?>">
	<input type="hidden" name="cc_bidderid" id="cc_bidderid" value="<? echo $Final_Bidcc; ?>">
	<input type="hidden" name="cc_bankid" id="cc_bankid" value="17">
	<input type="hidden" name="quote_type" id="quote_type" value="cc_outstanding">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>  
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_bankname" id="cc_bankname" value="Fullerton"><? echo "Fullerton"; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_loanamount" id="cc_loanamount" value="<? echo $fullertonplbt_la; ?>">Rs. <? echo $fullertonplbt_la; ?></td>
			<td height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_interestrate" id="cc_interestrate" value="<? echo $fullertonplbt_IR; ?>"><? echo $fullertonplbt_IR; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_emi" id="cc_emi" value="<? echo $fullertongetemicalc; ?>">Rs. <? echo $fullertongetemicalc; ?></td>
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_term" id="cc_term" value="<? echo $fullertonterm; ?>"><? echo $fullertonterm; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_totalsave" id="cc_totalsave" value="<? echo $totalsaving_fullertondplbt; ?>">Rs. <? echo $totalsaving_fullertondplbt; ?></td>
            <td height="35" align="center" bgcolor="#EFEFEF"><input name="image"  value="Submit_CCful" type="image" src="images/apply-savemy-app.png" width="47" height="21"  style="border:0px;" /></td>
	</tr>
		</table>
		</form>
		</td></tr>
	<? 
	$totalsaving_ccouttopl[]=round($totalinterest_fullertonindplbt);
	$seqcountoc[]=4;
	$showquotesquerycc="INSERT INTO `saveemicalc_tbl_showquotes` (`saveemiid`, `bank_name`, `interest_rate`, `loan_amount`, `new_emi`, `tenure`, `total_saving`, `product_details`, `dated`) VALUES ('".$last_inserted_id."', 'Fullerton', '".$fullertonplbt_IR."', '".$fullertonplbt_la."', '".$fullertongetemicalc."', '".$fullertonterm."', '".round($totalsaving_fullertondplbt)."', 'CC OS', Now())";
	$showquotesqueryccresult1=ExecQuery($showquotesquerycc);
	}
	}
//fullerton ENDS HERE ######################################################################################
//hdbfs START HERE ####################################################################################
//echo "HDBFS bank: ".$interestrate." - ".$getloanamout." - ".$getemicalc." - ".$term." - ".$Processing_Fee."<br><br/>";
list($hdbfsexactrate,$extra) = split('[%]', $interestrate);
if($bnkarraysrt==trim($hdbfsexactrate))
	{$css_ttlsav='style="border:#FF6633 1px solid !important; height:45px;"';} else { $css_ttlsav='';}
if($hdbfsexactrate<36 && $getloanamout>1)
	{
if($getloanamout> $outstanding_amount_cc)
	{
	$hdbfsmths=$term*12;
	$hdbfsintr = $hdbfsexactrate/1200;
	$getemicalc=round($outstanding_amount_cc * $hdbfsintr / (1 - (pow(1/(1 + $hdbfsintr), $hdbfsmths))));
	$hdbfsplbt_la = $outstanding_amount_cc;
	$hdbfsplbt_IR = $hdbfsexactrate."%";
	}
	else
		{
		$hdbfsplbt_la = $getloanamout;
		$hdbfsplbt_IR = $interestrate;
	}	
	$totalinterest_hdbfsindplbt = ($getemicalc*12)-$hdbfsplbt_la;
	$totalsaving_hdbfsdplbt = round($totalinterest_cc - $totalinterest_hdbfsindplbt);
	if($totalsaving_hdbfsdplbt>0 && ($totalinterest_cc>$totalsaving_hdbfsdplbt))
		{
	?>
	<tr>
	<td colspan="7">
	<form action="save-emi-app-ccthanks.php" target="_Blank" name="cc_outstanding" method="POST">
	<input type="hidden" name="unique_code" id="unique_code" value="<? echo $last_inserted_id; ?>">
	<input type="hidden" name="cc_bidderid" id="cc_bidderid" value="<? echo $Final_Bidcc; ?>">
	<input type="hidden" name="cc_bankid" id="cc_bankid" value="49">
	<input type="hidden" name="quote_type" id="quote_type" value="cc_outstanding">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr> 
			<td  height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_bankname" id="cc_bankname" value="HDBFS"><? echo "HDBFS"; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_loanamount" id="cc_loanamount" value="<? echo $hdbfsplbt_la; ?>">Rs. <? echo $hdbfsplbt_la; ?></td>
			<td height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_interestrate" id="cc_interestrate" value="<? echo $hdbfsplbt_IR; ?>"><? echo $hdbfsplbt_IR; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_emi" id="cc_emi" value="<? echo $getemicalc; ?>">Rs. <? echo $getemicalc; ?></td>
			<td  height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_term" id="cc_term" value="<? echo $term; ?>"><? echo $term; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text" <? echo $css_ttlsav; ?>><input type="hidden" name="cc_totalsave" id="cc_totalsave" value="<? echo $totalsaving_hdbfsdplbt; ?>">Rs. <? echo $totalsaving_hdbfsdplbt; ?></td>
            <td height="35" align="center" bgcolor="#EFEFEF"><input name="image"  value="Submit_CChdbfs" type="image" src="images/apply-savemy-app.png" width="47" height="21"  style="border:0px;" /></td>
		</tr>
		</table>
		</form>
		</td></tr>
	<? 
	$totalsaving_ccouttopl[]=round($totalinterest_hdbfsindplbt);
	$seqcountoc[]=5;

	$showquotesquerycc="INSERT INTO `saveemicalc_tbl_showquotes` (`saveemiid`, `bank_name`, `interest_rate`, `loan_amount`, `new_emi`, `tenure`, `total_saving`, `product_details`, `dated`) VALUES ('".$last_inserted_id."', 'HDBFS', '".$hdbfsplbt_IR."', '".$hdbfsplbt_la."', '".$getemicalc."', '".$term."', '".round($totalsaving_hdbfsdplbt)."', 'CC OS', Now())";
	$showquotesqueryccresult1=ExecQuery($showquotesquerycc);
	}
	}
//HDBFS END HERE ################################################################################################
//ingvysya START HERE #########################################################################################
//echo "INg vysya bank: ".$inginterestrate." - ".$inggetloanamout." - ".$inggetemicalc." - ".$ingterm." - ".$ingProcessing_Fee."<br><br/>";
list($ingexactrate,$extra) = split('[%]', $inginterestrate);
if($bnkarraysrt==trim($ingexactrate))
	{$css_ttlsav='style="border:#FF6633 1px solid !important; height:45px;"';}else { $css_ttlsav='';}
if($ingexactrate<36 && $inggetloanamout>1)
	{
if($inggetloanamout> $outstanding_amount_cc)
	{
	$ingmths=$ingterm*12;
	$ingintr = $ingexactrate/1200;
	$inggetemicalc=round($outstanding_amount_cc * $ingintr / (1 - (pow(1/(1 + $ingintr), $ingmths))));
	$ingvysyaplbt_la = $outstanding_amount_cc;
	$ingvysyaplbt_IR = $ingexactrate."%";
	}
	else
		{
		$ingvysyaplbt_la = $inggetloanamout;
		$ingvysyaplbt_IR = $inginterestrate;
	}	
	$totalinterest_ingvysyaindplbt = ($inggetemicalc*12)-$ingvysyaplbt_la;
	$totalsaving_ingvysyadplbt = round($totalinterest_cc - $totalinterest_ingvysyaindplbt);
	if($totalsaving_ingvysyadplbt>0 && ($totalinterest_cc>$totalsaving_ingvysyadplbt))
		{
	?>
	<tr>
	<td colspan="7">
	<form action="save-emi-app-ccthanks.php" target="_Blank" name="cc_outstanding" method="POST">
	<input type="hidden" name="unique_code" id="unique_code" value="<? echo $last_inserted_id; ?>">
	<input type="hidden" name="cc_bidderid" id="cc_bidderid" value="<? echo $Final_Bidcc; ?>">
	<input type="hidden" name="cc_bankid" id="cc_bankid" value="24">
	<input type="hidden" name="quote_type" id="quote_type" value="cc_outstanding">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr> 
    		<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_bankname" id="cc_bankname" value="ING Vysya"><? echo "INGVysya Bank"; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_loanamount" id="cc_loanamount" value="<? echo $ingvysyaplbt_la; ?>">Rs. <? echo $ingvysyaplbt_la; ?></td>
			<td height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_interestrate" id="cc_interestrate" value="<? echo $ingvysyaplbt_IR; ?>"><? echo $ingvysyaplbt_IR; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_emi" id="cc_emi" value="<? echo $inggetemicalc; ?>">Rs. <? echo $inggetemicalc; ?></td>
			<td height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_term" id="cc_term" value="<? echo $inggetemicalc; ?>"><? echo $ingterm; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text" <? echo $css_ttlsav; ?>><input type="hidden" name="cc_totalsave" id="cc_totalsave" value="<? echo $totalsaving_ingvysyadplbt; ?>">Rs. <? echo $totalsaving_ingvysyadplbt; ?></td>
            <td height="35" align="center" bgcolor="#EFEFEF">
		<input name="image"  value="Submit_CCing" type="image" src="images/apply-savemy-app.png" width="47" height="21"  style="border:0px;" />			</td>
</tr>
		</table>
		</form>
		</td></tr>
	<? 
	$totalsaving_ccouttopl[]=round($totalinterest_ingvysyaindplbt);
	$seqcountoc[]=6;

	$showquotesquerycc="INSERT INTO `saveemicalc_tbl_showquotes` (`saveemiid`, `bank_name`, `interest_rate`, `loan_amount`, `new_emi`, `tenure`, `total_saving`, `product_details`, `dated`) VALUES ('".$last_inserted_id."', 'INGVysya Bank', '".$ingvysyaplbt_IR."', '".$ingvysyaplbt_la."', '".$inggetemicalc."', '".$ingterm."', '".round($totalsaving_ingvysyadplbt)."', 'CC OS', Now())";
	$showquotesqueryccresult1=ExecQuery($showquotesquerycc);
	}
	}
	?>
	  </table></td></tr></table> <div style="clear:both;"></div>
  <div class="form-box-shadow"><img src="images/form-shadow-app.jpg" width="450" height="30"></div>
</div>
<div class="right-panel-app-new" id="container" style="height:300px !important;">
<? 
if(count($totalsaving_ccouttopl)>0)
{
	?>
    
	<table id="datatable" style="display:none;">
	<thead>	<tr>			<th></th>			<th>CC Interest</th>
			<th>Bank Interest</th>		</tr>	</thead>	<tbody>		
		<? for($sv=0;$sv<count($totalsaving_ccouttopl);$sv++)
	{	$SVI=$sv+1
		?>
		<tr>
			<th><? echo "Bank".$SVI; ?></th>
			<td><? echo round($totalinterest_cc); ?></td>
			<td><? echo round($totalsaving_ccouttopl[$sv]); ?></td>
		</tr>
	<? } ?>
		</tbody>
</table>
	<? 
 } ?>
 <div style="margin-top:5px;"></div>
</div>
<?
if(count($totalsaving_ccouttopl)>0)
	{
	}
	else
	{
		echo "Sorry, we are not able to get a deal for you as per details filled by you.<br>
			Please visit us again in some time to find an offer for your self";
	}
//ingvysya end HERE #################################################################################################
} ?>
 <div style="clear:both;"></div>
  <!--cc outstanding ends here-->
  <!--pl bt starts here--->
  <input type="hidden" name="existinglapl" id="existinglapl" value="<? echo $existing_la_pl; ?>">
  <?
  ##################################################################################################################################
//clause for PL Bt
##################################################################################################################################
if(strlen($existing_bank_pl)>0 &&  strlen($existing_la_pl)>0 && $existing_la_pl>50000)
{
	$totalsaving_plbtintr="";
	?>
	<? require 'scripts/personal_loan_function_bt.php';
	$existing_bank_pl = $_POST["existing_bank_pl"];
	$existing_la_pl = $_POST["existing_la_pl"];
	$existing_roi_pl = $_POST["existing_roi_pl"];
	$existing_noofemi_pl = $_POST["existing_noofemi_pl"];
	$existing_tenure_pl = $_POST["existing_tenure_pl"]/12;
	$existing_prepay_pl = $_POST["existing_prepay_pl"];
		
		$pre_payment_charges = $existing_prepay_pl;		
		$totalMonths = $existing_tenure_pl *12;
		$tenure_left = round((($totalMonths - $existing_noofemi_pl)/12),1);
		$intr =  $existing_roi_pl / 1200;
		$month = $existing_tenure_pl * 12;
		$EMI = round($existing_la_pl * ($intr / (1 - (pow(1/(1+$intr), $month)))));
		$yearlytotalinterest_plbt= (($EMI* $totalMonths) - $existing_la_pl)/$existing_tenure_pl;
		 $emiCount = '';
		for($i=0;$i<=$existing_noofemi_pl;$i++)
		{	
			$interest = $existing_la_pl * $intr; 
			$interest = round($interest,2);
			$principal = $EMI - $interest;
			$principal = round($principal,2);
			$existing_la_pl = $existing_la_pl - $principal;
			$existing_la_pl = round($existing_la_pl,2);
			$emiCount = $i + 1;
			$loan_amount_today = round($existing_la_pl);
		}
			$PrePayment_Charges = round(($loan_amount_today * ($pre_payment_charges/100)));
			$totalAmount_Repaid = round(($loan_amount_today));
			$newDuration  = ($existing_tenure_pl * 12) - $existing_noofemi_pl;
			$periodLeftYears = round(($newDuration/12),2);
			$totalPaid = $EMI * $newDuration;
			$totaloutStanding = $totalPaid;
			$PrePaymentCharges = round(($loan_amount_today * ($pre_payment_charges/100)));
			$totalAmountRepaid = '';			
			$tenureleft = $month - $existing_noofemi_pl;

if($loan_amount_today>0)
	{
		$updateqry_pl="Update saveemicalc_tbl_pl Set Loan_Amount='".$loan_amount_today."' where saveemiidpl=".$last_inserted_id_pl;
		$updateqry_plresult1=ExecQuery($updateqry_pl);

list($realbankiDpl,$bankIDpl,$FinalBidderpl,$finalBidderNamepl)= getBiddersList_pl("saveemicalc_tbl_pl",$last_inserted_id_pl,$City);
	$Final_Bidpl = "";
			while (list ($key,$val) = @each($bankIDpl)) { 
				$Final_Bidpl[]= $val; 
			}
			$Finalbidder_Bidplarr = "";
			while (list ($key,$val) = @each($FinalBidderpl)) { 
				$Finalbidder_Bidplarr[]= $val; 
			}

		$FinalBidder_idplbt=implode(",",$Finalbidder_Bidplarr);
		/*echo "for PL <br><br>";
			print_r($Final_Bidpl);
			$FinalBidder_idplbt = implode(",",$FinalBidderpl);
			echo "<br><br>";*/
	}
//icici bank
list($icicibtloan_amount,$icicibtinterestrate,$icicibtgetemicalc,$icicibttenureleft,$icicibtproc_fee)= icicibank_bt ($loan_amount_today,$existing_prepay_pl,$existing_roi_pl,$tenureleft);
//hdfc bank
list($hdfcbtloan_amount,$hdfcbtinterestrate,$hdfcbtgetemicalc,$hdfcbttenureleft,$hdfcbtproc_fee)= hdfcbank_bt ($loan_amount_today,$hdfcbtinterestrate,$existing_roi_pl,$tenureleft);
//kotak bank
list($kotakbtloan_amount,$kotakbtinterestrate,$kotakbtgetemicalc,$kotakbttenureleft,$kotakbtproc_fee)= kotakbank_bt ($loan_amount_today,$hdfcbtinterestrate,$existing_roi_pl,$tenureleft,$existing_bank_pl,$net_salary/12,$kotakcategory);

//echo "kotak ".$loan_amount_today." - ".$hdfcbtinterestrate." - ".$existing_roi_pl." - ".$tenureleft." - ".$existing_bank_pl." - ".$plbt_income." - ".$kotakcategory."<br>";

if(($kotakbtgetemicalc>0 && (in_array("Kotak Bank", $Final_Bidpl)==1 || in_array("Kotak", $Final_Bidpl)==1)) || ($hdfcbtgetemicalc>0 && (in_array("HDFC Bank", $Final_Bidpl)==1 || in_array("HDFC", $Final_Bidpl)==1)) || ($icicibtgetemicalc>0 && (in_array("ICICI Bank", $Final_Bidpl)==1 || in_array("ICICI", $Final_Bidpl)==1)))
	{
	//echo "entered";
	//echo $kotakbtgetemicalc." - ".$hdfcbtgetemicalc." - ".$icicibtgetemicalc."<br><br>";
?>
<div class="table-wrapperbxapp">
<div class="secondstage-box" style="background:#FFF;">
<div class="headtext-bxapp">Your Existing Personal Loan can be transfered to another bank<br>Please compare your savings.</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-radius:7px; background:#FFF;">
  <tr>
    <td height="55" align="center" bgcolor="#FFFFFF" class="columntext-app"><table width="100%" border="0" cellspacing="1" cellpadding="0" style=" border-radius:7px; border:#999 solid thin;">
      <tr>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Banks </td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Loan Amount</td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Interest Rate</td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">EMI <br>(Per month)</td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Tenure <br>(in yrs)</td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Processing fee</td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Total saving</td>
        <td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">&nbsp;</td>
      </tr>	     
      <tr>
        <td height="7" colspan="8" bgcolor="#CCCCCC" class="td-bg"></td>
      </tr>      
<?
//ICICI BANk BT starts here #######################################################################
if($icicibtloan_amount>0 && $icicibtinterestrate>0 && ($existing_bank_pl!="ICICI") && (in_array("ICICI Bank", $Final_Bidpl)==1 || in_array("ICICI", $Final_Bidpl)==1))
	{
	list($icicibtpf,$extrapf) = split('[%]', $icicibtproc_fee);
	
					if($icicibtpf>0)
					{
						$processingFee = round(($loan_amount_today * ($icicibtpf/100)));						
					}
					else
					{
						$processingFee = 0;
					}
			
				$totalAmountRepaid = '';
				$totalAmountRepaid = $totalAmount_Repaid;
				$new_EMItoPay = round($icicibtgetemicalc);
				$new_Debt = round(($newDuration * $new_EMItoPay));	
				$newDebt = $new_Debt; 
				$newDebtla = ($new_Debt-$icicibtloan_amount)/ ($icicibttenureleft/12); 
				$totalsaving_plbtintr[]=round($newDebtla);
				//$yearlytotalinterest_plbt= (($new_Debt) - $icicibtloan_amount)/$existing_tenure_pl;
			//echo "<br><br>".$totaloutStanding." - ".$PrePaymentCharges." - ".$processingFee." - ".$newDebt."<br><br>";
				$savedAmticici = $totaloutStanding - $PrePaymentCharges - $processingFee - $newDebt;
				$seqcountplbt[]=1;
	?>
	<tr>
	<td colspan="8">
	<form action="save-emi-app-ccthanks.php" target="_Blank" name="cc_outstanding" method="POST">
	<input type="hidden" name="unique_code" id="unique_code" value="<? echo $last_inserted_id; ?>">
	<input type="hidden" name="cc_bidderid" id="cc_bidderid" value="<? echo $FinalBidder_idplbt; ?>">
	<input type="hidden" name="cc_bankid" id="cc_bankid" value="27">
	<input type="hidden" name="quote_type" id="quote_type" value="pl_balancetransfer">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
			<td width="11%" height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_bankname" id="cc_bankname" value="ICICI Bank"><? echo "ICICI Bank"; ?></td>
			<td width="13%" height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_loanamount" id="cc_loanamount" value="<? echo $icicibtloan_amount; ?>">Rs. <? echo $icicibtloan_amount; ?></td>
			<td width="11%" height="35" bgcolor="#D6D6D6" class="td-details-bg td-body-text"><input type="hidden" name="cc_interestrate" id="cc_interestrate" value="<? echo $icicibtinterestrate; ?>"><? echo $icicibtinterestrate; ?></td>
			<td width="12%" height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_emi" id="cc_emi" value="<? echo $icicibtgetemicalc; ?>">Rs. <? echo $icicibtgetemicalc; ?></td>
			<td width="11%" height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_term" id="cc_term" value="<? echo $icicibttenureleft; ?>"><? echo round($icicibttenureleft/12); ?></td>
			<td width="12%" height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="processing_fee" id="processing_fee" value="<? echo $icicibtproc_fee; ?>"><? echo $icicibtproc_fee; ?></td>
			<td width="17%" height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_totalsave" id="cc_totalsave" value="<? echo $savedAmticici; ?>">Rs. <?  if($savedAmticici>0) { echo $savedAmticici;} else { echo "No Saving";} ?></td>
            <td width="13%" height="35" align="center" bgcolor="#EFEFEF"><input name="image"  value="Submit_plicici" type="image" src="images/apply-savemy-app.png" width="47" height="21"  style="border:0px;" /></td>		
		</tr>
		</table>
		</form>
		</td></tr>
	<? 
	$showquotesquerypl="INSERT INTO `saveemicalc_tbl_showquotes` (`saveemiid`, `bank_name`, `interest_rate`, `loan_amount`, `new_emi`, `tenure`,`processing_fee` , `total_saving`, `product_details`, `dated`) VALUES ('".$last_inserted_id."', 'ICICI Bank', '".$icicibtinterestrate."', '".$icicibtloan_amount."', '".$icicibtgetemicalc."', '".$icicibttenureleft."', '".$icicibtproc_fee."', '".round($savedAmticici)."', 'PL BT', Now())";
	$showquotesqueryplresult1=ExecQuery($showquotesquerypl);
	}
	//echo $icicibtloan_amount." - ".$icicibtinterestrate." - ".$icicibtgetemicalc." - ".$icicibttenureleft." - ".$icicibtproc_fee."<br><br>";
//ICICI BANk BT endss here #######################################################################
//HDFC BANk BT starts here #######################################################################
if($hdfcbtloan_amount>0 && $hdfcbtinterestrate>0 && ($existing_bank_pl!="HDFC") && (in_array("HDFC Bank", $Final_Bidpl)==1 || in_array("HDFC", $Final_Bidpl)==1))
	{
				$processingFeehdfc = $hdfcbtproc_fee;						
				$totalAmountRepaid = '';
				$totalAmountRepaid = $totalAmount_Repaid;
				$new_EMItoPay = round($hdfcbtgetemicalc);
				$new_Debt = round(($newDuration * $new_EMItoPay));	
				$newDebt = $new_Debt; 
				$newDebtHDfc = ($new_Debt-$icicibtloan_amount)/ ($icicibttenureleft/12); 
				$totalsaving_plbtintr[]=round($newDebtHDfc);
				$savedAmthdfc = $totaloutStanding - ($PrePaymentCharges + $processingFeehdfc + $newDebt);
				$seqcountplbt[]=2;
	?>
<tr>
	<td colspan="8">
	<form action="save-emi-app-ccthanks.php" target="_Blank" name="cc_outstanding" method="POST">
	<input type="hidden" name="unique_code" id="unique_code" value="<? echo $last_inserted_id; ?>">
	<input type="hidden" name="cc_bidderid" id="cc_bidderid" value="<? echo $FinalBidder_idplbt; ?>">
	<input type="hidden" name="cc_bankid" id="cc_bankid" value="4">
	<input type="hidden" name="quote_type" id="quote_type" value="pl_balancetransfer">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
			<td width="12%" height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_bankname" id="cc_bankname" value="HDFC Bank"><? echo "HDFC Bank"; ?></td>
			<td width="14%" height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_loanamount" id="cc_loanamount" value="<? echo $hdfcbtloan_amount; ?>">Rs. <? echo $hdfcbtloan_amount; ?></td>
			<td width="13%" height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_interestrate" id="cc_interestrate" value="<? echo $hdfcbtinterestrate; ?>"><? echo $hdfcbtinterestrate; ?></td>
			<td width="15%" height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_emi" id="cc_emi" value="<? echo $hdfcbtgetemicalc; ?>">Rs. <? echo $hdfcbtgetemicalc; ?></td>
			<td width="12%" height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_term" id="cc_term" value="<? echo $hdfcbttenureleft; ?>"><? echo round($hdfcbttenureleft/12); ?></td>
			<td width="9%" height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="processing_fee" id="processing_fee" value="<? echo $hdfcbtproc_fee; ?>"><? echo $hdfcbtproc_fee; ?></td>
			<td width="12%" height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_totalsave" id="cc_totalsave" value="<? echo $savedAmthdfc; ?>">. <?  if($savedAmthdfc>0) { echo "Rs.".$savedAmthdfc;} else { echo "No Saving";} ?></td>
            <td width="13%" height="35" align="center" bgcolor="#EFEFEF"><input name="image"  value="Submit_plhdfc" type="image" src="images/apply-savemy-app.png" width="47" height="21"  style="border:0px;" /></td>
		</tr>
		</table>
		</form>
		</td></tr>
	<?
	$showquotesquerypl="INSERT INTO `saveemicalc_tbl_showquotes` (`saveemiid`, `bank_name`, `interest_rate`, `loan_amount`, `new_emi`, `tenure`, `processing_fee`, `total_saving`, `product_details`, `dated`) VALUES ('".$last_inserted_id."', 'HDFC Bank', '".$hdfcbtinterestrate."', '".$hdfcbtloan_amount."', '".$hdfcbtgetemicalc."', '".$hdfcbttenureleft."', '".$hdfcbtproc_fee."', '".round($savedAmthdfc)."', 'PL BT', Now())";
	$showquotesqueryplresult1=ExecQuery($showquotesquerypl);
	}
//HDFC BANk BT endss here #######################################################################
//echo $loan_amount_today." - ".$hdfcbtinterestrate." - ".$existing_roi_pl." - ".$tenureleft." - ".$existing_bank_pl." - ".$plbt_income." - ".$kotakcategory."";
if($kotakbtloan_amount>0 && $kotakbtinterestrate>0 && ($existing_bank_pl!="Kotak") && (in_array("Kotak Bank", $Final_Bidpl)==1 || in_array("Kotak", $Final_Bidpl)==1))
	{
	//echo "i m here";
	list($kotakbtpf,$extrapf) = split('[%]', $kotakbtproc_fee);
	
					if($kotakbtpf>0)
					{
						$processingFeekotak = round(($loan_amount_today * ($kotakbtpf/100)));						
					}
					else
					{
						$processingFeekotak = 0;
					}
			
				$totalAmountRepaid = '';
				$totalAmountRepaid = $totalAmount_Repaid;
				$new_EMItoPay = round($kotakbtgetemicalc);
				$new_Debt = round(($newDuration * $new_EMItoPay));	
				$newDebt = $new_Debt; 
				$newDebtkotak = ($new_Debt-$icicibtloan_amount)/ ($icicibttenureleft/12); 
				$savedAmtkotak = $totaloutStanding - $PrePaymentCharges - $processingFeekotak - $newDebt;
				$totalsaving_plbtintr[]=round($newDebtkotak);
					$seqcountplbt[]=3;
	?>
	<tr>
	<td colspan="8">
	<form action="save-emi-app-ccthanks.php" target="_Blank" name="cc_outstanding" method="POST">
	<input type="hidden" name="unique_code" id="unique_code" value="<? echo $last_inserted_id; ?>">
	<input type="hidden" name="cc_bidderid" id="cc_bidderid" value="<? echo $FinalBidder_idplbt; ?>">
	<input type="hidden" name="cc_bankid" id="cc_bankid" value="13">
	<input type="hidden" name="quote_type" id="quote_type" value="pl_balancetransfer">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
			<td width="11%" height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_bankname" id="cc_bankname" value="Kotak Bank"><? echo "Kotak Bank"; ?></td>
			<td width="12%" height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_loanamount" id="cc_loanamount" value="<? echo $kotakbtloan_amount; ?>">Rs. <? echo $kotakbtloan_amount; ?></td>
			<td width="11%" height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_interestrate" id="cc_interestrate" value="<? echo $kotakbtinterestrate; ?>"><? echo $kotakbtinterestrate; ?></td>
			<td height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_emi" id="cc_emi" value="<? echo $kotakbtgetemicalc; ?>">Rs. <? echo $kotakbtgetemicalc; ?></td>
			<td  width="11%" height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_term" id="cc_term" value="<? echo $kotakbttenureleft; ?>"><? echo round($kotakbttenureleft/12); ?></td>
			<td width="12%" height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="processing_fee" id="processing_fee" value="<? echo $kotakbtproc_fee; ?>"><? echo $kotakbtproc_fee; ?></td>
			<td width="17%" height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_totalsave" id="cc_totalsave" value="<? echo $savedAmtkotak; ?>"><?  if($savedAmtkotak>0) { echo "Rs.".$savedAmtkotak;} else { echo "No Saving";} ?></td>
            <td width="13%" height="35" align="center" bgcolor="#EFEFEF"><input name="image"  value="Submit_plkotak" type="image" src="images/apply-savemy-app.png" width="47" height="21"  style="border:0px;" /></td>
		</tr>
		</table>
		</form>
		</td></tr>
	<?
	$showquotesquerypl="INSERT INTO `saveemicalc_tbl_showquotes` (`saveemiid`, `bank_name`, `interest_rate`, `loan_amount`, `new_emi`, `tenure`, `processing_fee`, `total_saving`, `product_details`, `dated`) VALUES ('".$last_inserted_id."', 'Kotak Bank', '".$kotakbtinterestrate."', '".$kotakbtloan_amount."', '".$kotakbtgetemicalc."', '".$kotakbttenureleft."', '".$kotakbtproc_fee."', '".round($savedAmtkotak)."', 'PL BT', Now())";
	$showquotesqueryplresult1=ExecQuery($showquotesquerypl);
	}
?>
</table></td>
</tr></table>
  <div style="clear:both;"></div>
  <div class="form-box-shadow"><img src="images/form-shadow-app.jpg" width="450" height="30"></div>
</div>
<div id="containerplbt" class="right-panel-app-new" style="height:300px !important;"><? 
if(count($totalsaving_plbtintr)>0)
{
	?>
	<table id="datatable_plbt" style="display:none;">
	<thead>	<tr>			<th></th>			<th>PL Interest</th>
			<th>PL BT Interest</th>		</tr>	</thead>	<tbody>		
		<? for($plbt=0;$plbt<count($totalsaving_plbtintr);$plbt++)
	{	$plbti=$plbt+1
		?>
		<tr>
			<th><? echo "Bank".$plbti; ?></th>
			<td><? echo round($yearlytotalinterest_plbt); ?></td>
			<td><? echo round($totalsaving_plbtintr[$plbt]); ?></td>
		</tr>
	<? } ?>
		</tbody>
</table>
	<? 
 } ?>
<div style="margin-top:5px;"></div>
</div>
<? 
	}
	else
	{   
		echo "Sorry, we are not able to get a deal for you as per details filled by you.<br>
			Please visit us again in some time to find an offer for your self";
			?>
<div id="containerplbt" class="right-panel-app-new" style="height:300px !important; display:none;"> 
	<table id="datatable_plbt" style="display:none;">
	</table>

<div style="margin-top:5px;"></div>
</div>
	<? }
}
##################################################################################################################################
//clause for PL Bt END HERE
##################################################################################################################################
?><!----------pl bt ends here-->
<div style="clear:both;"></div>
<?
##################################################################################################################################
//clause for HL Bt
if(strlen($existing_bank_hl)>0 &&  strlen($existing_la_hl)>0 && $existing_la_hl>50000)
{ 
?>      <? 
	$getBankIDSql = "SELECT * FROM Bank_Master where Bank_Name='".$existing_bank_hl."'";
	$getBankIDQuery = ExecQuery($getBankIDSql);
	$getBankID = mysql_result($getBankIDQuery,0,'BankID');	
	$loan_amount = $existing_la_hl;
		$Interest_Rate = $existing_roi_hl;
		$Duration_of_Loan = $existing_tenure_hl;
		$emi_paid = $existing_noofemi_hl;
		$pre_payment_charges = $existing_prepay_hl;		
		$totalMonths = $Duration_of_Loan *12;
		$tenure_left = round((($totalMonths - $emi_paid)/12),1);
		$intr =  $Interest_Rate / 1200;
		$old_intr =  $Interest_Rate;
		$month = $Duration_of_Loan * 12;
		$EMI = $loan_amount * ($intr / (1 - (pow(1/(1+$intr), $month))));
		$yearlytotalinterest_hlbt= (($EMI* $totalMonths) - $existing_la_hl)/$existing_tenure_hl;
		$EMI_show = round($EMI);		
	    $emiCount = '';
		for($i=0;$i<=$emi_paid;$i++)
		{
			$interest = $loan_amount * $intr; 
			$interest = round($interest,2);
			$principal = $EMI - $interest;
			$principal = round($principal,2);
			$loan_amount = $loan_amount - $principal;
			$loan_amount = round($loan_amount,2);
			$emiCount = $i + 1;
			$loan_amount_today = round($loan_amount);
		}

		if($loan_amount_today>0)
	{
		$updateqry_hl="Update saveemicalc_tbl_hl Set Loan_Amount='".$loan_amount_today."' where saveemiidhl=".$last_inserted_id_hl;
		$updateqry_hlresult1=ExecQuery($updateqry_hl);
		$Finalbidder_Bidhl="";
		list($realbankiDhl,$bankIDhl,$FinalBidderhl,$finalBidderNamehl)= getBiddersList_hl("saveemicalc_tbl_hl",$last_inserted_id_hl,$City,$getBankID);
	$Final_Bidhl = "";
			while (list ($key,$val) = @each($bankIDhl)) { 
				$Final_Bidhl[]= $val; 
			}
			$strbankIDhl = implode(",",$realbankiDhl);
			$Final_Bidhlarr = "";
			while (list ($key,$val) = @each($FinalBidderhl)) { 
				$Final_Bidhlarr[]= $val; 
			}
		$Finalbidder_Bidhl=implode(",",$Final_Bidhlarr);
			/*echo "for Hl <br><br>";
			print_r($Final_Bidhl);
			echo "<br><br>";*/

	}
		$getRatesSql = "select * from home_loan_bal_trans where (('".$loan_amount_today."' between min_amount and max_amount) and ('".$tenure_left."' between min_tenure and max_tenure) and 	bank_id in (".$strbankIDhl.") and status=1 and bank not like '%".$existing_bank_hl."%')";
		//echo $getRatesSql."<br>";
		$getRatesQuery = ExecQuery($getRatesSql);
		$getRates_NR = @mysql_num_rows($getRatesQuery);
			$PrePayment_Charges = round(($loan_amount_today * ($pre_payment_charges/100)));
			$totalAmount_Repaid = round(($loan_amount_today));
			$periodLeft = $totalMonths - $emiCount ; 
			$newDuration  = ($Duration_of_Loan * 12) - $emi_paid;
			$periodLeftYears = round(($newDuration/12),2);
			$totalPaid = $EMI_show * $newDuration;
			$totaloutStanding = $totalPaid;
			$processingFee = round(($totalAmount_Repaid * ($pre_payment_charges/100)));
			$totalAmountRepaid = '';	
			if($getRates_NR>0 && count($Final_Bidhl)>0)
			{ 
				?>
				<div class="table-wrapperbxapp">
<div class="secondstage-box" style="background:#FFF;">
<div class="headtext-bxapp">Your Existing Home Loan can be transfered to another bank<br> Please compare your savings.</div>
	 <table width="100%" border="0" cellspacing="0" cellpadding="0" style=" border-radius:7px; background:#FFF;">
		<tr>
		<td height="55" align="center" bgcolor="#FFFFFF" class="columntext-app"><table width="100%" border="0" cellspacing="1" cellpadding="0" style=" border-radius:7px; border:#999 solid thin;">
		<tr>
		<td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Banks </td>
		<td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">New Interest Rate</td>
		<td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Current Loan Amoun</td>
		<td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">EMI <br>(Per month)</td>
		<td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Tenure <br>(in yrs)</td>
		<td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp">Total saving</td>
		<td width="12%" height="55" align="center" bgcolor="#f4f4f4" class="textdapp"></td>
		</tr>	   
	<tr>
	<td height="7" colspan="8" bgcolor="#CCCCCC" class="td-bg"></td>
	</tr>      
				<? 
			}
				if($getRates_NR>0 && count($Final_Bidhl)>0)
				{
			for($i=0;$i<$getRates_NR;$i++)
			{
				$intr = '';
				$bal_id = mysql_result($getRatesQuery,$i,'bal_id');
				$bank = mysql_result($getRatesQuery,$i,'bank');
				$bank_id = mysql_result($getRatesQuery,$i,'bank_id');
				$roi = mysql_result($getRatesQuery,$i,'roi');
				$processing_fee = mysql_result($getRatesQuery,$i,'processing_fee');
				$fee_amount = mysql_result($getRatesQuery,$i,'fee_amount');
				$fee_percent = mysql_result($getRatesQuery,$i,'fee_percent');
				//$bank_image = mysql_result($getRatesQuery,$i,'bank_image');
				$intr =  $roi / 1200;												
				if($fee_amount>0)
				{
					if($fee_percent>0)
					{
						$PrePaymentCharges = round(($totalAmountRepaid * ($fee_percent/100)));
						if($PrePaymentCharges<$fee_amount)
						{
							$PrePaymentCharges = $fee_amount;
						}
					}
					else
					{
						$PrePaymentCharges = $fee_amount;
					}
				}
				else
				{
					if($fee_percent>0)
					{
						$PrePaymentCharges = round(($totalAmountRepaid * ($fee_percent/100)));						
					}
					else
					{
						$PrePaymentCharges = $fee_amount;
					}
				}
				$totalAmountRepaid = '';
				$totalAmountRepaid = $totalAmount_Repaid;
				$new_EMItoPay = round(($totalAmountRepaid * ($intr / (1 - (pow(1/(1+$intr), $newDuration))))));
				$new_Debt = round(($newDuration * $new_EMItoPay));	
				$newDebt = $new_Debt; 
				$savedAmt = $totaloutStanding - $PrePaymentCharges - $processingFee - $newDebt;
				$newDebtbankwise = ($new_Debt-$totalAmountRepaid)/ ($newDuration/12); 
				$totalsaving_hlbtintr[]=$newDebtbankwise;
				if($newDebtbankwise>0)
				{ ?>
				<tr>
	<td colspan="7">
	<form action="save-emi-app-ccthanks.php" target="_Blank" name="cc_outstanding" method="POST">
	<input type="hidden" name="unique_code" id="unique_code" value="<? echo $last_inserted_id; ?>">
	<input type="hidden" name="cc_bidderid" id="cc_bidderid" value="<? echo $Finalbidder_Bidhl; ?>">
	<input type="hidden" name="cc_bankid" id="cc_bankid" value="<? echo $bank_id; ?>">
	<input type="hidden" name="quote_type" id="quote_type" value="hl_balancetransfer">
	<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
                <td width="13%" height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_bankname" id="cc_bankname" value="<?php echo $bank ;  ?>"><?php echo $bank;  ?></td>
                <td width="15%" height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_interestrate" id="cc_interestrate" value="<? echo $roi; ?>"><?php echo $roi; ?>%</td>
                <td width="13%" height="35" bgcolor="#D6D6D6" class="td-details-bg"><input type="hidden" name="cc_loanamount" id="cc_loanamount" value="<? echo $totalAmountRepaid; ?>">Rs.<?php echo $totalAmountRepaid; ?>&nbsp;&nbsp;&nbsp;</td>
                 <td width="17%" height="35" bgcolor="#EFEFEF" class="td-body-text"><input type="hidden" name="cc_emi" id="cc_emi" value="<? echo $new_EMItoPay; ?>">Rs.<?php echo round($new_EMItoPay,2);   ?>&nbsp;&nbsp;&nbsp;</td>
                <td width="14%" height="35" bgcolor="#CCCCCC" class="td-details-bg"><input type="hidden" name="cc_term" id="cc_term" value="<? echo $newDuration; ?>"><?php echo "".round($newDuration/12);  ?></td>
                  <td width="13%" height="35" bgcolor="#EFEFEF" class="td-body-text" ><input type="hidden" name="cc_totalsave" id="cc_totalsave" value="<? echo $savedAmt; ?>">
                  <?php if($savedAmt>0)
				  {
				  	echo "Rs.".round($savedAmt);				  
				  }
                  else
				  {
				  ?>
				  	<span style="color:#CC0033;">
                    <?php echo "No Saving"; ?>
                    </span>
				  <?php
                  }
                  ?>
				  </td>
              <td width="15%" height="35" align="center" bgcolor="#EFEFEF"><input name="image"  value="Submit_<? echo $i; ?>" type="image" src="images/apply-savemy-app.png" width="47" height="21"  style="border:0px;" /></td>
			</tr>
		</table>
		</form>
		</td></tr>
                <?php
				$showquotesqueryhl="INSERT INTO `saveemicalc_tbl_showquotes` (`saveemiid`, `bank_name`, `interest_rate`, `loan_amount`, `new_emi`, `tenure`, `total_saving`, `product_details`, `dated`) VALUES ('".$last_inserted_id."', '".$bank."', '".$roi."', '".$totalAmountRepaid."', '".$new_EMItoPay."', '".$newDuration."', '".round($savedAmt)."', 'HL BT', Now())";
				$showquotesqueryhlresult1=ExecQuery($showquotesqueryhl);
				}
			} 
				  ?>
</table></td>
                </tr></table>               
                <div style="clear:both;"></div>
  <div class="form-box-shadow"><img src="images/form-shadow-app.jpg" width="450" height="30"></div>
</div>
				  <?
}
				?>				
<div class="right-panel-app-new" id="containerhlbt" style="height:300px !important;"><? if(count($totalsaving_hlbtintr)>0 && $bal_id>0)
{
	?>
	<table id="datatable_hlbt" style="display:none;">
	<thead>	<tr>			<th></th>			<th>HL Interest</th>
			<th>HL BT Interest</th>		</tr>	</thead>	<tbody>		
		<? for($hlsv=0;$hlsv<count($totalsaving_hlbtintr);$hlsv++)
	{	$HLSVI=$hlsv+1
		?>
		<tr>
			<th><? echo "Bank".$HLSVI; ?></th>
			<td><? echo round($yearlytotalinterest_hlbt); ?></td>
			<td><? echo round($totalsaving_hlbtintr[$hlsv]); ?></td>
		</tr>
	<? } ?>
		</tbody>
</table>
	<? 
 } ?>
<div style="margin-top:5px;"></div>
</div>				<?
if(count($totalsaving_hlbtintr)>0)
	{
	}
	else
	{
		echo "Sorry, we are not able to get a deal for you as per details filled by you.<br>
			Please visit us again in some time to find an offer for your self";
	}
}//clause for HL Bt end here
############################################################################################################################
?>
</div>
</div>
</div>
<div style="clear:both; height:165px;"></div>
</div>
<div style="clear: both; height:10px;"></div>
<div style="background-color:#203F5F;"><?php include "footer_index.php";?> </div>
</body>
</html>