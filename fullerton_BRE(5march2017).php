<?php
@set_time_limit(1000);

require_once ("lib/nusoap_fullerton.php");
$xmlstr='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://serviceimpl.alobr.valuemomentum.com">
   <soapenv:Header/>
   <soapenv:Body>
      <ser:invokeBRE>
         <ser:objModel><![CDATA[<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<loanContract>
<loanApplication>
<applicant>
<partyReference/>
<companyName>Mywish Marketplaces Pvt ltd</companyName>
<companyCategory>OTHERS</companyCategory>
<qualification></qualification>
<dateOfBirth>1983-05-01</dateOfBirth>
<ageInMonths>0.0</ageInMonths>
<ageInYears>0.0</ageInYears>
<ageAtMaturity>0.0</ageAtMaturity>
<incomeDetails>
<declaredGrossMonthlyIncome>75000</declaredGrossMonthlyIncome>
<minMonthlyIncome>0.0</minMonthlyIncome>
<verifiedMonthlyIncome>0.0</verifiedMonthlyIncome>
<totalMonthlyEMI>0</totalMonthlyEMI>
<totalMonthlyEMIPersonalLoans>0</totalMonthlyEMIPersonalLoans>
<grossAnnualIncome>900000</grossAnnualIncome>
<otherIncome>0.0</otherIncome>
<spouseIncome>0.0</spouseIncome>
<disposableMonthlyIncome>0.0</disposableMonthlyIncome>
<clubbedIncome>0.0</clubbedIncome>
<netAdjustedIncome>0.0</netAdjustedIncome>
<additionalIncome>0.0</additionalIncome>
<netMonthlyTakeHomeSalary>75000</netMonthlyTakeHomeSalary>
<salesTurnover>0</salesTurnover>
</incomeDetails>
<cibilBureauDetails>
<score>0.0</score>
<LIVE_UNSECURED_MUE>0.0</LIVE_UNSECURED_MUE>
<totalCardsOutstanding>0.0</totalCardsOutstanding>
<creditCard>
<overDueAmt>0.0</overDueAmt>
<writeOffAmt>0.0</writeOffAmt>
<cardVintage>0.0</cardVintage>
<outStandingAmt>0.0</outStandingAmt>
</creditCard>
<loanHistory>
<writeOffAmt>0.0</writeOffAmt>
<outStandingAmt>0.0</outStandingAmt>
<emi>0.0</emi>
<TwelveMonth30PlusDPDCount>0.0</TwelveMonth30PlusDPDCount>
<CurrentBalance>0.0</CurrentBalance>
</loanHistory>
<Total_Card_Util>0.0</Total_Card_Util>
<Total_Card_Balance>0.0</Total_Card_Balance>
<Months_Since_30DPD>0.0</Months_Since_30DPD>
<afterFICCWriteoffAmt>0.0</afterFICCWriteoffAmt>
<total_Delinquent_Trades>0.0</total_Delinquent_Trades>
<trade_info_4>0.0</trade_info_4>
<trade_info_9>0.0</trade_info_9>
<pt_var_23>0.0</pt_var_23>
<LiveCardUtil>0.0</LiveCardUtil>
<Total_PastDueBalance_SecuredTrade>0.0</Total_PastDueBalance_SecuredTrade>
<Total_Utilization_LivePL_Accounts>0.0</Total_Utilization_LivePL_Accounts>
<Unsecured_LastTrade_Opened>0.0</Unsecured_LastTrade_Opened>
<Trade_summary_1>0.0</Trade_summary_1>
<Trade_summary_2>0.0</Trade_summary_2>
<Trade_summary_3>0.0</Trade_summary_3>
</cibilBureauDetails>
<totalAddCardLiabilities>0.0</totalAddCardLiabilities>
<totalAddLoanLiabilities>0.0</totalAddLoanLiabilities>
<totalCibilLoanLiabilities>0.0</totalCibilLoanLiabilities>
<totalCibilCardLiabilities>0.0</totalCibilCardLiabilities>
<totalLiabilities>0.0</totalLiabilities>
<prevYearTotalLiabilities>0.0</prevYearTotalLiabilities>
<existingDebtBurdenServiced>0.0</existingDebtBurdenServiced>
<gender>M</gender>
<maritalStatus>1</maritalStatus>
<noOfMonthsInCurrentJob>0.0</noOfMonthsInCurrentJob>
<noOfYearsInCurrentJob>0.0</noOfYearsInCurrentJob>
<noOfYearsInPreviousJob>0.0</noOfYearsInPreviousJob>
<accomodationType>PARENTL</accomodationType>
<noOfYearsAtCurrentAddress>10</noOfYearsAtCurrentAddress>
<noOfMonthsAtCurrentAddress>0.0</noOfMonthsAtCurrentAddress>
<minYearsAtCurrentAddress>0.0</minYearsAtCurrentAddress>
<address>
<currentResidenceAddressOwnershipStatus>PARENTAL OWNED</currentResidenceAddressOwnershipStatus>
<officeAddressCity>hdjdjdj</officeAddressCity>
<currentResidenceAddressMobile>9599344050</currentResidenceAddressMobile>
<noOfMonthsCurrentResidenceAddress>0.0</noOfMonthsCurrentResidenceAddress>
<noOfYearsCurrentResidenceAddress>0.0</noOfYearsCurrentResidenceAddress>
<noOfMonthsPermanentResidenceAddress>0.0</noOfMonthsPermanentResidenceAddress>
<noOfYearsPermanentResidenceAddress>0.0</noOfYearsPermanentResidenceAddress>
<noOfMonthsOfficeAddress>0.0</noOfMonthsOfficeAddress>
<noOfYearsOfficeAddress>0.0</noOfYearsOfficeAddress>
<City>New Delhi</City>
</address>
<designation>9</designation>
<typeOfOrganization>4</typeOfOrganization>
<abb>0.0</abb>
<resiStabilityInYears>0.0</resiStabilityInYears>
<applicantType>01</applicantType>
<employmentType>K</employmentType>
<noOfDependants>0</noOfDependants>
<educationalQualification>2</educationalQualification>
<organizationType>4</organizationType>
<noOfYearsWithCurrentEmployer>10</noOfYearsWithCurrentEmployer>
<companyType>4</companyType>
<totalYearsInPresentBusiness>0.0</totalYearsInPresentBusiness>
<cibilScore>-1.0</cibilScore>
<appDate>2016-06-21</appDate>
<avgIncomePF>0.0</avgIncomePF>
<bankBalancePF>0.0</bankBalancePF>
<officeLandlineNumber>9566224220</officeLandlineNumber>
<eVerifyScore>0.0</eVerifyScore>
<cir_Name_Match>0.0</cir_Name_Match>
<cir_Address1_Match>0.0</cir_Address1_Match>
<cir_Address2_Match>0.0</cir_Address2_Match>
<vtr_Name_Match>0.0</vtr_Name_Match>
<vtr_DOB_Match>0.0</vtr_DOB_Match>
<vtr_Name_Match_CIR>0.0</vtr_Name_Match_CIR>
<vtr_DOB_Match_CIR>0.0</vtr_DOB_Match_CIR>
<pan_Name_Match>0.0</pan_Name_Match>
<pan_Name_Match_CIR>0.0</pan_Name_Match_CIR>
<costofHome>0.0</costofHome>
<costofLand>0.0</costofLand>
<costofConstruction>0.0</costofConstruction>
<marketvalueofProperty>0.0</marketvalueofProperty>
<outstandingLoanBalance>0.0</outstandingLoanBalance>
<requestedTopupLoanamount>0.0</requestedTopupLoanamount>
<variableIncome>0.0</variableIncome>
<annualIncome>0.0</annualIncome>
<emiperMonth>0.0</emiperMonth>
</applicant>
<outputVariables>
<loanAmount>0.0</loanAmount>
<rate>0.0</rate>
<procFee>0.0</procFee>
<netDisbursalAmount>0.0</netDisbursalAmount>
<stampDutyAndRegCharges>0.0</stampDutyAndRegCharges>
</outputVariables>
<loginDate>2017-02-13</loginDate>
<loanOpenDate>2016-06-21</loanOpenDate>
<appRefNo>121417</appRefNo>
<IRR>17.99</IRR>
<baseIrr>0.0</baseIrr>
<irrDifference>0.0</irrDifference>
<rateOfInterest>0.0</rateOfInterest>
<emiCFA>0.0</emiCFA>
<emiDebtBurdenRatio>0.0</emiDebtBurdenRatio>
<emiOffered>0.0</emiOffered>
<emiBasisAbb>0.0</emiBasisAbb>
<appliedTenor>36</appliedTenor>
<offeredLoanAmt>0.0</offeredLoanAmt>
<finalLoanAmt>0.0</finalLoanAmt>
<incrementalLoanAmt>0.0</incrementalLoanAmt>
<finalLoanAmtFivePercentIncr>0.0</finalLoanAmtFivePercentIncr>
<finalLoanAmtPlusFee>0.0</finalLoanAmtPlusFee>
<tier>Metro</tier>
<loanAmtApplied>0.0</loanAmtApplied>
<loanAmtBasisDbr>0.0</loanAmtBasisDbr>
<loanAmtBasisAbb>0.0</loanAmtBasisAbb>
<loanAmtBasisMultiplier>0.0</loanAmtBasisMultiplier>
<netIncomeMultiplier>0.0</netIncomeMultiplier>
<productTypeCode>FIRSTCALL</productTypeCode>
<applicantScore>0.0</applicantScore>
<maxLoanAmount>0.0</maxLoanAmount>
<minLoanAmount>0.0</minLoanAmount>
<emiOfTotalUnsecuredLoans>0.0</emiOfTotalUnsecuredLoans>
<emiOfUnsecuredLoan>0.0</emiOfUnsecuredLoan>
<emiOfTotalSecuredLoans>0.0</emiOfTotalSecuredLoans>
<emiOfSecuredLoan>0.0</emiOfSecuredLoan>
<interestObligationOfCCOrOD>0.0</interestObligationOfCCOrOD>
<totalObligation>0.0</totalObligation>
<totalExistingUnsecuredExposure>0.0</totalExistingUnsecuredExposure>
<currentPOS>0.0</currentPOS>
<DBRValue>0.0</DBRValue>
<dumyABB>0.0</dumyABB>
<requiredLoanAmount>100000.0</requiredLoanAmount>
<finalTenureRequired>48</finalTenureRequired>
<imputedPL>0.0</imputedPL>
<imputedCC>0.0</imputedCC>
<imputedHML>0.0</imputedHML>
<imputedTW>0.0</imputedTW>
<imputedCD>0.0</imputedCD>
<imputedOthers>0.0</imputedOthers>
<emiBasisCibilLiabilty>0.0</emiBasisCibilLiabilty>
<totalDeclaredEmiLiabilty>0.0</totalDeclaredEmiLiabilty>
<imputedOthersCC>0.0</imputedOthersCC>
<loanPMTNumerator>0.0</loanPMTNumerator>
<loanPMTDenominator>0.0</loanPMTDenominator>
<emiPMTDenominator>0.0</emiPMTDenominator>
<emiPMTNumerator>0.0</emiPMTNumerator>
<TIME_TAG_1>0.0</TIME_TAG_1>
<TIME_TAG_2>0.0</TIME_TAG_2>
<TIME_TAG_3>0.0</TIME_TAG_3>
<TIME_TAG_4>0.0</TIME_TAG_4>
<TIME_TAG_5>0.0</TIME_TAG_5>
<TIME_TAG_6>0.0</TIME_TAG_6>
<TIME_TAG_7>0.0</TIME_TAG_7>
<TIME_TAG_8>0.0</TIME_TAG_8>
<TIME_TAG_9>0.0</TIME_TAG_9>
<TIME_TAG_10>0.0</TIME_TAG_10>
<FF1_TAG_1>0.0</FF1_TAG_1>
<FF1_TAG_2>0.0</FF1_TAG_2>
<FF2_TAG_1>0.0</FF2_TAG_1>
<FF2_TAG_2>0.0</FF2_TAG_2>
<FF3_TAG_1>0.0</FF3_TAG_1>
<FF3_TAG_2>0.0</FF3_TAG_2>
<FF4_TAG_1>0.0</FF4_TAG_1>
<FF4_TAG_2>0.0</FF4_TAG_2>
<FF5_TAG_1>0.0</FF5_TAG_1>
<FF5_TAG_2>0.0</FF5_TAG_2>
<FF6_TAG_1>0.0</FF6_TAG_1>
<FF6_TAG_2>0.0</FF6_TAG_2>
<FF7_TAG_1>0.0</FF7_TAG_1>
<FF7_TAG_2>0.0</FF7_TAG_2>
<FF8_TAG_1>0.0</FF8_TAG_1>
<FF8_TAG_2>0.0</FF8_TAG_2>
<FF9_TAG_1>0.0</FF9_TAG_1>
<FF9_TAG_2>0.0</FF9_TAG_2>
<FF10_TAG_1>0.0</FF10_TAG_1>
<FF10_TAG_2>0.0</FF10_TAG_2>
<FF11_TAG_1>0.0</FF11_TAG_1>
<FF11_TAG_2>0.0</FF11_TAG_2>
<FF12_TAG_1>0.0</FF12_TAG_1>
<FF12_TAG_2>0.0</FF12_TAG_2>
<FF13_TAG_1>0.0</FF13_TAG_1>
<FF13_TAG_2>0.0</FF13_TAG_2>
<FF14_TAG_1>0.0</FF14_TAG_1>
<FF14_TAG_2>0.0</FF14_TAG_2>
<FF15_TAG_1>0.0</FF15_TAG_1>
<FF15_TAG_2>0.0</FF15_TAG_2>
<FF16_TAG_1>0.0</FF16_TAG_1>
<FF16_TAG_2>0.0</FF16_TAG_2>
<FF17_TAG_1>0.0</FF17_TAG_1>
<FF17_TAG_2>0.0</FF17_TAG_2>
<FF18_TAG_1>0.0</FF18_TAG_1>
<FF18_TAG_2>0.0</FF18_TAG_2>
<FF19_TAG_1>0.0</FF19_TAG_1>
<FF19_TAG_2>0.0</FF19_TAG_2>
<FF20_TAG_1>0.0</FF20_TAG_1>
<FF20_TAG_2>0.0</FF20_TAG_2>
<FF21_TAG_1>0.0</FF21_TAG_1>
<FF21_TAG_2>0.0</FF21_TAG_2>
<FF22_TAG_1>0.0</FF22_TAG_1>
<FF22_TAG_2>0.0</FF22_TAG_2>
<FF23_TAG_1>0.0</FF23_TAG_1>
<FF23_TAG_2>0.0</FF23_TAG_2>
<FF24_TAG_1>0.0</FF24_TAG_1>
<FF24_TAG_2>0.0</FF24_TAG_2>
<FF25_TAG_1>0.0</FF25_TAG_1>
<FF25_TAG_2>0.0</FF25_TAG_2>
<FF26_TAG_1>0.0</FF26_TAG_1>
<FF26_TAG_2>0.0</FF26_TAG_2>
<FF27_TAG_1>0.0</FF27_TAG_1>
<FF27_TAG_2>0.0</FF27_TAG_2>
<FF28_TAG_1>0.0</FF28_TAG_1>
<FF28_TAG_2>0.0</FF28_TAG_2>
<FF29_TAG_1>0.0</FF29_TAG_1>
<FF29_TAG_2>0.0</FF29_TAG_2>
<FF30_TAG_1>0.0</FF30_TAG_1>
<FF30_TAG_2>0.0</FF30_TAG_2>
<FF31_TAG_1>0.0</FF31_TAG_1>
<FF31_TAG_2>0.0</FF31_TAG_2>
<FF32_TAG_1>0.0</FF32_TAG_1>
<FF32_TAG_2>0.0</FF32_TAG_2>
<FF33_TAG_1>0.0</FF33_TAG_1>
<FF33_TAG_2>0.0</FF33_TAG_2>
<FF34_TAG_1>0.0</FF34_TAG_1>
<FF34_TAG_2>0.0</FF34_TAG_2>
<FF35_TAG_1>0.0</FF35_TAG_1>
<FF35_TAG_2>0.0</FF35_TAG_2>
<FF36_TAG_1>0.0</FF36_TAG_1>
<FF36_TAG_2>0.0</FF36_TAG_2>
<FF37_TAG_1>0.0</FF37_TAG_1>
<FF37_TAG_2>0.0</FF37_TAG_2>
<FF38_TAG_1>0.0</FF38_TAG_1>
<FF38_TAG_2>0.0</FF38_TAG_2>
<FF39_TAG_1>0.0</FF39_TAG_1>
<FF39_TAG_2>0.0</FF39_TAG_2>
<FF40_TAG_1>0.0</FF40_TAG_1>
<FF40_TAG_2>0.0</FF40_TAG_2>
<renovationLoan>0.0</renovationLoan>
</loanApplication>
<source>PLSALARIED</source>
<isSynchronous>YES</isSynchronous>
<randomNumber>0.0</randomNumber>
</loanContract>]]></ser:objModel>
         <ser:rawData><![CDATA[<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<CIBIL>
	<party>
		<partyreference>applicant</partyreference>
		<rawdata>
		<TransactData>
        <Application.ApplicationDate>20170601</Application.ApplicationDate>
        <Application.ApplicationTime>190710</Application.ApplicationTime>
        <Application.ClientReferenceNumber>1062017</Application.ClientReferenceNumber>
        <Application.UniqueCPlusApplicationNumber>049008802</Application.UniqueCPlusApplicationNumber>
        <Application.BureauEnquiryReferenceNumber>1062017</Application.BureauEnquiryReferenceNumber>
        <Application.StatusFlag>00</Application.StatusFlag>
        <Application.PreviousApplicationFound>N</Application.PreviousApplicationFound>
        <Application.MultipleRecordsFound>N</Application.MultipleRecordsFound>
        <ErrorBlock.ConnectPlusErrorCode></ErrorBlock.ConnectPlusErrorCode>
        <ErrorBlock.ConnectPlusErrorMessage></ErrorBlock.ConnectPlusErrorMessage>
        <ErrorBlock.BureauErrorCode></ErrorBlock.BureauErrorCode>
        <ErrorBlock.BureauErrorMessage></ErrorBlock.BureauErrorMessage>
        <Application.ResponseCode>000</Application.ResponseCode>
        <Application.BureauCalledCode>01</Application.BureauCalledCode>
        <Application.MultipleMatchFlag>N</Application.MultipleMatchFlag>
        <ControlBlock.UGTicketNumber></ControlBlock.UGTicketNumber>
        <IPA.Derogs.SPD.TotalNumberOfSPDs></IPA.Derogs.SPD.TotalNumberOfSPDs>
        <IPA.Derogs.SPD.TotalValueOfSPDs></IPA.Derogs.SPD.TotalValueOfSPDs>
        <IPA.Derogs.SPD.MonthsSinceMostRecentSPD></IPA.Derogs.SPD.MonthsSinceMostRecentSPD>
        <IPA.Derogs.MPD.TotalNumberOfMPDs></IPA.Derogs.MPD.TotalNumberOfMPDs>
        <IPA.Derogs.MPD.TotalValueOfMPDs></IPA.Derogs.MPD.TotalValueOfMPDs>
        <IPA.Derogs.MPD.MonthsSinceMostRecentMPD></IPA.Derogs.MPD.MonthsSinceMostRecentMPD>
        <IPA.Derogs.Other.TotalNumberOfOtherIPA.Derogs></IPA.Derogs.Other.TotalNumberOfOtherIPA.Derogs>
        <IPA.Derogs.Other.TotalValueOfOtherIPA.Derogs></IPA.Derogs.Other.TotalValueOfOtherIPA.Derogs>
        <IPA.Derogs.Other.MonthsSinceMostRecentOtherIPA.Derogs></IPA.Derogs.Other.MonthsSinceMostRecentOtherIPA.Derogs>
        <IPA.CADS.NonHousing.NumberOfIPA.CADS>-01</IPA.CADS.NonHousing.NumberOfIPA.CADS>
        <IPA.CADS.NonHousing.ValueOfIPA.CADS>-0000000001</IPA.CADS.NonHousing.ValueOfIPA.CADS>
        <IPA.CADS.NonHousing.MonthsSinceMostRecentCAD>9999</IPA.CADS.NonHousing.MonthsSinceMostRecentCAD>
        <IPA.CADS.Housing.NumberOfIPA.CADS>-01</IPA.CADS.Housing.NumberOfIPA.CADS>
        <IPA.CADS.Housing.ValueOfIPA.CADS>-0000000001</IPA.CADS.Housing.ValueOfIPA.CADS>
        <IPA.CADS.Housing.MonthsSinceMostRecentCAD>9999</IPA.CADS.Housing.MonthsSinceMostRecentCAD>
        <IPA.CADS.Microfinance.NumberOfIPA.CADS>-01</IPA.CADS.Microfinance.NumberOfIPA.CADS>
        <IPA.CADS.Microfinance.ValueOfIPA.CADS>-0000000001</IPA.CADS.Microfinance.ValueOfIPA.CADS>
        <IPA.CADS.Microfinance.MonthsSinceMostRecentCAD>9999</IPA.CADS.Microfinance.MonthsSinceMostRecentCAD>
        <IPA.CADS.Telco.NumberOfIPA.CADS>-01</IPA.CADS.Telco.NumberOfIPA.CADS>
        <IPA.CADS.Telco.ValueOfIPA.CADS>-0000000001</IPA.CADS.Telco.ValueOfIPA.CADS>
        <IPA.CADS.Telco.MonthsSinceMostRecentCAD>9999</IPA.CADS.Telco.MonthsSinceMostRecentCAD>
        <IPA.CADS.Retail.NumberOfIPA.CADS></IPA.CADS.Retail.NumberOfIPA.CADS>
        <IPA.CADS.Retail.ValueOfIPA.CADS></IPA.CADS.Retail.ValueOfIPA.CADS>
        <IPA.CADS.Retail.MonthsSinceMostRecentCAD></IPA.CADS.Retail.MonthsSinceMostRecentCAD>
        <IPA.CADS.TotalNumberOfIPA.CADS>-01</IPA.CADS.TotalNumberOfIPA.CADS>
        <IPA.CADS.TotalValueOfIPA.CADS>-0000000001</IPA.CADS.TotalValueOfIPA.CADS>
        <IPA.CADS.TotalMonthsSinceMostRecentCAD>9999</IPA.CADS.TotalMonthsSinceMostRecentCAD>
        <IPA.ACAS.NonHousing.NumberOfIPA.ACAS>-01</IPA.ACAS.NonHousing.NumberOfIPA.ACAS>
        <IPA.ACAS.NonHousing.BalanceOnIPA.ACAS>-0000000001</IPA.ACAS.NonHousing.BalanceOnIPA.ACAS>
        <IPA.ACAS.NonHousing.WorstCurrentDelinquencyStatusACA>-01</IPA.ACAS.NonHousing.WorstCurrentDelinquencyStatusACA>
        <IPA.ACAS.NonHousing.WorstDelinquencyStatusInThePrevious6MonthsACA>-01</IPA.ACAS.NonHousing.WorstDelinquencyStatusInThePrevious6MonthsACA>
        <IPA.ACAS.NonHousing.WorstDelinquencyStatusInThePrevious7-12MonthsACA>-01</IPA.ACAS.NonHousing.WorstDelinquencyStatusInThePrevious7-12MonthsACA>
        <IPA.ACAS.NonHousing.AgeOfOldestACA>9999</IPA.ACAS.NonHousing.AgeOfOldestACA>
        <IPA.ACAS.NonHousing.HighestCurrentBalanceToLimitPercentage-RevolvingIPA.ACAS>-001</IPA.ACAS.NonHousing.HighestCurrentBalanceToLimitPercentage-RevolvingIPA.ACAS>
        <IPA.ACAS.NonHousing.TotalCurrentBalanceToLimitPercentage-RevolvingIPA.ACAS>-001</IPA.ACAS.NonHousing.TotalCurrentBalanceToLimitPercentage-RevolvingIPA.ACAS>
        <IPA.ACAS.Housing.NumberOfIPA.ACAS>-01</IPA.ACAS.Housing.NumberOfIPA.ACAS>
        <IPA.ACAS.Housing.BalanceOnIPA.ACAS>-0000000001</IPA.ACAS.Housing.BalanceOnIPA.ACAS>
        <IPA.ACAS.Housing.WorstCurrentDelinquencyStatusACA>-01</IPA.ACAS.Housing.WorstCurrentDelinquencyStatusACA>
        <IPA.ACAS.Housing.WorstDelinquencyStatusInThePrevious6MonthsACA>-01</IPA.ACAS.Housing.WorstDelinquencyStatusInThePrevious6MonthsACA>
        <IPA.ACAS.Housing.WorstDelinquencyStatusInThePrevious7-12MonthsACA>-01</IPA.ACAS.Housing.WorstDelinquencyStatusInThePrevious7-12MonthsACA>
        <IPA.ACAS.Housing.AgeofoldestACA>9999</IPA.ACAS.Housing.AgeofoldestACA>
        <IPA.ACAS.Microfinance.NumberofIPA.ACAS>-01</IPA.ACAS.Microfinance.NumberofIPA.ACAS>
        <IPA.ACAS.Microfinance.BalanceonIPA.ACAS>-0000000001</IPA.ACAS.Microfinance.BalanceonIPA.ACAS>
        <IPA.ACAS.Microfinance.WorstCurrentDelinquencyStatusACA>-01</IPA.ACAS.Microfinance.WorstCurrentDelinquencyStatusACA>
        <IPA.ACAS.Microfinance.WorstDelinquencyStatusInThePrevious6MonthsACA>-01</IPA.ACAS.Microfinance.WorstDelinquencyStatusInThePrevious6MonthsACA>
        <IPA.ACAS.Microfinance.WorstDelinquencyStatusInThePrevious7-12MonthsACA>-01</IPA.ACAS.Microfinance.WorstDelinquencyStatusInThePrevious7-12MonthsACA>
        <IPA.ACAS.Microfinance.AgeOfOldestACA>9999</IPA.ACAS.Microfinance.AgeOfOldestACA>
        <IPA.ACAS.Retail.NumberOfIPA.ACAS></IPA.ACAS.Retail.NumberOfIPA.ACAS>
        <IPA.ACAS.Retail.BalanceOnIPA.ACAS></IPA.ACAS.Retail.BalanceOnIPA.ACAS>
        <IPA.ACAS.Retail.WorstCurrentDelinquencyStatusACA></IPA.ACAS.Retail.WorstCurrentDelinquencyStatusACA>
        <IPA.ACAS.Retail.WorstDelinquencyStatusInThePrevious6MonthsACA></IPA.ACAS.Retail.WorstDelinquencyStatusInThePrevious6MonthsACA>
        <IPA.ACAS.Retail.WorstDelinquencyDtatusInThePrevious7-12MonthsACA></IPA.ACAS.Retail.WorstDelinquencyDtatusInThePrevious7-12MonthsACA>
        <IPA.ACAS.Retail.AgeofoldestACA></IPA.ACAS.Retail.AgeofoldestACA>
        <IPA.ACAS.Telco.NumberOfIPA.ACAS>-01</IPA.ACAS.Telco.NumberOfIPA.ACAS>
        <IPA.ACAS.Telco.BalanceOnIPA.ACAS>-0000000001</IPA.ACAS.Telco.BalanceOnIPA.ACAS>
        <IPA.ACAS.Telco.WorstCurrentDelinquencyStatusACA>-01</IPA.ACAS.Telco.WorstCurrentDelinquencyStatusACA>
        <IPA.ACAS.Telco.WorstDelinquencyStatusInThePrevious6MonthsACA>-01</IPA.ACAS.Telco.WorstDelinquencyStatusInThePrevious6MonthsACA>
        <IPA.ACAS.Telco.WorstDelinquencyStatusInThePrevious7-12MonthsACA>-01</IPA.ACAS.Telco.WorstDelinquencyStatusInThePrevious7-12MonthsACA>
        <IPA.ACAS.Telco.AgeofoldestACA>9999</IPA.ACAS.Telco.AgeofoldestACA>
        <IPA.ACAS.TotalNumberOfIPA.ACAS>-01</IPA.ACAS.TotalNumberOfIPA.ACAS>
        <IPA.ACAS.TotalWorstCurrentDelinquencyStatusACA>-01</IPA.ACAS.TotalWorstCurrentDelinquencyStatusACA>
        <IPA.ACAS.TotalWorstDelinquencyStatusInThePrevious6monthsACA>-01</IPA.ACAS.TotalWorstDelinquencyStatusInThePrevious6monthsACA>
        <IPA.ACAS.TotalWorstDelinquencyStatusInThePrevious7-12monthsACA>-01</IPA.ACAS.TotalWorstDelinquencyStatusInThePrevious7-12monthsACA>
        <IPA.ACAS.TotalAgeofoldestACA>9999</IPA.ACAS.TotalAgeofoldestACA>
        <IPA.ICAS.NonHousing.NumberOfNon-DelinquentIPA.ICAS>-01</IPA.ICAS.NonHousing.NumberOfNon-DelinquentIPA.ICAS>
        <IPA.ICAS.NonHousing.NumberOfDelinquentIPA.ICAS>-01</IPA.ICAS.NonHousing.NumberOfDelinquentIPA.ICAS>
        <IPA.ICAS.Housing.NumberOfNon-DelinquentIPA.ICAS>-01</IPA.ICAS.Housing.NumberOfNon-DelinquentIPA.ICAS>
        <IPA.ICAS.Housing.NumberOfDelinquentIPA.ICAS>-01</IPA.ICAS.Housing.NumberOfDelinquentIPA.ICAS>
        <IPA.ICAS.Telco.NumberOfNon-DelinquentIPA.ICAS>-01</IPA.ICAS.Telco.NumberOfNon-DelinquentIPA.ICAS>
        <IPA.ICAS.Telco.NumberOfDelinquentIPA.ICAS>-01</IPA.ICAS.Telco.NumberOfDelinquentIPA.ICAS>
        <IPA.ICAS.Microfinance.NumberOfNon-DelinquentIPA.ICAS>-01</IPA.ICAS.Microfinance.NumberOfNon-DelinquentIPA.ICAS>
        <IPA.ICAS.Microfinance.NumberOfDelinquentIPA.ICAS>-01</IPA.ICAS.Microfinance.NumberOfDelinquentIPA.ICAS>
        <IPA.ICAS.Retail.NumberOfNon-DelinquentIPA.ICAS></IPA.ICAS.Retail.NumberOfNon-DelinquentIPA.ICAS>
        <IPA.ICAS.Retail.NumberOfDelinquentIPA.ICAS></IPA.ICAS.Retail.NumberOfDelinquentIPA.ICAS>
        <IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast24hours>000</IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast24hours>
        <IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast7days>000</IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast7days>
        <IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast30days>001</IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast30days>
        <IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast90days>001</IPA.CAPS.TotalNumberOfIPA.CAPSInTheLast90days>
        <IPA.CAPS.TotalNumberofIPA.CAPSInTheLast180days>001</IPA.CAPS.TotalNumberofIPA.CAPSInTheLast180days>
        <IPA.CAPS.TelcoIPA.CAPSinthelast90days>000</IPA.CAPS.TelcoIPA.CAPSinthelast90days>
        <IPA.CAPS.MicrofinanceIPA.CAPSinthelast90days>000</IPA.CAPS.MicrofinanceIPA.CAPSinthelast90days>
        <IPA.CAPS.RetailIPA.CAPSinthelast90days></IPA.CAPS.RetailIPA.CAPSinthelast90days>
        <IPA.OwnGroup.CADS.NumberofIPA.OwnGroupCADs>-01</IPA.OwnGroup.CADS.NumberofIPA.OwnGroupCADs>
        <IPA.OwnGroup.CADS.ValueofIPA.OwnGroupCADs>-0000000001</IPA.OwnGroup.CADS.ValueofIPA.OwnGroupCADs>
        <IPA.OwnGroup.CADS.MonthsSinceMostRecentIPA.OwnGroupCAD>9999</IPA.OwnGroup.CADS.MonthsSinceMostRecentIPA.OwnGroupCAD>
        <IPA.OwnGroup.ACAS.NumberofIPA.OwnGroupACAs>-01</IPA.OwnGroup.ACAS.NumberofIPA.OwnGroupACAs>
        <IPA.OwnGroup.ACAS.NonHousingBalanceonIPA.OwnGroupACAs>-0000000001</IPA.OwnGroup.ACAS.NonHousingBalanceonIPA.OwnGroupACAs>
        <IPA.OwnGroup.ACAS.HousingBalanceonIPA.OwnGroupACAs>-0000000001</IPA.OwnGroup.ACAS.HousingBalanceonIPA.OwnGroupACAs>
        <IPA.OwnGroup.ACAS.WorstCurrentDelinquencyStatusForIPA.OwnGroupACAs>-01</IPA.OwnGroup.ACAS.WorstCurrentDelinquencyStatusForIPA.OwnGroupACAs>
        <IPA.OwnGroup.ICAS.NumberOfNon-DelinquentIPA.OwnGroupICAs>-01</IPA.OwnGroup.ICAS.NumberOfNon-DelinquentIPA.OwnGroupICAs>
        <IPA.OwnGroup.ICAS.NumberOfDelinquentIPA.OwnGroupICAs>-01</IPA.OwnGroup.ICAS.NumberOfDelinquentIPA.OwnGroupICAs>
        <IPA.OwnGroup.ICAS.NumberofIPA.OwnGroupCAPsinthelast90days>001</IPA.OwnGroup.ICAS.NumberofIPA.OwnGroupCAPsinthelast90days>
        <IPA.OwnGroup.ICAS.HighestCurrentBalanceToLimitPercentage-RevolvingACAs>-001</IPA.OwnGroup.ICAS.HighestCurrentBalanceToLimitPercentage-RevolvingACAs>
        <IPA.ACAS.Retail.HighestCurBaltoLimitPercentageRevACA></IPA.ACAS.Retail.HighestCurBaltoLimitPercentageRevACA>
        <IPA.ACAS.Retail.TotalCurBaltoLimitPercentageRevACA></IPA.ACAS.Retail.TotalCurBaltoLimitPercentageRevACA>
        <IPA.ACAS.TotalBalanceACASExcludingHomeLoans>-0000000001</IPA.ACAS.TotalBalanceACASExcludingHomeLoans>
        <IPA.CAPS.BanksLeasingFH.CAPSinthelast90days>001</IPA.CAPS.BanksLeasingFH.CAPSinthelast90days>
        <IPA.OtherCBInfo.AnyRelevantCBDataInDispute>X</IPA.OtherCBInfo.AnyRelevantCBDataInDispute>
        <IPA.OtherCBInfo.OtherCBDataFoundConstitutingMatch></IPA.OtherCBInfo.OtherCBDataFoundConstitutingMatch>
        <Authentication.LocalAuthenicationscore1></Authentication.LocalAuthenicationscore1>
        <Authentication.LocalAuthenicationscore2></Authentication.LocalAuthenicationscore2>
        <Authentication.LocalAuthenicationscore3></Authentication.LocalAuthenicationscore3>
        <Authentication.LocalAuthenicationscore4></Authentication.LocalAuthenicationscore4>
        <Authentication.GlobalAuthenicationscore1></Authentication.GlobalAuthenicationscore1>
        <Authentication.GlobalAuthenicationscore2></Authentication.GlobalAuthenicationscore2>
        <Authentication.GlobalAuthenicationscore3></Authentication.GlobalAuthenicationscore3>
        <Authentication.GlobalAuthenicationscore4></Authentication.GlobalAuthenicationscore4>
        <Authentication.NumberPrimaryDataItemsIDCurrentAddress></Authentication.NumberPrimaryDataItemsIDCurrentAddress>
        <Authentication.NumberPrimaryDataSourcesIDCurrentAddress></Authentication.NumberPrimaryDataSourcesIDCurrentAddress>
        <Authentication.OldestPrimaryDataItemIDCurrentAddress></Authentication.OldestPrimaryDataItemIDCurrentAddress>
        <Authentication.NumberSecondaryDataItemsIDCurrentAddress></Authentication.NumberSecondaryDataItemsIDCurrentAddress>
        <Authentication.NumberSecondaryDataSourcesIDCurrentAddress></Authentication.NumberSecondaryDataSourcesIDCurrentAddress>
        <Authentication.OldestSecondaryDataItemIDCurrentAddress></Authentication.OldestSecondaryDataItemIDCurrentAddress>
        <Authentication.NumberPrimaryDataItemsAddressOnlyCurrent></Authentication.NumberPrimaryDataItemsAddressOnlyCurrent>
        <Authentication.NumberPrimaryDataSourcesAddressOnlyCurrent></Authentication.NumberPrimaryDataSourcesAddressOnlyCurrent>
        <Authentication.OldestPrimaryDataItemAddressOnlyCurrent></Authentication.OldestPrimaryDataItemAddressOnlyCurrent>
        <Authentication.NumberSecondaryDataItemsAddressOnlyCurrent></Authentication.NumberSecondaryDataItemsAddressOnlyCurrent>
        <Authentication.NumberSecondaryDataSourcesAddressOnlyCurrent></Authentication.NumberSecondaryDataSourcesAddressOnlyCurrent>
        <Authentication.OldestSecondaryDataItemAddressOnlyCurrent></Authentication.OldestSecondaryDataItemAddressOnlyCurrent>
        <Authentication.NumberPrimaryDataItemsIDAddressPrevious></Authentication.NumberPrimaryDataItemsIDAddressPrevious>
        <Authentication.NumberPrimaryDataSourcesIDAddressPrevious></Authentication.NumberPrimaryDataSourcesIDAddressPrevious>
        <Authentication.OldestPrimaryDataItemIDAddressPrevious></Authentication.OldestPrimaryDataItemIDAddressPrevious>
        <Authentication.NumberSecondaryDataItemsIDAddressPrevious></Authentication.NumberSecondaryDataItemsIDAddressPrevious>
        <Authentication.NumberSecondaryDataSourcesIDAddressPrevious></Authentication.NumberSecondaryDataSourcesIDAddressPrevious>
        <Authentication.OldestSecondaryDataItemIDAddressPrevious></Authentication.OldestSecondaryDataItemIDAddressPrevious>
        <Authentication.NumberPrimaryDataItemsAddressOnlyPrevious></Authentication.NumberPrimaryDataItemsAddressOnlyPrevious>
        <Authentication.NumberPrimaryDataSourcesAddressOnlyPrevious></Authentication.NumberPrimaryDataSourcesAddressOnlyPrevious>
        <Authentication.OldestPrimaryDataItemAddressOnlyPrevious></Authentication.OldestPrimaryDataItemAddressOnlyPrevious>
        <Authentication.NumberSecondaryDataItemsAddressOnlyPrevious></Authentication.NumberSecondaryDataItemsAddressOnlyPrevious>
        <Authentication.NumberSecondaryDataSourcesAddressOnlyPrevious></Authentication.NumberSecondaryDataSourcesAddressOnlyPrevious>
        <Authentication.OldestSecondaryDataItemAddressOnlyPrevious></Authentication.OldestSecondaryDataItemAddressOnlyPrevious>
        <Authentication.AgeMatchPrimary></Authentication.AgeMatchPrimary>
        <Authentication.AgeMatchSecondary></Authentication.AgeMatchSecondary>
        <Authentication.TimeAtCurrentMatchPrimary></Authentication.TimeAtCurrentMatchPrimary>
        <Authentication.TimeAtCurrentMatchSecondary></Authentication.TimeAtCurrentMatchSecondary>
        <Authentication.Decision></Authentication.Decision>
        <Authentication.DecisionText></Authentication.DecisionText>
        <Authentication.AuthenticationIndex></Authentication.AuthenticationIndex>
        <Authentication.AuthenticationIndexText></Authentication.AuthenticationIndexText>
        <Authentication.IDConfirmedLevel></Authentication.IDConfirmedLevel>
        <Authentication.IDConfirmedLevelText></Authentication.IDConfirmedLevelText>
        <Authentication.NumberOfHighRiskPolicyRules></Authentication.NumberOfHighRiskPolicyRules>
        <Authentication.CifasReference></Authentication.CifasReference>
        <Authentication.HighRiskPolicyRuleID></Authentication.HighRiskPolicyRuleID>
        <Authentication.HighRiskPolicyText></Authentication.HighRiskPolicyText>
        <Authentication.UIDTelephoneValid></Authentication.UIDTelephoneValid>
        <Authentication.UIDAddressValid></Authentication.UIDAddressValid>
        <Authentication.UIDDrivingLicenceValid></Authentication.UIDDrivingLicenceValid>
        <Authentication.UIDPassportValid></Authentication.UIDPassportValid>
        <Authentication.IDConfirmationlevel></Authentication.IDConfirmationlevel>
        <Authentication.IDConfirmationText></Authentication.IDConfirmationText>
        <Authentication.IDDecisionLevel></Authentication.IDDecisionLevel>
        <Authentication.IDDecisionText></Authentication.IDDecisionText>
        <Sanctions.PoliticallyExposedPersons></Sanctions.PoliticallyExposedPersons>
        <Sanctions.SpeciallyDesignatedNationals></Sanctions.SpeciallyDesignatedNationals>
        <Sanctions.UNEUSanctionsList></Sanctions.UNEUSanctionsList>
        <Sanctions.BOEPrivateList></Sanctions.BOEPrivateList>
        <Sanctions.USTreasuryList></Sanctions.USTreasuryList>
        <Sanctions.ProhibitionBOEList></Sanctions.ProhibitionBOEList>
        <Sanctions.ProhibitionSDNList></Sanctions.ProhibitionSDNList>
        <Fraud.LocalFraudScore1></Fraud.LocalFraudScore1>
        <Fraud.LocalFraudScore2></Fraud.LocalFraudScore2>
        <Fraud.GlobalFraudScore1></Fraud.GlobalFraudScore1>
        <Fraud.GlobalFraudScore2></Fraud.GlobalFraudScore2>
        <Fraud.FraudIndexID></Fraud.FraudIndexID>
        <Fraud.IndexText></Fraud.IndexText>
        <Fraud.Decisionlevel></Fraud.Decisionlevel>
        <Fraud.DecisionText></Fraud.DecisionText>
        <Fraud.BustOutScore></Fraud.BustOutScore>
        <Hunter.NumberRulesFired></Hunter.NumberRulesFired>
        <Hunter.VolumeRulesFired></Hunter.VolumeRulesFired>
        <Hunter.RuleID></Hunter.RuleID>
        <Hunter.RuleScore></Hunter.RuleScore>
        <Hunter.NumberMatchschemesFired></Hunter.NumberMatchschemesFired>
        <Hunter.MatchschemeID></Hunter.MatchschemeID>
        <Hunter.MatchschemeScore></Hunter.MatchschemeScore>
        <Hunter.TotalMatchScore></Hunter.TotalMatchScore>
        <Hunter.FraudRingAlert></Hunter.FraudRingAlert>
        <Hunter.FraudRingWarning></Hunter.FraudRingWarning>
        <Hunter.Message1></Hunter.Message1>
        <Hunter.Message2></Hunter.Message2>
        <Hunter.Message3></Hunter.Message3>
        <Hunter.Message4></Hunter.Message4>
        <Hunter.Message5></Hunter.Message5>
        <OtherValueAdded.DateVar1></OtherValueAdded.DateVar1>
        <OtherValueAdded.DateVar2></OtherValueAdded.DateVar2>
        <OtherValueAdded.DateVar3></OtherValueAdded.DateVar3>
        <OtherValueAdded.DateVar4></OtherValueAdded.DateVar4>
        <OtherValueAdded.DateVar5></OtherValueAdded.DateVar5>
        <OtherValueAdded.DateVar6></OtherValueAdded.DateVar6>
        <OtherValueAdded.DateVar7></OtherValueAdded.DateVar7>
        <OtherValueAdded.DateVar8></OtherValueAdded.DateVar8>
        <OtherValueAdded.DateVar9></OtherValueAdded.DateVar9>
        <OtherValueAdded.DateVar10></OtherValueAdded.DateVar10>
        <OtherValueAdded.DateVar11></OtherValueAdded.DateVar11>
        <OtherValueAdded.DateVar12></OtherValueAdded.DateVar12>
        <OtherValueAdded.DateVar13></OtherValueAdded.DateVar13>
        <OtherValueAdded.DateVar14></OtherValueAdded.DateVar14>
        <OtherValueAdded.DateVar15></OtherValueAdded.DateVar15>
        <OtherValueAdded.NumericVar1></OtherValueAdded.NumericVar1>
        <OtherValueAdded.NumericVar2></OtherValueAdded.NumericVar2>
        <OtherValueAdded.NumericVar3></OtherValueAdded.NumericVar3>
        <OtherValueAdded.NumericVar4></OtherValueAdded.NumericVar4>
        <OtherValueAdded.NumericVar5></OtherValueAdded.NumericVar5>
        <OtherValueAdded.NumericVar6></OtherValueAdded.NumericVar6>
        <OtherValueAdded.NumericVar7></OtherValueAdded.NumericVar7>
        <OtherValueAdded.NumericVar8></OtherValueAdded.NumericVar8>
        <OtherValueAdded.NumericVar9></OtherValueAdded.NumericVar9>
        <OtherValueAdded.NumericVar10></OtherValueAdded.NumericVar10>
        <OtherValueAdded.NumericVar11></OtherValueAdded.NumericVar11>
        <OtherValueAdded.NumericVar12></OtherValueAdded.NumericVar12>
        <OtherValueAdded.NumericVar13></OtherValueAdded.NumericVar13>
        <OtherValueAdded.NumericVar14></OtherValueAdded.NumericVar14>
        <OtherValueAdded.NumericVar15></OtherValueAdded.NumericVar15>
        <OtherValueAdded.NumericVar16></OtherValueAdded.NumericVar16>
        <OtherValueAdded.NumericVar17></OtherValueAdded.NumericVar17>
        <OtherValueAdded.NumericVar18></OtherValueAdded.NumericVar18>
        <OtherValueAdded.NumericVar19></OtherValueAdded.NumericVar19>
        <OtherValueAdded.NumericVar20></OtherValueAdded.NumericVar20>
        <OtherValueAdded.NumericVar21></OtherValueAdded.NumericVar21>
        <OtherValueAdded.NumericVar22></OtherValueAdded.NumericVar22>
        <OtherValueAdded.NumericVar23></OtherValueAdded.NumericVar23>
        <OtherValueAdded.NumericVar24></OtherValueAdded.NumericVar24>
        <OtherValueAdded.NumericVar25></OtherValueAdded.NumericVar25>
        <OtherValueAdded.NumericVar26>-00000000000001</OtherValueAdded.NumericVar26>
        <OtherValueAdded.NumericVar27>-00000000000001</OtherValueAdded.NumericVar27>
        <OtherValueAdded.NumericVar28>-00000000000001</OtherValueAdded.NumericVar28>
        <OtherValueAdded.NumericVar29>-00000000000001</OtherValueAdded.NumericVar29>
        <OtherValueAdded.NumericVar30>-00000000000001</OtherValueAdded.NumericVar30>
        <OtherValueAdded.NumericVar31>-0000000000000000001</OtherValueAdded.NumericVar31>
        <OtherValueAdded.NumericVar32>-0000000000000000001</OtherValueAdded.NumericVar32>
        <OtherValueAdded.NumericVar33>-0000000000000000001</OtherValueAdded.NumericVar33>
        <OtherValueAdded.NumericVar34>-0000000000000000001</OtherValueAdded.NumericVar34>
        <OtherValueAdded.NumericVar35>-0000000000000000001</OtherValueAdded.NumericVar35>
        <OtherValueAdded.StringVar1></OtherValueAdded.StringVar1>
        <OtherValueAdded.StringVar2></OtherValueAdded.StringVar2>
        <OtherValueAdded.StringVar3></OtherValueAdded.StringVar3>
        <OtherValueAdded.StringVar4></OtherValueAdded.StringVar4>
        <OtherValueAdded.StringVar5></OtherValueAdded.StringVar5>
        <OtherValueAdded.StringVar6>-1</OtherValueAdded.StringVar6>
        <OtherValueAdded.StringVar7></OtherValueAdded.StringVar7>
        <OtherValueAdded.StringVar8></OtherValueAdded.StringVar8>
        <OtherValueAdded.StringVar9></OtherValueAdded.StringVar9>
        <OtherValueAdded.StringVar10></OtherValueAdded.StringVar10>
        <OtherValueAdded.StringVar11></OtherValueAdded.StringVar11>
        <OtherValueAdded.StringVar12></OtherValueAdded.StringVar12>
        <OtherValueAdded.StringVar13></OtherValueAdded.StringVar13>
        <OtherValueAdded.StringVar14></OtherValueAdded.StringVar14>
        <OtherValueAdded.StringVar15></OtherValueAdded.StringVar15>
        <OtherValueAdded.StringVar16></OtherValueAdded.StringVar16>
        <OtherValueAdded.StringVar17></OtherValueAdded.StringVar17>
        <OtherValueAdded.StringVar18></OtherValueAdded.StringVar18>
        <OtherValueAdded.StringVar19></OtherValueAdded.StringVar19>
        <OtherValueAdded.StringVar20></OtherValueAdded.StringVar20>
        <OtherValueAdded.StringVar21></OtherValueAdded.StringVar21>
        <OtherValueAdded.StringVar22></OtherValueAdded.StringVar22>
        <OtherValueAdded.StringVar23></OtherValueAdded.StringVar23>
        <OtherValueAdded.StringVar24></OtherValueAdded.StringVar24>
        <OtherValueAdded.StringVar25></OtherValueAdded.StringVar25>
        <OtherValueAdded.StringVar26></OtherValueAdded.StringVar26>
        <OtherValueAdded.StringVar27></OtherValueAdded.StringVar27>
        <OtherValueAdded.StringVar28></OtherValueAdded.StringVar28>
        <OtherValueAdded.StringVar29></OtherValueAdded.StringVar29>
        <OtherValueAdded.StringVar30></OtherValueAdded.StringVar30>
        <OtherValueAdded.StringVar31></OtherValueAdded.StringVar31>
        <OtherValueAdded.StringVar32></OtherValueAdded.StringVar32>
        <OtherValueAdded.StringVar33></OtherValueAdded.StringVar33>
        <OtherValueAdded.StringVar34></OtherValueAdded.StringVar34>
        <OtherValueAdded.StringVar35></OtherValueAdded.StringVar35>
        <ClientSpecific.NumericSL3Var1>-09</ClientSpecific.NumericSL3Var1>
        <ClientSpecific.NumericSL3Var2>-09</ClientSpecific.NumericSL3Var2>
        <ClientSpecific.NumericSL3Var3>-09</ClientSpecific.NumericSL3Var3>
        <ClientSpecific.NumericSL3Var4>-09</ClientSpecific.NumericSL3Var4>
        <ClientSpecific.NumericSL3Var5>-09</ClientSpecific.NumericSL3Var5>
        <ClientSpecific.NumericSL3Var6>-09</ClientSpecific.NumericSL3Var6>
        <ClientSpecific.NumericSL3Var7>-09</ClientSpecific.NumericSL3Var7>
        <ClientSpecific.NumericSL3Var8>-09</ClientSpecific.NumericSL3Var8>
        <ClientSpecific.NumericSL3Var9>-09</ClientSpecific.NumericSL3Var9>
        <ClientSpecific.NumericSL3Var10>-09</ClientSpecific.NumericSL3Var10>
        <ClientSpecific.NumericSL3Var11>-09</ClientSpecific.NumericSL3Var11>
        <ClientSpecific.NumericSL3Var12>-09</ClientSpecific.NumericSL3Var12>
        <ClientSpecific.NumericSL3Var13>-09</ClientSpecific.NumericSL3Var13>
        <ClientSpecific.NumericSL3Var14>-09</ClientSpecific.NumericSL3Var14>
        <ClientSpecific.NumericSL3Var15>-09</ClientSpecific.NumericSL3Var15>
        <ClientSpecific.NumericSL3Var16>-09</ClientSpecific.NumericSL3Var16>
        <ClientSpecific.NumericSL3Var17>-09</ClientSpecific.NumericSL3Var17>
        <ClientSpecific.NumericSL3Var18>-09</ClientSpecific.NumericSL3Var18>
        <ClientSpecific.NumericSL3Var19>-09</ClientSpecific.NumericSL3Var19>
        <ClientSpecific.NumericSL3Var20>-09</ClientSpecific.NumericSL3Var20>
        <ClientSpecific.NumericSL3Var21>-09</ClientSpecific.NumericSL3Var21>
        <ClientSpecific.NumericSL3Var22>-09</ClientSpecific.NumericSL3Var22>
        <ClientSpecific.NumericSL3Var23>-09</ClientSpecific.NumericSL3Var23>
        <ClientSpecific.NumericSL3Var24>-09</ClientSpecific.NumericSL3Var24>
        <ClientSpecific.NumericSL3Var25>-09</ClientSpecific.NumericSL3Var25>
        <ClientSpecific.NumericSL3Var26>-09</ClientSpecific.NumericSL3Var26>
        <ClientSpecific.NumericSL3Var27>-09</ClientSpecific.NumericSL3Var27>
        <ClientSpecific.NumericSL3Var28>-09</ClientSpecific.NumericSL3Var28>
        <ClientSpecific.NumericSL3Var29>-09</ClientSpecific.NumericSL3Var29>
        <ClientSpecific.NumericSL3Var30>-09</ClientSpecific.NumericSL3Var30>
        <ClientSpecific.NumericSL3Var31>-09</ClientSpecific.NumericSL3Var31>
        <ClientSpecific.NumericSL3Var32>-09</ClientSpecific.NumericSL3Var32>
        <ClientSpecific.NumericSL3Var33>-09</ClientSpecific.NumericSL3Var33>
        <ClientSpecific.NumericSL3Var34>-09</ClientSpecific.NumericSL3Var34>
        <ClientSpecific.NumericSL3Var35>-09</ClientSpecific.NumericSL3Var35>
        <ClientSpecific.NumericSL3Var36>-09</ClientSpecific.NumericSL3Var36>
        <ClientSpecific.NumericSL3Var37>-09</ClientSpecific.NumericSL3Var37>
        <ClientSpecific.NumericSL3Var38>-09</ClientSpecific.NumericSL3Var38>
        <ClientSpecific.NumericSL3Var39>-09</ClientSpecific.NumericSL3Var39>
        <ClientSpecific.NumericSL3Var40>-09</ClientSpecific.NumericSL3Var40>
        <ClientSpecific.NumericSL3Var41>-09</ClientSpecific.NumericSL3Var41>
        <ClientSpecific.NumericSL3Var42>-09</ClientSpecific.NumericSL3Var42>
        <ClientSpecific.NumericSL3Var43>-09</ClientSpecific.NumericSL3Var43>
        <ClientSpecific.NumericSL3Var44>-09</ClientSpecific.NumericSL3Var44>
        <ClientSpecific.NumericSL3Var45>-09</ClientSpecific.NumericSL3Var45>
        <ClientSpecific.NumericSL3Var46>-09</ClientSpecific.NumericSL3Var46>
        <ClientSpecific.NumericSL3Var47>-09</ClientSpecific.NumericSL3Var47>
        <ClientSpecific.NumericSL3Var48>-09</ClientSpecific.NumericSL3Var48>
        <ClientSpecific.NumericSL3Var49>-09</ClientSpecific.NumericSL3Var49>
        <ClientSpecific.NumericSL3Var50>-09</ClientSpecific.NumericSL3Var50>
        <ClientSpecific.NumericSL3Var51>-09</ClientSpecific.NumericSL3Var51>
        <ClientSpecific.NumericSL3Var52>-09</ClientSpecific.NumericSL3Var52>
        <ClientSpecific.NumericSL3Var53>-09</ClientSpecific.NumericSL3Var53>
        <ClientSpecific.NumericSL3Var54>001</ClientSpecific.NumericSL3Var54>
        <ClientSpecific.NumericSL3Var55>001</ClientSpecific.NumericSL3Var55>
        <ClientSpecific.NumericSL3Var56>005</ClientSpecific.NumericSL3Var56>
        <ClientSpecific.NumericSL3Var57>-09</ClientSpecific.NumericSL3Var57>
        <ClientSpecific.NumericSL3Var58>-09</ClientSpecific.NumericSL3Var58>
        <ClientSpecific.NumericSL3Var59>001</ClientSpecific.NumericSL3Var59>
        <ClientSpecific.NumericSL3Var60>-09</ClientSpecific.NumericSL3Var60>
        <ClientSpecific.NumericSL3Var61>-09</ClientSpecific.NumericSL3Var61>
        <ClientSpecific.NumericSL3Var62>-09</ClientSpecific.NumericSL3Var62>
        <ClientSpecific.NumericSL3Var63>-09</ClientSpecific.NumericSL3Var63>
        <ClientSpecific.NumericSL3Var64></ClientSpecific.NumericSL3Var64>
        <ClientSpecific.NumericSL3Var65></ClientSpecific.NumericSL3Var65>
        <ClientSpecific.NumericSL3Var66></ClientSpecific.NumericSL3Var66>
        <ClientSpecific.NumericSL3Var67></ClientSpecific.NumericSL3Var67>
        <ClientSpecific.NumericSL3Var68></ClientSpecific.NumericSL3Var68>
        <ClientSpecific.NumericSL3Var69></ClientSpecific.NumericSL3Var69>
        <ClientSpecific.NumericSL3Var70></ClientSpecific.NumericSL3Var70>
        <ClientSpecific.NumericSL3Var71></ClientSpecific.NumericSL3Var71>
        <ClientSpecific.NumericSL3Var72></ClientSpecific.NumericSL3Var72>
        <ClientSpecific.NumericSL3Var73></ClientSpecific.NumericSL3Var73>
        <ClientSpecific.NumericSL3Var74></ClientSpecific.NumericSL3Var74>
        <ClientSpecific.NumericSL3Var75></ClientSpecific.NumericSL3Var75>
        <ClientSpecific.NumericSL3Var76></ClientSpecific.NumericSL3Var76>
        <ClientSpecific.NumericSL3Var77></ClientSpecific.NumericSL3Var77>
        <ClientSpecific.NumericSL3Var78></ClientSpecific.NumericSL3Var78>
        <ClientSpecific.NumericSL3Var79></ClientSpecific.NumericSL3Var79>
        <ClientSpecific.NumericSL3Var80></ClientSpecific.NumericSL3Var80>
        <ClientSpecific.NumericSL3Var81></ClientSpecific.NumericSL3Var81>
        <ClientSpecific.NumericSL3Var82></ClientSpecific.NumericSL3Var82>
        <ClientSpecific.NumericSL3Var83></ClientSpecific.NumericSL3Var83>
        <ClientSpecific.NumericSL3Var84></ClientSpecific.NumericSL3Var84>
        <ClientSpecific.NumericSL3Var85></ClientSpecific.NumericSL3Var85>
        <ClientSpecific.NumericSL3Var86></ClientSpecific.NumericSL3Var86>
        <ClientSpecific.NumericSL3Var87></ClientSpecific.NumericSL3Var87>
        <ClientSpecific.NumericSL3Var88></ClientSpecific.NumericSL3Var88>
        <ClientSpecific.NumericSL3Var89></ClientSpecific.NumericSL3Var89>
        <ClientSpecific.NumericSL3Var90></ClientSpecific.NumericSL3Var90>
        <ClientSpecific.NumericSL3Var91></ClientSpecific.NumericSL3Var91>
        <ClientSpecific.NumericSL3Var92></ClientSpecific.NumericSL3Var92>
        <ClientSpecific.NumericSL3Var93></ClientSpecific.NumericSL3Var93>
        <ClientSpecific.NumericSL3Var94></ClientSpecific.NumericSL3Var94>
        <ClientSpecific.NumericSL3Var95></ClientSpecific.NumericSL3Var95>
        <ClientSpecific.NumericSL3Var96></ClientSpecific.NumericSL3Var96>
        <ClientSpecific.NumericSL3Var97></ClientSpecific.NumericSL3Var97>
        <ClientSpecific.NumericSL3Var98></ClientSpecific.NumericSL3Var98>
        <ClientSpecific.NumericSL3Var99></ClientSpecific.NumericSL3Var99>
        <ClientSpecific.NumericSL3Var100></ClientSpecific.NumericSL3Var100>
        <ClientSpecific.NumericSL3Var101></ClientSpecific.NumericSL3Var101>
        <ClientSpecific.NumericSL3Var102></ClientSpecific.NumericSL3Var102>
        <ClientSpecific.NumericSL3Var103></ClientSpecific.NumericSL3Var103>
        <ClientSpecific.NumericSL3Var104></ClientSpecific.NumericSL3Var104>
        <ClientSpecific.NumericSL3Var105></ClientSpecific.NumericSL3Var105>
        <ClientSpecific.NumericSL3Var106></ClientSpecific.NumericSL3Var106>
        <ClientSpecific.NumericSL3Var107></ClientSpecific.NumericSL3Var107>
        <ClientSpecific.NumericSL3Var108></ClientSpecific.NumericSL3Var108>
        <ClientSpecific.NumericSL3Var109></ClientSpecific.NumericSL3Var109>
        <ClientSpecific.NumericSL3Var110></ClientSpecific.NumericSL3Var110>
        <ClientSpecific.NumericSL3Var111></ClientSpecific.NumericSL3Var111>
        <ClientSpecific.NumericSL3Var112></ClientSpecific.NumericSL3Var112>
        <ClientSpecific.NumericSL3Var113></ClientSpecific.NumericSL3Var113>
        <ClientSpecific.NumericSL3Var114></ClientSpecific.NumericSL3Var114>
        <ClientSpecific.NumericSL3Var115></ClientSpecific.NumericSL3Var115>
        <ClientSpecific.NumericSL3Var116></ClientSpecific.NumericSL3Var116>
        <ClientSpecific.NumericSL3Var117></ClientSpecific.NumericSL3Var117>
        <ClientSpecific.NumericSL3Var118></ClientSpecific.NumericSL3Var118>
        <ClientSpecific.NumericSL3Var119></ClientSpecific.NumericSL3Var119>
        <ClientSpecific.NumericSL3Var120></ClientSpecific.NumericSL3Var120>
        <ClientSpecific.NumericSL3Var121></ClientSpecific.NumericSL3Var121>
        <ClientSpecific.NumericSL3Var122></ClientSpecific.NumericSL3Var122>
        <ClientSpecific.NumericSL3Var123></ClientSpecific.NumericSL3Var123>
        <ClientSpecific.NumericSL3Var124></ClientSpecific.NumericSL3Var124>
        <ClientSpecific.NumericSL3Var125></ClientSpecific.NumericSL3Var125>
        <ClientSpecific.NumericSL3Var126></ClientSpecific.NumericSL3Var126>
        <ClientSpecific.NumericSL3Var127></ClientSpecific.NumericSL3Var127>
        <ClientSpecific.NumericSL3Var128></ClientSpecific.NumericSL3Var128>
        <ClientSpecific.NumericSL3Var129></ClientSpecific.NumericSL3Var129>
        <ClientSpecific.NumericSL3Var130></ClientSpecific.NumericSL3Var130>
        <ClientSpecific.NumericSL3Var131></ClientSpecific.NumericSL3Var131>
        <ClientSpecific.NumericSL3Var132></ClientSpecific.NumericSL3Var132>
        <ClientSpecific.NumericSL3Var133></ClientSpecific.NumericSL3Var133>
        <ClientSpecific.NumericSL3Var134></ClientSpecific.NumericSL3Var134>
        <ClientSpecific.NumericSL3Var135></ClientSpecific.NumericSL3Var135>
        <ClientSpecific.NumericSL3Var136></ClientSpecific.NumericSL3Var136>
        <ClientSpecific.NumericSL3Var137></ClientSpecific.NumericSL3Var137>
        <ClientSpecific.NumericSL3Var138></ClientSpecific.NumericSL3Var138>
        <ClientSpecific.NumericSL3Var139></ClientSpecific.NumericSL3Var139>
        <ClientSpecific.NumericSL3Var140></ClientSpecific.NumericSL3Var140>
        <ClientSpecific.NumericSL3Var141></ClientSpecific.NumericSL3Var141>
        <ClientSpecific.NumericSL3Var142></ClientSpecific.NumericSL3Var142>
        <ClientSpecific.NumericSL3Var143></ClientSpecific.NumericSL3Var143>
        <ClientSpecific.NumericSL3Var144></ClientSpecific.NumericSL3Var144>
        <ClientSpecific.NumericSL3Var145></ClientSpecific.NumericSL3Var145>
        <ClientSpecific.NumericSL3Var146></ClientSpecific.NumericSL3Var146>
        <ClientSpecific.NumericSL3Var147></ClientSpecific.NumericSL3Var147>
        <ClientSpecific.NumericSL3Var148></ClientSpecific.NumericSL3Var148>
        <ClientSpecific.NumericSL3Var149></ClientSpecific.NumericSL3Var149>
        <ClientSpecific.NumericSL3Var150></ClientSpecific.NumericSL3Var150>
        <ClientSpecific.NumericSL3Var151></ClientSpecific.NumericSL3Var151>
        <ClientSpecific.NumericSL3Var152></ClientSpecific.NumericSL3Var152>
        <ClientSpecific.NumericSL3Var153></ClientSpecific.NumericSL3Var153>
        <ClientSpecific.NumericSL3Var154></ClientSpecific.NumericSL3Var154>
        <ClientSpecific.NumericSL3Var155></ClientSpecific.NumericSL3Var155>
        <ClientSpecific.NumericSL3Var156></ClientSpecific.NumericSL3Var156>
        <ClientSpecific.NumericSL3Var157></ClientSpecific.NumericSL3Var157>
        <ClientSpecific.NumericSL3Var158></ClientSpecific.NumericSL3Var158>
        <ClientSpecific.NumericSL3Var159></ClientSpecific.NumericSL3Var159>
        <ClientSpecific.NumericSL3Var160></ClientSpecific.NumericSL3Var160>
        <ClientSpecific.NumericSL3Var161></ClientSpecific.NumericSL3Var161>
        <ClientSpecific.NumericSL3Var162></ClientSpecific.NumericSL3Var162>
        <ClientSpecific.NumericSL3Var163></ClientSpecific.NumericSL3Var163>
        <ClientSpecific.NumericSL3Var164></ClientSpecific.NumericSL3Var164>
        <ClientSpecific.NumericSL3Var165></ClientSpecific.NumericSL3Var165>
        <ClientSpecific.NumericSL3Var166></ClientSpecific.NumericSL3Var166>
        <ClientSpecific.NumericSL3Var167></ClientSpecific.NumericSL3Var167>
        <ClientSpecific.NumericSL3Var168></ClientSpecific.NumericSL3Var168>
        <ClientSpecific.NumericSL3Var169></ClientSpecific.NumericSL3Var169>
        <ClientSpecific.NumericSL3Var170></ClientSpecific.NumericSL3Var170>
        <ClientSpecific.NumericSL10Var1></ClientSpecific.NumericSL10Var1>
        <ClientSpecific.NumericSL10Var2></ClientSpecific.NumericSL10Var2>
        <ClientSpecific.NumericSL10Var3></ClientSpecific.NumericSL10Var3>
        <ClientSpecific.NumericSL10Var4></ClientSpecific.NumericSL10Var4>
        <ClientSpecific.NumericSL10Var5></ClientSpecific.NumericSL10Var5>
        <ClientSpecific.NumericSL10Var6></ClientSpecific.NumericSL10Var6>
        <ClientSpecific.NumericSL10Var7></ClientSpecific.NumericSL10Var7>
        <ClientSpecific.NumericSL10Var8></ClientSpecific.NumericSL10Var8>
        <ClientSpecific.NumericSL10Var9></ClientSpecific.NumericSL10Var9>
        <ClientSpecific.NumericSL10Var10></ClientSpecific.NumericSL10Var10>
        <ClientSpecific.NumericSL15Var42>-00000000000009</ClientSpecific.NumericSL15Var42>
        <ClientSpecific.NumericSL15Var43>-00000000000009</ClientSpecific.NumericSL15Var43>
        <ClientSpecific.NumericSL15Var44>-00000000000009</ClientSpecific.NumericSL15Var44>
        <ClientSpecific.NumericSL15Var45>000001547644403</ClientSpecific.NumericSL15Var45>
        <ClientSpecific.NumericSL15Var46></ClientSpecific.NumericSL15Var46>
        <ClientSpecific.NumericSL15Var47></ClientSpecific.NumericSL15Var47>
        <ClientSpecific.NumericSL15Var48></ClientSpecific.NumericSL15Var48>
        <ClientSpecific.NumericSL15Var49></ClientSpecific.NumericSL15Var49>
        <ClientSpecific.NumericSL15Var50></ClientSpecific.NumericSL15Var50>
        <ClientSpecific.NumericSL15Var51></ClientSpecific.NumericSL15Var51>
        <ClientSpecific.NumericSL15Var52></ClientSpecific.NumericSL15Var52>
        <ClientSpecific.NumericSL15Var53></ClientSpecific.NumericSL15Var53>
        <ClientSpecific.NumericSL15Var54></ClientSpecific.NumericSL15Var54>
        <ClientSpecific.NumericSL15Var55></ClientSpecific.NumericSL15Var55>
        <ClientSpecific.NumericSL15Var56></ClientSpecific.NumericSL15Var56>
        <ClientSpecific.NumericSL15Var57></ClientSpecific.NumericSL15Var57>
        <ClientSpecific.NumericSL15Var58></ClientSpecific.NumericSL15Var58>
        <ClientSpecific.NumericSL15Var59></ClientSpecific.NumericSL15Var59>
        <ClientSpecific.NumericSL15Var60></ClientSpecific.NumericSL15Var60>
        <ClientSpecific.NumericSL15Var61></ClientSpecific.NumericSL15Var61>
        <ClientSpecific.NumericSL15Var62></ClientSpecific.NumericSL15Var62>
        <ClientSpecific.NumericSL15Var63></ClientSpecific.NumericSL15Var63>
        <ClientSpecific.NumericSL15Var64></ClientSpecific.NumericSL15Var64>
        <ClientSpecific.NumericSL15Var65></ClientSpecific.NumericSL15Var65>
        <ClientSpecific.NumericSL15Var66></ClientSpecific.NumericSL15Var66>
        <ClientSpecific.NumericSL15Var67></ClientSpecific.NumericSL15Var67>
        <ClientSpecific.NumericSL15Var68></ClientSpecific.NumericSL15Var68>
        <ClientSpecific.NumericSL15Var69></ClientSpecific.NumericSL15Var69>
        <ClientSpecific.NumericSL15Var70></ClientSpecific.NumericSL15Var70>
        <ClientSpecific.NumericSL15Var71></ClientSpecific.NumericSL15Var71>
        <ClientSpecific.NumericSL15Var72></ClientSpecific.NumericSL15Var72>
        <ClientSpecific.NumericSL15Var73></ClientSpecific.NumericSL15Var73>
        <ClientSpecific.NumericSL15Var74></ClientSpecific.NumericSL15Var74>
        <ClientSpecific.NumericSL15Var75></ClientSpecific.NumericSL15Var75>
        <ClientSpecific.NumericSL15Var76></ClientSpecific.NumericSL15Var76>
        <ClientSpecific.NumericSL15Var77></ClientSpecific.NumericSL15Var77>
        <ClientSpecific.NumericSL15Var78></ClientSpecific.NumericSL15Var78>
        <ClientSpecific.NumericSL15Var79></ClientSpecific.NumericSL15Var79>
        <ClientSpecific.NumericSL15Var80></ClientSpecific.NumericSL15Var80>
        <ClientSpecific.NumericSL15Var81></ClientSpecific.NumericSL15Var81>
        <ClientSpecific.NumericSL15Var82></ClientSpecific.NumericSL15Var82>
        <ClientSpecific.NumericSL15Var83></ClientSpecific.NumericSL15Var83>
        <ClientSpecific.NumericSL15Var84></ClientSpecific.NumericSL15Var84>
        <ClientSpecific.NumericSL15Var85></ClientSpecific.NumericSL15Var85>
        <ClientSpecific.NumericSL15Var86></ClientSpecific.NumericSL15Var86>
        <ClientSpecific.NumericSL15Var87></ClientSpecific.NumericSL15Var87>
        <ClientSpecific.NumericSL15Var88></ClientSpecific.NumericSL15Var88>
        <ClientSpecific.NumericSL15Var89></ClientSpecific.NumericSL15Var89>
        <ClientSpecific.NumericSL15Var90></ClientSpecific.NumericSL15Var90>
        <ClientSpecific.StringL1Var1></ClientSpecific.StringL1Var1>
        <ClientSpecific.StringL1Var2></ClientSpecific.StringL1Var2>
        <ClientSpecific.StringL1Var3></ClientSpecific.StringL1Var3>
        <ClientSpecific.StringL1Var4></ClientSpecific.StringL1Var4>
        <ClientSpecific.StringL1Var5></ClientSpecific.StringL1Var5>
        <ClientSpecific.StringL1Var6></ClientSpecific.StringL1Var6>
        <ClientSpecific.StringL1Var7></ClientSpecific.StringL1Var7>
        <ClientSpecific.StringL1Var8></ClientSpecific.StringL1Var8>
        <ClientSpecific.StringL1Var9></ClientSpecific.StringL1Var9>
        <ClientSpecific.StringL1Var10></ClientSpecific.StringL1Var10>
        <ClientSpecific.StringL1Var11></ClientSpecific.StringL1Var11>
        <ClientSpecific.StringL1Var12></ClientSpecific.StringL1Var12>
        <ClientSpecific.StringL1Var13></ClientSpecific.StringL1Var13>
        <ClientSpecific.StringL1Var14></ClientSpecific.StringL1Var14>
        <ClientSpecific.StringL1Var15></ClientSpecific.StringL1Var15>
        <ClientSpecific.StringL1Var16></ClientSpecific.StringL1Var16>
        <ClientSpecific.StringL1Var17></ClientSpecific.StringL1Var17>
        <ClientSpecific.StringL1Var18></ClientSpecific.StringL1Var18>
        <ClientSpecific.StringL1Var19></ClientSpecific.StringL1Var19>
        <ClientSpecific.StringL1Var20></ClientSpecific.StringL1Var20>
        <ClientSpecific.StringL2Var1></ClientSpecific.StringL2Var1>
        <ClientSpecific.StringL2Var2></ClientSpecific.StringL2Var2>
        <ClientSpecific.StringL2Var3></ClientSpecific.StringL2Var3>
        <ClientSpecific.StringL2Var4></ClientSpecific.StringL2Var4>
        <ClientSpecific.StringL2Var5></ClientSpecific.StringL2Var5>
        <ClientSpecific.StringL2Var6></ClientSpecific.StringL2Var6>
        <ClientSpecific.StringL2Var7></ClientSpecific.StringL2Var7>
        <ClientSpecific.StringL2Var8></ClientSpecific.StringL2Var8>
        <ClientSpecific.StringL2Var9></ClientSpecific.StringL2Var9>
        <ClientSpecific.StringL2Var10></ClientSpecific.StringL2Var10>
        <ClientSpecific.StringL30Var1></ClientSpecific.StringL30Var1>
        <ClientSpecific.StringL30Var2></ClientSpecific.StringL30Var2>
        <ClientSpecific.StringL30Var3></ClientSpecific.StringL30Var3>
        <ClientSpecific.StringL30Var4></ClientSpecific.StringL30Var4>
        <ClientSpecific.StringL30Var5></ClientSpecific.StringL30Var5>
        <ClientSpecific.StringL30Var6></ClientSpecific.StringL30Var6>
        <ClientSpecific.StringL30Var7></ClientSpecific.StringL30Var7>
        <ClientSpecific.StringL30Var8></ClientSpecific.StringL30Var8>
        <ClientSpecific.StringL30Var9></ClientSpecific.StringL30Var9>
        <ClientSpecific.StringL30Var10></ClientSpecific.StringL30Var10>
        <ClientSpecific.StringL30Var11></ClientSpecific.StringL30Var11>
        <ClientSpecific.StringL30Var12></ClientSpecific.StringL30Var12>
        <ClientSpecific.StringL30Var13></ClientSpecific.StringL30Var13>
        <ClientSpecific.StringL30Var14></ClientSpecific.StringL30Var14>
        <ClientSpecific.StringL30Var15></ClientSpecific.StringL30Var15>
        <ClientSpecific.DateVar1></ClientSpecific.DateVar1>
        <ClientSpecific.DateVar2></ClientSpecific.DateVar2>
        <ClientSpecific.DateVar3></ClientSpecific.DateVar3>
        <ClientSpecific.DateVar4></ClientSpecific.DateVar4>
        <ClientSpecific.DateVar5></ClientSpecific.DateVar5>
        <ClientSpecific.DateVar6></ClientSpecific.DateVar6>
        <ClientSpecific.DateVar7></ClientSpecific.DateVar7>
        <ClientSpecific.DateVar8></ClientSpecific.DateVar8>
        <ClientSpecific.DateVar9></ClientSpecific.DateVar9>
        <ClientSpecific.DateVar10></ClientSpecific.DateVar10>
        <ClientSpecific.NumericSL10Var11></ClientSpecific.NumericSL10Var11>
        <ClientSpecific.NumericSL10Var12></ClientSpecific.NumericSL10Var12>
        <ClientSpecific.NumericSL10Var13></ClientSpecific.NumericSL10Var13>
        <ClientSpecific.NumericSL10Var14></ClientSpecific.NumericSL10Var14>
        <ClientSpecific.NumericSL10Var15></ClientSpecific.NumericSL10Var15>
        <ClientSpecific.NumericSL15Var1>-00000000000009</ClientSpecific.NumericSL15Var1>
        <ClientSpecific.NumericSL15Var2>-00000000000009</ClientSpecific.NumericSL15Var2>
        <ClientSpecific.NumericSL15Var3>-00000000000009</ClientSpecific.NumericSL15Var3>
        <ClientSpecific.NumericSL15Var4>-00000000000009</ClientSpecific.NumericSL15Var4>
        <ClientSpecific.NumericSL15Var5>-00000000000009</ClientSpecific.NumericSL15Var5>
        <ClientSpecific.NumericSL15Var6>-00000000000009</ClientSpecific.NumericSL15Var6>
        <ClientSpecific.NumericSL15Var7>-00000000000009</ClientSpecific.NumericSL15Var7>
        <ClientSpecific.NumericSL15Var8>-00000000000009</ClientSpecific.NumericSL15Var8>
        <ClientSpecific.NumericSL15Var9>-00000000000009</ClientSpecific.NumericSL15Var9>
        <ClientSpecific.NumericSL15Var10>-00000000000009</ClientSpecific.NumericSL15Var10>
        <ClientSpecific.NumericSL15Var11>-00000000000009</ClientSpecific.NumericSL15Var11>
        <ClientSpecific.NumericSL15Var12>-00000000000001</ClientSpecific.NumericSL15Var12>
        <ClientSpecific.NumericSL15Var13>-00000000000009</ClientSpecific.NumericSL15Var13>
        <ClientSpecific.NumericSL15Var14>000000000900000</ClientSpecific.NumericSL15Var14>
        <ClientSpecific.NumericSL15Var15>-00000000000009</ClientSpecific.NumericSL15Var15>
        <ClientSpecific.NumericSL15Var16>-00000000000009</ClientSpecific.NumericSL15Var16>
        <ClientSpecific.NumericSL15Var17>-00000000000009</ClientSpecific.NumericSL15Var17>
        <ClientSpecific.NumericSL15Var18>-00000000000009</ClientSpecific.NumericSL15Var18>
        <ClientSpecific.NumericSL15Var19>-00000000000009</ClientSpecific.NumericSL15Var19>
        <ClientSpecific.NumericSL15Var20>-00000000000009</ClientSpecific.NumericSL15Var20>
        <ClientSpecific.NumericSL15Var21>-00000000000009</ClientSpecific.NumericSL15Var21>
        <ClientSpecific.NumericSL15Var22>-00000000000009</ClientSpecific.NumericSL15Var22>
        <ClientSpecific.NumericSL15Var23>-00000000000009</ClientSpecific.NumericSL15Var23>
        <ClientSpecific.NumericSL15Var24>-00000000000009</ClientSpecific.NumericSL15Var24>
        <ClientSpecific.NumericSL15Var25>-00000000000009</ClientSpecific.NumericSL15Var25>
        <ClientSpecific.NumericSL15Var26>-00000000000009</ClientSpecific.NumericSL15Var26>
        <ClientSpecific.NumericSL15Var27>-00000000000009</ClientSpecific.NumericSL15Var27>
        <ClientSpecific.NumericSL15Var28>-00000000000009</ClientSpecific.NumericSL15Var28>
        <ClientSpecific.NumericSL15Var29>-00000000000009</ClientSpecific.NumericSL15Var29>
        <ClientSpecific.NumericSL15Var30>-00000000000009</ClientSpecific.NumericSL15Var30>
        <ClientSpecific.NumericSL15Var31>-00000000000009</ClientSpecific.NumericSL15Var31>
        <ClientSpecific.NumericSL15Var32>-00000000000009</ClientSpecific.NumericSL15Var32>
        <ClientSpecific.NumericSL15Var33>-00000000000009</ClientSpecific.NumericSL15Var33>
        <ClientSpecific.NumericSL15Var34>-00000000000009</ClientSpecific.NumericSL15Var34>
        <ClientSpecific.NumericSL15Var35>-00000000000009</ClientSpecific.NumericSL15Var35>
        <ClientSpecific.NumericSL15Var36>-00000000000009</ClientSpecific.NumericSL15Var36>
        <ClientSpecific.NumericSL15Var37>-00000000000009</ClientSpecific.NumericSL15Var37>
        <ClientSpecific.NumericSL15Var38>-00000000000009</ClientSpecific.NumericSL15Var38>
        <ClientSpecific.NumericSL15Var39>-00000000000009</ClientSpecific.NumericSL15Var39>
        <ClientSpecific.NumericSL15Var40>-00000000000009</ClientSpecific.NumericSL15Var40>
        <ClientSpecific.NumericSL15Var41>-00000000000009</ClientSpecific.NumericSL15Var41>
        <BureauSpecific.DateVar1>01062017</BureauSpecific.DateVar1>
        <BureauSpecific.DateVar2></BureauSpecific.DateVar2>
        <BureauSpecific.DateVar3></BureauSpecific.DateVar3>
        <BureauSpecific.DateVar4></BureauSpecific.DateVar4>
        <BureauSpecific.DateVar5></BureauSpecific.DateVar5>
        <BureauSpecific.DateVar6></BureauSpecific.DateVar6>
        <BureauSpecific.DateVar7></BureauSpecific.DateVar7>
        <BureauSpecific.DateVar8></BureauSpecific.DateVar8>
        <BureauSpecific.DateVar9></BureauSpecific.DateVar9>
        <BureauSpecific.DateVar10></BureauSpecific.DateVar10>
        <BureauSpecific.DateVar11></BureauSpecific.DateVar11>
        <BureauSpecific.DateVar12></BureauSpecific.DateVar12>
        <BureauSpecific.DateVar13></BureauSpecific.DateVar13>
        <BureauSpecific.DateVar14></BureauSpecific.DateVar14>
        <BureauSpecific.DateVar15></BureauSpecific.DateVar15>
        <BureauSpecific.DateVar16></BureauSpecific.DateVar16>
        <BureauSpecific.DateVar17></BureauSpecific.DateVar17>
        <BureauSpecific.DateVar18></BureauSpecific.DateVar18>
        <BureauSpecific.DateVar19></BureauSpecific.DateVar19>
        <BureauSpecific.DateVar20></BureauSpecific.DateVar20>
        <BureauSpecific.DateVar21></BureauSpecific.DateVar21>
        <BureauSpecific.DateVar22></BureauSpecific.DateVar22>
        <BureauSpecific.DateVar23></BureauSpecific.DateVar23>
        <BureauSpecific.DateVar24></BureauSpecific.DateVar24>
        <BureauSpecific.DateVar25></BureauSpecific.DateVar25>
        <BureauSpecific.DateVar26></BureauSpecific.DateVar26>
        <BureauSpecific.DateVar27></BureauSpecific.DateVar27>
        <BureauSpecific.DateVar28></BureauSpecific.DateVar28>
        <BureauSpecific.DateVar29></BureauSpecific.DateVar29>
        <BureauSpecific.DateVar30></BureauSpecific.DateVar30>
        <BureauSpecific.DateVar31></BureauSpecific.DateVar31>
        <BureauSpecific.DateVar32></BureauSpecific.DateVar32>
        <BureauSpecific.DateVar33></BureauSpecific.DateVar33>
        <BureauSpecific.DateVar34></BureauSpecific.DateVar34>
        <BureauSpecific.DateVar35></BureauSpecific.DateVar35>
        <BureauSpecific.DateVar36></BureauSpecific.DateVar36>
        <BureauSpecific.DateVar37></BureauSpecific.DateVar37>
        <BureauSpecific.DateVar38></BureauSpecific.DateVar38>
        <BureauSpecific.DateVar39></BureauSpecific.DateVar39>
        <BureauSpecific.DateVar40></BureauSpecific.DateVar40>
        <BureauSpecific.DateVar41></BureauSpecific.DateVar41>
        <BureauSpecific.DateVar42></BureauSpecific.DateVar42>
        <BureauSpecific.DateVar43></BureauSpecific.DateVar43>
        <BureauSpecific.DateVar44></BureauSpecific.DateVar44>
        <BureauSpecific.DateVar45></BureauSpecific.DateVar45>
        <BureauSpecific.DateVar46></BureauSpecific.DateVar46>
        <BureauSpecific.DateVar47></BureauSpecific.DateVar47>
        <BureauSpecific.DateVar48></BureauSpecific.DateVar48>
        <BureauSpecific.DateVar49></BureauSpecific.DateVar49>
        <BureauSpecific.DateVar50></BureauSpecific.DateVar50>
        <BureauSpecific.DateVar51></BureauSpecific.DateVar51>
        <BureauSpecific.DateVar52></BureauSpecific.DateVar52>
        <BureauSpecific.DateVar53></BureauSpecific.DateVar53>
        <BureauSpecific.DateVar54></BureauSpecific.DateVar54>
        <BureauSpecific.DateVar55></BureauSpecific.DateVar55>
        <BureauSpecific.DateVar56></BureauSpecific.DateVar56>
        <BureauSpecific.DateVar57></BureauSpecific.DateVar57>
        <BureauSpecific.DateVar58></BureauSpecific.DateVar58>
        <BureauSpecific.DateVar59></BureauSpecific.DateVar59>
        <BureauSpecific.DateVar60></BureauSpecific.DateVar60>
        <BureauSpecific.NumericVar1></BureauSpecific.NumericVar1>
        <BureauSpecific.NumericVar2></BureauSpecific.NumericVar2>
        <BureauSpecific.NumericVar3></BureauSpecific.NumericVar3>
        <BureauSpecific.NumericVar4></BureauSpecific.NumericVar4>
        <BureauSpecific.NumericVar5></BureauSpecific.NumericVar5>
        <BureauSpecific.NumericVar6></BureauSpecific.NumericVar6>
        <BureauSpecific.NumericVar7></BureauSpecific.NumericVar7>
        <BureauSpecific.NumericVar8></BureauSpecific.NumericVar8>
        <BureauSpecific.NumericVar9></BureauSpecific.NumericVar9>
        <BureauSpecific.NumericVar10></BureauSpecific.NumericVar10>
        <BureauSpecific.NumericVar11>01</BureauSpecific.NumericVar11>
        <BureauSpecific.NumericVar12>10</BureauSpecific.NumericVar12>
        <BureauSpecific.NumericVar13></BureauSpecific.NumericVar13>
        <BureauSpecific.NumericVar14></BureauSpecific.NumericVar14>
        <BureauSpecific.NumericVar15></BureauSpecific.NumericVar15>
        <BureauSpecific.NumericVar16></BureauSpecific.NumericVar16>
        <BureauSpecific.NumericVar17></BureauSpecific.NumericVar17>
        <BureauSpecific.NumericVar18></BureauSpecific.NumericVar18>
        <BureauSpecific.NumericVar19></BureauSpecific.NumericVar19>
        <BureauSpecific.NumericVar20></BureauSpecific.NumericVar20>
        <BureauSpecific.NumericVar21></BureauSpecific.NumericVar21>
        <BureauSpecific.NumericVar22></BureauSpecific.NumericVar22>
        <BureauSpecific.NumericVar23></BureauSpecific.NumericVar23>
        <BureauSpecific.NumericVar24></BureauSpecific.NumericVar24>
        <BureauSpecific.NumericVar25></BureauSpecific.NumericVar25>
        <BureauSpecific.NumericVar26></BureauSpecific.NumericVar26>
        <BureauSpecific.NumericVar27></BureauSpecific.NumericVar27>
        <BureauSpecific.NumericVar28></BureauSpecific.NumericVar28>
        <BureauSpecific.NumericVar29></BureauSpecific.NumericVar29>
        <BureauSpecific.NumericVar30></BureauSpecific.NumericVar30>
        <BureauSpecific.NumericVar31></BureauSpecific.NumericVar31>
        <BureauSpecific.NumericVar32></BureauSpecific.NumericVar32>
        <BureauSpecific.NumericVar33></BureauSpecific.NumericVar33>
        <BureauSpecific.NumericVar34></BureauSpecific.NumericVar34>
        <BureauSpecific.NumericVar35></BureauSpecific.NumericVar35>
        <BureauSpecific.NumericVar36></BureauSpecific.NumericVar36>
        <BureauSpecific.NumericVar37></BureauSpecific.NumericVar37>
        <BureauSpecific.NumericVar38></BureauSpecific.NumericVar38>
        <BureauSpecific.NumericVar39></BureauSpecific.NumericVar39>
        <BureauSpecific.NumericVar40></BureauSpecific.NumericVar40>
        <BureauSpecific.NumericVar41></BureauSpecific.NumericVar41>
        <BureauSpecific.NumericVar42></BureauSpecific.NumericVar42>
        <BureauSpecific.NumericVar43></BureauSpecific.NumericVar43>
        <BureauSpecific.NumericVar44></BureauSpecific.NumericVar44>
        <BureauSpecific.NumericVar45></BureauSpecific.NumericVar45>
        <BureauSpecific.NumericVar46></BureauSpecific.NumericVar46>
        <BureauSpecific.NumericVar47></BureauSpecific.NumericVar47>
        <BureauSpecific.NumericVar48></BureauSpecific.NumericVar48>
        <BureauSpecific.NumericVar49></BureauSpecific.NumericVar49>
        <BureauSpecific.NumericVar50></BureauSpecific.NumericVar50>
        <BureauSpecific.NumericVar51></BureauSpecific.NumericVar51>
        <BureauSpecific.NumericVar52></BureauSpecific.NumericVar52>
        <BureauSpecific.NumericVar53></BureauSpecific.NumericVar53>
        <BureauSpecific.NumericVar54></BureauSpecific.NumericVar54>
        <BureauSpecific.NumericVar55></BureauSpecific.NumericVar55>
        <BureauSpecific.NumericVar56></BureauSpecific.NumericVar56>
        <BureauSpecific.NumericVar57></BureauSpecific.NumericVar57>
        <BureauSpecific.NumericVar58></BureauSpecific.NumericVar58>
        <BureauSpecific.NumericVar59></BureauSpecific.NumericVar59>
        <BureauSpecific.NumericVar60></BureauSpecific.NumericVar60>
        <BureauSpecific.NumericVar61>-000000001</BureauSpecific.NumericVar61>
        <BureauSpecific.NumericVar62></BureauSpecific.NumericVar62>
        <BureauSpecific.NumericVar63>-000000001</BureauSpecific.NumericVar63>
        <BureauSpecific.NumericVar64>-000000001</BureauSpecific.NumericVar64>
        <BureauSpecific.NumericVar65>-000000001</BureauSpecific.NumericVar65>
        <BureauSpecific.NumericVar66>0000009999</BureauSpecific.NumericVar66>
        <BureauSpecific.NumericVar67>-000000001</BureauSpecific.NumericVar67>
        <BureauSpecific.NumericVar68>-000000001</BureauSpecific.NumericVar68>
        <BureauSpecific.NumericVar69></BureauSpecific.NumericVar69>
        <BureauSpecific.NumericVar70></BureauSpecific.NumericVar70>
        <BureauSpecific.NumericVar71></BureauSpecific.NumericVar71>
        <BureauSpecific.NumericVar72></BureauSpecific.NumericVar72>
        <BureauSpecific.NumericVar73></BureauSpecific.NumericVar73>
        <BureauSpecific.NumericVar74></BureauSpecific.NumericVar74>
        <BureauSpecific.NumericVar75></BureauSpecific.NumericVar75>
        <BureauSpecific.NumericVar76></BureauSpecific.NumericVar76>
        <BureauSpecific.NumericVar77></BureauSpecific.NumericVar77>
        <BureauSpecific.NumericVar78></BureauSpecific.NumericVar78>
        <BureauSpecific.NumericVar79></BureauSpecific.NumericVar79>
        <BureauSpecific.NumericVar80></BureauSpecific.NumericVar80>
        <BureauSpecific.NumericVar81></BureauSpecific.NumericVar81>
        <BureauSpecific.NumericVar82></BureauSpecific.NumericVar82>
        <BureauSpecific.NumericVar83></BureauSpecific.NumericVar83>
        <BureauSpecific.NumericVar84></BureauSpecific.NumericVar84>
        <BureauSpecific.NumericVar85></BureauSpecific.NumericVar85>
        <BureauSpecific.NumericVar86></BureauSpecific.NumericVar86>
        <BureauSpecific.NumericVar87></BureauSpecific.NumericVar87>
        <BureauSpecific.NumericVar88></BureauSpecific.NumericVar88>
        <BureauSpecific.NumericVar89></BureauSpecific.NumericVar89>
        <BureauSpecific.NumericVar90></BureauSpecific.NumericVar90>
        <BureauSpecific.NumericVar91></BureauSpecific.NumericVar91>
        <BureauSpecific.NumericVar92></BureauSpecific.NumericVar92>
        <BureauSpecific.NumericVar93></BureauSpecific.NumericVar93>
        <BureauSpecific.NumericVar94></BureauSpecific.NumericVar94>
        <BureauSpecific.NumericVar95></BureauSpecific.NumericVar95>
        <BureauSpecific.NumericVar96></BureauSpecific.NumericVar96>
        <BureauSpecific.NumericVar97></BureauSpecific.NumericVar97>
        <BureauSpecific.NumericVar98></BureauSpecific.NumericVar98>
        <BureauSpecific.NumericVar99></BureauSpecific.NumericVar99>
        <BureauSpecific.NumericVar100></BureauSpecific.NumericVar100>
        <BureauSpecific.NumericVar101></BureauSpecific.NumericVar101>
        <BureauSpecific.NumericVar102></BureauSpecific.NumericVar102>
        <BureauSpecific.NumericVar103></BureauSpecific.NumericVar103>
        <BureauSpecific.NumericVar104></BureauSpecific.NumericVar104>
        <BureauSpecific.NumericVar105></BureauSpecific.NumericVar105>
        <BureauSpecific.NumericVar106></BureauSpecific.NumericVar106>
        <BureauSpecific.NumericVar107></BureauSpecific.NumericVar107>
        <BureauSpecific.NumericVar108></BureauSpecific.NumericVar108>
        <BureauSpecific.NumericVar109></BureauSpecific.NumericVar109>
        <BureauSpecific.NumericVar110></BureauSpecific.NumericVar110>
        <BureauSpecific.NumericVar111></BureauSpecific.NumericVar111>
        <BureauSpecific.NumericVar112></BureauSpecific.NumericVar112>
        <BureauSpecific.NumericVar113></BureauSpecific.NumericVar113>
        <BureauSpecific.NumericVar114></BureauSpecific.NumericVar114>
        <BureauSpecific.NumericVar115></BureauSpecific.NumericVar115>
        <BureauSpecific.NumericVar116></BureauSpecific.NumericVar116>
        <BureauSpecific.NumericVar117></BureauSpecific.NumericVar117>
        <BureauSpecific.NumericVar118></BureauSpecific.NumericVar118>
        <BureauSpecific.NumericVar119></BureauSpecific.NumericVar119>
        <BureauSpecific.NumericVar120></BureauSpecific.NumericVar120>
        <BureauSpecific.StringVar1></BureauSpecific.StringVar1>
        <BureauSpecific.StringVar2></BureauSpecific.StringVar2>
        <BureauSpecific.StringVar3></BureauSpecific.StringVar3>
        <BureauSpecific.StringVar4></BureauSpecific.StringVar4>
        <BureauSpecific.StringVar5></BureauSpecific.StringVar5>
        <BureauSpecific.StringVar6></BureauSpecific.StringVar6>
        <BureauSpecific.StringVar7></BureauSpecific.StringVar7>
        <BureauSpecific.StringVar8></BureauSpecific.StringVar8>
        <BureauSpecific.StringVar9></BureauSpecific.StringVar9>
        <BureauSpecific.StringVar10></BureauSpecific.StringVar10>
        <BureauSpecific.StringVar11></BureauSpecific.StringVar11>
        <BureauSpecific.StringVar12></BureauSpecific.StringVar12>
        <BureauSpecific.StringVar13></BureauSpecific.StringVar13>
        <BureauSpecific.StringVar14></BureauSpecific.StringVar14>
        <BureauSpecific.StringVar15></BureauSpecific.StringVar15>
        <BureauSpecific.StringVar16></BureauSpecific.StringVar16>
        <BureauSpecific.StringVar17></BureauSpecific.StringVar17>
        <BureauSpecific.StringVar18></BureauSpecific.StringVar18>
        <BureauSpecific.StringVar19></BureauSpecific.StringVar19>
        <BureauSpecific.StringVar20></BureauSpecific.StringVar20>
        <BureauSpecific.StringVar21></BureauSpecific.StringVar21>
        <BureauSpecific.StringVar22></BureauSpecific.StringVar22>
        <BureauSpecific.StringVar23></BureauSpecific.StringVar23>
        <BureauSpecific.StringVar24></BureauSpecific.StringVar24>
        <BureauSpecific.StringVar25></BureauSpecific.StringVar25>
        <BureauSpecific.StringVar26></BureauSpecific.StringVar26>
        <BureauSpecific.StringVar27></BureauSpecific.StringVar27>
        <BureauSpecific.StringVar28></BureauSpecific.StringVar28>
        <BureauSpecific.StringVar29></BureauSpecific.StringVar29>
        <BureauSpecific.StringVar30></BureauSpecific.StringVar30>
        <BureauSpecific.StringVar31></BureauSpecific.StringVar31>
        <BureauSpecific.StringVar32></BureauSpecific.StringVar32>
        <BureauSpecific.StringVar33></BureauSpecific.StringVar33>
        <BureauSpecific.StringVar34></BureauSpecific.StringVar34>
        <BureauSpecific.StringVar35></BureauSpecific.StringVar35>
        <BureauSpecific.StringVar36></BureauSpecific.StringVar36>
        <BureauSpecific.StringVar37></BureauSpecific.StringVar37>
        <BureauSpecific.StringVar38></BureauSpecific.StringVar38>
        <BureauSpecific.StringVar39></BureauSpecific.StringVar39>
        <BureauSpecific.StringVar40></BureauSpecific.StringVar40>
        <BureauSpecific.StringVar41></BureauSpecific.StringVar41>
        <BureauSpecific.StringVar42></BureauSpecific.StringVar42>
        <BureauSpecific.StringVar43></BureauSpecific.StringVar43>
        <BureauSpecific.StringVar44></BureauSpecific.StringVar44>
        <BureauSpecific.StringVar45></BureauSpecific.StringVar45>
        <BureauSpecific.StringVar46></BureauSpecific.StringVar46>
        <BureauSpecific.StringVar47></BureauSpecific.StringVar47>
        <BureauSpecific.StringVar48></BureauSpecific.StringVar48>
        <BureauSpecific.StringVar49></BureauSpecific.StringVar49>
        <BureauSpecific.StringVar50></BureauSpecific.StringVar50>
        <BureauSpecific.StringVar51></BureauSpecific.StringVar51>
        <BureauSpecific.StringVar52></BureauSpecific.StringVar52>
        <BureauSpecific.StringVar53></BureauSpecific.StringVar53>
        <BureauSpecific.StringVar54></BureauSpecific.StringVar54>
        <BureauSpecific.StringVar55></BureauSpecific.StringVar55>
        <BureauSpecific.StringVar56></BureauSpecific.StringVar56>
        <BureauSpecific.StringVar57></BureauSpecific.StringVar57>
        <BureauSpecific.StringVar58></BureauSpecific.StringVar58>
        <BureauSpecific.StringVar59></BureauSpecific.StringVar59>
        <BureauSpecific.StringVar60></BureauSpecific.StringVar60>
        <BureauSpecific.StringVar61></BureauSpecific.StringVar61>
        <BureauSpecific.StringVar62></BureauSpecific.StringVar62>
        <BureauSpecific.StringVar63></BureauSpecific.StringVar63>
        <BureauSpecific.StringVar64></BureauSpecific.StringVar64>
        <BureauSpecific.StringVar65></BureauSpecific.StringVar65>
        <BureauSpecific.StringVar66></BureauSpecific.StringVar66>
        <BureauSpecific.StringVar67></BureauSpecific.StringVar67>
        <BureauSpecific.StringVar68></BureauSpecific.StringVar68>
        <BureauSpecific.StringVar69>9999</BureauSpecific.StringVar69>
        <BureauSpecific.StringVar70>9999</BureauSpecific.StringVar70>
        <BureauSpecific.StringVar71></BureauSpecific.StringVar71>
        <BureauSpecific.StringVar72></BureauSpecific.StringVar72>
        <BureauSpecific.StringVar73></BureauSpecific.StringVar73>
        <BureauSpecific.StringVar74></BureauSpecific.StringVar74>
        <BureauSpecific.StringVar75></BureauSpecific.StringVar75>
        <BureauSpecific.StringVar76></BureauSpecific.StringVar76>
        <BureauSpecific.StringVar77></BureauSpecific.StringVar77>
        <BureauSpecific.StringVar78></BureauSpecific.StringVar78>
        <BureauSpecific.StringVar79></BureauSpecific.StringVar79>
        <BureauSpecific.StringVar80></BureauSpecific.StringVar80>
        <BureauSpecific.StringVar81>CIBILTUSCR</BureauSpecific.StringVar81>
        <BureauSpecific.StringVar82></BureauSpecific.StringVar82>
        <BureauSpecific.StringVar83></BureauSpecific.StringVar83>
        <BureauSpecific.StringVar84></BureauSpecific.StringVar84>
        <BureauSpecific.StringVar85></BureauSpecific.StringVar85>
        <BureauSpecific.StringVar86></BureauSpecific.StringVar86>
        <BureauSpecific.StringVar87></BureauSpecific.StringVar87>
        <BureauSpecific.StringVar88></BureauSpecific.StringVar88>
        <BureauSpecific.StringVar89></BureauSpecific.StringVar89>
        <BureauSpecific.StringVar90></BureauSpecific.StringVar90>
        <BureauSpecific.StringVar91></BureauSpecific.StringVar91>
        <BureauSpecific.StringVar92></BureauSpecific.StringVar92>
        <BureauSpecific.StringVar93></BureauSpecific.StringVar93>
        <BureauSpecific.StringVar94></BureauSpecific.StringVar94>
        <BureauSpecific.StringVar95></BureauSpecific.StringVar95>
        <BureauSpecific.StringVar96></BureauSpecific.StringVar96>
        <BureauSpecific.StringVar97></BureauSpecific.StringVar97>
        <BureauSpecific.StringVar98></BureauSpecific.StringVar98>
        <BureauSpecific.StringVar99></BureauSpecific.StringVar99>
        <BureauSpecific.StringVar100></BureauSpecific.StringVar100>
        <BureauSpecific.StringVar101></BureauSpecific.StringVar101>
        <BureauSpecific.StringVar102></BureauSpecific.StringVar102>
        <BureauSpecific.StringVar103></BureauSpecific.StringVar103>
        <BureauSpecific.StringVar104></BureauSpecific.StringVar104>
        <BureauSpecific.StringVar105></BureauSpecific.StringVar105>
        <BureauSpecific.StringVar106></BureauSpecific.StringVar106>
        <BureauSpecific.StringVar107></BureauSpecific.StringVar107>
        <BureauSpecific.StringVar108></BureauSpecific.StringVar108>
        <BureauSpecific.StringVar109></BureauSpecific.StringVar109>
        <BureauSpecific.StringVar110></BureauSpecific.StringVar110>
        <BureauSpecific.StringVar111></BureauSpecific.StringVar111>
        <BureauSpecific.StringVar112></BureauSpecific.StringVar112>
        <BureauSpecific.StringVar113></BureauSpecific.StringVar113>
        <BureauSpecific.StringVar114></BureauSpecific.StringVar114>
        <BureauSpecific.StringVar115></BureauSpecific.StringVar115>
        <BureauSpecific.StringVar116></BureauSpecific.StringVar116>
        <BureauSpecific.StringVar117></BureauSpecific.StringVar117>
        <BureauSpecific.StringVar118></BureauSpecific.StringVar118>
        <BureauSpecific.StringVar119></BureauSpecific.StringVar119>
        <BureauSpecific.StringVar120></BureauSpecific.StringVar120>
    </TransactData>
         <RawData>
            <applicant index="1">
               <segment name="OUT_FIXED_TUEF">
                  <block nb="1">
                     <field cibil_tag="ProcessTime">190718</field>
                     <field cibil_tag="ProcessDate">01062017</field>
                     <field cibil_tag="ControlNumber">001547644403</field>
                     <field cibil_tag="ReturnCode">1</field>
                     <field cibil_tag="MemberCode">NB66304585</field>
                     <field cibil_tag="FutureUse2">0000</field>
                     <field cibil_tag="FutureUse1"/>
                     <field cibil_tag="MemberRef">1062017</field>
                     <field cibil_tag="Version">12</field>
                     <field cibil_tag="SegmentTag">TUEF</field>
                  </block>
               </segment>
               <segment name="OUT_PN">
                  <block nb="1">
                     <field cibil_tag="81"/>
                     <field cibil_tag="80"/>
                     <field cibil_tag="08">2</field>
                     <field cibil_tag="87"/>
                     <field cibil_tag="07">01051983</field>
                     <field cibil_tag="86"/>
                     <field cibil_tag="05"/>
                     <field cibil_tag="85"/>
                     <field cibil_tag="04"/>
                     <field cibil_tag="84"/>
                     <field cibil_tag="03"/>
                     <field cibil_tag="83"/>
                     <field cibil_tag="02">SHALINI</field>
                     <field cibil_tag="82"/>
                     <field cibil_tag="01">RAJPUT</field>
                     <field cibil_tag="PN">N01</field>
                  </block>
               </segment>
               <segment name="OUT_ID">
                  <block nb="1">
                     <field cibil_tag="90">Y</field>
                     <field cibil_tag="04"/>
                     <field cibil_tag="03"/>
                     <field cibil_tag="02">AAAPA2114B</field>
                     <field cibil_tag="01">01</field>
                     <field cibil_tag="ID">I01</field>
                  </block>
               </segment>
               <segment name="OUT_PT">
                  <block nb="1">
                     <field cibil_tag="90">Y</field>
                     <field cibil_tag="03">03</field>
                     <field cibil_tag="02"/>
                     <field cibil_tag="01">43744900</field>
                     <field cibil_tag="PT">T01</field>
                  </block>
                  <block nb="2">
                     <field cibil_tag="90">Y</field>
                     <field cibil_tag="03">01</field>
                     <field cibil_tag="02"/>
                     <field cibil_tag="01">9599344050</field>
                     <field cibil_tag="PT">T02</field>
                  </block>
               </segment>
               <segment name="OUT_EC">
                  <block nb="1">
                     <field cibil_tag="01"/>
                     <field cibil_tag="EC"/>
                  </block>
               </segment>
               <segment name="OUT_EM">
                  <block nb="1">
                     <field cibil_tag="83"/>
                     <field cibil_tag="82"/>
                     <field cibil_tag="80"/>
                     <field cibil_tag="06"/>
                     <field cibil_tag="05"/>
                     <field cibil_tag="87"/>
                     <field cibil_tag="04"/>
                     <field cibil_tag="86"/>
                     <field cibil_tag="03"/>
                     <field cibil_tag="85"/>
                     <field cibil_tag="02"/>
                     <field cibil_tag="84"/>
                     <field cibil_tag="01"/>
                     <field cibil_tag="EM"/>
                  </block>
               </segment>
               <segment name="OUT_PI">
                  <block nb="1">
                     <field cibil_tag="01"/>
                     <field cibil_tag="PI"/>
                  </block>
               </segment>
               <segment name="OUT_SC">
                  <block nb="1">
                     <field cibil_tag="59"/>
                     <field cibil_tag="58"/>
                     <field cibil_tag="57"/>
                     <field cibil_tag="56"/>
                     <field cibil_tag="55"/>
                     <field cibil_tag="54"/>
                     <field cibil_tag="53"/>
                     <field cibil_tag="52"/>
                     <field cibil_tag="51"/>
                     <field cibil_tag="50"/>
                     <field cibil_tag="49"/>
                     <field cibil_tag="48"/>
                     <field cibil_tag="47"/>
                     <field cibil_tag="46"/>
                     <field cibil_tag="45"/>
                     <field cibil_tag="44"/>
                     <field cibil_tag="43"/>
                     <field cibil_tag="42"/>
                     <field cibil_tag="41"/>
                     <field cibil_tag="40"/>
                     <field cibil_tag="39"/>
                     <field cibil_tag="38"/>
                     <field cibil_tag="37"/>
                     <field cibil_tag="36"/>
                     <field cibil_tag="35"/>
                     <field cibil_tag="34"/>
                     <field cibil_tag="33"/>
                     <field cibil_tag="32"/>
                     <field cibil_tag="31"/>
                     <field cibil_tag="30"/>
                     <field cibil_tag="29"/>
                     <field cibil_tag="28"/>
                     <field cibil_tag="27"/>
                     <field cibil_tag="26"/>
                     <field cibil_tag="25"/>
                     <field cibil_tag="24"/>
                     <field cibil_tag="23"/>
                     <field cibil_tag="22"/>
                     <field cibil_tag="21"/>
                     <field cibil_tag="20"/>
                     <field cibil_tag="09"/>
                     <field cibil_tag="08"/>
                     <field cibil_tag="07"/>
                     <field cibil_tag="06"/>
                     <field cibil_tag="05"/>
                     <field cibil_tag="04">-0001</field>
                     <field cibil_tag="03">01062017</field>
                     <field cibil_tag="02">10</field>
                     <field cibil_tag="01">01</field>
                     <field cibil_tag="SC">CIBILTUSCR</field>
                     <field cibil_tag="19"/>
                     <field cibil_tag="18"/>
                     <field cibil_tag="17"/>
                     <field cibil_tag="16"/>
                     <field cibil_tag="15"/>
                     <field cibil_tag="14"/>
                     <field cibil_tag="13"/>
                     <field cibil_tag="12"/>
                     <field cibil_tag="11"/>
                     <field cibil_tag="75"/>
                     <field cibil_tag="10"/>
                     <field cibil_tag="74"/>
                     <field cibil_tag="73"/>
                     <field cibil_tag="72"/>
                     <field cibil_tag="71"/>
                     <field cibil_tag="70"/>
                     <field cibil_tag="69"/>
                     <field cibil_tag="68"/>
                     <field cibil_tag="67"/>
                     <field cibil_tag="66"/>
                     <field cibil_tag="65"/>
                     <field cibil_tag="64"/>
                     <field cibil_tag="63"/>
                     <field cibil_tag="62"/>
                     <field cibil_tag="61"/>
                     <field cibil_tag="60"/>
                  </block>
               </segment>
               <segment name="OUT_PA">
                  <block nb="1">
                     <field cibil_tag="09"/>
                     <field cibil_tag="08">07</field>
                     <field cibil_tag="07">110092</field>
                     <field cibil_tag="06">07</field>
                     <field cibil_tag="05">NCR RMM</field>
                     <field cibil_tag="04">DELHI</field>
                     <field cibil_tag="90">Y</field>
                     <field cibil_tag="03">NEW DELHI</field>
                     <field cibil_tag="11"/>
                     <field cibil_tag="02">NEW DELHI</field>
                     <field cibil_tag="10">19052017</field>
                     <field cibil_tag="01">10 DARYA GANJ</field>
                     <field cibil_tag="PA">A01</field>
                  </block>
                  <block nb="2">
                     <field cibil_tag="09"/>
                     <field cibil_tag="08">02</field>
                     <field cibil_tag="07">110014</field>
                     <field cibil_tag="06">07</field>
                     <field cibil_tag="05">NCR RMM</field>
                     <field cibil_tag="04">DELHI</field>
                     <field cibil_tag="90">Y</field>
                     <field cibil_tag="03">ASHRAM</field>
                     <field cibil_tag="11"/>
                     <field cibil_tag="02">HARI NAGAR</field>
                     <field cibil_tag="10">19052017</field>
                     <field cibil_tag="01">A-29 FF</field>
                     <field cibil_tag="PA">A02</field>
                  </block>
               </segment>
               <segment name="OUT_TL">
                  <block nb="1">
                     <field cibil_tag="45"/>
                     <field cibil_tag="44"/>
                     <field cibil_tag="43"/>
                     <field cibil_tag="42"/>
                     <field cibil_tag="41"/>
                     <field cibil_tag="40"/>
                     <field cibil_tag="39"/>
                     <field cibil_tag="38"/>
                     <field cibil_tag="37"/>
                     <field cibil_tag="36"/>
                     <field cibil_tag="12"/>
                     <field cibil_tag="11"/>
                     <field cibil_tag="35"/>
                     <field cibil_tag="10"/>
                     <field cibil_tag="34"/>
                     <field cibil_tag="09"/>
                     <field cibil_tag="33"/>
                     <field cibil_tag="08"/>
                     <field cibil_tag="32"/>
                     <field cibil_tag="05"/>
                     <field cibil_tag="31"/>
                     <field cibil_tag="04"/>
                     <field cibil_tag="30"/>
                     <field cibil_tag="03"/>
                     <field cibil_tag="29"/>
                     <field cibil_tag="02"/>
                     <field cibil_tag="28"/>
                     <field cibil_tag="TL"/>
                     <field cibil_tag="14"/>
                     <field cibil_tag="13"/>
                     <field cibil_tag="87"/>
                     <field cibil_tag="86"/>
                     <field cibil_tag="85"/>
                     <field cibil_tag="84"/>
                     <field cibil_tag="83"/>
                     <field cibil_tag="82"/>
                     <field cibil_tag="80"/>
                  </block>
               </segment>
               <segment name="OUT_IQ">
                  <block nb="1">
                     <field cibil_tag="06">900000</field>
                     <field cibil_tag="05">05</field>
                     <field cibil_tag="04">FICCL</field>
                     <field cibil_tag="01">13022017</field>
                     <field cibil_tag="IQ">I001</field>
                  </block>
                  <block nb="2">
                     <field cibil_tag="06">900000</field>
                     <field cibil_tag="05">05</field>
                     <field cibil_tag="04">FICCL</field>
                     <field cibil_tag="01">13022017</field>
                     <field cibil_tag="IQ">I002</field>
                  </block>
                  <block nb="3">
                     <field cibil_tag="06">900000</field>
                     <field cibil_tag="05">05</field>
                     <field cibil_tag="04">FICCL</field>
                     <field cibil_tag="01">19052017</field>
                     <field cibil_tag="IQ">I001</field>
                  </block>
               </segment>
               <segment name="OUT_DR">
                  <block nb="1">
                     <field cibil_tag="06"/>
                     <field cibil_tag="05"/>
                     <field cibil_tag="04"/>
                     <field cibil_tag="03"/>
                     <field cibil_tag="02"/>
                     <field cibil_tag="01"/>
                     <field cibil_tag="DR"/>
                     <field cibil_tag="07"/>
                  </block>
               </segment>
               <segment name="OUT_ES">
                  <block nb="1">
                     <field cibil_tag="01">**</field>
                     <field cibil_tag="ES">0000552</field>
                  </block>
               </segment>
            </applicant>
         </RawData>
		</rawdata>
	</party>
</CIBIL>]]></ser:rawData>
      </ser:invokeBRE>
   </soapenv:Body>
</soapenv:Envelope>';

$url ='https://breesb.fullertonindia.com:9080/magicxpi4_1/MGrqispi.dll?appname=IFSBRE&prgname=HTTP&arguments=-AHTTP_BRE%23BRE';
$soapClient = new nusoap_client("https://14.140.27.7:9080/RupeePowerWebService/services/RupeePowerService?wsdl", true);   

$soapClient->setEndpoint($url);

$info = $soapClient->call("invokeBRE", $xmlstr);
print_r($info);
//echo "<pre>";print_r($soapClient);

//http://192.168.84.63:8085/OUGBufferedWebServiceComponent/UGService
//
/*response

Array
(
    [invokeBREReturn] => <loanContract>
  <loanApplication>
    <applicant>
      <partyReference/>
      <companyName>Mywish Marketplaces Pvt ltd</companyName>
      <companyCategory>OTHERS</companyCategory>
      <qualification/>
      <dateOfBirth>1985-02-01</dateOfBirth>
      <ageInMonths>384.0</ageInMonths>
      <ageInYears>32.0</ageInYears>
      <ageAtMaturity>35.0</ageAtMaturity>
      <incomeDetails>
        <declaredGrossMonthlyIncome>75000</declaredGrossMonthlyIncome>
        <minMonthlyIncome>0.0</minMonthlyIncome>
        <verifiedMonthlyIncome>0.0</verifiedMonthlyIncome>
        <totalMonthlyEMI>0</totalMonthlyEMI>
        <totalMonthlyEMIPersonalLoans>0</totalMonthlyEMIPersonalLoans>
        <grossAnnualIncome>900000</grossAnnualIncome>
        <otherIncome>0.0</otherIncome>
        <spouseIncome>0.0</spouseIncome>
        <disposableMonthlyIncome>0.0</disposableMonthlyIncome>
        <clubbedIncome>0.0</clubbedIncome>
        <netAdjustedIncome>52500.0</netAdjustedIncome>
        <additionalIncome>0.0</additionalIncome>
        <netMonthlyTakeHomeSalary>75000.0</netMonthlyTakeHomeSalary>
        <salesTurnover>0</salesTurnover>
      </incomeDetails>
      <cibilBureauDetails>
        <loanHistory>
          <status>000</status>
          <maxDpd>0</maxDpd>
          <closed_Ind>0</closed_Ind>
          <trade_Type>OTHER</trade_Type>
          <trade_Grp/>
          <finalDPDString>-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01-01</finalDPDString>
          <ownership/>
          <reportingMemberShortName/>
          <writeOffMonth>00000000</writeOffMonth>
          <noOfPaidEmisPostDPD>1</noOfPaidEmisPostDPD>
          <writeOffAmt>0</writeOffAmt>
          <writeOffDate/>
          <closerDate/>
          <actualCloserDate>00000000</actualCloserDate>
          <reportDate/>
          <lastRepaymentDate>2017-02-13</lastRepaymentDate>
          <foreclosureStatus/>
          <emi>000</emi>
          <TwelveMonth30PlusDPDCount>000</TwelveMonth30PlusDPDCount>
          <secured/>
          <durationOfWriteOfftoLogin>00000000</durationOfWriteOfftoLogin>
          <DateOpened>2017-02-13</DateOpened>
          <liabilityType>Other</liabilityType>
          <CurrentBalance>0</CurrentBalance>
          <Sanctioned>0</Sanctioned>
          <outStandingAmt>0</outStandingAmt>
          <subStatus>000</subStatus>
          <durationOfWriteOffToLogin>0</durationOfWriteOffToLogin>
        </loanHistory>
        <notrackavailable>0</notrackavailable>
        <loan_ever_90Plus>0</loan_ever_90Plus>
        <Trade_summary_1>0.0</Trade_summary_1>
        <Trade_summary_2>0.0</Trade_summary_2>
        <trade_info_1>0</trade_info_1>
        <trade_info_2>0</trade_info_2>
        <trade_info_3>0</trade_info_3>
        <trade_info_4>0.0</trade_info_4>
        <trade_info_5>0</trade_info_5>
        <trade_info_6>0</trade_info_6>
        <trade_info_7>0</trade_info_7>
        <max_delinq>0</max_delinq>
        <trade_info_8>0</trade_info_8>
        <enq_info_1>0</enq_info_1>
        <enq_info_2>0</enq_info_2>
        <enq_info_3>0</enq_info_3>
        <enq_Ever_Card>0</enq_Ever_Card>
        <enq_Ever_Unsec>6</enq_Ever_Unsec>
        <enq_info_4>0</enq_info_4>
        <enq_info_5>0</enq_info_5>
        <enq_info_6>0</enq_info_6>
        <enq_info_7>0</enq_info_7>
        <LoanEnquiries_6MNTH>0</LoanEnquiries_6MNTH>
        <MaxDEL_HL_6MNTH>0</MaxDEL_HL_6MNTH>
        <LiveCardUtil>NaN</LiveCardUtil>
        <HL_Enquiries_6MNTH>0</HL_Enquiries_6MNTH>
        <HL_Enquiries_Total>0</HL_Enquiries_Total>
        <TotalOFFUS_SecuredEnquiries_12MNTH>0</TotalOFFUS_SecuredEnquiries_12MNTH>
        <TotalOFFUS_PLEnquiries_12MNTH>6</TotalOFFUS_PLEnquiries_12MNTH>
        <Total_LiveCard_Trades>0</Total_LiveCard_Trades>
        <Total_LiveTrades>1</Total_LiveTrades>
        <Total_UnsecuredTrades_Opened_6MNTH>0</Total_UnsecuredTrades_Opened_6MNTH>
        <Unsecured_LastTrade_Opened>99999.0</Unsecured_LastTrade_Opened>
        <Total_PastDueBalance_SecuredTrade>0.0</Total_PastDueBalance_SecuredTrade>
        <Total_Utilization_LivePL_Accounts>NaN</Total_Utilization_LivePL_Accounts>
        <MaxDEL_CARD>0</MaxDEL_CARD>
        <MaxDEL_NONCARD>0</MaxDEL_NONCARD>
        <MaxDEL_24MNTH>0</MaxDEL_24MNTH>
        <MaxDEL_12MNTH>0</MaxDEL_12MNTH>
        <MaxDEL_PL_12MNTH>0</MaxDEL_PL_12MNTH>
        <MaxDEL_UNSECURED_6MNTH>0</MaxDEL_UNSECURED_6MNTH>
        <young_Unsec_Trade>0</young_Unsec_Trade>
        <total_Delinquent_Trades>0.0</total_Delinquent_Trades>
        <trade_info_9>0.0</trade_info_9>
        <Total_Card_Util>0.0</Total_Card_Util>
        <Total_Card_Balance>0.0</Total_Card_Balance>
        <Months_Since_30DPD>98.0</Months_Since_30DPD>
        <Clean_Record_3Years>Yes</Clean_Record_3Years>
        <derogPolicy>no deviation</derogPolicy>
        <beforeFICCStatus>NO</beforeFICCStatus>
        <beforeFICCSubStatus>NO</beforeFICCSubStatus>
        <beforeFICCDPD>NO</beforeFICCDPD>
        <beforeFICCWriteoffAmt>NO</beforeFICCWriteoffAmt>
        <beforeFICCWriteofftoLogin>NO</beforeFICCWriteofftoLogin>
        <afterFICCStatus>NB</afterFICCStatus>
        <afterFICCSubStatus>0</afterFICCSubStatus>
        <afterFICCDPD>147</afterFICCDPD>
        <afterFICCWriteoffAmt>NO</afterFICCWriteoffAmt>
        <afterFICCWriteofftoLogin>NO</afterFICCWriteofftoLogin>
        <trackRecordAfterWriteOffMonth>NO</trackRecordAfterWriteOffMonth>
        <noOfLiveCreditCards>0</noOfLiveCreditCards>
        <noOfLivePersonalLoans>0</noOfLivePersonalLoans>
        <noOfLiveHomeLoans>-9</noOfLiveHomeLoans>
        <totalCardsOutstanding>0</totalCardsOutstanding>
        <worstDelinquencyAcrossSecured>-9</worstDelinquencyAcrossSecured>
        <worstDelinquencyAcrossUnSecured>-9</worstDelinquencyAcrossUnSecured>
        <maxMobOfLiveUnsecuredLoans>-9</maxMobOfLiveUnsecuredLoans>
        <cust_info_1>0</cust_info_1>
        <score>-0001</score>
        <NON_FIC_ENQUIRIES_3MTH>6</NON_FIC_ENQUIRIES_3MTH>
        <UNSEC_ENQUIRIES_3MTH>6</UNSEC_ENQUIRIES_3MTH>
        <UNSEC_ENQUIRIES_6MTH>6</UNSEC_ENQUIRIES_6MTH>
        <PL_ENQUIRIES_3MTH>6</PL_ENQUIRIES_3MTH>
        <CARD_ENQUIRIES_6MNTH>-1</CARD_ENQUIRIES_6MNTH>
        <CARD_ENQUIRIES_4MNTH>0</CARD_ENQUIRIES_4MNTH>
        <LOAN_ENQUIRIES_6MNTH>6</LOAN_ENQUIRIES_6MNTH>
        <HL_ENQUIRIES_12MNTH>-1</HL_ENQUIRIES_12MNTH>
        <HL_ENQUIRIES_6MNTH>-1</HL_ENQUIRIES_6MNTH>
        <PL_ENQUIRIES_12MNTH>6</PL_ENQUIRIES_12MNTH>
        <SEC_ENQUIRIES_12MTH>-1</SEC_ENQUIRIES_12MTH>
        <trade_info_10>0</trade_info_10>
        <TOTAL_HL_ENQUIRIES>-1</TOTAL_HL_ENQUIRIES>
        <TOTAL_ENQUIRIES_3MNTH>6</TOTAL_ENQUIRIES_3MNTH>
        <OFFUS_SECURED_ENQUIRIES_12MNTH>0</OFFUS_SECURED_ENQUIRIES_12MNTH>
        <LIVE_UNSECURED_MUE>-1</LIVE_UNSECURED_MUE>
        <OFFUS_PL_ENQUIRIES_12MNTH>6</OFFUS_PL_ENQUIRIES_12MNTH>
        <hlEnquiry>0</hlEnquiry>
        <youngTrade>0</youngTrade>
        <Last_30_DEL>0</Last_30_DEL>
        <TIME_FIRST_TRADEOPENED>0</TIME_FIRST_TRADEOPENED>
        <UNSECURED_TRADES_OPENED_L6M>-1</UNSECURED_TRADES_OPENED_L6M>
        <UNSECURED_LAST_TRADE_OPENED>-1</UNSECURED_LAST_TRADE_OPENED>
        <TOTAL_PASTDUE_BALANCE_SECURED>0</TOTAL_PASTDUE_BALANCE_SECURED>
        <Max_DEL>0</Max_DEL>
        <Max_DEL_HL_6M>0</Max_DEL_HL_6M>
        <Max_DEL_CARD>0</Max_DEL_CARD>
        <Max_DEL_NONCARD>0</Max_DEL_NONCARD>
        <Max_DEL_12MNTH>0</Max_DEL_12MNTH>
        <Max_DEL_24MNTH>0</Max_DEL_24MNTH>
        <Max_DEL_PL_12MNTH>0</Max_DEL_PL_12MNTH>
        <Max_DEL_UNSECURED_6MNTH>0</Max_DEL_UNSECURED_6MNTH>
        <trade_info_11>-1</trade_info_11>
        <LIVE_PL_MUE>-1</LIVE_PL_MUE>
        <LIVE_CARD_MUE>0</LIVE_CARD_MUE>
        <LIVE_CARD_ACCOUNT>-1</LIVE_CARD_ACCOUNT>
        <LIVE_TRADELINE_MUE>-1</LIVE_TRADELINE_MUE>
        <trade_info_12>0</trade_info_12>
        <NoOfAccount_Settled>0</NoOfAccount_Settled>
        <pt_var_23>0</pt_var_23>
        <pt_var_1>0</pt_var_1>
        <pt_var_2>0</pt_var_2>
        <pt_var_3>0</pt_var_3>
        <pt_var_4>0</pt_var_4>
        <pt_var_5>0</pt_var_5>
        <pt_var_6>0</pt_var_6>
        <pt_var_7>0</pt_var_7>
        <pt_var_8>0</pt_var_8>
        <pt_var_9>0</pt_var_9>
        <pt_var_10>0</pt_var_10>
        <pt_var_11>0</pt_var_11>
        <pt_var_12>0</pt_var_12>
        <pt_var_13>0</pt_var_13>
        <pt_var_14>0</pt_var_14>
        <pt_var_15>0</pt_var_15>
        <pt_var_16>0</pt_var_16>
        <pt_var_17>0</pt_var_17>
        <pt_var_18>0</pt_var_18>
        <pt_var_19>0</pt_var_19>
        <pt_var_20>0</pt_var_20>
        <pt_var_21>0</pt_var_21>
        <pt_var_22>0</pt_var_22>
      </cibilBureauDetails>
      <totalAddCardLiabilities>0.0</totalAddCardLiabilities>
      <totalAddLoanLiabilities>0.0</totalAddLoanLiabilities>
      <totalCibilLoanLiabilities>0.0</totalCibilLoanLiabilities>
      <totalCibilCardLiabilities>0.0</totalCibilCardLiabilities>
      <totalLiabilities>0.0</totalLiabilities>
      <prevYearTotalLiabilities>0.0</prevYearTotalLiabilities>
      <existingDebtBurdenServiced>0.0</existingDebtBurdenServiced>
      <gender>M</gender>
      <maritalStatus>1</maritalStatus>
      <noOfMonthsInCurrentJob>0.0</noOfMonthsInCurrentJob>
      <noOfYearsInCurrentJob>0.0</noOfYearsInCurrentJob>
      <noOfYearsInPreviousJob>0.0</noOfYearsInPreviousJob>
      <accomodationType>PARENTL</accomodationType>
      <noOfYearsAtCurrentAddress>10</noOfYearsAtCurrentAddress>
      <noOfMonthsAtCurrentAddress>0.0</noOfMonthsAtCurrentAddress>
      <minYearsAtCurrentAddress>0.0</minYearsAtCurrentAddress>
      <address>
        <currentResidenceAddressOwnershipStatus>PARENTAL OWNED</currentResidenceAddressOwnershipStatus>
        <officeAddressCity>hdjdjdj</officeAddressCity>
        <currentResidenceAddressMobile>8943652533</currentResidenceAddressMobile>
        <noOfMonthsCurrentResidenceAddress>0.0</noOfMonthsCurrentResidenceAddress>
        <noOfYearsCurrentResidenceAddress>0.0</noOfYearsCurrentResidenceAddress>
        <noOfMonthsPermanentResidenceAddress>0.0</noOfMonthsPermanentResidenceAddress>
        <noOfYearsPermanentResidenceAddress>0.0</noOfYearsPermanentResidenceAddress>
        <noOfMonthsOfficeAddress>0.0</noOfMonthsOfficeAddress>
        <noOfYearsOfficeAddress>0.0</noOfYearsOfficeAddress>
        <City>New Delhi</City>
      </address>
      <designation>9</designation>
      <typeOfOrganization>4</typeOfOrganization>
      <abb>0.0</abb>
      <resiStabilityInYears>0.0</resiStabilityInYears>
      <applicantType>01</applicantType>
      <employmentType>K</employmentType>
      <noOfDependants>0</noOfDependants>
      <educationalQualification>2</educationalQualification>
      <organizationType>4</organizationType>
      <noOfYearsWithCurrentEmployer>10</noOfYearsWithCurrentEmployer>
      <companyType>4</companyType>
      <totalYearsInPresentBusiness>0.0</totalYearsInPresentBusiness>
      <cibilScore>-1.0</cibilScore>
      <appDate>2016-06-21</appDate>
      <avgIncomePF>0.0</avgIncomePF>
      <bankBalancePF>0.0</bankBalancePF>
      <officeLandlineNumber>9566224220</officeLandlineNumber>
      <eVerifyScore>0.0</eVerifyScore>
      <cir_Name_Match>0.0</cir_Name_Match>
      <cir_Address1_Match>0.0</cir_Address1_Match>
      <cir_Address2_Match>0.0</cir_Address2_Match>
      <vtr_Name_Match>0.0</vtr_Name_Match>
      <vtr_DOB_Match>0.0</vtr_DOB_Match>
      <vtr_Name_Match_CIR>0.0</vtr_Name_Match_CIR>
      <vtr_DOB_Match_CIR>0.0</vtr_DOB_Match_CIR>
      <pan_Name_Match>0.0</pan_Name_Match>
      <pan_Name_Match_CIR>0.0</pan_Name_Match_CIR>
      <costofHome>0.0</costofHome>
      <costofLand>0.0</costofLand>
      <costofConstruction>0.0</costofConstruction>
      <marketvalueofProperty>0.0</marketvalueofProperty>
      <outstandingLoanBalance>0.0</outstandingLoanBalance>
      <requestedTopupLoanamount>0.0</requestedTopupLoanamount>
      <variableIncome>0.0</variableIncome>
      <annualIncome>0.0</annualIncome>
      <emiperMonth>0.0</emiperMonth>
      <noOfYearsInBusiness>0</noOfYearsInBusiness>
      <customerId>0</customerId>
      <minYearsInBusiness>0</minYearsInBusiness>
      <numberOfInwardBouncedPaymentsPF>0</numberOfInwardBouncedPaymentsPF>
      <numberOfSalaryPensionCreditsPF>0</numberOfSalaryPensionCreditsPF>
      <totalNumberOfTransactionsPF>0</totalNumberOfTransactionsPF>
    </applicant>
    <outputVariables>
      <loanAmount>0.0</loanAmount>
      <rate>0.0</rate>
      <procFee>0.0</procFee>
      <netDisbursalAmount>0.0</netDisbursalAmount>
      <stampDutyAndRegCharges>0.0</stampDutyAndRegCharges>
      <riskStatus>AMBER</riskStatus>
      <riskGrade>GRADEE</riskGrade>
    </outputVariables>
    <loginDate>2017-02-13</loginDate>
    <loanOpenDate>2016-06-21</loanOpenDate>
    <appRefNo>121417</appRefNo>
    <IRR>16.49</IRR>
    <baseIrr>16.49</baseIrr>
    <irrDifference>0.0</irrDifference>
    <rateOfInterest>0.0</rateOfInterest>
    <emiCFA>0.0</emiCFA>
    <emiDebtBurdenRatio>52500.0</emiDebtBurdenRatio>
    <emiOffered>0.0</emiOffered>
    <emiBasisAbb>0.0</emiBasisAbb>
    <appliedTenor>36</appliedTenor>
    <offeredLoanAmt>0.0</offeredLoanAmt>
    <finalLoanAmt>0.0</finalLoanAmt>
    <incrementalLoanAmt>0.0</incrementalLoanAmt>
    <finalLoanAmtFivePercentIncr>0.0</finalLoanAmtFivePercentIncr>
    <finalLoanAmtPlusFee>0.0</finalLoanAmtPlusFee>
    <tier>Metro</tier>
    <loanAmtApplied>0.0</loanAmtApplied>
    <loanAmtBasisDbr>0.0</loanAmtBasisDbr>
    <loanAmtBasisAbb>0.0</loanAmtBasisAbb>
    <loanAmtBasisMultiplier>975000.0</loanAmtBasisMultiplier>
    <netIncomeMultiplier>13.0</netIncomeMultiplier>
    <productTypeCode>FIRSTCALL</productTypeCode>
    <applicantScore>0.0</applicantScore>
    <maxLoanAmount>2000000.0</maxLoanAmount>
    <minLoanAmount>65000.0</minLoanAmount>
    <emiOfTotalUnsecuredLoans>0.0</emiOfTotalUnsecuredLoans>
    <emiOfUnsecuredLoan>0.0</emiOfUnsecuredLoan>
    <emiOfTotalSecuredLoans>0.0</emiOfTotalSecuredLoans>
    <emiOfSecuredLoan>0.0</emiOfSecuredLoan>
    <interestObligationOfCCOrOD>0.0</interestObligationOfCCOrOD>
    <totalObligation>0.0</totalObligation>
    <totalExistingUnsecuredExposure>0.0</totalExistingUnsecuredExposure>
    <currentPOS>0.0</currentPOS>
    <DBRValue>0.7</DBRValue>
    <dumyABB>0.0</dumyABB>
    <requiredLoanAmount>100000.0</requiredLoanAmount>
    <finalTenureRequired>0.0</finalTenureRequired>
    <imputedPL>0.0</imputedPL>
    <imputedCC>0.0</imputedCC>
    <imputedHML>0.0</imputedHML>
    <imputedTW>0.0</imputedTW>
    <imputedCD>0.0</imputedCD>
    <imputedOthers>0.0</imputedOthers>
    <emiBasisCibilLiabilty>0.0</emiBasisCibilLiabilty>
    <totalDeclaredEmiLiabilty>0.0</totalDeclaredEmiLiabilty>
    <imputedOthersCC>0.0</imputedOthersCC>
    <loanPMTNumerator>0.0</loanPMTNumerator>
    <loanPMTDenominator>0.013741666666666666</loanPMTDenominator>
    <emiPMTDenominator>0.0</emiPMTDenominator>
    <emiPMTNumerator>0.013741666666666666</emiPMTNumerator>
    <TIME_TAG_1>0.0</TIME_TAG_1>
    <TIME_TAG_2>0.0</TIME_TAG_2>
    <TIME_TAG_3>0.0</TIME_TAG_3>
    <TIME_TAG_4>0.0</TIME_TAG_4>
    <TIME_TAG_5>0.0</TIME_TAG_5>
    <TIME_TAG_6>0.0</TIME_TAG_6>
    <TIME_TAG_7>0.0</TIME_TAG_7>
    <TIME_TAG_8>0.0</TIME_TAG_8>
    <TIME_TAG_9>0.0</TIME_TAG_9>
    <TIME_TAG_10>0.0</TIME_TAG_10>
    <FF1_TAG_1>0.0</FF1_TAG_1>
    <FF1_TAG_2>0.0</FF1_TAG_2>
    <FF2_TAG_1>0.0</FF2_TAG_1>
    <FF2_TAG_2>0.0</FF2_TAG_2>
    <FF3_TAG_1>0.0</FF3_TAG_1>
    <FF3_TAG_2>0.0</FF3_TAG_2>
    <FF4_TAG_1>0.0</FF4_TAG_1>
    <FF4_TAG_2>0.0</FF4_TAG_2>
    <FF5_TAG_1>0.0</FF5_TAG_1>
    <FF5_TAG_2>0.0</FF5_TAG_2>
    <FF6_TAG_1>0.0</FF6_TAG_1>
    <FF6_TAG_2>0.0</FF6_TAG_2>
    <FF7_TAG_1>0.0</FF7_TAG_1>
    <FF7_TAG_2>0.0</FF7_TAG_2>
    <FF8_TAG_1>0.0</FF8_TAG_1>
    <FF8_TAG_2>0.0</FF8_TAG_2>
    <FF9_TAG_1>0.0</FF9_TAG_1>
    <FF9_TAG_2>0.0</FF9_TAG_2>
    <FF10_TAG_1>0.0</FF10_TAG_1>
    <FF10_TAG_2>0.0</FF10_TAG_2>
    <FF11_TAG_1>0.0</FF11_TAG_1>
    <FF11_TAG_2>0.0</FF11_TAG_2>
    <FF12_TAG_1>0.0</FF12_TAG_1>
    <FF12_TAG_2>0.0</FF12_TAG_2>
    <FF13_TAG_1>0.0</FF13_TAG_1>
    <FF13_TAG_2>0.0</FF13_TAG_2>
    <FF14_TAG_1>0.0</FF14_TAG_1>
    <FF14_TAG_2>0.0</FF14_TAG_2>
    <FF15_TAG_1>0.0</FF15_TAG_1>
    <FF15_TAG_2>0.0</FF15_TAG_2>
    <FF16_TAG_1>0.0</FF16_TAG_1>
    <FF16_TAG_2>0.0</FF16_TAG_2>
    <FF17_TAG_1>0.0</FF17_TAG_1>
    <FF17_TAG_2>0.0</FF17_TAG_2>
    <FF18_TAG_1>0.0</FF18_TAG_1>
    <FF18_TAG_2>0.0</FF18_TAG_2>
    <FF19_TAG_1>0.0</FF19_TAG_1>
    <FF19_TAG_2>0.0</FF19_TAG_2>
    <FF20_TAG_1>0.0</FF20_TAG_1>
    <FF20_TAG_2>0.0</FF20_TAG_2>
    <FF21_TAG_1>0.0</FF21_TAG_1>
    <FF21_TAG_2>0.0</FF21_TAG_2>
    <FF22_TAG_1>0.0</FF22_TAG_1>
    <FF22_TAG_2>0.0</FF22_TAG_2>
    <FF23_TAG_1>0.0</FF23_TAG_1>
    <FF23_TAG_2>0.0</FF23_TAG_2>
    <FF24_TAG_1>0.0</FF24_TAG_1>
    <FF24_TAG_2>0.0</FF24_TAG_2>
    <FF25_TAG_1>0.0</FF25_TAG_1>
    <FF25_TAG_2>0.0</FF25_TAG_2>
    <FF26_TAG_1>0.0</FF26_TAG_1>
    <FF26_TAG_2>0.0</FF26_TAG_2>
    <FF27_TAG_1>0.0</FF27_TAG_1>
    <FF27_TAG_2>0.0</FF27_TAG_2>
    <FF28_TAG_1>0.0</FF28_TAG_1>
    <FF28_TAG_2>0.0</FF28_TAG_2>
    <FF29_TAG_1>0.0</FF29_TAG_1>
    <FF29_TAG_2>0.0</FF29_TAG_2>
    <FF30_TAG_1>0.0</FF30_TAG_1>
    <FF30_TAG_2>0.0</FF30_TAG_2>
    <FF31_TAG_1>0.0</FF31_TAG_1>
    <FF31_TAG_2>0.0</FF31_TAG_2>
    <FF32_TAG_1>0.0</FF32_TAG_1>
    <FF32_TAG_2>0.0</FF32_TAG_2>
    <FF33_TAG_1>0.0</FF33_TAG_1>
    <FF33_TAG_2>0.0</FF33_TAG_2>
    <FF34_TAG_1>0.0</FF34_TAG_1>
    <FF34_TAG_2>0.0</FF34_TAG_2>
    <FF35_TAG_1>0.0</FF35_TAG_1>
    <FF35_TAG_2>0.0</FF35_TAG_2>
    <FF36_TAG_1>0.0</FF36_TAG_1>
    <FF36_TAG_2>0.0</FF36_TAG_2>
    <FF37_TAG_1>0.0</FF37_TAG_1>
    <FF37_TAG_2>0.0</FF37_TAG_2>
    <FF38_TAG_1>0.0</FF38_TAG_1>
    <FF38_TAG_2>0.0</FF38_TAG_2>
    <FF39_TAG_1>0.0</FF39_TAG_1>
    <FF39_TAG_2>0.0</FF39_TAG_2>
    <FF40_TAG_1>0.0</FF40_TAG_1>
    <FF40_TAG_2>0.0</FF40_TAG_2>
    <renovationLoan>0.0</renovationLoan>
    <loanDisbursementDate>2017-02-13</loanDisbursementDate>
    <applicableProgram/>
    <disbursentInSecondHalfMonth/>
    <appRefStatus/>
    <applicationStatus/>
    <loanStatus/>
    <totalDebtBurden>0</totalDebtBurden>
    <totalDebt>0</totalDebt>
    <totalDebtBurdenPercent>0</totalDebtBurdenPercent>
    <emiComfortable>0</emiComfortable>
    <emiMaximum>0</emiMaximum>
    <emiBasisMultiplier>0</emiBasisMultiplier>
    <branchCode/>
    <isResidenceCpvWaived/>
    <servicingBranchcode/>
    <breRun>2017-02-13</breRun>
    <deviations>
      <deviationMessage>Unsecured enquiries in last 6 months larger than or equal to 5</deviationMessage>
      <deviationSeverity>L4</deviationSeverity>
      <approvalAuthority>RCM</approvalAuthority>
      <isCibil>NO</isCibil>
    </deviations>
    <gradeType>grade B</gradeType>
    <loanProgramType>1</loanProgramType>
  </loanApplication>
  <source>PLSALARIED</source>
  <isSynchronous>YES</isSynchronous>
  <randomNumber>0.0</randomNumber>
  <logMessages>Ruleset Name : Derivation Rules. Rule Name : deriveAgeatMaturity</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_1_cardInfo</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_2_tradecurrentx</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_3_enqoffus6m</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_4_resi</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_5_livehl</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_6_agebureau</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_7_ever90plus</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_8_delratio</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_9_phonejob</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_10_fixphone</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_11_resitype</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_12_loanamount</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_13_sex</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_14_enqcard</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_15_eduage</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_16_jobmonth</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_17_enqunsec3m</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_18_resimonth</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_19_phonetype</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_20_enqhl</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_21_appscore</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_22_Phoneiszero</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : NoOfYearsCurrentResiInMonths</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : pt_var_23_Division</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : SPL</logMessages>
  <logMessages>Ruleset Name : ScorePoint_Ruleset. Rule Name : Total trades smaller than or equal to zero</logMessages>
  <logMessages>Ruleset Name : BureauPolicy_Ruleset. Rule Name : Unsec Enquiry 6 month Amber</logMessages>
  <logMessages>Ruleset Name : RiskGrade_Ruleset. Rule Name : Risk Grade E</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : Derive Grade B</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : BASE IRR METRO TIER1 AUG 2016</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : IRR=BASE IRR</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : lOAN PMT NUMERATOR</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : lOAN PMT DENOMINATOR</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : EMI PMT NUMERATOR</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : Loan Program type</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : EMI PMT DENOMINATOR</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : EmiBasusCibilLiability</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : DBR DT New Feb 15</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : Net Income Multiplier DT 2016</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : DeriveMaxLoanAmount DT</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : DeriveMinLoanAmount DT</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : Net Adjusted Income</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : Calculate EMI Basis DBR IC</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : lOANAMTBASIS DBR</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : Loanamtbasis dbr Rounding</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : ComputeLoanAmountbasisMultiplier</logMessages>
  <logMessages>Ruleset Name : AIP_Ruleset. Rule Name : Calculate LoanAmount</logMessages>
  <logMessages>Ruleset Name : NonDigitalPL_Ruleset. Rule Name : NMTHS</logMessages>
</loanContract>
)
*/
?>