<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Swiss Star</title>


  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
  <?php /*
    if (PMS_RTL_DIR) { ?>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <?php
    } */ ?>

  <link rel="shortcut icon" type="image/png" href="<?php echo DOCBASE ?>templates/default/images/17_SwissStar.png" alt="logo" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" />
  <link rel="stylesheet" href="<?php echo pms_getFromTemplate("css/style.css"); ?>">

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


  <style>
    <?php include 'templates/default/models/wickedpicker/dist/wickedpicker.min.css';
    include 'templates/default/models/bootstrap/css/bootstrap.min.css';
    include 'templates/default/models/bootstrap/css/bootstrap.min_2.css';
    include 'templates/default/models/css/style.css'; ?>
  </style>

</head>

<style>
  select::-ms-expand {
    display: none;
  }

  #swiss_star_tower .navbar .container-fluid {
    border-bottom: 2px solid #D8D8D8;
    padding: 0 !important;
    margin-bottom: 20px
  }

  .ui-spinner a.ui-spinner-button {
    display: none;
  }

  .form-control:focus,
  button:focus,
  .ui-widget input:focus,
  .ui-widget input:active,
  .ui-widget input:active {
    outline: none;
    border: 0 !important;
    box-shadow: none !important;
  }

  #swiss_star_tower .form-control {
    font-size: 16px !important;
    padding: .375rem;
  }

  #cal_apartments .daterangepicker .calendar-table .prev {
    background-image: url(img/Arrow\ 2.png);
    background-repeat: no-repeat;
    position: absolute;
    top: 15px;
  }

  #cal_apartments .daterangepicker .calendar-table .next {
    background-image: url(img/Arrow\ 1.png);
    background-repeat: no-repeat;
    position: absolute;
    top: 10px;
    right: 20px;
  }

  @media only screen and (max-width: 576px) {
    #cal_apartments .daterangepicker {
      left: 12px !important;
      width: auto;
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