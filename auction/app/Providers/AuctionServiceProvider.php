<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MallMandu\Mandu;
use Illuminate\Support\Facades\Blade;

class AuctionServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerBladeDirectives();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerUrbanar();
        $this->registerFacade();
        $this->registerBindings();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerUrbanar()
    {
        $this->app->bind('mandu', function ($app) {
            return new Mandu($app);
        });
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade()
    {
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Mandu', \App\Services\MallMandu\Facades\Mandu::class);
        });
    }

    /**
     * Register the blade extender to use new blade sections
     */
    protected function registerBladeDirectives()
    {
        /**
         * Role based blade extensions
         * Accepts either string of Role Name or Role ID
         */
        Blade::directive('role', function ($role) {
            return "<?php if (mandu()->hasRole{$role}): ?>";
        });

        /**
         * Accepts array of names or id's
         */
        Blade::directive('roles', function ($roles) {
            return "<?php if (mandu()->hasRoles{$roles}): ?>";
        });

        Blade::directive('needsroles', function ($roles) {
            return "<?php if (mandu()->hasRoles(" . $roles . ", true)): ?>";
        });

        /**
         * Generic if closer to not interfere with built in blade
         */
        Blade::directive('endauth', function () {
            return "<?php endif; ?>";
        });
    }

    /**
     * Register service provider bindings
     */
    public function registerBindings()
    {
        $this->app->singleton(\App\Repositories\User\UserContract::class, \App\Repositories\User\UserRepository::class);
        $this->app->singleton(\App\Repositories\Role\RoleContract::class, \App\Repositories\Role\RoleRepository::class);
        $this->app->singleton(\App\Repositories\Item\ItemContract::class, \App\Repositories\Item\ItemRepository::class);
        $this->app->singleton(\App\Repositories\Product\ProductContract::class, \App\Repositories\Product\ProductRepository::class);
        $this->app->singleton(\App\Repositories\ProductHistory\ProductHistoryContract::class, \App\Repositories\ProductHistory\ProductHistoryRepository::class);
        $this->app->singleton(\App\Repositories\ProductClearingPrice\ProductClearingPriceContract::class, \App\Repositories\ProductClearingPrice\ProductClearingPriceRepository::class);
        $this->app->singleton(\App\Repositories\Page\PageContract::class, \App\Repositories\Page\PageRepository::class);
        $this->app->singleton(\App\Repositories\Activity\ActivityContract::class, \App\Repositories\Activity\ActivityRepository::class);
        $this->app->singleton(\App\Repositories\TopBid\TopBidContract::class, \App\Repositories\TopBid\TopBidRepository::class);
        $this->app->singleton(\App\Repositories\Gallery\GalleryContract::class, \App\Repositories\Gallery\GalleryRepository::class);
        $this->app->singleton(\App\Repositories\Member\MemberContract::class, \App\Repositories\Member\MemberRepository::class);
        $this->app->singleton(\App\Repositories\Bid\BidContract::class, \App\Repositories\Bid\BidRepository::class);
        $this->app->singleton(\App\Repositories\BidHistory\BidHistoryContract::class, \App\Repositories\BidHistory\BidHistoryRepository::class);
        $this->app->singleton(\App\Repositories\Customer\CustomerContract::class, \App\Repositories\Customer\CustomerRepository::class);
    }
}
