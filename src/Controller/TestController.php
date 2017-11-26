<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestController extends Controller
{
    public function index()
    {
        $kernel = $this->get('kernel');
        return $this->render('test/index.html.twig',[
            'triedToSet' => [
                'env' => ($_SERVER['APP_ENV'] ?? '-- not set --'),
                'debug' => ($_SERVER['APP_DEBUG'] ?? '-- not set --')
            ],
            'currentSetting' => [
                'env' => var_export($kernel->getEnvironment(), true),
                'debug' => var_export($kernel->isDebug(), true)
            ],
        ]);
    }
}