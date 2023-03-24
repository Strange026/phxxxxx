<?php
require('connection.inc.php');
require('functions.inc.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$name=get_safe_value($con,$_GET['first_name']);
$uid=$_SESSION['USER_ID'];
mysqli_query($con,"update customer set first_name='$name' where id='$uid'");
$_SESSION['USER_NAME']=$name;
echo "Your name updated";
?>