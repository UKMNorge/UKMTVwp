<?php

use UKMNorge\Filmer\UKMTV\Filmer;
use UKMNorge\Filmer\UKMTV\Write;

try {
    $film = Filmer::getById(
        Filmer::getIdFromUrl( $_POST['video_url'] )
    );
    Write::slett($film);
    UKMTV_wpadmin::addViewData('deleted',$film);
} catch( Exception $e ) {
    if( $e->getCode() == 143001 ) {
        UKMTV_wpadmin::getFlash()->error(
            'Fant ikke filmens id fra URL-adressen.'
        );
    } else {
        UKMTV_wpadmin::getFlash()->error(
            'En ukjent feil oppsto ved sletting av filmen. Serveren sa: '. $e->getMessage()
        );
    }
}