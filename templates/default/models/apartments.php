<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Swiss Star</title>
    <link rel="shortcut icon" type="image/png" href="templates/default/images/17_SwissStar.png" alt="logo" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        <?php include 'templates/default/models/wickedpicker/dist/wickedpicker.min.css';
        include 'templates/default/models/bootstrap/css/bootstrap.min.css';
        include 'templates/default/css/style.css'; ?>
    </style>


    <style>
        hr {
            margin: 7px 0 !important;
        }

        select {
            -webkit-appearance: none;
            appearance: none;
        }

        .form-select {
            background-image: url("templates/default/images/Polygon116.png");
        }

        input::placeholder {
            color: #D8D8D8;
            font-size: 11px;
            font-weight: 300;
            padding: 10px;

        }

        input[type="textarea"]::placeholder {
            color: black;
            font-size: 11px;
            font-weight: 500;
        }

        .form-select:focus,
        .form-select:active {
            outline: none;
            border: 1px solid #023E8A !important;
            box-shadow: none !important;
        }

        input:focus,
        input:active,
        input:focus-within {
            outline: none;
            border: 1px solid #023E8A !important;
            box-shadow: none !important;
        }

        #apartments_hotel .card {
            border: 1px solid #023E8A;

        }

        #cal_apartments .daterangepicker .calendar-table .prev {
            background-image: url("templates/default/images/Arrow2.png");
            background-repeat: no-repeat;
            position: absolute;
            top: 15px;
        }

        #cal_apartments .daterangepicker .calendar-table .next {
            background-image: url("templates/default/images/Arrow1.png");
            background-repeat: no-repeat;
            position: absolute;
            top: 10px;
            right: 15px;
        }

        @media only screen and (max-width: 576px) {
            #cal_apartments .daterangepicker {
                left: 36px !important;
                width: 83%;
            }

            #cal_apartments .daterangepicker .drp-calendar.right,
            #cal_apartments .daterangepicker .drp-calendar.left {
                width: 100%;
            }

            #cal_apartments .daterangepicker .drp-calendar.left .month {
                position: absolute;
                right: 20px;
            }

            #cal_apartments .daterangepicker .drp-calendar {
                max-width: 100%;
            }
        }
    </style>
</head>

<body id="cal_apartments">

    <header id="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid mt-4">
                    <a class="navbar-brand" href="<?php echo DOCBASE . 'index.php' ?>">
                        <h3>SWISS STAR</h3>
                        <p>WELCOME HOME</p>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav w-100">


                            <?php
                            $count = 1; // use this to only shift menu right once.
                            function subMenu($id_parent, $menu)
                            {
                            ?>
                                <span class="dropdown-btn visible-xs"></span>

                                <?php
                                foreach ($menu as $nav_id => $nav) {
                                    if ($nav['id_parent'] == $id_parent) { ?>
                                        <li class="nav-item">
                                            <?php
                                            $hasChildNav = pms_has_child_nav($nav_id, $menu); ?>
                                            <a class="<?php if ($hasChildNav) echo 'hasSubMenu'; ?>" href="<?php echo $nav['href']; ?>" target="<?php echo $nav['target']; ?>" title="<?php echo $nav['title']; ?>"><?php echo $nav['name']; ?></a>
                                            <?php if ($hasChildNav) subMenu($nav_id, $menu); ?>
                                        </li>
                                <?php

                                    }
                                } ?>

                                <?php
                            }

                            $top_nav_id = pms_get_top_nav_id($pms_menus['main']);
                            foreach ($pms_menus['main'] as $nav_id => $nav) {
                                if (empty($nav['id_parent']) || @$pms_menus['main'][$nav['id_parent']]['id_item'] == $pms_homepage['id']) { ?>
                                    <li class="nav-item <?php echo ($count === 1) ? 'ms-lg-auto' : '' ?> ">
                                        <?php

                                        if ($nav['item_type'] == 'page' && $pms_pages[$nav['id_item']]['home'] == 1) { ?>
                                            <a class="nav-link" href="<?php echo DOCBASE . trim(PMS_LANG_ALIAS, '/'); ?>" title="<?php echo $nav['title']; ?>"><?php echo $nav['name'];
                                                                                                                                                                ?></a>
                                        <?php
                                        } else {
                                            $hasChildNav = pms_has_child_nav($nav_id, $pms_menus['main']); ?>
                                            <a class="nav-link" href="<?php echo $nav['href'];
                                                                        ?>" target="<?php echo $nav['target']; ?>" title="<?php echo $nav['title']; ?>">
                                                <?php

                                                echo $nav['name'];
                                                if ($hasChildNav) { ?>
                                                    <i class="fa fa-fw fa-angle-down hidden-xs"></i>
                                                <?php
                                                } ?>
                                            </a>
                                        <?php if ($hasChildNav) subMenu($nav_id, $pms_menus['main']);
                                        }
                                        $count = 0; ?>
                                    </li>

                            <?php
                                }
                            } ?>
                            <li class="nav-item ms-lg-auto">
                                <a id="btn-login" data-bs-toggle="modal" href="#tab-login" data-bs-target="#modal-login-register" class="nav-link">Login</a>
                            </li>
                            <li class="nav-item">
                                <a id="btn-register" data-bs-toggle="modal" href="#tab-registrieren" data-bs-target="#modal-login-register" class="nav-link">Registrieren</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <section id="apartments">
        <div class="container pt-5">
            <div class="row pt-4">
                <div class="col-lg-3 pt-4 mt-2 pe-2">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid w-100 px-0">
                            <button class="navbar-toggler btn ms-auto border-1 border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filter" aria-controls="filter" aria-expanded="false" aria-label="Toggle navigation">
                                Filter
                            </button>
                            <div class="container-fluid w-100 px-0">
                                <button class="navbar-toggler btn ms-auto border-1 border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#filter" aria-controls="filter" aria-expanded="false" aria-label="Toggle navigation">
                                    Filter
                                </button>
                                <div class="collapse navbar-collapse" id="filter">
                                    <div class="right w-100 px-2">
                                        <div class="d-flex box flex-column p-3">
                                            <p class="mb-1">Grösse</p>
                                            <input type="text" id="name" name="name" required style="margin-top:10px;border:1px solid; padding:4px; border-radius:10px; font-weight:300; color: #D8D8D8;     opacity: 1;" placeholder="Lokation">

                                            <input type="text" id="name" name="name" required style="margin-top:10px;border:1px solid; padding:4px; border-radius:10px; font-weight:300; color: #D8D8D8;     opacity: 1;" placeholder="Anzahl Betten">

                                            <select name="unterkunft" class="form-select" style="border:1px solid; " id="first1" onclick="select_option()">
                                                <option value="0" style="background-color:#023E8A;   font-size:11px; color:white; font-weight: 300;">
                                                    Apartments</option>
                                                <option value="1" style="background-color:#023E8A;  font-size:11px; color:white;font-weight: 300;">
                                                    Hotels</option>
                                                <option value="2" style="background-color:#023E8A;  font-size:11px; color:white;font-weight: 300;">
                                                    Co-living</option>
                                            </select>

                                            <p class="mt-4 mb-1">Preise</p>
                                            <input type="textarea" id="name" name="name" required style="margin-top:10px;border:1px solid; padding:4px; border-radius:10px; font-weight:300; color: #D8D8D8;     opacity: 1; border:1px solid #023E8A;" placeholder="Min">

                                            <input type="textarea" id="name" name="name" required style="margin-top:10px;border:1px solid; padding:4px; border-radius:10px; font-weight:300; color: #D8D8D8; border:1px solid #023E8A;    opacity: 1;" placeholder="Max">


                                            <p class="mt-4 mb-1">Check in & Out</p>

                                            <input id="check_in" name="datefilter" required style="margin-top:10px;font-size:16px; border:1px solid #023E8A; padding:4px; border-radius:10px; font-weight:400; color: #555555;opacity: 1;" placeholder="Datum auwaglen">

                                        </div>
                                        <div class="d-flex box flex-column ausstattung p-3">
                                            <p class=" mb-1">Ausstattung</p>

                                            <div class="mt-0">
                                                <input class="form-check-input" type="checkbox" value="" id="tv">
                                                <label class="form-check-label" for="tv">
                                                    TV
                                                </label>
                                            </div>
                                            <div class="">
                                                <input class="form-check-input" type="checkbox" value="" id="kostenloses_wlan">
                                                <label class="form-check-label" for="kostenloses_wlan">
                                                    Kostenloses WLAN
                                                </label>
                                            </div>
                                            <div class="">
                                                <input class="form-check-input" type="checkbox" value="" id="nichtraucher_zimmer">
                                                <label class="form-check-label" for="nichtraucher_zimmer">
                                                    Nichtraucher Zimmer
                                                </label>
                                            </div>
                                            <div class="">
                                                <input class="form-check-input" type="checkbox" value="" id="haartrockner_fön">
                                                <label class="form-check-label" for="haartrockner_fön">
                                                    Haartrockner / Fön
                                                </label>
                                            </div>
                                            <div class="">
                                                <input class="form-check-input" type="checkbox" value="" id="mikrowelle">
                                                <label class="form-check-label" for="mikrowelle">
                                                    Mikrowelle
                                                </label>
                                            </div>
                                            <div class="">
                                                <input class="form-check-input" type="checkbox" value="" id="küche">
                                                <label class="form-check-label" for="küche">
                                                    Küche
                                                </label>
                                            </div>
                                        </div>
                                        <div class="d-flex box flex-column einrichtung p-3">
                                            <p class=" mb-1">Einrichtung</p>

                                            <div class="mt-0">
                                                <input class="form-check-input" type="checkbox" value="" id="wandern">
                                                <label class="form-check-label" for="wandern">
                                                    Wandern
                                                </label>
                                            </div>
                                            <div class="">
                                                <input class="form-check-input" type="checkbox" value="" id="fitness">
                                                <label class="form-check-label" for="fitness">
                                                    Fitness
                                                </label>
                                            </div>
                                            <div class="">
                                                <input class="form-check-input" type="checkbox" value="" id="kurse">
                                                <label class="form-check-label" for="kurse">
                                                    Kurse
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </nav>
                </div>
                <div id="apartments_hotel" class="col-lg-9">
                    <div class="d-sm-flex my-30 justify-content-between align-items-center">
                        <p>Ergebnisse: 12</p>
                        <div class="d-flex align-items-center">
                            <p>Sortieren nach:</p>
                            <select name="preisa_bsteigend" class="form-select border-0 border-bottom ms-2" style="border-bottom:1px solid #999999 !important; border-radius: unset; width: 59%;">
                                <option value="0" style="background-color:#023E8A;   font-size:11px; color:white; font-weight: 300;">
                                    Preis Absteigend</option>
                                <option value="1" style="background-color:#023E8A;   font-size:11px; color:white; font-weight: 300;">
                                    Preis Aufsteigend</option>
                                <option value="2" style="background-color:#023E8A;   font-size:11px; color:white; font-weight: 300;">
                                    Beste Bewertung</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">

                        <?php

                        $result_hotel = $pms_db->prepare('SELECT * FROM pm_hotel WHERE id=:id and checked = 1 AND home = 1 ORDER BY  rank');
                        $result_hotel->bindParam(':id', $hotel_id);

                        if ($result_hotel->execute() !== false && $pms_db->last_row_count() >= 0) {
                            // $nb_hotels = $pms_db->last_row_count();

                            $hotel_id = 0;

                            foreach ($result_hotel as $i => $row) {
                                $hotel_id = $row['id'];
                                $hotel_title = $row['title'];
                                $hotel_subtitle = $row['subtitle'];

                                $result_roomSearch = $pms_db->prepare('SELECT * FROM pm_room WHERE  id_hotel= :id_hotel ');
                                $result_roomSearch->bindParam(':id_hotel', $hotel_id);
                                if ($result_roomSearch->execute() !== false && $pms_db->last_row_count() >= 0) {

                                    foreach ($result_roomSearch as $i => $row) {

                                        $price = $row['price'];
                                        $room_ids = $row['id'];
                                        $min_price = $price;
                                        $rate = '0';
                                        $gest = '0';
                                        $WLAN = 'Nein';
                                        $Betten = '0';
                                        $Flache = '0';
                                        $gest = $row['max_people'];
                                        $Flache = $row['Flache'];
                                        $Betten = (string)$row['Betten'];
                                        if ($row['WLAN'] == '1') {
                                            (string) $WLAN = 'Ja';
                                        }



                                        $result_rating = $pms_db->prepare('SELECT  AVG(rating) as avg_rating, count(rating) as count_rating FROM pm_comment WHERE  id_item = :id_hotel  ');
                                        $result_rating->bindParam(':id_hotel', $hotel_id);
                                        $rate = 0;
                                        $count_rating = 0;
                                        if ($result_rating->execute() !== false && $pms_db->last_row_count() >= 0) {
                                            foreach ($result_rating as $i => $row) {
                                                $rate = round($row['avg_rating'], 2);
                                                $count_rating = $row['count_rating'];
                                            }
                                        }

                        ?>
                                        <div class="col-lg-4 col-md-6 px-4 mb-5">
                                            <div class="card">
                                                <div class="responsive1">
                                                    <div>
                                                        <div class="img-15 card-img-top">
                                                            <?php

                                                            $result_room_file = $pms_db->query('SELECT * FROM pm_room_file WHERE id_item = ' . $room_ids . ' AND checked = 1   AND type = \'image\' AND file != \'\' ORDER BY `rank limit 1`');
                                                            if ($result_room_file !== false && $pms_db->last_row_count() > 0) {
                                                                $row = $result_room_file->fetch(PDO::FETCH_ASSOC);
                                                                $realpath = SYSBASE . 'medias/room/small/' . $file_id . '/' . $filename;
                                                                $file_id = $row['id'];
                                                                $filename = $row['file'];






                                                            ?>
                                                                <img class="card-img-top" src="<?php echo  $realpath;

                                                                                                ?>" alt="Card image cap" />
                                                            <?php

                                                            }
                                                            ?>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="star">
                                                    <div>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                    <p class="p1"><?php echo  $rate ?></p>
                                                    <p class="p2">((<?php echo $count_rating ?>))</p>
                                                </div>
                                                <div class="card-body pb-0 px-0">

                                                    <div class="px-3">
                                                        <h5 class="card-title"><?php echo  $hotel_title ?></h5>
                                                        <p class="card-text"><?php echo  $hotel_subtitle ?></p>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <span>
                                                                    <img class="card-feature" src="templates/default/images/06_m2.png" alt="">
                                                                    Fläche: <?php echo (string)$Flache ?> m<sup style="top: 0%">2</sup></span>
                                                                </span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span><img class="card-feature" src="templates/default/images/08_Guest.png" alt="">
                                                                    Gäste: <?php echo (string)$gest ?></span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span><img class="card-feature" src="templates/default/images/07_Bed.png" alt="">
                                                                    Betten:<?php echo (string)$Betten ?> </span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span><img class="card-feature" src="templates/default/images/09_WLAN.png" alt=""> WLAN: <?php echo $WLAN ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-grid gap-2 pt-4">
                                                        <a href="single_apartment.html" class="btn" type="button"><sub>ab</sub><?php echo  (string)$min_price ?> <sup>CHF</sup></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        <?php
                                    }
                                }
                            }
                        } ?>



                    </div>
                </div>
            </div>
        </div>
    </section>
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
                                            <h3 style="font-size:30px; font-family: Montserrat;">Login</h3>
                                            <!-- <h4>Log dich jetzt ein.</h4> -->
                                            <p style="font-size:25px; color:#292929; font-family: Montserrat;">Log dich
                                                jetzt ein</p>
                                            <a href="#" class="btn px-0 w-100">
                                                <div class="d-flex border border-dark border-radius-30 justify-content-center align-items-center py-3">
                                                    <img class="h-75 pe-3" src="img/34_GoogleLogo.png" alt="">
                                                    <p class="mb-0" style="font-family:Montserrat">mit Google anmelden
                                                    </p>
                                                </div>
                                            </a>
                                            <div class="d-flex justify-content-center align-items-center mb-3 pt-5 pb-5">
                                                <div class="w-75 ms-0" style="height: 0">
                                                    <div class="border-dark border-0 border-bottom" style="width: 75%">
                                                    </div>
                                                </div>
                                                <div class="w-100">
                                                    <p class="mb-0 text-center w-100" style="font-size:20px; font-family: Montserrat;">Anmelden mit
                                                        E-Mail</p>
                                                </div>
                                                <div class="w-75 ms-auto" style="height: 0">
                                                    <div class="border-dark border-0 border-bottom ms-auto" style="width: 75%"></div>
                                                </div>
                                            </div>

                                            <form action="">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label" style="font-size:25px; font-family: Montserrat;">Email:</label>
                                                    <input type="email" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="email1" aria-describedby="emailHelp">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label" style="font-size:25px; font-family: Montserrat;">Password:</label>
                                                    <input type="password" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3  " id="password1" aria-describedby="emailHelp">
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <div class="mb-3 form-check w-100">
                                                        <input type="checkbox" class="form-check-input" style="border-radius: 0" id="check1">
                                                        <label class="form-check-label" for="check1" style="font-size:15px; font-family: Montserrat;">Check me
                                                            out</label>
                                                    </div>
                                                    <a href="#" class="text-end w-100 text-decoration-none" style="font-size:15px;font-family: Montserrat;">Passwort
                                                        vergessen</a>
                                                </div>
                                                <button type="submit" class="btn bg_primary w-100 color_secondary border-radius-30 my-3 py-3" style="font-size:20px">
                                                    Submit
                                                </button>
                                                <div class="d-flex">
                                                    <p class="mb-0 pe-2" style="font-size:15px;font-family: Montserrat;">Noch keinen
                                                        Account? </p>
                                                    <a href="#tab-registrieren" style=" font-size:15px; font-family: Montserrat;"> Erstelle
                                                        jetzt deinen Account</a>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 pe-0 px-0-1199 d-none-992">
                                        <img class="ps-5 px-0-1199" src="img/33_LoginRegisrierten.png" alt="">
                                    </div>
                                </div>
                            </div>
                            <div id="tab-registrieren">
                                <div class="row border-radius-80 bg_secondary" style="font-family:Montserrat">
                                    <div class="col-lg-6 mt-5 px-4">
                                        <div class="container">
                                            <h3 style="font-size:30px; font-family: Montserrat;">Jetzt Registrieren</h3>
                                            <!-- <h4>Entdecke jetzt Swiss Star</h4> -->
                                            <p style="font-size:25px; color:#292929; font-family: Montserrat;">Entdecke
                                                jetzt Swiss Star</p>
                                            <form action="" class="pt-4">

                                                <div class="mb-3">
                                                    <label for="username" class="form-label" style="font-size:25px; color:#292929; font-family: Montserrat;">Username:</label>
                                                    <input type="text" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="username" aria-describedby="emailHelp">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label" style="font-size:25px; color:#292929; font-family: Montserrat;">Email:</label>
                                                    <input type="email" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="email" aria-describedby="emailHelp">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password" class="form-label" style="font-size:25px; color:#292929; font-family: Montserrat;">Password:</label>
                                                    <input type="password" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3  " id="password" aria-describedby="emailHelp">
                                                </div>
                                                <div class="d-flex justify-content-center">
                                                    <div class="mb-3 form-check w-100">
                                                        <input type="checkbox" class="form-check-input" style="border-radius: 0" id="exampleCheck1">
                                                        <label class="form-check-label" for="exampleCheck1" style="font-size:15px; font-family:Montserrat">Ich
                                                            akzeptiere
                                                            die
                                                            AGB's</label>
                                                    </div>
                                                </div>

                                                <a href="#" class="btn px-0 w-100 mb-2">
                                                    <div class="d-flex border border-dark border-radius-30 justify-content-center align-items-center py-3">
                                                        <img class="h-75 pe-3" src="img/34_GoogleLogo.png" alt="">
                                                        <p class="mb-0" style="font-family:Montserrat; font-size:18px">
                                                            mit Google anmelden</p>
                                                    </div>
                                                </a>

                                                <button type="submit" class="btn bg_primary w-100 color_secondary border-radius-30 mt-3 mb-3 py-3" style="font-size:20px;font-family:Montserrat">
                                                    Submit
                                                </button>
                                                <div class="d-flex">
                                                    <p class="mb-0 pe-2" style="font-size:15px;font-family:Montserrat">
                                                        Noch keinen Account? </p>
                                                    <a href="#tab-login" style="font-size:15px;font-family:Montserrat">Login</a>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 pe-0 px-0-1199 d-none-992">
                                        <img class="ps-5 px-0-1199" src="img/33_LoginRegisrierten.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?php echo DOCBASE ?>templates/default/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        $(function() {

            $('input[name="datefilter"]').daterangepicker({
                autoUpdateInput: false,
                autoApply: true,
                opens: 'right',
                locale: {
                    cancelLabel: 'Clear'
                },
                minDate: new Date(),
                // minDate: moment().startOf('month'),
                changeMonth: false,
                changeYear: false,
                stepMonths: 0,

            });

            $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
            });

            $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

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
        $(function() {
            $("#login-register").tabs();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#login-register').tabs();
            $("#login-register>div a[href^='#']").click(function() {
                var index = $($(this).attr("href")).index() - 1
                $("#login-register").tabs("option", "active", index);
                return false
            })
        })
    </script>

</body>

</html>