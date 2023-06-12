<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/boxicons.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style1.css">
    

<?php

include 'connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['email'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `rec` WHERE email = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   
   if($select_admin->rowCount() > 0){
      $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
      $_SESSION['admin_id'] = $fetch_admin_id['id'];
      header('location:../recipient/dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>

    <title>ShareSupply</title>
  </head>
  <body data-bs-spy="scroll" data-bs-target=".navbar">
    
   <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-white">
      <div class="container">
        <a class="navbar-brand logo-text" href="#">ShareSupply</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">

            <li class="nav-item">
              <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="../Admin/admin/admin_login.php">Admin Panel</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="../Donour">Donation Requests</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="../Recipient/Rlogin.php">Login as Recipient</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#services">Our Services</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#works">Our Works</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#testimonials">Testimonials</a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#contact">Contact</a>
             </li>
          </ul>
        </div>
      </div>
    </nav>
 
  <style>


    /* CSS for slider container */
    .slider-container {
      width: 100%;
      height: 600px;
      position: relative;
      overflow: hidden;
    }

    /* CSS for slider images */
    .slider-image {
      width: 100%;
      height: 600px;
      position: absolute;
      transition: opacity 1s ease-in-out;
    }

    /* CSS for slider arrow buttons */
    .slider-arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(0, 0, 0, 0.7);
      color: white;
      font-size: 90px; 
      padding: 5px;
      cursor: pointer;
    }

    .slider-arrow.left {
      left: 10px;
    }

    .slider-arrow.right {
      right: 10px;
    }
    .slider-headline {
      position: absolute;
      top: 60%; /* Adjusted position */
      left: 50%;
  
      transform: translate(-50%, -50%);
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.10); /* Added text shadow */
      color: white;
      padding: 20px;
      font-size: 24px;
      text-align: center;
      text-transform: uppercase;
      letter-spacing: 2px;
      font-weight: bold;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
     
    }
  </style>
</head>
<body>
  <div class="slider-container">
    <img class="slider-image" src="img/slide1.jpg" alt="Image 1">
    <img class="slider-image" src="img/slide2.jpg" alt="Image 2">
    <img class="slider-image" src="img/slide3.jpg" alt="Image 3">
    <img class="slider-image" src="img/c4.jpg" alt="Image 4">
    <img class="slider-image" src="img/c7.jpg" alt="Image 5">
    <div class="slider-headline">Let's CREATE a better world with </br> SHARESUPPLY</div>

    
    <div class="slider-arrow left" onclick="showPreviousImage()">&#8249;</div>
    <div class="slider-arrow right" onclick="showNextImage()">&#8250;</div>
  </div>

  <script>
    // JavaScript for slider functionality
    const images = document.querySelectorAll('.slider-image');
    let currentIndex = 0;

    function showNextImage() {
      // Hide the current image
      images[currentIndex].style.opacity = 0;

      // Increment the current index
      currentIndex = (currentIndex + 1) % images.length;

      // Show the next image
      images[currentIndex].style.opacity = 1;
    }

    function showPreviousImage() {
      // Hide the current image
      images[currentIndex].style.opacity = 0;

      // Decrement the current index
      currentIndex = (currentIndex - 1 + images.length) % images.length;

      // Show the previous image
      images[currentIndex].style.opacity = 1;
    }

    // Show the first image initially
    images[currentIndex].style.opacity = 1;

    // Automatically switch to the next image every 3 seconds
    setInterval(showNextImage, 3000);
  </script>



  <style>
    /* CSS for centering the button */
  
    /* CSS for the button design */
    .donate-button {
      padding: 15px 30px;
      font-size: 18px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      color: #fff;
      background-color: #4CAF50;
      border-radius: 4px;
      border: none;
      transition: background-color 0.3s ease;
    }

    .donate-button:hover {
      background-color: #45a049;
    }
  </style>
 <section id="donate">
      <div class="container">
         <div class="row">
            <div class="col-12 section-intro">
          
            <a href="../Recipient/Rlogin.php" class="donate-button">Request for Donation</a>
            <a href="Donation.php" class="donate-button">Donate Now</a>
            <a href="../Donour" class="donate-button">See Donation Requests </a>
               <div class="hline"></div>
            </div>
         </div>
   </section>
   <section id="services">
      <div class="container">
         <div class="row">
            <div class="col-12 section-intro">
               <h1>Our Services</h1>
               <div class="hline"></div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-4 col-sm-6 p-4">
               <div class="icon-box">
                  <i class='bx bxs-landscape'></i>
               </div>
               <h4 class="title-sm mt-4">Direct Donation through verified Posts </h4>
               <p></p>
            </div>
            <div class="col-lg-4 col-sm-6 p-4">
               <div class="icon-box">
                  <i class='bx bxs-coffee'></i>
               </div>
               <h4 class="title-sm mt-4">Blood Bank</h4>
               <p></p>
            </div>
            <div class="col-lg-4 col-sm-6 p-4">
               <div class="icon-box">
                  <i class='bx bxs-image'></i>
               </div>
               <h4 class="title-sm mt-4">Child Home Service</h4>
               <p></p>
            </div>
            <div class="col-lg-4 col-sm-6 p-4">
               <div class="icon-box">
                  <i class='bx bxs-check-shield'></i>
               </div>
               <h4 class="title-sm mt-4">Old Home service</h4>
               <p></p>
            </div>
            <div class="col-lg-4 col-sm-6 p-4">
               <div class="icon-box">
                  <i class='bx bx-laptop'></i>
               </div>
               <h4 class="title-sm mt-4">Areawise institute Donation</h4>
               <p></p>
            </div>
            <div class="col-lg-4 col-sm-6 p-4">
               <div class="icon-box">
                  <i class='bx bxs-happy-heart-eyes'></i>
               </div>
               <h4 class="title-sm mt-4"></h4>
               <p></p>
            </div>
         </div>
      </div>
   </section>
   
   <section>
    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style1.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

   
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>


   

   <section id="works" class="row g-0 py-0">

   <div class="col-12 section-intro">
               <h1>Our WORKS</h1></div>
               <div class="hline"></div>
              

   <div class="col-lg-3 col-sm-6 team-member">
         <div class="team-member-img">
            <img src="img/C3.jpg" alt="">
            <div class="social-icons">
               <a href="#"><i class="bx bxl-facebook"></i></a>
               <a href="#"><i class="bx bxl-twitter"></i></a>
               <a href="#"><i class="bx bxl-instagram"></i></a>
               <a href="#"><i class="bx bxl-github"></i></a>
            </div>
         </div>
         <div class="p-4">
            <h5 class="title-sm mt-3 mb-0 text-white">Iftar item donated </h5>
            <small class="text-white">by AKR group to ABC colony</small>
            <div class="hline"></div>
         
         </div>
      </div>
            

   <div class="col-lg-3 col-sm-6 team-member">
         <div class="team-member-img">
            <img src="img/C8.jpg" alt="">
            <div class="social-icons">
               <a href="#"><i class="bx bxl-facebook"></i></a>
               <a href="#"><i class="bx bxl-twitter"></i></a>
               <a href="#"><i class="bx bxl-instagram"></i></a>
               <a href="#"><i class="bx bxl-github"></i></a>
            </div>
         </div> 
         <div class="p-4">
            <h5 class="title-sm mt-3 mb-0 text-white">MOre than 2500 Lives saved </h5>
            <small class="text-white">Through our Blood Bank</small>
            <div class="hline"></div>
         
         </div>
      </div>
            

   <div class="col-lg-3 col-sm-6 team-member">
         <div class="team-member-img">
            <img src="img/C2.jpg" alt="">
            <div class="social-icons">
               <a href="#"><i class="bx bxl-facebook"></i></a>
               <a href="#"><i class="bx bxl-twitter"></i></a>
               <a href="#"><i class="bx bxl-instagram"></i></a>
               <a href="#"><i class="bx bxl-github"></i></a>
            </div>
         </div>
         <div class="p-4">
            <h5 class="title-sm mt-3 mb-0 text-white">Iftar item donated </h5>
            <small class="text-white">by AKR group to ABC colony</small>
            <div class="hline"></div>
         
         </div>
      </div>


      <div class="col-lg-3 col-sm-6 team-member">
         <div class="team-member-img">
            <img src="img/c7.jpg" alt="">
            <div class="social-icons">
               <a href="#"><i class="bx bxl-facebook"></i></a>
               <a href="#"><i class="bx bxl-twitter"></i></a>
               <a href="#"><i class="bx bxl-instagram"></i></a>
               <a href="#"><i class="bx bxl-github"></i></a>
            </div>
         </div>
         <div class="p-4">
            <h5 class="title-sm mt-3 mb-0 text-white">9 Years old Jasmin is Successfully transfereed with bonemarrow</h5>
            <small class="text-white"> Kokilaben Dhirubhai Ambani Hospital (DEMO)</small>
            <div class="hline"></div>
         
         </div>
      </div>

      <div class="col-lg-3 col-sm-6 team-member">
         <div class="team-member-img">
            <img src="img/c2.jpg" alt="">
            <div class="social-icons">
               <a href="#"><i class="bx bxl-facebook"></i></a>
               <a href="#"><i class="bx bxl-twitter"></i></a>
               <a href="#"><i class="bx bxl-instagram"></i></a>
               <a href="#"><i class="bx bxl-github"></i></a>
            </div>
         </div>
         <div class="p-4">
            <h5 class="title-sm mt-3 mb-0 text-white">20 youngs got Rickshaw </h5>
            <small class="text-white">sponsored by ATC industry</small>
            <div class="hline"></div>
         
         </div>
      </div>



      <div class="col-lg-3 col-sm-6 team-member">
         <div class="team-member-img">
            <img src="img/c4.jpg" alt="">
            <div class="social-icons">
               <a href="#"><i class="bx bxl-facebook"></i></a>
               <a href="#"><i class="bx bxl-twitter"></i></a>
               <a href="#"><i class="bx bxl-instagram"></i></a>
               <a href="#"><i class="bx bxl-github"></i></a>
            </div>
         </div>
    
   
         <div class="p-4">
            <h5 class="title-sm mt-3 mb-0 text-white">fatema is now going to school</h5>
            <small class="text-white">Sharesupply Education fund</small>
            <div class="hline"></div>
         
      
         </div>
      </div>

     
   </section>

   </br>
   </br>
   </br>
   </br>
   </br>
   </br>
   </br>
   </br>
   </br>
   </br>
   </br>
   </br>
   <div class="col-12 section-intro">
               <h1>Our MEMBERS</h1></div>
               <div class="hline"></div>

   <section id="Members" class="row g-0 py-0 text-center">
      <div class="col-lg-3 col-sm-6 team-member">
         <div class="team-member-img">
            <img src="img/D2.jpg" alt="">
            <div class="social-icons">
               <a href="#"><i class="bx bxl-facebook"></i></a>
               <a href="#"><i class="bx bxl-twitter"></i></a>
               <a href="#"><i class="bx bxl-instagram"></i></a>
               <a href="#"><i class="bx bxl-github"></i></a>
            </div>
         </div>
         <div class="p-4">
            <h5 class="title-sm mt-3 mb-0 text-white">Ananta Jalil</h5>
            <small class="text-white">Actor and Industrialist</small>
            <div class="hline"></div>
            <p class="text-white">A GRADE DONOUR</p>
         </div>
      </div>
      <div class="col-lg-3 col-sm-6 team-member even">
         <div class="team-member-img">
            <img src="img/D1.jpg" alt="">
            <div class="social-icons">
               <a href="#"><i class="bx bxl-facebook"></i></a>
               <a href="#"><i class="bx bxl-twitter"></i></a>
               <a href="#"><i class="bx bxl-instagram"></i></a>
               <a href="#"><i class="bx bxl-github"></i></a>
            </div>
         </div>
         <div class="p-4">
            <h5 class="title-sm mt-3 mb-0 text-white">Shakib Khan</h5>
            <small class="text-white">Actor</small>
            <div class="hline"></div>
            <p class="text-white">A GRADE DONOUR</p>
         </div>
      </div>
      <div class="col-lg-3 col-sm-6 team-member">
         <div class="team-member-img">
            <img src="img/D4.jpg" alt="">
            <div class="social-icons">
               <a href="#"><i class="bx bxl-facebook"></i></a>
               <a href="#"><i class="bx bxl-twitter"></i></a>
               <a href="#"><i class="bx bxl-instagram"></i></a>
               <a href="#"><i class="bx bxl-github"></i></a>
            </div>
         </div>
         <div class="p-4">
            <h5 class="title-sm mt-3 mb-0 text-white">Bashundhara Group</h5>
            <small class="text-white"></small>
            <div class="hline"></div>
            <p class="text-white">A GRADE PARTNER </p>
         </div>
      </div>
      <div class="col-lg-3 col-sm-6 team-member even">
         <div class="team-member-img">
            <img src="img/D5.jpg" alt="">
            <div class="social-icons">
               <a href="#"><i class="bx bxl-facebook"></i></a>
               <a href="#"><i class="bx bxl-twitter"></i></a>
               <a href="#"><i class="bx bxl-instagram"></i></a>
               <a href="#"><i class="bx bxl-github"></i></a>
            </div>
         </div>
         <div class="p-4">
            <h5 class="title-sm mt-3 mb-0 text-white"> NSU SOCIAL SERVICE CLUB</h5>
            <small class="text-white"></small>
            <div class="hline"></div>
            <p class="text-white">MEMBER</p>
      </div>
   </section>

   <section id="Our Works" class="text-center">
   <div class="col-12 section-intro">
               <h1>Reviews</h1></div>
               <div class="hline"></div>
      <div class="container">
         <div class="row">
            <div class="col-12">

                     <div class="review">
                        <div class="stars">
                           <i class="bx bxs-star"></i>
                           <i class="bx bxs-star"></i>
                           <i class="bx bxs-star"></i>
                           <i class="bx bxs-star"></i>
                           <i class="bx bx-star"></i>
                        </div>
                        <p class="lead"></p>
                        <h5 class="title-sm mb-0">HASAN</h5>
                        <small>Nice,</small>
                     </div>
                     <div class="stars">
                           <i class="bx bxs-star"></i>
                           <i class="bx bxs-star"></i>
                           <i class="bx bxs-star"></i>
                           <i class="bx bxs-star"></i>
                           <i class="bx bx-star"></i>
                        </div>
                        <p class="lead"></p>
                        <h5 class="title-sm mb-0">MOmin</h5>
                        <small>Great Service,</small>
                     </div>
                     <div class="stars">
                           <i class="bx bxs-star"></i>
                           <i class="bx bxs-star"></i>
                           <i class="bx bxs-star"></i>
                           <i class="bx bxs-star"></i>
                           <i class="bx bx-star"></i>
                        </div>
                        <p class="lead"></p>
                        <h5 class="title-sm mb-0">Liver</h5>
                        <small>Awesome initivative carry On,</small>
                     </div>
            </div>
         </div>
      </div>
   </section>

   <section id="clients" class="bg-light">
      <div class="container">
         <div class="row gy-4">
            <div class="col-lg-2 col-md-3 col-6">
               <img src="img/logo1.svg" alt="">
            </div>
            <div class="col-lg-2 col-md-3 col-6">
               <img src="img/logo2.svg" alt="">
            </div>
            <div class="col-lg-2 col-md-3 col-6">
               <img src="img/logo3.svg" alt="">
            </div>
            <div class="col-lg-2 col-md-3 col-6">
               <img src="img/logo4.svg" alt="">
            </div>
            <div class="col-lg-2 col-md-3 col-6">
               <img src="img/logo5.svg" alt="">
            </div>
            <div class="col-lg-2 col-md-3 col-6">
               <img src="img/logo1.svg" alt="">
            </div>
         </div>
      </div>
   </section>

   <section id="contact">
      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-4">
               <img src="img/cntct.jpg" alt="">
            </div>
            <div class="col-lg-6 offset-lg-1">
               <form>
                  <div class="mb-3">
                    <small>Name</small>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                     <small>Email</small>
                     <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                   </div>
                   <div class="mb-3">
                     <small>Name</small>
                     <textarea name="" id="" cols="30" rows="4" class="form-control"></textarea>
                   </div>
                  <button type="submit" class="btn btn-brand">Submit</button>
                </form>
            </div>
         </div>
      </div>
   </section>

   <section id="cta" class="py-5">
      <div class="container py-4">
         <div class="row justify-content-center">
            <div class="col-md-6">
               <h3 class="text-white">Let's make a better world Together.</h3>
            </div>
            <div class="col-auto">
               <a href="#" class="btn btn-light">Get Started</a>
            </div>
         </div>
      </div>
   </section>

   <footer>
      <div class="footer-top">
         <div class="container">
            <div class="row gy-5">
               <div class="col-md-4">
                  <h4 class="logo-text">About US</h4>
                  <p>We are a donation based organization which ensures proper safety and verificaiton of the users and works for the betterment of the world. </br> OUR social media platforms:</p>
                  <div class="social-icons">
                     <a href="#"><i class="bx bxl-facebook"></i></a>
                     <a href="#"><i class="bx bxl-twitter"></i></a>
                     <a href="#"><i class="bx bxl-instagram"></i></a>
                     <a href="#"><i class="bx bxl-github"></i></a>
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">Navigation</h5>
                  <div class="footer-links">
                     <a href="#">Services</a>
                     <a href="#"></a>
                    
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">More</h5>
                  <div class="footer-links">
                     <a href="#">FAQ's</a>
                     <a href="#">Privacy & Policy</a>
                     <a href="#">Liscences</a>
                  </div>
               </div>
               <div class="col-md-2">
                  <h5 class="title-sm">Contact</h5>
                  <div class="footer-links">
                     <p class="mb">BASHUNDHARA ,DHAKA</p>
                     <p class="mb-">12345678910</p>
                     <p class="mb">admin@Sharesupply.com</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="footer-bottom">
         <div class="container">
            <div class="row justify-content-between gy-3">
               <div class="col-md-6">
                  <p class="mb-0"></p>
               </div>
               <div class="col-auto">
                  <p class="mb-0"></p>
               </div>
            </div>
         </div>
      </div>
   </footer>


    
    <script src="js/bootstrap.bundle.min.js"></script>
    
  </body>
</html>