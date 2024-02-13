var namePattern = /^[A-Z]'?[- a-zA-Z]+$/;
var emailPattern = /\S+@\S+\.\S+/;
var passwPattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;

function myValidate(string, patt) {
	var resString = patt.exec(string);
	if(resString == string)return true;
	else return false;
}

function validateRegisterForm() {
	lastDiv = document.getElementsByClassName("error");
	for(let i = lastDiv.length - 1; i >= 0; i--) {
        if(lastDiv[i] && lastDiv[i].parentElement) {
            lastDiv[i].parentElement.removeChild(lastDiv[i]);
        }
    }
	var evalErrors = [];

	var fam_name = document.forms["registerForm"]["fam_name"].value;
	if(!myValidate(fam_name, namePattern))
		evalErrors.push("Family name is not valid");

	var fst_name = document.forms["registerForm"]["fst_name"].value;
	if(!myValidate(fst_name, namePattern))
		evalErrors.push("First name is not valid");

	var email = document.forms["registerForm"]["email"].value;
	if(!myValidate(email, emailPattern))
		evalErrors.push("Email is not valid");

	var password = document.forms["registerForm"]["password"].value;
	if(!myValidate(password, passwPattern))
		evalErrors.push("The password must contain at least 8 chars (capital letter, small letter and number)");

	var conf_password = document.forms["registerForm"]["conf_password"].value;
	if(conf_password != password)
		evalErrors.push("The two passwords are not the same");

	if(evalErrors.length > 0){
		var mDiv = document.createElement("div");
		mDiv.classList.add("error");
		for(let i=0; i<evalErrors.length; i++){
			mDiv.innerHTML += "<p>"+ evalErrors[i] +"</p>";
		}
		var regForm = document.getElementById("regForm");
		regForm.insertBefore(mDiv, regForm.firstChild);
		return false;
	}
	else return true;
}
