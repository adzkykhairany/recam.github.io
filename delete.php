<?php
include('session_client.php');
@$camera_id = $_GET['camera_id'];
$stmt = mysqli_query($conn, "DELETE FROM cameras WHERE camera_id = '$camera_id'");
header("Location:entercamera.php");
