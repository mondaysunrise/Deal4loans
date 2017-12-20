<?if ($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '1'){ ?>
      <ul>
       <li><p align="left"><span class="bodyarial11">User Requests
       </span>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="Requests.php?type=personal">Personal Loan</a></li>
       <li><p align="left" class="bodyarial11"><a href="Requests.php?type=home">Home Loan</a></a></li>
	    <li><p align="left" class="bodyarial11"><a href="Requests.php?type=car">Car Loan</a></a></li>
		<li><p align="left" class="bodyarial11"><a href="Requests.php?type=property">Loan Against Property</a></a></li>
       <li><p align="left" class="bodyarial11"><a href="Requests.php?type=cc">Credit Card</a></li>
      </ul>
     </ul>
     <ul>
       <li><p align="left" class="bodyarial11"><a href="Bidder_Edit.php?edit=profile">Edit Profile</li>
       <li><p align="left" class="bodyarial11"><a href="Bidder_Edit.php?edit=pwd">Change Password</li>
	   <li><p align="left" class="bodyarial11"><a href="search.php">Download In Excel</li>
       <li><p align="left" class="bodyarial11"><a href="fresh_leads.php">Fresh Leads</li>
	   <li><p align="left" class="bodyarial11"><a href="all_fresh_leads.php">All Fresh Leads</li>
	   <li><p align="left" class="bodyarial11"><a href="reports.php">Reports</li>
     </ul>
     <span class="bodyarial11">
      <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '2'){?>
	</span>
     <b>Leads</b>
      <ul>
       <li id="change"><a href="citilogin_index.php">Personal Loan</a></li>
      </ul>
   
      <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '3'){?>
	</span>
      <ul>
		<b>Leads</b>
      <ul>
       <li><p align="left" class="bodyarial11"><a href="icicilogin_index.php">Home Loan</a></li>
      </ul>
     </ul>
      <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '4'){?>
	</span>
      
       <b>Leads</b>
       <li id="change"><p align="left" class="bodyarial11"><a href="hdfclogin_index.php">Personal Loan</a></li>
      </ul>
     </ul>
      <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '5'){?>
	</span>
      <ul>
       <b>Leads</b>
      <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="idbimumbailogin_index.php">Home Loan</a></li>
      </ul>
     </ul>
      <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '6'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="idbidelhilogin_index.php">Home Loan</a></li>
      </ul>
     </ul>
	 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '7'){?>
	</span>
      <ul>
      <b>Leads</b>
       <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="idbibanglorelogin_index.php">Home Loan</a></li>
      </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '8'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="citibanklaplogin_index.php">Loan Against Property</a></li>
      </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '9'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="hdfcdelhilogin_index.php">Home Loan </a></li>
      </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '10'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="insurancelogin_index.php">Insurance </a></li>
      </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '12'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="bhwpune_pllogin_index.php">Personal loan </a></li>
	    <li><p align="left" class="bodyarial11"><a href="bhwpunelogin_index.php">Home loan </a></li>
      </ul>
     </ul>
	 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '13'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="utichennai_hllogin_index.php">Home loan </a></li>
	    </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '14'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="Bhwbirladelhi_index.php">Home loan </a></li>
      </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '15'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="hsbcbangalore_pllogin_index.php">Personal loan </a></li>
	    </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '17'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="idbihyderabad_hllogin_index.php">Home loan </a></li>
	   <li><p align="left" class="bodyarial11"><a href="idbihyderabad_laplogin_index.php">Loan Against Property</a></li>
	    </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '18'){?>
	</span>
      <ul>
       <b>Leads</b>
      <ul>
       <li><p align="left" class="bodyarial11"><a href="LicHousingFinance_index.php">Home loan </a></li>
	    </ul>
     </ul>
	 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '19'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="utidelhi_hllogin_index.php">Home loan </a></li>
	   <li><p align="left" class="bodyarial11"><a href="utidelhi_laplogin_index.php">Loan Against Property</a></li>
	    </ul>
     </ul>
	 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '20'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="hsbcdelhi_pllogin_index.php">Personal loan </a></li>
	    </ul>
     </ul>
	 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '21'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="Reliance_index.php">Credit Card </a></li>
	    </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '22'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="IDBI_homeloan_index.php">Home Loan </a></li>
	    </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '23'){?>
	</span>
      <ul>
       <b>Leads</b>
      <ul>
       <li><p align="left" class="bodyarial11"><a href="Kotak_homeloan_index.php">Home loan </a></li>
	   <li><p align="left" class="bodyarial11"><a href="Kotak_lap_index.php">Loan Against Property</a></li>
	    </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '24'){?>
	</span>
      <ul>
       <b>Leads</b>
       </span>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="hdfc_mumbailogin_index.php">Personal loan </a></li>
	   <li><p align="left" class="bodyarial11"><a href="hdfc_mumbai_cl_index.php">Car Loan</a></li>
	    </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '25'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="icici_hyderabad_index.php">Home loan </a></li>
	   <li><p align="left" class="bodyarial11"><a href="icici_hyderabadlap_index.php">Loan Against Property</a></li>
	    </ul>
     </ul>
	 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '26'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="utipune_hllogin_index.php">Home loan </a></li>
	   <li><p align="left" class="bodyarial11"><a href="utipune_laplogin_index.php">Loan Against Property</a></li>
	    </ul>
     </ul>
 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '27'){?>
	</span>
      <ul>
       <b>Leads</b>
      <ul>
        <li><p align="left" class="bodyarial11"><a href="kotak_pl_index.php">Personal Loan</a></li>
	    </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '28'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
        <li><p align="left" class="bodyarial11"><a href="citibankbanglore_index.php">Home Loan</a></li>
	    </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '29'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
        <li id="change"><p align="left" class="bodyarial11"><a href="autoindia_index.php">Home Loan</a></li>
	    </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '30'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="citibangalore_index.php">Credit Card</a></li>
      </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '31'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="citibank_hlchennai_index.php">home Loan</a></li>
	   <li id="change"><p align="left" class="bodyarial11"><a href="citibank_lapchennai_index.php">Loan Against Property</a></li>
      </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '32'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="gemoney_hldelhi_index.php">home Loan</a></li>
	   <li id="change"><p align="left" class="bodyarial11"><a href="gemoney_lapdelhi_index.php">Loan Against Property</a></li>
	   <li id="change"><p align="left" class="bodyarial11"><a href="gemoney_pldelhi_index.php">Personal Loan</a></li>
      </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '33'){?>
	</span>
      <ul>
      <b>Leads</b>
       <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="icicidelhi_index.php">Home Loan</a></li>
	     </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '34'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li><p align="left" class="bodyarial11"><a href="mtlogin_index.php">All Leads</a></li>
	     </ul>
     </ul>
	  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '36'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li id="change"><p align="left" class="bodyarial11"><a href="mtleads.php">Lead MIS</a></li>
	     </ul>
     </ul>
	 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '37'){?>
	</span>
      <ul>
       <b>Leads</b>
       <ul>
       <li id="change" ><a href="deutsche_delhiindex.php">Personal Loan</a></li>
	     </ul>
     </ul>
	 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '38'){?>
	</span>
      <ul>
      <b>Leads</b>
       <ul>
       <li id="change"><a href="utibangalore_index.php">Home Loan</a></li>
	     </ul>
     </ul>
	 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '39'){?>
	</span>
      <ul>
    <b>Leads</b>
       <ul>
       <li id="change"><a href="citihyderabad_index.php">Home Loan</a></li>
	     </ul>
     </ul>
	<?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '40'){?>
	</span>
      <ul>
    <b>Leads</b>
         <ul>
       <li id="change"><a href="citipune_index.php">Home Loan</a></li>
	     </ul>
     </ul>
	 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '41'){?>
	</span>
      <b>Leads</b>
         <ul>
       <li id="change"><a href="Ingvbangalore_hl_index.php">Home Loan</a></li>
	     </ul>
		  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '42'){?>
	</span>
      <b>Leads</b>
         <ul>
       <li id="change"><a href="hdfcdelhi_hl_index.php">Home Loan</a></li>
	     </ul>
		  <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '43'){?>
	</span>
      <b>Leads</b>
         <ul>
       <li id="change"><a href="icicidelhi_lapindex.php">Loan Against Property</a></li>
	     </ul>
		   <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '44'){?>
	</span>
      <b>Leads</b>
         <ul>
       <li id="change"><a href="centurian_index.php">Home Loan</a></li>
	   <li id="change"><a href="centurian_index.php">Personal Loan</a></li>
	   <li id="change"><a href="centurian_index.php">Loan against property</a></li>
	     </ul>
		 <?}elseif($_SESSION['UserType'] == 'bidder' && $_SESSION['IsVerified'] == '45'){?>
	</span>
      <b>Leads</b>
         <ul>
       <li id="change"><a href="deutsche_plindex.php">Personal Loan</a></li>
	     </ul>
      <?}elseif($_SESSION['UserType'] == 'user'){?>
     </span>
     <ul>
	<li id="change"><a href="myRequests.php"><font class="bodyarial112">My Requests</a></li>
	<li id="change"><span class="bodyarial112">Apply for:</span>
	<ul>
		<li id="change"> <a href="Request_Loan_Personal_New.php" class="bodyarial112">Personal Loan</a></li>
		<li id="change"><a href="Request_Loan_Home_New.php" class="bodyarial112">Home Loan</a></li>
		<li id="change"><a href="Request_Loan_Car_New.php" class="bodyarial112">Car Loan</a></li>
		<li id="change"><a href="Request_Loan_Against_Property_New.php" class="bodyarial112">Loan Against Property</a></li>
		<li id="change"><a href="Request_Credit_Card_New.php" class="bodyarial112">Credit Cards</a></li>
		<li id="change"><a href="insurance_form.php" class="bodyarial112">Life Insurance</a></li>
      </ul>
	</li>
       <li id="change"><a href="User_Edit.php?edit=profile" class="bodyarial112">Edit Profile</a></li>
       <li id="change"><a href="User_Edit.php?edit=pwd" class="bodyarial112">Change Password</a></li>
     </ul>
     <span class="bodyarial11">
     <?}?>
     </span>