@extends('themes.default1.layouts.front.master')

 @section('title')
    Login | Register
@stop
@section('page-header')
    Login | Register
@stop
@section('page-heading')
    Sign in or Register
@stop
@section('breadcrumb')
    @if(Auth::check())
        <li><a href="{{url('my-invoices')}}">Home</a></li>
    @else
        <li><a href="{{url('login')}}">Home</a></li>
    @endif
    <li class="active">Login</li>
@stop
@section('main-class')
    main
@stop
@section('content')
     <?php
    use App\Http\Controllers\Front\CartController;
    $country = findCountryByGeoip($location['iso_code']);
    $states = findStateByRegionId($location['iso_code']);
    $states = \App\Model\Common\State::pluck('state_subdivision_name', 'state_subdivision_code')->toArray();
    $state_code = $location['iso_code'] . "-" . $location['state'];
    $state = getStateByCode($state_code);


    ?>  
    <style>
       /* .required:after{
            content:'*';
            color:red;
            padding-left:0px;
        }


        }*/

       /* .wizard-inner
        {
            display:none;
        }

        }

        .nav-tabs{
            border-bottom: none;
            margin: -5px;
        }
        .tab-content {
            border-radius: 0px;
            box-shadow: inherit;

            border: none ;
            border-top: 0;
            /*padding: 15px;*/
        }

        /*.open>.dropdown-menu {
            display: block;
            color:black;
        }
        .inner>.dropdown-menu{
            margin-top: 0px;
        }
        .bootstrap-select .dropdown-toggle .caret {
            display: none;
        }*/

        .form-control:not(.form-control-sm):not(.form-control-lg) {
            /*font-size: 13.6px;
            font-size: 0.85rem;*/
            line-height: normal;
        }*/




    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    
    <!-- <link rel="stylesheet" href="{{asset('client/css/selectpicker.css')}}" /> -->


    
   
     <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.css" /> -->
     <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/2.0.0-beta1/css/bootstrap-select.min.css" /> -->

     <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

     <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
     <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->


     <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.js"></script> -->
     <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/2.0.0-beta1/js/bootstrap-select.min.js"></script> -->

    <div class="row">
        <div class="col-md-12">

            <section>
                <div class="wizard">
                    <div class="wizard-inner" style="display: none">

                        <ul class="nav nav-tabs" role="tablist" style=" margin: -5px!important;">
                            <!--<li role="presentation" class="active">-->
                                <!--<a href="#step1" data-toggle="tab" aria-controls="step1" role="tab">-->


                                <!--</a>-->
                                <!--<p style="display: none">Contact Information</p>-->
                            <!--</li>-->
                            <!--<li role="presentation" class="disabled" >-->
                                <!--<a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" >-->


                                <!--</a>-->
                                <!--<p style="display: none">Identity Verification</p>-->
                            <!--</li>-->
                            <!--<li role="presentation" class="disabled">-->
                                <!--<a href="#step3" data-toggle="tab" aria-controls="complete" role="tab" title="Confirmation">-->


            <!--                     </a>
                                <p style="display: none">Confirmation</p>
                            </li>


                        </ul>
                    </div>
                    <div class="row tab-content">
                        <div class="col-md-12 tab-pane active" id="step1">
                            <div class="featured-boxes">
                                <div id="error">
                                </div>
                                <div id="success">
                                </div>
                                <div id="fails">
                                </div>
                                <div id="alertMessage1"></div>
                                <div id="alertMessage2"></div>
                             

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="featured-box featured-box-primary text-left mt-5">
                                            <div class="box-content">

                                                <h4 class="heading-primary text-uppercase mb-3">I'm a Returning Customer</h4>
                                                @if ($status->recaptcha_status==1 && $apiKeys->nocaptcha_sitekey != '00' && $apiKeys->captcha_secretCheck != '00')
                                                    {!!  Form::open(['action'=>'Auth\LoginController@login', 'method'=>'post','id'=>'formoid','onsubmit'=>'return validateform()']) !!}
                                                @else
                                                    {!!  Form::open(['action'=>'Auth\LoginController@login', 'method'=>'post','id'=>'formoid']) !!}
                                                @endif
                                                <div class="form-row">
                                                    <div class="form-group col">
                                             <label class="required" >E-mail Address</label>
                                                        <div class="input-group">
                                                            {!! Form::text('email1',null,['class' => 'form-control input-lg','id'=>'username','autocomplete'=>"off" ]) !!}
                                                            <div class="input-group-append">
                                                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                                                            </div>

                                                        </div>  
                                                        <span  style="color:#ff0000;">  <div>{{ $errors->login->first('email1') }}</div></span>
 -->
                                                        <!-- <h6 id="usercheck"></h6> -->

<!-- 
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col {{ $errors->has('password1') ? 'has-error' : '' }}">

                                                        <a class="pull-right" href="{{url('password/reset')}}">({{Lang::get('message.forgot-my-password')}})</a>
                                                        <label class="required" >Password</label>
                                                        <div class="input-group">
                                                            {!! Form::password('password1',['class' => 'form-control input-lg' ,'id'=>'pass']) !!}
                                                            <div class="input-group-append">
                                                                      <span class="input-group-text"><i class="fa fa-key"></i></span>
                                                            </div>

                                                        </div>
                                                           <span  style="color:#ff0000;">  <div>{{ $errors->login->first('password1') }}</div></span>
                                          -->               <!-- <h6 id="passcheck"></h6> -->
                                                        <!--<input type="password" value="" class="form-control input-lg">-->
<!-- 
                                                    </div>
                                                </div>

                                                @if ($status->recaptcha_status==1 && $apiKeys->nocaptcha_sitekey != '00' && $apiKeys->captcha_secretCheck != '00')
                                                    {!! NoCaptcha::renderJs() !!}
                                                    {!! NoCaptcha::display() !!}
                                                    <div class="loginrobot-verification"></div>
                                                @endif

                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
                                                        <div class="form-check form-check-inline">

                                                            <label class="form-check-label">
                                                                <input class="form-check-input" type="checkbox" id="rememberme" name="remember">Remember Me
                                                            </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <input type="submit" name="form" value="Login" id="submitbtn" class="btn btn-primary pull-right mb-xl" data-loading-text="Loading...">

                                               -->           
                                                        <!-- <button type="button" class="btn btn-primary mb-xl next-step float-right" name="sendOtp" id="login" onclick="loginUser()">
                                                                    Send Email
                                                        </button> -->
<!-- 
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="featured-box featured-box-primary text-left mt-5">
                                            <div class="box-content">
                                                <h4 class="heading-primary text-uppercase mb-3">Register An Account</h4>

                                                <form name="logregisterForm" id="logregiser-form">

                                                    <div class="row">

                                                        <div class="form-group col-lg-6 {{ $errors->has('first_name') ? 'has-error' : '' }}">

                                                            <label class="required">First Name</label>

                                                            {!! Form::text('first_name',null,['class'=>'form-control input-lg', 'id'=>'logfirst_name']) !!}
                                                            <span id="logfirst_namecheck"></span>
                                                        </div>



                                                        <div class="form-group col-lg-6 {{ $errors->has('last_name') ? 'has-error' : '' }}">
                                                            <label class="required">Last Name</label>
                                                            {!! Form::text('last_name',null,['class'=>'form-control input-lg', 'id'=>'loglast_name']) !!}
                                                            <span id="loglast_namecheck"></span>

                                                        </div>


                                                    </div>
 
                                                    <div class="form-row">
                                                        <div class="form-group col {{ $errors->has('email') ? 'has-error' : '' }}">
                                                            <label class="required">Email Address</label>
                                                            {!! Form::email('email',null,['class'=>'form-control input-lg', 'id'=>'logmail']) !!}
                                                            <span id="logemailcheck"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col col-lg-6 {{ $errors->has('country') ? 'has-error' : '' }}">
                                                            {!! Form::label('country',Lang::get('message.country'),['class'=>'required']) !!}
                                                            <?php $countries = \App\Model\Common\Country::pluck('nicename', 'country_code_char2')->toArray(); ?>
                                                            {!! Form::select('country',[''=>'','Choose'=>$countries],$country,['class' => 'form-control selectpicker','data-live-search-style'=>"startsWith",'data-live-search'=>'true','data-live-search-placeholder'=>'Search','data-dropup-auto'=>'false','data-size'=>'10','onChange'=>'getCountryAttr(this.value);','id'=>'logcountry']) !!}
                                                            <span id="logcountrycheck"></span>
                                                        </div>


                                                        <div class="col-lg-6 form-group {{ $errors->has('mobile_code') ? 'has-error' : '' }}">
                                                            <label class="required">Mobile</label>
                                                            {!! Form::hidden('mobile',null,['id'=>'logphone_code_hidden']) !!}
                                                            <input class="form-control input-lg" id="logphonenum" name="mobile" type="tel" >
                                                            {!! Form::hidden('mobile_code',null,['class'=>'form-control input-lg','disabled','id'=>'logmobile_code']) !!}
                                                            <span id="valid-msg" class="hide"></span>
                                                            <span id="error-msg" class="hide"></span>
                                                            <span id="logmobile_codecheck"></span>
                                                        </div>
                                                    </div> -->
                                                <!--   <input type="checkbox" name="checkbox" id="option" value="{{old('option')}}"><label for="option"><span></span> <p>I agree to the <a href="#">terms</a></p></label>-->
                                                   <!--  <div class="form-row">
                                                        <div class="form-group col-lg-6">
                                                            @if ($status->recaptcha_status==1 && $apiKeys->nocaptcha_sitekey != '00' && $apiKeys->captcha_secretCheck != '00')

                                                                {!! NoCaptcha::display() !!}

                                                                <div class="robot-verification" id="captcha"></div>
                                                                <span id="captchacheck"></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        @if ($status->terms ==0)
                                                            <div class="form-group col-lg-6">
                                                                <input type="hidden" value="true" name="logterms" id="logterm">
                                                            </div>
                                                        @else
                                                            <div class="form-group col-lg-6">
                                                                <label>

                                                                    <input type="checkbox" value="false" name="logterms" id="logterm" > {{Lang::get('message.i-agree-to-the')}} <a href="{{$apiKeys->terms_url}}" target="_blank">{{Lang::get('message.terms')}}</a>
                                                                </label>
                                                                <br><span id="logtermscheck"></span>
                                                            </div>
                                                        @endif

                                                        <div class="form-group col-lg-6">
                                                            <button type="button"  class="btn btn-primary pull-right marginright mb-xl next-step" name="register" id="logregister" onclick="logregisterUser(1)">Submit</button>
                                                        </div>

                                                    </div>

                                                    <div class="form-row">
                                                        <div class="form-group col-lg-6">
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 tab-pane" id="step2">

                            <div class="featured-boxes">


                                <!-- fail message -->
                                <!-- <div class="row">
                                    <div class="col-lg-6 offset-lg-3">
                                        <div id="successMessage1"></div>
                                        <div id = "emailsuccess"></div> -->
                                        <!-- <div id="successMessage2"></div> -->

                                       <!--  <div id="error1">
                                        </div>
                                        <div class="featured-box featured-box-primary text-left mt-5">
                                            <div class="box-content">

                                                <form class="form-horizontal" novalidate="novalidate" name="verifyForm">

                                                    <h4 class="heading-primary text-uppercase mb-md">Confirm Email/Mobile</h4>

                                                    <input type="hidden" name="user_id" id="user_id"/>
                                                    <input type="hidden" name="email_password" id="email_password"/>
                                                    <input type="hidden" id="checkEmailStatus" value="{{$status->emailverification_status}}">
                                                    @if($status->emailverification_status == 1)
                                                        <p>You will be sent a verification email by an automated system, Please click on the verification link in the email. Click next to continue</p>
                                                        <div class="form-row">
                                                            <div class="form-group col">
                                                                <label  for="mobile" class="required">Email</label>
                                                                <div class="input-group">
                                                                    <input type="hidden" id="emailstatusConfirm" value="{{$status->emailverification_status}}">
                                                                    <input type="email" value="" name="verify_email" id="verify_email" class="form-control form-control input-lg">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                                    </div>

                                                                </div>
                                                                <span id="conemail"></span>
                                                            </div>

                                                        </div>
                                                    @endif -->


<!-- 
                                                    @if($status->msg91_status == 1)
                                                        <p>You will be sent an OTP on your mobile immediately by an automated system, Please enter the OTP in the next step. Click next to continue</p>
                                                        <div class="form-row">
                                                            <div class="form-group col">
                                                                <input id="mobile_code_hidden" name="mobile_code" type="hidden">
                                                                <input class="form-control form-control input-lg"  id="verify_country_code" name="verify_country_code" type="hidden">
                                                                <label for="mobile" class="required">Mobile</label><br/>
                                                                <input type="hidden" id="mobstatusConfirm" value="{{$status->msg91_status}}">
                                                                <input class="form-control input-lg phone"  name="verify_number" type="text" id="verify_number">
                                                                <span id="valid-msg1" class="hide"></span>
                                                                <span id="error-msg1" class="hide"></span>

                                                                <span id="conmobile"></span>
                                                            </div>

                                                        </div>
                                                    @endif -->

                                                  <!--   <div class="form-row">
                                                        <div class="form-group col">

                                                            <button type="button" class="btn btn-primary mb-xl next-step float-right" name="sendOtp" id="sendOtp" onclick="sendOTP()">
                                                                Next
                                                            </button>
                                                        </div>
                                                    </div>



                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 tab-pane" id="step3">

                            <div class="featured-boxes"> -->
                                <!-- fail message -->
                                <!-- <div class="row"> -->
                               <!--      <div class="col-lg-6 offset-lg-3">
                                        <div id="error2">
                                        </div>
                                        <div id="successMessage2"></div>

                                        <div id="alertMessage3"></div>

                                        <div class="featured-box featured-box-primary text-left mt-5">
                                            <input type="hidden" id="checkOtpStatus" value="{{$status->msg91_status}}">
                                            <div class="box-content" id="showOtpBox">
                                                <h4 class="heading-primary text-uppercase mb-md">OTP Confirmation</h4> -->
                                                <!-- <div class="row verify">
                                                    <div class="col-md-12">
                                                        <label>
                                                            <span>Verification email sent on your email and OTP on mobile</span>
                                                        </label>
                                                    </div>
                                                </div> -->
                                               <!--  <form name="verify_otp_form">
                                                    <label for="mobile" class="required">Enter OTP</label><br/>
                                                    <div class="row ">
                                                        <div class="col-md-6">

                                                            <input type="hidden" name="user_id" id="hidden_user_id"/>
                                                            <input class="form-control input-lg"  id="oneTimePassword" name="oneTimePassword" type="text" >
                                                            <span id="enterotp"></span>
                                                        </div>


                                                        <div class="col-md-3">
                                                            <button type="button" class="btn btn-primary float-right mb-5" name="verifyOtp" style="width: max-content;" id="verifyOtp" value="Verify OTP" onclick="verifyBySendOtp()" >
                                                                Verify OTP
                                                            </button>
                                                        </div> -->

<!-- 
                                                        <div class="col-md-3">
                                                            <button type="button" class="btn btn-danger float-right mb-5" style="width: max-content;" name="resendOTP" id="resendOTP">
                                                                Resend OTP
                                                            </button>


                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-6 col-md-3 col-lg-6">
                                                            <p>Did not receive OTP via SMS?</p>
                                                            <button type="button" class="btn btn-secondary" name="voiceOTP" id="voiceOTP" value="Verify OTP" style= "margin-top:-15px;"><i class="fa fa-phone"></i>
                                                                Receive OTP via Voice call
                                                            </button>
                                                        </div>

                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </section>
    </div>
    </div>
@stop 




  <!--  <script type="text/javascript">
           var telInput = $('#logphonenum'),
          

            errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg"),
            addressDropdown = $("#country");
             var errorMap = [ "Invalid number", "Invalid country code", "Number Too short", "Number Too long", "Invalid number"];

          
        telInput.intlTelInput({


           
            geoIpLookup: function (callback) {
                $.get("https://ipinfo.io", function () {}, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            utilsScript: "{{asset('js/intl/js/utils.js')}}",

            initialCountry: "auto",
            separateDialCode: true,
        });
        var reset = function() {

            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };

        $('.intl-tel-input').css('width', '100%');

        telInput.on('blur', function () {
            reset();
            if ($.trim(telInput.val())) {
                 
                if (telInput.intlTelInput("isValidNumber")) {
                    $('#logphonenum').css("border-color","");
                    $("#error-msg").html('');
                    errorMsg.classList.add("hide");
                    $('#register').attr('disabled',false);
                } else {
                   
                    var errorCode = telInput.intlTelInput("getValidationError");
                    errorMsg.innerHTML = errorMap[errorCode];
                    $('#logmobile_codecheck').html("");

                    $('#logphonenum').css("border-color","red");
                    $('#error-msg').css({"color":"red","margin-top":"5px"});
                    errorMsg.classList.remove("hide");
                    $('#register').attr('disabled',true);
                }
            }
        });
        $('input').on('focus', function () {
            $(this).parent().removeClass('has-error');
        });
        addressDropdown.change(function() {
            telInput.intlTelInput("setCountry", $(this).val());
            if ($.trim(telInput.val())) {
                
                if (telInput.intlTelInput("isValidNumber")) {
                    $('#logphonenum').css("border-color","");
                    $("#error-msg").html('');
                    errorMsg.classList.add("hide");
                    $('#register').attr('disabled',false);
                } else {
                    
                    var errorCode = telInput.intlTelInput("getValidationError");
                    errorMsg.innerHTML = errorMap[errorCode];
                    $('#logmobile_codecheck').html("");

                    $('#logphonenum').css("border-color","red");
                    $('#error-msg').css({"color":"red","margin-top":"5px"});
                    errorMsg.classList.remove("hide");
                    $('#register').attr('disabled',true);
                }
            }
        });

        $('form').on('submit', function (e) {
            $('input[name=country_code]').attr('value', $('.selected-dial-code').text());
        });

    </script>


    <script>
        // var tel = $('.phone'),
        //     country = $('#country').val();
        // addressDropdown = $("#country");
        // errorMsg1 = document.querySelector("#error-msg1"),
        //     validMsg1 = document.querySelector("#valid-msg1");
        // var errorMap = [ "Invalid number", "Invalid country code", "Number Too short", "Number Too long", "Invalid number"];
        // tel.intlTelInput({
            // allowDropdown: false,
            // autoHideDialCode: false,
            // autoPlaceholder: "off",
            // dropdownContainer: "body",
            // excludeCountries: ["us"],
            // formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //     $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //         resp.country = country;
            //         var countryCode = (resp && resp.country) ? resp.country : "";
            //         callback(countryCode);
            //     });
            // },
            // hiddenInput: "full_number",
            // initialCountry: "auto",
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            // separateDialCode: true,

        //     utilsScript: "{{asset('js/intl/js/utils.js')}}"
        // });
        // var reset = function() {
        //     errorMsg1.innerHTML = "";
        //     errorMsg1.classList.add("hide");
        //     validMsg1.classList.add("hide");
        // };

        // addressDropdown.change(function() {
        //     tel.intlTelInput("setCountry", $(this).val());
        // });

        // tel.on('blur', function () {
        //     reset();
        //     if ($.trim(tel.val())) {
        //         if (tel.intlTelInput("isValidNumber")) {
        //             $('.phone').css("border-color","");
        //             validMsg1.classList.remove("hide");
        //             $('#sendOtp').attr('disabled',false);
        //         } else {
        //             var errorCode = tel.intlTelInput("getValidationError");
        //             errorMsg1.innerHTML = errorMap[errorCode];
        //             $('#conmobile').html("");

        //             $('.phone').css("border-color","red");
        //             $('#error-msg1').css({"color":"red","margin-top":"5px"});
        //             errorMsg1.classList.remove("hide");
        //             $('#sendOtp').attr('disabled',true);
        //         }
        //     }
        // });
     <!--</script>-->






    
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $analyticsTag; ?>"></script> -->

    <!-- <script> -->
        
        <!-- ///Google Recaptcha -->
        <!-- function recaptchaCallback() {
            document.querySelectorAll('.g-recaptcha').forEach(function (el) {
                grecaptcha.render(el);
            });
        } -->
        
    <!-- </script> -->


 <!-- <script type="text/javascript"> -->



       <!--  function verify_otp_check(){
            var userOtp = $('#oneTimePassword').val();
            if (userOtp.length < 4){
                $('#enterotp').show();
                $('#enterotp').html("Please Enter A Valid OTP");
                $('#enterotp').focus();
                $('#oneTimePassword').css("border-color","red");
                $('#enterotp').css({"color":"red","margin-top":"5px"});


                // mobile_error = false;
                return false;
            }
            else{
                $('#enterotp').hide();
                $('#oneTimePassword').css("border-color","");
                return true;

            }
        }

        function verifyBySendOtp() {
            $('#enterotp').hide();
            if(verify_otp_check()) {
                $("#verifyOtp").attr('disabled',true);
                $("#verifyOtp").html("<i class='fa fa-circle-o-notch fa-spin fa-1x fa-fw'></i>Verifying...");
                var data = {
                    "mobile":   $('#verify_number').val().replace(/[\. ,:-]+/g, ''),
                    "code"  :   $('#verify_country_code').val(),
                    "otp"   :   $('#oneTimePassword').val(),
                    'id'    :   $('#hidden_user_id').val(),
                };
                $.ajax({
                    url: '{{url('otp/verify')}}',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        $("#verifyOtp").attr('disabled',false);
                        $('#error2').hide();
                        $('#error').hide();
                        $('#alertMessage2').show();
                        var result =  '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="far fa-thumbs-up"></i>Well Done! </strong>'+response.message+'!</div>';
                        // $('#alertMessage3').show();
                        $('#successMessage2').hide();
                        $('#success').html(result);
                        $("#verifyOtp").html("Verify OTP");
                        $('.nav-tabs li a[href="#step1"]').tab('show');
                        $('.wizard-inner').css('display','none');
                        setTimeout(()=>{
                            getLoginTab();
                        },10)
                    },
                    error: function (ex) {
                        $("#verifyOtp").attr('disabled',false);
                        var myJSON = JSON.parse(ex.responseText);
                        var html = '<div class="alert alert-danger"><strong>Whoops! </strong>Something went wrong<br><br><ul>';
                        $("#verifyOtp").html("Verify OTP");
                        for (var key in myJSON)
                        {
                            html += '<li>' + myJSON[key][0] + '</li>'
                        }
                        html += '</ul></div>';
                        $('#successMessage2').hide();
                        $('#alertMessage2').hide();
                        $('#error2').show();
                        document.getElementById('error2').innerHTML = html;
                        setTimeout(function(){
                            $('#error2').hide();
                        }, 5000);
                    }
                });
            }
            else
            {
                return false;
            }
        }

 -->
       <!--  function getLoginTab(){
            registerForm.elements['first_name'].value = '';
            registerForm.elements['last_name'].value = '';
            registerForm.elements['email'].value = '';
            registerForm.elements['company'].value = '';
            registerForm.elements['bussiness'].value = '';
            registerForm.elements['company_type'].value = '';
            registerForm.elements['company_size'].value = '';
            registerForm.elements['mobile'].value = '';
            registerForm.elements['address'].value = '';
            registerForm.elements['user_name'].value = '';
            registerForm.elements['password'].value = '';
            registerForm.elements['password_confirmation'].value = '';
            registerForm.elements['terms'].checked = false;

            $('.nav-tabs li a[href="#step1"]').tab('show');
            $('.wizard-inner').css('display','none');
        }

        $(".prev-step").click(function (e) {
            getLoginTab();
        });

        //Enter OTP Validation
        $('#oneTimePassword').keyup(function(){
            verify_otp_check();
        });

        //--------------------------------------------------ReSend OTP via SMS---------------------------------------------------//

        $('#resendOTP').on('click',function(){
            var data = {
                "mobile":   $('#verify_number').val().replace(/[\. ,:-]+/g, ''),
                "code"  :  ($('#verify_country_code').val()),
                "type"  :  "text",
            };
            $("#resendOTP").attr('disabled',true);
            $("#resendOTP").html("<i class='fa fa-circle-o-notch fa-spin fa-1x fa-fw'></i>Resending..");
            $.ajax({
                url: '{{url('resend_otp')}}',
                type: 'GET',
                data: data,
                success: function (response) {
                    $("#resendOTP").attr('disabled',false);
                    $("#resendOTP").html("Resend OTP");
                    $('#successMessage2').hide ();
                    $('#alertMessage3').show();
                    $('#error2').hide();
                    var result =  '<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="far fa-thumbs-up"></i>Well Done! </strong>'+response.message+'!</div>';
                    $('#alertMessage3').html(result+ ".");
                },
                error: function (ex) {
                    $("#resendOTP").attr('disabled',false);
                    $("#resendOTP").html("Resend OTP");
                    var myJSON = JSON.parse(ex.responseText);
                    var html = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Oh Snap! </strong>Something went wrong<br><br><ul>';
                    for (var key in myJSON)
                    {
                        html += '<li>' + myJSON[key][0] + '</li>'
                    }
                    html += '</ul></div>';
                    ('#successMessage2').hide();
                    $('#alertMessage2').hide();
                    $('#alertMessage3').hide();
                    $('#error2').show();
                    document.getElementById('error2').innerHTML = html;
                }
            })

        }); -->

      <!--   //---------------------------------------Resend OTP via voice call--------------------------------------------------//

        $('#voiceOTP').on('click',function(){
            var data = {
                "mobile":   $('#verify_number').val().replace(/[\. ,:-]+/g, ''),
                "code"  :  ($('#verify_country_code').val()),
                "type"  :  "voice",
            };
            $("#voiceOTP").attr('disabled',true);
            $("#voiceOTP").html("<i class='fa fa-circle-o-notch fa-spin fa-1x fa-fw'></i>Sending Voice Call..");
            $.ajax({
                url: '{{url('resend_otp')}}',
                type: 'GET',
                data: data,
                success: function (response) {
                    $("#voiceOTP").attr('disabled',false);
                    $("#voiceOTP").html("Receive OTP via Voice call");
                    $('#successMessage2').hide ();
                    $('#alertMessage3').show();
                    $('#error2').hide();
                    var result =  '<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="far fa-thumbs-up"></i>Well Done! </strong>'+response.message+'!</div>';
                    $('#alertMessage3').html(result+ ".");
                },
                error: function (ex) {
                    $("#voiceOTP").attr('disabled',false);
                    $("#voiceOTP").html("Receive OTP via Voice call");
                    var myJSON = JSON.parse(ex.responseText);
                    var html = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Oh Snap! </strong>Something went wrong<br><br><ul>';
                    for (var key in myJSON)
                    {
                        html += '<li>' + myJSON[key][0] + '</li>'
                    }
                    html += '</ul></div>';
                    $('#alertMessage2').hide();
                    $('#alertMessage3').hide();
                    $('#error2').show();
                    document.getElementById('error2').innerHTML = html;
                }
            })

        });


    </script>



 -->

<!-- 
    <script type="text/javascript"> -->

     <!--         /*
        * Email ANd Mobile Validation when Send Button is cliced on Tab2
         */
        
        $('#verify_email').keyup(function(){//Email
            verify_email_check();
        });

        function verify_email_check(){
            if($("#emailstatusConfirm").val() ==1) {//if email verification is active frm admin panlel then validate else don't

                var pattern = new RegExp(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/);
                if (pattern.test($('#verify_email').val())) {
                    $('#conemail').hide();
                    $('#verify_email').css("border-color","");
                    return true;
                } else{
                    $('#conemail').show();
                    $('#conemail').html("Please Enter a valid email");
                    $('#conemail').focus();
                    $('#verify_email').css("border-color","red");
                    $('#conemail').css({"color":"red","margin-top":"5px"});
                    return false;

                }
            }
            return true;

        }

        $('#verify_number').keyup(function(){//Mobile
            verify_number_check();
        });

        function verify_number_check(){

            var userNumber = $('#verify_number').val();
            if($("#mobstatusConfirm").val() ==1) { //If Mobile Status Is Active
                if (userNumber.length < 5){
                    $('#conmobile').show();
                    $('#conmobile').html("Please Enter Your Mobile No.");
                    $('#conmobile').focus();
                    $('#verify_number').css("border-color","red");
                    $('#conmobile').css({"color":"red","margin-top":"5px"});

 -->
                  <!--   // mobile_error = false;
                    return false;
                }
                else{
                    $('#conmobile').hide();

                    $('#verify_number').css("border-color","");
                    return true;

                }
            }
            return true;

        }
      
        /*
          * After Send Button is Clicked on Tab 2 fOR sending OTP AND Email
         */
        function sendOTP() {
            $('#conemail').hide();
            $('#conmobile').hide();
            var mail_error = true;
            var mobile_error = true;
            if((verify_email_check()) && (verify_number_check()))
            { -->

               <!--  var oldemail=sessionStorage.getItem('oldemail');
                var newemail = $('#verify_email').val(); // this.value
                var oldnumber = sessionStorage.getItem('oldemail');
                var newnumber = $('#verify_number').val();

                $("#sendOtp").attr('disabled',true);
                $("#sendOtp").html("<i class='fa fa-circle-o-notch fa-spin fa-1x fa-fw'></i>Sending...");
                var data = {
                    "newemail": newemail,
                    "newnumber": newnumber,
                    "oldnumber": oldnumber,
                    "oldemail": oldemail,
                    "email": $('#verify_email').val(),
                    "mobile": $('#verify_number').val().replace(/[\. ,:-]+/g, ''),
                    'code': $('#verify_country_code').val(),
                    'id': $('#user_id').val(),
                    'password': $('#email_password').val()
                };
                $.ajax({
                    url: '{{url('otp/sendByAjax')}}',
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        // window.history.replaceState(response.type, "TitleTest", "login");
                        $("#sendOtp").attr('disabled',false);
                        var result =  '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="far fa-thumbs-up"></i>Almost there! </strong>'+response.message+'</div>';
                        if (($("#checkOtpStatus").val()) == 1 ) {
                            $('#successMessage2').html(result);
                            $('#error1').hide();
                            $('.wizard-inner').css('display','none');
                            var $active = $('.wizard .nav-tabs li.active');
                            $active.next().removeClass('disabled');
                            nextTab($active); -->

                          <!--   setTimeout(function(){
                                sessionStorage.removeItem('oldemail');
                                sessionStorage.clear();
                            }, 500);
                            window.scrollTo(0, 10);
                            verify_otp_form.elements['hidden_user_id'].value = $('#user_id').val();
                            $("#sendOtp").html("Send");
                        } else {//Show Only Email Success Message when Mobile Status is Not Active
                            $('#emailsuccess').html(result);
                            $('#successMessage1').hide();
                            $("#sendOtp").html("Send");
                            $('#error1').hide();
                        }
                    },
                    error: function (ex) {
                        $("#sendOtp").attr('disabled',false);
                        var myJSON = JSON.parse(ex.responseText);
                        var html = '<div class="alert alert-danger"><strong>Whoops! </strong>Something went wrong<br><br><ul>';
                        $("#sendOtp").html("Send");

                        html += '<li>' + myJSON.message + '</li>'

                        html += '</ul></div>';
                        $('#alertMessage1').hide();
                        $('#successMessage1').hide();
                        $('#error1').show();
                        document.getElementById('error1').innerHTML = html;
                        setTimeout(function(){
                            $('#error1').hide();
                        }, 5000);
                    }
                });
            }
            else{
                return false;
            }

        }

       -->
      <!--   //robot validation for Login Form
        function validateform() {
            var input = $(".g-recaptcha :input[name='g-recaptcha-response']");
            console.log(input.val());
            if(input.val() == null || input.val()==""){
                $('.loginrobot-verification').empty()
                $('.loginrobot-verification').append("<p style='color:red'>Robot verification failed, please try again.</p>")
                return false;
            }
            else{
                return true;
            }
        }

        //Registration Form Validation -->

       <!--  function logfirst_namecheck(){
            var firrstname_val = $('#logfirst_name').val();
            if(firrstname_val.length == ''){
                $('#logfirst_namecheck').show();
                $('#logfirst_namecheck').html("Please Enter First Name");
                $('#logfirst_namecheck').focus();
                $('#logfirst_name').css("border-color","red");
                $('#logfirst_namecheck').css("color","red");
                // userErr =false;

                $('html, body').animate({
                    scrollTop: $("#logfirst_namecheck").offset().top -200
                }, 1000)
                return false;
            }

            if(firrstname_val.length > 30){
                $('#logfirst_namecheck').show();
                $('#logfirst_namecheck').html("Max 30 characters allowed ");
                $('#logfirst_namecheck').focus();
                $('#logfirst_name').css("border-color","red");
                $('#logfirst_namecheck').css("color","red");
                // userErr =false;

                $('html, body').animate({
                    scrollTop: $("#logfirst_namecheck").offset().top -200
                }, 1000)
                return false;
            }

            var pattern = new RegExp(/[^a-zA-Z0-9]/);
            if(pattern.test(firrstname_val)) {
                $('#logfirst_namecheck').show();
                $('#logfirst_namecheck').html("Special characters not allowed");
                $('#logfirst_namecheck').focus();
                $('#logfirst_name').css("border-color","red");
                $('#logfirst_namecheck').css("color","red");

                $('html, body').animate({
                    scrollTop: $("#logfirst_namecheck").offset().top -200
                }, 1000)
                return false;
            }

            else{
                $('#logfirst_namecheck').hide();
                $('#logfirst_name').css("border-color","");
                return true;
            }
        }
        //Validating last name field
        function loglast_namecheck(){
            var lastname_val = $('#loglast_name').val();
            if(lastname_val.length == ''){
                $('#loglast_namecheck').show();
                $('#loglast_namecheck').html("Please Enter Last Name");
                $('#loglast_namecheck').focus();
                $('#loglast_name').css("border-color","red");
                $('#loglast_namecheck').css({"color":"red","margin-top":"5px"});
                // userErr =false;
                $('html, body').animate({

                    scrollTop: $("#loglast_namecheck").offset().top - 200
                }, 1000)
                return false;
            }

            if(lastname_val.length > 30 ){
                $('#loglast_namecheck').show();
                $('#loglast_namecheck').html("Maximum 30 characters allowed");
                $('#loglast_namecheck').focus();
                $('#loglast_name').css("border-color","red");
                $('#loglast_namecheck').css({"color":"red","margin-top":"5px"});
                // userErr =false;
                $('html, body').animate({

                    scrollTop: $("#loglast_namecheck").offset().top - 200
                }, 1000)
                return false;
            } -->

<!-- 
            var pattern = new RegExp(/[^a-zA-Z0-9]/);
            if(pattern.test(lastname_val)){
                $('#loglast_namecheck').show();
                $('#loglast_namecheck').html("Special characters not allowed");
                $('#loglast_namecheck').focus();
                $('#loglast_name').css("border-color","red");
                $('#loglast_namecheck').css({"color":"red","margin-top":"5px"});
                // userErr =false;
                $('html, body').animate({

                    scrollTop: $("#loglast_namecheck").offset().top - 200
                }, 1000)
                return false;
            }

            else{
                $('#loglast_namecheck').hide();
                $('#loglast_name').css("border-color","");
                return true;
            }
        }

        //Validating email field
        function logemailcheck(){

            var pattern = new RegExp(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/);
            if (pattern.test($('#logmail').val())){
                $('#logemailcheck').hide();
                $('#email').css("border-color","");
                return true;

            }
            else{
                $('#logemailcheck').show();
                $('#logemailcheck').html("Please Enter a valid email");
                $('#logemailcheck').focus();
                $('#logmail').css("border-color","red");
                $('#logemailcheck').css({"color":"red","margin-top":"5px"});
                // mail_error = false;
                $('html, body').animate({
                    scrollTop: $("#logemailcheck").offset().top -200
                }, 1000)
            }

        }

 -->




       <!--  function logcountrycheck(){
            var country_val = $('#logcountry').val();
            if(country_val == ''){
                $('#logcountrycheck').show();
                $('#logcountrycheck').html("Please Select One Country ");
                $('#logcountrycheck').focus();
                $('#logcountry').css("border-color","red");
                $('#logcountrycheck').css({"color":"red","margin-top":"5px"});
                // userErr =false;
                $('html, body').animate({
                    scrollTop: $("#logcountrycheck").offset().top - 200
                }, 1000)
            }
            else{
                $('#logcountrycheck').hide();
                $('#logcountry').css("border-color","");
                return true;
            }
        }

        function logmobile_codecheck(){
            var mobile_val = $('#logphonenum').val();
            if(mobile_val.length == ''){
                $('#logmobile_codecheck').show();
                $('#logmobile_codecheck').html("Please Enter Mobile No. ");
                $('#logmobile_codecheck').focus();
                $('#logphonenum').css("border-color","red");
                $('#logmobile_codecheck').css({"color":"red","margin-top":"5px"});
                // userErr =false;
                $('html, body').animate({
                    scrollTop: $("#logmobile_codecheck").offset().top -200
                }, 1000)
            }
            else{
                $('#logmobile_codecheck').hide();
                $('#logphonenum').css("border-color","");
                return true;
            }
        }

 --><!-- 
        //    $('#conpassword').keyup(function(){
        //     con_password_check();


        function logterms(){
            var term_val = $('#logterm').val();
            if(term_val == 'false'){
                $('#logtermscheck').show();
                $('#logtermscheck').html("Terms must be accepted");
                $('#logtermscheck').focus();
                $('#logterm').css("border-color","red");
                $('#logtermscheck').css({"color":"red","margin-top":"5px"});
                // userErr =false;
                return false;
            }

            else{
                $('#logtermscheck').hide();
                $('#logterm').css("border-color","");
                return true;
            }
        } -->

      <!--   function gcaptcha(){
            var captcha_val = $('#g-recaptcha-response-1').val();
            if(captcha_val == ''){
                $('#captchacheck').show();
                $('#captchacheck').html("Robot Verification Failed, please try again");
                $('#captchacheck').focus();
                $('#captcha').css("border-color","red");
                $('#captchacheck').css({"color":"red","margin-top":"5px"});
                // userErr =false;
                return false;
            }

            else{
                $('#captchacheck').hide();
                $('#captcha').css("border-color","");
                return true;
            }
        } -->

<!-- 
        ////////////////////////Registration Valdation Ends////////////////////////////////////////////////////////////////////////////////////////////
        ///
        ///////////////////////VALIDATE TERMS AND CNDITION////////////////////////////////////////
        $(document).on('change','#logterm',function(){
            if($(this).val()=="false"){
                $(this).val("true");
            }
            else{
                $(this).val("false");
            }
        })
        //////////////////////////////Google Analytics Code after Submit button is clicked//////////////////
        function gtag_report_conversion(tag) {
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', tag);
        }
        ////////////////////////////////////////////////////////////////////////////////////////////////////
        function logregisterUser(value) {
            this.value= value;     -->
                             


          <!--   $('#logfirst_namecheck').hide();
            $('#loglast_namecheck').hide();
            $('#logemailcheck').hide();
            $('#logcountrycheck').hide();
            $('#logmobile_codecheck').hide();
            $('#logtermscheck').hide();


            var first_nameErr = true;
            var last_nameErr = true;
            var emailErr = true;
            var countryErr = true;
            var mobile_codeErr = true;
            var termsErr = true;
            // con_password_check();

            if(logfirst_namecheck() && loglast_namecheck() && logemailcheck() &&   logmobile_codecheck()  && logcountrycheck()  && logterms() && gcaptcha())
            {
                


                var tag = "<?php echo $analyticsTag; ?>";
                if (tag !== "" ){
                    gtag_report_conversion(tag);
                } -->
<!-- 
                $("#logregister").attr('disabled',true);
                $("#logregister").html("<i class='fas fa-circle-o-notch fa-spin fa-1x fa-fw'></i>Please Wait...");
                $.ajax({
                    url: '{{url("auth/register")}}',
                    type: 'POST',
                    data: {
                        "first_name": $('#logfirst_name').val(),
                        "last_name": $('#loglast_name').val(),
                        "email": $('#logmail').val(),
                        "country": $('#logcountry').val(),
                        "mobile_code": $('#logmobile_code').val().replace(/\s/g, '') ,
                        "mobile": $('#logphonenum').val().replace(/[\. ,:-]+/g, ''),
                        "g-recaptcha-response-1":$('#g-recaptcha-response-1').val(),
                        "logterms": $('#logterm').val(),
                        "_token": "{!! csrf_token() !!}",
                        "value": value,

                    },
                    success: function (response) {
                        // window.history.pushState(response.type, "TitleTest", "thankyou");

                        $("#logregister").attr('disabled',false);
                        if(response.type == 'success'){
                            $('.wizard-inner').css('display','block');
                            if($("#checkEmailStatus").val() == 0 && $("#checkOtpStatus").val() == 0) {
                                var result =  '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="far fa-thumbs-up"></i>Thank You! </strong>'+response.message+'!!</div>';
                                $('#alertMessage1').html(result);
                                window.scrollTo(0,0);
                                $("#logregister").html("Submit");
                            } else {
                                var result =  '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="far fa-thumbs-up"></i>Thank You! </strong>'+response.message+'!!</div>';
                                $('#successMessage1').html(result);
                                var $active = $('.wizard .nav-tabs li.active');
                                $active.next().removeClass('disabled');
                                nextTab($active);
                                window.scrollTo(0,0);
                                verifyForm.elements['user_id'].value = response.user_id;
                                if($("#emailstatusConfirm").val() == 1) {
                                    var emailverfy = verifyForm.elements['verify_email'].value = $('#logmail').val();
                                    sessionStorage.setItem('oldemail',emailverfy);
                                }
 --><!-- 
                            }
                            verifyForm.elements['verify_country_code'].value =$('#logmobile_code').val();
                            var numberverify= verifyForm.elements['verify_number'].value = $('#logphonenum').val().replace(/[\. ,:-]+/g, '');
                            sessionStorage.setItem('oldenumber',numberverify);
                            verifyForm.elements['email_password'].value = $('#password').val();
                            $("#logregister").html("Register");
                            /*setTimeout(function(){
                                $('#alertMessage1').hide();
                            }, 3000);*/
                        }
                    },
                    error: function (data) {

                        $("#logregister").attr('disabled',false);
                        // location.reload();
                        $("#logregister").html("Register");

                        $('html, body').animate({scrollTop:0}, 500);


                        var html = '<div class="alert alert-danger alert-dismissable"><strong><i class="fas fa-exclamation-triangle"></i>Oh Snap! </strong>'+data.responseJSON.message+' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><br><ul>';
                        for (var key in data.responseJSON.errors)
                        {
                            html += '<li>' + data.responseJSON.errors[key][0] + '</li>'
                        }
                        html += '</ul></div>';

                        $('#error').show();
                        document.getElementById('error').innerHTML = html;
                        setInterval(function(){
                            $('#error').slideUp(3000);
                        }, 8000);
                    }
                });
            }
            else{
                return false;
            }
        }

 -->

<!-- 
        //get login tab1



        $( document ).ready(function() {
            var printitem= localStorage.getItem('successmessage');
            if(printitem != null){
                var result =  '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><i class="far fa-thumbs-up"></i>Well Done! </strong>'+printitem+'!</div>';
                $('#alertMessage2').html(result);
                localStorage.removeItem('successmessage');
                localStorage.clear();
            }

        });
 -->


    <!-- </script> -->



    <!-- <script> -->


       <!--  // console.log(state)
        $(document).ready(function () {
            var val = $("#logcountry").val();
            getCountryAttr(val);
        });

        function getCountryAttr(val) {
            if(val!=""){

                getCode(val);
            }
 -->


         <!--    // getCurrency(val);


        }
 -->


<!-- 
        function getCode(val) {
            $.ajax({
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{url('get-code')}}",
                data: {'country_id':val},//'country_id=' + val,
                success: function (data) {
                    $("#logmobile_code").val(data);
                    $("#logphone_code_hidden").val(data);
                }
            });
        } -->
       <!--  function getCurrency(val) {
            $.ajax({
                type: "GET",
                url: "{{url('get-currency')}}",
                data: {'country_id':val,'_token':"{{csrf_token()}}"},//'country_id=' + val,
                success: function (data) {
                    $("#currency").val(data);
                }
            });
        }
    </script> -->
    <!-- Google Code for Help Desk Pro | Campaign 001 Conversion Page
    In your html page, add the snippet and call
    goog_report_conversion when someone clicks on the
    chosen link or button. -->
    <script type="text/javascript">
        //<![CDATA[
        // goog_snippet_vars = function() {
        //     var w = window;
        //     w.google_conversion_id = 1027628032;
        //     w.google_conversion_label = "uBhoCLT3i3AQgLiB6gM";
        //     w.google_remarketing_only = false;
        // }
        // DO NOT CHANGE THE CODE BELOW.
        // goog_report_conversion = function(url) {
        //     goog_snippet_vars();
        //     window.google_conversion_format = "3";
        //     var opt = new Object();
        //     opt.onload_callback = function() {
        //         if (typeof(url) != 'undefined') {
        //             window.location = url;
        //         }
        //     }
        //     var conv_handler = window['google_trackConversion'];
        //     if (typeof(conv_handler) == 'function') {
        //         conv_handler(opt);
        //     }
        //     fbq('track', 'CompleteRegistration');
        }
        //]]>
    </script>
    <!-- Google Code for Help Desk Pro | Campaign 001 Conversion Page
    In your html page, add the snippet and call
    goog_report_conversion when someone clicks on the
    chosen link or button. -->
    <script type="text/javascript">
        //<![CDATA[
        // goog_snippet_vars = function() {
        //     var w = window;
        //     w.google_conversion_id = 1027628032;
        //     w.google_conversion_label = "uBhoCLT3i3AQgLiB6gM";
        //     w.google_remarketing_only = false;
        // }
        // DO NOT CHANGE THE CODE BELOW.
        // goog_report_conversion = function(url) {
        //     goog_snippet_vars();
        //     window.google_conversion_format = "3";
        //     var opt = new Object();
        //     opt.onload_callback = function() {
        //         if (typeof(url) != 'undefined') {
        //             window.location = url;
        //         }
        //     }
        //     var conv_handler = window['google_trackConversion'];
        //     if (typeof(conv_handler) == 'function') {
        //         conv_handler(opt);
        //     }
        //     fbq('track', 'CompleteRegistration');
        // }
        //]]>
    </script>
   <!--  <script type="text/javascript"
            src="//www.googleadservices.com/pagead/conversion_async.js">
    </script> -->
   

  <!--   <script type="text/javascript"
            src="//www.googleadservices.com/pagead/conversion_async.js">
    </script> -->
   <script>
        // $(document).ready(function () {

        //     $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        //     //Initialize tooltips
        //     $('.nav-tabs > li a[title]').tooltip();
        //     $('.nav-tabs .active a[href="#step1"]').click(function(){
        //         $('.wizard-inner').css('display','none');
        //     })
        //     //Wizard
        //     if(!$('.nav-tabs .active a[href="#step1"]')){
        //         $('.wizard-inner').css('display','block');
        //     }
        //     $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        //         var $target = $(e.target);

        //         if ($target.parent().hasClass('disabled')) {
        //             return false;
        //         }
        //     });

        

        //     $(".prev").click(function (e) {

        //         var $active = $('.wizard .nav-tabs li.active');
        //         $active.next().removeClass('disabled');
        //         prevTab($active);
        //         $('.wizard-inner').css('display','block');
        //     });
        // });

        // function nextTab(elem) {

        //     $(elem).next().find('a[data-toggle="tab"]').click();
        // }
        // function prevTab(elem) {
        //     $(elem).prev().find('a[data-toggle="tab"]').click();
        // }
    </script>
  





