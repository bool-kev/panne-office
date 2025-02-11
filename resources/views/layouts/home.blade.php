<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>panne office</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('frontend/home/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset('frontend/home/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/home/assets/css/templatemo-574-mexant.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/home/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/home/assets/css/animate.css') }}">
    {{-- <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/home/assets/js/swiper-bundle.min.css')}}">
<!--

TemplateMo 574 Mexant

https://templatemo.com/tm-574-mexant

-->
  </head>

<body>


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="/" class="logo">
                          {{-- <p class="fst-italic fs-2 fs-md-5 text-light my-3">Panne Office</p> --}}
                          <img src="{{ asset('images/logo.webp') }}" alt="Panne office"
                    style="width: 80px;height: 75px;border-radius: 50%">
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li class="bg-success px-2 mx-2"><a href="#top" class="active">Home</a></li>
                          <li class="bg-success px-2 mx-2"><a href="#about">A propos</a></li>
                          <li><a href="tel:+22670707070" class="orange-button">Appelez nous </a></li> 
                      </ul>        
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- ***** Header Area End ***** -->

  @yield('content')

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2024 ODC Groupe2 All Rights Reserved. 
          
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="{{asset('frontend/home/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/home/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('frontend/home/assets/js/isotope.min.js')}}"></script>
    <script src="{{asset('frontend/home/assets/js/owl-carousel.js')}}"></script>

    <script src="{{asset('frontend/home/assets/js/tabs.js')}}"></script>
    <script src="{{asset('frontend/home/assets/js/swiper.js')}}"></script>
    <script src="{{asset('frontend/home/assets/js/custom.js')}}"></script>
    <script>
        var interleaveOffset = 0.5;

      var swiperOptions = {
        loop: true,
        speed: 1000,
        grabCursor: true,
        watchSlidesProgress: true,
        mousewheelControl: true,
        keyboardControl: true,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
        },
        on: {
          progress: function() {
            var swiper = this;
            for (var i = 0; i < swiper.slides.length; i++) {
              var slideProgress = swiper.slides[i].progress;
              var innerOffset = swiper.width * interleaveOffset;
              var innerTranslate = slideProgress * innerOffset;
              swiper.slides[i].querySelector(".slide-inner").style.transform =
                "translate3d(" + innerTranslate + "px, 0, 0)";
            }      
          },
          touchStart: function() {
            var swiper = this;
            for (var i = 0; i < swiper.slides.length; i++) {
              swiper.slides[i].style.transition = "";
            }
          },
          setTransition: function(speed) {
            var swiper = this;
            for (var i = 0; i < swiper.slides.length; i++) {
              swiper.slides[i].style.transition = speed + "ms";
              swiper.slides[i].querySelector(".slide-inner").style.transition =
                speed + "ms";
            }
          }
        }
      };

      var swiper = new Swiper(".swiper-container", swiperOptions);
    </script>
  </body>
</html>