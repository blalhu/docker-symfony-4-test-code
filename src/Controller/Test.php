<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class Test extends Controller
{

    public function techShowcase()
    {
        $mysqlVersionInfo = $this
            ->get('doctrine.dbal.conn_mysql_connection')
            ->executeQuery('SHOW VARIABLES LIKE "%version%";')
            ->fetchAll()
        ;
        $pgsqlVersionInfo = $this
            ->get('doctrine.dbal.conn_pgsql_connection')
            ->executeQuery('SELECT version();')
            ->fetchColumn()
        ;
        $sqliteVersionInfo = $this
            ->get('doctrine.dbal.conn_sqlite_connection')
            ->executeQuery('SELECT sqlite_version();')
            ->fetchColumn()
        ;
        return $this->render('test/tech-showcase.html.twig', [
            'mysqlVersionInfo'  => $mysqlVersionInfo,
            'pgsqlVersionInfo'  => $pgsqlVersionInfo,
            'sqliteVersionInfo' => $sqliteVersionInfo,
        ]);
    }

}