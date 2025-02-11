@props(
    [
        'image'
    ]
)

<div class="swiper-slide">
    <div class="slide-inner" style="object-fit: cover;background-image:url({{ asset("images/$image") }})">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="header-text mt-5">
              <h2>Bienvenu, <em>signaler</em> tous les incident<em>autour de vous</em></h2>
              <div class="div-dec"></div>
              <p class="">Bienvenu sur notre plateforme de lanceur d'alerte ,signalez-nous tous les incidents lies a la SONABEL,ONEA et meme les cas de detresse aupres des Sapeurs Pompiers.</p>
              <div class="buttons">
                <div class="green-button">
                  <a href="{{route('login')}}">Se connecter</a>
                </div>
                <div class="orange-button">
                  <a href="tel:+22670707070">Appelez nous gratuitement</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>