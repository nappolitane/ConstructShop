products = document.getElementsByClassName("gallery");
//console.log(products[0].childNodes[1].childNodes[3].childNodes[1].textContent);

function sortAlphabetic() {
	for(i = 0; i < products.length - 1; i++) {
		
		for(q = 0; q < products.length - i - 1; q++){
			var product = products[q].childNodes;
			for(j = 0; j < product.length; j++) {
				if(product[j].childNodes.length != 0) {
					var descProduct = product[j].childNodes;
					for(k = 0; k < descProduct.length; k++) {
						if(descProduct[k].className == "desc"){
							var desc = descProduct[k].childNodes;
							for(l = 0; l < desc.length; l++) {
								if(desc[l].className == "nameP"){
									if(desc[l].textContent > products[q+1].childNodes[j].childNodes[k].childNodes[l].textContent){
										products[q+1].parentNode.insertBefore(products[q+1],products[q]);
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

function sortRevAlphabetically() {
	for(i = 0; i < products.length - 1; i++) {
		
		for(q = 0; q < products.length - i - 1; q++){
			var product = products[q].childNodes;
			for(j = 0; j < product.length; j++) {
				if(product[j].childNodes.length != 0) {
					var descProduct = product[j].childNodes;
					for(k = 0; k < descProduct.length; k++) {
						if(descProduct[k].className == "desc"){
							var desc = descProduct[k].childNodes;
							for(l = 0; l < desc.length; l++) {
								if(desc[l].className == "nameP"){
									if(desc[l].textContent < products[q+1].childNodes[j].childNodes[k].childNodes[l].textContent){
										products[q+1].parentNode.insertBefore(products[q+1],products[q]);
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

function sortIncPrice() {
	for(i = 0; i < products.length - 1; i++) {
		
		for(q = 0; q < products.length - i - 1; q++){
			var product = products[q].childNodes;
			for(j = 0; j < product.length; j++) {
				if(product[j].childNodes.length != 0) {
					var descProduct = product[j].childNodes;
					for(k = 0; k < descProduct.length; k++) {
						if(descProduct[k].className == "desc"){
							var desc = descProduct[k].childNodes;
							for(l = 0; l < desc.length; l++) {
								if(desc[l].className == "priceP"){
									if(parseFloat(desc[l].textContent) > parseFloat(products[q+1].childNodes[j].childNodes[k].childNodes[l].textContent)){
										products[q+1].parentNode.insertBefore(products[q+1],products[q]);
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

function sortDecPrice() {
	for(i = 0; i < products.length - 1; i++) {
		
		for(q = 0; q < products.length - i - 1; q++){
			var product = products[q].childNodes;
			for(j = 0; j < product.length; j++) {
				if(product[j].childNodes.length != 0) {
					var descProduct = product[j].childNodes;
					for(k = 0; k < descProduct.length; k++) {
						if(descProduct[k].className == "desc"){
							var desc = descProduct[k].childNodes;
							for(l = 0; l < desc.length; l++) {
								if(desc[l].className == "priceP"){
									if(parseFloat(desc[l].textContent) < parseFloat(products[q+1].childNodes[j].childNodes[k].childNodes[l].textContent)){
										products[q+1].parentNode.insertBefore(products[q+1],products[q]);
									}
								}
							}
						}
					}
				}
			}
		}
	}
}

function changeFunc() {
	var selectBox = document.getElementById("sort-select");
	var selectedValue = selectBox.options[selectBox.selectedIndex].value;
	switch(selectedValue) {
		case "alphabetic":
			sortAlphabetic();
			break;
		case "revAlphabetically":
			sortRevAlphabetically();
			break;
		case "incPrice":
			sortIncPrice();
			break;
		case "decPrice":
			sortDecPrice();
			break;
		default:
			sortAlphabetic();
			break;
	}
}

var filterForm = document.getElementById("prod-filter");

var boxWater = document.getElementById("waterproofing");
var boxThermal = document.getElementById("thermal_insulation");
var boxFacades = document.getElementById("facades_finishes");
var boxRoofs = document.getElementById("roofs");

boxWater.addEventListener('change',function(){
	filterForm.submit();
});
boxThermal.addEventListener('change',function(){
	filterForm.submit();
});
boxFacades.addEventListener('change',function(){
	filterForm.submit();
});
boxRoofs.addEventListener('change',function(){
	filterForm.submit();
});

var boxOrdinary = document.getElementById("ordinary");
var boxPremium = document.getElementById("premium");
var boxNew = document.getElementById("new");

boxOrdinary.addEventListener('change',function(){
	filterForm.submit();
});
boxPremium.addEventListener('change',function(){
	filterForm.submit();
});
boxNew.addEventListener('change',function(){
	filterForm.submit();
});

