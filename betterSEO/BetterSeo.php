<?php

	# get correct id for plugin
	$thisfile=basename(__FILE__, ".php");
	
	# register plugin
	register_plugin(
		$thisfile, //Plugin id
		'BetterSEO', 	//Plugin name
		'1.0', 		//Plugin version
		'Mateusz Skrzypczak',  //Plugin author
		'https://paypal.me/multicol0r', //author website
		'Make Get Simple CMS SEO better!', //Plugin description
		'plugins', //page type - on which admin tab to display
		'betterSEO'  //main function (administration)
	);
	
	# activate filter 
	
	# add a link in the admin tab 'theme'
	add_action('plugins-sidebar','createSideMenu',[$thisfile, 'BetterSEO Settings']);
	
	# functions

	function get_seoheader($full=true) {


		///file

		$folder  = GSDATAOTHERPATH . '/betterSEO/';
			$geofile = $folder . 'geocheck.txt';
			$geocodefile = $folder . 'geocode.txt';
			$facebookcheckfile = $folder . 'facebookcheck.txt';

			$fbcustomfile = $folder . 'fbcustom.txt';
			$fbimagefile = $folder . 'fbimage.txt';


			$dublinfile = $folder . 'dublin.txt';
			$dublincheckfile = $folder . 'dublincheck.txt';
			$faviconfile = $folder . 'favicon.txt';

			$homepagetitlefile = $folder . 'homepagetitle.txt';

		///


		if(@file_get_contents($homepagetitlefile)==='normal'){

			if (return_page_slug()=='index'){$newSeoTitle = get_page_title($echo=false). ' | '.get_site_name($echo=false);}
			else {$newSeoTitle = get_page_title($echo=false). ' | '.get_site_name($echo=false); };

		}elseif(@file_get_contents($homepagetitlefile)==='titlefirst'){
			
			if (return_page_slug()=='index'){$newSeoTitle = get_site_name($echo=false). ' | '.get_page_title($echo=false);}
			else {$newSeoTitle = get_page_title($echo=false). ' | '.get_site_name($echo=false); };

		}elseif(@file_get_contents($homepagetitlefile)==='titleonly'){
			
			if (return_page_slug()=='index'){$newSeoTitle = get_site_name($echo=false);}
			else {$newSeoTitle = get_page_title($echo=false). ' | '.get_site_name($echo=false); };

		}




		$seo = '	
		<!-- Basic Header Needs
		================================================== -->
		<base href="'.get_site_url($echo=false ).'">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>'.$newSeoTitle.'</title>
		<meta name="description" content="'.get_page_meta_desc($echo=false).'">
		<meta name="robots" content="index, follow">
		<meta name="copyright" content="'.get_site_name($echo=false).'">
		<meta http-equiv="last-modified" content="'.get_page_date('D, j M Y G:i:s', $echo=false).' +0000">
		<link rel="canonical" href="'.get_page_url($echo=true).'">
		';

		if(file_get_contents($geofile)!==''){
		$seo .='
		<!-- GeoLocation Meta Tags / Geotagging. Used for custom results in Google. Generator here https://www.geo-tag.de/generator/en.html -->
		'.@file_get_contents($geocodefile);
		
		};

		if(file_get_contents($facebookcheckfile)!==''){

		$imageseo = '';

			if(@file_get_contents($fbcustomfile)==''){
            $imageseo = @file_get_contents($fbimagefile);
        }else{
            $content = @file_get_contents($fbcustomfile);
			$imageseo = return_custom_field($content) ;
        }

		$seo .='
		
		<!-- Facebook, more here https://ogp.me/ 
		=================================================== -->
		<meta property="og:type" content="article">
		<meta property="og:site_name" content="'.get_site_name($echo=false).'">
		<meta property="og:title" content="'.$newSeoTitle.'">
		<meta property="og:description" content="'.get_page_meta_desc($echo=false).'">
		<meta property="og:url" content="'.get_page_url($echo=true).'">
		<meta property="og:image" content="'.$imageseo.'">
		';

		};

		if(file_get_contents($dublincheckfile)!==''){

		$seo .='
		<!-- Dublin Core Metadata Element Set
		=================================================== -->
		<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
		<meta name="DC.Format" content="text/html" />
		<meta name="DC.Type" content="article" />
		<meta name="DC.Language" content="'.file_get_contents($dublinfile).'" />
		<meta name="DC.Title" content="'.get_page_clean_title($echo=false).'" />
		<meta name="DC.Creator" content="'.get_site_name($echo=false).'"/>
		<meta name="DC.Date" content="'.get_page_date('D, j M Y G:i:s',$echo=false).' +0000">
		';

		};

		if(file_get_contents($faviconfile)!==''){

		$seo .='
		<!-- Favicons. Generator here: https://www.favicon-generator.org/ 
		=================================================== -->
		<link rel="icon" type="image/png" sizes="36x36" href="'.get_theme_url($echo=false).'/fav/android-icon-36x36.png">
		<link rel="icon" type="image/png" sizes="48x48" href="'.get_theme_url($echo=false).'/fav/android-icon-48x48.png">
		<link rel="icon" type="image/png" sizes="72x72" href="'.get_theme_url($echo=false).'/fav/android-icon-72x72.png">
		<link rel="icon" type="image/png" sizes="96x96" href="'.get_theme_url($echo=false).'/fav/android-icon-96x96.png">
		<link rel="icon" type="image/png" sizes="144x144" href="'.get_theme_url($echo=false).'/fav/android-icon-144x144.png">
		<link rel="icon" type="image/png" sizes="192x192" href="'.get_theme_url($echo=false).'/fav/android-icon-192x192.png">
		
		<link rel="apple-touch-icon" sizes="192x192" href="'.get_theme_url($echo=false).'/fav/apple-icon.png">
		<link rel="apple-touch-icon" sizes="57x57" href="'.get_theme_url($echo=false).'/fav/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="'.get_theme_url($echo=false).'/fav/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="'.get_theme_url($echo=false).'/fav/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="'.get_theme_url($echo=false).'/fav/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="'.get_theme_url($echo=false).'/fav/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="'.get_theme_url($echo=false).'/fav/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="'.get_theme_url($echo=false).'/fav/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="'.get_theme_url($echo=false).'/fav/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="'.get_theme_url($echo=false).'/fav/apple-icon-180x180.png">
		<link rel="apple-touch-icon" sizes="192x192" href="'.get_theme_url($echo=false).'/fav/apple-icon-precomposed.png">
		
		<link rel="shortcut icon" type="image/x-icon" href="'.get_theme_url($echo=false).'/fav/favicon.ico" />
		<link rel="icon" type="image/png" sizes="16x16" href="'.get_theme_url($echo=false).'/fav/favicon-16x16.png">
		<link rel="icon" type="image/png" sizes="32x32" href="'.get_theme_url($echo=false).'/fav/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="'.get_theme_url($echo=false).'/fav/favicon-96x96.png">
		
		<meta name="msapplication-TileImage" content="'.get_theme_url($echo=false).'/fav/ms-icon-70x70.png">
		<meta name="msapplication-TileImage" content="'.get_theme_url($echo=false).'/fav/ms-icon-144x144.png">
		<meta name="msapplication-TileImage" content="'.get_theme_url($echo=false).'/fav/ms-icon-150x150.png">
		<meta name="msapplication-TileImage" content="'.get_theme_url($echo=false).'/fav/ms-icon-310x310.png">
		
		<meta name="msapplication-config" content="'.get_theme_url($echo=false).'/fav/browserconfig.xml" />
		<meta name="msapplication-TileColor" content="#ffffff">
		<link rel="manifest" href="'.get_theme_url($echo=false).'/fav/manifest.json">
		<meta name="theme-color" content="#ffffff">
		';

		};

		echo $seo;

			// script queue
			get_scripts_frontend();
			
			exec_action('theme-header');
		}
	
	function betterSEO(){

		///file
 
		$folder  = GSDATAOTHERPATH . '/betterSEO/';
			$geofile = $folder . 'geocheck.txt';
			$geocodefile = $folder . 'geocode.txt';
			$facebookcheckfile = $folder . 'facebookcheck.txt';

			$fbcustomfile = $folder . 'fbcustom.txt';
			$fbimagefile = $folder . 'fbimage.txt';


			$dublinfile = $folder . 'dublin.txt';
			$dublincheckfile = $folder . 'dublincheck.txt';
			$faviconfile = $folder . 'favicon.txt';

			$homepagetitlefile = $folder . 'homepagetitle.txt';

		///

		$html = '
		<style>
			.seoguy{
				background:#fafafa;
				border:solid 1px #ddd;
				padding:20px;
				box-sizing:border-box;
				display:block;
				width:100%;
			}

			.seoguy p{
				margin:0;
				margin-bottom:10px;
				margin-top:10px;
			}

			.seoguy hr{
				border:none;
				border-bottom:dotted 1px rgba(0,0,0,0.6);
				margin:20px 0;
			}

			.seoguy textarea,input{
				border:solid 1px rgba(0,0,0,0.3);
				border-bottom:solid 3px green;
			}

			.seoguy textarea{
				box-sizing:border-box;
				width:100%;
			}
			
			.checkbox-circle{
				width:15px;
				height:15px;
				background:#fff;
				display:block;
				border-radius:50%;
				transition:all 250ms linear;
			}

			.seoguy input[type="checkbox"]  + .checkbox{
			
				width:60px;
				height:25px;
				border-radius:15px;
				background:red;
				display:block;
				padding:5px;
				box-sizing:border-box;
				margin-bottom:10px;
			}

			.seoguy input[type="checkbox"]:checked + .checkbox{
				content:"sd";
				background:green;
				display:block;
			}

			input[type="checkbox"]:checked + .checkbox .checkbox-circle{
				margin-left:35px;
			}

			.seoguy input[type="checkbox"]{
				display:none;

			}

			 .leader{
				font-size:0.9rem;
				font-style:italic;
				color:rgba(0,0,0,0.6);
			}

			.seoguy h3{
				margin:0;
			}

			.seoguy .submit{
				width:200px;
				height:40px;
				display:block;
				padding:10px;
				text-align:center;
				margin-top:20px;
			}

			.tab{
				width:100%;
				height:50px;
				border-bottom:solid 1px #ddd;
				display:flex;
				margin-bottom:20px;
			}

			.tab-item{
				width:100px;
				height:50px;
				display:flex;
				align-items:center;
				justify-content:center;
				cursor:pointer;
			}

			.tab-item-active{
				border:solid 1px #ddd;
				border-bottom:solid 1px #fff;	
			}

			.tab-item p{
				margin:0;
				padding-bottom:5px;
			}

			.tab-item-active p{
				border-bottom:solid 3px green;	
			}

			.seocode{background:#fafafa;color:rgba(0,0,0,0.8);width:100%;border:solid 1px #ddd;display:block;padding:15px;box-sizing:border-box;border-left:solid 5px green;font-style:italic;}


			.ul-linker{
list-style-type:none;
margin:0 !important;
padding:0;


			}

			.ul-linker li{
				padding:10px;border-bottom:solid 1px #ddd;
			}

			.ul-linker li:nth-child(2n){
				background:#fafafa;
			}

			.seoguy-select{
				width:100%;
				padding:10px;
				border:solid 1px rgba(0,0,0,0.3);
background:#fff;
margin-top:10px;
 border-bottom:solid 3px green;

			}

		</style>

		<h3 style="font-weight:bold;font-style:italic;font-size:1.3rem;">Better Seo Plugin</h3>

		<div class="tab">

			<div class="tab-item tab-item-active"><p>Setup</p></div>
			<div class="tab-item"><p>Help</p></div>

		</div>

		<div class="tab-content-1">
		
			<form method="post" class="seoguy">
			
			<h3>Homepage Title</h3>

			<select name="homepagetitle" class="seoguy-select">
			<option value="normal">Normal</option>
			<option value="titlefirst">Website Name | Page Title</option>
			<option value="titleonly">Only Website Name</option>

			</select>

			<hr>

			<h3>GeoLocation</h3>

			<p class="leader">GeoLocation (Visit generator  <a target="_blank" href="https://www.geo-tag.de/generator/en.html">here</a>.)</p>

			<label >
				<input type="checkbox" name="geocheck">

				<div class="checkbox">
					<span class="checkbox-circle"></span>
				</div>
			</label>

			<textarea name="geocode" style="height:150px">'.@file_get_contents($geocodefile).'</textarea>
			
			<hr>
			<h3 style="margin-top:20px;">Facebook</h3>
			<p class="leader">og:image (for FB etc.)</p>
		
			<label >
				<input type="checkbox" name="facebookcheck">

				<div class="checkbox">
					<span class="checkbox-circle"></span>
				</div>

			</label>

			<p>custom_field name (requires I18N Custom Fields plugin): </p>
			<input type="text" name="fbcustom" value="'.@file_get_contents($fbcustomfile).'" style="width:100%;padding:10px;box-sizing:border-box;"  >
			 </p>
			<p> or Static image:</p>
			<input type="text" style="width:100%;padding:10px;box-sizing:border-box;" name="fbimage" value="'.file_get_contents($fbimagefile).'" placeholder="place url image">
			<br>
			<hr>
			<br>
			
			<h3>Dublin Core</h3>
			<p class="leader">Metadata Element Set</p>
			
			<label >
				<input type="checkbox" name="dublincheck">

				<div class="checkbox">
					<span class="checkbox-circle"></span>
				</div>
			</label>

			<p>Lang. code:</p>
			<input type="text" style="width:100%;padding:10px;box-sizing:border-box;" name="dublin" placeholder="en" value="'.@file_get_contents($dublinfile).'">

			<hr>

			<h3 style="margin-top:20px;"> Favicons</h3>
			<p class="leader"> Favicons (icons need to be included in a folder named "fav" within your themes dir.)</p>

			<label >
				<input type="checkbox" name="favicon">

				<div class="checkbox">
					<span class="checkbox-circle"></span>
				</div>
			</label>

			<hr>

			<input type="submit" name="submit" class="submit" value="Save Settings">
			</form>

		</div>

		<div class="tab-content-2">

			<h3>How to use it?</h3>

			<p class="leader">To install, include (if your template use get_header() replace to this function) </p>

			<code class="seocode"> &#60;?php  get_seoheader();?&#62; </code>

			<p style="margin:10px 0;" class="leader">before</p>
			<code class="seocode"> &#60;/head&#62; </code>

			<br>
			<br>

			<h3>More Info:</h4>

			<ul class="leader ul-linker">	
				<li>GeoLocation Meta Tags / Geotagging. Used for custom results in Google. Generator <a href="https://www.geo-tag.de/generator/en.html" target="_blank">here.</a></li>
				<li>Open Graph protocol, more info <a href="https://ogp.me/" target="_blank">here.</a></li>
				<li>Dublin Core Metadata, more info <a href="http://purl.org/dc/elements/1.1/" target="_blank">here.</a></li>
				<li>Favicons. Generator <a href="https://www.favicon-generator.org/" target="_blank">here.</a></li>
			</ul>

		</div>

		<script>
		document.querySelector(".tab-content-2").style.display="none";

		document.querySelectorAll(".tab-item")[0].addEventListener("click",(e)=>{

			e.preventDefault();

			document.querySelectorAll(".tab-item").forEach(x=>{x.classList.remove("tab-item-active")});
			document.querySelectorAll(".tab-item")[0].classList.add("tab-item-active");
			document.querySelector(".tab-content-1").style.display="block";

			document.querySelector(".tab-content-2").style.display="none";

		});

		document.querySelectorAll(".tab-item")[1].addEventListener("click",(e)=>{

			e.preventDefault();

			document.querySelectorAll(".tab-item").forEach(x=>{x.classList.remove("tab-item-active")});
			document.querySelectorAll(".tab-item")[1].classList.add("tab-item-active");
			document.querySelector(".tab-content-1").style.display="none";
			document.querySelector(".tab-content-2").style.display="block";

		});


		if("'.@file_get_contents($homepagetitlefile).'"!==""){

			document.querySelector(".seoguy-select").value = "'.@file_get_contents($homepagetitlefile).'"

		}


		if("'.@file_get_contents($geofile).'"=="on"){
			document.querySelector(`input[name="geocheck"]`).checked = true;
		}else{
			document.querySelector(`input[name="geocheck"]`).checked = false;

		}

		if("'.@file_get_contents($facebookcheckfile).'"=="on"){
			document.querySelector(`input[name="facebookcheck"]`).checked = true;
		}else{
			document.querySelector(`input[name="facebookcheck"]`).checked = false;

		}

		if("'.@file_get_contents($dublincheckfile).'"=="on"){
			document.querySelector(`input[name="dublincheck"]`).checked = true;
		}else{
			document.querySelector(`input[name="dublincheck"]`).checked = false;
		}

		if("'.@file_get_contents($faviconfile).'"=="on"){
			document.querySelector(`input[name="favicon"]`).checked = true;
		}else{
			document.querySelector(`input[name="favicon"]`).checked = false;
		}

		</script>
		
		<div style="padding:20px;text-align:center;box-sizing:border-box;background:#C21010;color:#fff;margin-top:20px;" id="paypal">

			<p>If you want support my work, and you want to see new plugins:) </p>

			<a href="https://www.paypal.com/donate/?hosted_button_id=TW6PXVCTM5A72">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"  />
			</a>

			
			<p style="margin:0;padding:0;margin-top:10px;">Special thanks for support and give me ideas for new plugins @Islander </p>
		</div>
		';
		
		echo $html;

		if(isset($_POST['submit'])){

			$geocheck = $_POST['geocheck'];
			$geocode = $_POST['geocode'];
			$facebookcheck = $_POST['facebookcheck'];
			
			$fbcustom = $_POST['fbcustom'];
			$fbimage = $_POST['fbimage'];
			$dublincheck = $_POST['dublincheck'];
			$dublin = $_POST['dublin'];
			$faviconcheck = $_POST['favicon'];

			$homepagetitle = $_POST['homepagetitle'];

			


 
			// Set up the folder name and its permissions
			// Note the constant GSDATAOTHERPATH, which points to /path/to/getsimple/data/other/
			$folder  = GSDATAOTHERPATH . '/betterSEO/';
			$geofile = $folder . 'geocheck.txt';
			$geocodefile = $folder . 'geocode.txt';
			$facebookcheckfile = $folder . 'facebookcheck.txt';

			$fbcustomfile = $folder . 'fbcustom.txt';
			$fbimagefile = $folder . 'fbimage.txt';


			$dublinfile = $folder . 'dublin.txt';
			$dublincheckfile = $folder . 'dublincheck.txt';
			$faviconfile = $folder . 'favicon.txt';

			$homepagetitlefile = $folder . 'homepagetitle.txt';


			$chmod_mode    = 0755;
			$folder_exists = file_exists($folder) || mkdir($folder, $chmod_mode);
			 
			// Save the file (assuming that the folder indeed exists)
			if ($folder_exists) {
			  file_put_contents($geofile, $geocheck);
			  file_put_contents($geocodefile, $geocode);
			  file_put_contents($facebookcheckfile, $facebookcheck);
			  
			  file_put_contents($fbcustomfile, $fbcustom);
			  file_put_contents($fbimagefile , $fbimage);

			  file_put_contents($dublinfile, $dublin);
			  file_put_contents($dublincheckfile , $dublincheck);
			  file_put_contents($faviconfile , $faviconcheck);

			  file_put_contents($homepagetitlefile , $homepagetitle );

			}

			echo("<meta http-equiv='refresh' content='0'>");

		}

	}
?>
