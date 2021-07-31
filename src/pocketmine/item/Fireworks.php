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

namespace pocketmine\item;

use pocketmine\block\Block;
use pocketmine\entity\Entity;
use pocketmine\entity\EntityIds;
use pocketmine\entity\projectile\Projectile;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\Player;
use pocketmine\Server;

class Fireworks extends Item{
	public function __construct(int $meta = 0){
		parent::__construct(self::FIREWORKS, $meta, "FireworksRocket");
	}

	public function getMaxStackSize() : int{
		return 64;
	}

	public function onActivate(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector) : bool{
		$nbt = Entity::createBaseNBT($blockReplace, new Vector3(0,1,0), $player->yaw, $player->pitch);

		$projectile = Entity::createEntity('FireworksRocket', $player->getLevelNonNull(), $nbt, $player);

		if($projectile !== null){
			$projectile->setMotion($projectile->getMotion()->multiply(1.5));
		}

		$this->pop();

		if($projectile instanceof Projectile){
			$projectileEv = new ProjectileLaunchEvent($projectile);
			$projectileEv->call();
			if($projectileEv->isCancelled()){
				$projectile->flagForDespawn();
			}else{
				$projectile->spawnToAll();
				$blockReplace->getLevelNonNull()->broadcastLevelSoundEvent($blockReplace, LevelSoundEventPacket::SOUND_LAUNCH);
			}
		}elseif($projectile !== null){
			$projectile->spawnToAll();
		}else{
			return false;
		}

		return true;
	}
}
