<?php

declare(strict_types=1);

namespace Jolicht\MonologCloudwatchHandler;

use Aws\CloudWatchLogs\CloudWatchLogsClient;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\LogRecord;

final class CloudWatchHandler extends AbstractProcessingHandler
{
    public function __construct(
        private readonly CloudWatchLogsClient $cloudWatchLogsClient,
        private readonly string $logGroupName,
        private readonly string $logStreamName,
        int|string|Level $level = Level::Debug,
        bool $bubble = true
    ) {
        parent::__construct($level, $bubble);
    }

    protected function write(LogRecord $record): void
    {
        $this->cloudWatchLogsClient->putLogEvents([
            'logEvents' => [
                [
                    'message' => $record->formatted,
                    'timestamp' => (int) $record->datetime->format('Uv'),
                ],
            ],
            'logGroupName' => $this->logGroupName,
            'logStreamName' => $this->logStreamName,
        ]);
    }
}
