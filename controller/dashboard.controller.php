<?php

use UKMNorge\Filmer\UKMTV\Server\BandwidthMode;

// BANDWIDTH-MODE
if( isset($_GET['bandwidth'])) {
    BandwidthMode::setMode($_GET['bandwidth']);
}
UKMtv_wpadmin::addViewData('bandwidthmode', new BandwidthMode());

// SLETT FILM
if( isset($_POST['deleteFilm'])) {
    UKMTV_wpadmin::require('controller/delete.controller.php');
}

// LAST NED FILM
if( isset($_POST['downloadFilm'])) {
    UKMTV_wpadmin::require('controller/download.controller.php');
}

// CACHE-SERVERE
UKMTV_wpadmin::require('controller/caches.controller.php');