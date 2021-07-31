<?php
/**
 * SlimeBlock.php
 *
 * @project NaivePocketMine-MP
 * @author lixworth <lixworth@outlook.com>
 * @copyright NaivePocketMine-MP
 * @create 2021/7/31 20:38
 */

declare(strict_types=1);

namespace pocketmine\block;


class SlimeBlock extends Solid{
	protected $id = self::SLIME_BLOCK;

	public function __construct(int $meta = 0){
		$this->meta = $meta;
	}

	public function getName() : string
	{
		return 'Slime Block';
	}

	public function getHardness() : float
	{
		return 0;
	}


	public function getBlastResistance() : float
	{
		return 0;
	}

}