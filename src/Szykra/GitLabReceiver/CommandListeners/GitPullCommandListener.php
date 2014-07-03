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
        $this->log('Start git pull command listener');
        $output = shell_exec('cd '. $this->repositoryPath .' && git pull');
        $this->log($output);
        $this->log('Actual commit: '. $data['after']);
        $this->log('End git pull command listener.');
    }
}