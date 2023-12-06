<?php 
session_start();
include 'connection.php';

$error_message = ""; 

if(isset($_GET['submit'])){
$email = $_GET['email'];
$password = $_GET['password'];

$querry = "SELECT * FROM logcredentials WHERE email = '$email'";

$result = mysqli_query($con,$querry);

if(mysqli_num_rows($result)<=0) {
    $error_message = 'Invalid email or password!';
    echo '<script>hideErrorMessage();</script>';
    goto here;
}
else{
    $row = mysqli_fetch_array($result);
    
    if($password==$row['password'])
    {
        $_SESSION["email"] = $email;
        $_SESSION["role"] = $row[7];
        header("location: Home.php");
        exit();
    }else {
        $error_message = 'Invalid email or password!';
        echo '<script>hideErrorMessage();</script>';
    }
    here:
    mysqli_close($con);
}
}
?>

<head>
    <meta charset="utf-8">
    <title>Sign-in | MiCasa Events</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/calendar2-event-fill.svg" rel="icon" type="image/svg+xml">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    
    <link rel="stylesheet" type="text/css" href="signStyle.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body>
        <!-- Navbar & Hero Start -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0">
                    <i class=" fa fa-duotone fa-calendar me-3"></i>Mi Casa</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="Home.php" class="nav-item nav-link">Home</a>
                        <a href="Packages.php" class="nav-item nav-link">Packages</a>
                        <a href="Booking.php" class="nav-item nav-link">Booking</a>
                        <a href="About.php" class="nav-item nav-link">About us</a>
                </div>
            </nav>
        <!-- Navbar & Hero End -->

        <!--Signin Start-->
            <div class="form-box">
                <div class="form-value">
                    <form method="get">
                        <h2>LOGIN</h2>
                        <div class="inputbox3">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="text" id="email" name="email" required>
                            <label for="">Email</label>
                        </div>
                        <div class="inputbox3">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" id="password" name="password" required>
                            <label for="">Password</label>
                        </div>
                        <div class="forget">
                            <label><a href="fpass.php">Forgot Password</a></label>
                        </div>
                        <div class="buttons">
                            <input type="submit" name="submit" class="back_btn" value="Log in">
                            <div class="register">
                                <p>Don't have an account?<a href="signup.php"> Register</a></p>
                            </div>
                        </div> 
                    </form>
                    <div class="error-message">
                        <?php echo $error_message; ?>
                    </div>
                </div>
            </div>
        <!--Signin End-->

        <!-- Footer Start -->
        <div class="container-fluid text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-4 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Company</h4>
                        <a class="btn btn-link" href="About.php">About us</a>
                        <a class="btn btn-link" href="Booking.php">Booking</a>
                        <a class="btn btn-link" id="privacyLink" onclick="showPrivacyDialog()">Privacy Policy</a>
                        <a class="btn btn-link" id="termsLink" onclick="showTermsDialog()">Terms & Condition</a>
                    </div>

                    <dialog id="privacyDialog">
                        <button id="closePrivacyDialog" onclick="closePrivacyDialog()">&times;</button> 
                        <h1>Privacy Policy for MiCasa Events</h1>
                        <h5>Effective Date: November 1, 2023</h5>
                        <br>
                        <hr>
                        <br>
                        <p><b>1. Introduction</b></p>
                        <p class="non-bold"> Welcome to MiCasa Events. At MiCasa Events, we are committed to protecting your privacy and ensuring 
                            the security of your personal information. This Privacy Policy explains how we collect, use, 
                            and safeguard your information when you use our services and visit our website.</p>

                        <p><b>2. Information We Collect</b></p>

                        <p class="non-bold">We may collect various types of information, including but not limited to:
                            <ul><i>Personal Information:</i> This includes your name, email address, phone number, and any other information you provide to us.</ul>
                            <ul><i>Information:</i> We collect data about your interactions with our website and services, including your IP address, browser type, and pages visited.</ul>
                            <ul><i>Cookies and Tracking Technologies:</i> We may use cookies and similar technologies to collect information about your browsing habits.</ul></p>
                            
                        <p><b>3. How We Use Your Information</b></p>
                        <p class="non-bold"> We use the information we collect for various purposes, including but not limited to:
                            <br>•Providing and improving our services.
                            <br>•Communicating with you.
                            <br>•Personalizing your experience.
                            <br>•Analyzing website usage and trends.</p>

                        <p><b>4. Disclosure of Your Information</b></p>
                        <p class="non-bold">We may share your information with third parties in certain circumstances, such as:
                            <ul><i>Providers:</i> We may use third-party service providers to assist in delivering our services.</ul>
                            <ul><i>Legal Obligations:</i> We may share your information if required by law or to protect our rights and interests.</ul></p>
                        
                        <p><b>5. Data Security</b></p>
                        <p class="non-bold"> We take measures to protect your information from unauthorized access, disclosure, or alteration. 
                            However, no method of transmission over the internet or electronic storage is completely secure, 
                            and we cannot guarantee absolute security.</p>
                                                
                        <p><b> 6. Your Choices</b></p>
                        <p class="non-bold">You have the right to access, correct, or delete your personal information. 
                            You can also opt-out of marketing communications at any time.</p>
                        
                        <p><b>7. Children's Privacy</b></p>
                        <p class="non-bold">Our services are not intended for individuals under the age of 18. 
                            We do not knowingly collect or store information from children.</p>

                        <p><b>8. Changes to This Privacy Policy</b></p>
                        <p class="non-bold">We may update this Privacy Policy from time to time. 
                            Please check back periodically to review any changes.</p>

                        <p><b>9. Contact Us</b></p>
                        <p class="non-bold">If you have questions or concerns about this Privacy Policy, please contact us at 09123456789.</p>
                    </dialog>

                    <dialog id="termsDialog">
                        <button id="closePrivacyDialog" onclick="closeTermsDialog()">&times;</button> 
                        <h1>Terms and Conditions for MiCasa Events</h1>
                        <h6>Please read the following terms and conditions carefully before making a booking with MiCasa Events. 
                            By booking an event with us, you agree to abide by these terms and conditions.</h6>
                        <br>
                        <hr>
                        <br>
                        <p><b>1. Booking and Payment</b></p>
                        <p class="non-bold"> 1.1 <b>Downpayment:</b> A downpayment of 30% of the total event cost is required to secure your booking. The downpayment can be made through GCash, PayMaya, or credit and debit card.
                            <br><br>1.2. <b>Final Payment:</b> The remaining balance of the total event cost must be settled on the day of the event before the event begins.
                            <br><br>1.3. <b>Booking Lead Time:</b> Bookings must be made at least 2 weeks before the scheduled event date.</p>

                        <br><p><b>2. Overtime Charges</b></p>
                        <p class="non-bold">2.1. <b>Event Duration:</b> The booking time includes the set-up, event duration, and teardown. Any event exceeding the agreed-upon end time during booking will be subject to overtime charges.
                            <br><br>2.2. <b>Overtime Fees:</b> An additional 10% of the function room base price will be added for every hour or fraction thereof that the event goes overtime based on the selected end time during booking.</p>
                            
                        <br><p><b>3. Function Room Upgrades</b></p>
                        <p class="non-bold"> 3.1. <b>Package:</b> The prices quoted are for the base package. Any function room upgrades will result in an additional charge.
                            <br><br>3.2. <b>Upgrade Fee:</b> An additional 15% of the function room base price is added to the base package price for every function room upgrade.</p>

                        <br><p><b>4. Cancellation and Refunds</b></p>
                        <p class="non-bold">4.1. <b>Cancellation:</b> If you need to cancel your booking, please do so at least 2 weeks in advance to receive a full refund of the downpayment, minus a 10% processing fee.
                            <br><br>4.2. <b>Refund Policy:</b> Refunds for cancellations made within 2 weeks of the event date may be subject to a 10% processing fee, resulting in a 90% refund of the downpayment.</p>
                        
                        <br><p><b>5. House Rules</b></p>
                        <p class="non-bold">5.1. <b>Adherence to Rules:</b> Clients and guests are expected to adhere to the house rules and guidelines provided by MiCasa Events for a safe and enjoyable experience.
                            <br><br>5.2. <b>Liability:</b> MiCasa Events is not responsible for any loss or damage to personal property or injuries sustained during the event.</p>
                                                
                        <br><p><b>6. Contact Information</b></p>
                        <p class="non-bold">For any questions, concerns, or to make changes to your booking, please contact us at 09123456789 or email us at micasa.cosc75g2@gmail.com.
                            <br><br>By booking with MiCasa Events, you acknowledge that you have read and agreed to these terms and conditions.</p>
                    </dialog>

                    <script>
                        const privacyDialog = document.getElementById("privacyDialog");
                        const termsDialog = document.getElementById("termsDialog");

                        function showPrivacyDialog() {
                            privacyDialog.showModal();
                        }

                        function showTermsDialog() {
                            termsDialog.showModal();
                        }

                        function closePrivacyDialog() {
                            privacyDialog.close();
                        }

                        function closeTermsDialog() {
                            termsDialog.close();
                        }
                    </script>

                    <div class="col-lg-4 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Carmona, Cavite, Philippines</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>0912 345 6789</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>micasa.cosc75g2@gmail.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Opening</h4>
                        <h5 class="text-light fw-normal">Monday - Saturday</h5>
                        <p>08AM - 05PM</p>
                        <h5 class="text-light fw-normal">Sunday</h5>
                        <p>10AM - 06PM</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">MiCasa Events Place</a>, All Right Reserved. 
                            
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            <br>Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                            &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include jQuery UI library -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>
</html>

