<?php namespace ConsumerRewards\SDK\Config;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Logger extends AbstractConfig
{
    /**
     * @inheritdoc
     */
    protected function getName() : string
    {
        return 'logger';
    }

    /**
     * @param array $options
     * @return LoggerInterface $logger
     */
    public function config(array $options)
    {
        $logLevel = (empty($options['logLevel'])) ? LogLevel::DEBUG : $options['logLevel'];
        $logDir = ((empty($options['logDir'])) ? '' : $options['logDir']). 'cr-sdk.log';

        $logger = new \Monolog\Logger('cr-log');
        $stream = new StreamHandler($logDir, $logLevel);
        $formater = new LineFormatter("[%datetime%] %channel%.%level_name% - %context%: %message%\n");
        $formater->includeStacktraces();
        $formater->ignoreEmptyContextAndExtra();
        $stream->setFormatter($formater);
        $logger->pushHandler($stream);

        return $logger;
    }
}