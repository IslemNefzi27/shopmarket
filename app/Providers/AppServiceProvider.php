<?php

namespace App\Providers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Policies\CartItemPolicy;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ReviewPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        
        Schema::defaultStringLength(191); 

        Gate::policy(Product::class, ProductPolicy::class);
        Gate::policy(Order::class, OrderPolicy::class);
        Gate::policy(Review::class, ReviewPolicy::class);
        Gate::policy(CartItem::class, CartItemPolicy::class);

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Vérification de votre adresse email')
                ->line('Cliquez sur le bouton ci-dessous pour vérifier votre adresse email.')
                ->action('Vérifier mon email', $url)
                ->line('Si vous n\'avez pas créé de compte, aucune action n\'est requise.');
        });
    }
}