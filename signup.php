<?php
session_start();
include 'connection.php';

$errorMessages = array();

$emailValue = ""; 
$passwordValue = "";
$usernameValue = "";
$fnameValue = "";
$mnameValue = "";
$lnameValue = "";
$genderValue = "";
$bdayValue = "";
$contNumValue = "";
$idTypeValue = "";
$idNumValue = "";

if(isset($_POST['submit'])){
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
    $mname = filter_input(INPUT_POST, "mname", FILTER_SANITIZE_SPECIAL_CHARS);
    $lname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
    $gender = filter_input(INPUT_POST, "Gender", FILTER_SANITIZE_SPECIAL_CHARS);
    $bday = filter_input(INPUT_POST, "bday", FILTER_SANITIZE_NUMBER_INT);
    $contNum = filter_input(INPUT_POST, "contNum", FILTER_SANITIZE_NUMBER_INT);
    $idType = filter_input(INPUT_POST, "idType", FILTER_SANITIZE_SPECIAL_CHARS);
    $idNum = filter_input(INPUT_POST, "idNum", FILTER_SANITIZE_SPECIAL_CHARS);
    $idFront = $_POST['frontimage'];
    $idBack = $_POST['backimage'];

    $checkQuery = "SELECT * FROM logcredentials WHERE email = '$email' OR username = '$username'";
    $result1 = mysqli_query($con, $checkQuery);
    if (mysqli_num_rows($result1) > 0) {
        $errorMessages[] = "Email, username, or contact number is already in use. Please choose a different one.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages[] = "Invalid email address.";
    }
    if (strlen($password) < 8 || !preg_match('/[0-9\W]/', $password)) {
        $errorMessages[] = "Password must have at least 8 characters and include at least 1 symbol or number.";
    }
    if (!preg_match('/[0-9\W]/', $password)){
        $errorMessages[] = "Password must include at least 1 symbol or number.";
    }
    if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $errorMessages[] = "Invalid username. Only letters, numbers, and underscores are allowed.";
    }
    $checkQuery2 = "SELECT * FROM user WHERE contNum = '$contNum'";
    $result2 = mysqli_query($con, $checkQuery2);
    if (mysqli_num_rows($result2) > 0) {
        $errorMessages[] = "Contact number is already in use. Please choose a different one.";
    }
    if (!preg_match("/^[a-zA-Z\s]+$/", $fname) || !preg_match("/^[a-zA-Z\s]+$/", $lname)){
        $errorMessages[] = "Numbers and symbols are not allowed in the name field!";
    }
    else{
        if (empty($errorMessages)) {
            $sql1 = "INSERT INTO logcredentials (email, username, password) 
                VALUES ('$email', '$username', '$password')";
            mysqli_query($con, $sql1);
        
            $logID = mysqli_insert_id($con);

            $sql2 = "INSERT INTO user (logID, fname, mname, lname, bday, gender, contNum, idType, idNum, idFront, idBack) 
                    VALUES ($logID, '$fname' , '$mname', '$lname', '$bday', '$gender', '$contNum', '$idType', '$idNum', '$idFront', '$idBack')";
            mysqli_query($con, $sql2);

            echo "<div class='success-message'>You have successfully registered!</div>";
            header('Location: signin.php');
            exit();
        } 
    }

    $emailValue = htmlspecialchars($email);
    $passwordValue = htmlspecialchars($password);
    $usernameValue = htmlspecialchars($username);
    $fnameValue = htmlspecialchars($fname);
    $mnameValue = htmlspecialchars($mname);
    $lnameValue = htmlspecialchars($lname);
    $genderValue = htmlspecialchars($gender);
    $bdayValue = htmlspecialchars($bday);
    $contNumValue = htmlspecialchars($contNum);
    $idTypeValue = htmlspecialchars($idType);
    $idNumValue = htmlspecialchars($idNum);

    mysqli_close($con);

}

?>
<head>
    <meta charset="utf-8">
    <title>Sign-up | MiCasa Events</title>
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
                        <?php
                            if (isset($_SESSION['email'])) {
                                $role = $_SESSION['role'];
                            
                                if ($role == 'admin') {
                                    echo '<a href="Archive.php" class="nav-item nav-link">Archive</a>';
                                }
                            } 
                        ?>
                    </div>
                    <?php
                        if (isset($_SESSION['email'])) {
                            echo '<a href="logout.php" class="btn btn-primary py-2 px-4">Logout</a>';
                        } else {
                            echo '<a href="signin.php" class="btn btn-primary py-2 px-4">Login</a>';
                        }
                    ?>
                </div>
            </nav>
        <!-- Navbar & Hero End -->

        <!--Signin Start-->
        <div class="signup-form">
        <div class="tab_box">
            <div class="tab_btn active">STEP 1</div>
            <div class="tab_btn">STEP 2</div>
            <div class="tab_btn">STEP 3</div>
            <div class="line"></div>
        </div>

        <div class="content_box">
            <form action="signup.php" method="post" class="login_form" >
                <div class="content active">
                    <h2 class="header2">Login Credentials</h2><br>
                    <div class="login_form1" id="step-1">
                        <div class="inputbox">
                            <input type="email" name="email" id="emailInput" value="<?php echo $emailValue; ?>" required><br>
                            <label for="">Email</label>
                        </div>
                        <div class="inputbox">
                            <input type="password" name="password" id="password" value="<?php echo $passwordValue ; ?>" required><br>
                            <label for="">Password</label>
                        </div>
                        <div class="inputbox" >
                            <input type="text" name="username" id="username" value="<?php echo $usernameValue ; ?>" required>
                            <label for="">Username</label>
                        </div>
                        <div class="btn_button">
                            <button type="button" class="next_btn" onclick="nextStep(1)">Next</button>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <h2 class="header2">Personal Information</h2><br>
                    <div class="login_form2" id="step-2">
                        <!-- Row 1: First Name, Middle Name, Last Name -->
                        <div class="form-row1">
                            <div class="inputbox1">
                                <input type="text" name="fname" id="fname" value="<?php echo $fnameValue ; ?>" required>
                                <label for="">First Name</label>
                            </div>
                            <div class="inputbox1" id="middleNameInput">
                                <input type="text" name="mname" id="mname" value="<?php echo $mnameValue; ?>" <?php echo isset($_POST['noMiddleNameCheckbox']) ? 'disabled' : 'required'; ?>>
                                <label for="">Middle Name</label>
                            </div>
                            <div class="inputbox1">
                                <input type="text" name="lname" id="lname" value="<?php echo $lnameValue ; ?>" required>
                                <label for="">Last Name</label>
                            </div>
                        </div>
                        <div class="form-row1">
                            <div class="inputbox1" id="check"></div>
                            <div class="checkbox-container">
                                <input type="checkbox" name="noMiddleNameCheckbox" id="noMiddleNameCheckbox" onchange="toggleMiddleNameField()">
                                <label for="noMiddleNameCheckbox">No Middle Name</label>
                            </div>
                            <div class="inputbox1" id="check"></div>
                        </div>

                        <script>
                            function toggleMiddleNameField() {
                                var middleNameInputBox = document.getElementById('middleNameInputBox');
                                var noMiddleNameCheckbox = document.getElementById('noMiddleNameCheckbox');
                                var middleNameInput = document.getElementById('mname');

                                if (noMiddleNameCheckbox.checked) {
                                    middleNameInput.removeAttribute('required');
                                    middleNameInput.setAttribute('disabled', 'disabled');
                                } else {
                                    middleNameInput.setAttribute('required', 'required');
                                    middleNameInput.removeAttribute('disabled');
                                }
                            }
                        </script>

                        <!-- Row 2: Gender and Birthdate -->
                        <div class="form-row2">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="Gender" class="s3" value="<?php echo $genderValue ; ?>"required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Prefer not to say</option>
                            </select>
                            <label for="bday">Birthdate:</label>
                            <input type="date" name="bday" class="s3" id="bday" value="<?php echo $bdayValue ; ?>" required>
                        </div>

                        <!-- Row 3: Contact Number -->
                        <div class="form-row3">
                            <div class="inputbox1">
                            <input type="text" id="contNum"  name="contNum" maxlength="11" oninput="formatPhoneNumber(this)" value="<?php echo $contNumValue ; ?>" required>
                                <label for="">Contact Number</label>
                            </div>
                        </div>
                        <div class="btn_button">
                            <button type="button" class="prev_btn" onclick="prevStep(2)">Back</button>
                            <button type="button" class="next_btn" onclick="nextStep(2)">Next</button>
                        </div>
                    </div>
                </div>

                <div class="content">
                    <h2 class="header2">Verification</h2><br>
                    <div class="login_form3" step3>
                        <div class="form-row4">
                            <br>
                            <label for="idType">ID Type:</label>
                            <select id="idType" name="idType" class="s3" value="<?php echo $idTypeValue ; ?>" required>
                                <option value="passport">Passport</option>
                                <option value="natID">National ID</option>
                                <option value="drivLicense">Drivers License</option>
                                <option value="sss">SSS/ UMID</option>
                                <option value="philhealth">PhilHealth ID</option>
                                <option value="voter">Voters ID</option>
                                <option value="senior">Senior Citizen ID</option>
                                <option value="ofw">OFW ID</option>
                            </select>
                            <div class="inputbox3">
                                <input type="text" name="idNum" value="<?php echo $idNumValue ; ?>" required><br>
                                <label for="">ID Number</label>
                            </div>
                            <input type="hidden" name="step" value="3">
                        </div>
                        <div class="form-row5">
                            <div class="file-input">
                                <label for="front-image">Front of ID:</label>
                                <input type="file" name="frontimage" id="front-image" accept="image/*" required>
                            </div>
                            <div class="file-input">
                                <label for="back-image">Back of ID:</label>
                                <input type="file" name="backimage" id="back-image" accept="image/*" required>
                            </div>
                        </div>
                        <div class="btn_button">
                            <button type="button" class="prev_btn" onclick="prevStep(3)">Back</button>
                            <input type="submit" name="submit" value="Sign Up">
                        </div>
                    </div>
                </div>
            </form>
            <div>
            <?php
                if (!empty($errorMessages)) {
                    echo '<div class="error-message">Error(s) occurred:<ul>';
                    foreach ($errorMessages as $errorMessage) {
                        echo '<li>' . $errorMessage . '</li>';
                    }
                    echo '</ul></div>';
            
                    echo '<script>alert("Registration unsuccessful. Please check the error messages.");</script>';
                } 
                ?>
            </div>
        </div>
    </div>

    <script>
        function showStep(step) {
            var steps = document.querySelectorAll('.content');
            var tab_btn = document.querySelector('.line');

            for (var i = 0; i < steps.length; i++) {
                steps[i].classList.remove('active');
            }

            steps[step - 1].classList.add('active');

            tab_btn.style.left = (step - 1) * (33.33) + '%';
        }

        function nextStep(currentStep) {
            if (currentStep < 3) {
                showStep(currentStep + 1);
            }
        }

        function prevStep(currentStep) {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        }

        showStep(1);

        function formatPhoneNumber(input) {

            const phoneNumber = input.value.replace(/\D/g, '');

            if (phoneNumber.length === 0) {
                input.value = '';
            } else {
                const formattedPhoneNumber = phoneNumber.replace(/(\d{4})(\d{3})(\d{4})/, '$1-$2-$3');
                input.value = formattedPhoneNumber.slice(0, 13);
            }
        }
    </script>
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

