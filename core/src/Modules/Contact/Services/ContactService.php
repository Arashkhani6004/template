<?php
namespace Rahweb\CmsCore\Modules\Contact\Services;


use Rahweb\CmsCore\Modules\Contact\DTO\ContactDTO;
use Rahweb\CmsCore\Modules\Contact\Entities\Contact;


class ContactService
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function create(ContactDTO $contactDTO)
    {
        $this->model::create([
            'title' => $contactDTO->getTitle(),
            'name' => $contactDTO->getName(),
            'mobile' => $contactDTO->getMobile(),
            'message' => $contactDTO->getMessage(),

        ]);

    }

    public function destroy(int $id)
    {
        $this->model::destroy($id);
    }
    public function changeStatus(int $id)
    {
        $contact = $this->model::findOrfail($id);
        $contact ->update([
           'status'=>1
        ]);
    }
}
