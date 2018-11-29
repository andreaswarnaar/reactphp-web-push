<?php

use Clue\React\Buzz\Browser;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;
use React\EventLoop\Factory;

require __DIR__ . '/../vendor/autoload.php';

$loop = Factory::create();
$browser = new Browser($loop);

$auth = array(
    'VAPID' => array(
        'subject' => 'https://github.com/Minishlink/web-push-php-example/',
        'publicKey' => 'BCmti7ScwxxVAlB7WAyxoOXtV7J8vVCXwEDIFXjKvD-ma-yJx_eHJLdADyyzzTKRGb395bSAtxlh4wuDycO3Ih4',
        'privateKey' => 'HJweeF64L35gw5YLECa-K7hwp3LLfcKtpdRNK8C_fPQ', // in the real world, this would be in a secret file
    ),
);
$webpush = new WebPush($browser, $auth);

$subscription = new Subscription('http://example.com', 'key', 'aesgcm');

$payload = 'hello world!';
$webpush->sendNotification($subscription, $payload);

$loop->run();
