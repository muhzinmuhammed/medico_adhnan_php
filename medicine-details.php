<?php
require_once './config.php'; // Your Firebase configuration file
require_once './firebaseRDB.php'; // FirebaseRDB class file

// Initialize the FirebaseRDB class
$db = new firebaseRDB($databaseURL);

// Get the key from the URL parameter
$key = isset($_GET['id']) ? $_GET['id'] : null;

if ($key) {
    try {
        // Fetch data from the 'properties' node using the key
        $response = $db->retrieve('medicines/' . $key);

        // Decode the JSON response to an array
        $medicines = json_decode($response, true);

        // Handle the case when medicines is not found
        if (!$medicines) {
            throw new Exception("medicines not found");
        }
    }
    catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'No property key specified';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
		<title>Medicofy Website</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
				
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

		<!-- Feathericon CSS -->
    	<link rel="stylesheet" href="assets/css/feather.css">

		<!-- Boxicons CSS -->
		<link rel="stylesheet" href="assets/plugins/boxicons/css/boxicons.min.css"> 

		<!-- Owl Carousel CSS -->
		<link rel="stylesheet" href="assets/css/owl.carousel.min.css">

		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="assets/plugins/fancybox/jquery.fancybox.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">

	</head>		
	<body>

		<!-- Loader -->
		<div class="page-loader">
			<div class="page-loader-inner">
				<img src="assets/img/icons/loader.svg" alt="Loader">
				<label><i class="fa-solid fa-circle"></i></label>
				<label><i class="fa-solid fa-circle"></i></label>
				<label><i class="fa-solid fa-circle"></i></label>
			</div>
		</div>
		<!-- /Loader -->

		<!-- Main Wrapper -->
		<div class="main-wrapper">

			<!-- Header -->
            <header class="header header-trans">
                <nav class="navbar navbar-expand-lg header-nav">
                    <div class="navbar-header">
                        <a id="mobile_btn" href="javascript:void(0);">
                            <span class="bar-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </a>
                        <a href="index.html" class="navbar-brand logo">
                            <img src="assets/img/logo.svg" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                    <div class="main-menu-wrapper">
                        <div class="menu-header">
                            <a href="index.html" class="menu-logo">
                                <img src="assets/img/logo.svg" class="img-fluid" alt="Logo">
                            </a>
                
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                      
                </nav>
            </header>
            <!-- /Header -->

            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <div class="container">
                    <div class="bread-crumb-head">
                        <div class="breadcrumb-title">
                            <h2>Medicine Details</h2>
                        </div>
                        <!-- <div class="breadcrumb-list">
                            <ul>
                                <li><a href="index.html">Home </a></li>
                                <li>Rent Details</li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="breadcrumb-border-img">
                        <img src="assets/img/bg/line-bg.png" alt="Line Image">
                    </div>
                </div>
            </div>
            <!-- Breadcrumb -->

            <!-- Detail View Section -->
            <section class="buy-detailview">
                <div class="container">

					<!-- Details -->
                    <div class="row align-items-center page-head">
                        <div class="col-lg-8">
                           
                            <div class="page-title">
							<h3><?php echo htmlspecialchars($medicines['medicine_name']); ?><span><img src="assets/img/icons/location-icon.svg" alt="Image"></span></h3>
                                <!-- <p><i class="feather-map-pin"></i> 318-330 S Oakley Blvd, Chicago, IL 60612, USA</p> -->
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="latest-update">
                                <h5>Current Rate</h5>
                                <p>₹ <?php echo($medicines['sale_price']) ?> </p></p>
                                
                            </div>
                        </div>
                    </div>
					<!-- /Details -->

                    <div class="row">
                        <div class="col-lg-8">

							<!-- Slider -->
                            <div class="buy-details-col">
								<div class="rental-card">
								<div class="slider rental-slider">
									<div class="product-img">
										<img src="assets/img/rent/rent-detail-01.jpg" alt="Slider">
									</div>
									<div class="product-img">
										<img src="assets/img/rent/rent-detail-02.jpg" alt="Slider">
									</div>
									<div class="product-img">
										<img src="assets/img/rent/rent-detail-03.jpg" alt="Slider">
									</div>
									<div class="product-img">
										<img src="assets/img/rent/rent-detail-04.jpg" alt="Slider">
									</div>
									<div class="product-img">
										<img src="assets/img/rent/rent-detail-05.jpg" alt="Slider">
									</div>
									</div>
									<div class="slider slider-nav-thumbnails">
										<div><img src="assets/img/rent/rent-detail-01.jpg" alt="product image"></div>
										<div><img src="assets/img/rent/rent-detail-02.jpg" alt="product image"></div>
										<div><img src="assets/img/rent/rent-detail-03.jpg" alt="product image"></div>
										<div><img src="assets/img/rent/rent-detail-04.jpg" alt="product image"></div>
										<div><img src="assets/img/rent/rent-detail-05.jpg" alt="product image"></div>
									</div>
								</div>
							</div>
							<!-- /Slider -->

							<!-- Overview -->
							<!-- <div class="collapse-card">
								<h4 class="card-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#overview" aria-expanded="false">Overview</a>
								</h4>
								<div id="overview" class="card-collapse collapse show">
									<ul class="property-overview  collapse-view">
										<li>
											<img src="assets/img/icons/bed-icon.svg" alt="Image">
											<p>4 Beds</p>
										</li>
										<li>
											<img src="assets/img/icons/bath-icon.svg" alt="Image">
											<p>4 Baths</p>
										</li>
										<li>
											<img src="assets/img/icons/building-icon.svg" alt="Image">
											<p>35000 Sqft</p>
										</li>
										<li>
											<img src="assets/img/icons/garage-icon.svg" alt="Image">
											<p>2 Garages</p>
										</li>
										<li>
											<img src="assets/img/icons/calender-icon.svg" alt="Image">
											<p>Year Built: 2005</p>
										</li>
									</ul>
								</div>
							</div> -->
							<!-- /Overview -->

							<!-- Overview -->
							<div class="collapse-card">
								<h4 class="card-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#about" aria-expanded="false">Description</a>
								</h4>
								<div id="about" class="card-collapse collapse show">
									<div class="about-agent collapse-view">
										<p> <?php echo ($medicines['description']) ?><p>										   
									   <!-- <p>This property is mostly wooded and sits high on a hilltop overlooking the Mohawk River Valley.Located right in the heart of Upstate NYs Amish farm Country, this land is certified organic makingit extremely rare! Good road frontage on a paved  county road with utilities make it an amazingsetting for your dream country getaway! If you like views, you must see  this property!This propertyis mostly wooded and sits high on a hilltop overlooking the Mohawk River Valley. Located right inthe heart of Upstate NYs Amish farm Country, this land is certified organic making it extremelyrare! Good road frontage on a paved  county road with utilities make it an amazing setting for yourdream country getaway! If you like views, you must see  this property!</p> -->
									</div>
								</div>
							</div>
							<!-- /Overview -->
							
							<!-- Property Address -->
							<!-- <div class="collapse-card">
								<h4 class="card-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#address" aria-expanded="false">Property Address</a>
								</h4>
								<div id="address" class="card-collapse collapse show  collapse-view">
									<ul class="property-address">
										<li>Address : <span> Ferris Park</span></li>
										<li>City : <span> Jersey City </span></li> 
										<li>State/County : <span> New Jersey State</span></li>
										<li>Country : <span> United States</span></li> 
										<li>Zip : <span> 07305</span></li> 
										<li>Area : <span> Greenville</span></li> 
									</ul>
								</div>
							</div> -->
							<!-- /Property Address -->

							<!-- Property Details -->
							<!-- <div class="collapse-card">
								<h4 class="card-title">
									<a class="collapsed" data-bs-toggle="collapse" href="#details" aria-expanded="false">Property Details</a>
								</h4>
								<div id="details" class="card-collapse collapse show  collapse-view">
									<div class="row">
										<div class="col-md-4">
											<ul class="property-details">
												<li>Property Id : <span> 22972</span></li>
												<li>Price : <span> $ 860,000 </span></li> 
												<li>Price Info: <span> $ 1,098 /sq ft</span></li>
												<li>Property Size : <span>  190 ft2</span></li> 
												<li>Property Lot Size : <span>  1,200 ft2</span></li> 
											</ul>
										</div>
										<div class="col-md-4">
											<ul class="property-details">
												<li>Rooms : <span> 10</span></li>
												<li>Bedrooms : <span> 5</span></li> 
												<li>Bathrooms : <span> 6</span></li>
												<li>Custom Id : <span> 68</span></li> 
												<li>Garages : <span> 2</span></li> 
											</ul>
										</div>
										<div class="col-md-4">
											<ul class="property-details">
												<li>Year Built :  <span> 2005</span></li>
												<li>Garage Size : <span> 2 cars </span></li> 
												<li>Available From : <span> 2023-11-18</span></li>
												<li>Structure Type : <span> Brick</span></li> 
												<li>Floors No : <span> 3</span></li> 
											</ul>
										</div>
									</div>
								</div>
							</div> -->
							<!-- /Property Details -->

							<!-- Amenities -->
						
							<!-- /Amenities -->

							<!-- Video -->
						
							<!-- /Video -->

							<!-- Map -->
							
							<!-- /Map -->

							<!-- Reviews -->
							
							<!-- /Reviews -->

						</div>

						<!-- Sidebar -->
						<div class="col-lg-4 theiaStickySidebar">
							<div class="right-sidebar">
								<a href="billing-page.php?id=<?php echo urlencode($key) ?>" class="btn btn-primary prop-book">Book Medicine</a>
								
								<!-- Enquiry -->

								<!-- /Enquiry -->

								<!-- Listing Owner Details -->
								
								<!-- /Listing Owner Details -->

								<!-- Share Property -->
								<!-- <div class="sidebar-card">
									<div class="sidebar-card-title">
										<h5>Share Property</h5>
									</div>
									<div class="social-links">
										<ul class="sidebar-social-links">
											<li><a href="javascript:void(0);" class="fb-icon"><i class="fa-brands fa-facebook-f hi-icon"></i></a></li>
											<li><a href="javascript:void(0);" class="ins-icon"><i class="fa-brands fa-instagram hi-icon"></i></a></li>
											<li><a href="javascript:void(0);"><i class="fa-brands fa-behance hi-icon"></i></a></li>
											<li><a href="javascript:void(0);" class="twitter-icon"><i class="fa-brands fa-twitter hi-icon"></i></a></li>
											<li><a href="javascript:void(0);" class="ins-icon"><i class="fa-brands fa-pinterest-p hi-icon"></i></a></li>
											<li><a href="javascript:void(0);"><i class="fa-brands fa-linkedin hi-icon"></i></a></li>
										</ul>
									</div>
								</div> -->
								<!-- /Share Property -->
								
							</div>
						</div>
						<!-- /Sidebar -->

                    </div>

					<!-- Similar Listings -->
					
					<!-- /Similar Listings -->

                </div>
            </section>
			<!-- /Detail View Section -->

			<!-- Footer -->
			<!-- <footer class="footer"> -->
				<!-- Footer Top -->
				<!-- <div class="footer-top">
					<div class="footer-border-img">
						<img src="assets/img/bg/line-bg.png" alt="Line Image">
					</div>
					<div class="container">
						<div class="row">
							<div class="col-lg-4 col-md-6 col-sm-8">
								<div class="footer-widget footer-about">
									<div class="footer-app-content">
										<div class="footer-content-heading">
											<h4>Get Our App </h4> 
											<p>Download the app and book your property</p>
										</div>
										<div class="download-app">
											<a href="javascript:void(0);"><img src="assets/img/google-pay.png" alt="google play"></a>
											<a href="javascript:void(0);"><img src="assets/img/app-store.png" alt="app store"></a>
										</div>
										<div class="social-links">
											<h4>Connect with us</h4>
											<ul>
												<li><a href="javascript:void(0);"><i class="fa-brands fa-facebook-f hi-icon"></i></a></li>
												<li><a href="javascript:void(0);"><i class="fa-brands fa-instagram hi-icon"></i></a></li>
												<li><a href="javascript:void(0);"><i class="fa-brands fa-behance hi-icon"></i></a></li>
												<li><a href="javascript:void(0);"><i class="fa-brands fa-twitter hi-icon"></i></a></li>
												<li><a href="javascript:void(0);"><i class="fa-brands fa-pinterest-p hi-icon"></i></a></li>
												<li><a href="javascript:void(0);"><i class="fa-brands fa-linkedin hi-icon"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md-3 col-sm-4">
								<div class="footer-widget-list">
									<div class="footer-content-heading">
										<h4>Explore</h4>
									</div>
									<ul>
										<li><a href="rent-property-list.html">Listings</a></li>
										<li><a href="register.html">Register</a></li>
										<li><a href="login.html">Login</a></li>
										<li><a href="blog-grid.html">Blogs</a></li>
										<li><a href="agency-grid.html">Agency</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-2 col-md-3 col-sm-4">
								<div class="footer-widget-list">
									<div class="footer-content-heading">
										<h4>Categories</h4>
									</div>
									<ul>
										<li><a href="javascript:void(0);">Apartments</a></li>
										<li><a href="javascript:void(0);">Home</a></li>
										<li><a href="javascript:void(0);">Office</a></li>
										<li><a href="javascript:void(0);">Villas</a></li>
										<li><a href="javascript:void(0);">Flat</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-4">
								<div class="footer-widget-list">
									<div class="footer-content-heading">
										<h4>Locations</h4>
									</div>
									<ul>
										<li><a href="javascript:void(0);">United States</a></li>
										<li><a href="javascript:void(0);">Canada</a></li>
										<li><a href="javascript:void(0);">India</a></li>
										<li><a href="javascript:void(0);">UK</a></li>
										<li><a href="javascript:void(0);">Australia</a></li>
									</ul>
								</div>
							</div>
							<div class="col-lg-2 col-md-4 col-sm-4">
								<div class="footer-widget-list">
									<div class="footer-content-heading">
										<h4>Quick Links</h4>
									</div>
									<ul>
										<li><a href="about-us.html">About</a></li>
										<li><a href="faq.html">Faq</a></li>
										<li><a href="terms-condition.html">Terms & Conditions</a></li>
                                        <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                        <li><a href="gallery.html">Gallery</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				<!-- /Footer Top -->

				<!-- Footer Bottom -->
				<!-- <div class="footer-bottom">
					<div class="container">
						<div class="footer-bottom-content">
							<div class="copyright">
								<p>Copyright  2024 - All right reserved Medicofy Website</p>
							</div>
							<div class="company-logo">
								<p>a product of</p>
								<a href="https://dreamguystech.com/" target="_blank"><img src="assets/img/company-logo.png" alt="Logo"></a>
							</div>
						</div>						
					</div>
				</div>
				

			</footer> -->
			<!-- /Footer -->

			<!-- Search -->
			<div class="search-popup js-search-popup ">
				<a href="javascript:void(0);" class="close-button" id="search-close" aria-label="Close search">
					<i class="fa fa-close"></i>
				</a>
				<div class="popup-inner">
					<div class="inner-container">
						<form class="search-form" id="search-form" action="rent-property-grid.html">
							<h3>What Are You Looking for?</h3>
							<div class="search-form-box flex">
								<input type="text" class="search-input" placeholder="Type a  Keyword...." id="search-input" aria-label="Type to search" role="searchbox" autocomplete="off">
								<button type="submit" class="search-icon"><i class="bx bx-search"></i></button>
							</div>
							<h5>Popular Properties</h5>
							<ul>
								<li><a href="rent-property-grid.html">Beautiful Condo Room</a></li>
								<li><a href="rent-property-grid.html">Royal Apartment</a></li>
								<li><a href="rent-property-grid.html">Grand Villa House</a></li>
								<li><a href="rent-property-grid.html">Grand Mahaka</a></li>
								<li><a href="rent-property-grid.html">Lunaria Residence</a></li>
								<li><a href="rent-property-grid.html">Stephen Alexander Homes</a></li>
							</ul>
						</form>
					</div>
				</div>
			</div>	
			<!-- /Search -->

		</div>		
		<!-- /Main Wrapper -->

		<!-- ScrollToTop -->
		<div class="progress-wrap active-progress">
			<svg class="progress-circle svg-content" viewBox="-1 -1 102 102">
			<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
			</svg>
		</div>
		<!-- /ScrollToTop -->
	
		<!-- jQuery -->
		<script src="assets/js/jquery-3.7.1.min.js"></script>
		
		<!-- Bootstrap Bundle JS -->
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>

		<!-- Owl Carousel JS -->
		<script src="assets/js/owl.carousel.min.js"></script>

		<!-- Slick JS -->
		<script src="assets/plugins/slick/slick.js"></script>

		<!-- Sticky Sidebar JS -->
		<script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
		<script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>

		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
	
		<!-- Fancybox JS -->
		<script src="assets/plugins/fancybox/jquery.fancybox.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
	
	</body>
</html>