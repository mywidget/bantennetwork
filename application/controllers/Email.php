<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Email extends CI_Controller{
        
        function  __construct(){
            parent::__construct();
            $this->load->library('phpmailer_lib');
            $this->load->helper('body');
        }
        
        function kirim_email_konfirmasi(){
            $mailContent = [
            'site_name'     =>'kalklatorcetak.com',
            'url_token'     =>"https://kalkulatorcetak.com/dasfaf",
            'url_simulasi'  =>"https://kalkulatorcetak.com/simulasi"
            ];
            $body_isi = email_konfirmasi($mailContent);
            $arr = [
            'isHTML'    =>true,
            'body'          =>$body_isi,
            'logo'          =>'mail_logo_icon.png',
            'subject'       =>'Konfirmasi Pendaftaran',
            'email'         =>'fazrulrm@gmail.com',
            'title'         =>'Owner'
            ];
            $status = kirim_email($arr);
            if($status['status']=='terkirim'){
                echo $status['msg'];
            }
        }
        function send(){
            // Load PHPMailer library
            
            
            // PHPMailer object
            $mail = $this->phpmailer_lib->load();
            
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'rangkasku@gmail.com';
            $mail->Password   = 'uolwpnqkcndgrxju';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->SMTPDebug  = 2;
            
            
            $mail->setFrom('info@kalklatorcetak.com', 'kalklatorcetak');
            $mail->addReplyTo('kalklatorcetak@gmail.com', 'kalklatorcetak');
            
            // Add a recipient
            $mail->addAddress('fazrulrm@gmail.com');
            
            // Add cc or bcc 
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
            
            // Email subject
            $mail->Subject = 'Send Email via SMTP using PHPMailer in CodeIgniter';
            
            // Set email format to HTML
            $mail->isHTML(true);
            
            // Email body content
            $mailContent = "<h1>Send HTML Email using SMTP in CodeIgniter</h1>
            <p>This is a test email sending using SMTP mail server with PHPMailer.</p>";
            $mail->Body = $mailContent;
            
            // Send email
            if(!$mail->send()){
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                }else{
                echo 'Message has been sent';
            }
        }
        
    }        