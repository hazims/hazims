

<?php

$API_KEY = "-uHcGi5QfwL0ITcHJmy21_MwEzTKV3CwHXD72Bl7tI-TSBIqGD4IS9hMnHk00WwntumHwcSQe1-jdPHAP2QrJFHvGwGDLuxt6ahOH996kDwps8LsHITngkzG__tZYnYx";

// Complain if credentials haven't been filled out.
//assert($API_KEY, "Please supply your API key.");

// API constants, you shouldn't have to change these.
$API_HOST = "https://api.yelp.com";
$SEARCH_PATH = "/v3/businesses/search";
$BUSINESS_PATH = "/v3/businesses/";  // Business ID will come after slash.

// Defaults for our simple example.
$DEFAULT_TERM = "dinner";
$DEFAULT_LOCATION = "San Francisco, CA";
$SEARCH_LIMIT = 4;
$LATITUDE = 47.414040;
$LONGITUDE = 8.546990;
$CATEGORIES = "hospitals";


function request($host, $path, $url_params = array())
{
  // Send Yelp API Call
  try {
    $curl = curl_init();
    if (FALSE === $curl)
      throw new Exception('Failed to initialize');

    $url = $host . $path . "?" . http_build_query($url_params);
    // var_dump($url);
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,  // Capture response.
      CURLOPT_ENCODING => "",  // Accept gzip/deflate/whatever.
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer " . $GLOBALS['API_KEY'],
        "cache-control: no-cache",
      ),
    ));

    $response = curl_exec($curl);

    if (FALSE === $response)
      throw new Exception(curl_error($curl), curl_errno($curl));
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if (200 != $http_status)
      throw new Exception($response, $http_status);

    curl_close($curl);
  } catch (Exception $e) {
    trigger_error(
      sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(),
        $e->getMessage()
      ),
      E_USER_ERROR
    );
  }

  return $response;
}


function search($category)
{
  $url_params = array();

  //$url_params['term'] = $term;
  //$url_params['location'] = $location;
  $url_params['latitude'] = $GLOBALS['LATITUDE'];
  $url_params['longitude'] = $GLOBALS['LONGITUDE'];
  $url_params['categories'] = $category;
  $url_params['limit'] = $GLOBALS['SEARCH_LIMIT'];

  return request($GLOBALS['API_HOST'], $GLOBALS['SEARCH_PATH'], $url_params);
}

function get_business($business_id)
{
  $business_path = $GLOBALS['BUSINESS_PATH'] . urlencode($business_id);

  return request($GLOBALS['API_HOST'], $business_path);
}

function query_api($category)
{
  $response = json_decode(search($category));
  $business_id = $response->businesses[0]->id;

  // print sprintf(
  //   "%d businesses found, querying business info for the top result \"%s\"\n\n",
  //   count($response->businesses),
  //   $business_id
  // );
  // $firstBusiness = json_encode($response);

  // $response = get_business($business_id);

  return $response;

  // print sprintf("Result for business \"%s\" found:\n", $business_id);
  // $pretty_response = json_encode(json_decode($response), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
  // print "$pretty_response\n";
}
/**
 * User input is handled here 
 */
$longopts  = array(
  "term::",
  "latitude::",
  "longitude::",
);

$options = getopt("", $longopts);

$term = $GLOBALS['DEFAULT_TERM'];
$latitude = $GLOBALS['LATITUDE'];
$longitude = $GLOBALS['LONGITUDE'];

query_api($term, $GLOBALS['DEFAULT_LOCATION']);

function getStars($rating)
{
  $rating = round($rating * 2) / 2;
  // Append all the filled whole stars
  for ($i = $rating; $i >= 1; $i--)
    echo '<i class="fa fa-star" aria-hidden="true"></i>&nbsp;';

  // If there is a half a star, append it
  if ($i == .5) echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>&nbsp;';

  // Fill the empty stars
  for ($i = (5 - $rating); $i >= 1; $i--)
    echo '<i class="fa fa-star-o" aria-hidden="true"></i>&nbsp;';
}
?>
<?php
require(pms_getFromTemplate('common/start_site_header.php', false));
if ($article_alias == '') pms_err404();

$room_id = $_POST["room_id"];

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

$result = $pms_db->query('SELECT * FROM pm_hotel WHERE checked = 1 and id=' . $hotel_id . ' AND lang = ' . PMS_LANG_ID . ' AND alias = ' . $pms_db->quote($article_alias));
if ($result !== false && $pms_db->last_row_count() == 1) {

    $hotel = $result->fetch(PDO::FETCH_ASSOC);

    $hotel_id = $hotel['id'];
    $pms_article_id = $hotel_id;
    $title_tag = $hotel['title'] . ' - ' .  $row['subtitle'];;
    $page_title = $hotel['title'];
    $address = $hotel['address'];
    $lat = $hotel["lat"];
    $langt = $hotel["lang"];
    $page_subtitle = '';
    $page_alias = $pms_pages[$pms_page_id]['alias'] . '/' . pms_text_format($hotel['alias']);

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
} else pms_err404();

pms_check_URI(DOCBASE . $page_alias);
?>
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
</div>
</header>
<section id="swiss_star_tower" class="mt-150">
    <div class="container">
        <h1 class="swiss_title"><?php echo $title_tag ?></h1>
        <p class="swiss_para">
            <i class="fa fa-map-marker" aria-hidden="true"></i><?php echo $address ?>
        </p>
    </div>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid" id="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-0 ms-0">
                        <li class="nav-item ps-0 ms-0">
                            <a class="nav-link active ps-2 pe-3" aria-current="page" href="#">Details</a>
                            <div class="active-details w-100"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active px-3" aria-current="page" href="#lokation">Lokation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active px-3" href="#bewertungen">Bewertungen</a>
                        </li>
                    </ul>
                    <span class="navbar-text" style="color: #D8D8D8;">
                        <!-- <i class="fa fa-heart" aria-hidden="true"></i> -->
                        <img src="img/Pfad 12.png" style="cursor:pointer; width: 27px;" class="heart" id="imazhi" onclick="ndryshoImazhin()">
                        Zu Favoriten hinzufügen
                    </span>
                </div>
            </div>
        </nav>
    </div>
    <div>
        <div class="responsive1">
            <?php

            $result_room_file = $pms_db->query('SELECT * FROM pm_room_file WHERE id_item = ' . $room_id . ' AND checked = 1 AND lang = ' . PMS_DEFAULT_LANG . ' AND type = \'image\' AND file != \'\' ORDER BY `rank` ');
            if ($result_room_file->execute() !== false && $pms_db->last_row_count() >= 0) {

                foreach ($result_room_file as $i => $row) {

                    $file_id = $row['id_item'];
                    $filename = $row['file'];
                    $realpath = '';

                    $page_img = pms_getUrl(true) . DOCBASE . 'medias/room/medium/' . $file_id . '/' . $filename;
                    $realpath =  DOCBASE . 'medias/room/small/' . $file_id . '/' . $filename;
                    if ($realpath != null) {
            ?>
                        <div class="mx-4 h-100">
                            <img class="card-img-top" src="<?php echo  $realpath; ?>" alt="Card image cap" />
                        </div>
            <?php
                    }
                }
            }

            ?>
        </div>

    </div>
    </div>
    <div class="container pt-100" id="details">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-start">
                        <div>
                            <p><span><img src="<?php echo DOCBASE . 'templates/default/images/06_m2.png' ?>" alt=""> Fläche:
                                    <?php echo $Flache ?>
                                    m<sup>2</sup></p>
                            <p>
                                <span><i class="fa fa-wifi" aria-hidden="true"></i>WLAN: <?php echo $WLAN ?></span>
                            </p>
                            <p>
                                <span><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Check-in: Nach
                                    <?php echo $Checkin ?> Uhr</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center justify-content-md-end">
                        <div class="">
                            <p>
                                <span><i class="fa fa-bed" aria-hidden="true"></i>Betten:<?php echo  $Betten ?></span>
                            </p>
                            <p>
                                <span><i class="fa fa-users" aria-hidden="true"></i> Gäste: max <?php echo  $gest ?></span>
                            </p>
                            <p>
                                <span><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>Check-out: Vor
                                    <?php echo $Checkout ?> Uhr</span>
                            </p>
                        </div>
                    </div>
                </div>
                <hr />
                <div>
                    <p class="permbajtja" style="margin-top:40px">
                        <?php echo $descr ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4 px-0-1199 px-10-576-i ">
                <div class="d-flex price justify-content-between prices">
                    <p style="margin: auto 0; font-size: 25px;">ab <?php echo $Price ?> CHF</p>
                    <div class="star">
                        <div class="star-1">
                            <i class="fa fa-star" aria-hidden="true" style="    color: #F1BD6C;
                    "></i>
                        </div>
                        <div>
                            <p class="p1"> <?php echo  $rate ?> </p>
                            <p class="p2">(<?php echo $count_rating ?>)</p>

                        </div>
                    </div>
                </div>

                <div class="form">
                    <form action="<?php echo DOCBASE . $pms_sys_pages['booking']['alias'] ?>" method="POST">
                        <label for="exampleFormControlInput1" class="form-label">Check-in & out</label>
                        <div class="calendar d-flex">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <input class="form-control" name="datefilter" id="check_in" aria-describedby="telephoneHelpId" autocomplete="off">
                        </div>
                        <label for="exampleFormControlInput1" class="form-label">Anzahl der Gäste</label>
                        <div class="calendar d-flex">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <input class="form-control text-decoration-none table-hover" autocomplete="off" data-bs-toggle="collapse" href="#anzahl_personen" role="button" id="txt_anzahl_personen" aria-expanded="false" aria-controls="anzahl_personen" readonly />
                            <div class="collapse" id="anzahl_personen">
                                <div class="card card-body position-absolute" id="card_test">
                                    <div class="d-flex">
                                        <input type="text" readonly id="spinner-1" value="0">
                                        <div class="d-flex bbtn ms-4" style="padding-top: 5px; height: 40px; padding-bottom: 5px; background-color: #FFFFFF;">
                                            <a role="button" class="py-0 my-0 px-3 d-flex align-items-center py-0"><img id="stepDown-1" src="img/Pfad 82.png " style="padding-right: 0;" alt="remove"></a>
                                            <a role="button" class="py-0 my-0 px-3 d-flex align-items-center py-0"><img id="stepUp-1" src="img/Pfad 81.png " style="padding-right: 0;" alt="add"></a>
                                        </div>
                                    </div>
                                    <p>Wie viele Erwachsene?</p>

                                    <div class="hr mb-4"></div>

                                    <div class="d-flex">
                                        <input type="text" readonly id="spinner-2" value="0">
                                        <div class="d-flex bbtn ms-4" style="padding-top: 5px; height: 40px; padding-bottom: 5px; background-color: #FFFFFF;">
                                            <a role="button" class="py-0 my-0 px-3 d-flex align-items-center py-0"><img id="stepDown-2" src="img/Pfad 82.png " style="padding-right: 0;" alt="remove"></a>
                                            <a role="button" class="py-0 my-0 px-3 d-flex align-items-center py-0"><img id="stepUp-2" src="img/Pfad 81.png " style="padding-right: 0;" alt="add"></a>
                                        </div>
                                    </div>
                                    <p>Wie viele Kinder?</p>

                                </div>
                            </div>
                        </div>
                        <a href="#" class="text-decoration-none text-white">
                            <button class="btn btn-primary" type="submit">Buche
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </button>
                        </a>
                    </form>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-12">
                <div class="d-grid gap-3 d-md-block buttons">
                    <button class="btn btn-primary" type="button">STADTNÄH</button>
                    <button class="btn btn-primary" type="button">RUHIGE</button>
                    <button class="btn btn-primary" type="button">KINDERFREUNDLI</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container pt-150">
    <h1 style="font-size: 30px; color: #023E8A; font-weight: 400; padding-bottom: 10px;">Verfügbare Apartments</h1>
    <?php
    $result_rooms_show = $pms_db->query('SELECT * FROM pm_room WHERE   id_hotel= ' . $hotel_id . '  limit 4');
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
                                $realpaths = '';

                                $page_imgs = pms_getUrl(true) . DOCBASE . 'medias/room/medium/' . $file_id . '/' . $filename;
                                $realpaths =  DOCBASE . 'medias/room/small/' . $file_id . '/' . $filename;

                        ?>
                                <img class="w-100" src="<?php echo  $realpaths; ?>" />
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
                            <?php echo $descr ?>
                        </p>
                       
                 <a href="#apartment_details" data-bs-toggle="modal" class=" btn  text-decoration-none text-white">mehr Information en</a> 
                        
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

    </div>
</section>
<section class="container pt-100" id="lokation">
    <h1 style="font-size: 30px; font-weight: 400; color: #023e8a;">Lokation</h1>
    <div class="lokation">
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe class="w-100 h-100" id="gmap_canvas" src="https://www.google.com/maps/search/?api=1&query= <?php echo $lat ?>,<?php echo  $langt ?> " frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                </iframe>
                <a href="https://fmovies-online.net"></a><br>
                <style>
                    .mapouter {
                        position: relative;
                        text-align: right;
                        height: 100%;
                        width: 100%;
                    }
                </style>
                <a href="https://www.embedgooglemap.net">google map on web page</a>
                <style>
                    .gmap_canvas {
                        overflow: hidden;
                        background: none !important;
                        height: 100%;
                        width: 100%;
                    }
                </style>
            </div>
        </div>

    </div>
</section>
<section class="container pt-150" id="in_der_nahe">
    <div class="row">
        <div class="col-md-2">
            <h1 style="font-size: 20px; color: #023e8a">In der Nähe</h1>
        </div>
        <br/>
        <div class="col-md-10">
      
        <div class="restaurants">
      
                <p style="margin-bottom: 20px">
                <img src="<?php echo DOCBASE . 'templates/default/images/22_fad79.png ' ?>" alt="">
                    Spital / Arzt
                </p>
                
        <?php $results1 = query_api("hospitals");
      foreach ($results1->businesses as $key) : ?>
                <div class="reviews d-flex justify-content-between">
                    <div class="res_name">
                        <p>><?= $key->name ?></span></p>
                    </div>
                    <div class="stars">
                    <?= getStars($key->rating);
                         ?>
                           <span><?= $key->rating ?></span>
                    </div>
                  
                </div>
                <?php endforeach; ?>
              
            </div>
    
        <div class="restaurants">
      
                <p style="margin-bottom: 20px">
                      <img src="<?php echo DOCBASE . 'templates/default/images/21_fad77.png ' ?>" alt="">
                    Restauirants
                </p>
          
            
            <?php $results1 = query_api("restaurants");
          foreach ($results1->businesses as $key) : ?>
                <div class="reviews d-flex justify-content-between">
                    <div class="res_name">
                        <p>><?= $key->name ?></span></p>
                    </div>
                    <div class="stars">
                    <?= getStars($key->rating);
                         ?>
                           <span><?= $key->rating ?></span>
                    </div>
                  
                </div>
                
                <?php endforeach; ?>
            </div>
          
        
       
       
        <div class="restaurants">
      
                <p style="margin-bottom: 20px">
                <img src="<?php echo DOCBASE . 'templates/default/images/23_pfad80.png' ?>" alt="">
                    Club / Nachtleben
                </p>
                <?php $results1 = query_api("danceclubs");
                foreach ($results1->businesses as $key) : ?>
                <div class="reviews d-flex justify-content-between">
                    <div class="res_name">
                        <p>><?= $key->name ?></span></p>
                    </div>
                    <div class="stars">
                    <?= getStars($key->rating);
                         ?>
                           <span><?= $key->rating ?></span>
                    </div>
                  
                </div>
                
                <?php endforeach; ?>
            </div>
      
        </div>
    </div>
</section>
<section class="container pt-150 " id="bewertungen">

    <div class="rew d-flex justify-content-between">
        <h1 style="font-size: 30px; color: #023e8a; margin-bottom: 20px">
            Bewertungen
        </h1>
        <a style="text-decoration: none; color: #000;" href="#review_app" data-bs-toggle="modal">
            <div class="d-flex">

                <div class="box_review">
                    <img src="<?php echo DOCBASE . 'templates/default/images/Vector3.png ' ?>">
                </div>
                <p>Bewertung schreiben</p>

            </div>
        </a>
    </div>
 
    <?php
 $result_comment = $pms_db->query('SELECT pm_comment.id, pm_comment.id_item, pm_user.firstname, pm_comment.rating,  pm_user.lastname, pm_comment.msg,  NOW() - INTERVAL pm_comment.add_date DAY as data FROM  pm_comment , pm_user WHERE    pm_comment.email=pm_user.email order by  pm_comment.add_date limit 3');
 
 if ($result_comment->execute() !== false && $pms_db->last_row_count() >= 0) {
    $msg="";
    $rating=0;
    $firstname="";
    $data='';
     foreach ($result_comment as $i => $row) {
        $msg=$row["msg"];
        $firstname=$row["firstname"];
        $rating=$row["rating"];
        $data=$row["data"];
    ?>
    <div class="row testimonials">
        <div class="col-12">
            <h2><?php echo $firstname ?></h2>
            <p>
               <?php 
               for ($x = 0; $x <= $rating; $x++) {
                   ?>
                <i class="fa fa-star" aria-hidden="true"></i>

                <?php
               }
               ?>


                 
                <span style="color: #D8D8D8"><?php echo $data ?></span>
            </p>
            <p>
            <?php echo $msg ?>
            </p>
        </div>
    </div>

    <?php
     }
    }
    ?>
    

    <p class="weitere"><a href="#">Weitere Bewertungen</a></p>
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
                                                <p class=" mb-0">mit Google anmelden</p>
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
                                                    <label class="form-check-label" for="exampleCheck1">Ich
                                                        akzeptiere
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
<div class="modal fade" id="review_app" tabindex="-1" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen px-10-768">
        <div class="modal-content bg-transparent">
            <div class="container mt-5">
                <div class="w-100 d-flex justify-content-end pe-4 pb-3">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="row border-radius-80 bg_secondary">
                    <div class="container " id="review_page">
                        <div class="row">
                            <div class="col-6">
                                <h1>Bewertung schreiben</h1>
                            </div>
                            <div class="col-12 pb-5">
                                <p class="app_room">Bewertung abgeben für (Name of The Apartment/Room)</p>
                                <div class="reviews d-flex " style="padding-bottom: 30px;">
                                    <div class="res_name">
                                        <p style="font-size: 25px; font-weight: 400; padding-right: 40px;">
                                            Anazahl Sterne:</p>
                                    </div>
                                    <div class="stars" style="font-size: 25px;">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <label for="exampleFormControlTextarea1" class="form-label" style="font-size: 25px; font-weight: 400; padding-right: 40px;">Beschreibung</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="8"></textarea>
                                <button type="button" class="" style="background: #023E8A;color: #FFFFFF;font-size: 25px; padding: 10px; margin-top: 30px; float: right; border: 1px solid #023E8A;">Bewertung
                                    abgeben</button>

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
                                $result_room_file_details = $pms_db->query('SELECT * FROM pm_room_file WHERE id_item = ' . $room_id . ' AND checked = 1 AND lang = ' . PMS_DEFAULT_LANG . ' AND type = \'image\' AND file != \'\' ORDER BY `rank` limit 1 ');
                                if ($result_room_file_details->execute() !== false && $pms_db->last_row_count() >= 0) {

                                    foreach ($result_room_file_details as $i => $row) {

                                        $file_id = $row['id_item'];
                                        $filename = $row['file'];
                                        $realpath = '';

                                        $page_img = pms_getUrl(true) . DOCBASE . 'medias/room/medium/' . $file_id . '/' . $filename;
                                        $realpath =  DOCBASE . 'medias/room/small/' . $file_id . '/' . $filename;
                                ?>
                                        <img class="w-100" src="<?php echo  $realpath; ?>" />
                                        <img style="width: 100%; object-fit: cover;" src="<?php echo  $realpath; ?> alt="">
                          <?php


                                    }
                                } ?>
                                
                                <h3 class=" pt-4">2 BETTEN APARTMENT</h3>
                                        <p class="max_per">maximal 4 Personen</p>
                                        <h2>189.- / Nacht</h2>
                            </div>
                            <div class="col-md-8 ps-5 pe-5 ps-0 pe-0">
                                <div class="row ps-4 pe-4">
                                    <div class="col-md-12 pb-100 pb-10 ">
                                        <p>The self-check-in apartments Swiss Star Tower in Zurich-Oerlikon
                                            offer a kitchen, a bathroom and a balcony with a panoramic view
                                            in an up-and-coming district for culture, trade shows and sports.
                                            Friendly and appealingly furnished apartments, fair rates and a perfect
                                            housekeeping service guarantee a pleasant stay. The Swiss Star Tower
                                            apartments offer leisure and business travelers alike relaxation and
                                            tranquility in apartments with great infrastructure and facilities.
                                            Oerlikon is a great choice for travellers interested in convenient
                                            public
                                            transport, city trips and shopping.</p>
                                    </div>
                                    <div class="col-12">
                                        <p style="font-size: 18px; font-weight:600; color: #5A5A5A;">Ausstattung</p>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <p>Heizung</p>
                                        <p>Badezimmer</p>
                                        <p>Haartrockner</p>
                                        <p>TV</p>
                                        <p>Privates WC </p>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
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
                                    </div>
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
<script src="<?php echo DOCBASE ?>templates/default/wickedpicker/dist/wickedpicker.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    function ndryshoImazhin() {
        var imazhi = document.getElementById('imazhi');
        if (imazhi.src.match("Pfad123.png")) {
            imazhi.src = "img/Pfad 12.png";
        } else {
            imazhi.src = "img/Pfad123.png";
        }
    }
</script>

<script type="text/javascript">
    $(function() {
        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            autoApply: true,
            opens: 'left',
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
<script>
    $(function() {
        $(document).click(function(event) {

            let id_ = event.target.id;
            if (id_ != 'stepUp-1' && id_ != 'stepDown-1' && id_ != 'stepUp-2' && id_ != 'stepDown-2' && id_ != 'card_test') {
                let spinner1 = $('#spinner-1').val()
                let spinner2 = $('#spinner-2').val()

                if ((parseInt(spinner1) + parseInt(spinner2)) != 0) {
                    $('#txt_anzahl_personen').val(parseInt(spinner1) + parseInt(spinner2))
                } else {
                    $('#txt_anzahl_personen').val(null)
                }
                $('#anzahl_personen').collapse('hide');
            }
        });
    });

    $(function() {
        $("#spinner-1").spinner();
        $('button').button();

        $('#stepUp-1').click(function() {
            $("#spinner-1").spinner("stepUp");
        });
        $('#spinner-1').spinner('option', 'min', 0);

        $('#stepDown-1').click(function() {
            $("#spinner-1").spinner("stepDown");
        });
    });

    $(function() {
        $("#spinner-2").spinner();
        $('button').button();

        $('#stepUp-2').click(function() {
            $("#spinner-2").spinner("stepUp");
        });

        $('#spinner-2').spinner('option', 'min', 0);

        $('#stepDown-2').click(function() {
            $("#spinner-2").spinner("stepDown");
        });
    });
</script>

<script>
    $('.responsive1').slick({
        dots: false,
        arrows: false,
        infinite: true,
        speed: 500,
        centerMode: true,
        centerPadding: '300px',
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
                breakpoint: 1199,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    centerPadding: '150px',
                    infinite: true,
                }
            },

            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding: '150px',
                    infinite: true,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '50px',
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    centerPadding: '10px',
                    slidesToScroll: 1
                }
            },
        ]
    });
</script>

</body>

</html>