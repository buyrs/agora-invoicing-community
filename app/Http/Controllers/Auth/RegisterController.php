<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ProfileRequest;
use App\Model\Common\Setting;
use App\Model\Common\StatusSetting;
use App\User;
use Facades\Spatie\Referer\Referer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function postRegister(ProfileRequest $request, User $user)
    {
        $apiKeys = StatusSetting::value('recaptcha_status');
        $captchaRule = $apiKeys ? 'required|' : 'sometimes|';
        $this->validate($request, [
            'g-recaptcha-response-1' => $captchaRule.'captcha',
        ], [
            'g-recaptcha-response-1.required' => 'Robot Verification Failed. Please Try Again.',
        ]);
        try {
            $location = getLocation();

            $state_code = $location['iso_code'].'-'.$location['state'];

            $state = getStateByCode($state_code);
            $user->state = $state['id'];
            $password = Str::random(20);
            $user->password = \Hash::make($password);
            $user->town = $location['city'];
            $user->profile_pic = '';
            $user->active = 0;
            $user->mobile_verified = 0;
            $user->country = $request->input('country');
            $user->mobile = ltrim($request->input('mobile'), '0');
            $user->mobile_code = $request->input('mobile_code');
            $user->role = 'user';
            $user->company = strip_tags($request->input('company'));
            $user->address = strip_tags($request->input('address'));
            $user->email = strip_tags($request->input('email'));
            $user->first_name = strip_tags($request->input('first_name'));
            $user->last_name = strip_tags($request->input('last_name'));
            $user->user_name = strip_tags($request->input('email'));
            $user->manager = $user->assignSalesManager();
            $user->ip = $location['ip'];
            $user->timezone_id = getTimezoneByName($location['timezone']);
            $user->referrer = Referer::get(); // 'google.com'
            $user->save();

            //check in the settings
            $settings = new \App\Model\Common\Setting();
            $settings = $settings->where('id', 1)->first();

            //template
            $template = new \App\Model\Common\Template();
            $temp_id = $settings->where('id', 1)->first()->password_mail;
            $template = $template->where('id', $temp_id)->first();
            $from = $settings->email;
            $to = $user->email;
            $subject = $template->name;
            $data = $template->data;
            $replace = ['name' => $user->first_name.' '.$user->last_name,
                'username'         => $user->email, 'password' => $password, ];
            $type = '';

            if ($template) {
                $type_id = $template->type;
                $temp_type = new \App\Model\Common\TemplateType();
                $type = $temp_type->where('id', $type_id)->first()->name;
            }
            $mail = new \App\Http\Controllers\Common\PhpMailController();
            $mail->sendEmail($from, $to, $data, $subject, $replace, $type);

            $emailMobileStatusResponse = $this->getEmailMobileStatusResponse($user);

            activity()->log('User <strong>'.$user->first_name.' '.$user->last_name.'</strong> was created');

            return response()->json($emailMobileStatusResponse);
        } catch (\Exception $ex) {
            app('log')->error($ex->getMessage());
            $result = [$ex->getMessage()];

            return response()->json($result);
        }
    }

    protected function getEmailMobileStatusResponse($user)
    {
        $emailMobileSetting = StatusSetting::select('emailverification_status', 'msg91_status')->first();
        if ($emailMobileSetting->emailverification_status == 0 && $emailMobileSetting->msg91_status == 1) {
            $user->mobile_verified = 0;
            $user->active = 1;
            $response = ['type' => 'success', 'user_id' => $user->id, 'message' => 'Your Submission has been received successfully. Verify your Mobile to log into the Website.'];
        } elseif ($emailMobileSetting->emailverification_status == 1 && $emailMobileSetting->msg91_status == 0) {
            $user->mobile_verified = 1;
            $user->active = 0;
            $response = ['type' => 'success', 'user_id' => $user->id, 'message' => 'Your Submission has been received successfully. Verify your Email to log into the Website.'];
        } elseif ($emailMobileSetting->emailverification_status == 0 && $emailMobileSetting->msg91_status == 0) {
            $user->mobile_verified = 1;
            $user->active = 1;
            $response = ['type' => 'success', 'user_id' => $user->id, 'message' => 'Your have been Registered Successfully.'];
        } else {
            $response = ['type' => 'success', 'user_id' => $user->id, 'message' => 'Your Submission has been received successfully. Verify your Email and Mobile to log into the Website.'];
        }

        return $response;
    }

    protected function getUserCurrency($userCountry)
    {
        $currency = Setting::find(1)->default_currency;
        if ($userCountry->currency->status) {
            return $userCountry->currency->code;
        }

        return $currency;
    }

    protected function getUserCurrencySymbol($userCountry)
    {
        $currency_symbol = Setting::find(1)->default_symbol;
        if ($userCountry->currency->status) {
            return $userCountry->currency->symbol;
        }

        return $currency_symbol;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        // ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => bcrypt($data['password']),
        // ]);
    }
}
