<?php

namespace Rahweb\CmsCore\Modules\Contact\Http\Controllers\Api\V1;
use Rahweb\CmsCore\Modules\Contact\DTO\ContactDTO;
use Rahweb\CmsCore\Modules\Contact\Http\Requests\ContactRequest;
use Rahweb\CmsCore\Modules\Contact\Services\ContactService;
use Illuminate\Http\JsonResponse;

class ContactController

{
    public function __construct(
        ContactService         $contactService,
    )
    {
        $this->contactService = $contactService;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function create(ContactRequest $request): JsonResponse
    {
        $this->contactService->create(ContactDTO::fromRequest($request));
        return response()->json([
            'success' => true
        ]);
    }


}
