<?php

class AccountController extends BaseController {

    /* Show sign in form */
    public function getSignIn() {
        return View::make('account.signin');
    }

    /* Process sign in form */
    public function postSignIn() {
        $validator = Validator::make(Input::all(),
            array(
                'email' => 'required|email',
                'password' => 'required',
            )
        );

        if( $validator->fails() ) {

            return Redirect::route('account-sign-in')
                   ->withErrors($validator)
                   ->withInput();

        } else {

            $remember = ( Input::has('remember') ) ? true : false;

            $auth = Auth::attempt(array(
                'email'      => Input::get('email'),
                'password'   => Input::get('password'),
                'active'     => 1,
            ), $remember);

            if( $auth ) {

                /* Redirect to intended page */
                return Redirect::intended('/');

            } else {

                return Redirect::route('account-sign-in')
                       ->with('global', '<p class="bg-danger">Email/Password combination is invalid, or your account hasn\'t been activated via email.</p>');

            }

        }

        return Redirect::route('account-sign-in')
               ->with('global', '<p class="bg-danger">There was a problem signing you in.</p>');

    }

    /* Sign the user out */
    public function getSignOut() {
        Auth::logout();
        return Redirect::route('home');
    }

    /* Show signup form */
    public function getCreate() {

        return View::make('account.create');

    }

    /* Process signup form */
    public function postCreate() {

        $validator = Validator::make( Input::all(),
            array(
                'email' => 'required|max:50|email|unique:users',
                'username' => 'required|max:20|min:3|unique:users',
                'password' => 'required|min:6',
                'password_again' => 'required|same:password',
            )
        );

        if( $validator->fails() ) {

            return Redirect::route('account-create')
                   ->withErrors($validator)
                   ->withInput();

        } else {

            $email      = Input::get('email');
            $username   = Input::get('username');
            $password   = Input::get('password');

            // Activation hash ('code' in database)
            $code       = str_random(60);

            $user = User::create(array(
                'email'    => $email,
                'username' => $username,
                'password' => Hash::make($password),
                'code'     => $code,
                'active'   => 0,
            ));

            if( $user ) {

                Mail::send('emails.auth.activate', array(
                    'link' => URL::route('account-activate', $code),
                    'username' => $username,
                ), function($message) use ($user) {
                    $message->to($user->email, $user->username)->subject('Activate Your Account');
                });

                return Redirect::route('home')
                       ->with('global', '<p class="bg-success">Your account has been created, check your email to active your account.</p>');

            }

        }

    }

    public function getActivate($code) {

        $user = User::where('code', '=', $code)->where('active', '=', 0);

        if( $user->count() ) {
            $user = $user->first();

            // Set user to active state
            $user->active = 1;
            $user->code   = '';

            if( $user->save() ) {
                return Redirect::route('home')
                       ->with('global', '<p class="bg-success">Account activated! You can now sign in.</p>');

            }

        }

        return Redirect::route('home')
               ->with('global', '<p class="bg-danger">We could not activate your account. Try again later.</p>');

    }

    public function getChangePassword() {

        return View::make('account.password');

    }

    public function postChangePassword() {

        $validator = Validator::make( Input::all(),
            array(
                'old_password'      => 'required',
                'password'          => 'required|min:6',
                'password_again'    => 'required|same:password',
            )
        );

        if( $validator->fails() ) {

            return Redirect::route('account-change-password')
                   ->withErrors($validator);

        } else {

            $user = User::find( Auth::user()->id );

            $old_password = Input::get('old_password');
            $password     = Input::get('password');

            if( Hash::check( $old_password, $user->getAuthPassword() ) ) {

                $user->password = Hash::make( $password );

                if( $user->save() ) {
                    return Redirect::route('home')
                           ->with('global', '<p class="bg-success">Your password has been changed!</p>');
                } else {

                    /* Problem updating database with new password */
                    return Redirect::route('account-change-password')
                           ->with('global', '<p class="bg-danger">Your password could not be changed, try again later.</p>');

                }

            } else {

                    return Redirect::route('account-change-password')
                           ->with('global', '<p class="bg-danger">Your old password was not correct.</p>');


            }

        }

        return Redirect::route('account-change-password')
               ->with('global', '<p class="bg-danger">Your password could not be changed, try again later.</p>');

    }

    public function getForgotPassword() {

        return View::make('account.forgot');

    }

    public function postForgotPassword() {

        $validator = Validator::make( Input::all(),
            array(
                'email' => 'required|email',
            )
        );

        if( $validator->fails() ) {

            return Redirect::route('account-forgot-password')
                   ->withErrors($validator)
                   ->withInput();

        } else {

            $user = User::where( 'email', '=', Input::get('email') )->where( 'active', '=', 1 );

            if( $user->count() ) {

                $user = $user->first();

                /* Generate a new code and password */
                $code       = str_random(60);
                $password   = str_random(10);

                $user->code          = $code;
                $user->password_temp = Hash::make($password);

                if( $user->save() ) {

                    Mail::send('emails.auth.forgot',
                        array(
                            'link' => URL::route('account-recover', $code),
                            'username' => $user->username,
                            'password' => $password,
                        ), function($message) use ($user) {

                            $message->to($user->email, $user->username)->subject('Password Reset Request');

                        }
                    );

                    return Redirect::route('home')
                           ->with('global', '<p class="bg-success">We have emailed you a new password.</p>');

                } else {

                }

            }

        }

        return Redirect::route('account-forgot-password')
               ->with('global', '<p class="bg-danger">There was an error requesting your new password, or your account isn\'t activated yet. Try again?</p>');

    }

    public function getRecover($code) {

        $user = User::where('code', '=', $code)
                ->where('password_temp', '!=', '');

        if( $user->count() ) {

            $user = $user->first();

            $user->password      = $user->password_temp;
            $user->password_temp = '';
            $user->code          = '';

            if( $user->save() ) {

                return Redirect::route('home')
                       ->with('global', '<p class="bg-success">Your new password has been activated.</p>');

            }
        }

        return Redirect::route('home')
               ->with('global', '<p class="bg-danger">Could not activate your new password.</p>');

    }

}