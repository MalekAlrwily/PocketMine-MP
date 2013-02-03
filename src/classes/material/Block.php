<?php

/*

           -
         /   \
      /         \
   /   PocketMine  \
/          MP         \
|\     @shoghicp     /|
|.   \           /   .|
| ..     \   /     .. |
|    ..    |    ..    |
|       .. | ..       |
\          |          /
   \       |       /
      \    |    /
         \ | /

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Lesser General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.


*/


abstract class Block{

	protected $id;
	protected $meta;
	protected $shortname = "";
	protected $name = "";
	public $isActivable = false;
	public $isBreakable = true;
	public $isFlowable = false;
	public $isTransparent = false;
	public $isReplaceable = false;
	public $isPlaceable = true;
	public $inWorld = false;
	public $hasPhysics = false;
	public $isLiquid = false;
	public $x;
	public $y;
	public $z;
	
	public function __construct($id, $meta = 0, $name = "Unknown"){
		$this->id = (int) $id;
		$this->meta = (int) $meta;
		$this->name = $name;
		$this->shortname = strtolower(str_replace(" ", "_", $name));
	}
	
	public function getName(){
		return $this->name;
	}
	
	final public function getID(){
		return $this->id;
	}
	
	final public function getMetadata(){
		return $this->meta & 0x0F;
	}
	
	final public function position(Vector3 $v){
		$this->inWorld = true;
		$this->x = (int) $v->x;
		$this->y = (int) $v->y;
		$this->z = (int) $v->z;
	}
	
	public function getDrops(Item $item, Player $player){
		return array(
			array($this->id, $this->meta, 1),
		);
	}
	
	abstract function place(BlockAPI $level, Item $item, Player $player, Block $block, Block $target, $face, $fx, $fy, $fz);
	
	abstract function onActivate(BlockAPI $level, Item $item, Player $player);
	
	abstract function onUpdate(BlockAPI $level, $type);
}

require_once("block/GenericBlock.php");
require_once("block/SolidBlock.php");
require_once("block/TransparentBlock.php");
require_once("block/FallableBlock.php");
require_once("block/LiquidBlock.php");