<?php
    function kirim_email(array $data){
        $ci                 = & get_instance();
        $mail               = $ci->phpmailer_lib->load();
        $mail->isSMTP();
        $mail->Host         = 'smtp.gmail.com';
        $mail->SMTPAuth     = true;
        $mail->Username     = 'kalkulatorcetak@gmail.com';
        $mail->Password     = 'acimadskeqcfrvwm';
        // $mail->Username  = 'rangkasku@gmail.com';
        // $mail->Password  = 'uolwpnqkcndgrxju';
        $mail->SMTPSecure   = 'ssl';
        $mail->Port         = 465;
        // $mail->SMTPDebug = 2;
        
        $mail->setFrom('no-replay@kalkulatorcetak.com', 'KALKULATORCETAK');//email pengirim
        $mail->addAddress($data['email'],$data['title']); //email tujuan
        $mail->isHTML($data['isHTML']); // Aktifkan jika isi emailnya berupa html
        
        ob_start();
        
        ob_end_clean();
        
        $mail->Subject = $data['subject'];
        $mail->Body = $data['body'];
        $mail->AltBody = "kalkulatorcetak.com | hitung cept harga tepat";
        $mail->AddEmbeddedImage(FCPATH.'/assets/img/'.$data['logo'], 'logo_jrp',$data['logo']); // Aktifkan jika ingin menampilkan gambar dalam email
        
        try {
            $mail->send();
            $arr['status'] = 'terkirim';
            $arr['msg'] = "<h1>Email berhasil dikirim ke ".$data['email']."</h1><br /><a href='index.php'>Kembali ke Form</a>";
            } catch (Exception $e) {
            $arr['status'] = 'gagal';
            $arr['msg'] = $mail->ErrorInfo();
        }
        return $arr;
    }
?>
