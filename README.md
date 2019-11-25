# SMS Providers

## How to use

```php
<?php

$sms = \Saundefined\SmsProviders\Manager::with('intis');

$balance = $sms->getBalance();
$senders = $sms->getSenderList();
$result = $sms->send('79990000000', 'test', 'TEST');
```
