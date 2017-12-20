 <?php

if($_SESSION['siten']=="ndtv")
{
	}else
	{
		 if(!isset($_SESSION['UserType']))
		{
		?>   <div id="dvNavbg" style="background-color:#D07400; width:774px; margin:0px;">
			  <div id="dvTopNav"><a href="/mediarelease.php">Media Coverage</a> | <a href="/Contents_Blogs.php">Blogs</a> | <a href="/Contents_Feedback.php">Testimonials</a> | <a href="/Contents_Articles.php">Articles</a> | <a href="/AskAmitoj.php">Ask Amitoj</a> | <a href="/Contents_Calculators.php"> EMI Calculator</a></div>
			</div>

<? }
}			
			?>