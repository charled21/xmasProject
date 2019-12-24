
<?php 
require_once('config.php');
 ?>

<?php 


			if(isset($_POST)){
				$username = $_POST['username'];
				$password = sha1($_POST['password']);
				$confirmPassword = sha1($_POST['confirmPassword']);
				$firstname = $_POST['firstname'];
				$middlename = sha1($_POST['middlename']);
				$lastname = $_POST['lastname'];

				//date insertion----start

				$month = $_POST['month'];
				$day = $_POST['day'];
				$year = $_POST['year'];

				$datereg = $year."-".$month."-".$day; 


				//date insertion----end

				$sql = "INSERT INTO users (username,password,confirmPassword,firstname,middlename,lastname,date_reg) VALUES (?,?,?,?,?,?,'$datereg')";
				$stmtinsert = $db->prepare($sql);
				$result = $stmtinsert->execute([$username, $password, $confirmPassword, $firstname, $middlename, $lastname]);

				if($result){

					//echo "<script type='text/javascript'>alert('$messageAlert');</script>";
					//echo 'Successfully Added to Database!';
				}
				else{
					echo 'Error in Connection!';
				}
			//echo $firstname , " " , $middlename , " " , $lastname;
			}
			else{
				echo "Error";
			}

?>