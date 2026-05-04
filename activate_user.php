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

$email = decode(filter_input(INPUT_GET, 'email'));
if (!isset($email))
{
    $email = '';
}

$request_key = decode(filter_input(INPUT_GET, 'request_key'));
if (!isset($request_key))
{
    $request_key = '';
}

$check_msg = check_request_key($email, $request_key);

?>


<div class="title-container">
    <img src="img/puzzlepieces.jpg"></img>
    <div class="title-container-text caption">
      <h1>Create password</h1>
    </div>
</div>
   
 <div class="container">
	<div class="row  justify-content-center">
		<div class="col-8 justify-content-center text-center" id="page_message">
			<?php echo $check_msg; ?>
		</div>
		<div class="col-8 justify-content-center text-center" id="page_message">
			<div class="alert alert-danger div_hidden" id="invalid_input_message">Invalid password</div>
			<div class="alert alert-danger div_hidden" id="password_not_equal">The passwords are not identical</div>
		</div>
	</div>

	<div class="row justify-content-center <?php if ($check_msg != ''){echo " div_hidden";}?>">
		<div class="col-12 col-sm-8 col-md-6 col-xl-4 alert alert-filter">
			<div class="row justify-content-center  text-center">
				<div class="col-12 div_hidden" id="success_message">
					<?php 
						echo '<div class="alert alert-success" role="alert" text-center>The password has been successfully set. You can now log in as a user at:<br><a href="' . get_page_url('login.php') .'"><p style="text-decoration: underline; text-align: center; color: #333333;">Login</p></a></div>';
					?>
				</div>	
			</div>	

			<div class="row justify-content-center text-center" name="reset_div" id="reset_div" >
				<div class="col-12  mb-3">
					<input type="hidden"  name="email" id="email" value="<?php echo $email;?>">
					<input type="hidden"  name="request_key" id="request_key" value="<?php echo $request_key;?>">
					<input type="hidden"  name="token" id="token" value="<?php echo token_generator();?>">
					<h3>Please enter a secure password and confirm it</h3>
				</div>
				<div class="col-12 mb-3 text-start">
					<label for="edit-passwort">Password*</label>
					<input type="password" name="mdaten" id="edit-passwort" class="eingabe-mdaten form-control" placeholder="">
				</div>
				<div class="col-12 mb-3 text-start">
					<label for="edit-passwort-bestaetigung">Password confirmation*</label>
					<input type="password" name="mdaten" id="edit-passwort-bestaetigung" class="eingabe-mdaten form-control" placeholder="">
				</div>
				<div class="center">
					<button type="button" name="register_save_btn" id="register_save_btn" class="btn btn-dark">Save Password</button>
					<a href="login.php" class="btn btn-secondary">Cancel</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once("includes/footer.php") ?>	
<script src="js/resetpassword.js"></script>