function openSettings(evt, settingsType) {
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("account-settings-tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}
	tablinks = document.getElementsByClassName("account-settings-tablinks");
	for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	}
	document.getElementById(settingsType).style.display = "block";
	evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();

var namePattern = /^[A-Z]'?[- a-zA-Z]+$/;
var datetimePattern = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
var passwPattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;

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

function validateDetailsForm() {
	lastDiv = document.getElementsByClassName("error");
	for(let i = lastDiv.length - 1; i >= 0; i--) {
        if(lastDiv[i] && lastDiv[i].parentElement) {
            lastDiv[i].parentElement.removeChild(lastDiv[i]);
        }
    }
	var evalErrors = [];

	var fam_name = document.forms["detailsForm"]["fam_name"].value;
	if(!myValidate(fam_name, namePattern))
		evalErrors.push("Family name is not valid");

	var fst_name = document.forms["detailsForm"]["fst_name"].value;
	if(!myValidate(fst_name, namePattern))
		evalErrors.push("First name is not valid");

	var date_birth = document.forms["detailsForm"]["date_birth"].value;
	if(date_birth != ""){
		if(!myValidate(date_birth, datetimePattern))
			evalErrors.push("Birth date is not valid (dd/mm/yyyy or dd-mm-yyyy)");
	}

	var new_password = document.forms["detailsForm"]["new_password"].value;
	if(new_password != ""){
		if(!myValidate(new_password, passwPattern))
			evalErrors.push("The password must contain at least 8 characters, an uppercase letter, a lowercase letter and a number");
	}

	if(evalErrors.length > 0){
		var mDiv = document.createElement("div");
		mDiv.classList.add("error");
		for(let i=0; i<evalErrors.length; i++){
			mDiv.innerHTML += "<p>"+ evalErrors[i] +"</p>";
		}
		var detForm = document.getElementById("detForm");
		detForm.insertBefore(mDiv, detForm.firstChild);
		return false;
	}
	else return true;
}

var postalCodePattern = /[0-9]{6}/;
var cardNumberPattern = /[0-9]{4}[\-][0-9]{4}[\-][0-9]{4}[\-][0-9]{4}/;

function validatePaymentForm() {
	lastDiv = document.getElementsByClassName("error");
	for(let i = lastDiv.length - 1; i >= 0; i--) {
        if(lastDiv[i] && lastDiv[i].parentElement) {
            lastDiv[i].parentElement.removeChild(lastDiv[i]);
        }
    }
	var evalErrors = [];

	var card_number = document.forms["paymentForm"]["card_number"].value;
	if(card_number != ""){
		if(!myValidate(card_number, cardNumberPattern))
			evalErrors.push("Card number is not valid");
	}

	var exp_date = document.forms["paymentForm"]["exp_date"].value;
	if(exp_date != ""){
		if(!myValidate(exp_date, datetimePattern))
			evalErrors.push("Expiring date is not valid (dd/mm/yyyy or dd-mm-yyyy)");
	}

	var country = document.forms["paymentForm"]["country"].value;
	if(country != ""){
		if(!myValidate(country, namePattern))
			evalErrors.push("Country name is not valid");
	}

	var postal_code = document.forms["paymentForm"]["postal_code"].value;
	if(postal_code != ""){
		if(!myValidate(postal_code, postalCodePattern))
			evalErrors.push("Postal code is not valid");
	}

	if(evalErrors.length > 0){
		var mDiv = document.createElement("div");
		mDiv.classList.add("error");
		for(let i=0; i<evalErrors.length; i++){
			mDiv.innerHTML += "<p>"+ evalErrors[i] +"</p>";
		}
		var payForm = document.getElementById("payForm");
		payForm.insertBefore(mDiv, payForm.firstChild);
		return false;
	}
	else return true;
}
