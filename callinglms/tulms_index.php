<?php
require_once("includes/application-top-inner-plcalling.php");
define("NoOFLMS", 2);
$time = date("G");
if(!empty($_GET['page'])){
$page = $_GET['page'];
}else{
$page = 1;
}
$limit = 20;
$start = ($page - 1) * $limit;

function cleanSpace($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', ' ', $string); // Removes special chars.
}

function ccMasking($number, $maskingCharacter = 'X') 
{
	return substr($number, 0, 2) . str_repeat($maskingCharacter, strlen($number) - 4) . substr($number, -2);
}

$BidderIDstatic=$_SESSION["BidderID"];

$salaryclause="";
if(isset($_REQUEST['salaryrange']))
{
		$salaryclause=$_REQUEST['salaryrange'];

}
  $CallStatus = $_SESSION['CallStatus']; 
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
	$type="";
	if(isset($_REQUEST['type']))
	{
		$type=$_REQUEST['type'];
	}
	$Feedback="";
	if(isset($_REQUEST['Feedback']))
	{
		$Feedback=$_REQUEST['Feedback'];
	}	


$CityStr = "'Kolkata', 'Jaipur', 'Lucknow', 'Chandigarh', 'Surat', 'Indore', 'Ludhiana', 'Bhopal', 'Patna', 'Guwahati', 'Nagpur', 'Kochi', 'Udaipur', 'Rajkot', 'Vadodara', 'Jalandhar', 'Jodhpur', 'Nashik', 'Thiruvananthapuram', 'Kota', 'Kanpur', 'Meerut', 'Ranchi', 'Coimbatore', 'Visakhapatnam', 'Bhubaneshwar', 'Jammu', 'Raipur', 'Bikaner', 'Dehradun', 'Madurai', 'Mohali (Sas Nagar)', 'Panchkula Urban Estate', 'Varanasi', 'Bilaspur', 'Cuttack', 'Mangalore', 'Siliguri', 'Bhatinda', 'Gwalior', 'Haora', 'Jabalpur', 'Jamshedpur', 'Kalyan Dombivali', 'Kolhapur', 'Kozhikode', 'Mysore', 'Sangli-Miraj-Kupwad', 'Bhilwara', 'Bidhan Nagar', 'Kukatpally', 'Mira Bhayander', 'Muzaffarpur', 'Rajarhat Gopalpur', 'Raurkela', 'Vapi', 'Dhule', 'Erode', 'Hissar', 'Jamnagar', 'Karnal', 'Kishangarh', 'Kottayam', 'Pali', 'Panaji', 'Panipat', 'Patiala', 'Pondicherry', 'Rohtak', 'Solapur', 'Sonipat', 'Tiruppur', 'Trichy', 'Vijaywada', 'Bareilly', 'Belgaum', 'Bhavnagar', 'Bhiwadi', 'Dhanbad', 'Dungarpur', 'Durgapur', 'Gandhidham', 'Gaya', 'Guntur', 'Hubli', 'Imphal', 'Jalgaon', 'Karimnagar', 'Kollam', 'Latur', 'Morvi', 'Palakkad', 'Pathankot', 'Phagwara', 'Pimpri Chinchwad', 'Salem', 'Satara', 'Shillong', 'Shimla', 'Sholinganallur', 'Silchar', ' Cachar Dist.', 'Sriganganagar', 'Srinagar', ' Jammu & Kashmir', 'Tambaram', 'Thrissur', 'Ujjain', 'Vasai', 'Vellore', 'Warangal', 'Yamuna Nagar', 'Anjar', 'Baran', 'Barmer', 'Barrackpur', 'Batala', 'Beawar', 'Berhampur', 'Bhagalpur', 'Bharatpur', 'Bharuch', 'Bhilai Nagar', 'Bhubaneswar ', 'Bhuj', 'Bokaro Steel City', 'Bopal', 'Borgaon', 'Botad', 'Bundi', 'Chandrapur', 'Chengalpet', 'Chidambaram', 'Chitlapakkam', 'Cuddalore', 'Darbhanga', 'Darjeeling', 'Dausa', 'Dibrugarh', 'Dombivali', 'Dum Dum', 'Ernakulam', 'Gandhinagar', ' Gujarat', 'Gondia', 'Gulbarga', 'Haldia', 'Hanumangarh ', 'Haridwar', 'Hazira', 'Hoshiarpur', 'Hosur', 'Ichalkaranji', 'Jajpur', 'Jalor', 'Jhalawar', 'Jhansi', 'Jhunjhunu', 'Jorhat', 'Kakinada', 'Kallakurichi', 'Kalol', 'Kancheepuram', 'Kannur', 'Kapurthala', 'Karad', 'Karaikudi', 'Kashipur', 'Khammam', 'Khanna', 'Kharagpur', 'Kharghar', 'Kundli', 'Kurukshetra', 'Malegaon', 'Mandsaur', 'Mansa', 'Mapusa', 'Margao', 'Mathura', 'Moga', 'Moti Kavdi', 'Muktsar', 'Nadiad', 'Nagaur', 'Nallasopara', 'Nanded', 'Nasirabad', 'Navsari', 'Neemrana', 'Nellore', 'Nimbahera', 'Nokha', 'Pallavaram', 'Panvel', 'Peddur', 'Puttur', 'Quthbullapur', 'Raichur', 'Rajahmundry', 'Rajpura', 'Ratlam', 'Ratnagiri', 'Rewa', 'Rewari', 'Rudrapur', 'Sagar', 'Sambalpur', 'Sawai Madhopur', 'Shahapur', 'Shiradwad', 'Sikar', 'Silvassa', 'Sirohi', 'Sirsa', 'Sumerpur', 'Suratgarh', 'Talod', 'Tanjore', 'Tepla', 'Thaltej', 'Thiruvarur', 'Tinsukia', 'Tirunelveli', 'Tirupattur', 'Udupi', 'Ulhasnagar', 'Valsad', 'Villupuram', 'Virar', 'Abhanpur/Naya Raipur ', 'Abu Road', 'Achalpur', 'Achrol', 'Adambakkam', 'Adampur', 'Adarki Budruk', 'Adityapur', 'Adoni', 'Adoor', 'Agalur', 'Agar', 'Agartala', 'Agra', 'Ahmadnagar', 'Ahmedabad', 'Ahmedgarh', 'Aizawl', 'Ajitwal', 'Ajmer', 'Ajnala', 'Ajra', 'Akaltara', 'Akola', ' Maharashta', 'Akot', 'Alandur', 'Alangudi', 'Alas', 'Alathiyur', 'Alavakotti', 'Alibag', 'Aligarh', 'Alipurduar', 'Allahabad', 'Almora', 'Alooda', 'Alore', 'Alot', 'Aluva', 'Alwar', 'Amalapuram', 'Amaravathipudur', 'Amargarh Chowki', 'Ambad', 'Ambala', 'Ambala Cantt.', 'Ambalapuzha', 'Ambattur', 'Ambejogai', 'Ambernath', 'Ambikapur', 'Ambur', 'Amet', 'Amingad', 'Amla', ' Betul Dist', 'Amloh', 'Amravati', 'Amritsar', 'Amsanpally', 'Amtala', 'Anakapalle', 'Anand', 'Anantapur', 'Ananthapuram', 'Anaparthi', 'Anchal', 'Andal (Gram)', 'Angamaly', 'Angul', 'Ankalkhop', 'Ankleshwar', 'Antah', 'Antela', 'Antervedipalem', 'Aquem', 'Arakonam', 'Arali', 'Arambag', 'Arani', 'Arasavanangadu', 'Arcot', 'Ariyalur', 'Armoor', 'Aroor', 'Arsikere', 'Arthuna', 'Asansol', 'Asara ', 'Ashok Nagar', 'Asika', 'Assandh', 'Astha', ' Sehore Dist', 'Athani', 'Athikaddu Thekkur', 'Athikkadai', 'Attingal', 'Attur', 'Aurangabad', 'Auroville', 'Ausa', 'Avadi', 'Avinangudi', 'Avinashi', 'Avinipatti', 'Ayyappanthangal', 'Babian', 'Babina', 'Bachh Khera', 'Bachupally', 'Badarpur', 'Baddi', 'Badhkalan', 'Badhnu', 'Badlapur', 'Badnagar', 'Badshahpur', 'Bagalkot', 'Bagani', 'Bagasara', 'Bagdogra', 'Baghapurana', 'Bagri', 'Bagru', 'Bahadurgarh', 'Baharampur', 'Bahraich', 'Bahubali', 'Bahul', 'Baidyabati', 'Baikunthpur', 'Bailhongal', 'Balachaur', 'Balaghat', 'Balasore', 'Balinga', 'Balitutha', 'Bally', 'Baloda Bazar', 'Balotra', 'Balsamand', 'Balugaon', 'Balurghat', 'Bambora', 'Banda', 'Bandanwara', 'Bandaposanpally', 'Bandikui', 'Banga', 'Bangarapet', 'Bankra', 'Bankura', 'Bansi', 'Banswara', 'Bantala (Tardaha)', 'Bapatla', 'Bapini', 'Barad', 'Baramati', 'Baranagar', 'Barar', 'Barara', 'Barasat', 'Barbil', 'Bardoli', 'Bargarh', 'Bari Sadri', 'Baripada', 'Barliyas', 'Barnala', 'Barpali', 'Barshi', 'Baruipur', 'Barwala', 'Barwani', 'Basanti', 'Basirhat', 'Bastar', 'Batlagundu', 'Baudhgarh', 'Bavada', 'Bavla', 'Bazar Bhogaon', 'Beas', 'Bedag', 'Bedla', 'Beejova', 'Beelri', 'Beenota', 'Begowal', 'Begusarai', 'Behror', 'Belar', 'Bellary', 'Bemetara', 'Benaulim', 'Betul', 'Bhachalva', 'Bhadani', 'Bhadaur', 'Bhadla', 'Bhadrak', 'Bhadreswar', 'Bhadsora', 'Bhandara', 'Bhanvad', 'Bhardravad', 'Bhatapara', 'Bhatkal', 'Bhattu Mandi', 'Bhavani', 'Bhawanigarh', 'Bhawaninagar', 'Bhawanipatna', 'Bhed', 'Bheekamkor', 'Bhesavahi', 'Bhikapura', 'Bhikhiwind', 'Bhillai', 'Bhimavaram', 'Bhimpur', 'Bhinder', 'Bhindol', 'Bhira Patnus', 'Bhiwani', 'Bhoj', 'Bhuban', 'Bhucho Mandi', 'Bhusawal', 'Bhuvanagiri', 'Bhuwasa', 'Biaora', 'Bicholim', 'Bid', 'Bidadi', 'Bidar', 'Bidkin', 'Bigod', 'Biholi', 'Bijapur', 'Bijolia', 'Bila', 'Bilimora', 'Billur', 'Bodakdev', 'Bodhani', 'Boisar', 'Bolangir', 'Bolpur', 'Bommaiahgari Palle', 'Bommasandra', 'Bongaigaon', ' Bongaigaon Dist', 'Bongaon', 'Boothamanagalam', 'Boranara', 'Bordi Inami', 'Borgaon(Tasgaon)', 'Borsad', 'Brahmani Kalmeshwar', 'Brahmapur', ' Ganjam Dist', 'Brahmapuri', 'Bramhanal', 'Bramhanandanagar', 'Budge Budge', 'Budhagaon', 'Bugga', 'Buldhana', 'Burdwan', 'Burhanpur', 'Buti Bori', 'Calangute', 'Canacona', 'Candolim', 'Chaheru', 'Chaibasa', 'Chak Ganeshgarh', 'Chakan ', 'Chakardharpur', 'Chaksu', 'Chalakudy', 'Chalisgaon', 'Challakere', 'Champa', 'Champaneri', 'Champuah', 'Chandaka', 'Chandannagar', 'Chandikhol', 'Chandrakona Road', 'Chandrampet', 'Chandranagar', 'Changanacherry', 'Changodar', 'Channagiri', 'Channapatna', 'Chaparyali', 'Charkhi Dadri', 'Chas', 'Chatrapatti', 'Chatrapur', 'Chawand', 'Cheeka', 'Chelgal', 'Chenganur', 'Cherpulacherry', 'Cherthala', ' Alapuzha Dist', 'Cheyyar (Tiruvethipuram)', 'Chhabaliya', 'Chhabra', 'Chhani', 'Chhatarpur', 'Chhatral', 'Chhinch', 'Chhitaurgarh', 'Chhota Udaipur', 'Chikhli', 'Chikiliya', 'Chikiti', 'Chikmagalur', 'Chilakaluripet', 'Chilakota', 'Chilarvant', 'Chinchali', 'Chinchinim', 'Chinchwad', 'Chirala', 'Chirkunda', 'Chirmiri', 'Chittaurgarh', 'Chittoor', 'Chittur Thathamangalam', 'Chomu', 'Chowdhwar', 'Churu', 'Colva', 'Coonoor', 'Cuncolim', 'Curchorem Cacora', 'D.Muppavaram', 'Dabhoi', 'Daboda Khurd', 'Dabra', 'Dadhela', 'Dadri', 'Dahanu', 'Dahej', 'Dahod', 'Dakor', 'Dalkhoa', 'Dalli Rajhara', 'Daltonganj', 'Daman & Diu', 'Danapur', 'Dandeli', 'Dankuni', 'Danpur', 'Dapoli Camp', 'Dared', 'Dariba', 'Darlipali', 'Dasgaon', 'Dasla', 'Dasua', 'Davangere', 'Deesa', 'Deheli Gaon ', 'Dehgam', 'Dehra', 'Dei', 'Delwara', 'Deolali', 'Deoli', 'Deolia Kalan', 'Depalpur', 'Derabassi', 'Devanahalli', 'Devikapuram', 'Devipattinam', 'Dewas', 'Dhaligaon', 'Dhamni', 'Dhamnod', 'Dhamtari', 'Dhan Ka Bada', 'Dhandhoda', 'Dhansura', 'Dhantej', 'Dhar', 'Dharamjaygarh', 'Dharamkot', 'Dharampur', 'Dharapuram', 'Dhariwal', 'Dharmaj', 'Dharmapuri', 'Dharmshala', 'Dharuhera', 'Dharur', 'Dharwad', 'Dhaurapali', 'Dhavali', 'Dhenkanal', 'Dhoraji', 'Dhrangadhra', 'Dhrol', 'Dhuliajaan', 'Dhundhara', 'Dhuri', 'Diamond Harbour', 'Dighanchi', 'Digras', 'Dinanagar', 'Dindigul', 'Dindori', 'Dinhata', 'Dipka', 'Doraha', 'Duburi', 'Dumka', 'Dungarwant', 'Durg', 'Dwarka', 'Edappal', 'Elathur', 'Ellenabad', 'Eluru', 'Erattupetta ', 'Eriyur', 'Eru', 'Erulapatti', 'Examba', 'Falta', 'Faridkot', 'Fatehnagar ', 'Ferani', 'Ferozpur', 'Firozabad', 'Gachibowli', 'Gadag-Betigeri', 'Gadarwara', 'Gadhinglaj', 'Gajuwaka', 'Galatga', 'Gambharia', 'Gandapatrapali', 'Gandharpalli', 'Gandhinagar', ' Maharashtra', 'Ganeshwadi', 'Gangapur City', 'Gangawati', 'Gangtok', 'Gannaur', 'Gaongurha', 'Garbor', 'Garhshankar', 'Gediya', 'Gharaunda', 'Gharghoda', 'Ghatak Pukur', 'Ghatkesar', 'Ghatwa', 'Gheradi', 'Ghotavade(Panhala Tah.)', 'Ghoti Bhudruk', 'Giridih', 'Gobichettipalayam', 'Gobindgarh', 'Godda', 'Godhra', 'Gollapudi', 'Goltim', 'Gondal', 'Gorakhpur', 'Goraya', 'Gothada', 'Govindgarh', 'Gudha Nathawat', 'Gudivada', 'Gudur', 'Gulabpura', 'Guledagudda', 'Gumla', 'Guna', 'Guntakal', 'Gurdaspur', 'Guruvayur', 'Gyanpara', 'Habra', 'Hajipur', 'Haldwani', 'Haldwani-Cum-Kathgodam', 'Halflong', 'Halol', 'Halvad', 'Hamirgarh', 'Hamirpur', 'Hapur', 'Harda', 'Harihar', 'Harippad', 'Haripur', 'Hasarchampu', 'Hassan', 'Haveri', 'Hazaribag', 'Hazaribagh', 'Himmatnagar', 'Hingna', 'Hingoli', 'Hinjilicut', 'Hitani', 'Honnali ', 'Hoshangabad', 'Hoskote', 'Hospet', 'Hosur', ' Dhramapuri Dist.', 'Huzurabad', 'Idappadi', 'Idar', 'Igatpuri', 'Indapur', 'Indri', 'Irinjalakuda', 'Irle Vairag', 'Ismailabad', 'Israna', 'Itarsi', 'Itawa', 'Jadcherla', 'Jagadhri', 'Jagatsinghpur', 'Jagdalpur', 'Jagraon', 'Jainabad', 'Jaisinghdesar Magra', 'Jakhal', 'Jaleshwar', 'Jalia', 'Jalna', 'Jalpaiguri', 'Jambuda', 'Jamkhandi', 'Jamner', 'Jandiala', 'Jandiala Guru', 'Jangameshwarapuram', 'Jangareddygudem', 'Janmahammadpur', 'Jaora', 'Jarwala', 'Jasana', 'Jaswantgarh', 'Jatani', 'Jath', 'Jawala', 'Jaysingpur', 'Jetpur Navagadh', 'Jeypur', 'Jhabua', 'Jhagadia', 'Jhakdewali', 'Jhalar Baori', 'Jhalat', 'Jhamar Kotra ', 'Jharsuguda', 'Jhumri Tilaiya', 'Jobner', 'Joda', 'Jodhpurgam', 'Jogendranagar', 'Jogighopa', 'Joyan', 'Jugsalai', 'Jullakallu', 'Junagad', 'Kachhola', 'Kadaladi', 'Kadasan', 'Kadayanallur', 'Kadegaon', 'Kadi', 'Kadodara', 'Kagal', 'Kahari Kadeem', 'Kaithal', 'Kakkanad', 'Kalady', 'Kalanaur', 'Kalanwali', 'Kalasapur', 'Kalegaon', 'Kalimpong', 'Kalka', 'Kallai', 'Kallal', 'Kallambalam', 'Kalna', 'Kalyani', 'Kamareddy', 'Kamptee', 'Kanavaipatti', 'Kanchika Charla', 'Kanchrapara', 'Kandanur', 'Kandavarayanpatti', 'Kandukur', 'Kangeyam', 'Kangra', 'Kanigiri', 'Kaniha', 'Kanjirappally', 'Kankavali', 'Kanker', 'Kanniyapuram', 'Kannoj', 'Kantabania', 'Kanwas', 'Kapadvanj', 'Kapra', 'Kapren (Kaprain)', 'Kara Sahib', 'Karadaguru', 'Karaikal', 'Karaiyur', 'Karambali', 'Kareeri', 'Kargani', 'Karjan', 'Karkal', 'Karnajora', 'Karnal ', 'Kartarpur', 'Karur', 'Karwar', 'Kasargode', 'Kasegaon', 'Kashitola ', 'Katikanapally', 'Katni', 'Katol', 'Katras', 'Kattakada', 'Kaulage', 'Kavalapur', 'Kavali', 'Kavalkinaru', 'Kavathepiran', 'Kawardha', 'Kawathe Mahankal', 'Kayalpattinam', 'Kayamkullam', 'Kazhakutom', 'Keelakarai', 'Keelavalaru', 'Keeranur', 'Kekri', 'Kelambakkam', 'Keliya', 'Kelwa', 'Kendrapara', 'Kenjal', 'Keonjhar', 'Kera', 'Keshod', 'Khachraud', 'Khailabad', 'Khairthal', 'Khajisonenahalli', ' Bangalore', 'Khamgaon', 'Khandwa', 'Kharar', 'Kharbadi', 'Khardah', 'Khargone', 'Khariar Road', 'Kharsia', 'Khatwa', 'Khed', 'Kheroda', 'Kherva', 'Khijadiya', 'Khodla', 'Khopoli', 'Khoraj', 'Khunti', 'Khurda', 'Kinathukadavu', 'Kirkee', 'Kiwana', 'Kizhoor Iritty', 'Koch Bihar', 'Kodaikanal', 'Kodangallur', 'Kodinar', 'Kodumudi', 'Kolakaravadi', 'Kolar', 'Kolencherry', 'Kollidam', 'Komaratchi', 'Konapet', 'Konerirajapuram', 'Konnagar', 'Koothanallur', 'Koothattukulam', 'Koothuparamba', ' Kannur Dist', 'Kopargaon', 'Koppal', 'Koppanapatti', 'Korapally', 'Korba', 'Kosamba', 'Koshigram', 'Koshithal', 'Kosi Kalan', 'Kotakkal', 'Kotawade', 'Kotdwara', 'Kothagudem', 'Kothali', 'Kothamangalam', ' Kerala', 'Kothamangalam', ' Tamil Nadu', 'Kotkapura', 'Kotputli', 'Kottaipattinam', 'Kottaiyur', 'Kottarakara', 'Kottiyam', 'Kovilambakkam', 'Kovur', 'Kozhencherry', 'Krushnanandapur', 'Kshetra Mahuli', 'Kudal', 'Kuditre', 'Kukkudwad', 'Kulipirai', 'Kumaravelur', 'Kumbakonam', 'Kumbalagodu', 'Kumbanad', 'Kumbhalmer', 'Kumbhoj', 'Kumna', 'Kundapur', 'Kundara', 'Kundrathur', 'Kunnamangalam', 'Kuraj', 'Kurali', 'Kurnad-Mudipu', 'Kurseong', 'Kurud', 'Kurundwad', 'Kushalnagar', 'Kusmi', 'L.B. Nagar', 'Ladwa', 'Lalpet', 'Lalsot ', 'Lamphelpat', 'Landran', 'Lankelapalem', 'Lasalgaon', 'Lasani', 'Laxminagar', 'Lemallepadu', 'Liluah', 'Limb', 'Lohardaga', 'Lonand', 'Longowal', 'Macherla', 'Machhiwara', 'Machilipatnam', 'Machnur', 'Madanapalle', 'Madavaram', 'Madekeri', 'Madhapur', 'Madhavnagar', 'Madhyamgram', 'Madippakkam', 'Madlauda', 'Maduranthakam', 'Maduravayol', 'Mahad', 'Maharajwas', 'Mahasamund', 'Mahbubnagar', 'Mahidam', 'Mahilpur', 'Mahipalanpatti', 'Mahodiya', 'Maihar', ' Satna Dist', 'Majitha', 'Makronia', 'Mala', 'Malaiyur', 'Malappuram', 'Maldah', 'Malharpeth', 'Malkajgiri', 'Malkapur', 'Mallikapuram', 'Malthan', 'Malvan', 'Mamer', 'Manavadar', 'Mancherial', 'Mandapeta', 'Mandi', 'Mandideep', 'Mandla', 'Mandlikpur', 'Mandore Mandi', 'Mandrem', 'Manerajuri', 'Manesar', 'Mangalagiri', 'Mangalwedha', 'Mangaon', 'Mango', 'Mangrop', 'Manikonda Jagir', 'Manipal', 'Manjeri', 'Manmad', 'Mannargudi', 'Mannarkad', 'Manoharpur', 'Manpada', 'Manvi', 'Maraimalainagar', 'Marcela', 'Matheri', 'Mauje Tasgaon', 'Mavelikkara', 'Mawana', 'Medak', 'Medchal', 'Mehsana', 'Melanikuli Kudikadu', 'Melapavoor', 'Melasivapuri', 'Mellur', 'Melolakkur', 'Memari', 'Meri Dhani', 'Metoda', 'Mettupalayam', 'Mettur', 'Mevli', 'Mhaswad', 'Mhow', 'Midanur', 'Modasa', 'Modinagar', 'Mohadi', 'Mohali', 'Mohanpura', 'Mohanraopet', 'Mohi', 'Mohol', 'Mohopada Alias Wasambe', 'Morak (Modak)', 'Morba', 'Morinda', 'Moti Amrol', 'Moti Jhari', 'Motihari', 'Mudbidri', 'Mudhol', 'Mudichur', 'Mukerian', 'Mullanpur Dakha', 'Mullanpur Garibadas', 'Mundra', 'Mundwa', 'Mungeli', 'Muradnagar', 'Muraiyur', 'Murbad', 'Murshidabad', 'Musiri', 'Mussoorie', 'Muthupet', 'Mydaram', 'Nabarangapur', ' Nawrangpur Dist', 'Nabha', 'Nachandupatti', 'Nagalpar', 'Nagamalai Pudukottai', 'Nagapattinam', 'Nagarnar', 'Nagda', ' Ujjain Dist', 'Nagercoil', 'Nahan', 'Naidupet', 'Naigaon', 'Naihati', 'Nainital', 'Nakhatrana', 'Nakodar', 'Nalagarh', 'Nalgonda', 'Nalia Abdasa', 'Nalwi', 'Namakkal', 'Nandigama', 'Nangal', 'Nanjangud', 'Naraingarh', 'Narasampet', 'Narasaroapet', 'Narayangaon', 'Narendrapur', 'Narlapur', 'Narwad', 'Narwana', 'Natepute', 'Nathdwara', 'Naugachia', 'Naugama', 'Nausar', 'Nava Sheva', 'Navagam', 'Navelim', 'Nawanshahar', 'Nayagarh', 'Nazare', 'Nedumangad', 'Needamangalam', 'Nelamangala', 'Nemathanpatti', 'Neyveli', 'Neyyanttinkkara', 'Nigdhu', 'Nilambur', 'Nilanga', 'Nilokheri', 'Nipani', 'Nisa', 'Niwai', 'Nohar', 'North Paravur', 'Numaligarh Refinary Township', 'Nurmahal', 'Nuzvid', 'Ongole', 'Oragadam', 'Orai', 'Orathur', 'Ottapalam', 'Oyyakandan Siruvayal', 'Ozar', 'Pachora', 'Padampur', 'Padianallur', 'Padra', 'Paganeri', 'Pahihati', 'Paithan', 'Palacole', 'Palai', 'Palamaner', 'Palampur', 'Palani', 'Palanpur', 'Palasa', 'Palavangudi', 'Palej', 'Palghar', 'Palitana', 'Palladam', 'Palli', 'Pallikaranai', 'Pallipalayam', 'Palmathu Gamra', 'Palodara', 'Palwal', 'Pammal', 'Panaikulam', 'Panayapatti', 'Panchela', 'Panchkula', 'Pandharpur', 'Pandhurna', ' Chindwara Dist', 'Pandua', 'Panjim', 'Panna', 'Panoor ', 'Panruti', 'Paradip', 'Paramakudi', 'Parappanangadi', 'Parbhani', 'Pardi', 'Parlakhemundi', 'Parola', 'Parompat', 'Parvala', 'Parvathipuram', 'Parwanoo', 'Patan', 'Pathain', 'Pathanamthitta', 'Patran', 'Patratu', 'Pattamadi', 'Pattambi', 'Patti', 'Pattipulam', 'Pattiyandal', 'Pattukottai', 'Pavithram', 'Pawarwadi', 'Pawti', 'Payyannur', 'Peddapalli', 'Peddapuram', 'Pehowa', 'Pennadam', 'Peralam', 'Perambalur', 'Perianaickenpalayam', 'Perinthalmanna', 'Periyakulam', 'Pernem', 'Perumbakkam', 'Perundurai', 'Perungalathur', 'Peth Vadgaon', 'Petlad', 'Phalodi', 'Phaltan', 'Phillaur', 'Phulbani', 'Phulia Kalan', 'Phusro', 'Pilani', 'Pilerne', 'Pillamanklam Alagapuri', 'Pimpalgaon', 'Pipariya', 'Pipli', 'Pirachi Kuroli', 'Piravom', 'Pocharam', 'Pollachi', 'Ponda', 'Ponnamaravathy', 'Ponpethi', 'Poolampatti', 'Poonamallee', 'Poranki', 'Port Blair', 'Portonova', 'Porur', 'Pothencode', 'Potlan', 'Pratap Sasan', 'Proddatur', 'Ptihampur', ' Dhar Dist', 'Pudukottai', 'Pulankurichi', 'Pulgaon', 'Puliyur', 'Puluj', 'Punalur', ' Kollam Dist', 'Puri', 'Pusad', 'Pushkar', 'Puttaparthi', 'Puzhakkal', 'Quepem', 'Quilandy', 'Rabdal', 'Rabkavi Banhatti', 'Rahuri Khd', 'Raigarh', 'Raila', 'Rairangpur', 'Raisinghnagar', 'Raithal', 'Rajagangapur', ' Sundargarh Dist', 'Rajapalayam', 'Rajendranagar', 'Rajgarh', 'Rajnandgaon', 'Rajpur Sonarpur', 'Rajsamand', 'Rajula', 'Ramachandrapuram', 'Ramagri', 'Ramanagaram', 'Ramanandnagar', 'Ramanattukara', 'Ramanthapur', 'Ramapattinam', 'Ramapuram', 'Ramchandrapuram', 'Ramganj Mandi', 'Ramgarh', 'Ramnagar', 'Rampura Phull', 'Ranaghat', 'Ranavav', 'Rangiem', 'Rania', 'Raniganj', 'Ranjangaon', 'Ranni', 'Rasipuram', 'Ratangarh', 'Rau', ' Indore Dist', 'Ravanasamudram', 'Raver', 'Ravet', 'Ravulapalem', 'Rayagada', 'Rayavaram', 'Rayya', 'Reddiarchatram', 'Reencher', 'Remuna', 'Rendal', 'Renukoot', 'Rethare Harnax', 'Rikhabdeo', 'Rilon', 'Rishikesh', 'Rishra', 'Rohat', 'Rol', 'Roorkee', 'Ropar', 'Rusuda ', 'S. Sokkanathapuram', 'Sabalgarh', ' Morena Dist', 'Sachin', 'Sadhoona', 'Saharanpur', 'Sahibabad', 'Sahnewal', 'Salemabad', 'Salgare', 'Salwad', 'Samalkha', 'Samana', 'Samayanallur', 'Samrala', 'Samrau', 'Sanand', 'Sangamner', 'Sanganahalli', 'Sangareddy', 'Sangli', 'Sangole', 'Sangrur', 'Sanjauli', 'Sankari', 'Sankheda', 'Santa Cruz', 'Sapla', 'Sarangarh', 'Sarkoli', 'Saruda', 'Sasthamcotta', 'Sasvad', 'Sathyamangalam', 'Satna', 'Sattur', 'Saundatti', 'Savalaj', 'Savarkundla', 'Savner', 'Sayan', 'Secunderabad', 'Sehore', 'Selaiyur', 'Sendhwa', 'Seoni', 'Seoni Malwa', 'Hoshangabad Dist', 'Serampore', 'Seri-Lingampally', 'Sewantri', 'Shabashpally', 'Shahbad', 'Shahpura', 'Shajapur', 'Shambhupura', 'Shamgarh', 'Shazadpur', 'Shedshal', 'Sheopur', 'Shikaripur', 'Shikohabad', 'Shimoga', 'Shirahatti', 'Shirala', 'Shirdi', 'Shirpur-Warwade', 'Shirwal', 'Shivpuri', ' Shivpuri Dist', 'Shornanur', 'Shreepur (Borgaon)', 'Shrigonda', 'Shrirampur', 'Shujalpur', ' Shajapur Dist', 'Sibsagar', ' Sibsagar Dist', 'Siddamma Agraharam', 'Siddheshwarkuroli', 'Sidhmukh', 'Sihora', 'Sillod', 'Simdega', 'Simliguda', 'Sindhanur', 'Sindkheda', 'Singampunari', 'Singapur', 'Singrauli', 'Sinner', 'Siolim', 'Sirathu', 'Sircilla', 'Sirhind', 'Sirsedu', 'Sirsi', 'Siruguppa', 'Siruseri', 'Siruvachoor', 'Siruvanthadu', 'Sithalapakkam', 'Sithilingamadam', 'Sivaganga', 'Sivakasi', 'Siwah', 'Sohna', 'Sojat', 'Solan', 'Sonepur', 'Sonkatch', 'South Dum Dum', 'Sri Ganganagar', 'Srikakulam', 'Srikalahasti ', 'Sriperumbudur', 'Srirangam', 'St. Thomas Mount', 'Sule', 'Sultanganj', 'Sultanpur', 'Sumarganj Mandi', 'Sunam', 'Sundarapandipuram', 'Sundergarh', 'Sundernagar', 'Suri', 'Surpur', 'Tadepalligudam', 'Takali', 'Talaja', 'Talcher', 'Talegaon Dabhade', 'Taliparamba', 'Talwandi Bhai', 'Talwandi Sabo', 'Tamarassery', 'Tambesara', 'Tanda', 'Tanda Ratna', 'Tandur', 'Tantoti', 'Tanuku', 'Taraori', 'Tarn Taran', 'Tasgaon', 'Telenpali', 'Tenali', 'Tenkasi', 'Terdal', 'Tezpur', ' Sonitpur Dist', 'Thangad', 'Theni', 'Theog', 'Therwada', 'Thiruparamkundram', 'Thiruparankundram', 'Thiruvalla', 'Thiruvallur', 'Thiruvannamalai', 'Thiruverumbur', 'Thodupuzha', 'Thoraipakkam', 'Thottipatti', 'Thoubal', 'Thrippunithura', 'Thriumuruganpoondi', 'Thudiyalur', 'Thullur', 'Tikamgarh', 'Tikota', 'Tikundi', 'Timbi', 'Tindivanam', 'Tiruchendur', 'Tiruchengode', 'Tiruchirapalli', 'Tiruchirapally', 'Tirumangalam', 'Tirupathi', 'Tirupati', 'Tirur', 'Tirurangadi Chemmad', 'Tiruvalam', 'Tiruvottiyur', 'Tokar', 'Toothukudi', 'Toramdih', 'Toranagallu', 'Trikkakara', 'Trimbak', 'Triprayar', 'Tripunithura', 'Tuljapur', 'Tumkur', 'Tundav', 'Tung', 'Turchi', 'Tuticorin', 'Udgaon', 'Udgir', 'Udumalpet', 'Ugar Khurd', 'Uklana Mandi', 'Uluberia', 'Umar Tanda', 'Umarani', 'Umbergaon', 'Umerkote', 'Umred', 'Umroi', 'Una', 'Unchabali', 'Unjha', 'Upari', 'Uppal', 'Uppal Kalan', 'Urapakkam', 'Uttarpara', 'Vadakandam', 'Vadakara', 'Vadakarimbalur', 'Vadakkancheri', 'Vadakkankulam', 'Vadavalli', 'Vadinar', 'Vadipatti', ' Madurai Dist', 'Vaduj', 'Vaikom', 'Valanchery', 'Vallabh Vidya Nagar', 'Valoothoor', 'Vanavasi', 'Vandavasi ', 'Vaniyambadi', 'Varal', 'Varkala', 'Varkana', 'Vasad', 'Vasagade', 'Vasco Da  Gama', 'Vattiyoorkavu', 'Veerapandi', 'Vellakoyil', 'Vellalur', 'Vellanur', 'Vemandampalayam', 'Vengara', 'Veraval', 'Veraval Shapar', 'Verna', 'Vettaikaranpudur', 'Vidisha', 'Vijapur', 'Vijaynagar', 'Vikas Nagar', 'Vikravandi', 'Virachilai', 'Virudhachalam', 'Virudhunagar ', 'Visnagar', 'Vita', 'Vizianagaram', 'Vrindavan', 'Vyara', 'Wadakancherry', 'Wadi', 'Wagholi', 'Waidhan', 'Wakhari', 'Waluj', 'Wanaparthi', 'Wani', 'Wankaner', 'Warananagar', 'Warandh', 'Wardha', 'Warud', 'Wategaon', 'Yadgir', 'Yavatmal', 'Yembal', 'Zadeshwar', 'Zahirabad', 'Zira', 'Zirakpur'";

$CallStatus=1;
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
					defaultDate: "today",
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
        
       <!-- <script type="text/javascript" src="/js/jquery.js"></script>-->
<script type="text/javascript">

    function checkCall(RequestID,agent_user)
    {	
	   $.ajax({ type: 'post',  url: '/dialer_click2callpl.php',  data: {  RequestID:RequestID,agent_user:agent_user, },
			   success: function (response) {
			   //alert(response);
			   $( '#name_status' ).html(response);
  		          if(response=="OK") { return true;	 } else { return false;	}
                }
		      });
	  
	}


		var ajaxRequest;  // The variable that makes Ajax possible!
		function ajaxFunction(){
			
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
		}

			
		function getNumValue(iLoc,id, parameterVal)
		{
			//alert(iLoc);
			var allLoc = [];
			if(parameterVal>0 )
			{
				for(var iTrav=1; iTrav <= parameterVal; iTrav++) { allLoc.push(iTrav); }
			}
			else
			{
				for(var iTrav=1; iTrav <= <?php echo $limit; ?>; iTrav++) { allLoc.push(iTrav); }
			}
			var iRemove = allLoc.indexOf(iLoc);
			if(iRemove != -1) { allLoc.splice(iRemove, 1); }
			
		//	alert(allLoc);
			
			var queryString = "?get_requestid=" + id;
			ajaxRequest.open("GET", "/getfullertonNum.php" + queryString, true);
			ajaxRequest.onreadystatechange = function(){
				if(ajaxRequest.readyState == 4)
				{
					document.getElementById('clik4Num_'+ iLoc).innerHTML = "<b style='font-size:12px;'>"+ajaxRequest.responseText+"</b>";
						for(var iTraverse = allLoc.length; iTraverse--;)
						{ document.getElementById('clik4Num_'+ allLoc[iTraverse]).innerHTML = 'XXXXXXXXXX';	}
				}
			}
				ajaxRequest.send(null); 
		}
		window.onload = ajaxFunction;
	</script>
		</head>
		<body style="margin:0px 0px 0px 0px; padding:0px 0px 0px 0px; background-color:#45B2D8;">
<!-- End Main Banner Menu Panel --><div style="width:100%; background: #CCC; padding:0px 0px 10px 0px;"><div style="background:#F00; width:40px; padding-left:7px; line-height:30px; height:30px; float:right; margin-right:50px; margin-top:7px; border-radius:20%;"><a href="logout.php" style="color:#FFF; text-align:center; text-decoration:none; font-size:12px;">Logout</a></div>
<div style="clear:both;"></div>
</div>
<div style="clear:both; height:15px;"></div>
          <div> 
    <table width="98%" border="0">
	<!--  <tr><td align="right"><a href="/commonlms_report.php?bidderid=<?php echo $_SESSION['BidderID'];?>&product=1" target="_blank">today's Report</a></td></tr>-->
              <tr>
        <td align="right"></td>
      </tr>
              <tr>
        <td align="center" width="100%"><div align="center">
            <table width="600" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <form name="frmsearch" action="tulms_index.php" method="get" onSubmit="return chkform();">
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
                    <input name="min_date" type="text" id="min_date" size="15" value="<? echo $_REQUEST['min_date']; ?>" ></td>
                  <td width="13%" style="text-align:right;">To</td>
                  <td><input name="max_date" type="text" id="max_date" size="15" value="<? echo $_REQUEST['max_date']; ?>"></td>
                </tr>
                <tr>
                  <td width="12%"><strong>Feedback:</strong></td>
                  <td width="29%">
                  <select name="cmbfeedback" id="cmbfeedback" class="input-lead">
 		<option value="All" <? if($varCmbFeedback == "All") { echo "selected"; } ?>>All</option>
		<option value="" <? if($varCmbFeedback == "") { echo "selected"; } ?>>No Feedback</option>
	<option value="Ringing" <? if($varCmbFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
        <option value="Appointment" <? if($varCmbFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
        <option value="Followup" <? if($varCmbFeedback == "Followup") { echo "selected"; } ?>>Follow up</option>
    	<option value="Not Eligible - FOIR" <? if($varCmbFeedback == "Not Eligible - FOIR") { echo "selected"; } ?>>Not Eligible - FOIR</option>
    	<option value="Not Eligible - Salary" <? if($varCmbFeedback == "Not Eligible - Salary") { echo "selected"; } ?>>Not Eligible - Salary</option>
    	<option value="Not Eligible - Others" <? if($varCmbFeedback == "Not Eligible - Others") { echo "selected"; } ?>>Not Eligible - Others</option>
	<option value="Not Interested - Direct" <? if($varCmbFeedback == "Not Interested - Direct") { echo "selected"; } ?>>Not Interested - Direct</option>
    <option value="Not Interested - Offer" <? if($varCmbFeedback == "Not Interested - Offer") { echo "selected"; } ?>>Not Interested - Offer (ROI/PF etc)</option>
    <option value="Not Interested - Loan Amount" <? if($varCmbFeedback == "Not Interested - Loan Amount") { echo "selected"; } ?>>Not Interested - Loan Amount</option>
 <option value="Not Contactable" <? if($varCmbFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
        
       <option value="TU Approved" <? if($varCmbFeedback == "TU Approved") { echo "selected"; } ?>>TU Approved</option>
 
<option value="TU Approved Followup" <? if($varCmbFeedback == "TU Approved Followup") { echo "selected"; } ?>>TU Approved Followup</option>
<option value="TU Approved Not Interested" <? if($varCmbFeedback == "TU Approved Not Interested") { echo "selected"; } ?>>TU Approved Not Interested</option>
 <option value="TU Referred" <? if($varCmbFeedback == "TU Referred") { echo "selected"; } ?>>TU Referred</option>
 <option value="TU Referred Followup" <? if($varCmbFeedback == "TU Referred Followup") { echo "selected"; } ?>>TU Referred Followup</option>
  <option value="TU Referred Not Interested" <? if($varCmbFeedback == "TU Referred Not Interested") { echo "selected"; } ?>>TU Referred Not Interested</option> 
 <option value="TU Declined" <? if($varCmbFeedback == "TU Declined") { echo "selected"; } ?>>TU Declined</option>
           </select>
                  
                  </td>
      <td width="29%" align="center"  valign="middle" class="bidderclass"><strong>Net Salary</strong></td>
	  <td width="58%"  valign="middle" class="bidderclass"><select name="salaryrange" id="salaryrange">
		<option value="-1" <? if($salaryclause=="-1") echo "selected"; ?>>Please select</option>
		<option value="1" <? if($salaryclause=="1") echo "selected"; ?>>0- 2.4 lacs</option>
		<option value="2" <? if($salaryclause=="2") echo "selected"; ?>>2.4 lacs - 3.6 lacs</option>
		<option value="3" <? if($salaryclause=="3") echo "selected"; ?>>3.6 lacs & above</option></select>
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

	if(strlen(trim($RequestID))>0)
	{
		$strSQL="";
		$Msg="";
		$fbqry="select FeedbackID from Req_Feedback_PL where AllRequestID=$RequestID and BidderID=".$_SESSION['BidderID']." AND Reply_Type=1";
		$result = $obj->fun_db_query($fbqry);	
				
		$num_rows = $obj->fun_db_get_num_rows($result);
		if($num_rows > 0)
		{
			$row = $obj->fun_db_fetch_rs_array($result);
			$strSQL="Update Req_Feedback_PL Set Feedback='".$Feedback."' ";
			$strSQL=$strSQL."Where FeedbackID=".$row["FeedbackID"];
		}
		else
		{
			$strSQL="Insert into Req_Feedback_PL(AllRequestID, BidderID, Reply_Type , Feedback) Values (";
			$strSQL=$strSQL.$RequestID.",".$_SESSION['BidderID'].",'1','".$Feedback."')";
		}

//echo $strSQL;
		$result = $obj->fun_db_query($strSQL);
		if ($result == 1)
		{
		}
		else
		{
			$Msg = "** There was a problem in adding your feedback. Please try again.";
		}
		
	}
	

	if($search=="y")
	{		
		$min_dateonly=$min_date;
		$max_dateonly=$max_date;

		$min_date=$min_date." 00:00:00";
		$max_date=$max_date." 23:59:59";

		if(strlen(trim($varCmbFeedback))==0)
		{
			$FeedbackClause=" AND (Req_Feedback_PL.Feedback IS NULL OR Req_Feedback_PL.Feedback='' OR Req_Feedback_PL.Feedback='No Feedback') ";
		}
		else if($varCmbFeedback=="All")
		{
			$FeedbackClause=" ";
		}
		else
		{
			$FeedbackClause=" AND Req_Feedback_PL.Feedback='".$varCmbFeedback."' ";
		}	
		
		if($salaryclause=="1")
		{
			$salaryfilter="AND (Net_Salary>='0' and Net_Salary<'240000')";
		}
		elseif($salaryclause=="2")
		{
			$salaryfilter="AND (Net_Salary>='240000' and Net_Salary<'360000')";	
		}
		elseif($salaryclause=="3")
		{
			$salaryfilter="AND (Net_Salary>='360000')";
		}
		else
		{
			$salaryfilter="";
		}	
	/*
		$qryExcludeSourceSql = "SELECT * FROM manual_user_details where 1=1";
//		$qryExcludeSourceQuery = ExecQuery($qryExcludeSourceSql);
		$qryExcludeSourceQuery = $obj->fun_db_query($qryExcludeSourceSql);
	//	$qryExcludeSourceNum =$objAdmin->qryExcludeSourceSql($qryExcludeSourceSql);
		$excludeSource = '';
		while($qryExcludeSourceRow = $obj->fun_db_fetch_rs_object($qryExcludeSourceQuery))
		{
			$source_eS = $qryExcludeSourceRow->source;
			$excludeSource .= " and ".TABLE_REQ_LOAN_PERSONAL.".source!='".$source_eS."' ";
		}
		
		$qryExcludeSourceCallingSql = "SELECT * FROM exclude_source_calling where 1=1 and reply_type=1 and status=1";
		$qryExcludeSourceCallingQuery = $obj->fun_db_query($qryExcludeSourceCallingSql);
		$qryExcludeSourceCallingNum = mysql_num_rows($qryExcludeSourceCallingQuery);
		$excludeSourceC = '';
		$excludeSourceC .= "( ".TABLE_REQ_LOAN_PERSONAL.".ex_source!='below60k' ";
		while($qryExcludeSourceCallingRow = $obj->fun_db_fetch_rs_object($qryExcludeSourceCallingQuery))
		{	
			$source_eSC =  $qryExcludeSourceCallingRow->source;
			$excludeSourceC .= " and ".TABLE_REQ_LOAN_PERSONAL.".source!='".$source_eSC."' ";
		}
		
		$excludeSourceC .= $excludeSource."  )";	
		
	*/	
	?>       <p class="bodyarial11">
              <?=$Msg?>
            </p>
             <p><span id="name_status" style="color:#F00; font-weight:bold;"></span> </p>
            <table width="758" border="0" cellpadding="4" cellspacing="1" class="blueborder" bgcolor="#FFFFFF">
              <? $srh_qry=""; 
	//		  echo "BidderIDstatic - ".$BidderIDstatic;
		if($mob_num>0)
		{
			$mob_num_clause = " AND ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number = '".$mob_num."' ";
		}
		if($BidderIDstatic!="")
		{
			//echo "hello";
			$feedback_tble="xkyknzl5dwfyk4hg_tms_bank_api";
			$qry="SELECT * FROM ".$feedback_tble.",".TABLE_REQ_LOAN_PERSONAL." LEFT OUTER JOIN Req_Feedback_PL ON Req_Feedback_PL.AllRequestID=".TABLE_REQ_LOAN_PERSONAL.".RequestID AND Req_Feedback_PL.BidderID= '".$BidderIDstatic."' WHERE ( ".$feedback_tble.".d4l_id = ".TABLE_REQ_LOAN_PERSONAL.".RequestID and ".TABLE_REQ_LOAN_PERSONAL.".Allocated=0 and ((".$feedback_tble.".date_requested Between '".($min_date)."' and '".($max_date)."') or (Req_Feedback_PL.Followup_Date Between '".($min_date)."' and '".($max_date)."')) and  ".$feedback_tble.".bank_code='229' and  ".$feedback_tble.".product_type='PL' and  ".$feedback_tble.".web_services_default_values_id in (2,9) and (".TABLE_REQ_LOAN_PERSONAL.".City in (".$CityStr.") or ".TABLE_REQ_LOAN_PERSONAL.".City_Other in (".$CityStr."))  ) "; //and  ".$feedback_tble.".web_services_default_values_id in (1,8)
			$qry=$qry.$FeedbackClause." ".$mob_num_clause ." ".$salaryfilter." group by ".TABLE_REQ_LOAN_PERSONAL.".Mobile_Number " ;
		}		
	$srh_qry = $qry;

//echo $qry;
$resCount = $objAdmin->fun_get_num_rows($qry);
if($resCount>$limit)
{
$pagelinks = paginate($limit, $resCount);
}
$getParameterVal = min($start+$limit,$resCount) % $limit;
$qry.= " order by ".$feedback_tble.".date_requested DESC LIMIT $start,$limit ";
//echo $qry;
//echo "<br>".$resCount;
$result = $obj->fun_db_query($qry);
 ?>
              <tr>
                <td colspan="11"><strong><? echo $start+1; ?> to <? if($resCount >$limit) { echo $start+$limit; }else {echo $resCount;} ?> Out of <? echo $resCount; ?> Records </strong></td>
              </tr>
              <tr>
                <td class="head1">Name</td>
                <td class="head1">Mobile</td>
                <td class="head1">Salary</td>
                <td class="head1">City</td>
              <!--  <td class="head1">Eligible Bidders</td>-->
                <td class="head1">Feedback</td>                
                <td class="head1">FollowUp date</td>               
            <!--	<td class="head1">View history</td>
                <td class="head1">Call</td>-->
              </tr>
              <?			
	if($resCount>0)
			{
				$color = 1;		
				
		while($row = $obj->fun_db_fetch_rs_object($result))
		{
			//print_r($obj->fun_db_fetch_rs_object($result));
			$Followup_Date = $row->Followup_Date;				
			$exptodayformat = explode(" ",$Followup_Date);
			$explodeTime = explode(":",$exptodayformat[1]);
			$explodeHr = $explodeTime[0] - 1; 
			$FinalMinDate = '"'.$exptodayformat[0].' '.$explodeHr.':'.$explodeTime[1].':'.$explodeTime[2].'"';
			$FinalMaxDate ='"'.$exptodayformat[0].' 23:59:59"';
			$TodayFormat = date("Y-m-d");
			$FinalDay = $exptodayformat[0];		
			$Employment_Status=$row->Employment_Status;
			
			if($color%2!=0)
					{
						$colorvar = "#FFF";
					}
				else{
						$colorvar = "#EEE";
					}
	?>
                 <tr  bgcolor="<?php echo $colorvar;?>">			 
                <td class="bodyarial11">
                <a href="/edit-tu-appointments.php?id=<? echo urlencode($row->RequestID); ?>&Bid=<? echo $BidderIDstatic;?>&to=<? echo $min_date;?>&from=<? echo $max_date;?>" target="_blank"><? echo $row->Name; ?></a></td>
                <td class="bodyarial11">
                 <?php 
                if($CallStatus==1) {
                ?>
                  <span id="clik4Num_<?php echo $color; ?>">XXXXXXXXXX</span>

                
                <?php } else {  echo ccMasking($row->Mobile_Number); } ?>

                <?php //echo ccMasking($row->Mobile_Number); ?></td>
                <td class="bodyarial11">
                
                <? 
                  if($CallStatus==1) {
                ?>
<span id="clkNum<?php echo $color; ?>" onClick="getNumValue(<?php echo $color; ?>,<?php echo $row->RequestID; ?>,<?php echo $getParameterVal; ?>);" style="cursor:hand;"><? echo $row->Net_Salary; ?></span> <?php } else {  echo $row->Net_Salary; } ?>
</td>
                <td class="bodyarial11"><? if($row->City=="Others") {echo $row->City_Other; } else { echo $row->City; } ?></td>
				<!--<td class="bodyarial11"><?php 
				/*list($FinalBidder,$finalBidderName) = $objeligiblebidderfuncPL->getBiddersList("Req_Loan_Personal",$row->RequestID,$row->City,$row->Referral_Flag,$row->source);

   for($i=0;$i<count($FinalBidder);$i++)
			{
		
		echo $finalBidderName[$i].","; // 2140293
			}*/
		?></td>-->
       
		<td class="bodyarial11">
                 <? echo getJumpMenu("tulms_index.php",$row->RequestID,"1",$row->Feedback,$page,$varmin_date,$varmax_date,$varCmbFeedback, $val) ?>
      
     </td>
         <td class="bodyarial11"><input type="text" name="Followup_Date" id="Followup_Date" value="<? echo $Followup_Date; ?>"></td>
   <!--<td class="bodyarial11"><a href="javascript:void(0)"
onclick="window.open('http://www.deal4loans.com/get_complete_detailspl.php?mob=<? echo urlencode($row->RequestID); ?>&pt=Req_Loan_Personal')" >View</a>
<?php
/*$sourceLead =  $row->source;
if(strlen(strpos($sourceLead, "wf -")) > 0)
{
	echo '<br><b style="color:red; font-weight:bold; font-size:10px;">WishFin</b>';
}*/
?>
</td>-->
<!--  <td class="bodyarial11">
           <input type="button" name="chkCall" value="Call" onClick="checkCall(<?php echo $row->RequestID ?>,<?php echo $_SESSION['BidderID'] ?>)" />        </td>-->
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
		<?
function getJumpMenu($varPHPPage, $varRequestID, $varType, $varFeedback, $varpageon, $varmindate, $varmaxdate,$cmbfeedback,$varVal)
{
//www.deal4loans.com/callinglms/tulms_index.php?search=y&RequestID=2115107&type=1&pageno=&min_date=2016-05-01&max_date=2016-06-01&cmbfeedback=All&product=Req_Loan_Personal&Feedback=Not%20Applied 
	$strURL="";
	$strURL=$varPHPPage."?search=y&RequestID=".$varRequestID."&type=".$varType."&pageno=".$varpageon."&min_date=".urlencode($varmindate)."&max_date=".urlencode($varmaxdate)."&cmbfeedback=".urlencode($cmbfeedback)."&product=".$varVal;
?>
	<select name="type" id="type" onChange="MM_jumpMenu('parent',this,0)" class="style3" style="width:110px;">
		     
<option value="<? echo $strURL.'&Feedback='?>" <? if($varFeedback == "") { echo "selected"; } ?> >No Feedback</option>
        <option value="<? echo $strURL.'&Feedback=Ringing'?>" <? if($varFeedback == "Ringing") { echo "selected"; } ?>>Ringing</option>
        <option value="<? echo $strURL.'&Feedback=Appointment'?>" <? if($varFeedback == "Appointment") { echo "selected"; } ?>>Appointment</option>
        <option value="<? echo $strURL.'&Feedback=Followup'?>" <? if($varFeedback == "Followup") { echo "selected"; } ?>>Follow up</option>
        <option value="<? echo $strURL.'&Feedback=Not Eligible - FOIR'?>" <? if($varFeedback == "Not Eligible - FOIR") { echo "selected"; } ?>>Not Eligible - FOIR</option>
        <option value="<? echo $strURL.'&Feedback=Not Eligible - Salary'?>" <? if($varFeedback == "Not Eligible - Salary") { echo "selected"; } ?>>Not Eligible - Salary</option>
        <option value="<? echo $strURL.'&Feedback=Not Eligible - Others'?>" <? if($varFeedback == "Not Eligible - Others") { echo "selected"; } ?>>Not Eligible - Others</option>
        <option value="<? echo $strURL.'&Feedback=Not Interested - Direct'?>" <? if($varFeedback == "Not Interested - Direct") { echo "selected"; } ?>>Not Interested - Direct</option>
        <option value="<? echo $strURL.'&Feedback=Not Interested - Offer'?>" <? if($varFeedback == "Not Interested - Offer") { echo "selected"; } ?>>Not Interested - Offer (ROI/PF etc)</option>
        <option value="<? echo $strURL.'&Feedback=Not Interested - Loan Amount'?>" <? if($varFeedback == "Not Interested - Loan Amount") { echo "selected"; } ?>>Not Interested - Loan Amount</option>
		<option value="<? echo $strURL.'&Feedback=Not Contactable'?>" <? if($varFeedback == "Not Contactable") { echo "selected"; } ?>>Not Contactable</option>
         <option value="<? echo $strURL.'&Feedback=TU Approved'?>" <? if($varFeedback == "TU Approved") { echo "selected"; } ?>>TU Approved</option>
        <option value="<? echo $strURL.'&Feedback=TU Approved Followup'?>" <? if($varFeedback == "TU Approved Followup") { echo "selected"; } ?>>TU Approved Followup</option>
        <option value="<? echo $strURL.'&Feedback=TU Approved Not Interested'?>" <? if($varFeedback == "TU Approved Not Interested") { echo "selected"; } ?>>TU Approved Not Interested</option>
        <option value="<? echo $strURL.'&Feedback=TU Referred'?>" <? if($varFeedback == "TU Referred") { echo "selected"; } ?>>TU Referred</option>
          <option value="<? echo $strURL.'&Feedback=TU Referred Followup'?>" <? if($varFeedback == "TU Referred Followup") { echo "selected"; } ?>>TU Referred Followup</option>
          <option value="<? echo $strURL.'&Feedback=TU Referred Not Interested'?>" <? if($varFeedback == "TU Referred Not Interested") { echo "selected"; } ?>>TU Referred Not Interested</option>
        <option value="<? echo $strURL.'&Feedback=TU Declined'?>" <? if($varFeedback == "TU Declined") { echo "selected"; } ?>>TU Declined</option>  
       
</select>
	
<?
}
?>
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
<?php 
//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>".$qry;;
?>
