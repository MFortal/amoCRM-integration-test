<?php

namespace App\Http\Controllers\Form;

use AmoCRM\Models\LeadModel;
use App\Http\Requests\SendFormRequest;

class LeadFormController extends BaseLeadFormController
{
    public function index()
    {
        return view('welcome');
    }

    public function send(SendFormRequest $request)
    {
        $validated = $request->validated();
        if ($this->leadService->send($validated) instanceof LeadModel) {
            return view('results.success');
        }

        return view('results.errors');
    }
}
