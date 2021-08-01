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
declare(strict_types=1);

namespace pocketmine\block;

class SoulFireTorch extends Torch{

	protected $id = self::SOUL_TORCH;

	public function getName() : string{
		return "Soul Fire Torch";
	}

	public function getLightLevel() : int{
		return 7;
	}
}