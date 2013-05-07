//Create message when click the button "Hämta uppgifter" on tab-3
function showSsnMessage(){
	//If the div SSN has no value
	if($("#ssn").val() == ""){
		//Fade out the content
		$("#ssnInfo").fadeOut("fast");
		
		//And delete it to prevent duplication of the div
		$("#ssnInfo").queue(function(){
			$("#ssnInfo").remove();
			$(this).dequeue();
		});
	}
	else{
		//If div ssnInfo doesn't exist
		if($("#ssnInfo").length == 0){
			//Create it
			var div = $(document.createElement('div')).attr('id', 'ssnInfo').css("display", "none");
			//And insert after this div
			div.insertAfter("#tabs-3 #faktura button");
			
			//Add text the the ssnInfo div and fade it in
			$("#ssnInfo").html("Din folkbokföringsaddress kommer att användas som leverans och fakturaaddress. <br><br> Klicka på 'Hämta uppgifter' för att fylla i formuläret till vänster.").fadeIn("fast");
		}
	}
}

//jQuery Tabs
function jQueryTabs() {
	var $tabs = $('#tabs').tabs();
	//Tabs - fade effect
	$('#tabs').tabs('option', 'fx', { opacity: 'toggle', duration: 'fast' });
	
	//Select tab 1 as default
	$("#tabs").tabs('select',0);
	
	//Disable tab 2 and 3
	$("#tabs").tabs({disabled: [1,2]});
	
	//If there is a selected class on the categories
	if($("#tabs-1 img").hasClass("selected")){
		//To prevent duplicating the nav buttons, remove existing nav buttons first
		$(".mover").remove(); $(".nav").remove();
		
		//Enable all tabs
		$("#tabs").tabs({disabled: []});
	
		//Add next/prev buttons
		$(".ui-tabs-panel").each(function(i){
			//Count how many tabs there are
			var totalSize = $(".ui-tabs-panel").size() - 1;

			//Show prev button if its not on the first tab
			if (i != 0) {
			  prev = i;
			  $(this).append("<div class='nav'><a href='#tabs-"+prev+"' class='btn prev-tab mover' rel='" + prev + "'>&#171; Förgående</a>");
			}
			
			//Show next button if its not on the last tab
			if (i != totalSize) {
			  next = i + 2;
			  $(this).append("<a href='#tabs-"+next+"' class='btn next-tab mover' rel='" + next + "'>Nästa &#187;</a></div>");
			}
		});
	}
	//Else, remove the buttons
	else{
		$(".mover").remove(); $(".nav").remove();
	}
	
	//Add the click function to the tabs
	$('.next-tab, .prev-tab').click(function() { 
	   $tabs.tabs('select', $(this).attr("rel"));
	   return false;
	});
};

//Give selected image a selected class
function selectCat(select){
	//If the clicked image has class "selected"
	if($(select).hasClass("selected")){
		//Remove that class
		$(select).removeClass("selected");
	}
	//If the selected image does not have class "selected"
	else{
		//Remove the class "selected" from the the selected image
		$("img").removeClass("selected");
		
		//Add class "selected" to the clicked image
		$(select).addClass("selected");
	}
	jQueryTabs();
}

//Show products for the selected category
function showProd(){
	if($("#tabs-1 > img").hasClass("selected")){
		//Retrieve the category id from the selected category
		var category = $(".selected").attr("id");
		
		//First, we hide all the products that are possibly shown
		$("#cars").hide();
		$("#toys").hide();
		$("#flowers").hide();
		$("#travels").hide();
		
		//Then we bring the selected category´s products
		//If cars is selected
		if(category == "catCars"){
			$("#tabs-2 > p").hide();
			$("#cars").show();
			$(".prodBox").show();
		}
		else{
			//If toys is selected
			if(category == "catToys"){
				$("#tabs-2 > p").hide();
				$("#toys").show();
				$(".prodBox").show();
			}
			else{
				//If flowers is selected
				if(category == "catFlowers"){
					$("#tabs-2 > p").hide();
					$("#flowers").show();
					$(".prodBox").show();
				}
				else{
					if(category == "catTrips"){
						$("#tabs-2 > p").hide();
						$("#travels").show();
						$(".prodBox").show();
					}
				}
			}
		
		}
	}
	else{
		//If no category is selected, show messagebox with instructions (located inside #tabs-2)
		$("#tabs-2 > p").show();
		$(".prodBox").hide();
	}
}

//Show / hide the more info box
function showMoreInfo(target){
	//Retrieve the clicked buttons target number and store that number in "targetNumber"
	var targetNumber = $(target).attr("target");
	
	//If the more info box is hidden, show the box
	if($("#moreInfo"+targetNumber).css("display") == "none"){
		$("#moreInfo"+targetNumber).slideDown();
		$("#"+targetNumber).html("Dölj mer info");
	}
	else{
		//If the more info box is shown, hide the box
		if($("#moreInfo"+targetNumber).css("display") == "block"){
			$("#moreInfo"+targetNumber).slideUp();
			$("#"+targetNumber).html("Visa mer info");
		}
	}
}

//Check the last sent value
//Set lastNumber to a string
var lastNumber = "";
function validateAmount(ctrl){
	//if its not a number, set it to lastNumber
	if (isNaN(ctrl.value))
		ctrl.value = lastNumber;
	//If its a number, update lastNumber
	else
		lastNumber = ctrl.value;
}

//Hide current img and show next img (NOTICE: These img has to be after each other)
function imageOver(myimg){
	$(myimg).hide();
	$(myimg).next().show();
}

//Show previous img and hide this img (NOTICE: These img has to be after each other)
var orgImageSource;
function imageOut(myimg){
	$(myimg).prev().show();
	$(myimg).hide();
}

//Add product, amount, price and total price to the cart
//Set totalPrice to 0
var totalPrice = 0;
function addToCart(target){
	var targetNumber = $(target).attr("target");
	
	//Get the product name via its target number
	var productName = $("#productName"+targetNumber).html();
	
	//Get the product id via its target number
	var productId = $("#productName"+targetNumber).attr("id");
	
	//Get the product amount via its target number
	var productAmount = parseInt($("#productAmount"+targetNumber).val());
	
	//Get the product price via its target number
	var productPrice =  parseInt($("#productPrice"+targetNumber).html());
	
	//Get the total product by multiplying the amount times the price
	var productPriceTotal = parseInt(productPrice * productAmount);
	
	//Add them all together in a list item in the cashiers ul list
	//Check is its not a number
	if(!$.isNumeric(productAmount)){
		//If not, create a error div
		var err = $(document.createElement('div')).attr('class', 'err').html("Du måste fylla i ett tal!");
		
		//And insert it after the inputfield IF it doesnt already exists
		if($(".err").length == 0){
			err.insertAfter("#tabs-2 #productAmount"+targetNumber);
		}
	}
	//If it is a number
	else{
		//Delete the error box
		$(".err").remove();
		
		//Add product to the cart and to the check out
		$("#cart ul").append("<li><p class='left'>" + productAmount + "st</p><p class='middle' id='"+productId+"'>" + productName + "</p><p class='right'>" + productPriceTotal + "kr </p></li>");
		$("#checkOut ul").append("<li><p class='left'>" + productAmount + "st</p><p class='middle' id='"+productId+"'>" + productName + "</p><p class='right'>" + productPriceTotal + "kr </p></li>");
	}
	
	//Sum the price in the priceTotalBox
	//Set latestProdPrice to 0
	var latestProdPrice = 0;
	
	//Go through all the li items in the cart box
	$("#cart ul li").each(function(index){
		//Give each li a unique id, item-1, item-2 and so on
		$(this).attr("id", "item-"+(index+1));
		
		//For each item, get the price and update latestProdPrice
		var div = parseInt($("#item-"+(index+1)+" .right").html());
		latestProdPrice = div;
	});
	
	//Add the latestProdPrice to totalPrice
	totalPrice = totalPrice + latestProdPrice;
	
	//Write the new totalPrice in the priceTotalBox and the checkOut box
	$("#cart .priceTotalBox").html("Summa: " + totalPrice + "kr");
	$("#checkOut .priceTotalBox").html("Summa: " + totalPrice + "kr");
}

//Gather info to send to thanks.html
function checkOut(){
	//Get current date
	var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();

	var date = d.getFullYear() + '/' +
	((''+month).length<2 ? '0' : '') + month + '/' +
	((''+day).length<2 ? '0' : '') + day;
	
	//Get product ID from each item in the checkOut
	var productId = [];
	$("#checkOut .middle").each(function(){
		row = $(this).attr("id");
		productId.push(row);
	});
	
	//Get product amount from each item in the checkOut
	var productAmount = [];
	$("#checkOut .right").each(function(){
		row = $(this).html().replace(" ", "");
		productAmount.push(row);
	});
	
	//Get pricetotal from the checkOut
	var productPriceTotal = $("#checkOut .priceTotalBox").html();
	var toRemove = 'Summa: ';
	productPriceTotal = productPriceTotal.replace(toRemove,'');
	
	//Get pricetotal from the checkOut
	customerName = $("#formen #Fname").val() + " " + $("#formen #Lname").val();
	
	//Get pricetotal from the checkOut
	customerEmail = $("#formen #email").val();
	
	//Add value to each hidden input field
	$("#hdForm #productId").val(productId);
	$("#hdForm #productAmount").val(productAmount);
	$("#hdForm #productPriceTotal").val(productPriceTotal);
	$("#hdForm #date").val(date);
	$("#hdForm #customerName").val(customerName);
	$("#hdForm #customerEmail").val(customerEmail);
	
	/*alert(productId);
	alert(productAmount);
	alert(productPriceTotal);
	alert(date);
	alert(customerName);
	alert(customerEmail);*/
}

//Show/Hide the cart
function showHideCashier(){
	//Store the cart in a variable called div
	var div = $("#cart");
	
	//If the text on the tab is "DÖLJ"
	if($("#cart a").html() == "DÖLJ"){
		//Hide the tab 
		div.animate({left:'-240px'},300);
		//And change the text to "VISA"
		$("#cart a").html("VISA");
	}
	//If the text on the tab is not "DÖLJ" ie "VISA"
	else{
		//Show the tab
		div.animate({left:'0px'},300);
		//And change the text to "DÖLJ"
		$("#cart a").html("DÖLJ");
	}
}

//This is just a fake SSN thing. It adds fake name, address etc
function getSSN(){
	var ssnLength = $("#ssn").val().length == 12;
	
	//Validate ssn
	if(ssnLength == false){
		$("#ssn").next().fadeIn("fast");
		$("#ssn").addClass("hasError");
		hasError = true;
	} else {
		$("#ssn").next().fadeOut("fast");
		$("#ssn").removeClass("hasError");
		
		$("#Fname").val("Martin");
		$("#Lname").val("Nilsson");
		$("#address").val("Skräddarebyn 5A");
		$("#postal").val("21842");
		$("#city").val("Bunkeflostrand");
		$("#phone").val("0761824232");
	}
}

function validateInputs(){
	var hasError = false;
	var pattern = /[0-9, ,!"#¤%&=?`´'*^¨~+|><-@£$€]/;
		
		//Validate fname
		if(!$("#Fname").val() || $("#Fname").val() == " " || $("#Fname").val().match(pattern)){
			$("#Fname").next().fadeIn("fast");
			$("#Fname").addClass("hasError");
			hasError = true;
		} else {
			$("#Fname").next().fadeOut("fast");
			$("#Fname").removeClass("hasError");
		}
		
		//Validate lname
		if(!$("#Lname").val() || $("#Lname").val() == " " || $("#Lname").val().match(pattern)){
			$("#Lname").next().fadeIn("fast");
			$("#Lname").addClass("hasError");
			hasError = true;
		} else {
			$("#Lname").next().fadeOut("fast");
			$("#Lname").removeClass("hasError");
		}
		
		//Validate address
		if(!$("#address").val() || $("#address").val() == " "){
			$("#address").next().fadeIn("fast");
			$("#address").addClass("hasError");
			hasError = true;
		} else {
			$("#address").next().fadeOut("fast");
			$("#address").removeClass("hasError");
		}
		
		//Validate postal
		if(!$("#postal").val() || $("#postal").val() == " " || isNaN($("#postal").val() / 1) == true){
			$("#postal").next().fadeIn("fast");
			$("#postal").addClass("hasError");
			hasError = true;
		} else {
			$("#postal").next().fadeOut("fast");
			$("#postal").removeClass("hasError");
		}
		
		//Validate city
		if(!$("#city").val() || $("#city").val() == " " || $("#city").val().match(pattern)){
			$("#city").next().fadeIn("fast");
			$("#city").addClass("hasError");
			hasError = true;
		} else {
			$("#city").next().fadeOut("fast");
			$("#city").removeClass("hasError");
		}
		
		//Validate phone
		if(!$("#phone").val() || $("#phone").val() == " " || isNaN($("#phone").val() / 1) == true){
			$("#phone").next().fadeIn("fast");
			$("#phone").addClass("hasError");
			hasError = true;
		} else {
			$("#phone").next().fadeOut("fast");
			$("#phone").removeClass("hasError");
		}
	
		//Validate email
		var pattern = /\S+@+\S+\.\S+/;
		var str = $("#email").val();

		if(!$("#email").val() || $("#email").val() == " " || !str.match(pattern)){
			$("#email").next().fadeIn("fast");
			$("#email").addClass("hasError");
			hasError = true;
		} else {
			$("#email").next().fadeOut("fast");
			$("#email").removeClass("hasError");
		}
		
		//Validate checkbox
		if(!$('#checkbox').is(':checked')){
			$(".checkboxText").addClass("error");
			hasError = true;
		} else {
			$(".checkboxText").removeClass("error");
		}
		
			if($("#kortbetalning").css("display") == "block"){
				var pattern = /[0-9, ,!"#¤%&=?`´'*^¨~+|><-@£$€]/;
				
				//Validate cardOwner
				if (!$("#cardOwner").val() || $("#cardOwner").val() == " " || $("#cardOwner").val().match(pattern)){
					$("#cardOwner").next().fadeIn("fast");
					$("#cardOwner").addClass("hasError");
					hasError = true;
				} else {
					$("#cardOwner").next().fadeOut("fast");
					$("#cardOwner").removeClass("hasError");
				}
		
				//Validate cardNumber
				if(!$("#cardNumber").val() || $("#cardNumber").val() == " " || isNaN($("#cardNumber").val() / 1) == true){
					$("#cardNumber").next().fadeIn("fast");
					$("#cardNumber").addClass("hasError");
					hasError = true;
				} else {
					$("#cardNumber").next().fadeOut("fast");
					$("#cardNumber").removeClass("hasError");
				}
		
				//Validate cvc
				if(!$("#cvc").val() || $("#cvc").val() == " " || isNaN($("#cvc").val() / 1) == true){
					$("#cvc").next().fadeIn("fast");
					$("#cvc").addClass("hasError");
					hasError = true;
				} else {
					$("#cvc").next().fadeOut("fast");
					$("#cvc").removeClass("hasError");
				}
			}
			
			if($("#faktura").css("display") == "block"){
				//Validate ssn
				if(!$("#ssn").val() || $("#ssn").val() == " " || isNaN($("#ssn").val() / 1) == true || !$("#ssn").val().length == 12){
					$("#ssn").next().fadeIn("fast");
					$("#ssn").addClass("hasError");
					hasError = true;
				} else {
					$("#ssn").next().fadeOut("fast");
					$("#ssn").removeClass("hasError");
				}
			}
			
		if(hasError){
			return false;
		}
		else{
			return true;
		}
}