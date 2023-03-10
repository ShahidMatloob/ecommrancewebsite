<?php
ob_start();
session_start();
include '../inc/config.php';


if(isset($_POST['contact'])){
    
    $user_name = $_POST['user_name'];   
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $date = date("d/m/Y h:i A") ;
    
    $query = mysqli_query($connection,"INSERT INTO `contact`(`name`, `email`, `subject`, `message`, `date`) VALUES ('$user_name','$email','$subject','$message','$date')");
    
    if($query){
        
        $email_to = 'ayeza833@gmail.com';
        
        // Subject
        $email_subject = $user_name . " email you from Contact us Form";
        
        // Message
        $email_message = '


        <!DOCTYPE html>
            <html>
            
            <head>
                <title></title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <style type="text/css">
                    body,
                    table,
                    td,
                    a {
                        -webkit-text-size-adjust: 100%;
                        -ms-text-size-adjust: 100%;
                    }
            
                    table,
                    td {
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                    }
            
                    img {
                        -ms-interpolation-mode: bicubic;
                    }
            
                    img {
                        border: 0;
                        height: auto;
                        line-height: 100%;
                        outline: none;
                        text-decoration: none;
                    }
            
                    table {
                        border-collapse: collapse !important;
                    }
            
                    body {
                        height: 100% !important;
                        margin: 0 !important;
                        padding: 0 !important;
                        width: 100% !important;
                    }
            
                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: none !important;
                        font-size: inherit !important;
                        font-family: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                    }
            
                    @media screen and (max-width: 480px) {
                        .mobile-hide {
                            display: none !important;
                        }
            
                        .mobile-center {
                            text-align: center !important;
                        }
                    }
            
                    div[style*="margin: 16px 0;"] {
                        margin: 0 !important;
                    }
                </style>
            
            <body style="margin: 0 !important; padding: 0 !important; background-color: #eeeeee;" >
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td align="center" style="background-color: #eeeeee;" bgcolor="#eeeeee">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                <tr>
                                    <td align="center" valign="top" style="font-size:0; padding: 35px;" bgcolor="#282828">
                                        <div style="display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;">
                                          <h1 style="font-size: 36px; font-weight: 800; margin: 0; color: #ffffff;font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 30px; font-weight: 800; line-height: 48px;" class="mobile-center">Contact Us Email</h1>
                                        </div>
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td style="padding: 35px 35px 20px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                                        <table  border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                            <tr>
                                                <td style="font-family: Open Sans, Helvetica, Arial, sans-serif;  padding-top: 25px;"> 
                                                    <p style="font-size: 20px; font-weight: 700; line-height: 24px; color: #777777;"> Email From </p>
                                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> ' . $user_name . ' <' . $email . '> </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: Open Sans, Helvetica, Arial, sans-serif;  padding-top: 25px;"> 
                                                    <p style="font-size: 20px; font-weight: 700; line-height: 24px; color: #777777;"> Subject </p>
                                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> ' . $subject . ' </p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="padding-top: 20px;">
                                                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                        <tr>
                                                            <td width="75%" align="left" bgcolor="#eeeeee" style="font-family: Open Sans, Helvetica, Arial, sans-serif;  padding: 10px;"> 
                                                                <p style="font-size: 20px; font-weight: 700; line-height: 24px; color: #777777;"> Message </p>
                                                                <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777;"> ' . $message . ' </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style=" padding: 35px; background-color: #ff7361;">
                                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                                            <tr>
                                                <td align="center" style="padding: 25px 0 15px 0;">
                                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #ffffff;"> Sass Online Store </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            
            </html>

        ';
        
        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        
        // Additional headers
        $headers[] = 'From:  '.$user_name.'<'.$email.'>';
        
        
        // Mail it
        mail($email_to, $email_subject, $email_message, implode("\r\n", $headers));
        
        $_SESSION['contact_msg'] = "Your Message hase been sent.";
        header('Location:../contact-us.php');
    }else{
        $_SESSION['contact_msg'] = "Something went wrong. Please, check your Form agai. ";
        header('Location:../contact-us.php');
    }
    
    
    
    
    
    
    
}
?>