<?php /*
if (!isset($_SESSION['book']) || count($_SESSION['book']) == 0) {
    header('Location: ' . DOCBASE . $pms_sys_pages['booking']['alias']);
    exit();
} else
    $_SESSION['book']['step'] = 'payment';

$msg_error = '';
$msg_success = '';
$field_notice = array();

$paypal_email = '';
if (PMS_ENABLE_MULTI_VENDORS == 1) {
    $result_hotel = $pms_db->query('SELECT paypal_email FROM pm_hotel WHERE id = ' . $_SESSION['book']['hotel_id']);
    if ($result_hotel !== false && $pms_db->last_row_count() > 0) {
        $row = $result_hotel->fetch();
        $paypal_email = $row['paypal_email'];
    }
}

$payment_arr = array_map('trim', explode(',', PMS_PAYMENT_TYPE));
if (PMS_ENABLE_MULTI_VENDORS == 1 && $paypal_email != '') {
    $payment_type = 'paypal';
    $handle = true;
} elseif (count($payment_arr) == 1) {
    $payment_type = PMS_PAYMENT_TYPE;
    $handle = true;
} elseif (isset($_POST['payment_type'])) {
    $payment_type = $_POST['payment_type'];
    $handle = true;
} else {
    $payment_type = PMS_PAYMENT_TYPE;
    $handle = false;
}

if (isset($_SESSION['book']['id'])) {
    $result_booking = $pms_db->query('SELECT * FROM pm_booking WHERE id = ' . $_SESSION['book']['id'] . ' AND status != 1 AND trans != \'\'');
    if ($result_booking !== false && $pms_db->last_row_count() > 0) {
        unset($_SESSION['book']);
        header('Location: ' . DOCBASE . $pms_sys_pages['booking']['alias']);
        exit();
    }
}

$total = $_SESSION['book']['total'];
$payed_amount = (PMS_ENABLE_DOWN_PAYMENT == 1 && $_SESSION['book']['down_payment'] > 0) ? $_SESSION['book']['down_payment'] : $total;

$users = '';
$result_owner = $pms_db->query('SELECT users FROM pm_hotel WHERE id = ' . $_SESSION['book']['hotel_id']);
if ($result_owner !== false && $pms_db->last_row_count() > 0) {
    $row = $result_owner->fetch();
    $users = $row['users'];
}
$hotel_owners = array();
$result_owner = $pms_db->query('SELECT * FROM pm_user WHERE id IN (' . $users . ')');
if ($result_owner !== false && $pms_db->last_row_count() > 0)
    $hotel_owners = $result_owner->fetchAll();

if ($handle) {
    if (!isset($_SESSION['book']['id']) || is_null($_SESSION['book']['id'])) {

        $data = array();
        $data['id'] = null;
        $data['id_user'] = $_SESSION['book']['id_user'];
        $data['firstname'] = $_SESSION['book']['firstname'];
        $data['lastname'] = $_SESSION['book']['lastname'];
        $data['email'] = $_SESSION['book']['email'];
        $data['company'] = $_SESSION['book']['company'];
        $data['address'] = $_SESSION['book']['address'];
        $data['postcode'] = $_SESSION['book']['postcode'];
        $data['city'] = $_SESSION['book']['city'];
        $data['phone'] = $_SESSION['book']['phone'];
        $data['mobile'] = $_SESSION['book']['mobile'];
        $data['country'] = $_SESSION['book']['country'];
        $data['comments'] = $_SESSION['book']['comments'];
        $data['id_hotel'] = $_SESSION['book']['hotel_id'];
        $data['from_date'] = $_SESSION['book']['from_date'];
        $data['to_date'] = $_SESSION['book']['to_date'];
        $data['nights'] = $_SESSION['book']['nights'];
        $data['adults'] = $_SESSION['book']['adults'];
        $data['children'] = $_SESSION['book']['children'];
        $data['amount'] = number_format($_SESSION['book']['amount_rooms'], 2, '.', '');
        $data['total'] = number_format($total, 2, '.', '');
        if ($payment_type != 'arrival') $data['down_payment'] = number_format($_SESSION['book']['down_payment'], 2, '.', '');
        $data['add_date'] = time();
        $data['edit_date'] = null;
        $data['status'] = 1;
        $data['discount'] = number_format($_SESSION['book']['discount_amount'], 2, ".", "");
        $data['payment_option'] = $payment_type;
        $data['id_coupon'] = (isset($_SESSION['book']['id_coupon'])) ? $_SESSION['book']['id_coupon'] : null;
        $data['users'] = $users;

        $tax_amount = $_SESSION['book']['tax_rooms_amount'] + $_SESSION['book']['tax_activities_amount'] + $_SESSION['book']['tax_services_amount'];
        $data['tax_amount'] = number_format($tax_amount, 2, '.', '');
        $data['ex_tax'] = number_format($total - $tax_amount, 2, '.', '');

        $result_booking = pms_db_prepareInsert($pms_db, 'pm_booking', $data);
        if ($result_booking->execute() !== false) {

            $_SESSION['book']['id'] = $pms_db->lastInsertId();

            if (isset($_SESSION['book']['sessid']))
                $pms_db->query('DELETE FROM pm_room_lock WHERE sessid = ' . $pms_db->quote($_SESSION['book']['sessid']));

            if (isset($_SESSION['book']['rooms']) && count($_SESSION['book']['rooms']) > 0) {
                foreach ($_SESSION['book']['rooms'] as $id_room => $rooms) {
                    foreach ($rooms as $index => $room) {
                        $data = array();
                        $data['id'] = null;
                        $data['id_booking'] = $_SESSION['book']['id'];
                        $data['id_room'] = $id_room;
                        $data['id_hotel'] = $_SESSION['book']['hotel_id'];
                        $data['title'] = $_SESSION['book']['hotel'] . ' - ' . $room['title'];
                        $data['adults'] = $room['adults'];
                        $data['children'] = $room['children'];
                        $data['amount'] = number_format($room['amount'], 2, '.', '');
                        if (isset($room['duty_free'])) $data['ex_tax'] = number_format($room['duty_free'], 2, '.', '');
                        if (isset($room['tax_rate'])) $data['tax_rate'] = $room['tax_rate'];

                        $result = pms_db_prepareInsert($pms_db, 'pm_booking_room', $data);
                        $result->execute();
                    }
                }
            }
            if (isset($_SESSION['book']['activities']) && count($_SESSION['book']['activities']) > 0) {
                foreach ($_SESSION['book']['activities'] as $id_activity => $activity) {
                    $data = array();
                    $data['id'] = null;
                    $data['id_booking'] = $_SESSION['book']['id'];
                    $data['id_activity'] = $id_activity;
                    $data['title'] = $activity['title'];
                    $data['adults'] = $activity['adults'];
                    $data['children'] = $activity['children'];
                    $data['duration'] = $activity['duration'];
                    $data['amount'] = number_format($activity['amount'], 2, '.', '');
                    $data['date'] = $activity['session_date'];
                    if (isset($activity['duty_free'])) $data['ex_tax'] = number_format($activity['duty_free'], 2, '.', '');
                    if (isset($activity['tax_rate'])) $data['tax_rate'] = $activity['tax_rate'];

                    $result = pms_db_prepareInsert($pms_db, 'pm_booking_activity', $data);
                    $result->execute();
                }
            }
            if (isset($_SESSION['book']['extra_services']) && count($_SESSION['book']['extra_services']) > 0) {
                foreach ($_SESSION['book']['extra_services'] as $id_service => $service) {
                    $data = array();
                    $data['id'] = null;
                    $data['id_booking'] = $_SESSION['book']['id'];
                    $data['id_service'] = $id_service;
                    $data['title'] = $service['title'];
                    $data['qty'] = $service['qty'];
                    $data['amount'] = number_format($service['amount'], 2, '.', '');
                    if (isset($service['duty_free'])) $data['ex_tax'] = number_format($service['duty_free'], 2, '.', '');
                    if (isset($service['tax_rate'])) $data['tax_rate'] = $service['tax_rate'];

                    $result = pms_db_prepareInsert($pms_db, 'pm_booking_service', $data);
                    $result->execute();
                }
            }
            if (isset($_SESSION['book']['taxes']) && count($_SESSION['book']['taxes']) > 0) {
                $tax_id = 0;
                $result_tax = $pms_db->prepare('SELECT * FROM pm_tax WHERE id = :tax_id AND checked = 1 AND value > 0 AND lang = ' . PMS_LANG_ID . ' ORDER BY `rank`');
                $result_tax->bindParam(':tax_id', $tax_id);
                foreach ($_SESSION['book']['taxes'] as $tax_id => $taxes) {
                    $tax_amount = 0;
                    foreach ($taxes as $amount) $tax_amount += $amount;
                    if ($tax_amount > 0) {
                        if ($result_tax->execute() !== false && $pms_db->last_row_count() > 0) {
                            $row = $result_tax->fetch();
                            $data = array();
                            $data['id'] = null;
                            $data['id_booking'] = $_SESSION['book']['id'];
                            $data['id_tax'] = $tax_id;
                            $data['name'] = $row['name'];
                            $data['amount'] = number_format($tax_amount, 2, '.', '');

                            $result = pms_db_prepareInsert($pms_db, 'pm_booking_tax', $data);
                            $result->execute();
                        }
                    }
                }
            }
            $_SESSION['tmp_book'] = $_SESSION['book'];
        }
    }

    if (isset($_SESSION['book']['id']) && $_SESSION['book']['id'] > 0) {
        $data = array();
        $data['id'] = $_SESSION['book']['id'];
        $data['payment_option'] = $payment_type;

        $result_booking = pms_db_prepareUpdate($pms_db, 'pm_booking', $data);
        $result_booking->execute();
    }

    if ($payment_type == 'check' || $payment_type == 'arrival') {

        $room_content = '';
        if (isset($_SESSION['book']['rooms']) && count($_SESSION['book']['rooms']) > 0) {
            foreach ($_SESSION['book']['rooms'] as $id_room => $rooms) {
                foreach ($rooms as $index => $room) {
                    $room_content .= '<p><b>' . $_SESSION['book']['hotel'] . ' - ' . $room['title'] . '</b><br>
                    ' . ($room['adults'] + $room['children']) . ' ' . pms_getAltText($pms_texts['PERSON'], $pms_texts['PERSONS'], ($room['adults'] + $room['children'])) . ': ';
                    if ($room['adults'] > 0) $room_content .= $room['adults'] . ' ' . pms_getAltText($pms_texts['ADULT'], $pms_texts['ADULTS'], $room['adults']) . ' ';
                    if ($room['children'] > 0) {
                        $room_content .= $room['children'] . ' ' . pms_getAltText($pms_texts['CHILD'], $pms_texts['CHILDREN'], $room['children']) . ' ';
                        if (isset($room['child_age'])) {
                            $room_content .= '(' . implode(' ' . $pms_texts['YO'] . ', ', $room['child_age']) . ' ' . $pms_texts['YO'] . ')';
                        }
                    }
                    $room_content .= '<br>' . $pms_texts['PRICE'] . ' : ' . pms_formatPrice($room['amount'] * PMS_CURRENCY_RATE) . '</p>';
                }
            }
        }

        $service_content = '';
        if (isset($_SESSION['book']['extra_services']) && count($_SESSION['book']['extra_services']) > 0) {
            foreach ($_SESSION['book']['extra_services'] as $id_service => $service)
                $service_content .= $service['title'] . ' x ' . $service['qty'] . ' : ' . pms_formatPrice($service['amount'] * PMS_CURRENCY_RATE) . ' ' . $pms_texts['INCL_VAT'] . '<br>';
        }

        $activity_content = '';
        if (isset($_SESSION['book']['activities']) && count($_SESSION['book']['activities']) > 0) {
            foreach ($_SESSION['book']['activities'] as $id_activity => $activity) {
                $activity_content .= '<p><b>' . $activity['title'] . '</b> - ' . $activity['duration'] . ' - ' . gmstrftime(PMS_DATE_FORMAT . ' ' . PMS_TIME_FORMAT, $activity['session_date']) . '<br>
                ' . ($activity['adults'] + $activity['children']) . ' ' . pms_getAltText($pms_texts['PERSON'], $pms_texts['PERSONS'], ($activity['adults'] + $activity['children'])) . ': ';
                if ($activity['adults'] > 0) $activity_content .= $activity['adults'] . ' ' . pms_getAltText($pms_texts['ADULT'], $pms_texts['ADULTS'], $activity['adults']) . ' ';
                if ($activity['children'] > 0) $activity_content .= $activity['children'] . ' ' . pms_getAltText($pms_texts['CHILD'], $pms_texts['CHILDREN'], $activity['children']) . ' ';
                $activity_content .= $pms_texts['PRICE'] . ' : ' . pms_formatPrice($activity['amount'] * PMS_CURRENCY_RATE) . '</p>';
            }
        }

        $tax_id = 0;
        $tax_content = '';
        $result_tax = $pms_db->prepare('SELECT * FROM pm_tax WHERE id = :tax_id AND checked = 1 AND value > 0 AND lang = ' . PMS_LANG_ID . ' ORDER BY `rank`');
        $result_tax->bindParam(':tax_id', $tax_id);
        foreach ($_SESSION['book']['taxes'] as $tax_id => $taxes) {
            $tax_amount = 0;
            foreach ($taxes as $amount) $tax_amount += $amount;
            if ($tax_amount > 0) {
                if ($result_tax->execute() !== false && $pms_db->last_row_count() > 0) {
                    $row = $result_tax->fetch();
                    $tax_content .= $row['name'] . ': ' . pms_formatPrice($tax_amount * PMS_CURRENCY_RATE) . '<br>';
                }
            }
        }

        $payment_notice = '';
        if ($payment_type == 'check') $payment_notice .= str_replace('{amount}', '<b>' . pms_formatPrice($payed_amount * PMS_CURRENCY_RATE) . ' ' . $pms_texts['INCL_VAT'] . '</b>', $pms_texts['PAYMENT_CHECK_NOTICE']);
        if ($payment_type == 'arrival') $payment_notice .= str_replace('{amount}', '<b>' . pms_formatPrice($total) . ' ' . $pms_texts['INCL_VAT'] . '</b>', $pms_texts['PAYMENT_ARRIVAL_NOTICE']);

        $mail = pms_getMail($pms_db, 'BOOKING_CONFIRMATION', array(
            '{firstname}' => $_SESSION['book']['firstname'],
            '{lastname}' => $_SESSION['book']['lastname'],
            '{company}' => $_SESSION['book']['company'],
            '{address}' => $_SESSION['book']['address'],
            '{postcode}' => $_SESSION['book']['postcode'],
            '{city}' => $_SESSION['book']['city'],
            '{country}' => $_SESSION['book']['country'],
            '{phone}' => $_SESSION['book']['phone'],
            '{mobile}' => $_SESSION['book']['mobile'],
            '{email}' => $_SESSION['book']['email'],
            '{Check_in}' => isset($_SESSION['book']['from_date']) ? gmstrftime(PMS_DATE_FORMAT, $_SESSION['book']['from_date']) : '-',
            '{Check_out}' => isset($_SESSION['book']['from_date']) ? gmstrftime(PMS_DATE_FORMAT, $_SESSION['book']['to_date']) : '-',
            '{num_nights}' => isset($_SESSION['book']['nights']) ? $_SESSION['book']['nights'] : '-',
            '{num_guests}' => (isset($_SESSION['book']['adults']) || isset($_SESSION['book']['children'])) ? ($_SESSION['book']['adults'] + $_SESSION['book']['children']) : '-',
            '{num_adults}' => isset($_SESSION['book']['adults']) ? $_SESSION['book']['adults'] : '-',
            '{num_children}' => isset($_SESSION['book']['children']) ? $_SESSION['book']['children'] : '-',
            '{rooms}' => $room_content,
            '{extra_services}' => $service_content,
            '{activities}' => $activity_content,
            '{comments}' => nl2br($_SESSION['book']['comments']),
            '{discount}' => '- ' . pms_formatPrice($_SESSION['book']['discount_amount'] * PMS_CURRENCY_RATE),
            '{taxes}' => $tax_content,
            '{down_payment}' => pms_formatPrice($_SESSION['book']['down_payment'] * PMS_CURRENCY_RATE),
            '{total}' => pms_formatPrice($total * PMS_CURRENCY_RATE),
            '{payment_notice}' => $payment_notice
        ));

        if ($mail !== false) {
            foreach ($hotel_owners as $owner) {
                if ($owner['email'] != PMS_EMAIL)
                    pms_sendMail($owner['email'], $owner['firstname'], $mail['subject'], $mail['content'], $_SESSION['book']['email'], $_SESSION['book']['firstname'] . ' ' . $_SESSION['book']['lastname']);
            }
            pms_sendMail(PMS_EMAIL, PMS_OWNER, $mail['subject'], $mail['content'], $_SESSION['book']['email'], $_SESSION['book']['firstname'] . ' ' . $_SESSION['book']['lastname']);
            pms_sendMail($_SESSION['book']['email'], $_SESSION['book']['firstname'] . ' ' . $_SESSION['book']['lastname'], $mail['subject'], $mail['content']);
        }
        unset($_SESSION['book']);
    }
}
 
 ==============================================
 * CSS AND JAVASCRIPT USED IN THIS MODEL
 * ==============================================
 
if ($payment_type == 'cards')
    $pms_javascripts[] = 'https://www.2checkout.com/static/checkout/javascript/direct.min.js';
    */
require(pms_getFromTemplate('common/start_site_header.php', false)); ?>
</div>
</header>
<section id="zahlungsinformationen">
    <div class="container mt-5">
        <div class="pt-4">
            <h3 class="h3">Zahlungsinformationen</h3>
            <div class="checkout my-5 py-5 p-md-5">
                <div class="mx-md-5 px-md-5">
                    <div class="icons d-flex flex-wrap justify-content-between align-items-center">
                        <a href="">
                            <div class="icon d-flex align-items-center px-3">
                                <img src="img/26_checkout.png" alt="">
                            </div>
                        </a>
                        <a href="">
                            <div class="icon  d-flex align-items-center px-3">
                                <img src="img/27_checkout.png" alt="">
                            </div>
                            <div class="active"></div>
                        </a>
                        <a href="">
                            <div class="icon d-flex align-items-center px-3">
                                <img src="img/28_checkout.png" alt="">
                            </div>
                        </a>
                        <a href="">
                            <div class="icon d-flex align-items-center px-3">
                                <img src="img/29_checkout.png" alt="">
                            </div>
                        </a>
                        <a href="">
                            <div class="icon d-flex align-items-center px-3">
                                <img src="img/30_checkout.png" alt="">
                            </div>
                        </a>
                        <a href="">
                            <div class="icon d-flex align-items-center px-3">
                                <img src="img/31_checkout.png" alt="">
                            </div>
                        </a>
                        <a href="">
                            <div class="icon d-flex align-items-center px-3">
                                <img src="img/32_checkout.png" alt="">
                            </div>
                        </a>
                    </div>

                    <div class="row mt-4 ">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="karten_nr" class="col-lg-4 col-form-label">Karten Nr.</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="karten_nr">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="inhaber" class="col-lg-4 col-form-label">Inhaber:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="inhaber">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="ablaufdatum" class="col-lg-4 col-form-label">Ablaufdatum:</label>
                                <div class="col-lg-4 m-b-20">
                                    <input type="text" class="form-control " id="ablaufdatum">
                                </div>
                                <div class="col-lg-4 ms-lg-auto ">
                                    <input type="text" class="form-control " id="ablaufdatum1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label for="cvc" class="col-lg-4 col-form-label">CVC:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="cvc">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <p class="form-check-label mt-1" for="flexCheckDefault">
                                Zahlungsinformationen Speichern?
                            </p>
                        </div>
                    </div>

                    <div class="border-box-1 border-radius-30 p-4 mt-5">
                        <div class="bg_ p-4 pb-1">
                            <div class="d-md-flex justify-content-between">
                                <p>Subtotal (15.04.2022 - 25.10.2022)</p>
                                <p>CHF 1'220.50.-</p>
                            </div>

                            <div class="d-md-flex justify-content-between">
                                <p class="">Rabatt</p>
                                <p class="">CHF 100.00.-</p>
                            </div>

                        </div>

                        <div class="bg_ p-4 pb-1 mt-2">
                            <div class="d-md-flex justify-content-between">
                                <p>Total Betrag</p>
                                <p>CHF 1'120.50.-</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-5">
                        <button class="btn " type="button">JETZT BEZAHLEN</button>
                    </div>

                </div>
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
                                        <h3>Login</h3>
                                        <h4>Log dich jetzt ein.</h4>
                                        <a href="#" class="btn px-0 w-100">
                                            <div class="d-flex border border-dark border-radius-30 justify-content-center align-items-center py-3">
                                                <img class="h-75 pe-3" src="img/34_GoogleLogo.png" alt="">
                                                <p class="mb-0">mit Google anmelden</p>
                                            </div>
                                        </a>
                                        <div class="d-flex justify-content-center align-items-center mb-3 pt-5 pb-5">
                                            <div class="w-75 ms-0" style="height: 0">
                                                <div class="border-dark border-0 border-bottom" style="width: 75%">
                                                </div>
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
                                                    <label class="form-check-label" for="check1">Check me
                                                        out</label>
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
                                    <img class="ps-5 px-0-1199" src="img/33_LoginRegisrierten.png" alt="">
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
                                                    <label class="form-check-label" for="exampleCheck1">Ich
                                                        akzeptiere
                                                        die
                                                        AGB's</label>
                                                </div>
                                            </div>

                                            <a href="#" class="btn px-0 w-100 mb-2">
                                                <div class="d-flex border border-dark border-radius-30 justify-content-center align-items-center py-3">
                                                    <img class="h-75 pe-3" src="img/34_GoogleLogo.png" alt="">
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="<?php echo DOCBASE ?>templates/default/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="<?php echo DOCBASE ?>templates/default/wickedpicker/dist/wickedpicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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