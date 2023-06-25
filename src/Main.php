<?php

declare(strict_types=1);

namespace NhanAZ\ILoveJungle;

use pocketmine\data\bedrock\BiomeIds;
use pocketmine\event\Listener;
use pocketmine\event\world\ChunkLoadEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\world\format\SubChunk;
use pocketmine\world\format\PalettedBlockArray;

class Main extends PluginBase implements Listener {

	protected function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/** Thanks @Muqsit [https://discord.com/channels/373199722573201408/373214753147060235/1122366583050866738] */
	public function onChunk(ChunkLoadEvent $event): void {
		$chunk = $event->getChunk();
		foreach ($chunk->getSubChunks() as $y => $subChunk) {
			if ($chunk->getSubChunk($y)->getBiomeArray()->getPalette() === [BiomeIds::JUNGLE]) {
				continue;
			}
			$chunk->setSubChunk($y, new SubChunk(
				$subChunk->getEmptyBlockId(),
				$subChunk->getBlockLayers(),
				new PalettedBlockArray(BiomeIds::JUNGLE),
				$subChunk->getBlockSkyLightArray(),
				$subChunk->getBlockLightArray()
			));
		}
	}
}
