<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Swiss Star</title>
  <link rel="shortcut icon" type="image/png" href="img/17_SwissStar.png" alt="logo" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css" />

  <link rel="stylesheet" href="wickedpicker/dist/wickedpicker.min.css" />

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
</head>

<style>
  sub,
  sup {
    font-size: 7px;
  }

  sup {
    top: -8px;
    right: 3px;
  }

  .form-control:focus,
  button:focus {
    outline: none !important;
    box-shadow: none;
  }

  .ui-datepicker select.ui-datepicker-month,
  .ui-datepicker select.ui-datepicker-year {
    width: 30%;
    border: none;
    background: #f9f9f9;
    color: #292929;
    font-weight: 600;
    cursor: pointer;
    margin-left: -30px;
  }

  .ui-datepicker select.ui-datepicker-month:focus,
  .ui-datepicker select.ui-datepicker-year:focus {
    outline: none !important;
    box-shadow: none;
  }

  select::-ms-expand {
    display: none;
  }

  select {
    -webkit-appearance: none;
    appearance: none;
  }
</style>

<body>
  <section id="section_first">
    <div class="content">
      <img src="img/01_Swiss-Star-Background-Home.png" alt="" />
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container-fluid mt-4">
            <a class="navbar-brand" href="index.html">
              <h3>SWISS STAR</h3>
              <p>WELCOME HOME</p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav w-100">
                <li class="nav-item ms-lg-auto">
                  <a class="nav-link" href="apartments.html">Apartments</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Über uns</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link">Kontakt</a>
                </li>

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