<?php

namespace xqwtxon\SlapperCooldownV2;

use pocketmine\plugin\PluginBase;
use xqwtxon\SlapperCooldownV2\SlapperCooldownInfo;
use xqwtxon\SlapperCooldownV2\SlapperCooldownListener;
use pocketmine\utils\TextFormat;
use pocketmine\network\mcpe\protocol\ProtocolInfo;

class SlapperCooldown extends PluginBase implements SlapperCooldownInfo {

    public function onLoad() :void {
        $this->saveResource("config.yml");
        $config = $this->getConfig();
        $log = $this->getServer()->getLogger();
        $version = SlapperCooldownInfo::PLUGIN_VERSION;
        $log->notice(TextFormat::YELLOW."[INFO] You are running §aSlapperCooldown {$version} §eby xqwtxon!");
        if ($config->get("config-version") == SlapperCooldownInfo::CONFIG_VERSION){
            $log->info("[SUCCESS] Loaded SlapperCooldown!");
        } else {
            $log->notice("[WARNING] Your config is outdated!");
            $log->info("[WARNING] Your old config.yml was as old-config.yml");
            @rename($this->getDataFolder(). 'config.yml', 'old-config.yml');
            $this->saveResource("config.yml");
        }
        
        if (SlapperCooldownInfo::IS_DEVELOPMENT_BUILD == true){
            $log->warning(TextFormat::RED."[WARNING] Your SlapperCooldown is in development build! You may expect crash during the plugin. You can make issue about this plugin by visiting plugin github issue!");
        }
    }
    
	public function onEnable() :void{
	    if (SlapperCooldownInfo::PROTOCOL_VERSION == ProtocolInfo::CURRENT_PROTOCOL){
                $log->info(TextFormat::GREEN."[INFO] Your SlapperCooldown is Compatible with your version!");
            } else {
                $log->info(TextFormat::RED."[ERROR] Your SlapperCooldown isnt Compatible with your version!");
                $this->getServer()->getPluginManager()->disablePlugin($this);
                return;
            }
	    // nice comment be like:
	    $this->saveResource("config.yml"); // if not saved
	    $this->saveDefaultConfig(); // should be saved
	    $cfg = $this->getConfig(); // gets the config
	    $log = $this->getServer()->getLogger(); // gets the logger
	    $toggle = $cfg->get("enabled"); // toggleer
	    if (!isset($toggle)){ // if leaved the toggle
	        $log->error("[ERROR] You leaved blank in config the option 'enabled'! So, it automatically set it to 'true' by default."); // message if they leaved blank the toggle
	        $cfg->set("enabled", true); // the config automatically sets to true
	        return;
	    }
	    if ($toggle == true){
            $this->getServer()->getPluginManager()->registerEvents(new SlapperCooldownListener($this), $this);
	    }
	    if ($toggle == false){
	        $log->notice("[INFO] The SlapperCooldown was disabled by configuration. To enabled it, set in 'config.yml' the option 'enabled'!");
	        $this->getServer()->getPluginManager()->disablePlugin($this);
	    }
	    
	    if (!isset($delay)){
	        $log->error("[INFO] The hit delay must be int not string/bool! by default automatically set to 0.5!");
	        $cfg->set("delay", 0.5);
	        return;
	    }
	    /**
	     * TODO: @int $delay
	     * Boring rn.
	    if (){
	        $log->error("[INFO] The hit delay must be int not string/bool! by default it automatically set delay to 0.5!");
	        $cfg->set("delay", 0.5);
	    }
	    */
    }
    
    public function onDisable() :void{
        $config = $this->getConfig();
        $log = $this->getServer()->getLogger();
        $log->info(TextFormat::RED."Successfully disabled the plugin!");
    }
}
