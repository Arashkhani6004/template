<?php
namespace Rahweb\CmsCore\Modules\User\Services;

use Rahweb\CmsCore\Modules\General\Helper\FileManager;
use Rahweb\CmsCore\Modules\General\Helper\FileUploader;
use Rahweb\CmsCore\Modules\User\DTO\ChangePasswordDTO;
use Rahweb\CmsCore\Modules\User\DTO\SiteUserDTO;
use Rahweb\CmsCore\Modules\User\DTO\UserDTO;
use Rahweb\CmsCore\Modules\User\Entities\User;

class UserService
{
    public function create(UserDTO $userDto): void
    {
        $avatar = null;
        if ($userDto->getAvatar()) {
            $uploader = new FileUploader($userDto->getAvatar(), "uploads/user");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [250, 250]]);
            $avatar = $uploader->upload();
        }
        $user = User::create([
            'full_name' => $userDto->getFullName(),
            'email' => $userDto->getEmail(),
            'mobile' => $userDto->getMobile(),
            'password' => $userDto->getPassword(),
            'avatar' => $avatar,
            'show_in_first_page' => $userDto->isShowInFirstPage(),
        ]);
        //relations
        $user->services()->attach($userDto->getServices());
        $user->roles()->attach($userDto->getRoles());
        $user->syncUserTypes($userDto->getUserTypes());
    }

    public function update(int $id, UserDTO $userDto): void
    {
        $user = User::findOrFail($id);
        $password = $userDto->getPassword() ? $userDto->getPassword() : $user->password;
        $avatar = $user->getRawOriginal('avatar');
        if ($userDto->getAvatar()) {
            $uploader = new FileUploader($userDto->getAvatar(), "uploads/user");
            $uploader->setExtensions(["jpeg", "webp", "png", "jpg"]);
            $uploader->setSizes(["big" => [250, 250]]);
            $avatar = $uploader->upload();
        }
        $user->update([
            'full_name' => $userDto->getFullName(),
            'email' => $userDto->getEmail(),
            'mobile' => $userDto->getMobile(),
            'password' => $password,
            'avatar' => $avatar,
            'show_in_first_page' => $userDto->isShowInFirstPage(),
        ]);
        //relations
        $user->services()->sync($userDto->getServices());
        $user->roles()->sync($userDto->getRoles());
        $user->syncUserTypes($userDto->getUserTypes());
    }

    public function changePassword(int $id, ChangePasswordDTO $passwordDTO): void
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => $passwordDTO->getPassword(),
        ]);
    }

    public function destroy(int $id): void
    {
        User::destroy($id);
    }
    public static function findAll($query, $limit = 10)
    {
        $data = User::query();
        if (isset($query['first_page'])) {
            $data->firstPage();
        }
        return $data->take($limit)->get();
    }

    public static function findByMobile($mobile){
        return User::where("mobile", $mobile)->first();
    }
    public static function findByMobileAndCode($mobile,$code){
        return User::where([
            "mobile" => $mobile,
            'confirm_code' => $code
        ])->first();
    }
    public static function createFromSite($request)
    {

      $user = User::create([
            'full_name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
        ]);
      return $user;

    }
}
