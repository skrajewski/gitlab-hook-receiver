<?php namespace Szykra\GitLabReceiver\CommandListeners;

abstract class AbstractCommandListener {

    /**
     * @var
     */
    protected $logger;

    /**
     * @param $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param        $msg
     * @param string $level
     * @param array  $context
     */
    protected function log($msg, $level = 'NOTICE', $context = [])
    {
        $this->logger->log($level, $msg, $context);
    }

    /**
     * @param $data
     * @return mixed
     */
    abstract public function run($data);
}