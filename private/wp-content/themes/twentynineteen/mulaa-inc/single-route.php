<?php

//register custom query vars
function sm_register_query_vars( $vars ) {
    $vars[] = 'author';
    $vars[] = 'brandApproved';
    $vars[] = 'brand';
    return $vars;
} 
add_filter( 'query_vars', 'sm_register_query_vars' );

// custom endpoint 
add_action('rest_api_init', 'runRoute');

function runRoute(){
    register_rest_route('mulaa-auth/v1', 'products',array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'boomsResult',
        /*'permission_callback' => function ($request) {
                        if (current_user_can('edit_posts'))
                        return true;
                 }*/
    ));
}

function boomsResult($data){
    $parameters = $data->get_params();
    $booms = new WP_Query(array(
        'post_type' => 'boom',
        's' => $parameters['term'], //sanitize_text_field($parameters['term'])
        'author_name' => $parameters['author'],
        
    ));

    $boomResults = array();
   

    while($booms->have_posts()){
        $booms->the_post();
        array_push($boomResults, array(
            'title' => get_the_title(),
            'theAuthor' => get_the_author_nickname(),
            'productID' => get_the_ID(),
            'description' => get_post_field('description'),
            'price' => get_post_field('price'),
            'image' =>  get_post_field('image'),//get_field( "image", get_the_ID() ),
            'discount' => get_post_field('discount_price'),
            'showDiscount' => get_post_field('show_discount'),
            'deliveryLocations' => get_post_field('delivery_locations'),
            'userRole' => get_userdata(get_the_author_meta(ID))->roles
        ));
    }

    return $boomResults;
    //return $products->posts;
}