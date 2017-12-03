<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Test extends Controller
{

    public function techShowcase()
    {
        $mysqlVersionInfo = $this
            ->get('doctrine.dbal.default_connection')
            ->executeQuery('SHOW VARIABLES LIKE "%version%";')
            ->fetchAll()
        ;
        return $this->render('test/tech-showcase.html.twig', [
            'mysqlVersionInfo' => $mysqlVersionInfo
        ]);
    }

}