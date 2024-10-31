<?php
require('../../../wp-blog-header.php');
if(current_user_can('manage_options') ){
error_reporting(0);
$columns=array();
global $wpdb;
 
$columns['ID']='Venue ID'; 

$columns['title']='Venue Title';
$columns['description']='Venue Description';
$columns['pdc_venue_contact_name']='Contact Name'; 
$columns['wp_pdc_venue_address']='Address';
$columns['pdc_venue_city']='City';
$columns['pdc_venue_state']='State';
$columns['pdc_venue_zip']='Zip';
$columns['pdc_venue_phone']='Phone Number';
$columns['pdc_venue_camp']='Camps';

 
$data=array();
$i=0;
$args = array(
	'post_type' => 'pdc_venue',
	'posts_per_page' => -1 
);
$the_query = new WP_Query( $args ); 
if ( $the_query->have_posts() ) :  
	while ( $the_query->have_posts() ) : $the_query->the_post();  
		
		 $data[$i]=array(
		'ID'=> get_the_ID(),
		'description'=>$post->post_content,
		'title'=>$post->post_title, 
		'pdc_venue_contact_name' =>  get_post_meta( get_the_ID(), 'pdc_venue_contact_name', true) ,
		'wp_pdc_venue_address' =>get_post_meta( get_the_ID(), 'wp_pdc_venue_address', true),
		'pdc_venue_city' =>getCityName(get_post_meta( get_the_ID(), 'pdc_venue_city', true)),
		'pdc_venue_state' => getStateName(get_post_meta( get_the_ID(), 'pdc_venue_state', true)),
		'pdc_venue_zip' => (get_post_meta( get_the_ID(), 'pdc_venue_zip', true)),
		'pdc_venue_phone' =>get_post_meta( get_the_ID(), 'pdc_venue_phone', true),
		'pdc_venue_camp' =>getcamp_list_by_venue(get_the_ID())  
	);

  endwhile;  

   wp_reset_postdata(); 

  else:  
 $data[0]=array();
  endif;  

 
 
require_once('includes/csv_export.php');

new CSV($columns, $data, 'venue-'.date("M-d-Y"));

}else{

	wp_die( __( 'Cheatin&#8217; uh?' ) );

}

?>