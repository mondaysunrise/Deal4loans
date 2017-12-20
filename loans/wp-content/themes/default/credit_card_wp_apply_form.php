 <?
	 $d4l_section="Wordpress CMS";
	//echo $_SERVER['REQUEST_URI'];
	if($_SERVER['REQUEST_URI']=='/loans/banks/sbi-credit-cards/')
	{
		$subjectLine = "Quick Apply for Best Credit Card in 2 minutes";
	}
	else
	{
		$mystring2=$_SERVER['REQUEST_URI'];

		if(stripos($mystring2, "hdfc")>0 && stripos($mystring2, "credit")>0 && stripos($mystring2, "card")>0)
		{
			$subjectLine = "Apply online for HDFC Bank Credit Cards";
		}
		else if(stripos($mystring2, "icici")>0 && stripos($mystring2, "credit")>0 && stripos($mystring2, "card")>0)
		{
			$subjectLine = "Apply online for ICICI Bank Credit Cards";
		}
		else if(stripos($mystring2, "standard")>0 && stripos($mystring2, "chartered")>0 && stripos($mystring2, "credit")>0 && stripos($mystring2, "card")>0)
		{
			$subjectLine = "Apply online for Standard Chartered Bank Credit Cards";
		}
		else
		{
		$subjectLine = "Apply for Best Credit Cards with Deal4loans Network";
		}
 	}
		include "../credit-card-widget-wp.php";
	?>