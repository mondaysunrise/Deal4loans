function pancardupdate(Form)
{
	if(Form.contact_no.value=="")
	{ 
	    alert("enter your contact no.");
		Form.contact_no.focus();
		return false;
	}
	var myOption;
	var i;
	myOption = -1;
		for (i=Form.pancard_status.length-1; i > -1; i--) {
			if(Form.pancard_status[i].checked) {
				if(i==0)
				{
					if(Form.pancard_no.value==""){
						alert("enter your pancard no.");
						Form.pancard_no.focus();
						return false;}

				}
				myOption = i;

				
			}
		}
	
		if (myOption == -1) 
		{
			alert("Please select you are Pancard holder or not");
			return false;
		}

}