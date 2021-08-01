<?php

/*
 *               _ _
 *         /\   | | |
 *        /  \  | | |_ __ _ _   _
 *       / /\ \ | | __/ _` | | | |
 *      / ____ \| | || (_| | |_| |
 *     /_/    \_|_|\__\__,_|\__, |
 *                           __/ |
 *                          |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author TuranicTeam
 * @link https://github.com/TuranicTeam/Altay
 *
 */

declare(strict_types=1);

namespace pocketmine\item;

use pocketmine\entity\Entity;
use pocketmine\entity\object\FireworksRocket;
use pocketmine\level\particle\FireworksSparkParticle;
use pocketmine\level\sound\BlazeShootSound;
use pocketmine\math\Vector3;
use pocketmine\Player;

class Elytra extends Item{
	/** @var float */
	public const BOOST_POWER = 1.25;
	public const BOOST_TICK = 20*2;

	public static array $boost_players = [];

	public function __construct(int $meta = 0){
		parent::__construct(Item::ELYTRA, $meta, "Elytra Wings");
	}

	public function getArmorSlot() : int{
		return 1;
	}

	public function getMaxStackSize() : int{
		return 1;
	}

	public static function boostPlayer(Player $player): bool{
		$motion = new Vector3((-sin($player->yaw / 180 * M_PI) * cos($player->pitch / 180 * M_PI) * self::BOOST_POWER), (-sin($player->pitch / 180 * M_PI) * self::BOOST_POWER), (cos($player->yaw / 180 * M_PI) * cos($player->pitch / 180 * M_PI) * self::BOOST_POWER));
		$player->setMotion($motion);
		return true;
	}

	public function onUpdate(Player $player) : void{
		$name=$player->getLowerCaseName();
		if(isset(self::$boost_players[$name])){
			if($player->isGliding()){
				self::boostPlayer($player);
				if(self::$boost_players[$name] % 2 == 0){
					$player->getLevel()->addParticle(new FireworksSparkParticle($player));
				}
			}
			self::$boost_players[$name]-=1;
			if(self::$boost_players[$name]==0){
				unset(self::$boost_players[$name]);
			}
		}
	}
}
