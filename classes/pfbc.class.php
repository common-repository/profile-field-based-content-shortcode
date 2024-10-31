<?php
if(!class_exists('Profile_Field_Based_Content'))
{
   
        class Profile_Field_Based_Content{
          
            function __construct(){
               add_shortcode('profile_field_content',array($this,'profile_field_based_content'));
  
            }
            public function activate(){
              // ADD Custom Code which you want to run when the plugin is activated
            }
            public function deactivate(){
                    
            }
            function profile_field_based_content($atts, $content = null){
              
              extract(shortcode_atts(array(
                      'id'   => '',
                      'profile_field'   => '',
                      'profile_field_value'=>'',
                            ), $atts));
              global $post;
              if(empty($id)){
                $id=$post->ID;
              }
              $user_id=get_current_user_id();
              $user_profile_field=bp_get_profile_field_data( 'field='.$profile_field.'&user_id=' .$user_id );
              if(!is_user_logged_in() || !isset( $user_profile_field)){
                return apply_filters('pfbc_blank_message','', $user_profile_field,$user_id,$profile_field,$profile_field_value);
              }
               
              if(isset($profile_field) && isset($user_profile_field) && isset($profile_field_value) && $profile_field_value==$user_profile_field){
                 return apply_filters('the_content',$content);

              }

            }
            
        }

}