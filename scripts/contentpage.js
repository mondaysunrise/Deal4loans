
	
function insRow()
  {
	  if(document.getElementById('myTable').rows.length==1)
	  {
  var x=document.getElementById('myTable').insertRow(0)
  var y=x.insertCell(0)
  //var z=x.insertCell(1)
  y.innerHTML=" <table bgcolor='#DAEAF9'  style='border:1px dotted #9C9A9C;' width='100%'><tr><td ><b>Name</b></td><td ><input type='text' name='Name'></td><td><a  onclick='deleteRow(this)' style='cursor:pointer;'>close</a></td></tr><tr><td ><b>Email id</b></td><td ><input type='text' name='Email'></td></tr><tr><td><b>Subject</b></td><td><input type='text' name='subject'></td></tr><tr><td><b>Write Message</b></td><td><textarea rows='5' cols='50' name='content'></textarea></td></tr><tr><td colspan='2' align='center'> <input type='submit' value='submit' class='btnclr'></td></tr></table>"
//  z.innerHTML="NEW CELL2"
  }
  }
  function deleteRow(r)
  {
  var i=r.parentNode.parentNode.rowIndex
  document.getElementById('myTable').deleteRow(i)
  }

   function validmail(email1) 
{
	invalidChars = " /:,;";
	if (email1 == "")
	{// cannot be empty
		alert("Invalid E-mail ID.");
		return false;	
	}
	for (i=0; i<invalidChars.length; i++) 
	{	// does it contain any invalid characters?
		badChar = invalidChars.charAt(i);
		if (email1.indexOf(badChar,0) > -1) 
		{
			return false;
		}
	}
	atPos = email1.indexOf("@",1)// there must be one "@" symbol
	if (atPos == -1) 
	{
		alert("Invalid E-mail ID.");
		return false;
	}
	if (email1.indexOf("@",atPos+1) != -1) 
	{	// and only one "@" symbol
		alert("Invalid E-mail ID.");
		return false;
	}
	periodPos = email1.indexOf(".",atPos)
	if (periodPos == -1) 
	{// and at least one "." after the "@"
		alert("Invalid E-mail ID.");
		return false;
	}
	//alert(periodPos);
	//alert(email.length);
	if (periodPos+3 > email1.length)	
	{		// must be at least 2 characters after the "."
		alert("Invalid E-mail ID.");
		return false;
		
	}
	return true;
}
function chktesti()
{  
		if(document.testi_form.Name.value=="")
	{
			alert("please enter your Name!");
			document.testi_form.Name.focus();
				return false;
	}
		if(document.testi_form.Email.value=="")
	{
			alert("please enter your email id!");
			document.testi_form.Email.focus();
				return false;
	}
	if(document.testi_form.Email.value!="")
	{
		if (!validmail(document.testi_form.Email.value))
		{
			//alert("Please enter your valid email address!");
			document.testi_form.Email.focus();
			return false;
		}

	}
	if(document.testi_form.subject.value=="")
	{   
		alert("Please enter Subject");
		document.testi_form.subject.focus();
		return false;
	}
	if(document.testi_form.content.value=="")
	{
		alert("Please enter message");
		document.testi_form.content.focus();
		return false;
	}
	
	}


