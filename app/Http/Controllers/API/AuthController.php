<?php 
namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{

    /* public function login(Request $request)
    {
        try {
            $credentials = [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ];
            $user = User::where('username', $credentials['username'])->first();

            if (Auth::attempt($credentials)){
                if($user->has_two_fa && !empty($user->secret) && $request->input('totp') == ''){
                    return response()->json( [
                        'showTOTP' => true,
                    ], 200 );
                }

                if($user->has_two_fa && !empty($user->secret) && $request->has('totp')){
                    $code = $request->input('totp');
                    if(!static::verifyTOTP($user->secret,$code)){
                        return response()->json( [
                            'showTOTP' => true,
                            'errorCode' => true,
                        ], 200 );
                    }
                }
                
                auth()->loginUsingId( User::where( 'username',  $credentials['username'] )->first()->id );
                $user = auth()->user();
                $token = $user->createToken( 'grp_session' )->accessToken;
                // User won´t log because it needs two FA yet
                if ($user->has_two_fa && (!isset($user->secret) || empty($user->secret))) {
                    $label = config('app.name') . "-" . $user->username;
                    $otpSecret = static::getTOTPSecret();
                    $user->secret = $otpSecret;
                    $user->save();
                    $otpUri = static::generateTOTPUri($otpSecret,$label,$token);
                    $qrCode = base64_encode(QrCode::format('png')->size(400)->generate($otpUri));
                    return response()->json( [
                        'authenticated' => false,
                        'setTwoFA'      => true,
                        'qrCode'        => $qrCode,
                        'usr'           => Crypt::encryptString($user->id),
                    ], 200 );
                }

                if ($token) {
                    return response()->json( [
                        'authenticated'             => true,
                        'sgv_token'                 => $token,
                        'sgv_hash'                  => $user->hash,
                        'user'                      => static::getSessionInfo( $user->id ),
                        'sgv_token_expiration'      => date( 'D M d Y H:i:s', strtotime( "+8 hours" ) ),
                    ], 200 );
                }
            }
            return response()->json( [
                'authenticated' => false,
            ], 200 );
        }
        catch ( \Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ] );
        }
    } */

    public function login(Request $request)
    {
        try {
            $credentials = [
                'username' => $request->input('username'),
                'password' => $request->input('password'),
            ];
            $user = User::where('username', $credentials['username'])->first();
            $isValid = Hash::check($credentials['password'], $user->password);
            if ($isValid && $user->is_active == true){
                $token = $user->createToken( 'sci_session' )->accessToken;
                if ($token) {
                    return response()->json( [
                        'authenticated'             => true,
                        'sci_token'                 => $token,
                        'sci_hash'                  => $user->hash,
                        'user'                      => static::getSessionInfo( $user->id ),
                        'sci_token_expiration'      => date( 'D M d Y H:i:s', strtotime( "+8 hours" ) ),
                    ], 200 );
                }
            }
            return response()->json( [
                'authenticated' => false,
            ], 200 );
        }
        catch ( \Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ] );
        }
    }

    public function logout()
    {
        $authenticated = true;
        Auth::logout();
        if ( !Auth::check() ) {
            $authenticated = false;
        }

        return response()->json( [
            'authenticated' => $authenticated
        ], 200 );
    }

    public function userInfo(){
        try {
            $id = Auth::id();
            $user = static::getSessionInfo($id);
            return response()->json([
                'status' => 200,
                'user' => $user
            ],200);
        }
        catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public static function getSessionInfo($id)
    {
        $user = User::find( $id );
        $user->encryptedId = Crypt::encryptString($user->id);
        unset($user->id);
        return (object)[
            'encryptedId' => $user->encryptedId,
            'username'    => $user->username,
            'email'       => $user->email,
            'name'        => $user->name,
            'last_name'   => $user->last_name,
            'second_last_name'  => $user->second_last_name,
            'full_name'   => $user->getFullNameAttribute()
        ];
        //return $user->getprofile;
    }
}
