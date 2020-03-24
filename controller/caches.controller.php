<?php

use UKMNorge\Filmer\UKMTV\Server\Caches;

// AKTIVERE
if (isset($_GET['aktiver'])) {
    try {
        Caches::aktiverCache(
            Caches::getById(intval($_GET['aktiver']))
        );
        UKMTV_wpadmin::getFlash()->success(
            'Cache ' . $_GET['aktiver'] . ' er aktivert!'
        );
    } catch (Exception $e) {
        UKMTV_wpadmin::getFlash()->error(
            'Kunne ikke aktivere cache ' . $_GET['aktiver'] . '. ' .
            'Systemet sa: ' . $e->getMessage()
        );
    }
}

// DEAKTIVERE
if (isset($_GET['deaktiver'])) {
    try {
        Caches::deaktiverCache(
            Caches::getById(intval($_GET['deaktiver']))
        );
        UKMTV_wpadmin::getFlash()->success(
            'Cache ' . $_GET['aktiver'] . ' er deaktivert!'
        );
    } catch (Exception $e) {
        UKMTV_wpadmin::getFlash()->error(
            'Kunne ikke deaktivere cache ' . $_GET['deaktiver'] . '. ' .
            'Systemet sa: ' . $e->getMessage()
        );
    }
}

UKMTV_wpadmin::addViewData('caches', Caches::getAllInkludertInaktive());
