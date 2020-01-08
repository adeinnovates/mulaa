<?php
/** ===================================
  * Plugin Name: Mulaa Pay
  * Plugin URI: https://mulaa.co
  * Description: Mulaa pay with bank powered by qucoon
  * Version: 0.0.01
  * Author: Gdi
  * Author URI: http://mulaa.co
  * Text Domain: mulaa-pay
  * License: GPLv2 or later
*
 */

 if (!defined('ABSPATH')){
   die;
 }

 class mulaaPay
 {
   //public
   // can be accessed everywhere
   //protected
   // can be accessed within the class itself
   //private
   //only within the class, o extensions

   function __construct(){
     add_action('init', array($this, 'custom_post_type'));
   }

   function register(){
     add_action('admin_enqueue_scripts', array($this, 'enqueue'));
   }
   function activate(){
     // echo 'The error is here';
     //generated a CPT
     $this->custom_post_type();
     flush_rewrite_rules();
   }

   function deactivate(){
   // echo 'The error is here for deactivate';
   //flush rewrite
   }

   function uninstall(){
      //delete CPT
      //delete plugn data in DB
   }

   function enqueue(){
     //
     wp_enqueue_style('mulaapaystyle', plugins_url('/assets/style.css', __FILE__));
     wp_enqueue_script('mulaapayscript', plugins_url('/assets/script.js', __FILE__));
   }

   function custom_post_type(){
     register_post_type( 'mulaapay',
     array(
      'labels'      => array(
          'name'          => __('Mulaa Pays'),
          'singular_name' => __('Mulaa Pay'),
      ),
      'public'      => true,
      'has_archive' => true,
  )
    );
   }
 }

 if(class_exists('mulaaPay')){
    $mulaaPay = new mulaaPay();
    $mulaaPay->register();
 }

 //activation
 register_activation_hook( __FILE__, array($mulaaPay, 'activate'));

 //deactivation
 register_deactivation_hook( __FILE__, array($mulaaPay, 'deactivate'));


 //uninstall
 //register_uninstall_hook( __FILE__, array($mulaaPay, 'uninstall'));