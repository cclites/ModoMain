<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
     
     /*
	  * This is not the LAravel way to do things, as it is bypassing the session
	  * hijacking check. However. Modobot uses its own code to prevent this, so
	  * I don't feel too bad. It is easy to fix by simply passing the crf token 
	  * with all ajax requests.
	  */
    protected $except = [
        '/account',
        '/state',
        '/messages',
        '/history',
        '/update',
        '/resetbalance',
        '/resethistory',
        '/transactions',
        '/updatelogin',
        '/updateemail',
        '/updatebsconfigs',
        '/activateaccount',
        '/addnewuser',
        '/resetpassword',
        '/resendvalidation',
        '/updateuserconfigs',
        '/priceNotification',
    ];
}
