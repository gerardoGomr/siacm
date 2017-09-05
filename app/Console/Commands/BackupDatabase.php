<?php

namespace Siacme\Console\Commands;

use DateTime;
use Exception;
use Ifsnop\Mysqldump\Mysqldump;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

/**
 * Class BackupDatabase
 *
 * @package Siacme\Console\Commands
 * @category Console Command
 * @author Gerardo Adrián Gómez Ruiz <gerardo.gomr@gmail.com>
 */
class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs the backup for the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $name = (new DateTime)->format('Y-m-d H:i:s') . '.sql';
            $name = 'test.sql';
            $dump = new Mysqldump('mysql:host=localhost;dbname=consultorio_diamante', env('DB_USERNAME'), env('DB_PASSWORD'));
            $dump->start('/home/consultorio/' . $name);

        } catch (Exception $e) {
            Log::info('==========================');
            Log::info('mysqldump-php error');
            Log::info($e->getMessage());
            Log::info($e->getTraceAsString());
            Log::info('==========================');
        }
    }
}