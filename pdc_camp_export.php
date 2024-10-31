<?php
require('../../../wp-blog-header.php');
if(current_user_can('manage_options') ){
error_reporting(0);
$columns=array();
global $wpdb;
$SQL	=	"SHOW COLUMNS FROM ".$wpdb->posts;
$data	=	$wpdb->get_results($SQL);
for($i=0;$i<count($data);$i++){
 	$columns[$data[$i]->Field]=$data[$i]->Field;
}
 
$columns['thumbnail_image']='thumbnail_image';
$columns['pdc_camp_fees']='pdc_camp_fees';
$columns['pdc_camp_start_date']='pdc_camp_start_date';
$columns['pdc_camp_end_date']='pdc_camp_end_date';
$columns['pdc_camp_start_time']='pdc_camp_start_time';
$columns['pdc_camp_end_time']='pdc_camp_end_time';
$columns['pdc_camp_venue']='pdc_camp_venue';
$columns['pdc_camp_coach']='pdc_camp_coach';
$columns['pdc_camp_website']='pdc_camp_website';
$columns['pdc_camp_age_group']='pdc_camp_age_group';
$columns['pdc_camp_for_gender']='pdc_camp_for_gender';
$columns['pdc_camp_max_enrolment']='pdc_camp_max_enrolment';
$columns['pdc_camp_enrollments']='pdc_camp_enrollments';
$columns['pdc_camp_status']='pdc_camp_status';
$columns['pdc_camp_lcn']='pdc_camp_local_contact_number';
$columns['pdc_camp_lct']='pdc_camp_local_contact_telephone';
$columns['pdc_camp_lce']='pdc_camp_local_contact_email';
$columns['pdc_camp_lca']='pdc_camp_local_contact_address';
$columns['pdc_camp_lc_city']='pdc_camp_local_contact_city';
$columns['pdc_camp_lc_state']='pdc_camp_local_contact_state';
$columns['pdc_camp_lc_zip']='pdc_camp_local_contact_zip';
$columns['camp_image_gallery']='camp_image_gallery';
$data=array();
$i=0;
$args = array(
	'post_type' => 'pdc_camp',
	'posts_per_page' => -1
);
$the_query = new WP_Query( $args ); 
if ( $the_query->have_posts() ) :  
	while ( $the_query->have_posts() ) : $the_query->the_post();  
		$camp_image_gallery =get_post_meta( get_the_ID(), 'camp_image_gallery', true);
		$file_path=array();
		$attachments = array_filter(explode(',', $camp_image_gallery));
		if ($attachments){
			foreach ($attachments as $attachment_id) {
				$file_path[]='['.wp_get_attachment_url($attachment_id).']';
			}
		}
		$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'thumbnail' );
		$data[$i]=array(
		'ID'=> get_the_ID(),
		'post_author'=>get_the_author(),
		'post_date'=>$post->post_date,
		'post_date_gmt'=>$post->post_date_gmt,
		'post_content'=>$post->post_content,
		'post_title'=>$post->post_title,
		'post_excerpt'=>$post->post_excerpt,
		'post_status'=>$post->post_status,
		'comment_status'=>$post->comment_status,
		'ping_status'=>$post->ping_status,
		'post_password'=>$post->post_password,
		'post_name'=>$post->post_name,
		'to_ping'=>$post->to_ping,
		'pinged'=>$post->pinged,
		'post_modified'=>$post->post_modified,
		'post_modified_gmt'=>$post->post_modified_gmt,
		'post_content_filtered'=>$post->post_content_filtered,
		'post_parent'=>$post->post_parent,
		'guid'=>$post->guid,
		'menu_order'=>$post->menu_order,
		'post_type'=>$post->post_type,
		'post_mime_type'=>$post->post_mime_type,
		'comment_count'=>$post->comment_count,
		'thumbnail_image'=>$feat_image[0],
		'pdc_camp_start_date' => date('M d,Y',get_post_meta( get_the_ID(), 'pdc_camp_start_date', true)),
		'pdc_camp_end_date' => date('M d,Y',get_post_meta( get_the_ID(), 'pdc_camp_end_date', true)),
		'pdc_camp_start_time' =>get_post_meta( get_the_ID(), 'pdc_camp_start_time', true),
		'pdc_camp_end_time' =>get_post_meta( get_the_ID(), 'pdc_camp_end_time', true),
		'pdc_camp_venue' =>get_the_title(get_post_meta( get_the_ID(), 'pdc_camp_venue', true)),
		'pdc_camp_coach' =>get_the_title(get_post_meta( get_the_ID(), 'pdc_camp_coach', true)),
		'pdc_camp_website' =>get_post_meta( get_the_ID(), 'pdc_camp_website', true),
		'pdc_camp_age_group' =>get_post_meta( get_the_ID(), 'pdc_camp_age_group', true),
		'pdc_camp_for_gender' =>get_post_meta( get_the_ID(), 'pdc_camp_for_gender', true),
		'pdc_camp_max_enrolment' =>get_post_meta( get_the_ID(), 'pdc_camp_max_enrolment', true),
		'pdc_camp_enrollments'=> get_current_enrollment($post_ID).'/'.get_post_meta( get_the_ID(), 'pdc_camp_max_enrolment', true),
		'pdc_camp_status' =>get_post_meta( get_the_ID(), 'pdc_camp_status', true),
		'pdc_camp_lcn' =>get_post_meta( get_the_ID(), 'pdc_camp_lcn', true),
		'pdc_camp_lct' =>get_post_meta( get_the_ID(), 'pdc_camp_lct', true),
		'pdc_camp_lce' =>get_post_meta( get_the_ID(), 'pdc_camp_lce', true),
		'pdc_camp_lca' =>get_post_meta( get_the_ID(), 'pdc_camp_lca', true),
		'pdc_camp_lc_city' =>getCityName(get_post_meta( get_the_ID(), 'pdc_camp_lc_city', true)),
		'pdc_camp_lc_state' =>getStateName(get_post_meta( get_the_ID(), 'pdc_camp_lc_state', true)),
		'pdc_camp_lc_zip' =>get_post_meta( get_the_ID(), 'pdc_camp_lc_zip', true),
		'camp_image_gallery' =>implode('||',$file_path) 
	);

  endwhile;  

   wp_reset_postdata(); 

  else:  
 $data[0]=array();
  endif;  

 
 
require_once('includes/csv_export.php');

new CSV($columns, $data, 'camp-'.date("M-d-Y"));

}else{

	echo'uhh!! Cheating!!!....';

}

?>