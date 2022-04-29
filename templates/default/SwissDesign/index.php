<?php require_once("header.php") ?>
<div class="position-absolute section_content w-100 container h-100 d-flex flex-column justify-content-end">
  <h2 class="h2">Welcome Home</h2>
  <h1 class="h1">Apartments, Hotels & Co-Living</h1>
  <h1 class="fw-bold h1">in der ganzen Schweiz</h1>
  <h2 class="h2">Entdecken Sie jetzt über 1'000 Apartments</h2>
  <h2 class="h2">
    für Ihren nächsten Aufenthalt in der schönen Schweiz!
  </h2>
  <ul class="list-group list-group-horizontal px-60-768 mt-35">
    <li class="list-group-item" role="button" id="zurich" onClick="selectLocation(this.id)">
      Zürich
    </li>
    <li class="list-group-item" role="button" id="stGallen" onClick="selectLocation(this.id)">
      St.Gallen
    </li>
    <li class="list-group-item" role="button" id="geneve" onClick="selectLocation(this.id)">
      Genève
    </li>
    <li class="list-group-item" role="button" id="lausanne" onClick="selectLocation(this.id)">
      Lausanne
    </li>
    <li class="list-group-item" role="button" id="ticino" onClick="selectLocation(this.id)">
      Ticino
    </li>
  </ul>
  <form class="w-100" action="apartments.html">
    <div class="d-flex d-block-1023">
      <div class="location d-flex flex-column">
        <label class="">Lokation</label>
        <div class="form-group w-100">
          <input class="form-control" id="location" type="text" autocomplete="off" name="location" placeholder="Wo möchtest du hin?" />
        </div>
      </div>
      <div class="check-in d-flex flex-column">
        <label class="">Check-in</label>
        <input class="form-control" name="date" id="check_in" aria-describedby="telephoneHelpId" placeholder="Wann?" autocomplete="off" />
      </div>
      <div class="check-out d-flex flex-column">
        <label class="">Check-out</label>
        <input class="form-control" name="date" id="check_out" aria-describedby="telephoneHelpId" placeholder="Wann?" autocomplete="off" />
      </div>
      <div class="gaste d-flex flex-column">
        <label class="">Gäste</label>
        <input class="form-control text-decoration-none table-hover" autocomplete="off" data-bs-toggle="collapse" href="#anzahl_personen" role="button" id="txt_anzahl_personen" aria-expanded="false" aria-controls="anzahl_personen" placeholder="Anzahl Personen?" />
        <!--                            </input>-->
        <div class="collapse" id="anzahl_personen">
          <div class="card card-body position-absolute">
            <div class="d-flex">
              <input type="text" readonly id="spinner-1" value="0" />
              <div class="d-flex bbtn ms-4" style="padding-top: 10px">
                <a id="stepDown-1" role="button" class="py-0 my-0 px-3">-</a>
                <a id="stepUp-1" role="button" class="py-0 my-0 px-3">+</a>
              </div>
            </div>
            <p>Wie viele Erwachsene?</p>

            <div class="hr mb-4"></div>

            <div class="d-flex">
              <input type="text" readonly id="spinner-2" value="0" />
              <div class="d-flex bbtn ms-4" style="padding-top: 10px">
                <a id="stepDown-2" role="button" class="py-0 my-0 px-3">-</a>
                <a id="stepUp-2" role="button" class="py-0 my-0 px-3">+</a>
              </div>
            </div>
            <p>Wie viele Kinder?</p>
          </div>
        </div>
      </div>
      <div class="btn">
        <button>
          <i class="fa fa-angle-right" aria-hidden="true"></i>
        </button>
      </div>
    </div>
  </form>
</div>
</div>
</div>
<div class="bg_gradient">
  <div></div>
</div>
</section>
<section id="apartments_hotel" class="pt-150">
  <div class="container pt-150">
    <h3 class="h3">Apartments, Hotel & Co-Living</h3>
    <p style="font-size: 20px" class="p">
      Alle unsere Apartments, Hotels & Co-Livng Spaces sind möbliert und
      werden wöchentlich gesäubert.
    </p>
    <div class="responsive px-20-576 mt-5 pt-5">
      <div>
        <div class="img-1">
          <div class="col-md-3">
            <div class="card" style="width: 18rem">
              <div class="responsive1">
                <div>
                  <div class="img-15 card-img-top">
                    <img class="card-img-top" src="img/02_Bild.png" alt="Card image cap" />
                  </div>
                </div>
                <div>
                  <div class="img-115">
                    <img class="card-img-top" src="img/03_Bild.png" alt="Card image cap" />
                  </div>
                </div>
                <div>
                  <div class="img-5111">
                    <img class="card-img-top" src="img/04_Bild.png" alt="Card image cap" />
                  </div>
                </div>
              </div>
              <div class="star">
                <div>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <p class="p1">5.0</p>
                <p class="p2">(15)</p>
              </div>
              <div class="card-body pb-0 px-0">
                <div class="px-3">
                  <h5 class="card-title">Swiss Star Airport</h5>
                  <p class="card-text">Obstgartenstrasse 24, 8302 Kloten</p>
                  <hr />
                  <div class="row">
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/Pfad 9.png" alt="" />
                        Fläche: 130m<sup style="top: 0%">2</sup></span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/08_Guest.png" alt="" />
                        Gäste: 2</span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/07_Bed.png" alt="" />
                        Betten: 2</span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/Pfad 11.png" alt="" />
                        WLAN: NEIN</span>
                    </div>
                  </div>
                </div>
                <div class="d-grid gap-2 pt-3">
                  <a href="single_apartment.html" class="text-decoration-none text-white">
                    <button class="btn w-100" type="button">
                      <sub>ab</sub>119 <sup>CHF</sup>
                    </button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div>
        <div class="img-2">
          <div class="col-md-3">
            <div class="card" style="width: 18rem">
              <!--                            <img class="card-img-top" src="img/03_Bild.png" alt="Card image cap">-->
              <div class="test1">
                <div class="responsive1">
                  <div>
                    <div class="img-15 card-img-top">
                      <img class="card-img-top" src="img/04_Bild.png" alt="Card image cap" />
                    </div>
                  </div>
                  <div>
                    <div class="img-115">
                      <img class="card-img-top" src="img/02_Bild.png" alt="Card image cap" />
                    </div>
                  </div>
                  <div>
                    <div class="img-5111">
                      <img class="card-img-top" src="img/03_Bild.png" alt="Card image cap" />
                    </div>
                  </div>
                </div>
                <div class="star">
                  <div>
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                  <p class="p1">5.0</p>
                  <p class="p2">(15)</p>
                </div>
              </div>
              <div class="test2">
                <div class="card-body pb-0 px-0">
                  <div class="px-3">
                    <h5 class="card-title">Swiss Star Airport</h5>
                    <p class="card-text">
                      Obstgartenstrasse 24, 8302 Kloten
                    </p>
                    <hr />
                    <div class="row">
                      <div class="col-6">
                        <span class="d-flex py-2"><img class="card-feature me-2" src="img/Pfad 9.png" alt="" />
                          Fläche: 130m<sup style="top: 0%">2</sup></span>
                      </div>
                      <div class="col-6">
                        <span class="d-flex py-2"><img class="card-feature me-2" src="img/08_Guest.png" alt="" />
                          Gäste: 2</span>
                      </div>
                      <div class="col-6">
                        <span class="d-flex py-2"><img class="card-feature me-2" src="img/07_Bed.png" alt="" />
                          Betten: 2</span>
                      </div>
                      <div class="col-6">
                        <span class="d-flex py-2"><img class="card-feature me-2" src="img/Pfad 11.png" alt="" />
                          WLAN: NEIN</span>
                      </div>
                    </div>
                  </div>
                  <div class="d-grid gap-2 pt-3">
                    <a href="single_apartment.html" class="text-decoration-none text-white">
                      <button class="btn w-100" type="button">
                        <sub>ab</sub>119 <sup>CHF</sup>
                      </button></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="img-3">
          <div class="col-md-3">
            <div class="card" style="width: 18rem">
              <div class="responsive1">
                <div>
                  <div class="img-15 card-img-top">
                    <img class="card-img-top" src="img/05_Bild.png" alt="Card image cap" />
                  </div>
                </div>
                <div>
                  <div class="img-115">
                    <img class="card-img-top" src="img/03_Bild.png" alt="Card image cap" />
                  </div>
                </div>
                <div>
                  <div class="img-5111">
                    <img class="card-img-top" src="img/02_Bild.png" alt="Card image cap" />
                  </div>
                </div>
              </div>
              <div class="star">
                <div>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <p class="p1">5.0</p>
                <p class="p2">(15)</p>
              </div>

              <div class="card-body pb-0 px-0">
                <div class="px-3">
                  <h5 class="card-title">Swiss Star ZH Oerlikon</h5>
                  <p class="card-text">Gubelstrasse 64, 8050 Zürich</p>
                  <hr />
                  <div class="row">
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/Pfad 9.png" alt="" />
                        Fläche: 130m<sup style="top: 0%">2</sup></span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/08_Guest.png" alt="" />
                        Gäste: 2</span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/07_Bed.png" alt="" />
                        Betten: 2</span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/Pfad 11.png" alt="" />
                        WLAN: NEIN</span>
                    </div>
                  </div>
                </div>
                <div class="d-grid gap-2 pt-3">
                  <a href="single_apartment.html" class="text-decoration-none text-white">
                    <button class="btn w-100" type="button">
                      <sub>ab</sub>119 <sup>CHF</sup>
                    </button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="img-4">
          <div class="col-md-3">
            <div class="card" style="width: 18rem">
              <div class="responsive1">
                <div>
                  <div class="img-15 card-img-top">
                    <img class="card-img-top" src="img/02_Bild.png" alt="Card image cap" />
                  </div>
                </div>
                <div>
                  <div class="img-115">
                    <img class="card-img-top" src="img/03_Bild.png" alt="Card image cap" />
                  </div>
                </div>
                <div>
                  <div class="img-5111">
                    <img class="card-img-top" src="img/04_Bild.png" alt="Card image cap" />
                  </div>
                </div>
              </div>
              <div class="star">
                <div>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <p class="p1">5.0</p>
                <p class="p2">(15)</p>
              </div>
              <div class="card-body pb-0 px-0">
                <div class="px-3">
                  <h5 class="card-title">Swiss Star Sihlfeld</h5>
                  <p class="card-text">Dubsstrasse 30, 8003 Zürich</p>
                  <hr />
                  <div class="row">
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/Pfad 9.png" alt="" />
                        Fläche: 130m<sup style="top: 0%">2</sup></span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/08_Guest.png" alt="" />
                        Gäste: 2</span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/07_Bed.png" alt="" />
                        Betten: 2</span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/Pfad 11.png" alt="" />
                        WLAN: NEIN</span>
                    </div>
                  </div>
                </div>
                <div class="d-grid gap-2 pt-3">
                  <a href="single_apartment.html" class="text-decoration-none text-white">
                    <button class="btn w-100" type="button">
                      <sub>ab</sub>119 <sup>CHF</sup>
                    </button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="img-5">
          <div class="col-md-3">
            <div class="card" style="width: 18rem">
              <div class="responsive1">
                <div>
                  <div class="img-15 card-img-top">
                    <img class="card-img-top" src="img/02_Bild.png" alt="Card image cap" />
                  </div>
                </div>
                <div>
                  <div class="img-115">
                    <img class="card-img-top" src="img/03_Bild.png" alt="Card image cap" />
                  </div>
                </div>
                <div>
                  <div class="img-5111">
                    <img class="card-img-top" src="img/04_Bild.png" alt="Card image cap" />
                  </div>
                </div>
              </div>
              <div class="star">
                <div>
                  <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <p class="p1">5.0</p>
                <p class="p2">(15)</p>
              </div>
              <div class="card-body pb-0 px-0">
                <div class="px-3">
                  <h5 class="card-title">Swiss Star Sihlfeld</h5>
                  <p class="card-text">Dubsstrasse 30, 8003 Zürich</p>
                  <hr />
                  <div class="row">
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/Pfad 9.png" alt="" />
                        Fläche: 130m<sup style="top: 0%">2</sup></span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/08_Guest.png" alt="" />
                        Gäste: 2</span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/07_Bed.png" alt="" />
                        Betten: 2</span>
                    </div>
                    <div class="col-6">
                      <span class="d-flex py-2"><img class="card-feature me-2" src="img/Pfad 11.png" alt="" />
                        WLAN: NEIN</span>
                    </div>
                  </div>
                </div>
                <div class="d-grid gap-2 pt-3">
                  <a href="single_apartment.html" class="text-decoration-none text-white">
                    <button class="btn w-100" type="button">
                      <sub>ab</sub>119 <sup>CHF</sup>
                    </button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--            <div>-->
      <!--                <div class="img-5"></div>-->
      <!--            </div>-->
    </div>
  </div>
</section>
<section id="Apartment_buchen" class="pt-150">
  <div class="container">
    <h3 class="h3">Apartment buchen ganz einfach</h3>
    <p class="p">
      Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
      nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
      sed diam voluptua. At vero eos et accusam et.
    </p>
    <div class="row pt-5 mt-5">
      <div class="col-md-4 d-flex flex-column align-items-center">
        <img src="img/10_Component1.png" alt="" />
        <h4 class="h4 mt-5">Finden</h4>
        <p class="p mt-3">Finde ein passendes Apartment für dich</p>
      </div>
      <div class="col-md-4 d-flex flex-column align-items-center">
        <img src="img/11_Component2.png" alt="" />
        <h4 class="h4 mt-5">Checken</h4>
        <p class="p mt-3">Überprüfe die Verfügbarkeit</p>
      </div>
      <div class="col-md-4 d-flex flex-column align-items-center">
        <img src="img/12_Component3.png" alt="" />

        <h4 class="h4 mt-5">Reservieren</h4>
        <p class="p mt-3">Reserviere dein Apartment</p>
      </div>
    </div>
  </div>
</section>
<section id="Apartments_Hotel_Co-Living" class="pt-150">
  <div class="container">
    <a href="apartments.html">
      <div class="apartments position-relative pb-5">
        <img class="w-100" src="img/13_Apartments.png" alt="" />
        <h4 class="h4 t-position position-absolute">Apartments</h4>
      </div>
    </a>
    <div class="d-block-768 d-flex justify-content-between pt-5">
      <a href="apartments.html">
        <div class="hotel position-relative pe-3 p-0-768">
          <img src="img/14_Hotel.png" alt="" />
          <h4 class="h4 t-position1 position-absolute">Hotel</h4>
        </div>
      </a>
      <a href="apartments.html">
        <div class="co-living position-relative ps-3 p-0-768 pt-90-768">
          <img src="img/15_Co-Living.png" alt="" />
          <h4 class="h4 t-position1 position-absolute">Co-Living</h4>
        </div>
      </a>
    </div>
  </div>
</section>
<section id="Moderne_Apartment" class="mt-150">
  <div class="container d-flex align-items-center h-100">
    <div class="moderne-content p-5">
      <h4>Moderne Apartment</h4>
      <h5>ab 49CHF pro Nacht</h5>
      <p class="p">
        Lorem ipsum dolor sit amet, consetetur sadipscingelitr, sed diam
        nonumy eirmod tempor invidunt ut labore et dolore
      </p>
      <a class="text-decoration-none" href="apartments.html"><button>Jetzt Apartment buchen</button></a>
    </div>
  </div>
</section>
<section id="Unser_Service" class="pt-150">
  <div class="container">
    <h3 class="h3">Unser Service für Sie</h3>
    <p style="font-size: 20px" class="p">
      Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
      nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
      sed diam voluptua. At vero eos et accusam et justo duo dolores et ea
      rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem
      ipsum dolor sit amet.
    </p>

    <div class="row py-5 mb-3 pl-10-575">
      <div class="br-5 my-5 col-md-6">
        <h5>Langzeitaufenthalt</h5>
        <p>
          Ob für eine Woche, mehrere Monate oder auf unbestimmte Zeit: Wir
          sind davon überzeugt, dass Sie unsere Wohnmöglichkeiten mögen.
          Geniessen Sie Ihre Bewegungsfreiheit, Privatsphäre, Freizeit und
          lassen Sie uns den Rest erledigen.
        </p>
      </div>

      <div class="br-5 my-5 col-md-6">
        <h5>Reinigung</h5>
        <p>
          Unser wöchentlicher Reinigungsservice mit Wäschewechsel
          (Handtücher und Bettwäsche) ist im Mietpreis für alle Wohnungen,
          einschließlich der Entsorgung und Endreinigung im Preis
          inbegriffen.
        </p>
      </div>

      <div class="br-5 my-5 col-md-6">
        <h5>Gratis WiFi</h5>
        <p>
          Alle unsere Wohnungen haben eine kostenlose
          Business-WiFi-Verbindung mit 24-Stunden-Internetzugang.
        </p>
      </div>

      <div class="br-5 my-5 col-md-6">
        <h5>Kinderfreundlich</h5>
        <p>
          Auf Wunsch können wir jederzeit ein zusätzliches Bett für eine
          zusätzliche Gebühr zur Verfügung stellen.
        </p>
      </div>

      <div class="br-5 my-5 col-md-6">
        <h5>Tierfreundlich</h5>
        <p>
          Natürlich können Sie Ihren Hund oder Ihre Katze mitbringen. Durch
          einen zusätzlichen Reinigungsaufwand, müssen wir einen kleinen
          Aufschlag auf den Preis machen.
        </p>
      </div>

      <div class="br-5 my-5 col-md-6">
        <h5>Parking</h5>
        <p>
          Wenn ein Parkplatz erforderlich ist, sind wir jederzeit in der
          Lage, einen gegen Bezahlung zur Verfügung zu stellen. Dies ist
          immer abhängig von der Verfügbarkeit.
        </p>
      </div>
    </div>
  </div>
</section>
<?php require_once("footer.php"); ?>

<!--<div class="modal fade" id="login" tabindex="-1" aria-labelledby="login"-->
<!--     aria-hidden="true">-->
<!--    <div class="modal-dialog modal-fullscreen px-10-768">-->
<!--        <div class="modal-content bg-transparent">-->
<!--            <div class="container">-->
<!--                <div class="w-100 d-flex justify-content-end">-->
<!--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
<!--                </div>-->
<!--                <div class="py-4">-->
<!--                    <div class="row border-radius-80 bg_secondary">-->

<!--                    </div>-->

<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<!--======================-->

<div class="modal fade" id="modal-login-register" tabindex="-1" aria-labelledby="register" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen px-10-768">
    <div class="modal-content bg-transparent">
      <div class="container">
        <div class="py-4">
          <div id="login-register" class="bg-transparent border-0">
            <div class="d-flex justify-content-between align-items-center px-4">
              <ul class="">
                <li><a href="#tab-login">Login</a></li>
                <li><a href="#tab-registrieren">Registrieren</a></li>
              </ul>

              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="tab-login">
              <div class="row border-radius-80 bg_secondary">
                <div class="col-lg-6 mt-5 px-4">
                  <div class="container">
                    <!-- <h3>Login</h3> -->
                    <h3 style="font-size: 30px; font-family: Montserrat">
                      Login
                    </h3>
                    <!-- <h4>Log dich jetzt ein.</h4> -->
                    <p style="
                            font-size: 25px;
                            color: #292929;
                            font-family: Montserrat;
                          ">
                      Log dich jetzt ein
                    </p>
                    <a href="#" class="btn px-0 w-100">
                      <div class="d-flex border border-dark border-radius-30 justify-content-center align-items-center py-3">
                        <img class="h-75 pe-3" src="img/34_GoogleLogo.png" alt="" />
                        <p class="mb-0" style="font-family: Montserrat">
                          mit Google anmelden
                        </p>
                      </div>
                    </a>
                    <div class="d-flex justify-content-center align-items-center mb-3 pt-5 pb-5">
                      <div class="w-75 ms-0" style="height: 0">
                        <div class="border-dark border-0 border-bottom" style="width: 75%"></div>
                      </div>
                      <div class="w-100">
                        <p class="mb-0 text-center w-100" style="font-size: 20px; font-family: Montserrat">
                          Anmelden mit E-Mail
                        </p>
                      </div>
                      <div class="w-75 ms-auto" style="height: 0">
                        <div class="border-dark border-0 border-bottom ms-auto" style="width: 75%"></div>
                      </div>
                    </div>

                    <form action="">
                      <div class="mb-3">
                        <label for="email" class="form-label" style="font-size: 25px; font-family: Montserrat">Email:</label>
                        <input type="email" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="email1" aria-describedby="emailHelp" />
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label" style="font-size: 25px; font-family: Montserrat">Password:</label>
                        <input type="password" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="password1" aria-describedby="emailHelp" />
                      </div>
                      <div class="d-flex justify-content-center">
                        <div class="mb-3 form-check w-100">
                          <input type="checkbox" class="form-check-input" style="border-radius: 0" id="check1" />
                          <label class="form-check-label" for="check1" style="font-size: 15px; font-family: Montserrat">Check me out</label>
                        </div>
                        <a href="#" class="text-end w-100 text-decoration-none" style="font-size: 15px; font-family: Montserrat">Passwort vergessen</a>
                      </div>
                      <button type="submit" class="btn bg_primary w-100 color_secondary border-radius-30 my-3 py-3" style="font-size: 20px">
                        Submit
                      </button>
                      <div class="d-flex">
                        <p class="mb-0 pe-2" style="font-size: 15px; font-family: Montserrat">
                          Noch keinen Account?
                        </p>
                        <a href="#tab-registrieren" style="font-size: 15px; font-family: Montserrat">
                          Erstelle jetzt deinen Account</a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-lg-6 pe-0 px-0-1199 d-none-992">
                  <p class="rightpart" style="font-family: Montserrat !important">
                    Geniessen Sie Ihren Urlaub <br /><b> mit Swiss Star </b>
                  </p>
                  <img class="ps-5 px-0-1199" src="img/33_LoginRegisrierten.png" alt="" />
                </div>
              </div>
            </div>
            <div id="tab-registrieren">
              <div class="row border-radius-80 bg_secondary" style="font-family: Montserrat">
                <div class="col-lg-6 mt-5 px-4">
                  <div class="container">
                    <h3 style="font-size: 30px; font-family: Montserrat">
                      Jetzt Registrieren
                    </h3>
                    <!-- <h4>Entdecke jetzt Swiss Star</h4> -->
                    <p style="
                            font-size: 25px;
                            color: #292929;
                            font-family: Montserrat;
                          ">
                      Entdecke jetzt Swiss Star
                    </p>
                    <form action="" class="pt-4">
                      <div class="mb-3">
                        <label for="username" class="form-label" style="
                                font-size: 25px;
                                color: #292929;
                                font-family: Montserrat;
                              ">Username:</label>
                        <input type="text" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="username" aria-describedby="emailHelp" />
                      </div>
                      <div class="mb-3">
                        <label for="email" class="form-label" style="
                                font-size: 25px;
                                color: #292929;
                                font-family: Montserrat;
                              ">Email:</label>
                        <input type="email" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="email" aria-describedby="emailHelp" />
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label" style="
                                font-size: 25px;
                                color: #292929;
                                font-family: Montserrat;
                              ">Password:</label>
                        <input type="password" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="password" aria-describedby="emailHelp" />
                      </div>
                      <div class="d-flex justify-content-center">
                        <div class="mb-3 form-check w-100">
                          <input type="checkbox" class="form-check-input" style="border-radius: 0" id="exampleCheck1" />
                          <label class="form-check-label" for="exampleCheck1" style="font-size: 15px; font-family: Montserrat">Ich akzeptiere die AGB's</label>
                        </div>
                      </div>

                      <a href="#" class="btn px-0 w-100 mb-2">
                        <div class="d-flex border border-dark border-radius-30 justify-content-center align-items-center py-3">
                          <img class="h-75 pe-3" src="img/34_GoogleLogo.png" alt="" />
                          <p class="mb-0" style="font-family: Montserrat; font-size: 18px">
                            mit Google anmelden
                          </p>
                        </div>
                      </a>

                      <button type="submit" class="btn bg_primary w-100 color_secondary border-radius-30 mt-3 mb-3 py-3" style="font-size: 20px; font-family: Montserrat">
                        Submit
                      </button>
                      <div class="d-flex">
                        <p class="mb-0 pe-2" style="font-size: 15px; font-family: Montserrat">
                          Noch keinen Account?
                        </p>
                        <a href="#tab-login" style="font-size: 15px; font-family: Montserrat">Login</a>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-lg-6 pe-0 px-0-1199 d-none-992">
                  <p class="rightpart">
                    Geniessen Sie Ihren Urlaub <br /><b> mit Swiss Star </b>
                  </p>
                  <img class="ps-5 px-0-1199" src="img/33_LoginRegisrierten.png" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--======================-->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="wickedpicker/dist/wickedpicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  let dates1 = [
    '2022-04-01',
    '2022-04-02',
    '2022-04-03',
    '2022-04-04',
    '2022-04-05',
    '2022-04-06',
    '2022-04-07',
    '2022-04-08',
    '2022-04-09',
    '2022-04-10',
    '2022-04-11',
    '2022-04-12',
    '2022-04-13',
    '2022-04-14',
    '2022-04-15',
  ];

  let dates2 = [
    '2022-04-16',
    '2022-04-17',
    '2022-04-18',
    '2022-04-19',
    '2022-04-20',
    '2022-04-21',
    '2022-04-22',
    '2022-04-23',
    '2022-04-24',
    '2022-04-25',
    '2022-04-26',
    '2022-04-27',
  ];

  $('#check_in').datepicker({
    dateFormat: 'dd/mm/yy',
    // beforeShowDay: $.datepicker.noWeekends,
    // minDate: 0,
    firstDay: 1,
    showOtherMonths: true,
    changeMonth: true,
    changeYear: true,
    yearRange: '+0:+10',

    dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
    monthNames: [
      'Januar',
      'Februar',
      'März',
      'April',
      'Mai',
      'Juni',
      'Juli',
      'August',
      'September',
      'Oktober',
      'November',
      'Dezember',
    ],
    buttonImage: "{{ asset('img/prew.png') }}",

    beforeShow: function(input, inst) {
      var $this = $(this);
      var cal = inst.dpDiv;
      var top = $this.offset().top + $this.outerHeight();
      var left = $this.offset().left;

      setTimeout(function() {
        cal.css({
          top: top,
          left: left,
        });
      }, 1);
    },

    beforeShowDay: function(date) {
      let y = date.getFullYear().toString();
      let m = (date.getMonth() + 1).toString();
      let d = date.getDate().toString();
      if (m.length == 1) {
        m = '0' + m;
      }
      if (d.length == 1) {
        d = '0' + d;
      }
      let currDate = y + '-' + m + '-' + d;
      if (dates1.indexOf(currDate) >= 0) {
        return [true, 'ui-highlight'];
      } else {
        return [true, 'ui-highlight2'];
      }
    },
  });

  $('#check_out').datepicker({
    dateFormat: 'dd/mm/yy',
    // beforeShowDay: $.datepicker.noWeekends,
    // minDate: 0,
    firstDay: 1,
    showOtherMonths: true,
    changeMonth: true,
    changeYear: true,
    yearRange: '+0:+10',

    dayNamesMin: ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'],
    monthNames: [
      'Januar',
      'Februar',
      'März',
      'April',
      'Mai',
      'Juni',
      'Juli',
      'August',
      'September',
      'Oktober',
      'November',
      'Dezember',
    ],
    buttonImage: "{{ asset('img/prew.png') }}",

    beforeShow: function(input, inst) {
      var $this = $(this);
      var cal = inst.dpDiv;
      var top = $this.offset().top + $this.outerHeight();
      var left = $this.offset().left;

      setTimeout(function() {
        cal.css({
          top: top,
          left: left,
        });
      }, 1);
    },

    beforeShowDay: function(date) {
      let y = date.getFullYear().toString();
      let m = (date.getMonth() + 1).toString();
      let d = date.getDate().toString();
      if (m.length == 1) {
        m = '0' + m;
      }
      if (d.length == 1) {
        d = '0' + d;
      }
      let currDate = y + '-' + m + '-' + d;
      if (dates1.indexOf(currDate) >= 0) {
        return [true, 'ui-highlight'];
      } else if (dates2.indexOf(currDate) >= 0) {
        return [true, 'ui-highlight3'];
      } else {
        return [true, 'ui-highlight2'];
      }
    },
  });

  // $('#time').on('change', function (e) {
  //     var h = this.value.split(':');
  //     if (h[0] < '09' || h[0] > '20') {
  //         e.preventDefault();
  //         e.target.setCustomValidity('Choose a time between 09:00 and 20:00.');
  //     } else {
  //         e.target.setCustomValidity('');
  //     }
  // })
</script>
<script>
  $('#check_in')
    .datepicker()
    .bind('click keyup', function() {
      if ($('#ui-datepicker-div .ui-datepicker-title').is('div')) {
        $('#ui-datepicker-div .ui-datepicker-title').prepend(
          '<span class="position-absolute start-0 ms-2">Datum</span>'
        );
      }
    });

  $('#check_out')
    .datepicker()
    .bind('click keyup', function() {
      if ($('#ui-datepicker-div .ui-datepicker-title').is('div')) {
        $('#ui-datepicker-div .ui-datepicker-title').prepend(
          '<span class="position-absolute start-0 ms-2">Datum</span>'
        );
      }
    });
</script>
<script>
  $(function() {
    $(document).click(function(event) {
      let id_ = event.target.id;
      if (
        id_ != 'stepUp-1' &&
        id_ != 'stepDown-1' &&
        id_ != 'stepUp-2' &&
        id_ != 'stepDown-2'
      ) {
        let spinner1 = $('#spinner-1').val();
        let spinner2 = $('#spinner-2').val();

        if (parseInt(spinner1) + parseInt(spinner2) != 0) {
          $('#txt_anzahl_personen').val(
            parseInt(spinner1) + parseInt(spinner2)
          );
        } else {
          $('#txt_anzahl_personen').val(null);
        }
        $('#anzahl_personen').collapse('hide');
      }
    });
  });

  $(function() {
    $('#spinner-1').spinner();
    $('button').button();

    $('#stepUp-1').click(function() {
      $('#spinner-1').spinner('stepUp');
    });
    $('#spinner-1').spinner('option', 'min', 0);

    $('#stepDown-1').click(function() {
      $('#spinner-1').spinner('stepDown');
    });
  });

  $(function() {
    $('#spinner-2').spinner();
    $('button').button();

    $('#stepUp-2').click(function() {
      $('#spinner-2').spinner('stepUp');
    });

    $('#spinner-2').spinner('option', 'min', 0);

    $('#stepDown-2').click(function() {
      $('#spinner-2').spinner('stepDown');
    });
  });
</script>
<script>
  $('.responsive').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 1,
    responsive: [{
        breakpoint: 1400,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          // dots: true
        },
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
          // dots: true
        },
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          // dots: true
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      // {
      //     breakpoint: 576,
      //     settings: {
      //         arrows: false,
      //         slidesToShow: 1,
      //         slidesToScroll: 1
      //     }
      // },
    ],
  });
</script>
<script>
  $('.responsive1').slick({
    dots: true,
    infinite: true,
    arrows: false,
    speed: 300,
    slidesToShow: 1,
    slidesToScroll: 1,
    // autoplay: true,
    // autoplaySpeed: 1000,
  });
</script>
<script>
  function selectLocation(location_id) {
    selectLocation_ = document.getElementById(location_id).innerText;
    document.getElementById('location').value = selectLocation_;
  }
</script>
<script>
  function autocomplete(inp, arr) {
    var currentFocus;
    inp.addEventListener('input', function(e) {
      var a,
        b,
        i,
        val = this.value;
      closeAllLists();
      right_div = document.createElement('DIV');
      if (!val) {
        return false;
      }
      currentFocus = -1;
      a = document.createElement('DIV');
      a.setAttribute('id', this.id + 'autocomplete-list');
      a.setAttribute('class', 'autocomplete-items');
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
        location_uppercase = arr[i].toUpperCase();
        if (location_uppercase.includes(val.toUpperCase())) {
          b = document.createElement('DIV');
          b.innerHTML = arr[i];
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          b.addEventListener('click', function(e) {
            inp.value = this.getElementsByTagName('input')[0].value;
            closeAllLists();
          });
          a.appendChild(b);
        }
      }
      right_div.setAttribute('id', 'right_div');
      this.parentNode.appendChild(right_div);
    });
    inp.addEventListener('keydown', function(e) {
      var x = document.getElementById(this.id + 'autocomplete-list');
      if (x) x = x.getElementsByTagName('div');
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) {
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
      right_div = document.getElementById('right_div');
      // right_div.parentNode.removeChild(right_div);
    });

    function addActive(x) {
      if (!x) return false;
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = x.length - 1;
      x[currentFocus].classList.add('autocomplete-active');
    }

    function removeActive(x) {
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove('autocomplete-active');
      }
    }

    function closeAllLists(elmnt) {
      var x = document.getElementsByClassName('autocomplete-items');
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }

    document.addEventListener('click', function(e) {
      closeAllLists(e.target);
      right_div = document.getElementById('right_div');
      right_div.parentNode.removeChild(right_div);
    });
  }

  var countries = [
    'Zürich (Kanton)',
    'Bern (Kanton)',
    'Luzern (Kanton)',
    'Uri (Kanton)',
  ];
  autocomplete(document.getElementById('location'), countries);
</script>

<script>
  $(function() {
    $('#login-register').tabs();
  });
</script>
<script>
  $(document).ready(function() {
    $('#login-register').tabs();
    $("#login-register>div a[href^='#']").click(function() {
      var index = $($(this).attr('href')).index() - 1;
      $('#login-register').tabs('option', 'active', index);
      return false;
    });
  });

  // $('#modal-login-register').on('show.bs.modal', function (e) {
  //
  //     $("#btn-login").click(function () {
  //         // $("#tab-login").tabs("option", "active", 1);
  //         // $("#login-register").tabs("option", "active", index);
  //         $( "#login-register" ).tabs({ active: '#tab_login' });
  //         // alert('l')
  //     });
  //
  //     $("#btn-register").click(function () {
  //         // $("#tab-registrieren").tabs("option", "active", 1);
  //         $( "#login-register" ).tabs({ active: '#tab-registrieren' });
  //         // alert('r')
  //     });
  //
  // })
</script>
</body>

</html>