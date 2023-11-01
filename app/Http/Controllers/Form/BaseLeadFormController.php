<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Services\LeadService;

class BaseLeadFormController extends Controller
{
    public $leadService;

    public function __construct(LeadService $leadService)
    {
        $this->leadService = $leadService;
    }
}
