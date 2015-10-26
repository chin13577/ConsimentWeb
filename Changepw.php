<?PHP
	session_start();
	// Create connection to Oracle
	$conn = oci_connect("system", "chinchin999", "//localhost/XE");
	if (!$conn) {
		$m = oci_error();
		echo $m['message'], "\n";
		exit;
	} 
?>
Change Password Form
<hr>

<?PHP
	if(isset($_POST['submit'])){
		$oldPass = trim($_POST['oldPass']);
		$newPass = trim($_POST['newPass']);
		$conPass = trim($_POST['conPass']);
			if($_SESSION['PASSWORD']!=$oldPass)
			{
				echo "Wrong Password ";
			}
			if($_SESSION['PASSWORD']==$oldPass)
			{
				$_SESSION['PASSWORD']=$newPass;
				echo "Success ";				
			}
		if($newPass==$conPass){
			$query = "UPDATE AA_LOGIN SET PASSWORD='$newPass' WHERE Password = '$oldPass'";
			$parseRequest = oci_parse($conn, $query);
			oci_execute($parseRequest);
			// Fetch each row in an associative array
			//$row = oci_fetch_array($parseRequest, OCI_RETURN_NULLS+OCI_ASSOC);
			
		}
		else{
			echo "new password and confirm password is not same ";
		}
	};
	oci_close($conn);
?>

<form action='Changepw.php' method='post'>
	OldPassword <br>
	<input name='oldPass' type='input'><br>
	NewPassword<br>
	<input name='newPass' type='password'><br><br>
	ConfirmPassWord<br>
	<input name='conPass' type='password'><br><br>
	<input name='submit' type='submit' value='Change'>
	<a href='MemberPage.php'>Back</a>
</form>
