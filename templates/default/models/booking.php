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

  <style>
    <?php include 'templates/default/models/wickedpicker/dist/wickedpicker.min.css';
    include 'templates/default/models/bootstrap/css/bootstrap.min.css';
    include 'templates/default/models/bootstrap/css/bootstrap.min_2.css';
    include 'templates/default/css/style.css'; ?>
  </style>
<?php 
$room_id = $_POST["room_id"];
$date = $_POST["datefilter"];
 
?>

  <style>
    hr {
      margin: 8px 0 !important;
    }

    /* .form-select {
      background-image: url("templates/default/images/Polygon116.png");
    } */
  </style>
</head>

<body>

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
  <section class="container pt-150" id="buchungsbestätigung">
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="responsive1">
            <div>
            <?php

$result_rooms = $pms_db->query('SELECT * FROM pm_room WHERE id= ' . $room_id . '');
$gest = '0';
$WLAN = 'Nein';
$Betten = '0';
$Flache = '0';
$Checkin = '';
$Checkout = '';
$Price = 0;
if ($result_rooms->execute() !== false && $pms_db->last_row_count() >= 0) {
    foreach ($result_rooms as $i => $row) {
        $hotel_id = $row['id_hotel'];
        $Price = $row['price'];
        $descr = $row['descr'];
        $gest = (string)$row['max_people'];
        $Flache = (string) $row['Flache'];
        $Betten = (string)$row['Betten'];
        if ($row['Checkin'] != null) {
            $Checkin = (string) $row['Checkin'];
        }

        $Checkout = (string)$row['Checkout'];

        if ((string) $row['WLAN'] == '1') {
            (string) $WLAN = 'Ja';
        }
    }
}
$pms_article_id = '';
$title_tag = '';
$page_title = '';
$address = '';
$lat = 0;
$langt = 0;
$page_subtitle = '';
$page_alias = '';

$result = $pms_db->query('SELECT * FROM pm_hotel WHERE checked = 1 and id=' . $hotel_id);
if ($result !== false && $pms_db->last_row_count() == 1) {

    $hotel = $result->fetch(PDO::FETCH_ASSOC);

    $hotel_id = $hotel['id'];
    $pms_article_id = $hotel_id;
    $title_tag = $hotel['title'] . ' - ' .  $row['subtitle'];;
    $page_title = $hotel['title'];
    $address = $hotel['address'];
    $lat = $hotel["lat"];
    $langt = $hotel["lang"];
}
$result_room_file = $pms_db->query('SELECT * FROM pm_room_file WHERE id_item = ' . $room_id . ' AND checked = 1 AND lang = ' . PMS_DEFAULT_LANG . ' AND type = \'image\' AND file != \'\' ORDER BY `rank` limit 1 ');
if ($result_room_file->execute() !== false && $pms_db->last_row_count() >= 0) {

    foreach ($result_room_file as $i => $row) {

        $file_id = $row['id_item'];
        $filename = $row['file'];
        $realpath = '';

        $page_img = pms_getUrl(true) . DOCBASE . 'medias/room/medium/' . $file_id . '/' . $filename;
        $realpath =  DOCBASE . 'medias/room/small/' . $file_id . '/' . $filename;
        if ($realpath != null) {
?>
       
            <div class="img-15 card-img-top">
                <img class="card-img-top" src="<?php echo  $realpath; ?>" alt="Card image cap">
              </div>
<?php
        }
    }
}

?>
        
            </div>
          </div>
          <div class="card-body pb-0 px-0">
            <div class=" pxy-20">
              <h5 class="card-title"><?php echo $title_tag ?></h5>
              <p class="card-text"><?php echo $address ?></p>
              <hr>
              <div class="row">
                <div class="col-6 " style="margin-bottom: 15px;">
                  <span><img class="card-feature" src="<?php echo DOCBASE . 'templates/default/images/06_m2.png' ?>" alt=""> Fläche:
                  <?php echo $Flache ?> m<sup>2</sup></span>
                </div>
                <div class="col-6" style="margin-bottom: 15px;">
                  <span><img class="card-feature" src="<?php echo DOCBASE . 'templates/default/images/08_Guest.png' ?>" alt=""> Gäste:  <?php echo  $gest ?></span>
                </div>
                <div class="col-6">
                  <span><img class="card-feature" src="<?php echo DOCBASE . 'templates/default/images/07_Bed.png' ?>" alt=""> Betten: <?php echo  $Betten ?></span>
                </div>
                <div class="col-6">
                  <span><img class="card-feature" src="<?php echo DOCBASE . 'templates/default/images/09_WLAN.png' ?>" alt=""> WLAN:  <?php echo $WLAN ?></span>
                </div>
              </div>
            </div>
            <div class="d-grid gap-2 pt-4">
              <button class="btn" type="button"><sub>ab</sub>119 <sup>CHF</sup></button>
            </div>
          </div>
        </div>
 
      </div>
      <div class="col-md-8">
        <h1 style="padding-bottom: 10px;">Buchungsbestätigung </h1>
        <form action="<?php echo DOCBASE . $pms_sys_pages['payment']['alias'];
                      ?>" method="POST">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Check in & out Datum:</label>
            <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo $date?>" aria-describedby="emailHelp" value="">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Gäste:</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="3">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Apartment Auswahl:</label>
            <select class="form-select form-control">
              <option selected></option>
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <label style="padding-bottom: 10px;">Verfügbare Aktivitäten</label>
                <div class="col-6">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Aktivität 1
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Aktivität 2
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Aktivität 3
                    </label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Aktivität 1
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Aktivität 2
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Aktivität 3
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <label for="floatingTextarea2" style="padding-bottom: 10px;">Nachricht an uns</label>
              <div class="form-floating">

                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-4 jetzt_button">JETZT BUCHEN</button>
        </form>
      </div>
    </div>
  </section>
  <section class="container pt-150">
    <h1 style="font-size: 30px; color: #023E8A; font-weight: 400; padding-bottom: 10px;">Verfügbare Apartments</h1>
    <?php
    $result_rooms_show = $pms_db->query('SELECT * FROM pm_room WHERE   id_hotel= ' . $hotel_id . '  limit 5');
    if ($result_rooms_show->execute() !== false && $pms_db->last_row_count() >= 0) {
        foreach ($result_rooms_show as $i => $row) {
            $Price = $row['price'];
            $descr = $row['descr'];
            $gest = (string)$row['max_people'];
            $descr = (string) $row['descr'];
            $Betten = (string)$row['Betten'];
            $room_ids = $row['id'];

    ?>
            <div class="row verfügbare_apartments">
                <div class="col-md-4 px-0">
                    <div class="bd-highlight first">
                        <?php

                        $result_room_file_show = $pms_db->query('SELECT * FROM pm_room_file WHERE id_item = ' . $room_ids . ' AND checked = 1 AND lang = ' . PMS_DEFAULT_LANG . ' AND type = \'image\' AND file != \'\' ORDER BY `rank` limit 1 ');
                        if ($result_room_file_show->execute() !== false && $pms_db->last_row_count() >= 0) {

                            foreach ($result_room_file_show as $i => $row) {

                                $file_id = $row['id_item'];
                                $filename = $row['file'];
                             //   $realpaths = '';

                                $page_imgs = pms_getUrl(true) . DOCBASE . 'medias/room/medium/' . $file_id . '/' . $filename;
                                $realpath =  DOCBASE . 'medias/room/small/' . $file_id . '/' . $filename;
                                  
                        ?>
                                <img class="w-100" src="<?php echo  $realpath ?>"  alt="Card image cap" />
                        <?php


                            }
                        } ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bd-highlight second ">
                        <div class="studio">
                            <p class="s_title" style="margin-bottom: 0;">1 BETT APARTMENT</p>
                            <p class="s_para">maximal <?php echo $Betten ?> Personen</p>
                        </div>
                        <div class="nacht">
                            <p style="color: #023e8a; margin-bottom: 0;"><?php echo $Price ?>.- / Nacht</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="bd-highlight third">
                        <p>
                            <?php   $stringCut = substr($descr, 0, 75); echo  $stringCut . ' ...' ?>
                        </p>
                       
                 <a href="#apartment_details"  data-bs-toggle="modal" class=" btn  text-decoration-none text-white">mehr Information en</a> 
                        
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

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
                      <h3>Login</h3>
                      <h4>Log dich jetzt ein.</h4>
                      <a href="#" class="btn px-0 w-100">
                        <div class="d-flex border border-dark border-radius-30 justify-content-center align-items-center py-3">
                          <img class="h-75 pe-3" src="<?php echo DOCBASE . 'templates/default/images/34_GoogleLogo.png' ?>" alt="">
                          <p class="mb-0">mit Google anmelden</p>
                        </div>
                      </a>
                      <div class="d-flex justify-content-center align-items-center mb-3 pt-5 pb-5">
                        <div class="w-75 ms-0" style="height: 0">
                          <div class="border-dark border-0 border-bottom" style="width: 75%"></div>
                        </div>
                        <div class="w-100">
                          <p class="mb-0 text-center w-100">Anmelden mit E-Mail</p>
                        </div>
                        <div class="w-75 ms-auto" style="height: 0">
                          <div class="border-dark border-0 border-bottom ms-auto" style="width: 75%"></div>
                        </div>
                      </div>

                      <form action="">
                        <div class="mb-3">
                          <label for="email" class="form-label">Email:</label>
                          <input type="email" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="email1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password:</label>
                          <input type="password" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3  " id="password1" aria-describedby="emailHelp">
                        </div>
                        <div class="d-flex justify-content-center">
                          <div class="mb-3 form-check w-100">
                            <input type="checkbox" class="form-check-input" style="border-radius: 0" id="check1">
                            <label class="form-check-label" for="check1">Check me out</label>
                          </div>
                          <a href="#" class="text-end w-100 text-decoration-none">Passwort
                            vergessen</a>
                        </div>
                        <button type="submit" class="btn bg_primary w-100 color_secondary border-radius-30 my-3 py-3">
                          Submit
                        </button>
                        <div class="d-flex">
                          <p class="mb-0 pe-2">Noch keinen Account? </p>
                          <a href="#tab-registrieren"> Erstelle jetzt deinen Account</a>
                        </div>
                      </form>

                    </div>
                  </div>
                  <div class="col-lg-6 pe-0 px-0-1199 d-none-992">
                    <img class="ps-5 px-0-1199" src="<?php echo DOCBASE . 'templates/default/images/33_LoginRegisrierten.png' ?>" alt="">
                  </div>
                </div>
              </div>
              <div id="tab-registrieren">
                <div class="row border-radius-80 bg_secondary">
                  <div class="col-lg-6 mt-5 px-4">
                    <div class="container">
                      <h3>Jetzt Registrieren</h3>
                      <h4>Entdecke jetzt Swiss Star</h4>

                      <form action="" class="pt-4">

                        <div class="mb-3">
                          <label for="username" class="form-label">Username:</label>
                          <input type="text" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="username" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">Email:</label>
                          <input type="email" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                          <label for="password" class="form-label">Password:</label>
                          <input type="password" class="form-control border border-dark border-radius-30 justify-content-center align-items-center px-4 py-3  " id="password" aria-describedby="emailHelp">
                        </div>
                        <div class="d-flex justify-content-center">
                          <div class="mb-3 form-check w-100">
                            <input type="checkbox" class="form-check-input" style="border-radius: 0" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Ich akzeptiere
                              die
                              AGB's</label>
                          </div>
                        </div>

                        <a href="#" class="btn px-0 w-100 mb-2">
                          <div class="d-flex border border-dark border-radius-30 justify-content-center align-items-center py-3">
                            <img class="h-75 pe-3" src="<?php echo DOCBASE . 'templates/default/images/34_GoogleLogo.png' ?>" alt="">
                            <p class="mb-0">mit Google anmelden</p>
                          </div>
                        </a>

                        <button type="submit" class="btn bg_primary w-100 color_secondary border-radius-30 mt-3 mb-3 py-3">
                          Submit
                        </button>
                        <div class="d-flex">
                          <p class="mb-0 pe-2">Noch keinen Account? </p>
                          <a href="#tab-login">Login</a>
                        </div>
                      </form>

                    </div>
                  </div>
                  <div class="col-lg-6 pe-0 px-0-1199 d-none-992">
                    <img class="ps-5 px-0-1199" src="<?php echo DOCBASE . 'templates/default/images/33_LoginRegisrierten.png' ?>" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="apartment_details" tabindex="-1" aria-labelledby="login" aria-hidden="true">

<div class="modal-dialog modal-fullscreen px-10-768">
    <div class="modal-content bg-transparent">
        <div class="container mt-5">
            <div class="w-100 d-flex justify-content-end pe-4 pb-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="row border-radius-80 bg_secondary">
                <div class="container" id="apa_details">
                    <div class="row apa">
                        <div class="col-md-4">
                            <?php
                                
                                $result_rooms_details = $pms_db->query('SELECT * FROM pm_room WHERE   id=7 limit 4');
                                if ($result_rooms_details->execute() !== false && $pms_db->last_row_count() >= 0) {
                                    foreach ($result_rooms_details as $i => $row) {
                                        $Price = $row['price'];
                                        $descr = $row['descr'];
                                        $facilities = $row['facilities'];
                                        $max_people = (string) $row['max_people'];
                                        $Betten = (string)$row['Betten'];
                                        $room_ids = $row['id'];
                                    }}
                            
                            $result_room_file_details = $pms_db->query('SELECT * FROM pm_room_file WHERE id_item = 7 AND checked = 1 AND lang = ' . PMS_DEFAULT_LANG . ' AND type = \'image\' AND file != \'\' ORDER BY `rank` limit 1 ');
                            if ($result_room_file_details->execute() !== false && $pms_db->last_row_count() >= 0) {

                                foreach ($result_room_file_details as $i => $row) {

                                    $file_id = $row['id_item'];
                                    $filename = $row['file'];
                                 
                                    $realpath_details =  DOCBASE . 'medias/room/small/' . $file_id . '/' . $filename;
                                     
                                   
                            ?>
                                                 <img class="w-100" src="<?php echo  $realpath_details ?>"  alt="Card image cap" />
                                  
                      <?php


                                }
                            } ?>
                            
                            <h3 class=" pt-4">2 BETTEN APARTMENT</h3>
                                    <p class="max_per">maximal <?php echo $max_people ?> Personen</p>
                           
                                    <h2><?php echo $Price ?> - / Nacht</h2>
                        </div>
                        <div class="col-md-8 ps-5 pe-5 ps-0 pe-0">
                            <div class="row ps-4 pe-4">
                                <div class="col-md-12 pb-100 pb-10 ">
                                    <p><?php echo $descr;  ?> </p>
                                </div>
                                <div class="col-12">
                                    <p style="font-size: 18px; font-weight:600; color: #5A5A5A;">Ausstattung</p>
                                </div>
                                <?php 
                                      $result_facilities = $pms_db->query('SELECT * FROM pm_facility WHERE   id in (' .$facilities . ')  limit 4');
                                      if ($result_facilities->execute() !== false && $pms_db->last_row_count() >= 0) {
                                          foreach ($result_facilities as $i => $row) {
                                              $name_fcilities=$row["name"];
                                ?>
                                <div class="col-sm-6 col-md-4">
                                    <p><?php echo $name_fcilities ?></p>
                             <!--        <p>Badezimmer</p>
                                    <p>Haartrockner</p>
                                    <p>TV</p>
                                    <p>Privates WC </p> -->
                                </div>
                                <?php

                                          }
                                        }
                                ?>
                                <!-- <div class="col-sm-6 col-md-4">
                                    <p>Küchenutensilien</p>
                                    <p>Mikrowelle</p>
                                    <p>Herd</p>
                                    <p>Kühlschrank</p>
                                    <p>Kostenloses WLAN</p>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <p>Nicht Raucher Zimmer</p>
                                    <p>Handtücher</p>
                                    <p>Dusche</p>
                                    <p>Doppelbett</p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="<?php echo DOCBASE ?>templates/default/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
  <script src="<?php echo DOCBASE ?>templates/default/wickedpicker/dist/wickedpicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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