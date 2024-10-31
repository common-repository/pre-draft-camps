<?php session_start();

if(!isset($_REQUEST['cid']) || trim($_REQUEST['cid'])==''){
 wp_redirect(home_url());
}
if($_REQUEST['cid']!=''){

global $wpdb;
    $post_exists = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE id = '" . $_REQUEST['cid'] . "'", 'ARRAY_A');
    if($post_exists){
     //do nothing
    } else {
      wp_redirect(home_url());
    }
	
if(!check_camp_registration($_REQUEST['cid'])){
		 	$_SESSION['error'] = "Maximum enrollment has reached. Please contact to Administrator.";
 			wp_redirect(home_url());
			exit;
	}
	$_SESSION['camp_id']=$_REQUEST['cid'];
 $camp_detail= new WP_Query( array( 'post_type' => 'pdc_camp', 'post__in' => array( $_REQUEST['cid'] ) ) );
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



  <!--Left tabs block start here-->



  <div class="Tabsleft">



    <div class="Bannerbgmain">

 

      



      <?php while ( $camp_detail->have_posts() ) {
	$camp_detail->the_post();?>



      <div class="Birminghamblock Relative">



        <div class="Editbtn"><a href="<?php echo get_permalink();?>">Edit</a></div>



        <h3><?php echo get_the_title();?></h3>



        <p><em><strong><?php echo date('M d, Y',get_post_meta(get_the_ID(),'pdc_camp_start_date',true))?></strong></em><br />

		<?php  
							 $camp_venue = get_post_meta(get_the_ID(),'pdc_camp_venue',true);
							 
  echo (trim(get_the_title($camp_venue))!='')? '<strong>'.get_the_title($camp_venue).'</strong><br />':'';?>
				<?php echo (trim(get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ))!='')? wordwrap(get_post_meta( $camp_venue, 'wp_pdc_venue_address', true ),55,'<br>').',<br />':'';?>

							<?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_city', true ))!='')?getCityName(get_post_meta( $camp_venue, 'pdc_venue_city', true )).',':'';?>

							<?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_state', true ))!='')?' '.getStateName(get_post_meta( $camp_venue, 'pdc_venue_state', true )).',':'';?>

							 <?php echo (trim(get_post_meta( $camp_venue, 'pdc_venue_zip', true ))!='')?' '.get_post_meta( $camp_venue, 'pdc_venue_zip', true ):'';?></p>



      </div>



      <div class="Birminghamblock">



        <p><strong>Cost $<?php echo get_post_meta(get_the_ID(),'pdc_camp_fees',true);?></strong></p>



      </div>



      <?php }  wp_reset_query();   ?>



    </div>



  </div>



  <!--Left tabs block end here-->



  <!--Introduction right start here-->



  <form action="<?php echo home_url('pdc_camp_registration_two')?>" method="post" id="step21" name="step21" >



    <div class="Introductionright">



      <h1>Player Registration </h1>



       



      <div class="Floatright Farial Text11 Red">All fields required.</div>

<?php if(isset($_SESSION['error']) && $_SESSION['error']!=""){?>



        <?php echo'<div class="npdc_error">'.$_SESSION['error'].'</div>'; 

$_SESSION['error']='';

						unset($_SESSION['error']);



					  ?>



        <?php }?>

      <!--first block-->



      <div class="Registerright">



        <h2>Player's Contact Information</h2>

 
        



        <div class="Plyercontinfo"> <a href="#" id="players_contact_information"></a>



          <div class="Inputblocks">



            <label>First Name :</label>



            <input type="text" id="fname" style="width:275px;" name="fname" class="validate[required] text-input" value="<?php echo $_SESSION['fname'];?>"  />



          </div>



          <div class="Inputblocks">



            <label>Last Name :</label>



            <input type="text" id="lname" name="lname" style="width:340px;" class="validate[required] text-input" value="<?php echo $_SESSION['lname'];?>"  />



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>Daytime Phone :</label>



            <input type="text" id="dtphone" style="width:275px;" name="dtphone" class="validate[required,custom[phone]] text-input" value="<?php echo $_SESSION['dtphone'];?>"  />



          </div>



          <div class="Inputblocks">



            <label>Evening Phone :</label>



            <input type="text" style="width:340px;" id="evphone" name="evphone" class="validate[required,custom[phone]] text-input" value="<?php echo $_SESSION['evphone'];?>"   />



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>Address 1 : </label>



            <input type="text" id="add1" style="width:275px;" name="add1" class="validate[required] text-input" value="<?php echo $_SESSION['add1'];?>"   />



          </div>



          <div class="Inputblocks">



            <label>Email Address 1:</label>



            <input type="text" id="emailadd1" style="width:340px;" name="emailadd1" class="validate[required,custom[email]] text-input" value="<?php echo $_SESSION['emailadd1'];?>"   />



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>City :</label>



            <?php



		  	//cityDrpDown('camp_city','camp_city',0,$_SESSION['camp_city'],'',1,'validate[required] text-input');



		  ?>



            <input type="text" id="camp_city" style="width:275px;" name="camp_city" class="validate[required] text-input" value="<?php echo $_SESSION['camp_city'];?>"   />



          </div>



          <div class="Inputblocks">



            <label>State :</label>



            <?php



		  	stateDrpDown_normal('camp_state','camp_state',0,array('0'=>$_SESSION['camp_state']),'','camp_city',1,'validate[required] text-input');



		  ?>



          </div>



          <div class="Inputblocks">



            <label>Zip :</label>



            <input type="text" id="zip" name="zip" style="width:72px;" class="validate[required] text-input" value="<?php echo $_SESSION['zip'];?>"   />



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label> Address 2 :</label>



            <input type="text" id="add2" name="add2" style="width:275px;" class="text-input" value="<?php echo $_SESSION['add2'];?>"   />



          </div>



          <div class="Inputblocks">



            <label>Email Address 2:</label>



            <input type="text" id="emailadd2" style="width:340px;" name="emailadd2" class="text-input" value="<?php echo $_SESSION['emailadd2'];?>"   />



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>City :</label>



            <?php



		  	//cityDrpDown('camp_city2','camp_city2',0,$_SESSION['camp_city2'],'',1,'validate[required] text-input');



		  ?>



            <input type="text" id="camp_city2" style="width:275px;" name="camp_city2" class="text-input" value="<?php echo $_SESSION['camp_city2'];?>"   />



          </div>



          <div class="Inputblocks">



            <label>State :</label>



            <?php



		  	stateDrpDown_normal('camp_state2','camp_state2',0,array('0'=>$_SESSION['camp_state2']),'','1','text-input');



		  ?>



          </div>



          <div class="Inputblocks">



            <label> Zip : </label>



            <input type="text" id="zip2" name="zip2" style="width:72px;" class="text-input" value="<?php echo $_SESSION['zip2'];?>"   />



          </div>



        </div>



      </div>



      <!--first block-->



      <!--personal information-->



      <div class="Registerright">



        <h2>Personal Information</h2>



        <a href="#" id="personel_information"></a>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label> Age on Day of PDC :</label>



            <select id="age_on_pdc" name="age_on_pdc" class="validate[required] text-input">



              <option value="">-Select-</option>



              <?php for($j=10; $j <= 25;$j++){?>



              <option value="<?php echo $j;?>" <?php if($_SESSION['age_on_pdc']== $j){?> selected="selected"<?php }?>><?php echo $j;?></option>



              <?php } ?>



            </select>



          </div>



          <div class="Inputblocks">



            <label>Birthday :</label>



            <input type="text" style="width:127px;" id="birthday" name="birthday" class="validate[required] text-input" 



value="<?php echo $_SESSION['birthday'];?>" >



            <span class="Canlendaricon"><img style="cursor:pointer" onclick="javascript:NewCssCal('birthday','MMDDYYYY','dropdown',false,'24')" alt="" src="<?php bloginfo('template_url');?>/assets/calendar_icon.png"></span> </div>



          <div class="Inputblocks">



            <label>Grade On Day Of PDC :</label>



            <select id="grade" name="grade" class="validate[required] text-input" >



              <option value="">-Grade-</option>



              <option value="5th" <?php if( $_SESSION['grade']=='5th'){?> selected="selected"<?php }?>>-5th-</option>



              <option value="6th" <?php if( $_SESSION['grade']=='6th'){?> selected="selected"<?php }?>>-6th-</option>



              <option value="7th" <?php if( $_SESSION['grade']=='7th'){?> selected="selected"<?php }?>>-7th-</option>



              <option value="8th" <?php if( $_SESSION['grade']=='8th'){?> selected="selected"<?php }?>>-8th-</option>



              <option value="9th" <?php if( $_SESSION['grade']=='9th'){?> selected="selected"<?php }?>>-9th-</option>



              <option value="other" <?php if( $_SESSION['grade']=='other'){?> selected="selected"<?php }?>>-Other-</option>



            </select>



          </div>



          <div class="Inputblocks">



            <label>Gender :</label>

			

			<strong><select id="gender" name="gender" class="validate[required] text-input" >



              <option value="">-Gender-</option>



              <option value="m" <?php if( $_SESSION['gender']=='m'){?> selected="selected"<?php }?>>-Male-</option>



              <option value="f" <?php if($_SESSION['gender']=='f'){?> selected="selected"<?php }?>>-Female-</option>



            </select>



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>School :</label>



            <input type="text" style="width:640px;" id="school" name="school" class="validate[required] text-input" value="<?php echo $_SESSION['school'];?>"   />



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>Travel Team Program:</label>



            <input style="width:135px;" type="text" id="ttprog" name="ttprog" class="validate[required] text-input" value="<?php echo $_SESSION['ttprog'];?>"   />



          </div>



          <div class="Inputblocks">



            <label>Shirt Size : </label>



            <select id="shirt_size" name="shirt_size" class="validate[required] text-input" >



              <option value="">-Select-</option>



<!--      Omitted Feb 20, 2012 by client request. -Kirk          

<option value="S" <?php if($_SESSION['shirt_size']=='S'){?> selected="selected"<?php }?>>-Small-</option>

-->

              <option value="M" <?php if($_SESSION['shirt_size']=='M'){?> selected="selected"<?php }?>>-Medium-</option>



              <option value="L" <?php if($_SESSION['shirt_size']=='L'){?> selected="selected"<?php }?>>-Large-</option>



              <option value="XL" <?php if($_SESSION['shirt_size']=='XL'){?> selected="selected"<?php }?>>-XL-</option>



              <option value="2XL" <?php if($_SESSION['shirt_size']=='2XL'){?> selected="selected"<?php }?>>-2XL-</option>



              <option value="3XL" <?php if($_SESSION['shirt_size']=='3XL'){?> selected="selected"<?php }?>>-3XL-</option>



            </select>



          </div>

 



          <div class="Inputblocks">



            <label>Promotional Code:</label>



            <input type="text" id="promocode" style="width:194px;" name="promocode" class="text-input" value="<?php echo $_SESSION['promocode'];?>"   />



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>Facebook Page:</label>



            <input style="width:640px;" type="text" id="fb_page" name="fb_page" class="text-input" value="<?php echo $_SESSION['fb_page'];?>"   />



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>Twitter Page:</label>



            <input style="width:300px"  type="text" id="twitter_page" name="twitter_page" class="text-input" value="<?php echo $_SESSION['twitter_page'];?>"   />



          </div>



          <div class="Inputblocks">



            <label>YouTube Page:</label>



            <input  style="width:300px"  type="text" id="yt_page" name="yt_page" class="text-input" 



			value="<?php echo $_SESSION['yt_page'];?>"   />



          </div>
             



        </div>

 <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>About Yourself:</label>



           <textarea style="width:626px;" class="Textareabox" rows="4" cols="80" name="about_player"><?php echo $_SESSION['about_player']?></textarea>



          </div>



        </div>
        
        

        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>How did you hear about PDC?</label>



            <select id="hw_hr_pdc" name="hw_hr_pdc" class="text-input" >



              <option value="">-Select-</option>



              <option value="Internet" <?php if($_SESSION['hw_hr_pdc']=='Internet'){?> selected="selected"<?php }?> >-Internet-</option>



              <option value="Coach" <?php if($_SESSION['hw_hr_pdc']=='Coach'){?> selected="selected"<?php }?>>-Coach-</option>



              <option value="Friend" <?php if($_SESSION['hw_hr_pdc']=='Friend'){?> selected="selected"<?php }?>>-Friend-</option>



              <option value="School" <?php if($_SESSION['hw_hr_pdc']=='School'){?> selected="selected"<?php }?>>-School-</option>



              <option value="Other" <?php if($_SESSION['hw_hr_pdc']=='Other'){?> selected="selected"<?php }?>>-Other-</option>



            </select>



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <input type="checkbox" id="nike_more_info" name="nike_more_info" class="text-input" value="yes"  checked="checked"  />



            &nbsp;&nbsp;Check Here if you want more info about nike products, Nike EYB<br />



            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;events, messages from nike and other promotions.</div>



        </div>



      </div>



      <!--personal information-->



      <!--Medical Information-->



      <div class="Registerright">



        <h2>Medical Information</h2>



        <a href="#" id="medical_information"></a>



        <div class="Plyercontinfo">



          <div class="Inputblocks"> Emergency name and phone number to be used in the event of an injury that requires emergency treatment. </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>Parent/Guardian : </label>



            <input style="width:275px;" type="text" id="parent_name" name="parent_name" class="validate[required] text-input" 



			value="<?php echo $_SESSION['parent_name'];?>"  />



          </div>



          <div class="Inputblocks">



            <label>Parent's Phone :</label>



            <input style="width:340px;" type="text" id="parent_phone" name="parent_phone" class="validate[required,custom[phone]] text-input" value="<?php echo $_SESSION['parent_phone'];?>"  />



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>Family Physician:</label>



            <input style="width:275px;" type="text" id="family_phy" name="family_phy" class="text-input" value="<?php echo $_SESSION['family_phy'];?>"   />



          </div>



          <div class="Inputblocks">



            <label>Physician Phone : </label>



            <input style="width:140px;" type="text" id="phy_phone" name="phy_phone" class="text-input" value="<?php echo $_SESSION['phy_phone'];?>"   />



          </div>



          <div class="Inputblocks">



            <label>Medical Insurance Co. : </label>



            <input style="width:180px;" type="text" id="med_ins_comp" name="med_ins_comp" class="text-input" 



		   value="<?php echo $_SESSION['med_ins_comp'];?>"   />



          </div>



        </div>



        <div class="Plyercontinfo">



          <div class="Inputblocks">



            <label>Policy Number:</label>



            <input style="width:275px;" type="text" id="policy_number" name="policy_number" class="text-input" 



			value="<?php echo $_SESSION['policy_number'];?>"   />



          </div>



          <div class="Inputblocks">



            <label>Policy Holder Name:</label>



            <input style="width:140px;" type="text" id="policy_holder_name" name="policy_holder_name" class="text-input" value="<?php echo $_SESSION['policy_holder_name'];?>"   />



          </div>



        </div>



      </div>



      <!--Medical Information-->



      <div class="Plyercontinfo">



        <div style="width:auto; float:left; padding:0 0 0 15px;">



          <input type="checkbox" id="terms_acc" name="terms_acc" class="validate[required] text-input" value="accepted"  />



          &nbsp;&nbsp;<strong>I AGREE</strong> </div>



        <textarea name="textarea" cols="80" rows="4" readonly="readonly" class="Textareabox" style="width:626px; margin-left:31px; margin-top:3px;">MEDICAL RELEASE & LIABILITY WAIVER Parental Signature Required for ALL Campers







I understand that the Nike Pre Draft Camp ("PDC") is a rigorous basketball training camp, and that as the legal parent/guardian I am registering my child ("the Participant) to participate at his/her own risk. By signing this form, I demonstrate an understanding that Participant understands that as a condition to his/her participation in PDC, the Participant shall at all times be required to exercise reasonable care for his/her own safety and the safety of others, and shall abide by and conduct him/herself in a manner consistent with the rules and regulations of PDC. Accordingly, I agree on behalf of myself and the Participant, as well any related spouse, heirs, assigns related to individuals, and related entities, to hereby indemnify, release, waive, absolve, discharge and agree to hold harmless Pre Draft Camp LLC, Nike and any and all affiliated entities, including their representatives, volunteers, officers, directors, employees, officials, coaches, promoters, members, agents, affiliates, insurers and attorneys (collective, the "Released Parties"), from and against any and all rights, medical and personal injuries, claims, demands, causes, of action, obligations, suits, liens, damages, or liabilities of any kind and character whatsoever, whether known or unknown, suspected or claimed, which Participant shall or may have in the future against the Released Parties arising out of, based on, related to, or connected with Participant's participation in PDC and related activities. Participant and I further covenant and agree that in the event Participant is injured during PDC, Participant consents to treatment of any injury by an athletic trainer or other professional, subject to the provisions of this waiver, Release of Liability, Agreement Not to Sue, Hold Harmless and Indemnification Agreement. Participant and I authorize PDC, at its discretion, to arrange for transport to a hospital or other medical facility for further medical attention. Participant understands and agrees that PDC is not responsible for transporting Participant to, a hospital or medical facility that participates in his/her insurance plan/managed care plan. In the event the Participant does not have medical or accident insurance, I understand that Participant and I, and related parties, are hereby responsible for any and all medical expenses arising out of any injury suffered by the Participant and medical treatment received for such injury. Participant and I acknowledge that this Release of Liability, Agreement Not to Sue, Hold Harmless, and Indemnification Agreement is executed in exchange for the opportunity to participate PDC and related activities. Participant and I understand that the coaches, counselors, physicians, trainers, etc. ("the Staff") of PDC consists of independent contractors. By signing this form Participant understands and agrees that PDC shall not be responsible in any way for any actions, misconduct, or negligence of the Staff. I understand that by signing this registration and form, I am registering the Participant in PDC and am signing on behalf of myself, and the Participant. By signing this form, I hereby grant PDC the rights and permission to use the Participant's name and likeness for all publicity, advertising, promotion, commercial, media and other uses to the discretion of PDC.  Participant and I have read this Waiver, Release of Liability, Agreement Not to Sue, Hold Harmless and Indemnification Agreement in its Entirety; we understand it, voluntarily agree to it, and further understand that Participant has given up substantial rights by signing it and/or the person signing this document has the full authority and capacity as a legal parent/guardian to do so.</textarea>



      </div>



      <input type="hidden" id="camp_id" name="camp_id" value="<?php echo $_SESSION['camp_id'];?>" />



      <input type="submit" id="movetostep22" value="SUBMIT INFORMATION" name="movetostep22" 



				class="Movertobutton" />



    </div>



  </form>



  <!--Introduction right end here-->



</div>



<?php  get_footer(); ?>

