<?php
ini_set("display_errors",'1');
error_reporting(E_ALL);

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Connect to database
  include 'connbd.php';

  $allowTypesPDF = array('pdf'); 
  $allowTypes = array('jpg','png','jpeg','gif');

// Check if file was uploaded
if (isset($_FILES['pdf_file'])&&!empty($_FILES["pdf_file"]["name"])) {

  // Get file name
  $fileName = basename($_FILES['pdf_file']['name']);
 
  
  // Other form data
  $title = $_POST['title'];
  $author_name = $_POST['author_name'];
  $category = $_POST['category'];
  
  // Upload file to server
  $targetDir = "uploads/";
  $targetFile = $targetDir . $fileName;
  $fileType = pathinfo($targetFile,PATHINFO_EXTENSION);
//uplode data to data basse 


    


  
  //testing if file extanon is pdf befor uploding to the server 
  if(in_array($fileType, $allowTypesPDF)){

    if($_FILES['pdf_file']['size'] < 10485760){

      move_uploaded_file($_FILES['pdf_file']['tmp_name'], $targetFile);
      
     
     // Upload cover image to server
     $coverImage = "";
     if (isset($_FILES['cover_image'])) {
       $coverFileName = basename($_FILES['cover_image']['name']);
       $coverTargetFile = $targetDir . $coverFileName;
           
          
       //test file tipe and file size
       $coverfileType = pathinfo($coverTargetFile,PATHINFO_EXTENSION);
       
       if(in_array($coverfileType, $allowTypes)){
         if($_FILES['cover_image']['size'] < 10485760){
   
           
           move_uploaded_file($_FILES['cover_image']['tmp_name'], $coverTargetFile);
           $coverImage = $coverTargetFile;
           }
        }else{echo"<br> error cover file tipe <br>";}
      }
   
     
$query = "SELECT * FROM books WHERE title = '$title'";
$stmt = $conn->prepare($query);

$stmt->execute();

if ($stmt->rowCount() == 0) {
     $insert = $conn->query("INSERT INTO bookspending (title, author, description, file_path, cover_path, user_id) VALUES ('$title', '$author_name', '$category', '$targetFile', '$coverImage', 1)");
   
     if($insert){
       $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
       echo $statusMsg;
      }else{
       $statusMsg = "<br>File upload failed, please try again.";}
       echo "<br>",$statusMsg;
      }
      else {echo "books exicte";}

    }else{echo"invalid file size";}

  }else{echo"<br>invalid file tipe";}
}else {
  echo "<br>Error: No file uploaded.";
   }
  }




$conn = null; // Close the database connection

  
  // Close database connection





?>
