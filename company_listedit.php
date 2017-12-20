<?php
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
	session_start();
//$IP_Remote = getenv("REMOTE_ADDR");
///if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_REAL_IP']; }
//else { $IP=$IP_Remote;	}
$IP=ExactCustomerIP();

if(($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="122.176.54.210" || $IP=="1.22.91.57"))
{
	
	$user = $_REQUEST["user"];
 $cmpid = $_REQUEST["cmpid"];
 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
		$plcompanyid = $cmpid;
		$company_name = FixString($_POST["company_name"]);
		$hdfc_bank = FixString($_POST["hdfc_bank"]);
		$fullerton = FixString($_POST["fullerton"]);
		$citibank = FixString($_POST["citibank"]);
		//$barclays = FixString($_POST["barclays"]);
		$standard_chartered = FixString($_POST["standard_chartered"]);
		//$hdbfs = FixString($_POST["hdbfs"]);
		$tatacapital = FixString($_POST["tatacapital"]);
		$bajajfinserv = FixString($_POST["bajajfinserv"]);
		$icici_bank = FixString($_POST["icici_bank"]);
		$kotak = FixString($_POST["kotak"]);
		$Indusind = FixString($_POST["Indusind"]);
		$capitalfirst = FixString($_POST["capitalfirst"]);
		$adityabirla = FixString($_POST["adityabirla"]);
		$rblbank = FixString($_POST["rblbank"]);
		$iifl = FixString($_POST["iifl"]);

	 $dataUpdate = array('company_name'=>$company_name, 'hdfc_bank'=>$hdfc_bank, 'fullerton'=>$fullerton, 'citibank'=>$citibank,  'standard_chartered'=>$standard_chartered, 'tatacapital'=>$tatacapital, 'bajajfinserv'=>$bajajfinserv, 'icici_bank'=>$icici_bank, 'kotak'=>$kotak, 'Indusind'=>$Indusind, "capitalfirst"=>$capitalfirst, "adityabirla"=>$adityabirla, "rblbank"=>$rblbank, "iifl"=>$iifl);
	 $wherecondition = "(plcompanyid=".$plcompanyid.")";
 	 Mainupdatefunc ('pl_company_list', $dataUpdate, $wherecondition);

	 //print_R($dataUpdate);

	$Dated = ExactServerdate();
		//$data = array('company_name'=>$company_name, 'hdfc_bank'=>$hdfc_bank, 'fullerton'=>$fullerton, 'citibank'=>$citibank, 'barclays'=>$barclays, 'standard_chartered'=>$standard_chartered, 'hdbfs'=>$hdbfs, 'tatacapital'=>$tatacapital, 'bajajfinserv'=>$bajajfinserv, 'icici_bank'=>$icici_bank, 'kotak'=>$kotak, 'Indusind'=>$Indusind , "user"=>$user ,  "dated"=>$Dated );
		//$table = 'plcompany_log';
		//$insert = Maininsertfunc ($table, $data);
 }
$getcompany='select * from pl_company_list where (plcompanyid='.$cmpid.')';
list($num_rows,$row)=Mainselectfunc($getcompany,$array = array());

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<table cellpadding="0" cellspacing="0" align="center">
<tr><td>&nbsp;</td></tr>
<tr>
<td>
<form name="cmpedit" action="<? echo $_SERVER['PHP_SELF'] ?>" method="post">
<input type="hidden" name="cmpid" id="cmpid" value="<? echo $row["plcompanyid"]; ?>" />
<input type="hidden" name="user" id="user" value="<? echo $_REQUEST["user"]; ?>" />
	<table width="100%" cellpadding="5" cellspacing="0" border="1">
    	<tr>
            <td>S no</td>
           	<td>Company Name</td>
            <td align="center">HDFC Bank</td>
            <td align="center">Fullerton</td>
            <td align="center">Citibank</td>
            
            <td align="center">Standard Chartered</td>
           
            <td align="center">TATA Capital</td>
            <td align="center">Bajaj Finserv</td>
            <td align="center">ICICI Bank</td>
            <td align="center">Kotak Bank</td>
          <td align="center">IndusInd Bank</td>
            <td align="center">Capital First</td>
		  <td align="center">Aditya Birla</td> 
		  <td align="center">RBl Bank</td> 
		  <td align="center">IIFL</td> 
        </tr>
        <tr>		
       		 <td><? echo $row["plcompanyid"]; ?></td>
          	<td><input type="text" value="<? echo $row["company_name"]; ?>" name="company_name" id="company_name"  /></td>
            <td align="center">
			  <select  name="hdfc_bank"  id="hdfc_bank">
			   <option value="" <? if($row["hdfc_bank"]=="") echo "Selected"; ?>></option>
                <option value="CAT A" <? if( $row["hdfc_bank"]=="CAT A") echo "Selected"; ?>>CAT A</option>
                <option value="CAT B"  <? if( $row["hdfc_bank"]=="CAT B") echo "Selected"; ?>>CAT B</option>
                <option value="CAT C"  <? if( $row["hdfc_bank"]=="CAT C" || $row["hdfc_bank"]=="Cat C") echo "Selected"; ?>>CAT C</option>
                <option value="CAT D"  <? if( $row["hdfc_bank"]=="CAT D") echo "Selected"; ?>>CAT D</option>
                <option value="CAT GB"  <? if( $row["hdfc_bank"]=="CAT GB") echo "Selected"; ?>>CAT GB</option>
               <option value="CSA A"  <? if( $row["hdfc_bank"]=="CSA A") echo "Selected"; ?>>CSA A</option>
                <option value="CSA B"  <? if( $row["hdfc_bank"]=="CSA B") echo "Selected"; ?>>CSA B</option>
                <option value="CSA C"  <? if( $row["hdfc_bank"]=="CSA C") echo "Selected"; ?>>CSA C</option>
                <option value="CSA D"  <? if( $row["hdfc_bank"]=="CSA D") echo "Selected"; ?>>CSA D</option>
                <option value="Govt"  <? if( $row["hdfc_bank"]=="Govt" || $row["hdfc_bank"]=="Govt") echo "Selected"; ?>>Govt</option>
				 <option value="Super A"  <? if( $row["hdfc_bank"]=="Super A" || $row["hdfc_bank"]=="SUPER A") echo "Selected"; ?>>Super A</option>
				  <!--<option value="Super CAT A"  <? if( $row["hdfc_bank"]=="Super CAT A") echo "Selected"; ?>>Super CAT A</option>-->
               </select>           
            </td>
            <td align="center">
			 <select name="fullerton"  id="fullerton">
			 <option value="" <? if($row["fullerton"]=="") echo "Selected"; ?>></option>
			 <option value="CAT A" <? if( $row["fullerton"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			  <option value="CAT B"  <? if( $row["fullerton"]=="CAT B") echo "Selected"; ?>>CAT B</option>
			   <option value="CAT C"  <? if( $row["fullerton"]=="CAT C") echo "Selected"; ?>>CAT C</option>
                <option value="CAT D"  <? if( $row["fullerton"]=="CAT D") echo "Selected"; ?>>CAT D</option>
				<option value="CSA A"  <? if( $row["fullerton"]=="CSA A") echo "Selected"; ?>>CSA A</option>
				<option value="Super A"  <? if( $row["fullerton"]=="Super A" || $row["fullerton"]=="SUPER A") echo "Selected"; ?>>Super A</option>
				</select>  
				</td>
            <td align="center">
			<select name="citibank"  id="citibank">
			<option value="" <? if($row["citibank"]=="") echo "Selected"; ?>></option>
			 <option value="CAT A" <? if( $row["citibank"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			 <option value="CAT B"  <? if( $row["citibank"]=="CAT B") echo "Selected"; ?>>CAT B</option>
			 </select>  
			</td>
            <td align="center">
			<select name="standard_chartered"  id="standard_chartered">
			 <option value="" <? if($row["standard_chartered"]=="") echo "Selected"; ?>></option>
			 <option value="CAT A" <? if( $row["standard_chartered"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			 <option value="CAT A+" <? if( $row["standard_chartered"]=="CAT A+") echo "Selected"; ?>>CAT A+</option>
			 <option value="CAT B"  <? if( $row["standard_chartered"]=="CAT B") echo "Selected"; ?>>CAT B</option>
			 <option value="CAT C"  <? if( $row["standard_chartered"]=="CAT C") echo "Selected"; ?>>CAT C</option>
			 <option value="CAT D"  <? if( $row["standard_chartered"]=="CAT D") echo "Selected"; ?>>CAT D</option>
			 <option value="CEA"  <? if( $row["standard_chartered"]=="CEA") echo "Selected"; ?>>CEA</option>
			 </select>  
			</td>
           <td align="center">
			<select name="tatacapital"  id="tatacapital">
			<option value="" <? if($row["tatacapital"]=="") echo "Selected"; ?>></option>
			 <option value="SUPER CAT A"  <? if( $row["tatacapital"]=="SUPER CAT A") echo "Selected"; ?>>Super Cat A</option>
			 <option value="CAT A" <? if( $row["tatacapital"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			 <option value="CAT B"  <? if( $row["tatacapital"]=="CAT B") echo "Selected"; ?>>CAT B</option>
			 <option value="CAT C"  <? if( $row["tatacapital"]=="CAT C") echo "Selected"; ?>>CAT C</option>
			 <option value="GOVT"  <? if( $row["tatacapital"]=="GOVT") echo "Selected"; ?>>GOVT</option>
			 <option value="DEFENCE"  <? if( $row["tatacapital"]=="DEFENCE") echo "Selected"; ?>>DEFENCE</option>
			 <option value="TATA Group"  <? if( $row["tatacapital"]=="TATA Group") echo "Selected"; ?>>TATA Group</option>	
			 </select>  
			</td>
            <td align="center">
			<select name="bajajfinserv"  id="bajajfinserv">
			 <option value="" <? if($row["bajajfinserv"]=="") echo "Selected"; ?>></option>
			 <option value="CAT A" <? if( $row["bajajfinserv"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			 <option value="CAT B"  <? if( $row["bajajfinserv"]=="CAT B") echo "Selected"; ?>>CAT B</option>
			 <option value="CAT C"  <? if( $row["bajajfinserv"]=="CAT C") echo "Selected"; ?>>CAT C</option>
			 </select> 
			</td>
            <td align="center">
			<select name="icici_bank"  id="icici_bank">
			 <option value="" <? if($row["icici_bank"]=="") echo "Selected"; ?>></option>
			  <option value="Elite" <? if( $row["icici_bank"]=="Elite") echo "Selected"; ?>>Elite</option>
			 <option value="Preferred"  <? if($row["icici_bank"]=="Preferred") echo "Selected"; ?>>Preferred</option>
			 <option value="SuperPrime"  <? if( $row["icici_bank"]=="SuperPrime") echo "Selected"; ?>>SuperPrime</option>
			 </select>
			</td>
            <td align="center">
			<select name="kotak"  id="kotak">
			 <option value="" <? if($row["kotak"]=="") echo "Selected"; ?>></option>
			<option value="CAT A" <? if( $row["kotak"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			<option value="CAT B"  <? if( $row["kotak"]=="CAT B") echo "Selected"; ?>>CAT B</option>
			<option value="CAT C"  <? if( $row["kotak"]=="CAT C") echo "Selected"; ?>>CAT C</option>
			<option value="CAT D"  <? if( $row["kotak"]=="CAT D") echo "Selected"; ?>>CAT D</option>
			</select> 
			</td>
            <td align="center">
			<select name="Indusind"  id="Indusind">
			 <option value="" <? if($row["Indusind"]=="") echo "Selected"; ?>></option>
			<option value="A+" <? if( $row["Indusind"]=="A+") echo "Selected"; ?>>A+</option>
			<option value="C1000" <? if( $row["Indusind"]=="C1000") echo "Selected"; ?>>C1000</option>
			<option value="CAT A" <? if( $row["Indusind"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			<option value="CAT A+" <? if( $row["Indusind"]=="CAT A+") echo "Selected"; ?>>CAT A+</option>
			<option value="CAT B"  <? if($row["Indusind"]=="CAT B" || $row["Indusind"]=="Cat B") echo "Selected"; ?>>CAT B</option>
			<option value="CAT C"  <? if( $row["Indusind"]=="CAT C") echo "Selected"; ?>>CAT C</option>
			<option value="CAT G"  <? if( $row["Indusind"]=="CAT G") echo "Selected"; ?>>CAT G</option>
			</select> 
			</td>
			<td align="center">
			<select name="capitalfirst"  id="capitalfirst">
			 <option value="" <? if($row["capitalfirst"]=="") echo "Selected"; ?>></option>
			<option value="CAT A" <? if( $row["capitalfirst"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			<option value="CAT B"  <? if( $row["capitalfirst"]=="CAT B") echo "Selected"; ?>>CAT B</option>
			<option value="CAT C"  <? if( $row["capitalfirst"]=="CAT C") echo "Selected"; ?>>CAT C</option>
			<option value="CAT SA"  <? if( $row["capitalfirst"]=="CAT SA") echo "Selected"; ?>>CAT SA</option>
			</select> 
			</td>
			 <td align="center">
			<select name="adityabirla"  id="adityabirla">
			 <option value="" <? if($row["adityabirla"]=="") echo "Selected"; ?>></option>
			<option value="CAT A" <? if( $row["adityabirla"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			<option value="CAT B"  <? if($row["adityabirla"]=="CAT B") echo "Selected"; ?>>CAT B</option>
			<option value="CAT C"  <? if( $row["adityabirla"]=="CAT C") echo "Selected"; ?>>CAT C</option>
			</select> 
			</td>
			 <td align="center">
			<select name="rblbank"  id="rblbank">
			 <option value="" <? if($row["rblbank"]=="") echo "Selected"; ?>></option>
			 <option value="CAT A" <? if( $row["rblbank"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			 <option value="CAT B" <? if( $row["rblbank"]=="CAT B") echo "Selected"; ?>>CAT B</option>
			 <option value="CAT C" <? if( $row["rblbank"]=="CAT C") echo "Selected"; ?>>CAT C</option>	
			 <option value="CAT D" <? if( $row["rblbank"]=="CAT D") echo "Selected"; ?>>CAT D</option>
			 </select> 
			</td>
			<td align="center">
			<select name="iifl"  id="iifl">
			 <option value="" <? if($row["iifl"]=="") echo "Selected"; ?>></option>
			 <option value="CAT A" <? if( $row["iifl"]=="CAT A") echo "Selected"; ?>>CAT A</option>
			 <option value="CAT B" <? if( $row["iifl"]=="CAT B") echo "Selected"; ?>>CAT B</option>
			 <option value="SUPER CAT A" <? if( $row["iifl"]=="SUPER CAT A") echo "Selected"; ?>>SUPER CAT A</option>	

			 </select> 
			</td>
           </tr>
           
           <tr><td colspan="13" align="center"><input type="submit" name="submit" /></td></tr>        
    </table>
    </form>
</td>
</tr>

</table>
</body>
</html>
