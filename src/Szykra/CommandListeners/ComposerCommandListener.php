<?php namespace Szykra\GitLabReceiver\CommandListeners;

class ComposerCommandListener extends AbstractCommandListener {

    /**
     * @var string
     */
    protected $command = "composer";

    /**
     * @param $data
     * @return bool
     */
    public function run($data)
    {
        $this->logger->notice('Start Composer Hook checker');

        foreach($data['commits'] as $commit)
        {
            $arr = [];
            preg_match_all("/\\[(.*?):(.*?)\\]/", $commit['message'], $arr);

            if( ! empty($arr[1]) && $arr[1][0] == "composer" && ! empty($command))
            {
                $command = $arr[2][0];

                $this->logger->notice("Composer ". $command ." start...");
                $output = shell_exec('composer --no-interaction '. $command);
                $this->logger->notice($output);
                $this->logger->notice("Composer ". $command ." is done.");

                return;
            }
        }

        $this->logger->notice('End Composer Hook');

        return true;
    }

} 