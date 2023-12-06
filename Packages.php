<?php 
 session_start();
?>

<head>
    <meta charset="utf-8">
    <title>Mi Casa Events Place</title>
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
    <link href="css/style.css" rel="stylesheet">
    <link href="css/packages.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="style.css" />
    <script src="script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0">
                    <i class=" fa fa-duotone fa-calendar me-3"></i>Mi Casa</h1>
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
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Packages</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Packages</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Packages Start -->
        <div class="container-xxl pt-5 pb-3">
            <div class="container">
                <section id="section-feature" class="container wow fadeInUp" data-wow-delay="0.9s">
                    
                    <!-- new row-->
                    <div class="row g-4 justify-content-center package-m-fix" >
                
                        <!-- Weddings -->
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <div class="sf-wrap">
                                <div class="sf-mdl-left">
                                    <div class="wed-bg">
                                        <img src="img/wedding.jpg" alt="">
                                    </div>
                                    <h3>Weddings</h3>
                                </div>
                                <div class="sf-mdl-right">
                                    <div class="wed-bg-r">
                                        <img src="img/weddingR.jpg" alt="">
                                    </div>
                                    <h3>Weddings</h3>
                                </div>
                                <div class="sf-mdl-left-full">
                                    <h3>Weddings</h3>
                                    <p>Elevate your wedding day with our all-inclusive package, featuring a stunning venue, custom menu, and personalized decor for a truly unforgettable experience.</p>
                                </div>
                                <div class="sf-mdl-right-full">
                                    <h3><a>Weddings</a></h3>
                                    <p>Elevate your wedding day with our all-inclusive package, featuring a stunning venue, custom menu, and personalized decor for a truly unforgettable experience.</p>
                                </div>
                            </div>
                        </li>

                        <!-- Birthdays -->
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <div class="sf-wrap">
                                <div class="sf-mdl-left">
                                    <div class="bday-bg">
                                        <img src="img/BIRTHDAYS-L.jpg" alt="">
                                    </div>
                                    <h3>Birthdays</h3>
                                </div>
                                <div class="sf-mdl-right">
                                    <div class="bday-bg-r">
                                        <img src="img/BIRTHDAYS-r.jpg" alt="">
                                    </div>
                                    <h3>Birthdays</h3>
                                </div>
                                <div class="sf-mdl-left-full">
                                    <h3>Birthdays</h3>
                                    <p>Transform your birthday celebration with our customizable packages, offering themed decor, delectable catering, and entertainment to create an unforgettable party experience for all ages.</p>
                                </div>
                                <div class="sf-mdl-right-full">
                                    <h3>Birthdays</h3>
                                    <p>Transform your birthday celebration with our customizable packages, offering themed decor, delectable catering, and entertainment to create an unforgettable party experience for all ages.</p>
                                </div>
                            </div>
                        </li>

                        <!-- All Occasions -->
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <div class="sf-wrap">
                                <div class="sf-mdl-left">
                                    <div class="g-bg">
                                        <img src="img/gatherings-L.jpg" alt="">
                                    </div>
                                    <h3>All Occasions</h3>
                                </div>
                                <div class="sf-mdl-right">
                                    <div class="g-bg-r">
                                        <img src="img/gatherings-R.jpeg" alt="">
                                    </div>
                                    <h3>All Occasions</h3>
                                </div>
                                <div class="sf-mdl-left-full">
                                    <h3>All Occasions</h3>
                                    <p>Make any occasion extraordinary with our all-inclusive event packages, offering versatile venues, expert planning, and personalized details to ensure unforgettable moments.</p>
                                </div>
                                <div class="sf-mdl-right-full">
                                    <h3>All Occasions</h3>
                                    <p>Make any occasion extraordinary with our all-inclusive event packages, offering versatile venues, expert planning, and personalized details to ensure unforgettable moments.</p>
                                </div>
                            </div>
                        </li>

                        <!-- Function Rooms -->
                        <li class="col-md-3 col-sm-6 col-xs-12">
                            <div class="sf-wrap">
                                <div class="sf-mdl-left">
                                    <div class="rooms-bg">
                                        <img src="img/rooms.jpg" alt="">
                                    </div>
                                    <h3>Function Rooms</h3>
                                </div>
                                <div class="sf-mdl-right">
                                    <div class="rooms-bg-r">
                                        <img src="img/roomsR.jpg" alt="">
                                    </div>
                                    <h3>Function Rooms</h3>
                                </div>
                                <div class="sf-mdl-left-full">
                                    <h3>Function Rooms</h3>
                                    <p>Our function rooms provide a versatile and elegant space to host events, from corporate meetings to social gatherings, offering the ideal setting for a wide range of occasions.</p>
                                </div>
                                <div class="sf-mdl-right-full">
                                    <h3>Function Rooms</h3>
                                    <p>Our function rooms provide a versatile and elegant space to host events, from corporate meetings to social gatherings, offering the ideal setting for a wide range of occasions.</p>
                                </div>
                            </div>
                        </li>
                    </div> 
                </section>

                    <!-- Subpackages Start -->
                    <!-- Subpackages Header -->
                    <div class="text-center wow fadeInDown" data-wow-delay="0.1s">
                        <br/><br/><br/>
                        <h1 class="section-title ff-secondary text-center text-primary fw-normal">Wedding</h1>
                        <h5 class="mb-5">Packages</h5>
                    </div>                  
                    <!-- Wedding Subpackages Start -->
                    <div class="subpackage">
                        <div class="container">
                            <div class="subpackage__grid">
                                <!-- Intimate Wedding Subpackages -->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <!--<img src="img/Intimate_Wedding.jpg" />-->
                                        <div class="subpackage-card__title">Intimate</div>
                                        <div class="subpackage-card__price">Php 50, 000
                                            <span>/ 50 pax</span>
                                        </div>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li>Use of Function Room for 4 hours (Silver or Golden Ballroom)</li>
                                            <li>Use of Tiffany Chairs</li>
                                            <li>Table Setting and Physical Arrangement of the Area</li>
                                            <li>Use of Cake Table, Registration Table and Gift Table</li>
                                            <li>Use of Red Carpet</li>
                                            <li>Basic Sound System for Public Address and Background Music</li>
                                            <li>Full Bottle of Sparkling Wine for Ceremonial Toast</li>
                                            <li>Guest Book and Pen</li>
                                            <li>Use of Bubble Machine and Fog Machine</li>
                                            <li>Food Tasting for 2 persons</li>
                                        </ul>
                                        <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                    </div>
                                </div>
                                <!-- Intimate Wedding Package End-->

                                <!-- Classic Wedding Package Start-->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <div class="subpackage-card__title">Classic</div>
                                        <div class="subpackage-card__price">Php 150, 000
                                            <span>/ 150 pax</span>
                                        </div>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li>Use of Function Room for 4 hours (Silver, Golden or Platinum Ballroom)</li>
                                            <li>Use of Tiffany Chairs</li>
                                            <li>Table Setting and Physical Arrangement of the Area</li>
                                            <li>Use of Cake Table, Registration Table and Gift Table</li>
                                            <li>Use of Red Carpet</li>
                                            <li>Basic Sound System for Public Address and Background Music</li>
                                            <li>Full Bottle of Sparkling Wine for Ceremonial Toast</li>
                                            <li>Guest Book and Pen</li>
                                            <li>Use of Bubble Machine and Fog Machine</li>
                                            <li>Food Tasting for 2 persons</li>
                                            <li>Photo booth</li>
                                            <li>Dedicated Professional Events Personnel to attend to your necessities</li>
                                        </ul>
                                        <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                    </div>
                                </div>
                                <!-- Classic Wedding Package End-->

                                <!-- Deluxe Wedding Package Start-->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <div class="subpackage-card__title">Deluxe</div>
                                        <div class="subpackage-card__price">Php 200, 000
                                            <span>/ 200 pax</span>
                                        </div>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li>Use of Function Room for 4 hours (Diamond Ballroom)</li>
                                            <li>Use of Tiffany Chairs</li>
                                            <li>Table Setting and Physical Arrangement of the Area</li>
                                            <li>Use of Cake Table, Registration Table and Gift Table</li>
                                            <li>Use of Red Carpet</li>
                                            <li>Basic Sound System for Public Address and Background Music</li>
                                            <li>Full Bottle of Sparkling Wine for Ceremonial Toast</li>
                                            <li>Guest Book and Pen</li>
                                            <li>Use of Bubble Machine and Fog Machine</li>
                                            <li>Food Tasting for 2 persons</li>
                                            <li>Photo booth</li>
                                            <li>Dedicated Professional Events Personnel to attend to your necessities</li>
                                        </ul>
                                    </div>
                                    <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                </div>
                                <!-- Deluxe Wedding Package End-->
                            </div>
                        </div>

                        <!-- Slideshow Start -->
                        <div class="Weddingcontainer">
                            <div class="galleryHeader wow fadeInDown">
                                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Gallery</h5>
                                <h1 class="mb-5">Weddings</h1>
                            </div>
                            <section class="container">
                            <div class="slider-wrapper">
                                <div class="slider">
                                    <img id="slide-1" src="img/Wedding/Wed1.jpg" alt="imgw-1" />
                                    <img id="slide-2" src="img/Wedding/Wed13.jpg" alt="imgw-2" />
                                    <img id="slide-3" src="img/Wedding/Wed3.jpg" alt="imgw-3" />
                                    <img id="slide-4" src="img/Wedding/Wed4.jpg" alt="imgw-4" />
                                    <img id="slide-5" src="img/Wedding/Wed5.jpg" alt="imgw-5" />
                                    <img id="slide-6" src="img/Wedding/Wed6.jpg" alt="imgw-6" />
                                    <img id="slide-7" src="img/Wedding/Wed7.jpg" alt="imgw-7" />
                                    <img id="slide-8" src="img/Wedding/Wed8.jpg" alt="imgw-8" />
                                    <img id="slide-9" src="img/Wedding/Wed9.jpg" alt="imgw-9" />
                                    <img id="slide-10" src="img/Wedding/Wed10.jpg" alt="imgw-10" />
                                </div>
                                <div class="slider-nav">
                                    <a href="#slide-1"></a>
                                    <a href="#slide-2"></a>
                                    <a href="#slide-4"></a>
                                    <a href="#slide-5"></a>
                                    <a href="#slide-6"></a>
                                    <a href="#slide-7"></a>
                                    <a href="#slide-8"></a>
                                    <a href="#slide-9"></a>
                                    <a href="#slide-10"></a>
                                </div>
                            </div>
                        </section>

                        </div>
                        <!-- Slideshow End -->

                        <!-- Birthday Subpackages Start-->
                        <div class="text-center wow fadeInDown" data-wow-delay="0.1s">
                            <br/><br/><br/>
                            <h1 class="section-title ff-secondary text-center text-primary fw-normal">Birthday</h1>
                            <h5 class="mb-5">Packages</h5>
                        </div> 
                        <div class="subpackage">
                        <div class="container">
                            <div class="subpackage__grid">
                                <!-- Kiddie Birthday Subpackage -->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <!--<img src="img/Intimate_Wedding.jpg" />-->
                                        <div class="subpackage-card__title">Kiddie</div>
                                        <div class="subpackage-card__price">Php 90, 000
                                            <span>/ 50 Adults and 25 Kids</span>
                                        </div>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li>Use of private function room for 4 hours (Golden or Platinum Ballroom)</li>
                                            <li>Banquet set-up according to your color motif</li>
                                            <li>Party host and magician</li>
                                            <li>Balloon twisting show</li>
                                            <li>Balloon arrangements: 10pcs. Hanging balloons, Table centerpieces, Cake ark and 2</li>
                                            <li>Balloon pillars</li>
                                            <li>Bubble machine</li>
                                            <li>Basic sound system for public address and background music</li>
                                        </ul>
                                        <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                    </div>
                                </div>
                                <!-- Kiddie Birthday Package End-->

                                <!-- Debut Birthday Package Start-->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <div class="subpackage-card__title">Debut</div>
                                        <div class="subpackage-card__price">Php 175, 000
                                            <span>/ 120 pax</span>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li>Use of Function Room for 4 hours (Silver, Golden or Platinum Ballroom)</li>
                                            <li>Use of tiffany chairs and red carpet</li>
                                            <li>Banquet set-up according to your color motif</li>
                                            <li>Floral centerpieces for presidential, buffet, and guest tables</li>
                                            <li>18 Roses and 18 Candles</li>
                                            <li>Photobooth</li>
                                            <li>Tarpaulin</li>
                                            <li>Bubble machine and fog machine</li>
                                            <li>Food tasting for two persons</li>
                                            <li>Basic sound system for public address and background music</li>
                                        </ul>
                                        <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                    </div>
                                </div>
                                <!-- Debut Birthday Package End-->

                                <!-- Basic Birthday Package Start-->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <div class="subpackage-card__title">Basic</div>
                                        <div class="subpackage-card__price">Php 100, 000
                                            <span>/ 100 pax</span>
                                        </div>
                                        <br/>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li>Use of private function room for 4 hours (Silver or Golden Ballroom)</li>
                                            <li>Use of tiffany chairs and red carpet</li>
                                            <li>Photobooth</li>
                                            <li>Tarpaulin</li>
                                            <li>Bubble machine and fog machine</li>
                                            <li>Food tasting for two persons</li>
                                            <li>Basic sound system for public address and background music</li>
                                        </ul>
                                    </div>
                                    <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                </div>
                                <!-- Basic Birthday Package End-->
                            </div>
                        </div>
                        <!-- Birthday Subpackages End-->

                        <!-- Slideshow Start -->
                        <div class="Bdaycontainer">
                            <div class="galleryHeader wow fadeInDown">
                                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Gallery</h5>
                                <h1 class="mb-5">Birthday</h1>
                            </div>

                            <section class="container">
                            <div class="slider-wrapper">
                                <div class="slider">
                                    <img id="slide-11" src="img/Birthday/Birth1.jpg" alt="imgb-1" />
                                    <img id="slide-12" src="img/Birthday/Birth2.jpg" alt="imgb-2" />
                                    <img id="slide-13" src="img/Birthday/Birth3.jpg" alt="imgb-3" />
                                    <img id="slide-14" src="img/Birthday/Birth4.jpg" alt="imgb-4" />
                                </div>
                                <div class="slider-nav">
                                    <a href="#slide-11"></a>
                                    <a href="#slide-12"></a>
                                    <a href="#slide-13"></a>
                                    <a href="#slide-14"></a>
                                </div>
                            </div>
                        </section>
                        </div>
                        <!-- Slideshow End -->

                        <!-- Occasion Celebration Packages Start -->
                        <div class="text-center wow fadeInDown" data-wow-delay="0.1s">
                            <br/><br/><br/><br/>
                            <h1 class="section-title ff-secondary text-center text-primary fw-normal">All Occasions Celebration</h1>
                            <h5 class="mb-5">Packages</h5>
                        </div> 
                        <div class="subpackage">
                        <div class="container">
                            <div class="subpackage__grid">
                                <!-- Package A Celebration Subpackage Start -->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <!--<img src="img/Intimate_Wedding.jpg" />-->
                                        <div class="subpackage-card__title">Package A</div>
                                        <div class="subpackage-card__price">Php 40, 000
                                            <span>/ 50 pax</span>
                                        </div>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li>Use of private function room for 4 hours (Silver or Golden Ballroom)</li>
                                            <li>Use of tiffany chairs and red carpet</li>
                                            <li>Food tasting for two persons</li>
                                            <li>Basic sound system for public address and background music</li>
                                        </ul>
                                        <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                    </div>
                                </div>
                                <!-- Package A Celebration Subpackage End-->

                                <!-- Package B Celebration Subpackage Start-->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <div class="subpackage-card__title">Package B</div>
                                        <div class="subpackage-card__price">Php 75, 000
                                            <span>/ 100 pax</span>
                                        </div>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li>Use of private function room for 4 hours (Platinum or Diamond Ballroom)</li>
                                            <li>Use of tiffany chairs and red carpet</li>
                                            <li>Food tasting for two persons</li>
                                            <li>Basic sound system for public address and background music</li>
                                            <li>Photobooth</li>
                                            <li>Tarpaulin</li>
                                        </ul>
                                        <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                    </div>
                                </div>
                                <!-- Package B Celebration Subpackage End-->
                            </div>
                        </div>
                        <!-- Occassion Celebration Packages End -->

                        <!-- Slideshow Start -->
                        <div class="AllOcccontainer">
                            <div class="galleryHeader wow fadeInDown">
                                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Gallery</h5>
                                <h1 class="mb-5">All-Occassions</h1>
                            </div>
                            <section class="container">
                            <div class="slider-wrapper">
                                <div class="slider">
                                    <img id="slide-15" src="img/AllOccassion/AO1.jpg" alt="imga-1" />
                                    <img id="slide-16" src="img/AllOccassion/AO2.jpg" alt="imga-2" />
                                    <img id="slide-17" src="img/AllOccassion/AO3.jpg" alt="imga-3" />
                                    <img id="slide-18" src="img/AllOccassion/AO4.jpg" alt="imga-4" />
                                    <img id="slide-19" src="img/AllOccassion/AOBG.jpg" alt="imga-5" />
                                    <img id="slide-20" src="img/AllOccassion/AOBG1.jpg" alt="imga-6" />
                                    <img id="slide-21" src="img/AllOccassion/AOBG2.jpg" alt="imga-7" />
                                    <img id="slide-22" src="img/AllOccassion/AOBG3.jpg" alt="imga-8" />
                                    <img id="slide-23" src="img/AllOccassion/AOBG4.jpg" alt="imga-9" />
                                </div>
                                <div class="slider-nav">
                                    <a href="#slide-15"></a>
                                    <a href="#slide-16"></a>
                                    <a href="#slide-17"></a>
                                    <a href="#slide-18"></a>
                                    <a href="#slide-19"></a>
                                    <a href="#slide-20"></a>
                                    <a href="#slide-21"></a>
                                    <a href="#slide-22"></a>
                                    <a href="#slide-23"></a>
                                </div>
                            </div>
                        </section>
                        </div>
                        <!-- Slideshow End -->

                        <!-- Function Room Packages Start -->
                        <div class="text-center wow fadeInDown" data-wow-delay="0.1s">
                            <br/><br/><br/><br/>
                            <h1 class="section-title ff-secondary text-center text-primary fw-normal">Function Room</h1>
                            <h5 class="mb-5">Packages</h5>
                        </div> 
                        <div class="subpackage">
                        <div class="container">
                            <div class="subpackage__grid">
                                <!-- Silver Ballroom Start -->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <!--<img src="img/Intimate_Wedding.jpg" />-->
                                        <div class="subpackage-card__title">Silver Ballroom</div>
                                        <div class="subpackage-card__price">
                                            <span>Base Price: </span> Php 20, 000
                                        </div>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li class = "room">Area: 150 sqm</li>
                                            <li class = "room">Capacity: 50 persons</li>
                                            <li class = "room">Time Limit: 4 hours</li>
                                            <li class = "room">Overtime Additional Fee: Php 2, 000/hr.</li>
                                        </ul>
                                        <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                    </div>
                                </div>
                                <!-- Silver Ballroom End-->

                                <!-- Golden Ballroom Start -->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <!--<img src="img/Intimate_Wedding.jpg" />-->
                                        <div class="subpackage-card__title">Golden Ballroom</div>
                                        <div class="subpackage-card__price">
                                            <span>Base Price: </span> Php 40, 000
                                        </div>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li class = "room">Area: 180 sqm</li>
                                            <li class = "room">Capacity: 100 persons</li>
                                            <li class = "room">Time Limit: 4 hours</li>
                                            <li class = "room">Overtime Additional Fee: Php 4, 000/hr.</li>
                                        </ul>
                                        <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                    </div>
                                </div>
                                <!-- Golden Ballroom End-->

                                </div>
                                </div>
                                </div>
                                
                                <div class="subpackage">
                                <div class="container">
                                    <div class="subpackage__grid">
                                <!-- Platinum Ballroom Start -->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <!--<img src="img/Intimate_Wedding.jpg" />-->
                                        <div class="subpackage-card__title">Platinum Ballroom</div>
                                        <div class="subpackage-card__price">
                                            <span>Base Price: </span> Php 60, 000
                                        </div>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li class = "room">Area: 200 sqm</li>
                                            <li class = "room">Capacity: 150 persons</li>
                                            <li class = "room">Time Limit: 4 hours</li>
                                            <li class = "room">Overtime Additional Fee: Php 6, 000/hr.</li>
                                        </ul>
                                        <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                    </div>
                                </div>
                                <!-- Platinum Ballroom End-->

                                <!-- Diamond Ballroom Start -->
                                <div class="subpackage__card subpackage-card">
                                    <div class="subpackage-card__top">
                                        <!--<img src="img/Intimate_Wedding.jpg" />-->
                                        <div class="subpackage-card__title">Diamond Ballroom</div>
                                        <div class="subpackage-card__price">
                                            <span>Base Price: </span> Php 80, 000
                                        </div>
                                    </div>
                                    <div class="subpackage-card__body">
                                        <ul>
                                            <li class = "room">Area: 250 sqm</li>
                                            <li class = "room">Capacity: 200 persons</li>
                                            <li class = "room">Time Limit: 4 hours</li>
                                            <li class = "room">Overtime Additional Fee: Php 8, 000/hr.</li>
                                        </ul>
                                        <!--<div class="subpackage-card__button"><a href="">Select</a></div>-->
                                    </div>
                                </div>
                                <!-- Silver Ballroom End-->
                            </div>
                        </div>
                    </div>
                        <!-- Function Room Packages End -->

                        <!-- Slideshow Start -->
                        <div class="Funccontainer">
                            <div class="galleryHeader wow fadeInDown">
                                <h5 class="section-title ff-secondary text-center text-primary fw-normal">Gallery</h5>
                                <h1 class="mb-5">Function Rooms</h1>
                            </div>
                            <section class="container">
                            <div class="slider-wrapper">
                                <div class="slider">
                                    <img id="slide-24" src="img/Venue/Ven1.jpg" alt="imgf-1" />
                                    <img id="slide-25" src="img/Venue/Ven2.jpg" alt="imgf-2" />
                                    <img id="slide-26" src="img/Venue/Ven3.jpg" alt="imgf-3" />
                                    <img id="slide-27" src="img/Venue/Ven4.jpg" alt="imgf-4" />
                                    <img id="slide-28" src="img/Venue/Ven5.jpg" alt="imgf-5" />
                                    <img id="slide-30" src="img/Venue/Ven6.jpg" alt="imgf-6" />
                                    <img id="slide-31" src="img/Venue/Ven7.jpg" alt="imgf-7" />
                                    <img id="slide-32" src="img/Venue/Ven8.jpg" alt="imgf-8" />
                                    <img id="slide-33" src="img/Venue/Ven9.jpg" alt="imgf-9" />
                                    <img id="slide-34" src="img/Venue/Ven10.jpg" alt="imgf-10" />
                                </div>
                                <div class="slider-nav">
                                    <a href="#slide-24"></a>
                                    <a href="#slide-25"></a>
                                    <a href="#slide-26"></a>
                                    <a href="#slide-27"></a>
                                    <a href="#slide-28"></a>
                                    <a href="#slide-29"></a>
                                    <a href="#slide-30"></a>
                                    <a href="#slide-31"></a>
                                    <a href="#slide-32"></a>
                                    <a href="#slide-33"></a>
                                    <a href="#slide-34"></a>
                                </div>
                            </div>
                        </section>
                        </div>
                        <!-- Slideshow End -->
                </div>
            </div>
        </div>
        </div>
        </div>
        <!-- Packages End -->

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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>