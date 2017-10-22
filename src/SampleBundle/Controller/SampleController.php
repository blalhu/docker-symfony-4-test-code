<?php

namespace App\SampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SampleController extends Controller
{
    public function testAction()
    {
        $kernel = $this->container->get('kernel');
        return new Response(
            '<html>
                        <head>
                            <style>
                                table {
                                    border-collapse: collapse;
                                }
                                
                                table, td, th {
                                    border: 1px solid black;
                                }
                                td, th {
                                    padding:10px;
                                }
                            </style>
                        </head>
                        <body>
                            <h1>Test Page</h1>
                            <h2>Server settings</h2>
                            <table style="border-collapse:collapse;">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>tried to set</th>
                                        <th>current setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Environment</td>
                                        <td>'.($_SERVER['APP_ENV'] ?? '-- not set --').'</td>
                                        <td>'.var_export($kernel->getEnvironment(), true).'</td>
                                    </tr>
                                    <tr>
                                        <td>Debug</td>
                                        <td>'.($_SERVER['APP_DEBUG'] ?? '-- not set --').'</td>
                                        <td>'.var_export($kernel->isDebug(), true).'</td>
                                    </tr>
                                </tbody>
                            </table>
                        </body>
                     </html>'
        );
    }
}