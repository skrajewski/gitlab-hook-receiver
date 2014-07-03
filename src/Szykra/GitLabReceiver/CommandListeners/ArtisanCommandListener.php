<?php namespace Szykra\GitLabReceiver\CommandListeners;


class ArtisanCommandListener extends AbstractCommandListener {

    /**
     * @var string
     */
    protected $command = "artisan";

    /**
     * @var
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
     * @return mixed
     */
    public function run($data)
    {
        $this->log('Start artisan command listener.');

        foreach($data['commits'] as $commit)
        {
            $find = [];
            preg_match_all("/\\[(.*?):(.*?)\\]/", $commit['message'], $find);

            $key = array_search($this->command, $find[1]);

            if ($key === false) continue;

            $command = $find[2][$key];

            $this->log("Artisan " .$command. " start...");
            $output = shell_exec('cd '. $this->directory .' && php artisan ' . $command);
            $this->log($output);
            $this->log("Artisan " .$command. " is done.");

            return;
        }

        $this->log('End artisan command listener.');

        return true;
    }
}