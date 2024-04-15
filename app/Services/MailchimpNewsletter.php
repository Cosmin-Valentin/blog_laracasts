<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter {
    public function __construct(protected ApiClient $client)
    {
        
    }

    public function subscribe(string $email) {
        return $this->client->lists
            ->addListMember(config('services.mailchimp.lists.subscribers'), [
                'email_address' => $email,
                'status' => 'subscribed'
        ]);
    }

    public function newPost(array $emails) {
        foreach ($emails as $email) {
            // Send Email
        }
    }
}