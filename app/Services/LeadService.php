<?php

namespace App\Services;

use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use AmoCRM\Models\Unsorted\FormsMetadata;
use App\Interfaces\ILeadService;
use Exception;

class LeadService implements ILeadService
{
    private $leadsService;

    public function __construct()
    {
        $apiClient = new ApiClientService();
        $apiClient->createOrUpdateAccessToken();

        $this->leadsService = $apiClient->getLeadsService();
    }


    public function send(array $sendData): LeadModel
    {
        $lead = (new LeadModel())
            ->setName('Форма от ' . $sendData['phone'])
            ->setPrice($sendData['price'])
            ->setContacts(
                (new ContactsCollection())
                    ->add(
                        (new ContactModel())
                            ->setName($sendData['name'])
                            ->setCustomFieldsValues(
                                (new CustomFieldsValuesCollection())
                                    ->add(
                                        (new MultitextCustomFieldValuesModel())
                                            ->setFieldCode('PHONE')
                                            ->setValues(
                                                (new MultitextCustomFieldValueCollection())
                                                    ->add(
                                                        (new MultitextCustomFieldValueModel())
                                                            ->setValue($sendData['phone'])
                                                    )
                                            )
                                    )->add((new MultitextCustomFieldValuesModel())
                                        ->setFieldCode('EMAIL')
                                        ->setValues(
                                            (new MultitextCustomFieldValueCollection())
                                                ->add(
                                                    (new MultitextCustomFieldValueModel())
                                                        ->setValue($sendData['email'])
                                                )
                                        ))
                            )
                    )
            )
            ->setMetadata(
                (new FormsMetadata())
                    ->setFormId('lead_form')
                    ->setFormName('Обратная связь')
                    ->setFormPage(env('APP_URL', 'http://localhost'))
                    ->setFormSentAt(mktime(date('h'), date('i'), date('s'), date('m'), date('d'), date('Y')))
            );

        try {
            $this->leadsService->addOneComplex($lead);
            return $lead;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
