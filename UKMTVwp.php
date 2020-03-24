<?php  
/* 
Plugin Name: UKM-TV Wordpressadmin
Plugin URI: http://www.ukm-norge.no
Description: Brukes for å håndtere UKM-TV
Author: UKM Norge / M Mandal
Version: 1.0
Author URI: http://www.ukm-norge.no
*/

use UKMNorge\Wordpress\Modul;

require_once('UKM/Autoloader.php');

class UKMTV_wpadmin extends Modul {
    static $action = 'dashboard';
    static $path_plugin;

    /**
     * Hook inn på wordpress
     *
     * @return void
     */
    public static function hook() {
        add_action(
            'network_admin_menu',
            [ static::class, 'meny']
        );
    }

    /**
     * Legg til menyelementer
     *
     * @return void
     */
    public static function meny() {
        $scripts[] = add_menu_page(
            'UKM-TV',
            'UKM-TV',
            'administrator',
            'UKMTVwp_admin',
            [static::class, 'renderAdmin'],
            'dashicons-video-alt3',
            500
        );
        
        $scripts[] = add_submenu_page(
            'UKMTVwp_admin',
            'Konverteringskø',
            'Konverteringskø',
            'administrator',
            'UKMTVwp_queue',
            [static::class, 'renderQueue']
        );


        foreach( $scripts as $scripthook ) {
            add_action( 
                'admin_print_styles-' . $scripthook,
                [static::class, 'scripts_and_styles']
            );
        }
    }

    /**
     * Legg til scripts and styles
     *
     * @return void
     */
    public static function scripts_and_styles() {
        wp_enqueue_style('WPbootstrap3_css');
    }

    /**
     * Render av queue-action
     *
     * @return void
     */
    public static function renderQueue() {
        static::setAction('queue');
        return static::renderAdmin();
    }
}

UKMTV_wpadmin::init(__DIR__);
UKMTV_wpadmin::hook();