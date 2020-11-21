<?php

namespace Taghwo\PhoneNumber\Rule;

use Zttp\Zttp;

trait HttpClient
{
    protected $response;
    /**
     * check if phone number is a spam
     * @param string $cleanPhoneNumber
     * @return bool
     */
    public function runSpamChecker($cleanPhoneNumber)
    {
        $this->response = Zttp::withHeaders(['x-rapidapi-host' => config('spamCheckerHost'),'x-rapidapi-key' => config('spamCheckerKey')])
                    ->get("https://spamcheck.p.rapidapi.com/index.php?number=$cleanPhoneNumber");

        return $this->spamResponse();
    }

    private function spamResponse()
    {
        if ($this->response->json()['response'] !== 'Spam') {
            return 'true';
        }
        return 'false';
    }
}
