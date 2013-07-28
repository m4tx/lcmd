/*
* js file for loading information of searched language
* @author - Harsh Kothari (harshkothari410@gmail.com)
* @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
* global $:false (for jshint)
*/
/*global $:false */
$(function () {
	"use strict";
	//Load switch js and css
	$('.switch').bootstrapSwitch();

	//Load Toottip of edit button
	$('.edit').tooltip();

	//Use of typehead plugin for searching + suggestion facility
	$('#input').typeahead ({
		source : function ( query, process ){
			$.ajax({
				url: 'lib/langsearchshow.php',
				type: 'POST',
				dataType: 'json',
				data: 'query=' + query,
				complete: function(xhr, textStatus) {
					//called when complete
				},
				success: function(data, textStatus, xhr) {
					//called when successful
					//$('#input').val(data[0]).addClass("muted");
					process(data);
				},
				error: function(xhr, textStatus, errorThrown) {
					//called when there is an error
					console.log( errorThrown );
				}
			});
		},

		updater : function (lang) {
			hideDataAnimation();
			languageDetail( lang );
			return lang;
		}
	});

	//Call when state of switch is changed
	$('.switch').on('switch-change', function (e, data) {
		switching(data);
	});

	//Call when press the edit button
	$('.edit').click(function(){
		var $this = $(this);
		modelShow($this);
	});

	//Call when save button clicked on model
	$('#save').click(function(){
		var $this = $(this);
		dataChange($this);
	});
});

/*
* Function : hideDataAnimation
* function to hide title with smooth animation 
*/
function hideDataAnimation () {
	$('#title').slideUp('slow');
	$('#slideright').animate({
		marginLeft : '-600px',
	},'slow');
	$('#slideleft').animate({
		marginRight : '-600px',
		marginTop : '-60px'
	},'slow');
	$('#legend').hide();
}

/*
* Function : languageDetail
* Function for ajax call to fetch data from database for seleceted language
* input : language name
* output : fillData function call with response data
*/
function languageDetail(lang){
	var returnData;
	$.ajax({
		url: 'lib/langsearchajax.php',
		type: 'POST',
		dataType: 'json',
		data: 'query=' + lang,
		complete: function(xhr, textStatus) {
			//called when complete
		},
		success: function(data, textStatus, xhr) {
			//called when successful
			fillData(data);
		},
		error: function(xhr, textStatus, errorThrown) {
			//called when there is an error
		}
	});
	return returnData;	
}

/*
* Function : fillData
* Function to fill data for showing to user 
* input : language data 
* output : fill the data with appropriate field
* fill the data of font detail + ime detail from json mapping
*/
function fillData(data) {
	console.log(data);
	var $this;
	var langdetail_var = ["langcode_iso", "langcode_wmf", "langname_eng", "langname_autonym", "langname_html", "macro_lang", "wmf_proj_status", "fallback_code", "narayam", "jquery_ime", "webfonts", "jquery_webfonts", "i18n_mw_core", "jquery_i18n", "jquery_uls", "translate", "dictionary", "spellchecker", "glossary" ,"f_or_i"];
	for (var i = 0; i < data.length; i++) {
		//console.log(langdetail_var[i]);
		if(data[i] === '0' || data[i] === '1' ){
			if (data[i] === '1') {
				$this = $('[id=' + langdetail_var[i]+']');
				$this.html('<i class="icon-ok"></i>');
				$this.attr('value','yes');
				$this.siblings('.switch').bootstrapSwitch('setState',true);
			}
			else {
				$this = $('[id=' + langdetail_var[i]+']');
				$this.html('<i class="icon-remove"></i>');
				$this.attr('value','no');
				$this.siblings('.switch').bootstrapSwitch('setState',false);
			}
		}
		else{
			$('#' + langdetail_var[i]).text(data[i]);
		}
	}

	$('#moreinfo').text('More info on '+ data[2]); //data[2] => language name in english

	//Fill the font information
	$.getJSON('data/langtofontmap.json', function(json, textStatus) {
		//optional stuff to do after success
		if (json[data[1]] !== undefined) {
			var appendData = '';
			for(var i = 0 ; i < json[data[1]].length ; i++)
				appendData = appendData + '<li>' + json[data[1]][i] + '</li>';
			$('#fontdetail').html(appendData);
		}
		else {
			$('#fontdetail').text('No Font is available');
		}
	});

	//Fill the detail of input method information
	$.getJSON('data/langtoimemap.json', function(json, textStatus) {
		//optional stuff to do after success
		if (json[data[1]] !== undefined) {
			var appendData = '';
			for(var i = 0 ; i < json[data[1]].inputmethods.length ; i++)
				appendData = appendData + '<li>' + json[data[1]].inputmethods[i] + '</li>';
			$('#imedetail').html(appendData);
		}
		else {
			$('#imedetail').text('No IME is available');
		}
	});	
}

/*
* Function : switching
* This function will call when state of switch is changed
* input : object that contains DOM + event details of which switch is changed
* output : change the state of switch + change the value of that detail
* ajax connection is remaining for altering that detail into database
*/
function switching(data){
	var $this = $(data.el); //data.el => DOM (checkbox)
	var value = data.value;
	var $valdiv = $this.parent().parent().siblings('.iconshow');
	var val = $valdiv.attr('value');
	if(value === false){
		$valdiv.attr('value','no');
		$valdiv.children().removeClass('icon-ok').addClass('icon-remove');
	}
	else{
		$valdiv.attr('value','yes');
		$valdiv.children().removeClass('icon-remove').addClass('icon-ok');
	}
}

/*
* Function : modelShow 
* This function is called when click on edit button
* input : DOM of that button
* output : Model show with data feeling
*/
function modelShow(clickedDom){
	var $this = clickedDom;
	$('#myModal').modal('show'); //Model will appear
	var $divkey = $this.siblings('.span6');
	var $divvalue = $this.siblings('.span4');
	$('#oldname').html("Current value of "+$divkey.text() + " : <span style='color:red;'> <b>" + $divvalue.text()+ "</b></span>");
	$('#newvalue').text('New value of ' + $divkey.text());
	$('#myModalLabel').text($divkey.text());
	$('#save').attr('id',$divvalue.attr('id'));
}

/*
* Function : dataChange
* input : DOM of that save button ; need ID for further changes
* output : Model hide  + change the value 
* ajax connection is remaining for altering that detail into database
*/
function dataChange(clickedDom){
	var $this = clickedDom;
	$('#myModal').modal('hide'); // Model Hide
	var newid = $this.attr('id');
	var newVal = $('#changeval').val();
	$('#'+newid).text(newVal);
	$('#changeval').val(null);
	alertShow(newid,0); //This should be called after ajax success or fail
}

/* 
* Function : alertShow
* input : dataFiled of which data is changed and result (1 or 0)
* output : alert
* Required to call after ajax success or fail
*/
function alertShow(dataField,result){
	$('#alertshow').addClass('alert');
	if (result) {
		$('#alertshow').addClass('alert-success');
		$('#alertshow').text('The value of ' + dataField + ' is changed successfully.' ).hide();
		$('#alertshow').slideDown('slow').delay(3000).slideUp('slow');
	}
	else{
		$('#alertshow').addClass('alert-error');
		$('#alertshow').text('The value of ' + dataField + ' is not changed successfully.' ).hide();
		$('#alertshow').slideDown('slow').delay(3000).slideUp('slow');
	}
}