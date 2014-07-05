<?php namespace Szykra\GitLabReceiver\CommandListeners;

class ComposerCommandListener extends AbstractCommandListener {

    /**
     * @var string
     */
    protected $command = "composer";

    /**
     * @var string
     */
    protected $directory;

    /**
     * @param $directory
     */
    function __construct($directory)
    {
        $this->directory = $directory;
    }

    /**
     * @param $data
     * @return bool
     */
    public function run($data)
    {
        $this->log('Start composer command listener.');

        foreach($data['commits'] as $commit)
        {
            $find = [];
            preg_match_all("/\\[(.*?):(.*?)\\]/", $commit['message'], $find);

            $key = array_search($this->command, $find[1]);

            if ($key === false) continue;

            $command = $find[2][$key];

            $this->log("Composer " .$command. " start...");
            $output = shell_exec('cd '. $this->directory .' && composer --no-interaction ' . $command);
            $this->log($output);
            $this->log("Composer " .$command. " is done.");

            return;
        }

        $this->log('End composer command listener.');

        return true;
    }

} 