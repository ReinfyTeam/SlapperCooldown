<?php

namespace xqwtxon\SlapperCooldownV2;

use pocketmine\plugin\PluginBase;
use xqwtxon\SlapperCooldownV2\SlapperCooldownListener;
use pocketmine\utils\TextFormat;
use pocketmine\network\mcpe\protocol\ProtocolInfo;

class Main extends PluginBase{

    public function onLoad() :void {
        $this->saveResource("config.yml");
        $config = $this->getConfig();
        $log = $this->getServer()->getLogger();
        if ($config->get("config-version") == "1.0.0"){
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
	    $toggle = $cfg->get("enabled"); // toggleer
	    $delay = $cfg->get("delay"); // delay of hits
	    if (!isset($toggle)){ // if leaved the toggle
	        $log->error("You leaved blank in config the option 'enabled'! So, it automatically set it to 'true' by default."); // message if they leaved blank the toggle
	        $cfg->set("enabled", true); // the config automatically sets to true
	        return;
	    }
	    if ($toggle == true){
            $this->getServer()->getPluginManager()->registerEvents(new SlapperCooldownListener($this), $this);
	    }
	    if ($toggle == false){
	        $log->notice("The SlapperCooldown was disabled by configuration. To enabled it, set in 'config.yml' the option 'enabled'!");
	        $this->getServer()->getPluginManager()->disablePlugin($this);
	    }
	    
	    if (!isset($delay)){
	        $log->error("The hit delay must be int not string/bool! by default automatically set to 0.5!");
	        $cfg->set("delay", 0.5);
	        return;
	    }
	    if (is_int($delay)){
	        $log->error("The hit delay must be int not string/bool! by default it automatically set delay to 0.5!");
	        $cfg->set("delay", 0.5);
                return;
	   } 
    }
}
