<?php


function insertXMLData($myXMLData)
{
	$myXMLData = str_ireplace("&quot;", "'", $myXMLData);
	
	$xml=simplexml_load_string(stripslashes($myXMLData)) or die("Error: Cannot create object");
	
	$Header = $xml->Header;
	
	$SystemCode = $Header->SystemCode;//Insert
	$MessageText = $Header->MessageText;//Insert
	$ReportDate = $Header->ReportDate;//Insert
	$ReportTime = $Header->ReportTime;//Insert
	$UserMessageText = $xml->UserMessage->UserMessageText;//Insert
	
	$CreditProfileHeader = $xml->CreditProfileHeader;
	
	$Enquiry_Username = $CreditProfileHeader->Enquiry_Username;//Insert
	$Version = $CreditProfileHeader->Version;//Insert
	$ReportNumber = $CreditProfileHeader->ReportNumber;//Insert
	$Subscriber_Name = $CreditProfileHeader->Subscriber_Name;//Insert
	
	$CreditProfileHeader = $xml->Current_Application;
	$Current_Application_Details = $CreditProfileHeader->Current_Application_Details;
	
	$Enquiry_Reason = $Current_Application_Details->Enquiry_Reason;//Insert
	$Finance_Purpose = $Current_Application_Details->Finance_Purpose;//Insert
	$Amount_Financed = $Current_Application_Details->Amount_Financed;//Insert
	$Duration_Of_Agreement = $Current_Application_Details->Duration_Of_Agreement;//Insert
	
	$Current_Applicant_Details = $Current_Application_Details->Current_Applicant_Details;
	
	$Last_Name = $Current_Applicant_Details->Last_Name;//Insert
	$First_Name = $Current_Applicant_Details->First_Name;//Insert
	$Middle_Name1 = $Current_Applicant_Details->Middle_Name1;//Insert
	$Middle_Name2 = $Current_Applicant_Details->Middle_Name2;//Insert
	$Middle_Name3 = $Current_Applicant_Details->Middle_Name3;//Insert 
	
	$Customer_Name = $First_Name." ".$Middle_Name1." ".$Middle_Name2." ".$Middle_Name3." ".$Last_Name;
	$Gender_Code = $Current_Applicant_Details->Gender_Code;//Insert
	$IncomeTaxPan = $Current_Applicant_Details->IncomeTaxPan;//Insert
	$PAN_Issue_Date = $Current_Applicant_Details->PAN_Issue_Date;//Insert
	$PAN_Expiration_Date = $Current_Applicant_Details->PAN_Expiration_Date;//Insert
	$Passport_Issue_Date = $Current_Applicant_Details->Passport_Issue_Date;//Insert
	$Passport_Expiration_Date = $Current_Applicant_Details->Passport_Expiration_Date;//Insert
	$Voter_s_Identity_Card = $Current_Applicant_Details->Voter_s_Identity_Card;//Insert
	$Voter_ID_Issue_Date = $Current_Applicant_Details->Voter_ID_Issue_Date;//Insert
	$Voter_ID_Expiration_Date = $Current_Applicant_Details->Voter_ID_Expiration_Date;//Insert
	$Driver_License_Number = $Current_Applicant_Details->Driver_License_Number;//Insert
	$Driver_License_Issue_Date = $Current_Applicant_Details->Driver_License_Issue_Date;//Insert
	$Driver_License_Expiration_Date = $Current_Applicant_Details->Driver_License_Expiration_Date;//Insert
	$Ration_Card_Number = $Current_Applicant_Details->Ration_Card_Number;//Insert
	$Ration_Card_Issue_Date = $Current_Applicant_Details->Ration_Card_Issue_Date;//Insert
	$Ration_Card_Expiration_Date = $Current_Applicant_Details->Ration_Card_Expiration_Date;//Insert
	$Universal_ID_Number = $Current_Applicant_Details->Universal_ID_Number;//Insert
	$Universal_ID_Issue_Date = $Current_Applicant_Details->Universal_ID_Issue_Date;//Insert
	$Universal_ID_Expiration_Date = $Current_Applicant_Details->Universal_ID_Expiration_Date;//Insert
	$Date_Of_Birth_Applicant = $Current_Applicant_Details->Date_Of_Birth_Applicant;//Insert
	$Telephone_Number_Applicant_1st = $Current_Applicant_Details->Telephone_Number_Applicant_1st;//Insert
	$Telephone_Extension = $Current_Applicant_Details->Telephone_Extension;//Insert
	$Telephone_Type = $Current_Applicant_Details->Telephone_Type;//Insert
	$MobilePhoneNumber = $Current_Applicant_Details->MobilePhoneNumber;//Insert
	$EMailId = $Current_Applicant_Details->EMailId;//Insert
	$Universal_ID_Expiration_Date = $Current_Applicant_Details->Universal_ID_Expiration_Date;//Insert
	
	$Current_Other_Details = $Current_Application_Details->Current_Other_Details;
	
	$Income = $Current_Other_Details->Income;//Insert
	$Marital_Status = $Current_Other_Details->Marital_Status;//Insert
	$Employment_Status = $Current_Other_Details->Employment_Status;//Insert
	$Time_with_Employer = $Current_Other_Details->Time_with_Employer;//Insert
	$Number_of_Major_Credit_Card_Held = $Current_Other_Details->Number_of_Major_Credit_Card_Held;//Insert
	
	$Current_Applicant_Address_Details = $Current_Application_Details->Current_Applicant_Address_Details;
	$FlatNoPlotNoHouseNo = $Current_Applicant_Address_Details->FlatNoPlotNoHouseNo;//Insert
	$BldgNoSocietyName = $Current_Applicant_Address_Details->BldgNoSocietyName;//Insert
	$RoadNoNameAreaLocality = $Current_Applicant_Address_Details->RoadNoNameAreaLocality;//Insert
	$City = $Current_Applicant_Address_Details->City;//Insert
	$Landmark = $Current_Applicant_Address_Details->Landmark;//Insert
	$State = $Current_Applicant_Address_Details->State;//Insert
	$PINCode = $Current_Applicant_Address_Details->PINCode;//Insert
	$Country_Code = $Current_Applicant_Address_Details->Country_Code;//Insert
	
	$CAIS_Account = $xml->CAIS_Account;
	$CAIS_Summary = $CAIS_Account->CAIS_Summary;
	$Credit_Account = $CAIS_Summary->Credit_Account;
	
	$CreditAccountTotal = $Credit_Account->CreditAccountTotal;//Insert
	$CreditAccountActive = $Credit_Account->CreditAccountActive;//Insert
	$CreditAccountDefault = $Credit_Account->CreditAccountDefault;//Insert
	$CreditAccountClosed = $Credit_Account->CreditAccountClosed;//Insert
	$CADSuitFiledCurrentBalance = $Credit_Account->CADSuitFiledCurrentBalance;//Insert
	
	$Total_Outstanding_Balance = $CAIS_Summary->Total_Outstanding_Balance;
	$Outstanding_Balance_Secured = $Total_Outstanding_Balance->Outstanding_Balance_Secured;//Insert
	$Outstanding_Balance_Secured_Percentage = $Total_Outstanding_Balance->Outstanding_Balance_Secured_Percentage;//Insert
	$Outstanding_Balance_UnSecured = $Total_Outstanding_Balance->Outstanding_Balance_UnSecured;//Insert
	$Outstanding_Balance_UnSecured_Percentage = $Total_Outstanding_Balance->Outstanding_Balance_UnSecured_Percentage;//Insert
	$Outstanding_Balance_All = $Total_Outstanding_Balance->Outstanding_Balance_All;//Insert
	
	
	$Match_result = $xml->Match_result;
	$Exact_match = $Match_result->Exact_match; //Insert
	
	$TotalCAPS_Summary = $xml->TotalCAPS_Summary;
	$TotalCAPSLast7Days = $TotalCAPS_Summary->TotalCAPSLast7Days;//Insert
	$TotalCAPSLast30Days = $TotalCAPS_Summary->TotalCAPSLast30Days;//Insert
	$TotalCAPSLast90Days = $TotalCAPS_Summary->TotalCAPSLast90Days;//Insert
	$TotalCAPSLast180Days = $TotalCAPS_Summary->TotalCAPSLast180Days;//Insert
	
	$CAPS = $xml->CAPS;
	$CAPS_Summary = $CAPS->CAPS_Summary;
	$CAPSLast7Days = $CAPS_Summary->CAPSLast7Days;//Insert
	$CAPSLast30Days = $CAPS_Summary->CAPSLast30Days;//Insert
	$CAPSLast90Days = $CAPS_Summary->CAPSLast90Days;//Insert
	$CAPSLast180Days = $CAPS_Summary->CAPSLast180Days;//Insert
	
	$SCORE = $xml->SCORE;
	$BureauScore = $SCORE->BureauScore;//Insert
	$BureauScoreConfidLevel = $SCORE->BureauScoreConfidLevel;//Insert
	
	$Dated = date("Y-m-d hh:ii:ss");
	$Status = 1;
	$checkPrimaryDetailsSql = "select id from experian_customer_primary_details where IncomeTaxPan = '".$IncomeTaxPan."'";
	$checkPrimaryDetailsQuery = ExecQuery($checkPrimaryDetailsSql);
	$checkPrimaryDetailsNumRows = mysql_num_rows($checkPrimaryDetailsQuery);
	if($checkPrimaryDetailsNumRows>0)
	{
		$CustomerID = mysql_result($checkPrimaryDetailsQuery,0,'id');
	}
	else
	{
		$primaryDetailsSql = "insert INTO experian_customer_primary_details SET Customer_Name = '".$Customer_Name."', Gender_Code = '".$Gender_Code."', IncomeTaxPan = '".$IncomeTaxPan."', PAN_Issue_Date = '".$PAN_Issue_Date."', PAN_Expiration_Date = '".$PAN_Expiration_Date."', Universal_ID_Number = '".$Universal_ID_Number."', Universal_ID_Issue_Date = '".$Universal_ID_Issue_Date."', Universal_ID_Expiration_Date = '".$Universal_ID_Expiration_Date."', Date_Of_Birth_Applicant = '".$Date_Of_Birth_Applicant."'";
		$primaryDetailsQuery = ExecQuery($primaryDetailsSql);
		$CustomerID = mysql_insert_id();
	}
	
	$scoreDetailsSql = "insert INTO experian_customer_score_details SET CustomerID = '".$CustomerID."', Customer_Name = '".$Customer_Name."', Dated = '".$Dated."', SystemCode = '".$SystemCode."', MessageText = '".$MessageText."', ReportDate = '".$ReportDate."', ReportTime = '".$ReportTime."', UserMessageText = '".$UserMessageText."', Enquiry_Username = '".$Enquiry_Username."', Version = '".$Version."', ReportNumber = '".$ReportNumber."', Subscriber_Name = '".$Subscriber_Name."', Enquiry_Reason = '".$Enquiry_Reason."', Finance_Purpose = '".$Finance_Purpose."', Amount_Financed = '".$Amount_Financed."', Duration_Of_Agreement = '".$Duration_Of_Agreement."', BureauScore = '".$BureauScore."', BureauScoreConfidLevel = '".$BureauScoreConfidLevel."' ";
	
	$scoreDetailsQuery = ExecQuery($scoreDetailsSql);
	$ReportID = mysql_insert_id();
	
	$otherDetailsSql = "insert INTO experian_customer_other_details SET ReportID = '".$ReportID."', Customer_Name = '".$Customer_Name."', Last_Name = '".$Last_Name."', First_Name = '".$First_Name."', Middle_Name1 = '".$Middle_Name1."', Middle_Name2 = '".$Middle_Name2."', Middle_Name3 = '".$Middle_Name3."', Passport_Issue_Date = '".$Passport_Issue_Date."', Passport_Expiration_Date = '".$Passport_Expiration_Date."', Voter_s_Identity_Card = '".$Voter_s_Identity_Card."', Voter_ID_Issue_Date = '".$Voter_ID_Issue_Date."', Voter_ID_Expiration_Date = '".$Voter_ID_Expiration_Date."', Driver_License_Number = '".$Driver_License_Number."', Driver_License_Issue_Date = '".$Driver_License_Issue_Date."', Driver_License_Expiration_Date = '".$Driver_License_Expiration_Date."', Ration_Card_Number = '".$Ration_Card_Number."', Ration_Card_Issue_Date = '".$Ration_Card_Issue_Date."', Ration_Card_Expiration_Date = '".$Ration_Card_Expiration_Date."', Telephone_Number_Applicant_1st = '".$Telephone_Number_Applicant_1st."', Telephone_Extension = '".$Telephone_Extension."', Telephone_Type = '".$Telephone_Type."', MobilePhoneNumber = '".$MobilePhoneNumber."', EMailId = '".$EMailId."', Income = '".$Income."', Marital_Status = '".$Marital_Status."', Employment_Status = '".$Employment_Status."', Time_with_Employer = '".$Time_with_Employer."', Number_of_Major_Credit_Card_Held = '".$Number_of_Major_Credit_Card_Held."', FlatNoPlotNoHouseNo = '".$FlatNoPlotNoHouseNo."', BldgNoSocietyName = '".$BldgNoSocietyName."', RoadNoNameAreaLocality = '".$RoadNoNameAreaLocality."', City = '".$City."', Landmark = '".$Landmark."', State = '".$State."', PINCode = '".$PINCode."', Country_Code = '".$Country_Code."'";
	$otherDetailsQuery = ExecQuery($otherDetailsSql);
	echo "<br>Query Not working - ".$otherDetailsSql."<br>";
	
	$otherMiscDetailsSql = "insert INTO experian_customer_othermisc_details SET ReportID = '".$ReportID."', Customer_Name = '".$Customer_Name."', CreditAccountTotal = '".$CreditAccountTotal."', CreditAccountActive = '".$CreditAccountActive."', CreditAccountDefault = '".$CreditAccountDefault."', CreditAccountClosed = '".$CreditAccountClosed."', CADSuitFiledCurrentBalance = '".$CADSuitFiledCurrentBalance."', Outstanding_Balance_Secured = '".$Outstanding_Balance_Secured."', Outstanding_Balance_Secured_Percentage = '".$Outstanding_Balance_Secured_Percentage."', Outstanding_Balance_UnSecured = '".$Outstanding_Balance_UnSecured."', Outstanding_Balance_UnSecured_Percentage = '".$Outstanding_Balance_UnSecured_Percentage."', Outstanding_Balance_All = '".$Outstanding_Balance_All."', Exact_match = '".$Exact_match."', TotalCAPSLast7Days = '".$TotalCAPSLast7Days."', TotalCAPSLast30Days = '".$TotalCAPSLast30Days."', TotalCAPSLast90Days = '".$TotalCAPSLast90Days."', TotalCAPSLast180Days = '".$TotalCAPSLast180Days."', CAPSLast7Days = '".$CAPSLast7Days."', CAPSLast30Days = '".$CAPSLast30Days."', CAPSLast90Days = '".$CAPSLast90Days."', CAPSLast180Days = '".$CAPSLast180Days."'";
	$otherMiscDetailsQuery = ExecQuery($otherMiscDetailsSql);
	
	
	$CAIS_Account_DETAILS = $CAIS_Account->CAIS_Account_DETAILS;
	
	//Save this in Sub Table /** Start **/
	$CAISAccountDETAILS ='';
	$insertCAIS = '';
	$insertCAIS = "insert into experian_cais_account_details (ReportID, Subscriber_Name, Account_Number, Portfolio_Type, Account_Type, Open_Date, Highest_Credit_or_Original_Loan_Amount, Terms_Duration, Terms_Frequency, Scheduled_Monthly_Payment_Amount, Account_Status, Payment_Rating, Payment_History_Profile, Special_Comment, Current_Balance, Amount_Past_Due, Date_Reported, Date_Closed, Date_of_Last_Payment, SuitFiledWillfulDefaultWrittenOffStatus, Written_off_Settled_Status, Value_of_Credits_Last_Month, Occupation_Code, Settlement_Amount, Value_of_Collateral, Type_of_Collateral, Written_Off_Amt_Total, Written_Off_Amt_Principal, Rate_of_Interest, Repayment_Tenure, Promotional_Rate_Flag, Income, Income_Indicator, Income_Frequency_Indicator, DefaultStatusDate, LitigationStatusDate, WriteOffStatusDate, DateOfAddition, CurrencyCode, Subscriber_comments, Consumer_comments, AccountHoldertypeCode, Surname_Non_Normalized, First_Name_Non_Normalized, Middle_Name_1_Non_Normalized, Middle_Name_2_Non_Normalized, Middle_Name_3_Non_Normalized, Alias, Gender_Code, Date_of_birth, First_Line_Of_Address_non_normalized, Second_Line_Of_Address_non_normalized, Third_Line_Of_Address_non_normalized, City_non_normalized, Fifth_Line_Of_Address_non_normalized, State_non_normalized, ZIP_Postal_Code_non_normalized, CountryCode_non_normalized, Address_indicator_non_normalized, Residence_code_non_normalized, Telephone_Number, Telephone_Type, Driver_License_Number, Driver_License_Issue_Date, Driver_License_Expiration_Date,CAISAccountHistory) VALUES ";
	for($cad=0;$cad<count($CAIS_Account_DETAILS);$cad++)
	{
		$CAISAccountDETAILS = $CAIS_Account_DETAILS[$cad];
		$Subscriber_Name = $CAISAccountDETAILS->Subscriber_Name;//Insert
		$Account_Number = $CAISAccountDETAILS->Account_Number;//Insert
		$Portfolio_Type = $CAISAccountDETAILS->Portfolio_Type;//Insert
		$Account_Type = $CAISAccountDETAILS->Account_Type;//Insert
		$Open_Date = $CAISAccountDETAILS->Open_Date;//Insert
		$Highest_Credit_or_Original_Loan_Amount = $CAISAccountDETAILS->Highest_Credit_or_Original_Loan_Amount;//Insert
		$Terms_Duration = $CAISAccountDETAILS->Terms_Duration;//Insert
		$Terms_Frequency = $CAISAccountDETAILS->Terms_Frequency;//Insert
		$Scheduled_Monthly_Payment_Amount = $CAISAccountDETAILS->Scheduled_Monthly_Payment_Amount;//Insert
		$Account_Status = $CAISAccountDETAILS->Account_Status;//Insert
		$Payment_Rating = $CAISAccountDETAILS->Payment_Rating;//Insert
		$Payment_History_Profile = $CAISAccountDETAILS->Payment_History_Profile;//Insert
		$Special_Comment = $CAISAccountDETAILS->Special_Comment;//Insert
		$Current_Balance = $CAISAccountDETAILS->Current_Balance;//Insert
		$Amount_Past_Due = $CAISAccountDETAILS->Amount_Past_Due;//Insert
		$Date_Reported = $CAISAccountDETAILS->Date_Reported;//Insert
		$Date_Closed = $CAISAccountDETAILS->Date_Closed;//Insert
		$Date_of_Last_Payment = $CAISAccountDETAILS->Date_of_Last_Payment;//Insert
		$SuitFiledWillfulDefaultWrittenOffStatus = $CAISAccountDETAILS->SuitFiledWillfulDefaultWrittenOffStatus;//Insert
		$Written_off_Settled_Status = $CAISAccountDETAILS->Written_off_Settled_Status;//Insert
		$Value_of_Credits_Last_Month = $CAISAccountDETAILS->Value_of_Credits_Last_Month;//Insert
		$Occupation_Code = $CAISAccountDETAILS->Occupation_Code;//Insert
		$Settlement_Amount = $CAISAccountDETAILS->Settlement_Amount;//Insert
		$Value_of_Collateral = $CAISAccountDETAILS->Value_of_Collateral;//Insert
		$Type_of_Collateral = $CAISAccountDETAILS->Type_of_Collateral;//Insert
		$Written_Off_Amt_Total = $CAISAccountDETAILS->Written_Off_Amt_Total;//Insert
		$Written_Off_Amt_Principal = $CAISAccountDETAILS->Written_Off_Amt_Principal;//Insert
		$Rate_of_Interest = $CAISAccountDETAILS->Rate_of_Interest;//Insert
		$Repayment_Tenure = $CAISAccountDETAILS->Repayment_Tenure;//Insert
		$Promotional_Rate_Flag = $CAISAccountDETAILS->Promotional_Rate_Flag;//Insert
		$Income = $CAISAccountDETAILS->Income;//Insert
		$Income_Indicator = $CAISAccountDETAILS->Income_Indicator;//Insert
		$Income_Frequency_Indicator = $CAISAccountDETAILS->Income_Frequency_Indicator;//Insert
		$DefaultStatusDate = $CAISAccountDETAILS->DefaultStatusDate;//Insert
		$LitigationStatusDate = $CAISAccountDETAILS->LitigationStatusDate;//Insert
		$WriteOffStatusDate = $CAISAccountDETAILS->WriteOffStatusDate;//Insert
		$DateOfAddition = $CAISAccountDETAILS->DateOfAddition;//Insert
		$CurrencyCode = $CAISAccountDETAILS->CurrencyCode;//Insert
		$Subscriber_comments = $CAISAccountDETAILS->Subscriber_comments;//Insert
		$Consumer_comments = $CAISAccountDETAILS->Consumer_comments;//Insert
		$AccountHoldertypeCode = $CAISAccountDETAILS->AccountHoldertypeCode;//Insert
		
		$CAIS_Account_History =  $CAISAccountDETAILS->CAIS_Account_History;
		$CAISAccountHistory = '';
		$CAISAccountHistoryStr = '';
		//Save this in Sub Table /** Start **/
		for($cah=0;$cah<count($CAIS_Account_History);$cah++)
		{
			$CAISAccountHistory = $CAIS_Account_History[$cah];
			$Year = $CAISAccountHistory->Year;//Insert
			$Month = $CAISAccountHistory->Month;//Insert
			$Days_Past_Due = $CAISAccountHistory->Days_Past_Due;//Insert
			$Asset_Classification = $CAISAccountHistory->Asset_Classification;//Insert
			$CAISAccountHistoryStr .= $Year.",".$Month.",".$Days_Past_Due.",".$Asset_Classification."|";
		}
		//Save this in Sub Table /** End **/
		$CAIS_Holder_Details =  $CAISAccountDETAILS->CAIS_Holder_Details;
		$Surname_Non_Normalized =  $CAIS_Holder_Details->Surname_Non_Normalized;//Insert
		$First_Name_Non_Normalized =  $CAIS_Holder_Details->First_Name_Non_Normalized;//Insert
		$Middle_Name_1_Non_Normalized =  $CAIS_Holder_Details->Middle_Name_1_Non_Normalized;//Insert
		$Middle_Name_2_Non_Normalized =  $CAIS_Holder_Details->Middle_Name_2_Non_Normalized;//Insert
		$Middle_Name_3_Non_Normalized =  $CAIS_Holder_Details->Middle_Name_3_Non_Normalized;//Insert
		$Alias =  $CAIS_Holder_Details->Alias;//Insert
		$Gender_Code =  $CAIS_Holder_Details->Gender_Code;//Insert
		$Date_of_birth =  $CAIS_Holder_Details->Date_of_birth;//Insert
		
		$CAIS_Holder_Address_Details =  $CAISAccountDETAILS->CAIS_Holder_Address_Details;
		$First_Line_Of_Address_non_normalized =  $CAIS_Holder_Address_Details->First_Line_Of_Address_non_normalized;//Insert
		$Second_Line_Of_Address_non_normalized =  $CAIS_Holder_Address_Details->Second_Line_Of_Address_non_normalized;	//Insert
		$Third_Line_Of_Address_non_normalized =  $CAIS_Holder_Address_Details->Third_Line_Of_Address_non_normalized;//Insert
		$City_non_normalized =  $CAIS_Holder_Address_Details->City_non_normalized;	//Insert
		$Fifth_Line_Of_Address_non_normalized =  $CAIS_Holder_Address_Details->Fifth_Line_Of_Address_non_normalized;//Insert
		$State_non_normalized =  $CAIS_Holder_Address_Details->State_non_normalized;	//Insert
		$ZIP_Postal_Code_non_normalized =  $CAIS_Holder_Address_Details->ZIP_Postal_Code_non_normalized;//Insert
		$CountryCode_non_normalized =  $CAIS_Holder_Address_Details->CountryCode_non_normalized;	//Insert
		$Address_indicator_non_normalized =  $CAIS_Holder_Address_Details->Address_indicator_non_normalized;//Insert
		$Residence_code_non_normalized =  $CAIS_Holder_Address_Details->Residence_code_non_normalized;	//Insert
		
		$CAIS_Holder_Phone_Details =  $CAISAccountDETAILS->CAIS_Holder_Phone_Details;
		$Telephone_Number =  $CAIS_Holder_Phone_Details->Telephone_Number;//Insert
		$Telephone_Type =  $CAIS_Holder_Phone_Details->Telephone_Type;	//Insert
		
		$CAIS_Holder_ID_Details =  $CAISAccountDETAILS->CAIS_Holder_ID_Details;
		$Driver_License_Number =  $CAIS_Holder_ID_Details->Driver_License_Number;//Insert
		$Driver_License_Issue_Date =  $CAIS_Holder_ID_Details->Driver_License_Issue_Date;//Insert
		$Driver_License_Expiration_Date =  $CAIS_Holder_ID_Details->Driver_License_Expiration_Date;//Insert		
		
		$insertCAIS .= "('".$ReportID."', '".$Subscriber_Name."', '".$Account_Number."', '".$Portfolio_Type."', '".$Account_Type."', '".$Open_Date."', '".$Highest_Credit_or_Original_Loan_Amount."', '".$Terms_Duration."', '".$Terms_Frequency."', '".$Scheduled_Monthly_Payment_Amount."', '".$Account_Status."', '".$Payment_Rating."', '".$Payment_History_Profile."', '".$Special_Comment."', '".$Current_Balance."', '".$Amount_Past_Due."', '".$Date_Reported."', '".$Date_Closed."', '".$Date_of_Last_Payment."', '".$SuitFiledWillfulDefaultWrittenOffStatus."', '".$Written_off_Settled_Status."', '".$Value_of_Credits_Last_Month."', '".$Occupation_Code."', '".$Settlement_Amount."', '".$Value_of_Collateral."', '".$Type_of_Collateral."', '".$Written_Off_Amt_Total."', '".$Written_Off_Amt_Principal."', '".$Rate_of_Interest."', '".$Repayment_Tenure."', '".$Promotional_Rate_Flag."', '".$Income."', '".$Income_Indicator."', '".$Income_Frequency_Indicator."', '".$DefaultStatusDate."', '".$LitigationStatusDate."', '".$WriteOffStatusDate."', '".$DateOfAddition."', '".$CurrencyCode."', '".$Subscriber_comments."', '".$Consumer_comments."', '".$AccountHoldertypeCode."', '".$Surname_Non_Normalized."', '".$First_Name_Non_Normalized."', '".$Middle_Name_1_Non_Normalized."', '".$Middle_Name_2_Non_Normalized."', '".$Middle_Name_3_Non_Normalized."', '".$Alias."', '".$Gender_Code."', '".$Date_of_birth."', '".$First_Line_Of_Address_non_normalized."', '".$Second_Line_Of_Address_non_normalized."', '".$Third_Line_Of_Address_non_normalized."', '".$City_non_normalized."', '".$Fifth_Line_Of_Address_non_normalized."', '".$State_non_normalized."', '".$ZIP_Postal_Code_non_normalized."', '".$CountryCode_non_normalized."', '".$Address_indicator_non_normalized."', '".$Residence_code_non_normalized."', '".$Telephone_Number."', '".$Telephone_Type."', '".$Driver_License_Number."', '".$Driver_License_Issue_Date."', '".$Driver_License_Expiration_Date."', '".$CAISAccountHistoryStr."'), ";
		$CAISAccountHistoryStr = '';
	}
	
	$insertCAIS = trim($insertCAIS);
	$insertCAIS = rtrim($insertCAIS, ",");
	$insertCAISQuery = ExecQuery($insertCAIS);
	// Insert here 
	//echo "<br><br>";
	//echo $insertCAIS;
	//echo "<br><br>";
	
	
	//Save this in Sub Table /** End **/
	$CAPS_Application_Details = $CAPS->CAPS_Application_Details;
	
	
	$insertCAPS = '';
	$insertCAPS .= "insert into experian_caps_application_details (ReportID, CapsSubscriber_code, CapsSubscriber_Name, CapsDate_of_Request, CapsReportTime, CapsReportNumber, CapsEnquiry_Reason, CapsFinance_Purpose, CapsAmount_Financed, CapsDuration_Of_Agreement, CapsLast_Name, CapsFirst_Name, CapsMiddle_Name1, CapsMiddle_Name2, CapsMiddle_Name3, CapsGender_Code, CapsIncomeTaxPan, CapsPAN_Issue_Date, CapsPAN_Expiration_Date, CapsPassport_number, CapsPassport_Issue_Date, CapsPassport_Expiration_Date, CapsVoter_s_Identity_Card, CapsVoter_ID_Issue_Date, CapsVoter_ID_Expiration_Date, CapsDriver_License_Number, CapsDriver_License_Issue_Date, CapsDriver_License_Expiration_Date, CapsRation_Card_Number, CapsRation_Card_Issue_Date, CapsRation_Card_Expiration_Date, CapsUniversal_ID_Number, CapsUniversal_ID_Issue_Date, CapsUniversal_ID_Expiration_Date, CapsDate_Of_Birth_Applicant, CapsTelephone_Type, CapsMobilePhoneNumber, CapsEMailId, CapsIncome, CapsMarital_Status, CapsEmployment_Status, CapsTime_with_Employer, CapsNumber_of_Major_Credit_Card_Held, CapsFlatNoPlotNoHouseNo, CapsBldgNoSocietyName, CapsRoadNoNameAreaLocality, CapsCity, CapsLandmark, CapsState, CapsPINCode, CapsCountry_Code, CapsAddFlatNoPlotNoHouseNo, CapsAddBldgNoSocietyName, CapsAddRoadNoNameAreaLocality, CapsAddCity, CapsAddLandmark, CapsAddState, CapsAddPINCode, CapsAddCountry_Code) VALUES ";
	
	for($capsad=0;$capsad<count($CAPS_Application_Details);$capsad++)
	{
		$CAPSApplicationDetails = $CAPS_Application_Details[$capsad];
		$CapsSubscriber_code = $CAPSApplicationDetails->Subscriber_code;//Insert
		$CapsSubscriber_Name = $CAPSApplicationDetails->Subscriber_Name;//Insert
		$CapsDate_of_Request = $CAPSApplicationDetails->Date_of_Request;//Insert
		$CapsReportTime = $CAPSApplicationDetails->ReportTime;//Insert
		$CapsReportNumber = $CAPSApplicationDetails->ReportNumber;//Insert
		$CapsEnquiry_Reason = $CAPSApplicationDetails->Enquiry_Reason;//Insert
		$CapsFinance_Purpose = $CAPSApplicationDetails->Finance_Purpose;//Insert
		$CapsAmount_Financed = $CAPSApplicationDetails->Amount_Financed;//Insert
		$CapsDuration_Of_Agreement = $CAPSApplicationDetails->Duration_Of_Agreement;//Insert
	
		$CAPS_Applicant_Details = $CAPSApplicationDetails->CAPS_Applicant_Details;
		$CapsLast_Name = $CAPS_Applicant_Details->Last_Name;//Insert
		$CapsFirst_Name = $CAPS_Applicant_Details->First_Name;//Insert
		$CapsMiddle_Name1 = $CAPS_Applicant_Details->Middle_Name1;//Insert
		$CapsMiddle_Name2 = $CAPS_Applicant_Details->Middle_Name2;//Insert
		$CapsMiddle_Name3 = $CAPS_Applicant_Details->Middle_Name3;//Insert 
		$CapsGender_Code = $CAPS_Applicant_Details->Gender_Code;//Insert
		$CapsIncomeTaxPan = $CAPS_Applicant_Details->IncomeTaxPan;//Insert
		$CapsPAN_Issue_Date = $CAPS_Applicant_Details->PAN_Issue_Date;//Insert
		$CapsPAN_Expiration_Date = $CAPS_Applicant_Details->PAN_Expiration_Date;//Insert
		$CapsPassport_number = $CAPS_Applicant_Details->Passport_number;//Insert
		$CapsPassport_Issue_Date = $CAPS_Applicant_Details->Passport_Issue_Date;//Insert
		$CapsPassport_Expiration_Date = $CAPS_Applicant_Details->Passport_Expiration_Date;//Insert
		$CapsVoter_s_Identity_Card = $CAPS_Applicant_Details->Voter_s_Identity_Card;//Insert
		$CapsVoter_ID_Issue_Date = $CAPS_Applicant_Details->Voter_ID_Issue_Date;//Insert
		$CapsVoter_ID_Expiration_Date = $CAPS_Applicant_Details->Voter_ID_Expiration_Date;//Insert
		$CapsDriver_License_Number = $CAPS_Applicant_Details->Driver_License_Number;//Insert
		$CapsDriver_License_Issue_Date = $CAPS_Applicant_Details->Driver_License_Issue_Date;//Insert
		$CapsDriver_License_Expiration_Date = $CAPS_Applicant_Details->Driver_License_Expiration_Date;//Insert
		$CapsRation_Card_Number = $CAPS_Applicant_Details->Ration_Card_Number;//Insert
		$CapsRation_Card_Issue_Date = $CAPS_Applicant_Details->Ration_Card_Issue_Date;//Insert
		$CapsRation_Card_Expiration_Date = $CAPS_Applicant_Details->Ration_Card_Expiration_Date;//Insert
		$CapsUniversal_ID_Number = $CAPS_Applicant_Details->Universal_ID_Number;//Insert
		$CapsUniversal_ID_Issue_Date = $CAPS_Applicant_Details->Universal_ID_Issue_Date;//Insert
		$CapsUniversal_ID_Expiration_Date = $CAPS_Applicant_Details->Universal_ID_Expiration_Date;//Insert
		$CapsDate_Of_Birth_Applicant = $CAPS_Applicant_Details->Date_Of_Birth_Applicant;//Insert
		$CapsTelephone_Type = $CAPS_Applicant_Details->Telephone_Type;//Insert
		$CapsMobilePhoneNumber = $CAPS_Applicant_Details->MobilePhoneNumber;//Insert
		$CapsEMailId = $CAPS_Applicant_Details->EMailId;//Insert
	
		$CAPS_Other_Details = $CAPSApplicationDetails->CAPS_Other_Details;
		$CapsIncome = $CAPS_Other_Details->Income;//Insert
		$CapsMarital_Status = $CAPS_Other_Details->Marital_Status;//Insert
		$CapsEmployment_Status = $CAPS_Other_Details->Employment_Status;//Insert
		$CapsTime_with_Employer = $CAPS_Other_Details->Time_with_Employer;//Insert
		$CapsNumber_of_Major_Credit_Card_Held = $CAPS_Other_Details->Number_of_Major_Credit_Card_Held;//Insert
	
		$CAPS_Applicant_Address_Details = $CAPSApplicationDetails->CAPS_Applicant_Address_Details;
		$CapsFlatNoPlotNoHouseNo = $CAPS_Applicant_Address_Details->FlatNoPlotNoHouseNo;//Insert
		$CapsBldgNoSocietyName = $CAPS_Applicant_Address_Details->BldgNoSocietyName;//Insert
		$CapsRoadNoNameAreaLocality = $CAPS_Applicant_Address_Details->RoadNoNameAreaLocality;//Insert
		$CapsCity = $CAPS_Applicant_Address_Details->City;//Insert
		$CapsLandmark = $CAPS_Applicant_Address_Details->Landmark;//Insert
		$CapsState = $CAPS_Applicant_Address_Details->State;//Insert
		$CapsPINCode = $CAPS_Applicant_Address_Details->PINCode;//Insert
		$CapsCountry_Code = $CAPS_Applicant_Address_Details->Country_Code;//Insert
	
		$CAPS_Applicant_Additional_Address_Details = $CAPSApplicationDetails->CAPS_Applicant_Additional_Address_Details;
		$CapsAddFlatNoPlotNoHouseNo = $CAPS_Applicant_Additional_Address_Details->FlatNoPlotNoHouseNo;//Insert
		$CapsAddBldgNoSocietyName = $CAPS_Applicant_Additional_Address_Details->BldgNoSocietyName;//Insert
		$CapsAddRoadNoNameAreaLocality = $CAPS_Applicant_Additional_Address_Details->RoadNoNameAreaLocality;//Insert
		$CapsAddCity = $CAPS_Applicant_Additional_Address_Details->City;//Insert
		$CapsAddLandmark = $CAPS_Applicant_Additional_Address_Details->Landmark;//Insert
		$CapsAddState = $CAPS_Applicant_Additional_Address_Details->State;//Insert
		$CapsAddPINCode = $CAPS_Applicant_Additional_Address_Details->PINCode;//Insert
		$CapsAddCountry_Code = $CAPS_Applicant_Additional_Address_Details->Country_Code;//Insert
		
		$insertCAPS .= "('".$ReportID."', '".$CapsSubscriber_code."', '".$CapsSubscriber_Name."', '".$CapsDate_of_Request."', '".$CapsReportTime."', '".$CapsReportNumber."', '".$CapsEnquiry_Reason."', '".$CapsFinance_Purpose."', '".$CapsAmount_Financed."', '".$CapsDuration_Of_Agreement."', '".$CapsLast_Name."', '".$CapsFirst_Name."', '".$CapsMiddle_Name1."', '".$CapsMiddle_Name2."', '".$CapsMiddle_Name3."', '".$CapsGender_Code."', '".$CapsIncomeTaxPan."', '".$CapsPAN_Issue_Date."', '".$CapsPAN_Expiration_Date."', '".$CapsPassport_number."', '".$CapsPassport_Issue_Date."', '".$CapsPassport_Expiration_Date."', '".$CapsVoter_s_Identity_Card."', '".$CapsVoter_ID_Issue_Date."', '".$CapsVoter_ID_Expiration_Date."', '".$CapsDriver_License_Number."', '".$CapsDriver_License_Issue_Date."', '".$CapsDriver_License_Expiration_Date."', '".$CapsRation_Card_Number."', '".$CapsRation_Card_Issue_Date."', '".$CapsRation_Card_Expiration_Date."', '".$CapsUniversal_ID_Number."', '".$CapsUniversal_ID_Issue_Date."', '".$CapsUniversal_ID_Expiration_Date."', '".$CapsDate_Of_Birth_Applicant."', '".$CapsTelephone_Type."', '".$CapsMobilePhoneNumber."', '".$CapsEMailId."', '".$CapsIncome."', '".$CapsMarital_Status."', '".$CapsEmployment_Status."', '".$CapsTime_with_Employer."', '".$CapsNumber_of_Major_Credit_Card_Held."', '".$CapsFlatNoPlotNoHouseNo."', '".$CapsBldgNoSocietyName."', '".$CapsRoadNoNameAreaLocality."', '".$CapsCity."', '".$CapsLandmark."', '".$CapsState."', '".$CapsPINCode."', '".$CapsCountry_Code."', '".$CapsAddFlatNoPlotNoHouseNo."', '".$CapsAddBldgNoSocietyName."', '".$CapsAddRoadNoNameAreaLocality."', '".$CapsAddCity."', '".$CapsAddLandmark."', '".$CapsAddState."', '".$CapsAddPINCode."', '".$CapsAddCountry_Code."'),";
	}
	
	$insertCAPS = trim($insertCAPS);
	$insertCAPS = rtrim($insertCAPS, ",");
	$insertCAPSQuery = ExecQuery($insertCAPS);
	
	
	$NonCreditCAPS = $xml->NonCreditCAPS;
	$NonCreditCAPS_Summary = $NonCreditCAPS->NonCreditCAPS_Summary;
	$NonCreditCAPSLast7Days = $NonCreditCAPS_Summary->NonCreditCAPSLast7Days;//Insert
	$NonCreditCAPSLast30Days = $NonCreditCAPS_Summary->NonCreditCAPSLast30Days;//Insert
	$NonCreditCAPSLast90Days = $NonCreditCAPS_Summary->NonCreditCAPSLast90Days;//Insert
	$NonCreditCAPSLast180Days = $NonCreditCAPS_Summary->NonCreditCAPSLast180Days;//Insert
	
	$NonCAPS_Application_Details = $NonCreditCAPS->CAPS_Application_Details;
	$NonCAPSApplicationDetails = '';
	$insertNonCAPS = '';
	$insertNonCAPS .= "insert into experian_noncaps_application_details (ReportID, NonCapsReportNumber, NonCapsEnquiry_Reason, NonCapsFinance_Purpose, NonCapsAmount_Financed, NonCapsDuration_Of_Agreement, NonCapsLast_Name, NonCapsFirst_Name, NonCapsMiddle_Name1, NonCapsMiddle_Name2, NonCapsMiddle_Name3, NonCapsGender_Code, NonCapsIncomeTaxPan, NonCapsPAN_Issue_Date, NonCapsPAN_Expiration_Date, NonCapsPassport_number, NonCapsPassport_Issue_Date, NonCapsPassport_Expiration_Date, NonCapsVoter_s_Identity_Card, NonCapsVoter_ID_Issue_Date, NonCapsVoter_ID_Expiration_Date, NonCapsDriver_License_Number, NonCapsDriver_License_Issue_Date, NonCapsDriver_License_Expiration_Date, NonCapsRation_Card_Number, NonCapsRation_Card_Issue_Date, NonCapsRation_Card_Expiration_Date, NonCapsUniversal_ID_Number, NonCapsUniversal_ID_Issue_Date, NonCapsUniversal_ID_Expiration_Date, NonCapsDate_Of_Birth_Applicant, NonCapsTelephone_Number_Applicant_1st, NonCapsTelephone_Extension, NonCapsTelephone_Type, NonCapsMobilePhoneNumber, NonCapsEMailId, NonCapsIncome, NonCapsMarital_Status, NonCapsEmployment_Status, NonCapsTime_with_Employer, NonCapsNumber_of_Major_Credit_Card_Held, NonCapsFlatNoPlotNoHouseNo, NonCapsBldgNoSocietyName, NonCapsRoadNoNameAreaLocality, NonCapsCity, NonCapsLandmark, NonCapsState, NonCapsPINCode, NonCapsCountry_Code, NonCapsAddFlatNoPlotNoHouseNo, NonCapsAddBldgNoSocietyName, NonCapsAddRoadNoNameAreaLocality, NonCapsAddCity, NonCapsAddLandmark, NonCapsAddState, NonCapsAddPINCode, NonCapsAddCountry_Code) VALUES ";
	
	for($ncaps=0;$ncaps<count($NonCAPS_Application_Details);$ncaps++)
	{
		$NonCAPSApplicationDetails = $NonCAPS_Application_Details[$ncaps];
		$NonCapsSubscriber_code = $NonCAPSApplicationDetails->Subscriber_code;//Insert
		$NonCapsSubscriber_Name = $NonCAPSApplicationDetails->Subscriber_Name;//Insert
		$NonCapsDate_of_Request = $NonCAPSApplicationDetails->Date_of_Request;//Insert
		$NonCapsReportTime = $NonCAPSApplicationDetails->ReportTime;//Insert
		$NonCapsReportNumber = $NonCAPSApplicationDetails->ReportNumber;//Insert
		$NonCapsEnquiry_Reason = $NonCAPSApplicationDetails->Enquiry_Reason;//Insert
		$NonCapsFinance_Purpose = $NonCAPSApplicationDetails->Finance_Purpose;//Insert
		$NonCapsAmount_Financed = $NonCAPSApplicationDetails->Amount_Financed;//Insert
		$NonCapsDuration_Of_Agreement = $NonCAPSApplicationDetails->Duration_Of_Agreement;//Insert
		
		$NonCaps_Applicant_Details = $NonCAPSApplicationDetails->CAPS_Applicant_Details;
		$NonCapsLast_Name = $NonCaps_Applicant_Details->Last_Name;//Insert
		$NonCapsFirst_Name = $NonCaps_Applicant_Details->First_Name;//Insert
		$NonCapsMiddle_Name1 = $NonCaps_Applicant_Details->Middle_Name1;//Insert
		$NonCapsMiddle_Name2 = $NonCaps_Applicant_Details->Middle_Name2;//Insert
		$NonCapsMiddle_Name3 = $NonCaps_Applicant_Details->Middle_Name3;//Insert 
		$NonCapsGender_Code = $NonCaps_Applicant_Details->Gender_Code;//Insert
		$NonCapsIncomeTaxPan = $NonCaps_Applicant_Details->IncomeTaxPan;//Insert
		$NonCapsPAN_Issue_Date = $NonCaps_Applicant_Details->PAN_Issue_Date;//Insert
		$NonCapsPAN_Expiration_Date = $NonCaps_Applicant_Details->PAN_Expiration_Date;//Insert
		$NonCapsPassport_number = $NonCaps_Applicant_Details->Passport_number;//Insert
		$NonCapsPassport_Issue_Date = $NonCaps_Applicant_Details->Passport_Issue_Date;//Insert
		$NonCapsPassport_Expiration_Date = $NonCaps_Applicant_Details->Passport_Expiration_Date;//Insert
		$NonCapsVoter_s_Identity_Card = $NonCaps_Applicant_Details->Voter_s_Identity_Card;//Insert
		$NonCapsVoter_ID_Issue_Date = $NonCaps_Applicant_Details->Voter_ID_Issue_Date;//Insert
		$NonCapsVoter_ID_Expiration_Date = $NonCaps_Applicant_Details->Voter_ID_Expiration_Date;//Insert
		$NonCapsDriver_License_Number = $NonCaps_Applicant_Details->Driver_License_Number;//Insert
		$NonCapsDriver_License_Issue_Date = $NonCaps_Applicant_Details->Driver_License_Issue_Date;//Insert
		$NonCapsDriver_License_Expiration_Date = $NonCaps_Applicant_Details->Driver_License_Expiration_Date;//Insert
		$NonCapsRation_Card_Number = $NonCaps_Applicant_Details->Ration_Card_Number;//Insert
		$NonCapsRation_Card_Issue_Date = $NonCaps_Applicant_Details->Ration_Card_Issue_Date;//Insert
		$NonCapsRation_Card_Expiration_Date = $NonCaps_Applicant_Details->Ration_Card_Expiration_Date;//Insert
		$NonCapsUniversal_ID_Number = $NonCaps_Applicant_Details->Universal_ID_Number;//Insert
		$NonCapsUniversal_ID_Issue_Date = $NonCaps_Applicant_Details->Universal_ID_Issue_Date;//Insert
		$NonCapsUniversal_ID_Expiration_Date = $NonCaps_Applicant_Details->Universal_ID_Expiration_Date;//Insert
		$NonCapsDate_Of_Birth_Applicant = $NonCaps_Applicant_Details->Date_Of_Birth_Applicant;//Insert
		$NonCapsTelephone_Number_Applicant_1st = $NonCaps_Applicant_Details->Telephone_Number_Applicant_1st;//Insert
		$NonCapsTelephone_Extension = $NonCaps_Applicant_Details->Telephone_Extension;//Insert
		$NonCapsTelephone_Type = $NonCaps_Applicant_Details->Telephone_Type;//Insert
		$NonCapsMobilePhoneNumber = $NonCaps_Applicant_Details->MobilePhoneNumber;//Insert
		$NonCapsEMailId = $NonCaps_Applicant_Details->EMailId;//Insert
		
		$NonCaps_Other_Details = $NonCAPSApplicationDetails->CAPS_Other_Details;
		$NonCapsIncome = $NonCaps_Other_Details->Income;//Insert
		$NonCapsMarital_Status = $NonCaps_Other_Details->Marital_Status;//Insert
		$NonCapsEmployment_Status = $NonCaps_Other_Details->Employment_Status;//Insert
		$NonCapsTime_with_Employer = $NonCaps_Other_Details->Time_with_Employer;//Insert
		$NonCapsNumber_of_Major_Credit_Card_Held = $NonCaps_Other_Details->Number_of_Major_Credit_Card_Held;//Insert
		
		$NonCaps_Applicant_Address_Details = $NonCAPSApplicationDetails->CAPS_Applicant_Address_Details;
		$NonCapsFlatNoPlotNoHouseNo = $NonCaps_Applicant_Address_Details->FlatNoPlotNoHouseNo;//Insert
		$NonCapsBldgNoSocietyName = $NonCaps_Applicant_Address_Details->BldgNoSocietyName;//Insert
		$NonCapsRoadNoNameAreaLocality = $NonCaps_Applicant_Address_Details->RoadNoNameAreaLocality;//Insert
		$NonCapsCity = $NonCaps_Applicant_Address_Details->City;//Insert
		$NonCapsLandmark = $NonCaps_Applicant_Address_Details->Landmark;//Insert
		$NonCapsState = $NonCaps_Applicant_Address_Details->State;//Insert
		$NonCapsPINCode = $NonCaps_Applicant_Address_Details->PINCode;//Insert
		$NonCapsCountry_Code = $NonCaps_Applicant_Address_Details->Country_Code;//Insert
		
		$NonCaps_Applicant_Additional_Address_Details = $NonCAPSApplicationDetails->CAPS_Applicant_Additional_Address_Details;
		$NonCapsAddFlatNoPlotNoHouseNo = $NonCaps_Applicant_Additional_Address_Details->FlatNoPlotNoHouseNo;//Insert
		$NonCapsAddBldgNoSocietyName = $NonCaps_Applicant_Additional_Address_Details->BldgNoSocietyName;//Insert
		$NonCapsAddRoadNoNameAreaLocality = $NonCaps_Applicant_Additional_Address_Details->RoadNoNameAreaLocality;//Insert
		$NonCapsAddCity = $NonCaps_Applicant_Additional_Address_Details->City;//Insert
		$NonCapsAddLandmark = $NonCaps_Applicant_Additional_Address_Details->Landmark;//Insert
		$NonCapsAddState = $NonCaps_Applicant_Additional_Address_Details->State;//Insert
		$NonCapsAddPINCode = $NonCaps_Applicant_Additional_Address_Details->PINCode;//Insert
		$NonCapsAddCountry_Code = $NonCaps_Applicant_Additional_Address_Details->Country_Code;//Insert
		$insertNonCAPS .= 	"('".$ReportID."', '".$NonCapsReportNumber."', '".$NonCapsEnquiry_Reason."', '".$NonCapsFinance_Purpose."', '".$NonCapsAmount_Financed."', '".$NonCapsDuration_Of_Agreement."', '".$NonCapsLast_Name."', '".$NonCapsFirst_Name."', '".$NonCapsMiddle_Name1."', '".$NonCapsMiddle_Name2."', '".$NonCapsMiddle_Name3."', '".$NonCapsGender_Code."', '".$NonCapsIncomeTaxPan."', '".$NonCapsPAN_Issue_Date."', '".$NonCapsPAN_Expiration_Date."', '".$NonCapsPassport_number."', '".$NonCapsPassport_Issue_Date."', '".$NonCapsPassport_Expiration_Date."', '".$NonCapsVoter_s_Identity_Card."', '".$NonCapsVoter_ID_Issue_Date."', '".$NonCapsVoter_ID_Expiration_Date."', '".$NonCapsDriver_License_Number."', '".$NonCapsDriver_License_Issue_Date."', '".$NonCapsDriver_License_Expiration_Date."', '".$NonCapsRation_Card_Number."', '".$NonCapsRation_Card_Issue_Date."', '".$NonCapsRation_Card_Expiration_Date."', '".$NonCapsUniversal_ID_Number."', '".$NonCapsUniversal_ID_Issue_Date."', '".$NonCapsUniversal_ID_Expiration_Date."', '".$NonCapsDate_Of_Birth_Applicant."', '".$NonCapsTelephone_Number_Applicant_1st."', '".$NonCapsTelephone_Extension."', '".$NonCapsTelephone_Type."', '".$NonCapsMobilePhoneNumber."', '".$NonCapsEMailId."', '".$NonCapsIncome."', '".$NonCapsMarital_Status."', '".$NonCapsEmployment_Status."', '".$NonCapsTime_with_Employer."', '".$NonCapsNumber_of_Major_Credit_Card_Held."', '".$NonCapsFlatNoPlotNoHouseNo."', '".$NonCapsBldgNoSocietyName."', '".$NonCapsRoadNoNameAreaLocality."', '".$NonCapsCity."', '".$NonCapsLandmark."', '".$NonCapsState."', '".$NonCapsPINCode."', '".$NonCapsCountry_Code."', '".$NonCapsAddFlatNoPlotNoHouseNo."', '".$NonCapsAddBldgNoSocietyName."', '".$NonCapsAddRoadNoNameAreaLocality."', '".$NonCapsAddCity."', '".$NonCapsAddLandmark."', '".$NonCapsAddState."', '".$NonCapsAddPINCode."', '".$NonCapsAddCountry_Code."'),";
	
	}
	
	$insertNonCAPS = trim($insertNonCAPS);
	$insertNonCAPS = rtrim($insertNonCAPS, ",");
	$insertNonCAPSQuery = ExecQuery($insertNonCAPS);

}
?>