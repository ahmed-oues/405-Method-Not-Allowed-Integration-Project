<?php
include 'navANDhead.php';
require_once('sessonchekadmin.php');
?>
	<h1>List of Pending Courses</h1>
	<table>
		
		<?php
    if($_GET['msg']==1){
      echo "accsepted suseesfuly";
    }
		// Connect to the database
		$servername = "localhost";
		$username = "sammy";
		$password = "password";
		$dbname = "greatmove_library";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		// Retrieve the list of pending books
		$sql = "SELECT * FROM lessons";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// Output data of each row
			while($row = $result->fetch_assoc()) {
				?>
				     <div class="lessons-container">
  <div class="lessons">
    
    <!--  -->
    
    <h3><?php echo $row['title']; ?></h3>
    <p><?php echo $row['class_level']; ?></p>
    <p><?php echo $row['department_id']; ?></p>
    <p><?php echo $row['topec']; ?></p>
   
    <a href="<?php echo $row['file_path']; ?>">PDF File</a>


       <!-- the bottons  -->

      <input type='hidden' name='lessons_id' value='<?php echo $row["id"]; ?>'>
      
    </form>
    <form method='post' action='delete_lessons_uplode.php'>
      <input  name='lessons_id' value='<?php echo $row["id"]; ?>'>
      <input type='submit' value='Delete' class='aaa'>
    </form>
  </div>
</div>

		<?php
		}}?>
	</table>
</body>
</html>
<style>
.lessons-container {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	display: inline-block;

  
}

.lessons {
  width: 300px;
  padding: 20px;
  text-align: center;
  background-color: #f2f2f2;
  border-radius: 8px;
}

.lessons img {
  width: 400%;
  max-height: 400px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 10px;
}

.lessons h3 {
  font-size: 20px;
  margin-bottom: 8px;
}

.lessons p {
  font-size: 16px;
  margin-bottom: 16px;
}

.lessons a {
  display: inline-block;
  padding: 8px 16px;
  background-color: #007bff;
  color: #fff;
  text-decoration: none;
  border-radius: 4px;
  transition: background-color 0.3s ease;
}

.lessons a:hover {
  background-color: #0056b3;
}

.lessons form {
  margin-top: 16px;
  display: inline-block;
}

.lessons form input[type="submit"][value="Accept"] {
  background-color: green;
  color: #fff;
}

.aaa {
	
  padding: 8px 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #dc3545;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  margin-right: 10px; 
}
.bbb{  padding: 8px 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: green;
  color: #fff;
  cursor: pointer;
  display: inline-block;
  margin-right: 10px; }

</style>
