<?php
    if( ! defined('BASEPATH')) exit('No direct script access allowed'); 
    include_once getcwd().'/mandrill/'."lib/swift_required.php"; 
    
    function SendEmail($userData) 
    {
        $CI = & get_instance();
        $CI->load->library('parser');
               
        if($userData->purpose=="forgot_password")
        {
            $data = array(
                            'id'=>$userData->fld_id,
                            'username'=>$userData->fld_username,
                            'reset_token'=>$userData->reset_token
            );
            $message = $CI->parser->parse('user/forgot_password_template', $data, TRUE);
            echo $message;exit;
            
            $to = $userData->fld_email;
            $subject = "Reset your password";
            
            $CI->session->set_flashdata('message', 'Your reset token to reset your password has been sent to your email address.');
        }
        elseif($userData->purpose=="send_confirmation_email")
        {
            $data = array(
                    'id'=>$userData->fld_id,
                    'username' => $userData->fld_username,
                    'key' => $userData->fld_key,
                    'email' => $userData->fld_email
                );
            $message = $CI->parser->parse('user/confirmation_email_template', $data, TRUE);
            echo $message;exit;
            
            $to = $userData->fld_email;
            $subject = "Please confirm your account";
               
            $CI->session->set_flashdata('message', 'Your confirmation link has been sent to your email address.');
        }
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Photoshare <iamgallarian.com>' . "\r\n";
        mail($to, $subject, $message, $headers);
        
    }
?>    