var namePattern = /^[A-Z]'?[- a-zA-Z]+$/;
var emailPattern = /\S+@\S+\.\S+/;

function myValidate(string, patt) {
	var resString = patt.exec(string);
	if(resString == string)return true;
	else {
		if(resString != null){
			if(resString[0] == string)return true;
			else return false;
		}
		else return false;
	}
}

function validateContactForm() {
	lastDiv = document.getElementsByClassName("error");
	for(let i = lastDiv.length - 1; i >= 0; i--) {
        if(lastDiv[i] && lastDiv[i].parentElement) {
            lastDiv[i].parentElement.removeChild(lastDiv[i]);
        }
    }
	var evalErrors = [];

	var fam_name = document.forms["contactForm"]["fam_name"].value;
	if(fam_name != ""){
		if(!myValidate(fam_name, namePattern))
			evalErrors.push("Family name is not valid");
	}

	var fst_name = document.forms["contactForm"]["fst_name"].value;
	if(fst_name != ""){
		if(!myValidate(fst_name, namePattern))
			evalErrors.push("First name is not valid");
	}

	var email = document.forms["contactForm"]["email"].value;
	if(!myValidate(email, emailPattern))
		evalErrors.push("Email is not valid");

	var subject = document.forms["contactForm"]["subject"].value;
	if(subject.length > 99)
		evalErrors.push("Subject can contain maximum 100 characters");

	var message = document.forms["contactForm"]["message"].value;
	if(message.length > 999)
		evalErrors.push("Subject can contain maximum 1000 characters");

	if(evalErrors.length > 0){
		var mDiv = document.createElement("div");
		mDiv.classList.add("error");
		for(let i=0; i<evalErrors.length; i++){
			mDiv.innerHTML += "<p>"+ evalErrors[i] +"</p>";
		}
		var conForm = document.getElementById("conForm");
		conForm.insertBefore(mDiv, conForm.firstChild);
		return false;
	}
	else return true;
}
