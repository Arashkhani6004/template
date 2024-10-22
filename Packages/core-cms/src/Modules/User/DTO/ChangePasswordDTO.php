<?php

namespace Rahweb\CmsCore\Modules\User\DTO;

use Rahweb\CmsCore\Modules\General\Helper\NumberHelper;
use Rahweb\CmsCore\Modules\User\Http\Requests\AdminRequest;
use Rahweb\CmsCore\Modules\User\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\UploadedFile;

class ChangePasswordDTO
{
    protected string $password;

    public function getPassword(): string
    {
        return bcrypt($this->password);
    }
    public static function fromRequest(ChangePasswordRequest $request)
    {
        $self = new self();
        $self->password = $request->get('password');
        return $self;
    }
}
