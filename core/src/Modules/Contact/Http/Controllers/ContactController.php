<?php

namespace Rahweb\CmsCore\Modules\Contact\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Redirect;
use Rahweb\CmsCore\Modules\Contact\Entities\Contact;
use Rahweb\CmsCore\Modules\Contact\Services\ContactService;

class ContactController
{
    protected $contactService;
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }
    /**
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $query = Contact::query();
        $contacts = $query->orderby('id', 'DESC')->paginate(20);
        return view('CmsCore::contact.index', compact('contacts'));

    }

    public function delete($id)
    {

        $this->contactService->destroy($id);
        return Redirect::back()->with('success', 'آیتم موردنظر با موفقیت حذف شد');

    }
    public function changeStatus($id)
    {

        $this->contactService->changeStatus($id);
        return Redirect::back()->with('success', 'آیتم موردنظر بررسی شد');

    }
}
