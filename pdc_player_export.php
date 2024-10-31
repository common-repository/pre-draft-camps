<?php
require('../../../wp-blog-header.php');
if(current_user_can('manage_options') ){
error_reporting(0);
$columns=array();
global $wpdb;
 
$columns['ID']='Player ID'; 

$columns['fname']='First Name';
$columns['lname']='Last Name';
$columns['dtphone']='Daytime Phone';
$columns['evphone']='Evening Phone';
$columns['emailadd1']='Email Address 1';
$columns['add1']='Address 1';
$columns['camp_city']='City';
$columns['camp_state']='State';
$columns['zip']='Zip';
$columns['emailadd2']='Email Address 2';
$columns['add2']='Address 2';
$columns['camp_city2']='City';
$columns['camp_state2']='State';
$columns['zip2']='Zip';
$columns['age_on_pdc']='Age on Day of PDC';
$columns['birthday']='Birthday';
$columns['grade']='Grade On Day Of PDC';
$columns['gender']='Gender';
$columns['school']='School';
$columns['ttprog']='Travel Team Program';
$columns['shirt_size']='Shirt Size';

$columns['promocode']='Promotional Code';
$columns['fb_page']='Facebook Page';
$columns['twitter_page']='Twitter Page';
$columns['yt_page']='YouTube Page';
$columns['hw_hr_pdc']='How did you hear about PDC?';
$columns['parent_name']='Parent/Guardian';
$columns['parent_phone']='Parent\'s Phone';
$columns['family_phy']='Family Physician';
$columns['phy_phone']='Physician Phone';
$columns['med_ins_comp']='Medical Insurance Company';
$columns['policy_number']='Policy Number';

$columns['policy_holder_name']='Policy Holder name';
$columns['camp_id']='Registered for Camp';
$columns['thumbnail_image']='Player Image';
$columns['player_status']='Player Status';
 
$data=array();
$i=0;
$args = array(
	'post_type' => 'pdc_player',
	'posts_per_page' => -1,
	'meta_query' => array(
	    array(
	      'key' => 'camp_id',
	      'value' => $_GET['camp_id'],
	      'compare' => '='
	    )
  	)
);
$the_query = new WP_Query( $args ); 
if ( $the_query->have_posts() ) :  
	while ( $the_query->have_posts() ) : $the_query->the_post();  
		
		$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'thumbnail' );
		$data[$i]=array(
		'ID'=> get_the_ID(),
		'thumbnail_image'=>$feat_image[0],
		'fname' =>  get_post_meta( get_the_ID(), 'fname', true) ,
		'lname' =>get_post_meta( get_the_ID(), 'lname', true),
		'dtphone' =>get_post_meta( get_the_ID(), 'dtphone', true),
		'evphone' => (get_post_meta( get_the_ID(), 'evphone', true)),
		'emailadd1' => (get_post_meta( get_the_ID(), 'emailadd1', true)),
		'add1' =>get_post_meta( get_the_ID(), 'add1', true),
		'camp_city' =>get_post_meta( get_the_ID(), 'camp_city', true),
		'camp_state' =>get_post_meta( get_the_ID(), 'camp_state', true),
		'zip' =>get_post_meta( get_the_ID(), 'zip', true),
		'emailadd2'=>  get_post_meta( get_the_ID(), 'emailadd2', true),
		'add2' =>get_post_meta( get_the_ID(), 'add2', true),
		'camp_city2' =>get_post_meta( get_the_ID(), 'camp_city2', true),
		'camp_state2' =>get_post_meta( get_the_ID(), 'camp_state2', true),
		'zip2' =>get_post_meta( get_the_ID(), 'zip2', true),
		'age_on_pdc' =>get_post_meta( get_the_ID(), 'age_on_pdc', true),
		'birthday' =>  get_post_meta( get_the_ID(), 'birthday', true) ,
		'grade' =>(get_post_meta( get_the_ID(), 'grade', true)),
		'gender' =>(get_post_meta( get_the_ID(), 'gender', true)),
		'school' =>get_post_meta( get_the_ID(), 'school', true),
		'ttprog' =>get_post_meta( get_the_ID(), 'ttprog', true),
		'shirt_size' =>get_post_meta( get_the_ID(), 'shirt_size', true),
		'promocode' =>get_post_meta( get_the_ID(), 'promocode', true),
		'fb_page' =>get_post_meta( get_the_ID(), 'fb_page', true),
		'twitter_page' =>get_post_meta( get_the_ID(), 'twitter_page', true),
		'yt_page' =>get_post_meta( get_the_ID(), 'yt_page', true),
		'hw_hr_pdc' =>get_post_meta( get_the_ID(), 'hw_hr_pdc', true),
		'parent_name' =>get_post_meta( get_the_ID(), 'parent_name', true),
		'parent_phone' =>get_post_meta( get_the_ID(), 'parent_phone', true),
		'family_phy' =>get_post_meta( get_the_ID(), 'family_phy', true),
		'phy_phone' =>get_post_meta( get_the_ID(), 'phy_phone', true),
		'med_ins_comp' =>get_post_meta( get_the_ID(), 'med_ins_comp', true),
		'policy_number' =>get_post_meta( get_the_ID(), 'policy_number', true),
		'policy_holder_name' =>get_post_meta( get_the_ID(), 'policy_holder_name', true),
		'camp_id' =>get_the_title(get_post_meta(get_the_ID(), 'camp_id', true)) ,
		'player_status' =>(get_post_meta( get_the_ID(), 'player_status', true)==1)? 'Active' : 'In-Active'
	);

  endwhile;  

   wp_reset_postdata(); 

  else:  
 $data[0]=array();
  endif;  

 
 
require_once('includes/csv_export.php');

new CSV($columns, $data, 'player-'.date("M-d-Y"));

}else{

	wp_die( __( 'Cheatin&#8217; uh?' ) );

}

?>