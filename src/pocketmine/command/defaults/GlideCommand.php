<?php
/**
 * Cattery Mc
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author Cattery Team
 */

namespace pocketmine\command\defaults;


use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\Fireworks;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\lang\TranslationContainer;
use pocketmine\network\mcpe\protocol\AvailableCommandsPacket;
use pocketmine\network\mcpe\protocol\types\CommandParameter;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class GlideCommand extends VanillaCommand{
	public function __construct(string $name){
		parent::__construct(
			$name,
			"%pocketmine.command.glide.description",
			"%commands.glide.usage"
		);
		$this->setPermission("pocketmine.command.glide");
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if(!$this->testPermission($sender)){
			return true;
		}

		if($sender instanceof Player){
			$name=$sender->getLowerCaseName();
			if(!isset(Fireworks::$boost_players[$name])){
				Fireworks::$boost_players[$name]=-1;
				return true;
			}
			Fireworks::$boost_players[$name]=Fireworks::$boost_players[$name]<0?0:-1;
		}

		return true;
	}
}