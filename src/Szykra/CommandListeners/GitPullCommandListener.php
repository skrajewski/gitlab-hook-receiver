<?php namespace Szykra\GitLabReceiver\CommandListeners;

class GitPullCommandListener extends AbstractCommandListener {

    /**
     * @var
     */
    protected $repositoryPath;

    /**
     * @param $repositoryPath
     */
    function __construct($repositoryPath)
    {
        $this->repositoryPath = $repositoryPath;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function run($data)
    {
        $this->logger->notice('Start Git Pull Hook');
        $output = shell_exec('cd '. $this->repositoryPath .' && git pull');
        $this->logger->notice($output);
        $this->logger->notice('Actual commit: '. $data['after']);
        $this->logger->notice('Git pull complete.');
    }
}