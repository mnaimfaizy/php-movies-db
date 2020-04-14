<?php include 'includes/header.inc.php'; ?>
<?php
if(isset($_POST['submit'])) {
    $name       = @trim(stripslashes($_POST['name'])); 
    $email      = @trim(stripslashes($_POST['email'])); 
    $subject    = @trim(stripslashes($_POST['subject'])); 
    $message    = @trim(stripslashes($_POST['message'])); 

    $email_from = $email;
    $email_to = 'mnaimfaizy@mnfprofile.com';//replace with your email

    $body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;
    $success1 = mail($email_to, $subject, $body, 'From: <'.$email_from.'>');

	if($success1) {
		$res = true;	
	} else {
		$res = false;
	}
}
?>
      <div class="content">
      <div class="row">
      	<div class="col-md-1"></div>
        <div class="col-md-10">
        	<?php if(isset($res)) { ?>
            	<?php if($res === true) { ?>
        	<div class="alert alert-success"> Thanks! Your message has been send to me and I will look to it for improvmence in the website. </div>
            	<?php } else if($res === false) { ?>
            <div class="alert alert-danger"> Oh Snap! Something has broken please try again later. </div>
        	<?php } } ?>
        </div>
        <div class="col-md-1"></div>
      </div>
      	<div class="box_1">
      	 <h1 class="m_2">Contact Me</h1>
        
		<div class="clearfix"> </div>
		</div>
		<hr />
        <div class="box_2">
        
			<div class="row">
            	<div class="col-md-6">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="contact_form" name="contact_form">
                	<div class="row">
                    <div class="col-md-6">
                    	<label for="name"> Fullname </label>
                     <div class="form-group">
                       	<input type="text" name="name" id="name" class="form-control" placeholder="Fullname" />
                        
                     </div>
                    </div>
                    
                    <div class="col-md-6">
                    	<label for="email"> Email Address </label>
                     <div class="form-group">
                       	<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" />
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    	<label for="subject"> Subject </label>
                        <div class="form-group">
                        	<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" />
                        </div>
                    </div>
                    <div class="col-md-12">
                    	<label for="name"> Message </label>
                     <div class="form-group">
                        	<textarea class="form-control" name="message" id="message" cols="90" rows="10">
                            </textarea>
                    </div>
                    </div>
                    </div>
                    
                    <div class="col-md-3">
                     <div class="form-group">
                       	<input type="submit" value="Submit" name="submit" id="submit" class="btn btn-lg btn-success" />
                    </div>
                    </div>

                	
                </form>
                </div>
                <div class="col-md-6">
                	<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2764.80225528355!2d69.14049769724859!3d34.504848650899625!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0xed92d478fa1bb0f8!2s3rd+District+Kabul+Police+Department!5e0!3m2!1sen!2s!4v1441555439600" width="500" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
			<div class="clearfix"> </div>
		</div>      
      </div>
   </div>
 </div>
  
<?php include 'includes/footer.inc.php'; ?>