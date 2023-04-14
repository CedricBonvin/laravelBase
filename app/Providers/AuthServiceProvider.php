<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Mail\NewUserMail;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::createUrlUsing(function ($notifiable){
            $frontUrl = config('jeu-alcool.app_front_url');

            $verifyUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );

            //trim the url to remove the domain name
            $verifyUrl = str_replace(config('app.url') . '/api/email/verify/', '', $verifyUrl);

            return $frontUrl . '/email/verification/' . $verifyUrl;
        });

        VerifyEmail::toMailUsing(function ($notifiable, $url){
            return (new NewUserMail($notifiable, $url))
                ->to($notifiable->email)
                ->subject('JeuAlcool - Inscription');
        });

        //
    }
}
