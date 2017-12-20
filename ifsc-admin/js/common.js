
// Bank Validation 
function valAddBank(evt)
{
	var frm=document.Frm;
	if(frm.bankName.value=="")
	{
		frm.bankName.style.border='1px solid #FF0000';
		alert('Please enter Bank Name.');
		frm.bankName.focus();
		return false;
	 }
	
	 else
	{
		return true;
	}

}

// City Validation

function valAddCity()
	{
		var frm = document.CityFrm;
		if(frm.stateName.value=="")
			{
				frm.stateName.style.border='1px solid #FF0000';
				alert('Please Select State Name.');
				frm.stateName.focus();
				return false;
			}
		
		if(frm.CityName.value=="")
			{
				frm.CityName.style.border='1px solid #FF0000';
				alert('Please Enter City Name.');
				frm.CityName.focus();
				return false;
			}
		if(frm.CityLatitude.value=="")
			{
				frm.CityLatitude.style.border='1px solid #FF0000';
				alert('Please enter Latitude.');
				frm.CityLatitude.focus();
				return false;
			}
		if(frm.CityLongitude.value=="")
			{
				frm.CityLongitude.style.border='1px solid #FF0000';
				alert('Please enter Longitude.');
				frm.CityLongitude.focus();
				return false;
			}
	}


// Location/Branch Validation
function valAddLocation()
	{
		var frm = document.LocationFrm;
		if(frm.BankName.value=="")
			{
				frm.BankName.style.border='1px solid #FF0000';
				alert('Please Select Bank Name.');
				frm.BankName.focus();
				return false;
			}
		if(frm.CityName.value=="")
			{
				frm.CityName.style.border='1px solid #FF0000';
				alert('Please Select City Name.');
				frm.CityName.focus();
				return false;
			}
		if(frm.locationName.value=="")
			{
				frm.locationName.style.border='1px solid #FF0000';
				alert('Please enter Location Name.');
				frm.locationName.focus();
				return false;
			}
		if(frm.IfscCode.value=="")
			{
				frm.IfscCode.style.border='1px solid #FF0000';
				alert('Please enter IFSC Code.');
				frm.IfscCode.focus();
				return false;
			}
		
	/*	if(frm.SwiftBicCode.value=="")
			{
				frm.SwiftBicCode.style.border='1px solid #FF0000';
				alert('Please enter Swift Bic Code.');
				frm.SwiftBicCode.focus();
				return false;
			}
	if(frm.Latitude.value=="")
			{
				frm.Latitude.style.border='1px solid #FF0000';
				alert('Please enter Latitude.');
				frm.Latitude.focus();
				return false;
			}
		if(frm.Longitude.value=="")
			{
				frm.Longitude.style.border='1px solid #FF0000';
				alert('Please enter Longitude.');
				frm.Longitude.focus();
				return false;
			}
		*/
		
		
	}
