<?php

$url = "https://crmesb.fullertonindia.com:9082/magicxpi4_1/MGrqispi.dll?appname=IFSCRMNext&prgname=HTTP&arguments=-ACRM%23Service";
$body = '<?xml version="1.0" encoding="utf-8"?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:api="http://www.crmnext.com/api/">
   <soapenv:Header />
   <soapenv:Body>
      <api:Save>
         <!--Optional:-->
         <api:userContext>    
          <api:IsSuccess>true</api:IsSuccess>   
          <api:Message></api:Message>   
          <api:ClientTimeOffSet>0</api:ClientTimeOffSet>    
          <api:ExpiresOn>2027-06-23T10:14:09.950117+05:30</api:ExpiresOn>   
          <api:IsUTC>false</api:IsUTC>              
          <api:Token>qjg8clqv8mjs5njd6l2s676fkp4v9ls33x27s4zxrhgvq3t8sc6yz8nxc8zwksmb65b3f5shqaf4ttqmss22xfgnqzqu5qbtzr2t8lwvh7trg9qzj4mpdgrvar2ed74d9uybzn5fx733cd5ua469m5kcpadpscrmrh4pdxuyf7jhqqzx9cmsgdz3cmf83acsmbuqry3yfm4m9ayaubnltq6b7zgg5cdblht4rgyfekg4kbtjsq8cwyvwjrxedqzactvkfjt8ylvrux2hm5nefqljkm7fm5yt3h7fyv5qna2jutx7hq9kzcptgyh2tsessuskuyecje9lc</api:Token>
        </api:userContext>  
        <api:objects>   
          <api:CRMnextObject xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="api:Lead">
            <api:EmailOptOut>false</api:EmailOptOut>
            <api:PhoneOptOut>false</api:PhoneOptOut>
            <api:PreferredChannel>Email</api:PreferredChannel>
            <api:SmsOptOut>false</api:SmsOptOut>
            <api:TerritoryName></api:TerritoryName>           
            <api:AccountID>-1</api:AccountID>
            <api:AccountKey></api:AccountKey>
            <api:Address>SUDERNAGAR NAGAR</api:Address>
            <api:AssignToCode></api:AssignToCode>
            <api:AssignToName></api:AssignToName>                                   
            <api:AssigntoKey></api:AssigntoKey>
            <api:CampaignKey>35</api:CampaignKey>
            <api:CampaignName/>
            <api:ChildAccountID>-1</api:ChildAccountID>                             
            <api:City>Jamshedpur</api:City>
            <api:Comments></api:Comments>
            <api:CompanyName>Others</api:CompanyName>
            <api:Country>India</api:Country>
            <api:CreatedBy>1</api:CreatedBy>
            <api:CreatedByCode></api:CreatedByCode>
            <api:CreatedOn>2016-12-29T03:21:30</api:CreatedOn>
            <api:CurrencyID>INR</api:CurrencyID>                              
            <api:Custom>
              <api:l_Tier>Tier 3</api:l_Tier>                           
              <api:l_AIP_Amount>140000.0</api:l_AIP_Amount>
              <api:l_AIP_Tenure>48</api:l_AIP_Tenure>
              <api:l_Applicant_Type>1</api:l_Applicant_Type>
              <api:l_DOB>19/12/83</api:l_DOB>
              <api:l_PAN>AZTPR3627A</api:l_PAN>
              <api:l_Gross_Monthly_Income>14000</api:l_Gross_Monthly_Income>
              <api:l_Gender>M</api:l_Gender>
              <api:l_MaritalStatus>1</api:l_MaritalStatus>
              <api:l_Father_First_Name></api:l_Father_First_Name>
              <api:FieldID_67>SUDERNAGAR NAGAR</api:FieldID_67>
              <api:FieldID_68></api:FieldID_68>
              <api:FieldID_69></api:FieldID_69>
              <api:l_Current_Landmark></api:l_Current_Landmark>
              <api:l_Current_Country>India</api:l_Current_Country>
              <api:l_Current_State></api:l_Current_State>
              <api:l_Current_District></api:l_Current_District>
              <api:l_Yrs_Current_Add>5</api:l_Yrs_Current_Add>
              <api:l_Type_Current_Res>OWND</api:l_Type_Current_Res>
              <api:l_Monthly_Repayment>0</api:l_Monthly_Repayment>
              <api:l_Office_Address1>SUNDARNAGAR</api:l_Office_Address1>
              <api:l_Office_Address2></api:l_Office_Address2>
              <api:l_Office_Address3></api:l_Office_Address3>
              <api:l_Office_Landmark></api:l_Office_Landmark>
              <api:l_Office_Country>India</api:l_Office_Country>
              <api:l_Office_State></api:l_Office_State>
              <api:l_Office_District></api:l_Office_District>
              <api:l_Res_Mobile_No>8809202318</api:l_Res_Mobile_No>
              <api:l_CIBIL_Score>0</api:l_CIBIL_Score>                                                      
              <api:l_Father_Last_Name></api:l_Father_Last_Name>
              <api:l_OrganizationType>2</api:l_OrganizationType>
              <api:l_Designation></api:l_Designation>
              <api:l_Net_Monthly_Income>14000</api:l_Net_Monthly_Income>
              <api:l_Customertype>14</api:l_Customertype>
              <api:l_PreferredIRR>19.99</api:l_PreferredIRR>
              <api:l_Purpose_loan></api:l_Purpose_loan>
              <api:l_Qualification>2</api:l_Qualification>
              <api:l_RequiredLoanAmt>140000</api:l_RequiredLoanAmt>
              <api:l_Appref_No></api:l_Appref_No>
              <api:l_Father_Prefix></api:l_Father_Prefix>
              <api:l_Mnths_Current_Add></api:l_Mnths_Current_Add>
              <api:l_Branch_Disposition>Interested</api:l_Branch_Disposition>
              <api:l_DL_No></api:l_DL_No>
              <api:l_Voter_No></api:l_Voter_No>
              <api:l_Passport_No></api:l_Passport_No>
              <api:l_Emp_Type>K</api:l_Emp_Type>
              <api:l_IndustryType></api:l_IndustryType>
              <api:l_Total_Work_Exp_Yrs>5</api:l_Total_Work_Exp_Yrs>
              <api:l_Company_Type_Salaried>OTHERS</api:l_Company_Type_Salaried>
              <api:l_Company_Name_salaried>Others</api:l_Company_Name_salaried>
              <api:l_Lead_Source>Online Portal</api:l_Lead_Source>
              <api:l_Lead_Sub_source>Mass Channels</api:l_Lead_Sub_source>
              <api:l_Office_STD_Code>0657</api:l_Office_STD_Code>
              <api:l_City_productwise>Jamshedpur</api:l_City_productwise>
              <api:l_CopyEmp_Type></api:l_CopyEmp_Type>
              <api:l_CopyApplicant_Type></api:l_CopyApplicant_Type>             
              <api:l_CopyProduct>PL</api:l_CopyProduct>
              <api:l_DealerUserName></api:l_DealerUserName>
              <api:l_Lead_Status_Summary>1</api:l_Lead_Status_Summary>                                          
              <api:l_Type>1</api:l_Type>
               <api:FieldID_986>0</api:FieldID_986>
               <api:l_CurrentCity></api:l_CurrentCity>
               <api:l_Currentpincode>831007</api:l_Currentpincode>
               <api:l_Office_City></api:l_Office_City>
               <api:l_OfficePincode>831007</api:l_OfficePincode>
               <api:l_OmniUpdate></api:l_OmniUpdate>
               <api:FieldID_1042>0</api:FieldID_1042>
               <api:l_Report_EmpType>1</api:l_Report_EmpType>
               <api:FieldID_1070>Tetra Media Pvt Ltd (Rupee Power)_MA039</api:FieldID_1070>
               <api:l_DocsFlag></api:l_DocsFlag>
               <api:I_Additional_Income></api:I_Additional_Income>
               <api:I_Spouse_Income>0</api:I_Spouse_Income>
               <api:FieldID_1463>0</api:FieldID_1463>
               <api:FieldID_1464>0</api:FieldID_1464>
               <api:l_Lead_Created_On>29/12/16 03:21 PM</api:l_Lead_Created_On>
               <api:FieldID_1989>1</api:FieldID_1989>
               <api:l_Doc_Chk_ApplicationForm1>55</api:l_Doc_Chk_ApplicationForm1>
               <api:l_DocChk_ApplicationForm_Status1>2</api:l_DocChk_ApplicationForm_Status1>
               <api:l_ApplicationForm_Doc_Upload1>195738</api:l_ApplicationForm_Doc_Upload1>
               <api:l_Professional_Status1>1</api:l_Professional_Status1>
               <api:l_Fin_Sub_Status_Code1></api:l_Fin_Sub_Status_Code1>
               <api:l_Lead_Status_Summary>1</api:l_Lead_Status_Summary>
              <api:l_noOfIrdBncPayPF>0</api:l_noOfIrdBncPayPF>
              <api:l_noOfSalPenCrePF>0</api:l_noOfSalPenCrePF>
              <api:l_totlNumrOfTranPF>0</api:l_totlNumrOfTranPF>
              <api:l_bankNamePF></api:l_bankNamePF>
              <api:l_durOfDataFetchPF>0</api:l_durOfDataFetchPF>
              <api:l_lstOfAllTranPF>0</api:l_lstOfAllTranPF>
              <api:l_creditTurnoverPF>0</api:l_creditTurnoverPF>
              <api:l_highestBalancePF>0</api:l_highestBalancePF>                                    
              <api:FieldID_848>0</api:FieldID_848>
              <api:FieldID_849>0</api:FieldID_849>
              <api:FieldID_850>0</api:FieldID_850>
              <api:FieldID_851>0</api:FieldID_851>
              <api:FieldID_852>0</api:FieldID_852>
              <api:FieldID_853>0</api:FieldID_853>
              <api:FieldID_854>0</api:FieldID_854>
              <api:FieldID_855>0</api:FieldID_855>
              <api:FieldID_856>0</api:FieldID_856>
              <api:FieldID_857>0</api:FieldID_857>                                    
              <api:l_accountNumberPF>0</api:l_accountNumberPF>
              <api:FieldID_859>N</api:FieldID_859>
              <api:l_isResiCpvWaived></api:l_isResiCpvWaived>
              <api:l_isOffCpvWaived></api:l_isOffCpvWaived>
              <api:l_emailVerified></api:l_emailVerified>
              <api:l_avgIncomePF>0</api:l_avgIncomePF>
              <api:l_bankBalancePF></api:l_bankBalancePF>             
              <api:l_identityPrfProvided></api:l_identityPrfProvided>
              <api:l_identityProofType></api:l_identityProofType>
              <api:l_addressPrfProvided></api:l_addressPrfProvided>
              <api:l_addressProofType></api:l_addressProofType>
              <api:l_incomeProofProvided></api:l_incomeProofProvided>
              <api:l_incomeProofType></api:l_incomeProofType>                                   
              <api:l_empntPrfProvided></api:l_empntPrfProvided>                       
              <api:l_emplentPrfType></api:l_emplentPrfType>
              <api:l_aadharProvided></api:l_aadharProvided>
              <api:FieldID_986>0</api:FieldID_986>
              <api:FieldID_1042>0</api:FieldID_1042>
              <api:I_Additional_Income></api:I_Additional_Income>
              <api:I_Spouse_Income>0</api:I_Spouse_Income>
              <api:l_Lead_Created_On>29/12/16 03:21 PM</api:l_Lead_Created_On>
              <api:l_trade_info_1>0</api:l_trade_info_1>
              <api:l_trade_info_2>0</api:l_trade_info_2>
              <api:l_trade_info_3>0</api:l_trade_info_3>
              <api:l_trade_info_5>0</api:l_trade_info_5>
              <api:l_trade_info_6>0</api:l_trade_info_6>
              <api:l_trade_info_7>0</api:l_trade_info_7>
              <api:l_trade_info_8>0</api:l_trade_info_8>                                  
              <api:l_enq_info_1>0</api:l_enq_info_1>
              <api:l_enq_info_2>0</api:l_enq_info_2>
              <api:l_enq_info_3>0</api:l_enq_info_3>
              <api:l_enq_info_4>0</api:l_enq_info_4>
              <api:l_enq_info_5>0</api:l_enq_info_5>
              <api:l_enq_info_6>0</api:l_enq_info_6>
              <api:l_enq_info_7>0</api:l_enq_info_7>
              <api:l_cust_info_1>45454</api:l_cust_info_1>
              <api:l_trade_info_10>2</api:l_trade_info_10>
              <api:l_trade_info_11>783</api:l_trade_info_11>
              <api:l_trade_info_12>0</api:l_trade_info_12>                                    
              <api:l_pt_var_1>0</api:l_pt_var_1>
              <api:l_pt_var_2>0</api:l_pt_var_2>
              <api:l_pt_var_3>0</api:l_pt_var_3>
              <api:l_pt_var_4>0</api:l_pt_var_4>
              <api:l_pt_var_5>0</api:l_pt_var_5>
              <api:l_pt_var_6>0</api:l_pt_var_6>
              <api:l_pt_var_7>0</api:l_pt_var_7>
              <api:l_pt_var_8>0</api:l_pt_var_8>
              <api:l_pt_var_9>0</api:l_pt_var_9>
              <api:l_pt_var_10>0</api:l_pt_var_10>
              <api:l_pt_var_11>0</api:l_pt_var_11>
              <api:l_pt_var_12>0</api:l_pt_var_12>
              <api:l_pt_var_13>0</api:l_pt_var_13>
              <api:l_pt_var_14>0</api:l_pt_var_14>
              <api:l_pt_var_15>0</api:l_pt_var_15>
              <api:l_pt_var_16>0</api:l_pt_var_16>
              <api:l_pt_var_17>0</api:l_pt_var_17>
              <api:l_pt_var_18>0</api:l_pt_var_18>
              <api:l_pt_var_19>0</api:l_pt_var_19>
              <api:l_pt_var_20>0</api:l_pt_var_20>
              <api:l_pt_var_21>0</api:l_pt_var_21>
              <api:l_pt_var_22>0</api:l_pt_var_22>
              <api:l_pt_var_23>0</api:l_pt_var_23>              
              <api:l_cir_Gender_Match></api:l_cir_Gender_Match>
              <api:l_cir_DOB_Match></api:l_cir_DOB_Match>
              <api:l_cir_PAN_Match></api:l_cir_PAN_Match>
              <api:l_cir_Voter_Match></api:l_cir_Voter_Match>
              <api:l_cir_UID_Match></api:l_cir_UID_Match>
              <api:l_cir_DL_Match></api:l_cir_DL_Match>
              <api:l_cir_Passport_Match></api:l_cir_Passport_Match>
              <api:l_cir_Phone1_Match></api:l_cir_Phone1_Match>
              <api:l_cir_Phone2_Match></api:l_cir_Phone2_Match>
              <api:l_cir_Phone3_Match></api:l_cir_Phone3_Match>
              <api:l_cir_Phone4_Match></api:l_cir_Phone4_Match>
              <api:l_vtr_Gender_Match></api:l_vtr_Gender_Match>
              <api:l_vtr_Gender_Match_CIR></api:l_vtr_Gender_Match_CIR>
              <api:l_pan_Value></api:l_pan_Value>
              <api:l_pan_Value_CIR></api:l_pan_Value_CIR>
              <api:l_uid_Value></api:l_uid_Value>
              <api:l_uid_ID></api:l_uid_ID>
              <api:l_uid_Address></api:l_uid_Address>
              <api:l_uid_Full_Address></api:l_uid_Full_Address>
              <api:l_uid_Value_CIR></api:l_uid_Value_CIR>                                   
              <api:l_uid_ID_CIR></api:l_uid_ID_CIR>
              <api:l_uid_Address_CIR></api:l_uid_Address_CIR>
              <api:l_uid_Full_Address_CIR></api:l_uid_Full_Address_CIR>
              <api:l_trade_info_4>0.0</api:l_trade_info_4>
              <api:l_trade_info_9>0.0</api:l_trade_info_9>
              <api:l_cir_Name_Match></api:l_cir_Name_Match>
              <api:l_cir_Address1_Match></api:l_cir_Address1_Match>
              <api:l_cir_Address2_Match></api:l_cir_Address2_Match>
              <api:l_vtr_Name_Match></api:l_vtr_Name_Match>
              <api:l_vtr_DOB_Match></api:l_vtr_DOB_Match>
              <api:l_vtr_Name_Match_CIR></api:l_vtr_Name_Match_CIR>
              <api:l_vtr_DOB_Match_CIR></api:l_vtr_DOB_Match_CIR>
              <api:l_pan_Name_Match></api:l_pan_Name_Match>
              <api:l_pan_Name_Match_CIR></api:l_pan_Name_Match_CIR>             
              <api:l_RiskStatus></api:l_RiskStatus>
              <api:l_RiskGrade>GRADEB</api:l_RiskGrade>
              <api:l_RpPowerRiskStatus>G</api:l_RpPowerRiskStatus>
              <api:l_RPCIBIL_Score>00783</api:l_RPCIBIL_Score>
              <api:l_RPConnectToken>2600931</api:l_RPConnectToken>
              <api:l_Relationship_Officer></api:l_Relationship_Officer>
              <api:l_CIBILID></api:l_CIBILID>
              <api:l_Emp_Type>K</api:l_Emp_Type>
              <api:l_Bank_Name2>LS|LS_Email|None||||p_171</api:l_Bank_Name2>
              <api:l_Salary_Credit_Mode>1</api:l_Salary_Credit_Mode>
              <api:l_Alternate_Email></api:l_Alternate_Email>
              <api:l_Office_Landline_No>33000189</api:l_Office_Landline_No>
              <api:l_EmployerName>Others</api:l_EmployerName>
            </api:Custom>                             
            <api:District/>
            <api:Email>RVK.ICA@GMAIL.COM</api:Email>
            <api:EmployeeCount/>
            <!--api:EmployeeCountKey>0</api:EmployeeCountKey-->
            <api:ExternalSLAOn>0001-01-01T00:00:00</api:ExternalSLAOn>
            <api:Fax/>
            <api:FirstName>RABINDRA</api:FirstName>
            <!--api:IndustryKey>0</api:IndustryKey-->
            <api:IndustryName></api:IndustryName>
            <api:InternalSLA>0</api:InternalSLA>
            <api:InternalSLAOn>0001-01-01T00:00:00</api:InternalSLAOn>
            <api:IsAssignmentRule>false</api:IsAssignmentRule>
            <api:IsAutoResponse>false</api:IsAutoResponse>                                        
            <api:IsChildLead>false</api:IsChildLead>
            <api:IsDedupeSearch>false</api:IsDedupeSearch>
            <api:IsInsideBHR>false</api:IsInsideBHR>
            <api:LastModifiedBy>0</api:LastModifiedBy>
            <api:LastModifiedOn>0001-01-01T00:00:00</api:LastModifiedOn>
            <api:LastName>RAY</api:LastName>
            <api:LastPrintedBy>0</api:LastPrintedBy>
            <api:LastPrintedByName/>
            <api:LastPrintedOn>0001-01-01T00:00:00</api:LastPrintedOn>
            <api:LayoutKey>2061</api:LayoutKey>
            <api:l_Professional_Status1>1</api:l_Professional_Status1>
            <api:LeadAmount>140000</api:LeadAmount>
            <api:LeadAmountDefault>0</api:LeadAmountDefault>
            <api:LeadKey></api:LeadKey>
            <api:LeadName>RABINDRA KUMAR RAY</api:LeadName>
            <api:LeadOwnerKey>1</api:LeadOwnerKey>
            <api:LeadOwnerName></api:LeadOwnerName>
            <api:LeadOwnerTypeID>0</api:LeadOwnerTypeID>
            <api:LeadParentId>0</api:LeadParentId>
            <api:LeadParentName></api:LeadParentName>
            <api:LeadRating>Warm</api:LeadRating>
            <api:LeadSource></api:LeadSource>
            <api:LeadSourceKey>0</api:LeadSourceKey>
            <api:Locality></api:Locality>
            <api:MiddleName>KUMAR</api:MiddleName>
            <api:MobilePhone>8809202318</api:MobilePhone>
            <api:ObjectUniqueId></api:ObjectUniqueId>
            <api:OfferID>0</api:OfferID>
            <api:OfferName></api:OfferName>
            <api:OfficePhone>33000189</api:OfficePhone>
            <api:OwnerCode></api:OwnerCode>
            <api:Phone></api:Phone>
            <api:PreferredChannelKey>1</api:PreferredChannelKey>
            <api:PrevAssignTo>0</api:PrevAssignTo>
            <api:PrevOwnerId>0</api:PrevOwnerId>
            <api:PreviousStageId>0</api:PreviousStageId>
            <api:PrintStatus>false</api:PrintStatus>
            <api:ProductCategory>Unsecured</api:ProductCategory>
            <api:ProductCategoryID>0</api:ProductCategoryID>
            <api:ProductCode>DPL</api:ProductCode>
            <api:ProductKey>98</api:ProductKey>
            <api:ProductName></api:ProductName>
            <api:QualifiedByKey></api:QualifiedByKey>
            <api:QualifiedOn>0001-01-01T00:00:00</api:QualifiedOn>
            <api:RatingKey>2</api:RatingKey>
            <api:SalutationKey>1</api:SalutationKey>
            <api:SalutationName>Mr.</api:SalutationName>
            <api:SecEmail></api:SecEmail>
            <api:SecMobile></api:SecMobile>
            <api:StageID>0</api:StageID>
            <api:StageName>Active</api:StageName>
            <api:State></api:State>
            <api:StatusCode></api:StatusCode>
            <api:StatusCodeDisplayText>New Lead</api:StatusCodeDisplayText>
            <api:StatusCodeInOn>0001-01-01T00:00:00</api:StatusCodeInOn>                                        
            <api:StatusCodeKey>161</api:StatusCodeKey>
            <api:StatusCodeName>Document Collected</api:StatusCodeName>
            <api:TeamID>0</api:TeamID>
            <api:TerritoryCode>1296</api:TerritoryCode>
            <api:TerritoryKey>1376</api:TerritoryKey>
            <api:Title></api:Title>
            <api:WebsiteUrl></api:WebsiteUrl>
            <api:ZipCode>831007</api:ZipCode>
            </api:CRMnextObject>
        </api:objects>  
        <api:returnObjectOnSave>true</api:returnObjectOnSave>
      </api:Save>
   </soapenv:Body>
</soapenv:Envelope>'; /// Your SOAP XML needs to be in this variable

$headers = array( 
    'Content-Type: text/xml; charset="utf-8"', 
    'Content-Length: '.strlen($body), 
    'Accept: text/xml', 
    'Cache-Control: no-cache', 
    'Pragma: no-cache', 
); 

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
//curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($ch, CURLOPT_USERAGENT, $defined_vars['HTTP_USER_AGENT']);

// Stuff I have added
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $body); 

$output = curl_exec($ch);
$curlError = curl_error($ch) ;
curl_close($ch);
if($curlError){
    echo "cURL Error #:" . $curlError;        
} else {
    var_dump($output); 
}
?>