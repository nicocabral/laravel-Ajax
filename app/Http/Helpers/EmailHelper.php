<?php 
namespace App\Http\Helpers;
use Mail;
class EmailHelper{


	public function sendCredentials($email,$password){
		\Config::set('mail.from.address', 'cmtest@igentechnologies.com');
		\Config::set('mail.from.name', 'Test Sender');
		\Config::set('mail.host', 'mail.igentechnologies.com');
		\Config::set('mail.port', '587');
		\Config::set('mail.username', 'cmtest@igentechnologies.com');
		\Config::set('mail.password', '!p@ssw0rd1!');

        // $template = $this->template;
        // $recipient = $this->recipient;
        // $subject = $this->subject;

       $send = Mail::send([/*view template*/], [/*data to be passed to template*/], function($message) use ($email, $password) {
                    $message->to('ncabral010694@gmail.com')->subject('testing')
                    ->setBody('Username/Email: '.$email. '<br> Password: '.$password, 'text/html');
                });
     
   }

	
}