<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ClaveMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function send($email, $clave)
    {
        $objDemo = new \stdClass();

        Mail::to($email)->send(new ClaveMail($objDemo, $clave));
    }
}
