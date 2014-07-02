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
     * @param $data
     * @return mixed
     */
    abstract public function run($data);
}