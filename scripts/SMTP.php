<br /><br /><br /><center><font face="arial"><table width="80%"><tr><td>
This class will not work unless you chose to fill in your SMTP details when you installed phpdev5, you can reconfigure phpdev5 by running the install script found in <font color="blue">$your_install_dir\install.bat.</font>
<br /><br >
The SMTP class is structured as per the PHP mail() function, note that your application may hang whilst the SMTP connection is being made and that if you are not conected to the internet the script will time out!
<br /><br />
Note that you do not need to add the path to the SMTP.class as this is already in the PHP include path.
<br /><br />
</td></tr></table>

<table width="80%"><tr><td>
<?
highlight_string('<'."?
include 'SMTP.class';
echo dev_mail('whoever@whoever.com','hello from phpdev5','justatesting','FROM:me@mydomain.com');
?".'>');
?>
</td></tr></table>
</center>