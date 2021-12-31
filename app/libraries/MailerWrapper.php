<?php 

    class MailerWrapper{

        private $mail;
        
        public function __construct()
        {
            $this->mail = new PHPMailer();
        }

        private function authenticate_server(){
            $this->mail->isMail();                                            //Send using SMTP
            $this->mail->Host       = 'localhost';                       //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;
            $this->mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
            $this->mail->Port       = 587;
            $this->mail->isHTML(true);
        }
        
        private function authenticate_sender(){
            $this->mail->Username   = 'squ4doption@gmail.com';               //SMTP username
            $this->mail->Password   = 'Abc@123456';
            $this->mail->setFrom('squ4doption@gmail.com', 'squ4doption');
        }

        /*call this function to send emails.
        eg: 
            $mail = new MailerWrapper();
            $mail->send_email("example@gmail.com","example","example");
        */
        public function send_email($receiver_address,$subject,$mail_body){
            $this->authenticate_server();
            $this->authenticate_sender();

            $this->mail->addAddress($receiver_address);

            $this->mail->Subject = $subject;
            $this->mail->Body    = $mail_body;

            if(!$this->mail->send())
                die("something went wrong:((");
        }
    }
