<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Проверка электронного адреса')
                ->greeting('Здравствуйте!')
                ->line('Нажмите кнопку ниже, чтобы подтвердить адрес электронной почты.')
                ->action('Подтвердить адрес', $url)
                ->salutation('С уважением Granit Shop');
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            return (new MailMessage)
                ->subject('Уведомление о восстановлении пароля')
                ->greeting('Здравствуйте!')
                ->line('Вы получаете это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.')
                ->action('Восстановление пароля', url(route('password.reset', [
                    'token' => $token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false)))
                ->line('Срок действия этой ссылки для сброса пароля истечет через 60 минут.')
                ->line('Если вы не запрашивали сброс пароля, дальнейшие действия не требуются.')
                ->salutation('С уважением Granit Shop');
        });
    }
}
