<?php

namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MailController;

class LoginController extends Controller
{
    public function show(){
        if(Auth::check())
            return redirect()->to('/home');

        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)){
           return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);


        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    public function form_forget(Request $request){
        return view('auth.forget');
    }

    public function forget(Request $request){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $user = User::where('cedula', '=', $request->cedula)->first();

        if($user === null){
            $request->validate([
                'cantidad' => ['required', new UsuarioInvalido],
            ]);
        }

        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $user->password = $randomString;
        $user->save();

        $mail = new PHPMailer(true);

        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPDebug = 0;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "xxx@gmail.com";
        $mail->Password = "xxx";
        $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ));

        $mail->AddAddress($user->email, $user->name);
        $mail->Subject = "Recuperacion de Clave";
        $mail->Body = "Saludos,\n   su clave nueva es: " . $randomString;

        try{
            $mail->Send();
        } catch(Exception $e){
            echo "Fail - " . $mail->ErrorInfo;
        }

        return redirect()->to('/login');
    }

    public function authenticated(Request $request, $user){
        return redirect('/home');
    }
}
