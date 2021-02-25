
$("document").ready(function(){
		
	/**validation**/
	
	
	$("#register-form input:not([type='submit']), #register-form select").on("blur",function(e){
		toValidate($(this));
		
		var form = $("#register-form")[0];
        var isValid = form.checkValidity();
        if (!isValid) {
			$("#register-form input[type='submit']").prop('disabled', 'disabled');
            e.preventDefault();
            e.stopPropagation();
        }
		else
		{
			$("#register-form input[type='submit']").prop('disabled', false);
		}
	});
	
	$("#register-form").on("submit",function(e){
		////let inputs = $(this).children().children("input:not([type='submit'])");
		//let inputs = $(this).find("input:not([type='submit'])");
		//toValidate(inputs);
		var form = $("#register-form")[0];
        var isValid = form.checkValidity();
        if (!isValid) {
            e.preventDefault();
            e.stopPropagation();
        }
		form.classList.add('was-validated');
        //return false; 
		
	});
	
	
	function toValidate(el)
	{
		if(!validate(el))
		{
			el.removeClass('is-valid').addClass('is-invalid');
			if(el.attr("name") == "gender")
			{
				$("input[name=gender]").removeClass('is-valid').addClass('is-invalid');
			}
			return false;
		}
		else
		{
			el.removeClass('is-invalid').addClass('is-valid');
			return true;
		}
	}
	
	
	
	function validate(el)
	{
		//console.log(el.attr("name"));
		if(el.attr("name") == "name_ar")
		{
			if(el.val().trim().match(/^[\u0621-\u064A ]+$/) == null)//only arabic letters
				return false;
		}
		else if(el.attr("name") == "name_en")
		{
			if(el.val().trim().match(/^[a-zA-Z ]+$/) == null)
				return false;
		}
		else if(el.attr("name") == "email")
		{
			if(el.val().trim().match(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/) == null)
				return false;
		}
		else if(el.attr("name") == "country" || el.attr("name") == "state" || el.attr("name") == "city")
		{
			if(el.val().trim() == "")
				return false;
		}
		else if(el.attr("name") == "address")
		{
			if(el.val().trim().match(/^([\u0621-\u064A0-9\-, ]{3,})|([a-zA-Z0-9\-, ]{3,})+$/) == null)
				return false;
		}
		else if(el.attr("name") == "phone")
		{
			if(el.val().trim().match(/^\+?\d{10,}$/) == null)
				return false;
		}
		else if(el.attr("name") == "gender")
		{
			if(!el.prop("checked"))
				return false;
		}
		else if(el.attr("name") == "password")
		{
			if(el.val().trim().length < 8 )
				return false;
		}
		else if(el.attr("name") == "confirm-password")
		{
			if(el.val().trim().length < 8)
				return false;
			if(el.val().trim() != $("#register-form input[name='password']").val().trim())
				return false;
		}
		else if(el.attr("name") == "agree")
		{
			if(!el.is(":checked"))
				return false;
		}
		else if(el.has("required").val() == "")
		{
			return false;
		}
			
		return true;
	}
	$(document).on('change', "input[type='checkbox'], input[type='radio']", function() 
	{
		if(this.checked) 
		{
			$(this).removeClass('is-invalid').addClass('is-valid');
			if($(this).attr("name") == "gender")
			{
				$("input[name=gender]").removeClass('is-invalid').addClass('is-valid');
			}
		}
	});
	$(document).on('change', " select", function() 
	{
		if($(this).val().trim() != "")
		{
			$(this).removeClass('is-invalid').addClass('is-valid');
		}
		else
		{
			$(this).removeClass('is-valid').addClass('is-invalid');
		}
	});

	/** countries governates cities ***/
	  function getAJAX(url)
	  {
		var results;
		$.ajax
		  ({
		  type: 'GET',
		  url: url,
		  dataType: 'json',
		  data: {},
		  async:false, //stop untill the ajax request done
		  success: function (data)
		  {
			console.log(data);
			results = data;
		  },
		  error:function(data)
		  {
			console.log(data);
			results = data;
		  }
		  });
		//console.log(results);
		return results;
	  }

	  var language= $("html").attr("lang"); //get language from html set lang="en" or lang ="ar" if you don't set it
	  
		/** countries **/
	  var conutriesURL = 'http://api.geonames.org/countryInfoJSON?q=&country=&lang='+language+'&username=abdulnaser_mohsen'; //url that get your conuntries
	  var countries = getAJAX(conutriesURL); // the importance of async test without aync or aync is true
	  //console.log(countries);
	  //console.log(countries.geonames);
	  $(countries.geonames).each(function(index,item){
		//console.log(item.countryName , item.geonameId);
		var selectOption = $("<option>")
		selectOption.attr("value",item.geonameId).append(item.countryName);
		$('.countryId').append(selectOption);
	  });
	  
		/** states **/
	  $(document).on("change",".countryId",function(){
		//console.log($('.stateId').eq($('.countryId').index($(this))));
		var stateElement = $('.stateId').eq($('.countryId').index($(this)));
		//$('.stateId option:not(option:first)').eq($('.countryId').index($(this))).remove();
		$('.stateId option:not(option:first)').remove(); // clear states
		$('.cityId option:not(option:first)').remove(); //clear cities
		$('.stateId').removeClass('is-valid'); // clear validation
		$('.cityId ').removeClass('is-valid'); //clear validation
		var geonameid= $(this).val(); //get country id
		var statesURL = 'http://api.geonames.org/childrenJSON?lang='+language+'&geonameId='+geonameid+'&username=abdulnaser_mohsen'; //url that get your states
		
		var states = getAJAX(statesURL); 
		//console.log(states);
		//console.log(states.geonames);
		
		$(states.geonames).each(function(index,item){
		  //console.log(item.name , item.geonameId);
		  var selectOption = $("<option>")
		  selectOption.attr("value",item.geonameId).append(item.name);
		  $(stateElement).append(selectOption);
		  //$('.stateId').append(selectOption);
		});
	  });
	  
	  $(document).on("change",".stateId",function(){
		var cityElement = $('.cityId').eq($('.stateId').index($(this)));
		//$('.cityId option:not(option:first)').eq($('.stateId').index($(this))).remove();
		
		$('.cityId option:not(option:first)').remove(); // clear cities
		$('.cityId ').removeClass('is-valid'); //clear validation
		
		var geonameid= $(this).val(); //get country id
		var citiesURL = 'http://api.geonames.org/childrenJSON?lang='+language+'&geonameId='+geonameid+'&username=abdulnaser_mohsen'; //url that get your cities
		
		var cities = getAJAX(citiesURL); 
		//console.log(cities);
		//console.log(cities.geonames);
		
		$(cities.geonames).each(function(index,item){
		  //console.log(item.name , item.geonameId);
		  var selectOption = $("<option>")
		  selectOption.attr("value",item.geonameId).append(item.name);
		  $(cityElement).append(selectOption);
		  //$('.cityId').append(selectOption);
		});
	  });
	  
    
});

