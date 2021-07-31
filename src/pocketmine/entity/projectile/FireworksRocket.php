<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 *
 *
*/

declare(strict_types=1);

namespace pocketmine\entity\projectile;

use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\level\particle\FireworksSparkParticle;
use pocketmine\level\particle\ItemBreakParticle;
use pocketmine\level\particle\SplashParticle;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;

class FireworksRocket extends Throwable{
	public const NETWORK_ID = self::FIREWORKS_ROCKET;

	protected function onHit(ProjectileHitEvent $event) : void{

	}

	public function flagForDespawn() : void{
		parent::flagForDespawn();
		for($i = 0; $i < 20; ++$i){
			$this->level->addParticle(new FireworksSparkParticle($this->add(rand(-2,2),rand(-2,2),rand(-2,2))));
		}
		$this->getLevelNonNull()->broadcastLevelSoundEvent($this, LevelSoundEventPacket::SOUND_BLAST);
	}
}
