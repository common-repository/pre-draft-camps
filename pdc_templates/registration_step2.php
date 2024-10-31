<?php session_start();
global $wpdb;

if(!isset($_POST['camp_id']) || trim($_POST['camp_id'])==''){
 wp_redirect(home_url());
}
if (isset($_POST) && $_POST['movetostep22'] != "") {
    $_SESSION = $_POST;
    $camp_detail = new WP_Query(array('post_type' => 'pdc_camp', 'post__in' => array($_SESSION['camp_id'])));
    if (!isset($_SESSION['camp_id']) || trim($_SESSION['camp_id']) == '') {
        $_SESSION['error'] = "Please Select Your Camp Location";
        header('Location:' . get_permalink(27));
    }
    if (!isset($_SESSION['fname']) || trim($_SESSION['fname']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your First Name";
    }
    if (!isset($_SESSION['lname']) || trim($_SESSION['lname']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Last Name";
    }
    if (!isset($_SESSION['dtphone']) || trim($_SESSION['dtphone']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Daytime Phone";
    }
    if (!isset($_SESSION['evphone']) || trim($_SESSION['evphone']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Evening Phone";
    }
    if (!isset($_SESSION['add1']) || trim($_SESSION['add1']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Address 1";
    }
    if (!isset($_SESSION['emailadd1']) || trim($_SESSION['emailadd1']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Email Address 1";
    }
    if (!isset($_SESSION['camp_city']) || trim($_SESSION['camp_city']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your City";
    }
    if (!isset($_SESSION['zip']) || trim($_SESSION['zip']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Zip";
    }
    if (!isset($_SESSION['age_on_pdc']) || trim($_SESSION['age_on_pdc']) == '') {
        $_SESSION['error'] .= "<br/>*Please select Age on Day of PDC";
    }
    if (!isset($_SESSION['birthday']) || trim($_SESSION['birthday']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Birthday";
    }
    if (!isset($_SESSION['grade']) || trim($_SESSION['grade']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Grade On Day Of PDC";
    }
    if (!isset($_SESSION['gender']) || trim($_SESSION['gender']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Gender";
    }
    if (!isset($_SESSION['school']) || trim($_SESSION['school']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your School";
    }
    if (!isset($_SESSION['ttprog']) || trim($_SESSION['ttprog']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Travel Team Program";
    }
    if (!isset($_SESSION['shirt_size']) || trim($_SESSION['shirt_size']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Shirt Size";
    }
    if (!isset($_SESSION['parent_name']) || trim($_SESSION['parent_name']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Parent Name";
    }
    if (!isset($_SESSION['parent_phone']) || trim($_SESSION['parent_phone']) == '') {
        $_SESSION['error'] .= "<br/>*Please enter your Parent's Phone";
    }
    if ($_SESSION['error'] != "") {
        wp_redirect(home_url('pdc_camp_registration/').'?cid='.$_SESSION['camp_id']);
        exit;
    }
} else if ($_SESSION['camp_id'] != '') {
    $camp_detail = new WP_Query(array('post_type' => 'pdc_camp', 'post__in' => array($_SESSION['camp_id'])));
   // $camp_venue = $venue->camp_venue($camp_detail->camp_venue);
}

function is_email5($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    else
        return true;
}

if (isset($_POST) && trim($_POST['completestep2']) != "") {
     if (trim($_POST['fname']) == '') {
        $msg.='* Please enter Firstname<br>';
    }
    if (trim($_POST['lname']) == '') {
        $msg.='* Please enter Lastname<br>';
    }
    if (trim($_POST['payment_add']) == '') {
        $msg.='* Please enter Address<br>';
    }
    if (trim($_POST['payment_emailadd']) == '') {
        $msg.='* Please enter Email Address<br>';
    }
    if (trim($_POST['payment_emailadd']) != '' && !is_email5($_POST['payment_emailadd'])) {
        $msg.='* Please enter valid Email Address<br>';
    }
    if (trim($_POST['cpayment_emailadd']) == '') {
        $msg.='* Please enter Confirm Email Address<br>';
    }
     if (trim($_POST['cpayment_emailadd']) != '' && !is_email5($_POST['cpayment_emailadd'])) {
        $msg.='* Please enter valid Confirm Email Address<br>';
    }
     if (trim($_POST['cpayment_emailadd']) != '' && trim($_POST['payment_emailadd']) != '' && trim($_POST['cpayment_emailadd']) != trim($_POST['payment_emailadd'])) {
         $msg.='* Confirm Email Address is not match with Email Address. Please enter correct information<br>';
    }
     if (trim($_POST['payment_camp_state']) == '') {
         $msg.='* Please select State<br>';
    }
    if (trim($_POST['payment_camp_city']) == '') {
        $msg.='* Please enter City<br>';
    }
    if (trim($_POST['payment_zip']) == '') {
        $msg.='* Please enter Postal Code<br>';
    }
    if (trim($_POST['cc_type']) == '') {
        $msg.='* Please enter Credit card Type<br>';
    }
    if (trim($_POST['cc_number']) == '') {
        $msg.='* Please enter Credit card Number<br>';
    }
    if (trim($_POST['cvv_number']) == '') {
        $msg.='* Please enter Card Verification Number<br>';
    }
    if (trim($_POST['no_refund_chkbx']) == '') {
        $msg.='* Please accept the  NO REFUNDS term. <br>';
    }
    if(!preg_match("/\.(gif|png|jpg)$/", $_FILES['player_photo']['name'])){
            $msg.='* Please upload gif, jpg or png files. <br>';
        }
       
    if (trim($msg) != '') {
        //do nothing
    } else {
        // Sandbox (Test) Mode Trigger
        
    
   
         
        $sandbox = false;
        $api_username = get_option('pdc_paypal_username');
        $api_password = get_option('pdc_paypal_password');
        $api_signature = get_option('pdc_paypal_sign');
        $camp_data = new WP_Query(array('post_type' => 'pdc_camp', 'post__in' => array($_SESSION['camp_id'])));
        $no_seat = 1;
        $p_price = get_post_meta($_SESSION['camp_id'],'pdc_camp_fees',true);
        $p_title = get_the_title($_SESSION['camp_id']);
        $camp_local_contact_email = get_post_meta($_SESSION['camp_id'],'camp_local_contact_email',true);
        $payment_state_name11 = getStateName($_REQUEST['payment_camp_state']);
        $payment_state_name = $payment_state_name11->state_title;
        require_once('includes/DoDirectPayment.php');
        $fname = $_SESSION['fname'];
        $lname = $_SESSION['lname'];
        $dtphone = $_SESSION['dtphone'];
        $evphone = $_SESSION['evphone'];
        $emailadd1 = $_SESSION['emailadd1'];
        $camp_city = $_SESSION['camp_city'];
        $camp_state = $_SESSION['camp_state'];
        $zip = $_SESSION['zip'];
        $emailadd2 = $_SESSION['emailadd2'];
        $add1 = $_SESSION['add1'];
        $add2 = $_SESSION['add2'];
        $camp_city2 = $_SESSION['camp_city2'];
        $camp_state2 = $_SESSION['camp_state2'];
        $zip2 = $_SESSION['zip2'];
        $age_on_pdc = $_SESSION['age_on_pdc'];
        $birthday = $_SESSION['birthday'];
        $grade = $_SESSION['grade'];
        $gender = $_SESSION['gender'];
        $school = $_SESSION['school'];
        $ttprog = $_SESSION['ttprog'];
        $shirt_size = $_SESSION['shirt_size'];
        $promocode = $_SESSION['promocode'];
        $fb_page = $_SESSION['fb_page'];
        $twitter_page = $_SESSION['twitter_page'];
        $yt_page = $_SESSION['yt_page'];
        $about_player = $_SESSION['about_player'];
        $hw_hr_pdc = $_SESSION['hw_hr_pdc'];
        $nike_more_info = $_SESSION['nike_more_info'];
        $parent_name = $_SESSION['parent_name'];
        $parent_phone = $_SESSION['parent_phone'];
        $family_phy = $_SESSION['family_phy'];
        $phy_phone = $_SESSION['phy_phone'];
        $med_ins_comp = $_SESSION['med_ins_comp'];
        $policy_number = $_SESSION['policy_number'];
        $policy_holder_name = $_SESSION['policy_holder_name'];
        $camp_id = $_SESSION['camp_id'];
        $camp_name = get_the_title($_SESSION['camp_id']);
        $registration_date = time();
        //$PayPalResult['ACK']='Success';
        //$PayPalResult['TRANSACTIONID']='100000007';
        if ($PayPalResult['ACK'] == 'Success' && trim($PayPalResult['TRANSACTIONID']) != '') {
           $transactionid = $PayPalResult['TRANSACTIONID'];
           //$data = compact('fname', 'lname', 'dtphone', 'evphone','about_player', 'emailadd1', 'add1', 'camp_city', 'camp_state', 'zip', 'emailadd2', 'add2', 'camp_city2', 'camp_state2', 'zip2', 'age_on_pdc', 'birthday', 'grade', 'gender', 'school', 'ttprog', 'shirt_size', 'promocode', 'fb_page', 'twitter_page', 'yt_page', 'hw_hr_pdc', 'nike_more_info', 'parent_name', 'parent_phone', 'family_phy', 'phy_phone', 'med_ins_comp', 'policy_number', 'policy_holder_name', 'camp_id', 'camp_name', 'transactionid', 'registration_date');
           //$data = stripslashes_deep($data);
         //  $wpdb->insert($wpdb->prefix . "pdc_player_registration", $data);
           $my_post = array(
            'post_title' => $_SESSION['fname'].' '.$_SESSION['lname'],
            'post_content' => $_SESSION['about_player'],
            'post_status' => 'publish',
            'post_author' => 1,
            'post_name' => 'pdc_player_'.$_SESSION['fname'].' '.$_SESSION['lname'],
            'post_type' => 'pdc_player'
        );
           $player_id= wp_insert_post( $my_post);
           if($player_id){
            update_post_meta($player_id, 'fname', $_SESSION['fname']);
            update_post_meta($player_id, 'lname', $_SESSION['lname']);
            update_post_meta($player_id, 'dtphone', $_SESSION['dtphone']);
            update_post_meta($player_id, 'evphone', $_SESSION['evphone']);
            update_post_meta($player_id, 'emailadd1', $_SESSION['emailadd1']);
            update_post_meta($player_id, 'add1', $_SESSION['add1']);
            update_post_meta($player_id, 'camp_city', $_SESSION['camp_city']);
            update_post_meta($player_id, 'camp_state', $_SESSION['camp_state']);
            update_post_meta($player_id, 'zip', $_SESSION['zip']);
            update_post_meta($player_id, 'emailadd2', $_SESSION['emailadd2']);
            update_post_meta($player_id, 'add2', $_SESSION['add2']);
            update_post_meta($player_id, 'camp_city2', $_SESSION['camp_city2']);
            update_post_meta($player_id, 'camp_state2', $_SESSION['camp_state2']);
            update_post_meta($player_id, 'zip2', $_SESSION['zip2']);
            update_post_meta($player_id, 'age_on_pdc', $_SESSION['age_on_pdc']);
            update_post_meta($player_id, 'birthday', $_SESSION['birthday']);
            update_post_meta($player_id, 'grade', $_SESSION['grade']);
            update_post_meta($player_id, 'gender', $_SESSION['gender']);
            update_post_meta($player_id, 'school', $_SESSION['school']);
            update_post_meta($player_id, 'ttprog', $_SESSION['ttprog']);
            update_post_meta($player_id, 'shirt_size', $_SESSION['shirt_size']);
            update_post_meta($player_id, 'promocode', $_SESSION['promocode']);
            update_post_meta($player_id, 'fb_page', $_SESSION['fb_page']);
            update_post_meta($player_id, 'twitter_page', $_SESSION['twitter_page']);
            update_post_meta($player_id, 'yt_page', $_SESSION['yt_page']);
            update_post_meta($player_id, 'hw_hr_pdc', $_SESSION['hw_hr_pdc']);
            update_post_meta($player_id, 'parent_name', $_SESSION['parent_name']);
            update_post_meta($player_id, 'parent_phone', $_SESSION['parent_phone']);
            update_post_meta($player_id, 'family_phy', $_SESSION['family_phy']);
            update_post_meta($player_id, 'phy_phone', $_SESSION['phy_phone']);
            update_post_meta($player_id, 'med_ins_comp', $_SESSION['med_ins_comp']);
            update_post_meta($player_id, 'policy_number', $_SESSION['policy_number']);
            update_post_meta($player_id, 'policy_holder_name', $_SESSION['policy_holder_name']);
            update_post_meta($player_id, 'camp_id', $_SESSION['camp_id']);
            update_post_meta($player_id,'transactionid',$transactionid);
             update_post_meta($player_id,'player_status',0);

            require_once(ABSPATH . '/wp-admin/includes/file.php');
            require_once(ABSPATH . '/wp-admin/includes/image.php');
            $override = array('test_form' => FALSE);
            $file = wp_handle_sideload($_FILES['player_photo'], $override);
            $attachment = array(
            'post_mime_type' => $file['type'],
            'post_title' => basename($image),
            'post_content' => ' ',
            'post_status' => 'inherit'
            );
            $attach_id = wp_insert_attachment( $attachment, $file['file']);
            $attach_data = wp_generate_attachment_metadata( $attach_id, $file['file'] );
            wp_update_attachment_metadata( $attach_id,  $attach_data );
            set_post_thumbnail( $player_id, $attach_id );
         }
       
             
           $camp_venue = get_post_meta($_SESSION['camp_id'],'pdc_camp_venue',true);
           $mail_str = '<span style="color:#797979; font-size:12px;"> Congratulations, you are registered for:&nbsp;<strong><em>' . get_the_title($_SESSION['camp_id']) . '</em></strong><br><br>Start time: <strong><em>' . date('M d, Y',get_post_meta($_SESSION['camp_id'],'pdc_camp_start_date',true)) . '</em>&nbsp;' . get_post_meta($_SESSION['camp_id'], 'pdc_camp_start_time', true ). '</strong><br> End time: <strong><em>' . date('M d, Y',get_post_meta($_SESSION['camp_id'],'pdc_camp_end_date',true)) . '</em>&nbsp;' . get_post_meta($_SESSION['camp_id'], 'pdc_camp_end_time', true ) . '</strong><br>' . '<p> <strong>' .get_the_title($camp_venue) . '</strong><br/>' . get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ) . '<br/>' . getCityName(get_post_meta( $camp_venue, 'pdc_venue_city', true )) . ', ' . getStateName(get_post_meta( $camp_venue, 'pdc_venue_state', true )) . ' - ' . get_post_meta( $camp_venue, 'pdc_venue_zip', true ) . '<br></p> </span> ';
           $message = '<html><body><div class="Registerright"><div class="Contactinfo">' . $mail_str . '</div></div><div class="Registerright"><h2>Personal Information </h2><div class="Contactinfo"><dl><dt> <span><strong>First Name:</strong></span> <span class="Fistblockright">' . $_SESSION['fname'] . '</span> </dt><dd> <span><strong>Last Name:</strong></span> <span class="Fistblockright2">' . $_SESSION['lname'] . '</span> </dd></dl><dl><dt> <span><strong>Daytime Phone:</strong></span> <span class="Fistblockright">' . $_SESSION['dtphone'] . '</span> </dt>
                <dd> <span><strong>Evening Phone :</strong></span> <span class="Fistblockright2">' . $_SESSION['evphone'] . '</span> </dd></dl><dl><dt class="Colum5"> <strong> Email And Mailing Address 1:</strong> </dt>
                    <dd class="Colum4"> ' . $_SESSION['emailadd1'] . '<br/>' . $_SESSION['add1'] . ', ' . $_SESSION['camp_city'] . ',' . getStateName($_SESSION['camp_state']) . ',' . $_SESSION['zip'] . ' </dd></dl>';

            if (trim($_SESSION['emailadd2']) != '') {
                $message.='<dl><dt class="Colum5"> <strong>Email and Mailing Address 2:</strong> </dt><dd class="Colum4">' . $_SESSION['emailadd2'] . '<br/>';
            if (trim($_SESSION['add2']) != '')
                $message.=$_SESSION['add2'] . ', ';
            if (trim($_SESSION['camp_city2']) != '')
                $message.=$_SESSION['camp_city2'] . ', ';
            if (trim($_SESSION['camp_state2']) != '')
                $message.=getStateName($_SESSION['camp_state2']) . ', ';
            if (trim($_SESSION['zip2']) != '')
                $message.=$_SESSION['zip2'];
                $message.='</dd></dl>';
            }

            $message.='</div></div><div class="Registerright"><h2> Players Contact Information </span> </h2><div class="Contactinfo"><dl><dt> <span><strong>Age on Day of PDC:</strong></span> <span class="Fistblockright">' . $_SESSION['age_on_pdc'] . '</span> </dt><dd> <span><strong>Birthday:</strong></span> <span class="Fistblockright2">' . $_SESSION['birthday'] . '</span> </dd></dl><dl><dt> <span><strong>Grade on Day of PDC:</strong></span> <span class="Fistblockright">' . $_SESSION['grade'] . '</span> </dt> <dd> <span><strong>Gender:</strong></span> <span class="Fistblockright2">' . $_SESSION['gender'] . '</span> </dd></dl><dl><dt> <span><strong>School:</strong></span> <span class="Fistblockright">' . $_SESSION['school'] . ' </span> </dt><dd> <span><strong>Travel Team Program:</strong></span> <span class="Fistblockright2">' . $_SESSION['ttprog'] . '<br/></span> </dd></dl><dl><dt> <span><strong>Shirt Size :</strong></span> <span class="Fistblockright">' . $_SESSION['shirt_size'] . ' </span> </dt></dl><dl><dt class="Colum5"> <strong>Promotional Code:</strong> </dt><dd class="Colum4">' . $_SESSION['promocode'] . '</dd></dl><dl><dt class="Colum5"> <strong>Facebook Page:</strong> </dt><dd class="Colum4">' . $_SESSION['fb_page'] . '</dd></dl><dl><dt class="Colum5"> <strong>Twitter Name:</strong> </dt><dd class="Colum4">' . $_SESSION['twitter_page'] . '</dd></dl><dl><dt class="Colum5"> <strong>YouTube Page:</strong> </dt>
                        <dd class="Colum4">' . $_SESSION['yt_page'] . '</dd></dl><dl><dt class="Colum5"> <strong>How did you hear about PDC?</strong></dt><dd class="Colum4">' . $_SESSION['hw_hr_pdc'] . ' </dd></dl></div></div><div class="Registerright"><h2>Medical Information </span> </h2><div class="Contactinfo"><dl><dt> <span><strong>Parent/Guardian:</strong></span> <span class="Fistblockright">' . $_SESSION['parent'] . '</span> </dt><dd> <span><strong>Parent\'s Phone: </strong></span> <span class="Fistblockright2">' . $_SESSION['parent_phone'] . '</span> </dd></dl><dl><dt> <span><strong>Family Physician:</strong></span> <span class="Fistblockright">' . $_SESSION['family_phy'] . '</span> </dt><dd> <span><strong>Physician\'s Phone: </strong></span> <span class="Fistblockright2">' . $_SESSION['phy_phone'] . '</span> </dd></dl><dl><dt> <span><strong>Medical Insurance Co:</strong></span> <span class="Fistblockright">' . $_SESSION['med_ins_comp'] . '</span> </dt><dd> <span><strong>Policy Number:</strong></span> <span class="Fistblockright2">' . $_SESSION['policy_number'] . '</span> </dd></dl><dl><dt> <span><strong>Policy Holder Name:</strong></span> <span class="Fistblockright">' . $_SESSION['policy_holder_name'] . '</span> </dt></dl><dl><dt> <span><strong>Agree to Medial Waiver:</strong></span> <span class="Fistblockright">' . $_SESSION['terms_acc'] . '</span> </dt></dl><dl><dt> <span><strong>Agree to NO REFUNDS term:</strong></span> <span class="Fistblockright">' . $_REQUEST['no_refund_chkbx'] . '</span> </dt>
                        </dl></div></div><div class="Registerright"><div class="Contactinfo"> <span style="color:#797979; font-size:12px;"> Thank you for registering for the PreDraft Camp! If you have any questions, please contact us. </span></div></div></body></html>';
 
            wp_mail($camp_local_contact_email,get_the_title($_SESSION['camp_id']), $message);
            wp_mail(get_option('admin_email'),get_the_title($_SESSION['camp_id']), $message);
            unset($_SESSION);
            session_destroy();
            wp_redirect(home_url());
            exit;
        }
        else {
            $msg.='* ' . $PayPalResult['L_LONGMESSAGE0'] . '.';
            $msg.=' Error in transaction!!! Please try again.<br>';
        }
    }   
}
get_header();
?>
<script>
        jQuery(document).ready(function(){
              // binds form submission and fields to the validation engine
              jQuery('#step21').validationEngine('attach', {promptPosition : "centerRight"});
		      //jQuery("#formID2").validationEngine('attach', {promptPosition : "bottomLeft"});
              //jQuery("#formID3").validationEngine('attach', {promptPosition : "bottomRight"});
              //jQuery("#formID4").validationEngine('attach', {promptPosition : "topLeft"});
            });
        </script>
 
<div class="container" style="clear:both; margin-top: 20px;">
<div class="Introductionblock Borderbotnone">

    <!--Left tabs block start here-->

    <div class="Tabsleft">

        <div class="Bannerbgmain">
 

<?php if ($_SESSION['camp_id'] != '') { ?>

              <div class="Birminghamblock Relative">



        <div class="Editbtn"><a href="<?php echo home_url('pdc_camp_registration/?cid='.$_SESSION['camp_id'])?>">Edit</a></div>



        <h3><?php echo get_the_title($_SESSION['camp_id']);?></h3>



        <p><em><strong><?php echo date('M d, Y',get_post_meta($_SESSION['camp_id'],'pdc_camp_start_date',true))?></strong></em><br />

		<?php  
							 $camp_venue = get_post_meta($_SESSION['camp_id'],'pdc_camp_venue',true);
							 
  echo (trim(get_the_title($camp_venue))!='')? '<strong>'.get_the_title($camp_venue).'</strong><br />':'';?>
				<?php echo (trim(get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ))!='')? wordwrap(get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ),55,'<br>').',<br />':'';?>

							<?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_city', true ))!='')?getCityName(get_post_meta( $camp_venue, 'pdc_venue_city', true )).',':'';?>

							<?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_state', true ))!='')?' '.getStateName(get_post_meta( $camp_venue, 'pdc_venue_state', true )).',':'';?>

							 <?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_zip', true ))!='')?' '.get_post_meta( $camp_venue, 'pdc_venue_zip', true ):'';?></p>



      </div>



      <div class="Birminghamblock">



        <p><strong>Cost $<?php echo get_post_meta($_SESSION['camp_id'],'pdc_camp_fees',true);?></strong></p>



      </div>

<?php } else { ?>
<div class="Birminghamblock Relative"> <h3>PDC Plugin</h3></div>
 

<?php } ?>

        </div>

    </div>

    <!--Left tabs block end here-->

    <form action="" method="post" id="step21" name="step21" enctype="multipart/form-data" >

        <div class="Introductionright">

            <h1>Player Registration </h1>

          

            <div class="Floatright Farial Text11 Red">All fields required.</div>

<?php if ((isset($_SESSION['error']) && $_SESSION['error'] != "")) { ?>

    <?php
    echo '<div class="npdc_error">' . $_SESSION['error'] . '</div>';



    unset($_SESSION['error']);
    ?>

<?php
} else if ($msg != "") {







    echo '<div class="npdc_error">' . $msg . '</div>';
}
?>

            <!--personal information-->

            <div class="Registerright">

                <h2>Personal Information <span><a href="<?php echo home_url('pdc_camp_registration/?cid='.$_SESSION['camp_id']); ?>#personel_information">Edit</a></span> </h2>

                <!--contact info-->

                <div class="Contactinfo">

                    <dl>

                        <dt> <span><strong>First Name:</strong></span> <span class="Fistblockright"><?php echo $_SESSION['fname']; ?></span> </dt>

                        <dd> <span><strong>Last Name:</strong></span> <span class="Fistblockright2"><?php echo $_SESSION['lname']; ?></span> </dd>

                    </dl>

                    <dl>

                        <dt> <span><strong>Daytime Phone:</strong></span> <span class="Fistblockright"><?php echo $_SESSION['dtphone']; ?></span> </dt>

                        <dd> <span><strong>Evening Phone :</strong></span> <span class="Fistblockright2"><?php echo $_SESSION['evphone']; ?></span> </dd>

                    </dl>

                    <dl>

                        <dt class="Colum5"> <strong> Email And Mailing Address 1:</strong> </dt>

                        <dd class="Colum4"> <?php echo $_SESSION['emailadd1']; ?><br/>

<?php echo $_SESSION['add1']; ?>, <?php echo $_SESSION['camp_city']; ?>,<?php echo getStateName($_SESSION['camp_state']); ?>,<?php echo $_SESSION['zip']; ?> </dd>

                    </dl>

                    <dl>

                        <dt class="Colum5"> <strong>Email and Mailing Address 2:</strong> </dt>

                        <dd class="Colum4"><?php echo (trim($_SESSION['emailadd2']) != '') ? $_SESSION['emailadd2'] . '<br>' : ''; ?> <?php echo (trim($_SESSION['add2']) != '') ? $_SESSION['add2'] . ', ' : ''; ?> <?php echo (trim($_SESSION['camp_city2']) != '') ? $_SESSION['camp_city2'] . ', ' : ''; ?><?php echo (trim($_SESSION['camp_state2']) != '') ? getStateName($_SESSION['camp_state2']) : ''; ?><?php echo (trim($_SESSION['zip2']) != '') ? ' ,' . $_SESSION['zip2'] : ''; ?> </dd>

                    </dl>

                </div>

                <!--contact info-->

            </div>

            <!--personal information-->

            <!--player contact information-->

            <div class="Registerright">

                <h2> Players Contact Information <span><a href="<?php echo home_url('pdc_camp_registration/?cid='.$_SESSION['camp_id']); ?>#players_contact_information">Edit</a></span> </h2>

                <!--per-->

                <div class="Contactinfo">

                    <dl>

                        <dt> <span><strong>Age on Day of PDC:</strong></span> <span class="Fistblockright"><?php echo $_SESSION['age_on_pdc']; ?></span> </dt>

                        <dd> <span><strong>Birthday:</strong></span> <span class="Fistblockright2"><?php echo $_SESSION['birthday']; ?></span> </dd>

                    </dl>

                    <dl>

                        <dt> <span><strong>Grade on Day of PDC:</strong></span> <span class="Fistblockright"><?php echo $_SESSION['grade']; ?></span> </dt>

                        <dd> <span><strong>Gender:</strong></span> <span class="Fistblockright2">

            <?php echo (trim($_SESSION['gender']) == 'm') ? 'Male' : 'Female'; ?>

                            </span> </dd>

                    </dl>

                    <dl>

                        <dt> <span><strong>School:</strong></span> <span class="Fistblockright"><?php echo $_SESSION['school']; ?> </span> </dt>

                        <dd> <span><strong>Travel Team Program:</strong></span> <span class="Fistblockright2"><?php echo $_SESSION['ttprog']; ?></dd>

                    </dl>

                    <dl>

                        <dt> <span><strong>Shirt Size :</strong></span> <span class="Fistblockright"><?php echo $_SESSION['shirt_size']; ?> </span> </dt>

                        <!--
                                    <dd> <span><strong>Short Size:</strong></span> <span class="Fistblockright2"><?php echo $_SESSION['short_size']; ?></span> </dd>
                        -->
                    </dl>

                    <dl>

                        <dt class="Colum5"> <strong>Promotional Code:</strong> </dt>

                        <dd class="Colum4"><?php echo $_SESSION['promocode']; ?></dd>

                    </dl>

                    <dl>

                        <dt class="Colum5"> <strong>Facebook Page:</strong> </dt>

                        <dd class="Colum4"><a href="<?php echo $_SESSION['fb_page']; ?>"><?php echo $_SESSION['fb_page']; ?></a></dd>

                    </dl>

                    <dl>

                        <dt class="Colum5"> <strong>Twitter Name:</strong> </dt>

                        <dd class="Colum4"><?php echo $_SESSION['twitter_page']; ?></dd>

                    </dl>

                    <dl>

                        <dt class="Colum5"> <strong>YouTube Page:</strong> </dt>

                        <dd class="Colum4"><?php echo $_SESSION['yt_page']; ?></dd>

                    </dl>

                    <dl>

                        <dt class="Colum5"> <strong>How did you hear about PDC?</strong></dt>

                        <dd class="Colum4"><?php echo $_SESSION['hw_hr_pdc']; ?> </dd>

                    </dl>

                </div>

                <!--per-->

            </div>

            <!--player contact information-->

            <!--medical information-->

            <div class="Registerright">

                <h2>Medical Information <span><a href="<?php echo home_url('pdc_camp_registration/?cid='.$_SESSION['camp_id']); ?>#medical_information">Edit</a></span> </h2>

                <div class="Contactinfo">

                    <dl>

                        <dt> <span><strong>Parent/Guardian:</strong></span> <span class="Fistblockright"><?php echo $_SESSION['parent_name']; ?></span> </dt>

                        <dd> <span><strong>Parent's Phone: </strong></span> <span class="Fistblockright2"><?php echo $_SESSION['parent_phone']; ?></span> </dd>

                    </dl>

                    <dl>

                        <dt> <span><strong>Family Physician:</strong></span> <span class="Fistblockright"><?php echo $_SESSION['family_phy']; ?></span> </dt>

                        <dd> <span><strong>Physician's Phone: </strong></span> <span class="Fistblockright2"><?php echo $_SESSION['phy_phone']; ?></span> </dd>

                    </dl>

                    <dl>

                        <dt> <span><strong>Physician's Phone: </strong></span> <span class="Fistblockright"><?php echo $_SESSION['phy_phone']; ?></span> </dt>

                        <dd> <span><strong>Medical Insurance Co:</strong></span> <span class="Fistblockright2"><?php echo $_SESSION['med_ins_comp']; ?></span> </dd>

                    </dl>

                    <dl>

                        <dt> <span><strong>Policy Number:</strong></span> <span class="Fistblockright"><?php echo $_SESSION['policy_number']; ?></span> </dt>

                        <dd> <span><strong>Policy Holder Name:</strong></span> <span class="Fistblockright2"><?php echo $_SESSION['policy_holder_name']; ?></span> </dd>

                    </dl>

                    <dl>

                        <dd> <span><strong>Agree to Medial Waiver:</strong></span> <span class="Fistblockright2"><?php echo $_SESSION['terms_acc']; ?></span> </dd>

                    </dl>
                    
                     
                    

                </div>

            </div>
             <div class="Registerright">

                <h2>Upload Your Photo  </h2>

                <div class="Contactinfo">


            <dl>

                        <dt> <span><strong>Photo:</strong></span> <span class="Fistblockright">
                                 <input type="file" style="border:1px solid;" name="player_photo" class="text-input" value="<?php echo $_SESSION['player_photo'];?>">
                                 
                            </span> </dt>

                    </dl>
                     </div>

            </div>
            
            <!--medical information-->

            <input type="hidden" value="<?php echo $_SESSION['dtphone']; ?>" name="cc_phone" />

            <div class="Registerright">

                <h2>Payment</h2>

                <div class="Plyercontinfo">

                    <div class="Inputblocks">

                        <label>First Name :</label>

                        <input style="width:275px;" type="text" id="fname" name="fname" class="validate[required] text-input" value=""  />

                    </div>

                    <div class="Inputblocks">

                        <label>Last Name :</label>

                        <input style="width:340px;" type="text" id="lname" name="lname" class="validate[required] text-input" value=""  />

                    </div>

                </div>

                <div class="Plyercontinfo">

                    <div class="Inputblocks">

                        <label>Email Address :</label>

                        <input style="width:275px;" type="text" id="payment_emailadd" name="payment_emailadd" class="validate[required,custom[email]] text-input" value=""   />

                    </div>

                    <div class="Inputblocks">

                        <label>Confirm Email Address : </label>

                        <input style="width:340px;" type="text" id="cpayment_emailadd" name="cpayment_emailadd" class="validate[required,custom[email]] text-input" value=""   />

                    </div>

                </div>

                <div class="Plyercontinfo">

                    <div class="Inputblocks">

                        <label>Address : </label>

                        <input style="width:275px;" type="text" id="payment_add" name="payment_add" class="validate[required] text-input" value=""  />

                    </div>

                    <div class="Inputblocks">

                        <label>City :</label>

<?php
//cityDrpDown('payment_camp_city','payment_camp_city',0,'','',1,'validate[required] text-input');
?>

                        <input style="width:76px;" type="text" id="payment_camp_city" name="payment_camp_city" class="validate[required] text-input" value=""  />

                    </div>

                    <div class="Inputblocks">

                        <label>State :</label>

<?php
stateDrpDown_normal('payment_camp_state', 'payment_camp_state', 0, '', '', 'payment_camp_city', 1, 'validate[required] text-input');
?>

                    </div>

                    <div class="Inputblocks">

                        <label>Zip : </label>

                        <input  style="width:70px;" type="text" id="payment_zip" name="payment_zip" class="validate[required] text-input" value=""   />

                    </div>

                </div>

                <div class="Plyercontinfo">

                    <div class="Inputblocks">

                        <label>Payment Type : <b>Credit Card</b></label>

                        <input type="hidden" id="payment_type" name="payment_type" value="creditcard"  />

                    </div>

                </div>

                <div class="Plyercontinfo">

                    <div class="Inputblocks">

                        <label>Credit Card Type :</label>

                        <select id="cc_type" name="cc_type" class="validate[required] text-input">

                            <option value="">-Select-</option>

                            <option value="MasterCard">-Master Card-</option>

                            <option value="Visa">-Visa-</option>

                            <option value="Amex">-Amex-</option>

                        </select>

                    </div>

                    <div class="Inputblocks">

                        <label>Credit Card Number :</label>

                        <input style="width:340px;" type="text" id="cc_number" name="cc_number" class="validate[required] text-input" value=""  />

                    </div>

                </div>

                <div class="Plyercontinfo">

                    <div class="Inputblocks">

                        <label>Expiry Date :</label>

                        <select id="cc_exp_month" name="cc_exp_month" class="validate[required] text-input" >

                            <option value="">-Select Month-</option>

<?php for ($n = 1; $n <= 12; $n++) { ?>

                                <option value="<?php echo $n; ?>"><?php echo $n; ?></option>

                        <?php } ?>

                        </select>

                        <select id="cc_exp_year" name="cc_exp_year" class="validate[required] text-input" >

                            <option value="">-Select Year-</option>

                        <?php for ($m = 2011; $m <= 2020; $m++) { ?>

                                <option value="<?php echo $m; ?>"><?php echo $m; ?></option>

<?php } ?>

                        </select>

                    </div>

                    <div class="Inputblocks">

                        <label>Card Verification Number : </label>

                        <input style="width:75px;" type="text" id="cvv_number" name="cvv_number" class="validate[required] text-input" value="" maxlength="5"  />

                    </div>

                </div>

            </div>
            <div class="Plyercontinfo">

                <div style="width:auto; float:left; padding:0 0 0 15px;">

                    <input type="checkbox" id="no_refund_chkbx" checked="checked" name="no_refund_chkbx" class="validate[required] text-input" value="accepted"  />

                    &nbsp;&nbsp;<strong>I understand that NO REFUNDS will be granted for this event.</strong> </div>



            </div>
            <div>
			<input type="submit" id="completestep2" value="COMPLETE STEP 2" name="completestep2" class="Movertobutton" />
		
		</div>
    </div>

    </form>

    <!--Introduction right end here-->

</div>

</div>
 
<?php get_footer();?>
