<?php

namespace xqwtxon\SlapperCooldownV2;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use slapper\events\SlapperHitEvent;
use xqwtxon\SlapperCooldownV2\Main;

class SlapperCooldownListener implements Listener {
    
    public function __construct(private Main $plugin){
        //NOOP
    }
    
    /** @var array<string, float> */
	private $lastHit = [];
	
    /**
     * @param SlapperHitEvent $ev
     */
	public function onSlapperHit(SlapperHitEvent $ev){
	    $name = $ev->getDamager()->getName();
	    $delay = $this->plugin->getConfig()->get("delay");
	    $message = $this->plugin->getConfig()->get("message");
	    if(!isset($this->lastHit[$name])){
	        $this->lastHit[$name] = microtime(true);
	        return;
        }
        if(($this->lastHit[$name] + $delay) > (microtime(true))){
            $ev->cancel();
            $ev->getDamager()->sendTip($message);
        } else {
            $this->lastHit[$name] = microtime(true);
        }
        return;
    }

    public function onPlayerQuit(PlayerQuitEvent $ev){
        unset($this->lastHit[$ev->getPlayer()->getName()]);
    }
}