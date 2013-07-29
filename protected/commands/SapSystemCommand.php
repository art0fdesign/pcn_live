<?php

class SapSystemCommand extends CConsoleCommand {

    public function run($args)
    {
        set_time_limit(0);

        // action which use to communicate with sap
        if(isset($args[0]))
            $action =  $args[0];

        // 0 - real
        // 1 - test
        if(isset($args[1]))
            $test =  $args[1];

        // language
        $lang = 'sr';
        if(isset($args[2]))
            $lang =  $args[2];

        $sap = new SapSystem();

        $sap->Connect($action,$test,$lang);

         exit;
    }
}

