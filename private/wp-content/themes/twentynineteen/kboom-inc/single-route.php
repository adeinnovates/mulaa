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
    register_rest_route('kboom-auth/v1', 'booms',array(
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
            'boomID' => get_the_ID(),
            'brandName' => get_post_field('brand_name'),
            'postURL' => get_post_field('post_url'),
            'image' =>  get_field( "image", get_the_ID() ),
            'brandApproved' => get_post_field('brand_approved'),
            'userRole' => get_userdata(get_the_author_meta(ID))->roles
        ));
    }

    return $boomResults;
    //return $products->posts;
}