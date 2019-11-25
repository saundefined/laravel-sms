<?php

namespace Saundefined\LaravelSMS\Providers;

use Saundefined\LaravelSMS\Contracts\Provider\HasBalance;
use Saundefined\LaravelSMS\Contracts\Provider\HasSender;
use Saundefined\LaravelSMS\Exceptions\ApiException;
use Saundefined\LaravelSMS\Services\Balance;
use Saundefined\LaravelSMS\Services\Sender;
use Saundefined\LaravelSMS\Services\SenderCollection;

class IntisProvider extends AbstractProvider implements HasBalance, HasSender
{
    private $login;

    private $password;

    public function __construct($options)
    {
        $this->login = $options['login'];
        $this->password = $options['password'];
    }

    public function send($phone, $text, $sender)
    {
        // TODO: Implement send() method.
    }

    public function getBalance()
    {
        $result = $this->query('balance', ['login' => $this->login], 'POST');

        return new Balance($result['money'], $result['currency']);
    }

    private function query($path, $parameters = [], $method = 'GET')
    {
        $response = $this->getHttpClient()
            ->request($method, 'https://new.sms16.ru/get/' . $path . '.php', [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'http_errors' => false,
                'query' => $this->prepareParameters($parameters)
            ]);

        $result = json_decode($response->getBody(), true);
        if (isset($result['error'])) {
            throw new ApiException('Intis Provider API Error: ' . $result['error']);
        }

        return $result;
    }

    private function prepareParameters($parameters = [])
    {
        $parameters = array_merge($parameters, [
            'timestamp' => $this->getTimestamp(),
        ]);

        return array_merge($parameters, [
            'signature' => $this->getSignature($parameters),
        ]);
    }

    private function getTimestamp()
    {
        return (string)$this->getHttpClient()
            ->get('https://new.sms16.ru/get/timestamp.php')
            ->getBody();
    }

    private function getSignature($parameters)
    {
        ksort($parameters);
        reset($parameters);
        return md5(implode($parameters) . $this->password);
    }

    public function getSenderList()
    {
        $result = $this->query('senders', ['login' => $this->login]);

        $collection = new SenderCollection();
        foreach ($result as $sender => $status) {
            $collection->add(new Sender($sender, $status === 'completed'));
        }

        return $collection;
    }
}
