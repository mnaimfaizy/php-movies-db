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

<!-- Page Header -->
<div class="page-header" style="margin-top: 70px;">
    <div class="container">
        <h1 class="display-6 fw-bold"><i class="fas fa-envelope me-2 text-primary"></i>Contact Us</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Contact</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <!-- Alert Messages -->
    <?php if(isset($res)) { ?>
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <?php if($res === true) { ?>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="fas fa-check-circle me-2 fa-lg"></i>
                <div>
                    <strong>Message Sent!</strong> Thank you for reaching out. We'll get back to you as soon as possible.
                </div>
            </div>
            <?php } else { ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <i class="fas fa-exclamation-circle me-2 fa-lg"></i>
                <div>
                    <strong>Oops!</strong> Something went wrong. Please try again later.
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    
    <div class="row g-4">
        <!-- Contact Form -->
        <div class="col-lg-6">
            <div class="content-card h-100">
                <div class="card-header">
                    <h4 class="mb-0 text-white"><i class="fas fa-paper-plane me-2 text-primary"></i>Send a Message</h4>
                </div>
                <div class="card-body p-4">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="contact_form" name="contact_form" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label text-secondary">
                                    Full Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" id="name" class="form-control form-control-lg" 
                                       placeholder="John Doe" required 
                                       style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label text-secondary">
                                    Email Address <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg" 
                                       placeholder="john@example.com" required
                                       style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;">
                            </div>
                            <div class="col-12">
                                <label for="subject" class="form-label text-secondary">
                                    Subject <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="subject" id="subject" class="form-control form-control-lg" 
                                       placeholder="How can we help?" required
                                       style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;">
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label text-secondary">
                                    Message <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" name="message" id="message" rows="5" 
                                          placeholder="Write your message here..." required
                                          style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white;"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Contact Info & Map -->
        <div class="col-lg-6">
            <!-- Contact Info Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="content-card p-4 text-center h-100">
                        <div class="mb-3">
                            <i class="fas fa-envelope fa-2x text-primary"></i>
                        </div>
                        <h6 class="text-white">Email</h6>
                        <p class="text-secondary mb-0 small">mnaimfaizy@mnfprofile.com</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-card p-4 text-center h-100">
                        <div class="mb-3">
                            <i class="fas fa-globe fa-2x text-primary"></i>
                        </div>
                        <h6 class="text-white">Website</h6>
                        <p class="text-secondary mb-0 small">
                            <a href="https://mnfprofile.com" target="_blank" class="text-decoration-none text-primary">mnfprofile.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-card p-4 text-center h-100">
                        <div class="mb-3">
                            <i class="fab fa-github fa-2x text-primary"></i>
                        </div>
                        <h6 class="text-white">GitHub</h6>
                        <p class="text-secondary mb-0 small">
                            <a href="https://github.com/mnaimfaizy" target="_blank" class="text-decoration-none text-primary">@mnaimfaizy</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content-card p-4 text-center h-100">
                        <div class="mb-3">
                            <i class="fab fa-linkedin fa-2x text-primary"></i>
                        </div>
                        <h6 class="text-white">LinkedIn</h6>
                        <p class="text-secondary mb-0 small">
                            <a href="https://www.linkedin.com/in/mohammad-naim-faizy-17600250" target="_blank" class="text-decoration-none text-primary">Connect</a>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Map -->
            <div class="content-card overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2764.80225528355!2d69.14049769724859!3d34.504848650899625!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0xed92d478fa1bb0f8!2s3rd+District+Kabul+Police+Department!5e0!3m2!1sen!2s!4v1441555439600" 
                        width="100%" height="250" style="border:0; filter: grayscale(80%) contrast(90%);" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>
  
<?php include 'includes/footer.inc.php'; ?>