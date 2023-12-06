<?php
session_start();
include 'connection.php';

// Check if the user is logged in and has the admin role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: unauthorize.php"); 
    exit();
}
?>

<head>
    <meta charset="utf-8">
    <title>Archive | MiCasa Events</title>
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
    <link href="css\style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
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

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Archive</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="Home.php">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Archive</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!--Header Start-->
        <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="filter-container">
                            <div class="row g-3" style="margin-top: 10px; margin-bottom: 10px;">
                                <div class="col-md-9">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="searchQuery" placeholder="Search Events/Users Information" id="searchQuery" required>
                                        <label for="event" class="booking-label">Search Events/Users Information</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="archive_btn btn-primary w-100 py-3" onclick="searchQuery()">Search</button>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                    <select class="form-select" id="year" name="year" onchange="updateMonths()" required>
                                        <option selected disabled value="">Select Year</option>
                                        <?php
                                        $getDate = "SELECT DISTINCT YEAR(eventDate) AS year FROM eventinfo ORDER BY year DESC";
                                        $result = mysqli_query($con, $getDate);

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=\"{$row['year']}\">{$row['year']}</option>";
                                        }
                                        ?>
                                    </select>
                                        <label for="pk" class="booking-label">Year</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating">
                                    <select class="form-select" id="month" name="month" required>
                                        <option selected disabled value="">Select Month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>

                                        <label for="pk" class="booking-label">Month</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="ballroom" name="FRoom" required>
                                            <option selected disabled value="">Select Ballroom</option>
                                            <option value="sb" >Silver Ballroom</option>
                                            <option value="gb" >Golden Ballroom</option>
                                            <option value="pb" >Platinum Ballroom</option>
                                            <option value="db" >Diamond Ballroom</option>
                                        </select>
                                        <label for="fr" class="booking-label">Function Room</label>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <button type="button" class="archive_btn btn-primary w-100 py-3" onclick="searchEvents()">Search Events</button>

                                    <script>
                                        function searchEvents() {
                                            var selectedMonth = document.getElementById("month").value;
                                            console.log("Search for events in month " + selectedMonth);
                                        }
                                    </script>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div id="searchResults" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Header End-->

        <!--Table Start-->
        <div id="table-container" class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-12">
                        <table id="result-table" class="table">

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <dialog id="paymentDialog">
            <button id="closePaymentDialog" onclick="closePaymentDialog()">&times;</button> 
            <h1>Payment Details</h1>
            <h5>Event: <span id="eventName"></span></h5>
            <br>
            <hr>
            <br>
            <p><b>Status: </b><span id="paymentStatus"></span></p>
            <p><b>Total Amount: </b><span id="totalPayment"></span></p>
            <p><b>Partial Payment: </b><span id="downPayment"></span></p>
            <p><b>Date of Payment: </b><span id="downPaymentDate"></span></p>
            <p><b>Full Payment: </b><span id="balance"></span></p>
            <p><b>Date of Payment: </b><span id="fullPaymentDate"></span></p>

            <form action="archive_fullPay.php" method="post" class="Archive_fullPay" >
            <div id="paymentForm">
                <div class="col-md-12" style="margin-bottom: 20px;">
                    <div class="form-floating">
                        <select class="form-select" id="payType" name="payType" onchange="selectOption()" required>
                        <option selected disabled value="">Select Payment Method</option>
                        <optgroup label="Online Payment">
                            <option value="gcash">GCash</option>
                            <option value="maya">Paymaya</option>
                        </optgroup>
                        <optgroup label="Card Payment">
                            <option value="pA">Credit Card</option>
                            <option value="pB">Debit Card</option>
                        </optgroup>
                        <option value="cash">Cash</option>
                        </select>
                        <label for="select1 " class="booking-label">Type of Payment</label>
                    </div>
                </div>
                
                <div class="col-md-12" style="display: none;" id="referenceNumberField">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="refNum" id="referenceNumber" placeholder="Reference Number">
                        <label for="referenceNumber" class="booking-label">Reference Number</label>
                    </div>
                </div>

                <div class="col-md-12" style="display: none;" id="cardDetailsField">
                    <div class="col-md-12" style="margin-bottom: 15px;">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="cardNum" id="cardNum" placeholder="Card Number" maxlength="19" oninput="formatCardNumber(this)">
                            <label for="cardNum" class="booking-label">Card Number</label>
                        </div>
                    </div>

                    <!--Javascript for CardNumber input-->
                    <script>
                        function formatCardNumber(input) {
                            const cursorPosition = input.selectionStart;

                            const cardNumber = input.value.replace(/\D/g, '');

                            let formattedCardNumber = '';
                            for (let i = 0; i < cardNumber.length; i++) {
                                if (i > 0 && i % 4 === 0) {
                                    formattedCardNumber += '-';
                                }
                                formattedCardNumber += cardNumber[i];
                            }

                            input.value = formattedCardNumber;

                            const newPosition = cursorPosition + (formattedCardNumber.length - cardNumber.length);
                            input.setSelectionRange(newPosition, newPosition);
                        }

                    </script>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" name="cvv" id="cvv" placeholder="CVV" maxlength="3" oninput="formatCVV(this)">
                                <label for="cvv" class="booking-label">CVV</label>
                            </div>
                        </div>
                        
                        <!--Javascript for CVV-->
                        <script>
                            function formatCVV(input) {
                                const cvv = input.value.replace(/\D/g, '');

                                input.value = cvv.slice(0, 3);
                            }
                        </script>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="month" class="form-control" name="expDate" id="expDate" placeholder="Exp Date">
                                <label for="expDate" class="booking-label">Exp Date</label>
                            </div>
                        </div>
                        
                        <!--Javascript for expDate-->
                        <script>
                            const currentDate = new Date();
                            const currentYear = currentDate.getFullYear();
                            const currentMonth = (currentDate.getMonth() + 1).toString().padStart(2, '0'); 

                            const monthInput = document.getElementById("expDate");
                            monthInput.min = `${currentYear}-${currentMonth}`;
                        </script>

                    </div>
                </div>

                <div class="col-md-12" style="display: none;" id="cashField">
                    <div class="form-floating" style="margin-bottom: 20px;">
                        <input type="text" class="form-control" name="receiptNum" id="receiptNum" placeholder="Receipt Number">
                        <label for="receiptNum" class="booking-label">Receipt Number</label>
                    </div>  
                    <div class="file-input">
                        <label for="receiptPic" class="booking-label">Receipt Picture: </label>
                        <input type="file" name="receiptImg" id="receiptPic" accept="image/*">
                    </div>
                </div>

                <!--JavaScript for Payment Method Additional Fields-->
                <script>
                    function selectOption() {
                        const payType = document.getElementById("payType").value;
                        const referenceNumberField = document.getElementById("referenceNumberField");
                        const cardDetailsField = document.getElementById("cardDetailsField");
                        const cashField = document.getElementById("cashField");

                        referenceNumberField.style.display = "none";
                        document.getElementById("referenceNumber").removeAttribute("required");

                        cardDetailsField.style.display = "none";
                        document.getElementById("cardNum").removeAttribute("required");
                        document.getElementById("cvv").removeAttribute("required");
                        document.getElementById("expDate").removeAttribute("required");

                        cashField.style.display = "none";
                        document.getElementById("receiptNum").removeAttribute("required");
                        document.getElementById("receiptPic").removeAttribute("required");


                        if (payType === "gcash" || payType === "maya") {
                            referenceNumberField.style.display = "block";
                            document.getElementById("referenceNumber").setAttribute("required", "required");
                        } else if (payType === "pA" || payType === "pB") {
                            cardDetailsField.style.display = "block";
                            document.getElementById("cardNum").setAttribute("required", "required");
                            document.getElementById("cvv").setAttribute("required", "required");
                            document.getElementById("expDate").setAttribute("required", "required");
                        } else if (payType === "cash") {
                            cashField.style.display = "block";
                            document.getElementById("receiptNum").setAttribute("required", "required");
                            document.getElementById("receiptPic").setAttribute("required", "required");
                        }
                    }
                </script>

                <input type="submit" name="submit" class="archive_btn btn-primary w-100 py-3" style="margin-top: 20px;" value="Pay">
            </div>
            </form>
        </dialog>

        <script>
            function displaySearchResults(results) {
                var resultsContainer = document.getElementById("searchResults");
                resultsContainer.innerHTML = ""; 

                if (results.length > 0) {
                    var resultHTML = "<div class='table-responsive'><table class='table bordered-table'><thead><tr><th></th><th>Email</th><th>Full Name</th><th>Contact Number</th><th>Package</th><th>Event Type</th><th>Number of Attendees</th><th>Event Date</th><th>Event Time Start</th><th>Event Time End</th><th>Overtime</th><th>Request</th><th>Date Booked</th><th>Payment Status</th></tr></thead><tbody>";

                    for (var i = 0; i < results.length; i++) {
                        resultHTML += "<tr>" +
                            "<td>" + (i + 1) + "</td>" +
                            "<td>" + results[i].email + "</td>" +
                            "<td>" + results[i].fname + " " + results[i].lname + "</td>" +
                            "<td>" + results[i].contNum + "</td>" +
                            "<td>" + results[i].package + "</td>" +
                            "<td>" + results[i].eventType + "</td>" +
                            "<td>" + results[i].numAttendee + "</td>" +
                            "<td>" + results[i].eventDate + "</td>" +
                            "<td>" + results[i].eventTimeStart + "</td>" +
                            "<td>" + results[i].eventTimeEnd + "</td>" +
                            "<td>" + results[i].overtime + "</td>" +
                            "<td>" + (results[i].request ? results[i].request : '-') + "</td>" + 
                            "<td>" + results[i].date_booked + "</td>" +
                            "<td><a class='btn btn-link' id='paymentLink' onclick='showPaymentDetails(" + results[i].eventID + ")'>" + results[i].paymentStatus + "</a></td>" +
                            "</tr>";
                    }

                    resultHTML += "</tbody></table></div>";
                    resultsContainer.innerHTML = resultHTML;
                } else {
                    resultsContainer.innerHTML = "<p class='text-center fw-bold mt-5'>No results found.</p>";
                }
            }

            function searchEvents() {
                var selectedYear = document.getElementById("year").value;
                var selectedMonth = document.getElementById("month").value;
                var selectedRoom = document.getElementById("ballroom").value;

                $.ajax({
                    type: "POST",
                    url: "search_events.php",
                    data: { month: selectedMonth, year: selectedYear, room: selectedRoom },
                    success: function (data) {
                        console.log(data);

                        displaySearchResults(JSON.parse(data));
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            function updateMonths() {
                var selectedYear = $("#year").val();
                console.log("Selected Year: " + selectedYear);
                console.log("Year changed")

                $.ajax({
                    type: "POST",
                    url: "fetch_booked_months.php",
                    data: { year: selectedYear },
                    success: function (data) {
                        var bookedMonths = JSON.parse(data);

                        $("#month").prop("disabled", false);

                        $("#month option:not(:first-child)").each(function () {
                            var month = $(this).val();
                            var isBooked = (bookedMonths.indexOf(month) !== -1);
                            $(this).toggle(isBooked); 
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            function searchQuery() {
                var keyword = document.getElementById("searchQuery").value.trim().toLowerCase();

                $.ajax({
                    type: "POST",
                    url: "query_events.php",
                    data: { keyword: keyword },
                    success: function (data) {
                        console.log(data);

                        displaySearchResults(JSON.parse(data));
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            const paymentDialog = document.getElementById("paymentDialog");
            
            function showPaymentDetails(eventId) {
                $.ajax({
                    type: "POST",
                    url: "get_payment_details.php",
                    data: { eventId: eventId },
                    success: function (data) {
                        var paymentDetails = JSON.parse(data);

                        $("#eventName").text(paymentDetails[0].eventType); 
                        $("#paymentStatus").text(paymentDetails[0].paymentStatus.toUpperCase());
                        $("#totalPayment").text(parseFloat(paymentDetails[0].total_bill).toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }));
                        $("#downPayment").text(parseFloat(paymentDetails[0].downpayment).toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }));
                        $("#downPaymentDate").text(new Date(paymentDetails[0].date_booked.replace(/-/g, '/')).toLocaleString('en-US', { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true }));
                        $("#balance").text(parseFloat(paymentDetails[0].balance).toLocaleString('en-PH', { style: 'currency', currency: 'PHP' }));
                        $("#fullPaymentDate").text(new Date(paymentDetails[0].eventDate).toLocaleDateString('en-PH', { year: 'numeric', month: 'long', day: 'numeric' }));
                        
                        if (paymentDetails[0].paymentStatus.toLowerCase() !== 'paid') {
                            $('#paymentForm').show();
                        } else {
                            $('#paymentForm').hide();
                        }

                        paymentDialog.showModal();
                        
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            function closePaymentDialog() {
                paymentDialog.close();
            }



        </script>

        <!--Table End-->

        <!-- Javascript to display payment success -->
        <script>

        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('message')) {
            var successMessage = urlParams.get('message');
            Swal.fire({
                title: 'Success',
                text: successMessage,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }
        </script>

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
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

    </div>

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

    <!-- Include jQuery UI library -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>
</html>

