<?php
require 'Dbconnection.php';

class Common extends Dbconnection {

    public function uploads($file, $dest) {
        $Imagefile = $_FILES[$file];
//        print_r($Imagefile);
//file properties

        $fileName = $Imagefile['name'];
        $fileType = $Imagefile['type'];
        $fileSize = $Imagefile['size'];
        $fileTempName = $Imagefile['tmp_name'];
        $fileError = $Imagefile['error'];
//        print_r($fileName);
//file upload
        $fileExt = explode('.', $fileName);
        $fileExt = strtolower(end($fileExt));
//        print_r($fileExt);

        $allowedExt = array('png', 'jpeg', 'jpg', 'pdf');

        if (in_array($fileExt, $allowedExt)) {
            if ($fileError === 0) {
                if ($fileSize <= '2000000') {
                    $fileNew = uniqid('', TRUE) . '.' . $fileExt;
                    $fileDest = $dest . $fileNew;
//                    print_r($fileDest);

                    if (!empty($_SESSION['crop_items'])) {
                        $crop_items = $_SESSION['crop_items'];
                    } else {
                        $crop_items = array();
                    }
//array_push($crop_items,$fileDest);

                    if (move_uploaded_file($fileTempName, $fileDest)) {

                        array_push($crop_items, $fileDest);
                        $_SESSION['crop_items'] = $crop_items;
//                               header("Location:./crop");
//                            echo sizeof($_SESSION['crop_items']);
                        return $fileDest;
                    }
                } else {
                    echo "Image Upload Error";
                }
            }
        }
    }

    public function SendVerificationMail($name, $email, $random_hash) {

        require './PHPMailer/class.phpmailer.php';
        require './PHPMailer/class.smtp.php';

        $from = "projectatcm@gmail.com";
        $from_name = "3 Wheels";
        $subject = "Verification code from 3 Wheels";
        $body = "This is the verification code for this email adddress '.$random_hash.'";
        $to = $email;



        $mail = new PHPMailer;  // create a new object
        $mail->IsSMTP(); // enable SMTP
// $mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only

        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = "projectatcm@gmail.com";
        $mail->Password = "CODEMAGOS";

        $mail->SetFrom($from, $from_name);
        $mail->addReplyTo($from);
        $mail->Subject = $subject;
        $mail->IsHTML(true);
        $mail->Body = $body;
        $mail->AddAddress($to);

        if (!empty($cc)) {
            $mail->addCC($cc);
        }
        if (!empty($bcc)) {
            $mail->addBCC($bcc);
        }

        if (!$mail->Send()) {
            echo $error = 'Mail error: ' . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }

    public function SendEnquiryMail($tenderownerName, $tenderownerEmail, $username, $usermail, $t_id, $t_aboutwork, $t_bud, $t_date, $t_loc, $t_worktype) {

        require './PHPMailer/class.phpmailer.php';
        require './PHPMailer/class.smtp.php';

        $from = $tenderownerEmail;
        $from_name = "Builders website $tenderownerName";
        $subject = "Enquiry to Mr.$tenderownerName from $username";
        $body = "<h1>We are interested in your tender submitted on $t_date</h1>"
                . "<br>"
                . "<h3>Kindely contact us with this mail address</h3>";

        $to = $usermail;

        $mail = new PHPMailer;  // create a new object
        $mail->IsSMTP(); // enable SMTP
// $mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only

        $mail->SMTPAuth = true;  // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->Username = "projectatcm@gmail.com";
        $mail->Password = "CODEMAGOS";

        $mail->SetFrom($from, $from_name);
        $mail->addReplyTo($from);
        $mail->Subject = $subject;
        $mail->IsHTML(true);
        $mail->Body = $body;
        $mail->AddAddress($to);

        if (!empty($cc)) {
            $mail->addCC($cc);
        }
        if (!empty($bcc)) {
            $mail->addBCC($bcc);
        }

        if (!$mail->Send()) {
            echo $error = 'Mail error: ' . $mail->ErrorInfo;
            return false;
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Enquiry mail has been send");';
            echo 'window.location="userinterest.php";';
            echo '</script>';
            return true;
        }
    }

}
?>

