<?php
/*
 * Template Name: PDC Camp Detai Page
 */
get_header();
add_thickbox();
 
 $campid=$post->ID;

 
	
if(trim($campid)!=''){ 
	 $my_camp = new WP_Query( array( 'post_type' => 'pdc_camp', 'post__in' => array( $campid ) ));
	 
	  while ( $my_camp->have_posts() ) { 
	  $my_camp->the_post();
	 
	  $camp_venue = get_post_meta($campid,'pdc_camp_venue',true);
	  
	  $title = get_the_title();
	  $id = get_the_ID();
	  $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($campid), 'thumbnail' );
		$url = $thumb['0'];
	  ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
             <div id="main-content" class="main-content">
             	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
<div class="Gameblog PadT15A">
  <div class="Gameblogleft">
    <h1 class="entry-title"><?php echo $title;?> </h1>
    <p><em><strong><?php echo date('M d, Y',get_post_meta($campid,'pdc_camp_start_date',true));?></strong></em><br />
      <?php echo (trim(get_the_title($camp_venue))!='')?'<strong>'.get_the_title($camp_venue).'</strong><br />':'';?> <?php echo (trim(get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ))!='')?get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ).',<br />':'';?> <?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_city', true ))!='')?getCityName(get_post_meta( $camp_venue, 'pdc_venue_city', true )).',':'';?> <?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_state', true ))!='')?' '.getStateName(get_post_meta( $camp_venue, 'pdc_venue_state', true )).',':'';?> <?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_zip', true ))!='')?' '.get_post_meta( $camp_venue, 'pdc_venue_zip', true ):'';?> </p>
    <div class="Campdetailblock entry-content">
      <div class="Campdetailimgblock">
        <div class="Imgblock"><img src="<?php echo $url;?>" alt="" /></div>
        <?php
		  if(check_camp_registration($campid)){
 		  ?>
        <a href="<?php echo add_query_arg( 'cid', $campid, home_url('pdc_camp_registration') )?>" class="Redbtn" >Register Now!</a>
        <?php }?>
      </div>
      <div class="Campdescriptionnew">
        <p>
          <?php the_content();?>
        </p>
      </div>
    </div>
    
   
   
    <?php 
		if(trim(get_post_field('post_content', $camp_venue))!='' || trim(get_post_meta($camp_venue,'pdc_venue_contact_name',true))!=''){
		?>
    <div class="Campdetailblock entry-content">
      <p>
        <?php  echo apply_filters('the_content', get_post_field('post_content', $camp_venue)); ?>
         <br />
	
	
	
         <strong><em>For questions:</em></strong> call <strong><?php echo  get_post_meta($camp_venue,'pdc_venue_contact_name',true);?></strong> at <strong><?php echo  get_post_meta($camp_venue,'pdc_venue_phone',true); ?></strong></strong>  
      </p>
    </div>
    <?php
		}
  $coach_id=get_post_meta($campid,'pdc_camp_coach',true);
	$coach_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($coach_id), 'thumbnail' );
		$url = $coach_thumb['0'];
	?>
		<div class="Campdetailblock entry-content">
		  <?php if(trim($url)!=''){?>
		  <div class="Imgblock"><img src="<?php echo $url?>" alt="<?php echo get_the_title($coach_id);?>" /></div>
		  <?php }?>
		  <p><strong><?php echo get_the_title($coach_id);?></strong><br />
			<em class="Text11"><?php echo get_post_meta($coach_id,'pdc_coach_designation',true)?></em><br />
			<?php echo apply_filters('the_content', get_post_field('post_content', $coach_id));?></p>
		</div>
		 
    <div class="Commanblocks"> </div>
  </div>
  <!--Right block start here-->
  <div class="Gamerightblock">
    <?php
	
	 if(trim(get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ))!='' || trim(str_replace('-','',get_post_meta( $campid, 'pdc_camp_lcn', true )))!=''){
	
	?>
    <div class="Campdetailright">
      <?php if(trim(get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ))!='' && (trim(get_post_meta( $camp_venue, 'pdc_venue_city', true ))!='' || trim(get_post_meta( $camp_venue, 'pdc_venue_state', true ))!='')){
	
						
	
						    $address=str_replace(" ","+",get_post_meta( $camp_venue, 'wp_pdc_venue_address', true )).','.getCityName(get_post_meta( $camp_venue, 'pdc_venue_city', true )).','.getStateName(get_post_meta( $camp_venue, 'pdc_venue_state', true ));
						$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
	
						$output= json_decode($geocode);
	 
						if(trim($output->status)=='OK'){
	
	 
	
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
  var myLatlng = new google.maps.LatLng('<?php echo $lat;?>','<?php echo $long;?>');
  var mapOptions = {
    zoom: 8,
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(document.getElementById('map'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: '<?php echo $title;?>'
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

 

    </script>

    
       <?php 
	
						}
	
					}?>
      <?php if(trim(str_replace('-','',get_post_meta( $campid, 'pdc_camp_lcn', true )))!=''){
	
	  
	
	 ?>
      <div class="Mapbottom">
        <h3><?php echo get_post_meta( $campid, 'pdc_camp_lcn', true );?></h3>
        <p>
          <?php if(trim(get_post_meta( $campid, 'pdc_camp_lct', true ))!=''){?>
          <strong><?php echo get_post_meta( $campid, 'pdc_camp_lct', true );?></strong><br />
          <?php }?>
          <?php if(trim(get_post_meta( $campid, 'pdc_camp_lce', true ))!=''){?>
          <a href="mailto:<?php echo get_post_meta( $campid, 'pdc_camp_lce', true );?>"><?php echo get_post_meta( $campid, 'pdc_camp_lce', true );?></a>
          <?php }?>
        </p>
      </div>
      <?php }  ?>
    </div>
    <?php 	
	
	}			 	 ?>
    <!--Top penal end here-->
    <div style="padding-bottom:20px; float:left; width:auto;">
      <div style="float:left; padding-top:5px;"> <a name="fb_share" type="button" 
	   share_url="<?php echo get_permalink();?>">Share</a>
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
<?php
                if ( metadata_exists( 'post', $post->ID, 'camp_image_gallery' ) ) {
                        $camp_image_gallery = get_post_meta( $post->ID, 'camp_image_gallery', true );
                } else {
                        // Backwards compat
                        $attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
                        $camp_image_gallery = implode( ',', $attachment_ids );
                }

                $attachments = array_filter( explode( ',', $camp_image_gallery ) );

                if ( $attachments ){
?>
<div class="CampFee" style="margin-bottom: 20px; float: left; width: 100%;">
  <h1>Camp Gallery</h1>
  <div class="Campfeestable">
    <ul class="camp_images">
        <?php


                        foreach ( $attachments as $attachment_id ) {
                                $gurl=wp_get_attachment_image_src( $attachment_id, 'large' ) ;
                                echo '<li class="image" data-attachment_id="' . $attachment_id . '">
                                            <a href="' .$gurl[0] . '" class="thickbox" rel="gallery-camp">' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '</a>

                                </li>';
                        }
        ?>
	</ul>
    </div>

    </div>
	<?php }
	
	$args = array(
	'post_type' => 'pdc_player', 
	'meta_query' => array(
		array(
		'key' => 'camp_id',
		'value' => $campid 
		),
		array(
		'key' => 'player_status',
		'value' => 1
		)
	)
);
   $my_player = new WP_Query( $args);
   if($my_player->have_posts() ){
   ?>
	<div class="CampFee" style="margin-bottom: 20px; float: left; width: 100%;">
  <h1>Roster Gallery</h1>
  <div class="Campfeestable">
    <ul class="camp_images">
<?php

   while ( $my_player->have_posts() ) { 
    $my_player->the_post();
    $title = get_post_meta(get_the_ID(), 'fname', true).' '.get_post_meta(get_the_ID(), 'lname', true);
    $id = get_the_ID();
    $gurl=wp_get_attachment_image_src( get_post_thumbnail_id($id), 'large' ) ;
    echo '<li class="image" data-attachment_id="' . get_post_thumbnail_id($id) . '">
    <a href="' .$gurl[0] . '" class="thickbox" rel="player-camp">
' . wp_get_attachment_image( get_post_thumbnail_id($id), 'thumbnail' ) . '
</a>
<br/>
'. $title.'
    </li>';
    }
    ?>
</ul>
    </div>
    </div>
	
	<?php }?>

<div class="CampFee  entry-content">
  <h1>Camp Schedule &amp; Fees</h1>
  <div class="Campfeestable">
    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="317" height="48" align="left" valign="top" class="BdtR2"><table width="96%" height="52" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="42%" height="48" align="left" valign="middle" class="Text11 Farial Black PadL15 BdtR2"><strong>Age Group:</strong> <span class="Black"><?php echo get_post_meta( $campid, 'pdc_camp_age_group', true )?></span></td>
              <td width="58%" height="48" align="left" valign="middle" class="Text11 Farial Black PadL15"><strong>Gender:</strong> <span class="Black">
                <?php 
					if(trim(get_post_meta( $campid, 'pdc_camp_for_gender', true ))=='co-ed'){
						echo 'Co-Ed';
					}
					elseif(trim(get_post_meta( $campid, 'pdc_camp_for_gender', true ))=='f'){
						echo 'Girls Only';
					}
					else{
						echo 'Boys Only';
					}	
					 ?>
                </span> </td>
            </tr>
          </table></td>
        <td height="48" width="334" class="Farial Text11 BdtR2" style="line-height:18px;"><div class="Clear" style="padding:0px 0 10px 10px;">
            <div style="width:150px; float:left;"> <strong>Start Date:</strong> <span class="Black"><?php echo date('M d Y',get_post_meta( $campid, 'pdc_camp_start_date', true ) );?></span> </div>
            <div style="width:150px; float:left;"> <strong>Start Time:</strong> <span class="Black"><?php echo get_post_meta( $campid, 'pdc_camp_start_time', true );?></span> </div>
            <div style="width:150px; float:left;"> <strong>End Date:</strong> <span class="Black"><?php echo date('M d Y',get_post_meta( $campid, 'pdc_camp_end_date', true ) );?></span> </div>
            <div style="width:150px; float:left;"> <strong>End Time:</strong> <span class="Black"><?php echo get_post_meta( $campid, 'pdc_camp_end_time', true );?></span> </div>
          </div></td>
        <td width="125" height="48" align="center" valign="middle" class="Farial Text11 BdtR2"><strong>Camp Fee</strong> <span class="Black">$<?php echo get_post_meta( $campid, 'pdc_camp_fees', true )?></span></td>
        <td width="182" height="48" align="center" valign="middle" class="Black Farial Text11"><strong> &nbsp;</strong></span></td>
      </tr>
    </table>
  </div>
</div>
               
             <?php if ( comments_open() ) : ?>   
                <?php comments_template( '', true ); ?>
            <?php endif;   ?>
 </div></div></div>
<?php 


	}
	  wp_reset_query();
	  }else{
		 
	 wp_redirect(home_url());
	 
	  }
	  
 
 
get_footer();

?>