<?php
//this script is called by the videorecorder.swf file when the [SAVE] button is pressed and it is executed o the web server
//4 variables are passed to this file via GET/query string:
//the streamName var  contains the name of the .flv file as it is on the Red5/FMS/Wowza server on which it was saved
//the streamDuration var  contains the duration of the video stream in seconds but it is accurate to the millisecond  like this: 4.231 (4 seconds and 231 milliseconds)
//the userId var contains the value of the userId var sent from avc_settings.php or the value of the userId flash vars sent from VideoRecorder.html to the swf file, if userId si found in both places the one in avc_settings.php is used
//the recorderId var contais the value of the recorderId fash var sent from VideoRecorder.html to the swf file

//you can do whatever you want in here with the variables like insert them in a db etc..
include_once 'config.php';
$streamName=$_GET["streamName"].'.flv';
$streamDuration=$_GET["streamDuration"];
$userId= $_GET["userId"];
$recorderId= $_GET["recorderId"];
$tmp_name = 'http://208.109.108.68:5080/hdfvr/streams/'.$streamName;
move_uploaded_file($tmp_name,$streamName);
$sql = "INSERT INTO capture_videos(location,duration,user_id,record_id) VALUES('$streamName','$streamDuration','$userId','$recorderId')";
$response = mysqli_query($con, $sql);
header("location: ".$base_url."video_conversion.php?file=".$streamName."");
exit();
//echo "save=failed" to tell the recorder the save has failed and display the save button again
?>
                            