<?php

namespace Rahweb\CmsCore\Modules\User\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\General\Helper\CacheHelper;
use Rahweb\CmsCore\Modules\Service\Entities\Service;
use Rahweb\CmsCore\Modules\User\DTO\ChangePasswordDTO;
use Rahweb\CmsCore\Modules\User\DTO\UserDTO;
use Rahweb\CmsCore\Modules\User\Entities\Role;
use Rahweb\CmsCore\Modules\User\Entities\User;
use Rahweb\CmsCore\Modules\User\Filters\UserFilter;
use Rahweb\CmsCore\Modules\User\Http\Requests\AdminRequest;
use Rahweb\CmsCore\Modules\User\Http\Requests\ChangePasswordRequest;
use Rahweb\CmsCore\Modules\User\Services\UserService;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getTypeName($user_type)
    {
        if ($user_type) {
            if (isset(config('site.user_types')[$user_type])) {
                $type = config('site.user_types')[$user_type];
            } else {
                abort(404);
            }
        } else {
            $type = "کاربر";
        }
        return $type;
    }

    public function index(Request $request)
    {
        $query = User::query();
        if ($request->hasAny(['full_name', 'mobile', 'email', 'type'])) {
            $filters = [
                'full_name' => $request->input('full_name'),
                'mobile' => $request->input('mobile'),
                'email' => $request->input('email'),
                'type' => $request->input('type'),
            ];
            $query = app(UserFilter::class)->apply($query, $filters);
        }
        $user = $query->paginate(20)->withQueryString();
        $type = $this->getTypeName($request->get('type'));
        return view('CmsCore::user.user.index', compact('user', 'type'));
    }

    public function create(Request $request)
    {
        $roles = Role::all();
        $services = Service::orderBy('id', 'DESC')->select(['title', 'id'])->get();
        $type = $this->getTypeName($request->get('type'));
        return view('CmsCore::user.user.create',
            compact('roles', 'services', 'type'));
    }

    public function store(AdminRequest $request)
    {
        $this->userService->create(UserDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.user.index')
            ->with('success', 'کاربر جدید اضافه شد.');
    }

    public function edit(int $id)
    {
        $data = User::findOrFail($id);
        $roles = Role::all();
        $services = Service::orderBy('id', 'DESC')->select(['title', 'id'])->get();
        return view('CmsCore::user.user.edit', compact('data', 'roles', 'services'));
    }

    public function update(int $id, AdminRequest $request)
    {
        $this->userService->update($id, UserDTO::fromRequest($request));
        CacheHelper::clearCache();
        return redirect()->route('admin.user.index')
            ->with('success', 'کاربر ویرایش شد.');
    }

    public function changePassword(int $id, ChangePasswordRequest $request)
    {
        $this->userService->changePassword($id, ChangePasswordDTO::fromRequest($request));
        return redirect()->route('admin.user.index')
            ->with('success', 'رمز عبور با موفقیت تغییر کرد.');
    }

    public function destroy(int $id)
    {
        $admin_count = User::whereHas('userTypes', function (Builder $query2) {
            $query2->where('type', 'Admin');
        })->count();
        $user = User::find($id);
        if ($admin_count == 1 && $user->userTypes->contains('type', 'Admin')) {
            return Redirect::back()->with('error', 'تنها مدیر سایت قابلیت حذف ندارد');
        }
        $this->userService->destroy($id);
        CacheHelper::clearCache();
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');
    }
}
