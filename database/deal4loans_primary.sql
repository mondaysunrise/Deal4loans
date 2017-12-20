-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2017 at 01:38 PM
-- Server version: 5.6.35-log
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `deal4loans_primary`
--

-- --------------------------------------------------------

--
-- Table structure for table `Advertise_with_us`
--

CREATE TABLE IF NOT EXISTS `Advertise_with_us` (
  `advertiseid` int(11) NOT NULL,
  `from_name` varchar(100) NOT NULL,
  `from_email` varchar(200) NOT NULL,
  `from_contact` bigint(20) NOT NULL,
  `from_content` varchar(255) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allocation_leads_barclays`
--

CREATE TABLE IF NOT EXISTS `allocation_leads_barclays` (
  `id` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Reply_Type` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `amex_cardwebservice`
--

CREATE TABLE IF NOT EXISTS `amex_cardwebservice` (
  `amex_ccid` int(11) NOT NULL,
  `requestID` int(11) NOT NULL,
  `card_selected` varchar(200) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `amex_negative_pincode`
--

CREATE TABLE IF NOT EXISTS `amex_negative_pincode` (
  `id` int(11) NOT NULL,
  `city` varchar(40) NOT NULL,
  `pincode` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api_customer_cibil`
--

CREATE TABLE IF NOT EXISTS `api_customer_cibil` (
  `id` int(11) NOT NULL,
  `cibil_id` int(11) DEFAULT NULL,
  `process_source` varchar(50) DEFAULT NULL,
  `url_created` text,
  `url_created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `first_name` varchar(35) DEFAULT NULL,
  `middle_name` varchar(35) DEFAULT NULL,
  `last_name` varchar(35) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `mobile_number` bigint(20) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `pancard` varchar(10) DEFAULT NULL,
  `residence_address` varchar(255) DEFAULT NULL,
  `residence_pincode` mediumint(8) DEFAULT NULL,
  `city_name` varchar(50) DEFAULT NULL,
  `state_code` varchar(2) DEFAULT NULL,
  `legal_response` varchar(45) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `cibil_score` int(11) DEFAULT '0',
  `cibil_score_fetch_date` datetime DEFAULT NULL,
  `cibil_status` varchar(45) DEFAULT NULL,
  `mail_sent` tinyint(4) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(20) DEFAULT NULL,
  `browser_type` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api_log_cibil`
--

CREATE TABLE IF NOT EXISTS `api_log_cibil` (
  `id` int(11) NOT NULL,
  `product` varchar(20) NOT NULL,
  `productid` int(10) unsigned NOT NULL,
  `api_from` varchar(45) NOT NULL,
  `cibil_id` int(11) DEFAULT NULL,
  `api_version` varchar(10) DEFAULT NULL,
  `url_end_point` varchar(80) DEFAULT NULL,
  `api_request_data` text,
  `api_response_data` longtext,
  `cibil_status` varchar(20) DEFAULT NULL,
  `cibil_score` varchar(45) DEFAULT NULL,
  `cibil_score_fetch_date` datetime NOT NULL,
  `cibil_email` varchar(100) DEFAULT NULL,
  `cibil_password` varchar(100) DEFAULT NULL,
  `mail_sent` tinyint(1) NOT NULL DEFAULT '0',
  `mail_json` varchar(255) NOT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api_log_cibil_dummy`
--

CREATE TABLE IF NOT EXISTS `api_log_cibil_dummy` (
  `id` int(11) NOT NULL,
  `product` varchar(10) NOT NULL,
  `productid` int(10) unsigned NOT NULL,
  `api_from` varchar(45) NOT NULL,
  `cibil_id` int(11) DEFAULT NULL,
  `api_version` varchar(10) DEFAULT NULL,
  `url_end_point` varchar(45) DEFAULT NULL,
  `api_request_data` text,
  `api_response_data` longtext,
  `cibil_status` varchar(20) DEFAULT NULL,
  `cibil_score` varchar(45) DEFAULT NULL,
  `cibil_email` varchar(100) DEFAULT NULL,
  `cibil_password` varchar(100) DEFAULT NULL,
  `mail_sent` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apply_pl_capitalfirst`
--

CREATE TABLE IF NOT EXISTS `apply_pl_capitalfirst` (
  `capitalfirstid` int(11) NOT NULL,
  `capitalfirst_name` varchar(50) NOT NULL DEFAULT '',
  `capitalfirst_email` varchar(100) DEFAULT NULL,
  `capitalfirst_mobile_number` bigint(20) NOT NULL,
  `capitalfirst_occupation` varchar(20) DEFAULT NULL,
  `capitalfirst_totalexp` decimal(5,2) NOT NULL,
  `capitalfirst_dob` date NOT NULL,
  `capitalfirst_city` varchar(30) DEFAULT NULL,
  `capitalfirst_city_other` varchar(50) DEFAULT NULL,
  `capitalfirst_panno` varchar(20) NOT NULL,
  `capitalfirst_marital_stat` varchar(10) NOT NULL,
  `capitalfirst_gender` varchar(50) DEFAULT NULL,
  `capitalfirst_purpose_ofloan` varchar(50) NOT NULL,
  `capitalfirst_current_address` text NOT NULL,
  `capitalfirst_resipincode` varchar(10) DEFAULT NULL,
  `capitalfirst_property_stat` varchar(100) NOT NULL,
  `capitalfirst_annual_income` decimal(12,2) NOT NULL,
  `capitalfirst_company_name` varchar(255) NOT NULL,
  `capitalfirst_office_address` text NOT NULL,
  `capitalfirst_officepincode` varchar(10) NOT NULL,
  `capitalfirst_requestid` int(11) NOT NULL,
  `capitalfirst_dated` datetime NOT NULL,
  `direct_flag` tinyint(4) NOT NULL,
  `first_webservice` varchar(255) DEFAULT NULL,
  `first_webdated` datetime NOT NULL,
  `second_webservice` varchar(255) DEFAULT NULL,
  `second_webdated` datetime NOT NULL,
  `third_webservice` varchar(250) DEFAULT NULL,
  `third_webdated` datetime NOT NULL,
  `direct_webserviceflag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Articles`
--

CREATE TABLE IF NOT EXISTS `Articles` (
  `Art_ID` int(10) NOT NULL,
  `Art_Main_Title` varchar(100) NOT NULL DEFAULT '',
  `Art_Sub_Title` varchar(200) NOT NULL DEFAULT '',
  `Art_Content` text NOT NULL,
  `Art_Url` varchar(255) NOT NULL DEFAULT '',
  `Art_DOE` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Art_approve` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ask_Amitoj_Reply`
--

CREATE TABLE IF NOT EXISTS `Ask_Amitoj_Reply` (
  `AskReplyID` int(10) NOT NULL,
  `AskID` int(10) NOT NULL DEFAULT '0',
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(50) NOT NULL DEFAULT '',
  `Message` text NOT NULL,
  `Thankyou_Message` text,
  `Added_Message` text NOT NULL,
  `Reply_Message` text NOT NULL,
  `Is_Verified` tinyint(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Ask_Amitoj_Section`
--

CREATE TABLE IF NOT EXISTS `Ask_Amitoj_Section` (
  `AskID` int(11) NOT NULL,
  `Ask_Name` varchar(50) DEFAULT NULL,
  `Ask_Email` varchar(100) DEFAULT NULL,
  `Ask_City` varchar(50) DEFAULT NULL,
  `Ask_Emp_Status` tinyint(4) DEFAULT NULL,
  `Ask_Mobile` varchar(50) DEFAULT NULL,
  `Ask_Net_Salary` varchar(50) DEFAULT NULL,
  `Ask_Loan_Type` varchar(50) DEFAULT NULL,
  `Ask_EMI_Amount` int(11) DEFAULT NULL,
  `Ask_EMI_Paid` varchar(50) DEFAULT NULL,
  `Ask_Loan_Tenure` int(11) DEFAULT NULL,
  `Ask_ROI_Loan` varchar(50) DEFAULT '0',
  `Ask_CC_Holder` tinyint(4) NOT NULL DEFAULT '0',
  `Ask_CC_Due` int(11) NOT NULL DEFAULT '0',
  `Ask_Loan_On_CC` tinyint(4) NOT NULL DEFAULT '0',
  `Ask_Residential_Status` tinyint(4) NOT NULL DEFAULT '0',
  `Ask_Vehicle_Owned` tinyint(4) NOT NULL DEFAULT '0',
  `Ask_Query` text NOT NULL,
  `Ask_Dated` datetime DEFAULT NULL,
  `Ask_Valid` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `automated_mailers`
--

CREATE TABLE IF NOT EXISTS `automated_mailers` (
  `automatID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `City` varchar(100) NOT NULL,
  `email_to` varchar(255) NOT NULL,
  `email_cc` varchar(255) NOT NULL,
  `stat_flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `axis_mailers`
--

CREATE TABLE IF NOT EXISTS `axis_mailers` (
  `id` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Reply_Type` int(11) NOT NULL,
  `City` varchar(60) NOT NULL,
  `to` varchar(255) NOT NULL,
  `cc` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bajajallianz_carloancomp`
--

CREATE TABLE IF NOT EXISTS `bajajallianz_carloancomp` (
  `bajaj_clid` int(11) NOT NULL,
  `requestid` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `income` decimal(12,2) NOT NULL,
  `car_type` tinyint(4) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bajajfinserv_bidders`
--

CREATE TABLE IF NOT EXISTS `bajajfinserv_bidders` (
  `bajajfinservid` int(11) NOT NULL,
  `bfs_name` varchar(100) NOT NULL,
  `bfs_bidderid` int(11) NOT NULL,
  `bfs_city` varchar(200) NOT NULL,
  `bfs_mobileno` varchar(200) NOT NULL,
  `bfs_emailid` varchar(200) NOT NULL,
  `bfs_ccemailid` varchar(250) NOT NULL,
  `bfs_date` datetime NOT NULL,
  `bfs_status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bajajfinserv_bldetails`
--

CREATE TABLE IF NOT EXISTS `bajajfinserv_bldetails` (
  `bajajblid` int(11) NOT NULL,
  `bajaj_bidderid` int(11) NOT NULL,
  `bajaj_city` varchar(200) NOT NULL,
  `bajaj_rmname` varchar(100) NOT NULL,
  `bajaj_toemailid` varchar(200) NOT NULL,
  `bajaj_ccemailid` text NOT NULL,
  `bajaj_flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bajajfinserv_citypsf_mapping`
--

CREATE TABLE IF NOT EXISTS `bajajfinserv_citypsf_mapping` (
  `bajajfmapid` int(11) NOT NULL,
  `bajajf_city` varchar(100) NOT NULL,
  `bajajf_psf` varchar(100) NOT NULL,
  `bajajf_contact` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bajaj_cibildetails`
--

CREATE TABLE IF NOT EXISTS `bajaj_cibildetails` (
  `bajajcibilid` int(11) NOT NULL,
  `bajajf_plrequestid` int(11) NOT NULL,
  `bajajf_name` varchar(20) NOT NULL,
  `bajajf_mobile` bigint(20) NOT NULL,
  `bajajf_city` varchar(50) NOT NULL,
  `bajajf_dob` date NOT NULL,
  `bajajf_gender` tinyint(4) NOT NULL,
  `bajajf_loan_amt` decimal(12,2) NOT NULL,
  `bajajf_panno` varchar(20) NOT NULL,
  `bajajf_caddress` text NOT NULL,
  `residence_landline` varchar(20) NOT NULL,
  `bajajf_cstate` varchar(50) NOT NULL,
  `bajajf_cpincode` int(11) NOT NULL,
  `bajajf_company_name` varchar(255) NOT NULL,
  `bajajf_paddress` text NOT NULL,
  `bajajf_pstate` varchar(50) NOT NULL,
  `bajajf_ppincode` int(11) NOT NULL,
  `bajajf_salary` decimal(12,2) NOT NULL,
  `bajajf_source` varchar(50) NOT NULL,
  `bajaj_dated` datetime NOT NULL,
  `purpose_of_loan` varchar(50) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `marital_status` tinyint(4) NOT NULL,
  `bajajf_maritalstatus` varchar(20) NOT NULL,
  `no_of_dependent` tinyint(4) NOT NULL,
  `residence_type` varchar(100) NOT NULL,
  `residing_since` varchar(20) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `current_experience` varchar(20) NOT NULL,
  `total_experience` varchar(20) NOT NULL,
  `office_city` varchar(50) NOT NULL,
  `office_address` varchar(200) NOT NULL,
  `office_landline` varchar(50) NOT NULL,
  `office_email` varchar(50) NOT NULL,
  `bajajfg_feedback` varchar(200) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `bajajf_section` varchar(100) NOT NULL,
  `bajaj_request_json` text NOT NULL,
  `bajaj_json` text NOT NULL,
  `bajajf_eligibility` text,
  `Referenceno` varchar(50) DEFAULT NULL,
  `MCPCheck` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bajaj_finserv_mailer_leads`
--

CREATE TABLE IF NOT EXISTS `bajaj_finserv_mailer_leads` (
  `bajaj_finservid` int(11) NOT NULL,
  `bajajf_requestid` int(11) NOT NULL DEFAULT '0',
  `bajajf_product` varchar(20) NOT NULL DEFAULT '',
  `bajajf_name` varchar(50) NOT NULL DEFAULT '',
  `bajajf_email` varchar(100) NOT NULL DEFAULT '',
  `bajajf_mobile` bigint(20) NOT NULL DEFAULT '0',
  `bajajf_dob` date NOT NULL,
  `bajajf_employment_status` tinyint(4) NOT NULL,
  `bajajf_city` varchar(50) NOT NULL DEFAULT '',
  `bajajf_city_other` varchar(50) NOT NULL DEFAULT '',
  `bajajf_company_name` varchar(200) NOT NULL DEFAULT '',
  `bajajf_net_salary` decimal(12,2) NOT NULL DEFAULT '0.00',
  `bajajf_loan_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `bajajf_panno` varchar(20) NOT NULL,
  `bajajf_pincode` varchar(50) NOT NULL DEFAULT '',
  `bajajf_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `residence_address` varchar(50) NOT NULL,
  `residence_landline` varchar(50) NOT NULL,
  `purpose_of_loan` varchar(50) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `marital_status` tinyint(4) NOT NULL,
  `no_of_dependent` tinyint(4) NOT NULL,
  `residence_type` varchar(100) NOT NULL,
  `residing_since` varchar(20) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `current_experience` varchar(20) NOT NULL,
  `total_experience` varchar(20) NOT NULL,
  `office_address` varchar(200) NOT NULL,
  `office_landline` varchar(50) NOT NULL,
  `office_email` varchar(50) NOT NULL,
  `bajajf_source` varchar(20) NOT NULL,
  `bajajf_sent` tinyint(4) NOT NULL DEFAULT '0',
  `bajajf_feedback` varchar(200) NOT NULL,
  `sms_flag` tinyint(4) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `bajajf_section` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bajaj_finserv_mailer_leads_data`
--

CREATE TABLE IF NOT EXISTS `bajaj_finserv_mailer_leads_data` (
  `bajaj_finservid` int(11) NOT NULL,
  `bajajf_requestid` int(11) NOT NULL DEFAULT '0',
  `bajajf_product` varchar(20) NOT NULL DEFAULT '',
  `bajajf_name` varchar(50) NOT NULL DEFAULT '',
  `bajajf_email` varchar(100) NOT NULL DEFAULT '',
  `bajajf_mobile` bigint(20) NOT NULL DEFAULT '0',
  `bajajf_dob` date NOT NULL,
  `bajajf_employment_status` tinyint(4) NOT NULL,
  `bajajf_city` varchar(50) NOT NULL DEFAULT '',
  `bajajf_city_other` varchar(50) NOT NULL,
  `bajajf_company_name` varchar(200) NOT NULL DEFAULT '',
  `bajajf_net_salary` decimal(12,2) NOT NULL DEFAULT '0.00',
  `bajajf_loan_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `bajajf_panno` varchar(20) NOT NULL,
  `bajajf_pincode` varchar(50) NOT NULL DEFAULT '',
  `bajajf_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `residence_address` varchar(50) NOT NULL,
  `residence_landline` varchar(50) NOT NULL,
  `purpose_of_loan` varchar(50) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `marital_status` tinyint(4) NOT NULL,
  `no_of_dependent` tinyint(4) NOT NULL,
  `residence_type` varchar(100) NOT NULL,
  `residing_since` varchar(20) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `current_experience` varchar(20) NOT NULL,
  `total_experience` varchar(20) NOT NULL,
  `office_address` varchar(200) NOT NULL,
  `office_landline` varchar(50) NOT NULL,
  `office_email` varchar(50) NOT NULL,
  `bajajf_source` varchar(20) NOT NULL,
  `bajajf_sent` tinyint(4) NOT NULL DEFAULT '0',
  `bajajf_feedback` varchar(200) NOT NULL,
  `sms_flag` tinyint(4) NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank_documents_required`
--

CREATE TABLE IF NOT EXISTS `bank_documents_required` (
  `documentid` int(11) NOT NULL,
  `identification_proof` varchar(255) NOT NULL DEFAULT '',
  `residence_proof` varchar(255) NOT NULL DEFAULT '',
  `income_proof` varchar(255) NOT NULL DEFAULT '',
  `document_proof` varchar(255) NOT NULL DEFAULT '',
  `bank_name` varchar(100) NOT NULL DEFAULT '',
  `BankID` int(11) NOT NULL DEFAULT '0',
  `product_type` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bank_Master`
--

CREATE TABLE IF NOT EXISTS `Bank_Master` (
  `BankID` int(11) NOT NULL,
  `Bank_Name` varchar(50) NOT NULL DEFAULT '',
  `abbr` varchar(10) NOT NULL DEFAULT '',
  `logo` varchar(200) NOT NULL,
  `vw_flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Barclays_Credit_Card`
--

CREATE TABLE IF NOT EXISTS `Barclays_Credit_Card` (
  `BarclayID` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(20) NOT NULL DEFAULT '',
  `City` varchar(20) NOT NULL DEFAULT '',
  `Reference_Code` int(10) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barclays_pincode_list`
--

CREATE TABLE IF NOT EXISTS `barclays_pincode_list` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL DEFAULT '',
  `pincode` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `BD_List`
--

CREATE TABLE IF NOT EXISTS `BD_List` (
  `BD_ID` int(11) NOT NULL,
  `BD_Name` varchar(80) NOT NULL DEFAULT '',
  `BD_Manager` varchar(80) NOT NULL DEFAULT '',
  `BD_Number` bigint(20) NOT NULL DEFAULT '0',
  `BD_Email` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `BD_Mgmt_Entry`
--

CREATE TABLE IF NOT EXISTS `BD_Mgmt_Entry` (
  `BME_ID` tinyint(5) NOT NULL,
  `BME_BidderName` varchar(50) NOT NULL DEFAULT '',
  `BME_Mobile` bigint(10) NOT NULL DEFAULT '0',
  `BME_Product` varchar(10) NOT NULL DEFAULT '',
  `BME_Email` varchar(100) NOT NULL DEFAULT '',
  `BME_Feedback` text NOT NULL,
  `BMU_Name` varchar(80) NOT NULL DEFAULT '0',
  `BME_Followup` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `BD_Mgmt_User`
--

CREATE TABLE IF NOT EXISTS `BD_Mgmt_User` (
  `BMU_ID` tinyint(5) NOT NULL,
  `BMU_Name` varchar(50) NOT NULL DEFAULT '',
  `BMU_UserName` varchar(50) NOT NULL DEFAULT '',
  `BMU_Password` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `BidderDownloadCount`
--

CREATE TABLE IF NOT EXISTS `BidderDownloadCount` (
  `BD_ID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `BidderName` varchar(60) NOT NULL DEFAULT '',
  `BidderProduct` varchar(60) NOT NULL DEFAULT '',
  `BidderTable` varchar(60) NOT NULL DEFAULT '',
  `BidderSession` varchar(70) NOT NULL DEFAULT '',
  `NoofRecords` int(11) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MinDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MaxDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `BidderDownloadCount_new`
--

CREATE TABLE IF NOT EXISTS `BidderDownloadCount_new` (
  `BD_ID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `BidderName` varchar(60) NOT NULL DEFAULT '',
  `BidderProduct` varchar(60) NOT NULL DEFAULT '',
  `BidderTable` varchar(60) NOT NULL DEFAULT '',
  `BidderSession` varchar(70) NOT NULL DEFAULT '',
  `NoofRecords` int(11) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MinDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `MaxDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders`
--

CREATE TABLE IF NOT EXISTS `Bidders` (
  `BidderID` int(10) unsigned NOT NULL,
  `Email` varchar(50) NOT NULL DEFAULT '',
  `PWD` varchar(200) NOT NULL DEFAULT '',
  `Bidder_Name` varchar(100) NOT NULL DEFAULT '',
  `Associated_Bank` varchar(50) NOT NULL DEFAULT '' COMMENT 'Do not change',
  `Process_Name` varchar(200) NOT NULL COMMENT 'For LMS Process only',
  `Selection_Category` tinyint(5) NOT NULL DEFAULT '0',
  `City` varchar(255) NOT NULL DEFAULT '',
  `bidders_feedback_list` text NOT NULL,
  `Address` varchar(100) NOT NULL DEFAULT '',
  `Website` varchar(100) NOT NULL DEFAULT '',
  `Email_old` varchar(50) NOT NULL DEFAULT '',
  `Contact_Num` varchar(30) NOT NULL DEFAULT '',
  `Profile` text NOT NULL,
  `Join_Date` date NOT NULL DEFAULT '0000-00-00',
  `Last_Login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Count_Replies` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Has_New_Reply` tinyint(1) DEFAULT NULL,
  `Is_Verified` int(10) DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `BidderEmailID` text NOT NULL,
  `FeedbackMailID` varchar(250) NOT NULL DEFAULT '',
  `BD_Name` varchar(50) NOT NULL DEFAULT '',
  `Manager_Name` varchar(100) NOT NULL DEFAULT '',
  `BD_Number` varchar(50) NOT NULL DEFAULT '',
  `Define_PrePost` varchar(8) NOT NULL DEFAULT '',
  `Prepaid_Amount` int(9) NOT NULL DEFAULT '0',
  `Global_Access_ID` varchar(50) NOT NULL DEFAULT '0',
  `agent_lead_count` int(11) NOT NULL,
  `leadidentifier` varchar(60) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `CallStatus` tinyint(4) NOT NULL,
  `dialler_process` int(11) NOT NULL,
  `app_active` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bidderslms_call_log`
--

CREATE TABLE IF NOT EXISTS `bidderslms_call_log` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `call_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bidderslms_call_summary_log`
--

CREATE TABLE IF NOT EXISTS `bidderslms_call_summary_log` (
  `id` int(11) NOT NULL,
  `Visitor__number` varchar(15) NOT NULL,
  `Visitor_name` varchar(150) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `call_date_time` datetime NOT NULL,
  `call_duration` varchar(10) NOT NULL,
  `status` datetime NOT NULL,
  `call_units` varchar(15) NOT NULL,
  `call_amount` int(11) NOT NULL,
  `Visitor_ip` varchar(20) NOT NULL,
  `visitor_circle` varchar(150) NOT NULL,
  `operator` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `BiddersLoginDetails`
--

CREATE TABLE IF NOT EXISTS `BiddersLoginDetails` (
  `TrackID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Bidder_Name` varchar(100) NOT NULL DEFAULT '',
  `Reply_Type` varchar(20) NOT NULL DEFAULT '',
  `First_Login_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Month_Details` int(4) NOT NULL DEFAULT '0',
  `Date_01` tinytext NOT NULL,
  `Date_02` tinytext NOT NULL,
  `Date_03` tinytext NOT NULL,
  `Date_04` tinytext NOT NULL,
  `Date_05` tinytext NOT NULL,
  `Date_06` tinytext NOT NULL,
  `Date_07` tinytext NOT NULL,
  `Date_08` tinytext NOT NULL,
  `Date_09` tinytext NOT NULL,
  `Date_10` tinytext NOT NULL,
  `Date_11` tinytext NOT NULL,
  `Date_12` tinytext NOT NULL,
  `Date_13` tinytext NOT NULL,
  `Date_14` tinytext NOT NULL,
  `Date_15` tinytext NOT NULL,
  `Date_16` tinytext NOT NULL,
  `Date_17` tinytext NOT NULL,
  `Date_18` tinytext NOT NULL,
  `Date_19` tinytext NOT NULL,
  `Date_20` tinytext NOT NULL,
  `Date_21` tinytext NOT NULL,
  `Date_22` tinytext NOT NULL,
  `Date_23` tinytext NOT NULL,
  `Date_24` tinytext NOT NULL,
  `Date_25` tinytext NOT NULL,
  `Date_26` tinytext NOT NULL,
  `Date_27` tinytext NOT NULL,
  `Date_28` tinytext NOT NULL,
  `Date_29` tinytext NOT NULL,
  `Date_30` tinytext NOT NULL,
  `Date_31` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Book_Keeping`
--

CREATE TABLE IF NOT EXISTS `Bidders_Book_Keeping` (
  `BookID` int(9) NOT NULL,
  `BidderID` int(9) NOT NULL DEFAULT '0',
  `BookProduct` tinyint(2) NOT NULL DEFAULT '0',
  `BookDate` tinyint(2) NOT NULL DEFAULT '0',
  `BookWeek` tinyint(2) NOT NULL DEFAULT '0',
  `BookMonth` tinyint(2) NOT NULL DEFAULT '0',
  `BookYear` int(4) NOT NULL DEFAULT '0',
  `BookLeadCount` int(9) NOT NULL DEFAULT '0',
  `BookEntryTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Book_Keeping_CC`
--

CREATE TABLE IF NOT EXISTS `Bidders_Book_Keeping_CC` (
  `BookID` int(9) NOT NULL,
  `BidderID` int(9) NOT NULL DEFAULT '0',
  `BookProduct` tinyint(2) NOT NULL DEFAULT '0',
  `BookDate` tinyint(2) NOT NULL DEFAULT '0',
  `BookWeek` tinyint(2) NOT NULL DEFAULT '0',
  `BookMonth` tinyint(2) NOT NULL DEFAULT '0',
  `BookYear` int(4) NOT NULL DEFAULT '0',
  `BookLeadCount` int(9) NOT NULL DEFAULT '0',
  `BookEntryTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Book_Keeping_CL`
--

CREATE TABLE IF NOT EXISTS `Bidders_Book_Keeping_CL` (
  `BookID` int(9) NOT NULL,
  `BidderID` int(9) NOT NULL DEFAULT '0',
  `BookProduct` tinyint(2) NOT NULL DEFAULT '0',
  `BookDate` tinyint(2) NOT NULL DEFAULT '0',
  `BookWeek` tinyint(2) NOT NULL DEFAULT '0',
  `BookMonth` tinyint(2) NOT NULL DEFAULT '0',
  `BookYear` int(4) NOT NULL DEFAULT '0',
  `BookLeadCount` int(9) NOT NULL DEFAULT '0',
  `BookEntryTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Book_Keeping_dec11`
--

CREATE TABLE IF NOT EXISTS `Bidders_Book_Keeping_dec11` (
  `BookID` int(9) NOT NULL,
  `BidderID` int(9) NOT NULL DEFAULT '0',
  `BookProduct` tinyint(2) NOT NULL DEFAULT '0',
  `BookDate` tinyint(2) NOT NULL DEFAULT '0',
  `BookWeek` tinyint(2) NOT NULL DEFAULT '0',
  `BookMonth` tinyint(2) NOT NULL DEFAULT '0',
  `BookYear` int(4) NOT NULL DEFAULT '0',
  `BookLeadCount` int(9) NOT NULL DEFAULT '0',
  `BookEntryTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Book_Keeping_HL`
--

CREATE TABLE IF NOT EXISTS `Bidders_Book_Keeping_HL` (
  `BookID` int(9) NOT NULL,
  `BidderID` int(9) NOT NULL DEFAULT '0',
  `BookProduct` tinyint(2) NOT NULL DEFAULT '0',
  `BookDate` tinyint(2) NOT NULL DEFAULT '0',
  `BookWeek` tinyint(2) NOT NULL DEFAULT '0',
  `BookMonth` tinyint(2) NOT NULL DEFAULT '0',
  `BookYear` int(4) NOT NULL DEFAULT '0',
  `BookLeadCount` int(9) NOT NULL DEFAULT '0',
  `BookEntryTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Book_Keeping_ivr`
--

CREATE TABLE IF NOT EXISTS `Bidders_Book_Keeping_ivr` (
  `BookID` int(9) NOT NULL,
  `BidderID` int(9) NOT NULL DEFAULT '0',
  `BookProduct` tinyint(2) NOT NULL DEFAULT '0',
  `BookDate` tinyint(2) NOT NULL DEFAULT '0',
  `BookWeek` tinyint(2) NOT NULL DEFAULT '0',
  `BookMonth` tinyint(2) NOT NULL DEFAULT '0',
  `BookYear` int(4) NOT NULL DEFAULT '0',
  `BookLeadCount` int(9) NOT NULL DEFAULT '0',
  `BookEntryTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Book_Keeping_LAP`
--

CREATE TABLE IF NOT EXISTS `Bidders_Book_Keeping_LAP` (
  `BookID` int(9) NOT NULL,
  `BidderID` int(9) NOT NULL DEFAULT '0',
  `BookProduct` tinyint(2) NOT NULL DEFAULT '0',
  `BookDate` tinyint(2) NOT NULL DEFAULT '0',
  `BookWeek` tinyint(2) NOT NULL DEFAULT '0',
  `BookMonth` tinyint(2) NOT NULL DEFAULT '0',
  `BookYear` int(4) NOT NULL DEFAULT '0',
  `BookLeadCount` int(9) NOT NULL DEFAULT '0',
  `BookEntryTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Book_Keeping_nov21`
--

CREATE TABLE IF NOT EXISTS `Bidders_Book_Keeping_nov21` (
  `BookID` int(9) NOT NULL,
  `BidderID` int(9) NOT NULL DEFAULT '0',
  `BookProduct` tinyint(2) NOT NULL DEFAULT '0',
  `BookDate` tinyint(2) NOT NULL DEFAULT '0',
  `BookWeek` tinyint(2) NOT NULL DEFAULT '0',
  `BookMonth` tinyint(2) NOT NULL DEFAULT '0',
  `BookYear` int(4) NOT NULL DEFAULT '0',
  `BookLeadCount` int(9) NOT NULL DEFAULT '0',
  `BookEntryTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Book_Keeping_PL`
--

CREATE TABLE IF NOT EXISTS `Bidders_Book_Keeping_PL` (
  `BookID` int(9) NOT NULL,
  `BidderID` int(9) NOT NULL DEFAULT '0',
  `BookProduct` tinyint(2) NOT NULL DEFAULT '0',
  `BookDate` tinyint(2) NOT NULL DEFAULT '0',
  `BookWeek` tinyint(2) NOT NULL DEFAULT '0',
  `BookMonth` tinyint(2) NOT NULL DEFAULT '0',
  `BookYear` int(4) NOT NULL DEFAULT '0',
  `BookLeadCount` int(9) NOT NULL DEFAULT '0',
  `BookEntryTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Insertion`
--

CREATE TABLE IF NOT EXISTS `Bidders_Insertion` (
  `BidderInsertionID` int(6) NOT NULL,
  `Bidder_Name` varchar(100) NOT NULL DEFAULT '',
  `Associated_Bank` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(150) NOT NULL DEFAULT '',
  `Address` text NOT NULL,
  `Contact_Number` bigint(10) NOT NULL DEFAULT '0',
  `Join_Date` date NOT NULL DEFAULT '0000-00-00',
  `Reply_type` int(2) NOT NULL DEFAULT '0',
  `Conflict_Bidder` varchar(200) NOT NULL DEFAULT '',
  `No_Of_Leads` varchar(200) NOT NULL DEFAULT '',
  `Lead_Duration` varchar(6) NOT NULL DEFAULT '',
  `City` text NOT NULL,
  `Other_City` text NOT NULL,
  `Employment_Status` varchar(50) NOT NULL DEFAULT '',
  `Minimum_Age` int(3) NOT NULL DEFAULT '0',
  `Maximum_Age` int(3) NOT NULL DEFAULT '0',
  `Is_Valid` int(3) NOT NULL DEFAULT '0',
  `Pincodes` varchar(250) NOT NULL DEFAULT '',
  `Loan_Amount` bigint(15) NOT NULL DEFAULT '0',
  `Max_Loan_Amount` bigint(10) NOT NULL DEFAULT '0',
  `Pancard` varchar(4) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Vintage` int(2) NOT NULL DEFAULT '0',
  `Applied_With_Banks` varchar(100) NOT NULL DEFAULT '',
  `Net_Salary` bigint(10) NOT NULL DEFAULT '0',
  `Loan_Running` varchar(4) NOT NULL DEFAULT '',
  `Misc_Conditions` text NOT NULL,
  `Table_Name` varchar(100) NOT NULL DEFAULT '',
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `create_Sql` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_ivr`
--

CREATE TABLE IF NOT EXISTS `Bidders_ivr` (
  `BidderID` int(10) unsigned NOT NULL,
  `Email` varchar(50) NOT NULL DEFAULT '',
  `PWD` varchar(15) NOT NULL DEFAULT '',
  `Bidder_Name` varchar(100) NOT NULL DEFAULT '',
  `Associated_Bank` varchar(50) NOT NULL DEFAULT '',
  `City` text NOT NULL,
  `Address` varchar(100) NOT NULL DEFAULT '',
  `Join_Date` date NOT NULL DEFAULT '0000-00-00',
  `Last_Login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Contact_Num` varchar(30) NOT NULL DEFAULT '',
  `Is_Verified` tinyint(5) DEFAULT '0',
  `Reply_Type` varchar(50) NOT NULL DEFAULT '0',
  `BidderEmailID` varchar(100) NOT NULL DEFAULT '',
  `BD_Name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_List`
--

CREATE TABLE IF NOT EXISTS `Bidders_List` (
  `Bidder_listID` int(11) NOT NULL,
  `BidderID` int(10) unsigned NOT NULL DEFAULT '0',
  `Bidder_Name` varchar(100) DEFAULT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `City` text,
  `Query` text,
  `Dated` date DEFAULT NULL,
  `Always` tinyint(1) DEFAULT NULL,
  `Conflict_bidder` text,
  `Table_Name` varchar(100) DEFAULT NULL,
  `Sequence_no` tinyint(2) DEFAULT '0',
  `Last_allocation` tinyint(2) DEFAULT '0',
  `Last_set_select` tinyint(2) DEFAULT '0',
  `Restrict_Bidder` tinyint(4) NOT NULL DEFAULT '0',
  `Max_Dated` datetime DEFAULT NULL,
  `CapLead_Count` varchar(50) DEFAULT NULL,
  `Cap_MinDate` datetime DEFAULT NULL,
  `Cap_MaxDate` datetime DEFAULT NULL,
  `Cap_Type` varchar(11) DEFAULT NULL,
  `Bidder_Open_Flag` tinyint(4) DEFAULT '0',
  `lms_block_flag` tinyint(4) NOT NULL DEFAULT '0' COMMENT '2=Shown only in LMS, 1=Shown only in White Label, 0=shown in both',
  `Multiplier` int(9) NOT NULL DEFAULT '0',
  `CF_Multipler` int(11) NOT NULL DEFAULT '100',
  `Billing_Restriction_Flag` int(2) NOT NULL DEFAULT '0',
  `BankID` varchar(10) NOT NULL DEFAULT '0',
  `Bidder_Priority` varchar(11) NOT NULL DEFAULT '1,1,1',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `bidder_postpaid` tinyint(4) NOT NULL DEFAULT '0',
  `bankwise_priority` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_List_ivr`
--

CREATE TABLE IF NOT EXISTS `Bidders_List_ivr` (
  `Bidder_listID` int(11) NOT NULL,
  `BidderID` int(10) unsigned NOT NULL DEFAULT '0',
  `Bidder_Name` varchar(100) DEFAULT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `City` text,
  `Query` text,
  `New_Query` text NOT NULL,
  `Dated` date DEFAULT NULL,
  `Max_Dated` date NOT NULL DEFAULT '0000-00-00',
  `Always` tinyint(1) DEFAULT NULL,
  `Conflict_bidder` varchar(100) DEFAULT NULL,
  `Table_Name` varchar(100) DEFAULT NULL,
  `Sequence_no` tinyint(2) DEFAULT NULL,
  `Last_allocation` tinyint(2) DEFAULT NULL,
  `Last_set_select` tinyint(2) DEFAULT NULL,
  `Restrict_Bidder` tinyint(4) NOT NULL DEFAULT '0',
  `CapLead_Count` varchar(25) NOT NULL DEFAULT '',
  `Cap_MinDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Multiplier` int(9) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Login_Details`
--

CREATE TABLE IF NOT EXISTS `Bidders_Login_Details` (
  `TrackID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Bidder_Name` varchar(100) NOT NULL DEFAULT '',
  `Last_Login_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Last_Logout_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IP_Address` varchar(100) DEFAULT NULL,
  `Product_Type` varchar(50) DEFAULT NULL,
  `City` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Mailers`
--

CREATE TABLE IF NOT EXISTS `Bidders_Mailers` (
  `R_ID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Bank_Name` varchar(100) NOT NULL,
  `Folder` varchar(255) NOT NULL,
  `to_mail` text NOT NULL,
  `cc_mail` text NOT NULL,
  `bcc_mail` text NOT NULL,
  `GlobalID` int(11) NOT NULL,
  `Dated` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidders_Package_Log`
--

CREATE TABLE IF NOT EXISTS `Bidders_Package_Log` (
  `bpl_id` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Product_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Leads_Count` int(11) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bidders_session_details`
--

CREATE TABLE IF NOT EXISTS `bidders_session_details` (
  `bidsessid` int(11) NOT NULL,
  `sessionid` text NOT NULL,
  `bidderid` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `login_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidder_Contact_To_Customers`
--

CREATE TABLE IF NOT EXISTS `Bidder_Contact_To_Customers` (
  `BidderContactID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Bank_Name` varchar(50) NOT NULL DEFAULT '',
  `Bankers_Name` varchar(100) NOT NULL DEFAULT '',
  `Banker_Contact` varchar(100) NOT NULL DEFAULT '',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Sms_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `City_Wise` varchar(200) NOT NULL DEFAULT '',
  `RequestID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bidder_downloads`
--

CREATE TABLE IF NOT EXISTS `bidder_downloads` (
  `id` bigint(8) NOT NULL,
  `bidder_id` bigint(8) DEFAULT NULL,
  `request_id` bigint(8) DEFAULT NULL,
  `loan_type` varchar(100) DEFAULT NULL,
  `from_date` varchar(100) DEFAULT NULL,
  `to_date` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `city_other` varchar(100) DEFAULT NULL,
  `emp_status` varchar(100) DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `doe` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bidder_downloads1`
--

CREATE TABLE IF NOT EXISTS `bidder_downloads1` (
  `id` bigint(8) NOT NULL,
  `bidder_id` bigint(8) DEFAULT NULL,
  `request_id` bigint(8) DEFAULT NULL,
  `loan_type` varchar(100) DEFAULT NULL,
  `from_date` varchar(100) DEFAULT NULL,
  `to_date` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `city_other` varchar(100) DEFAULT NULL,
  `salaried` tinyint(1) DEFAULT '0',
  `salaried_amount` text,
  `self_emp` tinyint(1) DEFAULT '0',
  `self_emp_amount` text,
  `doe` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidder_ivr_Contact`
--

CREATE TABLE IF NOT EXISTS `Bidder_ivr_Contact` (
  `BicID` int(11) NOT NULL,
  `PromptID` int(11) NOT NULL DEFAULT '0',
  `PromptName` varchar(30) NOT NULL DEFAULT '',
  `City` text NOT NULL,
  `Contact` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bidder_Views`
--

CREATE TABLE IF NOT EXISTS `Bidder_Views` (
  `ViewID` int(10) unsigned NOT NULL,
  `BidderID` int(10) unsigned NOT NULL DEFAULT '0',
  `RequestID` int(10) unsigned NOT NULL DEFAULT '0',
  `Request_Type` tinyint(1) NOT NULL DEFAULT '0',
  `View_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Status` tinyint(1) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bike_list`
--

CREATE TABLE IF NOT EXISTS `bike_list` (
  `id` int(11) NOT NULL,
  `bike_manufacturer` varchar(200) NOT NULL,
  `bike_name` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Billing_List`
--

CREATE TABLE IF NOT EXISTS `Billing_List` (
  `BillingID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Bidder_Name` varchar(50) DEFAULT NULL,
  `Product_Type` varchar(100) DEFAULT NULL,
  `Query` text NOT NULL,
  `Table_Name` varchar(100) NOT NULL DEFAULT '',
  `Count` int(20) DEFAULT '0',
  `Multiplier` varchar(11) DEFAULT NULL,
  `Total_Bill` varchar(100) DEFAULT NULL,
  `Dated` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Billing_User`
--

CREATE TABLE IF NOT EXISTS `Billing_User` (
  `Billing_ID` int(10) NOT NULL,
  `Billing_Name` varchar(100) NOT NULL DEFAULT '',
  `Billing_UserName` varchar(100) NOT NULL DEFAULT '',
  `Billing_Password` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Bill_Record`
--

CREATE TABLE IF NOT EXISTS `Bill_Record` (
  `BID` int(10) NOT NULL,
  `Bill_Period` varchar(10) NOT NULL DEFAULT '',
  `Invoice_Number` varchar(100) NOT NULL DEFAULT '',
  `Invoice_Date` varchar(20) NOT NULL DEFAULT '',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Associated_Bank` varchar(100) NOT NULL DEFAULT '',
  `Address` varchar(255) NOT NULL DEFAULT '',
  `Product` varchar(100) NOT NULL DEFAULT '',
  `Lead_Volume` int(10) NOT NULL DEFAULT '0',
  `Discount_Lead` int(9) NOT NULL DEFAULT '0',
  `Total_Lead` int(9) NOT NULL DEFAULT '0',
  `Discount_Reason` varchar(255) NOT NULL DEFAULT '',
  `Cost_Lead` int(10) NOT NULL DEFAULT '0',
  `Sub_Total` varchar(10) NOT NULL DEFAULT '',
  `Service_Tax` varchar(10) NOT NULL DEFAULT '',
  `educationcess` varchar(20) NOT NULL DEFAULT '',
  `highereducationcess` varchar(20) NOT NULL DEFAULT '',
  `Total_Amount` varchar(10) NOT NULL DEFAULT '',
  `Bill_Sent` tinyint(3) NOT NULL DEFAULT '0',
  `Generated_By` varchar(100) NOT NULL DEFAULT '',
  `Payment_Received` int(10) NOT NULL DEFAULT '0',
  `Payment_Mode` varchar(100) NOT NULL DEFAULT '',
  `Payment_By` varchar(20) NOT NULL DEFAULT '',
  `Payment_Date` date NOT NULL DEFAULT '0000-00-00',
  `BidderID` int(10) NOT NULL DEFAULT '0',
  `Min_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Max_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Payment_TDS` int(9) NOT NULL DEFAULT '0',
  `City` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `B_List_Property`
--

CREATE TABLE IF NOT EXISTS `B_List_Property` (
  `Bidder_listID` int(11) NOT NULL,
  `BidderID` int(10) unsigned NOT NULL DEFAULT '0',
  `Bidder_Name` varchar(100) DEFAULT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `City` text,
  `Property_ID` varchar(255) NOT NULL,
  `MinAge` int(11) DEFAULT NULL,
  `MaxAge` int(11) NOT NULL,
  `Employment_Status` int(11) NOT NULL,
  `Dated` date DEFAULT NULL,
  `Last_allocation` tinyint(2) DEFAULT '0',
  `Last_set_select` tinyint(2) DEFAULT '0',
  `Restrict_Bidder` tinyint(4) NOT NULL DEFAULT '0',
  `Max_Dated` datetime DEFAULT NULL,
  `CapLead_Count` varchar(50) DEFAULT NULL,
  `Cap_MinDate` datetime DEFAULT NULL,
  `Cap_MaxDate` datetime DEFAULT NULL,
  `Cap_Type` varchar(11) DEFAULT NULL,
  `BankID` varchar(10) NOT NULL DEFAULT '0',
  `bidder_postpaid` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `B_Property`
--

CREATE TABLE IF NOT EXISTS `B_Property` (
  `BidderID` int(10) unsigned NOT NULL,
  `Email` varchar(50) NOT NULL DEFAULT '',
  `PWD` varchar(200) NOT NULL DEFAULT '',
  `Bidder_Name` varchar(100) NOT NULL DEFAULT '',
  `Associated_Bank` varchar(50) NOT NULL DEFAULT '',
  `Selection_Category` tinyint(5) NOT NULL DEFAULT '0',
  `City` varchar(100) NOT NULL DEFAULT '',
  `Address` varchar(100) NOT NULL DEFAULT '',
  `Website` varchar(100) NOT NULL DEFAULT '',
  `Email_old` varchar(50) NOT NULL DEFAULT '',
  `Contact_Num` varchar(30) NOT NULL DEFAULT '',
  `Profile` text NOT NULL,
  `Join_Date` date NOT NULL DEFAULT '0000-00-00',
  `Last_Login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Count_Replies` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Has_New_Reply` tinyint(1) DEFAULT NULL,
  `Is_Verified` int(10) DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `BidderEmailID` text NOT NULL,
  `FeedbackMailID` varchar(250) NOT NULL DEFAULT '',
  `BD_Name` varchar(50) NOT NULL DEFAULT '',
  `Manager_Name` varchar(100) NOT NULL DEFAULT '',
  `BD_Number` varchar(50) NOT NULL DEFAULT '',
  `Define_PrePost` varchar(8) NOT NULL DEFAULT '',
  `Prepaid_Amount` int(9) NOT NULL DEFAULT '0',
  `Global_Access_ID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_pixel_capture`
--

CREATE TABLE IF NOT EXISTS `campaign_pixel_capture` (
  `campid` int(11) NOT NULL,
  `camp_email` varchar(100) NOT NULL,
  `camp_uniqueid` int(11) NOT NULL,
  `camp_source` varchar(50) NOT NULL,
  `camp_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `captute_banner_click`
--

CREATE TABLE IF NOT EXISTS `captute_banner_click` (
  `captuteid` int(11) NOT NULL,
  `banner_name` varchar(100) NOT NULL,
  `capture_clicks` int(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cards_curing_queue`
--

CREATE TABLE IF NOT EXISTS `cards_curing_queue` (
  `id` int(11) NOT NULL,
  `bankname` varchar(80) NOT NULL,
  `identifier` varchar(60) NOT NULL,
  `process` varchar(80) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `RefRequestID` int(11) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `dated` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `LeadRefNumber` varchar(30) NOT NULL,
  `code` varchar(60) NOT NULL,
  `insert_status` varchar(20) NOT NULL,
  `upload_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `card_properties`
--

CREATE TABLE IF NOT EXISTS `card_properties` (
  `CardpropID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Card_Name` varchar(100) NOT NULL DEFAULT '',
  `Card_Image` varchar(200) NOT NULL DEFAULT '',
  `Card_Features` text NOT NULL,
  `Card_Eligibility` varchar(255) NOT NULL DEFAULT '',
  `Card_Annual_Fee` int(10) NOT NULL DEFAULT '0',
  `Extra_Clause` varchar(200) NOT NULL DEFAULT '',
  `Upper_Bound` varchar(255) NOT NULL DEFAULT '',
  `Card_Priority` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE IF NOT EXISTS `careers` (
  `id` int(11) NOT NULL,
  `Dept_Name` varchar(150) NOT NULL,
  `about_us` text NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `flag` tinyint(1) NOT NULL DEFAULT '1',
  `added_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `priority_flag` int(4) NOT NULL,
  `access_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `career_job_apply`
--

CREATE TABLE IF NOT EXISTS `career_job_apply` (
  `id` int(11) NOT NULL,
  `career_id` int(11) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `upload_files` varchar(255) NOT NULL,
  `cover_letter` text NOT NULL,
  `city` varchar(150) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `flag` tinyint(1) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carloan_mailers`
--

CREATE TABLE IF NOT EXISTS `carloan_mailers` (
  `id` int(11) NOT NULL,
  `City` varchar(80) NOT NULL,
  `State` varchar(130) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `mail_to` varchar(255) NOT NULL,
  `mail_cc` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `car_company_category`
--

CREATE TABLE IF NOT EXISTS `car_company_category` (
  `carcmpid` int(11) NOT NULL,
  `car_company` varchar(50) NOT NULL DEFAULT '',
  `car_model` varchar(100) NOT NULL DEFAULT '',
  `car_price_category` varchar(20) NOT NULL DEFAULT '',
  `car_loan_category` varchar(20) NOT NULL DEFAULT '',
  `car_loan_price` bigint(20) NOT NULL DEFAULT '0',
  `car_loan_price_dellhi` bigint(20) NOT NULL DEFAULT '0',
  `CategoryID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `car_loan_interest_rate`
--

CREATE TABLE IF NOT EXISTS `car_loan_interest_rate` (
  `B_id` int(11) NOT NULL,
  `BankName` varchar(50) NOT NULL,
  `BankID` int(11) NOT NULL,
  `NewCarRate` text NOT NULL,
  `OldCarRate` text NOT NULL,
  `ProcessingFee` text NOT NULL,
  `BankURL` varchar(250) NOT NULL,
  `ShowButton` tinyint(4) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Dated` datetime NOT NULL,
  `UpdatedDate` datetime NOT NULL,
  `Sequence` tinyint(4) NOT NULL,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `car_loan_state_category`
--

CREATE TABLE IF NOT EXISTS `car_loan_state_category` (
  `clstateid` int(11) NOT NULL,
  `car_state` varchar(20) NOT NULL DEFAULT '',
  `car_state_category` varchar(10) NOT NULL DEFAULT '',
  `rate_flag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ccndc_diningcity`
--

CREATE TABLE IF NOT EXISTS `ccndc_diningcity` (
  `ccndc_dinid` int(11) NOT NULL,
  `allccndc_offerid` int(11) NOT NULL DEFAULT '0',
  `Dining_Ahmedabad` text NOT NULL,
  `Dining_Bangalore` text NOT NULL,
  `Dining_Chennai` text NOT NULL,
  `Dining_Delhi` text NOT NULL,
  `Dining_Hyderabad` text NOT NULL,
  `Dining_Kolkata` text NOT NULL,
  `Dining_Mumbai` text NOT NULL,
  `Dining_Pune` text NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cc_american_express`
--

CREATE TABLE IF NOT EXISTS `cc_american_express` (
  `RequestID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Phone` bigint(20) NOT NULL,
  `Net_Salary` varchar(40) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Employment_Status` tinyint(4) NOT NULL,
  `Company_Name` varchar(255) NOT NULL,
  `nature_business` varchar(100) NOT NULL,
  `stat_location` varchar(10) NOT NULL,
  `current_experience` varchar(50) NOT NULL,
  `office_phone_std` varchar(6) NOT NULL,
  `office_phone` int(11) NOT NULL,
  `office_address` varchar(255) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `address_home` varchar(255) NOT NULL,
  `address_pincode` varchar(6) NOT NULL,
  `own_car` varchar(5) NOT NULL,
  `car_manufacturer` varchar(200) NOT NULL,
  `car_model` varchar(200) NOT NULL,
  `Pancard` varchar(11) NOT NULL,
  `DOB` date NOT NULL,
  `CC_Holder` varchar(6) NOT NULL,
  `cc_company` varchar(255) NOT NULL,
  `loan_any` varchar(200) NOT NULL,
  `Dated` datetime NOT NULL,
  `source` varchar(100) NOT NULL,
  `email_verification_code` varchar(60) NOT NULL,
  `email_verified` tinyint(4) NOT NULL,
  `IP` varchar(16) NOT NULL,
  `status` varchar(20) NOT NULL,
  `appID` varchar(20) NOT NULL,
  `Feedback` varchar(100) NOT NULL,
  `FollowupDate` datetime NOT NULL,
  `ccadd_comment` varchar(255) NOT NULL,
  `Reference_Code` varchar(10) NOT NULL,
  `Is_Valid` tinyint(4) NOT NULL,
  `Card_Name` varchar(170) NOT NULL,
  `existing_member` tinyint(4) NOT NULL,
  `membership_number` varchar(18) NOT NULL,
  `membership_tier` varchar(12) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Chat_Registered_User`
--

CREATE TABLE IF NOT EXISTS `Chat_Registered_User` (
  `ChatID` int(11) NOT NULL,
  `Chat_Name` varchar(50) NOT NULL DEFAULT '',
  `Chat_Contact` varchar(50) DEFAULT NULL,
  `Product_Type` varchar(50) DEFAULT NULL,
  `Chat_Email` varchar(100) NOT NULL DEFAULT '',
  `Chat_City` varchar(50) DEFAULT NULL,
  `Chat_Dated` datetime DEFAULT '0000-00-00 00:00:00',
  `Chat_Source` varchar(100) NOT NULL DEFAULT '',
  `Section` varchar(50) NOT NULL DEFAULT '',
  `Creative` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `citibankcards_negative_complist`
--

CREATE TABLE IF NOT EXISTS `citibankcards_negative_complist` (
  `compid` int(11) NOT NULL,
  `company_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `citibank_company_list`
--

CREATE TABLE IF NOT EXISTS `citibank_company_list` (
  `companyid` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `citibank_credit_card_6250`
--

CREATE TABLE IF NOT EXISTS `citibank_credit_card_6250` (
  `citiccid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `ResiHouseNo` varchar(200) NOT NULL,
  `ResiStreetNo` varchar(200) NOT NULL,
  `ResiArea` varchar(200) NOT NULL,
  `ResiLandmark` varchar(200) NOT NULL,
  `CompanyName` text NOT NULL,
  `OfficePin` mediumint(9) DEFAULT NULL,
  `OfficeCity` varchar(20) DEFAULT NULL,
  `OffiBuildingNo` varchar(200) NOT NULL,
  `OffiStreetNo` varchar(200) NOT NULL,
  `OffiArea` varchar(200) NOT NULL,
  `OffiLandmark` varchar(200) NOT NULL,
  `Qualification` varchar(25) NOT NULL,
  `Designation` varchar(100) NOT NULL,
  `CardName` varchar(50) DEFAULT NULL,
  `Mailing_Address` varchar(20) NOT NULL,
  `Dated` datetime NOT NULL,
  `send_status` tinyint(4) NOT NULL,
  `lms_flag` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `citibank_pincode_6250`
--

CREATE TABLE IF NOT EXISTS `citibank_pincode_6250` (
  `citipinid` int(11) NOT NULL,
  `citi_pincode` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `citi_appointments`
--

CREATE TABLE IF NOT EXISTS `citi_appointments` (
  `id` int(11) NOT NULL,
  `address_apt` text NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `appdate` varchar(15) NOT NULL DEFAULT '',
  `changeapp_time` varchar(60) NOT NULL DEFAULT '',
  `docs` text NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `city_hl_pages`
--

CREATE TABLE IF NOT EXISTS `city_hl_pages` (
  `pid` int(11) NOT NULL,
  `Product` varchar(30) NOT NULL,
  `Subcity` varchar(200) NOT NULL,
  `City` varchar(70) NOT NULL,
  `State` varchar(200) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `MetaKeyword` text NOT NULL,
  `MetaDescription` text NOT NULL,
  `PageDescription` longtext NOT NULL,
  `HeaderDEscription` longtext NOT NULL,
  `Dated` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `city_pages`
--

CREATE TABLE IF NOT EXISTS `city_pages` (
  `pid` int(11) NOT NULL,
  `Product` varchar(30) NOT NULL,
  `Subcity` varchar(200) NOT NULL,
  `City` varchar(70) NOT NULL,
  `State` varchar(200) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `MetaKeyword` text NOT NULL,
  `MetaDescription` text NOT NULL,
  `PageDescription` longtext NOT NULL,
  `HeaderDEscription` longtext NOT NULL,
  `Dated` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `click2call`
--

CREATE TABLE IF NOT EXISTS `click2call` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `returnID` bigint(20) NOT NULL,
  `Status` varchar(25) NOT NULL,
  `Dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_campaign_leads`
--

CREATE TABLE IF NOT EXISTS `client_campaign_leads` (
  `clientldid` int(11) NOT NULL,
  `product_type` tinyint(4) NOT NULL,
  `requestid` int(11) NOT NULL,
  `clientld_name` varchar(50) NOT NULL,
  `clientld_email` varchar(100) NOT NULL,
  `clientld_mobile` bigint(20) NOT NULL,
  `clientld_city` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `client_splcondition` tinyint(4) NOT NULL,
  `clientld_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_lead_allocate`
--

CREATE TABLE IF NOT EXISTS `client_lead_allocate` (
  `leadid` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `Feedback_ID` int(11) NOT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Feedback` varchar(100) DEFAULT NULL,
  `Followup_Date` datetime NOT NULL,
  `Comments` text,
  `AsmID` int(11) NOT NULL,
  `Asm_Feedback` varchar(50) DEFAULT NULL,
  `Asm_Followup_Date` datetime NOT NULL,
  `Asm_Comments` text,
  `DOE` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `smsflag` tinyint(4) NOT NULL,
  `sbitelecaller` tinyint(11) NOT NULL,
  `asm_allocation_date` datetime NOT NULL,
  `caller_name` varchar(20) DEFAULT NULL,
  `old_bidderid` int(11) NOT NULL,
  `old_allocated_date` datetime NOT NULL,
  `Old_Feedback` varchar(100) DEFAULT NULL,
  `Old_Comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_lead_allocated_comment`
--

CREATE TABLE IF NOT EXISTS `client_lead_allocated_comment` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Comments` text NOT NULL,
  `Dated` datetime NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `BidderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clubbed_company_list`
--

CREATE TABLE IF NOT EXISTS `clubbed_company_list` (
  `supercompanyid` int(11) NOT NULL,
  `supercompany_name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cl_company_list_hdfc`
--

CREATE TABLE IF NOT EXISTS `cl_company_list_hdfc` (
  `clcomplistid` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `company_category` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE IF NOT EXISTS `Comments` (
  `CommentID` int(11) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `CommentText` text,
  `ParentCommentID` int(11) DEFAULT '0',
  `PublishDate` int(11) DEFAULT NULL,
  `ForeignID` varchar(255) DEFAULT NULL,
  `UrlID` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments_pages`
--

CREATE TABLE IF NOT EXISTS `comments_pages` (
  `Rid` int(11) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Mobile` bigint(20) NOT NULL,
  `Comment` text NOT NULL,
  `Dated` datetime NOT NULL,
  `Page_Name` varchar(255) NOT NULL,
  `IP` varchar(16) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commonfloor_hlcampaign`
--

CREATE TABLE IF NOT EXISTS `commonfloor_hlcampaign` (
  `leadid` int(11) NOT NULL,
  `cf_name` varchar(50) NOT NULL,
  `cf_mobile_number` bigint(20) NOT NULL,
  `cf_email_id` varchar(100) NOT NULL,
  `cf_city` varchar(50) NOT NULL,
  `cf_property_value` decimal(12,2) NOT NULL,
  `cf_dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `compaign_bidders_list`
--

CREATE TABLE IF NOT EXISTS `compaign_bidders_list` (
  `Bidder_listID` int(11) NOT NULL,
  `BidderID` int(10) unsigned NOT NULL DEFAULT '0',
  `Bidder_Name` varchar(100) DEFAULT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `City` text,
  `Query` text,
  `Dated` date DEFAULT NULL,
  `Always` tinyint(1) DEFAULT NULL,
  `Conflict_bidder` varchar(100) DEFAULT NULL,
  `Table_Name` varchar(100) DEFAULT NULL,
  `Sequence_no` tinyint(2) DEFAULT '0',
  `Last_allocation` tinyint(2) DEFAULT '0',
  `Last_set_select` tinyint(2) DEFAULT '0',
  `Restrict_Bidder` tinyint(4) NOT NULL DEFAULT '0',
  `CapLead_Count` varchar(50) DEFAULT NULL,
  `Cap_MinDate` datetime DEFAULT NULL,
  `BankID` varchar(10) NOT NULL DEFAULT '0',
  `Salary_Clause` varchar(50) NOT NULL DEFAULT '',
  `Age_Clause` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Compaign_Credit_Card`
--

CREATE TABLE IF NOT EXISTS `Compaign_Credit_Card` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(10,0) DEFAULT NULL,
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `CC_Holder` tinyint(4) DEFAULT '0',
  `Descr` varchar(50) DEFAULT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(50) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Pancard` varchar(25) NOT NULL DEFAULT '',
  `Pancard_No` varchar(50) DEFAULT NULL,
  `No_of_Banks` varchar(200) DEFAULT NULL,
  `Allocated` tinyint(2) DEFAULT NULL,
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) DEFAULT '0',
  `Applied_With_Banks` varchar(250) DEFAULT NULL,
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Office_Address` varchar(255) DEFAULT NULL,
  `Credit_Limit` tinyint(1) DEFAULT '0',
  `Bidder_Count` int(11) NOT NULL DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(150) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cpp_card_protection_leads`
--

CREATE TABLE IF NOT EXISTS `cpp_card_protection_leads` (
  `CPP_ID` int(11) NOT NULL,
  `CPP_RequestID` int(11) NOT NULL DEFAULT '0',
  `CPP_Product` int(11) NOT NULL DEFAULT '0',
  `CPP_Name` varchar(100) NOT NULL DEFAULT '',
  `CPP_Email` varchar(60) NOT NULL DEFAULT '',
  `CPP_City` varchar(100) NOT NULL DEFAULT '',
  `CPP_Address` varchar(200) NOT NULL DEFAULT '',
  `CPP_Mobile_Number` bigint(20) NOT NULL DEFAULT '0',
  `CPP_DOB` varchar(100) NOT NULL DEFAULT '',
  `CPP_CC_Holder` tinyint(4) NOT NULL DEFAULT '0',
  `CPP_No_Of_Card` int(11) NOT NULL DEFAULT '0',
  `CPP_Source` varchar(50) NOT NULL DEFAULT '',
  `CPP_Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditcard_citylist`
--

CREATE TABLE IF NOT EXISTS `creditcard_citylist` (
  `id` int(10) unsigned NOT NULL,
  `cityname` varchar(100) NOT NULL,
  `cityalias` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `source` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditndebit_card_offer`
--

CREATE TABLE IF NOT EXISTS `creditndebit_card_offer` (
  `ccndc_offerid` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL DEFAULT '',
  `new_bank_name` varchar(255) NOT NULL DEFAULT '',
  `another_bank_name` varchar(255) NOT NULL DEFAULT '',
  `card_name` varchar(200) NOT NULL DEFAULT '',
  `dinning_offers` text NOT NULL,
  `shopping_offers` text NOT NULL,
  `entertainment_offers` text NOT NULL,
  `travel_offers` text NOT NULL,
  `petrol_offers` text NOT NULL,
  `reward_points_offers` text NOT NULL,
  `other_offers` text NOT NULL,
  `ccndc_features` text NOT NULL,
  `ccndc_offer_type` tinyint(4) NOT NULL DEFAULT '0',
  `ccndc_dated` date NOT NULL DEFAULT '0000-00-00',
  `ccndc_approval` tinyint(4) NOT NULL DEFAULT '0',
  `compare_value` varchar(200) NOT NULL DEFAULT '',
  `compare_value_new` varchar(50) NOT NULL DEFAULT '',
  `city_list` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditndebit_card_reward_offer`
--

CREATE TABLE IF NOT EXISTS `creditndebit_card_reward_offer` (
  `ccndc_reid` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL DEFAULT '',
  `card_name` varchar(50) NOT NULL DEFAULT '',
  `card_type` tinyint(4) NOT NULL DEFAULT '0',
  `reward_point` varchar(255) NOT NULL DEFAULT '',
  `card_contact` varchar(50) NOT NULL DEFAULT '',
  `ccndc_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ccndc_approval` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_card_banks_apply`
--

CREATE TABLE IF NOT EXISTS `credit_card_banks_apply` (
  `id` int(11) NOT NULL,
  `cc_requestid` int(11) NOT NULL,
  `office_city` varchar(50) NOT NULL,
  `office_pincode` int(5) unsigned NOT NULL,
  `resi_address` varchar(255) DEFAULT NULL COMMENT 'Residence Address',
  `residence_address` text NOT NULL COMMENT 'serialized address',
  `billing_preference` tinyint(4) NOT NULL,
  `qualification` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `relation_with_bank` varchar(100) NOT NULL,
  `cc_holder` varchar(10) NOT NULL,
  `already_applied` varchar(10) NOT NULL,
  `applied_bankname` varchar(50) NOT NULL,
  `applied_cardname` varchar(200) NOT NULL,
  `bank_relationship_number` varchar(40) NOT NULL,
  `webservice_flag` tinyint(4) NOT NULL COMMENT '0 - not initiated, 1 - initiated, 2 - got response',
  `request_data` text NOT NULL,
  `response_data` text NOT NULL,
  `lead_source` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime NOT NULL,
  `lead_repush` int(10) NOT NULL DEFAULT '0',
  `lead_repush_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_card_banks_apply_log`
--

CREATE TABLE IF NOT EXISTS `credit_card_banks_apply_log` (
  `logid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `cc_requestid` int(11) NOT NULL,
  `applied_bankname` varchar(50) NOT NULL,
  `applied_cardname` varchar(200) NOT NULL,
  `request_data` text NOT NULL,
  `response_data` text NOT NULL,
  `lead_source` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_card_banks_eligibility`
--

CREATE TABLE IF NOT EXISTS `credit_card_banks_eligibility` (
  `cc_bankid` int(11) NOT NULL,
  `cc_bank_name` varchar(100) NOT NULL DEFAULT '',
  `cc_bank_age` varchar(50) NOT NULL DEFAULT '',
  `cc_bank_fee` int(11) NOT NULL DEFAULT '0',
  `cc_bank_fee_content` text NOT NULL,
  `cc_bank_income` varchar(100) NOT NULL DEFAULT '',
  `cc_bank_features` text NOT NULL,
  `cc_bank_new_features` text NOT NULL,
  `cc_bank_rates` varchar(50) NOT NULL DEFAULT '',
  `cc_other_charges` text NOT NULL,
  `cc_bank_flag` tinyint(4) NOT NULL DEFAULT '0',
  `cc_bank_query` text NOT NULL,
  `other_query` text NOT NULL,
  `cc_application_time` varchar(200) NOT NULL DEFAULT '',
  `cc_bank_citylist` text NOT NULL,
  `cc_bank_url` text NOT NULL,
  `cc_bank_url_ndtv` varchar(255) NOT NULL DEFAULT '',
  `bank_income` decimal(12,2) NOT NULL DEFAULT '0.00',
  `card_image` varchar(255) NOT NULL DEFAULT '',
  `card_image_view` varchar(255) NOT NULL,
  `cc_priority` tinyint(4) NOT NULL DEFAULT '0',
  `cc_priority_2to4lac` tinyint(3) unsigned NOT NULL,
  `cc_priority_4to6lac` tinyint(3) unsigned NOT NULL,
  `category_tag` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_card_cibil_check`
--

CREATE TABLE IF NOT EXISTS `credit_card_cibil_check` (
  `cibilchkid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Pincode` varchar(20) NOT NULL,
  `Address` text NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `existing_relation` varchar(50) NOT NULL,
  `Type_Of_Company` varchar(100) NOT NULL,
  `PanNo` varchar(200) NOT NULL,
  `Result` varchar(20) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Status_Description` varchar(255) NOT NULL,
  `Credit_Score` int(11) NOT NULL,
  `RuleStatus` varchar(100) NOT NULL,
  `ApplicationID` bigint(20) NOT NULL,
  `Response` text NOT NULL,
  `icici_check1` tinyint(4) NOT NULL,
  `icici_check2` tinyint(4) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(50) NOT NULL,
  `appointment_place` varchar(50) NOT NULL,
  `appointment_address` text NOT NULL,
  `documents` text NOT NULL,
  `other_documents` text NOT NULL,
  `Dated` datetime NOT NULL,
  `flag` tinyint(4) NOT NULL,
  `TelecallerID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_card_listing`
--

CREATE TABLE IF NOT EXISTS `credit_card_listing` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(200) DEFAULT NULL,
  `content` longtext,
  `sequence` smallint(6) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `status_uat` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `credit_card_mail_logs`
--

CREATE TABLE IF NOT EXISTS `credit_card_mail_logs` (
  `log_id` int(11) unsigned NOT NULL,
  `request_id` int(11) NOT NULL,
  `mail1_response` varchar(200) NOT NULL,
  `mail2_response` varchar(200) NOT NULL,
  `mail2_status` tinyint(4) NOT NULL DEFAULT '1',
  `customer_consent` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1->accepted, 2->rejected',
  `webservice_response` varchar(70) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Crossword_Details`
--

CREATE TABLE IF NOT EXISTS `Crossword_Details` (
  `CrosswordD_ID` int(11) NOT NULL,
  `CrosswordID` int(11) NOT NULL DEFAULT '0',
  `Crossword_Solution` text NOT NULL,
  `Crossword_Option` text NOT NULL,
  `Crossword_Across` text NOT NULL,
  `Crossword_Down` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_experience_with_banks`
--

CREATE TABLE IF NOT EXISTS `customer_experience_with_banks` (
  `feedbackid` int(11) NOT NULL,
  `requestid` int(11) NOT NULL DEFAULT '0',
  `received_call` varchar(50) NOT NULL DEFAULT '',
  `bank_experience` varchar(50) NOT NULL DEFAULT '0',
  `bank_requirement_fulfilled` varchar(50) NOT NULL DEFAULT '0',
  `bank_name` varchar(100) NOT NULL DEFAULT '',
  `productid` varchar(10) NOT NULL DEFAULT '',
  `feedback_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `gone_to_bankid` varchar(200) NOT NULL DEFAULT '',
  `gone_to_bankname` varchar(200) NOT NULL DEFAULT '',
  `documents_pick` varchar(100) NOT NULL DEFAULT '',
  `loan_amount` varchar(200) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_feedback_verified`
--

CREATE TABLE IF NOT EXISTS `customer_feedback_verified` (
  `custfbvdid` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `company_name` text NOT NULL,
  `account` varchar(100) NOT NULL,
  `income` decimal(12,2) NOT NULL,
  `loan_amount` decimal(12,2) NOT NULL,
  `doe` date NOT NULL,
  `bank_feedback` varchar(100) NOT NULL,
  `bank_remark` varchar(255) NOT NULL,
  `given_to` tinyint(4) NOT NULL,
  `Bank_Name` varchar(50) NOT NULL,
  `date_of_crosscheck` datetime NOT NULL,
  `d4l_feedback` varchar(100) NOT NULL,
  `d4l_remarks` varchar(200) NOT NULL,
  `followup_date` datetime NOT NULL,
  `dated` datetime NOT NULL,
  `upload_manager` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `d4l_smscampaign_leads`
--

CREATE TABLE IF NOT EXISTS `d4l_smscampaign_leads` (
  `d4lcampid` int(11) NOT NULL,
  `sms_Keyword` varchar(10) NOT NULL,
  `sms_senddate` datetime NOT NULL,
  `sms_FromNumber` bigint(20) NOT NULL,
  `sms_ToNumber` bigint(20) NOT NULL,
  `sms_text` varchar(100) NOT NULL,
  `sms_operator` varchar(20) NOT NULL,
  `sms_City` varchar(50) NOT NULL,
  `sms_source` varchar(20) NOT NULL,
  `sms_DOE` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `data_id` int(11) NOT NULL,
  `entry_id` int(11) NOT NULL DEFAULT '0',
  `data_name` text NOT NULL,
  `data_content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_prepaid_aug`
--

CREATE TABLE IF NOT EXISTS `data_prepaid_aug` (
  `requestid` int(11) NOT NULL,
  `bidder_count` int(11) NOT NULL,
  `source` text NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dcb_cards_pincode`
--

CREATE TABLE IF NOT EXISTS `dcb_cards_pincode` (
  `id` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `debt_counseling`
--

CREATE TABLE IF NOT EXISTS `debt_counseling` (
  `dbtid` int(11) NOT NULL,
  `dbt_name` varchar(30) NOT NULL,
  `dbt_contact` bigint(20) NOT NULL,
  `dbt_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `DND_customer_details`
--

CREATE TABLE IF NOT EXISTS `DND_customer_details` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(10,0) DEFAULT NULL,
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `CC_Holder` tinyint(4) DEFAULT '0',
  `Descr` varchar(50) DEFAULT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(250) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Pancard` varchar(25) NOT NULL DEFAULT '',
  `Pancard_No` varchar(50) DEFAULT NULL,
  `No_of_Banks` varchar(200) DEFAULT NULL,
  `Allocated` tinyint(2) DEFAULT NULL,
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Loan_Running` tinyint(4) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) DEFAULT '0',
  `Applied_With_Banks` varchar(250) DEFAULT NULL,
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Office_Address` varchar(255) DEFAULT NULL,
  `Credit_Limit` tinyint(1) DEFAULT '0',
  `Bidder_Count` int(11) NOT NULL DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(150) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `docs_uploaded`
--

CREATE TABLE IF NOT EXISTS `docs_uploaded` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Doc_Name` varchar(200) NOT NULL DEFAULT '',
  `Filename` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `docs_uploaded_blue`
--

CREATE TABLE IF NOT EXISTS `docs_uploaded_blue` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Doc_Name` varchar(200) NOT NULL DEFAULT '',
  `Filename` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `docs_uploaded_fil`
--

CREATE TABLE IF NOT EXISTS `docs_uploaded_fil` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Doc_Name` varchar(200) NOT NULL DEFAULT '',
  `Filename` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `docs_uploaded_hl`
--

CREATE TABLE IF NOT EXISTS `docs_uploaded_hl` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Doc_Name` varchar(200) NOT NULL DEFAULT '',
  `Filename` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Dummy_Bidders`
--

CREATE TABLE IF NOT EXISTS `Dummy_Bidders` (
  `BidderID` int(10) unsigned NOT NULL,
  `Email` varchar(50) NOT NULL DEFAULT '',
  `PWD` varchar(15) NOT NULL DEFAULT '',
  `Bidder_Name` varchar(100) NOT NULL DEFAULT '',
  `Associated_Bank` varchar(50) NOT NULL DEFAULT '',
  `Selection_Category` tinyint(5) NOT NULL DEFAULT '0',
  `City` varchar(100) NOT NULL DEFAULT '',
  `Address` varchar(100) NOT NULL DEFAULT '',
  `Website` varchar(100) NOT NULL DEFAULT '',
  `Email_old` varchar(50) NOT NULL DEFAULT '',
  `Contact_Num` varchar(30) NOT NULL DEFAULT '',
  `Profile` text NOT NULL,
  `Join_Date` date NOT NULL DEFAULT '0000-00-00',
  `Last_Login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Count_Replies` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Has_New_Reply` tinyint(1) DEFAULT NULL,
  `Is_Verified` tinyint(5) DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `BidderEmailID` varchar(150) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Dummy_Bidders_List`
--

CREATE TABLE IF NOT EXISTS `Dummy_Bidders_List` (
  `Bidder_listID` int(11) NOT NULL,
  `BidderID` int(10) unsigned NOT NULL DEFAULT '0',
  `Bidder_Name` varchar(100) DEFAULT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `City` text,
  `Query` text,
  `Dated` date DEFAULT NULL,
  `Always` tinyint(1) DEFAULT NULL,
  `Conflict_bidder` varchar(100) DEFAULT NULL,
  `Table_Name` varchar(100) DEFAULT NULL,
  `Sequence_no` tinyint(2) DEFAULT '0',
  `Last_allocation` tinyint(2) DEFAULT '0',
  `Last_set_select` tinyint(2) DEFAULT '0',
  `Restrict_Bidder` tinyint(4) NOT NULL DEFAULT '0',
  `Lead_Count` varchar(50) DEFAULT NULL,
  `Bidder_Open_Flag` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dummy_table`
--

CREATE TABLE IF NOT EXISTS `dummy_table` (
  `dumy_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `emp_status` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `city_other` varchar(50) DEFAULT NULL,
  `std_code` varchar(50) DEFAULT NULL,
  `landline` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(50) DEFAULT NULL,
  `std_code_o` varchar(50) DEFAULT NULL,
  `landline_o` varchar(50) DEFAULT NULL,
  `net_salary` varchar(50) DEFAULT NULL,
  `loan_amount` varchar(50) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `doe` varchar(50) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `is_valid` varchar(50) DEFAULT NULL,
  `bidder_count` varchar(50) DEFAULT NULL,
  `sent_to_bidders` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Duplicate_Bidders_Book_Keeping`
--

CREATE TABLE IF NOT EXISTS `Duplicate_Bidders_Book_Keeping` (
  `BookID` int(9) NOT NULL,
  `BidderID` int(9) NOT NULL DEFAULT '0',
  `BookProduct` tinyint(2) NOT NULL DEFAULT '0',
  `BookDate` tinyint(2) NOT NULL DEFAULT '0',
  `BookWeek` tinyint(2) NOT NULL DEFAULT '0',
  `BookMonth` tinyint(2) NOT NULL DEFAULT '0',
  `BookYear` int(4) NOT NULL DEFAULT '0',
  `BookLeadCount` int(9) NOT NULL DEFAULT '0',
  `BookEntryTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Duplicate_Lead_Update`
--

CREATE TABLE IF NOT EXISTS `Duplicate_Lead_Update` (
  `duplicateid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Mobile_Number` bigint(20) NOT NULL DEFAULT '0',
  `NewMobile_number` bigint(20) NOT NULL DEFAULT '0',
  `ProductID` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lead_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `EBBusiness_leads_credithistory`
--

CREATE TABLE IF NOT EXISTS `EBBusiness_leads_credithistory` (
  `ebleadchid` int(11) NOT NULL,
  `ebch_loan_type` varchar(100) NOT NULL,
  `ebch_bank_name` varchar(100) NOT NULL,
  `ebch_roi` decimal(5,2) NOT NULL,
  `ebch_tenure` smallint(6) NOT NULL,
  `ebch_emi` int(11) NOT NULL,
  `ebch_loan_amount` decimal(12,2) NOT NULL,
  `ebch_loan_month` varchar(10) NOT NULL,
  `ebch_loan_year` mediumint(9) NOT NULL,
  `ebch_dated` datetime NOT NULL,
  `ebch_sequence` int(11) NOT NULL,
  `ebleadid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `edelweiss_leads`
--

CREATE TABLE IF NOT EXISTS `edelweiss_leads` (
  `Edelweiss_ID` int(11) NOT NULL,
  `E_RequestID` int(11) NOT NULL DEFAULT '0',
  `E_Product` int(11) NOT NULL DEFAULT '0',
  `E_Name` varchar(100) NOT NULL DEFAULT '',
  `E_Emailid` varchar(255) NOT NULL,
  `E_City` varchar(100) NOT NULL DEFAULT '',
  `E_Mobile_Number` bigint(20) NOT NULL DEFAULT '0',
  `E_DOB` varchar(100) NOT NULL DEFAULT '',
  `E_Pincode` varchar(50) NOT NULL DEFAULT '',
  `E_Dated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Eligible_Bidder_List`
--

CREATE TABLE IF NOT EXISTS `Eligible_Bidder_List` (
  `ID` bigint(20) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `City` varchar(50) NOT NULL DEFAULT '',
  `Bidder_Bank` varchar(25) NOT NULL DEFAULT '',
  `Bidder_Contact` varchar(25) NOT NULL DEFAULT '',
  `Bidder_Number` varchar(50) NOT NULL DEFAULT '',
  `IsValid` char(1) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_survey`
--

CREATE TABLE IF NOT EXISTS `employee_survey` (
  `e_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL DEFAULT '',
  `department` varchar(40) NOT NULL DEFAULT '',
  `friendly_place` varchar(50) NOT NULL DEFAULT '',
  `resources` varchar(50) NOT NULL DEFAULT '',
  `physically_safe` varchar(50) NOT NULL DEFAULT '',
  `special_recognition` varchar(50) NOT NULL DEFAULT '',
  `give_extra` varchar(50) NOT NULL DEFAULT '',
  `people_coorperate` varchar(50) NOT NULL DEFAULT '',
  `expectation_clear` varchar(50) NOT NULL DEFAULT '',
  `straight_answer` varchar(50) NOT NULL DEFAULT '',
  `training_personally` varchar(50) NOT NULL DEFAULT '',
  `appreciation` varchar(50) NOT NULL DEFAULT '',
  `paid_fairly` varchar(50) NOT NULL DEFAULT '',
  `just_job` varchar(50) NOT NULL DEFAULT '',
  `feel_home` varchar(50) NOT NULL DEFAULT '',
  `easy_talk` varchar(50) NOT NULL DEFAULT '',
  `honest_mistakes` varchar(50) NOT NULL DEFAULT '',
  `respond_suggestions` varchar(50) NOT NULL DEFAULT '',
  `sense_pride` varchar(50) NOT NULL DEFAULT '',
  `fair_share` varchar(50) NOT NULL DEFAULT '',
  `informed_issues` varchar(50) NOT NULL DEFAULT '',
  `clear_view` varchar(50) NOT NULL DEFAULT '',
  `trust_people` varchar(50) NOT NULL DEFAULT '',
  `involves_people` varchar(50) NOT NULL DEFAULT '',
  `avoid_playing` varchar(50) NOT NULL DEFAULT '',
  `ways_contribute` varchar(50) NOT NULL DEFAULT '',
  `assigning_coordinating` varchar(50) NOT NULL DEFAULT '',
  `given_responsibility` varchar(50) NOT NULL DEFAULT '',
  `emotionally_healthy` varchar(50) NOT NULL DEFAULT '',
  `treated_fairly` varchar(50) NOT NULL DEFAULT '',
  `best_deserve` varchar(50) NOT NULL DEFAULT '',
  `coming_to_work` varchar(50) NOT NULL DEFAULT '',
  `myself_here` varchar(50) NOT NULL DEFAULT '',
  `delivers_promise` varchar(50) NOT NULL DEFAULT '',
  `treated_fair_race` varchar(50) NOT NULL DEFAULT '',
  `care_each_other` varchar(50) NOT NULL DEFAULT '',
  `action_match` varchar(50) NOT NULL DEFAULT '',
  `good_working` varchar(50) NOT NULL DEFAULT '',
  `treated_fair_sex` varchar(50) NOT NULL DEFAULT '',
  `tell_others` varchar(50) NOT NULL DEFAULT '',
  `ft_feeling` varchar(50) NOT NULL DEFAULT '',
  `celebrate_events` varchar(50) NOT NULL DEFAULT '',
  `last_resort` varchar(50) NOT NULL DEFAULT '',
  `avoid_politicking` varchar(50) NOT NULL DEFAULT '',
  `balance_work` varchar(50) NOT NULL DEFAULT '',
  `treated_fair_orientation` varchar(50) NOT NULL DEFAULT '',
  `competent_running_busines` varchar(50) NOT NULL DEFAULT '',
  `fair_shake` varchar(50) NOT NULL DEFAULT '',
  `su_benefits` varchar(50) NOT NULL DEFAULT '',
  `in_this_together` varchar(50) NOT NULL DEFAULT '',
  `honest_ethical` varchar(50) NOT NULL DEFAULT '',
  `sincere_interest` varchar(50) NOT NULL DEFAULT '',
  `work_long` varchar(50) NOT NULL DEFAULT '',
  `treated_full_member` varchar(50) NOT NULL DEFAULT '',
  `take_time_off` varchar(50) NOT NULL DEFAULT '',
  `make_difference` varchar(50) NOT NULL DEFAULT '',
  `feel_welcome` varchar(50) NOT NULL DEFAULT '',
  `fun_place` varchar(50) NOT NULL DEFAULT '',
  `fit_well_here` varchar(50) NOT NULL DEFAULT '',
  `great_place` varchar(50) NOT NULL DEFAULT '',
  `leaders_right_thing` varchar(50) NOT NULL DEFAULT '',
  `values_entrepreneurship` varchar(50) NOT NULL DEFAULT '',
  `leaders_consistent` varchar(50) NOT NULL DEFAULT '',
  `value_integrity` varchar(50) NOT NULL DEFAULT '',
  `value_teamwork` varchar(50) NOT NULL DEFAULT '',
  `leadership_team_work` varchar(50) NOT NULL DEFAULT '',
  `openness_trust` varchar(50) NOT NULL DEFAULT '',
  `satisfied_management` varchar(50) NOT NULL DEFAULT '',
  `satisfied_culture` varchar(50) NOT NULL DEFAULT '',
  `expect_to_work` varchar(30) NOT NULL DEFAULT '',
  `rate_wrs` varchar(30) NOT NULL DEFAULT '',
  `age` varchar(30) NOT NULL DEFAULT '0',
  `gender` varchar(6) NOT NULL DEFAULT '',
  `service` varchar(4) NOT NULL DEFAULT '',
  `state` varchar(50) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `company_great_place` text NOT NULL,
  `improved_compnay` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `entry_id` int(11) NOT NULL,
  `full_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exact_bidder_leads_count`
--

CREATE TABLE IF NOT EXISTS `exact_bidder_leads_count` (
  `lead_counid` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `product_type` int(11) NOT NULL DEFAULT '0',
  `leads_count` int(11) NOT NULL DEFAULT '0',
  `caplead_count` varchar(200) NOT NULL DEFAULT '',
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastdatetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exclude_source_calling`
--

CREATE TABLE IF NOT EXISTS `exclude_source_calling` (
  `id` int(11) NOT NULL,
  `source` varchar(120) NOT NULL,
  `reply_type` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_cais_account_details`
--

CREATE TABLE IF NOT EXISTS `experian_cais_account_details` (
  `id` int(11) NOT NULL,
  `ReportID` int(11) NOT NULL,
  `Subscriber_Name` varchar(120) DEFAULT NULL,
  `Account_Number` varchar(120) DEFAULT NULL,
  `Portfolio_Type` varchar(120) DEFAULT NULL,
  `Account_Type` varchar(120) DEFAULT NULL,
  `Open_Date` varchar(120) DEFAULT NULL,
  `Highest_Credit_or_Original_Loan_Amount` varchar(120) DEFAULT NULL,
  `Terms_Duration` varchar(120) DEFAULT NULL,
  `Terms_Frequency` varchar(120) DEFAULT NULL,
  `Scheduled_Monthly_Payment_Amount` varchar(120) DEFAULT NULL,
  `Account_Status` varchar(120) DEFAULT NULL,
  `Payment_Rating` varchar(120) DEFAULT NULL,
  `Payment_History_Profile` varchar(120) DEFAULT NULL,
  `Special_Comment` varchar(120) DEFAULT NULL,
  `Current_Balance` varchar(120) DEFAULT NULL,
  `Amount_Past_Due` varchar(120) DEFAULT NULL,
  `Date_Reported` varchar(120) DEFAULT NULL,
  `Date_Closed` varchar(120) DEFAULT NULL,
  `Date_of_Last_Payment` varchar(120) DEFAULT NULL,
  `SuitFiledWillfulDefaultWrittenOffStatus` varchar(120) DEFAULT NULL,
  `Written_off_Settled_Status` varchar(120) DEFAULT NULL,
  `Value_of_Credits_Last_Month` varchar(120) DEFAULT NULL,
  `Occupation_Code` varchar(120) DEFAULT NULL,
  `Settlement_Amount` varchar(120) DEFAULT NULL,
  `Value_of_Collateral` varchar(120) DEFAULT NULL,
  `Type_of_Collateral` varchar(120) NOT NULL,
  `Written_Off_Amt_Total` varchar(120) NOT NULL,
  `Written_Off_Amt_Principal` varchar(120) NOT NULL,
  `Rate_of_Interest` varchar(120) NOT NULL,
  `Repayment_Tenure` varchar(120) NOT NULL,
  `Promotional_Rate_Flag` varchar(120) NOT NULL,
  `Income` varchar(120) NOT NULL,
  `Income_Indicator` varchar(120) NOT NULL,
  `Income_Frequency_Indicator` varchar(120) NOT NULL,
  `DefaultStatusDate` varchar(120) NOT NULL,
  `LitigationStatusDate` varchar(120) NOT NULL,
  `WriteOffStatusDate` varchar(120) NOT NULL,
  `DateOfAddition` varchar(120) NOT NULL,
  `CurrencyCode` varchar(120) NOT NULL,
  `Subscriber_comments` varchar(120) NOT NULL,
  `Consumer_comments` varchar(120) NOT NULL,
  `AccountHoldertypeCode` varchar(120) NOT NULL,
  `Surname_Non_Normalized` varchar(120) NOT NULL,
  `First_Name_Non_Normalized` varchar(120) NOT NULL,
  `Middle_Name_1_Non_Normalized` varchar(120) NOT NULL,
  `Middle_Name_2_Non_Normalized` varchar(120) NOT NULL,
  `Middle_Name_3_Non_Normalized` varchar(120) NOT NULL,
  `Alias` varchar(120) NOT NULL,
  `Gender_Code` varchar(120) NOT NULL,
  `Date_of_birth` varchar(120) NOT NULL,
  `First_Line_Of_Address_non_normalized` varchar(120) NOT NULL,
  `Second_Line_Of_Address_non_normalized` varchar(120) NOT NULL,
  `Third_Line_Of_Address_non_normalized` varchar(120) NOT NULL,
  `City_non_normalized` varchar(120) NOT NULL,
  `Fifth_Line_Of_Address_non_normalized` varchar(120) NOT NULL,
  `State_non_normalized` varchar(120) NOT NULL,
  `ZIP_Postal_Code_non_normalized` varchar(120) NOT NULL,
  `CountryCode_non_normalized` varchar(120) NOT NULL,
  `Address_indicator_non_normalized` varchar(120) NOT NULL,
  `Residence_code_non_normalized` varchar(120) NOT NULL,
  `Telephone_Number` varchar(120) NOT NULL,
  `Telephone_Type` varchar(120) NOT NULL,
  `Driver_License_Number` varchar(120) NOT NULL,
  `Driver_License_Issue_Date` varchar(120) NOT NULL,
  `Driver_License_Expiration_Date` varchar(120) NOT NULL,
  `CAISAccountHistory` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_cais_account_history`
--

CREATE TABLE IF NOT EXISTS `experian_cais_account_history` (
  `id` int(11) NOT NULL,
  `ReportID` int(11) NOT NULL,
  `exp_caisaccount_id` int(11) NOT NULL,
  `Year` varchar(6) NOT NULL,
  `Month` varchar(6) NOT NULL,
  `Days_Past_Due` varchar(20) NOT NULL,
  `Asset_Classification` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_caps_application_details`
--

CREATE TABLE IF NOT EXISTS `experian_caps_application_details` (
  `id` int(11) NOT NULL,
  `ReportID` int(11) NOT NULL,
  `CapsSubscriber_code` varchar(120) NOT NULL,
  `CapsSubscriber_Name` varchar(120) NOT NULL,
  `CapsDate_of_Request` varchar(120) NOT NULL,
  `CapsReportTime` varchar(120) NOT NULL,
  `CapsReportNumber` varchar(120) NOT NULL,
  `CapsEnquiry_Reason` varchar(120) NOT NULL,
  `CapsFinance_Purpose` varchar(120) NOT NULL,
  `CapsAmount_Financed` varchar(120) NOT NULL,
  `CapsDuration_Of_Agreement` varchar(120) NOT NULL,
  `CapsLast_Name` varchar(120) NOT NULL,
  `CapsFirst_Name` varchar(120) NOT NULL,
  `CapsMiddle_Name1` varchar(120) NOT NULL,
  `CapsMiddle_Name2` varchar(120) NOT NULL,
  `CapsMiddle_Name3` varchar(120) NOT NULL,
  `CapsGender_Code` varchar(120) NOT NULL,
  `CapsIncomeTaxPan` varchar(120) NOT NULL,
  `CapsPAN_Issue_Date` varchar(120) NOT NULL,
  `CapsPAN_Expiration_Date` varchar(120) NOT NULL,
  `CapsPassport_number` varchar(120) NOT NULL,
  `CapsPassport_Issue_Date` varchar(120) NOT NULL,
  `CapsPassport_Expiration_Date` varchar(120) NOT NULL,
  `CapsVoter_s_Identity_Card` varchar(120) NOT NULL,
  `CapsVoter_ID_Issue_Date` varchar(120) NOT NULL,
  `CapsVoter_ID_Expiration_Date` varchar(120) NOT NULL,
  `CapsDriver_License_Number` varchar(120) NOT NULL,
  `CapsDriver_License_Issue_Date` varchar(120) NOT NULL,
  `CapsDriver_License_Expiration_Date` varchar(120) NOT NULL,
  `CapsRation_Card_Number` varchar(120) NOT NULL,
  `CapsRation_Card_Issue_Date` varchar(120) NOT NULL,
  `CapsRation_Card_Expiration_Date` varchar(120) NOT NULL,
  `CapsUniversal_ID_Number` varchar(120) NOT NULL,
  `CapsUniversal_ID_Issue_Date` varchar(120) NOT NULL,
  `CapsUniversal_ID_Expiration_Date` varchar(120) NOT NULL,
  `CapsDate_Of_Birth_Applicant` varchar(120) NOT NULL,
  `CapsTelephone_Type` varchar(120) NOT NULL,
  `CapsMobilePhoneNumber` varchar(120) NOT NULL,
  `CapsEMailId` varchar(120) NOT NULL,
  `CapsIncome` varchar(120) NOT NULL,
  `CapsMarital_Status` varchar(120) NOT NULL,
  `CapsEmployment_Status` varchar(120) NOT NULL,
  `CapsTime_with_Employer` varchar(120) NOT NULL,
  `CapsNumber_of_Major_Credit_Card_Held` varchar(120) NOT NULL,
  `CapsFlatNoPlotNoHouseNo` varchar(120) NOT NULL,
  `CapsBldgNoSocietyName` varchar(120) NOT NULL,
  `CapsRoadNoNameAreaLocality` varchar(120) NOT NULL,
  `CapsCity` varchar(120) NOT NULL,
  `CapsLandmark` varchar(120) NOT NULL,
  `CapsState` varchar(120) NOT NULL,
  `CapsPINCode` varchar(120) NOT NULL,
  `CapsCountry_Code` varchar(120) NOT NULL,
  `CapsAddFlatNoPlotNoHouseNo` varchar(120) NOT NULL,
  `CapsAddBldgNoSocietyName` varchar(120) NOT NULL,
  `CapsAddRoadNoNameAreaLocality` varchar(120) NOT NULL,
  `CapsAddCity` varchar(120) NOT NULL,
  `CapsAddLandmark` varchar(120) NOT NULL,
  `CapsAddState` varchar(120) NOT NULL,
  `CapsAddPINCode` varchar(120) NOT NULL,
  `CapsAddCountry_Code` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_customer_othermisc_details`
--

CREATE TABLE IF NOT EXISTS `experian_customer_othermisc_details` (
  `id` int(11) NOT NULL,
  `ReportID` int(11) NOT NULL,
  `Customer_Name` varchar(180) NOT NULL,
  `CreditAccountTotal` varchar(40) NOT NULL,
  `CreditAccountActive` varchar(10) NOT NULL,
  `CreditAccountDefault` varchar(40) NOT NULL,
  `CreditAccountClosed` varchar(20) NOT NULL,
  `CADSuitFiledCurrentBalance` varchar(20) NOT NULL,
  `Outstanding_Balance_Secured` varchar(20) NOT NULL,
  `Outstanding_Balance_Secured_Percentage` varchar(6) NOT NULL,
  `Outstanding_Balance_UnSecured` varchar(40) NOT NULL,
  `Outstanding_Balance_UnSecured_Percentage` varchar(6) NOT NULL,
  `Outstanding_Balance_All` varchar(40) NOT NULL,
  `Exact_match` varchar(20) NOT NULL,
  `TotalCAPSLast7Days` varchar(20) NOT NULL,
  `TotalCAPSLast30Days` varchar(20) NOT NULL,
  `TotalCAPSLast90Days` varchar(20) NOT NULL,
  `TotalCAPSLast180Days` varchar(20) NOT NULL,
  `CAPSLast7Days` varchar(20) NOT NULL,
  `CAPSLast30Days` varchar(20) NOT NULL,
  `CAPSLast90Days` varchar(20) NOT NULL,
  `CAPSLast180Days` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_customer_other_details`
--

CREATE TABLE IF NOT EXISTS `experian_customer_other_details` (
  `id` int(11) NOT NULL,
  `ReportID` int(11) NOT NULL,
  `Customer_Name` varchar(120) NOT NULL,
  `Last_Name` varchar(70) DEFAULT NULL,
  `First_Name` varchar(70) DEFAULT NULL,
  `Middle_Name1` varchar(70) DEFAULT NULL,
  `Middle_Name2` varchar(70) DEFAULT NULL,
  `Middle_Name3` varchar(70) DEFAULT NULL,
  `Passport_Issue_Date` varchar(30) DEFAULT NULL,
  `Passport_Expiration_Date` varchar(15) NOT NULL,
  `Voter_s_Identity_Card` varchar(40) DEFAULT NULL,
  `Voter_ID_Issue_Date` varchar(30) DEFAULT NULL,
  `Voter_ID_Expiration_Date` varchar(20) DEFAULT NULL,
  `Driver_License_Number` varchar(20) DEFAULT NULL,
  `Driver_License_Issue_Date` varchar(20) DEFAULT NULL,
  `Driver_License_Expiration_Date` varchar(20) DEFAULT NULL,
  `Ration_Card_Number` varchar(20) DEFAULT NULL,
  `Ration_Card_Issue_Date` varchar(20) DEFAULT NULL,
  `Ration_Card_Expiration_Date` varchar(20) DEFAULT NULL,
  `Marital_Status` varchar(10) DEFAULT NULL,
  `MobilePhoneNumber` varchar(12) DEFAULT NULL,
  `EMailId` varchar(110) DEFAULT NULL,
  `Telephone_Number_Applicant_1st` varchar(40) NOT NULL,
  `Telephone_Extension` varchar(10) NOT NULL,
  `Telephone_Type` varchar(10) NOT NULL,
  `Income` varchar(15) NOT NULL,
  `Employment_Status` varchar(20) NOT NULL,
  `Time_with_Employer` varchar(20) NOT NULL,
  `Number_of_Major_Credit_Card_Held` varchar(20) NOT NULL,
  `FlatNoPlotNoHouseNo` varchar(200) NOT NULL,
  `BldgNoSocietyName` varchar(200) NOT NULL,
  `RoadNoNameAreaLocality` varchar(200) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Landmark` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `PINCode` varchar(8) NOT NULL,
  `Country_Code` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_customer_primary_details`
--

CREATE TABLE IF NOT EXISTS `experian_customer_primary_details` (
  `id` int(11) NOT NULL,
  `Customer_name` varchar(80) NOT NULL,
  `Gender_Code` tinyint(4) NOT NULL,
  `IncomeTaxPan` varchar(10) NOT NULL,
  `PAN_Issue_Date` varchar(20) NOT NULL,
  `PAN_Expiration_Date` varchar(20) NOT NULL,
  `Universal_ID_Number` varchar(50) NOT NULL,
  `Universal_ID_Issue_Date` varchar(20) NOT NULL,
  `Universal_ID_Expiration_Date` varchar(20) NOT NULL,
  `Date_Of_Birth_Applicant` varchar(20) NOT NULL,
  `initialdetailsid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_customer_score_details`
--

CREATE TABLE IF NOT EXISTS `experian_customer_score_details` (
  `id` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `Customer_Name` varchar(180) NOT NULL,
  `Dated` datetime NOT NULL,
  `SystemCode` varchar(40) NOT NULL,
  `MessageText` varchar(160) NOT NULL,
  `ReportDate` varchar(30) NOT NULL,
  `ReportTime` varchar(30) NOT NULL,
  `UserMessageText` varchar(40) NOT NULL,
  `Enquiry_Username` varchar(40) NOT NULL,
  `Version` varchar(40) NOT NULL,
  `ReportNumber` varchar(40) NOT NULL,
  `Subscriber_Name` varchar(40) NOT NULL,
  `Enquiry_Reason` varchar(20) NOT NULL,
  `Finance_Purpose` varchar(40) NOT NULL,
  `Amount_Financed` varchar(30) NOT NULL,
  `Duration_Of_Agreement` varchar(40) NOT NULL,
  `BureauScore` varchar(40) NOT NULL,
  `BureauScoreConfidLevel` varchar(40) NOT NULL,
  `initialdetailsid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_initial_details`
--

CREATE TABLE IF NOT EXISTS `experian_initial_details` (
  `id` int(11) NOT NULL,
  `firstName` varchar(80) NOT NULL,
  `middleName` varchar(80) DEFAULT NULL,
  `surName` varchar(80) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('1','2') NOT NULL,
  `mobileNo` bigint(20) NOT NULL,
  `telephoneNo` int(11) DEFAULT NULL,
  `telephoneType` enum('0','2','3') DEFAULT NULL,
  `email` varchar(120) NOT NULL,
  `flatno` varchar(120) DEFAULT NULL,
  `buildingName` varchar(120) DEFAULT NULL,
  `road` varchar(120) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL,
  `pan` varchar(10) NOT NULL,
  `passport` varchar(20) DEFAULT NULL,
  `aadhaar` varchar(40) DEFAULT NULL,
  `voterid` varchar(40) DEFAULT NULL,
  `driverlicense` varchar(40) DEFAULT NULL,
  `rationcard` varchar(40) DEFAULT NULL,
  `ip_address` varchar(15) NOT NULL,
  `dated` datetime NOT NULL,
  `vouchercode` varchar(30) NOT NULL,
  `Stage1ID` varchar(20) NOT NULL,
  `Stage2ID` varchar(20) NOT NULL,
  `counter` int(11) DEFAULT '0',
  `email_code` varchar(10) NOT NULL,
  `mobile_code` varchar(10) NOT NULL,
  `mobile_verified` tinyint(4) NOT NULL,
  `email_verified` tinyint(4) NOT NULL,
  `product` varchar(6) NOT NULL,
  `source` varchar(50) DEFAULT NULL,
  `requestid` int(11) NOT NULL,
  `cibil_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_log`
--

CREATE TABLE IF NOT EXISTS `experian_log` (
  `id` int(11) NOT NULL,
  `step` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL,
  `message` varchar(255) NOT NULL,
  `requestid` int(11) NOT NULL DEFAULT '0',
  `lead_details` text,
  `Dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_noncaps_application_details`
--

CREATE TABLE IF NOT EXISTS `experian_noncaps_application_details` (
  `id` int(11) NOT NULL,
  `ReportID` int(11) NOT NULL,
  `NonCapsSubscriber_code` varchar(80) NOT NULL,
  `NonCapsSubscriber_Name` varchar(80) NOT NULL,
  `NonCapsDate_of_Request` varchar(80) NOT NULL,
  `NonCapsReportTime` varchar(30) NOT NULL,
  `NonCapsReportNumber` varchar(80) NOT NULL,
  `NonCapsEnquiry_Reason` varchar(80) NOT NULL,
  `NonCapsFinance_Purpose` varchar(80) NOT NULL,
  `NonCapsAmount_Financed` varchar(80) NOT NULL,
  `NonCapsDuration_Of_Agreement` varchar(80) NOT NULL,
  `NonCapsLast_Name` varchar(80) NOT NULL,
  `NonCapsFirst_Name` varchar(80) NOT NULL,
  `NonCapsMiddle_Name1` varchar(80) NOT NULL,
  `NonCapsMiddle_Name2` varchar(80) NOT NULL,
  `NonCapsMiddle_Name3` varchar(80) NOT NULL,
  `NonCapsGender_Code` varchar(80) NOT NULL,
  `NonCapsIncomeTaxPan` varchar(80) NOT NULL,
  `NonCapsPAN_Issue_Date` varchar(80) NOT NULL,
  `NonCapsPAN_Expiration_Date` varchar(80) NOT NULL,
  `NonCapsPassport_number` varchar(80) NOT NULL,
  `NonCapsPassport_Issue_Date` varchar(80) NOT NULL,
  `NonCapsPassport_Expiration_Date` varchar(80) NOT NULL,
  `NonCapsVoter_s_Identity_Card` varchar(80) NOT NULL,
  `NonCapsVoter_ID_Issue_Date` varchar(80) NOT NULL,
  `NonCapsVoter_ID_Expiration_Date` varchar(80) NOT NULL,
  `NonCapsDriver_License_Number` varchar(80) NOT NULL,
  `NonCapsDriver_License_Issue_Date` varchar(80) NOT NULL,
  `NonCapsDriver_License_Expiration_Date` varchar(80) NOT NULL,
  `NonCapsRation_Card_Number` varchar(80) NOT NULL,
  `NonCapsRation_Card_Issue_Date` varchar(80) NOT NULL,
  `NonCapsRation_Card_Expiration_Date` varchar(80) NOT NULL,
  `NonCapsUniversal_ID_Number` varchar(80) NOT NULL,
  `NonCapsUniversal_ID_Issue_Date` varchar(80) NOT NULL,
  `NonCapsUniversal_ID_Expiration_Date` varchar(80) NOT NULL,
  `NonCapsDate_Of_Birth_Applicant` varchar(80) NOT NULL,
  `NonCapsTelephone_Number_Applicant_1st` varchar(80) NOT NULL,
  `NonCapsTelephone_Extension` varchar(80) NOT NULL,
  `NonCapsTelephone_Type` varchar(80) NOT NULL,
  `NonCapsMobilePhoneNumber` varchar(80) NOT NULL,
  `NonCapsEMailId` varchar(80) NOT NULL,
  `NonCapsIncome` varchar(80) NOT NULL,
  `NonCapsMarital_Status` varchar(80) NOT NULL,
  `NonCapsEmployment_Status` varchar(80) NOT NULL,
  `NonCapsTime_with_Employer` varchar(80) NOT NULL,
  `NonCapsNumber_of_Major_Credit_Card_Held` varchar(80) NOT NULL,
  `NonCapsFlatNoPlotNoHouseNo` varchar(80) NOT NULL,
  `NonCapsBldgNoSocietyName` varchar(80) NOT NULL,
  `NonCapsRoadNoNameAreaLocality` varchar(80) NOT NULL,
  `NonCapsCity` varchar(80) NOT NULL,
  `NonCapsLandmark` varchar(80) NOT NULL,
  `NonCapsState` varchar(80) NOT NULL,
  `NonCapsPINCode` varchar(80) NOT NULL,
  `NonCapsCountry_Code` varchar(80) NOT NULL,
  `NonCapsAddFlatNoPlotNoHouseNo` varchar(80) NOT NULL,
  `NonCapsAddBldgNoSocietyName` varchar(80) NOT NULL,
  `NonCapsAddRoadNoNameAreaLocality` varchar(80) NOT NULL,
  `NonCapsAddCity` varchar(80) NOT NULL,
  `NonCapsAddLandmark` varchar(80) NOT NULL,
  `NonCapsAddState` varchar(80) NOT NULL,
  `NonCapsAddPINCode` varchar(80) NOT NULL,
  `NonCapsAddCountry_Code` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_vouchers_codes`
--

CREATE TABLE IF NOT EXISTS `experian_vouchers_codes` (
  `id` int(11) NOT NULL,
  `Batch_Id` varchar(10) NOT NULL,
  `vouchercode` varchar(30) DEFAULT NULL,
  `VoucherUsedIndicator` varchar(2) NOT NULL DEFAULT 'N',
  `ProviderId` varchar(10) NOT NULL,
  `Assignedtoconsumer` varchar(2) NOT NULL,
  `Stage1HitId` varchar(10) NOT NULL,
  `Stage2HitId` varchar(10) NOT NULL,
  `VoucherdetailsId` int(11) NOT NULL,
  `IssueDate` varchar(10) NOT NULL,
  `StartDate` varchar(10) NOT NULL,
  `UsedDate` varchar(10) NOT NULL,
  `ExpiryDate` varchar(10) NOT NULL,
  `InsertDate` varchar(10) NOT NULL,
  `voucher_type` varchar(13) NOT NULL DEFAULT 'production',
  `requestid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `experian_xml_files`
--

CREATE TABLE IF NOT EXISTS `experian_xml_files` (
  `id` int(11) NOT NULL,
  `requestid` int(11) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `dated` datetime NOT NULL,
  `counter` int(11) NOT NULL,
  `file_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fd_bidders_list`
--

CREATE TABLE IF NOT EXISTS `fd_bidders_list` (
  `Bidder_listID` int(11) NOT NULL,
  `BidderID` int(10) unsigned NOT NULL DEFAULT '0',
  `Bidder_Name` varchar(100) DEFAULT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `City` text,
  `Query` text,
  `Dated` date DEFAULT NULL,
  `Always` tinyint(1) DEFAULT NULL,
  `Conflict_bidder` varchar(200) DEFAULT NULL,
  `Table_Name` varchar(100) DEFAULT NULL,
  `Sequence_no` tinyint(2) DEFAULT '0',
  `Last_allocation` tinyint(2) DEFAULT '0',
  `Last_set_select` tinyint(2) DEFAULT '0',
  `Restrict_Bidder` tinyint(4) NOT NULL DEFAULT '0',
  `Max_Dated` datetime DEFAULT NULL,
  `CapLead_Count` varchar(50) DEFAULT NULL,
  `Cap_MinDate` datetime DEFAULT NULL,
  `Cap_MaxDate` datetime DEFAULT NULL,
  `Cap_Type` varchar(11) DEFAULT NULL,
  `Bidder_Open_Flag` tinyint(4) DEFAULT '0',
  `Multiplier` int(9) NOT NULL DEFAULT '0',
  `CF_Multipler` int(11) NOT NULL DEFAULT '100',
  `Billing_Restriction_Flag` int(2) NOT NULL DEFAULT '0',
  `BankID` varchar(10) NOT NULL DEFAULT '0',
  `Bidder_Priority` varchar(11) NOT NULL DEFAULT '1,1,1',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fd_interestrates`
--

CREATE TABLE IF NOT EXISTS `fd_interestrates` (
  `fd_interestrateID` int(11) NOT NULL,
  `fd_bankID` int(11) NOT NULL DEFAULT '0',
  `7_180bellow15` decimal(4,2) NOT NULL DEFAULT '0.00',
  `7_180bellow15sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `7_180bet15_50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `7_180bet15_50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `7_180above50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `7_180above50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `180_364bellow15` decimal(4,2) NOT NULL DEFAULT '0.00',
  `180_364bellow15sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `180_364bet15_50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `180_364bet15_50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `180_364above50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `180_364above50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `1_2yrbellow15` decimal(4,2) NOT NULL DEFAULT '0.00',
  `1_2yrbellow15sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `1_2yrbet15_50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `1_2yrbet15_50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `1_2yrabove50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `1_2yrabove50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `2_3yrbellow15` decimal(4,2) NOT NULL DEFAULT '0.00',
  `2_3yrbellow15sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `2_3yrbet15_50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `2_3yrbet15_50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `2_3yrabove50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `2_3yrabove50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `3_4yrbellow15` decimal(4,2) NOT NULL DEFAULT '0.00',
  `3_4yrbellow15sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `3_4yrbet15_50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `3_4yrbet15_50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `3_4yrabove50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `3_4yrabove50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `4_5yrbellow15` decimal(4,2) NOT NULL DEFAULT '0.00',
  `4_5yrbellow15sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `4_5yrbet15_50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `4_5yrbet15_50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `4_5yrabove50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `4_5yrabove50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `5_10yrbellow15` decimal(4,2) NOT NULL DEFAULT '0.00',
  `5_10yrbellow15sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `5_10yrbet15_50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `5_10yrbet15_50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `5_10yrabove50` decimal(4,2) NOT NULL DEFAULT '0.00',
  `5_10yrabove50sr` decimal(4,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fd_interestrate_bank`
--

CREATE TABLE IF NOT EXISTS `fd_interestrate_bank` (
  `fd_bankID` int(11) NOT NULL,
  `fd_bank` varchar(255) NOT NULL DEFAULT '',
  `fd_view` tinyint(4) NOT NULL DEFAULT '0',
  `logo` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_bookkeeping`
--

CREATE TABLE IF NOT EXISTS `feedback_bookkeeping` (
  `feedbkid` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `Feedback_ID` int(11) NOT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Dated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Feedback` varchar(50) DEFAULT NULL,
  `Followup_Date` datetime NOT NULL,
  `Comments` text,
  `smstext` text NOT NULL,
  `emailtext` text NOT NULL,
  `leadidentifier` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `FE_Questions`
--

CREATE TABLE IF NOT EXISTS `FE_Questions` (
  `FEID` int(11) NOT NULL,
  `FE_Question` text NOT NULL,
  `FE_Answer` text NOT NULL,
  `FE_Flag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fil_appointments`
--

CREATE TABLE IF NOT EXISTS `fil_appointments` (
  `id` int(11) NOT NULL,
  `address_apt` text NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `appdate` varchar(15) NOT NULL DEFAULT '',
  `changeapp_time` varchar(60) NOT NULL DEFAULT '',
  `docs` text NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `first_blue_leads`
--

CREATE TABLE IF NOT EXISTS `first_blue_leads` (
  `firstblueID` int(11) NOT NULL,
  `firstblue_name` varchar(50) NOT NULL DEFAULT '',
  `firstblue_dob` date NOT NULL DEFAULT '0000-00-00',
  `firstblue_city` varchar(50) NOT NULL DEFAULT '',
  `firstblue_mobile` bigint(20) NOT NULL DEFAULT '0',
  `firstblue_email` varchar(100) NOT NULL DEFAULT '',
  `firstblue_emp_stat` varchar(20) NOT NULL DEFAULT '',
  `firstblue_netsalary` decimal(12,2) NOT NULL DEFAULT '0.00',
  `firstblue_company_name` varchar(200) NOT NULL DEFAULT '',
  `firstblue_office_telephone` varchar(100) NOT NULL DEFAULT '',
  `firstblue_designation` varchar(100) NOT NULL DEFAULT '',
  `firstblue_resi_address1` text NOT NULL,
  `firstblue_resi_address2` text NOT NULL,
  `firstblue_pincode` bigint(20) NOT NULL DEFAULT '0',
  `firstblue_resi_telephone` varchar(50) NOT NULL DEFAULT '',
  `firstblue_pancard` varchar(50) NOT NULL DEFAULT '',
  `firstblue_property_identified` tinyint(4) NOT NULL DEFAULT '0',
  `firstblue_property_value` varchar(100) NOT NULL DEFAULT '',
  `firstblue_property_loc` varchar(50) NOT NULL DEFAULT '',
  `firstblue_builder_name` varchar(50) NOT NULL DEFAULT '',
  `firstblue_obligation` varchar(20) NOT NULL DEFAULT '',
  `firstblue_defaultd` varchar(10) NOT NULL DEFAULT '',
  `firstblue_declined` varchar(10) NOT NULL DEFAULT '',
  `firstblue_appid` varchar(20) NOT NULL DEFAULT '',
  `firstblue_loanamt` varchar(50) NOT NULL DEFAULT '',
  `firstblue_roi` varchar(20) NOT NULL DEFAULT '',
  `firstblue_emi` varchar(20) NOT NULL DEFAULT '',
  `firstblue_tenure` varchar(20) NOT NULL DEFAULT '',
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(50) NOT NULL DEFAULT '',
  `firstblue_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fixed_deposit`
--

CREATE TABLE IF NOT EXISTS `fixed_deposit` (
  `requestid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `dob` date NOT NULL DEFAULT '0000-00-00',
  `age` int(11) NOT NULL DEFAULT '0',
  `mobile_number` varchar(11) NOT NULL DEFAULT '0',
  `city` varchar(50) NOT NULL DEFAULT '',
  `other_city` varchar(50) NOT NULL DEFAULT '',
  `investment_duration` varchar(50) NOT NULL DEFAULT '',
  `investment_amount` varchar(50) NOT NULL DEFAULT '',
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `add_comment` varchar(255) NOT NULL DEFAULT '',
  `allocated` tinyint(4) NOT NULL DEFAULT '2',
  `source` varchar(50) NOT NULL DEFAULT '',
  `ip` varchar(16) NOT NULL DEFAULT '',
  `sms_send` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fs_category`
--

CREATE TABLE IF NOT EXISTS `fs_category` (
  `CategoryID` bigint(20) NOT NULL,
  `ParentID` bigint(20) NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Position` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Fullerton_Allocated_Leads`
--

CREATE TABLE IF NOT EXISTS `Fullerton_Allocated_Leads` (
  `fullertonrequestID` int(11) NOT NULL,
  `RequestID` int(10) NOT NULL,
  `FeedbackID` int(10) unsigned NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(200) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Salary_Drawn` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `identification_proof` text NOT NULL,
  `salary_proof` varchar(255) NOT NULL,
  `experience_proof` varchar(255) NOT NULL,
  `bankstat_proof` varchar(255) NOT NULL,
  `cuurentadd_proof` varchar(255) NOT NULL,
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Bank` varchar(150) NOT NULL,
  `Existing_Loan` decimal(12,2) NOT NULL,
  `Existing_ROI` varchar(10) NOT NULL,
  `Existing_Noofemi` varchar(10) NOT NULL,
  `TelecallerID` int(11) NOT NULL,
  `Allocation_Date` datetime NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(50) NOT NULL,
  `appointment_place` varchar(200) NOT NULL,
  `appointment_address` text NOT NULL,
  `fullerton_feedback` varchar(50) NOT NULL,
  `verifier_feedback` varchar(100) NOT NULL,
  `fullerton_followupdate` datetime NOT NULL,
  `Is_Verified` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fullerton_allocation_track`
--

CREATE TABLE IF NOT EXISTS `fullerton_allocation_track` (
  `id` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Mobile` bigint(20) NOT NULL,
  `BName` varchar(60) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `CName` varchar(90) NOT NULL,
  `CMobile` bigint(20) NOT NULL,
  `Dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fullerton_doc_list`
--

CREATE TABLE IF NOT EXISTS `fullerton_doc_list` (
  `id` int(11) NOT NULL,
  `document` varchar(255) NOT NULL DEFAULT '',
  `abbr` varchar(50) NOT NULL DEFAULT '',
  `p_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fullerton_exclusivecamp`
--

CREATE TABLE IF NOT EXISTS `fullerton_exclusivecamp` (
  `RequestID` int(10) unsigned NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `Total_Experience` decimal(5,2) NOT NULL,
  `Years_In_Company` decimal(5,2) NOT NULL,
  `Is_Permit` tinyint(4) NOT NULL,
  `Feedback` varchar(50) NOT NULL,
  `Add_Comment` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fullerton_leads`
--

CREATE TABLE IF NOT EXISTS `fullerton_leads` (
  `f_id` int(11) NOT NULL,
  `LeadID` int(11) NOT NULL DEFAULT '0',
  `a_feedback` varchar(110) NOT NULL DEFAULT '',
  `a_fullowup_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `a_month` varchar(10) NOT NULL DEFAULT '',
  `a_telecaller` varchar(110) NOT NULL DEFAULT '',
  `a_date` date NOT NULL DEFAULT '0000-00-00',
  `a_time` varchar(30) NOT NULL DEFAULT '',
  `a_address` text NOT NULL,
  `a_city` varchar(70) NOT NULL DEFAULT '',
  `a_pincode` int(11) NOT NULL DEFAULT '0',
  `a_loan_amt` int(11) NOT NULL DEFAULT '0',
  `a_final_loan_amt` int(11) NOT NULL DEFAULT '0',
  `roi` varchar(15) NOT NULL DEFAULT '',
  `a_leaddate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `a_netsalary` int(11) NOT NULL DEFAULT '0',
  `a_remark` text NOT NULL,
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Branch` varchar(100) NOT NULL DEFAULT '',
  `doclist` text NOT NULL,
  `sms_done` char(1) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fullerton_leads_allocation`
--

CREATE TABLE IF NOT EXISTS `fullerton_leads_allocation` (
  `fullertonlid` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Mobile_Number` bigint(20) NOT NULL DEFAULT '0',
  `Compaign_ID` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fullerton_pl_leads`
--

CREATE TABLE IF NOT EXISTS `fullerton_pl_leads` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `Residential_Status` varchar(150) NOT NULL DEFAULT '-1',
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(200) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `CL_EMI_Paid` varchar(15) DEFAULT NULL,
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(25) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Residence_City` varchar(100) NOT NULL DEFAULT '',
  `BidderID` int(11) DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Salary_Drawn` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Contactable` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `identification_proof` varchar(255) NOT NULL DEFAULT '',
  `residence_proof` varchar(255) NOT NULL DEFAULT '',
  `income_proof` varchar(255) NOT NULL DEFAULT '',
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Pancard` varchar(10) NOT NULL DEFAULT '',
  `valid_pan` char(2) NOT NULL DEFAULT '',
  `send_mail` char(2) NOT NULL DEFAULT '',
  `allocated_sms` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `getdata_logs`
--

CREATE TABLE IF NOT EXISTS `getdata_logs` (
  `getdatalgid` int(11) NOT NULL,
  `whoacessed` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `product` varchar(100) NOT NULL,
  `search_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `getdata_tracking`
--

CREATE TABLE IF NOT EXISTS `getdata_tracking` (
  `getdataid` int(11) NOT NULL,
  `secure_pwd` varchar(50) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `get_eligible_leads`
--

CREATE TABLE IF NOT EXISTS `get_eligible_leads` (
  `GetID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Product_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Bidderid_Details` varchar(250) NOT NULL DEFAULT '',
  `Eligible_BidderID` varchar(255) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `get_tataaig_leads`
--

CREATE TABLE IF NOT EXISTS `get_tataaig_leads` (
  `tataaigID` int(11) NOT NULL,
  `t_name` varchar(50) NOT NULL DEFAULT '0',
  `t_mobile` varchar(50) NOT NULL DEFAULT '0',
  `t_email` varchar(100) NOT NULL DEFAULT '',
  `t_city` varchar(100) NOT NULL DEFAULT '',
  `t_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `t_ip` varchar(100) NOT NULL DEFAULT '',
  `t_source` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdbfc_companylist`
--

CREATE TABLE IF NOT EXISTS `hdbfc_companylist` (
  `id` int(11) NOT NULL,
  `company_name` varchar(250) NOT NULL DEFAULT '',
  `category` varchar(10) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdbfs_mailer_leads`
--

CREATE TABLE IF NOT EXISTS `hdbfs_mailer_leads` (
  `hdbfsid` int(11) NOT NULL,
  `hdbfs_name` varchar(50) NOT NULL,
  `hdbfs_email` varchar(200) NOT NULL,
  `hdbfs_mobileno` bigint(20) NOT NULL,
  `hdbfs_dob` date NOT NULL,
  `hdbfs_occupation` tinyint(4) NOT NULL,
  `hdbfs_company_name` text NOT NULL,
  `hdbfs_net_salary` decimal(12,2) NOT NULL,
  `hdbfs_loan_amount` decimal(12,2) NOT NULL,
  `hdbfs_city` varchar(100) NOT NULL,
  `hdbfs_othercity` varchar(100) NOT NULL,
  `hdbfs_panno` varchar(200) NOT NULL,
  `hdbfs_dated` datetime NOT NULL,
  `hdbfs_source` varchar(50) NOT NULL,
  `hdbfs_eligible_bidder` varchar(20) NOT NULL,
  `hdbfs_feedback` varchar(100) NOT NULL,
  `hdbfs_comments` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfcbank_citywise_contactdetails`
--

CREATE TABLE IF NOT EXISTS `hdfcbank_citywise_contactdetails` (
  `id` int(11) NOT NULL,
  `mkgt_city` varchar(100) NOT NULL,
  `mkgt_bidderid` int(11) NOT NULL,
  `sm_name` varchar(100) NOT NULL,
  `sm_email` varchar(100) NOT NULL,
  `sm_mobile_no` varchar(12) NOT NULL,
  `sma_name2` varchar(100) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `rsm_name` varchar(100) NOT NULL,
  `zsm_name` varchar(100) NOT NULL,
  `aro_name` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfccarloan_leads`
--

CREATE TABLE IF NOT EXISTS `hdfccarloan_leads` (
  `RequestID` int(11) NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `Salutation` varchar(4) NOT NULL,
  `FName` varchar(200) NOT NULL,
  `MName` varchar(100) NOT NULL,
  `LName` varchar(100) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `Email` varchar(240) NOT NULL,
  `City` varchar(200) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `AccountNo` varchar(16) NOT NULL,
  `no_dependents` varchar(5) NOT NULL,
  `Qualification` varchar(200) NOT NULL,
  `Resi_Address_line1` varchar(250) NOT NULL,
  `Resi_Address_line2` varchar(255) NOT NULL,
  `Resi_Address_line3` varchar(255) NOT NULL,
  `Resi_landmark` varchar(200) NOT NULL,
  `Resi_State` varchar(50) NOT NULL,
  `Resi_City` varchar(50) NOT NULL,
  `Residence_Pincode` int(11) NOT NULL,
  `Resi_Std` int(11) NOT NULL,
  `Resi_Telephone` bigint(20) NOT NULL,
  `Off_Address_line1` varchar(255) NOT NULL,
  `Off_Address_line2` varchar(255) NOT NULL,
  `Off_Address_line3` varchar(255) NOT NULL,
  `Off_landmark` varchar(200) NOT NULL,
  `Off_State` varchar(50) NOT NULL,
  `Off_City` varchar(50) NOT NULL,
  `Employment_Status` tinyint(4) NOT NULL,
  `Net_Salary` int(11) NOT NULL,
  `Company_Name` varchar(200) NOT NULL,
  `Primary_Acc` varchar(35) NOT NULL,
  `Residence_Status` varchar(180) NOT NULL,
  `salary_account` tinyint(4) NOT NULL,
  `Resi_Stability` varchar(100) NOT NULL,
  `CC_Holder` tinyint(4) NOT NULL,
  `Off_Landline` bigint(20) NOT NULL,
  `office_std` int(11) NOT NULL,
  `off_pincode` int(11) NOT NULL,
  `Dated` datetime NOT NULL,
  `Reference_Code` varchar(6) NOT NULL,
  `Is_Valid` tinyint(4) NOT NULL,
  `captcha_code` varchar(6) NOT NULL,
  `captcha_valid` tinyint(4) NOT NULL,
  `IP` varchar(15) NOT NULL,
  `Source` varchar(25) NOT NULL,
  `Loan_Amount` int(2) NOT NULL,
  `Car_Model` varchar(200) NOT NULL,
  `Car_Price` int(11) NOT NULL,
  `intr_rate` float(5,2) NOT NULL,
  `Tenure` int(11) NOT NULL,
  `AppID` varchar(20) NOT NULL,
  `promotional` varchar(100) NOT NULL,
  `Car_Type` tinyint(4) NOT NULL DEFAULT '1',
  `City_Other` varchar(100) NOT NULL,
  `sms_sent` tinyint(4) NOT NULL,
  `sms_to` varchar(100) NOT NULL,
  `sms_number` bigint(20) NOT NULL,
  `DNDstatus` varchar(20) NOT NULL,
  `address_check` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfccc_leads`
--

CREATE TABLE IF NOT EXISTS `hdfccc_leads` (
  `hdfcccid` int(11) NOT NULL,
  `hdfccc_name` varchar(50) NOT NULL,
  `hdfccc_email` varchar(100) NOT NULL,
  `hdfccc_mobile` bigint(20) NOT NULL,
  `hdfccc_offlandline` varchar(50) NOT NULL,
  `hdfccc_resilandline` varchar(50) NOT NULL,
  `hdfccc_city` varchar(50) NOT NULL,
  `hdfccc_occupation` tinyint(4) NOT NULL,
  `hdfccc_dob` date NOT NULL,
  `hdfccc_income` decimal(12,2) NOT NULL,
  `hdfccc_salary_account` varchar(150) NOT NULL,
  `hdfccc_company_name` varchar(200) NOT NULL,
  `hdfccc_comp_cat` tinyint(4) NOT NULL,
  `hdfccc_ccholder` tinyint(4) NOT NULL,
  `hdfccc_bank_name` varchar(50) NOT NULL,
  `hdfccc_source` varchar(20) NOT NULL,
  `hdfccc_date` datetime NOT NULL,
  `hdfccc_consent` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfclife_compleads`
--

CREATE TABLE IF NOT EXISTS `hdfclife_compleads` (
  `hdfclifeid` int(11) NOT NULL,
  `hdfclife_name` varchar(50) NOT NULL,
  `hdfclife_email` varchar(100) NOT NULL,
  `hdfclife_mobile_number` bigint(20) NOT NULL,
  `hdfclife_city` varchar(50) NOT NULL,
  `hdfclife_income` decimal(12,2) NOT NULL,
  `hdfclife_dob` date NOT NULL,
  `hdfclife_dated` datetime NOT NULL,
  `hdfclife_product` tinyint(4) NOT NULL,
  `hdfclife_source` varchar(50) NOT NULL,
  `hdfclife_requestid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfcred_pixel_capture`
--

CREATE TABLE IF NOT EXISTS `hdfcred_pixel_capture` (
  `hdfcredid` int(11) NOT NULL,
  `hdfcred_email` varchar(100) NOT NULL,
  `hdfcred_uniqueid` int(11) NOT NULL,
  `hdfcred_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_balance_transfer_leads`
--

CREATE TABLE IF NOT EXISTS `hdfc_balance_transfer_leads` (
  `hdfcbtid` int(11) NOT NULL,
  `hdfcbt_name` varchar(50) NOT NULL,
  `hdfcbt_mobile` bigint(20) NOT NULL,
  `hdfcbt_email` varchar(100) NOT NULL,
  `hdfcbt_city` varchar(50) NOT NULL,
  `hdfcbt_net_salary` decimal(12,2) NOT NULL,
  `hdfcbt_existibg_loan_amt` decimal(12,2) NOT NULL,
  `hdfcbt_existing_loan_bank` varchar(50) NOT NULL,
  `hdfcbt_dated` datetime NOT NULL,
  `Feedback` varchar(100) NOT NULL,
  `comment_section` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_bidders`
--

CREATE TABLE IF NOT EXISTS `hdfc_bidders` (
  `Bid` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(170) NOT NULL DEFAULT '',
  `Mobile` bigint(20) NOT NULL DEFAULT '0',
  `Location` varchar(150) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_bike_city`
--

CREATE TABLE IF NOT EXISTS `hdfc_bike_city` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_card_for_card`
--

CREATE TABLE IF NOT EXISTS `hdfc_card_for_card` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL DEFAULT '',
  `card_limit` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_car_list_category`
--

CREATE TABLE IF NOT EXISTS `hdfc_car_list_category` (
  `hdfc_clid` int(11) NOT NULL,
  `hdfc_car_manufacturer` varchar(200) NOT NULL,
  `hdfc_car_name` varchar(50) NOT NULL,
  `hdfc_car_category` varchar(15) NOT NULL,
  `hdfc_car_segment` varchar(10) NOT NULL,
  `hdfc_car_rate_segment` varchar(15) NOT NULL,
  `hdfc_car_price` bigint(20) NOT NULL,
  `hdfc_car_price_delhi` bigint(20) NOT NULL,
  `ltv_36months` mediumint(9) NOT NULL,
  `ltv_60months` mediumint(9) NOT NULL,
  `ltv_84months` mediumint(9) NOT NULL,
  `Overall_Length` int(11) NOT NULL,
  `Overall_Width` varchar(100) NOT NULL,
  `Displacement` int(10) NOT NULL,
  `Power` varchar(100) NOT NULL,
  `Torque` varchar(100) NOT NULL,
  `Fuel_Type` varchar(20) NOT NULL,
  `Seating_Capacity` mediumint(9) NOT NULL,
  `Fuel_Tank_Capacity` varchar(20) NOT NULL,
  `Mileage` float(5,2) NOT NULL,
  `Top_Speed` int(5) NOT NULL,
  `Gears_Speeds` int(10) NOT NULL,
  `car_videocode` text NOT NULL,
  `hdfc_car_model` varchar(100) NOT NULL,
  `hdfc_list` tinyint(4) NOT NULL,
  `magma_list` tinyint(4) NOT NULL,
  `magma_car_rate_segment` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_car_loan`
--

CREATE TABLE IF NOT EXISTS `hdfc_car_loan` (
  `hdfcccid` int(11) NOT NULL,
  `hdfc_name` varchar(50) NOT NULL DEFAULT '',
  `hdfc_email` varchar(100) NOT NULL DEFAULT '',
  `hdfc_city` varchar(50) NOT NULL DEFAULT '',
  `hdfc_mobileno` bigint(20) NOT NULL DEFAULT '0',
  `hdfc_dob` date NOT NULL DEFAULT '0000-00-00',
  `hdfc_employer` varchar(200) NOT NULL DEFAULT '',
  `hdfc_income` decimal(12,2) NOT NULL DEFAULT '0.00',
  `hdfc_office_landline` varchar(50) NOT NULL DEFAULT '',
  `hdfc_resi_landline` varchar(50) NOT NULL DEFAULT '',
  `hdfc_source` varchar(20) NOT NULL DEFAULT '',
  `hdfc_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hdfc_car_type` tinyint(4) NOT NULL,
  `hdfc_emp_status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_car_loan_gifts`
--

CREATE TABLE IF NOT EXISTS `hdfc_car_loan_gifts` (
  `id` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Product_Name` varchar(180) NOT NULL,
  `image` varchar(250) NOT NULL,
  `estimated_delivery` varchar(150) NOT NULL,
  `manufacturer` varchar(150) NOT NULL,
  `specifications` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `min_range` int(11) NOT NULL,
  `max_range` int(11) NOT NULL,
  `range` varchar(170) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_car_loan_leads`
--

CREATE TABLE IF NOT EXISTS `hdfc_car_loan_leads` (
  `RequestID` int(11) NOT NULL,
  `car_loan_ReqId` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `Email` varchar(240) NOT NULL,
  `City` varchar(200) NOT NULL,
  `DOB` date NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `Residence_Address` text NOT NULL,
  `resi_state` varchar(150) NOT NULL,
  `Residence_Pincode` int(11) NOT NULL,
  `Resi_Std` int(11) NOT NULL,
  `Resi_Telephone` bigint(20) NOT NULL,
  `Employment_Status` tinyint(4) NOT NULL,
  `Net_Salary` int(11) NOT NULL,
  `Company_Name` varchar(200) NOT NULL,
  `Primary_Acc` varchar(35) NOT NULL,
  `Residence_Status` varchar(180) NOT NULL,
  `Total_Experience` float(5,2) NOT NULL,
  `salary_account` tinyint(4) NOT NULL,
  `Resi_Stability` varchar(100) NOT NULL,
  `CC_Holder` tinyint(4) NOT NULL,
  `Off_Landline` bigint(20) NOT NULL,
  `office_std` int(11) NOT NULL,
  `Off_Address` text NOT NULL,
  `off_city` varchar(150) NOT NULL,
  `off_state` varchar(150) NOT NULL,
  `off_pincode` int(11) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `edu_quali` varchar(150) NOT NULL,
  `Dated` datetime NOT NULL,
  `IP` varchar(15) NOT NULL,
  `Source` varchar(25) NOT NULL,
  `Loan_Amount` int(2) NOT NULL,
  `Car_Model` varchar(200) NOT NULL,
  `Car_Price` int(11) NOT NULL,
  `intr_rate` float(5,2) NOT NULL,
  `Tenure` int(11) NOT NULL,
  `AppID` varchar(20) NOT NULL,
  `office_ext` tinyint(4) NOT NULL,
  `income_proof` varchar(255) NOT NULL,
  `address_proof` varchar(255) NOT NULL,
  `identify_proof` varchar(255) NOT NULL,
  `bank_statement` varchar(255) NOT NULL,
  `income_proof_doc` varchar(255) NOT NULL,
  `address_proof_doc` varchar(255) NOT NULL,
  `identify_proof_doc` varchar(255) NOT NULL,
  `bank_statement_doc` varchar(255) NOT NULL,
  `promotional` varchar(100) NOT NULL,
  `reward_selected` int(11) NOT NULL,
  `Car_Type` tinyint(4) NOT NULL DEFAULT '1',
  `City_Other` varchar(100) NOT NULL,
  `sms_sent` tinyint(4) NOT NULL,
  `sms_to` varchar(100) NOT NULL,
  `sms_number` bigint(20) NOT NULL,
  `DNDstatus` varchar(20) NOT NULL,
  `pdfDownload` tinyint(1) NOT NULL COMMENT 'PDF enable=1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HDFC_CC`
--

CREATE TABLE IF NOT EXISTS `HDFC_CC` (
  `RequestID` int(10) unsigned NOT NULL,
  `First_name` varchar(255) NOT NULL DEFAULT '',
  `Last_name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employer` varchar(100) NOT NULL DEFAULT '0',
  `City` varchar(255) NOT NULL DEFAULT '',
  `Office_number` varchar(50) DEFAULT NULL,
  `Residence_number` varchar(50) DEFAULT NULL,
  `Mobile_number` varchar(50) DEFAULT NULL,
  `Annual_income` varchar(250) NOT NULL DEFAULT '0.00',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IP_address` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HDFC_CC_Company_List`
--

CREATE TABLE IF NOT EXISTS `HDFC_CC_Company_List` (
  `hdfcccid` int(11) NOT NULL,
  `hdfc_company_name` text NOT NULL,
  `company_category` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_cl_appointments`
--

CREATE TABLE IF NOT EXISTS `hdfc_cl_appointments` (
  `id` int(11) NOT NULL,
  `address_apt` text NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `appdate` varchar(15) NOT NULL DEFAULT '',
  `changeapp_time` varchar(60) NOT NULL DEFAULT '',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_cl_companylist`
--

CREATE TABLE IF NOT EXISTS `hdfc_cl_companylist` (
  `hdfcclid` int(11) NOT NULL,
  `hdfccl_comp_name` text NOT NULL,
  `hdfccl_comp_type` varchar(100) NOT NULL,
  `krc_flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_company_list`
--

CREATE TABLE IF NOT EXISTS `hdfc_company_list` (
  `companyid` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `category` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_company_list_gold`
--

CREATE TABLE IF NOT EXISTS `hdfc_company_list_gold` (
  `id` int(11) NOT NULL,
  `COMPANY_CODE` varchar(50) NOT NULL DEFAULT '',
  `COMPANY_NAME` varchar(250) NOT NULL DEFAULT '',
  `Category` varchar(40) NOT NULL DEFAULT '',
  `Sub_Category` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_company_list_silver`
--

CREATE TABLE IF NOT EXISTS `hdfc_company_list_silver` (
  `id` int(11) NOT NULL,
  `COMPANY_CODE` varchar(50) NOT NULL DEFAULT '',
  `COMPANY_NAME` varchar(250) NOT NULL DEFAULT '',
  `Category` varchar(40) NOT NULL DEFAULT '',
  `Sub_Category` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_credila_ncourse_list`
--

CREATE TABLE IF NOT EXISTS `hdfc_credila_ncourse_list` (
  `hdfc_credilaid` int(11) NOT NULL,
  `hdfccourse_name` varchar(255) NOT NULL,
  `flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_credit_card`
--

CREATE TABLE IF NOT EXISTS `hdfc_credit_card` (
  `hdfcccid` int(11) NOT NULL,
  `hdfc_name` varchar(50) NOT NULL DEFAULT '',
  `hdfc_email` varchar(100) NOT NULL DEFAULT '',
  `hdfc_city` varchar(50) NOT NULL DEFAULT '',
  `hdfc_mobileno` bigint(20) NOT NULL DEFAULT '0',
  `hdfc_dob` date NOT NULL DEFAULT '0000-00-00',
  `hdfc_employer` varchar(200) NOT NULL DEFAULT '',
  `hdfc_income` decimal(12,2) NOT NULL DEFAULT '0.00',
  `hdfc_office_landline` varchar(50) NOT NULL DEFAULT '',
  `hdfc_resi_landline` varchar(50) NOT NULL DEFAULT '',
  `hdfc_source` varchar(20) NOT NULL DEFAULT '',
  `hdfc_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_goldloan_citylist`
--

CREATE TABLE IF NOT EXISTS `hdfc_goldloan_citylist` (
  `hdfcglid` int(11) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_hlnlap_cronlog`
--

CREATE TABLE IF NOT EXISTS `hdfc_hlnlap_cronlog` (
  `hdfc_logid` int(11) NOT NULL,
  `hdfc_leadcount` int(11) NOT NULL,
  `hdfcstart_time` datetime NOT NULL,
  `hdfcend_time` datetime NOT NULL,
  `hdfc_bidderid` int(11) NOT NULL,
  `hdfc_product` tinyint(4) NOT NULL,
  `run_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `HDFC_homeloanBT`
--

CREATE TABLE IF NOT EXISTS `HDFC_homeloanBT` (
  `hdfchlbt_id` int(11) NOT NULL,
  `hdfchlbt_name` varchar(50) NOT NULL,
  `hdfchlbt_mobile` bigint(20) NOT NULL,
  `hdfchlbt_city` varchar(100) NOT NULL,
  `hdfchlbt_outstandingloan` decimal(12,2) NOT NULL,
  `hdfchlbt_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_homeloan_lead_data`
--

CREATE TABLE IF NOT EXISTS `hdfc_homeloan_lead_data` (
  `Serial_No` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Mobile` bigint(20) NOT NULL DEFAULT '0',
  `Reference_id` int(11) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_meritus_scholarships`
--

CREATE TABLE IF NOT EXISTS `hdfc_meritus_scholarships` (
  `HdfcmeritID` int(11) NOT NULL,
  `Father_Name` varchar(50) NOT NULL DEFAULT '',
  `Student_Name` varchar(50) NOT NULL DEFAULT '',
  `Student_Class` varchar(50) NOT NULL DEFAULT '',
  `City` varchar(100) NOT NULL DEFAULT '',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Mobile_No` varchar(20) NOT NULL DEFAULT '',
  `IP_Address` varchar(20) NOT NULL DEFAULT '',
  `Date_Of_Entry` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_pl_calc_leads`
--

CREATE TABLE IF NOT EXISTS `hdfc_pl_calc_leads` (
  `hdfcplid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `age` varchar(10) NOT NULL DEFAULT '',
  `mobile_number` bigint(20) NOT NULL DEFAULT '0',
  `email_id` varchar(50) NOT NULL DEFAULT '',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Employment_Status` tinyint(4) NOT NULL DEFAULT '0',
  `company_name` varchar(200) NOT NULL DEFAULT '',
  `city` varchar(20) NOT NULL DEFAULT '',
  `other_city` varchar(50) NOT NULL,
  `residence_status` tinyint(4) NOT NULL DEFAULT '0',
  `company_type` varchar(10) NOT NULL DEFAULT '0',
  `company_category` tinyint(4) NOT NULL DEFAULT '0',
  `net_salary` decimal(12,2) NOT NULL DEFAULT '0.00',
  `primary_acc` varchar(20) NOT NULL DEFAULT '',
  `no_of_loan_running` tinyint(4) NOT NULL DEFAULT '0',
  `clubbed_emi` varchar(15) NOT NULL DEFAULT '',
  `pl_with_hdfc` tinyint(4) NOT NULL DEFAULT '0',
  `availed_loan_amt` varchar(15) NOT NULL DEFAULT '',
  `pl_emi_amt` varchar(15) NOT NULL DEFAULT '',
  `pl_tenure` varchar(10) NOT NULL DEFAULT '',
  `pl_no_of_emi` varchar(10) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eligible` varchar(5) NOT NULL DEFAULT '',
  `eligible_loanAmt` varchar(10) NOT NULL DEFAULT '',
  `eligible_interestRate` varchar(10) NOT NULL DEFAULT '',
  `eligible_emi` varchar(10) NOT NULL DEFAULT '',
  `eligible_term` varchar(10) NOT NULL DEFAULT '',
  `AppID` varchar(10) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT '',
  `MAIL_SENT` varchar(4) NOT NULL DEFAULT '',
  `compare_with_banks` tinyint(4) NOT NULL DEFAULT '0',
  `source` varchar(150) NOT NULL DEFAULT '',
  `hdfc_feedback` varchar(50) NOT NULL,
  `hdfc_add_comment` varchar(200) NOT NULL,
  `Existing_Bank` varchar(150) NOT NULL,
  `Existing_Loan` decimal(12,2) NOT NULL,
  `Existing_ROI` varchar(10) NOT NULL,
  `mainBidderID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_pl_company_list`
--

CREATE TABLE IF NOT EXISTS `hdfc_pl_company_list` (
  `hdfcid` int(11) NOT NULL,
  `hdfc_company_name` text NOT NULL,
  `hdfc_category` varchar(50) NOT NULL DEFAULT '',
  `hdfc_type` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_response_data`
--

CREATE TABLE IF NOT EXISTS `hdfc_response_data` (
  `hdfcresid` int(11) NOT NULL,
  `hdfc_response` varchar(200) NOT NULL DEFAULT '',
  `hdfc_req_id` varchar(100) NOT NULL DEFAULT '0',
  `hdfc_response_arr` text NOT NULL,
  `hdfc_reponse_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `BidderID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_response_data_lap`
--

CREATE TABLE IF NOT EXISTS `hdfc_response_data_lap` (
  `hdfcresid` int(11) NOT NULL,
  `hdfc_response` varchar(200) NOT NULL DEFAULT '',
  `hdfc_req_id` varchar(100) NOT NULL DEFAULT '0',
  `hdfc_response_arr` varchar(255) NOT NULL DEFAULT '',
  `hdfc_reponse_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_salary_cut`
--

CREATE TABLE IF NOT EXISTS `hdfc_salary_cut` (
  `id` int(11) NOT NULL,
  `city` varchar(250) NOT NULL DEFAULT '',
  `Cat_AB` int(11) NOT NULL DEFAULT '0',
  `Cat_C` int(11) NOT NULL DEFAULT '0',
  `Cat_D` int(11) NOT NULL DEFAULT '0',
  `Cat_E` int(11) NOT NULL DEFAULT '0',
  `Cat_V` int(11) NOT NULL DEFAULT '0',
  `Cat_W` int(11) NOT NULL DEFAULT '0',
  `Cat_X` int(11) NOT NULL DEFAULT '0',
  `Cat_Y` int(11) NOT NULL DEFAULT '0',
  `Cat_Z` int(11) NOT NULL DEFAULT '0',
  `cutoff` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_salary_cut_gold`
--

CREATE TABLE IF NOT EXISTS `hdfc_salary_cut_gold` (
  `id` int(11) NOT NULL,
  `city` varchar(250) NOT NULL DEFAULT '',
  `Cat_AB` int(11) NOT NULL DEFAULT '0',
  `Cat_C` int(11) NOT NULL DEFAULT '0',
  `Cat_D` int(11) NOT NULL DEFAULT '0',
  `Cat_E` int(11) NOT NULL DEFAULT '0',
  `Cat_V` int(11) NOT NULL DEFAULT '0',
  `Cat_W` int(11) NOT NULL DEFAULT '0',
  `Cat_X` int(11) NOT NULL DEFAULT '0',
  `Cat_Y` int(11) NOT NULL DEFAULT '0',
  `Cat_Z` int(11) NOT NULL DEFAULT '0',
  `cutoff` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hdfc_spl_city_rates`
--

CREATE TABLE IF NOT EXISTS `hdfc_spl_city_rates` (
  `hdfc_splid` int(11) NOT NULL,
  `hdfc_city` varchar(100) NOT NULL DEFAULT '',
  `hdfc_net_salary` decimal(12,0) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hesk_attachments`
--

CREATE TABLE IF NOT EXISTS `hesk_attachments` (
  `att_id` mediumint(8) unsigned NOT NULL,
  `ticket_id` varchar(10) NOT NULL DEFAULT '',
  `saved_name` varchar(255) NOT NULL DEFAULT '',
  `real_name` varchar(255) NOT NULL DEFAULT '',
  `size` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hesk_categories`
--

CREATE TABLE IF NOT EXISTS `hesk_categories` (
  `id` smallint(5) unsigned NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `cat_order` smallint(5) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hesk_replies`
--

CREATE TABLE IF NOT EXISTS `hesk_replies` (
  `id` mediumint(8) unsigned NOT NULL,
  `replyto` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `dt` datetime DEFAULT NULL,
  `attachments` text,
  `view_message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hesk_show_transcript`
--

CREATE TABLE IF NOT EXISTS `hesk_show_transcript` (
  `HtID` int(9) NOT NULL,
  `TrackID` varchar(15) NOT NULL DEFAULT '',
  `Subject_Line` varchar(255) NOT NULL DEFAULT '',
  `TrackFlag` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hesk_std_replies`
--

CREATE TABLE IF NOT EXISTS `hesk_std_replies` (
  `id` smallint(5) unsigned NOT NULL,
  `title` varchar(70) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `reply_order` smallint(5) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hesk_tickets`
--

CREATE TABLE IF NOT EXISTS `hesk_tickets` (
  `id` mediumint(8) unsigned NOT NULL,
  `trackid` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `category` smallint(5) unsigned NOT NULL DEFAULT '1',
  `priority` enum('1','2','3') NOT NULL DEFAULT '3',
  `subject` varchar(70) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastchange` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(20) NOT NULL DEFAULT '',
  `status` enum('0','1','2','3') DEFAULT '1',
  `lastreplier` enum('0','1') NOT NULL DEFAULT '0',
  `archive` enum('0','1') NOT NULL DEFAULT '0',
  `attachments` text,
  `custom1` varchar(255) NOT NULL DEFAULT '',
  `custom2` varchar(255) NOT NULL DEFAULT '',
  `custom3` varchar(255) NOT NULL DEFAULT '',
  `custom4` varchar(255) NOT NULL DEFAULT '',
  `custom5` varchar(255) NOT NULL DEFAULT '',
  `view_message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hesk_users`
--

CREATE TABLE IF NOT EXISTS `hesk_users` (
  `id` smallint(5) unsigned NOT NULL,
  `user` varchar(20) NOT NULL DEFAULT '',
  `pass` varchar(20) NOT NULL DEFAULT '',
  `isadmin` char(1) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `signature` varchar(255) NOT NULL DEFAULT '',
  `categories` varchar(255) NOT NULL DEFAULT '',
  `notify` char(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hlcallinglms_allocation`
--

CREATE TABLE IF NOT EXISTS `hlcallinglms_allocation` (
  `hlallocateid` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Allocation_Date` datetime NOT NULL,
  `DOE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL,
  `reallocation` tinyint(3) unsigned NOT NULL,
  `old_bidderid` int(10) unsigned NOT NULL,
  `reallocation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hlverifylms_allocation`
--

CREATE TABLE IF NOT EXISTS `hlverifylms_allocation` (
  `id` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Allocation_Date` datetime NOT NULL,
  `DOE` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `old_bidderid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hl_quote_shown`
--

CREATE TABLE IF NOT EXISTS `hl_quote_shown` (
  `hlquoteid` int(11) NOT NULL,
  `hl_leadid` int(11) NOT NULL,
  `hl_bankname` varchar(50) NOT NULL,
  `hl_bankrate` decimal(5,2) NOT NULL,
  `hl_bankrate_shown` varchar(250) NOT NULL DEFAULT '',
  `hl_bankemi` varchar(100) NOT NULL,
  `hl_bankemishown` varchar(250) NOT NULL DEFAULT '',
  `hl_banktenure` varchar(20) NOT NULL,
  `hl_loanamount` decimal(12,2) NOT NULL,
  `hl_img` varchar(255) NOT NULL,
  `hl_dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hl_referral_leads`
--

CREATE TABLE IF NOT EXISTS `hl_referral_leads` (
  `id` int(11) NOT NULL,
  `reference_id` varchar(20) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(120) NOT NULL,
  `city` varchar(80) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `referrer_id` int(11) NOT NULL,
  `referrer_ip` varchar(15) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mail_count` int(11) NOT NULL DEFAULT '0',
  `total_count` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `lead_transfered` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeloan_interest_rates`
--

CREATE TABLE IF NOT EXISTS `homeloan_interest_rates` (
  `hlrateid` int(11) NOT NULL,
  `hlrate_seq` tinyint(4) NOT NULL,
  `hlrate_bankname` varchar(50) NOT NULL,
  `min_amount` int(11) NOT NULL,
  `max_amount` int(11) NOT NULL,
  `hlrate_prefix` varchar(50) NOT NULL,
  `hlrate_interest` float(5,2) NOT NULL,
  `hlrate_postfix` varchar(50) NOT NULL,
  `hlrate_mintenure` float(5,1) NOT NULL,
  `hlrate_maxtenure` float(5,1) NOT NULL,
  `hlrate_processing` varchar(255) NOT NULL,
  `hlrate_prepayment` varchar(255) NOT NULL,
  `hlrate_flag` tinyint(4) NOT NULL,
  `hlrate_dated` datetime NOT NULL,
  `hlrate_priorty` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `home_loan_bal_trans`
--

CREATE TABLE IF NOT EXISTS `home_loan_bal_trans` (
  `bal_id` int(11) NOT NULL,
  `min_amount` int(11) NOT NULL DEFAULT '0',
  `max_amount` int(11) NOT NULL DEFAULT '0',
  `min_tenure` float(5,1) NOT NULL DEFAULT '0.0',
  `max_tenure` float(5,1) NOT NULL DEFAULT '0.0',
  `bank` varchar(50) NOT NULL DEFAULT '',
  `bank_id` int(11) NOT NULL DEFAULT '0',
  `roi` varchar(5) NOT NULL DEFAULT '',
  `processing_fee` varchar(250) NOT NULL DEFAULT '',
  `fee_percent` float(5,1) NOT NULL DEFAULT '0.0',
  `fee_amount` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `bank_image` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `home_loan_eligibility`
--

CREATE TABLE IF NOT EXISTS `home_loan_eligibility` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Phone` bigint(20) NOT NULL DEFAULT '0',
  `Email` varchar(60) NOT NULL DEFAULT '',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `Loan_Amt` int(11) NOT NULL DEFAULT '0',
  `Employment_Status` tinyint(4) NOT NULL DEFAULT '0',
  `Net_Salary` int(11) NOT NULL DEFAULT '0',
  `Obligations` int(11) NOT NULL DEFAULT '0',
  `Co_Name` varchar(50) NOT NULL DEFAULT '',
  `Co_DOB` date NOT NULL DEFAULT '0000-00-00',
  `Co_Salary` int(11) NOT NULL DEFAULT '0',
  `Co_Obligation` int(11) NOT NULL DEFAULT '0',
  `emi` varchar(11) NOT NULL DEFAULT '0',
  `tenure` varchar(20) NOT NULL DEFAULT '',
  `roi` varchar(10) NOT NULL DEFAULT '',
  `documents` varchar(255) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IP` varchar(16) NOT NULL DEFAULT '',
  `resi_address` text NOT NULL,
  `pan_no` varchar(10) NOT NULL DEFAULT '',
  `office_address` text NOT NULL,
  `Defaulted` varchar(10) NOT NULL DEFAULT '',
  `declined` varchar(10) NOT NULL DEFAULT '',
  `Designation` varchar(100) NOT NULL DEFAULT '',
  `AppID` varchar(10) NOT NULL DEFAULT '',
  `Reference_Code` varchar(4) NOT NULL DEFAULT '',
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `pincode` varchar(6) NOT NULL DEFAULT '',
  `resi_phone` varchar(20) NOT NULL DEFAULT '',
  `off_phone` varchar(20) NOT NULL DEFAULT '',
  `builder_name` varchar(250) NOT NULL DEFAULT '',
  `propertyConstruction` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `home_loan_interest_rate_chart`
--

CREATE TABLE IF NOT EXISTS `home_loan_interest_rate_chart` (
  `hlrateid` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL DEFAULT '',
  `tenure` varchar(50) NOT NULL DEFAULT '',
  `upto_20lacs` varchar(200) NOT NULL DEFAULT '',
  `perlac_upto_20lacs` varchar(250) NOT NULL DEFAULT '',
  `percentage_upto_20lacs` varchar(200) NOT NULL,
  `upto_30lacs` varchar(255) NOT NULL DEFAULT '',
  `perlac_upto_30lacs` varchar(250) NOT NULL,
  `percentage_upto_30lacs` varchar(200) NOT NULL,
  `above_30lacs` text NOT NULL,
  `perlac_above_30lacs` text NOT NULL,
  `percentage_above_30lacs` varchar(200) NOT NULL,
  `above_75lacs` varchar(200) NOT NULL DEFAULT '',
  `perlac_above_75lacs` varchar(250) NOT NULL,
  `percentage_above_75lacs` varchar(200) NOT NULL,
  `prepayment_charges` text NOT NULL,
  `processing_fee` text NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bank_url` varchar(255) NOT NULL DEFAULT '',
  `mclr_rates` varchar(50) NOT NULL,
  `ndtv_rates` varchar(255) NOT NULL DEFAULT '',
  `priority` int(11) NOT NULL DEFAULT '0',
  `rates_change` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ibibo_compaign_leads`
--

CREATE TABLE IF NOT EXISTS `ibibo_compaign_leads` (
  `ibibo_id` int(11) NOT NULL,
  `ibibo_product` text NOT NULL,
  `ibibo_requestid` int(11) NOT NULL DEFAULT '0',
  `ibibo_name` varchar(50) NOT NULL DEFAULT '',
  `ibibo_email` varchar(60) NOT NULL DEFAULT '',
  `ibibo_city` varchar(50) NOT NULL DEFAULT '',
  `ibibo_mobile` bigint(20) NOT NULL DEFAULT '0',
  `ibibo_dob` date NOT NULL DEFAULT '0000-00-00',
  `ibibo_car_name` varchar(25) NOT NULL DEFAULT '',
  `ibibo_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ibibo_portal` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icicihfc_leads`
--

CREATE TABLE IF NOT EXISTS `icicihfc_leads` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` int(11) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icicihl_lapreport`
--

CREATE TABLE IF NOT EXISTS `icicihl_lapreport` (
  `icicihlid` int(11) NOT NULL,
  `icici_product` varchar(4) NOT NULL,
  `icici_city` varchar(100) NOT NULL,
  `icici_month` varchar(50) NOT NULL,
  `date_01` int(11) NOT NULL,
  `date_02` int(11) NOT NULL,
  `date_03` int(11) NOT NULL,
  `date_04` int(11) NOT NULL,
  `date_05` int(11) NOT NULL,
  `date_06` int(11) NOT NULL,
  `date_07` int(11) NOT NULL,
  `date_08` int(11) NOT NULL,
  `date_09` int(11) NOT NULL,
  `date_10` int(11) NOT NULL,
  `date_11` int(11) NOT NULL,
  `date_12` int(11) NOT NULL,
  `date_13` int(11) NOT NULL,
  `date_14` int(11) NOT NULL,
  `date_15` int(11) NOT NULL,
  `date_16` int(11) NOT NULL,
  `date_17` int(11) NOT NULL,
  `date_18` int(11) NOT NULL,
  `date_19` int(11) NOT NULL,
  `date_20` int(11) NOT NULL,
  `date_21` int(11) NOT NULL,
  `date_22` int(11) NOT NULL,
  `date_23` int(11) NOT NULL,
  `date_24` int(11) NOT NULL,
  `date_25` int(11) NOT NULL,
  `date_26` int(11) NOT NULL,
  `date_27` int(11) NOT NULL,
  `date_28` int(11) NOT NULL,
  `date_29` int(11) NOT NULL,
  `date_30` int(11) NOT NULL,
  `date_31` int(11) NOT NULL,
  `total_count` int(11) NOT NULL,
  `stat_flag` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icicilms_allocation`
--

CREATE TABLE IF NOT EXISTS `icicilms_allocation` (
  `iciciallocateid` int(11) NOT NULL,
  `cc_requestid` int(11) NOT NULL,
  `bidderid` int(11) NOT NULL,
  `product` tinyint(4) NOT NULL,
  `allocation_date` datetime NOT NULL,
  `changed_flag` tinyint(4) NOT NULL,
  `icici_feedback` varchar(200) NOT NULL,
  `icici_followupdate` datetime NOT NULL,
  `not_contactable_counter` tinyint(4) NOT NULL,
  `icici_sendnow_date` datetime NOT NULL,
  `icici_bidders` varchar(200) NOT NULL,
  `verifier_feedback` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icicilms_loginlog`
--

CREATE TABLE IF NOT EXISTS `icicilms_loginlog` (
  `icicilogid` int(11) NOT NULL,
  `icicilog_bidderid` int(11) NOT NULL,
  `icicilog_startdatetime` datetime NOT NULL,
  `icicilog_product` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icicipllms_allocation`
--

CREATE TABLE IF NOT EXISTS `icicipllms_allocation` (
  `iciciallocateid` int(11) NOT NULL,
  `icicirequestID` int(11) NOT NULL,
  `pl_requestid` int(11) NOT NULL,
  `bidderid` int(11) NOT NULL,
  `product` tinyint(4) NOT NULL,
  `allocation_date` datetime NOT NULL,
  `icici_feedback` varchar(200) NOT NULL,
  `icici_followupdate` datetime NOT NULL,
  `not_contactable_counter` tinyint(4) NOT NULL,
  `icici_sendnow_date` datetime NOT NULL,
  `icici_bidders` varchar(200) NOT NULL,
  `verifier_feedback` varchar(200) NOT NULL,
  `icici_comments` varchar(255) NOT NULL,
  `icici_sent` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icicipl_appointment_details`
--

CREATE TABLE IF NOT EXISTS `icicipl_appointment_details` (
  `iciciaaptid` int(11) NOT NULL,
  `icici_name` varchar(50) NOT NULL,
  `icici_mobileno` bigint(20) NOT NULL,
  `icici_city` varchar(100) NOT NULL,
  `icici_appointment_address` text NOT NULL,
  `icici_appointment_place` varchar(200) NOT NULL,
  `icici_app_time` varchar(100) NOT NULL,
  `icici_appdate` date NOT NULL,
  `icici_document_proof` text NOT NULL,
  `icici_other_document` varchar(255) NOT NULL,
  `icici_telecaller` varchar(50) NOT NULL,
  `icici_allocateno` varchar(50) NOT NULL,
  `icici_dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icicipl_callLOG`
--

CREATE TABLE IF NOT EXISTS `icicipl_callLOG` (
  `callogid` int(11) NOT NULL,
  `icicirequestID` int(11) NOT NULL,
  `TelecallerID` int(11) NOT NULL,
  `icici_feedback` varchar(255) NOT NULL,
  `calldated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icicipl_webservice`
--

CREATE TABLE IF NOT EXISTS `icicipl_webservice` (
  `icicwcid` int(11) NOT NULL,
  `requestid` int(11) NOT NULL,
  `ApplicationId` varchar(50) NOT NULL,
  `Decision` varchar(20) NOT NULL,
  `request_json1` text NOT NULL,
  `response_json1` text NOT NULL,
  `dated1` datetime NOT NULL,
  `request_json2` text NOT NULL,
  `response_json2` text NOT NULL,
  `Comments` text NOT NULL,
  `dated2` datetime NOT NULL,
  `request_json3` text NOT NULL,
  `response_json3` datetime NOT NULL,
  `dated3` datetime NOT NULL,
  `bidderid` int(11) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_agent_leadallocation`
--

CREATE TABLE IF NOT EXISTS `icici_agent_leadallocation` (
  `allocationid` int(11) NOT NULL,
  `bidderid` int(11) NOT NULL DEFAULT '0',
  `agentid` int(11) NOT NULL DEFAULT '0',
  `feedback_id` varchar(11) NOT NULL DEFAULT '',
  `allrequestid` varchar(200) NOT NULL DEFAULT '',
  `product` int(11) NOT NULL DEFAULT '0',
  `allocation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ICICI_Allocated_Leads`
--

CREATE TABLE IF NOT EXISTS `ICICI_Allocated_Leads` (
  `icicirequestID` int(11) NOT NULL,
  `RequestID` int(10) NOT NULL,
  `FeedbackID` int(10) unsigned NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(200) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Salary_Drawn` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `identification_proof` text NOT NULL,
  `salary_proof` varchar(255) NOT NULL,
  `experience_proof` varchar(255) NOT NULL,
  `bankstat_proof` varchar(255) NOT NULL,
  `cuurentadd_proof` varchar(255) NOT NULL,
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Bank` varchar(150) NOT NULL,
  `Existing_Loan` decimal(12,2) NOT NULL,
  `Existing_ROI` varchar(10) NOT NULL,
  `Existing_Noofemi` varchar(10) NOT NULL,
  `TelecallerID` int(11) NOT NULL,
  `Allocation_Date` datetime NOT NULL,
  `approved` tinyint(4) NOT NULL,
  `source` varchar(50) NOT NULL,
  `eligible` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_callingdata_DNC`
--

CREATE TABLE IF NOT EXISTS `icici_callingdata_DNC` (
  `id` int(11) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `Dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_cards_calling`
--

CREATE TABLE IF NOT EXISTS `icici_cards_calling` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Company_HDFC_Cat` tinyint(4) NOT NULL DEFAULT '0',
  `Company_ICICI_Cat` tinyint(4) NOT NULL,
  `CC_Holder` tinyint(4) DEFAULT '0',
  `Descr` varchar(100) DEFAULT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(250) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Pancard` varchar(25) NOT NULL DEFAULT '',
  `Pancard_No` varchar(50) DEFAULT NULL,
  `No_of_Banks` varchar(200) NOT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) DEFAULT '0',
  `Applied_With_Banks` varchar(250) DEFAULT NULL,
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Office_Address` varchar(255) DEFAULT NULL,
  `Credit_Limit` tinyint(1) DEFAULT '0',
  `Bidder_Count` int(11) NOT NULL DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(150) NOT NULL DEFAULT '',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `already_applied` varchar(10) NOT NULL DEFAULT '',
  `applied_card_name` text NOT NULL,
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Loan_Amount` decimal(10,0) NOT NULL DEFAULT '0',
  `Account_No` varchar(100) NOT NULL DEFAULT '',
  `Existing_Relationship` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Relationship_ICICI` tinyint(4) NOT NULL,
  `Loan_No` varchar(100) NOT NULL DEFAULT '',
  `Eligible_Card_Option` varchar(200) NOT NULL DEFAULT '',
  `Salary_Account` varchar(150) NOT NULL,
  `Privacy` varchar(3) NOT NULL,
  `TelecallerID` int(11) NOT NULL,
  `DNC_flag` tinyint(4) NOT NULL,
  `cards_flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_car_loan_calc`
--

CREATE TABLE IF NOT EXISTS `icici_car_loan_calc` (
  `icici_clid` int(11) NOT NULL,
  `icici_name` varchar(50) NOT NULL DEFAULT '',
  `icici_email` varchar(200) NOT NULL DEFAULT '',
  `icici_mobile` bigint(20) NOT NULL DEFAULT '0',
  `icici_pan_no` varchar(50) NOT NULL DEFAULT '',
  `icici_city` varchar(50) NOT NULL DEFAULT '',
  `icici_company_name` varchar(50) NOT NULL DEFAULT '',
  `icici_occupation` tinyint(4) NOT NULL DEFAULT '0',
  `icici_annual_income` varchar(20) NOT NULL DEFAULT '',
  `icici_current_experience` int(11) NOT NULL DEFAULT '0',
  `icici_total_experience` int(11) NOT NULL DEFAULT '0',
  `icici_dob` date NOT NULL DEFAULT '0000-00-00',
  `icici_age` varchar(10) NOT NULL DEFAULT '',
  `icici_car_manufacturer` varchar(50) NOT NULL DEFAULT '',
  `icici_car_model` varchar(50) NOT NULL DEFAULT '',
  `icici_office_address` varchar(200) NOT NULL DEFAULT '',
  `icici_resi_address` varchar(200) NOT NULL DEFAULT '',
  `icici_pincode` varchar(10) NOT NULL DEFAULT '',
  `icici_home_telephone` varchar(20) NOT NULL DEFAULT '',
  `icici_office_telephone` varchar(30) NOT NULL DEFAULT '',
  `icici_is_valid` tinyint(4) NOT NULL DEFAULT '0',
  `icici_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `icici_validated` tinyint(4) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(4) NOT NULL DEFAULT '',
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `AppID` varchar(10) NOT NULL DEFAULT '',
  `Defaulted` varchar(10) NOT NULL DEFAULT '',
  `declined` varchar(10) NOT NULL DEFAULT '',
  `Designation` varchar(100) NOT NULL DEFAULT '',
  `icici_eligible_loanamt` decimal(12,2) NOT NULL DEFAULT '0.00',
  `icici_eligible_interestrate` varchar(20) NOT NULL DEFAULT '',
  `icici_eligible_emi` varchar(20) NOT NULL DEFAULT '',
  `icici_eligible_tenure` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ICICI_CCAppt_Details`
--

CREATE TABLE IF NOT EXISTS `ICICI_CCAppt_Details` (
  `ApptID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Appt_Address` text NOT NULL,
  `Appt_Address_line2` varchar(255) NOT NULL,
  `Appt_Date` date DEFAULT NULL,
  `Appt_Time` varchar(20) NOT NULL,
  `Appt_card_name` varchar(255) NOT NULL,
  `Appt_Feedback` varchar(200) NOT NULL,
  `Appt_Dated` datetime NOT NULL,
  `lead_type` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_cc_city_state_list`
--

CREATE TABLE IF NOT EXISTS `icici_cc_city_state_list` (
  `id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country_code` varchar(20) NOT NULL,
  `std` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_city_cc_list`
--

CREATE TABLE IF NOT EXISTS `icici_city_cc_list` (
  `id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `city` varchar(80) NOT NULL,
  `cityalias` varchar(80) NOT NULL,
  `district` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_credit_card`
--

CREATE TABLE IF NOT EXISTS `icici_credit_card` (
  `iciciccid` int(11) NOT NULL,
  `icici_name` varchar(50) NOT NULL DEFAULT '',
  `icici_email` varchar(100) NOT NULL DEFAULT '',
  `icici_city` varchar(50) NOT NULL DEFAULT '',
  `icici_city_other` varchar(50) NOT NULL,
  `icici_mobileno` bigint(20) NOT NULL DEFAULT '0',
  `icici_dob` date NOT NULL DEFAULT '0000-00-00',
  `icici_emp_status` tinyint(4) NOT NULL,
  `icici_employer` text NOT NULL,
  `icici_income` decimal(12,2) NOT NULL DEFAULT '0.00',
  `icici_office_landline` varchar(50) NOT NULL DEFAULT '',
  `icici_resi_landline` varchar(50) NOT NULL DEFAULT '',
  `icici_source` varchar(20) NOT NULL DEFAULT '',
  `icici_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `icici_eligible_flag` tinyint(4) NOT NULL,
  `icici_feedback` varchar(100) NOT NULL,
  `icici_comment` varchar(255) NOT NULL,
  `icici_salary_account` varchar(50) NOT NULL,
  `icici_exist_rel` tinyint(4) NOT NULL,
  `icici_typrofrel` tinyint(4) NOT NULL,
  `icici_followup_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_exclusive_app`
--

CREATE TABLE IF NOT EXISTS `icici_exclusive_app` (
  `iciciappid` int(11) NOT NULL,
  `iciciapp_name` varchar(50) NOT NULL,
  `iciciapp_email` varchar(100) NOT NULL,
  `iciciapp_mobile_number` bigint(20) NOT NULL,
  `iciciapp_gender` tinyint(4) NOT NULL,
  `iciciapp_relation` varchar(100) NOT NULL,
  `iciciapp_city` varchar(50) NOT NULL,
  `iciciapp_dob` date NOT NULL,
  `iciciapp_age` varchar(10) NOT NULL,
  `iciciapp_occupation` tinyint(4) NOT NULL,
  `iciciapp_company_name` text NOT NULL,
  `iciciapp_salary` decimal(12,2) NOT NULL,
  `iciciapp_secure_emi` int(11) NOT NULL,
  `iciciapp_unsecure_emi` int(11) NOT NULL,
  `iciciapp_ipaddress` varchar(50) NOT NULL,
  `iciciapp_dated` datetime NOT NULL,
  `customer_loan_amt` int(11) NOT NULL,
  `icici_loan_amount` varchar(200) NOT NULL,
  `icici_interest_rate` varchar(50) NOT NULL,
  `icici_emi` varchar(50) NOT NULL,
  `icici_tenure` varchar(50) NOT NULL,
  `icici_proc_fee` varchar(20) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `p_address` varchar(250) NOT NULL,
  `p_city` varchar(100) NOT NULL,
  `p_state` varchar(70) NOT NULL,
  `p_pincode` int(11) NOT NULL,
  `source` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `age` int(11) NOT NULL,
  `Reference_Code` int(11) NOT NULL,
  `Is_Valid` tinyint(4) NOT NULL,
  `Feedback` varchar(50) NOT NULL,
  `DurationofStayMonth` varchar(10) NOT NULL,
  `DurationofStayYear` varchar(10) NOT NULL,
  ` IndustrySector` varchar(50) NOT NULL,
  `TotalworkExperience` int(11) NOT NULL,
  `CurrentEmployerMonth` varchar(10) NOT NULL,
  `CurrentEmployerYear` varchar(10) NOT NULL,
  `email_verified` tinyint(4) NOT NULL,
  `email_verification_code` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_exclusive_application`
--

CREATE TABLE IF NOT EXISTS `icici_exclusive_application` (
  `iciciappid` int(11) NOT NULL,
  `iciciapp_name` varchar(50) NOT NULL,
  `iciciapp_email` varchar(100) NOT NULL,
  `iciciapp_mobile_number` bigint(20) NOT NULL,
  `iciciapp_gender` varchar(6) NOT NULL,
  `iciciapp_relation` varchar(100) NOT NULL,
  `iciciapp_city` varchar(50) NOT NULL,
  `iciciapp_dob` date NOT NULL,
  `iciciapp_age` varchar(10) NOT NULL,
  `iciciapp_occupation` tinyint(4) NOT NULL,
  `iciciapp_company_name` text NOT NULL,
  `iciciapp_salary` decimal(12,2) NOT NULL,
  `iciciapp_secure_emi` int(11) NOT NULL,
  `iciciapp_unsecure_emi` int(11) NOT NULL,
  `iciciapp_ipaddress` varchar(50) NOT NULL,
  `iciciapp_dated` datetime NOT NULL,
  `customer_loan_amt` int(11) NOT NULL,
  `icici_loan_amount` varchar(200) NOT NULL,
  `icici_interest_rate` varchar(50) NOT NULL,
  `icici_emi` varchar(50) NOT NULL,
  `icici_tenure` varchar(50) NOT NULL,
  `icici_proc_fee` varchar(20) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `p_address` varchar(250) NOT NULL,
  `p_address1` varchar(255) NOT NULL,
  `p_address2` varchar(255) NOT NULL,
  `p_city` varchar(100) NOT NULL,
  `p_state` varchar(70) NOT NULL,
  `p_pincode` int(11) NOT NULL,
  `source` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `age` int(11) NOT NULL,
  `Reference_Code` int(11) NOT NULL,
  `Is_Valid` tinyint(4) NOT NULL,
  `Feedback` varchar(50) NOT NULL,
  `DurationofStayMonth` varchar(10) NOT NULL,
  `DurationofStayYear` varchar(10) NOT NULL,
  `IndustrySector` varchar(50) NOT NULL,
  `TotalworkExperience` int(11) NOT NULL,
  `CurrentEmployerMonth` varchar(10) NOT NULL,
  `CurrentEmployerYear` varchar(10) NOT NULL,
  `email_verified` tinyint(4) NOT NULL,
  `email_verification_code` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_exclusive_app_docs`
--

CREATE TABLE IF NOT EXISTS `icici_exclusive_app_docs` (
  `icicidocid` int(11) NOT NULL,
  `iciciappid` int(11) NOT NULL,
  `photo_proof_doc` varchar(200) NOT NULL,
  `address_proof` varchar(200) NOT NULL,
  `income_proof` varchar(200) NOT NULL,
  `identify_proof` varchar(200) NOT NULL,
  `bank_statement` varchar(200) NOT NULL,
  `identify_proof_doc` varchar(200) NOT NULL,
  `bank_statement_doc` varchar(200) NOT NULL,
  `income_proof_doc` varchar(200) NOT NULL,
  `address_proof_doc` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_exclusive_transunion`
--

CREATE TABLE IF NOT EXISTS `icici_exclusive_transunion` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Authentication_Status` varchar(20) NOT NULL,
  `Authentication_Token` varchar(100) NOT NULL,
  `ResponseInfo_ApplicationId` varchar(30) NOT NULL,
  `PLReason` varchar(200) NOT NULL,
  `PLResult` varchar(50) NOT NULL,
  `EMICalculatedString` text NOT NULL,
  `LoanAmountString` varchar(255) NOT NULL,
  `BTDataSet` varchar(100) NOT NULL,
  `BTEligibleFlag` varchar(10) NOT NULL,
  `ResponseInfo_SolutionSetInstanceId` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_hfc_agents`
--

CREATE TABLE IF NOT EXISTS `icici_hfc_agents` (
  `agentid` int(11) NOT NULL,
  `agent_name` varchar(100) NOT NULL DEFAULT '',
  `agent_dma_id` varchar(20) NOT NULL,
  `agent_city` varchar(200) NOT NULL DEFAULT '',
  `agent_no` varchar(100) NOT NULL DEFAULT '',
  `agent_email` varchar(200) NOT NULL DEFAULT '',
  `agent_sequence` int(11) NOT NULL DEFAULT '0',
  `agent_flag` tinyint(4) NOT NULL DEFAULT '1',
  `agent_allocation` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_hfc_location_list`
--

CREATE TABLE IF NOT EXISTS `icici_hfc_location_list` (
  `locationid` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL DEFAULT '',
  `location_category` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_lead_allocation_table`
--

CREATE TABLE IF NOT EXISTS `icici_lead_allocation_table` (
  `lead_allocation_logic` int(11) NOT NULL,
  `city` text NOT NULL,
  `total_lead_count` int(11) NOT NULL DEFAULT '0',
  `last_allocated_to` int(10) NOT NULL DEFAULT '0',
  `total_no_agents` int(10) NOT NULL DEFAULT '0',
  `BidderId` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_organisation_list`
--

CREATE TABLE IF NOT EXISTS `icici_organisation_list` (
  `icici_orgid` int(11) NOT NULL,
  `organisation_name` text NOT NULL,
  `org_type` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_pl_cibili_check`
--

CREATE TABLE IF NOT EXISTS `icici_pl_cibili_check` (
  `plcibilid` int(11) NOT NULL,
  `icicirequestID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Panno` varchar(50) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Pincode` varchar(20) NOT NULL,
  `Address` text NOT NULL,
  `City` varchar(100) NOT NULL,
  `Resistate` varchar(100) NOT NULL,
  `DurationofStayMonth` varchar(10) NOT NULL,
  `DurationofStayYear` smallint(6) NOT NULL,
  `CurrentEmployerMonth` varchar(10) NOT NULL,
  `CurrentEmployerYear` smallint(6) NOT NULL,
  `Industry_sector` varchar(100) NOT NULL,
  `Existing_Relation` varchar(50) NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Authentication_Status` varchar(40) NOT NULL,
  `ApplicationID` int(11) NOT NULL,
  `PLReason` text NOT NULL,
  `PLResult` varchar(15) NOT NULL,
  `EMIPeriod` varchar(20) NOT NULL,
  `EMICalculatedString` text NOT NULL,
  `FixedTenure` varchar(200) NOT NULL,
  `FixedLoanAmount` varchar(200) NOT NULL,
  `FixedROI` varchar(200) NOT NULL,
  `FixedEMI` varchar(200) NOT NULL,
  `FixedProcessingFee` varchar(200) NOT NULL,
  `OBPLAvailable` varchar(50) NOT NULL,
  `BTDataSet` text NOT NULL,
  `BTEligibleFlag` varchar(100) NOT NULL,
  `LoanAmountString` varchar(255) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(50) NOT NULL,
  `appointment_place` varchar(50) NOT NULL,
  `appointment_address` text NOT NULL,
  `documents` text NOT NULL,
  `Dated` datetime NOT NULL,
  `flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icici_pl_referral_leads`
--

CREATE TABLE IF NOT EXISTS `icici_pl_referral_leads` (
  `icicildid` int(11) NOT NULL,
  `employ_id` varchar(20) NOT NULL,
  `employee_name` varchar(20) NOT NULL,
  `employ_contact` bigint(20) NOT NULL,
  `employee_email` varchar(50) NOT NULL,
  `employee_city` varchar(20) NOT NULL,
  `employee_pincode` int(11) NOT NULL,
  `referral_income` decimal(12,2) NOT NULL,
  `referral_occupation` tinyint(4) NOT NULL,
  `referral_company_name` varchar(50) NOT NULL,
  `referral_loan_amount` decimal(12,2) NOT NULL,
  `referral_dob` date NOT NULL,
  `referral_ccholder` tinyint(4) NOT NULL,
  `icici_leadtype` varchar(20) NOT NULL,
  `icicipl_dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ifsc_bank`
--

CREATE TABLE IF NOT EXISTS `ifsc_bank` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(250) NOT NULL,
  `bank_url` varchar(255) NOT NULL,
  `flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ifsc_branch`
--

CREATE TABLE IF NOT EXISTS `ifsc_branch` (
  `id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `stateid` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_url` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `ifsc` varchar(50) NOT NULL,
  `swift_bic_code` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `branch_code` varchar(12) NOT NULL,
  `micr_code` varchar(12) NOT NULL,
  `latitude` varchar(15) NOT NULL,
  `longitude` varchar(15) NOT NULL,
  `description` text NOT NULL,
  `MetaTitle` varchar(255) NOT NULL,
  `MetaKeyword` text NOT NULL,
  `MetaDesc` text NOT NULL,
  `last_modify_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ifsc_state_dist`
--

CREATE TABLE IF NOT EXISTS `ifsc_state_dist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_city_url` varchar(255) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL,
  `city_latitude` varchar(15) NOT NULL,
  `city_longitide` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ifsc_state_dist_demo`
--

CREATE TABLE IF NOT EXISTS `ifsc_state_dist_demo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `state_city_url` varchar(255) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `flag` tinyint(4) NOT NULL,
  `city_latitude` varchar(15) NOT NULL,
  `city_longitude` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indusbank_exclusive_leads`
--

CREATE TABLE IF NOT EXISTS `indusbank_exclusive_leads` (
  `indusbnkid` int(11) NOT NULL,
  `indusbnk_name` varchar(50) NOT NULL,
  `indusbnk_email` varchar(150) NOT NULL,
  `indusbnk_mobileno` bigint(20) NOT NULL,
  `indusbnk_age` varchar(50) NOT NULL,
  `indusbnk_city` varchar(50) NOT NULL,
  `indusbnk_city_other` varchar(50) NOT NULL,
  `indusbnk_occupation` tinyint(4) NOT NULL,
  `indusbnk_companyname` text NOT NULL,
  `indusbnk_monthlyincome` decimal(12,2) NOT NULL,
  `indusbnk_loanamount` decimal(12,2) NOT NULL,
  `indusbnk_totalobligation` varchar(50) NOT NULL,
  `indusbnk_source` varchar(50) NOT NULL,
  `indusbnk_dated` datetime NOT NULL,
  `indusbnk_status` tinyint(4) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `comment_section` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indusbnk_msging`
--

CREATE TABLE IF NOT EXISTS `indusbnk_msging` (
  `id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `Dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indusind_credit_card`
--

CREATE TABLE IF NOT EXISTS `indusind_credit_card` (
  `indusindccid` int(11) NOT NULL,
  `indusind_name` varchar(50) NOT NULL DEFAULT '',
  `indusind_email` varchar(100) NOT NULL DEFAULT '',
  `indusind_city` varchar(50) NOT NULL DEFAULT '',
  `indusind_city_other` varchar(50) NOT NULL,
  `indusind_mobileno` bigint(20) NOT NULL DEFAULT '0',
  `indusind_dob` date NOT NULL DEFAULT '0000-00-00',
  `indusind_emp_status` tinyint(4) NOT NULL,
  `indusind_employer` text NOT NULL,
  `indusind_income` decimal(12,2) NOT NULL DEFAULT '0.00',
  `indusind_office_landline` varchar(50) NOT NULL DEFAULT '',
  `indusind_resi_landline` varchar(50) NOT NULL DEFAULT '',
  `indusind_source` varchar(20) NOT NULL DEFAULT '',
  `indusind_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `indusind_eligible_flag` tinyint(4) NOT NULL,
  `indusind_feedback` varchar(100) NOT NULL,
  `indusind_comment` varchar(255) NOT NULL,
  `indusind_salary_account` varchar(50) NOT NULL,
  `indusind_exist_rel` tinyint(4) NOT NULL,
  `indusind_typrofrel` tinyint(4) NOT NULL,
  `indusind_followup_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingvyasya_pl_calc_leads`
--

CREATE TABLE IF NOT EXISTS `ingvyasya_pl_calc_leads` (
  `ingvyasyaplid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL DEFAULT '',
  `age` varchar(10) NOT NULL DEFAULT '',
  `mobile_number` bigint(20) NOT NULL DEFAULT '0',
  `email_id` varchar(50) NOT NULL DEFAULT '',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Employment_Status` tinyint(4) NOT NULL DEFAULT '0',
  `company_name` varchar(200) NOT NULL DEFAULT '',
  `city` varchar(50) NOT NULL DEFAULT '',
  `other_city` varchar(100) NOT NULL,
  `residence_status` tinyint(4) NOT NULL DEFAULT '0',
  `company_type` varchar(10) NOT NULL DEFAULT '0',
  `company_category` tinyint(4) NOT NULL DEFAULT '0',
  `net_salary` decimal(12,2) NOT NULL DEFAULT '0.00',
  `business_stability` tinyint(4) NOT NULL,
  `primary_acc` varchar(20) NOT NULL DEFAULT '',
  `no_of_loan_running` tinyint(4) NOT NULL DEFAULT '0',
  `clubbed_emi` varchar(15) NOT NULL DEFAULT '',
  `pl_with_ingvyasya` tinyint(4) NOT NULL DEFAULT '0',
  `availed_loan_amt` varchar(15) NOT NULL DEFAULT '',
  `pl_emi_amt` varchar(15) NOT NULL DEFAULT '',
  `pl_tenure` varchar(10) NOT NULL DEFAULT '',
  `pl_no_of_emi` varchar(10) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `eligible` varchar(100) NOT NULL DEFAULT '',
  `eligible_loanAmt` varchar(10) NOT NULL DEFAULT '',
  `eligible_interestRate` varchar(10) NOT NULL DEFAULT '',
  `eligible_emi` varchar(10) NOT NULL DEFAULT '',
  `eligible_term` varchar(10) NOT NULL DEFAULT '',
  `AppID` varchar(10) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT '',
  `MAIL_SENT` varchar(4) NOT NULL DEFAULT '',
  `compare_with_banks` tinyint(4) NOT NULL DEFAULT '0',
  `source` varchar(150) NOT NULL DEFAULT '',
  `Feedback` varchar(110) NOT NULL,
  `comment_section` varchar(255) NOT NULL,
  `duplicate_inmonth` tinyint(4) NOT NULL,
  `Panno` varchar(100) NOT NULL,
  `residence_address` text NOT NULL,
  `office_address` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingvysya_bidders`
--

CREATE TABLE IF NOT EXISTS `ingvysya_bidders` (
  `Bid` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(170) NOT NULL DEFAULT '',
  `Mobile` bigint(20) NOT NULL DEFAULT '0',
  `Location` varchar(150) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingvysya_companylist`
--

CREATE TABLE IF NOT EXISTS `ingvysya_companylist` (
  `id` int(11) NOT NULL,
  `company_name` varchar(250) NOT NULL DEFAULT '',
  `category` varchar(10) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ing_tempcomplist`
--

CREATE TABLE IF NOT EXISTS `ing_tempcomplist` (
  `ingid` int(11) NOT NULL,
  `ingcompany_n` text NOT NULL,
  `ingcat` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ip_whitelist`
--

CREATE TABLE IF NOT EXISTS `ip_whitelist` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `komli_plcompaign`
--

CREATE TABLE IF NOT EXISTS `komli_plcompaign` (
  `komliplid` int(11) NOT NULL,
  `komli_uniqueid` int(11) NOT NULL,
  `komli_email` varchar(100) NOT NULL,
  `komli_city` varchar(50) NOT NULL,
  `komli_netsalary` decimal(12,2) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `komli_date` datetime NOT NULL,
  `validated` tinyint(4) NOT NULL,
  `pubid` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kotak_credit_card_details`
--

CREATE TABLE IF NOT EXISTS `kotak_credit_card_details` (
  `kotakID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Mobile_No` varchar(100) NOT NULL DEFAULT '',
  `Emailid` varchar(100) NOT NULL DEFAULT '',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Desired_Name_On_Card` varchar(100) NOT NULL DEFAULT '',
  `Mother_Name` varchar(100) NOT NULL DEFAULT '',
  `Gender` varchar(50) NOT NULL DEFAULT '',
  `Marital_Status` varchar(50) NOT NULL DEFAULT '',
  `No_of_Dependents` varchar(20) NOT NULL DEFAULT '',
  `Education` varchar(100) NOT NULL DEFAULT '',
  `Pan_No` varchar(100) NOT NULL DEFAULT '',
  `Vehicle_Ownership` varchar(100) NOT NULL DEFAULT '',
  `Occupation` varchar(100) NOT NULL DEFAULT '',
  `Resi_Status` varchar(100) NOT NULL DEFAULT '',
  `Resi_Address` varchar(255) NOT NULL DEFAULT '',
  `Land_Mark` varchar(100) NOT NULL DEFAULT '',
  `Resi_Landline` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(100) NOT NULL DEFAULT '',
  `Pincode` varchar(100) NOT NULL DEFAULT '',
  `Company_Name` varchar(200) NOT NULL DEFAULT '',
  `Address` varchar(255) NOT NULL DEFAULT '',
  `Landline_No` varchar(100) NOT NULL DEFAULT '',
  `Department` varchar(100) NOT NULL DEFAULT '',
  `Designation` varchar(100) NOT NULL DEFAULT '',
  `Preferd_Mailing_Address` varchar(200) NOT NULL DEFAULT '',
  `Bank_Name` varchar(50) NOT NULL DEFAULT '',
  `Account_Type` varchar(100) NOT NULL DEFAULT '',
  `Account_No` varchar(100) NOT NULL DEFAULT '',
  `Branch` varchar(100) NOT NULL DEFAULT '',
  `Other_Credit_Card` varchar(100) NOT NULL DEFAULT '',
  `Card_Limit` varchar(100) NOT NULL DEFAULT '',
  `Card_No` varchar(100) NOT NULL DEFAULT '',
  `Membership_Since` varchar(100) NOT NULL DEFAULT '',
  `Entry_Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Card_Name` varchar(200) NOT NULL DEFAULT '',
  `Net_Salary` varchar(200) NOT NULL DEFAULT '',
  `Recording_No` varchar(200) NOT NULL DEFAULT '',
  `Total_Experience` varchar(50) NOT NULL DEFAULT '',
  `add_comment` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lap_interest_rate`
--

CREATE TABLE IF NOT EXISTS `lap_interest_rate` (
  `B_id` int(11) NOT NULL,
  `BankName` varchar(50) NOT NULL,
  `BankID` int(11) NOT NULL,
  `Upto30` text NOT NULL,
  `Upto75` text NOT NULL,
  `Above75` text NOT NULL,
  `ProcessingFee` text NOT NULL,
  `BankURL` varchar(250) NOT NULL,
  `BankURL1` varchar(255) NOT NULL,
  `ShowButton` tinyint(4) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Dated` datetime NOT NULL,
  `UpdatedDate` datetime NOT NULL,
  `Sequence` tinyint(4) NOT NULL,
  `UpdatedBy` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leads_with_other_processes`
--

CREATE TABLE IF NOT EXISTS `leads_with_other_processes` (
  `id` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `product` varchar(2) NOT NULL,
  `process_name` varchar(20) NOT NULL,
  `transfer_product` varchar(2) NOT NULL,
  `transfer_productid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Not Processed, 1 - Allocation Done, 2 - Duplicate',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_allocate`
--

CREATE TABLE IF NOT EXISTS `lead_allocate` (
  `leadid` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` mediumint(9) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `old_bidderid` int(11) NOT NULL,
  `old_allocated_date` datetime NOT NULL,
  `reallocation_archive` varchar(100) DEFAULT NULL,
  `cc_product_flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_allocate_140817`
--

CREATE TABLE IF NOT EXISTS `lead_allocate_140817` (
  `leadid` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` mediumint(9) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `old_bidderid` int(11) NOT NULL,
  `old_allocated_date` datetime NOT NULL,
  `reallocation_archive` varchar(100) DEFAULT NULL,
  `cc_product_flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_allocate_160817`
--

CREATE TABLE IF NOT EXISTS `lead_allocate_160817` (
  `leadid` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` mediumint(9) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `old_bidderid` int(11) NOT NULL,
  `old_allocated_date` datetime NOT NULL,
  `reallocation_archive` varchar(100) DEFAULT NULL,
  `cc_product_flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_allocation_table`
--

CREATE TABLE IF NOT EXISTS `lead_allocation_table` (
  `lead_allocation_logic` int(11) NOT NULL,
  `total_lead_count` int(11) NOT NULL DEFAULT '0',
  `last_allocated_to` int(10) NOT NULL DEFAULT '0',
  `total_no_agents` int(10) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Citywise` varchar(100) NOT NULL,
  `is_allocated` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lead_personal_loan_attributes`
--

CREATE TABLE IF NOT EXISTS `lead_personal_loan_attributes` (
  `id` int(11) unsigned NOT NULL,
  `lead_id` int(11) unsigned NOT NULL,
  `bank_code` varchar(5) DEFAULT NULL,
  `attribute_name` varchar(50) NOT NULL,
  `attribute_value` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `LMSLoginDetails`
--

CREATE TABLE IF NOT EXISTS `LMSLoginDetails` (
  `TrackID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Bidder_Name` varchar(100) NOT NULL,
  `Start_Time` datetime NOT NULL,
  `End_Time` datetime NOT NULL,
  `SessionID` varchar(50) NOT NULL,
  `IP` varchar(16) NOT NULL,
  `Product_Type` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_access_attributes`
--

CREATE TABLE IF NOT EXISTS `lms_access_attributes` (
  `id` int(11) NOT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `leadidentifier` varchar(60) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `login_url` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_attributes`
--

CREATE TABLE IF NOT EXISTS `lms_attributes` (
  `id` int(11) unsigned NOT NULL,
  `BidderID` int(11) unsigned NOT NULL,
  `productid` tinyint(4) unsigned NOT NULL,
  `product_tbl` varchar(25) NOT NULL,
  `allocation_tbl` varchar(25) NOT NULL,
  `feedback_tbl` varchar(25) NOT NULL,
  `feedback_list` text NOT NULL,
  `exclude_feedback_list` varchar(255) NOT NULL,
  `date_filter` tinyint(3) unsigned NOT NULL,
  `feedback_filter` tinyint(3) unsigned NOT NULL,
  `referenceid_filter` tinyint(4) unsigned NOT NULL,
  `app_active` tinyint(3) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `lms_type` varchar(20) NOT NULL,
  `lead_edit_page` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `LoanQuery`
--

CREATE TABLE IF NOT EXISTS `LoanQuery` (
  `ID` double NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `EMail` varchar(50) NOT NULL DEFAULT '',
  `Phone` varchar(50) NOT NULL DEFAULT '',
  `Products` varchar(100) DEFAULT NULL,
  `City` varchar(50) NOT NULL DEFAULT '',
  `Query` text,
  `RequestDate` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loans_interest_rate`
--

CREATE TABLE IF NOT EXISTS `loans_interest_rate` (
  `interestID` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL DEFAULT '',
  `rates` varchar(100) NOT NULL DEFAULT '',
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Logxy`
--

CREATE TABLE IF NOT EXISTS `Logxy` (
  `LogID` int(11) NOT NULL,
  `LeadID` int(11) NOT NULL DEFAULT '0',
  `ProductID` int(11) NOT NULL DEFAULT '0',
  `City` varchar(40) NOT NULL DEFAULT '',
  `TotalBidders` varchar(100) NOT NULL DEFAULT '',
  `EligibleBidders` varchar(200) NOT NULL DEFAULT '',
  `AlwaysBidders` varchar(200) NOT NULL DEFAULT '',
  `NonConflictingBidders` varchar(200) NOT NULL DEFAULT '',
  `ConflictingBiddersFirstSet` text NOT NULL,
  `ConflictingBiddersFinalSet` text NOT NULL,
  `BiddersFinalSet` varchar(255) NOT NULL DEFAULT '',
  `NotEligibleCity` varchar(250) NOT NULL DEFAULT '',
  `AgeLoanSalValidEmpStat` varchar(250) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Log_ivr`
--

CREATE TABLE IF NOT EXISTS `Log_ivr` (
  `LogID` int(11) NOT NULL,
  `LeadID` int(11) NOT NULL DEFAULT '0',
  `EligibleBidders` varchar(100) NOT NULL DEFAULT '',
  `Product_Type` varchar(50) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mailpancard`
--

CREATE TABLE IF NOT EXISTS `mailpancard` (
  `p_id` int(8) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  `request_id` int(8) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mailpancard1`
--

CREATE TABLE IF NOT EXISTS `mailpancard1` (
  `p_id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  `request_id` int(8) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manual_user_details`
--

CREATE TABLE IF NOT EXISTS `manual_user_details` (
  `id` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `pwd` varchar(40) NOT NULL,
  `firstname` varchar(120) NOT NULL,
  `standard_fields` varchar(255) NOT NULL,
  `custom_fields` varchar(255) NOT NULL,
  `custom_fields_captions` varchar(255) NOT NULL,
  `source` varchar(70) NOT NULL,
  `dated` datetime NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `product` varchar(25) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `last_inserted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_india_city`
--

CREATE TABLE IF NOT EXISTS `master_india_city` (
  `id` int(11) unsigned NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `std_code` smallint(6) NOT NULL,
  `pincode` mediumint(9) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 => Active , 0 => Deactive'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `media_release_np`
--

CREATE TABLE IF NOT EXISTS `media_release_np` (
  `id` tinyint(5) NOT NULL,
  `publication_heading` varchar(200) NOT NULL DEFAULT '',
  `publication_title` text NOT NULL,
  `publication_title_image` varchar(255) NOT NULL,
  `publication_name` varchar(100) NOT NULL DEFAULT '',
  `publication_city` varchar(200) NOT NULL DEFAULT '',
  `publication_date` date NOT NULL DEFAULT '0000-00-00',
  `publication_image` varchar(200) NOT NULL DEFAULT '',
  `publication_content` text NOT NULL,
  `publication_block` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `media_release_online`
--

CREATE TABLE IF NOT EXISTS `media_release_online` (
  `id` tinyint(5) NOT NULL,
  `publication_heading` varchar(200) NOT NULL DEFAULT '',
  `publication_name` varchar(100) NOT NULL DEFAULT '',
  `publication_city` varchar(200) NOT NULL DEFAULT '',
  `publication_date` date NOT NULL DEFAULT '0000-00-00',
  `publication_url` varchar(200) NOT NULL DEFAULT '',
  `publication_content` text NOT NULL,
  `publication_block` int(1) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monthly_creditcard_offer`
--

CREATE TABLE IF NOT EXISTS `monthly_creditcard_offer` (
  `cc_offerid` int(11) NOT NULL,
  `ccbank_name` varchar(200) NOT NULL DEFAULT '',
  `cc_content` text NOT NULL,
  `cc_dated` date NOT NULL DEFAULT '0000-00-00',
  `cc_approval` tinyint(4) NOT NULL DEFAULT '0',
  `compare_value` varchar(200) NOT NULL DEFAULT '',
  `compare_value_new` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `msging`
--

CREATE TABLE IF NOT EXISTS `msging` (
  `id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `Dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_comments`
--

CREATE TABLE IF NOT EXISTS `nests_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_golfresult`
--

CREATE TABLE IF NOT EXISTS `nests_golfresult` (
  `result_aid` mediumint(10) NOT NULL,
  `table_id` mediumint(10) NOT NULL DEFAULT '0',
  `row_id` mediumint(10) NOT NULL DEFAULT '1',
  `value` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_golftable`
--

CREATE TABLE IF NOT EXISTS `nests_golftable` (
  `table_aid` mediumint(10) NOT NULL,
  `table_name` varchar(200) NOT NULL DEFAULT 'Table name',
  `description` mediumtext NOT NULL,
  `alternative` tinyint(1) NOT NULL DEFAULT '1',
  `show_name` tinyint(1) NOT NULL DEFAULT '1',
  `show_desc` tinyint(1) NOT NULL DEFAULT '0',
  `head_bold` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_links`
--

CREATE TABLE IF NOT EXISTS `nests_links` (
  `link_id` bigint(20) unsigned NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_options`
--

CREATE TABLE IF NOT EXISTS `nests_options` (
  `option_id` bigint(20) unsigned NOT NULL,
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_postmeta`
--

CREATE TABLE IF NOT EXISTS `nests_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_posts`
--

CREATE TABLE IF NOT EXISTS `nests_posts` (
  `ID` bigint(20) unsigned NOT NULL,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` text NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_terms`
--

CREATE TABLE IF NOT EXISTS `nests_terms` (
  `term_id` bigint(20) unsigned NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_term_relationships`
--

CREATE TABLE IF NOT EXISTS `nests_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `nests_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_usermeta`
--

CREATE TABLE IF NOT EXISTS `nests_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nests_users`
--

CREATE TABLE IF NOT EXISTS `nests_users` (
  `ID` bigint(20) unsigned NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Newsletter`
--

CREATE TABLE IF NOT EXISTS `Newsletter` (
  `News_Id` int(10) NOT NULL,
  `News_Subject` varchar(50) NOT NULL DEFAULT '',
  `News_Content` varchar(50) NOT NULL DEFAULT '',
  `News_Month` varchar(50) NOT NULL DEFAULT '',
  `News_Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Newsletter_Subscription`
--

CREATE TABLE IF NOT EXISTS `Newsletter_Subscription` (
  `subnewsid` int(11) NOT NULL,
  `subscription_news_name` varchar(255) NOT NULL DEFAULT '',
  `subscription_news_email` varchar(255) NOT NULL DEFAULT '',
  `subscription_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_comments`
--

CREATE TABLE IF NOT EXISTS `nm_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_golfresult`
--

CREATE TABLE IF NOT EXISTS `nm_golfresult` (
  `result_aid` mediumint(10) NOT NULL,
  `table_id` mediumint(10) NOT NULL DEFAULT '0',
  `row_id` mediumint(10) NOT NULL DEFAULT '1',
  `value` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_golftable`
--

CREATE TABLE IF NOT EXISTS `nm_golftable` (
  `table_aid` mediumint(10) NOT NULL,
  `table_name` varchar(200) NOT NULL DEFAULT 'Table name',
  `description` mediumtext NOT NULL,
  `alternative` tinyint(1) NOT NULL DEFAULT '1',
  `show_name` tinyint(1) NOT NULL DEFAULT '1',
  `show_desc` tinyint(1) NOT NULL DEFAULT '0',
  `head_bold` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_links`
--

CREATE TABLE IF NOT EXISTS `nm_links` (
  `link_id` bigint(20) unsigned NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_options`
--

CREATE TABLE IF NOT EXISTS `nm_options` (
  `option_id` bigint(20) unsigned NOT NULL,
  `blog_id` int(11) NOT NULL DEFAULT '0',
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_postmeta`
--

CREATE TABLE IF NOT EXISTS `nm_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_posts`
--

CREATE TABLE IF NOT EXISTS `nm_posts` (
  `ID` bigint(20) unsigned NOT NULL,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` text NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_terms`
--

CREATE TABLE IF NOT EXISTS `nm_terms` (
  `term_id` bigint(20) unsigned NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_term_relationships`
--

CREATE TABLE IF NOT EXISTS `nm_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `nm_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_usermeta`
--

CREATE TABLE IF NOT EXISTS `nm_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nm_users`
--

CREATE TABLE IF NOT EXISTS `nm_users` (
  `ID` bigint(20) unsigned NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `non_dnc_tataaigleads`
--

CREATE TABLE IF NOT EXISTS `non_dnc_tataaigleads` (
  `non_dncid` int(11) NOT NULL,
  `ndnc_requestid` int(11) NOT NULL DEFAULT '0',
  `ndnc_product` tinyint(4) NOT NULL DEFAULT '0',
  `ndnc_email` varchar(100) NOT NULL DEFAULT '',
  `ndnc_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `openers_datacheck`
--

CREATE TABLE IF NOT EXISTS `openers_datacheck` (
  `openersid` int(11) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `plflag` tinyint(4) NOT NULL,
  `pldated` datetime NOT NULL,
  `hlflag` tinyint(4) NOT NULL,
  `hldated` datetime NOT NULL,
  `liflag` tinyint(4) NOT NULL,
  `lidated` datetime NOT NULL,
  `baseupload_date` datetime NOT NULL,
  `download_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `other_city_list`
--

CREATE TABLE IF NOT EXISTS `other_city_list` (
  `id` int(11) NOT NULL,
  `other_city` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `package_purchase_details`
--

CREATE TABLE IF NOT EXISTS `package_purchase_details` (
  `Rid` int(11) NOT NULL,
  `MTrackid` bigint(20) NOT NULL,
  `Aid` int(11) NOT NULL,
  `Pid` int(11) NOT NULL,
  `Cost` int(11) NOT NULL,
  `initiate_dt` datetime NOT NULL,
  `response_dt` datetime NOT NULL,
  `purchase_status` varchar(18) NOT NULL,
  `message` varchar(255) NOT NULL,
  `ResResult` varchar(40) NOT NULL,
  `ResTrackId` varchar(20) NOT NULL,
  `ResAmount` int(11) NOT NULL,
  `ResPaymentId` varchar(20) NOT NULL,
  `ResRef` varchar(20) NOT NULL,
  `ResTranId` varchar(20) NOT NULL,
  `ResError` varchar(255) NOT NULL,
  `IP` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_cellnext_details`
--

CREATE TABLE IF NOT EXISTS `payment_cellnext_details` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL DEFAULT '',
  `mobile` bigint(20) NOT NULL DEFAULT '0',
  `transaction_id` varchar(30) NOT NULL DEFAULT '',
  `Amount` varchar(30) NOT NULL DEFAULT '',
  `Status` varchar(30) NOT NULL DEFAULT '',
  `Message` varchar(200) NOT NULL DEFAULT '',
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personalloan_interest_rates_chart`
--

CREATE TABLE IF NOT EXISTS `personalloan_interest_rates_chart` (
  `plintr_id` int(11) NOT NULL,
  `plintr_bank_name` varchar(50) NOT NULL,
  `plintr_category` varchar(50) NOT NULL,
  `plintr_min_rates` float(5,2) NOT NULL,
  `plintr_max_rates` float(5,2) NOT NULL,
  `plintr_description` varchar(200) NOT NULL,
  `plintr_procfee` varchar(100) NOT NULL,
  `plintr_prepay` varchar(100) NOT NULL,
  `plintr_url` varchar(255) NOT NULL,
  `plintr_seq` tinyint(4) NOT NULL,
  `plintr_flag` tinyint(4) NOT NULL,
  `plintr_priorty` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personal_loan_banks_eligibility`
--

CREATE TABLE IF NOT EXISTS `personal_loan_banks_eligibility` (
  `pl_bankid` int(11) NOT NULL,
  `pl_bank_name` varchar(100) NOT NULL DEFAULT '',
  `pl_bank_roi` varchar(50) NOT NULL DEFAULT '',
  `pl_bank_processing_fee` varchar(100) NOT NULL DEFAULT '',
  `pl_bank_loan_amt` varchar(100) NOT NULL DEFAULT '',
  `pl_bank_prepayment` varchar(100) NOT NULL DEFAULT '',
  `pl_bank_disbursal_time` varchar(100) NOT NULL DEFAULT '',
  `pl_bank_documents` text NOT NULL,
  `identification_proof` varchar(255) NOT NULL DEFAULT '',
  `part_payment_option` varchar(50) NOT NULL DEFAULT '',
  `income_proof` varchar(255) NOT NULL DEFAULT '',
  `pl_bank_flag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personal_loan_interest_rate_chart`
--

CREATE TABLE IF NOT EXISTS `personal_loan_interest_rate_chart` (
  `rateid` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL DEFAULT '',
  `cat_a` varchar(50) NOT NULL DEFAULT '',
  `cat_b` varchar(50) NOT NULL DEFAULT '',
  `others` varchar(50) NOT NULL DEFAULT '',
  `pre_payment` varchar(30) NOT NULL DEFAULT '',
  `processing_fee` varchar(200) NOT NULL DEFAULT '',
  `bankid` int(30) NOT NULL DEFAULT '0',
  `bank_url` varchar(255) NOT NULL DEFAULT '',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bankwise_priority` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personal_loan_updates`
--

CREATE TABLE IF NOT EXISTS `personal_loan_updates` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(150) NOT NULL,
  `BankID` tinyint(4) NOT NULL,
  `option1_priority` tinyint(4) NOT NULL,
  `interest_rates` varchar(100) NOT NULL,
  `option2_priority` tinyint(4) NOT NULL,
  `prepayment_charges` varchar(100) NOT NULL,
  `option3_priority` tinyint(4) NOT NULL,
  `processing_fee` varchar(100) NOT NULL,
  `option4_priority` tinyint(4) NOT NULL,
  `option5_priority` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `min_loanamt` int(11) NOT NULL,
  `max_loanamt` int(11) NOT NULL,
  `minSalary` int(11) NOT NULL,
  `maxSalary` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plcallinglms_allocation`
--

CREATE TABLE IF NOT EXISTS `plcallinglms_allocation` (
  `plallocateid` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Allocation_Date` datetime NOT NULL,
  `DOE` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PLivrBidders`
--

CREATE TABLE IF NOT EXISTS `PLivrBidders` (
  `BidderID` int(10) unsigned NOT NULL,
  `Email` varchar(50) NOT NULL DEFAULT '',
  `PWD` varchar(15) NOT NULL DEFAULT '',
  `Bidder_Name` varchar(100) NOT NULL DEFAULT '',
  `Associated_Bank` varchar(50) NOT NULL DEFAULT '',
  `City` text NOT NULL,
  `Address` varchar(100) NOT NULL DEFAULT '',
  `Join_Date` date NOT NULL DEFAULT '0000-00-00',
  `Is_Verified` tinyint(5) DEFAULT '0',
  `Reply_Type` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `PLivrBiddersList`
--

CREATE TABLE IF NOT EXISTS `PLivrBiddersList` (
  `Bidder_listID` int(11) NOT NULL,
  `BidderID` int(10) unsigned NOT NULL DEFAULT '0',
  `Bidder_Name` varchar(100) DEFAULT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `City` text,
  `Query` text,
  `Dated` date DEFAULT NULL,
  `Always` tinyint(4) NOT NULL DEFAULT '0',
  `BidderContact` varchar(20) NOT NULL DEFAULT '',
  `BlockBidder` tinyint(4) NOT NULL DEFAULT '0',
  `Priority` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pllms_leadupload`
--

CREATE TABLE IF NOT EXISTS `pllms_leadupload` (
  `pllmsid` int(11) NOT NULL,
  `pllms_name` varchar(50) NOT NULL,
  `pllms_mobileno` bigint(20) NOT NULL,
  `pllms_city` varchar(30) NOT NULL,
  `pllms_salary` decimal(12,2) NOT NULL,
  `pllms_bankname` varchar(50) NOT NULL,
  `pllms_dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pllms_sw_email`
--

CREATE TABLE IF NOT EXISTS `pllms_sw_email` (
  `pllms_swid` int(11) NOT NULL,
  `bank_name` varchar(20) NOT NULL,
  `bidderid` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  `to_send` varchar(255) NOT NULL,
  `cc_send` varchar(255) NOT NULL,
  `send_flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_companylist_icici`
--

CREATE TABLE IF NOT EXISTS `pl_companylist_icici` (
  `compid` int(10) unsigned NOT NULL,
  `company_name` text NOT NULL,
  `category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_altest`
--

CREATE TABLE IF NOT EXISTS `pl_company_altest` (
  `company_name` text NOT NULL,
  `comp_cat` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_bajajfinserv`
--

CREATE TABLE IF NOT EXISTS `pl_company_bajajfinserv` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `bajajfinserv` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_hdbfs`
--

CREATE TABLE IF NOT EXISTS `pl_company_hdbfs` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `icici` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_hdfc`
--

CREATE TABLE IF NOT EXISTS `pl_company_hdfc` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `hdfc` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `interest_rate_csa` float(5,2) NOT NULL,
  `processing_fee` float(6,2) NOT NULL,
  `interest_rate_noncsa` float(5,2) NOT NULL,
  `prcessing_fee_noncsa` float(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_hdfc_test`
--

CREATE TABLE IF NOT EXISTS `pl_company_hdfc_test` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `hdfc` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `interest_rate_csa` float(5,2) NOT NULL,
  `processing_fee` float(6,2) NOT NULL,
  `interest_rate_noncsa` float(5,2) NOT NULL,
  `prcessing_fee_noncsa` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_icici`
--

CREATE TABLE IF NOT EXISTS `pl_company_icici` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `icici` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `interest_rate` float(5,2) NOT NULL,
  `processing_fee` float(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_iciciapp`
--

CREATE TABLE IF NOT EXISTS `pl_company_iciciapp` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `interest_rate` float(5,2) NOT NULL,
  `processing_fee` float(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_icicibank`
--

CREATE TABLE IF NOT EXISTS `pl_company_icicibank` (
  `icicicompid` int(11) NOT NULL,
  `icici_company_name` text NOT NULL,
  `icici_cat` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_indusind`
--

CREATE TABLE IF NOT EXISTS `pl_company_indusind` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `indusind` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_indusindspl`
--

CREATE TABLE IF NOT EXISTS `pl_company_indusindspl` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `interest_rate` float(5,2) NOT NULL,
  `processing_fee` float(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_ingvysya`
--

CREATE TABLE IF NOT EXISTS `pl_company_ingvysya` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `ingvysya` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `interest_rate` float(5,2) NOT NULL,
  `processing_fee` float(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_ingvysya_sco`
--

CREATE TABLE IF NOT EXISTS `pl_company_ingvysya_sco` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `interest_rate_above50` float(5,2) NOT NULL,
  `interest_rate_less50` float(5,2) NOT NULL,
  `processing_fee` float(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_kotak`
--

CREATE TABLE IF NOT EXISTS `pl_company_kotak` (
  `kotakid` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `cmp_type` varchar(50) NOT NULL,
  `interest_rate` float(5,2) NOT NULL,
  `processing_fee` float(6,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_list`
--

CREATE TABLE IF NOT EXISTS `pl_company_list` (
  `plcompanyid` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `hdfc_bank` varchar(50) NOT NULL DEFAULT '',
  `fullerton` varchar(50) NOT NULL DEFAULT '',
  `citibank` varchar(50) NOT NULL DEFAULT '',
  `barclays` varchar(100) NOT NULL DEFAULT '',
  `standard_chartered` varchar(50) NOT NULL DEFAULT '',
  `hdbfs` varchar(10) NOT NULL DEFAULT '',
  `ingvyasya` varchar(10) NOT NULL DEFAULT '',
  `bajajfinserv` varchar(8) NOT NULL,
  `icici_bank` varchar(20) NOT NULL,
  `kotak` varchar(20) NOT NULL,
  `Indusind` varchar(20) NOT NULL,
  `tatacapital` varchar(20) NOT NULL,
  `capitalfirst` varchar(20) NOT NULL,
  `adityabirla` varchar(20) NOT NULL,
  `rblbank` varchar(50) NOT NULL,
  `iifl` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_list_detail`
--

CREATE TABLE IF NOT EXISTS `pl_company_list_detail` (
  `plcompanyid` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `hdfc_bank_compname` text,
  `hdfc_bank` varchar(50) DEFAULT NULL,
  `fullerton_compname` text,
  `fullerton` varchar(50) DEFAULT NULL,
  `citibank_compname` text,
  `citibank` varchar(50) DEFAULT NULL,
  `standard_chartered_compname` text,
  `standard_chartered` varchar(50) DEFAULT NULL,
  `bajajfinserv_compname` text,
  `bajajfinserv` varchar(50) DEFAULT NULL,
  `icici_bank_compname` text,
  `icici_bank` varchar(50) DEFAULT NULL,
  `kotak_compname` text,
  `kotak` varchar(50) DEFAULT NULL,
  `Indusind_compname` text,
  `Indusind` varchar(50) DEFAULT NULL,
  `tatacapital_compname` text,
  `tatacapital` text,
  `adityabirla_compname` text,
  `adityabirla` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_list_test`
--

CREATE TABLE IF NOT EXISTS `pl_company_list_test` (
  `plcompanyid` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `hdfc_bank` varchar(50) NOT NULL DEFAULT '',
  `fullerton` varchar(50) NOT NULL DEFAULT '',
  `citibank` varchar(50) NOT NULL DEFAULT '',
  `barclays` varchar(100) NOT NULL DEFAULT '',
  `standard_chartered` varchar(50) NOT NULL DEFAULT '',
  `hdbfs` varchar(20) NOT NULL DEFAULT '',
  `ingvyasya` varchar(10) NOT NULL DEFAULT '',
  `bajajfinserv` varchar(8) NOT NULL,
  `icici_bank` varchar(20) NOT NULL,
  `kotak` varchar(20) NOT NULL,
  `Indusind` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_stanc`
--

CREATE TABLE IF NOT EXISTS `pl_company_stanc` (
  `plcompanyid` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `standard_chartered` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_company_tatacapital`
--

CREATE TABLE IF NOT EXISTS `pl_company_tatacapital` (
  `id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `tata_capital` varchar(20) NOT NULL,
  `interest_rate` float(5,2) NOT NULL,
  `processing_fee` float(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_content`
--

CREATE TABLE IF NOT EXISTS `pl_content` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL DEFAULT '',
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_feedback`
--

CREATE TABLE IF NOT EXISTS `pl_feedback` (
  `id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL DEFAULT '0',
  `bidder_id` int(11) NOT NULL DEFAULT '0',
  `contacted` varchar(10) NOT NULL DEFAULT '',
  `feedback` varchar(100) NOT NULL DEFAULT '',
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `followupdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bidder_name` varchar(100) NOT NULL DEFAULT '',
  `lead_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cus_contacted` varchar(10) NOT NULL DEFAULT '',
  `doa` varchar(100) NOT NULL DEFAULT '',
  `toa` varchar(100) NOT NULL DEFAULT '',
  `address` text NOT NULL,
  `comment` varchar(255) NOT NULL DEFAULT '',
  `fbidder_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_icici_leads`
--

CREATE TABLE IF NOT EXISTS `pl_icici_leads` (
  `RequestID` int(11) NOT NULL,
  `ReqID` int(11) NOT NULL,
  `Name` varchar(130) NOT NULL,
  `Email` varchar(160) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `City` varchar(70) NOT NULL,
  `DOB` date NOT NULL,
  `age` tinyint(4) NOT NULL,
  `Loan_Amount` int(11) NOT NULL,
  `Employment_Status` tinyint(4) NOT NULL,
  `Company_Name` varchar(200) NOT NULL,
  `Company_Type` varchar(80) NOT NULL,
  `Years_In_Company` tinyint(4) NOT NULL,
  `Years_Company` int(11) NOT NULL,
  `Month_Company` int(11) NOT NULL,
  `Total_Experience` tinyint(4) NOT NULL,
  `Total_Exp_Year` int(11) NOT NULL,
  `Total_Exp_Month` int(11) NOT NULL,
  `Net_Salary` int(11) NOT NULL,
  `business_running` int(11) NOT NULL,
  `Reference_Code` varchar(6) NOT NULL,
  `Is_Valid` text NOT NULL,
  `Residential_Stability` tinyint(4) NOT NULL,
  `Residential_Status` varchar(110) NOT NULL,
  `CC_Holder` tinyint(4) NOT NULL,
  `card_obligation` int(11) NOT NULL,
  `existing_relationship` tinyint(4) NOT NULL,
  `relationship` varchar(100) NOT NULL,
  `LoanAny` tinyint(4) NOT NULL,
  `Loan_Any` varchar(60) NOT NULL,
  `EMI_Paid` varchar(100) NOT NULL,
  `other_emi` int(11) NOT NULL,
  `source` varchar(50) NOT NULL,
  `IP` varchar(16) NOT NULL,
  `Dated` datetime NOT NULL,
  `Residence_Address` varchar(255) NOT NULL,
  `Pincode` int(11) NOT NULL,
  `home_std` int(11) NOT NULL,
  `Landline` bigint(20) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `Designation` varchar(100) NOT NULL,
  `office_std` int(11) NOT NULL,
  `office_ext` int(11) NOT NULL,
  `Off_Landline` int(11) NOT NULL,
  `Primary_Acc` varchar(110) NOT NULL,
  `CC_Limit` int(11) NOT NULL,
  `finalLoanAmount` int(11) NOT NULL,
  `intr_rate` float(6,2) NOT NULL,
  `proc_fee` float(6,2) NOT NULL,
  `Tenure` varchar(4) NOT NULL,
  `AppID` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_quote_shown`
--

CREATE TABLE IF NOT EXISTS `pl_quote_shown` (
  `plquoteid` int(11) NOT NULL,
  `pl_leadid` int(11) NOT NULL,
  `pl_bankname` varchar(50) NOT NULL,
  `pl_bankrate` decimal(5,2) NOT NULL,
  `pl_bankemi` varchar(100) NOT NULL,
  `pl_banktenure` varchar(20) NOT NULL,
  `pl_loanamount` decimal(12,2) NOT NULL,
  `pl_bankpf` varchar(100) NOT NULL,
  `pl_bankppc` varchar(50) NOT NULL,
  `pl_dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_quote_shown_save`
--

CREATE TABLE IF NOT EXISTS `pl_quote_shown_save` (
  `plquoteid` int(11) NOT NULL,
  `pl_leadid` int(11) NOT NULL,
  `pl_bankname` varchar(50) NOT NULL,
  `pl_bankrate` decimal(5,2) NOT NULL,
  `pl_bankemi` varchar(100) NOT NULL,
  `pl_banktenure` varchar(20) NOT NULL,
  `pl_loanamount` decimal(12,2) NOT NULL,
  `pl_bankpf` varchar(100) NOT NULL,
  `pl_bankppc` varchar(50) NOT NULL,
  `pl_dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_salaryclause`
--

CREATE TABLE IF NOT EXISTS `pl_salaryclause` (
  `plsalid` int(11) NOT NULL,
  `plRequestID` int(11) NOT NULL,
  `plUpdated_Date` datetime NOT NULL,
  `plbidders` varchar(255) NOT NULL,
  `pldated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_stanc_leads`
--

CREATE TABLE IF NOT EXISTS `pl_stanc_leads` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `fname` varchar(110) NOT NULL,
  `mname` varchar(110) NOT NULL,
  `lname` varchar(110) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `qualification` varchar(170) NOT NULL,
  `address1` varchar(250) NOT NULL,
  `address2` varchar(250) NOT NULL,
  `city` varchar(90) NOT NULL,
  `pincode` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `pancard` varchar(10) NOT NULL,
  `pancardLater` varchar(4) NOT NULL,
  `Net_Salary` int(11) NOT NULL,
  `existing_customer` varchar(3) NOT NULL,
  `Dated` datetime NOT NULL,
  `RedID` varchar(14) NOT NULL,
  `DOB` date NOT NULL,
  `Descr` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `poll_for_loan`
--

CREATE TABLE IF NOT EXISTS `poll_for_loan` (
  `id` int(11) NOT NULL,
  `employment_status` tinyint(2) NOT NULL,
  `annual_income` tinyint(2) NOT NULL,
  `loan_type` tinyint(1) NOT NULL,
  `loan_amount` tinyint(2) NOT NULL,
  `preferred_banks` varchar(10) NOT NULL,
  `other_bank` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `city` varchar(25) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `process_send_emails`
--

CREATE TABLE IF NOT EXISTS `process_send_emails` (
  `id` int(11) NOT NULL,
  `EmailID` varchar(170) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `TemplateID` int(11) NOT NULL,
  `BankID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `Dated` datetime NOT NULL,
  `DatetoSend` datetime NOT NULL,
  `Process` varchar(60) NOT NULL,
  `Item_Value` text NOT NULL,
  `Status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `process_templates`
--

CREATE TABLE IF NOT EXISTS `process_templates` (
  `id` int(11) NOT NULL,
  `mail_template` text NOT NULL,
  `sms_template` text NOT NULL,
  `process` varchar(60) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_for_sale`
--

CREATE TABLE IF NOT EXISTS `product_for_sale` (
  `Pid` int(11) NOT NULL,
  `Product_Name` varchar(60) NOT NULL,
  `Portal_Name` varchar(20) NOT NULL,
  `Package_Name` varchar(255) NOT NULL,
  `Package_Name_Display` varchar(255) NOT NULL,
  `Package_Desc` text NOT NULL,
  `CPL` float(10,2) NOT NULL,
  `Leads_Count` int(11) NOT NULL,
  `Total_Cost` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  `Dated` datetime NOT NULL,
  `priority` int(11) NOT NULL,
  `payu_button` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_rating`
--

CREATE TABLE IF NOT EXISTS `product_rating` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `rating` float NOT NULL,
  `reviews` text NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_wisecitylist`
--

CREATE TABLE IF NOT EXISTS `product_wisecitylist` (
  `procityid` int(11) NOT NULL,
  `product` tinyint(4) NOT NULL,
  `citylist` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `property_deals`
--

CREATE TABLE IF NOT EXISTS `property_deals` (
  `propertyd_id` int(11) NOT NULL,
  `propertyd_name` varchar(50) NOT NULL DEFAULT '',
  `property_title` varchar(250) NOT NULL DEFAULT '',
  `propertyd_city` varchar(100) NOT NULL DEFAULT '',
  `propertyd_end_date` date NOT NULL DEFAULT '0000-00-00',
  `propertyd_market_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `propertyd_offer_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `propertyd_link` varchar(200) NOT NULL DEFAULT '',
  `propertyd_valid` tinyint(4) NOT NULL DEFAULT '0',
  `propertyd_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `property_deal_leads`
--

CREATE TABLE IF NOT EXISTS `property_deal_leads` (
  `prprtydl_id` int(11) NOT NULL,
  `prprtydl_name` varchar(50) NOT NULL DEFAULT '',
  `prprtydl_email` varchar(100) NOT NULL DEFAULT '',
  `prprtydl_mobile_no` bigint(20) NOT NULL DEFAULT '0',
  `prprtydl_city` varchar(50) NOT NULL DEFAULT '',
  `prprtydl_dob` date NOT NULL DEFAULT '0000-00-00',
  `prprtydi_slcid` int(11) NOT NULL DEFAULT '0',
  `prprtydl_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `property_details_city`
--

CREATE TABLE IF NOT EXISTS `property_details_city` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `sub_city` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `property_details_hl`
--

CREATE TABLE IF NOT EXISTS `property_details_hl` (
  `PID` int(11) NOT NULL,
  `State` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Price` int(11) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `Rate` varchar(25) NOT NULL,
  `CoveredArea` varchar(100) NOT NULL,
  `Facilities` varchar(200) NOT NULL,
  `Description` longtext NOT NULL,
  `ApprovedBy` varchar(255) NOT NULL,
  `BuilderName` varchar(100) NOT NULL,
  `Dated` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `AgentName` varchar(100) NOT NULL,
  `AgentEmail` varchar(150) NOT NULL,
  `AgentMobile` bigint(20) NOT NULL,
  `AgentPwd` varchar(60) NOT NULL,
  `metadesc` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `qa_blobs`
--

CREATE TABLE IF NOT EXISTS `qa_blobs` (
  `blobid` bigint(20) unsigned NOT NULL,
  `format` varchar(20) CHARACTER SET ascii NOT NULL,
  `content` mediumblob NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `userid` int(10) unsigned DEFAULT NULL,
  `cookieid` bigint(20) unsigned DEFAULT NULL,
  `createip` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_cache`
--

CREATE TABLE IF NOT EXISTS `qa_cache` (
  `type` char(8) CHARACTER SET ascii NOT NULL,
  `cacheid` bigint(20) unsigned NOT NULL DEFAULT '0',
  `content` mediumblob NOT NULL,
  `created` datetime NOT NULL,
  `lastread` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_categories`
--

CREATE TABLE IF NOT EXISTS `qa_categories` (
  `categoryid` int(10) unsigned NOT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `title` varchar(80) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `content` varchar(800) NOT NULL DEFAULT '',
  `qcount` int(10) unsigned NOT NULL DEFAULT '0',
  `position` smallint(5) unsigned NOT NULL,
  `backpath` varchar(804) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_categorymetas`
--

CREATE TABLE IF NOT EXISTS `qa_categorymetas` (
  `categoryid` int(10) unsigned NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_contentwords`
--

CREATE TABLE IF NOT EXISTS `qa_contentwords` (
  `postid` int(10) unsigned NOT NULL,
  `wordid` int(10) unsigned NOT NULL,
  `count` tinyint(3) unsigned NOT NULL,
  `type` enum('Q','A','C','NOTE') NOT NULL,
  `questionid` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_cookies`
--

CREATE TABLE IF NOT EXISTS `qa_cookies` (
  `cookieid` bigint(20) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `createip` int(10) unsigned NOT NULL,
  `written` datetime DEFAULT NULL,
  `writeip` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_iplimits`
--

CREATE TABLE IF NOT EXISTS `qa_iplimits` (
  `ip` int(10) unsigned NOT NULL,
  `action` char(1) CHARACTER SET ascii NOT NULL,
  `period` int(10) unsigned NOT NULL,
  `count` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_messages`
--

CREATE TABLE IF NOT EXISTS `qa_messages` (
  `messageid` int(10) unsigned NOT NULL,
  `fromuserid` int(10) unsigned NOT NULL,
  `touserid` int(10) unsigned NOT NULL,
  `content` varchar(8000) NOT NULL,
  `format` varchar(20) CHARACTER SET ascii NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_options`
--

CREATE TABLE IF NOT EXISTS `qa_options` (
  `title` varchar(40) NOT NULL,
  `content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_pages`
--

CREATE TABLE IF NOT EXISTS `qa_pages` (
  `pageid` smallint(5) unsigned NOT NULL,
  `title` varchar(80) NOT NULL,
  `nav` char(1) CHARACTER SET ascii NOT NULL,
  `position` smallint(5) unsigned NOT NULL,
  `flags` tinyint(3) unsigned NOT NULL,
  `permit` tinyint(3) unsigned DEFAULT NULL,
  `tags` varchar(200) NOT NULL,
  `heading` varchar(800) DEFAULT NULL,
  `content` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_postmetas`
--

CREATE TABLE IF NOT EXISTS `qa_postmetas` (
  `postid` int(10) unsigned NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_posts`
--

CREATE TABLE IF NOT EXISTS `qa_posts` (
  `postid` int(10) unsigned NOT NULL,
  `type` enum('Q','A','C','Q_HIDDEN','A_HIDDEN','C_HIDDEN','Q_QUEUED','A_QUEUED','C_QUEUED','NOTE') NOT NULL,
  `parentid` int(10) unsigned DEFAULT NULL,
  `categoryid` int(10) unsigned DEFAULT NULL,
  `catidpath1` int(10) unsigned DEFAULT NULL,
  `catidpath2` int(10) unsigned DEFAULT NULL,
  `catidpath3` int(10) unsigned DEFAULT NULL,
  `acount` smallint(5) unsigned NOT NULL DEFAULT '0',
  `amaxvote` smallint(5) unsigned NOT NULL DEFAULT '0',
  `selchildid` int(10) unsigned DEFAULT NULL,
  `closedbyid` int(10) unsigned DEFAULT NULL,
  `userid` int(10) unsigned DEFAULT NULL,
  `cookieid` bigint(20) unsigned DEFAULT NULL,
  `createip` int(10) unsigned DEFAULT NULL,
  `lastuserid` int(10) unsigned DEFAULT NULL,
  `lastip` int(10) unsigned DEFAULT NULL,
  `upvotes` smallint(5) unsigned NOT NULL DEFAULT '0',
  `downvotes` smallint(5) unsigned NOT NULL DEFAULT '0',
  `netvotes` smallint(6) NOT NULL DEFAULT '0',
  `lastviewip` int(10) unsigned DEFAULT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `hotness` float DEFAULT NULL,
  `flagcount` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `format` varchar(20) CHARACTER SET ascii NOT NULL DEFAULT '',
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updatetype` char(1) CHARACTER SET ascii DEFAULT NULL,
  `title` varchar(800) DEFAULT NULL,
  `content` varchar(8000) DEFAULT NULL,
  `tags` varchar(800) DEFAULT NULL,
  `notify` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_posttags`
--

CREATE TABLE IF NOT EXISTS `qa_posttags` (
  `postid` int(10) unsigned NOT NULL,
  `wordid` int(10) unsigned NOT NULL,
  `postcreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_sharedevents`
--

CREATE TABLE IF NOT EXISTS `qa_sharedevents` (
  `entitytype` char(1) CHARACTER SET ascii NOT NULL,
  `entityid` int(10) unsigned NOT NULL,
  `questionid` int(10) unsigned NOT NULL,
  `lastpostid` int(10) unsigned NOT NULL,
  `updatetype` char(1) CHARACTER SET ascii DEFAULT NULL,
  `lastuserid` int(10) unsigned DEFAULT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_tagmetas`
--

CREATE TABLE IF NOT EXISTS `qa_tagmetas` (
  `tag` varchar(80) NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_tagwords`
--

CREATE TABLE IF NOT EXISTS `qa_tagwords` (
  `postid` int(10) unsigned NOT NULL,
  `wordid` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_titlewords`
--

CREATE TABLE IF NOT EXISTS `qa_titlewords` (
  `postid` int(10) unsigned NOT NULL,
  `wordid` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_userevents`
--

CREATE TABLE IF NOT EXISTS `qa_userevents` (
  `userid` int(10) unsigned NOT NULL,
  `entitytype` char(1) CHARACTER SET ascii NOT NULL,
  `entityid` int(10) unsigned NOT NULL,
  `questionid` int(10) unsigned NOT NULL,
  `lastpostid` int(10) unsigned NOT NULL,
  `updatetype` char(1) CHARACTER SET ascii DEFAULT NULL,
  `lastuserid` int(10) unsigned DEFAULT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_userfavorites`
--

CREATE TABLE IF NOT EXISTS `qa_userfavorites` (
  `userid` int(10) unsigned NOT NULL,
  `entitytype` char(1) CHARACTER SET ascii NOT NULL,
  `entityid` int(10) unsigned NOT NULL,
  `nouserevents` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_userfields`
--

CREATE TABLE IF NOT EXISTS `qa_userfields` (
  `fieldid` smallint(5) unsigned NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(40) DEFAULT NULL,
  `position` smallint(5) unsigned NOT NULL,
  `flags` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_userlimits`
--

CREATE TABLE IF NOT EXISTS `qa_userlimits` (
  `userid` int(10) unsigned NOT NULL,
  `action` char(1) CHARACTER SET ascii NOT NULL,
  `period` int(10) unsigned NOT NULL,
  `count` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_userlogins`
--

CREATE TABLE IF NOT EXISTS `qa_userlogins` (
  `userid` int(10) unsigned NOT NULL,
  `source` varchar(16) CHARACTER SET ascii NOT NULL,
  `identifier` varbinary(1024) NOT NULL,
  `identifiermd5` binary(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_usermetas`
--

CREATE TABLE IF NOT EXISTS `qa_usermetas` (
  `userid` int(10) unsigned NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_usernotices`
--

CREATE TABLE IF NOT EXISTS `qa_usernotices` (
  `noticeid` int(10) unsigned NOT NULL,
  `userid` int(10) unsigned NOT NULL,
  `content` varchar(8000) NOT NULL,
  `format` varchar(20) CHARACTER SET ascii NOT NULL,
  `tags` varchar(200) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_userpoints`
--

CREATE TABLE IF NOT EXISTS `qa_userpoints` (
  `userid` int(10) unsigned NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `qposts` mediumint(9) NOT NULL DEFAULT '0',
  `aposts` mediumint(9) NOT NULL DEFAULT '0',
  `cposts` mediumint(9) NOT NULL DEFAULT '0',
  `aselects` mediumint(9) NOT NULL DEFAULT '0',
  `aselecteds` mediumint(9) NOT NULL DEFAULT '0',
  `qupvotes` mediumint(9) NOT NULL DEFAULT '0',
  `qdownvotes` mediumint(9) NOT NULL DEFAULT '0',
  `aupvotes` mediumint(9) NOT NULL DEFAULT '0',
  `adownvotes` mediumint(9) NOT NULL DEFAULT '0',
  `qvoteds` int(11) NOT NULL DEFAULT '0',
  `avoteds` int(11) NOT NULL DEFAULT '0',
  `upvoteds` int(11) NOT NULL DEFAULT '0',
  `downvoteds` int(11) NOT NULL DEFAULT '0',
  `bonus` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_userprofile`
--

CREATE TABLE IF NOT EXISTS `qa_userprofile` (
  `userid` int(10) unsigned NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(8000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_users`
--

CREATE TABLE IF NOT EXISTS `qa_users` (
  `userid` int(10) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `createip` int(10) unsigned NOT NULL,
  `email` varchar(80) NOT NULL,
  `handle` varchar(20) NOT NULL,
  `avatarblobid` bigint(20) unsigned DEFAULT NULL,
  `avatarwidth` smallint(5) unsigned DEFAULT NULL,
  `avatarheight` smallint(5) unsigned DEFAULT NULL,
  `passsalt` binary(16) DEFAULT NULL,
  `passcheck` binary(20) DEFAULT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  `loggedin` datetime NOT NULL,
  `loginip` int(10) unsigned NOT NULL,
  `written` datetime DEFAULT NULL,
  `writeip` int(10) unsigned DEFAULT NULL,
  `emailcode` char(8) CHARACTER SET ascii NOT NULL DEFAULT '',
  `sessioncode` char(8) CHARACTER SET ascii NOT NULL DEFAULT '',
  `sessionsource` varchar(16) CHARACTER SET ascii DEFAULT '',
  `flags` tinyint(3) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_uservotes`
--

CREATE TABLE IF NOT EXISTS `qa_uservotes` (
  `postid` int(10) unsigned NOT NULL,
  `userid` int(10) unsigned NOT NULL,
  `vote` tinyint(4) NOT NULL,
  `flag` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_widgets`
--

CREATE TABLE IF NOT EXISTS `qa_widgets` (
  `widgetid` smallint(5) unsigned NOT NULL,
  `place` char(2) CHARACTER SET ascii NOT NULL,
  `position` smallint(5) unsigned NOT NULL,
  `tags` varchar(800) CHARACTER SET ascii NOT NULL,
  `title` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qa_words`
--

CREATE TABLE IF NOT EXISTS `qa_words` (
  `wordid` int(10) unsigned NOT NULL,
  `word` varchar(80) NOT NULL,
  `titlecount` int(10) unsigned NOT NULL DEFAULT '0',
  `contentcount` int(10) unsigned NOT NULL DEFAULT '0',
  `tagwordcount` int(10) unsigned NOT NULL DEFAULT '0',
  `tagcount` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Rate_Experience`
--

CREATE TABLE IF NOT EXISTS `Rate_Experience` (
  `RateE_ID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL DEFAULT '',
  `URL` varchar(200) NOT NULL DEFAULT '',
  `Rateval` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IP_Address` varchar(50) NOT NULL DEFAULT '',
  `Keyword` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Rate_Services`
--

CREATE TABLE IF NOT EXISTS `Rate_Services` (
  `RateS_ID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL DEFAULT '',
  `URL` varchar(200) NOT NULL DEFAULT '',
  `Rateval` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `IP_Address` varchar(50) NOT NULL DEFAULT '',
  `Keyword` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Rating`
--

CREATE TABLE IF NOT EXISTS `Rating` (
  `id` bigint(20) NOT NULL,
  `ip` varchar(25) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `dat` date DEFAULT NULL,
  `rateval` int(11) DEFAULT NULL,
  `Keyword` varchar(20) NOT NULL DEFAULT '',
  `Email` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rbl_creditcard`
--

CREATE TABLE IF NOT EXISTS `rbl_creditcard` (
  `rblccid` int(11) NOT NULL,
  `cc_requestID` int(11) NOT NULL,
  `AppliedCC` varchar(50) NOT NULL,
  `Gender` tinyint(4) NOT NULL,
  `Qualification` smallint(6) NOT NULL,
  `ResCity` varchar(30) NOT NULL,
  `ResiPin` int(11) NOT NULL,
  `Resiaddress1` varchar(255) NOT NULL,
  `Resiaddress2` varchar(255) NOT NULL,
  `Phoneno` varchar(30) NOT NULL,
  `EmploymentType` tinyint(4) NOT NULL,
  `EmployerName` varchar(255) NOT NULL,
  `Designation` varchar(100) NOT NULL,
  `CompanyType` smallint(6) NOT NULL,
  `SalaryAcc` varchar(50) NOT NULL,
  `Panno` varchar(100) NOT NULL,
  `IncomeProof` smallint(6) NOT NULL,
  `IncomeProofval` varchar(100) NOT NULL,
  `ExistingCCNo` varchar(200) NOT NULL,
  `CCCreditLimit` varchar(100) NOT NULL,
  `CardSince` date NOT NULL,
  `RBLcustomer` varchar(10) NOT NULL,
  `Dated` datetime NOT NULL,
  `Status` varchar(10) NOT NULL,
  `ReferenceCode` varchar(20) NOT NULL,
  `Errorcode` varchar(20) NOT NULL,
  `Errorinfo` varchar(50) NOT NULL,
  `RequestIP` varchar(50) NOT NULL,
  `rblappointment_date` date NOT NULL,
  `rblappointment_time` varchar(50) NOT NULL,
  `rblappointment_place` varchar(50) NOT NULL,
  `rblappointment_address` text NOT NULL,
  `rbldocuments` text NOT NULL,
  `autoflag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `redupmtion_channel`
--

CREATE TABLE IF NOT EXISTS `redupmtion_channel` (
  `r_id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL DEFAULT '',
  `card_name` varchar(100) NOT NULL DEFAULT '',
  `card_type` varchar(25) NOT NULL DEFAULT '',
  `pointsrequired` int(11) NOT NULL DEFAULT '0',
  `brand_name` varchar(250) NOT NULL DEFAULT '',
  `worth` varchar(255) NOT NULL DEFAULT '',
  `pointspay` varchar(80) NOT NULL DEFAULT '',
  `category` varchar(255) NOT NULL DEFAULT '',
  `item_code` varchar(50) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Register_Rating`
--

CREATE TABLE IF NOT EXISTS `Register_Rating` (
  `RatingID` int(11) NOT NULL,
  `Rating_Name` varchar(50) NOT NULL DEFAULT '',
  `Rating_Email` varchar(50) NOT NULL DEFAULT '',
  `Rating_City` varchar(20) NOT NULL DEFAULT '',
  `Rating_Net_Salary` varchar(50) NOT NULL DEFAULT '',
  `Rating_Contact` varchar(20) NOT NULL DEFAULT '',
  `Rating_DOB` varchar(20) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Replies`
--

CREATE TABLE IF NOT EXISTS `Replies` (
  `ReplyID` int(10) unsigned NOT NULL,
  `RequestID` int(10) unsigned NOT NULL DEFAULT '0',
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `BidderID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequenceID` int(10) unsigned NOT NULL DEFAULT '0',
  `PostedBy` tinyint(1) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Message` text NOT NULL,
  `Other_Comments` text NOT NULL,
  `Rate` varchar(10) NOT NULL DEFAULT '',
  `EMI` varchar(10) NOT NULL DEFAULT '',
  `Tenure` varchar(10) NOT NULL DEFAULT '',
  `smsreply` varchar(160) DEFAULT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Replies1`
--

CREATE TABLE IF NOT EXISTS `Replies1` (
  `ReplyID` int(10) unsigned NOT NULL,
  `RequestID` int(10) unsigned NOT NULL DEFAULT '0',
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `BidderID` int(10) unsigned NOT NULL DEFAULT '0',
  `SequenceID` int(10) unsigned NOT NULL DEFAULT '0',
  `PostedBy` tinyint(1) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Message` text NOT NULL,
  `Other_Comments` text NOT NULL,
  `Rate` varchar(10) NOT NULL DEFAULT '',
  `EMI` varchar(10) NOT NULL DEFAULT '',
  `Tenure` varchar(10) NOT NULL DEFAULT '',
  `smsreply` varchar(160) DEFAULT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Agent`
--

CREATE TABLE IF NOT EXISTS `Req_Agent` (
  `A_ID` int(10) NOT NULL,
  `A_Name` varchar(100) NOT NULL DEFAULT '',
  `A_Email` varchar(100) NOT NULL DEFAULT '',
  `A_City` varchar(100) NOT NULL DEFAULT '',
  `A_City_Other` varchar(100) NOT NULL DEFAULT '',
  `A_Mobile` bigint(10) NOT NULL DEFAULT '0',
  `A_Product` varchar(200) NOT NULL DEFAULT '',
  `A_Company` varchar(100) NOT NULL DEFAULT '',
  `A_Query_Type` tinyint(4) NOT NULL DEFAULT '0',
  `A_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `A_Feedback` varchar(200) NOT NULL DEFAULT '',
  `A_FollowupDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `A_Comment` varchar(200) NOT NULL DEFAULT '',
  `pwd` varchar(40) NOT NULL,
  `Address` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Agent_Pay`
--

CREATE TABLE IF NOT EXISTS `Req_Agent_Pay` (
  `A_ID` int(10) NOT NULL,
  `A_Name` varchar(100) NOT NULL DEFAULT '',
  `A_Email` varchar(100) NOT NULL DEFAULT '',
  `A_City` varchar(100) NOT NULL DEFAULT '',
  `A_City_Other` varchar(100) NOT NULL DEFAULT '',
  `A_Mobile` bigint(10) NOT NULL DEFAULT '0',
  `A_Product` varchar(200) NOT NULL DEFAULT '',
  `A_Company` varchar(100) NOT NULL DEFAULT '',
  `A_Query_Type` tinyint(4) NOT NULL DEFAULT '0',
  `A_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `A_Feedback` varchar(200) NOT NULL DEFAULT '',
  `A_FollowupDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `A_Comment` varchar(200) NOT NULL DEFAULT '',
  `pwd` varchar(40) NOT NULL,
  `Address` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Apply_Here`
--

CREATE TABLE IF NOT EXISTS `Req_Apply_Here` (
  `ApplyID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Contact` bigint(11) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Product_Type` varchar(50) DEFAULT NULL,
  `Referred_Page` varchar(50) NOT NULL DEFAULT '',
  `Source` varchar(100) DEFAULT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Bajaj_HomenBT`
--

CREATE TABLE IF NOT EXISTS `Req_Bajaj_HomenBT` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Property_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Property_Value` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Property_Identified` tinyint(4) DEFAULT '0',
  `Property_Loc` varchar(50) DEFAULT NULL,
  `source` varchar(250) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Existing_Bank` varchar(20) NOT NULL,
  `Existing_ROI` varchar(20) NOT NULL,
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` text NOT NULL,
  `Allocated` tinyint(4) NOT NULL,
  `BidderID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `req_barclays_lead`
--

CREATE TABLE IF NOT EXISTS `req_barclays_lead` (
  `RequestID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(100) NOT NULL DEFAULT '',
  `middle_name` varchar(100) NOT NULL DEFAULT '',
  `last_name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(120) NOT NULL DEFAULT '',
  `Phone` bigint(20) NOT NULL DEFAULT '0',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Residence_Type` varchar(20) NOT NULL DEFAULT '',
  `Gender` varchar(6) NOT NULL DEFAULT '',
  `City` varchar(80) NOT NULL DEFAULT '',
  `City_Other` varchar(80) NOT NULL DEFAULT '',
  `Employement_Type` varchar(30) NOT NULL DEFAULT '',
  `Monthly_Salary` int(11) NOT NULL DEFAULT '0',
  `Last_Applied` varchar(50) NOT NULL DEFAULT '',
  `Credit_Card` varchar(20) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Source` varchar(100) NOT NULL DEFAULT '',
  `pancard` varchar(10) NOT NULL DEFAULT '',
  `Loan_Any` varchar(200) NOT NULL DEFAULT '',
  `EMI_Paid` varchar(200) NOT NULL DEFAULT '',
  `address` text NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `address3` text NOT NULL,
  `pincode` int(11) NOT NULL DEFAULT '0',
  `designation` varchar(190) NOT NULL DEFAULT '',
  `salary_mode` varchar(50) NOT NULL DEFAULT '',
  `eligible` varchar(50) NOT NULL DEFAULT '',
  `valid_pan` char(2) NOT NULL DEFAULT '',
  `cc_bank_name` varchar(255) NOT NULL DEFAULT '',
  `cc_bank_time` varchar(250) NOT NULL DEFAULT '',
  `cc_bank_limit` varchar(250) NOT NULL DEFAULT '',
  `work_email` varchar(120) NOT NULL DEFAULT '',
  `std_code` int(11) NOT NULL DEFAULT '0',
  `landline_no` bigint(20) NOT NULL DEFAULT '0',
  `cc_default` varchar(8) NOT NULL DEFAULT '',
  `identity_proof` varchar(255) NOT NULL DEFAULT '',
  `address_proof` varchar(255) NOT NULL DEFAULT '',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `send_mail` char(2) NOT NULL DEFAULT '',
  `Reference_Code` varchar(4) NOT NULL DEFAULT '0',
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `app_code` varchar(12) NOT NULL DEFAULT '',
  `card_number` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Business_Loan`
--

CREATE TABLE IF NOT EXISTS `Req_Business_Loan` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `DOB` varchar(50) DEFAULT NULL,
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code` int(10) NOT NULL DEFAULT '0',
  `Landline` varchar(20) NOT NULL DEFAULT '',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Industry` varchar(250) NOT NULL DEFAULT '',
  `Constitution` varchar(250) NOT NULL DEFAULT '',
  `Year_Of_Establishment` varchar(200) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `CC_Holder` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Vintage` varchar(100) DEFAULT NULL,
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `CC_Bank` varchar(200) DEFAULT NULL,
  `EMI_Paid` varchar(200) DEFAULT NULL,
  `Loan_Any` varchar(200) DEFAULT NULL,
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(50) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Bidder_Count` int(11) DEFAULT '0',
  `Bidderid_Details` varchar(150) NOT NULL DEFAULT '',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `Experience` varchar(200) NOT NULL DEFAULT '',
  `Residential_Status` tinyint(4) NOT NULL DEFAULT '0',
  `Office_Status` tinyint(4) NOT NULL DEFAULT '0',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_CC_ivr`
--

CREATE TABLE IF NOT EXISTS `Req_CC_ivr` (
  `RequestID` int(10) unsigned NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Phone` varchar(50) DEFAULT NULL,
  `Employement_Status` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Source` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `Product_Type` int(11) NOT NULL DEFAULT '0',
  `Feedback` varchar(100) NOT NULL DEFAULT '',
  `Allocated` tinyint(4) NOT NULL DEFAULT '0',
  `TimeSlab` varchar(50) NOT NULL DEFAULT '',
  `CallonDay` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Compaign`
--

CREATE TABLE IF NOT EXISTS `Req_Compaign` (
  `Compaign_ID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Bank_Name` varchar(50) NOT NULL DEFAULT '',
  `RequestID` int(20) DEFAULT NULL,
  `BidderID` int(10) NOT NULL DEFAULT '0',
  `Start_Date` date NOT NULL DEFAULT '0000-00-00',
  `City_Wise` varchar(255) NOT NULL DEFAULT '',
  `Sms_Flag` int(4) NOT NULL DEFAULT '0',
  `Mobile_no` varchar(50) NOT NULL DEFAULT '',
  `Sequence_no` tinyint(4) NOT NULL DEFAULT '0',
  `priority` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Compaign_Property`
--

CREATE TABLE IF NOT EXISTS `Req_Compaign_Property` (
  `Compaign_ID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Bank_Name` varchar(50) NOT NULL DEFAULT '',
  `RequestID` int(20) DEFAULT NULL,
  `BidderID` int(10) NOT NULL DEFAULT '0',
  `Start_Date` date NOT NULL DEFAULT '0000-00-00',
  `City_Wise` varchar(255) NOT NULL DEFAULT '',
  `Sms_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `Mobile_no` varchar(50) NOT NULL DEFAULT '',
  `Sequence_no` tinyint(4) NOT NULL DEFAULT '0',
  `priority` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Credit_Card`
--

CREATE TABLE IF NOT EXISTS `Req_Credit_Card` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Gender` varchar(10) NOT NULL,
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `State` varchar(50) NOT NULL,
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Company_HDFC_Cat` tinyint(4) NOT NULL DEFAULT '0',
  `Company_ICICI_Cat` tinyint(4) NOT NULL,
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `CC_Holder` tinyint(4) DEFAULT '0',
  `Descr` varchar(100) DEFAULT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(250) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Pancard` varchar(25) NOT NULL DEFAULT '',
  `Pancard_No` varchar(50) DEFAULT NULL,
  `No_of_Banks` varchar(200) NOT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Ibibo_compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) DEFAULT '0',
  `Applied_With_Banks` varchar(250) DEFAULT NULL,
  `Resi_Address` varchar(255) NOT NULL,
  `Offi_Address` varchar(255) NOT NULL,
  `Residence_Address` varchar(255) NOT NULL DEFAULT '',
  `Office_Address` varchar(255) DEFAULT NULL,
  `Office_City` varchar(50) NOT NULL,
  `Credit_Limit` tinyint(1) DEFAULT '0',
  `Bidder_Count` int(11) NOT NULL DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(150) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'DOE -> It is not updated',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `already_applied` varchar(10) NOT NULL DEFAULT '',
  `applied_card_name` text NOT NULL,
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Edelweiss_Compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Cpp_Compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Loan_Amount` decimal(10,0) NOT NULL DEFAULT '0',
  `Account_No` varchar(100) NOT NULL DEFAULT '',
  `Existing_Relationship` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Relationship_ICICI` tinyint(4) NOT NULL,
  `Loan_No` varchar(100) NOT NULL DEFAULT '',
  `Eligible_Card_Option` varchar(200) NOT NULL DEFAULT '',
  `ABMMU_flag` tinyint(4) NOT NULL,
  `Salary_Account` varchar(150) NOT NULL,
  `Privacy` varchar(3) NOT NULL,
  `rbl_flag` tinyint(4) NOT NULL,
  `cards_flag` tinyint(4) NOT NULL,
  `form_step` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `req_credit_card1`
--

CREATE TABLE IF NOT EXISTS `req_credit_card1` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Descr` varchar(50) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Credit_Card_Bankwise`
--

CREATE TABLE IF NOT EXISTS `Req_Credit_Card_Bankwise` (
  `bankreqid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `Pancard` varchar(50) DEFAULT NULL,
  `Loan_Amount` decimal(12,2) DEFAULT NULL,
  `Company_Name` varchar(200) DEFAULT NULL,
  `Residence_Address` text,
  `Office_Address` text,
  `Gross_Monthly_Salary` decimal(12,2) NOT NULL,
  `Net_Monthly_Salary` decimal(12,2) NOT NULL,
  `Bank_Name` varchar(100) DEFAULT NULL,
  `dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Credit_Card_Sms`
--

CREATE TABLE IF NOT EXISTS `Req_Credit_Card_Sms` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Gender` varchar(10) NOT NULL,
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `State` varchar(50) NOT NULL,
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Company_HDFC_Cat` tinyint(4) NOT NULL DEFAULT '0',
  `Company_ICICI_Cat` tinyint(4) NOT NULL,
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `CC_Holder` tinyint(4) DEFAULT '0',
  `Descr` varchar(100) DEFAULT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(250) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Pancard` varchar(25) NOT NULL DEFAULT '',
  `Pancard_No` varchar(50) DEFAULT NULL,
  `No_of_Banks` varchar(200) NOT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Ibibo_compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) DEFAULT '0',
  `Applied_With_Banks` varchar(250) DEFAULT NULL,
  `Residence_Address` varchar(255) NOT NULL DEFAULT '',
  `Office_Address` varchar(255) DEFAULT NULL,
  `Credit_Limit` tinyint(1) DEFAULT '0',
  `Bidder_Count` int(11) NOT NULL DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(150) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `already_applied` varchar(10) NOT NULL DEFAULT '',
  `applied_card_name` text NOT NULL,
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Edelweiss_Compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Cpp_Compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Loan_Amount` decimal(10,0) NOT NULL DEFAULT '0',
  `Account_No` varchar(100) NOT NULL DEFAULT '',
  `Existing_Relationship` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Relationship_ICICI` tinyint(4) NOT NULL,
  `Loan_No` varchar(100) NOT NULL DEFAULT '',
  `Eligible_Card_Option` varchar(200) NOT NULL DEFAULT '',
  `ABMMU_flag` tinyint(4) NOT NULL,
  `Salary_Account` varchar(150) NOT NULL,
  `Privacy` varchar(3) NOT NULL,
  `rbl_flag` tinyint(4) NOT NULL,
  `cards_flag` tinyint(4) NOT NULL,
  `Feedback` varchar(150) NOT NULL,
  `Old_Feedback` varchar(50) DEFAULT NULL,
  `Followup_Date` datetime NOT NULL,
  `AgentID` int(11) NOT NULL,
  `comment_section` varchar(255) NOT NULL,
  `not_contactable_counter` int(11) NOT NULL,
  `sendnow_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Credit_Sudhaar`
--

CREATE TABLE IF NOT EXISTS `Req_Credit_Sudhaar` (
  `ReqID` int(11) NOT NULL,
  `Name` varchar(130) NOT NULL,
  `Mobile` bigint(20) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `City` varchar(100) NOT NULL,
  `Message` text NOT NULL,
  `Source` varchar(40) NOT NULL,
  `IP` varchar(16) NOT NULL,
  `Dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Crossword`
--

CREATE TABLE IF NOT EXISTS `Req_Crossword` (
  `CrosswordID` int(11) NOT NULL,
  `Crossword_Name` varchar(20) NOT NULL DEFAULT '',
  `Crossword_Rows` varchar(10) NOT NULL DEFAULT '',
  `Crossword_Cols` varchar(10) NOT NULL DEFAULT '',
  `Crossword_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `Crossword_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Crossword_Position` text NOT NULL,
  `Crossword_Values` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Dialer_Records`
--

CREATE TABLE IF NOT EXISTS `Req_Dialer_Records` (
  `id` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `RequestID` bigint(20) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `Feedback` varchar(50) NOT NULL,
  `Dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Dialer_Records_CC`
--

CREATE TABLE IF NOT EXISTS `Req_Dialer_Records_CC` (
  `id` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `RequestID` bigint(20) NOT NULL,
  `DialerID` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `Feedback` varchar(50) NOT NULL,
  `Dated` datetime NOT NULL,
  `AgentID` int(11) NOT NULL,
  `AgentName` varchar(70) NOT NULL,
  `DialerFeedback` varchar(50) NOT NULL,
  `FollowupDate` datetime NOT NULL,
  `lead_track` varchar(30) NOT NULL,
  `dialer_camp_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Dialer_Records_HL`
--

CREATE TABLE IF NOT EXISTS `Req_Dialer_Records_HL` (
  `id` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `RequestID` bigint(20) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `Feedback` varchar(50) NOT NULL,
  `Dated` datetime NOT NULL,
  `DialerFeedback` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Dialer_Records_PL`
--

CREATE TABLE IF NOT EXISTS `Req_Dialer_Records_PL` (
  `id` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `RequestID` bigint(20) NOT NULL,
  `DialerID` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `Feedback` varchar(50) NOT NULL,
  `Dated` datetime NOT NULL,
  `AgentID` int(11) NOT NULL,
  `AgentName` varchar(70) NOT NULL,
  `DialerFeedback` varchar(50) NOT NULL,
  `FollowupDate` datetime NOT NULL,
  `lead_track` varchar(30) NOT NULL,
  `dialer_camp_id` int(11) NOT NULL,
  `dialler_process` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Dialer_Records_PL_090917_backup`
--

CREATE TABLE IF NOT EXISTS `Req_Dialer_Records_PL_090917_backup` (
  `id` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `RequestID` bigint(20) NOT NULL,
  `DialerID` int(11) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `Feedback` varchar(50) NOT NULL,
  `Dated` datetime NOT NULL,
  `AgentID` int(11) NOT NULL,
  `AgentName` varchar(70) NOT NULL,
  `DialerFeedback` varchar(50) NOT NULL,
  `FollowupDate` datetime NOT NULL,
  `lead_track` varchar(30) NOT NULL,
  `dialer_camp_id` int(11) NOT NULL,
  `dialler_process` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Dialler_Report`
--

CREATE TABLE IF NOT EXISTS `Req_Dialler_Report` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `LeadID` varchar(50) DEFAULT NULL COMMENT 'Dialler ID',
  `AgentID` int(11) DEFAULT NULL,
  `Agent_Name` varchar(50) DEFAULT NULL,
  `CampaignID` varchar(50) DEFAULT NULL,
  `ListID` varchar(11) DEFAULT NULL,
  `Phone` bigint(20) DEFAULT NULL,
  `Disposition` varchar(80) DEFAULT NULL,
  `DOE` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `DOE_String` varchar(25) DEFAULT NULL,
  `url_data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_EBBusiness_Leads`
--

CREATE TABLE IF NOT EXISTS `Req_EBBusiness_Leads` (
  `ebleadid` int(11) NOT NULL,
  `eb_name` varchar(100) NOT NULL,
  `eb_email` varchar(100) NOT NULL,
  `eb_mobile_number` bigint(20) NOT NULL,
  `eb_city` varchar(50) NOT NULL,
  `eb_dob` date NOT NULL,
  `eb_company_name` varchar(200) NOT NULL,
  `eb_net_salary` decimal(12,2) NOT NULL,
  `eb_loan_amount` decimal(12,2) NOT NULL,
  `eb_bank_name` varchar(20) NOT NULL,
  `eb_roi` decimal(2,2) NOT NULL,
  `eb_tenure` mediumint(9) NOT NULL,
  `eb_emi` decimal(12,2) NOT NULL,
  `eb_existing_loan` varchar(255) NOT NULL,
  `eb_source` varchar(20) NOT NULL,
  `eb_dated` datetime NOT NULL,
  `date_of_crosscheck` datetime NOT NULL,
  `eb_feedback` varchar(200) NOT NULL,
  `eb_remarks` varchar(200) NOT NULL,
  `followup_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(100) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `smstext` text NOT NULL,
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `emailtext` text NOT NULL,
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_BCalling`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_BCalling` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` date NOT NULL DEFAULT '0000-00-00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT '',
  `Caller_Name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Allocated_BidderID` varchar(100) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` tinyint(2) DEFAULT NULL,
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Total_Cost` int(11) NOT NULL DEFAULT '0',
  `Loan_Disbursed` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder1`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder1` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` tinyint(4) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder1_new`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder1_new` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` tinyint(4) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder_CC`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder_CC` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` tinyint(4) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder_CC1`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder_CC1` (
  `Feedback_ID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `Allocated` tinyint(4) NOT NULL,
  `Allocation_Date` datetime NOT NULL,
  `Consent` tinyint(4) NOT NULL DEFAULT '1',
  `Consent_Date` datetime NOT NULL,
  `final_allocate` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder_CL`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder_CL` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` tinyint(4) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder_CL1`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder_CL1` (
  `Feedback_ID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `Allocated` tinyint(4) NOT NULL,
  `Allocation_Date` datetime NOT NULL,
  `Consent` tinyint(4) NOT NULL DEFAULT '1',
  `Consent_Date` datetime NOT NULL,
  `final_allocate` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder_HL`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder_HL` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` tinyint(4) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder_HL1`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder_HL1` (
  `Feedback_ID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `Allocated` tinyint(4) NOT NULL,
  `Allocation_Date` datetime NOT NULL,
  `Consent` tinyint(4) NOT NULL DEFAULT '1',
  `Consent_Date` datetime NOT NULL,
  `final_allocate` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder_LAP`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder_LAP` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` tinyint(4) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder_LAP1`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder_LAP1` (
  `Feedback_ID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `Allocated` tinyint(4) NOT NULL,
  `Allocation_Date` datetime NOT NULL,
  `Consent` tinyint(4) NOT NULL DEFAULT '1',
  `Consent_Date` datetime NOT NULL,
  `final_allocate` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder_PL`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder_PL` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` tinyint(4) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Bidder_PL1`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Bidder_PL1` (
  `Feedback_ID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `Allocated` tinyint(4) NOT NULL,
  `Allocation_Date` datetime NOT NULL,
  `Consent` tinyint(4) NOT NULL DEFAULT '1',
  `Consent_Date` datetime NOT NULL,
  `final_allocate` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_CC`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_CC` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `file_stat` tinyint(4) NOT NULL,
  `last_updated` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_CL`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_CL` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` date NOT NULL DEFAULT '0000-00-00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Comments_PL`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Comments_PL` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` tinyint(4) NOT NULL DEFAULT '0',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Comments` text NOT NULL,
  `Feedback` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_HL`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_HL` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime NOT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `smstext` text NOT NULL,
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `emailtext` text NOT NULL,
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT '',
  `Caller_Name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_HL_16april15`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_HL_16april15` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` date NOT NULL DEFAULT '0000-00-00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT '',
  `Caller_Name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_ICICI_CC`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_ICICI_CC` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `file_stat` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_LAP`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_LAP` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` date NOT NULL DEFAULT '0000-00-00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT '',
  `Caller_Name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_MF`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_MF` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` date NOT NULL DEFAULT '0000-00-00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT '',
  `Caller_Name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_new`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_new` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` date NOT NULL DEFAULT '0000-00-00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_PL`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_PL` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT '',
  `Caller_Name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_PLSW`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_PLSW` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Allocted_BidderID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `email_sent` tinyint(4) NOT NULL,
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `last_update_dated` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_PL_16april15`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_PL_16april15` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` date NOT NULL DEFAULT '0000-00-00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT '',
  `Caller_Name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_PL_25jan2017`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_PL_25jan2017` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` date NOT NULL DEFAULT '0000-00-00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT '',
  `Caller_Name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Property`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Property` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Feedback_Travel`
--

CREATE TABLE IF NOT EXISTS `Req_Feedback_Travel` (
  `FeedbackID` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL DEFAULT '0',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback` varchar(50) NOT NULL DEFAULT '',
  `Followup_Date` datetime DEFAULT NULL,
  `SmsSent` tinyint(4) NOT NULL DEFAULT '0',
  `SentEmail` tinyint(4) NOT NULL DEFAULT '0',
  `comment_section` text NOT NULL,
  `not_contactable_counter` int(10) NOT NULL DEFAULT '0',
  `flag` tinyint(4) NOT NULL DEFAULT '0',
  `updated_flag` tinyint(4) NOT NULL DEFAULT '0',
  `eligible` tinyint(4) NOT NULL DEFAULT '0',
  `interest_stat` tinyint(4) NOT NULL DEFAULT '0',
  `post_login_stat` varchar(100) NOT NULL DEFAULT '',
  `last_update_dated` date NOT NULL DEFAULT '0000-00-00',
  `axis_executive_name` varchar(100) NOT NULL DEFAULT '',
  `Caller_Name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `req_hdfc_lead`
--

CREATE TABLE IF NOT EXISTS `req_hdfc_lead` (
  `RequestID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(120) NOT NULL DEFAULT '',
  `Phone` bigint(20) NOT NULL DEFAULT '0',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Residence_Type` varchar(20) NOT NULL DEFAULT '',
  `Gender` varchar(6) NOT NULL DEFAULT '',
  `City` varchar(80) NOT NULL DEFAULT '',
  `City_Other` varchar(80) NOT NULL DEFAULT '',
  `Employement_Type` varchar(30) NOT NULL DEFAULT '',
  `Monthly_Salary` int(11) NOT NULL DEFAULT '0',
  `Last_Applied` varchar(50) NOT NULL DEFAULT '',
  `HDFC_Account` varchar(30) NOT NULL DEFAULT '',
  `Credit_Card` varchar(20) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Source` varchar(100) NOT NULL DEFAULT '',
  `pancard` varchar(10) NOT NULL DEFAULT '',
  `address` text NOT NULL,
  `pincode` int(11) NOT NULL DEFAULT '0',
  `designation` varchar(190) NOT NULL DEFAULT '',
  `salary_mode` varchar(50) NOT NULL DEFAULT '',
  `eligible` varchar(50) NOT NULL DEFAULT '',
  `valid_pan` char(2) NOT NULL DEFAULT '',
  `cc_bank_name` varchar(255) NOT NULL DEFAULT '',
  `cc_bank_time` varchar(250) NOT NULL DEFAULT '',
  `cc_bank_limit` varchar(250) NOT NULL DEFAULT '',
  `work_email` varchar(120) NOT NULL DEFAULT '',
  `std_code` int(11) NOT NULL DEFAULT '0',
  `landline_no` bigint(20) NOT NULL DEFAULT '0',
  `cc_default` varchar(8) NOT NULL DEFAULT '',
  `identity_proof` varchar(255) NOT NULL DEFAULT '',
  `address_proof` varchar(255) NOT NULL DEFAULT '',
  `company_name` varchar(255) NOT NULL DEFAULT '',
  `send_mail` char(2) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Incomplete_Lead`
--

CREATE TABLE IF NOT EXISTS `Req_Incomplete_Lead` (
  `IncompeletID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(200) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(20) NOT NULL DEFAULT '0',
  `City` varchar(100) NOT NULL DEFAULT '',
  `Product_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Insurance_Lead`
--

CREATE TABLE IF NOT EXISTS `Req_Insurance_Lead` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Gender` char(1) NOT NULL DEFAULT '',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `No_of_dependents` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Annual_Income` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Plan_Interested` char(1) NOT NULL DEFAULT '0',
  `Pincode` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(15) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `ProductID` tinyint(4) NOT NULL DEFAULT '0',
  `TataID` int(11) NOT NULL DEFAULT '0',
  `Renewal_Date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Investment`
--

CREATE TABLE IF NOT EXISTS `Req_Investment` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Period` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Insurance_Linked` tinyint(1) NOT NULL DEFAULT '0',
  `Investment_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_lead_trans`
--

CREATE TABLE IF NOT EXISTS `Req_lead_trans` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `LnsID` int(11) NOT NULL,
  `Duplicate` varchar(11) NOT NULL,
  `Product_Name` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Life_Insurance`
--

CREATE TABLE IF NOT EXISTS `Req_Life_Insurance` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Gender` char(1) NOT NULL DEFAULT '',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `No_of_dependents` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Annual_Income` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Plan_Interested` char(1) NOT NULL DEFAULT '0',
  `Pincode` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(4) NOT NULL DEFAULT '0',
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(15) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `ProductID` tinyint(4) NOT NULL DEFAULT '0',
  `TataID` int(11) NOT NULL DEFAULT '0',
  `Renewal_Date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Against_Property`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Against_Property` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Property_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Property_Value` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(250) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Holder` tinyint(4) DEFAULT NULL,
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Any_Surrogate` tinyint(4) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Count` int(11) DEFAULT '0',
  `Bidderid_Details` varchar(150) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `Add_Comment` varchar(200) NOT NULL DEFAULT '',
  `Property_Loc` varchar(200) NOT NULL DEFAULT '',
  `Edelweiss_Compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Cpp_Compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Ibibo_compaign` tinyint(4) NOT NULL DEFAULT '0',
  `sms_not_got` varchar(20) NOT NULL DEFAULT 'Received',
  `ABMMU_flag` tinyint(4) NOT NULL,
  `Privacy` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `req_loan_against_property1`
--

CREATE TABLE IF NOT EXISTS `req_loan_against_property1` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Property_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Property_Value` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Against_Property_Bankwise`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Against_Property_Bankwise` (
  `bankreqid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `Pancard` varchar(50) DEFAULT NULL,
  `Loan_Amount` decimal(12,2) DEFAULT NULL,
  `Company_Name` varchar(200) DEFAULT NULL,
  `Residence_Address` text,
  `Office_Address` text,
  `Gross_Monthly_Salary` decimal(12,2) NOT NULL,
  `Net_Monthly_Salary` decimal(12,2) NOT NULL,
  `Bank_Name` varchar(100) DEFAULT NULL,
  `dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Against_Property_ED`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Against_Property_ED` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Emp_Status` varchar(6) NOT NULL,
  `Owner_Property` tinyint(4) NOT NULL,
  `Urgency_Loan` tinyint(4) NOT NULL,
  `PL_Details` varchar(255) NOT NULL,
  `HL_Details` varchar(255) NOT NULL,
  `CL_Details` varchar(255) NOT NULL,
  `BL_Details` varchar(255) NOT NULL,
  `LAP_Details` varchar(255) NOT NULL,
  `CC_Details` varchar(255) NOT NULL,
  `ITR_filing` tinyint(4) NOT NULL,
  `ITR_Details` tinyint(4) NOT NULL,
  `reflecting_income` tinyint(4) NOT NULL,
  `residence_address` varchar(255) NOT NULL,
  `office_address` varchar(255) NOT NULL,
  `IncorporationDate` date NOT NULL,
  `Property_Type` varchar(20) NOT NULL,
  `vat` varchar(40) NOT NULL,
  `map_available` tinyint(4) NOT NULL,
  `Property_Size` tinyint(4) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `Company_Type` tinyint(4) NOT NULL,
  `allocated_to_banks` varchar(60) NOT NULL,
  `Holding_Current_Account` tinyint(4) NOT NULL,
  `Annual_Turnover` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Bike`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Bike` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Account_No` varchar(20) NOT NULL DEFAULT '',
  `Primary_Acc` varchar(20) NOT NULL DEFAULT '',
  `Bike_Make` varchar(100) NOT NULL,
  `Bike_Model` varchar(250) NOT NULL,
  `Bike_Varient` varchar(200) NOT NULL,
  `Bike_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Bike_Booked` tinyint(4) NOT NULL DEFAULT '0',
  `Loan_Tenure` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` varchar(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(250) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Holder` tinyint(4) DEFAULT NULL,
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Office_address` varchar(255) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `Bidder_Count` int(11) DEFAULT '0',
  `Bidderid_Details` varchar(150) NOT NULL DEFAULT '',
  `Car_Insurance` text NOT NULL,
  `CL_Bank` varchar(255) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Cpp_Compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Ibibo_compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Relation` tinyint(4) NOT NULL,
  `Delivery_Date` varchar(50) NOT NULL,
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(3) NOT NULL,
  `Residence_Status` int(11) NOT NULL,
  `Residence_Stability` int(11) NOT NULL,
  `Total_Experience` int(11) NOT NULL,
  `reward_selected` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Business_ED`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Business_ED` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Emp_Status` varchar(20) NOT NULL,
  `Owner_Property` tinyint(4) NOT NULL,
  `Urgency_Loan` tinyint(4) NOT NULL,
  `PL_Details` varchar(255) NOT NULL,
  `HL_Details` varchar(255) NOT NULL,
  `CL_Details` varchar(255) NOT NULL,
  `BL_Details` varchar(255) NOT NULL,
  `LAP_Details` varchar(255) NOT NULL,
  `CC_Details` varchar(255) NOT NULL,
  `ITR_Details` tinyint(4) NOT NULL,
  `reflecting_income` tinyint(4) NOT NULL,
  `Holding_Bank_Account` tinyint(4) NOT NULL,
  `BankAccount` varchar(10) NOT NULL,
  `Office_Property` varchar(10) NOT NULL,
  `RegistrationProof` tinyint(4) NOT NULL,
  `VintageRegistration` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Car`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Car` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Gender` tinyint(4) NOT NULL,
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Account_No` varchar(20) NOT NULL DEFAULT '',
  `Primary_Acc` varchar(20) NOT NULL DEFAULT '',
  `Car_Make` varchar(100) NOT NULL DEFAULT '',
  `Car_Model` varchar(250) NOT NULL DEFAULT '',
  `Car_Varient` varchar(200) NOT NULL DEFAULT '',
  `Car_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Car_Booked` tinyint(4) NOT NULL DEFAULT '0',
  `Loan_Tenure` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` varchar(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(250) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Holder` tinyint(4) DEFAULT NULL,
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Office_address` varchar(255) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `Bidder_Count` int(11) DEFAULT '0',
  `Bidderid_Details` varchar(150) NOT NULL DEFAULT '',
  `Car_Insurance` text NOT NULL,
  `CL_Bank` varchar(255) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Cpp_Compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Ibibo_compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Relation` tinyint(4) NOT NULL,
  `Delivery_Date` varchar(50) NOT NULL,
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(3) NOT NULL,
  `Residence_Status` int(11) NOT NULL,
  `Residence_Stability` int(11) NOT NULL,
  `Total_Experience` int(11) NOT NULL,
  `reward_selected` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `req_loan_car1`
--

CREATE TABLE IF NOT EXISTS `req_loan_car1` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Car_Make` varchar(100) NOT NULL DEFAULT '',
  `Car_Model` varchar(250) NOT NULL DEFAULT '',
  `Car_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Tenure` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Car_Bankwise`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Car_Bankwise` (
  `bankreqid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `Pancard` varchar(50) DEFAULT NULL,
  `Loan_Amount` decimal(12,2) DEFAULT NULL,
  `Company_Name` varchar(200) DEFAULT NULL,
  `Residence_Address` text,
  `Office_Address` text,
  `Gross_Monthly_Salary` decimal(12,2) NOT NULL,
  `Net_Monthly_Salary` decimal(12,2) NOT NULL,
  `Bank_Name` varchar(100) DEFAULT NULL,
  `dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Car_BK1`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Car_BK1` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Account_No` varchar(20) NOT NULL DEFAULT '',
  `Primary_Acc` varchar(20) NOT NULL DEFAULT '',
  `Car_Make` varchar(100) NOT NULL DEFAULT '',
  `Car_Model` varchar(250) NOT NULL DEFAULT '',
  `Car_Varient` varchar(200) NOT NULL DEFAULT '',
  `Car_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Car_Booked` tinyint(4) NOT NULL DEFAULT '0',
  `Loan_Tenure` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` varchar(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(250) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Holder` tinyint(4) DEFAULT NULL,
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Office_address` varchar(255) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `Bidder_Count` int(11) DEFAULT '0',
  `Bidderid_Details` varchar(150) NOT NULL DEFAULT '',
  `Car_Insurance` text NOT NULL,
  `CL_Bank` varchar(255) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Cpp_Compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Ibibo_compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Relation` tinyint(4) NOT NULL,
  `Delivery_Date` varchar(50) NOT NULL,
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(3) NOT NULL,
  `Residence_Status` int(11) NOT NULL,
  `Residence_Stability` int(11) NOT NULL,
  `Total_Experience` int(11) NOT NULL,
  `reward_selected` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Education`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Education` (
  `RequestID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(100) NOT NULL DEFAULT '',
  `Mobile_Number` bigint(20) NOT NULL DEFAULT '0',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Gender` varchar(10) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(4) NOT NULL,
  `Net_Salary` decimal(12,2) NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `Residence_City` varchar(50) NOT NULL DEFAULT '',
  `Residence_City_Other` varchar(100) NOT NULL DEFAULT '',
  `Country` varchar(50) NOT NULL DEFAULT '',
  `Coborrower_Income` decimal(12,2) NOT NULL,
  `Course` varchar(50) NOT NULL DEFAULT '',
  `Course_Name` varchar(255) NOT NULL,
  `Collateral_Security` varchar(10) NOT NULL DEFAULT '0',
  `IP_Address` varchar(50) NOT NULL DEFAULT '',
  `source` varchar(50) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Reference_Code` varchar(4) NOT NULL DEFAULT '',
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Allocated` tinyint(2) NOT NULL,
  `Bidderid_Details` varchar(200) NOT NULL,
  `Bidder_Count` int(11) NOT NULL,
  `hdfc_credila` tinyint(4) NOT NULL,
  `Privacy` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Gold`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Gold` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(4) NOT NULL,
  `Bidder_Count` int(11) DEFAULT '0',
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Cpp_Compaign` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Home`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Home` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Property_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Property_Value` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Property_Identified` tinyint(4) DEFAULT '0',
  `Property_Loc` varchar(50) DEFAULT NULL,
  `Clubbed_Income` varchar(15) DEFAULT NULL,
  `Loan_Disbursement_Period` tinyint(4) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `Is_Permit` tinyint(4) DEFAULT NULL,
  `Pancard` varchar(25) DEFAULT NULL,
  `CL_Tenure` varchar(15) DEFAULT NULL,
  `Edelweiss_Compaign` tinyint(4) DEFAULT '0',
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `CC_Bank` varchar(100) DEFAULT NULL,
  `source` varchar(250) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Referrer` varchar(250) DEFAULT NULL,
  `Creative` varchar(200) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Budget` varchar(100) DEFAULT NULL,
  `Loan_Time` varchar(50) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Flag` tinyint(4) DEFAULT '0',
  `Bidder_Count` int(11) DEFAULT '0',
  `Bidderid_Details` varchar(255) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` text NOT NULL,
  `Email_Sent` tinyint(4) NOT NULL DEFAULT '0',
  `Sms_Sent` tinyint(4) NOT NULL DEFAULT '0',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `alternate_number` bigint(20) NOT NULL,
  `Hl_mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `Co_Applicant_Name` varchar(100) NOT NULL DEFAULT '',
  `Co_Applicant_DOB` varchar(200) NOT NULL DEFAULT '',
  `Co_Applicant_Income` varchar(100) NOT NULL DEFAULT '',
  `Co_Applicant_Obligation` varchar(100) NOT NULL DEFAULT '',
  `Total_Obligation` varchar(100) NOT NULL DEFAULT '',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Bank` varchar(150) NOT NULL DEFAULT '',
  `Existing_Loan` int(11) NOT NULL DEFAULT '0',
  `Existing_ROI` varchar(10) NOT NULL DEFAULT '',
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(3) NOT NULL,
  `wishfin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Home1`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Home1` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Property_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Property_Value` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `source` varchar(50) NOT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Updated_Date` datetime NOT NULL,
  `Property_Identified` tinyint(4) DEFAULT NULL,
  `Property_Loc` varchar(50) DEFAULT NULL,
  `Clubbed_Income` varchar(15) DEFAULT NULL,
  `Loan_Disbursement_Period` tinyint(4) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `CL_EMI_Amt` varchar(15) DEFAULT NULL,
  `CL_Bank` varchar(25) DEFAULT NULL,
  `CL_Tenure` varchar(15) DEFAULT NULL,
  `CL_EMI_Paid` varchar(15) DEFAULT NULL,
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(25) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `CC_Holder` tinyint(4) DEFAULT NULL,
  `CC_Bank` varchar(100) DEFAULT NULL,
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Home_16april15`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Home_16april15` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Property_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Property_Value` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Property_Identified` tinyint(4) DEFAULT '0',
  `Property_Loc` varchar(50) DEFAULT NULL,
  `Clubbed_Income` varchar(15) DEFAULT NULL,
  `Loan_Disbursement_Period` tinyint(4) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `Is_Permit` tinyint(4) DEFAULT NULL,
  `CL_Bank` varchar(25) DEFAULT NULL,
  `CL_Tenure` varchar(15) DEFAULT NULL,
  `Edelweiss_Compaign` tinyint(4) DEFAULT '0',
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `CC_Holder` tinyint(4) DEFAULT NULL,
  `CC_Bank` varchar(100) DEFAULT NULL,
  `source` varchar(250) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(200) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Budget` varchar(100) DEFAULT NULL,
  `Loan_Time` varchar(50) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Flag` tinyint(4) DEFAULT '0',
  `Bidder_Count` int(11) DEFAULT '0',
  `Bidderid_Details` varchar(255) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` text NOT NULL,
  `Email_Sent` tinyint(4) NOT NULL DEFAULT '0',
  `Sms_Sent` tinyint(4) NOT NULL DEFAULT '0',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Hl_mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `Co_Applicant_Name` varchar(100) NOT NULL DEFAULT '',
  `Co_Applicant_DOB` varchar(200) NOT NULL DEFAULT '',
  `Co_Applicant_Income` varchar(100) NOT NULL DEFAULT '',
  `Co_Applicant_Obligation` varchar(100) NOT NULL DEFAULT '',
  `Total_Obligation` varchar(100) NOT NULL DEFAULT '',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Bank` varchar(150) NOT NULL DEFAULT '',
  `Existing_Loan` int(11) NOT NULL DEFAULT '0',
  `Existing_ROI` varchar(10) NOT NULL DEFAULT '',
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Home_Bankwise`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Home_Bankwise` (
  `bankreqid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `Pancard` varchar(50) DEFAULT NULL,
  `Loan_Amount` decimal(12,2) DEFAULT NULL,
  `Company_Name` varchar(200) DEFAULT NULL,
  `Residence_Address` text,
  `Office_Address` text,
  `Gross_Monthly_Salary` decimal(12,2) NOT NULL,
  `Net_Monthly_Salary` decimal(12,2) NOT NULL,
  `Bank_Name` varchar(100) DEFAULT NULL,
  `dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Home_Extrafields`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Home_Extrafields` (
  `RequestID` int(10) unsigned NOT NULL,
  `HL_RequestID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Property_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Property_Value` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Property_Identified` tinyint(4) DEFAULT '0',
  `Property_Loc` varchar(50) DEFAULT NULL,
  `Pancard` varchar(25) DEFAULT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `source` varchar(250) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Residence_State` varchar(50) NOT NULL,
  `Add_Comment` text NOT NULL,
  `Co_Applicant_Name` varchar(100) NOT NULL DEFAULT '',
  `Co_Applicant_DOB` varchar(200) NOT NULL DEFAULT '',
  `Co_Applicant_Income` varchar(100) NOT NULL DEFAULT '',
  `Co_Applicant_Obligation` varchar(100) NOT NULL DEFAULT '',
  `Total_Obligation` varchar(100) NOT NULL DEFAULT '',
  `Existing_Bank` varchar(150) NOT NULL DEFAULT '',
  `Existing_Loan` int(11) NOT NULL DEFAULT '0',
  `Existing_ROI` varchar(10) NOT NULL DEFAULT '',
  `Bank_Name` varchar(50) NOT NULL,
  `Disposition` varchar(100) NOT NULL,
  `Followup_Date` datetime NOT NULL,
  `Dated` datetime NOT NULL,
  `Updated_Date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `last_updated` datetime NOT NULL,
  `sendnow_flag` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Home_test`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Home_test` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Total_Experience` decimal(4,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Property_Type` tinyint(1) NOT NULL DEFAULT '0',
  `Property_Value` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Descr` text NOT NULL,
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Property_Identified` tinyint(4) DEFAULT '0',
  `Property_Loc` varchar(50) DEFAULT NULL,
  `Clubbed_Income` varchar(15) DEFAULT NULL,
  `Loan_Disbursement_Period` tinyint(4) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `Is_Permit` tinyint(4) DEFAULT NULL,
  `CL_Bank` varchar(25) DEFAULT NULL,
  `CL_Tenure` varchar(15) DEFAULT NULL,
  `Edelweiss_Compaign` tinyint(4) DEFAULT '0',
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `CC_Holder` tinyint(4) DEFAULT NULL,
  `CC_Bank` varchar(100) DEFAULT NULL,
  `source` varchar(250) DEFAULT NULL,
  `Marital_Status` char(1) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(100) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Budget` varchar(100) DEFAULT NULL,
  `Loan_Time` varchar(50) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Flag` tinyint(4) DEFAULT '0',
  `Bidder_Count` int(11) DEFAULT '0',
  `Bidderid_Details` varchar(255) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` text NOT NULL,
  `Email_Sent` tinyint(4) NOT NULL DEFAULT '0',
  `Sms_Sent` tinyint(4) NOT NULL DEFAULT '0',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Hl_mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `Co_Applicant_Name` varchar(100) NOT NULL DEFAULT '',
  `Co_Applicant_DOB` varchar(200) NOT NULL DEFAULT '',
  `Co_Applicant_Income` varchar(100) NOT NULL DEFAULT '',
  `Co_Applicant_Obligation` varchar(100) NOT NULL DEFAULT '',
  `Total_Obligation` varchar(100) NOT NULL DEFAULT '',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `Existing_Bank` varchar(150) NOT NULL DEFAULT '',
  `Existing_Loan` int(11) NOT NULL DEFAULT '0',
  `Existing_ROI` varchar(10) NOT NULL DEFAULT '',
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Personal`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Personal` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `full_name` varchar(150) DEFAULT NULL,
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` varchar(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(200) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `Barclays_Eligibility` varchar(255) DEFAULT NULL,
  `Citibank_Eligibility` varchar(255) DEFAULT NULL,
  `Hdfc_Eligibility` varchar(255) DEFAULT NULL,
  `Cpp_Compaign` tinyint(4) DEFAULT NULL,
  `Is_Permit` tinyint(4) NOT NULL DEFAULT '0',
  `HL_Bank` varchar(25) DEFAULT NULL,
  `Direct_Allocation` tinyint(4) NOT NULL DEFAULT '0',
  `Edelweiss_Compaign` tinyint(4) DEFAULT '0',
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `Life_Insurance` tinyint(4) DEFAULT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(250) DEFAULT NULL,
  `Creative` varchar(200) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Bidder_Flag` int(11) DEFAULT NULL,
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Count` int(11) DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Mobile_Connection` tinyint(4) NOT NULL DEFAULT '0',
  `Landline_connection` tinyint(4) NOT NULL DEFAULT '0',
  `Salary_Drawn` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Contactable` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `identification_proof` varchar(255) NOT NULL DEFAULT '',
  `residence_proof` varchar(255) NOT NULL DEFAULT '',
  `income_proof` varchar(255) NOT NULL DEFAULT '',
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `upload_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `ex_source` varchar(15) NOT NULL,
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(5) NOT NULL,
  `panel` varchar(50) NOT NULL,
  `Existing_Bank` varchar(150) NOT NULL,
  `Existing_Loan` decimal(12,2) NOT NULL,
  `Existing_ROI` varchar(10) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `Cibilscore` int(11) NOT NULL,
  `Cibilok` tinyint(4) NOT NULL,
  `Holding_Current_Account` tinyint(4) NOT NULL DEFAULT '0',
  `wishfin_id` int(11) NOT NULL,
  `company_category` varchar(50) NOT NULL,
  `tu_status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Personal1`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Personal1` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `DOB` date NOT NULL,
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` tinyint(1) NOT NULL DEFAULT '0',
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `source` varchar(50) NOT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(100) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `CL_EMI_Amt` varchar(15) DEFAULT NULL,
  `CL_Bank` varchar(25) DEFAULT NULL,
  `CL_Tenure` varchar(15) DEFAULT NULL,
  `CL_EMI_Paid` varchar(15) DEFAULT NULL,
  `HL_EMI_Amt` varchar(15) DEFAULT NULL,
  `HL_Bank` varchar(25) DEFAULT NULL,
  `HL_Tenure` varchar(15) DEFAULT NULL,
  `HL_EMI_Paid` varchar(15) DEFAULT NULL,
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(25) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `Life_Insurance` tinyint(4) DEFAULT NULL,
  `Insureance_Period` tinyint(4) DEFAULT NULL,
  `Updated_Date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Personal_16april15`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Personal_16april15` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` varchar(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(200) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `Barclays_Eligibility` varchar(255) DEFAULT NULL,
  `Citibank_Eligibility` varchar(255) DEFAULT NULL,
  `Hdfc_Eligibility` varchar(255) DEFAULT NULL,
  `Cpp_Compaign` tinyint(4) DEFAULT NULL,
  `Is_Permit` tinyint(4) NOT NULL DEFAULT '0',
  `HL_Bank` varchar(25) DEFAULT NULL,
  `Direct_Allocation` tinyint(4) NOT NULL DEFAULT '0',
  `Edelweiss_Compaign` tinyint(4) DEFAULT '0',
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `Life_Insurance` tinyint(4) DEFAULT NULL,
  `Insureance_Period` tinyint(4) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(200) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Bidder_Flag` int(11) DEFAULT NULL,
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Count` int(11) DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Mobile_Connection` tinyint(4) NOT NULL DEFAULT '0',
  `Landline_connection` tinyint(4) NOT NULL DEFAULT '0',
  `Salary_Drawn` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Contactable` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `identification_proof` varchar(255) NOT NULL DEFAULT '',
  `residence_proof` varchar(255) NOT NULL DEFAULT '',
  `income_proof` varchar(255) NOT NULL DEFAULT '',
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `upload_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `ex_source` varchar(15) NOT NULL,
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(5) NOT NULL,
  `panel` varchar(50) NOT NULL,
  `Existing_Bank` varchar(150) NOT NULL,
  `Existing_Loan` decimal(12,2) NOT NULL,
  `Existing_ROI` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Personal_25jan2017`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Personal_25jan2017` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` varchar(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(200) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `Barclays_Eligibility` varchar(255) DEFAULT NULL,
  `Citibank_Eligibility` varchar(255) DEFAULT NULL,
  `Hdfc_Eligibility` varchar(255) DEFAULT NULL,
  `Cpp_Compaign` tinyint(4) DEFAULT NULL,
  `Is_Permit` tinyint(4) NOT NULL DEFAULT '0',
  `HL_Bank` varchar(25) DEFAULT NULL,
  `Direct_Allocation` tinyint(4) NOT NULL DEFAULT '0',
  `Edelweiss_Compaign` tinyint(4) DEFAULT '0',
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `Life_Insurance` tinyint(4) DEFAULT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(250) DEFAULT NULL,
  `Creative` varchar(200) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Bidder_Flag` int(11) DEFAULT NULL,
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Count` int(11) DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Mobile_Connection` tinyint(4) NOT NULL DEFAULT '0',
  `Landline_connection` tinyint(4) NOT NULL DEFAULT '0',
  `Salary_Drawn` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Contactable` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `identification_proof` varchar(255) NOT NULL DEFAULT '',
  `residence_proof` varchar(255) NOT NULL DEFAULT '',
  `income_proof` varchar(255) NOT NULL DEFAULT '',
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `upload_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `ex_source` varchar(15) NOT NULL,
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(5) NOT NULL,
  `panel` varchar(50) NOT NULL,
  `Existing_Bank` varchar(150) NOT NULL,
  `Existing_Loan` decimal(12,2) NOT NULL,
  `Existing_ROI` varchar(10) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `Cibilscore` int(11) NOT NULL,
  `Cibilok` tinyint(4) NOT NULL,
  `Holding_Current_Account` tinyint(4) NOT NULL DEFAULT '0',
  `wishfin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Personal_Bankwise`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Personal_Bankwise` (
  `bankreqid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `Pancard` varchar(50) DEFAULT NULL,
  `Loan_Amount` decimal(12,2) DEFAULT NULL,
  `Company_Name` varchar(200) DEFAULT NULL,
  `Residence_Address` text,
  `Office_Address` text,
  `Gross_Monthly_Salary` decimal(12,2) NOT NULL,
  `Net_Monthly_Salary` decimal(12,2) NOT NULL,
  `Bank_Name` varchar(100) DEFAULT NULL,
  `dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Personal_barclays`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Personal_barclays` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Cpp_Compaign` tinyint(4) DEFAULT NULL,
  `Edelweiss_Compaign` tinyint(4) DEFAULT '0',
  `Life_Insurance` tinyint(4) DEFAULT NULL,
  `Insureance_Period` tinyint(4) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) DEFAULT NULL,
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Count` int(11) DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Contactable` tinyint(2) NOT NULL DEFAULT '0',
  `identification_proof` varchar(255) NOT NULL DEFAULT '',
  `residence_proof` varchar(255) NOT NULL DEFAULT '',
  `income_proof` varchar(255) NOT NULL DEFAULT '',
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Personal_BK1`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Personal_BK1` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` varchar(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(200) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `Barclays_Eligibility` varchar(255) DEFAULT NULL,
  `Citibank_Eligibility` varchar(255) DEFAULT NULL,
  `Hdfc_Eligibility` varchar(255) DEFAULT NULL,
  `Cpp_Compaign` tinyint(4) DEFAULT NULL,
  `Is_Permit` tinyint(4) NOT NULL DEFAULT '0',
  `HL_Bank` varchar(25) DEFAULT NULL,
  `Direct_Allocation` tinyint(4) NOT NULL DEFAULT '0',
  `Edelweiss_Compaign` tinyint(4) DEFAULT '0',
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `Life_Insurance` tinyint(4) DEFAULT NULL,
  `Insureance_Period` tinyint(4) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(200) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Bidder_Flag` int(11) DEFAULT NULL,
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Count` int(11) DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Mobile_Connection` tinyint(4) NOT NULL DEFAULT '0',
  `Landline_connection` tinyint(4) NOT NULL DEFAULT '0',
  `Salary_Drawn` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Contactable` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `identification_proof` varchar(255) NOT NULL DEFAULT '',
  `residence_proof` varchar(255) NOT NULL DEFAULT '',
  `income_proof` varchar(255) NOT NULL DEFAULT '',
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `upload_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `ex_source` varchar(15) NOT NULL,
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(5) NOT NULL,
  `panel` varchar(50) NOT NULL,
  `Existing_Bank` varchar(150) NOT NULL,
  `Existing_Loan` decimal(12,2) NOT NULL,
  `Existing_ROI` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Personal_Extra_Fields`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Personal_Extra_Fields` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Salary` varchar(100) NOT NULL,
  `unsecured_emi` int(11) NOT NULL,
  `secured_emi` int(11) NOT NULL,
  `card_outstanding` int(11) NOT NULL,
  `cibil_reference_id` varchar(32) NOT NULL,
  `obligation_details` varchar(2048) NOT NULL,
  `cc_obligation_details` varchar(2048) NOT NULL,
  `incorporation_date` date NOT NULL,
  `any_loan_running` tinyint(4) NOT NULL,
  `pf_deduction` tinyint(4) NOT NULL,
  `residence_address` varchar(1024) NOT NULL,
  `office_address` varchar(1024) NOT NULL,
  `purpose_of_loan` tinyint(3) unsigned NOT NULL,
  `current_tenure` mediumint(8) unsigned NOT NULL,
  `current_roi` decimal(5,2) unsigned NOT NULL,
  `no_of_emipaid` mediumint(8) unsigned NOT NULL,
  `higher_qualification` varchar(100) DEFAULT NULL,
  `official_email_id` varchar(100) DEFAULT NULL,
  `approved_loan` varchar(15) DEFAULT NULL,
  `SFDC_ID` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Personal_ICICI`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Personal_ICICI` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(255) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `panel` varchar(100) NOT NULL,
  `Existing_Bank` varchar(150) NOT NULL,
  `Existing_Loan` float(12,2) NOT NULL,
  `Existing_ROI` varchar(10) NOT NULL,
  `Existing_EMIPaid` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `allocated_bidderid` varchar(100) NOT NULL,
  `Feedback` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Loan_Share`
--

CREATE TABLE IF NOT EXISTS `Req_Loan_Share` (
  `RequestID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL DEFAULT '0',
  `Name` varchar(80) NOT NULL DEFAULT '',
  `Phone` bigint(20) NOT NULL DEFAULT '0',
  `Email` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(100) NOT NULL DEFAULT '',
  `portfolio` int(11) NOT NULL DEFAULT '0',
  `Loan_Amount` int(11) NOT NULL DEFAULT '0',
  `source` varchar(40) NOT NULL DEFAULT '',
  `creative` varchar(200) NOT NULL DEFAULT '',
  `section` varchar(200) NOT NULL DEFAULT '',
  `IP` varchar(20) NOT NULL DEFAULT '',
  `referrer` varchar(200) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Message`
--

CREATE TABLE IF NOT EXISTS `Req_Message` (
  `PostID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(50) NOT NULL DEFAULT '',
  `Subject` text NOT NULL,
  `Message` text NOT NULL,
  `Product_Type` varchar(100) NOT NULL DEFAULT '',
  `Is_Verified` tinyint(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Mutual_Fund`
--

CREATE TABLE IF NOT EXISTS `Req_Mutual_Fund` (
  `RequestID` int(11) NOT NULL,
  `UserID` int(11) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(120) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '1',
  `Company_Name` varchar(200) NOT NULL DEFAULT '',
  `City` varchar(100) NOT NULL DEFAULT '',
  `City_Other` varchar(100) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(20) DEFAULT NULL,
  `Net_Salary` int(11) NOT NULL DEFAULT '0',
  `Alternate_Number` bigint(20) NOT NULL,
  `MF_Plan` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Residence_Address` varchar(255) NOT NULL DEFAULT '',
  `Residence_Pincode` int(11) NOT NULL DEFAULT '0',
  `Office_Address` varchar(255) NOT NULL DEFAULT '',
  `Office_Pincode` int(11) NOT NULL DEFAULT '0',
  `ekyc_status` tinyint(4) DEFAULT NULL,
  `Contact_Time` varchar(40) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `source` varchar(80) NOT NULL DEFAULT '',
  `IP_Address` varchar(15) NOT NULL DEFAULT '',
  `DOB` date DEFAULT '0000-00-00',
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) NOT NULL DEFAULT '',
  `Is_Valid` tinyint(1) NOT NULL DEFAULT '0',
  `Bidder_Count` varchar(11) NOT NULL DEFAULT '',
  `Bidderid_Details` varchar(255) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Company_Type` varchar(100) NOT NULL DEFAULT '',
  `Pancard` varchar(10) NOT NULL DEFAULT '',
  `wishfin_id` int(11) NOT NULL DEFAULT '0',
  `MF_SIP` tinyint(4) NOT NULL,
  `Trans_Val_SIP` varchar(20) NOT NULL,
  `MF_Lumpsum` tinyint(4) NOT NULL,
  `Trans_Val_Lumpsum` varchar(20) NOT NULL,
  `want_online` tinyint(3) unsigned NOT NULL,
  `is_invest_ready` tinyint(4) NOT NULL,
  `mobile_verified` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Partner`
--

CREATE TABLE IF NOT EXISTS `Req_Partner` (
  `Partner_ID` int(10) NOT NULL,
  `Partner_Username` varchar(60) NOT NULL DEFAULT '',
  `Partner_Password` varchar(50) NOT NULL DEFAULT '',
  `Partner_Name` varchar(100) NOT NULL DEFAULT '',
  `Partner_Email` varchar(100) NOT NULL DEFAULT '',
  `Partner_City` varchar(100) NOT NULL DEFAULT '',
  `Partner_City_Other` varchar(100) NOT NULL DEFAULT '',
  `Partner_Mobile` bigint(10) NOT NULL DEFAULT '0',
  `Partner_Product` varchar(200) NOT NULL DEFAULT '',
  `Partner_Company` varchar(100) NOT NULL DEFAULT '',
  `Partner_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Partner_Comment` varchar(200) NOT NULL DEFAULT '',
  `Partner_Manager_ID` int(11) NOT NULL,
  `Partner_Manager` varchar(50) NOT NULL DEFAULT '',
  `Is_Verified` tinyint(4) NOT NULL DEFAULT '0',
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Partner_PL`
--

CREATE TABLE IF NOT EXISTS `Req_Partner_PL` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` varchar(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(200) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `Barclays_Eligibility` varchar(255) DEFAULT NULL,
  `Citibank_Eligibility` varchar(255) DEFAULT NULL,
  `Hdfc_Eligibility` varchar(255) DEFAULT NULL,
  `Cpp_Compaign` tinyint(4) DEFAULT NULL,
  `Is_Permit` tinyint(4) NOT NULL DEFAULT '0',
  `HL_Bank` varchar(25) DEFAULT NULL,
  `Direct_Allocation` tinyint(4) NOT NULL DEFAULT '0',
  `Edelweiss_Compaign` tinyint(4) DEFAULT '0',
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `Life_Insurance` tinyint(4) DEFAULT NULL,
  `Insureance_Period` tinyint(4) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `Creative` varchar(50) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Bidder_Flag` int(11) DEFAULT NULL,
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Count` int(11) DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Mobile_Connection` tinyint(4) NOT NULL DEFAULT '0',
  `Landline_connection` tinyint(4) NOT NULL DEFAULT '0',
  `Salary_Drawn` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Contactable` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `identification_proof` varchar(255) NOT NULL DEFAULT '',
  `residence_proof` varchar(255) NOT NULL DEFAULT '',
  `income_proof` varchar(255) NOT NULL DEFAULT '',
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `upload_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `ex_source` varchar(15) NOT NULL,
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(5) NOT NULL,
  `Referral_ID` int(11) NOT NULL,
  `Reference_ID` int(11) NOT NULL,
  `Feedback` varchar(255) NOT NULL,
  `Followup_Date` datetime NOT NULL,
  `not_contactable_counter` tinyint(4) NOT NULL,
  `Bank_Approval` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Personal_Loan_ivr`
--

CREATE TABLE IF NOT EXISTS `Req_Personal_Loan_ivr` (
  `RequestID` int(10) unsigned NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Phone` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Source` varchar(50) DEFAULT NULL,
  `Referrer` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `Reference_Code` int(11) NOT NULL DEFAULT '0',
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Product_Type` int(11) NOT NULL DEFAULT '0',
  `Reference` varchar(50) NOT NULL DEFAULT '',
  `Section` varchar(100) NOT NULL DEFAULT '',
  `Incremented_Time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Inserted_By` varchar(50) NOT NULL DEFAULT '',
  `Feedback` varchar(100) NOT NULL DEFAULT '',
  `Feedback_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `req_plcompaign_smscontact`
--

CREATE TABLE IF NOT EXISTS `req_plcompaign_smscontact` (
  `Compaign_ID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Bank_Name` varchar(50) NOT NULL DEFAULT '',
  `RequestID` int(20) DEFAULT NULL,
  `BidderID` int(10) NOT NULL DEFAULT '0',
  `Start_Date` date NOT NULL DEFAULT '0000-00-00',
  `City_Wise` varchar(255) NOT NULL DEFAULT '',
  `Sms_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `Mobile_no` varchar(50) NOT NULL DEFAULT '',
  `Sequence_no` tinyint(4) NOT NULL DEFAULT '0',
  `priority` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_PL_BackCalling`
--

CREATE TABLE IF NOT EXISTS `Req_PL_BackCalling` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '1',
  `Company_Name` varchar(100) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `City_Other` varchar(255) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `Residential_Status` varchar(20) NOT NULL DEFAULT '0',
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) NOT NULL DEFAULT '',
  `EMIAmt` int(11) NOT NULL,
  `CC_Holder` varchar(20) NOT NULL DEFAULT '0',
  `Card_Vintage` varchar(20) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` varchar(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(200) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `Is_Permit` tinyint(4) NOT NULL DEFAULT '0',
  `Direct_Allocation` tinyint(4) NOT NULL DEFAULT '0',
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(250) DEFAULT NULL,
  `Creative` varchar(200) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Bidder_Flag` int(11) DEFAULT NULL,
  `Residence_Address` varchar(250) NOT NULL DEFAULT '',
  `Bidder_Count` int(11) DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(200) NOT NULL DEFAULT '',
  `checked_bidders` varchar(255) NOT NULL DEFAULT '',
  `Salary_Drawn` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) NOT NULL DEFAULT '',
  `Contactable` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `identification_proof` varchar(255) NOT NULL DEFAULT '',
  `residence_proof` varchar(255) NOT NULL DEFAULT '',
  `income_proof` varchar(255) NOT NULL DEFAULT '',
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Company_Type` varchar(20) NOT NULL DEFAULT '0',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `upload_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(5) NOT NULL,
  `panel` varchar(50) NOT NULL,
  `Existing_Bank` varchar(150) NOT NULL,
  `Existing_Loan` decimal(12,2) NOT NULL,
  `Existing_ROI` varchar(10) NOT NULL,
  `Pancard` varchar(10) NOT NULL,
  `Cibilscore` int(11) NOT NULL,
  `Cibilok` tinyint(4) NOT NULL,
  `Holding_Current_Account` tinyint(4) NOT NULL DEFAULT '0',
  `wishfin_id` int(11) NOT NULL,
  `company_category` varchar(50) NOT NULL,
  `ReferenceID` varchar(25) NOT NULL,
  `CRMNumber` varchar(50) NOT NULL,
  `D4lComment` varchar(255) NOT NULL,
  `ExclusiveLead` varchar(200) NOT NULL,
  `CompanyType` varchar(20) NOT NULL,
  `callerid` mediumint(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_PL_ivr`
--

CREATE TABLE IF NOT EXISTS `Req_PL_ivr` (
  `RequestID` int(10) unsigned NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Email` varchar(255) NOT NULL DEFAULT '',
  `City` varchar(255) NOT NULL DEFAULT '',
  `DOB` date NOT NULL DEFAULT '0000-00-00',
  `Phone` varchar(50) DEFAULT NULL,
  `Employement_Status` varchar(50) DEFAULT NULL,
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Source` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `Product_Type` int(11) NOT NULL DEFAULT '0',
  `Feedback` varchar(100) NOT NULL DEFAULT '',
  `Allocated` tinyint(4) NOT NULL DEFAULT '0',
  `TimeSlab` varchar(50) NOT NULL DEFAULT '',
  `CallonDay` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_PL_ivr_Feedback`
--

CREATE TABLE IF NOT EXISTS `Req_PL_ivr_Feedback` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Allocated` tinyint(2) DEFAULT NULL,
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Property_Bidder`
--

CREATE TABLE IF NOT EXISTS `Req_Property_Bidder` (
  `Feedback_ID` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `PropertyID` int(11) NOT NULL,
  `Allocated` tinyint(4) NOT NULL DEFAULT '1',
  `Allocation_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `Req_Quick_201601`
--
CREATE TABLE IF NOT EXISTS `Req_Quick_201601` (
`TOTALLEADS` int(5)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `Req_Quick_201602`
--
CREATE TABLE IF NOT EXISTS `Req_Quick_201602` (
`TOTALLEADS` int(5)
);

-- --------------------------------------------------------

--
-- Table structure for table `Req_Quick_Leads`
--

CREATE TABLE IF NOT EXISTS `Req_Quick_Leads` (
  `quickleadid` int(11) NOT NULL,
  `lead_count` int(11) NOT NULL,
  `product_type` varchar(20) NOT NULL,
  `lead_month` int(11) NOT NULL,
  `lead_year` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `req_reply_message`
--

CREATE TABLE IF NOT EXISTS `req_reply_message` (
  `Reply_ID` int(10) NOT NULL,
  `PostID` int(10) NOT NULL DEFAULT '0',
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(50) NOT NULL DEFAULT '',
  `Subject` text NOT NULL,
  `Message` text NOT NULL,
  `Is_Verified` tinyint(5) DEFAULT '0',
  `IP_Address` varchar(15) NOT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Sms_Delivery`
--

CREATE TABLE IF NOT EXISTS `Req_Sms_Delivery` (
  `Reqsmsid` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `RequestID` bigint(20) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `City_Wise` varchar(50) NOT NULL,
  `Sms_Dated` datetime NOT NULL,
  `smsflag` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_User_Update`
--

CREATE TABLE IF NOT EXISTS `Req_User_Update` (
  `RUU_ID` int(10) NOT NULL,
  `RUU_Name` varchar(100) NOT NULL DEFAULT '',
  `RUU_Email` varchar(100) NOT NULL DEFAULT '',
  `RUU_RequestID` int(10) NOT NULL DEFAULT '0',
  `RUU_Product` varchar(100) NOT NULL DEFAULT '',
  `RUU_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `RUU_Pancard` varchar(18) NOT NULL DEFAULT '',
  `RUU_Phone` bigint(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Req_Win_Cash`
--

CREATE TABLE IF NOT EXISTS `Req_Win_Cash` (
  `Cash_ID` int(10) NOT NULL,
  `Email` varchar(255) NOT NULL DEFAULT '',
  `Customer_Name` varchar(100) DEFAULT NULL,
  `Contact_No` varchar(50) DEFAULT NULL,
  `Bank_Name` varchar(255) NOT NULL DEFAULT '',
  `Loan_Amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `Product_Type` varchar(100) NOT NULL DEFAULT '',
  `Month` varchar(100) NOT NULL DEFAULT '',
  `Year` varchar(100) NOT NULL DEFAULT '',
  `Descr` text NOT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restrictIPAddr`
--

CREATE TABLE IF NOT EXISTS `restrictIPAddr` (
  `id` int(11) NOT NULL,
  `IP_Address` varchar(15) NOT NULL,
  `Dated` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `Page_Name` varchar(250) NOT NULL,
  `Query` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rm_detail_fullerton`
--

CREATE TABLE IF NOT EXISTS `rm_detail_fullerton` (
  `id` int(11) NOT NULL,
  `rm_name` varchar(100) NOT NULL DEFAULT '',
  `rm_contact` varchar(44) NOT NULL DEFAULT '0',
  `rm_email` varchar(120) NOT NULL DEFAULT '',
  `rm_email_cc` varchar(110) NOT NULL DEFAULT '',
  `rm_city` varchar(60) NOT NULL DEFAULT '',
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `RM_List`
--

CREATE TABLE IF NOT EXISTS `RM_List` (
  `BD_ID` int(11) NOT NULL,
  `BD_Name` varchar(80) NOT NULL DEFAULT '',
  `BD_Manager` varchar(80) NOT NULL DEFAULT '',
  `BD_Number` bigint(20) NOT NULL DEFAULT '0',
  `BD_Email` varchar(100) NOT NULL DEFAULT '',
  `BD_pwd` varchar(32) NOT NULL,
  `dated` datetime NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saveemicalc_tbl`
--

CREATE TABLE IF NOT EXISTS `saveemicalc_tbl` (
  `saveemiid` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Mobile_No` bigint(20) NOT NULL,
  `Net_Salary` decimal(12,2) NOT NULL,
  `DOB` date NOT NULL,
  `Employment_Status` tinyint(4) NOT NULL,
  `Loan_Amount` decimal(12,2) NOT NULL,
  `City` varchar(150) NOT NULL,
  `City_Other` varchar(150) NOT NULL,
  `Company_Name` varchar(200) NOT NULL,
  `Total_Experience` decimal(5,2) NOT NULL,
  `Years_In_Company` decimal(5,2) NOT NULL,
  `CC_Holder` tinyint(4) NOT NULL,
  `Card_Vintage` tinyint(4) NOT NULL,
  `CC_Age` tinyint(4) NOT NULL,
  `EMI_Paid` varchar(50) NOT NULL,
  `Primary_Acc` varchar(50) NOT NULL,
  `unique_code` int(11) NOT NULL,
  `Is_Valid` tinyint(4) NOT NULL,
  `dated` datetime NOT NULL,
  `flag_plbt` tinyint(4) NOT NULL,
  `flag_hlbt` tinyint(4) NOT NULL,
  `flag_ccot` tinyint(4) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `Allocate` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saveemicalc_tbl_hl`
--

CREATE TABLE IF NOT EXISTS `saveemicalc_tbl_hl` (
  `saveemiidhl` int(11) NOT NULL,
  `saveemiid` int(11) NOT NULL,
  `Net_Salary` decimal(12,2) NOT NULL,
  `DOB` date NOT NULL,
  `Employment_Status` tinyint(4) NOT NULL,
  `City` varchar(150) NOT NULL,
  `City_Other` varchar(150) NOT NULL,
  `Loan_Amount` decimal(12,2) NOT NULL,
  `existing_bank_hl` varchar(50) NOT NULL,
  `existing_la_hl` decimal(12,2) NOT NULL,
  `existing_tenure_hl` smallint(6) NOT NULL,
  `existing_prepay_hl` varchar(20) NOT NULL,
  `existing_roi_hl` varchar(20) NOT NULL,
  `existing_noofemi_hl` smallint(6) NOT NULL,
  `EMI_Paid` tinyint(4) NOT NULL,
  `Property_Identified` tinyint(4) NOT NULL DEFAULT '1',
  `Property_Loc` varchar(50) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saveemicalc_tbl_pl`
--

CREATE TABLE IF NOT EXISTS `saveemicalc_tbl_pl` (
  `saveemiidpl` int(11) NOT NULL,
  `Net_Salary` decimal(12,2) NOT NULL,
  `DOB` date NOT NULL,
  `Employment_Status` tinyint(4) NOT NULL,
  `Loan_Amount` decimal(12,2) NOT NULL,
  `City` varchar(150) NOT NULL,
  `City_Other` varchar(150) NOT NULL,
  `Total_Experience` decimal(5,0) NOT NULL,
  `Years_In_Company` decimal(5,2) NOT NULL,
  `CC_Holder` tinyint(4) NOT NULL,
  `Card_Vintage` tinyint(4) NOT NULL,
  `existing_bank_pl` varchar(50) NOT NULL,
  `existing_la_pl` decimal(12,2) NOT NULL,
  `existing_roi_pl` varchar(20) NOT NULL,
  `existing_noofemi_pl` smallint(6) NOT NULL,
  `EMI_Paid` tinyint(4) NOT NULL,
  `existing_tenure_pl` mediumint(9) NOT NULL,
  `existing_prepay_pl` varchar(20) NOT NULL,
  `CC_Age` tinyint(4) NOT NULL,
  `dated` datetime NOT NULL,
  `saveemiid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saveemicalc_tbl_quotes`
--

CREATE TABLE IF NOT EXISTS `saveemicalc_tbl_quotes` (
  `quotetblid` int(11) NOT NULL,
  `saveemiid` int(11) NOT NULL,
  `quote_type` varchar(50) NOT NULL,
  `bank_name` varchar(20) NOT NULL,
  `loan_amount` decimal(12,2) NOT NULL,
  `interest_rate` decimal(5,2) NOT NULL,
  `emi_amount` varchar(10) NOT NULL,
  `term_period` varchar(10) NOT NULL,
  `processing_fee` varchar(15) NOT NULL,
  `total_saving` varchar(50) NOT NULL,
  `Bidders_idlist` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saveemicalc_tbl_showquotes`
--

CREATE TABLE IF NOT EXISTS `saveemicalc_tbl_showquotes` (
  `showquoteid` int(11) NOT NULL,
  `saveemiid` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `interest_rate` varchar(50) NOT NULL,
  `loan_amount` decimal(12,2) NOT NULL,
  `new_emi` varchar(50) NOT NULL,
  `tenure` varchar(20) NOT NULL,
  `processing_fee` varchar(20) NOT NULL,
  `total_saving` varchar(200) NOT NULL,
  `product_details` varchar(50) NOT NULL,
  `dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbicard_decline_code`
--

CREATE TABLE IF NOT EXISTS `sbicard_decline_code` (
  `id` int(10) unsigned NOT NULL,
  `decline_code` varchar(10) DEFAULT NULL,
  `resourcing_tat` varchar(50) DEFAULT NULL,
  `resourcing_days` mediumint(8) unsigned NOT NULL,
  `dated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbihl_6168_asmlist`
--

CREATE TABLE IF NOT EXISTS `sbihl_6168_asmlist` (
  `sbiasmid` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `asm_name` varchar(50) NOT NULL,
  `asm_code` mediumint(8) unsigned NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `bidderid` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_ccoffers_directonsite`
--

CREATE TABLE IF NOT EXISTS `sbi_ccoffers_directonsite` (
  `sbiccoffersid` int(11) NOT NULL,
  `sbicc_name` varchar(50) NOT NULL,
  `sbicc_dob` date NOT NULL,
  `sbicc_email` varchar(100) NOT NULL,
  `sbicc_mobile` bigint(20) NOT NULL,
  `sbicc_occupation` tinyint(4) NOT NULL,
  `sbicc_net_salary` decimal(12,2) NOT NULL,
  `sbicc_city` varchar(50) NOT NULL,
  `sbicc_company_name` text,
  `sbicc_std_code` varchar(10) DEFAULT NULL,
  `sbicc_landline` varchar(20) DEFAULT NULL,
  `sbicc_postpaidmobile` bigint(20) unsigned NOT NULL,
  `sbicc_gender` varchar(10) DEFAULT NULL,
  `sbicc_residence_address` varchar(250) DEFAULT NULL,
  `sbicc_state` varchar(50) DEFAULT NULL,
  `sbicc_pancard` varchar(25) DEFAULT NULL,
  `sbicc_pincode` varchar(50) DEFAULT NULL,
  `sbicc_product` tinyint(4) NOT NULL,
  `sbicc_requestid` int(11) NOT NULL,
  `sbicc_dated` datetime NOT NULL,
  `lms_comment` varchar(255) NOT NULL,
  `lms_feedback` varchar(100) NOT NULL,
  `lms_followup_date` datetime NOT NULL,
  `lms_last_updated` date NOT NULL,
  `CallerID` int(11) NOT NULL,
  `sendnow_date` datetime NOT NULL,
  `IP_Address` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_cc_city_state_list`
--

CREATE TABLE IF NOT EXISTS `sbi_cc_city_state_list` (
  `id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `city` varchar(150) NOT NULL,
  `cityalias` varchar(100) NOT NULL,
  `state` varchar(150) NOT NULL,
  `std` int(11) NOT NULL,
  `nrr` varchar(10) NOT NULL,
  `tier` varchar(10) NOT NULL,
  `base_city` varchar(20) NOT NULL,
  `source_code` varchar(20) NOT NULL,
  `eapply_city` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_cc_company_list`
--

CREATE TABLE IF NOT EXISTS `sbi_cc_company_list` (
  `sbicompid` int(11) NOT NULL,
  `sbi_companyname` text NOT NULL,
  `sbi_exact_companyname` text NOT NULL,
  `sbi_category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_cc_company_list_10112017`
--

CREATE TABLE IF NOT EXISTS `sbi_cc_company_list_10112017` (
  `sbicompid` int(11) NOT NULL,
  `sbi_companyname` text NOT NULL,
  `sbi_exact_companyname` text NOT NULL,
  `sbi_category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_cc_company_list_old`
--

CREATE TABLE IF NOT EXISTS `sbi_cc_company_list_old` (
  `sbicompid` int(11) NOT NULL,
  `sbi_companyname` text NOT NULL,
  `sbi_category` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_cc_designation`
--

CREATE TABLE IF NOT EXISTS `sbi_cc_designation` (
  `sbidesgid` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_checks_errorlog`
--

CREATE TABLE IF NOT EXISTS `sbi_checks_errorlog` (
  `logid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `productflag` tinyint(4) NOT NULL,
  `Mobile` varchar(20) NOT NULL,
  `Pancard` varchar(20) NOT NULL,
  `StepNumber` varchar(20) NOT NULL,
  `PageUrl` varchar(255) NOT NULL,
  `Dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_credit_card_5633`
--

CREATE TABLE IF NOT EXISTS `sbi_credit_card_5633` (
  `sbiccid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Postpaid_Mobile` bigint(20) NOT NULL,
  `CompanyName` text NOT NULL,
  `ResidenceAddress1` varchar(255) DEFAULT NULL,
  `ResidenceAddress2` varchar(255) DEFAULT NULL,
  `ResidenceAddress3` varchar(255) DEFAULT NULL,
  `OfficeAddress1` varchar(255) DEFAULT NULL,
  `OfficeAddress2` varchar(255) DEFAULT NULL,
  `OfficeAddress3` varchar(200) DEFAULT NULL,
  `OfficePin` mediumint(9) DEFAULT NULL,
  `TypeOfLandline` varchar(50) DEFAULT NULL,
  `OfficeCity` varchar(20) DEFAULT NULL,
  `LandlineNo` varchar(50) DEFAULT NULL,
  `OfficeState` varchar(10) DEFAULT NULL,
  `Qualification` varchar(50) DEFAULT NULL,
  `Designation` varchar(100) NOT NULL,
  `CardName` varchar(50) DEFAULT NULL,
  `bank_name` varchar(10) NOT NULL,
  `relationship_type` varchar(4) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `sbi_cc_holder` varchar(4) NOT NULL,
  `applied_in_6_months` varchar(4) NOT NULL,
  `resiaddress_document_status` varchar(4) NOT NULL,
  `Dated` datetime NOT NULL,
  `LeadRefNumber` varchar(20) DEFAULT NULL,
  `ApplicationNumber` varchar(20) DEFAULT NULL,
  `StatusCode` varchar(20) DEFAULT NULL,
  `ProcessingStatus` int(11) DEFAULT NULL,
  `CreditLimit` int(11) DEFAULT NULL,
  `Messages` text,
  `webservice_flag` tinyint(4) NOT NULL COMMENT '0 - not initiated, 1 - initiated, 2 - got response',
  `request_xml` text NOT NULL,
  `request_dated` datetime NOT NULL,
  `response_xml` text NOT NULL,
  `response_dated` datetime NOT NULL,
  `first_dated` datetime NOT NULL,
  `first_dated_old` datetime NOT NULL,
  `pushflag` tinyint(4) NOT NULL,
  `secondpushflag` tinyint(4) NOT NULL,
  `repushflag` tinyint(4) NOT NULL,
  `productflag` tinyint(4) NOT NULL,
  `process_type` varchar(10) NOT NULL DEFAULT '',
  `process_track` int(11) NOT NULL DEFAULT '0' COMMENT '1-Preferred LMS',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request2_xml` text NOT NULL,
  `response2_xml` text NOT NULL,
  `ApplicationNumber_2` varchar(20) NOT NULL,
  `StatusCode_2` varchar(20) NOT NULL,
  `ProcessingStatus_2` mediumint(9) NOT NULL,
  `Messages_2` varchar(255) NOT NULL,
  `code_2` varchar(20) NOT NULL,
  `message_2` varchar(255) NOT NULL,
  `second_other` varchar(255) NOT NULL,
  `appointment_datetime` datetime NOT NULL,
  `appointment_address` tinyint(1) NOT NULL COMMENT '1->ResidenceAddress, 2->OfficeAddress',
  `second_dated` datetime NOT NULL,
  `request3_xml` text NOT NULL,
  `response3_xml` text NOT NULL,
  `ApplicationNumber_3` varchar(20) NOT NULL,
  `LeadRefNo_3` varchar(20) NOT NULL,
  `Status_3` varchar(20) NOT NULL,
  `StatusDesc_3` varchar(50) NOT NULL,
  `ApplicationState_3` varchar(50) NOT NULL,
  `CreditLimit_3` decimal(12,2) NOT NULL,
  `DecisionCode` varchar(100) NOT NULL,
  `message_3` varchar(255) NOT NULL,
  `third_other` text NOT NULL,
  `third_dated` datetime NOT NULL,
  `table_name` varchar(30) NOT NULL,
  `Pan_card` varchar(10) NOT NULL,
  `MobileNumber` bigint(20) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `Sms_RequestID` int(11) NOT NULL,
  `manipulated_lead` int(11) NOT NULL COMMENT 'Leads for which we applied productflag=4. 1- not punched, 2 punched',
  `doc_email_status` tinyint(1) NOT NULL DEFAULT '0',
  `noresponse_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 --> Not Available for Punching, 1--> Available for punching'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_credit_card_5633_07112017`
--

CREATE TABLE IF NOT EXISTS `sbi_credit_card_5633_07112017` (
  `sbiccid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Postpaid_Mobile` bigint(20) NOT NULL,
  `CompanyName` text NOT NULL,
  `ResidenceAddress1` varchar(255) DEFAULT NULL,
  `ResidenceAddress2` varchar(255) DEFAULT NULL,
  `ResidenceAddress3` varchar(255) DEFAULT NULL,
  `OfficeAddress1` varchar(255) DEFAULT NULL,
  `OfficeAddress2` varchar(255) DEFAULT NULL,
  `OfficeAddress3` varchar(200) DEFAULT NULL,
  `OfficePin` mediumint(9) DEFAULT NULL,
  `TypeOfLandline` varchar(50) DEFAULT NULL,
  `OfficeCity` varchar(20) DEFAULT NULL,
  `LandlineNo` varchar(50) DEFAULT NULL,
  `OfficeState` varchar(10) DEFAULT NULL,
  `Qualification` varchar(50) DEFAULT NULL,
  `Designation` varchar(100) NOT NULL,
  `CardName` varchar(50) DEFAULT NULL,
  `bank_name` varchar(10) NOT NULL,
  `relationship_type` varchar(4) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `sbi_cc_holder` varchar(4) NOT NULL,
  `applied_in_6_months` varchar(4) NOT NULL,
  `resiaddress_document_status` varchar(4) NOT NULL,
  `Dated` datetime NOT NULL,
  `LeadRefNumber` varchar(20) DEFAULT NULL,
  `ApplicationNumber` varchar(20) DEFAULT NULL,
  `StatusCode` varchar(20) DEFAULT NULL,
  `ProcessingStatus` int(11) DEFAULT NULL,
  `CreditLimit` int(11) DEFAULT NULL,
  `Messages` text,
  `webservice_flag` tinyint(4) NOT NULL COMMENT '0 - not initiated, 1 - initiated, 2 - got response',
  `request_xml` text NOT NULL,
  `response_xml` text NOT NULL,
  `first_dated` datetime NOT NULL,
  `pushflag` tinyint(4) NOT NULL,
  `secondpushflag` tinyint(4) NOT NULL,
  `repushflag` tinyint(4) NOT NULL,
  `productflag` tinyint(4) NOT NULL,
  `process_type` varchar(10) NOT NULL DEFAULT '',
  `process_track` int(11) NOT NULL DEFAULT '0' COMMENT '1-Preferred LMS',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request2_xml` text NOT NULL,
  `response2_xml` text NOT NULL,
  `ApplicationNumber_2` varchar(20) NOT NULL,
  `StatusCode_2` varchar(20) NOT NULL,
  `ProcessingStatus_2` mediumint(9) NOT NULL,
  `Messages_2` varchar(255) NOT NULL,
  `code_2` varchar(20) NOT NULL,
  `message_2` varchar(255) NOT NULL,
  `second_other` varchar(255) NOT NULL,
  `appointment_datetime` datetime NOT NULL,
  `appointment_address` tinyint(1) NOT NULL COMMENT '1->ResidenceAddress, 2->OfficeAddress',
  `second_dated` datetime NOT NULL,
  `request3_xml` text NOT NULL,
  `response3_xml` text NOT NULL,
  `ApplicationNumber_3` varchar(20) NOT NULL,
  `LeadRefNo_3` varchar(20) NOT NULL,
  `Status_3` varchar(20) NOT NULL,
  `StatusDesc_3` varchar(50) NOT NULL,
  `ApplicationState_3` varchar(50) NOT NULL,
  `CreditLimit_3` decimal(12,2) NOT NULL,
  `DecisionCode` varchar(100) NOT NULL,
  `message_3` varchar(255) NOT NULL,
  `third_other` text NOT NULL,
  `third_dated` datetime NOT NULL,
  `table_name` varchar(30) NOT NULL,
  `Pan_card` varchar(10) NOT NULL,
  `MobileNumber` bigint(20) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `Sms_RequestID` int(11) NOT NULL,
  `manipulated_lead` int(11) NOT NULL COMMENT 'Leads for which we applied productflag=4. 1- not punched, 2 punched',
  `doc_email_status` tinyint(1) NOT NULL DEFAULT '0',
  `noresponse_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 --> Not Available for Punching, 1--> Available for punching'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_credit_card_5633_backup`
--

CREATE TABLE IF NOT EXISTS `sbi_credit_card_5633_backup` (
  `sbiccid` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `Postpaid_Mobile` bigint(20) NOT NULL,
  `CompanyName` text NOT NULL,
  `ResidenceAddress1` varchar(255) DEFAULT NULL,
  `ResidenceAddress2` varchar(255) DEFAULT NULL,
  `ResidenceAddress3` varchar(255) DEFAULT NULL,
  `OfficeAddress1` varchar(255) DEFAULT NULL,
  `OfficeAddress2` varchar(255) DEFAULT NULL,
  `OfficeAddress3` varchar(200) DEFAULT NULL,
  `OfficePin` mediumint(9) DEFAULT NULL,
  `TypeOfLandline` varchar(50) DEFAULT NULL,
  `OfficeCity` varchar(20) DEFAULT NULL,
  `LandlineNo` varchar(50) DEFAULT NULL,
  `OfficeState` varchar(10) DEFAULT NULL,
  `Qualification` varchar(50) DEFAULT NULL,
  `Designation` varchar(100) NOT NULL,
  `CardName` varchar(50) DEFAULT NULL,
  `bank_name` varchar(10) NOT NULL,
  `relationship_type` varchar(4) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `sbi_cc_holder` varchar(4) NOT NULL,
  `applied_in_6_months` varchar(4) NOT NULL,
  `resiaddress_document_status` varchar(4) NOT NULL,
  `Dated` datetime NOT NULL,
  `LeadRefNumber` varchar(20) DEFAULT NULL,
  `ApplicationNumber` varchar(20) DEFAULT NULL,
  `StatusCode` varchar(20) DEFAULT NULL,
  `ProcessingStatus` int(11) DEFAULT NULL,
  `CreditLimit` int(11) DEFAULT NULL,
  `Messages` text,
  `webservice_flag` tinyint(4) NOT NULL COMMENT '0 - not initiated, 1 - initiated, 2 - got response',
  `request_xml` text NOT NULL,
  `request_dated` datetime NOT NULL,
  `response_xml` text NOT NULL,
  `response_dated` datetime NOT NULL,
  `first_dated` datetime NOT NULL,
  `first_dated_old` datetime NOT NULL,
  `pushflag` tinyint(4) NOT NULL,
  `secondpushflag` tinyint(4) NOT NULL,
  `repushflag` tinyint(4) NOT NULL,
  `productflag` tinyint(4) NOT NULL,
  `process_type` varchar(10) NOT NULL DEFAULT '',
  `process_track` int(11) NOT NULL DEFAULT '0' COMMENT '1-Preferred LMS',
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request2_xml` text NOT NULL,
  `response2_xml` text NOT NULL,
  `ApplicationNumber_2` varchar(20) NOT NULL,
  `StatusCode_2` varchar(20) NOT NULL,
  `ProcessingStatus_2` mediumint(9) NOT NULL,
  `Messages_2` varchar(255) NOT NULL,
  `code_2` varchar(20) NOT NULL,
  `message_2` varchar(255) NOT NULL,
  `second_other` varchar(255) NOT NULL,
  `appointment_datetime` datetime NOT NULL,
  `appointment_address` tinyint(1) NOT NULL COMMENT '1->ResidenceAddress, 2->OfficeAddress',
  `second_dated` datetime NOT NULL,
  `request3_xml` text NOT NULL,
  `response3_xml` text NOT NULL,
  `ApplicationNumber_3` varchar(20) NOT NULL,
  `LeadRefNo_3` varchar(20) NOT NULL,
  `Status_3` varchar(20) NOT NULL,
  `StatusDesc_3` varchar(50) NOT NULL,
  `ApplicationState_3` varchar(50) NOT NULL,
  `CreditLimit_3` decimal(12,2) NOT NULL,
  `DecisionCode` varchar(100) NOT NULL,
  `message_3` varchar(255) NOT NULL,
  `third_other` text NOT NULL,
  `third_dated` datetime NOT NULL,
  `table_name` varchar(30) NOT NULL,
  `Pan_card` varchar(10) NOT NULL,
  `MobileNumber` bigint(20) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `Sms_RequestID` int(11) NOT NULL,
  `manipulated_lead` int(11) NOT NULL COMMENT 'Leads for which we applied productflag=4. 1- not punched, 2 punched',
  `doc_email_status` tinyint(1) NOT NULL DEFAULT '0',
  `noresponse_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 --> Not Available for Punching, 1--> Available for punching'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_credit_card_5633_log`
--

CREATE TABLE IF NOT EXISTS `sbi_credit_card_5633_log` (
  `sbicclogid` int(11) NOT NULL,
  `sbiccid` int(11) NOT NULL,
  `cc_requestid` int(11) NOT NULL,
  `LeadRefNumber` varchar(20) DEFAULT NULL,
  `LeadRefNumber_Old` varchar(20) DEFAULT NULL,
  `ApplicationNumber` varchar(20) DEFAULT NULL,
  `ApplicationNumber_Old` varchar(20) DEFAULT NULL,
  `StatusCode` varchar(20) DEFAULT NULL,
  `ProcessingStatus` int(11) DEFAULT NULL,
  `CreditLimit` int(11) DEFAULT NULL,
  `bank_name` varchar(10) NOT NULL,
  `relationship_type` varchar(30) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `Messages` text,
  `code` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `first_other` text,
  `webservice_flag` tinyint(4) NOT NULL COMMENT '0 - not initiated, 1 - initiated, 2 - got response',
  `request_xml` text NOT NULL,
  `request_dated` datetime NOT NULL,
  `response_xml` text NOT NULL,
  `response_dated` datetime NOT NULL,
  `first_dated` datetime NOT NULL,
  `first_dated_old` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request2_xml` text NOT NULL,
  `response2_xml` text NOT NULL,
  `ApplicationNumber_2` varchar(20) NOT NULL,
  `StatusCode_2` varchar(20) NOT NULL,
  `ProcessingStatus_2` mediumint(9) NOT NULL,
  `Messages_2` varchar(255) NOT NULL,
  `code_2` varchar(20) NOT NULL,
  `message_2` varchar(255) NOT NULL,
  `second_other` varchar(255) NOT NULL,
  `second_dated` datetime NOT NULL,
  `request3_xml` text NOT NULL,
  `response3_xml` text NOT NULL,
  `ApplicationNumber_3` varchar(20) NOT NULL,
  `LeadRefNo_3` varchar(20) NOT NULL,
  `Status_3` varchar(20) NOT NULL,
  `StatusDesc_3` varchar(50) NOT NULL,
  `ApplicationState_3` varchar(50) NOT NULL,
  `CreditLimit_3` decimal(12,2) NOT NULL,
  `DecisionCode` varchar(100) NOT NULL,
  `message_3` varchar(255) NOT NULL,
  `third_other` text NOT NULL,
  `third_dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_credit_card_5633_log_07112017`
--

CREATE TABLE IF NOT EXISTS `sbi_credit_card_5633_log_07112017` (
  `sbicclogid` int(11) NOT NULL,
  `sbiccid` int(11) NOT NULL,
  `cc_requestid` int(11) NOT NULL,
  `LeadRefNumber` varchar(20) DEFAULT NULL,
  `ApplicationNumber` varchar(20) DEFAULT NULL,
  `StatusCode` varchar(20) DEFAULT NULL,
  `ProcessingStatus` int(11) DEFAULT NULL,
  `CreditLimit` int(11) DEFAULT NULL,
  `bank_name` varchar(10) NOT NULL,
  `relationship_type` varchar(30) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `Messages` text,
  `code` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `first_other` text,
  `webservice_flag` tinyint(4) NOT NULL COMMENT '0 - not initiated, 1 - initiated, 2 - got response',
  `request_xml` text NOT NULL,
  `response_xml` text NOT NULL,
  `first_dated` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request2_xml` text NOT NULL,
  `response2_xml` text NOT NULL,
  `ApplicationNumber_2` varchar(20) NOT NULL,
  `StatusCode_2` varchar(20) NOT NULL,
  `ProcessingStatus_2` mediumint(9) NOT NULL,
  `Messages_2` varchar(255) NOT NULL,
  `code_2` varchar(20) NOT NULL,
  `message_2` varchar(255) NOT NULL,
  `second_other` varchar(255) NOT NULL,
  `second_dated` datetime NOT NULL,
  `request3_xml` text NOT NULL,
  `response3_xml` text NOT NULL,
  `ApplicationNumber_3` varchar(20) NOT NULL,
  `LeadRefNo_3` varchar(20) NOT NULL,
  `Status_3` varchar(20) NOT NULL,
  `StatusDesc_3` varchar(50) NOT NULL,
  `ApplicationState_3` varchar(50) NOT NULL,
  `CreditLimit_3` decimal(12,2) NOT NULL,
  `DecisionCode` varchar(100) NOT NULL,
  `message_3` varchar(255) NOT NULL,
  `third_other` text NOT NULL,
  `third_dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_credit_card_5633_log_direct`
--

CREATE TABLE IF NOT EXISTS `sbi_credit_card_5633_log_direct` (
  `sbicclogid` int(11) NOT NULL,
  `sbiccid` int(11) NOT NULL,
  `cc_requestid` int(11) NOT NULL,
  `LeadRefNumber` varchar(20) DEFAULT NULL,
  `LeadRefNumber_Old` varchar(20) DEFAULT NULL,
  `ApplicationNumber` varchar(20) DEFAULT NULL,
  `ApplicationNumber_Old` varchar(20) DEFAULT NULL,
  `StatusCode` varchar(20) DEFAULT NULL,
  `ProcessingStatus` int(11) DEFAULT NULL,
  `CreditLimit` int(11) DEFAULT NULL,
  `Messages` text,
  `code` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `first_other` text,
  `request_xml` text NOT NULL,
  `request_dated` datetime NOT NULL,
  `response_xml` text NOT NULL,
  `response_dated` datetime NOT NULL,
  `first_dated` datetime NOT NULL,
  `first_dated_old` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_credit_card_5633_log_direct_07112017`
--

CREATE TABLE IF NOT EXISTS `sbi_credit_card_5633_log_direct_07112017` (
  `sbicclogid` int(11) NOT NULL,
  `sbiccid` int(11) NOT NULL,
  `cc_requestid` int(11) NOT NULL,
  `LeadRefNumber` varchar(20) DEFAULT NULL,
  `ApplicationNumber` varchar(20) DEFAULT NULL,
  `StatusCode` varchar(20) DEFAULT NULL,
  `ProcessingStatus` int(11) DEFAULT NULL,
  `CreditLimit` int(11) DEFAULT NULL,
  `Messages` text,
  `code` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `first_other` text,
  `request_xml` text NOT NULL,
  `response_xml` text NOT NULL,
  `first_dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_documents`
--

CREATE TABLE IF NOT EXISTS `sbi_documents` (
  `doc_id` int(11) unsigned NOT NULL,
  `RequestID` int(11) unsigned NOT NULL,
  `doc_category` varchar(20) NOT NULL,
  `doc_type` varchar(50) NOT NULL,
  `doc_name` varchar(100) NOT NULL,
  `doc_path` varchar(255) NOT NULL,
  `source_code` varchar(20) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sbi_documents_decision_table`
--

CREATE TABLE IF NOT EXISTS `sbi_documents_decision_table` (
  `id` int(11) NOT NULL,
  `card_id` varchar(255) NOT NULL,
  `card_type` varchar(255) NOT NULL,
  `occupation_type` tinyint(1) NOT NULL COMMENT '1-->Salaried, 0-->SelfEmployed',
  `company_category` varchar(10) NOT NULL,
  `doc_set` tinyint(5) NOT NULL,
  `condition_status` tinyint(1) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_adminmember`
--

CREATE TABLE IF NOT EXISTS `site_adminmember` (
  `id` bigint(20) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `usertype` varchar(20) NOT NULL DEFAULT '',
  `valid` tinyint(1) NOT NULL DEFAULT '0',
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smsapp_leadallocation_log`
--

CREATE TABLE IF NOT EXISTS `smsapp_leadallocation_log` (
  `leadlogid` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `ProductID` tinyint(4) NOT NULL,
  `bidder_number` bigint(20) NOT NULL,
  `Sendnow_Date` datetime NOT NULL,
  `RequestID` int(11) NOT NULL,
  `CallerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smspl_mapping_bidderlms`
--

CREATE TABLE IF NOT EXISTS `smspl_mapping_bidderlms` (
  `leadmapid` int(11) NOT NULL,
  `rm_name` varchar(50) NOT NULL,
  `rm_emailid` varchar(100) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_consiolidated_id` smallint(6) NOT NULL,
  `bank_individual_id` text NOT NULL,
  `leadap_dated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smspl_status_details`
--

CREATE TABLE IF NOT EXISTS `smspl_status_details` (
  `statid` int(11) NOT NULL,
  `leadlogid` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL,
  `caller_id` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `final_bidderid` varchar(20) NOT NULL,
  `Bidder_Number` bigint(20) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `appt_date` datetime NOT NULL,
  `appt_time` varchar(150) NOT NULL,
  `special_remarks` text,
  `escalation1` tinyint(4) NOT NULL,
  `escalation2` tinyint(4) NOT NULL,
  `escalation3` tinyint(11) NOT NULL,
  `final_feedback` varchar(50) DEFAULT NULL,
  `final_remarks` text NOT NULL,
  `final_team_feedback` varchar(100) NOT NULL,
  `Flag` tinyint(1) NOT NULL,
  `stat_dated` datetime NOT NULL,
  `finalstat_dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_acknowledgement`
--

CREATE TABLE IF NOT EXISTS `sms_acknowledgement` (
  `sms_id` int(11) NOT NULL,
  `a2wackid` varchar(80) NOT NULL DEFAULT '',
  `custref` varchar(200) NOT NULL DEFAULT '',
  `submitdt` varchar(20) NOT NULL DEFAULT '',
  `lastutime` varchar(20) NOT NULL DEFAULT '',
  `a2wstatus` varchar(80) NOT NULL DEFAULT '',
  `carrierstatus` varchar(80) NOT NULL DEFAULT '',
  `mnumber` varchar(12) NOT NULL DEFAULT '',
  `status` tinytext NOT NULL,
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `s_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `air2web_requestid` int(11) NOT NULL DEFAULT '0',
  `product_type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_acknowledgement_vfirst`
--

CREATE TABLE IF NOT EXISTS `sms_acknowledgement_vfirst` (
  `sms_vid` int(11) NOT NULL,
  `vfirstmyid` varchar(100) NOT NULL DEFAULT '',
  `vfirst_status` varchar(50) DEFAULT NULL,
  `vfirst_updated_on` varchar(50) NOT NULL DEFAULT '',
  `vfirst_res` varchar(20) NOT NULL DEFAULT '0',
  `vfirst_product` tinyint(4) NOT NULL DEFAULT '0',
  `vfirst_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stanc_company_list`
--

CREATE TABLE IF NOT EXISTS `stanc_company_list` (
  `companyid` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `category` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `states_in_india`
--

CREATE TABLE IF NOT EXISTS `states_in_india` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(6) NOT NULL DEFAULT 'state'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_mailer_cards`
--

CREATE TABLE IF NOT EXISTS `store_mailer_cards` (
  `m_id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL DEFAULT '',
  `card_id` int(11) NOT NULL DEFAULT '0',
  `card_name` varchar(120) NOT NULL DEFAULT '',
  `card_offers` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `card_type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_records_mailer`
--

CREATE TABLE IF NOT EXISTS `store_records_mailer` (
  `mailerid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  `mobile` varchar(100) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `ccholder_bank` varchar(255) NOT NULL DEFAULT '',
  `accidental_insurance` tinyint(4) NOT NULL DEFAULT '0',
  `source` varchar(100) NOT NULL DEFAULT '',
  `mailer_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mailerip` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_records_redemption`
--

CREATE TABLE IF NOT EXISTS `store_records_redemption` (
  `mailerid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(200) NOT NULL DEFAULT '',
  `mobile` varchar(100) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `ccholder_bank` varchar(255) NOT NULL DEFAULT '',
  `accidental_insurance` tinyint(4) NOT NULL DEFAULT '0',
  `source` varchar(100) NOT NULL DEFAULT '',
  `mailer_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mailerip` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_redemption_cards`
--

CREATE TABLE IF NOT EXISTS `store_redemption_cards` (
  `m_id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL DEFAULT '',
  `card_id` int(11) NOT NULL DEFAULT '0',
  `card_name` varchar(120) NOT NULL DEFAULT '',
  `card_offers` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `card_type` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Submit_Log`
--

CREATE TABLE IF NOT EXISTS `Submit_Log` (
  `Session_Id` varchar(255) DEFAULT NULL,
  `First_Name` varchar(50) DEFAULT NULL,
  `Last_Name` varchar(50) DEFAULT NULL,
  `Mobile` varchar(50) DEFAULT NULL,
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Reply_Type` varchar(100) NOT NULL DEFAULT '',
  `SubmitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Subscribe_Newsletter`
--

CREATE TABLE IF NOT EXISTS `Subscribe_Newsletter` (
  `SNID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(70) NOT NULL DEFAULT '',
  `Flag` int(11) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sws_acknowledgement`
--

CREATE TABLE IF NOT EXISTS `sws_acknowledgement` (
  `sms_id` int(11) NOT NULL,
  `a2wackid` varchar(80) NOT NULL DEFAULT '',
  `custref` varchar(200) NOT NULL DEFAULT '',
  `submitdt` varchar(20) NOT NULL DEFAULT '',
  `lastutime` varchar(20) NOT NULL DEFAULT '',
  `a2wstatus` varchar(80) NOT NULL DEFAULT '',
  `carrierstatus` varchar(80) NOT NULL DEFAULT '',
  `mnumber` varchar(12) NOT NULL DEFAULT '',
  `status` tinytext NOT NULL,
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `s_dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `product_type` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Task_Assignment`
--

CREATE TABLE IF NOT EXISTS `Task_Assignment` (
  `RequestID` int(10) NOT NULL,
  `Task_Name` text NOT NULL,
  `Raised_By` varchar(100) NOT NULL DEFAULT '',
  `Raised_Date` date NOT NULL DEFAULT '0000-00-00',
  `Priority` varchar(50) NOT NULL DEFAULT '',
  `Work_Status` varchar(30) NOT NULL DEFAULT '',
  `Website_name` varchar(100) NOT NULL DEFAULT '',
  `Testing_Url` varchar(250) NOT NULL DEFAULT '',
  `Start_Date` date NOT NULL DEFAULT '0000-00-00',
  `Time_Required` varchar(20) NOT NULL DEFAULT '0',
  `Handled_by` varchar(100) NOT NULL DEFAULT '',
  `File_Name` varchar(100) NOT NULL DEFAULT '',
  `Feedback_Tech` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Task_Testing`
--

CREATE TABLE IF NOT EXISTS `Task_Testing` (
  `id` tinyint(4) NOT NULL,
  `Field1` varchar(20) NOT NULL DEFAULT '',
  `Field2` varchar(20) NOT NULL DEFAULT '',
  `Field3` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tataaig_leads`
--

CREATE TABLE IF NOT EXISTS `tataaig_leads` (
  `Tataaig_ID` int(11) NOT NULL,
  `T_RequestID` int(11) NOT NULL DEFAULT '0',
  `T_Product` int(11) NOT NULL DEFAULT '0',
  `T_City` varchar(100) NOT NULL DEFAULT '',
  `T_Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Mobile_Number` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tataaig_Leads_New`
--

CREATE TABLE IF NOT EXISTS `Tataaig_Leads_New` (
  `RequestID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(100) NOT NULL DEFAULT '',
  `DOB` varchar(50) NOT NULL DEFAULT '',
  `Mobile_Number` varchar(50) NOT NULL DEFAULT '',
  `City` varchar(50) NOT NULL DEFAULT '',
  `City_Other` varchar(50) NOT NULL DEFAULT '',
  `Net_Salary` varchar(100) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `source` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tatacapital_plmailer_leads`
--

CREATE TABLE IF NOT EXISTS `tatacapital_plmailer_leads` (
  `tatacapitalid` int(11) NOT NULL,
  `tatacapital_name` varchar(50) NOT NULL,
  `tatacapital_email` varchar(100) NOT NULL,
  `tatacapital_mobile_number` bigint(20) NOT NULL,
  `tatacapital_age` varchar(20) NOT NULL,
  `tatacapital_city` varchar(100) NOT NULL,
  `tatacapital_other_city` varchar(50) NOT NULL,
  `tatacapital_employment_status` tinyint(4) NOT NULL,
  `tatacapital_net_Salary` decimal(12,2) NOT NULL,
  `tatacapital_annual_turnover` tinyint(4) NOT NULL,
  `tatacapital_total_experience` smallint(6) NOT NULL,
  `tatacapital_loan_amount` decimal(12,2) NOT NULL,
  `tatacapital_company_name` varchar(255) NOT NULL,
  `tatacapital_source` varchar(50) NOT NULL,
  `tatacapital_sent` smallint(6) NOT NULL,
  `tatacapital_ip` varchar(50) NOT NULL,
  `tatacapital_feedback` varchar(200) NOT NULL,
  `tatacapital_dated` datetime NOT NULL,
  `sentto_tatacapital` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tax_query`
--

CREATE TABLE IF NOT EXISTS `tax_query` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `mobile` bigint(20) NOT NULL DEFAULT '0',
  `email` varchar(120) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `telecaller_feedback_bookkeeping`
--

CREATE TABLE IF NOT EXISTS `telecaller_feedback_bookkeeping` (
  `bookkeepid` int(10) NOT NULL,
  `AllRequestID` int(11) DEFAULT NULL,
  `Feedback_ID` int(11) NOT NULL,
  `BidderID` int(11) DEFAULT NULL,
  `Reply_Type` tinyint(2) DEFAULT NULL,
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Feedback` varchar(50) DEFAULT NULL,
  `Followup_Date` datetime NOT NULL,
  `Comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `telecaller_fullerton`
--

CREATE TABLE IF NOT EXISTS `telecaller_fullerton` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Telecaller_Mgmt_Entry`
--

CREATE TABLE IF NOT EXISTS `Telecaller_Mgmt_Entry` (
  `TME_ID` int(10) NOT NULL,
  `TME_Name` varchar(50) NOT NULL DEFAULT '',
  `TME_Mobile` bigint(10) NOT NULL DEFAULT '0',
  `TME_Pancard` varchar(10) NOT NULL DEFAULT '',
  `TME_TCaller_Name` varchar(50) NOT NULL DEFAULT '',
  `TME_UniqueID` varchar(23) NOT NULL DEFAULT '',
  `TMU_ID` int(5) NOT NULL DEFAULT '0',
  `TME_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TME_TCEntryDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TME_InitialDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TME_Source` varchar(30) NOT NULL DEFAULT '',
  `TME_Product_Type` varchar(20) NOT NULL DEFAULT '0',
  `TME_Email` varchar(50) NOT NULL DEFAULT '',
  `TME_Card_Type` varchar(50) NOT NULL DEFAULT '',
  `TME_Pincode` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Telecaller_Mgmt_User`
--

CREATE TABLE IF NOT EXISTS `Telecaller_Mgmt_User` (
  `TMU_ID` tinyint(5) NOT NULL,
  `TMU_Name` varchar(50) NOT NULL DEFAULT '',
  `TMU_UserName` varchar(50) NOT NULL DEFAULT '',
  `TMU_Password` varchar(50) NOT NULL DEFAULT '',
  `TCaller_Code` varchar(10) NOT NULL DEFAULT '',
  `TCallerFlag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Telecaller_Mgmt_User_Lms`
--

CREATE TABLE IF NOT EXISTS `Telecaller_Mgmt_User_Lms` (
  `TMUL_ID` int(11) NOT NULL,
  `TMUL_TeleCaller_Name` varchar(100) NOT NULL DEFAULT '',
  `TMUL_EnteredBy` varchar(100) NOT NULL DEFAULT '',
  `TMUL_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TMUL_TotalEntries` int(11) NOT NULL DEFAULT '0',
  `TMUL_FinalEntries` int(11) NOT NULL DEFAULT '0',
  `TMUL_RepeatedEntry` int(11) NOT NULL DEFAULT '0',
  `TMUL_Error` varchar(250) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tell_Friends`
--

CREATE TABLE IF NOT EXISTS `Tell_Friends` (
  `Friend_Id` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL DEFAULT '',
  `Email` varchar(30) NOT NULL DEFAULT '',
  `Phone` varchar(30) NOT NULL DEFAULT '',
  `Friend_Name` varchar(30) NOT NULL DEFAULT '',
  `Friend_Email` varchar(30) NOT NULL DEFAULT '',
  `Friend_URL` varchar(250) NOT NULL DEFAULT '',
  `Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `session_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `emp_status` varchar(255) DEFAULT NULL,
  `c_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `city_other` varchar(255) DEFAULT NULL,
  `car_make` varchar(255) DEFAULT NULL,
  `car_model` varchar(255) DEFAULT NULL,
  `car_type` varchar(255) DEFAULT NULL,
  `loan_tenure` varchar(255) DEFAULT NULL,
  `descr` text,
  `property_type` varchar(255) DEFAULT NULL,
  `property_value` varchar(255) DEFAULT NULL,
  `year_in_comp` varchar(255) DEFAULT NULL,
  `total_exp` varchar(255) DEFAULT NULL,
  `mobile_number` varchar(35) DEFAULT NULL,
  `std_code` varchar(100) DEFAULT NULL,
  `landline` varchar(100) DEFAULT NULL,
  `std_code_o` varchar(100) DEFAULT NULL,
  `landline_o` varchar(50) DEFAULT NULL,
  `net_salary` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `marital_status` varchar(255) DEFAULT NULL,
  `residential_status` varchar(255) DEFAULT NULL,
  `vehicle_owned` varchar(255) DEFAULT NULL,
  `loan_any` varchar(255) DEFAULT NULL,
  `emi_paid` varchar(255) DEFAULT NULL,
  `cc_holder` varchar(255) DEFAULT NULL,
  `loan_amount` varchar(255) DEFAULT NULL,
  `no_of_dependents` varchar(35) DEFAULT NULL,
  `annual_income` varchar(255) DEFAULT NULL,
  `plan_interested` varchar(255) DEFAULT NULL,
  `pincode` varchar(100) DEFAULT NULL,
  `source` varchar(150) DEFAULT NULL,
  `Feedback` varchar(100) DEFAULT NULL,
  `contact_time` varchar(100) DEFAULT NULL,
  `count_views` varchar(255) DEFAULT NULL,
  `count_replies` varchar(255) DEFAULT NULL,
  `is_modified` varchar(255) DEFAULT NULL,
  `is_processed` varchar(255) DEFAULT NULL,
  `already_download` varchar(20) DEFAULT NULL,
  `doe` varchar(255) DEFAULT NULL,
  `budget` varchar(255) DEFAULT NULL,
  `product_type` varchar(255) DEFAULT NULL,
  `count` varchar(100) DEFAULT NULL,
  `total_bill` varchar(255) DEFAULT NULL,
  `pancard` varchar(50) DEFAULT NULL,
  `no_of_banks` varchar(50) DEFAULT NULL,
  `residence_address` varchar(250) DEFAULT NULL,
  `current_age` varchar(250) DEFAULT NULL,
  `property_identified` varchar(250) DEFAULT NULL,
  `property_loc` varchar(100) DEFAULT NULL,
  `card_vintage` varchar(200) DEFAULT NULL,
  `referred_page` varchar(200) DEFAULT NULL,
  `bidderid` varchar(50) DEFAULT NULL,
  `login_date` varchar(100) DEFAULT NULL,
  `logout_date` varchar(100) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `is_valid` varchar(50) DEFAULT NULL,
  `constitution` varchar(200) DEFAULT NULL,
  `year_of_establishment` varchar(100) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `request_id` varchar(200) DEFAULT NULL,
  `query_type` varchar(100) DEFAULT NULL,
  `employer` varchar(200) DEFAULT NULL,
  `loan_time` varchar(200) NOT NULL DEFAULT '',
  `Card_Limit` varchar(100) DEFAULT NULL,
  `add_comment` varchar(255) NOT NULL DEFAULT '',
  `Documents` text NOT NULL,
  `bank_name` varchar(200) NOT NULL DEFAULT '',
  `account_no` varchar(200) NOT NULL DEFAULT '',
  `apt_dt` varchar(255) NOT NULL DEFAULT '',
  `docs` varchar(255) NOT NULL DEFAULT '',
  `address_apt` varchar(255) NOT NULL DEFAULT '',
  `changeapp_time` varchar(255) NOT NULL DEFAULT '',
  `unique_id` varchar(50) NOT NULL,
  `feedback_1` varchar(255) NOT NULL,
  `feedback_2` varchar(255) NOT NULL,
  `feedback_3` varchar(255) NOT NULL,
  `feedback_4` varchar(255) NOT NULL,
  `feedback_5` varchar(255) NOT NULL,
  `feedback_6` varchar(255) NOT NULL,
  `feedback_7` varchar(255) NOT NULL,
  `feedback_8` varchar(255) NOT NULL,
  `feedback_9` varchar(255) NOT NULL,
  `feedback_10` varchar(255) NOT NULL,
  `feedback_11` varchar(255) NOT NULL,
  `feedback_12` varchar(255) NOT NULL,
  `feedback_13` varchar(255) NOT NULL,
  `feedback_14` varchar(255) NOT NULL,
  `feedback_15` varchar(255) NOT NULL,
  `feedback_16` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Testimonial`
--

CREATE TABLE IF NOT EXISTS `Testimonial` (
  `TestID` int(10) NOT NULL,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Email` varchar(50) NOT NULL DEFAULT '',
  `Subject` text NOT NULL,
  `Message` text NOT NULL,
  `Is_Verified` tinyint(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `TMU_Pincode`
--

CREATE TABLE IF NOT EXISTS `TMU_Pincode` (
  `PincodeID` int(11) NOT NULL,
  `Pincode` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `totalLoans`
--

CREATE TABLE IF NOT EXISTS `totalLoans` (
  `id` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Amount` varchar(60) NOT NULL DEFAULT '',
  `Name` varchar(30) NOT NULL DEFAULT '',
  `countr_amt` int(11) NOT NULL,
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `totalLoans_test`
--

CREATE TABLE IF NOT EXISTS `totalLoans_test` (
  `id` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Amount` varchar(60) NOT NULL DEFAULT '',
  `Name` varchar(30) NOT NULL DEFAULT '',
  `countr_amt` int(11) NOT NULL,
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `flag` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trackBanner`
--

CREATE TABLE IF NOT EXISTS `trackBanner` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `PageName` varchar(255) NOT NULL,
  `Dated` datetime NOT NULL,
  `Counter` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tracksms`
--

CREATE TABLE IF NOT EXISTS `tracksms` (
  `id` int(11) NOT NULL,
  `Phone` bigint(20) NOT NULL DEFAULT '0',
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Status` varchar(60) NOT NULL DEFAULT '',
  `domain` varchar(20) NOT NULL DEFAULT '',
  `length` int(11) NOT NULL DEFAULT '0',
  `msgcount` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `track_sms`
--

CREATE TABLE IF NOT EXISTS `track_sms` (
  `id` int(11) NOT NULL,
  `pcode` varchar(40) NOT NULL DEFAULT '',
  `smscount` int(11) NOT NULL DEFAULT '0',
  `total_amount` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unsubscribe`
--

CREATE TABLE IF NOT EXISTS `unsubscribe` (
  `id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT '',
  `Email` varchar(110) NOT NULL DEFAULT '',
  `Phone` bigint(20) NOT NULL DEFAULT '0',
  `Status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload_documents`
--

CREATE TABLE IF NOT EXISTS `upload_documents` (
  `DocID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Appointment_Letter` varchar(200) NOT NULL DEFAULT '',
  `Form16` varchar(200) NOT NULL DEFAULT '',
  `Salary_Slip` varchar(200) NOT NULL DEFAULT '',
  `Bank_Statement` varchar(200) NOT NULL DEFAULT '',
  `Pancard` varchar(200) NOT NULL DEFAULT '',
  `Voterid` varchar(200) NOT NULL DEFAULT '',
  `Passport` varchar(200) NOT NULL DEFAULT '',
  `Driving_License` varchar(200) NOT NULL DEFAULT '',
  `Photo` varchar(200) NOT NULL DEFAULT '',
  `LIC_Policy` varchar(200) NOT NULL DEFAULT '',
  `Telephone_Bill` varchar(200) NOT NULL DEFAULT '',
  `Electricity_Bill` varchar(200) NOT NULL DEFAULT '',
  `Loan_Track` varchar(200) NOT NULL DEFAULT '',
  `CC_Photocopy` varchar(200) NOT NULL DEFAULT '',
  `mode` varchar(20) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT '',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Income_Proof` varchar(255) NOT NULL DEFAULT '',
  `Address_Proof` varchar(255) NOT NULL DEFAULT '',
  `Identity_Proof` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload_documents_citi`
--

CREATE TABLE IF NOT EXISTS `upload_documents_citi` (
  `DocID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `RequestID` int(11) NOT NULL DEFAULT '0',
  `Appointment_Letter` varchar(200) NOT NULL DEFAULT '',
  `Form16` varchar(200) NOT NULL DEFAULT '',
  `Salary_Slip` varchar(200) NOT NULL DEFAULT '',
  `Bank_Statement` varchar(200) NOT NULL DEFAULT '',
  `Pancard` varchar(200) NOT NULL DEFAULT '',
  `Voterid` varchar(200) NOT NULL DEFAULT '',
  `Passport` varchar(200) NOT NULL DEFAULT '',
  `Driving_License` varchar(200) NOT NULL DEFAULT '',
  `Photo` varchar(200) NOT NULL DEFAULT '',
  `LIC_Policy` varchar(200) NOT NULL DEFAULT '',
  `Telephone_Bill` varchar(200) NOT NULL DEFAULT '',
  `Electricity_Bill` varchar(200) NOT NULL DEFAULT '',
  `Loan_Track` varchar(200) NOT NULL DEFAULT '',
  `CC_Photocopy` varchar(200) NOT NULL DEFAULT '',
  `mode` varchar(20) NOT NULL DEFAULT '',
  `status` varchar(10) NOT NULL DEFAULT '',
  `BidderID` int(11) NOT NULL DEFAULT '0',
  `Income_Proof` varchar(255) NOT NULL DEFAULT '',
  `Address_Proof` varchar(255) NOT NULL DEFAULT '',
  `Identity_Proof` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `useragentlog`
--

CREATE TABLE IF NOT EXISTS `useragentlog` (
  `id` int(11) NOT NULL,
  `useragent` varchar(255) NOT NULL,
  `dated` datetime NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_requests_count`
--

CREATE TABLE IF NOT EXISTS `user_requests_count` (
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `c_Investment` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `c_CreditCard` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `c_Loan_Personal` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `c_Loans_Home` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Last_Request_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `webservice_bidder_details`
--

CREATE TABLE IF NOT EXISTS `webservice_bidder_details` (
  `websrvid` int(11) NOT NULL,
  `leadid` int(11) NOT NULL,
  `product` tinyint(4) NOT NULL,
  `request_xml` text NOT NULL,
  `feedback` text NOT NULL,
  `bidderid` varchar(50) NOT NULL,
  `doe` datetime NOT NULL,
  `mail_sent` tinyint(4) NOT NULL,
  `cust_requestid` int(11) NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `final_feedback` text NOT NULL,
  `final_feedback_date` datetime NOT NULL,
  `sbi_current_status` varchar(50) NOT NULL,
  `finalpush_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `webservice_details_pl`
--

CREATE TABLE IF NOT EXISTS `webservice_details_pl` (
  `webserviceid` int(11) NOT NULL,
  `product` varchar(5) NOT NULL,
  `productid` int(11) NOT NULL,
  `bankid` int(11) NOT NULL,
  `api_name` varchar(30) NOT NULL,
  `api_version` varchar(20) NOT NULL,
  `api_request` text NOT NULL,
  `api_response` text NOT NULL,
  `api_response_status` int(11) NOT NULL COMMENT 'Response - true or false',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `webservice_log_sbi`
--

CREATE TABLE IF NOT EXISTS `webservice_log_sbi` (
  `sbicclogid` int(11) NOT NULL,
  `sbiccid` int(11) NOT NULL,
  `cc_requestid` int(11) NOT NULL,
  `LeadRefNumber` varchar(20) DEFAULT '',
  `ApplicationNumber` varchar(20) DEFAULT '',
  `StatusCode` varchar(20) DEFAULT NULL,
  `ProcessingStatus` int(11) DEFAULT NULL,
  `CreditLimit` int(11) DEFAULT NULL,
  `bank_name` varchar(10) NOT NULL,
  `relationship_type` varchar(30) NOT NULL,
  `account_number` varchar(20) NOT NULL,
  `Messages` text,
  `code` varchar(20) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `first_other` text,
  `webservice_flag` tinyint(4) NOT NULL COMMENT '0 - not initiated, 1 - initiated, 2 - got response',
  `request_xml` text NOT NULL,
  `response_xml` text NOT NULL,
  `first_dated` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `request2_xml` text NOT NULL,
  `response2_xml` text NOT NULL,
  `ApplicationNumber_2` varchar(20) NOT NULL,
  `StatusCode_2` varchar(20) NOT NULL,
  `ProcessingStatus_2` mediumint(9) NOT NULL,
  `Messages_2` varchar(255) NOT NULL,
  `code_2` varchar(20) NOT NULL,
  `message_2` varchar(255) NOT NULL,
  `second_other` varchar(255) NOT NULL,
  `second_dated` datetime NOT NULL,
  `request3_xml` text NOT NULL,
  `response3_xml` text NOT NULL,
  `ApplicationNumber_3` varchar(20) NOT NULL,
  `LeadRefNo_3` varchar(20) NOT NULL,
  `Status_3` varchar(20) NOT NULL,
  `StatusDesc_3` varchar(50) NOT NULL,
  `ApplicationState_3` varchar(50) NOT NULL,
  `CreditLimit_3` decimal(12,2) NOT NULL,
  `DecisionCode` varchar(100) NOT NULL,
  `message_3` varchar(255) NOT NULL,
  `third_other` text NOT NULL,
  `third_dated` datetime NOT NULL,
  `lms_process` varchar(20) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `response_blank` tinyint(4) NOT NULL DEFAULT '0',
  `noresponse_status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `webservice_whatsapp`
--

CREATE TABLE IF NOT EXISTS `webservice_whatsapp` (
  `id` int(11) NOT NULL,
  `bidder_id` int(11) NOT NULL,
  `bidder_name` varchar(60) NOT NULL,
  `customer_name` varchar(60) NOT NULL,
  `customer_mobile` bigint(20) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `table_name` varchar(30) NOT NULL,
  `feedback` varchar(30) DEFAULT NULL,
  `allocation_date` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `message_sent_date` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `status_message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_services`
--

CREATE TABLE IF NOT EXISTS `web_services` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Client_Name` varchar(100) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `table_name` varchar(25) NOT NULL,
  `allotation_table_name` varchar(50) NOT NULL,
  `Status` tinyint(4) NOT NULL,
  `repush_lifespan` int(11) DEFAULT '360' COMMENT 'in minutes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_services_bidders_map`
--

CREATE TABLE IF NOT EXISTS `web_services_bidders_map` (
  `ID` int(11) NOT NULL,
  `WSID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_services_default_values`
--

CREATE TABLE IF NOT EXISTS `web_services_default_values` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` int(11) NOT NULL,
  `turnaroundtime` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_services_error_log`
--

CREATE TABLE IF NOT EXISTS `web_services_error_log` (
  `ID` int(11) NOT NULL,
  `WSID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `feedback` varchar(150) NOT NULL DEFAULT '',
  `actual_feedback` varchar(255) NOT NULL DEFAULT '',
  `Dated` datetime NOT NULL,
  `allocation_date` datetime NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL,
  `counter_lead` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_services_error_log_notification`
--

CREATE TABLE IF NOT EXISTS `web_services_error_log_notification` (
  `ID` int(11) NOT NULL,
  `WSID` int(11) NOT NULL,
  `email_notification` varchar(150) NOT NULL,
  `sms_notification` varchar(150) NOT NULL,
  `Dated` datetime NOT NULL,
  `counter_notification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_services_notifications`
--

CREATE TABLE IF NOT EXISTS `web_services_notifications` (
  `ID` int(11) NOT NULL,
  `WSID` int(11) NOT NULL,
  `RM_Name` varchar(70) NOT NULL,
  `to_email` varchar(255) NOT NULL,
  `cc_email` varchar(255) NOT NULL,
  `to_sms` varchar(255) NOT NULL,
  `cc_sms` varchar(255) NOT NULL,
  `mail_template` text NOT NULL,
  `sms_template` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wf_company_list_hdfc`
--

CREATE TABLE IF NOT EXISTS `wf_company_list_hdfc` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `hdfc` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `cin` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wf_lead_allocate`
--

CREATE TABLE IF NOT EXISTS `wf_lead_allocate` (
  `id` int(10) unsigned NOT NULL,
  `leadid` int(11) unsigned DEFAULT NULL,
  `callerid` int(11) unsigned DEFAULT NULL,
  `product` tinyint(2) unsigned DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `feedback` varchar(50) NOT NULL,
  `followup_date` datetime NOT NULL,
  `comments` varchar(255) NOT NULL,
  `satus` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wishfin_mailer_send`
--

CREATE TABLE IF NOT EXISTS `wishfin_mailer_send` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `Dated` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wishfin_master_bank`
--

CREATE TABLE IF NOT EXISTS `wishfin_master_bank` (
  `bank_code` varchar(5) NOT NULL,
  `bank_name` varchar(250) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `bank_name_prosa` varchar(250) DEFAULT NULL,
  `bank_alpha_code` varchar(4) NOT NULL,
  `priority` tinyint(2) unsigned NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 => Active , 0 => Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wishfin_quote_loan`
--

CREATE TABLE IF NOT EXISTS `wishfin_quote_loan` (
  `RequestID` int(10) unsigned NOT NULL,
  `UserID` int(10) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(255) DEFAULT '',
  `Email` varchar(255) DEFAULT '',
  `Employment_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Company_Name` varchar(100) DEFAULT '',
  `City` varchar(255) DEFAULT '',
  `City_Other` varchar(255) DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `Mobile_Number` varchar(50) DEFAULT NULL,
  `Std_Code_O` varchar(10) DEFAULT NULL,
  `Landline_O` varchar(50) DEFAULT NULL,
  `Years_In_Company` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Total_Experience` decimal(5,2) unsigned NOT NULL DEFAULT '0.00',
  `Net_Salary` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Marital_Status` char(1) NOT NULL DEFAULT '',
  `Residential_Status` tinyint(1) NOT NULL DEFAULT '0',
  `Vehicles_Owned` tinyint(1) NOT NULL DEFAULT '0',
  `Loan_Any` varchar(250) DEFAULT NULL,
  `EMI_Paid` varchar(50) DEFAULT '',
  `CC_Holder` tinyint(1) NOT NULL DEFAULT '0',
  `Card_Vintage` tinyint(4) NOT NULL DEFAULT '0',
  `Card_Limit` varchar(50) DEFAULT '',
  `Loan_Amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00',
  `Pincode` varchar(50) DEFAULT NULL,
  `Contact_Time` varchar(100) DEFAULT NULL,
  `Count_Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Count_Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `IsModified` tinyint(1) NOT NULL DEFAULT '0',
  `IsProcessed` tinyint(1) NOT NULL DEFAULT '0',
  `IsPublic` varchar(5) DEFAULT '0',
  `Dated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CC_Age` varchar(10) DEFAULT NULL,
  `CC_Bank` varchar(200) DEFAULT NULL,
  `Primary_Acc` varchar(25) DEFAULT NULL,
  `Barclays_Eligibility` varchar(255) DEFAULT NULL,
  `Citibank_Eligibility` varchar(255) DEFAULT NULL,
  `Hdfc_Eligibility` varchar(255) DEFAULT NULL,
  `Cpp_Compaign` tinyint(4) DEFAULT NULL,
  `Is_Permit` tinyint(4) NOT NULL DEFAULT '0',
  `HL_Bank` varchar(25) DEFAULT NULL,
  `Direct_Allocation` tinyint(4) NOT NULL DEFAULT '0',
  `Edelweiss_Compaign` tinyint(4) DEFAULT '0',
  `PL_EMI_Amt` varchar(15) DEFAULT NULL,
  `PL_Bank` varchar(255) DEFAULT NULL,
  `PL_Tenure` varchar(15) DEFAULT NULL,
  `PL_EMI_Paid` varchar(15) DEFAULT NULL,
  `Life_Insurance` tinyint(4) DEFAULT NULL,
  `Gender` tinyint(4) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `Referrer` varchar(250) DEFAULT NULL,
  `Creative` varchar(200) DEFAULT NULL,
  `Section` varchar(50) DEFAULT NULL,
  `IP_Address` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Allocated` tinyint(2) NOT NULL DEFAULT '0',
  `Reference_Code` varchar(10) DEFAULT NULL,
  `Is_Valid` tinyint(4) NOT NULL DEFAULT '0',
  `Bidder_Flag` int(11) DEFAULT NULL,
  `Residence_Address` varchar(250) DEFAULT '',
  `Bidder_Count` int(11) DEFAULT '0',
  `Sms_Sent` tinyint(4) DEFAULT NULL,
  `Email_Sent` tinyint(4) DEFAULT NULL,
  `Bidderid_Details` varchar(200) DEFAULT '',
  `checked_bidders` varchar(255) DEFAULT '',
  `Accidental_Insurance` tinyint(4) NOT NULL DEFAULT '0',
  `Mobile_Connection` tinyint(4) NOT NULL DEFAULT '0',
  `Landline_connection` tinyint(4) NOT NULL DEFAULT '0',
  `Salary_Drawn` tinyint(4) NOT NULL DEFAULT '0',
  `Updated_Date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Add_Comment` varchar(255) DEFAULT '',
  `Contactable` tinyint(2) NOT NULL DEFAULT '0',
  `CC_Mailer` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Health` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Auto` tinyint(4) NOT NULL DEFAULT '0',
  `Tataaig_Home` tinyint(4) NOT NULL DEFAULT '0',
  `identification_proof` varchar(255) DEFAULT '',
  `residence_proof` varchar(255) DEFAULT '',
  `income_proof` varchar(255) DEFAULT '',
  `lead_cost` int(11) NOT NULL DEFAULT '0',
  `Company_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Referral_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `upload_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Annual_Turnover` tinyint(4) NOT NULL DEFAULT '0',
  `ex_source` varchar(15) DEFAULT NULL,
  `ABMMU_flag` tinyint(4) NOT NULL DEFAULT '0',
  `Privacy` varchar(5) DEFAULT NULL,
  `panel` varchar(50) DEFAULT NULL,
  `Existing_Bank` varchar(150) DEFAULT NULL,
  `Existing_Loan` decimal(12,2) NOT NULL,
  `Existing_ROI` varchar(10) DEFAULT NULL,
  `Pancard` varchar(10) DEFAULT NULL,
  `Cibilscore` int(11) NOT NULL,
  `Cibilok` tinyint(4) NOT NULL,
  `Holding_Current_Account` tinyint(4) NOT NULL DEFAULT '0',
  `wishfin_id` int(11) NOT NULL,
  `company_category` varchar(50) DEFAULT NULL,
  `tu_status` tinyint(4) NOT NULL DEFAULT '0',
  `quote_response` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_commentmeta`
--

CREATE TABLE IF NOT EXISTS `wpbnk_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_comments`
--

CREATE TABLE IF NOT EXISTS `wpbnk_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_links`
--

CREATE TABLE IF NOT EXISTS `wpbnk_links` (
  `link_id` bigint(20) unsigned NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_options`
--

CREATE TABLE IF NOT EXISTS `wpbnk_options` (
  `option_id` bigint(20) unsigned NOT NULL,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_phppc_functions`
--

CREATE TABLE IF NOT EXISTS `wpbnk_phppc_functions` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL DEFAULT 'Untitled Function',
  `description` text,
  `code` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_pollsa`
--

CREATE TABLE IF NOT EXISTS `wpbnk_pollsa` (
  `polla_aid` int(10) NOT NULL,
  `polla_qid` int(10) NOT NULL DEFAULT '0',
  `polla_answers` varchar(200) NOT NULL DEFAULT '',
  `polla_votes` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_pollsip`
--

CREATE TABLE IF NOT EXISTS `wpbnk_pollsip` (
  `pollip_id` int(10) NOT NULL,
  `pollip_qid` varchar(10) NOT NULL DEFAULT '',
  `pollip_aid` varchar(10) NOT NULL DEFAULT '',
  `pollip_ip` varchar(100) NOT NULL DEFAULT '',
  `pollip_host` varchar(200) NOT NULL DEFAULT '',
  `pollip_timestamp` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollip_user` tinytext NOT NULL,
  `pollip_userid` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_pollsq`
--

CREATE TABLE IF NOT EXISTS `wpbnk_pollsq` (
  `pollq_id` int(10) NOT NULL,
  `pollq_question` varchar(200) NOT NULL DEFAULT '',
  `pollq_timestamp` varchar(20) NOT NULL DEFAULT '',
  `pollq_totalvotes` int(10) NOT NULL DEFAULT '0',
  `pollq_active` tinyint(1) NOT NULL DEFAULT '1',
  `pollq_expiry` varchar(20) NOT NULL DEFAULT '',
  `pollq_multiple` tinyint(3) NOT NULL DEFAULT '0',
  `pollq_totalvoters` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_postmeta`
--

CREATE TABLE IF NOT EXISTS `wpbnk_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_posts`
--

CREATE TABLE IF NOT EXISTS `wpbnk_posts` (
  `ID` bigint(20) unsigned NOT NULL,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_terms`
--

CREATE TABLE IF NOT EXISTS `wpbnk_terms` (
  `term_id` bigint(20) unsigned NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_term_relationships`
--

CREATE TABLE IF NOT EXISTS `wpbnk_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `wpbnk_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_usermeta`
--

CREATE TABLE IF NOT EXISTS `wpbnk_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wpbnk_users`
--

CREATE TABLE IF NOT EXISTS `wpbnk_users` (
  `ID` bigint(20) unsigned NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_blaster_reviews`
--

CREATE TABLE IF NOT EXISTS `wp_blaster_reviews` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `page_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `rating` float NOT NULL,
  `review` text NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_blaster_reviews_setting`
--

CREATE TABLE IF NOT EXISTS `wp_blaster_reviews_setting` (
  `id` int(11) NOT NULL,
  `page_url` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE IF NOT EXISTS `wp_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE IF NOT EXISTS `wp_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_golfresult`
--

CREATE TABLE IF NOT EXISTS `wp_golfresult` (
  `result_aid` mediumint(10) NOT NULL,
  `table_id` mediumint(10) NOT NULL DEFAULT '0',
  `row_id` mediumint(10) NOT NULL DEFAULT '1',
  `value` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_golftable`
--

CREATE TABLE IF NOT EXISTS `wp_golftable` (
  `table_aid` mediumint(10) NOT NULL,
  `table_name` varchar(200) NOT NULL DEFAULT 'Table name',
  `description` mediumtext NOT NULL,
  `alternative` tinyint(1) NOT NULL DEFAULT '1',
  `show_name` tinyint(1) NOT NULL DEFAULT '1',
  `show_desc` tinyint(1) NOT NULL DEFAULT '0',
  `head_bold` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE IF NOT EXISTS `wp_links` (
  `link_id` bigint(20) unsigned NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_image` varchar(255) NOT NULL DEFAULT '',
  `link_target` varchar(25) NOT NULL DEFAULT '',
  `link_description` varchar(255) NOT NULL DEFAULT '',
  `link_visible` varchar(20) NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) unsigned NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) NOT NULL DEFAULT '',
  `link_notes` mediumtext NOT NULL,
  `link_rss` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_mappress_maps`
--

CREATE TABLE IF NOT EXISTS `wp_mappress_maps` (
  `mapid` int(11) NOT NULL,
  `obj` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_mappress_posts`
--

CREATE TABLE IF NOT EXISTS `wp_mappress_posts` (
  `postid` int(11) NOT NULL DEFAULT '0',
  `mapid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE IF NOT EXISTS `wp_options` (
  `option_id` bigint(20) unsigned NOT NULL,
  `option_name` varchar(191) DEFAULT NULL,
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_pollsa`
--

CREATE TABLE IF NOT EXISTS `wp_pollsa` (
  `polla_aid` int(10) NOT NULL,
  `polla_qid` int(10) NOT NULL DEFAULT '0',
  `polla_answers` varchar(200) NOT NULL DEFAULT '',
  `polla_votes` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_pollsip`
--

CREATE TABLE IF NOT EXISTS `wp_pollsip` (
  `pollip_id` int(10) NOT NULL,
  `pollip_qid` varchar(10) NOT NULL DEFAULT '',
  `pollip_aid` varchar(10) NOT NULL DEFAULT '',
  `pollip_ip` varchar(100) NOT NULL DEFAULT '',
  `pollip_host` varchar(200) NOT NULL DEFAULT '',
  `pollip_timestamp` varchar(20) NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollip_user` tinytext NOT NULL,
  `pollip_userid` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_pollsq`
--

CREATE TABLE IF NOT EXISTS `wp_pollsq` (
  `pollq_id` int(10) NOT NULL,
  `pollq_question` varchar(200) NOT NULL DEFAULT '',
  `pollq_timestamp` varchar(20) NOT NULL DEFAULT '',
  `pollq_totalvotes` int(10) NOT NULL DEFAULT '0',
  `pollq_active` tinyint(1) NOT NULL DEFAULT '1',
  `pollq_expiry` varchar(20) NOT NULL DEFAULT '',
  `pollq_multiple` tinyint(3) NOT NULL DEFAULT '0',
  `pollq_totalvoters` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE IF NOT EXISTS `wp_postmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `post_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE IF NOT EXISTS `wp_posts` (
  `ID` bigint(20) unsigned NOT NULL,
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  `view_form` tinyint(4) NOT NULL DEFAULT '0',
  `view_redirect` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_sharebar`
--

CREATE TABLE IF NOT EXISTS `wp_sharebar` (
  `id` mediumint(9) NOT NULL,
  `position` mediumint(9) NOT NULL,
  `enabled` int(1) NOT NULL,
  `name` varchar(80) NOT NULL,
  `big` text NOT NULL,
  `small` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_social_users`
--

CREATE TABLE IF NOT EXISTS `wp_social_users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `verified` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_token` text COLLATE utf8_unicode_ci,
  `oauth_secret` text COLLATE utf8_unicode_ci,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_termmeta`
--

CREATE TABLE IF NOT EXISTS `wp_termmeta` (
  `meta_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE IF NOT EXISTS `wp_terms` (
  `term_id` bigint(20) unsigned NOT NULL,
  `name` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE IF NOT EXISTS `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE IF NOT EXISTS `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) unsigned NOT NULL,
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE IF NOT EXISTS `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) unsigned NOT NULL,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(255) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wp_yasr_log`
--

CREATE TABLE IF NOT EXISTS `wp_yasr_log` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `multi_set_id` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vote` decimal(11,1) NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_yasr_multi_set`
--

CREATE TABLE IF NOT EXISTS `wp_yasr_multi_set` (
  `set_id` int(2) NOT NULL,
  `set_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_yasr_multi_set_fields`
--

CREATE TABLE IF NOT EXISTS `wp_yasr_multi_set_fields` (
  `id` bigint(20) NOT NULL,
  `parent_set_id` int(2) NOT NULL,
  `field_name` varchar(23) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `field_id` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_yasr_multi_values`
--

CREATE TABLE IF NOT EXISTS `wp_yasr_multi_values` (
  `id` bigint(20) NOT NULL,
  `field_id` int(2) NOT NULL,
  `set_type` int(2) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `votes` decimal(2,1) NOT NULL,
  `number_of_votes` bigint(20) NOT NULL,
  `sum_votes` decimal(11,1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wp_yasr_votes`
--

CREATE TABLE IF NOT EXISTS `wp_yasr_votes` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL,
  `overall_rating` decimal(2,1) NOT NULL,
  `number_of_votes` bigint(20) NOT NULL,
  `sum_votes` decimal(11,1) NOT NULL,
  `review_type` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wUsers`
--

CREATE TABLE IF NOT EXISTS `wUsers` (
  `UserID` int(10) unsigned NOT NULL,
  `Email` varchar(50) NOT NULL DEFAULT '',
  `FName` varchar(100) NOT NULL DEFAULT '',
  `LName` varchar(30) NOT NULL DEFAULT '',
  `PWD` varchar(15) DEFAULT NULL,
  `Phone` varchar(30) NOT NULL DEFAULT '',
  `Std_Code` varchar(10) DEFAULT NULL,
  `Landline` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `Join_Date` date NOT NULL DEFAULT '0000-00-00',
  `Last_Login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Count_Requests` smallint(5) unsigned NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) NOT NULL DEFAULT '0',
  `By_Callers` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wusers1`
--

CREATE TABLE IF NOT EXISTS `wusers1` (
  `UserID` int(10) unsigned NOT NULL,
  `Email` varchar(50) NOT NULL DEFAULT '',
  `FName` varchar(30) NOT NULL DEFAULT '',
  `LName` varchar(30) NOT NULL DEFAULT '',
  `PWD` varchar(15) NOT NULL DEFAULT '',
  `Phone` varchar(30) NOT NULL DEFAULT '',
  `DOB` varchar(50) DEFAULT NULL,
  `Join_Date` date NOT NULL DEFAULT '0000-00-00',
  `Last_Login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Count_Requests` smallint(5) unsigned NOT NULL DEFAULT '0',
  `IsPublic` tinyint(1) NOT NULL DEFAULT '0',
  `By_Callers` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xkyknzl5dwfyk4hg_master_bank`
--

CREATE TABLE IF NOT EXISTS `xkyknzl5dwfyk4hg_master_bank` (
  `bank_code` varchar(5) NOT NULL,
  `bank_name` varchar(250) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `gray_image_path` varchar(255) DEFAULT NULL,
  `bank_name_prosa` varchar(250) DEFAULT NULL,
  `bank_alpha_code` varchar(4) NOT NULL,
  `priority` tinyint(2) unsigned NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 => Active , 0 => Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xkyknzl5dwfyk4hg_tms_bank_api`
--

CREATE TABLE IF NOT EXISTS `xkyknzl5dwfyk4hg_tms_bank_api` (
  `id` int(11) unsigned NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `lead_id` int(11) unsigned NOT NULL,
  `d4l_id` int(11) NOT NULL,
  `credit_card_id` int(11) NOT NULL,
  `bank_code` varchar(5) NOT NULL,
  `date_requested` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `requester` varchar(50) NOT NULL,
  `date_started` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_ended` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bank_api_header` text NOT NULL,
  `bank_api_request_data` text NOT NULL,
  `bank_api_response_data` text NOT NULL,
  `reference_hash` varchar(255) DEFAULT NULL,
  `application_id` varchar(50) DEFAULT NULL,
  `json_header` text NOT NULL,
  `json_request_data` text NOT NULL,
  `json_response_data` text NOT NULL,
  `retry` tinyint(1) NOT NULL DEFAULT '1',
  `web_services_default_values_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `xkyknzl5dwfyk4hg_tms_whatsapp`
--

CREATE TABLE IF NOT EXISTS `xkyknzl5dwfyk4hg_tms_whatsapp` (
  `id` int(11) unsigned NOT NULL,
  `master_user_id` int(11) unsigned DEFAULT NULL,
  `whatsapp_id` int(11) unsigned DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_requested` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `requester` varchar(45) DEFAULT NULL,
  `whatsapp_request_data` text,
  `whatsapp_response_data` text,
  `whatsapp_response_id` varchar(255) NOT NULL,
  `whatsapp_response_info` varchar(255) NOT NULL,
  `whatsapp_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 => Pending,1 => In Queue ,2 => Send',
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xkyknzl5dwfyk4hg_whatsapp_callback`
--

CREATE TABLE IF NOT EXISTS `xkyknzl5dwfyk4hg_whatsapp_callback` (
  `id` int(11) unsigned NOT NULL,
  `mobile_number` bigint(20) unsigned NOT NULL DEFAULT '0',
  `to_or_from` varchar(7) NOT NULL,
  `message_id` varchar(255) NOT NULL,
  `message_status` varchar(255) DEFAULT NULL,
  `message_text` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `message_media_file` text,
  `message_media_mime_type` varchar(255) DEFAULT NULL,
  `message_media_status` varchar(255) DEFAULT NULL,
  `message_media_url` text NOT NULL,
  `timestamp` bigint(20) DEFAULT NULL,
  `request_data` text,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 => status_callback api for status,1 => inbound_callback API for message,2 => media_callback for media',
  `unique_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xkyknzl5dwfyk4hg_wishfin_whatsapp`
--

CREATE TABLE IF NOT EXISTS `xkyknzl5dwfyk4hg_wishfin_whatsapp` (
  `id` int(11) unsigned NOT NULL,
  `template_id` int(11) unsigned NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `unique_id` int(11) unsigned NOT NULL,
  `process_name` varchar(255) DEFAULT NULL,
  `mobile_number` bigint(20) unsigned NOT NULL DEFAULT '0',
  `variables` text,
  `whatsapp_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 => Pending,1 => In Queue ,2 => Send',
  `send_date` datetime NOT NULL,
  `attempt` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 => Active , 0 => Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xkyknzl5dwfyk4hg_wish_travel`
--

CREATE TABLE IF NOT EXISTS `xkyknzl5dwfyk4hg_wish_travel` (
  `id` int(11) unsigned NOT NULL,
  `total_budget` int(11) unsigned NOT NULL,
  `city_id` int(11) unsigned NOT NULL,
  `monthly_income` int(11) unsigned DEFAULT NULL,
  `travelling_with` tinyint(1) unsigned DEFAULT NULL COMMENT '1 => Family, 2 => Friends',
  `no_of_person` tinyint(1) unsigned DEFAULT NULL,
  `total_savings` int(11) unsigned DEFAULT NULL,
  `other_emi` mediumint(8) unsigned DEFAULT NULL,
  `age` tinyint(1) unsigned DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `package_id` varchar(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile_number` bigint(20) unsigned DEFAULT NULL,
  `offer_update` tinyint(1) DEFAULT '0',
  `travel_insurance` tinyint(1) DEFAULT '0',
  `reference_hash` varchar(45) NOT NULL COMMENT 'This column will save the User Referecnce Hash Key',
  `master_user_id` int(11) unsigned DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 => Active , 0 => Deactive',
  `budget_flag` tinyint(1) unsigned DEFAULT NULL COMMENT '1 => System, 0 => User',
  `fb_share_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 => Done , 0 => Pending',
  `apply_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1 => Done,0 => Pending',
  `otp` varchar(10) NOT NULL,
  `otp_validate` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `source` varchar(50) NOT NULL,
  `utm_source` varchar(50) DEFAULT NULL,
  `utm_medium` varchar(50) DEFAULT NULL,
  `utm_campaign` varchar(100) DEFAULT NULL,
  `ip_address` varchar(30) NOT NULL,
  `pagename` varchar(80) NOT NULL DEFAULT '',
  `referrer_address` varchar(255) NOT NULL,
  `querystring` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xkyknzl5dwfyk4hg_wish_travel_data_city_list`
--

CREATE TABLE IF NOT EXISTS `xkyknzl5dwfyk4hg_wish_travel_data_city_list` (
  `id` int(11) unsigned NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL COMMENT '1 = Domestic, 2 = International, 0 = Other',
  `cost_per_person_3_star` int(11) unsigned NOT NULL,
  `total_nd` varchar(45) DEFAULT NULL,
  `airfare` varchar(50) DEFAULT NULL,
  `visa_fee` varchar(50) DEFAULT NULL,
  `meals` varchar(45) DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1 => Active , 0 => Deactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `xkyknzl5dwfyk4hg_wish_travel_data_package_list`
--

CREATE TABLE IF NOT EXISTS `xkyknzl5dwfyk4hg_wish_travel_data_package_list` (
  `package_id` varchar(10) NOT NULL DEFAULT '',
  `package_name` varchar(255) DEFAULT NULL,
  `destination` varchar(30) DEFAULT NULL,
  `package_type` varchar(20) DEFAULT NULL,
  `package_sub_type` varchar(50) DEFAULT NULL,
  `places_covered` varchar(52) DEFAULT NULL,
  `starting_price` decimal(8,2) DEFAULT NULL,
  `discount_percentage` int(11) NOT NULL,
  `max_discount` decimal(8,2) NOT NULL,
  `hubs` varchar(255) DEFAULT NULL,
  `vendor` varchar(20) NOT NULL,
  `package_end_date` date NOT NULL DEFAULT '2099-12-31',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `yes_cc_city_state_list`
--

CREATE TABLE IF NOT EXISTS `yes_cc_city_state_list` (
  `id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `area` text NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `yes_cc_company_list`
--

CREATE TABLE IF NOT EXISTS `yes_cc_company_list` (
  `yescompid` int(11) unsigned NOT NULL,
  `yes_internal_link` varchar(10) NOT NULL,
  `yes_company_name` varchar(255) NOT NULL,
  `yes_aps_company_name` varchar(255) NOT NULL,
  `yes_aps_company_code` varchar(10) NOT NULL,
  `yes_company_category` varchar(10) NOT NULL,
  `yes_company_cin` varchar(50) NOT NULL,
  `yes_company_name_full` varchar(255) NOT NULL,
  `yes_company_city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `z2v_transactions`
--

CREATE TABLE IF NOT EXISTS `z2v_transactions` (
  `id` int(11) NOT NULL,
  `client_transaction_id` varchar(50) NOT NULL,
  `zipdial_no` varchar(50) NOT NULL,
  `transaction_token` varchar(200) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `viewable` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `z2v_transactions2`
--

CREATE TABLE IF NOT EXISTS `z2v_transactions2` (
  `id` int(11) NOT NULL,
  `client_transaction_id` varchar(20) NOT NULL DEFAULT '',
  `zipdial_no` varchar(15) DEFAULT NULL,
  `transaction_token` varchar(50) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `viewable` varchar(14) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zexternal_appointment_details`
--

CREATE TABLE IF NOT EXISTS `zexternal_appointment_details` (
  `statid` int(11) NOT NULL,
  `leadlogid` int(11) NOT NULL,
  `AllRequestID` int(11) NOT NULL,
  `Reply_Type` int(11) NOT NULL,
  `caller_id` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `final_bidderid` varchar(20) NOT NULL,
  `Bidder_Number` bigint(20) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `appt_date` datetime NOT NULL,
  `appt_time` varchar(150) NOT NULL,
  `special_remarks` text,
  `IDProof` varchar(40) NOT NULL,
  `AddressProof` varchar(40) NOT NULL,
  `PanCard` varchar(40) NOT NULL,
  `SalSlip` varchar(40) NOT NULL,
  `BankStmnt` varchar(40) NOT NULL,
  `PassSizePhoto` varchar(40) NOT NULL,
  `escalation1` tinyint(4) NOT NULL,
  `escalation2` tinyint(4) NOT NULL,
  `escalation3` tinyint(11) NOT NULL,
  `final_feedback` varchar(50) DEFAULT NULL,
  `final_remarks` text NOT NULL,
  `final_team_feedback` varchar(100) NOT NULL,
  `Flag` tinyint(1) NOT NULL,
  `stat_dated` datetime NOT NULL,
  `finalstat_dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zexternal_appointment_docs`
--

CREATE TABLE IF NOT EXISTS `zexternal_appointment_docs` (
  `id` int(11) NOT NULL,
  `caller_id` int(11) NOT NULL,
  `RequestID` int(11) NOT NULL,
  `CityName` varchar(100) NOT NULL,
  `Reply_Type` int(11) NOT NULL,
  `Address` text NOT NULL,
  `IDProof` varchar(100) NOT NULL,
  `AddressProof` varchar(150) NOT NULL,
  `PanCard` varchar(100) NOT NULL,
  `SalSlip` varchar(100) NOT NULL,
  `BankStmnt` varchar(100) NOT NULL,
  `PassSizePhoto` varchar(100) NOT NULL,
  `IDProof_Status` tinyint(4) NOT NULL,
  `AddressProof_Status` tinyint(4) NOT NULL,
  `PanCard_Status` tinyint(4) NOT NULL,
  `SalSlip_Status` tinyint(4) NOT NULL,
  `BankStmnt_Status` tinyint(4) NOT NULL,
  `PassSizePhoto_Status` tinyint(4) NOT NULL,
  `leadlogid` int(11) NOT NULL,
  `apptdetailsid` int(11) NOT NULL,
  `docpickerid` int(11) NOT NULL,
  `AssignBy` varchar(100) NOT NULL,
  `docStatus` int(11) NOT NULL,
  `appt_date` datetime NOT NULL,
  `appt_time` varchar(30) NOT NULL,
  `special_remarks` varchar(255) NOT NULL,
  `rescheduled` tinyint(4) NOT NULL,
  `spoc_status` varchar(50) NOT NULL,
  `dated` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `Landmark` varchar(100) NOT NULL,
  `assigned_remark` text NOT NULL,
  `doc_pickup_remark` text NOT NULL,
  `viewstatus` tinyint(4) NOT NULL,
  `AgentFeedback` tinyint(4) NOT NULL DEFAULT '0',
  `Feedback_ID` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `BankID` int(11) NOT NULL,
  `feedback_date` datetime NOT NULL,
  `disbursed_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zexternal_appointment_users`
--

CREATE TABLE IF NOT EXISTS `zexternal_appointment_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Mobile_Number` bigint(20) NOT NULL,
  `City` varchar(80) NOT NULL,
  `City_List` text NOT NULL,
  `Dated` datetime NOT NULL,
  `Reply_Type` int(11) NOT NULL DEFAULT '1',
  `Status` tinyint(4) NOT NULL,
  `UserType` varchar(20) NOT NULL,
  `GlobalID` int(11) NOT NULL,
  `Owner` int(11) NOT NULL,
  `Product_pl` tinyint(4) NOT NULL,
  `Product_hl` tinyint(4) NOT NULL,
  `Product_cl` tinyint(4) NOT NULL,
  `Product_lap` tinyint(4) NOT NULL,
  `Product_cc` tinyint(4) NOT NULL,
  `Product_bl` tinyint(4) NOT NULL,
  `vsts_code` varchar(40) NOT NULL,
  `agent_id` varchar(255) NOT NULL,
  `leadidentifier` varchar(50) NOT NULL,
  `bank_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zexternal_campaign_smscontact`
--

CREATE TABLE IF NOT EXISTS `zexternal_campaign_smscontact` (
  `Compaign_ID` int(11) NOT NULL,
  `Reply_Type` tinyint(4) NOT NULL DEFAULT '0',
  `Bank_Name` varchar(50) NOT NULL DEFAULT '',
  `RequestID` int(20) DEFAULT NULL,
  `BidderID` int(10) NOT NULL DEFAULT '0',
  `Start_Date` date NOT NULL DEFAULT '0000-00-00',
  `City_Wise` varchar(255) NOT NULL DEFAULT '',
  `Sms_Flag` tinyint(4) NOT NULL DEFAULT '0',
  `Mobile_no` varchar(50) NOT NULL DEFAULT '',
  `Sequence_no` tinyint(4) NOT NULL DEFAULT '0',
  `priority` tinyint(4) NOT NULL DEFAULT '0',
  `Dated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zexternal_lap_documents`
--

CREATE TABLE IF NOT EXISTS `zexternal_lap_documents` (
  `docs_id` int(11) NOT NULL,
  `Name_Caption` text NOT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT '1',
  `Parent_Key` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zexternal_leadallocation_log`
--

CREATE TABLE IF NOT EXISTS `zexternal_leadallocation_log` (
  `leadlogid` int(11) NOT NULL,
  `BidderID` int(11) NOT NULL,
  `ProductID` tinyint(4) NOT NULL,
  `bidder_number` bigint(20) NOT NULL,
  `Sendnow_Date` datetime NOT NULL,
  `RequestID` int(11) NOT NULL,
  `CallerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `zexternal_send_appointment_sms`
--

CREATE TABLE IF NOT EXISTS `zexternal_send_appointment_sms` (
  `id` int(11) NOT NULL,
  `send_id` int(11) NOT NULL,
  `send_name` varchar(70) NOT NULL,
  `send_mobile` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `dated` datetime NOT NULL,
  `appt_date` date NOT NULL,
  `send_status` tinyint(4) NOT NULL,
  `appt_send_status` tinyint(4) NOT NULL,
  `user_type` varchar(17) NOT NULL,
  `process` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `z_validate_ip_address`
--

CREATE TABLE IF NOT EXISTS `z_validate_ip_address` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(30) NOT NULL,
  `internal_system` tinyint(1) NOT NULL DEFAULT '1',
  `external_system` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `process_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `Req_Quick_201601`
--
DROP TABLE IF EXISTS `Req_Quick_201601`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Req_Quick_201601` AS select 71000 AS `TOTALLEADS`;

-- --------------------------------------------------------

--
-- Structure for view `Req_Quick_201602`
--
DROP TABLE IF EXISTS `Req_Quick_201602`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `Req_Quick_201602` AS select 64000 AS `TOTALLEADS`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Advertise_with_us`
--
ALTER TABLE `Advertise_with_us`
  ADD PRIMARY KEY (`advertiseid`);

--
-- Indexes for table `allocation_leads_barclays`
--
ALTER TABLE `allocation_leads_barclays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amex_cardwebservice`
--
ALTER TABLE `amex_cardwebservice`
  ADD PRIMARY KEY (`amex_ccid`);

--
-- Indexes for table `amex_negative_pincode`
--
ALTER TABLE `amex_negative_pincode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_customer_cibil`
--
ALTER TABLE `api_customer_cibil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_log_cibil`
--
ALTER TABLE `api_log_cibil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `cibil_score` (`cibil_score`),
  ADD KEY `productid_2` (`productid`);

--
-- Indexes for table `api_log_cibil_dummy`
--
ALTER TABLE `api_log_cibil_dummy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productid` (`productid`),
  ADD KEY `cibil_score` (`cibil_score`),
  ADD KEY `productid_2` (`productid`);

--
-- Indexes for table `apply_pl_capitalfirst`
--
ALTER TABLE `apply_pl_capitalfirst`
  ADD PRIMARY KEY (`capitalfirstid`),
  ADD KEY `capitalfirst_requestid` (`capitalfirst_requestid`);

--
-- Indexes for table `Articles`
--
ALTER TABLE `Articles`
  ADD PRIMARY KEY (`Art_ID`),
  ADD KEY `Art_Main_Title` (`Art_Main_Title`),
  ADD KEY `Art_DOE` (`Art_DOE`);

--
-- Indexes for table `Ask_Amitoj_Reply`
--
ALTER TABLE `Ask_Amitoj_Reply`
  ADD PRIMARY KEY (`AskReplyID`);

--
-- Indexes for table `Ask_Amitoj_Section`
--
ALTER TABLE `Ask_Amitoj_Section`
  ADD PRIMARY KEY (`AskID`);

--
-- Indexes for table `automated_mailers`
--
ALTER TABLE `automated_mailers`
  ADD PRIMARY KEY (`automatID`);

--
-- Indexes for table `axis_mailers`
--
ALTER TABLE `axis_mailers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bajajallianz_carloancomp`
--
ALTER TABLE `bajajallianz_carloancomp`
  ADD PRIMARY KEY (`bajaj_clid`);

--
-- Indexes for table `bajajfinserv_bidders`
--
ALTER TABLE `bajajfinserv_bidders`
  ADD PRIMARY KEY (`bajajfinservid`);

--
-- Indexes for table `bajajfinserv_bldetails`
--
ALTER TABLE `bajajfinserv_bldetails`
  ADD PRIMARY KEY (`bajajblid`);

--
-- Indexes for table `bajajfinserv_citypsf_mapping`
--
ALTER TABLE `bajajfinserv_citypsf_mapping`
  ADD PRIMARY KEY (`bajajfmapid`);

--
-- Indexes for table `bajaj_cibildetails`
--
ALTER TABLE `bajaj_cibildetails`
  ADD PRIMARY KEY (`bajajcibilid`);

--
-- Indexes for table `bajaj_finserv_mailer_leads`
--
ALTER TABLE `bajaj_finserv_mailer_leads`
  ADD PRIMARY KEY (`bajaj_finservid`);

--
-- Indexes for table `bajaj_finserv_mailer_leads_data`
--
ALTER TABLE `bajaj_finserv_mailer_leads_data`
  ADD PRIMARY KEY (`bajaj_finservid`);

--
-- Indexes for table `bank_documents_required`
--
ALTER TABLE `bank_documents_required`
  ADD PRIMARY KEY (`documentid`);

--
-- Indexes for table `Bank_Master`
--
ALTER TABLE `Bank_Master`
  ADD PRIMARY KEY (`BankID`),
  ADD KEY `BankID` (`BankID`);

--
-- Indexes for table `Barclays_Credit_Card`
--
ALTER TABLE `Barclays_Credit_Card`
  ADD PRIMARY KEY (`BarclayID`),
  ADD KEY `BarclayID` (`BarclayID`);

--
-- Indexes for table `barclays_pincode_list`
--
ALTER TABLE `barclays_pincode_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `BD_List`
--
ALTER TABLE `BD_List`
  ADD PRIMARY KEY (`BD_ID`);

--
-- Indexes for table `BD_Mgmt_Entry`
--
ALTER TABLE `BD_Mgmt_Entry`
  ADD PRIMARY KEY (`BME_ID`);

--
-- Indexes for table `BD_Mgmt_User`
--
ALTER TABLE `BD_Mgmt_User`
  ADD PRIMARY KEY (`BMU_ID`);

--
-- Indexes for table `BidderDownloadCount`
--
ALTER TABLE `BidderDownloadCount`
  ADD PRIMARY KEY (`BD_ID`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `BidderDownloadCount_new`
--
ALTER TABLE `BidderDownloadCount_new`
  ADD PRIMARY KEY (`BD_ID`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `Bidders`
--
ALTER TABLE `Bidders`
  ADD PRIMARY KEY (`BidderID`),
  ADD KEY `City` (`City`),
  ADD KEY `Reply_Type` (`Reply_Type`),
  ADD KEY `leadidentifier` (`leadidentifier`),
  ADD KEY `Global_Access_ID` (`Global_Access_ID`);

--
-- Indexes for table `BiddersLoginDetails`
--
ALTER TABLE `BiddersLoginDetails`
  ADD PRIMARY KEY (`TrackID`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `Bidders_Book_Keeping`
--
ALTER TABLE `Bidders_Book_Keeping`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `BookDate` (`BookDate`),
  ADD KEY `BookWeek` (`BookWeek`),
  ADD KEY `BookMonth` (`BookMonth`),
  ADD KEY `BookYear` (`BookYear`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `BidderID_2` (`BidderID`),
  ADD KEY `BookProduct` (`BookProduct`);

--
-- Indexes for table `Bidders_Book_Keeping_CC`
--
ALTER TABLE `Bidders_Book_Keeping_CC`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `BookDate` (`BookDate`),
  ADD KEY `BookWeek` (`BookWeek`),
  ADD KEY `BookMonth` (`BookMonth`),
  ADD KEY `BookYear` (`BookYear`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `BidderID_2` (`BidderID`),
  ADD KEY `BookProduct` (`BookProduct`);

--
-- Indexes for table `Bidders_Book_Keeping_CL`
--
ALTER TABLE `Bidders_Book_Keeping_CL`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `BookDate` (`BookDate`),
  ADD KEY `BookWeek` (`BookWeek`),
  ADD KEY `BookMonth` (`BookMonth`),
  ADD KEY `BookYear` (`BookYear`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `Bidders_Book_Keeping_dec11`
--
ALTER TABLE `Bidders_Book_Keeping_dec11`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `BookDate` (`BookDate`),
  ADD KEY `BookWeek` (`BookWeek`),
  ADD KEY `BookMonth` (`BookMonth`),
  ADD KEY `BookYear` (`BookYear`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `BidderID_2` (`BidderID`),
  ADD KEY `BookProduct` (`BookProduct`);

--
-- Indexes for table `Bidders_Book_Keeping_HL`
--
ALTER TABLE `Bidders_Book_Keeping_HL`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `BookDate` (`BookDate`),
  ADD KEY `BookWeek` (`BookWeek`),
  ADD KEY `BookMonth` (`BookMonth`),
  ADD KEY `BookYear` (`BookYear`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `Bidders_Book_Keeping_ivr`
--
ALTER TABLE `Bidders_Book_Keeping_ivr`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `BookLeadCount` (`BookLeadCount`),
  ADD KEY `BookEntryTime` (`BookEntryTime`);

--
-- Indexes for table `Bidders_Book_Keeping_LAP`
--
ALTER TABLE `Bidders_Book_Keeping_LAP`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `BookDate` (`BookDate`),
  ADD KEY `BookWeek` (`BookWeek`),
  ADD KEY `BookMonth` (`BookMonth`),
  ADD KEY `BookYear` (`BookYear`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `Bidders_Book_Keeping_nov21`
--
ALTER TABLE `Bidders_Book_Keeping_nov21`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `BookDate` (`BookDate`),
  ADD KEY `BookWeek` (`BookWeek`),
  ADD KEY `BookMonth` (`BookMonth`),
  ADD KEY `BookYear` (`BookYear`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `BidderID_2` (`BidderID`),
  ADD KEY `BookProduct` (`BookProduct`);

--
-- Indexes for table `Bidders_Book_Keeping_PL`
--
ALTER TABLE `Bidders_Book_Keeping_PL`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `BookDate` (`BookDate`),
  ADD KEY `BookWeek` (`BookWeek`),
  ADD KEY `BookMonth` (`BookMonth`),
  ADD KEY `BookYear` (`BookYear`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `Bidders_Insertion`
--
ALTER TABLE `Bidders_Insertion`
  ADD PRIMARY KEY (`BidderInsertionID`);

--
-- Indexes for table `Bidders_ivr`
--
ALTER TABLE `Bidders_ivr`
  ADD PRIMARY KEY (`BidderID`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Bidders_List`
--
ALTER TABLE `Bidders_List`
  ADD UNIQUE KEY `Bidder_listID` (`Bidder_listID`),
  ADD KEY `Reply_Type` (`Reply_Type`),
  ADD KEY `Restrict_Bidder` (`Restrict_Bidder`),
  ADD KEY `CapLead_Count` (`CapLead_Count`);

--
-- Indexes for table `Bidders_List_ivr`
--
ALTER TABLE `Bidders_List_ivr`
  ADD UNIQUE KEY `Bidder_listID` (`Bidder_listID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Bidders_Login_Details`
--
ALTER TABLE `Bidders_Login_Details`
  ADD PRIMARY KEY (`TrackID`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `Bidders_Mailers`
--
ALTER TABLE `Bidders_Mailers`
  ADD PRIMARY KEY (`R_ID`);

--
-- Indexes for table `Bidders_Package_Log`
--
ALTER TABLE `Bidders_Package_Log`
  ADD PRIMARY KEY (`bpl_id`);

--
-- Indexes for table `bidders_session_details`
--
ALTER TABLE `bidders_session_details`
  ADD PRIMARY KEY (`bidsessid`);

--
-- Indexes for table `Bidder_Contact_To_Customers`
--
ALTER TABLE `Bidder_Contact_To_Customers`
  ADD PRIMARY KEY (`BidderContactID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `bidder_downloads`
--
ALTER TABLE `bidder_downloads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bidder_downloads1`
--
ALTER TABLE `bidder_downloads1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Bidder_ivr_Contact`
--
ALTER TABLE `Bidder_ivr_Contact`
  ADD PRIMARY KEY (`BicID`),
  ADD KEY `PromptID` (`PromptID`);

--
-- Indexes for table `Bidder_Views`
--
ALTER TABLE `Bidder_Views`
  ADD PRIMARY KEY (`ViewID`);

--
-- Indexes for table `bike_list`
--
ALTER TABLE `bike_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Billing_List`
--
ALTER TABLE `Billing_List`
  ADD PRIMARY KEY (`BillingID`);

--
-- Indexes for table `Billing_User`
--
ALTER TABLE `Billing_User`
  ADD PRIMARY KEY (`Billing_ID`);

--
-- Indexes for table `Bill_Record`
--
ALTER TABLE `Bill_Record`
  ADD PRIMARY KEY (`BID`);

--
-- Indexes for table `B_List_Property`
--
ALTER TABLE `B_List_Property`
  ADD UNIQUE KEY `Bidder_listID` (`Bidder_listID`),
  ADD KEY `Reply_Type` (`Reply_Type`),
  ADD KEY `Restrict_Bidder` (`Restrict_Bidder`),
  ADD KEY `CapLead_Count` (`CapLead_Count`);

--
-- Indexes for table `B_Property`
--
ALTER TABLE `B_Property`
  ADD PRIMARY KEY (`BidderID`),
  ADD KEY `City` (`City`),
  ADD KEY `Reply_Type` (`Reply_Type`),
  ADD KEY `Define_PrePost` (`Define_PrePost`);

--
-- Indexes for table `campaign_pixel_capture`
--
ALTER TABLE `campaign_pixel_capture`
  ADD PRIMARY KEY (`campid`);

--
-- Indexes for table `captute_banner_click`
--
ALTER TABLE `captute_banner_click`
  ADD PRIMARY KEY (`captuteid`);

--
-- Indexes for table `cards_curing_queue`
--
ALTER TABLE `cards_curing_queue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AgentID` (`AgentID`),
  ADD KEY `dated` (`dated`);

--
-- Indexes for table `card_properties`
--
ALTER TABLE `card_properties`
  ADD PRIMARY KEY (`CardpropID`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career_job_apply`
--
ALTER TABLE `career_job_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carloan_mailers`
--
ALTER TABLE `carloan_mailers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_company_category`
--
ALTER TABLE `car_company_category`
  ADD PRIMARY KEY (`carcmpid`);

--
-- Indexes for table `car_loan_interest_rate`
--
ALTER TABLE `car_loan_interest_rate`
  ADD PRIMARY KEY (`B_id`);

--
-- Indexes for table `car_loan_state_category`
--
ALTER TABLE `car_loan_state_category`
  ADD PRIMARY KEY (`clstateid`);

--
-- Indexes for table `ccndc_diningcity`
--
ALTER TABLE `ccndc_diningcity`
  ADD PRIMARY KEY (`ccndc_dinid`);

--
-- Indexes for table `cc_american_express`
--
ALTER TABLE `cc_american_express`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Chat_Registered_User`
--
ALTER TABLE `Chat_Registered_User`
  ADD PRIMARY KEY (`ChatID`),
  ADD KEY `Chat_Contact` (`Chat_Contact`);

--
-- Indexes for table `citibankcards_negative_complist`
--
ALTER TABLE `citibankcards_negative_complist`
  ADD PRIMARY KEY (`compid`);

--
-- Indexes for table `citibank_company_list`
--
ALTER TABLE `citibank_company_list`
  ADD PRIMARY KEY (`companyid`),
  ADD KEY `companyid` (`companyid`);

--
-- Indexes for table `citibank_credit_card_6250`
--
ALTER TABLE `citibank_credit_card_6250`
  ADD PRIMARY KEY (`citiccid`);

--
-- Indexes for table `citibank_pincode_6250`
--
ALTER TABLE `citibank_pincode_6250`
  ADD PRIMARY KEY (`citipinid`);

--
-- Indexes for table `citi_appointments`
--
ALTER TABLE `citi_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RequestID` (`RequestID`);

--
-- Indexes for table `city_hl_pages`
--
ALTER TABLE `city_hl_pages`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `city_pages`
--
ALTER TABLE `city_pages`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `click2call`
--
ALTER TABLE `click2call`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_campaign_leads`
--
ALTER TABLE `client_campaign_leads`
  ADD PRIMARY KEY (`clientldid`);

--
-- Indexes for table `client_lead_allocate`
--
ALTER TABLE `client_lead_allocate`
  ADD PRIMARY KEY (`leadid`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `client_lead_allocated_comment`
--
ALTER TABLE `client_lead_allocated_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clubbed_company_list`
--
ALTER TABLE `clubbed_company_list`
  ADD PRIMARY KEY (`supercompanyid`),
  ADD KEY `supercompanyid` (`supercompanyid`),
  ADD KEY `supercompany_name` (`supercompany_name`);

--
-- Indexes for table `cl_company_list_hdfc`
--
ALTER TABLE `cl_company_list_hdfc`
  ADD PRIMARY KEY (`clcomplistid`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `comments_pages`
--
ALTER TABLE `comments_pages`
  ADD PRIMARY KEY (`Rid`);

--
-- Indexes for table `commonfloor_hlcampaign`
--
ALTER TABLE `commonfloor_hlcampaign`
  ADD PRIMARY KEY (`leadid`);

--
-- Indexes for table `compaign_bidders_list`
--
ALTER TABLE `compaign_bidders_list`
  ADD UNIQUE KEY `Bidder_listID` (`Bidder_listID`),
  ADD KEY `Reply_Type` (`Reply_Type`),
  ADD KEY `Restrict_Bidder` (`Restrict_Bidder`),
  ADD KEY `CapLead_Count` (`CapLead_Count`);

--
-- Indexes for table `Compaign_Credit_Card`
--
ALTER TABLE `Compaign_Credit_Card`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`);

--
-- Indexes for table `cpp_card_protection_leads`
--
ALTER TABLE `cpp_card_protection_leads`
  ADD PRIMARY KEY (`CPP_ID`),
  ADD KEY `CPP_RequestID` (`CPP_RequestID`),
  ADD KEY `CPP_Mobile_Number` (`CPP_Mobile_Number`),
  ADD KEY `CPP_Dated` (`CPP_Dated`);

--
-- Indexes for table `creditcard_citylist`
--
ALTER TABLE `creditcard_citylist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditndebit_card_offer`
--
ALTER TABLE `creditndebit_card_offer`
  ADD PRIMARY KEY (`ccndc_offerid`),
  ADD KEY `ccndc_offer_type` (`ccndc_offer_type`),
  ADD KEY `bank_name` (`bank_name`),
  ADD KEY `new_bank_name` (`new_bank_name`);

--
-- Indexes for table `creditndebit_card_reward_offer`
--
ALTER TABLE `creditndebit_card_reward_offer`
  ADD PRIMARY KEY (`ccndc_reid`);

--
-- Indexes for table `credit_card_banks_apply`
--
ALTER TABLE `credit_card_banks_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_card_banks_apply_log`
--
ALTER TABLE `credit_card_banks_apply_log`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `credit_card_banks_eligibility`
--
ALTER TABLE `credit_card_banks_eligibility`
  ADD PRIMARY KEY (`cc_bankid`),
  ADD KEY `cc_bank_fee` (`cc_bank_fee`),
  ADD KEY `cc_bank_flag` (`cc_bank_flag`);

--
-- Indexes for table `credit_card_cibil_check`
--
ALTER TABLE `credit_card_cibil_check`
  ADD PRIMARY KEY (`cibilchkid`),
  ADD KEY `RequestID` (`RequestID`),
  ADD KEY `flag` (`flag`);

--
-- Indexes for table `credit_card_listing`
--
ALTER TABLE `credit_card_listing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_card_mail_logs`
--
ALTER TABLE `credit_card_mail_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `Crossword_Details`
--
ALTER TABLE `Crossword_Details`
  ADD PRIMARY KEY (`CrosswordD_ID`);

--
-- Indexes for table `customer_experience_with_banks`
--
ALTER TABLE `customer_experience_with_banks`
  ADD PRIMARY KEY (`feedbackid`),
  ADD KEY `requestid` (`requestid`),
  ADD KEY `gone_to_bankid` (`gone_to_bankid`),
  ADD KEY `productid` (`productid`),
  ADD KEY `bank_experience` (`bank_experience`);

--
-- Indexes for table `customer_feedback_verified`
--
ALTER TABLE `customer_feedback_verified`
  ADD PRIMARY KEY (`custfbvdid`);

--
-- Indexes for table `d4l_smscampaign_leads`
--
ALTER TABLE `d4l_smscampaign_leads`
  ADD PRIMARY KEY (`d4lcampid`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `entry_id` (`entry_id`);

--
-- Indexes for table `data_prepaid_aug`
--
ALTER TABLE `data_prepaid_aug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dcb_cards_pincode`
--
ALTER TABLE `dcb_cards_pincode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debt_counseling`
--
ALTER TABLE `debt_counseling`
  ADD PRIMARY KEY (`dbtid`);

--
-- Indexes for table `DND_customer_details`
--
ALTER TABLE `DND_customer_details`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`);

--
-- Indexes for table `docs_uploaded`
--
ALTER TABLE `docs_uploaded`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docs_uploaded_blue`
--
ALTER TABLE `docs_uploaded_blue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docs_uploaded_fil`
--
ALTER TABLE `docs_uploaded_fil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RequestID` (`RequestID`);

--
-- Indexes for table `docs_uploaded_hl`
--
ALTER TABLE `docs_uploaded_hl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Dummy_Bidders`
--
ALTER TABLE `Dummy_Bidders`
  ADD PRIMARY KEY (`BidderID`);

--
-- Indexes for table `Dummy_Bidders_List`
--
ALTER TABLE `Dummy_Bidders_List`
  ADD UNIQUE KEY `Bidder_listID` (`Bidder_listID`);

--
-- Indexes for table `dummy_table`
--
ALTER TABLE `dummy_table`
  ADD PRIMARY KEY (`dumy_id`);

--
-- Indexes for table `Duplicate_Bidders_Book_Keeping`
--
ALTER TABLE `Duplicate_Bidders_Book_Keeping`
  ADD PRIMARY KEY (`BookID`),
  ADD KEY `BookDate` (`BookDate`),
  ADD KEY `BookWeek` (`BookWeek`),
  ADD KEY `BookMonth` (`BookMonth`),
  ADD KEY `BookYear` (`BookYear`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `Duplicate_Lead_Update`
--
ALTER TABLE `Duplicate_Lead_Update`
  ADD PRIMARY KEY (`duplicateid`),
  ADD KEY `duplicateid` (`duplicateid`);

--
-- Indexes for table `EBBusiness_leads_credithistory`
--
ALTER TABLE `EBBusiness_leads_credithistory`
  ADD PRIMARY KEY (`ebleadchid`);

--
-- Indexes for table `edelweiss_leads`
--
ALTER TABLE `edelweiss_leads`
  ADD PRIMARY KEY (`Edelweiss_ID`),
  ADD KEY `E_RequestID` (`E_RequestID`);

--
-- Indexes for table `Eligible_Bidder_List`
--
ALTER TABLE `Eligible_Bidder_List`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employee_survey`
--
ALTER TABLE `employee_survey`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `entry_id` (`entry_id`);

--
-- Indexes for table `exact_bidder_leads_count`
--
ALTER TABLE `exact_bidder_leads_count`
  ADD PRIMARY KEY (`lead_counid`);

--
-- Indexes for table `exclude_source_calling`
--
ALTER TABLE `exclude_source_calling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_cais_account_details`
--
ALTER TABLE `experian_cais_account_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_cais_account_history`
--
ALTER TABLE `experian_cais_account_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_caps_application_details`
--
ALTER TABLE `experian_caps_application_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_customer_othermisc_details`
--
ALTER TABLE `experian_customer_othermisc_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_customer_other_details`
--
ALTER TABLE `experian_customer_other_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_customer_primary_details`
--
ALTER TABLE `experian_customer_primary_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_customer_score_details`
--
ALTER TABLE `experian_customer_score_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_initial_details`
--
ALTER TABLE `experian_initial_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_log`
--
ALTER TABLE `experian_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_noncaps_application_details`
--
ALTER TABLE `experian_noncaps_application_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_vouchers_codes`
--
ALTER TABLE `experian_vouchers_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experian_xml_files`
--
ALTER TABLE `experian_xml_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fd_bidders_list`
--
ALTER TABLE `fd_bidders_list`
  ADD UNIQUE KEY `Bidder_listID` (`Bidder_listID`),
  ADD KEY `Reply_Type` (`Reply_Type`),
  ADD KEY `Restrict_Bidder` (`Restrict_Bidder`),
  ADD KEY `CapLead_Count` (`CapLead_Count`);

--
-- Indexes for table `fd_interestrates`
--
ALTER TABLE `fd_interestrates`
  ADD PRIMARY KEY (`fd_interestrateID`);

--
-- Indexes for table `fd_interestrate_bank`
--
ALTER TABLE `fd_interestrate_bank`
  ADD PRIMARY KEY (`fd_bankID`),
  ADD KEY `fd_bankID` (`fd_bankID`);

--
-- Indexes for table `feedback_bookkeeping`
--
ALTER TABLE `feedback_bookkeeping`
  ADD PRIMARY KEY (`feedbkid`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `FE_Questions`
--
ALTER TABLE `FE_Questions`
  ADD PRIMARY KEY (`FEID`);

--
-- Indexes for table `fil_appointments`
--
ALTER TABLE `fil_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RequestID` (`RequestID`);

--
-- Indexes for table `first_blue_leads`
--
ALTER TABLE `first_blue_leads`
  ADD PRIMARY KEY (`firstblueID`);

--
-- Indexes for table `fixed_deposit`
--
ALTER TABLE `fixed_deposit`
  ADD PRIMARY KEY (`requestid`);

--
-- Indexes for table `fs_category`
--
ALTER TABLE `fs_category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `Fullerton_Allocated_Leads`
--
ALTER TABLE `Fullerton_Allocated_Leads`
  ADD PRIMARY KEY (`fullertonrequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `TelecallerID` (`TelecallerID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `approved` (`approved`);

--
-- Indexes for table `fullerton_allocation_track`
--
ALTER TABLE `fullerton_allocation_track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fullerton_doc_list`
--
ALTER TABLE `fullerton_doc_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fullerton_exclusivecamp`
--
ALTER TABLE `fullerton_exclusivecamp`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `fullerton_leads`
--
ALTER TABLE `fullerton_leads`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `fullerton_leads_allocation`
--
ALTER TABLE `fullerton_leads_allocation`
  ADD PRIMARY KEY (`fullertonlid`);

--
-- Indexes for table `fullerton_pl_leads`
--
ALTER TABLE `fullerton_pl_leads`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `DOB` (`DOB`);

--
-- Indexes for table `getdata_logs`
--
ALTER TABLE `getdata_logs`
  ADD PRIMARY KEY (`getdatalgid`);

--
-- Indexes for table `getdata_tracking`
--
ALTER TABLE `getdata_tracking`
  ADD PRIMARY KEY (`getdataid`);

--
-- Indexes for table `get_eligible_leads`
--
ALTER TABLE `get_eligible_leads`
  ADD PRIMARY KEY (`GetID`),
  ADD KEY `GetID` (`GetID`);

--
-- Indexes for table `get_tataaig_leads`
--
ALTER TABLE `get_tataaig_leads`
  ADD PRIMARY KEY (`tataaigID`),
  ADD KEY `t_dated` (`t_dated`),
  ADD KEY `t_mobile` (`t_mobile`);

--
-- Indexes for table `hdbfc_companylist`
--
ALTER TABLE `hdbfc_companylist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdbfs_mailer_leads`
--
ALTER TABLE `hdbfs_mailer_leads`
  ADD PRIMARY KEY (`hdbfsid`);

--
-- Indexes for table `hdfcbank_citywise_contactdetails`
--
ALTER TABLE `hdfcbank_citywise_contactdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdfccarloan_leads`
--
ALTER TABLE `hdfccarloan_leads`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `hdfccc_leads`
--
ALTER TABLE `hdfccc_leads`
  ADD PRIMARY KEY (`hdfcccid`);

--
-- Indexes for table `hdfclife_compleads`
--
ALTER TABLE `hdfclife_compleads`
  ADD PRIMARY KEY (`hdfclifeid`),
  ADD KEY `hdfclife_dated` (`hdfclife_dated`);

--
-- Indexes for table `hdfcred_pixel_capture`
--
ALTER TABLE `hdfcred_pixel_capture`
  ADD PRIMARY KEY (`hdfcredid`);

--
-- Indexes for table `hdfc_balance_transfer_leads`
--
ALTER TABLE `hdfc_balance_transfer_leads`
  ADD PRIMARY KEY (`hdfcbtid`);

--
-- Indexes for table `hdfc_bidders`
--
ALTER TABLE `hdfc_bidders`
  ADD PRIMARY KEY (`Bid`);

--
-- Indexes for table `hdfc_bike_city`
--
ALTER TABLE `hdfc_bike_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdfc_card_for_card`
--
ALTER TABLE `hdfc_card_for_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdfc_car_list_category`
--
ALTER TABLE `hdfc_car_list_category`
  ADD PRIMARY KEY (`hdfc_clid`);

--
-- Indexes for table `hdfc_car_loan`
--
ALTER TABLE `hdfc_car_loan`
  ADD PRIMARY KEY (`hdfcccid`);

--
-- Indexes for table `hdfc_car_loan_gifts`
--
ALTER TABLE `hdfc_car_loan_gifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdfc_car_loan_leads`
--
ALTER TABLE `hdfc_car_loan_leads`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `HDFC_CC`
--
ALTER TABLE `HDFC_CC`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `HDFC_CC_Company_List`
--
ALTER TABLE `HDFC_CC_Company_List`
  ADD PRIMARY KEY (`hdfcccid`);

--
-- Indexes for table `hdfc_cl_appointments`
--
ALTER TABLE `hdfc_cl_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RequestID` (`RequestID`);

--
-- Indexes for table `hdfc_cl_companylist`
--
ALTER TABLE `hdfc_cl_companylist`
  ADD PRIMARY KEY (`hdfcclid`);

--
-- Indexes for table `hdfc_company_list`
--
ALTER TABLE `hdfc_company_list`
  ADD PRIMARY KEY (`companyid`);

--
-- Indexes for table `hdfc_company_list_gold`
--
ALTER TABLE `hdfc_company_list_gold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdfc_company_list_silver`
--
ALTER TABLE `hdfc_company_list_silver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdfc_credila_ncourse_list`
--
ALTER TABLE `hdfc_credila_ncourse_list`
  ADD PRIMARY KEY (`hdfc_credilaid`);

--
-- Indexes for table `hdfc_credit_card`
--
ALTER TABLE `hdfc_credit_card`
  ADD PRIMARY KEY (`hdfcccid`);

--
-- Indexes for table `hdfc_goldloan_citylist`
--
ALTER TABLE `hdfc_goldloan_citylist`
  ADD PRIMARY KEY (`hdfcglid`);

--
-- Indexes for table `hdfc_hlnlap_cronlog`
--
ALTER TABLE `hdfc_hlnlap_cronlog`
  ADD PRIMARY KEY (`hdfc_logid`),
  ADD KEY `hdfc_bidderid` (`hdfc_bidderid`);

--
-- Indexes for table `HDFC_homeloanBT`
--
ALTER TABLE `HDFC_homeloanBT`
  ADD PRIMARY KEY (`hdfchlbt_id`);

--
-- Indexes for table `hdfc_homeloan_lead_data`
--
ALTER TABLE `hdfc_homeloan_lead_data`
  ADD PRIMARY KEY (`Serial_No`);

--
-- Indexes for table `hdfc_meritus_scholarships`
--
ALTER TABLE `hdfc_meritus_scholarships`
  ADD PRIMARY KEY (`HdfcmeritID`),
  ADD KEY `Date_Of_Entry` (`Date_Of_Entry`);

--
-- Indexes for table `hdfc_pl_calc_leads`
--
ALTER TABLE `hdfc_pl_calc_leads`
  ADD PRIMARY KEY (`hdfcplid`),
  ADD KEY `mobile_number` (`mobile_number`);

--
-- Indexes for table `hdfc_pl_company_list`
--
ALTER TABLE `hdfc_pl_company_list`
  ADD PRIMARY KEY (`hdfcid`);

--
-- Indexes for table `hdfc_response_data`
--
ALTER TABLE `hdfc_response_data`
  ADD PRIMARY KEY (`hdfcresid`);

--
-- Indexes for table `hdfc_response_data_lap`
--
ALTER TABLE `hdfc_response_data_lap`
  ADD PRIMARY KEY (`hdfcresid`);

--
-- Indexes for table `hdfc_salary_cut`
--
ALTER TABLE `hdfc_salary_cut`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdfc_salary_cut_gold`
--
ALTER TABLE `hdfc_salary_cut_gold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hdfc_spl_city_rates`
--
ALTER TABLE `hdfc_spl_city_rates`
  ADD PRIMARY KEY (`hdfc_splid`);

--
-- Indexes for table `hesk_attachments`
--
ALTER TABLE `hesk_attachments`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indexes for table `hesk_categories`
--
ALTER TABLE `hesk_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hesk_replies`
--
ALTER TABLE `hesk_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replyto` (`replyto`);

--
-- Indexes for table `hesk_show_transcript`
--
ALTER TABLE `hesk_show_transcript`
  ADD PRIMARY KEY (`HtID`),
  ADD KEY `TrackID` (`TrackID`),
  ADD KEY `TrackFlag` (`TrackFlag`);

--
-- Indexes for table `hesk_std_replies`
--
ALTER TABLE `hesk_std_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hesk_tickets`
--
ALTER TABLE `hesk_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trackid` (`trackid`),
  ADD KEY `archive` (`archive`);

--
-- Indexes for table `hesk_users`
--
ALTER TABLE `hesk_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hlcallinglms_allocation`
--
ALTER TABLE `hlcallinglms_allocation`
  ADD PRIMARY KEY (`hlallocateid`);

--
-- Indexes for table `hlverifylms_allocation`
--
ALTER TABLE `hlverifylms_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hl_quote_shown`
--
ALTER TABLE `hl_quote_shown`
  ADD PRIMARY KEY (`hlquoteid`),
  ADD KEY `pl_leadid` (`hl_leadid`);

--
-- Indexes for table `hl_referral_leads`
--
ALTER TABLE `hl_referral_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homeloan_interest_rates`
--
ALTER TABLE `homeloan_interest_rates`
  ADD PRIMARY KEY (`hlrateid`);

--
-- Indexes for table `home_loan_bal_trans`
--
ALTER TABLE `home_loan_bal_trans`
  ADD PRIMARY KEY (`bal_id`);

--
-- Indexes for table `home_loan_eligibility`
--
ALTER TABLE `home_loan_eligibility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_loan_interest_rate_chart`
--
ALTER TABLE `home_loan_interest_rate_chart`
  ADD PRIMARY KEY (`hlrateid`),
  ADD KEY `hlrateid` (`hlrateid`),
  ADD KEY `tenure` (`tenure`),
  ADD KEY `flag` (`flag`),
  ADD KEY `bank_name` (`bank_name`);

--
-- Indexes for table `ibibo_compaign_leads`
--
ALTER TABLE `ibibo_compaign_leads`
  ADD PRIMARY KEY (`ibibo_id`);

--
-- Indexes for table `icicihfc_leads`
--
ALTER TABLE `icicihfc_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icicihl_lapreport`
--
ALTER TABLE `icicihl_lapreport`
  ADD PRIMARY KEY (`icicihlid`);

--
-- Indexes for table `icicilms_allocation`
--
ALTER TABLE `icicilms_allocation`
  ADD PRIMARY KEY (`iciciallocateid`),
  ADD KEY `cc_requestid` (`cc_requestid`),
  ADD KEY `bidderid` (`bidderid`),
  ADD KEY `icici_followupdate` (`icici_followupdate`);

--
-- Indexes for table `icicilms_loginlog`
--
ALTER TABLE `icicilms_loginlog`
  ADD PRIMARY KEY (`icicilogid`);

--
-- Indexes for table `icicipllms_allocation`
--
ALTER TABLE `icicipllms_allocation`
  ADD PRIMARY KEY (`iciciallocateid`),
  ADD KEY `icicirequestID` (`icicirequestID`),
  ADD KEY `bidderid` (`bidderid`),
  ADD KEY `icici_feedback` (`icici_feedback`),
  ADD KEY `icici_followupdate` (`icici_followupdate`);

--
-- Indexes for table `icicipl_appointment_details`
--
ALTER TABLE `icicipl_appointment_details`
  ADD PRIMARY KEY (`iciciaaptid`);

--
-- Indexes for table `icicipl_callLOG`
--
ALTER TABLE `icicipl_callLOG`
  ADD PRIMARY KEY (`callogid`);

--
-- Indexes for table `icicipl_webservice`
--
ALTER TABLE `icicipl_webservice`
  ADD PRIMARY KEY (`icicwcid`);

--
-- Indexes for table `icici_agent_leadallocation`
--
ALTER TABLE `icici_agent_leadallocation`
  ADD PRIMARY KEY (`allocationid`),
  ADD KEY `agentid` (`agentid`),
  ADD KEY `allrequestid` (`allrequestid`);

--
-- Indexes for table `ICICI_Allocated_Leads`
--
ALTER TABLE `ICICI_Allocated_Leads`
  ADD PRIMARY KEY (`icicirequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `TelecallerID` (`TelecallerID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `approved` (`approved`);

--
-- Indexes for table `icici_callingdata_DNC`
--
ALTER TABLE `icici_callingdata_DNC`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icici_cards_calling`
--
ALTER TABLE `icici_cards_calling`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Privacy` (`Privacy`),
  ADD KEY `TelecallerID` (`TelecallerID`);

--
-- Indexes for table `icici_car_loan_calc`
--
ALTER TABLE `icici_car_loan_calc`
  ADD PRIMARY KEY (`icici_clid`);

--
-- Indexes for table `ICICI_CCAppt_Details`
--
ALTER TABLE `ICICI_CCAppt_Details`
  ADD PRIMARY KEY (`ApptID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Appt_Date` (`Appt_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `icici_cc_city_state_list`
--
ALTER TABLE `icici_cc_city_state_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icici_city_cc_list`
--
ALTER TABLE `icici_city_cc_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icici_credit_card`
--
ALTER TABLE `icici_credit_card`
  ADD PRIMARY KEY (`iciciccid`);

--
-- Indexes for table `icici_exclusive_app`
--
ALTER TABLE `icici_exclusive_app`
  ADD PRIMARY KEY (`iciciappid`);

--
-- Indexes for table `icici_exclusive_application`
--
ALTER TABLE `icici_exclusive_application`
  ADD PRIMARY KEY (`iciciappid`);

--
-- Indexes for table `icici_exclusive_app_docs`
--
ALTER TABLE `icici_exclusive_app_docs`
  ADD PRIMARY KEY (`icicidocid`);

--
-- Indexes for table `icici_exclusive_transunion`
--
ALTER TABLE `icici_exclusive_transunion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icici_hfc_agents`
--
ALTER TABLE `icici_hfc_agents`
  ADD PRIMARY KEY (`agentid`),
  ADD KEY `agentid` (`agentid`);

--
-- Indexes for table `icici_hfc_location_list`
--
ALTER TABLE `icici_hfc_location_list`
  ADD PRIMARY KEY (`locationid`);

--
-- Indexes for table `icici_lead_allocation_table`
--
ALTER TABLE `icici_lead_allocation_table`
  ADD PRIMARY KEY (`lead_allocation_logic`);

--
-- Indexes for table `icici_organisation_list`
--
ALTER TABLE `icici_organisation_list`
  ADD PRIMARY KEY (`icici_orgid`);

--
-- Indexes for table `icici_pl_cibili_check`
--
ALTER TABLE `icici_pl_cibili_check`
  ADD PRIMARY KEY (`plcibilid`),
  ADD KEY `icicirequestID` (`icicirequestID`);

--
-- Indexes for table `icici_pl_referral_leads`
--
ALTER TABLE `icici_pl_referral_leads`
  ADD PRIMARY KEY (`icicildid`);

--
-- Indexes for table `ifsc_bank`
--
ALTER TABLE `ifsc_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ifsc_branch`
--
ALTER TABLE `ifsc_branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ifsc_state_dist`
--
ALTER TABLE `ifsc_state_dist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ifsc_state_dist_demo`
--
ALTER TABLE `ifsc_state_dist_demo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indusbank_exclusive_leads`
--
ALTER TABLE `indusbank_exclusive_leads`
  ADD PRIMARY KEY (`indusbnkid`);

--
-- Indexes for table `indusbnk_msging`
--
ALTER TABLE `indusbnk_msging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indusind_credit_card`
--
ALTER TABLE `indusind_credit_card`
  ADD PRIMARY KEY (`indusindccid`);

--
-- Indexes for table `ingvyasya_pl_calc_leads`
--
ALTER TABLE `ingvyasya_pl_calc_leads`
  ADD PRIMARY KEY (`ingvyasyaplid`),
  ADD KEY `mobile_number` (`mobile_number`),
  ADD KEY `Dated` (`Dated`);

--
-- Indexes for table `ingvysya_bidders`
--
ALTER TABLE `ingvysya_bidders`
  ADD PRIMARY KEY (`Bid`);

--
-- Indexes for table `ingvysya_companylist`
--
ALTER TABLE `ingvysya_companylist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ing_tempcomplist`
--
ALTER TABLE `ing_tempcomplist`
  ADD PRIMARY KEY (`ingid`);

--
-- Indexes for table `ip_whitelist`
--
ALTER TABLE `ip_whitelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komli_plcompaign`
--
ALTER TABLE `komli_plcompaign`
  ADD PRIMARY KEY (`komliplid`);

--
-- Indexes for table `kotak_credit_card_details`
--
ALTER TABLE `kotak_credit_card_details`
  ADD KEY `kotakID` (`kotakID`);

--
-- Indexes for table `lap_interest_rate`
--
ALTER TABLE `lap_interest_rate`
  ADD PRIMARY KEY (`B_id`);

--
-- Indexes for table `leads_with_other_processes`
--
ALTER TABLE `leads_with_other_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_allocate`
--
ALTER TABLE `lead_allocate`
  ADD PRIMARY KEY (`leadid`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `lead_allocate_140817`
--
ALTER TABLE `lead_allocate_140817`
  ADD PRIMARY KEY (`leadid`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `lead_allocate_160817`
--
ALTER TABLE `lead_allocate_160817`
  ADD PRIMARY KEY (`leadid`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `lead_allocation_table`
--
ALTER TABLE `lead_allocation_table`
  ADD PRIMARY KEY (`lead_allocation_logic`);

--
-- Indexes for table `lead_personal_loan_attributes`
--
ALTER TABLE `lead_personal_loan_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LMSLoginDetails`
--
ALTER TABLE `LMSLoginDetails`
  ADD PRIMARY KEY (`TrackID`);

--
-- Indexes for table `lms_access_attributes`
--
ALTER TABLE `lms_access_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_attributes`
--
ALTER TABLE `lms_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `LoanQuery`
--
ALTER TABLE `LoanQuery`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `loans_interest_rate`
--
ALTER TABLE `loans_interest_rate`
  ADD PRIMARY KEY (`interestID`);

--
-- Indexes for table `Logxy`
--
ALTER TABLE `Logxy`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `LeadID` (`LeadID`);

--
-- Indexes for table `Log_ivr`
--
ALTER TABLE `Log_ivr`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `LeadID` (`LeadID`);

--
-- Indexes for table `mailpancard1`
--
ALTER TABLE `mailpancard1`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `manual_user_details`
--
ALTER TABLE `manual_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_india_city`
--
ALTER TABLE `master_india_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_release_np`
--
ALTER TABLE `media_release_np`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publication_date` (`publication_date`);

--
-- Indexes for table `media_release_online`
--
ALTER TABLE `media_release_online`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publication_date` (`publication_date`);

--
-- Indexes for table `monthly_creditcard_offer`
--
ALTER TABLE `monthly_creditcard_offer`
  ADD PRIMARY KEY (`cc_offerid`),
  ADD KEY `compare_value` (`compare_value`),
  ADD KEY `compare_value_new` (`compare_value_new`);

--
-- Indexes for table `msging`
--
ALTER TABLE `msging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nests_comments`
--
ALTER TABLE `nests_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_approved` (`comment_approved`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`);

--
-- Indexes for table `nests_golfresult`
--
ALTER TABLE `nests_golfresult`
  ADD PRIMARY KEY (`result_aid`),
  ADD UNIQUE KEY `id` (`result_aid`);

--
-- Indexes for table `nests_golftable`
--
ALTER TABLE `nests_golftable`
  ADD PRIMARY KEY (`table_aid`),
  ADD UNIQUE KEY `id` (`table_aid`);

--
-- Indexes for table `nests_links`
--
ALTER TABLE `nests_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `nests_options`
--
ALTER TABLE `nests_options`
  ADD PRIMARY KEY (`option_id`,`blog_id`,`option_name`),
  ADD KEY `option_name` (`option_name`);

--
-- Indexes for table `nests_postmeta`
--
ALTER TABLE `nests_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`);

--
-- Indexes for table `nests_posts`
--
ALTER TABLE `nests_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`);

--
-- Indexes for table `nests_terms`
--
ALTER TABLE `nests_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `nests_term_relationships`
--
ALTER TABLE `nests_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `nests_term_taxonomy`
--
ALTER TABLE `nests_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `nests_usermeta`
--
ALTER TABLE `nests_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`);

--
-- Indexes for table `nests_users`
--
ALTER TABLE `nests_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`);

--
-- Indexes for table `Newsletter`
--
ALTER TABLE `Newsletter`
  ADD PRIMARY KEY (`News_Id`);

--
-- Indexes for table `Newsletter_Subscription`
--
ALTER TABLE `Newsletter_Subscription`
  ADD PRIMARY KEY (`subnewsid`);

--
-- Indexes for table `nm_comments`
--
ALTER TABLE `nm_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_approved` (`comment_approved`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`);

--
-- Indexes for table `nm_golfresult`
--
ALTER TABLE `nm_golfresult`
  ADD PRIMARY KEY (`result_aid`),
  ADD UNIQUE KEY `id` (`result_aid`);

--
-- Indexes for table `nm_golftable`
--
ALTER TABLE `nm_golftable`
  ADD PRIMARY KEY (`table_aid`),
  ADD UNIQUE KEY `id` (`table_aid`);

--
-- Indexes for table `nm_links`
--
ALTER TABLE `nm_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `nm_options`
--
ALTER TABLE `nm_options`
  ADD PRIMARY KEY (`option_id`,`blog_id`,`option_name`),
  ADD KEY `option_name` (`option_name`);

--
-- Indexes for table `nm_postmeta`
--
ALTER TABLE `nm_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`);

--
-- Indexes for table `nm_posts`
--
ALTER TABLE `nm_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`);

--
-- Indexes for table `nm_terms`
--
ALTER TABLE `nm_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `nm_term_relationships`
--
ALTER TABLE `nm_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `nm_term_taxonomy`
--
ALTER TABLE `nm_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `nm_usermeta`
--
ALTER TABLE `nm_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`);

--
-- Indexes for table `nm_users`
--
ALTER TABLE `nm_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`);

--
-- Indexes for table `non_dnc_tataaigleads`
--
ALTER TABLE `non_dnc_tataaigleads`
  ADD PRIMARY KEY (`non_dncid`);

--
-- Indexes for table `openers_datacheck`
--
ALTER TABLE `openers_datacheck`
  ADD PRIMARY KEY (`openersid`);

--
-- Indexes for table `other_city_list`
--
ALTER TABLE `other_city_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_purchase_details`
--
ALTER TABLE `package_purchase_details`
  ADD PRIMARY KEY (`Rid`);

--
-- Indexes for table `payment_cellnext_details`
--
ALTER TABLE `payment_cellnext_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personalloan_interest_rates_chart`
--
ALTER TABLE `personalloan_interest_rates_chart`
  ADD PRIMARY KEY (`plintr_id`);

--
-- Indexes for table `personal_loan_banks_eligibility`
--
ALTER TABLE `personal_loan_banks_eligibility`
  ADD PRIMARY KEY (`pl_bankid`);

--
-- Indexes for table `personal_loan_interest_rate_chart`
--
ALTER TABLE `personal_loan_interest_rate_chart`
  ADD PRIMARY KEY (`rateid`),
  ADD KEY `rateid` (`rateid`);

--
-- Indexes for table `personal_loan_updates`
--
ALTER TABLE `personal_loan_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plcallinglms_allocation`
--
ALTER TABLE `plcallinglms_allocation`
  ADD PRIMARY KEY (`plallocateid`),
  ADD KEY `DOE` (`DOE`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `PLivrBidders`
--
ALTER TABLE `PLivrBidders`
  ADD PRIMARY KEY (`BidderID`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `PLivrBiddersList`
--
ALTER TABLE `PLivrBiddersList`
  ADD UNIQUE KEY `Bidder_listID` (`Bidder_listID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `pllms_leadupload`
--
ALTER TABLE `pllms_leadupload`
  ADD PRIMARY KEY (`pllmsid`);

--
-- Indexes for table `pllms_sw_email`
--
ALTER TABLE `pllms_sw_email`
  ADD PRIMARY KEY (`pllms_swid`);

--
-- Indexes for table `pl_companylist_icici`
--
ALTER TABLE `pl_companylist_icici`
  ADD PRIMARY KEY (`compid`);

--
-- Indexes for table `pl_company_bajajfinserv`
--
ALTER TABLE `pl_company_bajajfinserv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_company_hdbfs`
--
ALTER TABLE `pl_company_hdbfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_company_hdfc`
--
ALTER TABLE `pl_company_hdfc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_company_hdfc_test`
--
ALTER TABLE `pl_company_hdfc_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_company_icici`
--
ALTER TABLE `pl_company_icici`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_company_iciciapp`
--
ALTER TABLE `pl_company_iciciapp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_company_icicibank`
--
ALTER TABLE `pl_company_icicibank`
  ADD PRIMARY KEY (`icicicompid`);

--
-- Indexes for table `pl_company_indusind`
--
ALTER TABLE `pl_company_indusind`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_company_indusindspl`
--
ALTER TABLE `pl_company_indusindspl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_company_ingvysya`
--
ALTER TABLE `pl_company_ingvysya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_company_ingvysya_sco`
--
ALTER TABLE `pl_company_ingvysya_sco`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_company_kotak`
--
ALTER TABLE `pl_company_kotak`
  ADD PRIMARY KEY (`kotakid`);

--
-- Indexes for table `pl_company_list`
--
ALTER TABLE `pl_company_list`
  ADD PRIMARY KEY (`plcompanyid`),
  ADD KEY `hdfc_bank` (`hdfc_bank`),
  ADD KEY `ingvyasya` (`ingvyasya`);

--
-- Indexes for table `pl_company_list_detail`
--
ALTER TABLE `pl_company_list_detail`
  ADD PRIMARY KEY (`plcompanyid`);

--
-- Indexes for table `pl_company_stanc`
--
ALTER TABLE `pl_company_stanc`
  ADD PRIMARY KEY (`plcompanyid`);

--
-- Indexes for table `pl_company_tatacapital`
--
ALTER TABLE `pl_company_tatacapital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_content`
--
ALTER TABLE `pl_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_feedback`
--
ALTER TABLE `pl_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pl_icici_leads`
--
ALTER TABLE `pl_icici_leads`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `pl_quote_shown`
--
ALTER TABLE `pl_quote_shown`
  ADD PRIMARY KEY (`plquoteid`),
  ADD KEY `pl_leadid` (`pl_leadid`);

--
-- Indexes for table `pl_quote_shown_save`
--
ALTER TABLE `pl_quote_shown_save`
  ADD PRIMARY KEY (`plquoteid`),
  ADD KEY `pl_leadid` (`pl_leadid`);

--
-- Indexes for table `pl_salaryclause`
--
ALTER TABLE `pl_salaryclause`
  ADD PRIMARY KEY (`plsalid`);

--
-- Indexes for table `pl_stanc_leads`
--
ALTER TABLE `pl_stanc_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_for_loan`
--
ALTER TABLE `poll_for_loan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employment_status` (`employment_status`);

--
-- Indexes for table `process_send_emails`
--
ALTER TABLE `process_send_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process_templates`
--
ALTER TABLE `process_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_for_sale`
--
ALTER TABLE `product_for_sale`
  ADD PRIMARY KEY (`Pid`);

--
-- Indexes for table `product_rating`
--
ALTER TABLE `product_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_name` (`page_name`);

--
-- Indexes for table `product_wisecitylist`
--
ALTER TABLE `product_wisecitylist`
  ADD PRIMARY KEY (`procityid`);

--
-- Indexes for table `property_deals`
--
ALTER TABLE `property_deals`
  ADD PRIMARY KEY (`propertyd_id`),
  ADD KEY `propertyd_city` (`propertyd_city`);

--
-- Indexes for table `property_deal_leads`
--
ALTER TABLE `property_deal_leads`
  ADD PRIMARY KEY (`prprtydl_id`);

--
-- Indexes for table `property_details_city`
--
ALTER TABLE `property_details_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_details_hl`
--
ALTER TABLE `property_details_hl`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `qa_blobs`
--
ALTER TABLE `qa_blobs`
  ADD PRIMARY KEY (`blobid`);

--
-- Indexes for table `qa_cache`
--
ALTER TABLE `qa_cache`
  ADD PRIMARY KEY (`type`,`cacheid`),
  ADD KEY `lastread` (`lastread`);

--
-- Indexes for table `qa_categories`
--
ALTER TABLE `qa_categories`
  ADD PRIMARY KEY (`categoryid`),
  ADD UNIQUE KEY `parentid` (`parentid`,`tags`),
  ADD UNIQUE KEY `parentid_2` (`parentid`,`position`),
  ADD KEY `backpath` (`backpath`(200));

--
-- Indexes for table `qa_categorymetas`
--
ALTER TABLE `qa_categorymetas`
  ADD PRIMARY KEY (`categoryid`,`title`);

--
-- Indexes for table `qa_contentwords`
--
ALTER TABLE `qa_contentwords`
  ADD KEY `postid` (`postid`),
  ADD KEY `wordid` (`wordid`);

--
-- Indexes for table `qa_cookies`
--
ALTER TABLE `qa_cookies`
  ADD PRIMARY KEY (`cookieid`);

--
-- Indexes for table `qa_iplimits`
--
ALTER TABLE `qa_iplimits`
  ADD UNIQUE KEY `ip` (`ip`,`action`);

--
-- Indexes for table `qa_messages`
--
ALTER TABLE `qa_messages`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `fromuserid` (`fromuserid`,`touserid`,`created`);

--
-- Indexes for table `qa_options`
--
ALTER TABLE `qa_options`
  ADD PRIMARY KEY (`title`);

--
-- Indexes for table `qa_pages`
--
ALTER TABLE `qa_pages`
  ADD PRIMARY KEY (`pageid`),
  ADD UNIQUE KEY `tags` (`tags`),
  ADD UNIQUE KEY `position` (`position`);

--
-- Indexes for table `qa_postmetas`
--
ALTER TABLE `qa_postmetas`
  ADD PRIMARY KEY (`postid`,`title`);

--
-- Indexes for table `qa_posts`
--
ALTER TABLE `qa_posts`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `type` (`type`,`created`),
  ADD KEY `type_2` (`type`,`acount`,`created`),
  ADD KEY `type_4` (`type`,`netvotes`,`created`),
  ADD KEY `type_5` (`type`,`views`,`created`),
  ADD KEY `type_6` (`type`,`hotness`),
  ADD KEY `type_7` (`type`,`amaxvote`,`created`),
  ADD KEY `parentid` (`parentid`,`type`),
  ADD KEY `userid` (`userid`,`type`,`created`),
  ADD KEY `selchildid` (`selchildid`,`type`,`created`),
  ADD KEY `closedbyid` (`closedbyid`),
  ADD KEY `catidpath1` (`catidpath1`,`type`,`created`),
  ADD KEY `catidpath2` (`catidpath2`,`type`,`created`),
  ADD KEY `catidpath3` (`catidpath3`,`type`,`created`),
  ADD KEY `categoryid` (`categoryid`,`type`,`created`),
  ADD KEY `createip` (`createip`,`created`),
  ADD KEY `updated` (`updated`,`type`),
  ADD KEY `flagcount` (`flagcount`,`created`,`type`),
  ADD KEY `catidpath1_2` (`catidpath1`,`updated`,`type`),
  ADD KEY `catidpath2_2` (`catidpath2`,`updated`,`type`),
  ADD KEY `catidpath3_2` (`catidpath3`,`updated`,`type`),
  ADD KEY `categoryid_2` (`categoryid`,`updated`,`type`),
  ADD KEY `lastuserid` (`lastuserid`,`updated`,`type`),
  ADD KEY `lastip` (`lastip`,`updated`,`type`);

--
-- Indexes for table `qa_posttags`
--
ALTER TABLE `qa_posttags`
  ADD KEY `postid` (`postid`),
  ADD KEY `wordid` (`wordid`,`postcreated`);

--
-- Indexes for table `qa_sharedevents`
--
ALTER TABLE `qa_sharedevents`
  ADD KEY `entitytype` (`entitytype`,`entityid`,`updated`),
  ADD KEY `questionid` (`questionid`,`entitytype`,`entityid`);

--
-- Indexes for table `qa_tagmetas`
--
ALTER TABLE `qa_tagmetas`
  ADD PRIMARY KEY (`tag`,`title`);

--
-- Indexes for table `qa_tagwords`
--
ALTER TABLE `qa_tagwords`
  ADD KEY `postid` (`postid`),
  ADD KEY `wordid` (`wordid`);

--
-- Indexes for table `qa_titlewords`
--
ALTER TABLE `qa_titlewords`
  ADD KEY `postid` (`postid`),
  ADD KEY `wordid` (`wordid`);

--
-- Indexes for table `qa_userevents`
--
ALTER TABLE `qa_userevents`
  ADD KEY `userid` (`userid`,`updated`),
  ADD KEY `questionid` (`questionid`,`userid`);

--
-- Indexes for table `qa_userfavorites`
--
ALTER TABLE `qa_userfavorites`
  ADD PRIMARY KEY (`userid`,`entitytype`,`entityid`),
  ADD KEY `userid` (`userid`,`nouserevents`),
  ADD KEY `entitytype` (`entitytype`,`entityid`,`nouserevents`);

--
-- Indexes for table `qa_userfields`
--
ALTER TABLE `qa_userfields`
  ADD PRIMARY KEY (`fieldid`);

--
-- Indexes for table `qa_userlimits`
--
ALTER TABLE `qa_userlimits`
  ADD UNIQUE KEY `userid` (`userid`,`action`);

--
-- Indexes for table `qa_userlogins`
--
ALTER TABLE `qa_userlogins`
  ADD KEY `source` (`source`,`identifiermd5`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `qa_usermetas`
--
ALTER TABLE `qa_usermetas`
  ADD PRIMARY KEY (`userid`,`title`);

--
-- Indexes for table `qa_usernotices`
--
ALTER TABLE `qa_usernotices`
  ADD PRIMARY KEY (`noticeid`),
  ADD KEY `userid` (`userid`,`created`);

--
-- Indexes for table `qa_userpoints`
--
ALTER TABLE `qa_userpoints`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `points` (`points`);

--
-- Indexes for table `qa_userprofile`
--
ALTER TABLE `qa_userprofile`
  ADD UNIQUE KEY `userid` (`userid`,`title`);

--
-- Indexes for table `qa_users`
--
ALTER TABLE `qa_users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `email` (`email`),
  ADD KEY `handle` (`handle`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `qa_uservotes`
--
ALTER TABLE `qa_uservotes`
  ADD UNIQUE KEY `userid` (`userid`,`postid`),
  ADD KEY `postid` (`postid`);

--
-- Indexes for table `qa_widgets`
--
ALTER TABLE `qa_widgets`
  ADD PRIMARY KEY (`widgetid`),
  ADD UNIQUE KEY `position` (`position`);

--
-- Indexes for table `qa_words`
--
ALTER TABLE `qa_words`
  ADD PRIMARY KEY (`wordid`),
  ADD KEY `word` (`word`),
  ADD KEY `tagcount` (`tagcount`);

--
-- Indexes for table `Rate_Experience`
--
ALTER TABLE `Rate_Experience`
  ADD PRIMARY KEY (`RateE_ID`),
  ADD KEY `URL` (`URL`);

--
-- Indexes for table `Rate_Services`
--
ALTER TABLE `Rate_Services`
  ADD PRIMARY KEY (`RateS_ID`),
  ADD KEY `URL` (`URL`);

--
-- Indexes for table `Rating`
--
ALTER TABLE `Rating`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `url` (`url`);

--
-- Indexes for table `rbl_creditcard`
--
ALTER TABLE `rbl_creditcard`
  ADD PRIMARY KEY (`rblccid`);

--
-- Indexes for table `redupmtion_channel`
--
ALTER TABLE `redupmtion_channel`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `Register_Rating`
--
ALTER TABLE `Register_Rating`
  ADD PRIMARY KEY (`RatingID`);

--
-- Indexes for table `Replies`
--
ALTER TABLE `Replies`
  ADD PRIMARY KEY (`ReplyID`);

--
-- Indexes for table `Replies1`
--
ALTER TABLE `Replies1`
  ADD PRIMARY KEY (`ReplyID`);

--
-- Indexes for table `Req_Agent`
--
ALTER TABLE `Req_Agent`
  ADD PRIMARY KEY (`A_ID`),
  ADD KEY `A_Feedback` (`A_Feedback`);

--
-- Indexes for table `Req_Agent_Pay`
--
ALTER TABLE `Req_Agent_Pay`
  ADD PRIMARY KEY (`A_ID`),
  ADD KEY `A_Feedback` (`A_Feedback`);

--
-- Indexes for table `Req_Apply_Here`
--
ALTER TABLE `Req_Apply_Here`
  ADD PRIMARY KEY (`ApplyID`),
  ADD KEY `Contact` (`Contact`),
  ADD KEY `Email` (`Email`),
  ADD KEY `Dated` (`Dated`);

--
-- Indexes for table `Req_Bajaj_HomenBT`
--
ALTER TABLE `Req_Bajaj_HomenBT`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `req_barclays_lead`
--
ALTER TABLE `req_barclays_lead`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_Business_Loan`
--
ALTER TABLE `Req_Business_Loan`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Annual_Turnover` (`Annual_Turnover`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`);

--
-- Indexes for table `Req_CC_ivr`
--
ALTER TABLE `Req_CC_ivr`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `Phone` (`Phone`);

--
-- Indexes for table `Req_Compaign`
--
ALTER TABLE `Req_Compaign`
  ADD PRIMARY KEY (`Compaign_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `Mobile_no` (`Mobile_no`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Compaign_Property`
--
ALTER TABLE `Req_Compaign_Property`
  ADD PRIMARY KEY (`Compaign_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `Mobile_no` (`Mobile_no`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Credit_Card`
--
ALTER TABLE `Req_Credit_Card`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`);

--
-- Indexes for table `req_credit_card1`
--
ALTER TABLE `req_credit_card1`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_Credit_Card_Bankwise`
--
ALTER TABLE `Req_Credit_Card_Bankwise`
  ADD PRIMARY KEY (`bankreqid`);

--
-- Indexes for table `Req_Credit_Card_Sms`
--
ALTER TABLE `Req_Credit_Card_Sms`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`);

--
-- Indexes for table `Req_Credit_Sudhaar`
--
ALTER TABLE `Req_Credit_Sudhaar`
  ADD PRIMARY KEY (`ReqID`);

--
-- Indexes for table `Req_Crossword`
--
ALTER TABLE `Req_Crossword`
  ADD KEY `CrosswordID` (`CrosswordID`);

--
-- Indexes for table `Req_Dialer_Records`
--
ALTER TABLE `Req_Dialer_Records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Req_Dialer_Records_CC`
--
ALTER TABLE `Req_Dialer_Records_CC`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Req_Dialer_Records_HL`
--
ALTER TABLE `Req_Dialer_Records_HL`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Req_Dialer_Records_PL`
--
ALTER TABLE `Req_Dialer_Records_PL`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Req_Dialer_Records_PL_090917_backup`
--
ALTER TABLE `Req_Dialer_Records_PL_090917_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Req_Dialler_Report`
--
ALTER TABLE `Req_Dialler_Report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RequestID` (`RequestID`),
  ADD KEY `date_created` (`date_created`),
  ADD KEY `Phone` (`Phone`),
  ADD KEY `AgentID` (`AgentID`);

--
-- Indexes for table `Req_EBBusiness_Leads`
--
ALTER TABLE `Req_EBBusiness_Leads`
  ADD PRIMARY KEY (`ebleadid`);

--
-- Indexes for table `Req_Feedback`
--
ALTER TABLE `Req_Feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_BCalling`
--
ALTER TABLE `Req_Feedback_BCalling`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`),
  ADD KEY `Feedback` (`Feedback`);

--
-- Indexes for table `Req_Feedback_Bidder`
--
ALTER TABLE `Req_Feedback_Bidder`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`);

--
-- Indexes for table `Req_Feedback_Bidder1`
--
ALTER TABLE `Req_Feedback_Bidder1`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_Bidder1_new`
--
ALTER TABLE `Req_Feedback_Bidder1_new`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_Bidder_CC`
--
ALTER TABLE `Req_Feedback_Bidder_CC`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_Bidder_CC1`
--
ALTER TABLE `Req_Feedback_Bidder_CC1`
  ADD PRIMARY KEY (`Feedback_ID`);

--
-- Indexes for table `Req_Feedback_Bidder_CL`
--
ALTER TABLE `Req_Feedback_Bidder_CL`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_Bidder_CL1`
--
ALTER TABLE `Req_Feedback_Bidder_CL1`
  ADD PRIMARY KEY (`Feedback_ID`);

--
-- Indexes for table `Req_Feedback_Bidder_HL`
--
ALTER TABLE `Req_Feedback_Bidder_HL`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_Bidder_HL1`
--
ALTER TABLE `Req_Feedback_Bidder_HL1`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `AllRequestID` (`AllRequestID`);

--
-- Indexes for table `Req_Feedback_Bidder_LAP`
--
ALTER TABLE `Req_Feedback_Bidder_LAP`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_Bidder_LAP1`
--
ALTER TABLE `Req_Feedback_Bidder_LAP1`
  ADD PRIMARY KEY (`Feedback_ID`);

--
-- Indexes for table `Req_Feedback_Bidder_PL`
--
ALTER TABLE `Req_Feedback_Bidder_PL`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_Bidder_PL1`
--
ALTER TABLE `Req_Feedback_Bidder_PL1`
  ADD PRIMARY KEY (`Feedback_ID`);

--
-- Indexes for table `Req_Feedback_CC`
--
ALTER TABLE `Req_Feedback_CC`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_CL`
--
ALTER TABLE `Req_Feedback_CL`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_Comments_PL`
--
ALTER TABLE `Req_Feedback_Comments_PL`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_HL`
--
ALTER TABLE `Req_Feedback_HL`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Feedback` (`Feedback`);

--
-- Indexes for table `Req_Feedback_HL_16april15`
--
ALTER TABLE `Req_Feedback_HL_16april15`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_ICICI_CC`
--
ALTER TABLE `Req_Feedback_ICICI_CC`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_LAP`
--
ALTER TABLE `Req_Feedback_LAP`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_MF`
--
ALTER TABLE `Req_Feedback_MF`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`),
  ADD KEY `Feedback` (`Feedback`);

--
-- Indexes for table `Req_Feedback_new`
--
ALTER TABLE `Req_Feedback_new`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_PL`
--
ALTER TABLE `Req_Feedback_PL`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`),
  ADD KEY `Feedback` (`Feedback`);

--
-- Indexes for table `Req_Feedback_PLSW`
--
ALTER TABLE `Req_Feedback_PLSW`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_PL_16april15`
--
ALTER TABLE `Req_Feedback_PL_16april15`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_PL_25jan2017`
--
ALTER TABLE `Req_Feedback_PL_25jan2017`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_Property`
--
ALTER TABLE `Req_Feedback_Property`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Feedback_Travel`
--
ALTER TABLE `Req_Feedback_Travel`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Followup_Date` (`Followup_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`),
  ADD KEY `Feedback` (`Feedback`);

--
-- Indexes for table `req_hdfc_lead`
--
ALTER TABLE `req_hdfc_lead`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_Incomplete_Lead`
--
ALTER TABLE `Req_Incomplete_Lead`
  ADD PRIMARY KEY (`IncompeletID`);

--
-- Indexes for table `Req_Insurance_Lead`
--
ALTER TABLE `Req_Insurance_Lead`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_Investment`
--
ALTER TABLE `Req_Investment`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_lead_trans`
--
ALTER TABLE `Req_lead_trans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Req_Life_Insurance`
--
ALTER TABLE `Req_Life_Insurance`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_Loan_Against_Property`
--
ALTER TABLE `Req_Loan_Against_Property`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`);

--
-- Indexes for table `req_loan_against_property1`
--
ALTER TABLE `req_loan_against_property1`
  ADD PRIMARY KEY (`RequestID`),
  ADD FULLTEXT KEY `Descr` (`Descr`);
ALTER TABLE `req_loan_against_property1`
  ADD FULLTEXT KEY `Descr_2` (`Descr`);
ALTER TABLE `req_loan_against_property1`
  ADD FULLTEXT KEY `Descr_3` (`Descr`);

--
-- Indexes for table `Req_Loan_Against_Property_Bankwise`
--
ALTER TABLE `Req_Loan_Against_Property_Bankwise`
  ADD PRIMARY KEY (`bankreqid`);

--
-- Indexes for table `Req_Loan_Against_Property_ED`
--
ALTER TABLE `Req_Loan_Against_Property_ED`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Req_Loan_Bike`
--
ALTER TABLE `Req_Loan_Bike`
  ADD PRIMARY KEY (`RequestID`),
  ADD UNIQUE KEY `RequestID` (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`);

--
-- Indexes for table `Req_Loan_Business_ED`
--
ALTER TABLE `Req_Loan_Business_ED`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Req_Loan_Car`
--
ALTER TABLE `Req_Loan_Car`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`);

--
-- Indexes for table `req_loan_car1`
--
ALTER TABLE `req_loan_car1`
  ADD PRIMARY KEY (`RequestID`),
  ADD FULLTEXT KEY `Descr` (`Descr`);
ALTER TABLE `req_loan_car1`
  ADD FULLTEXT KEY `Descr_2` (`Descr`);
ALTER TABLE `req_loan_car1`
  ADD FULLTEXT KEY `Descr_3` (`Descr`);

--
-- Indexes for table `Req_Loan_Car_Bankwise`
--
ALTER TABLE `Req_Loan_Car_Bankwise`
  ADD PRIMARY KEY (`bankreqid`);

--
-- Indexes for table `Req_Loan_Car_BK1`
--
ALTER TABLE `Req_Loan_Car_BK1`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`);

--
-- Indexes for table `Req_Loan_Education`
--
ALTER TABLE `Req_Loan_Education`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Residence_City` (`Residence_City`);

--
-- Indexes for table `Req_Loan_Gold`
--
ALTER TABLE `Req_Loan_Gold`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_Loan_Home`
--
ALTER TABLE `Req_Loan_Home`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_Loan_Home1`
--
ALTER TABLE `Req_Loan_Home1`
  ADD PRIMARY KEY (`RequestID`),
  ADD FULLTEXT KEY `Descr` (`Descr`);
ALTER TABLE `Req_Loan_Home1`
  ADD FULLTEXT KEY `Descr_2` (`Descr`);
ALTER TABLE `Req_Loan_Home1`
  ADD FULLTEXT KEY `Descr_3` (`Descr`);

--
-- Indexes for table `Req_Loan_Home_16april15`
--
ALTER TABLE `Req_Loan_Home_16april15`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_Loan_Home_Bankwise`
--
ALTER TABLE `Req_Loan_Home_Bankwise`
  ADD PRIMARY KEY (`bankreqid`);

--
-- Indexes for table `Req_Loan_Home_Extrafields`
--
ALTER TABLE `Req_Loan_Home_Extrafields`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_Loan_Home_test`
--
ALTER TABLE `Req_Loan_Home_test`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_Loan_Personal`
--
ALTER TABLE `Req_Loan_Personal`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `DOB` (`DOB`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_Loan_Personal1`
--
ALTER TABLE `Req_Loan_Personal1`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_Loan_Personal_16april15`
--
ALTER TABLE `Req_Loan_Personal_16april15`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `DOB` (`DOB`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_Loan_Personal_25jan2017`
--
ALTER TABLE `Req_Loan_Personal_25jan2017`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `DOB` (`DOB`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_Loan_Personal_Bankwise`
--
ALTER TABLE `Req_Loan_Personal_Bankwise`
  ADD PRIMARY KEY (`bankreqid`);

--
-- Indexes for table `Req_Loan_Personal_barclays`
--
ALTER TABLE `Req_Loan_Personal_barclays`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `DOB` (`DOB`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_Loan_Personal_BK1`
--
ALTER TABLE `Req_Loan_Personal_BK1`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `DOB` (`DOB`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_Loan_Personal_Extra_Fields`
--
ALTER TABLE `Req_Loan_Personal_Extra_Fields`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Req_Loan_Personal_ICICI`
--
ALTER TABLE `Req_Loan_Personal_ICICI`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_Loan_Share`
--
ALTER TABLE `Req_Loan_Share`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_Message`
--
ALTER TABLE `Req_Message`
  ADD PRIMARY KEY (`PostID`),
  ADD KEY `Is_Verified` (`Is_Verified`),
  ADD KEY `Dated` (`Dated`);

--
-- Indexes for table `Req_Mutual_Fund`
--
ALTER TABLE `Req_Mutual_Fund`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Req_Partner`
--
ALTER TABLE `Req_Partner`
  ADD PRIMARY KEY (`Partner_ID`);

--
-- Indexes for table `Req_Partner_PL`
--
ALTER TABLE `Req_Partner_PL`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `DOB` (`DOB`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_Personal_Loan_ivr`
--
ALTER TABLE `Req_Personal_Loan_ivr`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `Phone` (`Phone`);

--
-- Indexes for table `req_plcompaign_smscontact`
--
ALTER TABLE `req_plcompaign_smscontact`
  ADD PRIMARY KEY (`Compaign_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `Mobile_no` (`Mobile_no`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_PL_BackCalling`
--
ALTER TABLE `Req_PL_BackCalling`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `DOB` (`DOB`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `Req_PL_ivr`
--
ALTER TABLE `Req_PL_ivr`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `Phone` (`Phone`);

--
-- Indexes for table `Req_PL_ivr_Feedback`
--
ALTER TABLE `Req_PL_ivr_Feedback`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`);

--
-- Indexes for table `Req_Property_Bidder`
--
ALTER TABLE `Req_Property_Bidder`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Allocation_Date` (`Allocation_Date`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `Req_Quick_Leads`
--
ALTER TABLE `Req_Quick_Leads`
  ADD PRIMARY KEY (`quickleadid`),
  ADD UNIQUE KEY `product_type` (`product_type`,`lead_month`,`lead_year`);

--
-- Indexes for table `req_reply_message`
--
ALTER TABLE `req_reply_message`
  ADD PRIMARY KEY (`Reply_ID`),
  ADD KEY `PostID` (`PostID`);

--
-- Indexes for table `Req_Sms_Delivery`
--
ALTER TABLE `Req_Sms_Delivery`
  ADD PRIMARY KEY (`Reqsmsid`);

--
-- Indexes for table `Req_User_Update`
--
ALTER TABLE `Req_User_Update`
  ADD PRIMARY KEY (`RUU_ID`);

--
-- Indexes for table `Req_Win_Cash`
--
ALTER TABLE `Req_Win_Cash`
  ADD PRIMARY KEY (`Cash_ID`);

--
-- Indexes for table `restrictIPAddr`
--
ALTER TABLE `restrictIPAddr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rm_detail_fullerton`
--
ALTER TABLE `rm_detail_fullerton`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `RM_List`
--
ALTER TABLE `RM_List`
  ADD PRIMARY KEY (`BD_ID`);

--
-- Indexes for table `saveemicalc_tbl`
--
ALTER TABLE `saveemicalc_tbl`
  ADD PRIMARY KEY (`saveemiid`);

--
-- Indexes for table `saveemicalc_tbl_hl`
--
ALTER TABLE `saveemicalc_tbl_hl`
  ADD PRIMARY KEY (`saveemiidhl`);

--
-- Indexes for table `saveemicalc_tbl_pl`
--
ALTER TABLE `saveemicalc_tbl_pl`
  ADD PRIMARY KEY (`saveemiidpl`);

--
-- Indexes for table `saveemicalc_tbl_quotes`
--
ALTER TABLE `saveemicalc_tbl_quotes`
  ADD PRIMARY KEY (`quotetblid`);

--
-- Indexes for table `saveemicalc_tbl_showquotes`
--
ALTER TABLE `saveemicalc_tbl_showquotes`
  ADD PRIMARY KEY (`showquoteid`);

--
-- Indexes for table `sbicard_decline_code`
--
ALTER TABLE `sbicard_decline_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `decline_code` (`decline_code`);

--
-- Indexes for table `sbihl_6168_asmlist`
--
ALTER TABLE `sbihl_6168_asmlist`
  ADD PRIMARY KEY (`sbiasmid`);

--
-- Indexes for table `sbi_ccoffers_directonsite`
--
ALTER TABLE `sbi_ccoffers_directonsite`
  ADD PRIMARY KEY (`sbiccoffersid`);

--
-- Indexes for table `sbi_cc_city_state_list`
--
ALTER TABLE `sbi_cc_city_state_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sbi_cc_company_list`
--
ALTER TABLE `sbi_cc_company_list`
  ADD PRIMARY KEY (`sbicompid`);

--
-- Indexes for table `sbi_cc_company_list_10112017`
--
ALTER TABLE `sbi_cc_company_list_10112017`
  ADD PRIMARY KEY (`sbicompid`);

--
-- Indexes for table `sbi_cc_company_list_old`
--
ALTER TABLE `sbi_cc_company_list_old`
  ADD PRIMARY KEY (`sbicompid`);

--
-- Indexes for table `sbi_cc_designation`
--
ALTER TABLE `sbi_cc_designation`
  ADD PRIMARY KEY (`sbidesgid`);

--
-- Indexes for table `sbi_checks_errorlog`
--
ALTER TABLE `sbi_checks_errorlog`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `sbi_credit_card_5633`
--
ALTER TABLE `sbi_credit_card_5633`
  ADD PRIMARY KEY (`sbiccid`),
  ADD KEY `RequestID` (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `process_type` (`process_type`),
  ADD KEY `LeadRefNumber` (`LeadRefNumber`),
  ADD KEY `productflag` (`productflag`),
  ADD KEY `first_dated` (`first_dated`);

--
-- Indexes for table `sbi_credit_card_5633_07112017`
--
ALTER TABLE `sbi_credit_card_5633_07112017`
  ADD PRIMARY KEY (`sbiccid`),
  ADD KEY `RequestID` (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `process_type` (`process_type`),
  ADD KEY `LeadRefNumber` (`LeadRefNumber`),
  ADD KEY `productflag` (`productflag`),
  ADD KEY `first_dated` (`first_dated`);

--
-- Indexes for table `sbi_credit_card_5633_backup`
--
ALTER TABLE `sbi_credit_card_5633_backup`
  ADD PRIMARY KEY (`sbiccid`),
  ADD KEY `RequestID` (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `process_type` (`process_type`),
  ADD KEY `LeadRefNumber` (`LeadRefNumber`),
  ADD KEY `productflag` (`productflag`),
  ADD KEY `first_dated` (`first_dated`);

--
-- Indexes for table `sbi_credit_card_5633_log`
--
ALTER TABLE `sbi_credit_card_5633_log`
  ADD PRIMARY KEY (`sbicclogid`),
  ADD KEY `LeadRefNumber` (`LeadRefNumber`),
  ADD KEY `cc_requestid` (`cc_requestid`);

--
-- Indexes for table `sbi_credit_card_5633_log_07112017`
--
ALTER TABLE `sbi_credit_card_5633_log_07112017`
  ADD PRIMARY KEY (`sbicclogid`),
  ADD KEY `LeadRefNumber` (`LeadRefNumber`),
  ADD KEY `cc_requestid` (`cc_requestid`);

--
-- Indexes for table `sbi_credit_card_5633_log_direct`
--
ALTER TABLE `sbi_credit_card_5633_log_direct`
  ADD PRIMARY KEY (`sbicclogid`);

--
-- Indexes for table `sbi_credit_card_5633_log_direct_07112017`
--
ALTER TABLE `sbi_credit_card_5633_log_direct_07112017`
  ADD PRIMARY KEY (`sbicclogid`);

--
-- Indexes for table `sbi_documents`
--
ALTER TABLE `sbi_documents`
  ADD PRIMARY KEY (`doc_id`),
  ADD KEY `source_code` (`source_code`),
  ADD KEY `RequestID` (`RequestID`),
  ADD KEY `doc_id` (`doc_id`);

--
-- Indexes for table `sbi_documents_decision_table`
--
ALTER TABLE `sbi_documents_decision_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_adminmember`
--
ALTER TABLE `site_adminmember`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smsapp_leadallocation_log`
--
ALTER TABLE `smsapp_leadallocation_log`
  ADD PRIMARY KEY (`leadlogid`);

--
-- Indexes for table `smspl_mapping_bidderlms`
--
ALTER TABLE `smspl_mapping_bidderlms`
  ADD PRIMARY KEY (`leadmapid`);

--
-- Indexes for table `smspl_status_details`
--
ALTER TABLE `smspl_status_details`
  ADD PRIMARY KEY (`statid`);

--
-- Indexes for table `sms_acknowledgement`
--
ALTER TABLE `sms_acknowledgement`
  ADD PRIMARY KEY (`sms_id`),
  ADD KEY `air2web_requestid` (`air2web_requestid`),
  ADD KEY `product_type` (`product_type`);

--
-- Indexes for table `sms_acknowledgement_vfirst`
--
ALTER TABLE `sms_acknowledgement_vfirst`
  ADD PRIMARY KEY (`sms_vid`);

--
-- Indexes for table `stanc_company_list`
--
ALTER TABLE `stanc_company_list`
  ADD KEY `companyid` (`companyid`);

--
-- Indexes for table `states_in_india`
--
ALTER TABLE `states_in_india`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_mailer_cards`
--
ALTER TABLE `store_mailer_cards`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `store_records_mailer`
--
ALTER TABLE `store_records_mailer`
  ADD PRIMARY KEY (`mailerid`),
  ADD KEY `mobile` (`mobile`),
  ADD KEY `mailer_dated` (`mailer_dated`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `store_records_redemption`
--
ALTER TABLE `store_records_redemption`
  ADD PRIMARY KEY (`mailerid`),
  ADD KEY `mobile` (`mobile`),
  ADD KEY `mailer_dated` (`mailer_dated`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `store_redemption_cards`
--
ALTER TABLE `store_redemption_cards`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `Subscribe_Newsletter`
--
ALTER TABLE `Subscribe_Newsletter`
  ADD PRIMARY KEY (`SNID`);

--
-- Indexes for table `sws_acknowledgement`
--
ALTER TABLE `sws_acknowledgement`
  ADD PRIMARY KEY (`sms_id`);

--
-- Indexes for table `Task_Assignment`
--
ALTER TABLE `Task_Assignment`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `Task_Testing`
--
ALTER TABLE `Task_Testing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tataaig_leads`
--
ALTER TABLE `tataaig_leads`
  ADD PRIMARY KEY (`Tataaig_ID`),
  ADD KEY `T_Dated` (`T_Dated`),
  ADD KEY `T_RequestID` (`T_RequestID`);

--
-- Indexes for table `Tataaig_Leads_New`
--
ALTER TABLE `Tataaig_Leads_New`
  ADD PRIMARY KEY (`RequestID`);

--
-- Indexes for table `tatacapital_plmailer_leads`
--
ALTER TABLE `tatacapital_plmailer_leads`
  ADD PRIMARY KEY (`tatacapitalid`);

--
-- Indexes for table `tax_query`
--
ALTER TABLE `tax_query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telecaller_feedback_bookkeeping`
--
ALTER TABLE `telecaller_feedback_bookkeeping`
  ADD PRIMARY KEY (`bookkeepid`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `AllRequestID` (`AllRequestID`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `telecaller_fullerton`
--
ALTER TABLE `telecaller_fullerton`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Telecaller_Mgmt_Entry`
--
ALTER TABLE `Telecaller_Mgmt_Entry`
  ADD PRIMARY KEY (`TME_ID`),
  ADD KEY `TME_Date` (`TME_Date`),
  ADD KEY `TME_UniqueID` (`TME_UniqueID`);

--
-- Indexes for table `Telecaller_Mgmt_User`
--
ALTER TABLE `Telecaller_Mgmt_User`
  ADD PRIMARY KEY (`TMU_ID`);

--
-- Indexes for table `Telecaller_Mgmt_User_Lms`
--
ALTER TABLE `Telecaller_Mgmt_User_Lms`
  ADD PRIMARY KEY (`TMUL_ID`),
  ADD KEY `TMUL_Date` (`TMUL_Date`);

--
-- Indexes for table `Tell_Friends`
--
ALTER TABLE `Tell_Friends`
  ADD PRIMARY KEY (`Friend_Id`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `Testimonial`
--
ALTER TABLE `Testimonial`
  ADD PRIMARY KEY (`TestID`),
  ADD KEY `Is_Verified` (`Is_Verified`);

--
-- Indexes for table `TMU_Pincode`
--
ALTER TABLE `TMU_Pincode`
  ADD PRIMARY KEY (`PincodeID`);

--
-- Indexes for table `totalLoans`
--
ALTER TABLE `totalLoans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `totalLoans_test`
--
ALTER TABLE `totalLoans_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trackBanner`
--
ALTER TABLE `trackBanner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracksms`
--
ALTER TABLE `tracksms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track_sms`
--
ALTER TABLE `track_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unsubscribe`
--
ALTER TABLE `unsubscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_documents`
--
ALTER TABLE `upload_documents`
  ADD PRIMARY KEY (`DocID`),
  ADD KEY `RequestID` (`RequestID`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `upload_documents_citi`
--
ALTER TABLE `upload_documents_citi`
  ADD PRIMARY KEY (`DocID`);

--
-- Indexes for table `useragentlog`
--
ALTER TABLE `useragentlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_requests_count`
--
ALTER TABLE `user_requests_count`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `webservice_bidder_details`
--
ALTER TABLE `webservice_bidder_details`
  ADD PRIMARY KEY (`websrvid`);

--
-- Indexes for table `webservice_details_pl`
--
ALTER TABLE `webservice_details_pl`
  ADD PRIMARY KEY (`webserviceid`);

--
-- Indexes for table `webservice_log_sbi`
--
ALTER TABLE `webservice_log_sbi`
  ADD PRIMARY KEY (`sbicclogid`),
  ADD KEY `LeadRefNumber` (`LeadRefNumber`),
  ADD KEY `cc_requestid` (`cc_requestid`);

--
-- Indexes for table `webservice_whatsapp`
--
ALTER TABLE `webservice_whatsapp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_services`
--
ALTER TABLE `web_services`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `web_services_bidders_map`
--
ALTER TABLE `web_services_bidders_map`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `web_services_default_values`
--
ALTER TABLE `web_services_default_values`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `web_services_error_log`
--
ALTER TABLE `web_services_error_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `web_services_notifications`
--
ALTER TABLE `web_services_notifications`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `wf_company_list_hdfc`
--
ALTER TABLE `wf_company_list_hdfc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wf_lead_allocate`
--
ALTER TABLE `wf_lead_allocate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishfin_mailer_send`
--
ALTER TABLE `wishfin_mailer_send`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishfin_master_bank`
--
ALTER TABLE `wishfin_master_bank`
  ADD PRIMARY KEY (`bank_code`);

--
-- Indexes for table `wishfin_quote_loan`
--
ALTER TABLE `wishfin_quote_loan`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `Dated` (`Dated`),
  ADD KEY `City` (`City`),
  ADD KEY `City_Other` (`City_Other`),
  ADD KEY `Employment_Status` (`Employment_Status`),
  ADD KEY `Net_Salary` (`Net_Salary`),
  ADD KEY `Loan_Amount` (`Loan_Amount`),
  ADD KEY `Mobile_Number` (`Mobile_Number`),
  ADD KEY `Allocated` (`Allocated`),
  ADD KEY `Updated_Date` (`Updated_Date`),
  ADD KEY `Bidderid_Details` (`Bidderid_Details`),
  ADD KEY `DOB` (`DOB`),
  ADD KEY `source` (`source`);

--
-- Indexes for table `wpbnk_commentmeta`
--
ALTER TABLE `wpbnk_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191)),
  ADD KEY `disqus_dupecheck` (`meta_key`,`meta_value`(11));

--
-- Indexes for table `wpbnk_comments`
--
ALTER TABLE `wpbnk_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indexes for table `wpbnk_links`
--
ALTER TABLE `wpbnk_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `wpbnk_options`
--
ALTER TABLE `wpbnk_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `wpbnk_phppc_functions`
--
ALTER TABLE `wpbnk_phppc_functions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wpbnk_pollsa`
--
ALTER TABLE `wpbnk_pollsa`
  ADD PRIMARY KEY (`polla_aid`);

--
-- Indexes for table `wpbnk_pollsip`
--
ALTER TABLE `wpbnk_pollsip`
  ADD PRIMARY KEY (`pollip_id`),
  ADD KEY `pollip_ip` (`pollip_ip`),
  ADD KEY `pollip_qid` (`pollip_qid`),
  ADD KEY `pollip_ip_qid_aid` (`pollip_ip`,`pollip_qid`,`pollip_aid`);

--
-- Indexes for table `wpbnk_pollsq`
--
ALTER TABLE `wpbnk_pollsq`
  ADD PRIMARY KEY (`pollq_id`);

--
-- Indexes for table `wpbnk_postmeta`
--
ALTER TABLE `wpbnk_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wpbnk_posts`
--
ALTER TABLE `wpbnk_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `wpbnk_terms`
--
ALTER TABLE `wpbnk_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `wpbnk_term_relationships`
--
ALTER TABLE `wpbnk_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `wpbnk_term_taxonomy`
--
ALTER TABLE `wpbnk_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `wpbnk_usermeta`
--
ALTER TABLE `wpbnk_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wpbnk_users`
--
ALTER TABLE `wpbnk_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`);

--
-- Indexes for table `wp_blaster_reviews`
--
ALTER TABLE `wp_blaster_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_blaster_reviews_setting`
--
ALTER TABLE `wp_blaster_reviews_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `disqus_dupecheck` (`meta_key`,`meta_value`(11)),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_comments`
--
ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indexes for table `wp_golfresult`
--
ALTER TABLE `wp_golfresult`
  ADD PRIMARY KEY (`result_aid`),
  ADD UNIQUE KEY `id` (`result_aid`);

--
-- Indexes for table `wp_golftable`
--
ALTER TABLE `wp_golftable`
  ADD PRIMARY KEY (`table_aid`),
  ADD UNIQUE KEY `id` (`table_aid`);

--
-- Indexes for table `wp_links`
--
ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `wp_mappress_maps`
--
ALTER TABLE `wp_mappress_maps`
  ADD PRIMARY KEY (`mapid`);

--
-- Indexes for table `wp_mappress_posts`
--
ALTER TABLE `wp_mappress_posts`
  ADD PRIMARY KEY (`postid`,`mapid`);

--
-- Indexes for table `wp_options`
--
ALTER TABLE `wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `wp_pollsa`
--
ALTER TABLE `wp_pollsa`
  ADD PRIMARY KEY (`polla_aid`);

--
-- Indexes for table `wp_pollsip`
--
ALTER TABLE `wp_pollsip`
  ADD PRIMARY KEY (`pollip_id`),
  ADD KEY `pollip_ip` (`pollip_ip`),
  ADD KEY `pollip_qid` (`pollip_qid`),
  ADD KEY `pollip_ip_qid` (`pollip_ip`,`pollip_qid`);

--
-- Indexes for table `wp_pollsq`
--
ALTER TABLE `wp_pollsq`
  ADD PRIMARY KEY (`pollq_id`);

--
-- Indexes for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`),
  ADD KEY `post_name` (`post_name`(191));

--
-- Indexes for table `wp_sharebar`
--
ALTER TABLE `wp_sharebar`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wp_social_users`
--
ALTER TABLE `wp_social_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_terms`
--
ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `wp_term_relationships`
--
ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_users`
--
ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `wp_yasr_log`
--
ALTER TABLE `wp_yasr_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wp_yasr_multi_set`
--
ALTER TABLE `wp_yasr_multi_set`
  ADD UNIQUE KEY `set_id` (`set_id`),
  ADD UNIQUE KEY `set_name` (`set_name`);

--
-- Indexes for table `wp_yasr_multi_set_fields`
--
ALTER TABLE `wp_yasr_multi_set_fields`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wp_yasr_multi_values`
--
ALTER TABLE `wp_yasr_multi_values`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wp_yasr_votes`
--
ALTER TABLE `wp_yasr_votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- Indexes for table `wUsers`
--
ALTER TABLE `wUsers`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `wusers1`
--
ALTER TABLE `wusers1`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `xkyknzl5dwfyk4hg_master_bank`
--
ALTER TABLE `xkyknzl5dwfyk4hg_master_bank`
  ADD PRIMARY KEY (`bank_code`);

--
-- Indexes for table `xkyknzl5dwfyk4hg_tms_bank_api`
--
ALTER TABLE `xkyknzl5dwfyk4hg_tms_bank_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xkyknzl5dwfyk4hg_tms_whatsapp`
--
ALTER TABLE `xkyknzl5dwfyk4hg_tms_whatsapp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xkyknzl5dwfyk4hg_whatsapp_callback`
--
ALTER TABLE `xkyknzl5dwfyk4hg_whatsapp_callback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xkyknzl5dwfyk4hg_wishfin_whatsapp`
--
ALTER TABLE `xkyknzl5dwfyk4hg_wishfin_whatsapp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xkyknzl5dwfyk4hg_wish_travel`
--
ALTER TABLE `xkyknzl5dwfyk4hg_wish_travel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wish_travel_wish_travel_data_city_list_idx` (`city_id`),
  ADD KEY `fk_wish_travel_master_user1_idx` (`master_user_id`),
  ADD KEY `fk_lead_wish_travel_date_created_idx` (`date_created`);

--
-- Indexes for table `xkyknzl5dwfyk4hg_wish_travel_data_city_list`
--
ALTER TABLE `xkyknzl5dwfyk4hg_wish_travel_data_city_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xkyknzl5dwfyk4hg_wish_travel_data_package_list`
--
ALTER TABLE `xkyknzl5dwfyk4hg_wish_travel_data_package_list`
  ADD PRIMARY KEY (`package_id`),
  ADD UNIQUE KEY `package_id` (`package_id`),
  ADD KEY `package_id_2` (`package_id`);

--
-- Indexes for table `yes_cc_city_state_list`
--
ALTER TABLE `yes_cc_city_state_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yes_cc_company_list`
--
ALTER TABLE `yes_cc_company_list`
  ADD PRIMARY KEY (`yescompid`);

--
-- Indexes for table `z2v_transactions`
--
ALTER TABLE `z2v_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `z2v_transactions2`
--
ALTER TABLE `z2v_transactions2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zexternal_appointment_details`
--
ALTER TABLE `zexternal_appointment_details`
  ADD PRIMARY KEY (`statid`);

--
-- Indexes for table `zexternal_appointment_docs`
--
ALTER TABLE `zexternal_appointment_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zexternal_appointment_users`
--
ALTER TABLE `zexternal_appointment_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zexternal_campaign_smscontact`
--
ALTER TABLE `zexternal_campaign_smscontact`
  ADD PRIMARY KEY (`Compaign_ID`),
  ADD KEY `BidderID` (`BidderID`),
  ADD KEY `Mobile_no` (`Mobile_no`),
  ADD KEY `Reply_Type` (`Reply_Type`);

--
-- Indexes for table `zexternal_lap_documents`
--
ALTER TABLE `zexternal_lap_documents`
  ADD PRIMARY KEY (`docs_id`);

--
-- Indexes for table `zexternal_leadallocation_log`
--
ALTER TABLE `zexternal_leadallocation_log`
  ADD PRIMARY KEY (`leadlogid`);

--
-- Indexes for table `zexternal_send_appointment_sms`
--
ALTER TABLE `zexternal_send_appointment_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `z_validate_ip_address`
--
ALTER TABLE `z_validate_ip_address`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Advertise_with_us`
--
ALTER TABLE `Advertise_with_us`
  MODIFY `advertiseid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `allocation_leads_barclays`
--
ALTER TABLE `allocation_leads_barclays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `amex_cardwebservice`
--
ALTER TABLE `amex_cardwebservice`
  MODIFY `amex_ccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `amex_negative_pincode`
--
ALTER TABLE `amex_negative_pincode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `api_customer_cibil`
--
ALTER TABLE `api_customer_cibil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `api_log_cibil`
--
ALTER TABLE `api_log_cibil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `api_log_cibil_dummy`
--
ALTER TABLE `api_log_cibil_dummy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `apply_pl_capitalfirst`
--
ALTER TABLE `apply_pl_capitalfirst`
  MODIFY `capitalfirstid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Articles`
--
ALTER TABLE `Articles`
  MODIFY `Art_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Ask_Amitoj_Reply`
--
ALTER TABLE `Ask_Amitoj_Reply`
  MODIFY `AskReplyID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Ask_Amitoj_Section`
--
ALTER TABLE `Ask_Amitoj_Section`
  MODIFY `AskID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `automated_mailers`
--
ALTER TABLE `automated_mailers`
  MODIFY `automatID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `axis_mailers`
--
ALTER TABLE `axis_mailers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bajajallianz_carloancomp`
--
ALTER TABLE `bajajallianz_carloancomp`
  MODIFY `bajaj_clid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bajajfinserv_bidders`
--
ALTER TABLE `bajajfinserv_bidders`
  MODIFY `bajajfinservid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bajajfinserv_bldetails`
--
ALTER TABLE `bajajfinserv_bldetails`
  MODIFY `bajajblid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bajajfinserv_citypsf_mapping`
--
ALTER TABLE `bajajfinserv_citypsf_mapping`
  MODIFY `bajajfmapid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bajaj_cibildetails`
--
ALTER TABLE `bajaj_cibildetails`
  MODIFY `bajajcibilid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bajaj_finserv_mailer_leads`
--
ALTER TABLE `bajaj_finserv_mailer_leads`
  MODIFY `bajaj_finservid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bajaj_finserv_mailer_leads_data`
--
ALTER TABLE `bajaj_finserv_mailer_leads_data`
  MODIFY `bajaj_finservid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bank_documents_required`
--
ALTER TABLE `bank_documents_required`
  MODIFY `documentid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bank_Master`
--
ALTER TABLE `Bank_Master`
  MODIFY `BankID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Barclays_Credit_Card`
--
ALTER TABLE `Barclays_Credit_Card`
  MODIFY `BarclayID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `barclays_pincode_list`
--
ALTER TABLE `barclays_pincode_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `BD_List`
--
ALTER TABLE `BD_List`
  MODIFY `BD_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `BD_Mgmt_Entry`
--
ALTER TABLE `BD_Mgmt_Entry`
  MODIFY `BME_ID` tinyint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `BD_Mgmt_User`
--
ALTER TABLE `BD_Mgmt_User`
  MODIFY `BMU_ID` tinyint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `BidderDownloadCount`
--
ALTER TABLE `BidderDownloadCount`
  MODIFY `BD_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `BidderDownloadCount_new`
--
ALTER TABLE `BidderDownloadCount_new`
  MODIFY `BD_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders`
--
ALTER TABLE `Bidders`
  MODIFY `BidderID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `BiddersLoginDetails`
--
ALTER TABLE `BiddersLoginDetails`
  MODIFY `TrackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Book_Keeping`
--
ALTER TABLE `Bidders_Book_Keeping`
  MODIFY `BookID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Book_Keeping_CC`
--
ALTER TABLE `Bidders_Book_Keeping_CC`
  MODIFY `BookID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Book_Keeping_CL`
--
ALTER TABLE `Bidders_Book_Keeping_CL`
  MODIFY `BookID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Book_Keeping_dec11`
--
ALTER TABLE `Bidders_Book_Keeping_dec11`
  MODIFY `BookID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Book_Keeping_HL`
--
ALTER TABLE `Bidders_Book_Keeping_HL`
  MODIFY `BookID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Book_Keeping_ivr`
--
ALTER TABLE `Bidders_Book_Keeping_ivr`
  MODIFY `BookID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Book_Keeping_LAP`
--
ALTER TABLE `Bidders_Book_Keeping_LAP`
  MODIFY `BookID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Book_Keeping_nov21`
--
ALTER TABLE `Bidders_Book_Keeping_nov21`
  MODIFY `BookID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Book_Keeping_PL`
--
ALTER TABLE `Bidders_Book_Keeping_PL`
  MODIFY `BookID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Insertion`
--
ALTER TABLE `Bidders_Insertion`
  MODIFY `BidderInsertionID` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_ivr`
--
ALTER TABLE `Bidders_ivr`
  MODIFY `BidderID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_List`
--
ALTER TABLE `Bidders_List`
  MODIFY `Bidder_listID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_List_ivr`
--
ALTER TABLE `Bidders_List_ivr`
  MODIFY `Bidder_listID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Login_Details`
--
ALTER TABLE `Bidders_Login_Details`
  MODIFY `TrackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Mailers`
--
ALTER TABLE `Bidders_Mailers`
  MODIFY `R_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidders_Package_Log`
--
ALTER TABLE `Bidders_Package_Log`
  MODIFY `bpl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bidders_session_details`
--
ALTER TABLE `bidders_session_details`
  MODIFY `bidsessid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidder_Contact_To_Customers`
--
ALTER TABLE `Bidder_Contact_To_Customers`
  MODIFY `BidderContactID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bidder_downloads`
--
ALTER TABLE `bidder_downloads`
  MODIFY `id` bigint(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bidder_downloads1`
--
ALTER TABLE `bidder_downloads1`
  MODIFY `id` bigint(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidder_ivr_Contact`
--
ALTER TABLE `Bidder_ivr_Contact`
  MODIFY `BicID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bidder_Views`
--
ALTER TABLE `Bidder_Views`
  MODIFY `ViewID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bike_list`
--
ALTER TABLE `bike_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Billing_List`
--
ALTER TABLE `Billing_List`
  MODIFY `BillingID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Billing_User`
--
ALTER TABLE `Billing_User`
  MODIFY `Billing_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Bill_Record`
--
ALTER TABLE `Bill_Record`
  MODIFY `BID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `B_List_Property`
--
ALTER TABLE `B_List_Property`
  MODIFY `Bidder_listID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `B_Property`
--
ALTER TABLE `B_Property`
  MODIFY `BidderID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campaign_pixel_capture`
--
ALTER TABLE `campaign_pixel_capture`
  MODIFY `campid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `captute_banner_click`
--
ALTER TABLE `captute_banner_click`
  MODIFY `captuteid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cards_curing_queue`
--
ALTER TABLE `cards_curing_queue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `card_properties`
--
ALTER TABLE `card_properties`
  MODIFY `CardpropID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `career_job_apply`
--
ALTER TABLE `career_job_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carloan_mailers`
--
ALTER TABLE `carloan_mailers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `car_company_category`
--
ALTER TABLE `car_company_category`
  MODIFY `carcmpid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `car_loan_interest_rate`
--
ALTER TABLE `car_loan_interest_rate`
  MODIFY `B_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `car_loan_state_category`
--
ALTER TABLE `car_loan_state_category`
  MODIFY `clstateid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ccndc_diningcity`
--
ALTER TABLE `ccndc_diningcity`
  MODIFY `ccndc_dinid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cc_american_express`
--
ALTER TABLE `cc_american_express`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Chat_Registered_User`
--
ALTER TABLE `Chat_Registered_User`
  MODIFY `ChatID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `citibankcards_negative_complist`
--
ALTER TABLE `citibankcards_negative_complist`
  MODIFY `compid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `citibank_company_list`
--
ALTER TABLE `citibank_company_list`
  MODIFY `companyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `citibank_credit_card_6250`
--
ALTER TABLE `citibank_credit_card_6250`
  MODIFY `citiccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `citibank_pincode_6250`
--
ALTER TABLE `citibank_pincode_6250`
  MODIFY `citipinid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `citi_appointments`
--
ALTER TABLE `citi_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city_hl_pages`
--
ALTER TABLE `city_hl_pages`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `city_pages`
--
ALTER TABLE `city_pages`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `click2call`
--
ALTER TABLE `click2call`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_campaign_leads`
--
ALTER TABLE `client_campaign_leads`
  MODIFY `clientldid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_lead_allocate`
--
ALTER TABLE `client_lead_allocate`
  MODIFY `leadid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_lead_allocated_comment`
--
ALTER TABLE `client_lead_allocated_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clubbed_company_list`
--
ALTER TABLE `clubbed_company_list`
  MODIFY `supercompanyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cl_company_list_hdfc`
--
ALTER TABLE `cl_company_list_hdfc`
  MODIFY `clcomplistid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comments_pages`
--
ALTER TABLE `comments_pages`
  MODIFY `Rid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `commonfloor_hlcampaign`
--
ALTER TABLE `commonfloor_hlcampaign`
  MODIFY `leadid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `compaign_bidders_list`
--
ALTER TABLE `compaign_bidders_list`
  MODIFY `Bidder_listID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Compaign_Credit_Card`
--
ALTER TABLE `Compaign_Credit_Card`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cpp_card_protection_leads`
--
ALTER TABLE `cpp_card_protection_leads`
  MODIFY `CPP_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `creditcard_citylist`
--
ALTER TABLE `creditcard_citylist`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `creditndebit_card_offer`
--
ALTER TABLE `creditndebit_card_offer`
  MODIFY `ccndc_offerid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `creditndebit_card_reward_offer`
--
ALTER TABLE `creditndebit_card_reward_offer`
  MODIFY `ccndc_reid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `credit_card_banks_apply`
--
ALTER TABLE `credit_card_banks_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `credit_card_banks_apply_log`
--
ALTER TABLE `credit_card_banks_apply_log`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `credit_card_banks_eligibility`
--
ALTER TABLE `credit_card_banks_eligibility`
  MODIFY `cc_bankid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `credit_card_cibil_check`
--
ALTER TABLE `credit_card_cibil_check`
  MODIFY `cibilchkid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `credit_card_listing`
--
ALTER TABLE `credit_card_listing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `credit_card_mail_logs`
--
ALTER TABLE `credit_card_mail_logs`
  MODIFY `log_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Crossword_Details`
--
ALTER TABLE `Crossword_Details`
  MODIFY `CrosswordD_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_experience_with_banks`
--
ALTER TABLE `customer_experience_with_banks`
  MODIFY `feedbackid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_feedback_verified`
--
ALTER TABLE `customer_feedback_verified`
  MODIFY `custfbvdid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `d4l_smscampaign_leads`
--
ALTER TABLE `d4l_smscampaign_leads`
  MODIFY `d4lcampid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `data_prepaid_aug`
--
ALTER TABLE `data_prepaid_aug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dcb_cards_pincode`
--
ALTER TABLE `dcb_cards_pincode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `debt_counseling`
--
ALTER TABLE `debt_counseling`
  MODIFY `dbtid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `DND_customer_details`
--
ALTER TABLE `DND_customer_details`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `docs_uploaded`
--
ALTER TABLE `docs_uploaded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `docs_uploaded_blue`
--
ALTER TABLE `docs_uploaded_blue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `docs_uploaded_fil`
--
ALTER TABLE `docs_uploaded_fil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `docs_uploaded_hl`
--
ALTER TABLE `docs_uploaded_hl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Dummy_Bidders`
--
ALTER TABLE `Dummy_Bidders`
  MODIFY `BidderID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Dummy_Bidders_List`
--
ALTER TABLE `Dummy_Bidders_List`
  MODIFY `Bidder_listID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dummy_table`
--
ALTER TABLE `dummy_table`
  MODIFY `dumy_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Duplicate_Bidders_Book_Keeping`
--
ALTER TABLE `Duplicate_Bidders_Book_Keeping`
  MODIFY `BookID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Duplicate_Lead_Update`
--
ALTER TABLE `Duplicate_Lead_Update`
  MODIFY `duplicateid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `EBBusiness_leads_credithistory`
--
ALTER TABLE `EBBusiness_leads_credithistory`
  MODIFY `ebleadchid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `edelweiss_leads`
--
ALTER TABLE `edelweiss_leads`
  MODIFY `Edelweiss_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Eligible_Bidder_List`
--
ALTER TABLE `Eligible_Bidder_List`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_survey`
--
ALTER TABLE `employee_survey`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `entries`
--
ALTER TABLE `entries`
  MODIFY `entry_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exact_bidder_leads_count`
--
ALTER TABLE `exact_bidder_leads_count`
  MODIFY `lead_counid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `exclude_source_calling`
--
ALTER TABLE `exclude_source_calling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_cais_account_details`
--
ALTER TABLE `experian_cais_account_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_cais_account_history`
--
ALTER TABLE `experian_cais_account_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_caps_application_details`
--
ALTER TABLE `experian_caps_application_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_customer_othermisc_details`
--
ALTER TABLE `experian_customer_othermisc_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_customer_other_details`
--
ALTER TABLE `experian_customer_other_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_customer_primary_details`
--
ALTER TABLE `experian_customer_primary_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_customer_score_details`
--
ALTER TABLE `experian_customer_score_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_initial_details`
--
ALTER TABLE `experian_initial_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_log`
--
ALTER TABLE `experian_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_noncaps_application_details`
--
ALTER TABLE `experian_noncaps_application_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_vouchers_codes`
--
ALTER TABLE `experian_vouchers_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `experian_xml_files`
--
ALTER TABLE `experian_xml_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fd_bidders_list`
--
ALTER TABLE `fd_bidders_list`
  MODIFY `Bidder_listID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fd_interestrates`
--
ALTER TABLE `fd_interestrates`
  MODIFY `fd_interestrateID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fd_interestrate_bank`
--
ALTER TABLE `fd_interestrate_bank`
  MODIFY `fd_bankID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedback_bookkeeping`
--
ALTER TABLE `feedback_bookkeeping`
  MODIFY `feedbkid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `FE_Questions`
--
ALTER TABLE `FE_Questions`
  MODIFY `FEID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fil_appointments`
--
ALTER TABLE `fil_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `first_blue_leads`
--
ALTER TABLE `first_blue_leads`
  MODIFY `firstblueID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fixed_deposit`
--
ALTER TABLE `fixed_deposit`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fs_category`
--
ALTER TABLE `fs_category`
  MODIFY `CategoryID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Fullerton_Allocated_Leads`
--
ALTER TABLE `Fullerton_Allocated_Leads`
  MODIFY `fullertonrequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fullerton_allocation_track`
--
ALTER TABLE `fullerton_allocation_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fullerton_doc_list`
--
ALTER TABLE `fullerton_doc_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fullerton_exclusivecamp`
--
ALTER TABLE `fullerton_exclusivecamp`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fullerton_leads`
--
ALTER TABLE `fullerton_leads`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fullerton_leads_allocation`
--
ALTER TABLE `fullerton_leads_allocation`
  MODIFY `fullertonlid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fullerton_pl_leads`
--
ALTER TABLE `fullerton_pl_leads`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `getdata_logs`
--
ALTER TABLE `getdata_logs`
  MODIFY `getdatalgid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `getdata_tracking`
--
ALTER TABLE `getdata_tracking`
  MODIFY `getdataid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `get_eligible_leads`
--
ALTER TABLE `get_eligible_leads`
  MODIFY `GetID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `get_tataaig_leads`
--
ALTER TABLE `get_tataaig_leads`
  MODIFY `tataaigID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdbfc_companylist`
--
ALTER TABLE `hdbfc_companylist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdbfs_mailer_leads`
--
ALTER TABLE `hdbfs_mailer_leads`
  MODIFY `hdbfsid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfcbank_citywise_contactdetails`
--
ALTER TABLE `hdfcbank_citywise_contactdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfccarloan_leads`
--
ALTER TABLE `hdfccarloan_leads`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfccc_leads`
--
ALTER TABLE `hdfccc_leads`
  MODIFY `hdfcccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfclife_compleads`
--
ALTER TABLE `hdfclife_compleads`
  MODIFY `hdfclifeid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfcred_pixel_capture`
--
ALTER TABLE `hdfcred_pixel_capture`
  MODIFY `hdfcredid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_balance_transfer_leads`
--
ALTER TABLE `hdfc_balance_transfer_leads`
  MODIFY `hdfcbtid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_bidders`
--
ALTER TABLE `hdfc_bidders`
  MODIFY `Bid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_bike_city`
--
ALTER TABLE `hdfc_bike_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_card_for_card`
--
ALTER TABLE `hdfc_card_for_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_car_list_category`
--
ALTER TABLE `hdfc_car_list_category`
  MODIFY `hdfc_clid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_car_loan`
--
ALTER TABLE `hdfc_car_loan`
  MODIFY `hdfcccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_car_loan_gifts`
--
ALTER TABLE `hdfc_car_loan_gifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_car_loan_leads`
--
ALTER TABLE `hdfc_car_loan_leads`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `HDFC_CC`
--
ALTER TABLE `HDFC_CC`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `HDFC_CC_Company_List`
--
ALTER TABLE `HDFC_CC_Company_List`
  MODIFY `hdfcccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_cl_appointments`
--
ALTER TABLE `hdfc_cl_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_cl_companylist`
--
ALTER TABLE `hdfc_cl_companylist`
  MODIFY `hdfcclid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_company_list`
--
ALTER TABLE `hdfc_company_list`
  MODIFY `companyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_company_list_gold`
--
ALTER TABLE `hdfc_company_list_gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_company_list_silver`
--
ALTER TABLE `hdfc_company_list_silver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_credila_ncourse_list`
--
ALTER TABLE `hdfc_credila_ncourse_list`
  MODIFY `hdfc_credilaid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_credit_card`
--
ALTER TABLE `hdfc_credit_card`
  MODIFY `hdfcccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_goldloan_citylist`
--
ALTER TABLE `hdfc_goldloan_citylist`
  MODIFY `hdfcglid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_hlnlap_cronlog`
--
ALTER TABLE `hdfc_hlnlap_cronlog`
  MODIFY `hdfc_logid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `HDFC_homeloanBT`
--
ALTER TABLE `HDFC_homeloanBT`
  MODIFY `hdfchlbt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_homeloan_lead_data`
--
ALTER TABLE `hdfc_homeloan_lead_data`
  MODIFY `Serial_No` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_meritus_scholarships`
--
ALTER TABLE `hdfc_meritus_scholarships`
  MODIFY `HdfcmeritID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_pl_calc_leads`
--
ALTER TABLE `hdfc_pl_calc_leads`
  MODIFY `hdfcplid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_pl_company_list`
--
ALTER TABLE `hdfc_pl_company_list`
  MODIFY `hdfcid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_response_data`
--
ALTER TABLE `hdfc_response_data`
  MODIFY `hdfcresid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_response_data_lap`
--
ALTER TABLE `hdfc_response_data_lap`
  MODIFY `hdfcresid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_salary_cut`
--
ALTER TABLE `hdfc_salary_cut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_salary_cut_gold`
--
ALTER TABLE `hdfc_salary_cut_gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hdfc_spl_city_rates`
--
ALTER TABLE `hdfc_spl_city_rates`
  MODIFY `hdfc_splid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hesk_attachments`
--
ALTER TABLE `hesk_attachments`
  MODIFY `att_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hesk_categories`
--
ALTER TABLE `hesk_categories`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hesk_replies`
--
ALTER TABLE `hesk_replies`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hesk_show_transcript`
--
ALTER TABLE `hesk_show_transcript`
  MODIFY `HtID` int(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hesk_std_replies`
--
ALTER TABLE `hesk_std_replies`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hesk_tickets`
--
ALTER TABLE `hesk_tickets`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hesk_users`
--
ALTER TABLE `hesk_users`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hlcallinglms_allocation`
--
ALTER TABLE `hlcallinglms_allocation`
  MODIFY `hlallocateid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hlverifylms_allocation`
--
ALTER TABLE `hlverifylms_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hl_quote_shown`
--
ALTER TABLE `hl_quote_shown`
  MODIFY `hlquoteid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hl_referral_leads`
--
ALTER TABLE `hl_referral_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `homeloan_interest_rates`
--
ALTER TABLE `homeloan_interest_rates`
  MODIFY `hlrateid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `home_loan_bal_trans`
--
ALTER TABLE `home_loan_bal_trans`
  MODIFY `bal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `home_loan_eligibility`
--
ALTER TABLE `home_loan_eligibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `home_loan_interest_rate_chart`
--
ALTER TABLE `home_loan_interest_rate_chart`
  MODIFY `hlrateid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ibibo_compaign_leads`
--
ALTER TABLE `ibibo_compaign_leads`
  MODIFY `ibibo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icicihfc_leads`
--
ALTER TABLE `icicihfc_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icicihl_lapreport`
--
ALTER TABLE `icicihl_lapreport`
  MODIFY `icicihlid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icicilms_allocation`
--
ALTER TABLE `icicilms_allocation`
  MODIFY `iciciallocateid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icicilms_loginlog`
--
ALTER TABLE `icicilms_loginlog`
  MODIFY `icicilogid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icicipllms_allocation`
--
ALTER TABLE `icicipllms_allocation`
  MODIFY `iciciallocateid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icicipl_appointment_details`
--
ALTER TABLE `icicipl_appointment_details`
  MODIFY `iciciaaptid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icicipl_callLOG`
--
ALTER TABLE `icicipl_callLOG`
  MODIFY `callogid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icicipl_webservice`
--
ALTER TABLE `icicipl_webservice`
  MODIFY `icicwcid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_agent_leadallocation`
--
ALTER TABLE `icici_agent_leadallocation`
  MODIFY `allocationid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ICICI_Allocated_Leads`
--
ALTER TABLE `ICICI_Allocated_Leads`
  MODIFY `icicirequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_callingdata_DNC`
--
ALTER TABLE `icici_callingdata_DNC`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_cards_calling`
--
ALTER TABLE `icici_cards_calling`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_car_loan_calc`
--
ALTER TABLE `icici_car_loan_calc`
  MODIFY `icici_clid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ICICI_CCAppt_Details`
--
ALTER TABLE `ICICI_CCAppt_Details`
  MODIFY `ApptID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_cc_city_state_list`
--
ALTER TABLE `icici_cc_city_state_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_city_cc_list`
--
ALTER TABLE `icici_city_cc_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_credit_card`
--
ALTER TABLE `icici_credit_card`
  MODIFY `iciciccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_exclusive_app`
--
ALTER TABLE `icici_exclusive_app`
  MODIFY `iciciappid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_exclusive_application`
--
ALTER TABLE `icici_exclusive_application`
  MODIFY `iciciappid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_exclusive_app_docs`
--
ALTER TABLE `icici_exclusive_app_docs`
  MODIFY `icicidocid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_exclusive_transunion`
--
ALTER TABLE `icici_exclusive_transunion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_hfc_agents`
--
ALTER TABLE `icici_hfc_agents`
  MODIFY `agentid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_hfc_location_list`
--
ALTER TABLE `icici_hfc_location_list`
  MODIFY `locationid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_lead_allocation_table`
--
ALTER TABLE `icici_lead_allocation_table`
  MODIFY `lead_allocation_logic` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_organisation_list`
--
ALTER TABLE `icici_organisation_list`
  MODIFY `icici_orgid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_pl_cibili_check`
--
ALTER TABLE `icici_pl_cibili_check`
  MODIFY `plcibilid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icici_pl_referral_leads`
--
ALTER TABLE `icici_pl_referral_leads`
  MODIFY `icicildid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ifsc_bank`
--
ALTER TABLE `ifsc_bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ifsc_branch`
--
ALTER TABLE `ifsc_branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ifsc_state_dist`
--
ALTER TABLE `ifsc_state_dist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ifsc_state_dist_demo`
--
ALTER TABLE `ifsc_state_dist_demo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `indusbank_exclusive_leads`
--
ALTER TABLE `indusbank_exclusive_leads`
  MODIFY `indusbnkid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `indusbnk_msging`
--
ALTER TABLE `indusbnk_msging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `indusind_credit_card`
--
ALTER TABLE `indusind_credit_card`
  MODIFY `indusindccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ingvyasya_pl_calc_leads`
--
ALTER TABLE `ingvyasya_pl_calc_leads`
  MODIFY `ingvyasyaplid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ingvysya_bidders`
--
ALTER TABLE `ingvysya_bidders`
  MODIFY `Bid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ingvysya_companylist`
--
ALTER TABLE `ingvysya_companylist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ing_tempcomplist`
--
ALTER TABLE `ing_tempcomplist`
  MODIFY `ingid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ip_whitelist`
--
ALTER TABLE `ip_whitelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `komli_plcompaign`
--
ALTER TABLE `komli_plcompaign`
  MODIFY `komliplid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kotak_credit_card_details`
--
ALTER TABLE `kotak_credit_card_details`
  MODIFY `kotakID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lap_interest_rate`
--
ALTER TABLE `lap_interest_rate`
  MODIFY `B_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `leads_with_other_processes`
--
ALTER TABLE `leads_with_other_processes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lead_allocate`
--
ALTER TABLE `lead_allocate`
  MODIFY `leadid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lead_allocate_140817`
--
ALTER TABLE `lead_allocate_140817`
  MODIFY `leadid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lead_allocate_160817`
--
ALTER TABLE `lead_allocate_160817`
  MODIFY `leadid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lead_allocation_table`
--
ALTER TABLE `lead_allocation_table`
  MODIFY `lead_allocation_logic` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lead_personal_loan_attributes`
--
ALTER TABLE `lead_personal_loan_attributes`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `LMSLoginDetails`
--
ALTER TABLE `LMSLoginDetails`
  MODIFY `TrackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_access_attributes`
--
ALTER TABLE `lms_access_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_attributes`
--
ALTER TABLE `lms_attributes`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `LoanQuery`
--
ALTER TABLE `LoanQuery`
  MODIFY `ID` double NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loans_interest_rate`
--
ALTER TABLE `loans_interest_rate`
  MODIFY `interestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Logxy`
--
ALTER TABLE `Logxy`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Log_ivr`
--
ALTER TABLE `Log_ivr`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mailpancard1`
--
ALTER TABLE `mailpancard1`
  MODIFY `p_id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `manual_user_details`
--
ALTER TABLE `manual_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_india_city`
--
ALTER TABLE `master_india_city`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media_release_np`
--
ALTER TABLE `media_release_np`
  MODIFY `id` tinyint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media_release_online`
--
ALTER TABLE `media_release_online`
  MODIFY `id` tinyint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monthly_creditcard_offer`
--
ALTER TABLE `monthly_creditcard_offer`
  MODIFY `cc_offerid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `msging`
--
ALTER TABLE `msging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_comments`
--
ALTER TABLE `nests_comments`
  MODIFY `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_golfresult`
--
ALTER TABLE `nests_golfresult`
  MODIFY `result_aid` mediumint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_golftable`
--
ALTER TABLE `nests_golftable`
  MODIFY `table_aid` mediumint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_links`
--
ALTER TABLE `nests_links`
  MODIFY `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_options`
--
ALTER TABLE `nests_options`
  MODIFY `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_postmeta`
--
ALTER TABLE `nests_postmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_posts`
--
ALTER TABLE `nests_posts`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_terms`
--
ALTER TABLE `nests_terms`
  MODIFY `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_term_taxonomy`
--
ALTER TABLE `nests_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_usermeta`
--
ALTER TABLE `nests_usermeta`
  MODIFY `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nests_users`
--
ALTER TABLE `nests_users`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Newsletter`
--
ALTER TABLE `Newsletter`
  MODIFY `News_Id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Newsletter_Subscription`
--
ALTER TABLE `Newsletter_Subscription`
  MODIFY `subnewsid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_comments`
--
ALTER TABLE `nm_comments`
  MODIFY `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_golfresult`
--
ALTER TABLE `nm_golfresult`
  MODIFY `result_aid` mediumint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_golftable`
--
ALTER TABLE `nm_golftable`
  MODIFY `table_aid` mediumint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_links`
--
ALTER TABLE `nm_links`
  MODIFY `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_options`
--
ALTER TABLE `nm_options`
  MODIFY `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_postmeta`
--
ALTER TABLE `nm_postmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_posts`
--
ALTER TABLE `nm_posts`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_terms`
--
ALTER TABLE `nm_terms`
  MODIFY `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_term_taxonomy`
--
ALTER TABLE `nm_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_usermeta`
--
ALTER TABLE `nm_usermeta`
  MODIFY `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nm_users`
--
ALTER TABLE `nm_users`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `non_dnc_tataaigleads`
--
ALTER TABLE `non_dnc_tataaigleads`
  MODIFY `non_dncid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `openers_datacheck`
--
ALTER TABLE `openers_datacheck`
  MODIFY `openersid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `other_city_list`
--
ALTER TABLE `other_city_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `package_purchase_details`
--
ALTER TABLE `package_purchase_details`
  MODIFY `Rid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_cellnext_details`
--
ALTER TABLE `payment_cellnext_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personalloan_interest_rates_chart`
--
ALTER TABLE `personalloan_interest_rates_chart`
  MODIFY `plintr_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personal_loan_banks_eligibility`
--
ALTER TABLE `personal_loan_banks_eligibility`
  MODIFY `pl_bankid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personal_loan_interest_rate_chart`
--
ALTER TABLE `personal_loan_interest_rate_chart`
  MODIFY `rateid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personal_loan_updates`
--
ALTER TABLE `personal_loan_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plcallinglms_allocation`
--
ALTER TABLE `plcallinglms_allocation`
  MODIFY `plallocateid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `PLivrBidders`
--
ALTER TABLE `PLivrBidders`
  MODIFY `BidderID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `PLivrBiddersList`
--
ALTER TABLE `PLivrBiddersList`
  MODIFY `Bidder_listID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pllms_leadupload`
--
ALTER TABLE `pllms_leadupload`
  MODIFY `pllmsid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pllms_sw_email`
--
ALTER TABLE `pllms_sw_email`
  MODIFY `pllms_swid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_companylist_icici`
--
ALTER TABLE `pl_companylist_icici`
  MODIFY `compid` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_bajajfinserv`
--
ALTER TABLE `pl_company_bajajfinserv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_hdbfs`
--
ALTER TABLE `pl_company_hdbfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_hdfc`
--
ALTER TABLE `pl_company_hdfc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_hdfc_test`
--
ALTER TABLE `pl_company_hdfc_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_icici`
--
ALTER TABLE `pl_company_icici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_iciciapp`
--
ALTER TABLE `pl_company_iciciapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_icicibank`
--
ALTER TABLE `pl_company_icicibank`
  MODIFY `icicicompid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_indusind`
--
ALTER TABLE `pl_company_indusind`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_indusindspl`
--
ALTER TABLE `pl_company_indusindspl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_ingvysya`
--
ALTER TABLE `pl_company_ingvysya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_ingvysya_sco`
--
ALTER TABLE `pl_company_ingvysya_sco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_kotak`
--
ALTER TABLE `pl_company_kotak`
  MODIFY `kotakid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_list`
--
ALTER TABLE `pl_company_list`
  MODIFY `plcompanyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_list_detail`
--
ALTER TABLE `pl_company_list_detail`
  MODIFY `plcompanyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_stanc`
--
ALTER TABLE `pl_company_stanc`
  MODIFY `plcompanyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_company_tatacapital`
--
ALTER TABLE `pl_company_tatacapital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_content`
--
ALTER TABLE `pl_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_feedback`
--
ALTER TABLE `pl_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_icici_leads`
--
ALTER TABLE `pl_icici_leads`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_quote_shown`
--
ALTER TABLE `pl_quote_shown`
  MODIFY `plquoteid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_quote_shown_save`
--
ALTER TABLE `pl_quote_shown_save`
  MODIFY `plquoteid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_salaryclause`
--
ALTER TABLE `pl_salaryclause`
  MODIFY `plsalid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pl_stanc_leads`
--
ALTER TABLE `pl_stanc_leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `poll_for_loan`
--
ALTER TABLE `poll_for_loan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `process_send_emails`
--
ALTER TABLE `process_send_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `process_templates`
--
ALTER TABLE `process_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_for_sale`
--
ALTER TABLE `product_for_sale`
  MODIFY `Pid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_rating`
--
ALTER TABLE `product_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_wisecitylist`
--
ALTER TABLE `product_wisecitylist`
  MODIFY `procityid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `property_deals`
--
ALTER TABLE `property_deals`
  MODIFY `propertyd_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `property_deal_leads`
--
ALTER TABLE `property_deal_leads`
  MODIFY `prprtydl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `property_details_city`
--
ALTER TABLE `property_details_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `property_details_hl`
--
ALTER TABLE `property_details_hl`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qa_categories`
--
ALTER TABLE `qa_categories`
  MODIFY `categoryid` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qa_messages`
--
ALTER TABLE `qa_messages`
  MODIFY `messageid` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qa_pages`
--
ALTER TABLE `qa_pages`
  MODIFY `pageid` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qa_posts`
--
ALTER TABLE `qa_posts`
  MODIFY `postid` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qa_userfields`
--
ALTER TABLE `qa_userfields`
  MODIFY `fieldid` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qa_usernotices`
--
ALTER TABLE `qa_usernotices`
  MODIFY `noticeid` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qa_users`
--
ALTER TABLE `qa_users`
  MODIFY `userid` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qa_widgets`
--
ALTER TABLE `qa_widgets`
  MODIFY `widgetid` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `qa_words`
--
ALTER TABLE `qa_words`
  MODIFY `wordid` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Rate_Experience`
--
ALTER TABLE `Rate_Experience`
  MODIFY `RateE_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Rate_Services`
--
ALTER TABLE `Rate_Services`
  MODIFY `RateS_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Rating`
--
ALTER TABLE `Rating`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rbl_creditcard`
--
ALTER TABLE `rbl_creditcard`
  MODIFY `rblccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `redupmtion_channel`
--
ALTER TABLE `redupmtion_channel`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Register_Rating`
--
ALTER TABLE `Register_Rating`
  MODIFY `RatingID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Replies`
--
ALTER TABLE `Replies`
  MODIFY `ReplyID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Replies1`
--
ALTER TABLE `Replies1`
  MODIFY `ReplyID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Agent`
--
ALTER TABLE `Req_Agent`
  MODIFY `A_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Agent_Pay`
--
ALTER TABLE `Req_Agent_Pay`
  MODIFY `A_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Apply_Here`
--
ALTER TABLE `Req_Apply_Here`
  MODIFY `ApplyID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Bajaj_HomenBT`
--
ALTER TABLE `Req_Bajaj_HomenBT`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `req_barclays_lead`
--
ALTER TABLE `req_barclays_lead`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Business_Loan`
--
ALTER TABLE `Req_Business_Loan`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_CC_ivr`
--
ALTER TABLE `Req_CC_ivr`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Compaign`
--
ALTER TABLE `Req_Compaign`
  MODIFY `Compaign_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Compaign_Property`
--
ALTER TABLE `Req_Compaign_Property`
  MODIFY `Compaign_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Credit_Card`
--
ALTER TABLE `Req_Credit_Card`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `req_credit_card1`
--
ALTER TABLE `req_credit_card1`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Credit_Card_Bankwise`
--
ALTER TABLE `Req_Credit_Card_Bankwise`
  MODIFY `bankreqid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Credit_Card_Sms`
--
ALTER TABLE `Req_Credit_Card_Sms`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Credit_Sudhaar`
--
ALTER TABLE `Req_Credit_Sudhaar`
  MODIFY `ReqID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Crossword`
--
ALTER TABLE `Req_Crossword`
  MODIFY `CrosswordID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Dialer_Records`
--
ALTER TABLE `Req_Dialer_Records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Dialer_Records_CC`
--
ALTER TABLE `Req_Dialer_Records_CC`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Dialer_Records_HL`
--
ALTER TABLE `Req_Dialer_Records_HL`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Dialer_Records_PL`
--
ALTER TABLE `Req_Dialer_Records_PL`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Dialer_Records_PL_090917_backup`
--
ALTER TABLE `Req_Dialer_Records_PL_090917_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Dialler_Report`
--
ALTER TABLE `Req_Dialler_Report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_EBBusiness_Leads`
--
ALTER TABLE `Req_EBBusiness_Leads`
  MODIFY `ebleadid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback`
--
ALTER TABLE `Req_Feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_BCalling`
--
ALTER TABLE `Req_Feedback_BCalling`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder`
--
ALTER TABLE `Req_Feedback_Bidder`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder1`
--
ALTER TABLE `Req_Feedback_Bidder1`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder1_new`
--
ALTER TABLE `Req_Feedback_Bidder1_new`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder_CC`
--
ALTER TABLE `Req_Feedback_Bidder_CC`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder_CC1`
--
ALTER TABLE `Req_Feedback_Bidder_CC1`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder_CL`
--
ALTER TABLE `Req_Feedback_Bidder_CL`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder_CL1`
--
ALTER TABLE `Req_Feedback_Bidder_CL1`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder_HL`
--
ALTER TABLE `Req_Feedback_Bidder_HL`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder_HL1`
--
ALTER TABLE `Req_Feedback_Bidder_HL1`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder_LAP`
--
ALTER TABLE `Req_Feedback_Bidder_LAP`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder_LAP1`
--
ALTER TABLE `Req_Feedback_Bidder_LAP1`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder_PL`
--
ALTER TABLE `Req_Feedback_Bidder_PL`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Bidder_PL1`
--
ALTER TABLE `Req_Feedback_Bidder_PL1`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_CC`
--
ALTER TABLE `Req_Feedback_CC`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_CL`
--
ALTER TABLE `Req_Feedback_CL`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Comments_PL`
--
ALTER TABLE `Req_Feedback_Comments_PL`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_HL`
--
ALTER TABLE `Req_Feedback_HL`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_HL_16april15`
--
ALTER TABLE `Req_Feedback_HL_16april15`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_ICICI_CC`
--
ALTER TABLE `Req_Feedback_ICICI_CC`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_LAP`
--
ALTER TABLE `Req_Feedback_LAP`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_MF`
--
ALTER TABLE `Req_Feedback_MF`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_new`
--
ALTER TABLE `Req_Feedback_new`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_PL`
--
ALTER TABLE `Req_Feedback_PL`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_PLSW`
--
ALTER TABLE `Req_Feedback_PLSW`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_PL_16april15`
--
ALTER TABLE `Req_Feedback_PL_16april15`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_PL_25jan2017`
--
ALTER TABLE `Req_Feedback_PL_25jan2017`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Property`
--
ALTER TABLE `Req_Feedback_Property`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Feedback_Travel`
--
ALTER TABLE `Req_Feedback_Travel`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `req_hdfc_lead`
--
ALTER TABLE `req_hdfc_lead`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Incomplete_Lead`
--
ALTER TABLE `Req_Incomplete_Lead`
  MODIFY `IncompeletID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Insurance_Lead`
--
ALTER TABLE `Req_Insurance_Lead`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Investment`
--
ALTER TABLE `Req_Investment`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_lead_trans`
--
ALTER TABLE `Req_lead_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Life_Insurance`
--
ALTER TABLE `Req_Life_Insurance`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Against_Property`
--
ALTER TABLE `Req_Loan_Against_Property`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `req_loan_against_property1`
--
ALTER TABLE `req_loan_against_property1`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Against_Property_Bankwise`
--
ALTER TABLE `Req_Loan_Against_Property_Bankwise`
  MODIFY `bankreqid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Against_Property_ED`
--
ALTER TABLE `Req_Loan_Against_Property_ED`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Bike`
--
ALTER TABLE `Req_Loan_Bike`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Business_ED`
--
ALTER TABLE `Req_Loan_Business_ED`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Car`
--
ALTER TABLE `Req_Loan_Car`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `req_loan_car1`
--
ALTER TABLE `req_loan_car1`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Car_Bankwise`
--
ALTER TABLE `Req_Loan_Car_Bankwise`
  MODIFY `bankreqid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Car_BK1`
--
ALTER TABLE `Req_Loan_Car_BK1`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Education`
--
ALTER TABLE `Req_Loan_Education`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Gold`
--
ALTER TABLE `Req_Loan_Gold`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Home`
--
ALTER TABLE `Req_Loan_Home`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Home1`
--
ALTER TABLE `Req_Loan_Home1`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Home_16april15`
--
ALTER TABLE `Req_Loan_Home_16april15`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Home_Bankwise`
--
ALTER TABLE `Req_Loan_Home_Bankwise`
  MODIFY `bankreqid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Home_Extrafields`
--
ALTER TABLE `Req_Loan_Home_Extrafields`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Home_test`
--
ALTER TABLE `Req_Loan_Home_test`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Personal`
--
ALTER TABLE `Req_Loan_Personal`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Personal1`
--
ALTER TABLE `Req_Loan_Personal1`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Personal_16april15`
--
ALTER TABLE `Req_Loan_Personal_16april15`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Personal_25jan2017`
--
ALTER TABLE `Req_Loan_Personal_25jan2017`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Personal_Bankwise`
--
ALTER TABLE `Req_Loan_Personal_Bankwise`
  MODIFY `bankreqid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Personal_barclays`
--
ALTER TABLE `Req_Loan_Personal_barclays`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Personal_BK1`
--
ALTER TABLE `Req_Loan_Personal_BK1`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Personal_Extra_Fields`
--
ALTER TABLE `Req_Loan_Personal_Extra_Fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Personal_ICICI`
--
ALTER TABLE `Req_Loan_Personal_ICICI`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Loan_Share`
--
ALTER TABLE `Req_Loan_Share`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Message`
--
ALTER TABLE `Req_Message`
  MODIFY `PostID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Mutual_Fund`
--
ALTER TABLE `Req_Mutual_Fund`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Partner`
--
ALTER TABLE `Req_Partner`
  MODIFY `Partner_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Partner_PL`
--
ALTER TABLE `Req_Partner_PL`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Personal_Loan_ivr`
--
ALTER TABLE `Req_Personal_Loan_ivr`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `req_plcompaign_smscontact`
--
ALTER TABLE `req_plcompaign_smscontact`
  MODIFY `Compaign_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_PL_BackCalling`
--
ALTER TABLE `Req_PL_BackCalling`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_PL_ivr`
--
ALTER TABLE `Req_PL_ivr`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_PL_ivr_Feedback`
--
ALTER TABLE `Req_PL_ivr_Feedback`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Property_Bidder`
--
ALTER TABLE `Req_Property_Bidder`
  MODIFY `Feedback_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Quick_Leads`
--
ALTER TABLE `Req_Quick_Leads`
  MODIFY `quickleadid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `req_reply_message`
--
ALTER TABLE `req_reply_message`
  MODIFY `Reply_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Sms_Delivery`
--
ALTER TABLE `Req_Sms_Delivery`
  MODIFY `Reqsmsid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_User_Update`
--
ALTER TABLE `Req_User_Update`
  MODIFY `RUU_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Req_Win_Cash`
--
ALTER TABLE `Req_Win_Cash`
  MODIFY `Cash_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `restrictIPAddr`
--
ALTER TABLE `restrictIPAddr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rm_detail_fullerton`
--
ALTER TABLE `rm_detail_fullerton`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `RM_List`
--
ALTER TABLE `RM_List`
  MODIFY `BD_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `saveemicalc_tbl`
--
ALTER TABLE `saveemicalc_tbl`
  MODIFY `saveemiid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `saveemicalc_tbl_hl`
--
ALTER TABLE `saveemicalc_tbl_hl`
  MODIFY `saveemiidhl` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `saveemicalc_tbl_pl`
--
ALTER TABLE `saveemicalc_tbl_pl`
  MODIFY `saveemiidpl` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `saveemicalc_tbl_quotes`
--
ALTER TABLE `saveemicalc_tbl_quotes`
  MODIFY `quotetblid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `saveemicalc_tbl_showquotes`
--
ALTER TABLE `saveemicalc_tbl_showquotes`
  MODIFY `showquoteid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbicard_decline_code`
--
ALTER TABLE `sbicard_decline_code`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbihl_6168_asmlist`
--
ALTER TABLE `sbihl_6168_asmlist`
  MODIFY `sbiasmid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_ccoffers_directonsite`
--
ALTER TABLE `sbi_ccoffers_directonsite`
  MODIFY `sbiccoffersid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_cc_city_state_list`
--
ALTER TABLE `sbi_cc_city_state_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_cc_company_list`
--
ALTER TABLE `sbi_cc_company_list`
  MODIFY `sbicompid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_cc_company_list_10112017`
--
ALTER TABLE `sbi_cc_company_list_10112017`
  MODIFY `sbicompid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_cc_company_list_old`
--
ALTER TABLE `sbi_cc_company_list_old`
  MODIFY `sbicompid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_cc_designation`
--
ALTER TABLE `sbi_cc_designation`
  MODIFY `sbidesgid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_checks_errorlog`
--
ALTER TABLE `sbi_checks_errorlog`
  MODIFY `logid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_credit_card_5633`
--
ALTER TABLE `sbi_credit_card_5633`
  MODIFY `sbiccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_credit_card_5633_07112017`
--
ALTER TABLE `sbi_credit_card_5633_07112017`
  MODIFY `sbiccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_credit_card_5633_backup`
--
ALTER TABLE `sbi_credit_card_5633_backup`
  MODIFY `sbiccid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_credit_card_5633_log`
--
ALTER TABLE `sbi_credit_card_5633_log`
  MODIFY `sbicclogid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_credit_card_5633_log_07112017`
--
ALTER TABLE `sbi_credit_card_5633_log_07112017`
  MODIFY `sbicclogid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_credit_card_5633_log_direct`
--
ALTER TABLE `sbi_credit_card_5633_log_direct`
  MODIFY `sbicclogid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_credit_card_5633_log_direct_07112017`
--
ALTER TABLE `sbi_credit_card_5633_log_direct_07112017`
  MODIFY `sbicclogid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_documents`
--
ALTER TABLE `sbi_documents`
  MODIFY `doc_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sbi_documents_decision_table`
--
ALTER TABLE `sbi_documents_decision_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `site_adminmember`
--
ALTER TABLE `site_adminmember`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `smsapp_leadallocation_log`
--
ALTER TABLE `smsapp_leadallocation_log`
  MODIFY `leadlogid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `smspl_mapping_bidderlms`
--
ALTER TABLE `smspl_mapping_bidderlms`
  MODIFY `leadmapid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `smspl_status_details`
--
ALTER TABLE `smspl_status_details`
  MODIFY `statid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_acknowledgement`
--
ALTER TABLE `sms_acknowledgement`
  MODIFY `sms_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_acknowledgement_vfirst`
--
ALTER TABLE `sms_acknowledgement_vfirst`
  MODIFY `sms_vid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stanc_company_list`
--
ALTER TABLE `stanc_company_list`
  MODIFY `companyid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `states_in_india`
--
ALTER TABLE `states_in_india`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_mailer_cards`
--
ALTER TABLE `store_mailer_cards`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_records_mailer`
--
ALTER TABLE `store_records_mailer`
  MODIFY `mailerid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_records_redemption`
--
ALTER TABLE `store_records_redemption`
  MODIFY `mailerid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_redemption_cards`
--
ALTER TABLE `store_redemption_cards`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Subscribe_Newsletter`
--
ALTER TABLE `Subscribe_Newsletter`
  MODIFY `SNID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sws_acknowledgement`
--
ALTER TABLE `sws_acknowledgement`
  MODIFY `sms_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Task_Assignment`
--
ALTER TABLE `Task_Assignment`
  MODIFY `RequestID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Task_Testing`
--
ALTER TABLE `Task_Testing`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tataaig_leads`
--
ALTER TABLE `tataaig_leads`
  MODIFY `Tataaig_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Tataaig_Leads_New`
--
ALTER TABLE `Tataaig_Leads_New`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tatacapital_plmailer_leads`
--
ALTER TABLE `tatacapital_plmailer_leads`
  MODIFY `tatacapitalid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tax_query`
--
ALTER TABLE `tax_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `telecaller_feedback_bookkeeping`
--
ALTER TABLE `telecaller_feedback_bookkeeping`
  MODIFY `bookkeepid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `telecaller_fullerton`
--
ALTER TABLE `telecaller_fullerton`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Telecaller_Mgmt_Entry`
--
ALTER TABLE `Telecaller_Mgmt_Entry`
  MODIFY `TME_ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Telecaller_Mgmt_User`
--
ALTER TABLE `Telecaller_Mgmt_User`
  MODIFY `TMU_ID` tinyint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Telecaller_Mgmt_User_Lms`
--
ALTER TABLE `Telecaller_Mgmt_User_Lms`
  MODIFY `TMUL_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Tell_Friends`
--
ALTER TABLE `Tell_Friends`
  MODIFY `Friend_Id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Testimonial`
--
ALTER TABLE `Testimonial`
  MODIFY `TestID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `TMU_Pincode`
--
ALTER TABLE `TMU_Pincode`
  MODIFY `PincodeID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `totalLoans`
--
ALTER TABLE `totalLoans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `totalLoans_test`
--
ALTER TABLE `totalLoans_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trackBanner`
--
ALTER TABLE `trackBanner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tracksms`
--
ALTER TABLE `tracksms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `track_sms`
--
ALTER TABLE `track_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unsubscribe`
--
ALTER TABLE `unsubscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upload_documents`
--
ALTER TABLE `upload_documents`
  MODIFY `DocID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `upload_documents_citi`
--
ALTER TABLE `upload_documents_citi`
  MODIFY `DocID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `useragentlog`
--
ALTER TABLE `useragentlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `webservice_bidder_details`
--
ALTER TABLE `webservice_bidder_details`
  MODIFY `websrvid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `webservice_details_pl`
--
ALTER TABLE `webservice_details_pl`
  MODIFY `webserviceid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `webservice_log_sbi`
--
ALTER TABLE `webservice_log_sbi`
  MODIFY `sbicclogid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `webservice_whatsapp`
--
ALTER TABLE `webservice_whatsapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `web_services`
--
ALTER TABLE `web_services`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `web_services_bidders_map`
--
ALTER TABLE `web_services_bidders_map`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `web_services_default_values`
--
ALTER TABLE `web_services_default_values`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `web_services_error_log`
--
ALTER TABLE `web_services_error_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `web_services_notifications`
--
ALTER TABLE `web_services_notifications`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wf_company_list_hdfc`
--
ALTER TABLE `wf_company_list_hdfc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wf_lead_allocate`
--
ALTER TABLE `wf_lead_allocate`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wishfin_mailer_send`
--
ALTER TABLE `wishfin_mailer_send`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wishfin_quote_loan`
--
ALTER TABLE `wishfin_quote_loan`
  MODIFY `RequestID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_commentmeta`
--
ALTER TABLE `wpbnk_commentmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_comments`
--
ALTER TABLE `wpbnk_comments`
  MODIFY `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_links`
--
ALTER TABLE `wpbnk_links`
  MODIFY `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_options`
--
ALTER TABLE `wpbnk_options`
  MODIFY `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_phppc_functions`
--
ALTER TABLE `wpbnk_phppc_functions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_pollsa`
--
ALTER TABLE `wpbnk_pollsa`
  MODIFY `polla_aid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_pollsip`
--
ALTER TABLE `wpbnk_pollsip`
  MODIFY `pollip_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_pollsq`
--
ALTER TABLE `wpbnk_pollsq`
  MODIFY `pollq_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_postmeta`
--
ALTER TABLE `wpbnk_postmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_posts`
--
ALTER TABLE `wpbnk_posts`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_terms`
--
ALTER TABLE `wpbnk_terms`
  MODIFY `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_term_taxonomy`
--
ALTER TABLE `wpbnk_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_usermeta`
--
ALTER TABLE `wpbnk_usermeta`
  MODIFY `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wpbnk_users`
--
ALTER TABLE `wpbnk_users`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_blaster_reviews`
--
ALTER TABLE `wp_blaster_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_blaster_reviews_setting`
--
ALTER TABLE `wp_blaster_reviews_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_comments`
--
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_golfresult`
--
ALTER TABLE `wp_golfresult`
  MODIFY `result_aid` mediumint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_golftable`
--
ALTER TABLE `wp_golftable`
  MODIFY `table_aid` mediumint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_mappress_maps`
--
ALTER TABLE `wp_mappress_maps`
  MODIFY `mapid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_options`
--
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_pollsa`
--
ALTER TABLE `wp_pollsa`
  MODIFY `polla_aid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_pollsip`
--
ALTER TABLE `wp_pollsip`
  MODIFY `pollip_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_pollsq`
--
ALTER TABLE `wp_pollsq`
  MODIFY `pollq_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_sharebar`
--
ALTER TABLE `wp_sharebar`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_social_users`
--
ALTER TABLE `wp_social_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_terms`
--
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_yasr_log`
--
ALTER TABLE `wp_yasr_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wp_yasr_votes`
--
ALTER TABLE `wp_yasr_votes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wUsers`
--
ALTER TABLE `wUsers`
  MODIFY `UserID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wusers1`
--
ALTER TABLE `wusers1`
  MODIFY `UserID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xkyknzl5dwfyk4hg_tms_bank_api`
--
ALTER TABLE `xkyknzl5dwfyk4hg_tms_bank_api`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xkyknzl5dwfyk4hg_tms_whatsapp`
--
ALTER TABLE `xkyknzl5dwfyk4hg_tms_whatsapp`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xkyknzl5dwfyk4hg_whatsapp_callback`
--
ALTER TABLE `xkyknzl5dwfyk4hg_whatsapp_callback`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xkyknzl5dwfyk4hg_wishfin_whatsapp`
--
ALTER TABLE `xkyknzl5dwfyk4hg_wishfin_whatsapp`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xkyknzl5dwfyk4hg_wish_travel`
--
ALTER TABLE `xkyknzl5dwfyk4hg_wish_travel`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `xkyknzl5dwfyk4hg_wish_travel_data_city_list`
--
ALTER TABLE `xkyknzl5dwfyk4hg_wish_travel_data_city_list`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `yes_cc_city_state_list`
--
ALTER TABLE `yes_cc_city_state_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `yes_cc_company_list`
--
ALTER TABLE `yes_cc_company_list`
  MODIFY `yescompid` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `z2v_transactions`
--
ALTER TABLE `z2v_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `z2v_transactions2`
--
ALTER TABLE `z2v_transactions2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zexternal_appointment_details`
--
ALTER TABLE `zexternal_appointment_details`
  MODIFY `statid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zexternal_appointment_docs`
--
ALTER TABLE `zexternal_appointment_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zexternal_appointment_users`
--
ALTER TABLE `zexternal_appointment_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zexternal_campaign_smscontact`
--
ALTER TABLE `zexternal_campaign_smscontact`
  MODIFY `Compaign_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zexternal_lap_documents`
--
ALTER TABLE `zexternal_lap_documents`
  MODIFY `docs_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zexternal_leadallocation_log`
--
ALTER TABLE `zexternal_leadallocation_log`
  MODIFY `leadlogid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `zexternal_send_appointment_sms`
--
ALTER TABLE `zexternal_send_appointment_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `z_validate_ip_address`
--
ALTER TABLE `z_validate_ip_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `qa_categorymetas`
--
ALTER TABLE `qa_categorymetas`
  ADD CONSTRAINT `qa_categorymetas_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `qa_categories` (`categoryid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_contentwords`
--
ALTER TABLE `qa_contentwords`
  ADD CONSTRAINT `qa_contentwords_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_contentwords_ibfk_2` FOREIGN KEY (`wordid`) REFERENCES `qa_words` (`wordid`);

--
-- Constraints for table `qa_postmetas`
--
ALTER TABLE `qa_postmetas`
  ADD CONSTRAINT `qa_postmetas_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_posts`
--
ALTER TABLE `qa_posts`
  ADD CONSTRAINT `qa_posts_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE SET NULL,
  ADD CONSTRAINT `qa_posts_ibfk_2` FOREIGN KEY (`parentid`) REFERENCES `qa_posts` (`postid`),
  ADD CONSTRAINT `qa_posts_ibfk_3` FOREIGN KEY (`categoryid`) REFERENCES `qa_categories` (`categoryid`) ON DELETE SET NULL,
  ADD CONSTRAINT `qa_posts_ibfk_4` FOREIGN KEY (`closedbyid`) REFERENCES `qa_posts` (`postid`);

--
-- Constraints for table `qa_posttags`
--
ALTER TABLE `qa_posttags`
  ADD CONSTRAINT `qa_posttags_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_posttags_ibfk_2` FOREIGN KEY (`wordid`) REFERENCES `qa_words` (`wordid`);

--
-- Constraints for table `qa_tagwords`
--
ALTER TABLE `qa_tagwords`
  ADD CONSTRAINT `qa_tagwords_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_tagwords_ibfk_2` FOREIGN KEY (`wordid`) REFERENCES `qa_words` (`wordid`);

--
-- Constraints for table `qa_titlewords`
--
ALTER TABLE `qa_titlewords`
  ADD CONSTRAINT `qa_titlewords_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_titlewords_ibfk_2` FOREIGN KEY (`wordid`) REFERENCES `qa_words` (`wordid`);

--
-- Constraints for table `qa_userevents`
--
ALTER TABLE `qa_userevents`
  ADD CONSTRAINT `qa_userevents_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_userfavorites`
--
ALTER TABLE `qa_userfavorites`
  ADD CONSTRAINT `qa_userfavorites_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_userlimits`
--
ALTER TABLE `qa_userlimits`
  ADD CONSTRAINT `qa_userlimits_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_userlogins`
--
ALTER TABLE `qa_userlogins`
  ADD CONSTRAINT `qa_userlogins_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_usermetas`
--
ALTER TABLE `qa_usermetas`
  ADD CONSTRAINT `qa_usermetas_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_usernotices`
--
ALTER TABLE `qa_usernotices`
  ADD CONSTRAINT `qa_usernotices_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_userprofile`
--
ALTER TABLE `qa_userprofile`
  ADD CONSTRAINT `qa_userprofile_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `qa_uservotes`
--
ALTER TABLE `qa_uservotes`
  ADD CONSTRAINT `qa_uservotes_ibfk_1` FOREIGN KEY (`postid`) REFERENCES `qa_posts` (`postid`) ON DELETE CASCADE,
  ADD CONSTRAINT `qa_uservotes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `qa_users` (`userid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
