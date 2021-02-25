<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	
	<body>
		
		<section class="container ">
			<h1> Registeration </h1>
			<span class="h6 form-text text-muted">Your information is private</span>
			
			<?php require_once('signup.php');?>
			<form class="needs-validation "novalidate="" id="register-form" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post">
				
				<div class="form-group">
					<label class="form-control-label" for="arabicName">Your Name in Arabic</label>
					<input class="form-control <?php if($errors['name_ar']) echo "is-invalid"; else if(isset($inputs['name_ar'])) echo "is-valid";  ?>" type="text" name="name_ar" placeholder="أحمد" pattern="^[\u0621-\u064A ]+$" title="Your name must be in Arabic character only" value="<?php if(isset($inputs['name_ar'])) echo $name_ar; ?>" autocomplete="on" id="arabicName" autofocus required >
					<div class="invalid-feedback">
						Your name must be in Arabic character only
					</div>
				</div>
				
				<div class="form-group">
					<label class="form-control-label" for="englishName">Your Name in English</label>
					<input class="form-control <?php if($errors['name_en']) echo "is-invalid"; else if(isset($inputs['name_en'])) echo "is-valid";  ?>" type="text" name="name_en" placeholder="ahmed" pattern="^[a-zA-Z ]+$" title="Your name must be in English character only" value="<?php if(isset($inputs['name_en'])) echo $name_en; ?>" autocomplete="on" id="englishName" required >
					<div class="invalid-feedback">
						Your name must be in English character only
					</div>
				</div>
				
				<div class="form-group">
					<label class="form-control-label" for="email">Your Email</label>
					<input class="form-control <?php if($errors['email']) echo "is-invalid"; else if(isset($inputs['email'])) echo "is-valid";  ?>" id="email" type="text" name="email" placeholder="name@domain-name.com" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" title="Your email must be like that name@domain-name.com" value="<?php if(isset($inputs['email'])) echo $email; ?>" autocomplete="on" required>
					<div class="invalid-feedback">
						Your email must be like that name@domain-name.com
					</div>
				</div>
				
				<div class="form-group">
					<label class="form-control-label" for="phone">Your Phone</label>
					<input class="form-control <?php if($errors['phone']) echo "is-invalid"; else if(isset($inputs['phone'])) echo "is-valid";  ?>" id="phone" type="text" name="phone" placeholder="+201..." pattern="^\+?\d{10,}$" title="Your phone must be at least 10 digits" value="<?php if(isset($inputs['phone'])) echo $phone; ?>" autocomplete="on" required >
					
					<div class="invalid-feedback">
						Your phone must be at least 10 digits
					</div>
				</div>
				<div class="form-group ">
					<div class="card-columns">
						<div class="d-inline-block">
							<label class="form-control-label">Your Country</label>
							<select name="country" class="custom-select countryId <?php if($errors['country']) echo "is-invalid"; else if(isset($inputs['country'])) echo "is-valid";  ?>" id="countryId" required>
								<option value="">Select Country</option>
							</select>
							<div class="invalid-feedback">
								Choose your country
							</div>
						</div>
						
						<div class="d-inline-block">
							<label class="form-control-label">Your State</label>
							<select name="state" class="custom-select stateId <?php if($errors['state']) echo "is-invalid"; else if(isset($inputs['state'])) echo "is-valid";  ?>" id="stateId" required>
								<option value="">Select State</option>
							</select>
							<div class="invalid-feedback">
								Choose your state
							</div>
						</div>
						
						<div class="d-inline-block">
							<label class="form-control-label">Your City</label>
							<select name="city" class="custom-select cityId <?php if($errors['city']) echo "is-invalid"; else if(isset($inputs['city'])) echo "is-valid";  ?>" id="cityId" required>
								<option value="">Select City</option>
							</select>
							<div class="invalid-feedback">
								Choose your city
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="form-group">
					<label class="form-control-label" for="address">Your Address</label>
					<input class="form-control <?php if($errors['address']) echo "is-invalid"; else if(isset($inputs['address'])) echo "is-valid";  ?>" id="address" type="text" name="address" placeholder="Street..." pattern="^([\u0621-\u064A0-9\-, ]{3,})|([a-zA-Z0-9\-, ]{3,})+$" title="Your address must be in English or Arabic characters only and at least 3 characters" value="<?php if(isset($inputs['address'])) echo $address; ?>" autocomplete="on" required>
					<div class="invalid-feedback">
						Your address must be in English or Arabic characters only and at least 3 characters
					</div>
				</div>
								
				<div class="form-group">
					<label class="form-control-label d-block">Gender</label>
					<div class="custom-control custom-radio">
						<input class="custom-control-input <?php if($errors['gender']) echo "is-invalid"; else if(isset($inputs['gender'])) echo "is-valid";  ?>" type="radio" name="gender" title="You should choose your gender" value="male" id="male" <?php if(isset($inputs['gender']) && $inputs['gender'] == "male") echo "checked"; ?> >
						<label class="custom-control-label" for="male">Male</label>
					</div>
					<div class="custom-control custom-radio ">
						<input class="custom-control-input <?php if($errors['gender']) echo "is-invalid"; else if(isset($inputs['gender'])) echo "is-valid";  ?>" type="radio" name="gender" title="You should choose your gender" value="female" id="female" required <?php if(isset($inputs['gender']) && $inputs['gender'] == "female") echo "checked"; ?> >
						<label class="custom-control-label" for="female">Female</label>
						<div class="invalid-feedback">
							You should choose your gender
						</div>
					</div>
					
					
				</div>
					
				<div class="form-group">
					<label class="form-control-label" for="password">Your Password</label>
					<input class="form-control <?php if($errors['password']) echo "is-invalid"; else if(isset($inputs['password'])) echo "is-valid";  ?>" id="password" type="password" name="password" placeholder="at least 8 characters" pattern="^.{8,}$" title="Your password must be 8 caharacters at least" autocomplete="on" required>
					<div class="invalid-feedback">
						Your password must be 8 caharacters at least
					</div>
				</div>
				
				<div class="form-group">
					<label class="form-control-label" for="confirm-password">Confirm Password</label>
					<input class="form-control <?php if($errors['confirm-password']) echo "is-invalid"; else if(isset($inputs['confirm-password'])) echo "is-valid";  ?>" id="confirm-password" type="password" name="confirm-password" placeholder="the same as password" pattern="^.{8,}$" title="confirm password must match the password" autocomplete="on" required>
					<div class="invalid-feedback">
						confirm password must match the password.
					</div>
				</div>
					
					
					
					
				<div class="custom-control custom-checkbox">
					<input class="custom-control-input <?php if($errors['agree']) echo "is-invalid"; else if(isset($inputs['agree'])) echo "is-valid";  ?>" type="checkbox" name="agree" title="You should agree all terms" id="agree" value="accepted" <?php if(isset($inputs['agree']) && $inputs['agree'] == "accepted") echo "checked"; ?> required >
					<label class="custom-control-label" for="agree"><a href="#" > I agree all terms  </a></label>	
					<div class="invalid-feedback">
						You should agree all terms first.
					</div>
				</div>
				
				<div class="form-group text-right">
					<input class="btn btn-primary" type="submit" value="Register" title="Can't Register" data-content="you should match all validation first" disabled>
				</div>
								
			</form>
			
		</section>
		
		<script src="js/jquery-3.5.1.min.js" ></script>
		<script src="js/popper.min.js" ></script>
		<script src="js/bootstrap.min.js" ></script>
		<script src="js/script.js" ></script>
		
	</body>
</html>