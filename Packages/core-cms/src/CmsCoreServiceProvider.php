<?php

namespace Rahweb\CmsCore;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Rahweb\CmsCore\Modules\Banner\Providers\BannerServiceProvider;
use Rahweb\CmsCore\Modules\Blog\Providers\BlogServiceProvider;
use Rahweb\CmsCore\Modules\Certification\Providers\CertificationServiceProvider;
use Rahweb\CmsCore\Modules\Comment\Providers\CommentServiceProvider;
use Rahweb\CmsCore\Modules\Contact\Providers\ContactServiceProvider;
use Rahweb\CmsCore\Modules\Course\Providers\CourseServiceProvider;
use Rahweb\CmsCore\Modules\Faq\Providers\FaqServiceProvider;
use Rahweb\CmsCore\Modules\Gallery\Providers\GalleryServiceProvider;
use Rahweb\CmsCore\Modules\General\Helper\ModuleUtils;
use Rahweb\CmsCore\Modules\General\Providers\GeneralServiceProvider;
use Rahweb\CmsCore\Modules\Location\Providers\LocationServiceProvider;
use Rahweb\CmsCore\Modules\Order\Providers\OrderServiceProvider;
use Rahweb\CmsCore\Modules\Page\Providers\PageServiceProvider;
use Rahweb\CmsCore\Modules\Product\Providers\ProductServiceProvider;
use Rahweb\CmsCore\Modules\Seo\Providers\SeoServiceProvider;
use Rahweb\CmsCore\Modules\Service\Providers\ServicesServiceProvider;
use Rahweb\CmsCore\Modules\Setting\Providers\SettingsServiceProvider;
use Rahweb\CmsCore\Modules\Tag\Providers\TagServiceProvider;
use Rahweb\CmsCore\Modules\User\Http\Middleware\AdminPermission;
use Rahweb\CmsCore\Modules\User\Providers\UserServiceProvider;
use Rahweb\CmsCore\View\Components\CheckBox;
use Rahweb\CmsCore\View\Components\CkEditor;
use Rahweb\CmsCore\View\Components\ImageInput;
use Rahweb\CmsCore\View\Components\Input;
use Rahweb\CmsCore\View\Components\MultipleImageInput;
use Rahweb\CmsCore\View\Components\MultiSelect;
use Rahweb\CmsCore\View\Components\PasswordInput;
use Rahweb\CmsCore\View\Components\Select;
use Rahweb\CmsCore\View\Components\TextArea;

class CmsCoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->register(BannerServiceProvider::class);
        $this->app->register(BlogServiceProvider::class);
        $this->app->register(CertificationServiceProvider::class);
        $this->app->register(CommentServiceProvider::class);
        $this->app->register(ContactServiceProvider::class);
        $this->app->register(CourseServiceProvider::class);
        $this->app->register(FaqServiceProvider::class);
        $this->app->register(GalleryServiceProvider::class);
        $this->app->register(GeneralServiceProvider::class);
        $this->app->register(PageServiceProvider::class);
        $this->app->register(ProductServiceProvider::class);
        $this->app->register(OrderServiceProvider::class);
        $this->app->register(LocationServiceProvider::class);
        $this->app->register(SeoServiceProvider::class);
        $this->app->register(ServicesServiceProvider::class);
        $this->app->register(SettingsServiceProvider::class);
        $this->app->register(TagServiceProvider::class);
        $this->app->register(UserServiceProvider::class);
        $this->mergeConfigFrom(__DIR__ . '/../config/modules.php', 'modules');
        $this->mergeConfigFrom(__DIR__ . '/../config/setting.php', 'setting');
        $this->mergeConfigFrom(__DIR__ . '/../config/setting_structure.php', 'setting_structure');
    }

    public function boot()
    {
        Schema::defaultStringLength(191);
        if (env('APP_ENV') == "production") {
            URL::forceScheme('https');
        }
        Blade::directive('file', function (string $file_path) {
            return "<?php echo FileManager::serveFile($file_path); ?>";
        });

        require_once ModuleUtils::app_module_path('General/Helper/file.php');
        require_once ModuleUtils::app_module_path('General/Helper/jdate.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/assets' => public_path('assets/'),
            ], 'assets');
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'CmsCore');

        $this->loadViewComponentsAs('cms', [
            CheckBox::class,
            CkEditor::class,
            ImageInput::class,
            Input::class,
            MultipleImageInput::class,
            MultiSelect::class,
            PasswordInput::class,
            Select::class,
            TextArea::class,
        ]);

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('AdminPermission', AdminPermission::class);

    }
}
