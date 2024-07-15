<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Site metas -->
    <title>Handel Search Page</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="../css/responsive.css">
    <!-- Favicon -->
    <link rel="icon" href="../images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <!-- FancyBox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen">
</head>

<body>
    <!-- Banner Background Main Start -->
    <div class="banner_bg_main">
        <!-- Header Top Section Start -->
        <div class="container">
            <div class="header_section_top">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="custom_menu">
                            <ul>
                                <?php
                                    if(!isset($_SESSION['id'])) {
                                ?>
                                <li><a href="../authentication/register.php">Register</a></li>
                                <li><a href="../authentication/login.php">Login</a></li>
                                <?php
                                    } else {
                                ?>
                                <li><a href="../authentication/logout.php">Logout</a></li>
                                <?php
                                    }
                                ?>
                                <li><a href="contactUs.php">Contact Us</a></li>
                                <li><a href="aboutUs.php"> About Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Top Section End -->
        <!-- Logo Section Start -->
        <div class="logo_section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="logo"><a style="display:none" href="handleSearch.php"><img
                                    src="../images/logo.png"></a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Logo Section End -->
        <!-- Header Section Start -->
        <div class="header_section">
            <div class="container">
                <div class="containt_main">
                    <div class="main">
                        <!-- Another variation with a button -->
                        <form action="handleSearch.php" method="POST">
                            <div class="input-group">
                                <input type="text" name="searchWord" required class="form-control"
                                    placeholder="Search By Product Name">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary" type="submit"
                                        style="background-color: #f26522; border-color:#f26522 ">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="header_box">
                        <div class="lang_box ">
                            <div class="dropdown-menu ">
                                <a href="#" class="dropdown-item">
                                    <img src="../images/flag-france.png" class="mr-2" alt="flag">
                                    French
                                </a>
                            </div>
                        </div>
                        <div class="login_menu">
                            <ul>
                                <li><a href="../admin/carts/customer_cart.php">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span class="padding_10">Cart</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Section End -->
        <!-- Banner Section Start -->
        <div class="banner_section layout_padding">
            <div class="container">
                <div id="my_slider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="banner_taital">Get Start <br>Your favorite shopping</h1>
                                </div>
                            </div>
                        </div>
                        <!-- Add more carousel items here if needed -->
                    </div>
                    <!-- Carousel Controls -->
                    <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Banner Section End -->
    </div>
    <!-- Banner Background Main End -->
</body>

</html>