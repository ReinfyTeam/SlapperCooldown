<?php

declare(strict_types=1);

namespace ReinfyTeam\SlapperCooldown;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

    protected function onLoad() : void {
        $this->saveResource("config.yml");
        $config = $this->getConfig();
        $log = $this->getServer()->getLogger();
        if ($config->get("config-version") === "1.0.1"){
            return;
        } else {
            $log->notice("Your config is outdated!");
            $dataFolder = rtrim($this->getDataFolder(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
            if(!rename($dataFolder . "config.yml", $dataFolder . "old-config.yml")){
                $log->error("Unable to preserve the old config.yml before migration.");
                return;
            }
            $this->saveResource("config.yml", true);
        }
    }
    
	public function onEnable() : void{
	    $log = $this->getLogger(); // gets the logger
	    // nice comment be like
	    $this->saveDefaultConfig(); // should be saved
	    $this->getServer()->getPluginManager()->registerEvents(new SlapperCooldownListener($this), $this);
	    $cfg = $this->getConfig(); // gets the config
	    $delay = $cfg->get("delay"); // delay of hit
	    
	    if (!isset($delay)){
	        $log->error("The hit delay must not blanked! by default automatically set to 0.5!");
	        $cfg->set("delay", 0.5);
	        $this->saveConfig();
	        return;
	   } 
    }
}
