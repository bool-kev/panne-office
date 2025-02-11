@extends('layouts.home')
@section('content')

<body>
  <div class="swiper-container" id="top">
    <div class="swiper-wrapper">
      <x-slide image="bnsp-2.jpg"></x-slide>
      <x-slide image="slide-02-2.jpg"></x-slide>
      <x-slide image="slide-03-2.jpg"></x-slide>
    </div>
    <div class="swiper-button-next swiper-button-white" id="next"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
  </div>

  <!-- ***** Main Banner Area End ***** -->


  <section class="services" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="service-item">
            <i class="fas fa-archive"></i>
            <h4>Declarations</h4>
            <p>Avec panne office vous pouvez declarer des incidents autour de vous avec quelques click</p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="service-item">
            <i class="fas fa-cloud"></i>
            <h4>All in One</h4>
            <p>Plusieurs services sont disponibles pour l'universalite</p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="service-item">
            <i class="fas fa-charging-station"></i>
            <h4>Sans Frontiere</h4>
            <p>Declarer des incidents partout que vous etes </p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="service-item">
            <i class="fas fa-suitcase"></i>
            <h4>Distribue</h4>
            <p>Centralisez vos incidents par departement dans plusieurs villes</p>
          </div>
        </div>
        
      </div>
    </div>
  </section>


  <section class="partners">
    <div class="container">
      <div class="row">
        <div class="col-4 ">
          <div class="item">
            <img src="{{asset('images/icon1.jpg')}}" alt="" style="width: 7rem;height: 100px;border-radius: 10px">
          </div>
        </div>
        <div class="col-4 ">
          <div class="item">
            <img src="{{asset('images/icon2.jpg')}}" alt="" style="width: 7rem;height: 100px;border-radius: 10px">
          </div>
        </div>
        <div class="col-4 ">
          <div class="item">
            <img src="{{asset('images/icon3.jpg')}}" alt="" style="width: 7rem;height: 100px;border-radius: 10px">
          </div>
        </div>
        
      </div>
    </div>
  </section>
  <script>
    setInterval(() => {
        document.getElementById('next').dispatchEvent(new Event('click'));
    }, 5000);
  </script>
</body>
<!-- ***** Main Banner Area Start ***** -->
@endsection