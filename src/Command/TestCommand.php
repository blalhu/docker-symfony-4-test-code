<?php

namespace App\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'test';

    private $mysqlConn  = null;
    private $pgsqlConn  = null;
    private $sqliteConn = null;

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
        ;
    }

    public function __construct(ManagerRegistry $mr)
    {
        parent::__construct();
        $this->mysqlConn  = $mr->getConnection('conn_mysql');
        $this->pgsqlConn  = $mr->getConnection('conn_pgsql');
        $this->sqliteConn = $mr->getConnection('conn_sqlite');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $mysqlVersionInfo = $this
            ->mysqlConn
            ->executeQuery('SHOW VARIABLES LIKE "%version%";')
            ->fetchAll()
        ;
        $pgsqlVersionInfo = $this
            ->pgsqlConn
            ->executeQuery('SELECT version();')
            ->fetchColumn()
        ;
        $sqliteVersionInfo = $this
            ->sqliteConn
            ->executeQuery('SELECT sqlite_version();')
            ->fetchColumn()
        ;
        $mysqlTable = new Table($output);
        $mysqlTable->setHeaders([new TableCell('MySql connection', ['colspan' => 2])]);
        foreach ($mysqlVersionInfo as $mysqlRow){
            $mysqlTable->addRow([$mysqlRow['Variable_name'], $mysqlRow['Value']]);
        }
        $mysqlTable->render();
        $pgsqlTable = new Table($output);
        $pgsqlTable->setHeaders(['PgSql connection']);
        $pgsqlTable->addRow([$pgsqlVersionInfo]);
        $pgsqlTable->render();
        $sqLiteTable = new Table($output);
        $sqLiteTable->setHeaders(['SqLite connection']);
        $sqLiteTable->addRow([$sqliteVersionInfo]);
        $sqLiteTable->render();

    }
}
