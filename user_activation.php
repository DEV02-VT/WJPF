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
/*echo "<br>Server: ";
check_page_language();
print_r($_SERVER);*/

$email = decode(filter_input(INPUT_POST, 'email'));
if (!isset($email))
{
    $email = '';
	$email_valid = false;
}
else
{
	$email_valid = filter_var($email, FILTER_VALIDATE_EMAIL);
}

?>
<div class="title-container">
    <img src="img/puzzlepieces.jpg"></img>
    <div class="title-container-text caption">
      <h1>Activate user access</h1>
    </div>
</div>
   
 <div class="container">
	<div class="row  justify-content-center">
		<div class="col-12 col-sm-8 col-md-6 col-xl-4 justify-content-center text-center" id="page_message">
		<?php 
			if ($email_valid)
			{
				recover_password();
			}
			else if ($email != '')
			{
				echo '<div class="alert alert-danger text-center" role="alert">Invalid email address!</div>';
			}
		?>
		</div>
	</div>

	<div class="row justify-content-center">
		<div class="col-12 navi-tab">
			<div class="alert alert-primary ">
                    With your user account, you can access internal federation data. To log in, your account must be activated and a password created.
					<br><br>To activate your user access, you need to enter the email address and click the 'Activate user' button. You will then receive an email containing a link to confirm your registration and set a password. Once you have entered a password, your access will be activated.

					<br><br>If you encounter any problems during registration, please send an email to <span class="secondary">michael.smit@wjpf.org</span>.<br>
			</div>
		</div>
		<div class="col-12 col-sm-8 col-md-6 col-xl-4 alert alert-filter">
			<div class="row justify-content-center">
				<form id="login-form" method="post" enctype="application/x-www-form-urlencoded">
					<div class="formbody">
						<input type="number" name="user_activation" id="user_activation" hidden value="1">
						<input type="hidden"  name="token" id="token" value="<?php echo token_generator();?>">

						<div class="mb-3">
							<input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>" placeholder="email" required>
						</div>

						<div class="justify-content-center text-center mb-3">
							<button type="submit" class="btn btn-dark">Activate user</button>
							<a href="login.php" class="btn btn-secondary">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include_once("includes/footer.php") ?>	