<?php
/**
Plugin Name: WP Pre Draft Camp Manager Plugin
Plugin URI:
Description: From this plugin you can create/edit/delete Pre Draft Camps.
Author: Avinash Deedwaniya
Version: 1.0
Author URI: http://www.iwebdeeds.com
*/
$wpt_menu_manager_title = 'WP Pre Draft Camp Manager Plugin';

/* Runs when plugin is activated */
register_activation_hook(__FILE__, 'wp_pdc_install');

/* Runs on plugin deactivation */
register_deactivation_hook(__FILE__, 'wp_pdc_remove');

/* Update some variables */

function wp_pdc_install() {

/* Creates new variables */
add_option('wp_pdc_enable_status', 'yes', '', 'yes');
add_option('wp_pdc_version', '1.0', '', '1.0');
global $wpdb;
/*     * ********CREATE CITY - STATES DATABASE************* */
$charset_collate = "";

if ($wpdb->supports_collation()) {

if (!empty($wpdb->charset)) {

$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
}

if (!empty($wpdb->collate)) {

$charset_collate .= " COLLATE $wpdb->collate";
}
}
$simple_pdc_table_name = $wpdb->prefix . "pdc_state_manager";

if ($wpdb->get_var("SHOW TABLES LIKE '$simple_pdc_table_name'") != $simple_pdc_table_name) {

$create_pdc_manager_table = "CREATE TABLE IF NOT EXISTS $simple_pdc_table_name (
`id` int(11) NOT NULL AUTO_INCREMENT,
`state_title` varchar(22) NOT NULL,
PRIMARY KEY (`id`)
) $charset_collate AUTO_INCREMENT=1 ";

require_once(ABSPATH . "wp-admin/includes/upgrade.php");

dbDelta($create_pdc_manager_table);

$wpdb->query(("
INSERT INTO " . $simple_pdc_table_name . " (`id`, `state_title`) VALUES(1, 'AK'),(2, 'AL'),(3, 'AR'),(4, 'AZ'),(5, 'CA'),(6, 'CO'),(7, 'CT'),(8, 'DC'),(9, 'DE'),(10, 'FL'),(11, 'GA'),(12, 'HI'),(13, 'IA'),(14, 'ID'),(15, 'IL'),(16, 'IN'),(17, 'KS'),(18, 'KY'),(19, 'LA'),(20, 'MA'),(21, 'MD'),(22, 'ME'),(23, 'MI'),(24, 'MN'),(25, 'MO'),(26, 'MS'),(27, 'MT'),(28, 'NC'),(29, 'ND'),(30, 'NE'),(31, 'NH'),(32, 'NJ'),(33, 'NM'),(34, 'NV'),(35, 'NY'),(36, 'OH'),(37, 'OK'),(38, 'OR'),(39, 'PA'),(40, 'RI'),(41, 'SC'),(42, 'SD'),(43, 'TN'),(44, 'TX'),(45, 'UT'),(46, 'VA'),(47, 'VT'),(48, 'WA'),(49, 'WI'),(50, 'WV'),(51, 'WY')"));
}


$simple_pdc_table_name = $wpdb->prefix . "pdc_city_manager";

if ($wpdb->get_var("SHOW TABLES LIKE '$simple_pdc_table_name'") != $simple_pdc_table_name) {

$create_pdc_manager_table = "CREATE TABLE IF NOT EXISTS $simple_pdc_table_name (
`id` int(11) NOT NULL AUTO_INCREMENT,
`city_title` varchar(50) NOT NULL,
`state_id` int(11) NOT NULL,
PRIMARY KEY (`id`)
) $charset_collate AUTO_INCREMENT=1 ";

require_once(ABSPATH . "wp-admin/includes/upgrade.php");

dbDelta($create_pdc_manager_table);

$wpdb->query(("
INSERT INTO " . $simple_pdc_table_name . " (`id`, `city_title`, `state_id`) VALUES(1, 'Aaronsburg', 39),(2, 'Abbeville', 2),(3, 'Abbeville', 11),(4, 'Abbeville', 19),(5, 'Abbeville', 26),(6, 'Abbeville', 41),(7, 'Abbot', 22),(8, 'Abbotsford', 49),(9, 'Abbott', 44),(10, 'Abbottstown', 39),(11, 'Abbeyville', 46),(12, 'Abell', 21),(13, 'Abercrombie', 29),(14, 'Aberdeen', 14),(15, 'Aberdeen', 18),(16, 'Aberdeen', 21),(17, 'Aberdeen', 26),(18, 'Aberdeen', 28),(19, 'Aberdeen', 36),(20, 'Aberdeen', 42),(21, 'Aberdeen', 48),(22, 'Aberdeen Proving Ground', 21),(23, 'Abernant', 2),(24, 'Abernathy', 44),(25, 'Abie', 30),(26, 'Abilene', 17),(27, 'Abilene', 44),(28, 'Abingdon', 15),(29, 'Abingdon', 21),(30, 'Abingdon', 46),(31, 'Abington', 7),(32, 'Abington', 20),(33, 'Abington', 39),(34, 'Abiquiu', 33),(35, 'Abita Springs', 19),(36, 'Abrams', 49),(37, 'Absaraka', 29),(38, 'Absarokee', 27),(39, 'Absecon', 32),(40, 'Acampo', 5),(41, 'Accident', 21),(42, 'Accokeek', 21),(43, 'Accomac', 46),(44, 'Accord', 20),(45, 'Accord', 35),(46, 'Accoville', 50),(47, 'Ace', 44),(48, 'Achille', 37),(49, 'Achilles', 46),(50, 'Ackerly', 44),(51, 'Ackerman', 26),(52, 'Ackermanville', 39),(53, 'Ackley', 13),(54, 'Ackworth', 13),(55, 'Acme', 19),(56, 'Acme', 23),(57, 'Acme', 39),(58, 'Acme', 48),(59, 'Acosta', 39),(60, 'Acra', 35),(61, 'Acton', 5),(62, 'Acton', 20),(63, 'Acton', 22),(64, 'Acton', 27),(65, 'Acushnet', 20),(66, 'Acworth', 11),(67, 'Acworth', 31),(68, 'Ada', 23),(69, 'Ada', 24),(70, 'Ada', 36),(71, 'Ada', 37),(72, 'Adah', 39),(73, 'Adair', 13),(74, 'Adair', 15),(75, 'Adair', 37),(76, 'Adairsville', 11),(77, 'Adairville', 18),(78, 'Adak', 1),(79, 'Adamant', 47),(80, 'Adams', 18),(81, 'Adams', 20),(82, 'Adams', 24),(83, 'Adams', 29),(84, 'Adams', 30),(85, 'Adams', 35),(86, 'Adams', 37),(87, 'Adams', 38),(88, 'Adams', 43),(89, 'Adams', 49),(90, 'Adams Basin', 35),(91, 'Adams Center', 35),(92, 'Adams Run', 41),(93, 'Adamsburg', 39),(94, 'Adamstown', 21),(95, 'Adamstown', 39),(96, 'Adamsville', 2),(97, 'Adamsville', 36),(98, 'Adamsville', 39),(99, 'Adamsville', 40),(100, 'Adamsville', 43),(29739, 'Jackson', 26),(29740, 'Houston', 44),(29741, 'Orlando', 10),(29742, 'Philadelphia', 39),(29743, 'Portland', 38),(29744, 'Seattle', 48),(29745, 'Chicago', 15),(29746, 'Greensborough ', 28),(29747, 'Atlanta', 11),(29748, 'Kansas City', 17),(29749, 'Iowa', 6),(29750, 'Salem', 38),(29751, 'Decatur', 11),(29752, 'Burlington', 32),(29753, 'Olathe', 17),(29754, 'Ridgeland', 26),(29755, 'The Woodlands', 44),(29756, 'Mesa', 4),(29757, 'Tucson', 4),(29758, 'Burlington123456', 32),(29759, 'test', 1),(29760, 'Westchester', 15),(29761, 'OKLAHOMA CITY', 37),(29762, 'Lisle', 15),(29763, 'New York', 35),(29764, 'Greensboro', 28),(29765, '', 13),(29766, 'Ames', 13),(29767, 'Mission Hills', 5),(29768, 'Winter Park', 10),(29769, 'Dallas', 44),(29770, 'Augusta', 11),(29771, 'Des Plaines', 15),(29772, 'West Hempstead', 35),(29773, 'Nashua', 31),(29774, 'Mahwah', 32),(29775, 'Snellville', 11),(29776, 'Camp Hill', 39),(29777, 'North Augusta', 11),(29778, 'Paterson', 32),(29779, 'Colonie', 35)"));
}


if (!is_page('pdc_camp_registration')):
// Create post object
$my_post = array(
'post_title' => 'Camp Registration Step-1',
'post_content' => '',
'post_status' => 'publish',
'post_author' => 1,
'post_name' => 'pdc_camp_registration',
'post_type' => 'page'
);

// Insert the post into the database
wp_insert_post($my_post);
endif;
if (!is_page('pdc_camp_registration_two')):
$my_post = array(
'post_title' => 'Camp Registration Step-2',
'post_content' => '',
'post_status' => 'publish',
'post_author' => 1,
'post_name' => 'pdc_camp_registration_two',
'post_type' => 'page'
);

// Insert the post into the database
wp_insert_post($my_post);
/*     * **********END****************************** */
endif;
}

/* Remove all created variables */

function wp_pdc_remove() {
/* Deletes the database field */
delete_option('wp_pdc_enable_status');
delete_option('wp_pdc_version');
}

add_action('init', 'create_wp_pdc_venue');

function create_wp_pdc_venue() {


register_post_type('pdc_venue', array(
'labels' => array(
'name' => 'PDC Venue',
'singular_name' => 'PDC Venue',
'add_new' => 'Add New',
'add_new_item' => 'Add New Entry',
'edit' => 'Edit',
'edit_item' => 'Edit Entry',
'new_item' => 'New Entry',
'view' => 'View',
'view_item' => 'View Entry',
'search_items' => 'Search Entry',
'not_found' => 'No Entry found',
'not_found_in_trash' => 'No Entry found in Trash',
'parent' => 'Parent Entry'
),
'public' => true,
'menu_icon'=>plugins_url( 'assets/final-pre-draft.jpg' , __FILE__ ),
'menu_position' => 15,
'supports' => array('title', 'editor'),
'has_archive' => true
)
);

register_post_type('pdc_camp', array(
'labels' => array(
'name' => 'PDC Camp',
'singular_name' => 'PDC Camp',
'add_new' => 'Add New',
'add_new_item' => 'Add New Entry',
'edit' => 'Edit',
'edit_item' => 'Edit Entry',
'new_item' => 'New Entry',
'view' => 'View',
'view_item' => 'View Entry',
'search_items' => 'Search Entry',
'not_found' => 'No Entry found',
'not_found_in_trash' => 'No Entry found in Trash',
'parent' => 'Parent Entry'
),
'public' => true,
'menu_icon'=>plugins_url( 'assets/final-pre-draft.jpg' , __FILE__ ),
'menu_position' => 14,
'supports' => array('title', 'editor', 'thumbnail', 'comments'),
'has_archive' => true
)
);

register_post_type('pdc_coach', array(
'labels' => array(
'name' => 'PDC Coach',
'singular_name' => 'PDC Coach',
'add_new' => 'Add New',
'add_new_item' => 'Add New Entry',
'edit' => 'Edit',
'edit_item' => 'Edit Entry',
'new_item' => 'New Entry',
'view' => 'View',
'view_item' => 'View Entry',
'search_items' => 'Search Entry',
'not_found' => 'No Entry found',
'not_found_in_trash' => 'No Entry found in Trash',
'parent' => 'Parent Entry'
),
'public' => true,
'menu_icon'=>plugins_url( 'assets/final-pre-draft.jpg' , __FILE__ ),
'menu_position' => 14,
'supports' => array('title', 'editor', 'thumbnail'),
'has_archive' => true
)
);

register_post_type('pdc_player', array(
'labels' => array(
'name' => 'PDC Player',
'singular_name' => 'PDC Player',
'add_new' => 'Add New',
'add_new_item' => 'Add New Entry',
'edit' => 'Edit',
'edit_item' => 'Edit Entry',
'new_item' => 'New Entry',
'view' => 'View',
'view_item' => 'View Entry',
'search_items' => 'Search Entry',
'not_found' => 'No Entry found',
'not_found_in_trash' => 'No Entry found in Trash',
'parent' => 'Parent Entry'
),
'public' => true,
'menu_icon'=>plugins_url( 'assets/final-pre-draft.jpg' , __FILE__ ),
'menu_position' => 14,
'supports' => array('title', 'editor', 'thumbnail')
)
);

wp_register_script(
'pdc_custom_script', plugins_url('assets/datetimepicker_css.js', __FILE__)
);
wp_enqueue_script('pdc_custom_script');
wp_enqueue_script('jquery');

wp_register_script(
'pdc_custom_script2', plugins_url('assets/bjqs-1.3.js', __FILE__)
);
wp_enqueue_script('pdc_custom_script2');

wp_register_style(
'pdc_custom_style', plugins_url('assets/bjqs.css', __FILE__)
);
wp_enqueue_style('pdc_custom_style');
wp_register_style(
'pdc_main_style', plugins_url('assets/pdc.css', __FILE__)
);
wp_enqueue_style('pdc_main_style');

wp_register_script(
'pdc_custom_script3', plugins_url('assets/jquery.validationEngine.js', __FILE__)
);
wp_enqueue_script('pdc_custom_script3');
wp_register_script(
'pdc_custom_script4', plugins_url('assets/jquery.validationEngine-en.js', __FILE__)
);
wp_enqueue_script('pdc_custom_script4');
wp_register_style(
'pdc_custom_style5', plugins_url('assets/validationEngine.jquery.css', __FILE__)
);
wp_enqueue_style('pdc_custom_style5');
}

add_action('admin_init', 'custom_fields_wp_pdc_coach');

//Function to attach metabox to related content type
function custom_fields_wp_pdc_coach() {
add_meta_box('pdc_coach_meta_box', 'PDC Coach Details', 'display_pdc_coach_meta_box', 'pdc_coach', 'side', 'high'
);
add_meta_box('pdc_camp_meta_box', 'PDC Camp Details', 'display_pdc_camp_meta_box', 'pdc_camp', 'normal', 'high'
);
add_meta_box('pdc_camp_meta_box_local', 'PDC Camp Local Contact Details', 'display_pdc_camp_meta_box_local', 'pdc_camp', 'side', 'high'
);
add_meta_box('pdc_venue_meta_box', 'PDC Venue Details', 'display_pdc_venue_meta_box', 'pdc_venue', 'side', 'high'
);
add_meta_box('pdc_player_meta_box', 'PDC Player Details', 'display_pdc_player_meta_box', 'pdc_player', 'normal', 'high'
);

}

//Display custom fields of player in admin section
function display_pdc_player_meta_box($post) {

$fname = get_post_meta($post->ID, 'fname', true);
$lname = get_post_meta($post->ID, 'lname', true);
$dtphone = get_post_meta($post->ID, 'dtphone', true);
$evphone = get_post_meta($post->ID, 'evphone', true);
$emailadd1 = get_post_meta($post->ID, 'emailadd1', true);
$add1 = get_post_meta($post->ID, 'add1', true);
$camp_city = get_post_meta($post->ID, 'camp_city', true);
$camp_state = get_post_meta($post->ID, 'camp_state', true);
$zip = get_post_meta($post->ID, 'zip', true);

$emailadd2 = get_post_meta($post->ID, 'emailadd2', true);
$add2 = get_post_meta($post->ID, 'add2', true);
$camp_city2 = get_post_meta($post->ID, 'camp_city2', true);
$camp_state2 = get_post_meta($post->ID, 'camp_state2', true);
$zip2 = get_post_meta($post->ID, 'zip2', true);
$age_on_pdc = get_post_meta($post->ID, 'age_on_pdc', true);
$birthday = get_post_meta($post->ID, 'birthday', true);
$grade = get_post_meta($post->ID, 'grade', true);
$gender = get_post_meta($post->ID, 'gender', true);

$school = get_post_meta($post->ID, 'school', true);
$ttprog = get_post_meta($post->ID, 'ttprog', true);
$shirt_size = get_post_meta($post->ID, 'shirt_size', true);
$promocode = get_post_meta($post->ID, 'promocode', true);
$fb_page = get_post_meta($post->ID, 'fb_page', true);
$twitter_page = get_post_meta($post->ID, 'twitter_page', true);
$yt_page = get_post_meta($post->ID, 'yt_page', true);
$hw_hr_pdc = get_post_meta($post->ID, 'hw_hr_pdc', true);
$parent_name = get_post_meta($post->ID, 'parent_name', true);
$parent_phone = get_post_meta($post->ID, 'parent_phone', true);
$family_phy = get_post_meta($post->ID, 'family_phy', true);
$phy_phone = get_post_meta($post->ID, 'phy_phone', true);
$med_ins_comp = get_post_meta($post->ID, 'med_ins_comp', true);
$policy_number = get_post_meta($post->ID, 'policy_number', true);
$policy_holder_name = get_post_meta($post->ID, 'policy_holder_name', true);
$camp_id = get_post_meta($post->ID, 'camp_id', true);
$player_status = get_post_meta($post->ID, 'player_status', true);

?>
<table class="form-table">

<tr valign="top">  
<th scope="row"><label for="policy_holder_name" ><?php echo( __('Camp List') . ':' ); ?> </label></th>
<td  ><select name="camp_id" id="camp_id" style="width:135px;">
<?php
$my_loop = new WP_Query(array('post_type' => 'pdc_camp', 'posts_per_page' => -1));
while ($my_loop->have_posts()) : $my_loop->the_post();
$title = get_the_title();
$id = get_the_ID();
?>
<option value="<?php echo $id ?>" <?php selected($camp_id, $id); ?>><?php echo $title ?></option>
<?php
endwhile;
?>
</select>
<?php
wp_reset_query();?></td>

<?php

if($_REQUEST['action']=='edit'){
$camp_detail= new WP_Query( array( 'post_type' => 'pdc_camp', 'post__in' => array( $camp_id) ) );
while ( $camp_detail->have_posts() ) {
$camp_detail->the_post();?>


<td >
<div class="Birminghamblock Relative">
<p><em><strong><u><?php echo get_the_title();?></u> <br /><?php echo date('M d, Y',get_post_meta(get_the_ID(),'pdc_camp_start_date',true))?></strong></em><br />

<?php  
$camp_venue = get_post_meta(get_the_ID(),'pdc_camp_venue',true);

echo (trim(get_the_title($camp_venue))!='')? '<strong>'.get_the_title($camp_venue).'</strong><br />':'';?>
<?php echo (trim(get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ))!='')? wordwrap(get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ),55,'<br>').',<br />':'';?>

<?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_city', true ))!='')?getCityName(get_post_meta( $camp_venue, 'pdc_venue_city', true )).',':'';?>

<?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_state', true ))!='')?' '.getStateName(get_post_meta( $camp_venue, 'pdc_venue_state', true )).',':'';?>

<?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_zip', true ))!='')?' '.get_post_meta( $camp_venue, 'pdc_venue_zip', true ):'';?></p>
<p><strong>Cost $<?php echo get_post_meta($camp_id,'pdc_camp_fees',true);?></strong></p>
</div>
</td>
<td><?php echo get_the_post_thumbnail(get_the_ID(),'thumbnail');?></td>
<?php } wp_reset_query();}
?>



</tr>

<tr valign="top">  
<th scope="row" colspan="4"><strong>Player's Contact Information</strong>
</th>



</tr>
<tr valign="top">
<th scope="row"><label for="fname" ><?php echo( __('First Name') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="fname" value="<?php echo esc_attr($fname); ?>"/></td>

<th scope="row"><label for="lname" ><?php echo( __('Last Name') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="lname" value="<?php echo esc_attr($lname); ?>"/></td>
</tr>
<tr valign="top">
<th scope="row"><label for="dtphone" ><?php echo( __('Daytime Phone') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="dtphone" value="<?php echo esc_attr($dtphone); ?>"/></td>

<th scope="row"><label for="evphone" ><?php echo( __('Evening Phone') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="evphone" value="<?php echo esc_attr($evphone); ?>"/></td>
</tr>
<tr valign="top">
<th scope="row"><label for="emailadd1" ><?php echo( __('Email Address 1') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="emailadd1" value="<?php echo esc_attr($emailadd1); ?>"/></td>

<th scope="row"><label for="add1" ><?php echo( __('Address 1') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="add1" value="<?php echo esc_attr($add1); ?>"/></td>
</tr>
<tr valign="top">
<th scope="row"><label for="camp_city" ><?php echo( __('City') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="camp_city" value="<?php echo esc_attr($camp_city); ?>"/></td>

<th scope="row"><label for="camp_state" ><?php echo( __('State') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="camp_state" value="<?php echo esc_attr($camp_state); ?>"/></td>
</tr>
<tr valign="top">
<th scope="row"><label for="zip" ><?php echo( __('Zip') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="zip" value="<?php echo esc_attr($zip); ?>"/></td>
<th scope="row">&nbsp;</th>
<td>&nbsp;</td>
</tr>
<tr valign="top">
<th scope="row"><label for="emailadd2" ><?php echo( __('Email Address 2') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="emailadd2" value="<?php echo esc_attr($emailadd2); ?>"/></td>

<th scope="row"><label for="add2" ><?php echo( __('Address 2') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="add2" value="<?php echo esc_attr($add2); ?>"/></td>
</tr>
<tr valign="top">  
<th scope="row"><label for="camp_city2" ><?php echo( __('City') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="camp_city2" value="<?php echo esc_attr($camp_city2); ?>"/></td>

<th scope="row"><label for="camp_state2" ><?php echo( __('State') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="camp_state2" value="<?php echo esc_attr($camp_state2); ?>"/></td>
</tr>
<tr valign="top"> 
<th scope="row"><label for="zip2" ><?php echo( __('Zip') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="zip2" value="<?php echo esc_attr($zip2); ?>"/></td>
<th scope="row">&nbsp;</th>
<td>&nbsp;</td>
</tr> 
<tr valign="top">  
<th scope="row" colspan="4"><strong>Personal Information</strong>
</th>



</tr>

<th scope="row"><label for="age_on_pdc" ><?php echo( __('Age on Day of PDC') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="age_on_pdc" value="<?php echo esc_attr($age_on_pdc); ?>"/></td>

<th scope="row"><label for="birthday" ><?php echo( __('Birthday') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="birthday" value="<?php echo esc_attr($birthday); ?>"/></td>
</tr>
<tr valign="top">  
<th scope="row"><label for="grade" ><?php echo( __('Grade On Day Of PDC') . ':' ); ?> </label></th>
<td><select name="grade" >
<option value="">-Grade-</option>
<option value="5th" <?php if ($grade == '5th') echo 'selected="selected"' ?>>-5th-</option>
<option value="6th" <?php if ($grade == '6th') echo 'selected="selected"' ?>>-6th-</option>
<option value="7th" <?php if ($grade == '7th') echo 'selected="selected"' ?>>-7th-</option>
<option value="8th" <?php if ($grade == '8th') echo 'selected="selected"' ?>>-8th-</option>
<option value="9th" <?php if ($grade == '9th') echo 'selected="selected"' ?>>-9th-</option>
<option value="other" <?php if ($grade == 'other') echo 'selected="selected"' ?>>-Other-</option>
</select>
</td>

<th scope="row"><label for="gender" ><?php echo( __('Gender') . ':' ); ?> </label></th>
<td><select name="gender" >
<option value="">-Grade-</option>
<option value="m" <?php if ($gender == 'm') echo 'selected="selected"' ?>>-Male-</option>
<option value="f" <?php if ($gender == 'f') echo 'selected="selected"' ?>>-Female-</option>

</select>
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="school" ><?php echo( __('School') . ':' ); ?> </label></th>
<td colspan="3"><input size="130" name="school" value="<?php echo esc_attr($school); ?>"/></td>


</tr>
<tr valign="top">  
<th scope="row"><label for="ttprog" ><?php echo( __('Travel Team Program') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="ttprog" value="<?php echo esc_attr($ttprog); ?>"/></td>

<th scope="row"><label for="shirt_size" ><?php echo( __('Shirt Size') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="shirt_size" value="<?php echo esc_attr($shirt_size); ?>"/></td>
</tr>
<tr valign="top">  
<th scope="row"><label for="promocode" ><?php echo( __('Promotional Code') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="promocode" value="<?php echo esc_attr($promocode); ?>"/></td>

<th scope="row"><label for="hw_hr_pdc" ><?php echo( __('How did you hear about PDC?') . ':' ); ?> </label></th>
<td><select  name="hw_hr_pdc" >
<option value="">-Select-</option>
<option value="Internet" <?php if ($hw_hr_pdc == 'Internet') echo 'selected="selected"' ?>>-Internet-</option>
<option value="Coach" <?php if ($hw_hr_pdc == 'Coach') echo 'selected="selected"' ?>>-Coach-</option>
<option value="Friend" <?php if ($hw_hr_pdc == 'Friend') echo 'selected="selected"' ?>>-Friend-</option>
<option value="School" <?php if ($hw_hr_pdc == 'School') echo 'selected="selected"' ?>>-School-</option>
<option value="Other" <?php if ($hw_hr_pdc == 'Other') echo 'selected="selected"' ?>>-Other-</option>
</select></td>
</tr>
<tr valign="top">
<th scope="row"><label for="fb_page" ><?php echo( __('Facebook Page') . ':' ); ?> </label></th>
<td colspan="3"><input size="130" name="fb_page" value="<?php echo esc_attr($fb_page); ?>"/></td>
</tr>
<tr valign="top">  
<th scope="row"><label for="twitter_page" ><?php echo( __('Twitter Page') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="twitter_page" value="<?php echo esc_attr($twitter_page); ?>"/></td>

<th scope="row"><label for="yt_page" ><?php echo( __('YouTube Page') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="yt_page" value="<?php echo esc_attr($yt_page); ?>"/></td>
</tr>
<tr valign="top">  
<th scope="row" colspan="4"><strong>Medical Information<br />
Emergency name and phone number to be used in the event of an injury that requires emergency treatment.</strong>
</th>
</tr>
<tr valign="top">  
<th scope="row"><label for="parent_name" ><?php echo( __('Parent/Guardian') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="parent_name" value="<?php echo esc_attr($parent_name); ?>"/></td>

<th scope="row"><label for="parent_phone" ><?php echo( __('Parent\'s Phone') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="parent_phone" value="<?php echo esc_attr($parent_phone); ?>"/></td>
</tr>
<tr valign="top">  
<th scope="row"><label for="family_phy" ><?php echo( __('Family Physician') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="family_phy" value="<?php echo esc_attr($family_phy); ?>"/></td>

<th scope="row"><label for="phy_phone" ><?php echo( __('Physician Phone') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="phy_phone" value="<?php echo esc_attr($phy_phone); ?>"/></td>
</tr>
<tr valign="top">  
<th scope="row"><label for="med_ins_comp" ><?php echo( __('Medical Insurance Co.') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="med_ins_comp" value="<?php echo esc_attr($med_ins_comp); ?>"/></td>

<th scope="row"><label for="policy_number" ><?php echo( __('Policy Number') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="policy_number" value="<?php echo esc_attr($policy_number); ?>"/></td>
</tr>
<tr valign="top">  
<th scope="row"><label for="policy_holder_name" ><?php echo( __('Policy Holder Name') . ':' ); ?> </label></th>
<td><input maxlength="32" size="20" name="policy_holder_name" value="<?php echo esc_attr($policy_holder_name); ?>"/></td>

<th scope="row"><label for="player_status" ><?php echo( __('Player Status') . ':' ); ?> </label></th>
<td><input type="radio" name="player_status" value="1" <?php checked($player_status, '1'); ?>  />
Active&nbsp;&nbsp;
<input type="radio" name="player_status" value="0" <?php checked($player_status, '0'); ?> />
Suspended </td>
</tr></table>
<?php
}

//Display custom fields of coach in admin section
function display_pdc_coach_meta_box($post) {
// Retrieve current name of the Director and Movie Rating based on review ID
$pdc_coach_email = ( get_post_meta($post->ID, 'pdc_coach_email', true) );
$pdc_coach_designation = ( get_post_meta($post->ID, 'pdc_coach_designation', true) );
?>
<table>
<tr>
<th style="width: 30%">Coach Email:</th>
<td><input type="text" name="pdc_coach_email" id="pdc_coach_email" value="<?php echo $pdc_coach_email ?>"/>
</td>
</tr>
<tr>
<th style="width: 30%">Designation:</th>
<td><input type="text" name="pdc_coach_designation" id="pdc_coach_designation" value="<?php echo $pdc_coach_designation ?>"/>
</td>
</tr>
</table>
<?php
}

//Save custom fields of player in admin section
add_action('save_post', 'add_pdc_player_fields', 10, 2);

function add_pdc_player_fields($post_id) {
// Bail if we're doing an auto save
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
return;
// if our current user can't edit this post, bail
if (!current_user_can('edit_post'))
return;
// Check post type for movie reviews

if (get_post_type($post_id) == 'pdc_player') {
// Store data in post meta table if present in post data

update_post_meta($post_id, 'fname', $_POST['fname']);
update_post_meta($post_id, 'lname', $_POST['lname']);
update_post_meta($post_id, 'dtphone', $_POST['dtphone']);
update_post_meta($post_id, 'evphone', $_POST['evphone']);
update_post_meta($post_id, 'emailadd1', $_POST['emailadd1']);
update_post_meta($post_id, 'add1', $_POST['add1']);
update_post_meta($post_id, 'camp_city', $_POST['camp_city']);
update_post_meta($post_id, 'camp_state', $_POST['camp_state']);
update_post_meta($post_id, 'zip', $_POST['zip']);
update_post_meta($post_id, 'emailadd2', $_POST['emailadd2']);
update_post_meta($post_id, 'add2', $_POST['add2']);
update_post_meta($post_id, 'camp_city2', $_POST['camp_city2']);
update_post_meta($post_id, 'camp_state2', $_POST['camp_state2']);
update_post_meta($post_id, 'zip2', $_POST['zip2']);
update_post_meta($post_id, 'age_on_pdc', $_POST['age_on_pdc']);
update_post_meta($post_id, 'birthday', $_POST['birthday']);
update_post_meta($post_id, 'grade', $_POST['grade']);
update_post_meta($post_id, 'gender', $_POST['gender']);
update_post_meta($post_id, 'school', $_POST['school']);
update_post_meta($post_id, 'ttprog', $_POST['ttprog']);
update_post_meta($post_id, 'shirt_size', $_POST['shirt_size']);
update_post_meta($post_id, 'promocode', $_POST['promocode']);
update_post_meta($post_id, 'fb_page', $_POST['fb_page']);
update_post_meta($post_id, 'twitter_page', $_POST['twitter_page']);
update_post_meta($post_id, 'yt_page', $_POST['yt_page']);
update_post_meta($post_id, 'hw_hr_pdc', $_POST['hw_hr_pdc']);
update_post_meta($post_id, 'parent_name', $_POST['parent_name']);
update_post_meta($post_id, 'parent_phone', $_POST['parent_phone']);
update_post_meta($post_id, 'family_phy', $_POST['family_phy']);
update_post_meta($post_id, 'phy_phone', $_POST['phy_phone']);
update_post_meta($post_id, 'med_ins_comp', $_POST['med_ins_comp']);
update_post_meta($post_id, 'policy_number', $_POST['policy_number']);
update_post_meta($post_id, 'policy_holder_name', $_POST['policy_holder_name']);
update_post_meta($post_id, 'camp_id', $_POST['camp_id']);
update_post_meta($post_id, 'player_status', $_POST['player_status']);
}
}

//Save custom fields of coach in admin section
add_action('save_post', 'add_pdc_coach_fields', 10, 2);

function add_pdc_coach_fields($post_id) {
// Bail if we're doing an auto save
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
return;
// if our current user can't edit this post, bail
if (!current_user_can('edit_post'))
return;
// Check post type for movie reviews

if (get_post_type($post_id) == 'pdc_coach') {
// Store data in post meta table if present in post data
if (isset($_POST['pdc_coach_email']) && $_POST['pdc_coach_email'] != '') {
update_post_meta($post_id, 'pdc_coach_email', $_POST['pdc_coach_email']);
}
if (isset($_POST['pdc_coach_designation']) && $_POST['pdc_coach_designation'] != '') {
update_post_meta($post_id, 'pdc_coach_designation', $_POST['pdc_coach_designation']);
}
}
}

//Display custom fields of camp in admin section
function display_pdc_camp_meta_box($post) {
// Retrieve current name of the Director and Movie Rating based on review ID
$pdc_camp_fees = ( get_post_meta($post->ID, 'pdc_camp_fees', true) );
$pdc_camp_start_date = ( get_post_meta($post->ID, 'pdc_camp_start_date', true) );
$pdc_camp_end_date = ( get_post_meta($post->ID, 'pdc_camp_end_date', true) );
$pdc_camp_start_time = ( get_post_meta($post->ID, 'pdc_camp_start_time', true) );
$pdc_camp_end_time = ( get_post_meta($post->ID, 'pdc_camp_end_time', true) );
$pdc_camp_venue = ( get_post_meta($post->ID, 'pdc_camp_venue', true) );
$pdc_camp_coach = ( get_post_meta($post->ID, 'pdc_camp_coach', true) );

$pdc_camp_website = ( get_post_meta($post->ID, 'pdc_camp_website', true) );
$pdc_camp_age_group = ( get_post_meta($post->ID, 'pdc_camp_age_group', true) );
$pdc_camp_for_gender = ( get_post_meta($post->ID, 'pdc_camp_for_gender', true) );
$pdc_camp_max_enrolment = ( get_post_meta($post->ID, 'pdc_camp_max_enrolment', true) );
$pdc_camp_status = ( get_post_meta($post->ID, 'pdc_camp_status', true) );
?>

<table>
<tr>
<th style="width: 30%">Camp Fees($):</th>
<td><input type="text" name="pdc_camp_fees" id="pdc_camp_fees" value="<?php echo $pdc_camp_fees ?>"/>
</td>
</tr>
<tr>
<th style="width: 150px">Start Date:</th>
<td><input type="text" name="pdc_camp_start_date" id="pdc_camp_start_date" value="<?php echo date('m-d-Y', $pdc_camp_start_date) ?>"/>
<img src="<?php echo plugins_url('assets/icon_calendar.jpg', __FILE__); ?>" alt="" onclick="javascript:NewCssCal('pdc_camp_start_date','MMddyyyy','dropdown',false,'24')" style="cursor:pointer"/> </td>
</tr>
<tr>
<th style="width: 150px">End Date:</th>
<td><input type="text" name="pdc_camp_end_date" id="pdc_camp_end_date" value="<?php echo date('m-d-Y', $pdc_camp_end_date) ?>"/>
<img src="<?php echo plugins_url('assets/icon_calendar.jpg', __FILE__); ?>" alt="" onclick="javascript:NewCssCal('pdc_camp_end_date','MMddyyyy','dropdown',false,'24')" style="cursor:pointer"/> </td>
</tr>
<tr>
<th valign="top">Start Time:</th>
<td><?php
/* ?> <input type="text" name="camp_time" id="camp_time" value="<?php echo $camp_info->camp_time?>"/><?php */
$camp_start_time = $pdc_camp_start_time;
$arrTime = explode(":", $camp_start_time);
$camp_start_time_h = $arrTime[0];
$arrTime2 = explode(" ", $arrTime[1]);
$camp_start_time_s = $arrTime2[0];
$camp_start_time_ap = $arrTime2[1];
?>
<select id="camp_start_time_h" name="camp_start_time_h" >
<option value="">-Select-</option>
<?php
for ($i = 1; $i <= 12; $i++) {
if ($i < 10) {
?>
<option value="<?php echo "0" . $i; ?>" <?php selected("0" . $i, $camp_start_time_h); ?>><?php echo "0" . $i; ?></option>
<?php } else { ?>
<option value="<?php echo $i; ?>" <?php selected($i, $camp_start_time_h); ?>><?php echo $i; ?></option>
<?php
}
}
?>
</select>
<select id="camp_start_time_s" name="camp_start_time_s" >
<option value="">-Select-</option>
<option value="00" <?php selected('00', $camp_start_time_s); ?>>00</option>
<option value="15" <?php selected('15', $camp_start_time_s); ?>>15</option>
<option value="30" <?php selected('30', $camp_start_time_s); ?>>30</option>
<option value="45" <?php selected('45', $camp_start_time_s); ?>>45</option>
</select>
<select id="camp_start_time_ap" name="camp_start_time_ap">
<option value="AM" <?php selected('AM', $camp_start_time_ap); ?> >AM</option>
<option value="PM" <?php selected('PM', $camp_start_time_ap); ?>>PM</option>
</select>
</td>
</tr>
<tr>
<th valign="top">End Time:</th>
<td><?php
$camp_end_time = $pdc_camp_end_time;
$arrEndTime = explode(":", $camp_end_time);
$camp_end_time_h = $arrEndTime[0];
$arrEndTime2 = explode(" ", $arrEndTime[1]);
$camp_end_time_s = $arrEndTime2[0];
$camp_end_time_ap = $arrEndTime2[1];
?>
<select id="camp_end_time_h" name="camp_end_time_h" >
<option value="">-Select-</option>
<?php
for ($i = 1; $i <= 12; $i++) {
if ($i < 10) {
?>
<option value="<?php echo "0" . $i; ?>" <?php selected("0" . $i, $camp_end_time_h); ?>><?php echo "0" . $i; ?></option>
<?php } else { ?>
<option value="<?php echo $i; ?>" <?php selected($i, $camp_end_time_h); ?>><?php echo $i; ?></option>
<?php
}
}
?>
</select>
<select id="camp_end_time_s" name="camp_end_time_s" >
<option value="">-Select-</option>
<option value="00" <?php selected('00', $camp_end_time_s); ?>>00</option>
<option value="15"  <?php selected('15', $camp_end_time_s); ?>>15</option>
<option value="30" <?php selected('30', $camp_end_time_s); ?>>30</option>
<option value="45" <?php selected('45', $camp_end_time_s); ?>>45</option>
</select>
<select id="camp_end_time_ap" name="camp_end_time_ap">
<option value="AM" <?php selected('AM', $camp_end_time_ap); ?>>AM</option>
<option value="PM" <?php selected('PM', $camp_end_time_ap); ?>>PM</option>
</select>
</td>
</tr>
<tr>
<th valign="top">Camp Venue:</th>
<td>
<?php
$my_loop = new WP_Query(array('post_type' => 'pdc_venue', 'posts_per_page' => -1));
if($my_loop->have_posts()):
?>
<select name="pdc_camp_venue" id="pdc_camp_venue" style="width:135px;">
<?php

while ($my_loop->have_posts()) : $my_loop->the_post();
$title = get_the_title();
$id = get_the_ID();
?>
<option value="<?php echo $id ?>" <?php selected($pdc_camp_venue, $id); ?>><?php echo $title ?></option>
<?php
endwhile;
?>
</select>
<?php
else:
echo'<a href="'.admin_url('post-new.php?post_type=pdc_venue').'">Click here to add venue.</a>';
endif;
wp_reset_query();
?>
</td>
</tr>
<tr>
<th valign="top">Camp Coach:</th>
<td>
<?php
$my_loop = new WP_Query(array('post_type' => 'pdc_coach', 'posts_per_page' => -1));
if($my_loop->have_posts()):
?>
<select name="pdc_camp_coach" id="pdc_camp_coach" style="width:135px;">
<?php
while ($my_loop->have_posts()) : $my_loop->the_post();
$title = get_the_title();
$id = get_the_ID();
?>
<option value="<?php echo $id ?>" <?php selected($pdc_camp_coach, $id); ?>><?php echo $title ?></option>
<?php
endwhile;
?>
</select>
<?php
else:
echo'<a href="'.admin_url('post-new.php?post_type=pdc_coach&redirect_to=http://localhost/wordpress/wp-admin/post-new.php?post_type=pdc_camp').'">Click here to add coach.</a>';
endif;
wp_reset_query();
?>
</td>
</tr>
<tr>
<th style="width: 150px">Camp Website:</th>
<td><input type="text" name="pdc_camp_website" id="pdc_camp_website" value="<?php echo ($pdc_camp_website) ?>"  />
</td>
</tr>
<tr>
<th style="width: 150px">Camp Age Group:</th>
<td><input type="text" name="pdc_camp_age_group" id="pdc_camp_age_group" value="<?php echo ($pdc_camp_age_group) ?>"  />
&nbsp;<small>ex: (16 - 17 Grade)</small> </td>
</tr>
<tr>
<th style="width: 150px">Camp for Gender:</th>
<td><select name="pdc_camp_for_gender" id="pdc_camp_for_gender">
<option value="m" <?php selected($pdc_camp_for_gender, 'm'); ?>>Boys only</option>
<option value="f" <?php selected($pdc_camp_for_gender, 'f'); ?>>Girls only</option>
<option value="co-ed" <?php selected($pdc_camp_for_gender, 'co-ed'); ?>>Co-Ed</option>
</select>
</td>
</tr>
<tr>
<th style="width: 150px">Camp Max Enrollment:</th>
<td><input type="text" name="pdc_camp_max_enrolment" id="pdc_camp_max_enrolment" value="<?php echo ($pdc_camp_max_enrolment) ?>"  />
&nbsp;<small> (0 means unlimited enrollment.)</small><br />
(Current Enrollments: <strong><?php echo get_current_enrollment(get_the_ID()); ?></strong>) </td>
</tr>
<tr>
<th style="width: 150px">Camp Status:</th>
<td><input type="radio" name="pdc_camp_status" value="1" <?php checked($pdc_camp_status, '1'); ?>  />
Active&nbsp;&nbsp;
<input type="radio" name="pdc_camp_status" value="0" <?php checked($pdc_camp_status, '0'); ?> />
Inactive </td>
</tr>
</table>
<?php
}

 
//Display custom fields of camp in admin section
function display_pdc_camp_meta_box_local($post) {
// Retrieve current name of the Director and Movie Rating based on review ID

$pdc_camp_lcn = ( get_post_meta($post->ID, 'pdc_camp_lcn', true) );
$pdc_camp_lct = ( get_post_meta($post->ID, 'pdc_camp_lct', true) );
$pdc_camp_lce = ( get_post_meta($post->ID, 'pdc_camp_lce', true) );
$pdc_camp_lca = ( get_post_meta($post->ID, 'pdc_camp_lca', true) );
$pdc_camp_lc_state = ( get_post_meta($post->ID, 'pdc_camp_lc_state', true) );
$pdc_camp_lc_city = ( get_post_meta($post->ID, 'pdc_camp_lc_city', true) );
$pdc_camp_lc_zip = ( get_post_meta($post->ID, 'pdc_camp_lc_zip', true) );
?>
<table>
<tr>
<th style="width: 150px">Name:</th>
<td><input type="text" name="pdc_camp_lcn" id="pdc_camp_lcn" value="<?php echo ($pdc_camp_lcn) ?>"  />
</td>
</tr>
<tr>
<th style="width: 150px">Telephone:</th>
<td><input type="text" name="pdc_camp_lct" id="pdc_camp_lct" value="<?php echo ($pdc_camp_lct) ?>"  />
</td>
</tr>
<tr>
<th style="width: 150px">Email:</th>
<td><input type="text" name="pdc_camp_lce" id="pdc_camp_lce" value="<?php echo ($pdc_camp_lce) ?>"  />
</td>
</tr>
<tr>
<th style="width: 150px"> Address:</th>
<td><input type="text" name="pdc_camp_lca" id="pdc_camp_lca" value="<?php echo ($pdc_camp_lca) ?>"  />
</td>
</tr>
<tr>
<th style="width: 150px">State:</th>
<td><?php
stateDrpDown_normal('pdc_camp_lc_state', 'pdc_camp_lc_state', 0, array('0' => $pdc_camp_lc_state));
?>
</td>
</tr>
<tr>
<th style="width: 150px">City:</th>
<td><?php
cityDrpDown('pdc_camp_lc_city', 'pdc_camp_lc_city', 0, array('0' => $pdc_camp_lc_city));
?>
</td>
</tr>
<tr>
<th style="width: 150px">Zip:</th>
<td><input type="text" name="pdc_camp_lc_zip" id="pdc_camp_lc_zip" value="<?php echo ($pdc_camp_lc_zip) ?>"  />
</td>
</tr>
</table>
<?php
}


// Add custom column in listing of camp in admin 
add_filter('manage_pdc_camp_posts_columns', 'total_enrollment_column');
add_action('manage_pdc_camp_posts_custom_column', 'total_enrollment_column_data', 10, 2);

// ADD NEW COLUMN  
function total_enrollment_column($defaults) {
unset($defaults['date']);
$defaults['total_enrollments'] = 'Enrollments (Current/Total)';
$defaults['camp_status'] = 'Camp Status';
$defaults['camp_start_date'] = 'Camp Start Date';
return $defaults;
}

// SHOW THE FEATURED IMAGE  
function total_enrollment_column_data($column_name, $post_ID) {
if ($column_name == 'total_enrollments') {

echo'	 <strong>' . get_current_enrollment($post_ID) . '</strong> / ' . get_post_meta($post_ID, 'pdc_camp_max_enrolment', true);
if (!check_camp_registration($post_ID)) {
echo '<br><strong>(CAMP FULL)</strong>';
}
}

if ($column_name == 'camp_status') {

echo (get_post_meta($post_ID, 'pdc_camp_status', true) == '1') ? 'Active' : 'Inactive';
}
if ($column_name == 'camp_start_date') {

echo date('l, M d Y', get_post_meta($post_ID, 'pdc_camp_start_date', true));
}
}

//Save custom fields of camp in admin section
add_action('save_post', 'add_pdc_camp_fields', 10, 2);
 
function add_pdc_camp_fields($post_id) {
// Bail if we're doing an auto save
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
return;
// if our current user can't edit this post, bail
if (!current_user_can('edit_post'))
return;
// Check post type for movie reviews

if (get_post_type($post_id) == 'pdc_camp') {
// Store data in post meta table if present in post data
if (isset($_POST['pdc_camp_fees']) && $_POST['pdc_camp_fees'] != '') {
update_post_meta($post_id, 'pdc_camp_fees', $_POST['pdc_camp_fees']);
}
if (isset($_POST['pdc_camp_start_date']) && $_POST['pdc_camp_start_date'] != '') {

$date2_arr = explode(' ', $_POST['pdc_camp_start_date']);
$date_arr = explode('-', $date2_arr[0]);
$camp_start_date = mktime('0', '0', '0', $date_arr[0], $date_arr[1], $date_arr[2]);


update_post_meta($post_id, 'pdc_camp_start_date', $camp_start_date);
}
if (isset($_POST['pdc_camp_end_date']) && $_POST['pdc_camp_end_date'] != '') {
$date2_arr2 = explode(' ', $_POST['pdc_camp_end_date']);
$date_arr2 = explode('-', $date2_arr2[0]);
$camp_end_date = mktime('0', '0', '0', $date_arr2[0], $date_arr2[1], $date_arr2[2]);

update_post_meta($post_id, 'pdc_camp_end_date', $camp_end_date);
}
if (isset($_POST['camp_start_time_h']) && $_POST['camp_start_time_h'] != '') {
$camp_start_time_h = $_POST['camp_start_time_h'];
$camp_start_time_s = $_POST['camp_start_time_s'];
$camp_start_time_ap = $_POST['camp_start_time_ap'];

$camp_start_time = $camp_start_time_h . ":" . $camp_start_time_s . " " . $camp_start_time_ap;


update_post_meta($post_id, 'pdc_camp_start_time', $camp_start_time);
}
if (isset($_POST['camp_end_time_h']) && $_POST['camp_end_time_h'] != '') {
$camp_end_time_h = $_POST['camp_end_time_h'];
$camp_end_time_s = $_POST['camp_end_time_s'];
$camp_end_time_ap = $_POST['camp_end_time_ap'];
$camp_end_time = $camp_end_time_h . ":" . $camp_end_time_s . " " . $camp_end_time_ap;

update_post_meta($post_id, 'pdc_camp_end_time', $camp_end_time);
}
if (isset($_POST['pdc_camp_venue'])) {
update_post_meta($post_id, 'pdc_camp_venue', $_POST['pdc_camp_venue']);
}
if (isset($_POST['pdc_camp_coach'])) {
update_post_meta($post_id, 'pdc_camp_coach', $_POST['pdc_camp_coach']);
}
if (isset($_POST['pdc_camp_website'])) {
update_post_meta($post_id, 'pdc_camp_website', $_POST['pdc_camp_website']);
}
if (isset($_POST['pdc_camp_age_group'])) {
update_post_meta($post_id, 'pdc_camp_age_group', $_POST['pdc_camp_age_group']);
}
if (isset($_POST['pdc_camp_for_gender'])) {
update_post_meta($post_id, 'pdc_camp_for_gender', $_POST['pdc_camp_for_gender']);
}
if (isset($_POST['pdc_camp_max_enrolment'])) {
update_post_meta($post_id, 'pdc_camp_max_enrolment', $_POST['pdc_camp_max_enrolment']);
}
if (isset($_POST['pdc_camp_status'])) {
update_post_meta($post_id, 'pdc_camp_status', $_POST['pdc_camp_status']);
}
if (isset($_POST['pdc_camp_lcn'])) {
update_post_meta($post_id, 'pdc_camp_lcn', $_POST['pdc_camp_lcn']);
}
if (isset($_POST['pdc_camp_lct'])) {
update_post_meta($post_id, 'pdc_camp_lct', $_POST['pdc_camp_lct']);
}
if (isset($_POST['pdc_camp_lce'])) {
update_post_meta($post_id, 'pdc_camp_lce', $_POST['pdc_camp_lce']);
}
if (isset($_POST['pdc_camp_lca'])) {
update_post_meta($post_id, 'pdc_camp_lca', $_POST['pdc_camp_lca']);
}
if (isset($_POST['pdc_camp_lc_city'])) {
update_post_meta($post_id, 'pdc_camp_lc_city', $_POST['pdc_camp_lc_city']);
}
if (isset($_POST['pdc_camp_lc_state'])) {
update_post_meta($post_id, 'pdc_camp_lc_state', $_POST['pdc_camp_lc_state']);
}
if (isset($_POST['pdc_camp_lc_zip'])) {
update_post_meta($post_id, 'pdc_camp_lc_zip', $_POST['pdc_camp_lc_zip']);
}

if (isset($_POST['camp_image_gallery'])) {
update_post_meta($post_id, 'camp_image_gallery', $_POST['camp_image_gallery']);
}
}
}

 

//Display custom fields of venue in admin section
function display_pdc_venue_meta_box($post) {
// Retrieve current name of the Director and Movie Rating based on review ID
$wp_pdc_venue_address = ( get_post_meta($post->ID, 'wp_pdc_venue_address', true) );
$pdc_venue_state = ( get_post_meta($post->ID, 'pdc_venue_state', true) );
$pdc_venue_city = ( get_post_meta($post->ID, 'pdc_venue_city', true) );
$pdc_venue_zip = ( get_post_meta($post->ID, 'pdc_venue_zip', true) );
$pdc_venue_phone = ( get_post_meta($post->ID, 'pdc_venue_phone', true) );
$pdc_venue_contact_name = ( get_post_meta($post->ID, 'pdc_venue_contact_name', true) );
?>
<table>
<tr>
<th style="width: 30%">Address:</th>
<td><textarea rows="5" cols="30" name="wp_pdc_venue_address" id="wp_pdc_venue_address"><?php echo $wp_pdc_venue_address ?></textarea>
</td>
</tr>
<tr>
<th style="width: 150px">State:</th>
<td><?php
stateDrpDown_normal('pdc_venue_state', 'pdc_venue_state', 0, array('0' => $pdc_venue_state));
?>
</td>
</tr>
<tr>
<th style="width: 150px">City:</th>
<td><?php
cityDrpDown('pdc_venue_city', 'pdc_venue_city', 0, array('0' => $pdc_venue_city));
?>
</td>
</tr>
<tr>
<th style="width: 150px">Zip:</th>
<td><input type="text" name="pdc_venue_zip" id="pdc_venue_zip" value="<?php echo ($pdc_venue_zip) ?>"  />
</td>
</tr>
<tr>
<th style="width: 150px">Phone:</th>
<td><input type="text" name="pdc_venue_phone" id="pdc_venue_phone" value="<?php echo ($pdc_venue_phone) ?>"  />
</td>
</tr>
<tr>
<th style="width: 150px">Contact Name:</th>
<td><input type="text" name="pdc_venue_contact_name" id="pdc_venue_contact_name" value="<?php echo ($pdc_venue_contact_name) ?>"  />
</td>
</tr>
</table>
<?php
}

//Save custom fields of venue in admin section
add_action('save_post', 'add_pdc_venue_fields', 10, 2);

function add_pdc_venue_fields($post_id) {
// Bail if we're doing an auto save
if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
return;
// if our current user can't edit this post, bail
if (!current_user_can('edit_post'))
return;
// Check post type for movie reviews

if (get_post_type($post_id) == 'pdc_venue') { 
// Store data in post meta table if present in post data
if (isset($_POST['wp_pdc_venue_address'])) {
update_post_meta($post_id, 'wp_pdc_venue_address', $_POST['wp_pdc_venue_address']);
}
if (isset($_POST['pdc_venue_state'])) {
update_post_meta($post_id, 'pdc_venue_state', $_POST['pdc_venue_state']);
}
if (isset($_POST['pdc_venue_city'])) {
update_post_meta($post_id, 'pdc_venue_city', $_POST['pdc_venue_city']);
}
if (isset($_POST['pdc_venue_zip'])) {
update_post_meta($post_id, 'pdc_venue_zip', $_POST['pdc_venue_zip']);
}
if (isset($_POST['pdc_venue_phone'])) {
update_post_meta($post_id, 'pdc_venue_phone', $_POST['pdc_venue_phone']);
}
if (isset($_POST['pdc_venue_contact_name'])) {
update_post_meta($post_id, 'pdc_venue_contact_name', $_POST['pdc_venue_contact_name']);
}
}
}

//Add custom column in listing of venue in admin
add_filter('manage_pdc_venue_posts_columns', 'ST4_columns_head');
add_action('manage_pdc_venue_posts_custom_column', 'ST4_columns_content', 10, 2);

// ADD NEW COLUMN  
function ST4_columns_head($defaults) {
$defaults['pdc_city_state'] = 'City / State';
return $defaults;
}

// SHOW THE FEATURED IMAGE  
function ST4_columns_content($column_name, $post_ID) {
if ($column_name == 'pdc_city_state') {
$pdc_venue_state = ( get_post_meta($post_ID, 'pdc_venue_state', true) );
$pdc_venue_city = ( get_post_meta($post_ID, 'pdc_venue_city', true) );
echo getCityName($pdc_venue_city) . ' / ' . getStateName($pdc_venue_state);
}
}

 
/* * ******************STATE DROPDOWN******************************** */

function stateDrpDown_normal($name = 'state_drpdwn', $id = 'state_drpdwn', $multiple = 0, $selected_ids = array(), $exclude = array(), $useDefault = 0, $class = '') {
global $wpdb;
$data = $wpdb->get_results(("SELECT * FROM " . $wpdb->prefix . "pdc_state_manager order by state_title asc"));
?>
<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" <?php if ($multiple) { ?> multiple="multiple" size="6"<?php } ?>  <?php if ($class != "") { ?>class="<?php echo $class; ?>"<?php } ?> style="width:174px;" >
<?php
if ($useDefault != 0) {
echo'<option value="">-Select-</option>';
}
if (empty($data)) {
echo'<option value="0">No State</option>';
} else {
for ($i = 0; $i < count($data); $i++) {
if (!in_array($data[$i]->id, $exclude)) {
if (in_array($data[$i]->id, $selected_ids)) {
$select = 'selected="selected"';
} else {
$select = '';
}
echo'<option value="' . $data[$i]->id . '" ' . $select . '>' . $data[$i]->state_title . '</option>';
}
}
}
?>
</select>
<?php
}

/* * ******************CITY DROPDOWN******************************** */

function cityDrpDown($name = 'city_drpdwn', $id = 'city_drpdwn', $multiple = 0, $selected_ids = array(), $exclude = array(), $useDefault = 0, $class = '') {
global $wpdb;
$data = $wpdb->get_results(("SELECT * FROM " . $wpdb->prefix . "pdc_city_manager order by city_title asc"));
?>
<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" <?php if ($multiple) { ?> multiple="multiple" size="6"<?php } ?>  
<?php if ($class != "") { ?>class="<?php echo $class; ?>"<?php } ?> style="height:auto !important; width:200px;">
<?php
if ($useDefault != 0) {
echo'<option value="">-Select State-</option>';
}
if (empty($data)) {
echo'<option value="0">No City</option>';
} else {
for ($i = 0; $i < count($data); $i++) {
if (!in_array($data[$i]->id, $exclude)) {
if (in_array($data[$i]->id, $selected_ids)) {
$select = 'selected="selected"';
} else {
$select = '';
}
echo'<option value="' . $data[$i]->id . '" ' . $select . '>' . $data[$i]->city_title . '</option>';
}
}
}
?>
</select>
<?php
}

/* * ******************GET CITY NAME BY CITY ID******************************** */

function getCityName($ctId) {

global $wpdb;

$data = $wpdb->get_row(("SELECT * FROM " . $wpdb->prefix . "pdc_city_manager where id='" . $ctId . "'"));

//echo "SELECT * FROM ".$wpdb->prefix."state_manager where id='".$stId."'";

if (!empty($data)) {



return $data->city_title;
}
}

/* * ******************GET STATE NAME BY STATE ID******************************** */

function getStateName($stId) {

global $wpdb;

$data = $wpdb->get_row(("SELECT * FROM " . $wpdb->prefix . "pdc_state_manager where id='" . $stId . "'"));

//echo "SELECT * FROM ".$wpdb->prefix."state_manager where id='".$stId."'";

if (!empty($data)) {



return $data->state_title;
}
}

/* * ******************GET CURRENT ENROLLMENT IN A CAMP BY CAMP ID******************************** */

function get_current_enrollment($cid) {
global $wpdb;
if ($cid) {
$count_player=new WP_query('post_type=pdc_player&posts_per_page=-1&meta_key=camp_id&meta_value='.$cid);

$booked_seat = (int)$count_player->post_count;
wp_reset_query();
// $SQL = "select count(camp_id) as camp_count from " . $wpdb->prefix . "pdc_player_registration where camp_id=" . $cid;
// $sel = $wpdb->get_results(($SQL));
//$booked_seat = $sel[0]->camp_count;
return $booked_seat;
} else {
return '0';
}
}

/* * ******************CHECK CAMP AVAILABILITY FOR NEW REGISTRATION******************************** */
function check_camp_registration($cid) {
global $wpdb;
if ($cid) {
$total_seats = (int) get_post_meta($cid, 'pdc_camp_max_enrolment', true);
if ($total_seats > 0) {
//$SQL = "select count(camp_id) as camp_count from " . $wpdb->prefix . "pdc_player_registration where camp_id=" . $cid;
//$sel = $wpdb->get_results(($SQL));
//$booked_seat = (int) $sel[0]->camp_count;
$booked_seat = (int)get_current_enrollment($cid);
$available = $total_seats - $booked_seat;
if ($available > 0) {
return true;
} else {
return false;
}
} else {
return true;
}
} else {
return false;
}
}

/* * ******************GET CAMP DETAIL BY CAMP ID******************************** */
function Get_camp($cid = '', $maxRows = 0, $pageNum = 0) {
global $wpdb;
if ($cid == '') {
$Query = "Select * from " . $wpdb->prefix . "master_camp" . " where camp_status='1' order by camp_end desc";
if ($maxRows > 0) {
$startRow = $pageNum * $maxRows;
$Query = sprintf("%s LIMIT %d, %d", $Query, $startRow, $maxRows);
}
$select = $wpdb->get_results(($Query));
} else {
$Query = "Select * from " . $wpdb->prefix . "master_camp" . " where camp_id=" . $cid . " and camp_status='1'";
$select = $wpdb->get_row(($Query));
}
return $select;
}

function pdc_camp_details($atts) {

global $wpdb;
extract(shortcode_atts(array(
'campid' => ''
), $atts));

if (trim($campid) != '') {
$my_camp = new WP_Query(array('post_type' => 'pdc_camp', 'post__in' => array($campid)));

while ($my_camp->have_posts()) {
$my_camp->the_post();

$camp_venue = get_post_meta($campid, 'pdc_camp_venue', true);

$title = get_the_title();
$id = get_the_ID();
$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($campid), 'thumbnail');
$url = $thumb['0'];
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

<div class="Gameblog PadT15A">
<div class="Gameblogleft">
<h1><?php echo $title; ?> </h1>
<p><em><strong><?php echo date('M d, Y', get_post_meta($campid, 'pdc_camp_start_date', true)); ?></strong></em><br />
<?php echo (trim(get_the_title($camp_venue)) != '') ? '<strong>' . get_the_title($camp_venue) . '</strong><br />' : ''; ?> <?php echo (trim(get_post_meta($camp_venue, 'wp_pdc_venue_address', true)) != '') ? get_post_meta($camp_venue, 'wp_pdc_venue_address', true) . ',<br />' : ''; ?> <?php echo (trim(get_post_meta($camp_venue, 'pdc_venue_city', true)) != '') ? getCityName(get_post_meta($camp_venue, 'pdc_venue_city', true)) . ',' : ''; ?> <?php echo (trim(get_post_meta($camp_venue, 'pdc_venue_state', true)) != '') ? ' ' . getStateName(get_post_meta($camp_venue, 'pdc_venue_state', true)) . ',' : ''; ?> <?php echo (trim(get_post_meta($camp_venue, 'pdc_venue_zip', true)) != '') ? ' ' . get_post_meta($camp_venue, 'pdc_venue_zip', true) : ''; ?> </p>
<div class="Campdetailblock">
<div class="Campdetailimgblock">
<div class="Imgblock"><img src="<?php echo $url; ?>" alt="" /></div>
<?php
if (check_camp_registration($campid)) {
?>

<a href="<?php echo add_query_arg('cid', $campid, home_url('pdc_camp_registration')) ?>">Register Now!</a>
<?php } ?>
</div>
<div class="Campdescriptionnew">
<p>
<?php the_content(); ?>
</p>
</div>
</div>

<?php
if (trim(get_post_field('post_content', $camp_venue)) != '') {
?>
<div class="Campdetailblock">
<p>
<?php echo apply_filters('the_content', get_post_field('post_content', $camp_venue)); ?>
<br />



<strong><em>For questions:</em></strong> call <strong><?php echo get_post_meta($camp_venue, 'pdc_venue_contact_name', true); ?></strong> at <strong><?php echo get_post_meta($camp_venue, 'pdc_venue_phone', true); ?></strong></strong>  
</p>
</div>
<?php
}
$coach_id = get_post_meta($campid, 'pdc_camp_coach', true);
$coach_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($coach_id), 'thumbnail');
$url = $coach_thumb['0'];
?>
<div class="Campdetailblock">
<?php if (trim($url) != '') { ?>
<div class="Imgblock"><img src="<?php echo $url ?>" alt="<?php echo get_the_title($coach_id); ?>" /></div>
<?php } ?>
<p><strong><?php echo get_the_title($coach_id); ?></strong><br />
<em class="Text11"><?php echo get_post_meta($coach_id, 'pdc_coach_designation', true) ?></em><br />
<?php echo apply_filters('the_content', get_post_field('post_content', $coach_id)); ?></p>
</div>

<div class="Commanblocks"> </div>
</div>
<!--Right block start here-->
<div class="Gamerightblock">
<?php
if (trim(get_post_meta($camp_venue, 'wp_pdc_venue_address', true)) != '' || trim(str_replace('-', '', get_post_meta($campid, 'pdc_camp_lcn', true))) != '') {
?>
<div class="Campdetailright">
<?php
if (trim(get_post_meta($camp_venue, 'wp_pdc_venue_address', true)) != '' && (trim(get_post_meta($camp_venue, 'pdc_venue_city', true)) != '' || trim(get_post_meta($camp_venue, 'pdc_venue_state', true)) != '')) {



$address = str_replace(" ", "+", get_post_meta($camp_venue, 'wp_pdc_venue_address', true)) . ',' . getCityName(get_post_meta($camp_venue, 'pdc_venue_city', true)) . ',' . getStateName(get_post_meta($camp_venue, 'pdc_venue_state', true));
$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $address . '&sensor=false');

$output = json_decode($geocode);

if (trim($output->status) == 'OK') {



$lat = $output->results[0]->geometry->location->lat;

$long = $output->results[0]->geometry->location->lng;
?>
<div class="Clear" id="map" style="width: 253px; height: 250px"> </div>
<noscript>
<b>JavaScript must be enabled in order for you to use Google Maps.</b> However, it seems JavaScript is either disabled or not supported by your browser. 

To view Google Maps, enable JavaScript by changing your browser options, and then 

try again.
</noscript>
<script>
function initialize() {
var myLatlng = new google.maps.LatLng('<?php echo $lat; ?>','<?php echo $long; ?>');
var mapOptions = {
zoom: 8,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
var map = new google.maps.Map(document.getElementById('map'), mapOptions);

var marker = new google.maps.Marker({
position: myLatlng,
map: map,
title: '<?php echo $title; ?>'
});
}

google.maps.event.addDomListener(window, 'load', initialize);

							 

</script>


<?php
}
}
?>
<?php if (trim(str_replace('-', '', get_post_meta($campid, 'pdc_camp_lcn', true))) != '') {
?>
<div class="Mapbottom">
<h3><?php echo get_post_meta($campid, 'pdc_camp_lcn', true); ?></h3>
<p>
<?php if (trim(get_post_meta($campid, 'pdc_camp_lct', true)) != '') { ?>
<strong><?php echo get_post_meta($campid, 'pdc_camp_lct', true); ?></strong><br />
<?php } ?>
<?php if (trim(get_post_meta($campid, 'pdc_camp_lce', true)) != '') { ?>
<a href="mailto:<?php echo get_post_meta($campid, 'pdc_camp_lce', true); ?>"><?php echo get_post_meta($campid, 'pdc_camp_lce', true); ?></a>
<?php } ?>
</p>
</div>
<?php } ?>
</div>
<?php }
?>
<!--Top penal end here-->
<div style="padding-bottom:20px; float:left; width:auto;">
<div style="float:left; padding-top:5px;"> <a name="fb_share" type="button" 
  share_url="<?php echo get_permalink(); ?>">Share</a>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
type="text/javascript">
</script>
</div>
<div style="float:left; padding-top:5px; padding-left:15px;"><a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
</div>
</div>
<!--Right block end here-->
</div>
<!--Game block end here-->
<div class="CampFee">
<h1>Camp Schedule &amp; Fees</h1>
<div class="Campfeestable">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="317" height="48" align="left" valign="top" class="BdtR2"><table width="96%" height="52" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="42%" height="48" align="left" valign="middle" class="Text11 Farial Black PadL15 BdtR2"><strong>Age Group:</strong> <span class="Black"><?php echo get_post_meta($campid, 'pdc_camp_age_group', true) ?></span></td>
<td width="58%" height="48" align="left" valign="middle" class="Text11 Farial Black PadL15"><strong>Gender:</strong> <span class="Black">
<?php
if (trim(get_post_meta($campid, 'pdc_camp_for_gender', true)) == 'co-ed') {
echo 'Co-Ed';
} elseif (trim(get_post_meta($campid, 'pdc_camp_for_gender', true)) == 'f') {
echo 'Girls Only';
} else {
echo 'Boys Only';
}
?>
</span> </td>
</tr>
</table></td>
<td height="48" width="334" class="Farial Text11 BdtR2" style="line-height:18px;"><div class="Clear" style="padding:0px 0 10px 10px;">
<div style="width:150px; float:left;"> <strong>Start Date:</strong> <span class="Black"><?php echo date('M d Y', get_post_meta($campid, 'pdc_camp_start_date', true)); ?></span> </div>
<div style="width:150px; float:left;"> <strong>Start Time:</strong> <span class="Black"><?php echo get_post_meta($campid, 'pdc_camp_start_time', true); ?></span> </div>
<div style="width:150px; float:left;"> <strong>End Date:</strong> <span class="Black"><?php echo date('M d Y', get_post_meta($campid, 'pdc_camp_end_date', true)); ?></span> </div>
<div style="width:150px; float:left;"> <strong>End Time:</strong> <span class="Black"><?php echo get_post_meta($campid, 'pdc_camp_end_time', true); ?></span> </div>
</div></td>
<td width="125" height="48" align="center" valign="middle" class="Farial Text11 BdtR2"><strong>Camp Fee</strong> <span class="Black">$<?php echo get_post_meta($campid, 'pdc_camp_fees', true) ?></span></td>
<td width="182" height="48" align="center" valign="middle" class="Black Farial Text11"><strong> &nbsp;</strong></span></td>
</tr>
</table>
</div>
</div>

<?php
}
wp_reset_query();
} else {

wp_redirect(home_url());
}
}

add_shortcode('pdc_camp', 'pdc_camp_details');

/******************************DISPLAY UPCOMING CAMPS**********************************/
function upcoming_camps() {

	global $wpdb;
 
 $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	 
		$args_upcoming_home_popup = array(
		'post_type' => 'pdc_camp',
		'posts_per_page' => 5,
		'paged'=>$paged 
	);
	
	add_filter('posts_orderby', 'orderby_upcoming');
	add_filter('posts_join', 'join_upcoming', 10, 2);
	add_filter('posts_where', 'where_upcoming', 10, 2);
	 query_posts($args_upcoming_home_popup);
 
	remove_filter('posts_join', 'join_upcoming', 10, 2);
	remove_filter('posts_where', 'where_upcoming', 10, 2);
	remove_filter('posts_orderby', 'orderby_upcoming');
	while ( have_posts()) {
	 the_post();
	
	$camp_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
	
	$url = $camp_thumb['0'];
	?>
    <div class="Gamelisting">
		<div class="Morebtn"><a href="<?php echo get_permalink(); ?>">more...</a></div>
		<?php if (trim($url) != '') { ?>
			<div class="Imgblock"> <img src="<?php echo $url ?>" alt="<?php echo get_the_title(get_the_ID()); ?>" border="0" /> </div>
		<?php } ?>
		<div class="Imgrightblock">
			<h1><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h1>
			<p><em><strong><?php echo date('M d, Y', get_post_meta(get_the_ID(), 'pdc_camp_start_date', true)) ?></strong></em><br />
		<?php
		$camp_venue = get_post_meta(get_the_ID(), 'pdc_camp_venue', true);
		echo (trim(get_the_title($camp_venue)) != '') ? '<strong>' . get_the_title($camp_venue) . '</strong><br />' : '';
		?>
		<?php echo (trim(get_post_meta($camp_venue, 'wp_pdc_venue_address', true)) != '') ? wordwrap(get_post_meta($camp_venue, 'wp_pdc_venue_address', true), 55, '<br>') . ',<br />' : ''; ?>
		<?php echo (trim(get_post_meta($camp_venue, 'pdc_venue_city', true)) != '') ? getCityName(get_post_meta($camp_venue, 'pdc_venue_city', true)) . ',' : ''; ?>
		<?php echo (trim(get_post_meta($camp_venue, 'pdc_venue_state', true)) != '') ? ' ' . getStateName(get_post_meta($camp_venue, 'pdc_venue_state', true)) . ',' : ''; ?>
		<?php echo (trim(get_post_meta($camp_venue, 'pdc_venue_zip', true)) != '') ? ' ' . get_post_meta($camp_venue, 'pdc_venue_zip', true) : ''; ?></p>
		</div>
	</div>
	<?php
	}
	?>
	<div style="text-align:center;">
	<div class="navigation">
<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
<div class="alignright"><?php next_posts_link('Next Entries &raquo;','') ?></div>
</div>
	</div>
	<?php
	wp_reset_query();
}
add_shortcode('upcoming_camps', 'upcoming_camps');

/******************************DISPLAY CAMPS LISTING**********************************/
function pdc_camp_listing() {

	global $wpdb;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
 		$args_upcoming_home_popup = array(
 		'post_type' => 'pdc_camp',
		'paged'=>$paged
	);
	 
	add_filter('posts_orderby', 'orderby_upcoming');
	add_filter('posts_join', 'join_upcoming', 10, 2);
	 add_filter('posts_where','where_camp_list',10,2);
	 query_posts($args_upcoming_home_popup);
 
	remove_filter('posts_join', 'join_upcoming', 10, 2);
	 remove_filter('posts_where', 'where_camp_list', 10, 2);
	remove_filter('posts_orderby', 'orderby_upcoming');
	while ( have_posts()) {
	 the_post();
	
	$camp_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
	
	$url = $camp_thumb['0'];
	?>
    
    <div class="Gamelisting">
		<div class="Morebtn"><a href="<?php echo get_permalink(); ?>">more...</a></div>
		<?php if (trim($url) != '') { ?>
			<div class="Imgblock"> <img src="<?php echo $url ?>" alt="<?php echo get_the_title(get_the_ID()); ?>" border="0" /> </div>
		<?php } ?>
		<div class="Imgrightblock">
			<h1><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h1>
			<p><em><strong><?php echo date('M d, Y', get_post_meta(get_the_ID(), 'pdc_camp_start_date', true)) ?></strong></em><br />
		<?php
		$camp_venue = get_post_meta(get_the_ID(), 'pdc_camp_venue', true);
		echo (trim(get_the_title($camp_venue)) != '') ? '<strong>' . get_the_title($camp_venue) . '</strong><br />' : '';
		?>
		<?php echo (trim(get_post_meta($camp_venue, 'wp_pdc_venue_address', true)) != '') ? wordwrap(get_post_meta($camp_venue, 'wp_pdc_venue_address', true), 55, '<br>') . ',<br />' : ''; ?>
		<?php echo (trim(get_post_meta($camp_venue, 'pdc_venue_city', true)) != '') ? getCityName(get_post_meta($camp_venue, 'pdc_venue_city', true)) . ',' : ''; ?>
		<?php echo (trim(get_post_meta($camp_venue, 'pdc_venue_state', true)) != '') ? ' ' . getStateName(get_post_meta($camp_venue, 'pdc_venue_state', true)) . ',' : ''; ?>
		<?php echo (trim(get_post_meta($camp_venue, 'pdc_venue_zip', true)) != '') ? ' ' . get_post_meta($camp_venue, 'pdc_venue_zip', true) : ''; ?></p>
		</div>
	</div>
	<?php
	}
	?>
	<div style="text-align:center;">
	<div class="navigation">
<div class="alignleft"><?php previous_posts_link('&laquo; Previous Entries') ?></div>
<div class="alignright"><?php next_posts_link('Next Entries &raquo;','') ?></div>
</div>
	</div>
	<?php
	wp_reset_query();
}
add_shortcode('pdc_camp_listing', 'pdc_camp_listing');


function join_upcoming($join) {
		global $wp_query, $wpdb;
		$join .= "LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id ";
		return $join;
	}
	function orderby_upcoming($orderby_statement) {
		$orderby_statement = "(FROM_UNIXTIME( meta_value,  '%Y-%m-%d' ) ) ASC";
		return $orderby_statement;
	}  
	
	function where_upcoming($where_clause, $query_object) {
		$where_clause .= " AND meta_key='pdc_camp_start_date' AND FROM_UNIXTIME( meta_value,  '%Y-%m-%d' )  > '" . date('Y-m-d') . "' ";
		return $where_clause;
	}  
	function where_camp_list($where_clause, $query_object) {
		$where_clause .= " AND meta_key='pdc_camp_start_date'";
		return $where_clause;
	}  
 

/**
* Adds Foo_Widget widget.
*/
class PDC_Camp_Widget extends WP_Widget {

/**
* Register widget with WordPress.
*/
public function __construct() {
parent::__construct(
'pdc_camp_widget', // Base ID
'PDC Camp Widget', // Name
array('num_camp' => __('A PDC Camp Widget', 'text_domain'),) // Args
);
}

/**
* Front-end display of widget.
*
* @see WP_Widget::widget()
*
* @param array $args     Widget arguments.
* @param array $instance Saved values from database.
*/
public function widget($args, $instance) {
extract($args);
$title = apply_filters('widget_title', $instance['title_of_tab']);
$num_camp = apply_filters('widget_title', $instance['num_camp']);

echo $before_widget;
$widget_data = '';
if (!empty($title))
echo $before_title . $title . $after_title;

global $wpdb;
$args_widget = array(
'posts_per_page' => $num_camp,
'post_type' => 'pdc_camp',
'suppress_filters' => FALSE
);

add_filter('posts_orderby', 'orderby_upcoming');
add_filter('posts_join', 'join_upcoming', 10, 2);
add_filter('posts_where', 'where_upcoming', 10, 2);
$my_camp = new WP_Query($args_widget);
remove_filter('posts_join', 'join_upcoming', 10, 2);
remove_filter('posts_where', 'where_upcoming', 10, 2);
remove_filter('posts_orderby', 'orderby_upcoming');
if ($my_camp->have_posts()) {
$widget_data.='<div id="banner-fade"><ul class="bjqs">';
while ($my_camp->have_posts()) {

$my_camp->the_post();
$camp_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
$url = $camp_thumb['0'];
$widget_data.=' <li><div class="Gamerightblock">';
if (trim($url) != '') {
$widget_data.='<div class="Imgblock"> <img src="' . $url . '" alt="' . get_the_title(get_the_ID()) . '" border="0" width="50" /> </div>';
}
$widget_data.='<div class="Imgrightblock">

<h1><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>
<p><em><strong>' . date('M d, Y', get_post_meta(get_the_ID(), 'pdc_camp_start_date', true)) . '</strong></em><br /> 
</div>

</div></li>';
}
$widget_data.='</ul></div>
<script class="secret-source">
jQuery(document).ready(function($) {

$("#banner-fade").bjqs({
height      : 320,
width       : 200,
responsive  : true,
showcontrols : false,
showmarkers : false
});

});
</script>
';
} else {
$widet_data.='No ' . $title;
}
wp_reset_query();

// $widget_data=widget_upcoming_camp($num_camp);
echo $widget_data;
echo $after_widget;
}

/**
* Sanitize widget form values as they are saved.
*
* @see WP_Widget::update()
*
* @param array $new_instance Values just sent to be saved.
* @param array $old_instance Previously saved values from database.
*
* @return array Updated safe values to be saved.
*/
public function update($new_instance, $old_instance) {
$instance = array();
$instance['title_of_tab'] = strip_tags($new_instance['title_of_tab']);
$instance['num_camp'] = strip_tags($new_instance['num_camp']);

return $instance;
}

/**
* Back-end widget form.
*
* @see WP_Widget::form()
*
* @param array $instance Previously saved values from database.
*/
public function form($instance) {
if (isset($instance['title_of_tab'])) {
$title_of_tab = $instance['title_of_tab'];
} else {
$title_of_tab = __('Upcoming Camps', 'text_domain');
}
if (isset($instance['num_camp'])) {
$num_camp = $instance['num_camp'];
} else {
$num_camp = __('5', 'num_camp');
}
?>
<p>
<label for="<?php echo $this->get_field_id('title_of_tab'); ?>"><?php _e('Title of Tab:'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title_of_tab'); ?>" name="<?php echo $this->get_field_name('title_of_tab'); ?>" type="text" value="<?php echo esc_attr($title_of_tab); ?>" />
<label for="<?php echo $this->get_field_id('num_camp'); ?>"><?php _e('Number of Upcoming Camps:'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('num_camp'); ?>" name="<?php echo $this->get_field_name('num_camp'); ?>" type="text" value="<?php echo esc_attr($num_camp); ?>" />
</p>
<?php
}

}

// class PDC_Camp_Widget
// register PDC_Camp_Widget widget
add_action('widgets_init', create_function('', 'register_widget( "pdc_camp_widget" );'));

function my_search_template_redirect() {
global $post;

if ($post->post_type == 'pdc_camp' && !is_search()) {
$templatefilename = 'pdc_camp-template.php';

$return_template = dirname(__FILE__) . '/pdc_templates/' . $templatefilename;

do_theme_redirect($return_template);

//A Custom Taxonomy Page
}
}

add_action('template_redirect', 'my_search_template_redirect', 1);

function camp_registration_step_1() {
global $post;

if ($post->post_name == 'pdc_camp_registration' && !is_search()) {
$templatefilename = 'registration_step1.php';

$return_template = dirname(__FILE__) . '/pdc_templates/' . $templatefilename;

do_theme_redirect($return_template);

//A Custom Taxonomy Page
}
}

add_action('template_redirect', 'camp_registration_step_1', 1);

function camp_registration_step_2() {
global $post;

if ($post->post_name == 'pdc_camp_registration_two' && !is_search()) {
$templatefilename = 'registration_step2.php';

$return_template = dirname(__FILE__) . '/pdc_templates/' . $templatefilename;

do_theme_redirect($return_template);

//A Custom Taxonomy Page
}
}

add_action('template_redirect', 'camp_registration_step_2', 1);

function do_theme_redirect($url) {
global $post, $wp_query;
if (have_posts()) {
include($url);
die();
} else {
$wp_query->is_404 = true;
}
}

add_action('admin_init', 'custom_fields_wp_pdc_camp');

function custom_fields_wp_pdc_camp() {
add_meta_box('pdc_camp_meta_boxa', 'PDC Camp Gallery', 'pdc_camp_images_boxa', 'pdc_camp', 'normal', 'high'
);
}

function pdc_camp_images_boxa() {
wp_reset_query();
global $post;
$post->ID=$_GET['post'];
?>
<div id="camp_images_container" style="float:left;">
<ul class="camp_images">
<?php
    $my_post_meta = get_post_meta($post->ID, 'camp_image_gallery', true);
if ( ! empty ( $my_post_meta ) ) {
  $camp_image_gallery = get_post_meta($post->ID, 'camp_image_gallery', true);

$attachments = array_filter(explode(',', $camp_image_gallery));
if ($attachments)
foreach ($attachments as $attachment_id) {
echo '<li class="image" data-attachment_id="' . $attachment_id . '">
' . wp_get_attachment_image($attachment_id, 'thumbnail') . '
<ul class="actions">
<li><a href="#" class="delete" title="' . __('Delete image', 'colorshop') . '">' . __('Delete', 'colorshop') . '</a></li>
</ul>
</li>';
}} /*else {
// Backwards compat
$attachment_ids = array_filter(array_diff(get_posts('post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids'), array(get_post_thumbnail_id())));
$camp_image_gallery = implode(',', $attachment_ids);
}*/

?> 
</ul>

<input type="hidden" id="camp_image_gallery" name="camp_image_gallery" value="<?php echo esc_attr($camp_image_gallery); ?>" />

</div>


<p class="add_camp_images hide-if-no-js" style="clear:both">
<a href="#"><?php _e('Add gallery images', 'colorshop'); ?></a>
</p>
<script type="text/javascript">
jQuery(document).ready(function($){

// Uploading files
var camp_gallery_frame;
var $image_gallery_ids = $('#camp_image_gallery');
var $camp_images = $('#camp_images_container ul.camp_images');

jQuery('.add_camp_images').on( 'click', 'a', function( event ) {

var $el = $(this);
var attachment_ids = $image_gallery_ids.val();

event.preventDefault();

// If the media frame already exists, reopen it.
if ( camp_gallery_frame ) {
camp_gallery_frame.open();
return;
}

// Create the media frame.
camp_gallery_frame = wp.media.frames.downloadable_file = wp.media({
// Set the title of the modal.
title: '<?php _e('Add Images to camp Gallery', 'colorshop'); ?>',
button: {
text: '<?php _e('Add to gallery', 'colorshop'); ?>',
},
multiple: true
});

// When an image is selected, run a callback.
camp_gallery_frame.on( 'select', function() {

var selection = camp_gallery_frame.state().get('selection');

selection.map( function( attachment ) {

attachment = attachment.toJSON();

if ( attachment.id ) {
attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;

$camp_images.append('\
<li class="image" data-attachment_id="' + attachment.id + '">\
<img src="' + attachment.url + '" width="100" />\
<ul class="actions">\
		<li><a href="#" class="delete" title="<?php _e('Delete image', 'colorshop'); ?>"><?php _e('Delete', 'colorshop'); ?></a></li>\
</ul>\
</li>');
					}

				} );

				$image_gallery_ids.val( attachment_ids );
			});

			// Finally, open the modal.
			camp_gallery_frame.open();
		});

		// Image ordering
		$camp_images.sortable({
			items: 'li.image',
			cursor: 'move',
			scrollSensitivity:40,
			forcePlaceholderSize: true,
			forceHelperSize: false,
			helper: 'clone',
			opacity: 0.65,
			placeholder: 'cs-metabox-sortable-placeholder',
			start:function(event,ui){
				ui.item.css('background-color','#f6f6f6');
			},
			stop:function(event,ui){
				ui.item.removeAttr('style');
			},
			update: function(event, ui) {
				var attachment_ids = '';

				$('#camp_images_container ul li.image').css('cursor','default').each(function() {
					var attachment_id = jQuery(this).attr( 'data-attachment_id' );
					attachment_ids = attachment_ids + attachment_id + ',';
				});

				$image_gallery_ids.val( attachment_ids );
			}
		});

		// Remove images
		$('#camp_images_container').on( 'click', 'a.delete', function() {

			$(this).closest('li.image').remove();

			var attachment_ids = '';

			$('#camp_images_container ul li.image').css('cursor','default').each(function() {
				var attachment_id = jQuery(this).attr( 'data-attachment_id' );
				attachment_ids = attachment_ids + attachment_id + ',';
			});

			$image_gallery_ids.val( attachment_ids );

			return false;
		} );

	});
</script>
<?php
}

/* ------------------------------------------------------------------------ *
* Setting Registration
* ------------------------------------------------------------------------ */

/**
* Initializes the theme options page by registering the Sections,
* Fields, and Settings.
*
* This function is registered with the 'admin_init' hook.
*/

add_action('admin_menu', 'pdc_add_page');

function pdc_add_page( ) {
add_options_page( 'PDC Settings', 'PDC Settings', 'manage_options', 'pdc_settings', 'pdc_option_page' );
add_submenu_page( 'edit.php?post_type=pdc_camp','Export PDC Camps', 'Export PDC Camps', 'manage_options', 'pdc_camp_export','pdc_camp_export' );
add_submenu_page( 'edit.php?post_type=pdc_player','Export PDC Players', 'Export PDC Players', 'manage_options', 'pdc_player_export','pdc_player_export' );
add_submenu_page( 'edit.php?post_type=pdc_venue','Export PDC Venues', 'Export PDC Venues', 'manage_options', 'pdc_venue_export','pdc_venue_export' );
}

// ----------------------------------------------------------------
// Render the option page
// ----------------------------------------------------------------
function pdc_option_page() {
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>PDC Plugin Settings</h2>
<?php //settings_errors(); ?>
<form action="options.php" method="post">
<?php settings_fields( 'pdc_settings' ); ?>
<?php do_settings_sections( 'pdc_settings' ); ?>
<p>
<input name="Submit" type="submit" class="button-primary" value="Save Changes" />
</p>
</form>
</div>
<?php
}
add_action('admin_init', 'pdc_theme_options');

function pdc_theme_options() {

// First, we register a section. This is necessary since all future options must belong to one.
add_settings_section(
'general_settings_section', // ID used to identify this section and with which to register options
'<img src="'.plugins_url( 'assets/pdc-logo.jpg' , __FILE__ ).'" />', // Title to be displayed on the administration page
'pdc_general_options_callback', // Callback used to render the description of the section
'pdc_settings'       // Page on which to add this section of options
);

add_settings_section(
'topbar_settings_section', // ID used to identify this section and with which to register options
'Top camp Search Option', // Title to be displayed on the administration page
'pdc_general_options_callback', // Callback used to render the description of the section
'pdc_settings'       // Page on which to add this section of options
);

// Next, we will introduce the fields for toggling the visibility of content elements.
add_settings_field(
'pdc_show_top_ajax_camp_search', // ID used to identify the field throughout the theme
'Show Ajax camp Search at Top', // The label to the left of the option interface element
'pdc_show_top_ajax_camp_search_callback', // The name of the function responsible for rendering the option interface
'pdc_settings', // The page on which this option will be displayed
'topbar_settings_section', // The name of the section to which this field belongs
array(// The array of arguments to pass to the callback. In this case, just a description.
'0'
)
);

// Next, we will introduce the fields for toggling the visibility of content elements.
add_settings_field(
'pdc_paypal_username', // ID used to identify the field throughout the theme
'PAYPAL USERNAME', // The label to the left of the option interface element
'pdc_toggle_username_callback', // The name of the function responsible for rendering the option interface
'pdc_settings', // The page on which this option will be displayed
'general_settings_section', // The name of the section to which this field belongs
array(// The array of arguments to pass to the callback. In this case, just a description.
'Paypal API Username'
)
);

// Next, we will introduce the fields for toggling the visibility of content elements.
add_settings_field(
'pdc_paypal_password', // ID used to identify the field throughout the theme
'PAYPAL PASSWORD', // The label to the left of the option interface element
'pdc_toggle_password_callback', // The name of the function responsible for rendering the option interface
'pdc_settings', // The page on which this option will be displayed
'general_settings_section', // The name of the section to which this field belongs
array(// The array of arguments to pass to the callback. In this case, just a description.
'Paypal API Password'
)
);

// Next, we will introduce the fields for toggling the visibility of content elements.
add_settings_field(
'pdc_paypal_sign', // ID used to identify the field throughout the theme
'PAYPAL SIGNATURE', // The label to the left of the option interface element
'pdc_toggle_sign_callback', // The name of the function responsible for rendering the option interface
'pdc_settings', // The page on which this option will be displayed
'general_settings_section', // The name of the section to which this field belongs
array(// The array of arguments to pass to the callback. In this case, just a description.
'Paypal API Signature'
)
);
// Finally, we register the fields with WordPress  
register_setting(
'pdc_settings', 'pdc_show_top_ajax_camp_search'
);

register_setting(
'pdc_settings', 'pdc_paypal_username'
);
register_setting(
'pdc_settings', 'pdc_paypal_password'
);
register_setting(
'pdc_settings', 'pdc_paypal_sign'
);
}

// end sandbox_initialize_theme_options

/* ------------------------------------------------------------------------ *
* Section Callbacks
* ------------------------------------------------------------------------ */

/**
* This function provides a simple description for the General Options page. 
*
* It is called from the 'sandbox_initialize_theme_options' function by being passed as a parameter
* in the add_settings_section function.
*/
function pdc_general_options_callback() {
echo '<p>Paypal Settings</p>';
}

// end sandbox_general_options_callback

/* ------------------------------------------------------------------------ *
* Field Callbacks
* ------------------------------------------------------------------------ */

function pdc_show_top_ajax_camp_search_callback($args) {

// Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field
$show_option=get_option('pdc_show_top_ajax_camp_search', true);
?>
<select name="pdc_show_top_ajax_camp_search" id="pdc_show_top_ajax_camp_search">
<option value="1" <?php selected($show_option,1)?> >Yes</option>
<option value="0" <?php selected($show_option,0)?> >No</option>
</select> 
<?php
}

/**
* This function renders the interface elements for toggling the visibility of the header element.
* 
* It accepts an array of arguments and expects the first element in the array to be the description
* to be displayed next to the checkbox.
*/
function pdc_toggle_username_callback($args) {

// Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field
$html = '<input type="text" id="pdc_paypal_username" name="pdc_paypal_username" value="' . get_option('pdc_paypal_username', true) . '" />';

echo $html;
}

// end sandbox_toggle_header_callback

function pdc_toggle_password_callback($args) {
// Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field
$html = '<input type="text" id="pdc_paypal_password" name="pdc_paypal_password" value="' . get_option('pdc_paypal_password', true) . '" />';

echo $html;
}

// end sandbox_toggle_header_callback

function pdc_toggle_sign_callback($args) {
// Note the ID and the name attribute of the element match that of the ID in the call to add_settings_field
$html = '<input type="text" id="pdc_paypal_sign" name="pdc_paypal_sign" value="' . get_option('pdc_paypal_sign', true) . '" />';

echo $html;
}

// end sandbox_toggle_header_callback





/* * ****************************************************************************************************************************************************************************************************************
* ****************************************************************************************************************************************************************************************************************
* * ****************************************************************************************************************************************************************************************************************
*                                  
* 
* 
*                                                                              PDC PLAYER START
* 
* 
* 
* * ****************************************************************************************************************************************************************************************************************
* * ****************************************************************************************************************************************************************************************************************
* * ****************************************************************************************************************************************************************************************************************
*/

add_filter('manage_pdc_player_posts_columns', 'player_list_column');
add_action('manage_pdc_player_posts_custom_column', 'player_list_column_data', 10, 2);

// ADD NEW COLUMN  
function player_list_column($defaults) {
unset($defaults['date']);
$defaults['player_photo'] = 'Image';
$defaults['email'] = 'Email';
$defaults['player_status'] = 'Player Status';
$defaults['camp_name'] = 'Camp Name';
return $defaults;
}

// SHOW THE FEATURED IMAGE  
function player_list_column_data($column_name, $post_ID) {
if ($column_name == 'player_photo') {

echo get_the_post_thumbnail($post_ID,'thumbnail'); 
}
if ($column_name == 'email') {

echo get_post_meta($post_ID, 'emailadd1', true);
}

if ($column_name == 'player_status') {

echo (get_post_meta($post_ID, 'player_status', true) == '1') ? 'Active' : 'Suspended';
}
if ($column_name == 'camp_name') {

echo $camp_name = get_the_title(get_post_meta($post_ID, 'camp_id', true));  
}
}


add_filter("manage_edit-pdc_player_sortable_columns", 'concerts_sort');
function concerts_sort($columns) {
$custom = array(

'player_status' 		=> 'player_status'
);
return wp_parse_args($custom, $columns);
/* or this way
$columns['player_status'] = 'player_status';

return $columns;
*/
}


add_filter( 'request', 'player_status_column_orderby' );
function player_status_column_orderby( $vars ) {
if ( isset( $vars['orderby'] ) && 'player_status' == $vars['orderby'] ) {
$vars = array_merge( $vars, array(
'meta_key' => 'player_status',
//'orderby' => 'meta_value_num', // does not work
'orderby' => 'meta_value'
//'order' => 'asc' // don't use this; blocks toggle UI
) );
}
return $vars;
}

function get_camp_array(){
global $wpdb;
$values=array();
$arr=$wpdb->get_results("SELECT SQL_CALC_FOUND_ROWS ".$wpdb->prefix."posts.ID FROM ".$wpdb->prefix."posts INNER JOIN ".$wpdb->prefix."postmeta ON (".$wpdb->prefix."posts.ID = ".$wpdb->prefix."postmeta.post_id) 
WHERE 1=1 AND ".$wpdb->prefix."posts.post_type = 'pdc_camp' AND	(".$wpdb->prefix."posts.post_status = 'publish')  GROUP BY ".$wpdb->prefix."posts.ID ORDER BY ".$wpdb->prefix."posts.post_date DESC
");


foreach($arr as $val){
$title = get_the_title($val->ID);
$id = $val->ID;
$values[$title]=$id;
}
return $values;
}
/**********************************/
add_action( 'restrict_manage_posts', 'wpse45436_admin_posts_filter_restrict_manage_posts' );
function wpse45436_admin_posts_filter_restrict_manage_posts(){
$type = 'post';
if (isset($_GET['post_type'])) {
$type = $_GET['post_type'];
}

//only add filter to post type you want
if ('pdc_player' == $type){
//change this to the list of values you want to show
//in 'label' => 'value' format


?>

<?php  

$current_v = isset($_GET['camp'])? $_GET['camp']:'';

$values =get_camp_array();

?>
<select name="camp">
<option value=""><?php _e('Filter By ','wose45436'); ?></option>
<?php
$current_v = isset($_GET['camp'])? $_GET['camp']:'';
foreach ($values as $label => $value) {
printf
(
'<option value="%s"%s>%s</option>',
$value,
$value == $current_v? ' selected="selected"':'',
$label
);
}
?>
</select>


<?php
}
}


add_filter( 'parse_query', 'wpse45436_posts_filter' );
/**
* if submitted filter by post meta
* 
* make sure to change META_KEY to the actual meta key
* and POST_TYPE to the name of your custom post type
* @author Ohad Raz
* @param  (wp_query object) $query
* 
* @return Void
*/
function wpse45436_posts_filter( $query ){
global $pagenow;
$type = 'post';
if (isset($_GET['post_type'])) {
$type = $_GET['post_type'];
}
if ( 'pdc_player' == $type && is_admin() && $pagenow=='edit.php' && isset($_GET['camp']) && $_GET['camp'] != '') {
$query->query_vars['meta_key'] = 'camp_id';
$query->query_vars['meta_value'] = $_GET['camp'];
}
}
/* * ****************************************************************************************************************************************************************************************************************
* ****************************************************************************************************************************************************************************************************************
* * ****************************************************************************************************************************************************************************************************************
* 
* 
*                                  
*                                                                              PDC PLAYER END
* 
* 
* 
* * ****************************************************************************************************************************************************************************************************************
* * ****************************************************************************************************************************************************************************************************************
* * ****************************************************************************************************************************************************************************************************************
*/

add_action('wp_head','top_camp_search');

function top_camp_search(){
$show_option=get_option('pdc_show_top_ajax_camp_search', true);
if($show_option){
?>

<script type="text/javascript">
var mouse_is_inside = false;
jQuery(document).ready(function($) {


jQuery('#select_drp_camp').click(function(e){
jQuery('.camp_drp_down12').toggle();
e.stopPropagation();
});
jQuery('.camp_drp_down12').click(function(e){

e.stopPropagation();
});

jQuery('.boxhidebut').click(function(){
jQuery('.camp_drp_down12').hide();
});
jQuery('#city_state_drp li').click(function(){

var city_id	=	jQuery(this).attr("id");

if(city_id=='all'){
location.href='<?php echo home_url();?>';			
}
else{
jQuery('#city_state_drp li').each(function() {
jQuery(this).removeClass('current_page_item');
});

jQuery('#'+city_id).addClass('current_page_item');

//AJAX CALL START

jQuery.ajax({
type: "POST",
//data: dataString,
cache: false,
delay: 50,
// whether to cancel ongoing request when a new one is added
cancel: true,
url: '<?php echo admin_url("admin-ajax.php"); ?>',
 data: {  
  action: 'ajax_camp_list_callback',  
  cid: city_id,  
  },
beforeSend: function( ) {
jQuery('.camp_ajax_box').html('<img src="<?php echo plugins_url( "assets/Loading.gif", __FILE__ )?>" height="150" />');
},
error: function(){
alert( "Triggered ajaxError handler." );
},
success: function(html) {
jQuery('.camp_ajax_box').html(html);
}
});
//AJAX CALL END
}

});

jQuery("body").click(function(){
jQuery('.camp_drp_down12').hide();
});
 

});
 
</script>

<!--Top bar start here-->
<div class="Topmain">

<!--Top inner main start here-->
<div class="Wraperinner">
<!--TopLeft part start here-->
<div class="Topleft">

<div class="Topleftmap">

<div class="Topdropdown"><a href="javascript:void(0);" id="select_drp_camp">Select your camp</a></div>
<div class="camp_drp_down12"  style="display:none;">

<div class="dropdownopenbox">
<a href="javascript:void(0);" class="boxhidebut">&nbsp;</a>
<!-- info --><!-- thumbnail scroller markup begin -->
<div id="tS3" class="jThumbnailScroller">
<div class="jTscrollerContainer">
<div class="jTscroller">
<?php
$args_upcoming_home_popup = array(
'posts_per_page' => -1,
'post_type' => 'pdc_camp'
);

function left_join_search($join) {
global $wp_query, $wpdb;


$join .= "LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id ";

return $join;
}

function orderby_search($orderby_statement) {
$orderby_statement = "CAST( meta_value AS SIGNED )  ASC";
return $orderby_statement;
}

add_filter('posts_orderby', 'orderby_search');
add_filter('posts_join', 'left_join_search', 10, 2);

add_filter('posts_where', 'where_search', 10, 2);

function where_search($where_clause, $query_object) {

$where_clause .= " AND meta_key='pdc_camp_start_date' AND CAST( meta_value AS SIGNED )  > '" . mktime(date('h'), date('i'), date('s'), date('m'), date('d'), date('y')). "'";
return $where_clause;
}

$upcoming_home_popup = query_posts($args_upcoming_home_popup);
//      print_r($upcoming_home_popup);
// echo $GLOBALS['wp_query']->request;  
 
 



remove_filter('posts_join', 'left_join_search', 10, 2);
remove_filter('posts_where', 'where_search', 10, 2);
remove_filter('posts_orderby', 'orderby_search');
wp_reset_query();
?>
<span class="LBordertop"></span>

<ul name="city_state_drp" id="city_state_drp"  class="city_state_drp" >
<?php
if ($upcoming_home_popup) {
$k=0;   
$venue_arr=array();
foreach ($upcoming_home_popup as $post) {

 $pdc_camp_venue = get_post_meta($post->ID, 'pdc_camp_venue', true);

$state=getStateName(get_post_meta($pdc_camp_venue, 'pdc_venue_state', true));
$city=getCityName(get_post_meta($pdc_camp_venue, 'pdc_venue_city', true));


if(!in_array($pdc_camp_venue,$venue_arr))
echo'<li id="'.$pdc_camp_venue.'" >'.$city.', '.$state.'</li>';	
array_push($venue_arr,$pdc_camp_venue);
}
}
else{

echo'<li>No City</li>';
}


?>
<li id="all">All Locations</li>

</ul>

<span class="LBordertop"></span>
</div>
</div>

</div>
<!-- thumbnail scroller markup end -->
<script>

(function($){
window.onload=function(){ 
jQuery("#tS3").thumbnailScroller({ 
scrollerType:"clickButtons", 
scrollerOrientation:"vertical", 
scrollSpeed:2, 
scrollEasing:"easeOutCirc", 
scrollEasingAmount:800, 
acceleration:4, 
scrollSpeed:800, 
noScrollCenterSpace:10, 
autoScrolling:0, 
autoScrollingSpeed:2000, 
autoScrollingEasing:"easeInOutQuad", 
autoScrollingDelay:500 
});
}
})(jQuery);
</script>
<!-- thumbnailScroller script -->
<script src="<?php echo plugins_url( 'assets/jquery.thumbnailScroller.js' , __FILE__ )?>"></script>
<link rel='stylesheet' href='<?php echo plugins_url( 'assets/jquery.thumbnailScroller.css' , __FILE__ )?>' type='text/css' media='screen' />


<div class="camp_ajax_box">

</div>			 
</div>

</div>


</div>

<div class="Linerepeat"></div>

</div>
<!--TopLeft part end here-->


<div class="Clear"></div>
</div>
<!--Top inner main end here-->

</div>
<!--Top bar end here-->
<?php  
}
}

/// AJAX FUNCTION
function ajax_camp_list_callback(){
	global $wpdb;
	 
$args = array(
    'post_type' => 'pdc_camp',
    'posts_per_page'=> -1,
    'orderby' => 'meta_value',
     'meta_key' => 'pdc_camp_start_date' ,
    'order' => 'ASC',
    'meta_query' => array(
        array(
            'key' => 'pdc_camp_venue',
            'value' => $_POST['cid'],
        )
    )
);
        
 $query = new WP_Query( $args);
 
 if($query->have_posts()){
     echo'<div class="div_row">';
     $j=0;
     while ( $query->have_posts() ) :
         $j++;
	$query->the_post();
        
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
		$url = $thumb['0'];
         ?>
	<div class="drpdwn_camp_list">
			<a href="<?php echo get_permalink();?>">
				<img src="<?php echo $url;?>" alt="" border="0"  class="drpdwn_camp_img" />
			</a>
			<h1>
				<a href="<?php echo  get_permalink();?>">
					<?php echo get_the_title();?>
				</a>
			</h1>
			<span class="drpdwn_camp_date">
				<?php echo date('M d, Y',get_post_meta(get_the_ID(),'pdc_camp_start_date',true));?>
			</span>
		</div>
<?php		
			if($j%2==0)
			echo'</div><div>';
endwhile;



echo'</div>';

     
 }
 
 else{
     echo'<div class="div_row">
		<div class="drpdwn_camp_list">
		<h1><a href="javascript:void(0);" style="color:#009FDD;">No Camp</a></h1></div></div>';
     
 }
 
}
 add_action( 'wp_ajax_nopriv_ajax_camp_list_callback', 'ajax_camp_list_callback' );  
   add_action( 'wp_ajax_ajax_camp_list_callback', 'ajax_camp_list_callback' );  
   
   function pdc_camp_export(){
   	 
   	?>
   	<div class="wrap">
<?php screen_icon(); ?>
<h2>Export Camps</h2>
	 <div id="poststuff">
	<div class="metabox-holder columns-2" id="post-body">
	<div id="post-body-content">

	<div id="titlediv">
	<div id="titlewrap">
			<label for="title" id="title-prompt-text" class="">
	 		Creating CSV files...
		<script type="text/javascript">
   		window.open('<?php echo plugins_url( "pdc_camp_export.php" , __FILE__ )?>',"popUpWindow","height=100,width=100,left=200,top=200,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes");
   	</script>
			 

   </label>
		
	</div>

	</div><!-- /titlediv -->

	</div><!-- /post-body-content -->



	</div><!-- /post-body -->
	<br class="clear">
	</div>
 
</div>

   	
   	<?php

   	//require_once('pdc_camp_export.php');
   }

   function pdc_player_export(){
    ?>
    <div class="wrap">
<?php screen_icon(); ?>
<h2>Export Players</h2>
<?php //settings_errors(); ?>
<form action="" method="post" id="player_export_form">
	 <div id="poststuff">
	<div class="metabox-holder columns-2" id="post-body">
	<div id="post-body-content">

	<div id="titlediv">
	<div id="titlewrap">
			<label for="title" id="title-prompt-text" class="">
				<?php
				 
   	$posts = get_posts(
        array(
            'post_type'  => 'pdc_camp',
            'numberposts' => -1
        )
    );
    if( ! $posts ) return;

    $out = 'Please select camp:&nbsp;<select id="pdc_camp_export" name="pdc_camp_export"><option>Select a camp</option>';
    foreach( $posts as $p )
    {
        $out .= '<option value="' . $p->ID . '">' . esc_html( $p->post_title ) . '</option>';
    }
    $out .= '</select>';
    echo $out; 
	$postcamp=$_POST["pdc_camp_export"];

	if($postcamp!='' && $postcamp > 0){
		?>
		<script type="text/javascript">
			window.open('<?php echo plugins_url( "pdc_player_export.php?camp_id=$postcamp" , __FILE__ )?>',"popUpWindow","height=100,width=100,left=200,top=200,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes");
		</script>
			<?php

	}
     
   	?>
   	<script type="text/javascript">
   		jQuery("#pdc_camp_export").change(function(){
   			jQuery("#player_export_form").submit();

   		});
   		
   	</script>

   </label>
		
	</div>

	</div><!-- /titlediv -->

	</div><!-- /post-body-content -->



	</div><!-- /post-body -->
	<br class="clear">
	</div>
</form>
</div>
 
    
   	<?php

   	//require_once('pdc_camp_export.php');
   }


function pdc_venue_export(){
   	 
   	?>
   	<div class="wrap">
<?php screen_icon(); ?>
<h2>Export Venues</h2>
	 <div id="poststuff">
	<div class="metabox-holder columns-2" id="post-body">
	<div id="post-body-content">

	<div id="titlediv">
	<div id="titlewrap">
			<label for="title" id="title-prompt-text" class="">
	 		Creating CSV files...
		<script type="text/javascript">
   		window.open('<?php echo plugins_url( "pdc_venue_export.php" , __FILE__ )?>',"popUpWindow","height=100,width=100,left=200,top=200,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes");
   	</script>
			 

   </label>
		
	</div>

	</div><!-- /titlediv -->

	</div><!-- /post-body-content -->



	</div><!-- /post-body -->
	<br class="clear">
	</div>
 
</div>

   	
   	<?php
 
   }

   /******************ADD CUSTOM BOX AT WP DASHBOARD*****************************/
   add_action('wp_dashboard_setup', 'pdc_dashboard_widgets');
 
function pdc_dashboard_widgets() {
global $wp_meta_boxes;

wp_add_dashboard_widget('dashboard_pdc_now', 'PDC Plugin', 'pdc_dashboard_help');
}

function pdc_dashboard_help() {
	$count_camp = wp_count_posts('pdc_camp')->publish;
	$count_venue = wp_count_posts('pdc_venue')->publish;
	$count_coach = wp_count_posts('pdc_coach')->publish;
	$count_player = wp_count_posts('pdc_player')->publish;
echo '<div class="main">
	<ul>
	<li class="post-count"><a href="edit.php?post_type=pdc_camp">'.$count_camp.' Camp</a></li>
	<li class="page-count"><a href="edit.php?post_type=pdc_venue">'.$count_venue.' Venues</a></li>
	<li class="page-count"><a href="edit.php?post_type=pdc_coach">'.$count_coach.' Coach</a></li>
	<li class="page-count"><a href="edit.php?post_type=pdc_player">'.$count_player.' Player</a></li>
	</ul>
	<p>Click here for <a href="options-general.php?page=pdc_settings">PDC settings</a>.<br/></p>
		</div>
';
}
   /*******************DASHBOARD END*******************************************/

/***************************GET CAMP LIST BY VENUE ID*************************************/
function getcamp_list_by_venue($venue=''){
	if($venue==''){
		return'';
	}
	else{
		$camp_arr=array();	
		$args = array(
			'post_type' => 'pdc_camp',
			'posts_per_page' => -1,
			'meta_query' => array(
			    array(
			      'key' => 'pdc_camp_venue',
			      'value' => $venue,
			      'compare' => '='
			   	)
		  	)
		);

		$the_query = new WP_Query( $args ); 

		if ( $the_query->have_posts() ) :  
			while ( $the_query->have_posts() ) : $the_query->the_post();  
			 	$camp_arr[]=get_the_title();
			endwhile;  
			wp_reset_postdata(); 
			return implode(',', $camp_arr);
		else:  
		return $camp_arr;
		endif;  
	}
}
?>