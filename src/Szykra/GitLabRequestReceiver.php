<?php namespace Szykra\GitLabReceiver;

use Psr\Log\LoggerInterface;
use Szykra\GitLabReceiver\CommandListeners\AbstractCommandListener;

class GitLabRequestReceiver {

    /**
     * @var
     */
    protected $requestData;

    /**
     * @var
     */
    private $logger;

    /**
     * @var array
     */
    private $commands = [];

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param $data
     */
    public function prepareData($data)
    {
        $this->requestData = json_decode($data, true);
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->requestData;
    }

    /**
     * @param $command
     */
    public function addCommandListener(AbstractCommandListener $command)
    {
        $this->commands[] = $command;
        $command->setLogger($this->logger);
    }

    /**
     * Run all commands
     */
    public function run()
    {
        foreach ($this->commands as $command)
        {
            $command->run($this->requestData);
        }
    }
} 