<?php

use UKMNorge\Filmer\UKMTV\Filmer;
use UKMNorge\Filmer\UKMTV\Server\Server;

try {
    $film = Filmer::getById(
        Filmer::getIdFromUrl( $_POST['video_url'] )
    );
    UKMTV_wpadmin::addViewData('storage', Server::getStorageUrl());
    UKMTV_wpadmin::addViewData('download', $film);

    $store = new UKMCURL();
    $store->timeout(6);
    $apiAnswer = $store->request('https://api.'. UKM_HOSTNAME .'/video:info/'. $film->getCronId());
    
    UKMTV_wpadmin::addViewData('digarkpath', $apiAnswer->path->dir . $apiAnswer->path->filename);
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