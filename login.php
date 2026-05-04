<?php
include_once("includes/header.php");
include_once("includes/nav_base.php");


/*
echo "<br>Post: ";
print_r($_POST);
echo "<br>Get: ";
print_r($_GET);
echo "<br>Session: ";
print_r($_SESSION);
echo "<br>Server: ";
print_r($_SERVER);
*/

$user_name = decode(filter_input(INPUT_POST, 'user_name'));
if (!isset($user_name))
{
    $user_name = '';
}

$password = decode(filter_input(INPUT_POST, 'password'));
if (!isset($password))
{
    $password = '';
}

if (!isset($_SESSION['link_to']))
{
    $link_to = '';
}
else
{
	$link_to = $_SESSION['link_to'];
}
//echo 'linkto: ' . $link_to;
?>

<div class="title-container">
    <img src="img/puzzlepieces.jpg"></img>
    <div class="title-container-text caption">
      <h1>Login</h1>
    </div>
</div>
   
 <div class="container">
	<div class="row  justify-content-center">
		<div class="col-8 justify-content-center text-center" id="page_message">
		<?php
            validate_user_login();
			display_message();
		?>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-12 col-sm-8 col-md-6 col-xl-4 alert alert-filter">
			<div class="row justify-content-center">
				<form id="login-form" method="post" enctype="application/x-www-form-urlencoded">
					<input type="hidden"  name="token" id="token" value="<?php echo token_generator();?>">
					<input type="hidden"  name="link_to" id="link_to" value="<?php echo $link_to;?>">
					<div class="mb-3">
						<input type="email" name="user_name" id="user_name" class="form-control" value="<?php echo $user_name; ?>" placeholder="E-Mail" required>
					</div>
					<div class="mb-3">
						<input type="password" name="password" id="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" required></input>
					</div>
					<div class="justify-content-center text-center mb-3">
						<button type="submit" class="btn btn-dark">Login</button>
					</div>
					<div class="justify-content-center text-center">
						<a href="user_activation.php"><p>Activate user</p></a>
						<a href="passwordreset.php"><p>Forgot Password</p></a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php include_once("includes/footer.php") ?>	