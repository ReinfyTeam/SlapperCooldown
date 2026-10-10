<?php

declare(strict_types=1);

namespace slapper\events;

use pocketmine\player\Player;

final class SlapperHitEvent {
	public function getDamager() : Player {
		throw new \LogicException();
	}

	public function cancel() : void {
	}
}
