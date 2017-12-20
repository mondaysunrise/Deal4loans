function validmailCheck(email1)
{

    invalidChars = " /:,;";

    if (email1 == "")

    {// cannot be empty

        alert("Invalid E-mail ID.");

        return false;

    }

    for (i = 0; i < invalidChars.length; i++)

    {	// does it contain any invalid characters?

        badChar = invalidChars.charAt(i);

        if (email1.indexOf(badChar, 0) > -1)

        {

            return false;

        }

    }

    atPos = email1.indexOf("@", 1)// there must be one "@" symbol

    if (atPos == -1)

    {

        alert("Invalid E-mail ID.");

        return false;

    }

    if (email1.indexOf("@", atPos + 1) != -1)

    {	// and only one "@" symbol

        alert("Invalid E-mail ID.");

        return false;

    }

    periodPos = email1.indexOf(".", atPos)

    if (periodPos == -1)

    {// and at least one "." after the "@"

        alert("Invalid E-mail ID.");

        return false;

    }

    if (periodPos + 3 > email1.length)

    {		// must be at least 2 characters after the "."

        alert("Invalid E-mail ID.");

        return false;

    }

    return true;

}

function mfFormValidate(Form)

{
    var Form = document.mf_form;
    var regMail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9])+$/
    var dt, mdate;
    dt = new Date();
    var alpha = /^[a-zA-Z\ ]*$/;
    var alphanum = /^[a-zA-Z0-9]*$/;
    var num = /^[0-9]*$/;
    var space = /^[\ ]*$/;
    var iChars = "/@#$%^&*()+=-[]\\\';,.{}|\":<>?!";

    if ((Form.Name.value == ""))
    {
        document.getElementById('NameVal').innerHTML = "<span  class='hintanchor'>Kindly fill in your Name!</span>";
        Form.Name.focus();
        return false;
    }
    if ((Form.Phone.value == 'Mobile') || (Form.Phone.value == ''))
    {
        document.getElementById('MobileVal').innerHTML = "<span  class='hintanchor'>Kindly fill in your Mobile Number!</span>";
        Form.Phone.focus();
        return false;

    }
    if (Form.Phone.value.length < 10)
    {
        alert("Please Enter 10 Digits");
        Form.Phone.focus();
        return false;
    }

    if ((Form.Phone.value.charAt(0) != "9") && (Form.Phone.value.charAt(0) != "8") && (Form.Phone.value.charAt(0) != "7"))
    {
        alert("The number should start only with 9 or 8 or 7");
        Form.Phone.focus();
        return false;
    }
    if (Form.Email.value != "Email Id")
    {
        if (!validmailCheck(Form.Email.value)) {
            Form.Email.focus();
            return false;
        }
    }
    if (Form.City.selectedIndex == 0)
    {
        document.getElementById('CityVal').innerHTML = "<span  class='hintanchor'>Select City!</span>";
        Form.City.focus();
        return false;
    }
    if ((Form.City.value == "Others") && ((Form.City_Other.value == "" || Form.City_Other.value == "Other City") || !isNaN(Form.City_Other.value)))
    {
        document.getElementById('othercityVal').innerHTML = "<span  class='hintanchor'>Enter Other City to Continue!</span>";
        Form.City_Other.focus();
        return false;
    }

    if (!document.getElementById("accept").checked)
    {
        document.getElementById('acceptVal').innerHTML = "<span class='hintanchor'>Please Check Term and condition to proceed.</span>";
        Form.accept.focus();
        return false;
    }


}
function isCharsetKeyMF(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode > 33) && (charCode < 58))
        return false;
    return true;
}

function validateDiv(div)
{
    var ni1 = document.getElementById(div);
    ni1.innerHTML = '';
}
function GetCityVal(cVal) {

    if (cVal == 'Others') {
        document.getElementById('OtherCity').style.display = 'block';

    } else {
        document.getElementById('OtherCity').style.display = 'none';
    }
}
