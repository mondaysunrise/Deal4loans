<?php
require_once("includes/application-top.php");

function ExactCustomerIP()
{
	$IP_Remote= getenv("REMOTE_ADDR");
	if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12' || $IP_Remote=="185.93.231.12" || $IP_Remot=="192.88.134.12")
	{
		$IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; 
	}
	else 
	{ 
		$IP= $IP_Remote;	
	}
	return($IP);
}
/*
$IP_Remote = $_SERVER["REMOTE_ADDR"];
if($IP_Remote=='192.124.249.12' || $IP_Remote=='185.93.228.12') { $IP= $_SERVER['HTTP_X_SUCURI_CLIENTIP']; }
else { $IP= $IP_Remote;	}
*/

$IP= ExactCustomerIP();
echo $IP;
//6030,6031,6032,6033,6043 -allocated_pllms_dashboard.php // 19May 16
//70,71,73 - pllms-self-emp-index.php // 19 May 16


if($_SESSION['BidderID']!="")
	{
		if($_SESSION['BidderID']==5657 || $_SESSION['BidderID']==5658 || $_SESSION['BidderID']==5633 || $_SESSION['BidderID']==6702 || $_SESSION['BidderID']==6703 || $_SESSION['BidderID']==6704 || $_SESSION['BidderID']==6705 || $_SESSION['BidderID']==6706 || $_SESSION['BidderID']==6707 || $_SESSION['BidderID']==6708 || $_SESSION['BidderID']==6709  || $_SESSION['BidderID']==7134 || $_SESSION['BidderID']==7135 || $_SESSION['BidderID']==7136 || $_SESSION['leadidentifier']=='diallerleadccwhatsappnew')
		{
			header("Location:cclms_index.php");
		}
		elseif($_SESSION['BidderID']==6088)
		{
			header("Location:cclms_sms_index.php");
		}
		elseif($_SESSION['leadidentifier']=='experianadmin')
		{
			header("Location:experian_admin_index.php");
		}
		elseif($_SESSION['leadidentifier']=='experian')
		{
			header("Location:experian_index.php");
		}
		elseif($_SESSION['BidderID']==5923 || $_SESSION['BidderID']==5924)
		{
			header("Location:cclmstwl_index.php");
		}
		elseif($_SESSION['BidderID']==5706 || $_SESSION['BidderID']==5705 || $_SESSION['BidderID']==5749)
		{
			header("Location:capitalfirstcallinglms_index.php");
		}
		elseif($_SESSION['BidderID']==5795 || $_SESSION['BidderID']==5796)
		{
			header("Location:capitalfirstcallingdirectlms_index.php");
		}
		elseif($_SESSION['BidderID']==5692)
		{
			header("Location:capitalfirstlms_index.php");
		}
		elseif($_SESSION['BidderID']==6160)
		{
			header("Location:capitalfirstdirectlms_index.php");
		}
		elseif($_SESSION['BidderID']==5793)
		{
			header("Location:smslead_upload.php");
		}
		elseif($_SESSION['BidderID']==6783 || $_SESSION['BidderID']==7448)
		{
			header("Location:backprocesslead_upload.php");
		}
                elseif($_SESSION['BidderID']==7218)
		{
			header("Location:backprocess_fullerton_lead_upload.php");
		}
		elseif($_SESSION['BidderID']==7238 || $_SESSION['BidderID']==7637)
		{
			header("Location:backprocess_kotak_lead_upload.php");
		}
                
                elseif($_SESSION['BidderID']==7612)
		{
			header("Location:scb_data_lead_upload.php");
		}
                elseif($_SESSION['leadidentifier']=='SMS_SCB_CALLING')
		{
		   header("Location:scb_lms_index.php");
		}
                elseif($_SESSION['leadidentifier']=='SMS_HDBFINANCE_CALLING')
		{
		   header("Location:hdb_lms_index.php");
		}
		elseif($_SESSION['BidderID']==5965)
		{
			header("Location:smsapp_pllmsplgn_dashboard.php");
		}
		elseif($_SESSION['BidderID']==5926)
		{
			header("Location:contactto_sendsmslead.php");
		} 
		elseif($_SESSION['BidderID']==5930 || $_SESSION['BidderID']==5929 || $_SESSION['BidderID']==5931 || $_SESSION['BidderID']==5959 || $_SESSION['BidderID']==5960 || $_SESSION['BidderID']==5973)
		{
			header("Location:smsapp_pllms_dashboard.php");
		}
		elseif($_SESSION['BidderID']==6029 || $_SESSION['BidderID']==6034)
		{
			header("Location:allocated_pllms_dashboard.php");
		}
		elseif($_SESSION['BidderID']==6681)
		{
			header("Location:cardsreport_view.php");
		}
		elseif($_SESSION['BidderID']==6167)
		{
			header("Location:bajaj_pllms_dashboard.php");
		}
		elseif($_SESSION['BidderID']==5936)
		{
			header("Location:chatapp_pllms_dashboard.php");
		}
		elseif($_SESSION['BidderID']==5808)
		{
			header("Location:capitalfirstcallingSElms_index.php");
		}
		elseif($_SESSION['BidderID']==6116 || $_SESSION['BidderID']==6117)
		{
			header("Location:hdfclms_index.php");
		}
		elseif($_SESSION['BidderID']==7190 || $_SESSION['BidderID']==7191 || $_SESSION['BidderID']==7192 || $_SESSION['BidderID']==7193 || $_SESSION['BidderID']==7229)
		{
			header("Location:creditreport_index.php");
		}		
		elseif($_SESSION['leadidentifier']=='MISSBI')
		{
		   header("Location:sbi_mis_cc_index.php");
		}
		elseif(($_SESSION['BidderID']==6671) && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="122.177.67.75" || $IP=="122.176.54.210" || $IP=="122.177.54.92" || $IP=="117.205.80.231" || $IP=="117.212.77.182" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="1.22.91.211"))
		{
			header("Location:cclms_admin_sr_index.php");// Credit Card Admin
		}
		elseif(($_SESSION['BidderID']==6769) && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP=="117.205.80.231" || $IP=="122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="1.22.91.116" || $IP=="122.176.77.240" || $IP=="1.22.91.211"))
		{
			header("Location:cc_lms_dashboard_sbi.php");// Credit Card Admin
		}
		elseif(($_SESSION['BidderID']==7528) && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP=="117.205.80.231" || $IP=="122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="1.22.91.116" || $IP=="122.176.77.240" || $IP=="103.12.135.98" || $IP=="122.160.2.249" || $IP=="115.254.0.58" || $IP=="1.22.91.211"))
		{
			header("Location:cc_lms_dashboard_digitech.php");// Credit Card Admin Digitech
		}
		elseif(($_SESSION['BidderID']==7529) && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP=="117.205.80.231" || $IP=="122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="1.22.91.116" || $IP=="122.176.77.240" || $IP=="1.22.91.211"))
		{
			header("Location:cc_lms_dashboard_iccs.php");// Credit Card Admin ICCS
		}
		elseif(($_SESSION['BidderID']==6775) && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="122.177.67.75" || $IP=="122.176.54.210" || $IP=="122.177.54.92" || $IP=="117.205.80.231" || $IP=="117.212.78.235" || $IP=="113.193.239.185" || $IP=="122.176.54.194" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="1.22.91.211"))
		{
			header("Location:mf_lms_dashboard.php");// Mutual Fund Admin
		}
		elseif(($_SESSION['BidderID']==6793) && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="122.177.67.75" || $IP=="122.176.54.210" || $IP=="122.177.54.92" || $IP=="117.205.80.231" || $IP=="117.212.78.235" || $IP=="113.193.239.185" || $IP=="122.176.54.194" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="1.23.116.104" || $IP=="1.22.91.57" || $IP=="122.176.68.155" || $IP=="1.22.91.211"))
		{
			header("Location:pl_lms_dashboard.php");die;// PL (CFL, TATA, ICICI, IIFL) Admin 
		}
		elseif(($_SESSION['BidderID']==6798) && ($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="122.177.67.75" || $IP=="122.176.54.210" || $IP=="122.177.54.92" || $IP=="117.205.80.231" || $IP=="117.212.78.235" || $IP=="113.193.239.185" || $IP=="122.176.54.194" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.176.77.239" || $IP=="203.122.21.163"|| $IP=="1.23.116.104" || $IP=="1.22.91.57" || $IP=="1.22.91.211"))
		{
			header("Location:pl_lms_dashboard.php");// PL (CFL, TATA, ICICI, IIFL) Super Admin
		}
		elseif($_SESSION['BidderID']==6299 || $_SESSION['BidderID']==6300 || $_SESSION['BidderID']==6386 || $_SESSION['BidderID']==6406 || $_SESSION['BidderID']==6407 || $_SESSION['BidderID']==6408 || $_SESSION['BidderID']==6409 || $_SESSION['BidderID']==6501 || $_SESSION['BidderID']==6502 || $_SESSION['BidderID']==6556 || $_SESSION['BidderID']==6557  || $_SESSION['BidderID']==6558 || $_SESSION['BidderID']==6559 || $_SESSION['BidderID']==6583 || $_SESSION['BidderID']==6584 || $_SESSION['BidderID']==6585 || $_SESSION['BidderID']==6586 || $_SESSION['BidderID']==6587 || $_SESSION['BidderID']==6588 || $_SESSION['BidderID']==6476 || $_SESSION['BidderID']==6589  || $_SESSION['BidderID']==6590 || $_SESSION['BidderID']==6591 || $_SESSION['BidderID']==6592 || $_SESSION['BidderID']==6593 || $_SESSION['BidderID']==6594 || $_SESSION['BidderID']==6595 || $_SESSION['BidderID']==6596 || $_SESSION['BidderID']==6597 || $_SESSION['BidderID']==6632 || $_SESSION['BidderID']==6633 || $_SESSION['BidderID']==6634 || $_SESSION['BidderID']==6635 || $_SESSION['BidderID']==6688 || $_SESSION['BidderID']==6689 || $_SESSION['BidderID']==6690 || $_SESSION['BidderID']==6691 || $_SESSION['BidderID']==6692 || $_SESSION['BidderID']==6694 || $_SESSION['BidderID']==6695 || $_SESSION['BidderID']==6696 || $_SESSION['BidderID']==6697 || $_SESSION['BidderID']==6698 || $_SESSION['BidderID']==6699 || $_SESSION['BidderID']==6701 || $_SESSION['BidderID']==6700  || $_SESSION['BidderID']==6739 || $_SESSION['BidderID']==6740 || $_SESSION['BidderID']==6741 || $_SESSION['BidderID']==6742 || $_SESSION['BidderID']==6743 || $_SESSION['BidderID']==6744 || $_SESSION['BidderID']==6745 || $_SESSION['BidderID']==6746 || $_SESSION['BidderID']==6747 || $_SESSION['BidderID']==6748 || $_SESSION['BidderID']==6749 || $_SESSION['BidderID']==6750  || $_SESSION['BidderID']==6751 || $_SESSION['BidderID']==6752 || $_SESSION['BidderID']==6753 || $_SESSION['BidderID']==6754 || $_SESSION['BidderID']==6755 || $_SESSION['BidderID']==6756 || $_SESSION['BidderID']==6757 || $_SESSION['BidderID']==6758 || $_SESSION['BidderID']==6790 || $_SESSION['BidderID']==6791 || $_SESSION['BidderID']==6792 || $_SESSION['BidderID']==6808 || $_SESSION['BidderID']==6809 || $_SESSION['BidderID']==6810 || $_SESSION['BidderID']==6811 || $_SESSION['BidderID']==6982 || $_SESSION['BidderID']==6983 || $_SESSION['BidderID']==6984 || $_SESSION['BidderID']==6985 || $_SESSION['BidderID']==6986 || $_SESSION['BidderID']==6987 || $_SESSION['BidderID']==7028 || $_SESSION['BidderID']==7029 || $_SESSION['BidderID']==7030 || $_SESSION['BidderID']==7031 || $_SESSION['BidderID']==7032 || $_SESSION['BidderID']==7033 || $_SESSION['BidderID']==7034 || $_SESSION['BidderID']==7035 || $_SESSION['leadidentifier']=='sbicallerdigilms_cc' || $_SESSION['leadidentifier']=='diallerleadccsmsnew')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP=="117.205.80.231" || $IP=="122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="1.22.91.113" || $IP=="1.22.91.116" || $IP=="122.176.77.240" || $IP=="103.12.135.98" || $IP=="103.47.56.10" || $IP=="122.160.2.249" || $IP=="115.254.0.58" || $IP=="1.22.91.211")
			{
				header("Location:cclms_sms_new_index.php");
			}
			else
			{
				session_unset();
				session_destroy();
				echo "<br />Please ask your Manager to get the IP whitelisted.";
				//die();
			}
		}
//	elseif($_SESSION['BidderID']==6723 || $_SESSION['BidderID']==6724)
		elseif($_SESSION['leadidentifier']=='rblcallerlms_cc' || $_SESSION['leadidentifier']=='rblcallerinternallms_cc' || $_SESSION['leadidentifier']=='rblcallerdigilms_cc')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="103.12.135.98" || $IP=="122.176.68.155" || $IP=="122.160.2.249" || $IP=="115.254.0.58" || $IP=="1.22.91.211")
			{
				header("Location:rblcclms_index.php");
			}
		}
		elseif($_SESSION['leadidentifier']=='amercianexpresscallerlms_cc' || $_SESSION['leadidentifier']=='amercianexpressinternalcallerlms_cc' || $_SESSION['leadidentifier']=='amexdigicallerlms_cc')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP== "122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155"  || $IP=="103.12.135.98" || $IP=="122.160.2.249" || $IP=="115.254.0.58" || $IP=="1.22.91.211")
			{
				header("Location:amexcreditcardlms_index.php");
			}
		}
		elseif($_SESSION['leadidentifier']=='ybankdigicallerlms_cc')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="103.12.135.98" || $IP=="115.254.0.58" || $IP=="1.22.91.211")
			{
				header("Location:ybankcclms_index.php");
			}
		}
		elseif($_SESSION['leadidentifier']=='CibilCallingLmsF' || $_SESSION['leadidentifier']=='CibilCallingLms')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="103.12.135.98" || $IP=="113.193.239.185" || $IP=="1.22.91.57" || $IP=="1.22.91.211")
			{
				header("Location:cbllms_view.php");
			}
		}
		elseif($_SESSION['leadidentifier']=='CallerVerifierYesBank')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="1.22.91.57" || $IP=="1.22.91.211")
			{
				header("Location:ybankccverifier_index.php");
			}
		}
		elseif($_SESSION['leadidentifier']=='CallerDigitechVerifierYesBank')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="103.12.135.98" || $IP=="115.254.0.58" || $IP=="1.22.91.211")
			{
				header("Location:ybankccsubverifier_index.php");
			}
		}
		elseif($_SESSION['leadidentifier']=='sbicallerlms_cc' || $_SESSION['leadidentifier']=='CCTRANSFER2CALLER')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP== "122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="1.22.91.116" || $IP=="1.22.91.211")
			{
				header("Location:sbicc_index.php");
			}
		}
		elseif($_SESSION['leadidentifier']=='sbicallerlms_cc')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP== "122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="1.22.91.211")
			{
				header("Location:sbicc_index.php");
			}
		}
		elseif($_SESSION['leadidentifier']=='icicibankcallerlms_cc' || $_SESSION['leadidentifier']=='icicibankinternalcallerlms_cc')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP== "122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="1.22.91.211")
			{
				header("Location:icicicc_index.php");
			}
		}
		elseif($_SESSION['leadidentifier']=='scbbankcallerlms_cc')
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP== "122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="1.22.91.211")
			{
				header("Location:scbcc_index.php");
			}
		}
		elseif($_SESSION['BidderID']==6729)
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30" || $IP=="182.71.109.218"  || $IP=="185.93.231.12" || $IP=="182.71.109.218" || $IP=="103.18.75.251" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130" || $IP== "122.176.54.210" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155" || $IP=="1.22.91.211")
			{
				header("Location:amexcclms_index.php");
			}
		}
		elseif($_SESSION['leadidentifier']=="mutualfundslms" || $_SESSION['BidderID']==6659 || $_SESSION['BidderID']==6660 || $_SESSION['BidderID']==6661 || $_SESSION['BidderID']==6770 || $_SESSION['BidderID']==6771|| $_SESSION['BidderID']==6772)
		{
			header("Location:mflms_index.php");
		}
		elseif($_SESSION['leadidentifier']=="wish_travel_caller_leads")
		{
			header("Location:travellms_index.php");
		}
		elseif($_SESSION['leadidentifier']=="hdfcbackcalling" || $_SESSION['leadidentifier']=="fullertonbackcalling" || $_SESSION['leadidentifier']=="kotakbackcallingDelhi" || $_SESSION['leadidentifier']=="kotakbackcallingJCK" || $_SESSION['leadidentifier']=="kotakbackcallingOthers"  || $_SESSION['leadidentifier']=="hdfcback_calling" || $_SESSION['BidderID']==7237 || $_SESSION['BidderID']==7239)
		{
			header("Location:backcallinglms_index.php");
		}
		elseif($_SESSION['leadidentifier']=="iciciwfcalling" || $_SESSION['BidderID']==6788 || $_SESSION['BidderID']==6789)
		{
			header("Location:iciciwflms_index.php");
		}
		elseif($_SESSION['BidderID']==6252 || $_SESSION['BidderID']==6253 || $_SESSION['BidderID']==6290 || $_SESSION['BidderID']==6684 || $_SESSION['BidderID']==7230 || $_SESSION['BidderID']==7347)
		{
			header("Location:bajajlms_index.php");
		}
		elseif($_SESSION['BidderID']==6768 )
		{
			header("Location:tulms_index.php");
		}		
		elseif($_SESSION['BidderID']==6801 )
		{
			header("Location:tu_lms_index.php");
		}		

		elseif($_SESSION['BidderID']==6120 )
		{
			header("Location:plselfemplms_index.php");
		}
		elseif($_SESSION['BidderID']==6376 )
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.60" || $IP=="180.151.74.83" || $IP=="115.249.245.30"  || $IP=="185.93.231.12"  || $IP=="182.71.109.218" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.176.77.239" || $IP=="1.22.91.211")
			{
				header("Location:citylms_index.php");
			}
		}
		elseif($_SESSION['BidderID']==6158 )
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.71.109.218" || $IP=="122.176.54.194" || $IP=="122.177.136.237" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="113.193.239.185" || $IP=="185.93.231.12" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="1.22.91.116" || $IP=="1.22.91.211")
			{
				header("Location:/leads_consolidate.php");
			}
		}
		elseif($_SESSION['BidderID']==6161 )
		{
			if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.71.109.218" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="1.22.91.57" || $IP=="1.22.91.211")
			{
				header("Location:/manual_leads_user_view.php");
			}
		}
		elseif($_SESSION['leadidentifier']=='sbiverifierlms')
		{
                    header("Location:cclms_index_verifier.php");
		}
                elseif($_SESSION['BidderID']==7493 || $_SESSION['BidderID']==7494 || $_SESSION['BidderID']==7495 || $_SESSION['BidderID']==7496)
                {
                    header("Location:fullertonlms_index.php");
                }
                elseif($_SESSION['BidderID']==7449)
                {
                    header("Location:conso_backcallinglms_index.php");
                }
                elseif($_SESSION['BidderID']==7636 || $_SESSION['BidderID']==7650)
                {
                    header("Location:consolidate-agent-lms.php");
                }
                else
		{
			if($_SESSION['BidderID']==9 || $_SESSION['BidderID']==10 || $_SESSION['BidderID']==846 || $_SESSION['BidderID']==847 || $_SESSION['BidderID']==854 || $_SESSION['BidderID']==63 || $_SESSION['BidderID']==67 || $_SESSION['BidderID']==68)
			{
				header("Location:pllmslogin.php");
				//header("Location:pllms_index.php");
			}
			else
			{
				session_unset();
				session_destroy();
				header("Location:lmslogin.php");
				
			}
		}
	}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	if($IP=="122.176.100.27" || $IP=="122.176.100.28" || $IP=="122.176.122.134" || $IP=="122.161.196.68" || $IP=="61.246.3.127" || $IP=="122.160.30.168" || $IP=="180.188.224.34" || $IP=="122.161.193.191" || $IP=="122.160.74.241" || $IP=="122.160.74.235" || $IP=="182.73.4.58" || $IP=="182.73.4.59" || $IP=="182.73.4.60" || $IP=="182.73.4.61" || $IP=="182.73.4.62" || $IP=="182.71.109.218"  || $IP=="180.151.74.83"  || $IP=="115.249.245.30" || $IP=="185.93.231.12" || $IP=="122.176.54.194" || $IP=="113.193.239.185" || $IP=="182.71.109.218"  || $IP=="122.177.136.237" || $IP=="122.177.67.75" || $IP=="122.176.54.210" || $IP=="103.18.75.251" || $IP=="124.124.244.139"  || $IP=="122.177.54.92" || $IP=="122.177.139.130"  || $IP=="117.212.78.93" || $IP=="122.176.77.240" || $IP=="122.176.77.79" || $IP=="122.180.253.3" || $IP=="124.124.244.141" || $IP=="122.176.77.239" || $IP=="203.122.21.163" || $IP=="122.176.68.155"  || $IP=="1.22.91.57" || $IP=="103.12.135.98" || $IP=="1.22.91.116" || $IP=="103.47.56.10" || $IP=="122.160.2.249" || $IP=="1.22.91.116" || $IP=="1.22.91.57" || $IP=="115.254.0.58" || $IP=="1.22.91.211")
	{
		$admincallerName = fun_db_output($_POST['callerName']); 
		$adminUname = fun_db_output($_POST['Email']); 
		$adminPass = fun_db_output($_POST['PWD']);
		if(!$objAdmin->fun_check_username_admin_existance($adminUname))
		{
			redirectURL(SITE_URL."lmslogin.php?msg=".urlencode("Please enter correct username!"));
		}
		if(!$objAdmin->fun_check_pwd_admin_existance($adminPass))
		{
			redirectURL(SITE_URL."lmslogin.php?msg=".urlencode("Your password does not match with our record. Please enter correct password!"));
		}
		
		if($objAdmin->fun_verify_admins($adminUname, $adminPass)){
			$adminInfo = $objAdmin->fun_getAdminUserInfo(0, $adminUname, $adminPass);
			if(sizeof($adminInfo)){
				$_SESSION['BidderID'] =  $adminInfo['BidderID'];
				$_SESSION['Email'] = $adminInfo['Email'];
				$_SESSION['PWD'] = $adminInfo['PWD'];
				$_SESSION['Bidder_Name'] = $adminInfo['Bidder_Name'];
				$_SESSION['City'] = $adminInfo['City'];
				$_SESSION['ReplyType'] = $adminInfo['Reply_Type'];
				$_SESSION['leadidentifier'] = $adminInfo['leadidentifier'];
				$_SESSION['CallStatus'] = $adminInfo['CallStatus'];
				$_SESSION['Global_Access_ID'] = $adminInfo['Global_Access_ID'];

				$sqlTrackBidder = "INSERT INTO  LMSLoginDetails (BidderID ,Bidder_Name ,Start_Time ,End_Time ,SessionID ,IP ,Product_Type) VALUES ( '".$adminInfo['BidderID']."',  '".$admincallerName."',  Now(),  '',  '',  '".$IP."',  '1')";
				$sqlTrackreult= $obj->fun_db_query($sqlTrackBidder);

				if($_SESSION['BidderID']==5657 || $_SESSION['BidderID']==5658 || $_SESSION['BidderID']==5633 || $_SESSION['BidderID']==6702 || $_SESSION['BidderID']==6703 || $_SESSION['BidderID']==6704 || $_SESSION['BidderID']==6705 || $_SESSION['BidderID']==6706 || $_SESSION['BidderID']==6707 || $_SESSION['BidderID']==6708 || $_SESSION['BidderID']==6709 || $_SESSION['BidderID']==7019 || $_SESSION['BidderID']==7020 || $_SESSION['BidderID']==7021)
				{
					redirectURL(SITE_URL."cclms_index.php");die;
				}
				elseif($_SESSION['BidderID']==5923 || $_SESSION['BidderID']==5924)
				{
					redirectURL(SITE_URL."cclmstwl_index.php");die;
				}
				elseif($_SESSION['BidderID']==6088)
				{
					redirectURL(SITE_URL."cclms_sms_index.php");die;
				}
				elseif($_SESSION['BidderID']==6723 || $_SESSION['BidderID']==6724)
				{
					redirectURL(SITE_URL."rblcclms_index.php");die;
				}
				elseif($_SESSION['BidderID']==6160)
				{
					redirectURL(SITE_URL."capitalfirstdirectlms_index.php");die;
				}
				elseif($_SESSION['BidderID']==5705 || $_SESSION['BidderID']==5706 || $_SESSION['BidderID']==5749)
				{
					redirectURL(SITE_URL."capitalfirstcallinglms_index.php");die;
				}
				elseif($_SESSION['BidderID']==5795 || $_SESSION['BidderID']==5796)
				{
					redirectURL(SITE_URL."capitalfirstcallingdirectlms_index.php");die;
				}
				elseif($_SESSION['BidderID']==7190 || $_SESSION['BidderID']==7191 || $_SESSION['BidderID']==7192 || $_SESSION['BidderID']==7193)
				{
					redirectURL(SITE_URL."creditreport_index.php");die;
				}	
				elseif($_SESSION['BidderID']==5692)
				{
					redirectURL(SITE_URL."capitalfirstlms_index.php");die;
				}
				elseif($_SESSION['BidderID']==5965)
				{
					redirectURL(SITE_URL."smsapp_pllmsplgn_dashboard.php");die;
				}
				elseif($_SESSION['BidderID']==5808)
				{
					redirectURL(SITE_URL."capitalfirstcallingSElms_index.php");die;
				}
				elseif($_SESSION['BidderID']==5793)
				{
					redirectURL(SITE_URL."smslead_upload.php");die;
				}
				elseif($_SESSION['BidderID']==5926)
				{
					redirectURL(SITE_URL."contactto_sendsmslead.php");die;
				}
				elseif($_SESSION['BidderID']==5930 || $_SESSION['BidderID']==5929 || $_SESSION['BidderID']==5931 || $_SESSION['BidderID']==5959 || $_SESSION['BidderID']==5960 || $_SESSION['BidderID']==5973)
				{
					redirectURL(SITE_URL."smsapp_pllms_dashboard.php");die;
				}
				elseif($_SESSION['BidderID']==6029 || $_SESSION['BidderID']==6034)
				{
					redirectURL(SITE_URL."allocated_pllms_dashboard.php");die;
				}
				elseif($_SESSION['BidderID']==6167)
				{
					redirectURL(SITE_URL."bajaj_pllms_dashboard.php");die;
				}
				elseif($_SESSION['BidderID']==5936)
				{
					redirectURL(SITE_URL."chatapp_pllms_dashboard.php");die;
				}
				elseif($_SESSION['BidderID']==6681)
				{
					redirectURL(SITE_URL."cardsreport_view.php");die;
				}
				elseif($_SESSION['BidderID']==6116 || $_SESSION['BidderID']==6117)
				{
					redirectURL(SITE_URL."hdfclms_index.php");die;
				}
                elseif($_SESSION['BidderID']==7493 || $_SESSION['BidderID']==7494 || $_SESSION['BidderID']==7495 || $_SESSION['BidderID']==7496)
				{
					redirectURL(SITE_URL."fullertonlms_index.php");die;
				}
				elseif($_SESSION['BidderID']==7296)
				{
					redirectURL(SITE_URL."cclms_index_verifier.php");die;
				}
				else
				{
					redirectURL(SITE_URL."lmslogin.php");die;
				}
			}
			else{
				redirectURL(SITE_URL."lmslogin.php?msg=".urlencode("Invalid username or password!"));
			}
		}
		else{
			redirectURL(SITE_URL."lmslogin.php?msg=".urlencode("Invalid username or password!"));
		}
		die;
	}else{
		redirectURL(SITE_URL."lmslogin.php?msg=".urlencode("Not permission for you!"));
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=WINDOWS-1252">
<title>Login(Bidder)</title>
<script Language="JavaScript" Type="text/javascript" src="../scripts/common.js"></script>
<link href="../includes/style1.css" rel="stylesheet" type="text/css">
<style>
.bidderclass {
	Font-family: Comic Sans MS;
	font-size: 13px;
}
.style1 {
	font-family: verdana;
	font-size: 12px;
	font-weight: bold;
	color: #084459;
}
</style>
<Script Language="JavaScript">
   function validateMe(theFrm){
	if(!checkData(theFrm.callerName, 'Name', 4))
	{
		return false;
	}
	if(!checkData(theFrm.Email, 'Email', 4))
	{
		return false;
	}
	var str=theFrm.Email.value
					var aa=str.indexOf("@")
					var bb=str.indexOf(".")
					var cc=str.charAt(aa)
					if(aa==-1)
						{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
						return false;
						}
					else if(bb==-1)
					{
					alert("Please enter the valid Email Address");
					theFrm.Email.focus();
					return false;
					}
	if(!checkData(theFrm.PWD, 'Password', 3))
		return false;
	return true;
    }
</Script>
<body style="margin:0px; padding:0px; background-color:#45B2D8;">
<div style="width:100%; background:#036; padding:0px 0px 2px 0px;">
<img src="http://www.deal4loans.com/homeimages/dea4lonasnew-logo.png" width="158" height="62"  >
</div>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse" valign="top">
  <tr bgcolor="#FFFFFF">
    <Td align="left" bgcolor="#45B2D8">&nbsp;</Td>
  </tr>
  <tr>
    <td style="padding-top:150px;"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"></td>
  </tr>
  <tr>
    <td bgcolor="#45B2D8" ><table width="361"   border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="361" height="43" align="center" valign="middle"><img src="../images/login-form-topshine-bg.gif" width="361" height="43"></td>
        </tr>
        <tr>
          <td height="156" align="center" valign="middle" background="../images/login-form-login-bg.gif"><form method="post" action="" onSubmit="return validateMe(this);">
              <table width="250" border="0" cellpadding="4" cellspacing="0">
                <tr>
                  <td colspan="2" align="center" id="Alert">&nbsp; <span class="bodyarial11" style="color:#F00"><?php echo $_REQUEST['msg'];?></span></td>
                </tr>
                <tr>
                  <td width="50%" class="style1">Name</td>
                  <td width="50%"><input type="text" name="callerName" size="20" maxlength="50" autocomplete="off"></td>
                </tr>
                <tr>
                  <td width="50%" class="style1">Email</td>
                  <td width="50%"><input type="text" name="Email" size="20" maxlength="50"  autocomplete="off"></td>
                </tr>
                <tr>
                  <td width="100%" class="style1">Password</td>
                  <td width="100%"><input type="password" name="PWD" size="20" maxlength="50" autocomplete="off"></td>
                </tr>
                <tr>
                  <td width="100%" colspan="2" align="center"><input name="submit" type="image"  src="../images/login-form-lgn-sbtn.gif" style="width:111px; height:35px; border:none;"></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr>
          <td width="361" height="70" align="center" valign="middle"><img src="../images/login-form-bot-shine-bg.jpg" width="361" height="70"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
