<?php

use UKMNorge\Filmer\UKMTV\Server\BandwidthMode;
use UKMNorge\Meta\Collection;
use UKMNorge\Meta\ParentObject;
use UKMNorge\Meta\Write;

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

// LIVESTREAM
$livestream = new Collection(
    new ParentObject('livestream',0)
);
if( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['livestream_pass']) ) {
    Write::set( $livestream->get('brukernavn')->set(LIVESTREAM_EMAIL) );
    Write::set( $livestream->get('passord')->set($_POST['livestream_pass']) );
    UKMTV_wpadmin::getFlash()->success('Oppdatert livestream-innstillinger');
}
UKMTV_wpadmin::addViewData('livestream', $livestream);