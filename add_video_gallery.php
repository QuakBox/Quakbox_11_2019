<?php
set_time_limit(0);
session_start();    
ini_set('max_execution_time', -1);
//ini_set('post_max_size', "32000M");
//ini_set('upload_max_filesize', "16000M");
//ini_set('memory_limit', "64000M");  
//ini_set('max_input_time','0');  
 	require_once($_SERVER['DOCUMENT_ROOT'].'/common/qb_session.php'); 	 
 	require_once($_SERVER['DOCUMENT_ROOT'].'/common/common.php');
	//require_once($_SERVER['DOCUMENT_ROOT'].'/qb_config.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/time_stamp.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/qb_header.php');

	if(!isset($_SESSION['SESS_MEMBER_ID']))
	{
		header("location: ".$base_url."login.php?back=". urlencode($_SERVER['REQUEST_URI']));
		exit();
	}
	$session_member_id = $_SESSION['SESS_MEMBER_ID'];
	//echo "<br>session_member_id :".$session_member_id;  
?>
<?php /*?><link rel="stylesheet" type="text/css" href="css/search.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="icon" href="images/favicon.ico" type="image" />
<link rel="shortcut icon" href="images/favicon.ico" type="image" />
<link rel="stylesheet" type="text/css" href="css/responsive.css" /><?php */?>
<link rel="stylesheet" type="text/css" href="css/wall.css"/>
<link rel="stylesheet" type="text/css" href="css/uploadVideo.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $base_url;?>font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="assets/chosen-jquery/chosen.css">
<style type="text/css">
.thumb-active{
	box-shadow:10px 10px 5px #888;
	-ms-box-shadow:10px 10px 5px #888;
	-webkit-box-shadow:10px 10px 5px #888;
	-moz-box-shadow:10px 10px 5px #888;
	-o-box-shadow:10px 10px 5px #888;
	border:2px solid;
	border-radius:20px;
}
body{
	
	overflow-y: scroll !important;
overflow-x: hidden !important; 
}
.progress{
	width:93% !important; 
}
</style>
<script src="js/jquery1.7.2.js"></script>
<script src="<?php echo $base_url;?>js/check.js"></script>
<script type="text/javascript" src="jscolor/jscolor.js"></script>

<script type="text/javascript">

 //Global Variables

 var videoname="";   //Container For Storing actual trimmed video name with time stamp with Extension.

 var logfileoutput = ""; //logfile of ffmpe conversion

 var logRunningConditionStatus = false;//for preventing set interval jquery post

 var nameWithoutExt = ""; //video name without extension

 var uploadBoolCheck = false;//for preventing page refresh while processing by window unload function

 var DefaultImageThumbnailName = "";//for storing default thumbnail name

 var sizefont=14;
 

 $(document).ready(function() {
 $('#publish_video').attr('disabled','disabled');
 

 $("#fontsizeid").change(function(){

	 

	   switch(this.selectedIndex)

	   {

         	

		 case 1:  sizefont=14;

		 	 break;

		 case 2:  sizefont=16;

		 		  break;

		 case 3:  sizefont=18;

		 		  break;

		 case 4:  sizefont=20;

		 		  break;

		 case 5:  sizefont=22;

		 		  break;

		 case 6:  sizefont=24;

		 		  break;

		 case 7:  sizefont=26;

         		  break;	

         	 case 8:  sizefont=28;

         		  break;	  

                 default: sizefont=14;

		 		  break;

		}

		

            $("#ftitle").css('font-size', sizefont+'px');

           

}); 





$( ".color" ).change(function() {

  var value = $(this).val();

  $("#ftitle").css('color', '#'+value);

   

});





 

 

 

  $("#streamingid").change(function(){



var favcountries = document.getElementById("favouriteCountries"); 

	 

	   if(this.selectedIndex === 2) {

                favcountries.style.display = 'block';

            } else {

                favcountries.style.display = 'none';

            }

            

           

}); 

// This Function is called after clicking Upload Button.

$('#uploadFile').change(

    function(){

         

         var fsize = $('#uploadFile')[0].files[0].size; //get file size

           var ftype = $('#uploadFile')[0].files[0].type; // get file type
           
           var filename = $('#uploadFile').val();
		   var filename = filename.substr(0,filename.lastIndexOf("."));
		   var filename = filename.replace(/^.*\\/, "");
			console.log("filename is: "+filename+ "file size is:"+fsize);
		   $('#ftitle').val(filename);

        //allow file types 

     //validation of mime types of uploaded video file

      switch(ftype)

           {

            case 'video/avi': 

            case 'video/mpeg': 

            case 'video/quicktime': 

            case 'video/webm':

            case 'video/ogg':

            case 'video/x-matroska':

            case 'video/x-ms-wmv':

            case 'video/x-flv':

            case 'video/flv':

            case 'video/mp4':
            case 'video/3gpp':

            break;

            default:

             alert(ftype+" <?php echo $lang[' Unsupported file type'];?>!");

             $(this).closest('form').preventDefault();

         //return false;

        

           }

    

       //Allowed file size is less than 1000 MB (1048576 = 1 mb) 16000000000

       if(fsize> 16000000000) 

       {

         alert("Its big file and size is mentioned here:"+fsize); 
		 alert(fsize +"<?php echo $lang['Ohh,  Too big file! <br />File is too big, it should be less than 16G'];?>.");

         return false;

         

       }else{
		   
		   console.log("File is lessser than 16G so go ahead for uploading");
	   }

         

         

         $(this).closest('form').trigger('submit'); //this button submits closest form and action page is action/video_upload.php

         $('#uploadPage').hide();//hiding upload page

         

    	 $('#ProcessPage').show();//showing process page

    	 

    	 uploadBoolCheck = true;

    });

    





 $('div.thumb').click(function(){

    var opt = $(this).attr("abc");
	var thumb_value = $(this).attr("data-value");

    if(opt==01)

    {

    $('#thumb1').addClass('thumb-active');

    $('#thumb2').removeClass('thumb-active');

	$('#thumb3').removeClass('thumb-active');

	$('#thumb4').removeClass('thumb-active');

	$('#thumb5').removeClass('thumb-active');
	
	$('#thumb6').removeClass('thumb-active');

    }

    else if(opt==02)

    {

    $('#thumb1').removeClass('thumb-active');

    $('#thumb2').addClass('thumb-active');

	$('#thumb3').removeClass('thumb-active');

	$('#thumb4').removeClass('thumb-active');

	$('#thumb5').removeClass('thumb-active');
	
	$('#thumb6').removeClass('thumb-active');

    }

    else if(opt==03)

    {

    $('#thumb1').removeClass('thumb-active');

    $('#thumb2').removeClass('thumb-active');

	$('#thumb3').addClass('thumb-active');

	$('#thumb4').removeClass('thumb-active');

	$('#thumb5').removeClass('thumb-active');
	
	$('#thumb6').removeClass('thumb-active');

    }

	else if(opt==04)

    {

     $('#thumb1').removeClass('thumb-active');

    $('#thumb2').removeClass('thumb-active');

	$('#thumb3').removeClass('thumb-active');

	$('#thumb4').addClass('thumb-active');

	$('#thumb5').removeClass('thumb-active');
	
	$('#thumb6').removeClass('thumb-active');

    }

     else if(opt==05)

    {

    $('#thumb1').removeClass('thumb-active');

    $('#thumb2').removeClass('thumb-active');

	$('#thumb3').removeClass('thumb-active');

	$('#thumb4').removeClass('thumb-active');

	$('#thumb5').addClass('thumb-active');
	
	$('#thumb6').removeClass('thumb-active');

    }
	
	else if(opt==06)

    {

    $('#thumb1').removeClass('thumb-active');

    $('#thumb2').removeClass('thumb-active');

	$('#thumb3').removeClass('thumb-active');

	$('#thumb4').removeClass('thumb-active');

	$('#thumb5').removeClass('thumb-active');
	
	$('#thumb6').addClass('thumb-active');

    }

    
$('#dthumb').val(thumb_value);
     

});

//function to uploAD video

 $('#publish_video').click(function(){

   uploadBoolCheck = false;

    var ftitle = $('#ftitle').val();

    var title_color = $('.color').val();

    var title_size = $('#fontsizeid').val();

    var fdescription = $('#fdescription').val();

    var fcategory = $('#fcategory').val();

    var type = $('#type').val();

    var streaming = $("#streamingid").val();

    var countries = "";
	var dthumb = $('#dthumb').val();
	var custom_thumb = $("#custom_hidden_value").val();
    

    if(streaming == "countrywall"){

    countries = $("#countries").val();}    

    $.post('action/videoUpExec.php', { title : ftitle , desc : fdescription, category : fcategory, tpe : type, strm : streaming, country : countries, defaultthumbnail : dthumb, nwe : nameWithoutExt,title_size:title_size, title_color:title_color,custom_thumb: custom_thumb }, function(data) {
    
    
	alert("Video upload successfully !!!");
		
	
   
//alert('Video uploaded successfully!!!');
window.location.href = "qcast.php";

     });

    
    

    

    

});



 

 var bar1 = $('#bar1');

 var percent1 = $('#percent1');
 console.log('going to call');

 //progress bar for processing and calling unload function

 setInterval(function(){       

        if(logRunningConditionStatus){
			//console.log('calling ffmpegProgRes.php ');

        $.post('action/ffmpegProgRes.php', { logfilepath : logfileoutput }, function(data) {

        

        bar1.width(data);

        percent1.html(data);

        

    }); }

}, 1000);


 var bar = $('.bar');  

 var percent = $('.percent'); 

  var progress = $('.progress'); 

 var status = $('#status');


 $('form').ajaxForm({ 

 beforeSend: function() {

     progress.show();

     status.empty();  

     var percentVal = '0%';  

     bar.width(percentVal)  

     percent.html(percentVal);  

   },  

   uploadProgress: function(event, position, total, percentComplete) {  

     

     var percentVal = percentComplete + '%';  

     bar.width(percentVal)  

     percent.html(percentVal);

    

   },  

   complete: function(xhr) {  

     bar.width("100%");  

     percent.html("100%");  

     videoname = xhr.responseText;
	videoname = videoname.trim();
     nameWithoutExt = videoname.substr(0,videoname.lastIndexOf("."));
     
     DefaultImageThumbnailName = "new"+ nameWithoutExt +"02.png";

     logfileoutput = nameWithoutExt + ".txt";

     progress.hide();

     logRunningConditionStatus = true;

     $('#bar1').width('1%');

     $('#percent1').html('1%');

     $('#progress1').show();

     $.post('action/video_convert.php', { video_name: videoname, logFile: logfileoutput  }, function(result) {
		console.log("result is:"+result) 
	 $('#progress1').hide();

	 logRunningConditionStatus = false;
	 
$('#publish_video').removeAttr('disabled');
	 status.html(result);

	 $('#mesg').hide();	 

	 $('#vidplayer').append('<video id="videojsidid" class="" controls autoplay preload="none" width="200" height="150" poster="uploadedvideo/videothumb/new'+ nameWithoutExt +'02.png" data-setup="{}"><source id="mp4src" src="uploadedvideo/new'+ nameWithoutExt +'.mp4" type="video/mp4" /><source id="oggsrc" src="uploadedvideo/new'+ nameWithoutExt +'.ogg" type="video/ogg" /><source id="webmsrc" src="uploadedvideo/new'+ nameWithoutExt +'.webm" type="video/webm" /></video>');

	 $('#vidplayer').show();

	 $('#thumb1').css("background", "url(uploadedvideo/videothumb/new"+ nameWithoutExt +"01.png) no-repeat");

	 $('#thumb2').css("background", "url(uploadedvideo/videothumb/new"+ nameWithoutExt +"02.png) no-repeat");

	 $('#thumb3').css("background", "url(uploadedvideo/videothumb/new"+ nameWithoutExt +"03.png) no-repeat");

	 $('#thumb4').css("background", "url(uploadedvideo/videothumb/new"+ nameWithoutExt +"04.png) no-repeat");

	 $('#thumb5').css("background", "url(uploadedvideo/videothumb/new"+ nameWithoutExt +"05.png) no-repeat");

	 $('#thumb1').css("background-size", "195px 120px");

	 $('#thumb2').css("background-size", "195px 120px");

	 $('#thumb3').css("background-size", "195px 120px");

	 $('#thumb4').css("background-size", "195px 120px");

	 $('#thumb5').css("background-size", "195px 120px");

$('#thumb1').attr("data-value","new"+ nameWithoutExt +"01.png");
$('#thumb2').attr("data-value","new"+ nameWithoutExt +"02.png");
$('#thumb3').attr("data-value","new"+ nameWithoutExt +"03.png");
$('#thumb4').attr("data-value","new"+ nameWithoutExt +"04.png");
$('#thumb5').attr("data-value","new"+ nameWithoutExt +"05.png");
	 $('#thumbmesg').hide();

	 $('#para').hide();

	 $('.thumbnails').show();
	 
	 $('#thumb2').addClass('thumb-active');
	 $('#dthumb').val(DefaultImageThumbnailName);

	 

	});

   }  

 }); 
 
 $('#thumbfile').change(function(){
	 
	 $('#custom_thumb_form').ajaxForm({ 
	 
     beforeSend: function() {
		  $("#imageloadstatus").show();
            $("#imageloadbutton").show();    

     },  

     success: function (html) {		 
		 $("#imageloadstatus").hide();
         $("#imageloadbutton").show();		 
		 
		 $('#thumb1').removeClass('thumb-active');
    	 $('#thumb2').removeClass('thumb-active');
	 	 $('#thumb3').removeClass('thumb-active');
	     $('#thumb4').removeClass('thumb-active');
	     $('#thumb5').removeClass('thumb-active');	
	     $('#thumb6').addClass('thumb-active');
		 
		 $('#thumb6').css("background", "url(uploadedvideo/videothumb/p200x150"+ html +") no-repeat");
		 $('#thumb6').css("background-size", "195px 120px");
		 $("#custom_hidden_value").val(html);
		 $('#dthumb').val(html);
		 $('#thumb6').show();
     }

 }).submit();  
	
 });   

 });     		

        	window.onbeforeunload = function(){
				if(uploadBoolCheck){
	    		    return '<?php echo $lang['You have unsaved changes'];?>!';
		        }
			}

 </script>
<div class="insideWrapper container" style="margin-left:50px;">
    <div id="uploadPage"><!--First Division with upload button present-->
        <div id="starting_box" class="col-lg-6 col-md-6 col-sm-6">
        
        <br />
        <div>
        
                                          
        
                    <form>
         
                    <a href="qcast.php" >
        
                    <input type="button" value="<?php echo $lang['Back'];?>" class="button"/>
					<input type="hidden" name="member_id" value="<?php echo $session_member_id;?>" />
                    </a>
        
                    </form>
        
                      </div>
        <br /><br /><br />
        
                <center>
        
                    <div class="row">
        
                        
        
                        <a href="#" class="">
        
                         <form id="video_upload_form" name="video_upload" method="post" enctype="multipart/form-data" action="action/video_upload.php">
        
        <div id="typefile" >
        
        <label for="uploadFile"><!--For hiding input type file and showing upload image-->
        
            <div id="imageuploadbutton" class="imageuploadbutton" ></div>
        
        </label>
        
        <input id="uploadFile" class="inputbox" type="file" value="" size="45" name="uploadedfile" required="required" style="display:none;">
        
        </div><!--end of typefile div-->
        
        </form>
        
                          <?php echo $lang['Click here to upload videos'];?>
        
                        </a>
        
                      
        
                    </div><!--end of row div-->
        
              </center>   
        
        </div><!--end of starting_box div-->
        <div id="rightsidebar" class="col-lg-6 col-md-6 col-sm-6">
        
            <h3><?php echo 'CREATE VIDEOS'; ?></h3>
        
            <br><br>
        
                <div  id="mobDiv"> <!--mobile menu webcam capture-->
                
                
        
                <div class="webcam_capture">
        
                <div class="img">
        
                    
        
                        <a href="uploadMobPage.php" class="thumbnail">
        
                          <img src="<?php echo $base_url;?>images/aperturelogo.png" alt="..." height="70px" width="70px">
        
                          </a>
        
                     
        
                </div>	<!--end of img div-->	
        
                
        
                <div class="btn">
        
                          <a href="uploadMobPage.php" ><?php echo $lang['Upload Video'];?></a>
        
                          <br /> <br />	     
        
                          
        
                    <form>
        
                    <a href="uploadMobPage.php" >
        
                    <input type="button" value="<?php echo $lang['Video'];?>" class="button"/>
        
                    </a>
        
                    </form>
        
                      </div><!--end of btn div-->
        
                      </div><!--end of webcam_capture div-->
                      
                <div class="webcam_capture">
        
                <div class="img">
        
                    
        
                    
        
                        <a href="webcam-mob.php" class="thumbnail">
        
                          <img src="<?php echo $base_url;?>images/mzl.vtvlspvo.png" alt="..." height="70px" width="70px">
        
                          </a>
        
                     
        
                    
        
                </div>	<!--end of img div-->	
        
                
        
                <div class="btn">
        
                          <a href="webcam-mob.php" ><?php echo $lang['Webcam Capture'];?></a>
        
                          <br /> <br />	     
        
                          
        
                    <form>
        
                    <a href="webcam-mob.php" >
        
                    <input type="button" value="<?php echo $lang['record'];?>" class="button"/>
        
                    </a>
        
                    </form>
        
                      </div><!--end of btn div-->
        
                      </div><!--end of webcam_capture div-->
        
                <div class="webcam_capture">
        
                <div class="img">
        
                    
        
                        <a href="mob-slideShow.php" class="thumbnail">
        
                          <img src="<?php echo $base_url;?>images/images1.jpg" alt="..." height="70px" width="70px">
        
                          </a>
        
                     
        
                    </div>	<!--end of img div-->
        
                
        
                
        
                <div class="btn">
        
                          <a href="mob-slideShow.php" ><?php echo $lang['photo slideshow'];?></a>
        
                         <br/> <br/> 
        
                          
        
                    <form>
        
                    <a href="mob-slideShow.php" >
        
                    <input type="button" value="<?php echo $lang['Create'];?>" class="button"/>
        
                    </a>
        
                    </form>
        
                     
        
                    </div><!--end of btn div-->
        
                  
        
                    </div><!--end of webcam_capture div-->
                    
                    <div class="webcam_capture">
        
                <div class="img">
        
                    
        
                        <a href="music-mob.php" class="thumbnail">
        
                          <img src="<?php echo $base_url;?>images/music.jpg" alt="..." height="70px" width="70px">
        
                          </a>
        
                     
        
                    </div>	<!--end of img div-->
        
                
        
                
        
                <div class="btn">
        
                          <a href="music-mob.php" ><?php echo 'Create music';?></a>
        
                         <br/> <br/> 
        
                          
        
                    <form>
        
                    <a href="music-mob.php" >
        
                    <input type="button" value="<?php echo $lang['Create'];?>" class="button"/>
        
                    </a>
        
                    </form>
        
                     
        
                    </div><!--end of btn div-->
        
                  
        
                    </div><!--end of webcam_capture div-->
        
               </div><!--end of mob menu webcam capture-->
        
            
        
            <div id="webcamCapture">
        
                <div class="webcam_capture">
        
                <div class="img">
        
                    
        
                    
        
                        <a href="webcam.php" class="thumbnail">
        
                          <img src="<?php echo $base_url;?>images/mzl.vtvlspvo.png" alt="..." height="70px" width="70px">
        
                          </a>
        
                     
        
                    
        
                </div>	<!--end of img div-->	
        
                
        
                <div class="btn">
        
                          <a href="webcam.php" ><?php echo $lang['Webcam Capture'];?></a>
        
                          <br /> <br />	     
        
                          
        
                    <form>
        
                    <a href="webcam.php" >
        
                    <input type="button" value="<?php echo $lang['record'];?>" class="button"/>
        
                    </a>
        
                    </form>
        
                      </div><!--end of btn div-->
                      
                
        
                      </div><!--end of webcam_capture div-->
                    <br /><br /><br /><br />
        
                <div class="webcam_capture">
        
                <div class="img">
        
                    
        
                     
        
                        <a href="slideShow.php" class="thumbnail">
        
                          <img src="<?php echo $base_url;?>images/images1.jpg" alt="..." height="70px" width="70px">
        
                          </a>
        
                     
        
                    </div>	<!--end of img div-->
        
                
        
                
        
                <div class="btn">
        
                          <a href="slideShow.php"><?php echo $lang['photo slideshow'];?></a>
        
                         <br/> <br/> 
        
                          
        
                    <form>
        
                    <a href="slideShow.php" >
        
                    <input type="button" value="<?php echo $lang['Create'];?>" class="button"/>
        
                    </a>
        
                    </form>
        
                     
        
                    </div><!--end of btn div-->
        
                  
        
                    </div><!--end of webcam_capture div-->
                    
              <br /><br /><br /><br />
                <div class="webcam_capture">
        
                <div class="img">
        
                    
        
                     
        
                        <a href="music.php" class="thumbnail">
        
                          <img src="<?php echo $base_url;?>images/music.jpg" alt="..." height="70px" width="70px">
        
                          </a>
        
                     
        
                    </div>	<!--end of img div-->
        
                
        
                
        
                <div class="btn">
        
                          <a href="music.php"><?php echo 'Create music';?></a>
        
                         <br/> <br/> 
        
                          
        
                    <form>
        
                    <a href="music.php" >
        
                    <input type="button" value="<?php echo $lang['Create'];?>" class="button"/>
        
                    </a>
        
                    </form>
        
                     
        
                    </div><!--end of btn div-->
        
                  
        
                    </div><!--end of webcam_capture div-->
        
            
        
        </div><!--end of right-sidebar div-->
        
        </div><!-- End UploadPage -->
    </div>

    <div id="ProcessPage" class="row"><!--Second Division with Progress bar forms and thumbnails.-->
        <!-- Left Column -->
        <div id="leftContainer" class="col-lg-6 col-md-6 col-sm-6">
        
            
        
         <!--<form name="Basic_Data" method="post" action="action/updateThumbnail.php"> -->
        
         <input type="hidden" name="member_id" value="<?php echo $session_member_id;?>" />
        
                
        
             
        
                <select name="category" id="fcategory" class="required inputbox text3">
        
                
        
                  <?php $group_sql = mysqli_query($con, "select * from videos_category");
        
                    while($group_res = mysqli_fetch_array($group_sql))
        
                    {
        
                    ?>
        
                <option value="<?php echo $group_res['id'];?>"><?php echo $group_res['name'];?></option>
        
                    <?php } ?>    
        
                
        
                    </select><br /><br />
        
                    
        
                    <input type="radio" checked="checked" value="0" name="type" id="type"/> <?php echo $lang['Public'];?>
        
                      <input type="radio" id="type" name="type" value="1"  /> <?php echo $lang['Private'];?>
        
                  <br /> <br />
        
                  
        
                 <select id="streamingid" class="required inputbox text3" name="streaming" >		
        
                <option value="countrywall"><?php echo $lang['Country'];?></option> 
        
                </select>
        
                <br /> <br />
        
                <div id="favouriteCountries" style="margin-bottom:15px;" >
        
                
        
        <select name="countries" id="countries" data-placeholder="<?php echo $lang['Choose a Country'];?>..." class="chosen-select" multiple style="width:350px;" tabindex="4">
        
        <?php $favcountries_sql = mysqli_query($con, "select * from geo_country where country_id!=207 ") or die(mysqli_error($con));
        
        while($favcountries_res = mysqli_fetch_array($favcountries_sql))
        
        {
        
        ?>
        
        
        
        <option value="<?php echo $favcountries_res['country_id'];?>"><?php echo $favcountries_res['country_title'];?></option>									
        
        
        
        <?php } ?>    
        
        </select>
        
        </div>
        
            
        
             <textarea name="description" rows="5" placeholder="<?php echo $lang['Description'];?>" id="fdescription" class="inputbox text3" type="text" value=""></textarea><br /><br />
        
             
        
        </form>
        
        
        
         <div id="publish">
        
                
        
                    <input type="button" class="myButton" id="publish_video" value="<?php echo $lang['Save'];?>" /> &nbsp; &nbsp; &nbsp;
        
                     <input type="button" name="add_video" class="myButton" value="<?php echo $lang['Back To My Videos'];?>" onclick="window.open('myvideos.php','_self');" />
        
            
        
               </div>  
        
        
        
            
        
        </div><!-- end leftContainer -->
        <div class="rightContainer" class="col-lg-6 col-md-6 col-sm-6"> 
           <div class="progress">
        
            <span style="position:absolute;"><?php echo $lang['Uploading'];?>..</span>  
        
             <div class="bar"></div >  
        
             <div class="percent">0%</div >  
        
           </div>
        
           <div id="progress1" >  
        
             <span style="position:absolute;"><?php echo $lang['Processing'];?>..</span>
        
             <div id="bar1" ></div >  
        
             <div id="percent1">1%</div >  
        
           </div>    
        
           
        
           <div id="status"></div> 
        
           
        
        
        
        
        
         
        
        
        
            <div id="video">
        
                    <span id="mesg"><h4><?php echo $lang['Preveiw will be available after processing the video'];?></h4></span>
        
                    <div id="vidplayer">
        
                </div>
        
            </div>	
        
            
        
            <div id="videoTitle">
        
                 <input type="text" name="title" placeholder="<?php echo $lang['Title'];?>" id="ftitle" class="required text3 inputbox" value=""/>
        
                
        
                 <select id="fontsizeid" class="required inputbox text3" name="fontsize" style="width:90px; padding:0px;" >
        
                    <option value="12"><?php echo $lang['Size'];?></option>
        
                    <option value="14">14px</option>
        
                    <option value="16">16px</option>
        
                    <option value="18">18px</option> 
        
                    <option value="20">20px</option>
        
                    <option value="22">22px</option>
        
                    <option value="24">24px</option>
        
                    <option value="26">26px</option>
        
                    <option value="28">28px</option>
        
                    
        
                    </select>
        
                    
        
                  <input id="colorpickbuts" class="color" value=""><label for="colorpickbuts"><img id="colorpicks" src="../images/DigitalColor Meter.png" alt="..." height="40px" width="40px" style="margin-bottom: -15px;"/></label>
        
                
        
            </div>
        
        
        
        <input type="hidden" value="save" name="action"></input>
        
        <input type="hidden" value="" name="groupid"></input>
        
        <!--<input class="button validateSubmit" type="submit" value="Upload" style="width:80px;padding:0px;"></input>
        
        <input class="button" type="button" value="Cancel" onclick="history.go(-1);return false;" style="width:80px;padding:0px;"></input>-->
        
        <input type="hidden" value="1" name="326e4f73c340f29d8ce547ad40dc0e1b"></input>
        
        
        
        
        
         <!--</form>-->
        
         <div id="para">
        
         <h4><?php echo $lang['Thumbnails'];?></h4><br/>
        
         <span id="thumbmesg"><?php echo $lang['Thumbnail selections will appear when the video has finished processing'];?>.</span>
        
         </div>
        
         
        
          
        
         <div class="thumbnails">
        
             <div id="thumb1" class="thumb" abc="01" data-value="">
        
               <div id="overlay101" class="overlay1">
        
               <span id="plus01" class="plus"><?php echo $lang['SELECT'];?></span>
        
               </div>
        
             </div>
        
             <div id="thumb2" class="thumb" abc="02" data-value="">
        
               <div id="overlay102" class="overlay1">
        
               <span id="plus02" class="plus"><?php echo $lang['SELECT'];?></span>
        
               </div>
        
             </div>
        
             <div id="thumb3" class="thumb" abc="03" data-value="">
        
               <div id="overlay103" class="overlay1">
        
               <span id="plus03" class="plus"><?php echo $lang['SELECT'];?></span>
        
               </div>
        
             </div>
        
             <div id="thumb4" class="thumb" abc="04" data-value="">
        
               <div id="overlay104" class="overlay1">
        
               <span id="plus04" class="plus"><?php echo $lang['SELECT'];?></span>
        
               </div>
        
             </div>
        
             <div id="thumb5" class="thumb" abc="05" data-value="">
        
               <div id="overlay105" class="overlay1">
        
               <span id="plus05" class="plus"><?php echo $lang['SELECT'];?></span>
        
               </div>
        
             </div>
             
             <div id="thumb6" class="thumb" abc="06" style="display:none;" data-value="">
        
               <div id="overlay106" class="overlay1">
        
               <span id="plus06" class="plus"><?php echo $lang['SELECT'];?></span>
        
               </div>
        
             </div>
             
             <div class="custom_thumb">
           
           <form id="custom_thumb_form" name="custom_thumb_form" action="action/custom_thumb.php" method="post" enctype="multipart/form-data">
           <div id='imageloadstatus'>
             <img src='images/ajax-loader.gif'/> <?php echo $lang['Uploading please wait']; ?> ....
           </div>
           <div id='imageloadbutton'>   
               <div class="thumbfile_upload">
                <input type="file" id="thumbfile" value=""  name="thumbfile" required="required" accept="image/*" style="content:Custom Thumb">
            </div>
               <input type="hidden" name="dthumb" id="dthumb" value="" />
               <input type="hidden" id="custom_hidden_value" value="" />
           </div>
           
           </form>
        </div>
        
           </div><!--thumbnails -->
        
              <script src="js/form.js"></script>
        
              
        
             <!-- select or dropdown enhancer -->
        
            <script src="assets/chosen-jquery/chosen.jquery.js"></script> 
        
        <script type="text/javascript">
        
            var config = {
        
              '.chosen-select'           : {},
        
              '.chosen-select-deselect'  : {allow_single_deselect:true},
        
              '.chosen-select-no-single' : {disable_search_threshold:10},
        
              '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        
              '.chosen-select-width'     : {width:"95%"}
        
            }
        
            for (var selector in config) {
        
              $(selector).chosen(config[selector]);
        
            }
        
          </script>    
        </div>  
    </div><!--basicInfo Eniv><!--End column left div-->
</div><!--End mainbody div-->
<?php
	include($_SERVER['DOCUMENT_ROOT'].'/includes/qb_footer.php');
?>