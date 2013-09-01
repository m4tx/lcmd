<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta http-equiv="content-type" content="text-html; charset=utf-8">	
	<meta charset="utf-8">
	<meta name="author" content="Harsh Kothari">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="screen">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-switch.css">
	<link rel="stylesheet" type="text/css" href="css/boxed.css">
	<link rel="stylesheet" type="text/css" href="jquery.ime/css/jquery.ime.css"/>
	<link rel="stylesheet" type="text/css" href="css/example.css">
	
	<script type="text/javascript" src="js/hogan.js"></script>
	<script type="text/javascript" src="js/jquery-1.10.2-min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-switch.js"></script>
	<script type="text/javascript" src="jquery.ime/src/jquery.ime.js"></script>
	<script type="text/javascript" src="jquery.ime/src/jquery.ime.selector.js"></script>
	<script type="text/javascript" src="jquery.ime/src/jquery.ime.preferences.js"></script>
	<script typpe="text/javascript" src="jquery.ime/src/jquery.ime.inputmethods.js"></script>
	<script type="text/javascript" src="js/typeahead.js"></script>
	<script type="text/javascript" src="js/langlist.js"></script>
	<script type="text/javascript" src="js/filter.js"></script>

</head>

<body>
	<?php
		if(isset($_SESSION['username'])){
			include "lib/header-wrap-with-login.php";
		}
		else{
			include "lib/header-wrap-without-login.php";
		}
	?>

	<div class='well'>
		<div class='row-fluid'>
			<div class='span4' id=''>
			</div>
		</div>
	</div>
<div class="container-fluid">
	<div class='row-fluid'>


		<div class='alert span3 alert-success ' id="filterLabel" align='center' style='display:none'>
			Active Filters
		</div>

		<div class='span9' id="filtershow">

		</div>
</div>
</div>
	<div class='container-fluid'>
	<div class='row-fluid'>
	<div class='span3'>
		<div class="accordion span12" id="accordion2">

					<!-- Heading 1 -->
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#">
								Universal Language Selector
							</a>
						</div>
						<div id="uls" class="accordion-body collapse in">
							<div class="accordion-inner">						
								<label class="checkbox inline">
									<input type="checkbox" id="webfonts" value="webfonts"> webfonts
								</label>
							</div>

							<div class="accordion-inner">
								<label class="checkbox inline">
									<input type="checkbox" id="jquery_ime" value="jquery_ime"> Input Methods
								</label>
							</div>

							<div class="accordion-inner">
								<label class="checkbox inline">
									<input type="checkbox" id="jquery_uls" value="jquery_uls"> Internationalization Support
								</label>
							</div>
						</div>
					</div>
		

					<!-- Heading 2 -->
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#">
								Project Milkshake
							</a>
						</div>
						<div id="" class="accordion-body collapse in">
							<div class="accordion-inner">						
								<label class="checkbox inline">
									<input type="checkbox" id="jquery_ime" value="jquery_ime"> Input Method Library
								</label>
							</div>

							<div class="accordion-inner">
								<label class="checkbox inline">
									<input type="checkbox" id="jquery_webfonts" value="jquery_webfonts"> Webfont Library
								</label>
							</div>

							<div class="accordion-inner">
								<label class="checkbox inline">
									<input type="checkbox" id="jquery_i18n" value="jquery_i18n"> i18n Library
								</label>
							</div>

							<div class="accordion-inner">
								<label class="checkbox inline">
									<input type="checkbox" id="jquery_uls" value="jquery_uls"> ULS Library
								</label>
							</div>
						</div>
					</div>

					<!-- Heading 3 -->
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#">
								Legacy Extension
							</a>
						</div>
						<div id="" class="accordion-body collapse in">
							<div class="accordion-inner">						
								<label class="checkbox inline">
									<input type="checkbox" id="narayam" value="narayam"> Narayam
								</label>
							</div>

							<div class="accordion-inner">
								<label class="checkbox inline">
									<input type="checkbox" id="webfonts" value="webfonts"> Webfonts
								</label>
							</div>
						</div>
					</div>


				</div>
		</div>
<!--
		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="jquery_ime" value="jquery_ime"> jquery.ime
		</label>
		</div>
		
		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="webfonts" value="webfonts"> Webfonts
		</label>
		</div>
		
		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="jquery_webfonts" value="jquery_webfonts"> jquery.webfonts
		</label>
		</div>

		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="i18n_mw_core" value="i18n_mw_core"> i18n mw core
		</label>
		</div>

		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="jquery_i18n" value="jquery_i18n"> jquery.i18n
		</label>
		</div>

		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="jquery_uls" value="jquery_uls"> jquery.uls
		</label>
		</div>

		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="translate" value="translate"> Translate
		</label>
		</div>

		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="dictionary" value="dictionary"> Dictionary
		</label>
		</div>

		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="spellchecker" value="spellchecker"> Spellchecker
		</label>
		</div>

		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="glossary" value="glossary"> Glossary
		</label>
		</div>

		<div class='control-group'>
		<label class="checkbox inline">
  			<input type="checkbox" id="f_or_i" value="f_or_i"> Feature
		</label>
		</div>
	</div>
-->


	<div class='span6' id=''>
		<div id="loader" align="center">
			<img src="img/ajax-loader.gif" align="center">
		</div>
		<div class="row-fluid" id="data">
			<table class='table table-striped table-bordered' id='langlist'>
			</table>
		</div>
	</div>

	<div class="span3 row-fluid">
		<div class="span12 well">
			<div class='span4' id='langcount'>
			</div>
		</div>
		<div class="span12 well">
			Preview detail
		</div>
		<div class="span12 well">
			<div>
				Languages with projects
			</div>
			<div>
				Languages in incubator
			</div>
			<div>
				Languages with webfonts
			</div>
			<div>
				Languages with Input Methods
			</div>	
		</div>
	</div>
	</div>
</div>
<!--
	<script type="text/javascript">
	$(function(){
		$('td').click(function(){
			$this = $(this);
			var lang = $this.children().children(".span8").children(".text-info").text();
			console.log(lang);
			window.location.href = 'language.php?'+lang;
		})
		})
	</script>
-->
</body>
</html>