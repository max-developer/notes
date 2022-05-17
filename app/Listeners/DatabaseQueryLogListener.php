<?php

namespace App\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Log\LogManager;

class DatabaseQueryLogListener
{
    private LogManager $logManager;

    public function __construct(LogManager $logManager)
    {
        $this->logManager = $logManager;
    }

    public function handle(QueryExecuted $event)
    {
        $sql = str_replace("?", "'%s'", $event->sql);
        $sql = vsprintf($sql, $event->bindings);
        $log = sprintf('SQL: %s; Time: %s;', $sql, $event->time);

        $this->logManager
            ->build([
                'driver' => 'single',
                'path' => storage_path('logs/sql.log'),
            ])
            ->info($log);
    }
}
