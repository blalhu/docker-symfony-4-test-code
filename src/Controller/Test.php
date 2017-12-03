<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Test extends Controller
{

    public function techShowcase()
    {
        return $this->render('test/tech-showcase.html.twig');
    }

}