<?php
//trigger this on plugin uninstall

if(!defined('WP_UNINSTALL_PLUGIN')){
    die;
}

//Clear Database stored data
/*
$mulaapays = get_posts(array('post_type'=>'mulaapay', 'numberposts'=> -1));

foreach($mulaapays as $mulaapay){
    wp_delete_post( $mulaapay->ID, true );
}
*/

//access DB via SQL
global $wpdb;
$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'mulaapay");
