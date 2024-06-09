<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if file was uploaded
  if ($_FILES['video']) {
    $videoName = $_FILES['video']['name'];
    $videoTmpName = $_FILES['video']['tmp_name'];
    $videoSize = $_FILES['video']['size'];
    $videoType = $_FILES['video']['type'];

    // Validate video type and size
    if ($videoType != "video/mp4") {
      echo json_encode(array('error' => 'Only MP4 videos are allowed'));
      exit;
    }
    if ($videoSize > 10000000) {
      echo json_encode(array('error' => 'Video file size is too large'));
      exit;
    }

    // Upload video to server
    $uploadDir = 'uploads/';
    $videoUrl = $uploadDir . $videoName;
    if (move_uploaded_file($videoTmpName, $videoUrl)) {
      // Insert video details into database
      $conn = mysqli_connect("localhost", "root", "", "yaa");
      $sql = "INSERT INTO videos (name, url) VALUES ('$videoName', '$videoUrl')";
      if (mysqli_query($conn, $sql)) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);      } 
        else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
      mysqli_close($conn);
    } else {
      echo json_encode(array('error' => 'Failed to upload video'));
    }
  }
}
?>
