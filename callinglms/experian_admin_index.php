<?php
require_once("includes/application-top-inner.php");
define("NoOFLMS", 2);
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 25;
$start = ($page - 1) * $limit;
//print_r($_SESSION);
//echo "<br>".$_SESSION["BidderID"];
$BidderIDstatic="";
	if(isset($_REQUEST['BidderIDstatic']) && strlen($_REQUEST['BidderIDstatic'])>0 )
	{
		 $BidderIDstatic=$_REQUEST['BidderIDstatic'];
	}
	
	if(isset($BidderIDstatic) && strlen($_REQUEST['BidderIDstatic'])>0)
	{
$_SESSION["BidderID"] = $BidderIDstatic;
	}

$dwlndtomorrow  = mktime(0, 0, 0, date("m")  , date("d")-60, date("Y"));
	 $daydwlnd=date('Y-m-d',$dwlndtomorrow);

$salaryclause="";
if(isset($_REQUEST['salaryrange']))
{
		$salaryclause=$_REQUEST['salaryrange'];

}
   
  $val = "Req_Loan_Personal";
  
	$FeedbackClause="";
	//$OrderBy=" order by Req_Loan_Personal.Dated desc";
	$mob_num="";
	if(isset($_REQUEST['mob_num']))
	{
		$mob_num = $_REQUEST['mob_num'];
	}
	$search="";
	if(isset($_GET['search']))
	{
		$search=$_GET['search'];
	}
	
	$min_date="";
	if(isset($_REQUEST['min_date']))
	{
		$min_date=$_REQUEST['min_date'];
	}
	
	$cc_type="";
	if(isset($_REQUEST['cc_type']))
	{
		$cc_type=$_REQUEST['cc_type'];
	}

	$max_date="";
	if(isset($_REQUEST['max_date']))
	{
		$max_date=$_REQUEST['max_date'];
	}

	$varCmbFeedback="";
	if(isset($_REQUEST['cmbfeedback']))
	{
		$varCmbFeedback=$_REQUEST['cmbfeedback'];
	}

	$RequestID="";
	if(isset($_REQUEST['RequestID']))
	{
		$RequestID=$_REQUEST['RequestID'];
	}
	
	$cibil_score="";
	if(isset($_REQUEST['cibil_score']))
	{
		$cibil_score=$_REQUEST['cibil_score'];
	}
	$source="";
	if(isset($_REQUEST['source']))
	{
		$source=$_REQUEST['source'];
	}	
?>
<html>
		<head>
		<meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
		<title>Login</title>
		<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
		<link href="../includes/style1.css" rel="stylesheet" type="text/css">
		<link href="../style.css" rel="stylesheet" type="text/css" />
		<script language="javascript" type="text/javascript" src="../scripts/datetime.js"></script>
		<style>
/* Pagination*/

div.pagination {
	padding: 3px;
	margin: 3px;
}
div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #000099;
	font-weight: bold;
	background-color: #2b62b5;
	color: #FFF;
}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #CCC;
	color: #CCC;
}
</style>
		<!--DatePicker Start-->
		<link rel="stylesheet" type="text/css" href="css-datepicker/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css-datepicker/datepicker.css">
		<script src="js-datepicker/jquery-1.5.1.js"></script>
		<script src="js-datepicker/jquery.ui.core.js"></script>
		<script src="js-datepicker/jquery.ui.datepicker.js"></script>
		<script> 
			$(function() {
				var dates = $( "#min_date, #max_date" ).datepicker({
					defaultDate: "-1w",
					changeMonth: true,
					changeYear: true,
					numberOfMonths: 1,
					onSelect: function( selectedDate ) {
						var option = this.id == "min_date" ? "minDate" : "maxDate",
							instance = $( this ).data( "datepicker" ),
							date = $.datepicker.parseDate(
								instance.settings.dateFormat ||
								$.datepicker._defaults.dateFormat,
								selectedDate, instance.settings );
						dates.not( this ).datepicker( "option", option, date );
					}
				});
			});

		function MM_jumpMenu(targ,selObj,restore){ //v3.0
 eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}
		</script>
		<!--DatePicker End-->
      
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
	
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="experian_admin_index.php" method="get" onSubmit="return chkform();">
                <input type="hidden" name="BidderIDstatic" id="BidderIDstatic" value="<? echo $_SESSION["BidderID"];?>">
                <input type="hidden" name="search" id="search" value="y">
                <tr>
                  <td colspan="4" class="head1">Search</td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="12%"><strong>Date:</strong></td>
                  <td width="29%">From
                    <input name="min_date" type="text" id="min_date" size="15" <? if($min_date=="" || $min_date<$daydwlnd) { ?>value="<? echo $daydwlnd; ?>"<? } else { ?>value="<? echo $min_date; ?>" <? } ?> ></td>
                  <td width="13%" style="text-align:right;">To</td>
                  <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                </tr>
                <tr>
                  <td width="12%"><strong>Source:</strong></td>
                  <td width="29%"><select name="source" id="source">
                      <option value="All" <? if($source== "All") { echo "selected"; } ?>>All</option>
				<?php			
				$qrySource="SELECT * FROM Bidders WHERE (Global_Access_ID=7475 AND Status=1 ) ";	
				$resSourceCount = $objAdmin->fun_get_num_rows($qrySource);
				
				$resultSource = $obj->fun_db_query($qrySource);
				$selected='';
				while($rowSource = $obj->fun_db_fetch_rs_object($resultSource))
				{
					$selected='';
					$Process_Name = $rowSource->Process_Name;
					if($source== $Process_Name) { $selected= "selected"; }
					echo '<option value="'.$Process_Name.'" '.$selected.'>'.ucfirst(strtolower($Process_Name)).'</option>';
				}
				?>
	</select></td>
                   <td width="29%" align="center"  valign="middle" class="bidderclass"><strong>Cibil Score</strong></td>
	  <td width="58%"  valign="middle" class="bidderclass"><select name="cibil_score" id="cibil_score">
                      <option value="All" <? if($cibil_score== "All") { echo "selected"; } ?>>All</option>
                      <option value="1" <? if($cibil_score== "1") { echo "selected"; } ?>>With Score</option>
                      </select>
</td>
                </tr>
                 <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="left"><input name="Submit" type="submit" class="bluebutton" value="Search" border="0"></td>
                </tr>
              </form>
            </table>
            <p>&nbsp;</p>
            <?	
			$search_date="";
	$varmin_date=$min_date;
	$varmax_date=$max_date;

	if($search=="y")
	{		
		$min_dateonly=$min_date;
		$max_dateonly=$max_date;

		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";
		$scoreClause='';
		if($cibil_score==1)
		{
			$scoreClause=" AND cibil_score>0 ";
		} 
		
		if($source=="All")
		{
			$qrySource="SELECT * FROM Bidders WHERE (Global_Access_ID=7475 AND Status=1 ) ";	
			$resSourceCount = $objAdmin->fun_get_num_rows($qrySource);
			
			$resultSource = $obj->fun_db_query($qrySource);
			$Process_NameArr='';
			while($rowSource = $obj->fun_db_fetch_rs_object($resultSource))
			{
				$Process_NameArr[] = $rowSource->Process_Name;
			}
			$Process_NameStr = implode("', '",$Process_NameArr);
			
			$sourceClause=" AND source in ('".$Process_NameStr."') ";
		}
		else
		{
			$sourceClause=" AND source='".$source."' ";
		}
		
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
                         <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
		
		if($_SESSION['BidderID']!="")
		{
			$qry="SELECT * FROM experian_initial_details WHERE ( dated Between '".($min_date)."' and '".($max_date)."') ".$sourceClause." ".$scoreClause." ";	
		
		}		
		

//echo $qry;
$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
	$pagelinks = paginate($limit, $resCount);
}
$qry.= " order by dated  DESC LIMIT $start,$limit ";


$result = $obj->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? echo $start+$limit; ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
                <td class="head1">Name</td>
                <td class="head1">Mobile</td>
                <td class="head1">DOB</td>
                <td class="head1">Email</td>
                <td class="head1">Address</td>
                <td class="head1">Score</td>  
                <td class="head1">Experian HTML</td>              
              </tr>
              <?			
		if($resCount>0)
			{
				$color = 1;		
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
		
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
              <!--///////////////////////-->
		  <tr  bgcolor="<?php echo $colorvar;?>">			 
			<td class="bodyarial11"><?php
			 $firstName= $row->firstName;
			 $middleName= $row->middleName;
			 $surName= $row->surName;
				echo $firstName;
				if(strlen($middleName)>0)
				{
					echo " ".$middleName;			
				}
				if(strlen($surName)>0)
				{
					echo " ".$surName;
				}
			
			?></td>
		
			<td class="bodyarial11"><? echo $row->mobileNo; ?></td>
			<td class="bodyarial11"><? echo $row->dob; ?></td>
			<td class="bodyarial11"><? echo $row->email; ?></td> 
			<td class="bodyarial11"><? 
			if(strlen($row->flatno)>0) { echo $row->flatno; }
			if(strlen($row->buildingName)>0) { echo ", ".$row->buildingName; }
			if(strlen($row->road)>0) { echo ", ".$row->road; }
			if(strlen($row->city)>0) { echo ", ".$row->city; }
			//if(strlen($row->state)>0) { echo ", ".$row->state; }
			if($row->pincode>0) { echo ", ".$row->pincode; }
		 ?></td> 
			<td class="bodyarial11"><? echo $row->cibil_score; ?></td> 
				<td class="bodyarial11">
			<? 
			if($row->cibil_score>0)
			{
				$url ='';
				$filename ='';
				$getDocQry = "SELECT * FROM `experian_xml_files`  where requestid = '".$row->id."' AND file_type='html'";
				$resDocCount = $objAdmin->fun_get_num_rows($getDocQry);
				$resultDoc = $obj->fun_db_query($getDocQry );
				$rowDoc = $obj->fun_db_fetch_rs_object($resultDoc);
				$filename = $rowDoc->filename;
				$cibilurl = "/experianxml/".$filename.".html";
				?>
				<a href="<?php echo $cibilurl; ?>" target="_blank">View</a>
				<?php
			}

			?></td> 

		
                   </tr>
                <?
		$color++;
		}		
		}
	?>
           </table>
            <br>
            <table  border="0" cellpadding="5" cellspacing="1" align="center">
              <tr>
                <td style="color:#FFF;" align="center" bgcolor="#FFFFFF"><?php echo $pagelinks;?></td>
              </tr>
            </table>
            <?
 }
 ?>            </div></td>
      </tr>

            </table>
        </div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script> 
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-1312775-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
