<?php

namespace ReinfyTeam\SlapperCooldown;

use pocketmine\plugin\PluginBase;
use ReinfyTeam\SlapperCooldown\SlapperCooldownListener;
use pocketmine\utils\TextFormat;
use pocketmine\network\mcpe\protocol\ProtocolInfo;

class Main extends PluginBase{

    public function onLoad() :void {
        $this->saveResource("config.yml");
        $config = $this->getConfig();
        $log = $this->getServer()->getLogger();
        if ($config->get("config-version") == "1.0.1"){
            return;
        } else {
            $log->notice("Your config is outdated!");
            $log->info("Your old config.yml was as old-config.yml");
            @rename($this->getDataFolder(). 'config.yml', 'old-config.yml');
            $this->saveResource("config.yml");
        }
    }
    
	public function onEnable() :void{
	    $log = $this->getLogger(); // gets the logger
	    // nice comment be like
	    $this->saveDefaultConfig(); // should be saved
	    $cfg = $this->getConfig(); // gets the config
	    $delay = $cfg->get("delay"); // delay of hit
	    
	    if (!isset($delay)){
	        $log->error("The hit delay must not blanked! by default automatically set to 0.5!");
	        $cfg->set("delay", 0.5);
	        return;
	   } 
    }
}
