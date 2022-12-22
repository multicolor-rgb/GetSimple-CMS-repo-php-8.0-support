<?php error_reporting (E_ALL ^ E_NOTICE); ?>

<?php  $massiveHiddenSection = GSDATAOTHERPATH . '/massiveHiddenSection/';
 $filejson ='userhidden.json';
 $finaljson = $massiveHiddenSection.$filejson;

    $datee = @file_get_contents( $finaljson);
    $data = json_decode($datee);
 

	

	$folder2        = GSDATAOTHERPATH . '/massiveMenuExt/';
$filename2     = $folder2 . 'menuext.json';
  $datee2 = @file_get_contents($filename2);
$data2 = json_decode($datee2,true);





;?>


			
			<style>
					@import url("https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap");
					@import url("https://unicons.iconscout.com/release/v2.1.9/css/unicons.css");
					body{
						padding-top:38px;
					}
					.m-toper{
						font-family: "Lato", sans-serif;
						position:fixed;
						top:0;
						left:0;
						width:100%;
						height:38px;
						background:#111;
						z-index:999;
					}
					.m-toper ul{
						margin:0;
						padding:10px 0;
					}
					.massivepages,.massiveedit{
						padding:10px 0;
						display:flex;
						list-style-type:none;
					}
					.massivepages li a,.massiveedit li a{
						color:#fff;
						margin-left:15px;
						text-decoration:none;
						font-size:0.9rem;
						transition:all 250ms linear;
					}
						.massivepages li a:hover,.massiveedit li a:hover{
						opacity:0.8;
					}
					.m-toper-container{
						width:96%;
						margin:0 auto;
						max-width:1240px;
						display:flex;
						justify-content:space-between;
					}
					@media(max-width:768px){
						.massivepages{display:none}
						.massiveedit{
							width:100%;
							margin:0 auto;
							justify-content:center;
						}
						.massiveedit li{
							margin-right:15px;
						}
					}
					.maintenceOn{
						display:none !important;
					}
				</style>

		
				<div class="m-toper">
					<div class="m-toper-container">
						<ul class="massiveedit">
							<li><a href="<?php get_site_url();?>admin/edit.php?id=<?php echo get_page_slug();?>"><i class="uil uil-edit"></i><?php echo i18n('EDITPAGE_TITLE');?></a></li>
							<li><a href="<?php get_site_url();?>admin/edit.php"><i class="uil uil-plus-circle"></i> <?php echo i18n('SIDE_CREATE_NEW');?></a></li> 
						</ul>
					
						<ul class="massivepages">
							<li id="nav_pages"><a href="<?php get_site_url();?>admin/pages.php"><i class="uil uil-desktop"></i><?php echo i18n('TAB_PAGES') ;?> </a></li> 
							<li id="nav_upload"><a href="<?php get_site_url();?>admin/upload.php"><i class="uil uil-file"></i><?php echo i18n('TAB_FILES');?></a></li> 
							<li id="nav_theme"><a href="<?php get_site_url();?>admin/theme.php"><i class="uil uil-paint-tool"></i><?php echo i18n('TAB_THEME');?></a></li> 
							<li id="nav_backups"><a href="<?php get_site_url();?>admin/backups.php"><i class="uil uil-save"></i> <?php echo i18n('TAB_BACKUPS');?></a></li> 
							<li id="nav_plugins"><a href="<?php get_site_url();?>admin/plugins.php"><i class="uil uil-plug"></i><?php i18n('PLUGINS_NAV');?></a></li> 
						
							<?php 

if(file_exists($filename2)){

	foreach($data2 as $query){
	
	echo '<li><a href="'.$query["url"].'" target="'.$query["linkblank"].'"><i class="'.$query["icon"].'"></i> '.$query["name"].'</a></li>';
	
	};
	
	};
	?>
						
							<li> <a href="<?php get_site_url();?>admin/settings.php"><i class="uil uil-setting"></i></a> 
 					<li><a href="<?php get_site_url();?>admin/logout.php"><i class="uil uil-power"></i></a>
					</ul>


					</div>
				</div>


				<script>


if(document.querySelector("#nav_pages")!==null){
if('<?php echo $data->hidepages;?>' == "hide"){document.querySelector("#nav_pages").remove()};
};

if(document.querySelector("#nav_upload")!==null){
if('<?php echo $data->hidefiles;?>' == "hide"){document.querySelector("#nav_upload").remove()};
};

if(document.querySelector("#nav_theme")!==null){
if('<?php echo $data->hidethemes;?>' == "hide"){document.querySelector("#nav_theme").remove()};
};

if(document.querySelector("#nav_plugins")!==null){
if('<?php echo $data->hideplugin;?>' == "hide"){document.querySelector("#nav_plugins").remove()};
};


if(document.querySelector("#nav_backups")!==null){
if('<?php echo $data->hidebackup;?>' == "hide"){document.querySelector("#nav_backups").remove()};
};


if(document.querySelector("#nav_i18n_gallery")!==null){
if('<?php echo $data->hidei18n;?>' == "hide"){document.querySelector("#nav_i18n_gallery").remove()};
};

if(document.querySelector(".support")!==null){
if('<?php echo $data->hidesupport;?>' == "hide"){document.querySelector(".support").remove()};
};



				</script>