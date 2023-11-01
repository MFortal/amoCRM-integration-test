<?php

namespace App\Interfaces;

use AmoCRM\Models\LeadModel;

interface ILeadService
{
    public function send(array $value): LeadModel;
}
