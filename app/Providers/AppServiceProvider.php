<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\Setting;
use App\Observers\ProjectObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer( '*', function( $view ) {
            $logo = Setting::where( 'name', 'logo' )->first() ?: null;

            $view->with( 'logo', $logo ? $logo->value : null );

            if ( auth()->check() ) {
                $user = auth()->user();

                $view->with( 'user', $user );

                // mark notifications as read
                if ( request()->has( 'read' ) ) {
                    $id = request()->get( 'read' );

                    $notification = $user->notifications()->where( 'id', $id )->limit(1)->first();

                    if ( $notification ) {
                        $notification->markAsRead();
                    }
                }
            }
        });

//        if ( config( 'app.debug' ) ) {
//            $this->app->register( 'VIACreative\SudoSu\ServiceProvider' );
//        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Project::observe( ProjectObserver::class );
    }
}
