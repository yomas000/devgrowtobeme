<?php

namespace App\Controllers;

use Mailgun\Mailgun;

class Test extends BaseController
{
    public function index()
    {
        # Include the Autoloader (see "Libraries" for install instructions)
# Instantiate the client.
$mgClient = new Mailgun(getenv("MAIL_API", false));
$domain = "mail.growtobe.me";
# Make the call to the client.
$result = $mgClient->sendMessage($domain, array(
	'from'	=> 'thomasd@mail.growtobe.me',
	'to'	=> 'timothy.aaron.dick@gmail.com',
	'subject' => 'Hello',
	'text'	=> '<body style="background-color:blue;"><h1>Hello There</h1></body>'
));
    }
}
