<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            $message = 'Ваша електронна адреса вже була успішно підтверджена.';
            $request->session()->flash('verified', $message);
            $user = User::query()
                ->where('email',$request->user()->email)->first();
            if($user->email == 'jenyaphphunter@gmail.com' || $user->email == 'aigletter@gmail.com'){
                $user->role_id = 1;
            } else {
                $user->role_id = 3;
            }
            $user->save();
            $request->session()->put('user', $user);

            return redirect()->route('main');
        }

        if ($request->user()->markEmailAsVerified()) {
            $user = User::query()
                ->where('email',$request->user()->email)->first();
            if($user->email == 'jenyaphphunter@gmail.com' || $user->email == 'aigletter@gmail.com'){
                $user->role_id = 1;
            } else {
                $user->role_id = 3;
            }
            $user->save();
            $request->session()->put('user', $user);

            event(new Verified($request->user()));
            $message = 'Ваша електронна адреса успішно підтверджена.';
            if ($request->session()) {
                $request->session()->flash('verified', $message);
            }
        }

        return redirect()->route('userarea');
    }

//    public function __invoke(EmailVerificationRequest $request)
//    {
//        if ($request->user()->hasVerifiedEmail()) {
//            $message = 'Ваша електронна адреса вже була успішно підтверджена.';
//            $request->session()->flash('verified', $message);
//            $user = User::query()
//                ->where('email',$request->user()->email)->first();
//            if($user->email == 'jenyaphphunter@gmail.com' || $user->email == 'aigletter@gmail.com'){
//                $user->role_id = 1;
//            } else {
//                $user->role_id = 3;
//            }
//            $user->save();
//            $request->session()->put('user', $user);
//
//            return redirect()->route('main');
//        }
//
//        if ($request->user()->markEmailAsVerified()) {
//            $user = User::query()
//                ->where('email',$request->user()->email)->first();
//            if($user->email == 'jenyaphphunter@gmail.com' || $user->email == 'aigletter@gmail.com'){
//                $user->role_id = 1;
//            } else {
//                $user->role_id = 3;
//            }
//            $user->save();
//            $request->session()->put('user', $user);
//
//            event(new Verified($request->user()));
//            $message = 'Ваша електронна адреса успішно підтверджена.';
//            $request->session()->flash('verified', $message);
//        }
//
//        return redirect()->route('userarea');
//    }

}
