<?php
//ob_start();
	require 'scripts/db_init.php';
	require 'scripts/functions.php';
session_start();

$titles = array('1'=>'1029', '2'=>'1215', '3'=>'1221', '4'=>'1292', '5'=>'1432', '6'=>'1436', '7'=>'1439', '8'=>'1095', '9'=>'1096', '10'=>'1097', '11'=>'1098', '12'=>'1106', '13'=>'1108', '14'=>'1338', '15'=>'1339', '16'=>'1340', '17'=>'1343', '18'=>'1347', '19'=>'1348', '20'=>'1350', '21'=>'1451', '22'=>'1452', '23'=>'1164', '24'=>'1165', '25'=>'1025', '26'=>'1470', '27'=>'1471', '28'=>'1473', '29'=>'1480', '30'=>'1204', '31'=>'1223', '32'=>'1424', '33'=>'1425', '34'=>'1429', '35'=>'1433', '36'=>'1435', '37'=>'1293', '38'=>'1427', '39'=>'1428', '40'=>'1431', '41'=>'1437', '42'=>'1379', '43'=>'1381', '44'=>'1387', '45'=>'1385', '46'=>'1384', '47'=>'1380', '48'=>'1386', '49'=>'1162', '50'=>'1166', '51'=>'1167', '52'=>'1168', '53'=>'1226', '54'=>'1342', '55'=>'1344', '56'=>'1345', '57'=>'1346', '58'=>'1453', '59'=>'1454', '60'=>'1456', '61'=>'1455', '62'=>'1284', '63'=>'1295', '64'=>'1287', '65'=>'1102', '66'=>'1105', '67'=>'1163', '68'=>'1100', '69'=>'1103', '70'=>'1104', '71'=>'1107', '72'=>'1294', '73'=>'1423', '74'=>'1426', '75'=>'1430', '76'=>'1434', '77'=>'1438', '78'=>'1222', '79'=>'1360', '80'=>'1361', '81'=>'1362', '82'=>'1363', '83'=>'1372', '84'=>'1375', '85'=>'1523', '86'=>'1524', '87'=>'1351', '88'=>'1353', '89'=>'1354', '90'=>'1355', '91'=>'1356', '92'=>'1357', '93'=>'1462', '94'=>'1463', '95'=>'1464', '96'=>'1465', '97'=>'1125', '98'=>'1378', '99'=>'1383', '100'=>'1377', '101'=>'1349', '102'=>'1352', '103'=>'1358', '104'=>'1457', '105'=>'1458', '106'=>'1459', '107'=>'1460', '108'=>'1461', '109'=>'1359', '110'=>'1364', '111'=>'1365', '112'=>'1370', '113'=>'1519', '114'=>'1520', '115'=>'1521', '116'=>'1522', '117'=>'1366', '118'=>'1367', '119'=>'1368', '120'=>'1369', '121'=>'1515', '122'=>'1516', '123'=>'1517', '124'=>'1518', '125'=>'1371', '126'=>'1373', '127'=>'1374', '128'=>'1376', '129'=>'1525', '130'=>'1526', '131'=>'1527', '132'=>'1546', '133'=>'1547', '134'=>'1548', '135'=>'1549', '136'=>'1550', '137'=>'1551', '138'=>'1552', '139'=>'1553', '140'=>'1554', '141'=>'1555', '142'=>'1556', '143'=>'1557', '144'=>'1558', '145'=>'1559', '146'=>'1560', '147'=>'1561', '148'=>'1562', '149'=>'1597', '150'=>'1598', '151'=>'1599', '152'=>'1600', '153'=>'1601', '154'=>'1602', '155'=>'1603', '156'=>'1642', '157'=>'1641', '158'=>'1675');

	$states = array('1'=>'Ahmedabad', '2'=>'Surat', '3'=>'Baroda', '4'=>'Gwalior', '5'=>'Vidisha', '6'=>'Hoshangabad', '7'=>'Itarsi', '8'=>'Shimla', '9'=>'Chandigarh', '10'=>'Mandi', '11'=>'Patiala', '12'=>'Baddi', '13'=>'Mohali', '14'=>'Trivandrum', '15'=>'Kochi', '16'=>'Thrissur', '17'=>'Coimbatore', '18'=>'Erode', '19'=>'Ooty', '20'=>'Salem', '21'=>'Namakkal', '22'=>'Udumalpet', '23'=>'Rishikesh', '24'=>'Haridwar', '25'=>'KOLKATA', '26'=>'Jamshedpur', '27'=>'Siliguri', '28'=>'Cuttack', '29'=>'Bhubaneshwar', '30'=>'Indore', '31'=>'Bhopal', '32'=>'Ujjain', '33'=>'Dewas', '34'=>'Ratlam', '35'=>'Mandsour', '36'=>'Neemuch', '37'=>'Jabalpur', '38'=>'Katni', '39'=>'Satna', '40'=>'Rewa', '41'=>'Singrauli', '42'=>'Ajmer', '43'=>'Alwar', '44'=>'Banswara', '45'=>'Beawar', '46'=>'Bhilwara', '47'=>'Bikaner', '48'=>'Ganganagar', '49'=>'Kanpur', '50'=>'Jhansi', '51'=>'Lucknow', '52'=>'Meerut', '53'=>'Agra', '54'=>'Madurai', '55'=>'Tirunelveli', '56'=>'Nagercoil', '57'=>'Tuticorin', '58'=>'Rajapalayam', '59'=>'Sivakasi', '60'=>'Palani', '61'=>'Ramanathapuram', '62'=>'Nagpur', '63'=>'Nasik', '64'=>'Goa', '65'=>'Bathinda', '66'=>'Ropar', '67'=>'Ludhiana', '68'=>'Jalandhar', '69'=>'jammu', '70'=>'Pathankot', '71'=>'Amritsar', '72'=>'Raipur', '73'=>'Rajnandgaon', '74'=>'Bilaspur', '75'=>'Durg', '76'=>'Raigarh', '77'=>'Korba', '78'=>'Rajkot', '79'=>'Ongole', '80'=>'Nellore', '81'=>'Tirupathi', '82'=>'Khammam', '83'=>'Kurnool', '84'=>'Ananthpur', '85'=>'Chittor', '86'=>'Kothagudem', '87'=>'Trichy', '88'=>'Thanjavur', '89'=>'Dindigul', '90'=>'Karur', '91'=>'Kumbakonam', '92'=>'Pudukottai', '93'=>'Tanjore', '94'=>'Karaikudi', '95'=>'Pattukottai', '96'=>'Mayiladuthurai', '97'=>'Jaipur', '98'=>'Jodhpur', '99'=>'Pali', '100'=>'Udaipur', '101'=>'Vellore', '102'=>'Pondicherry', '103'=>'Karaikkal', '104'=>'Kanchipuram', '105'=>'Krishnagiri', '106'=>'Vaniyambadi', '107'=>'Panruti', '108'=>'Tiruvannamalai', '109'=>'Guntur', '110'=>'Eluru', '111'=>'Vijaywada', '112'=>'Bhimavaram', '113'=>'Tenali', '114'=>'Machilipatnam', '115'=>'Tanuku', '116'=>'Palacollu', '117'=>'Rajahmundry', '118'=>'Srikakulam', '119'=>'Vizianagaram', '120'=>'Kakinada', '121'=>' Vizag', '122'=>'Anakapalli', '123'=>'Pitapuram', '124'=>'Tuni', '125'=>'Warangal', '126'=>'Nizamabad', '127'=>'Karimnagar', '128'=>'Ramagundam', '129'=>'Mahaboob Nagar', '130'=>'Armoor', '131'=>'Kodad', '132'=>'Aurangabad', '133'=>'Kolhapur', '134'=>'Ahmednagar', '135'=>'Sholapur', '136'=>'Nanded', '137'=>'Latur', '138'=>'Prabhani', '139'=>'Satara', '140'=>'Chandrapur', '141'=>'Ratnagiri', '142'=>'Sangli', '143'=>'Jalna', '144'=>'Amravati', '145'=>'Beed', '146'=>'Nandurbar', '147'=>'Wardha', '148'=>'Akot', '149'=>'Varanasi', '150'=>'Deoria', '151'=>'Gorakhpur', '152'=>'Jaunpur', '153'=>'Lakhimpur Khiri', '154'=>'Faizabad', '155'=>'Gonda', '156'=>'Bhavnagar', '157'=>'Mehsana', '158'=>'Karnal');

	$to_emails = array('1'=>'tajinder.bagga@fullertonindia.com', '2'=>'akash.mehta@fullertonindia.com', '3'=>'pinkesh.patel@fullertonindia.com, praful.bakre@fullertonindia.com', '4'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '5'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '6'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '7'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '8'=>'avneet.thakur@fullertonindia.com', '9'=>'sarvjeet.saini@fullertonindia.com', '10'=>'pankaj.kumarsharma@fullertonindia.com', '11'=>'girish.chhabra@fullertonindia.com', '12'=>'ameen.kumar@fullertonindia.com', '13'=>'anuj.khurana@fullertonindia.com', '14'=>'rajesh.vs@fullertonindia.com', '15'=>'sajeeshkumar.b@fullertonindia.com', '16'=>'prajith.ts@fullertonindia.com', '17'=>'venkatesh.jayabalan@fullertonindia.com', '18'=>'r.venkatesh@fullertonindia.com', '19'=>'amarnath.s@fullertonindia.com', '20'=>'manikandan.s@fullertonindia.com', '21'=>'venkatanarayanan.k@fullertonindia.com', '22'=>'balbir.singh@deal4loans.com', '23'=>'suraj.bhandari@fullertonindia.com', '24'=>'deepak.kaushik@fullertonindia.com', '25'=>'ratul.dasgupta@fullertonindia.com,nirnimesh.maity@fullertonindia.com', '26'=>'dilip.singh@fullertonindia.com', '27'=>'soumen.ghosh@fullertonindia.com', '28'=>'swarup.behera@fullertonindia.com', '29'=>'sanjeev.barik@fullertonindia.com', '30'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '31'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '32'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '33'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '34'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '35'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '36'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '37'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '38'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '39'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '40'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '41'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '42'=>'sandeep.khandelwal@fullertonindia.com', '43'=>'yatin.malik@fullertonindia.com', '44'=>'balbir.singh@deal4loans.com', '45'=>'harish.soni@fullertonindia.com', '46'=>'gaurav.jasra@fullertonindia.com', '47'=>'durgesh.nandanpurohit@fullertonindia.com', '48'=>'', '49'=>'rajeev.kumarmishra@fullertonindia.com', '50'=>'kapil.khatter@fullertonindia.com', '51'=>'mridul.misra@fullertonindia.com', '52'=>'amit.agarwal@fullertonindia.com', '53'=>'om.yadav@fullertonindia.com', '54'=>'chellapandian.g@fullertonindia.com', '55'=>'jebasubash.r@fullertonindia.com', '56'=>'mahimairajan.m@fullertonindia.com', '57'=>'s.babu@fullertonindia.com', '58'=>'kaliraj.j@fullertonindia.com', '59'=>'ranjith.m@fullertonindia.com', '60'=>'gopalan.s@fullertonindia.com', '61'=>'r.balaji@fullertonindia.com', '62'=>'deepak.dhone@fullertonindia.com, pankaj.jawanjal@fullertonindia.com', '63'=>'sameer.sampat@fullertonindia.com, rajesh.shriwal@fullertonindia.com', '64'=>'tushar.unde@fullertonindia.com', '65'=>'parvinder.sohal@fullertonindia.com', '66'=>'vikram.singh@fullertonindia.com', '67'=>'gupta.ankur@fullertonindia.com', '68'=>'vineshwar.gupta@fullertonindia.com', '69'=>'ramesh.kajal@fullertonindia.com', '70'=>'kumar.s@fullertonindia.com', '71'=>'kailashchander.bansal@fullertonindia.com', '72'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '73'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '74'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '75'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '76'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '77'=>'intellect.dinesh.kushwah@fullertonindia.com,intellect.ritu.sharma@fullertonindia.com', '78'=>'nirav.buch@fullertonindia.com', '79'=>'venkatakrishna.guduru@fullertonindia.com ', '80'=>'pratap.sada@fullertonindia.com', '81'=>'nileshkumar.singh@fullertonindia.com', '82'=>'avinashreddy.juka@fullertonindia.com ', '83'=>'r.ramnath@fullertonindia.com ', '84'=>'venkatarajanikumar.vemuri@fullertonindia.com ', '85'=>'kishorekumar.chelley@fullertonindia.com ', '86'=>'srinivasarao.t@fullertonindia.com ', '87'=>'magesh.s@fullertonindia.com', '88'=>'kumaresan.c@fullertonindia.com', '89'=>'senthilkumar.ss@fullertonindia.com', '90'=>'alex.m@fullertonindia.com', '91'=>'bharathi.s@fullertonindia.com', '92'=>'anandr.v@fullertonindia.com', '93'=>'kumaresan.c@fullertonindia.com', '94'=>'m.satheesh@fullertonindia.com', '95'=>'balbir.singh@deal4loans.com', '96'=>'balbir.singh@deal4loans.com', '97'=>'manish.revani@fullertonindia.com', '98'=>'himanshu.maru@fullertonindia.com', '99'=>'balbir.singh@deal4loans.com', '100'=>'khan.imran@fullertonindia.com', '101'=>'araja.zamseer@fullertonindia.com', '102'=>'ulaganathan.sp@fullertonindia.com', '103'=>'srinivasan.s@fullertonindia.com', '104'=>'gururaja.n@fullertonindia.com', '105'=>'sachidhanandam.r@fullertonindia.com', '106'=>'sivaramakrishnan.n@fullertonindia.com', '107'=>'sivaraj.t@fullertonindia.com', '108'=>'venkatesan.v1@fullertonindia.com', '109'=>'miriyala.jagadeeshrao@fullertonindia.com ', '110'=>'durgaprakash.bangaru@fullertonindia.com', '111'=>'abdulnayeem.ansari@fullertonindia.com', '112'=>'venkata.pulipati@fullertonindia.com ', '113'=>'arunkumar.tatikonda@fullertonindia.com ', '114'=>'balbir.singh@deal4loans.com', '115'=>'ravikumar.avala@fullertonindia.com', '116'=>'poornavenkatapraveen.alavala@fullertonindia.com ', '117'=>'balbir.singh@deal4loans.com', '118'=>'suryanarayana.murthy@fullertonindia.com ', '119'=>'satya.kishore.t@fullertonindia.com ', '120'=>'mohankumar.senapathi@fullertonindia.com ', '121'=>'mohankumar.senapathi@fullertonindia.com', '122'=>'ramesh.gundu@fullertonindia.com ', '123'=>'prabhukumar.gudavalli@fullertonindia.com ', '124'=>'suresh.gannamani@fullertonindia.com ', '125'=>'vishnuvardhanreddy.banda@fullertonindia.com ', '126'=>'narender.mara@fullertonindia.com ', '127'=>'vsanilkumar.achanti@fullertonindia.com ', '128'=>'kranti.jakkula@fullertonindia.com ', '129'=>'subramanyam.gattupally@fullertonindia.com ', '130'=>'raghavendrarao.madala@fullertonindia.com ', '131'=>'guruprasadrao.gottuveedu@fullertonindia.com ', '132'=>'inderjeetsingh.saggu@fullertonindia.com', '133'=>'harshal.mhaisalkar@fullertonindia.com', '134'=>'patrick.mendonza@fullertonindia.com', '135'=>'sunil.kolhe@fullertonindia.com', '136'=>'K.Imran@fullertonindia.com', '137'=>'manoj.munjewar@fullertonindia.com', '138'=>'balbir.singh@deal4loans.com', '139'=>'dhaval.patil@fullertonindia.com', '140'=>'dhananjay.lambore@fullertonindia.com', '141'=>'sandeep.thoke@fullertonindia.com', '142'=>'prashat.giryalkar@fullertonindia.com', '143'=>'nitin.tiwari@fullertonindia.com', '144'=>'pratik.ambadkar@fullertonindia.com', '145'=>'sandeep.faye@fullertonindia.com', '146'=>'sachin.bhaskar@fullertonindia.com', '147'=>'deepak.dhone@fullertonindia.com', '148'=>'pratik.ambadkar@fullertonindia.com', '149'=>'pawankumar.singh@fullertonindia.com', '150'=>'rahul.s@fullertonindia.com', '151'=>'vinod.tiwari@fullertonindia.com', '152'=>'ashwani.gupta@fullertonindia.com', '153'=>'gaurav.jain2@fullertonindia.com', '154'=>'adnan.kidwai@fullertonindia.com', '155'=>'rohit.srivastava@fullertonindia.com', '156'=>'manojkumar.jha@fullertonindia.com', '157'=>'alpesh.raval@fullertonindia.com', '158'=>'sandeep.aggarwal@fullertonindia.com');

$cc_emails = array('1'=>'tejal.panicker@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com', '2'=>'mayank.gandhi@fullertonindia.com, vivek.vishwakarma@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '3'=>'artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com', '4'=>'chauhan.ajay@fullertonindia.com', '5'=>'chauhan.ajay@fullertonindia.com', '6'=>'chauhan.ajay@fullertonindia.com', '7'=>'chauhan.ajay@fullertonindia.com', '8'=>'sudeep.gupta@fullertonindia.com', '9'=>'sudeep.gupta@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com', '10'=>'sudeep.gupta@fullertonindia.com', '11'=>'sudeep.gupta@fullertonindia.com', '12'=>'sudeep.gupta@fullertonindia.com', '13'=>'sudeep.gupta@fullertonindia.com', '14'=>'thirugnanasambandam.m@fullertonindia.com', '15'=>'thirugnanasambandam.m@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com', '16'=>'thirugnanasambandam.m@fullertonindia.com', '17'=>'thirugnanasambandam.m@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com', '18'=>'thirugnanasambandam.m@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com', '19'=>'thirugnanasambandam.m@fullertonindia.com', '20'=>'thirugnanasambandam.m@fullertonindia.com', '21'=>'thirugnanasambandam.m@fullertonindia.com', '22'=>'thirugnanasambandam.m@fullertonindia.com', '23'=>'rajiv.singh@fullertonindia.com', '24'=>'rajiv.singh@fullertonindia.com', '25'=>'vikrant.kumar@fullertonindia.com, mihir.chakraborty@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com', '26'=>'priyabrata.samal@fullertonindia.com', '27'=>'priyabrata.samal@fullertonindia.com', '28'=>'priyabrata.samal@fullertonindia.com', '29'=>'priyabrata.samal@fullertonindia.com', '30'=>'deepak.chanpuria@fullertonindia.com', '31'=>'deepak.chanpuria@fullertonindia.com', '32'=>'deepak.chanpuria@fullertonindia.com', '33'=>'deepak.chanpuria@fullertonindia.com', '34'=>'deepak.chanpuria@fullertonindia.com', '35'=>'deepak.chanpuria@fullertonindia.com', '36'=>'deepak.chanpuria@fullertonindia.com', '37'=>'mahua.dutta@fullertonindia.com', '38'=>'mahua.dutta@fullertonindia.com', '39'=>'mahua.dutta@fullertonindia.com', '40'=>'mahua.dutta@fullertonindia.com', '41'=>'mahua.dutta@fullertonindia.com', '42'=>'amit.sindwani@fullertonindia.com, artemishr.sitaram.sharma@fullertonindia.com', '43'=>'amit.sindwani@fullertonindia.com, artemishr.sitaram.sharma@fullertonindia.com', '44'=>'ajeet.sharm@fullertonindia.com, artemishr.sitaram.sharma@fullertonindia.com', '45'=>'ajeet.sharm@fullertonindia.com, artemishr.sitaram.sharma@fullertonindia.com', '46'=>'ajeet.sharm@fullertonindia.com, artemishr.sitaram.sharma@fullertonindia.com', '47'=>'pushpendra.mehru@fullertonindia.com, artemishr.sitaram.sharma@fullertonindia.com', '48'=>'pushpendra.mehru@fullertonindia.com, artemishr.sitaram.sharma@fullertonindia.com', '49'=>'sidhartha.tyagi@fullertonindia.com', '50'=>'sidhartha.tyagi@fullertonindia.com', '51'=>'sidhartha.tyagi@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com', '52'=>'sidhartha.tyagi@fullertonindia.com', '53'=>'sidhartha.tyagi@fullertonindia.com', '54'=>'thangaraju.kalidasan@fullertonindia.com', '55'=>'thangaraju.kalidasan@fullertonindia.com', '56'=>'thangaraju.kalidasan@fullertonindia.com', '57'=>'thangaraju.kalidasan@fullertonindia.com', '58'=>'thangaraju.kalidasan@fullertonindia.com', '59'=>'thangaraju.kalidasan@fullertonindia.com', '60'=>'thangaraju.kalidasan@fullertonindia.com', '61'=>'thangaraju.kalidasan@fullertonindia.com', '62'=>'deepak.dhone@fullertonindia.com, pankaj.jawanjal@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com', '63'=>'artemis.subodh.jaiswal@fullertonindia.com', '64'=>'artemis.subodh.jaiswal@fullertonindia.com', '65'=>'tarun.raina@fullertonindia.com', '66'=>'tarun.raina@fullertonindia.com', '67'=>'tarun.raina@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com', '68'=>'kabir.verma@fullertonindia.com', '69'=>'kabir.verma@fullertonindia.com', '70'=>'kabir.verma@fullertonindia.com', '71'=>'kabir.verma@fullertonindia.com', '72'=>'thomas.varghese@fullertonindia.com', '73'=>'thomas.varghese@fullertonindia.com', '74'=>'thomas.varghese@fullertonindia.com', '75'=>'thomas.varghese@fullertonindia.com', '76'=>'thomas.varghese@fullertonindia.com', '77'=>'thomas.varghese@fullertonindia.com', '78'=>'mehul.shah@fullertonindia.com', '79'=>'stalin.mandhadapu@fullertonindia.com', '80'=>'stalin.mandhadapu@fullertonindia.com', '81'=>'stalin.mandhadapu@fullertonindia.com', '82'=>'stalin.mandhadapu@fullertonindia.com', '83'=>'stalin.mandhadapu@fullertonindia.com', '84'=>'stalin.mandhadapu@fullertonindia.com', '85'=>'stalin.mandhadapu@fullertonindia.com', '86'=>'stalin.mandhadapu@fullertonindia.com', '87'=>'shankar.p@fullertonindia.com', '88'=>'shankar.p@fullertonindia.com', '89'=>'shankar.p@fullertonindia.com', '90'=>'shankar.p@fullertonindia.com', '91'=>'shankar.p@fullertonindia.com', '92'=>'shankar.p@fullertonindia.com', '93'=>'shankar.p@fullertonindia.com', '94'=>'shankar.p@fullertonindia.com', '95'=>'shankar.p@fullertonindia.com', '96'=>'shankar.p@fullertonindia.com', '97'=>'manish.revani@fullertonindia.com, artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.comartemishr.sitaram.sharma@fullertonindia.com', '98'=>'pushpendra.mehru@fullertonindia.com, artemishr.sitaram.sharma@fullertonindia.com', '99'=>'pushpendra.mehru@fullertonindia.com, artemishr.sitaram.sharma@fullertonindia.com', '100'=>'ajeet.sharm@fullertonindia.com, artemishr.sitaram.sharma@fullertonindia.com', '101'=>'ebenezerdaniel.g@fullertonindia.com', '102'=>'ebenezerdaniel.g@fullertonindia.com', '103'=>'ebenezerdaniel.g@fullertonindia.com', '104'=>'ebenezerdaniel.g@fullertonindia.com', '105'=>'ebenezerdaniel.g@fullertonindia.com', '106'=>'ebenezerdaniel.g@fullertonindia.com', '107'=>'ebenezerdaniel.g@fullertonindia.com', '108'=>'ebenezerdaniel.g@fullertonindia.com', '109'=>'n.pardhasaradhi@fullertonindia.com', '110'=>'n.pardhasaradhi@fullertonindia.com', '111'=>'n.pardhasaradhi@fullertonindia.com', '112'=>'n.pardhasaradhi@fullertonindia.com', '113'=>'n.pardhasaradhi@fullertonindia.com', '114'=>'n.pardhasaradhi@fullertonindia.com', '115'=>'n.pardhasaradhi@fullertonindia.com', '116'=>'n.pardhasaradhi@fullertonindia.com', '117'=>'subramanyam.kvs@fullertonindia.com', '118'=>'subramanyam.kvs@fullertonindia.com', '119'=>'subramanyam.kvs@fullertonindia.com', '120'=>'subramanyam.kvs@fullertonindia.com', '121'=>'subramanyam.kvs@fullertonindia.com', '122'=>'subramanyam.kvs@fullertonindia.com', '123'=>'subramanyam.kvs@fullertonindia.com', '124'=>'subramanyam.kvs@fullertonindia.com', '125'=>'chandrasekhar.sunnapu@fullertonindia.com', '126'=>'chandrasekhar.sunnapu@fullertonindia.com', '127'=>'chandrasekhar.sunnapu@fullertonindia.com', '128'=>'chandrasekhar.sunnapu@fullertonindia.com', '129'=>'chandrasekhar.sunnapu@fullertonindia.com', '130'=>'chandrasekhar.sunnapu@fullertonindia.com', '131'=>'chandrasekhar.sunnapu@fullertonindia.com', '132'=>'', '133'=>'', '134'=>'', '135'=>'', '136'=>'', '137'=>'', '138'=>'', '139'=>'', '140'=>'', '141'=>'', '142'=>'', '143'=>'', '144'=>'', '145'=>'', '146'=>'', '147'=>'', '148'=>'', '149'=>'shailendra.swaroop@fullertonindia.com', '150'=>'shailendra.swaroop@fullertonindia.com', '151'=>'shailendra.swaroop@fullertonindia.com', '152'=>'shailendra.swaroop@fullertonindia.com', '153'=>'shailendra.swaroop@fullertonindia.com', '154'=>'shailendra.swaroop@fullertonindia.com', '155'=>'shailendra.swaroop@fullertonindia.com', '156'=>'tejal.panicker@fullertonindia.com', '157'=>'tejal.panicker@fullertonindia.com', '158'=>'artemis.subodh.jaiswal@fullertonindia.com, artemis.mohdtahseen.assad@fullertonindia.com');

$Today = date("Y-m-d"); 
$min_date=$Today." 00:00:00";
$max_date=$Today." 23:59:59";
	
$session_id="";

for($j=1;$j<=158;$j++)
{
	$session_id="";
	$session_id=session_id();
	//session_regenerate_id();
	$session_id=session_id();

	$search_qry="";

	$search_qry="SELECT * FROM Req_Feedback_Bidder1,Req_Loan_Personal LEFT OUTER JOIN Req_Feedback ON 		Req_Feedback.AllRequestID=Req_Loan_Personal.RequestID AND Req_Feedback.BidderID in (".$titles[$j].") WHERE Req_Feedback_Bidder1.AllRequestID=Req_Loan_Personal.RequestID and Req_Feedback_Bidder1.BidderID in (".$titles[$j].") and Req_Feedback_Bidder1.Reply_Type='1' and (Req_Feedback_Bidder1.Allocation_Date  Between '".($min_date)."' and '".($max_date)."' ) ";	

	$newfileatt = "";
	$row_result = "";
	list($recordcount,$row_result)=MainselectfuncNew($citifinquery,$array = array());
 	for($i=0;$i<$recordcount;$i++)
	{
		if($row_result[$i]["Employment_Status"]==0) { $emp_status="Self Employed"; } else { $emp_status="Salaried"; }
		if($row_result[$i]["Marital_Status"]==1) { $marital_status="Single"; } else { $marital_status="Married"; }
		if($row_result[$i]["Residential_Status"]==1) { $residential_status="Owned"; }  if($row_result[$i]["Residential_Status"]==2) { $residential_status="Rented"; } if($row_result[$i]["Residential_Status"]==3) { $residential_status="Company Provided"; }
		if($row_result[$i]["Vehicles_Owned"]==0) { $vehicle_owned="2 Wheeler"; } if($row_result[$i]["Vehicles_Owned"]==1) { $vehicle_owned="4 Wheeler"; } if($row_result[$i]["Vehicles_Owned"]==2) { $vehicle_owned="Other"; }
		if($row_result[$i]["CC_Holder"]==1) { $cc_holder="Yes"; }  if($row_result[$i]["CC_Holder"]==0) { $cc_holder="No"; }

		
		if($row_result[$i]["EMI_Paid"]==1){ $emi_paid="Less than 6 months";}
		elseif($row_result[$i]["EMI_Paid"]==2) {  $emi_paid="6 to 9 months"; }
		elseif($row_result[$i]["EMI_Paid"]==3){  $emi_paid="9 to 12 months"; }
		elseif($row_result[$i]["EMI_Paid"]==4){  $emi_paid="more than 12 months"; }
		else
		{ 
			$emi_paid="";
		}
		if($row_result[$i]["Card_Vintage"]==1)	{	$card_vintage="Less than 6 months";}
		elseif($row_result[$i]["Card_Vintage"]==2)	{	$card_vintage="6 to 9 months";}
	elseif($row_result[$i]["Card_Vintage"]==3)	{	$card_vintage="9 to 12 months";}
	elseif($row_result[$i]["Card_Vintage"]==4)		{	$card_vintage="more than 12 months";}
	else
		{
			$card_vintage="";
		}

		//$Dateofallocation = $row_result[$i]["Allocation_Date"];
		
		if($row_result[$i]["Allocation_Date"] > "2007-10-19 00:00:00")
		{
			$Dateofallocation = $row_result[$i]["Allocation_Date"];
		}
		else 
		{
			$Dateofallocation = $row_result[$i]["Dated"];
		}
		//echo $Dateofallocation;
		//exit();

		$dob_loan=$row_result[$i]["dob"];
		if(strlen($dob_loan)>0)
		{
			$dob=$dob_loan;} else { $dob=$row_result[$i]["DOB"];}
			
			
			$dataInsert = array('session_id'=>$session_id, 'name'=>$row_result[$i]['Name'], 'dob'=>$dob, 'email'=>$row_result[$i]['Email'], 'emp_status'=>$emp_status, 'c_name'=>$row_result[$i]['Company_Name'], 'city'=>$row_result[$i]['City'], 'city_other'=>$row_result[$i]['City_Other'], 'year_in_comp'=>$row_result[$i]['Years_In_Company'], 'total_exp'=>$row_result[$i]['Total_Experience'], 'mobile_number'=>$row_result[$i]['Mobile_Number'], 'std_code'=>$row_result[$i]['Std_Code'], 'landline'=>$row_result[$i]['Landline'], 'std_code_o'=>$row_result[$i]['Std_Code_O'], 'landline_o'=>$row_result[$i]['Landline_O'], 'net_salary'=>$row_result[$i]['Net_Salary'], 'marital_status'=>$marital_status, 'residential_status'=>$residential_status, 'vehicle_owned'=>$vehicle_owned, 'loan_any'=>$row_result[$i]['Loan_Any'], 'emi_paid'=>$row_result[$i]['emi_paid'], 'cc_holder'=>$row_result[$i]['cc_holder'], 'loan_amount'=>$row_result[$i]['Loan_Amount'], 'Feedback'=>$row_result[$i]['Feedback'], 'count_views'=>$row_result[$i]['Count_Views'], 'count_replies'=>$row_result[$i]['Count_Replies'], 'is_modified'=>$row_result[$i]['IsModified'], 'is_processed'=>$row_result[$i]['PL_EMI_Amt'], 'pincode'=>$row_result[$i]['Pincode'], 'doe'=>$Dateofallocation, 'card_vintage'=>$card_vintage, 'card_limit'=>$row_result[$i]['Card_Limit'], 'ip_address'=>$row_result[$i]['IP_Address'], 'add_comment'=>$row_result[$i]['comment_section'], 'Documents'=>$row_result[$i]['identification_proof']);
				$table = 'temp';
		$insert = Maininsertfunc ($table, $dataInsert);
	}
	
	$qry="select name, email, mobile_number, emp_status, c_name, city, city_other, net_salary, loan_amount, add_comment, doe   from temp where session_id='".$session_id."' order by doe DESC ";
	//echo "<br>".$qry."<br>";
	$newfileatt = "";		
	$header="";
	$newdata="";
	list($num_rows,$myrow)=MainselectfuncNew($qry,$array = array());
	 $field_names = getFieldNames($qry);
	for ($i = 0; $i <count($field_names); $i++){
		$header .= $field_names[$i]."\t";
	}
	
	for($dnld=0;$dnld<count($myrow);$dnld++)
	{
		$myrowarr=$myrow[$dnld];
		
		  $line = '';
		  foreach($myrowarr as $value){
		if(!isset($value) || $value == ""){
		  $value = '"' . $value . '"' . "\t";
		}else{
	# important to escape any quotes to preserve them in the data.
		  $value = str_replace('"', '""', $value);
	# needed to encapsulate data in quotes because some data might be multi line.
	# the good news is that numbers remain numbers in Excel even though quoted.
		  $value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	  }
	  $newdata .= trim($line)."\n";
	}
	# this line is needed because returns embedded in the data have "\r"
	# and this looks like a "box character" in Excel
	$retnewdata = str_replace("\r", "", $header);
	$retnewdata .="\n"; 
	$retnewdata .= str_replace("\r", "", $newdata);
 

	$newToday = date('d')."".date('m')."".date('y')."".date('s');
	// Open the file and erase the contents if any
	$newfileatt = "fullerton/ful".$newToday."(".$states[$j].").xls";
//	echo "fine".$newfileatt."<br>";
	$newfile = fopen( $newfileatt, 'w+' ); 
	$dataold=fwrite($newfile, $retnewdata);
	fclose( $newfile );
//$recordcount = 1;

	if($recordcount>0)
	{
		$emailid = "";
		$emailid_cc = "";
		echo "<br>";
		echo $titles[$j];
		echo "<br>";
		//	echo "<br>jjjj ".$recordcount."  ghghg<br>";
		$emailid = $to_emails[$j];
		$emailid_cc = $cc_emails[$j];
		
	//	$emailid_cc = "";
		sendexcelfileattachment( $emailid,$session_id,$states[$j],$emailid_cc);
		$lastCount = $j;
	}
	$recordcount=0;
	
}

function sendexcelfileattachment($emailid,$session_id,$fullecity, $emailid_cc)
	{
		$newToday = date('d')."".date('m')."".date('y')."".date('s');
	//echo $emailid."<br>";
//	$to = $emailid; 
	//$cc = $emailid_cc;
		$cc = ""; 
		$to = "balbirsingh499@gmail.com";
		echo "City: ".$fullecity;
		echo "<br>";
		echo "To: ".$to;
		echo "<br>";
		echo "Cc: ".$cc;
		echo "<br>";
		echo "--------------------------------------------------------------------------------";
		echo "<br>";
    
	   $from = "Deal4loans <no-reply@deal4loans.com>"; 
       $subject = "Deal4loans (MA002) Leads Allocated on ".$newToday." in ".$fullecity.""; 
 //   $subject = "test ".$newToday."(".$fullecity.")"; 
       
	   $fileatt = "fullerton/ful".$newToday."(".$fullecity.").xls";
        $fileatttype = "application/xls"; 
        $fileattname = "ful".$newToday."(".$fullecity.").xls";
   
        
       $file = fopen( $fileatt, 'r+' ); 
        $data = fread( $file, filesize( $fileatt ) ); 
        fclose( $file );
		
		$headers = "From: $from";
		
		
		 $semi_rand = md5( time() ); 
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
   
        $headers .= "\nMIME-Version: 1.0\n" . 
                    "Content-Type: multipart/mixed;\n" . 
                    " boundary=\"{$mime_boundary}\""."\n";
if(strlen($cc)>0)
{
	$headers .= "Cc:".$cc.""."\n";
}
	
    
        $message = "This is a multi-part message in MIME format.\n\n" . 
                "--{$mime_boundary}\n" . 
                "Content-Type: text/plain; charset=\"iso-8859-1\"\n" . 
                "Content-Transfer-Encoding: 7bit\n\n" . 
                $message . "\n\n";
    
        $data = chunk_split( base64_encode( $data ) );
                 
        $message .= "--{$mime_boundary}\n" . 
                 "Content-Type: {$fileatttype};\n" . 
                 " name=\"{$fileattname}\"\n" . 
                 "Content-Disposition: attachment;\n" . 
                 " filename=\"{$fileattname}\"\n" . 
                 "Content-Transfer-Encoding: base64\n\n" . 
                 $data . "\n\n" . 
                 "--{$mime_boundary}--\n"; 
                 

     if( mail( $to, $subject, $message, $headers ) ) {
             echo "<p>The email was sent.".$fullecity."</p>";  
        }
        else { 
              echo "<p>There was an error sending the mail.".$fullecity."</p>"; 
         
        }

          $qry1="delete from `temp` where session_id='".$session_id."'";
	//	echo "<br>".$qry1;
		
	Maindeletefunc($qry1,$array = array());

    
    }
	

?>