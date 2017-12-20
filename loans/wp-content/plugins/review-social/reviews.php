<?php
$timezone = "Australia/Melbourne";
date_default_timezone_set($timezone);
session_start();
/* BASE_URL end without slash '/'  */
define("BASE_URL",'http://demo.vshakya.com/mmpl');
/* DATA_AJAXURL value must be in same format as given */
define('DATA_AJAXURL','&quot;http:||demo&quot;,&quot;vshakya&quot;,&quot;com|mmpl|review-social|reviews&quot;,&quot;php?action=vshcr3-ajax&quot;');

class db{			
	public $user='mmpl_usr';
	public $pass='mmpl#786';
	public $host='localhost';
	public $dbname='mmpl_db';
	public $dbh;
	public function connection(){
		try {
			$this->dbh = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass); 
			return $this->dbh;
		}
		catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}	
	}
}
$db = new db(); 
$conn = $db->connection();
function displayRating($rating){
	if($rating){
		return $rating . " Star";
	}
	else{
		return false;
	}
} 
function page_title($url) {
	$fp = file_get_contents($url);
	if (!$fp) 
		return null;

	$res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
	if (!$res) 
		return null; 

	// Clean up title: remove EOL's and excessive whitespace.
	$title = preg_replace('/\s+/', ' ', $title_matches[1]);
	$title = trim($title);
	return $title;
}

function insertReview($conn, $data){
	try {	
 		$page_url = $_SERVER['HTTP_REFERER'];
		//$page_url = 'http://' . $_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$sqlPgUrl = "SELECT id from wp_blaster_reviews_setting where page_url='".$page_url."'";
		$resultSetPgUrl = $conn->query($sqlPgUrl);
		if($resultSetPgUrl->rowCount()==0){
			$statement = $conn->prepare("INSERT INTO wp_blaster_reviews_setting(page_url, status)
			VALUES(:page_url, :status)");
			$statement->execute(array(
				"page_url" 	=> $page_url, 
				"status" 	=> 1
			));
			$page_id = $conn->lastInsertId();
		}
		else{
			if(is_array($resultSetPgUrl)|| is_object($resultSetPgUrl)){  
				foreach($resultSetPgUrl as $rowPgUrl) {
					$page_id = $rowPgUrl['id'];
				}
			}
		}
		 
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$statement = $conn->prepare("INSERT INTO wp_blaster_reviews(ip, page_id, name, email, title, rating, review, date, status)
			VALUES(:ip, :page_id, :name, :email, :title, :rating, :review, :date, :status)");
		$statement->execute(array(
			"ip" 		=> $ip,
			"page_id" 	=> $page_id,
			"name" 		=> $data["vshcr3_fname"],
			"email"		=> $data["vshcr3_femail"],
			"title"		=> $data["vshcr3_ftitle"],
			"rating"	=> $data["vshcr3_frating"],
			"review"	=> $data["vshcr3_ftext"],
			"date" 		=> date('Y-m-d'),
			"status" 	=> 0
		));
		$result = array('err'=>'',"success"=>true);
		
		echo '{"err":[],"success":true}';
	} 
	catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	return false;	
}
$action = ( array_key_exists( 'action', $_GET) ? $_GET['action'] : "" );
if($action=='vshcr3-ajax'){
	insertReview($conn, $_POST);
	exit;
}
function displayReviewList($conn){
	?>
<div class="vshcr3_dotline"></div>
<?php 
//$page_url_disp = $_SERVER['HTTP_REFERER'];
$page_url_disp = 'http://' . $_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$sqlPgUrlDisp = "SELECT id from wp_blaster_reviews_setting where page_url='".$page_url_disp."'";
$resultSetPgUrlDisp = $conn->query($sqlPgUrlDisp);
$page_id_disp = 0;
if($resultSetPgUrlDisp->rowCount()>0){	  
	if(is_array($resultSetPgUrlDisp)|| is_object($resultSetPgUrlDisp)){  
		foreach($resultSetPgUrlDisp as $rowPgUrlDisp) {
			$page_id_disp = $rowPgUrlDisp['id'];
		}
	}
}
$sql = "SELECT br.`id`, br.`ip`, br.`page_id`, br.`name`, br.`email`, br.`title`, br.`rating`, br.`review`, br.`date`, br.`status`, brs.`page_url` from wp_blaster_reviews as br LEFT JOIN wp_blaster_reviews_setting as brs ON br.page_id = brs.id  where br.status='1' and br.`page_id` = '".$page_id_disp."' order by br.id desc";		
$resultSet = $conn->query($sql);
//$tags = get_meta_tags($page_url_disp);
/* Please provide all Information from your current page */
$ProductName = page_title($page_url_disp);
$brand = 'Mywish Marketplaces';
$productID ='Mywish-Marketplaces';

 ?>
<div class="vshcr3_reviews_holder">
  <div class="vshcr3_review_item">
    <div class="vshcr3_item vshcr3_product" itemscope itemtype="http://schema.org/Product">
      <!--<div class="vshcr3_item_name"><a href="<?php //echo $page_url_disp_agrate;?>"><?php //echo $ProductName;?></a></div>-->
      <meta itemprop="name" content="<?php echo $ProductName;?>" />
      <meta itemprop="brand" content="<?php echo $brand;?>" />
      <meta itemprop="productID" content="<?php echo $productID;?>" />
      <?php
       $page_url_disp_agrate = 'http://' . $_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$sqlPgUrlAgrate = "SELECT id from wp_blaster_reviews_setting where page_url='".$page_url_disp_agrate."'";
		$resultSetPgUrlAgrate = $conn->query($sqlPgUrlAgrate);
		$page_id_agrate = 0;
		if($resultSetPgUrlAgrate->rowCount()>0){	  
			if(is_array($resultSetPgUrlAgrate)|| is_object($resultSetPgUrlAgrate)){  
				foreach($resultSetPgUrlAgrate as $rowPgUrlAgrate) {
					$page_id_agrate = $rowPgUrlAgrate['id'];
				}
			}
		}
	  	$resultSetAgrate = $conn->query("
			SELECT 
			COUNT(*) AS aggregate_count, AVG(r1.rating) AS aggregate_rating
			FROM wp_blaster_reviews  r1
			INNER JOIN  wp_blaster_reviews_setting pr ON pr.status = '1' AND pr.id = r1.page_id
			WHERE
			r1.page_id = '".$page_id_agrate."' AND r1.status = '1'
			GROUP BY r1.page_id"
		);
		
		if(is_array($resultSetAgrate)|| is_object($resultSetAgrate)){  
			foreach($resultSetAgrate as $rowAgrate) {
				 
			$aggregate_count = $rowAgrate['aggregate_count'];
			$aggregate_rating = $rowAgrate['aggregate_rating'];
			if ($aggregate_count == 0) { $aggregate_rating = 0; }
			$rating_width = 20 * $aggregate_rating;
			?>
      <div class="vshcr3_aggregateRating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
        <meta itemprop="bestRating" content="5" />
        <meta itemprop="worstRating" content="1" />
        <meta itemprop="ratingValue" content="<?php echo $aggregate_rating;?>" />
        <meta itemprop="reviewCount" content="<?php echo $aggregate_count;?>" />
        <span class="vshcr3_aggregateRating_overallText">Average rating:</span>&nbsp;
        <div class="vshcr3_aggregateRating_ratingValue">
          <div class="vshcr3_rating_style1_base">
            <div class="vshcr3_rating_style1_average" style="width:<?php echo $rating_width;?>%;"></div>
          </div>
        </div>
        &nbsp;<span class="vshcr3_aggregateRating_reviewCount"><?php echo $aggregate_count;?>reviews</span></div>
      <?php    
			}
		}?>
      <div class="vshcr3_dotline"></div>
      <?php     
    if(is_array($resultSet)|| is_object($resultSet)){   
        foreach($resultSet as $row) { ?>
      <div id="vshcr3_id_<?php echo $row['id']?>" class="vshcr3_review" itemprop="review" itemscope itemtype="http://schema.org/Review">
        <meta itemprop="author" content="springat water" />
        <div class="vshcr3_hide" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
          <meta itemprop="bestRating" content="5" />
          <meta itemprop="worstRating" content="1" />
          <meta itemprop="ratingValue" content="<?php echo $row['rating']?>" />
        </div>
        <div class="vshcr3_review_ratingValue">
          <div class="vshcr3_rating_style1">
            <div class="vshcr3_rating_style1_base ">
              <div class="vshcr3_rating_style1_average" style="width:<?php echo ($row['rating']*20)?>%;"></div>
            </div>
          </div>
        </div>
        <div class="vshcr3_review_datePublished" itemprop="datePublished"><?php echo $row['date']?></div>
        <div class="vshcr3_review_author">by<span class="vshcr3_caps">&nbsp;<?php echo $row['name']?></span><!--<span class="vshcr3_item_name"><a href="<?php //echo $page_url_disp_agrate;?>"><?php //echo $ProductName;?></a></span>--></div>
        <div class="vshcr3_clear"></div>
        <?php if( $row['title']){ ?>
        <div class="vshcr3_review_title vshcr3_caps"><?php echo $row['title']?></div>
        <?php } ?>
        <div class="vshcr3_clear"></div>
        <blockquote class="vshcr3_content" itemprop="reviewBody">
          <p><?php echo $row['review']?></p>
        </blockquote>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php 
		 
    }  
}

function displayReviewForm($conn){
	$page_url_disp = 'http://' . $_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$sqlPgUrlDisp = "SELECT id from wp_blaster_reviews_setting where page_url='".$page_url_disp."'";
	$resultSetPgUrlDisp = $conn->query($sqlPgUrlDisp);
	$page_id_disp = 0;
	if($resultSetPgUrlDisp->rowCount()>0){	  
		if(is_array($resultSetPgUrlDisp)|| is_object($resultSetPgUrlDisp)){  
			foreach($resultSetPgUrlDisp as $rowPgUrlDisp) {
				$page_id_disp = $rowPgUrlDisp['id'];
			}
		}
	}
	########################################################################
	#**** Get Socail Setting **********************************************#
	#########Facebook#############################Facebook###################		
	$facebook_client_id='';
	$facebook_redirect_uri='';
	$facebook_secret_key='';
	#########Facebook#############################Facebook###################
	$twitter_consumer_key='';
	$twitter_consumer_secret='';
	$twitter_oauth_callback= '';
 	#########Facebook#############################Facebook###################
	$google_client_id='';
	$google_redirect_uri='';
	$google_scope='';
	$resultSetApi = $conn->query("SELECT option_value from wp_options where option_name='vshcr3_social_setting'");
    if(is_array($resultSetApi)|| is_object($resultSetApi)){   
        foreach($resultSetApi as $rowApi) {
			$vshcr3_social_setting =  @unserialize($rowApi['option_value']);
			//echo "<pre>";print_r($vshcr3_social_setting);echo "</pre>";
			#########Facebook#############################Facebook###################		
			$facebook_client_id=$vshcr3_social_setting['facebook_app_id']; 
			$facebook_secret_key=$vshcr3_social_setting['facebook_secret_key']; 
			$facebook_redirect_uri='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			#########Facebook#############################Facebook###################
			$twitter_consumer_key=$vshcr3_social_setting['twitter_consumer_key']; 
			$twitter_consumer_secret=$vshcr3_social_setting['twitter_consumer_secret']; 
			$twitter_oauth_callback= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			#########Facebook#############################Facebook###################
			$google_client_id=$vshcr3_social_setting['google_client_id']; 
			$google_client_secret=$vshcr3_social_setting['google_client_secret']; 
			$google_redirect_uri='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			$google_scope='email+profile';
		}
	}
	$email = ( array_key_exists( 'email', $_GET) ? $_GET['email'] : "" );
	$name  = ( array_key_exists( 'name', $_GET) ? $_GET['name'] : "" );
	$vshcr3_fname 	=  	'vshakya';
	$vshcr3_femail 	= 	'info@vshakya';
	$vshcr3_ftitle 	=  	'vshakya';
	$vshcr3_ftext 	= 	'vshakya';
	?>
<div class="vshcr3_respond_1 vshcr3_in_content" data-ajaxurl="[<?php echo DATA_AJAXURL?>]" data-on-postid="<?php echo $page_id_disp;?>" data-postid="<?php echo $page_id_disp;?>">
  <form id="comments_submit_form" method="post" action=""  >
    <div class="vshcr3_respond_2">
      <div class="vshcr3_div_2">
        <table class="vshcr3_table_2">
          <tbody>
            <tr>
              <td colspan="2"><div class="vshcr3_leave_text">Submit your review</div></td>
            </tr>
            <tr class="vshcr3_review_form_text_field">
              <td><label for="vshcr3_fname" class="comment-field">Name:</label></td>
              <td><input maxlength="150" class="text-input vshcr3_required" type="text" id="vshcr3_fname" name="vshcr3_fname" value="<?php echo $vshcr3_fname;?>" /></td>
            </tr>
            <tr class="vshcr3_review_form_text_field">
              <td><label for="vshcr3_femail" class="comment-field">Email:</label></td>
              <td><input maxlength="150" class="text-input vshcr3_required" type="text" id="vshcr3_femail" name="vshcr3_femail" value="<?php echo $vshcr3_femail;?>" /></td>
            </tr>
            <tr class="vshcr3_review_form_text_field">
              <td><label for="vshcr3_ftitle" class="comment-field">Review Title:</label></td>
              <td><input maxlength="150" class="text-input " type="text" id="vshcr3_ftitle" name="vshcr3_ftitle" value="<?php echo $vshcr3_ftitle;?>" /></td>
            </tr>
            <tr class="vshcr3_review_form_rating_field">
              <td><label for="id_vshcr3_frating" class="comment-field">Rating:</label></td>
              <td><div class="vshcr3_rating_stars">
                  <div class="vshcr3_rating_style1">
                    <div class="vshcr3_rating_style1_status">
                      <div class="vshcr3_rating_style1_score">
                        <div class="vshcr3_rating_style1_score1">1</div>
                        <div class="vshcr3_rating_style1_score2">2</div>
                        <div class="vshcr3_rating_style1_score3">3</div>
                        <div class="vshcr3_rating_style1_score4">4</div>
                        <div class="vshcr3_rating_style1_score5">5</div>
                      </div>
                    </div>
                    <div class="vshcr3_rating_style1_base vshcr3_hide">
                      <div class="vshcr3_rating_style1_average" style="width:0%;"></div>
                    </div>
                  </div>
                </div>
                <input style="display:none;" type="hidden" class="vshcr3_required vshcr3_frating" id="id_vshcr3_frating" name="vshcr3_frating" /></td>
            </tr>
            <tr class="vshcr3_review_form_review_field_label">
              <td colspan="2"><label for="id_vshcr3_ftext" class="comment-field">Review:</label></td>
            </tr>
            <tr class="vshcr3_review_form_review_field_textarea">
              <td colspan="2"><textarea class="vshcr3_required vshcr3_ftext" id="id_vshcr3_ftext" name="vshcr3_ftext" rows="8" cols="50"><?php echo $vshcr3_ftext;?></textarea></td>
            </tr>
            <tr>
              <td colspan="2" class="vshcr3_check_confirm"><div class="vshcr3_clear"></div>
                <input type="hidden" name="vshcr3_postid" value="<?php echo $page_id_disp;?>" />
                <input type="text" class="vshcr3_fakehide vshcr3_fake_url" name="url" />
                <input type="checkbox" class="vshcr3_fakehide vshcr3_fconfirm1" name="vshcr3_fconfirm1" value="1" />
                <label>
                  <input type="checkbox" name="vshcr3_fconfirm2" class="vshcr3_fconfirm2" value="1" />
                  &nbsp; Check this box to confirm you are human.</label>
                <input type="checkbox" class="vshcr3_fakehide vshcr3_fconfirm3" name="vshcr3_fconfirm3" checked="checked" value="1" /></td>
            </tr>
            <tr>
              <td colspan="2"><div class="vshcr3_button_1 vshcr3_submit_btn" href="javascript:void(0);">Submit</div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="vshcr3_button_1 vshcr3_cancel_btn" href="javascript:void(0);">Cancel</div></td>
            </tr>
            <tr>
              <td colspan="2"><a id="authorize-button-facebook" style="display: none;" onClick="fb_login();" class="fb_button fb_button_medium vshcr3_button_1 vshcr3_twitter_btn">Facebook</a><a id="signout-button-facebook" style="display: none;" onClick="fb_logout();"  class="fb_button fb_button_medium vshcr3_button_1 vshcr3_twitter_btn">Facebook Sign Out</a><span id="fb-root"></span>
                <script type="text/javascript">
    var authorizeButtonFacebook = document.getElementById('authorize-button-facebook');
    var signoutButtonFacebook = document.getElementById('signout-button-facebook');
    
	window.fbAsyncInit = function() {
		FB.init({
			appId   : '<?php echo $facebook_client_id;?>',
			oauth   : true,
			status  : true, // check login status
			cookie  : true, // enable cookies to allow the server to access the session
			xfbml   : true // parse XFBML
		}); 
		authStatus();
		/**/
	};
	function authStatus(){
		FB.getLoginStatus(function(response) { 
			if (response && response.status === 'connected') {
				if (response.authResponse) { 
					access_token = response.authResponse.accessToken; 
					user_id = response.authResponse.userID;   
					FB.api('/me', function(response) {  
						jQuery.ajax({
							url: '<?php echo BASE_URL?>/wp-admin/admin-ajax.php?action=vshcr3-socailAjax&oauth_provider=FacebookOAuth',
							data : {'socialData':response},
							type: 'POST'
						});  
					}); 
				} 
					
				authorizeButtonFacebook.style.display = 'none';
				signoutButtonFacebook.style.display = 'inline-block';
			}
			else{
				 
				authorizeButtonFacebook.style.display = 'inline-block';
				signoutButtonFacebook.style.display = 'none';
			} 
		}, true);
	}
	function fb_login(){
		FB.login(function(response) {
	
			if (response.authResponse) { 
				access_token = response.authResponse.accessToken; 
				user_id = response.authResponse.userID;   
				FB.api('/me', function(response) {   
			  	    console.log(response); 
					document.location.reload();  
				}); 
			} 
			else {
				//user hit cancel button
				console.log('User cancelled login or did not fully authorize.');
	
			}
		}, {
			scope: 'email'
		});
	}
	function fb_logout() {
		
		FB.getLoginStatus(function(response) {
			if (response && response.status === 'connected') {
				FB.logout(function(response) {
					document.location.reload();
				});  
			}
		});
		
	}
	(function() {
		var e = document.createElement('script');
		e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
		e.async = true;
		document.getElementById('fb-root').appendChild(e);
	}());
	</script>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php 
    $connection = new TwitterOAuth($twitter_consumer_key, $twitter_consumer_secret);
    $request_token = $connection->getRequestToken($twitter_oauth_callback);  
    $_SESSION['token'] 	= $request_token['oauth_token']; 
    $_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
    //echo "token = ".$_SESSION['token']." | token_secret: ".$_SESSION['token_secret']; 
    if($connection->http_code == '200')
    { 
        $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']); 
         
    }
    if(isset($_SESSION['status']) && ($_SESSION['status'] =='verified')) { 
        $twitter_url = 'https://twitter.com/logout'; 
        echo '<a id="vshcr3_twitter_btn" class="vshcr3_button_1 vshcr3_twitter_btn" target="_blank" href="#"  onClick="twitter_logout();" >Twitter Logout</a>'; 
    }
    else{
        echo '<a id="vshcr3_twitter_btn" class="vshcr3_button_1 vshcr3_twitter_btn" href="'.$twitter_url.'">Twitter</a>';   
	} 
        ?>
                <script type="text/javascript">
        function twitter_logout(){
			<?php unset($_SESSION['status']);?>
			window.open('https://twitter.com/logout');
			//https://api.twitter.com/oauth/authorize?oauth_token=<?php //echo $request_token['oauth_token'];?>
			location.reload();
		}
        </script>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--Add buttons to initiate auth sequence and sign out-->
                <a id="authorize-button-google" style="display: none;"  class="fb_button fb_button_medium vshcr3_button_1 vshcr3_twitter_btn">Google</a><a id="signout-button-google" style="display: none;"  class="fb_button fb_button_medium vshcr3_button_1 vshcr3_twitter_btn">Google Sign Out</a>
                <script type="text/javascript">
      // Enter an API key from the Google API Console:
      //   https://console.developers.google.com/apis/credentials?project=_
        var apiKey = '<?php echo $google_client_secret?>';

      // Enter a client ID for a web application from the Google API Console:
      //   https://console.developers.google.com/apis/credentials?project=_
      // In your API Console project, add a JavaScript origin that corresponds
      //   to the domain where you will be running the script.
      var clientId = '<?php echo $google_client_id?>';

      // Enter one or more authorization scopes. Refer to the documentation for
      // the API or https://developers.google.com/identity/protocols/googlescopes
      // for details.
      var scopes = 'profile';

      var auth2; // The Sign-In object.
      var authorizeButtonGoogle = document.getElementById('authorize-button-google');
      var signoutButtonGoogle = document.getElementById('signout-button-google');

      function handleClientLoad() {
        // Load the API client and auth library
        gapi.load('client:auth2', initAuth);
      }

      function initAuth() {
        gapi.client.setApiKey(apiKey);
        gapi.auth2.init({
            client_id: clientId,
            scope: scopes
        }).then(function () {
          auth2 = gapi.auth2.getAuthInstance();

          // Listen for sign-in state changes.
          auth2.isSignedIn.listen(updateSigninStatus);

          // Handle the initial sign-in state.
          updateSigninStatus(auth2.isSignedIn.get());

          authorizeButtonGoogle.onclick = handleAuthClick;
          signoutButtonGoogle.onclick = handleSignoutClick;
        });
      }

      function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
          authorizeButtonGoogle.style.display = 'none';
          signoutButtonGoogle.style.display = 'inline-block';
          makeApiCall();
        } else {
          authorizeButtonGoogle.style.display = 'inline-block';
          signoutButtonGoogle.style.display = 'none';
        }
      }

      function handleAuthClick(event) {
        auth2.signIn();
      }

      function handleSignoutClick(event) {
        auth2.signOut();
      }

      // Load the API and make an API call.  Display the results on the screen.
      function makeApiCall() {
		var resultFinal = auth2.currentUser.get().getBasicProfile();
		jQuery.ajax({
			url: '<?php echo BASE_URL?>/wp-admin/admin-ajax.php?action=vshcr3-socailAjax&oauth_provider=GoogleOAuth',
			data : {'socialData':resultFinal},
			type: 'POST'
		  });
       // console.log(auth2.currentUser.get().getBasicProfile());
      }
    </script>
                <script src="https://apis.google.com/js/api.js?onload=handleClientLoad"></script></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </form>
  <div class="vshcr3_clear vshcr3_pb5"></div>
  <div class="vshcr3_respond_3">
    <p>
    <div class="vshcr3_button_1 vshcr3_show_btn" href="javascript:void(0);">Create your own review</div>
    </p>
  </div>
</div>
<?php 
}

################################################################
##----------Start Facebook----------##
################################################################
error_reporting(0);
require 'socailclasses/facebook/facebook.php';
function facebook_login($conn){
	$sql = "SELECT option_value from wp_options where option_name='vshcr3_social_setting'";
	$resultSetApi = $conn->query($sql);  
    if(is_array($resultSetApi)|| is_object($resultSetApi)){ 
        foreach($resultSetApi as $rowApi) {
			$vshcr3_social_setting =  @unserialize($rowApi['option_value']);
			#########Facebook#############################Facebook###################		
			$facebook_client_id=$vshcr3_social_setting['facebook_app_id'];//'1212359948783920';
			$facebook_secret_key=$vshcr3_social_setting['facebook_secret_key'];//'1212359948783920';
			$facebook_redirect_uri='http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			#########Facebook#############################Facebook###################		
		}
	}
	$facebook = new Facebook(
		array(
		  'appId'  => $facebook_client_id,
		  'secret' => $facebook_secret_key,
		)
	);
	$user = $facebook->getUser(); 
	if ( $user ) {
	  	try {
			// Proceed knowing you have a logged in user who's authenticated.
			$data = $facebook->api('/me'); 
			$name = explode(" ",$data['name']);
			$first_name = isset($name[0])?$name[0]:'';
			$last_name = isset($name[1])?$name[1]:'';
			//echo "<pre>";print_r($data); echo "</pre>";
			$sql = "SELECT oauth_uid from wp_social_users where oauth_uid='".$data["id"]."'";
			$resultSetApi = $conn->query($sql);  
			$count = $resultSetApi->rowCount();
			if($count==0){
				$statement = $conn->query("INSERT INTO wp_social_users( oauth_provider, oauth_uid, email, username, first_name, last_name, gender, location_name, verified, locale, oauth_token, oauth_secret, picture, created, modified )
				VALUES('FacebookOAuth', '".$data["id"]."', '".$data["email"]."', '".$data["username"]."', '".$first_name."', '".$last_name."', '".$data["gender"]."', '".$data["location_name"]."', '".$data["verified"]."', '".$data["locale"]."', '".$data["oauth_token"]."', '".$data["oauth_secret"]."', '"."https://graph.facebook.com/".$user."/picture"."', '".date('Y-m-d')."', '".date('Y-m-d')."')");
			}
			 return true;
		} 
	  	catch (FacebookApiException $e) {
			 
		}
	}	 
}

facebook_login($conn);

##----------End Facebook----------##
################################################################
##----------Start Twitter----------##
################################################################
require_once ('socailclasses/twitter/twitteroauth.php');

function twitter_login($conn){
	$sql = "SELECT option_value from wp_options where option_name='vshcr3_social_setting'";
	$resultSetApi = $conn->query($sql); print_r($resultSet);
    $twitter_consumer_key='';
	$twitter_consumer_secret= '';
	$twitter_oauth_callback='';
	if(is_array($resultSetApi)|| is_object($resultSetApi)){ 
        foreach($resultSetApi as $rowApi) {
			$vshcr3_social_setting =  @unserialize($rowApi['option_value']);
			#########Facebook#############################Facebook###################		
			$twitter_consumer_key=$vshcr3_social_setting['twitter_consumer_key'];
			$twitter_consumer_secret=$vshcr3_social_setting['twitter_consumer_secret'];
			$twitter_oauth_callback= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			#########Facebook#############################Facebook###################		
		}
	} 
	if(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {  
		$connection = new TwitterOAuth($twitter_consumer_key, $twitter_consumer_secret, $_SESSION['token'] , $_SESSION['token_secret']);
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);  
		if($connection->http_code == '200'){  
			try {
				$_SESSION['status'] = 'verified';
				$_SESSION['request_vars'] = $access_token; 
				//Insert user into the database
				$data = $connection->get('account/verify_credentials'); 
				//echo "<pre>";print_r($data); echo "</pre>";
				$name = explode(" ",$data->name);
				$first_name = isset($name[0])?$name[0]:'';
				$last_name = isset($name[1])?$name[1]:'';
				$sql = "SELECT oauth_uid from wp_social_users where oauth_uid='".$data->id."'";
				$resultSetApi = $conn->query($sql);  
				$count = $resultSetApi->rowCount();
				if($count==0){
					// Proceed knowing you have a logged in user who's authenticated.  
					$statement = $conn->query("INSERT INTO wp_social_users( oauth_provider, oauth_uid, email, username, first_name, last_name, gender, location_name, verified, locale, oauth_token, oauth_secret, picture, created, modified )
					VALUES('TwitterOAuth', '".$data->id."', '', '', '".$first_name."', '".$last_name."', '', '', '".$_SESSION['status']."', '".$data->lang."', '".$access_token['oauth_token']."', '".$access_token['oauth_token_secret']."', '".$data->profile_image_url."', '".date('Y-m-d')."', '".date('Y-m-d')."')"); 
				}
			} 
			catch (Exception $e) {
 
 			}
		} 
	} 
} 
twitter_login($conn);
##----------End Twitter----------##
################################################################

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>Hello world! | Deal4loans.com</title>
<link rel='stylesheet' id='wp-social-customer-reviews-3-frontend-css' href='<?php echo BASE_URL?>/review-social/assets/wp-social-customer-reviews-generated.css?ver=1.0.0' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo BASE_URL?>/review-social/assets/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='<?php echo BASE_URL?>/review-social/assets/wp-social-customer-reviews.js?ver=1.0.0'></script>
</head>
<body class="single single-post postid-1 single-format-standard single-author sidebar">
<div class="entry-content">
  <p>Welcome to  post reviews writing panel!</p>
  <div data-vshcr3-content="1">
    <?php 
    displayReviewForm($conn);  
    displayReviewList($conn);
    ?>
  </div>
</div>
</body>
</html>