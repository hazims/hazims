<?php
/* ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 */


// define variables and set to empty values
$location = "";
$from_date = "";
$to_date = "";
$adult = 0;
$child = 0;


require(pms_getFromTemplate('common/header.php', false));

$slide_id = 0;
$result_slide_file = $pms_db->prepare('SELECT * FROM pm_slide_file WHERE id_item = :slide_id AND checked = 1 AND lang = ' . PMS_DEFAULT_LANG . ' AND type = \'image\' AND file != \'\' ORDER BY `rank` LIMIT 1');
$result_slide_file->bindParam('slide_id', $slide_id);

$result_slide = $pms_db->query('SELECT * FROM pm_slide WHERE id_page = ' . $pms_page_id . ' AND checked = 1 AND lang = ' . PMS_LANG_ID . ' ORDER BY `rank`', PDO::FETCH_ASSOC);

/* if ($result_slide !== false) {
    $nb_slides = $pms_db->last_row_count();
    if ($nb_slides > 0) {  */
?>


<!-- <div id="search-home-wrapper">
     <div id="search-home" class="container"> -->
<?php /* include(pms_getFromTemplate('common/search.php', false)); */ ?>
<!-- </div>
     </div> -->
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


    <form action="apartaments.php" method="post">

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
                            <input type="text" name="adult" readonly id="spinner-1" value="0" />
                            <div class="d-flex bbtn ms-4" style="padding-top: 10px">
                                <a id="stepDown-1" role="button" class="py-0 my-0 px-3">-</a>
                                <a id="stepUp-1" role="button" class="py-0 my-0 px-3">+</a>
                            </div>
                        </div>
                        <p>Wie viele Erwachsene?</p>

                        <div class="hr mb-4"></div>

                        <div class="d-flex">
                            <input type="text" name="child" readonly id="spinner-2" value="0" />
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
                <button type="submit">
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
            <?php
            $result_hotel = $pms_db->query('SELECT * FROM pm_hotel WHERE checked = 1 AND home = 1 ORDER BY  rank');
            if ($result_hotel !== false) {
                $nb_hotels = $pms_db->last_row_count();

                $hotel_id = 0;

                $result_hotel_file = $pms_db->prepare('SELECT * FROM pm_hotel_file WHERE id_item = :hotel_id AND checked = 1  AND type = \'image\' AND file != \'\' ORDER BY `rank` LIMIT 1');
                $result_hotel_file->bindParam(':hotel_id', $hotel_id);

                $result_rate = $pms_db->prepare('SELECT MIN(price) as min_price, id_room FROM pm_rate WHERE id_hotel = :hotel_id limit 1');
                $result_rate->bindParam(':hotel_id', $hotel_id);

                foreach ($result_hotel as $i => $row) {
                    $hotel_id = $row['id'];

                    $hotel_title = $row['title'];
                    $hotel_subtitle = $row['subtitle'];
                    $address = $row['address'];

                    $hotel_alias = DOCBASE . $pms_pages[23]['alias'] . '/' . pms_text_format($row['alias']);

                    $min_price = '0';
                    $room_id = '0';
                    if ($result_rate->execute() !== false && $pms_db->last_row_count() >= 0) {
                        $row = $result_rate->fetch();
                        $price = $row['min_price'];
                        $room_id = $row['id_room'];
                        $min_price = $price;
                    }
                    $rate = '0';
                    $gest = '0';
                    $WLAN = 'Nein';
                    $Betten = '0';
                    $Flache = '0';
                    $result_room = $pms_db->prepare('SELECT * FROM pm_room WHERE  id= :id ');
                    $result_room->bindParam(':id', $room_id);

                    if ($result_room->execute() !== false && $pms_db->last_row_count() >= 0) {
                        //$rows = $result_room->fetch();
                        foreach ($result_room as $i => $row) {
                            $gest = (string)$row['max_people'];
                            $Flache = (string) $row['Flache'];
                            $Betten = (string)$row['Betten'];
                            if ((string) $row['WLAN'] == '1') {
                                (string) $WLAN = 'Ja';
                            }
                        }
                    }
                    $result_rating = $pms_db->prepare('SELECT  AVG(rating) as avg_rating, count(rating) as count_rating FROM pm_comment WHERE  id_item = :id_hotel  ');
                    $result_rating->bindParam(':id_hotel', $hotel_id);
                    $rate = '0';
                    $count_rating = 0;
                    if ($result_rating->execute() !== false && $pms_db->last_row_count() >= 0) {
                        foreach ($result_rating as $i => $row) {
                            $rate = round($row['avg_rating'], 2);
                            $count_rating = $row['count_rating'];
                        }
                    }

            ?>
                    <div>
                        <div class="img-1">
                            <div class="col-md-3">
                                <div class="card" style="width: 18rem">
                                    <div class="responsive1">
                                        <div class="img-15 card-img-top">
                                            <?php

                                            if ($result_hotel_file->execute() !== false && $pms_db->last_row_count() == 1) {
                                                $row = $result_hotel_file->fetch(PDO::FETCH_ASSOC);
                                                $file_id = $row['id'];
                                                $filename = $row['file'];
                                                $label = $row['label'];

                                                $realpath = 'medias/hotel/small/' . $file_id . '/' . $filename;
                                                $thumbpath = DOCBASE . 'medias/hotel/small/' . $file_id . '/' . $filename;
                                                $zoompath = DOCBASE . 'medias/hotel/big/' . $file_id . '/' . $filename;


                                            ?>
                                                <img class="card-img-top" src="<?php echo  $realpath;

                                                                                ?>" alt="Card image cap" />
                                            <?php
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <div class="star">
                                        <div>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <p class="p1"> <?php echo  $rate ?>
                                        </p>
                                        <p class="p2">(<?php echo $count_rating ?>)</p>

                                    </div>
                                    <div class="card-body pb-0 px-0">
                                        <div class="px-3">
                                            <h5 class="card-title"> <?php echo  $hotel_title;
                                                                    ?></h5>
                                            <p class="card-text"> <?php echo  $address ?></p>
                                            <hr />
                                            <div class="row">
                                                <div class="col-6">
                                                    <span class="d-flex py-2"><img class="card-feature me-2" src="templates/default/images/Pfad9.png" alt="" />
                                                        Fläche: <?php echo (string)$Flache ?> m<sup style="top: 0%">2</sup></span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="d-flex py-2"><img class="card-feature me-2" src="templates/default/images/08_Guest.png" alt="" />
                                                        Gäste: <?php echo (string)$gest ?></span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="d-flex py-2"><img class="card-feature me-2" src="templates/default/images/07_Bed.png" alt="" />
                                                        Betten:<?php echo (string)$Betten ?> </span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="d-flex py-2"><img class="card-feature me-2" src="templates/default/images/Pfad11.png" alt="" />
                                                        WLAN: <?php echo $WLAN ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 pt-3">

                                            <?php
                                            $host = DOCBASE . 'single-apartment.php/' ?>

                                            <form action="<?php echo $hotel_alias ?> " method="post">

                                                <input type="text" hidden name="room_id" value="<?php echo $room_id ?>" />


                                                <button class="btn w-100" type="submit">
                                                    <sub>ab</sub><?php echo  (string)$min_price ?><sup> CHF</sup>
                                                </button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>


            <!--            <div>-->
            <!--                <div class="img-5"></div>-->
            <!--            </div>-->
        </div>
    </div>
</section>
<!-- <section>
    <div class="row">
        <?php
        $lz_offset = 1;
        $lz_limit = 9;
        $lz_pages = 0;
        $num_records = 0;
        $result = $pms_db->query("SELECT count(*) FROM pm_hotel WHERE checked = 1 AND lang = " . PMS_LANG_ID);
        if ($result !== false) {
            $num_records = $result->fetchColumn(0);
            $lz_pages = ceil($num_records / $lz_limit);
        }
        if ($num_records > 0) { ?>
            <div class="isotopeWrapper clearfix isotope lazy-wrapper" data-loader="<?php echo pms_getFromTemplate("common/get_hotels.php"); ?>" data-mode="click" data-limit="<?php echo $lz_limit; ?>" data-pages="<?php echo $lz_pages; ?>" data-more_caption="<?php echo $pms_texts['LOAD_MORE']; ?>" data-is_isotope="true" data-variables="page_id=<?php echo $pms_page_id; ?>&page_alias=<?php echo $page['alias']; ?>">
                <?php include(pms_getFromTemplate("common/get_hotels.php", false)); ?>
            </div>
        <?php
        } ?>
    </div>
</section> -->
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
                <img src="templates/default/images/10_Component1.png" alt="" />
                <h4 class="h4 mt-5">Finden</h4>
                <p class="p mt-3">Finde ein passendes Apartment für dich</p>
            </div>
            <div class="col-md-4 d-flex flex-column align-items-center">
                <img src="templates/default/images/11_Component2.png" alt="" />
                <h4 class="h4 mt-5">Checken</h4>
                <p class="p mt-3">Überprüfe die Verfügbarkeit</p>
            </div>
            <div class="col-md-4 d-flex flex-column align-items-center">
                <img src="templates/default/images/12_Component3.png" alt="" />

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
                <img class="w-100" src="templates/default/images/13_Apartments.png" alt="" />
                <h4 class="h4 t-position position-absolute">Apartments</h4>
            </div>
        </a>
        <div class="d-block-768 d-flex justify-content-between pt-5">
            <a href="apartments.html">
                <div class="hotel position-relative pe-3 p-0-768">
                    <img src="templates/default/images/14_Hotel.png" alt="" />
                    <h4 class="h4 t-position1 position-absolute">Hotel</h4>
                </div>
            </a>
            <a href="apartments.html">
                <div class="co-living position-relative ps-3 p-0-768 pt-90-768">
                    <img src="templates/default/images/15_Co-Living.png" alt="" />
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

<?php require(SYSBASE . 'templates/' . PMS_TEMPLATE . '/common/footer.php'); ?>


</script>
<script src="templates/default/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="templates/default/wickedpicker/dist/wickedpicker.min.js"></script>
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
        dots: false,
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
            /*  right_div.parentNode.removeChild(right_div); */
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
<script src='https://www.google.com/recaptcha/api.js?hl=<?php echo PMS_LANG_TAG; ?>'></script>
<script src="templates/default/common/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="templates/default/SwissDesign/wickedpicker/dist/wickedpicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>