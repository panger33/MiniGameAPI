<?php
namespace minigameapi\team;

use pocketmine\Player;
use pocketmine\Server;

class Team {
	private $maxPlayers = -1;
	private $minPlayers = 0;
	private $teamName;
	private $players = [];
	
	public function __construct(string $teamName, Player $firstPlayer, int $maxPlayers = -1, int $minPlayers = 0) {
		$this->setMaxPlayers($maxPlayers);
		$this->setMinPlayers($minPlayers);
		$this->setTeamName($teamName);
		$this->addPlayer($firstPlayer);
	}
	public function getMaxPlayers() : int{
		return $this->maxPlayers;
	}
	public function setMaxPlayers(int $maxPlayers) : bool{
		if(count($this->players) > $maxPlayers) {
			Server::getInstance()->getLogger()->error('$maxPlayers has to be smaller than count of players in team');
			return FALSE;
		}
		$this->maxPlayers = $maxPlayers;
		return true;
	}
	public function getMinPlayers() : int{
		return $this->minPlayers;
	}
	public function setMinPlayers(int $minPlayers) {
		$this->minPlayers = $minPlayers;
		return;
	}
	public function setTeamName(string $teamName) {
		$this->teamName = $teamName;
		return;
	}
	public function addPlayer(Player $player) : bool{
		if(count($this->players) == $this->maxPlayers) {
			Server::getInstance()->getLogger()->error('adding new player on full team');
			return false;
		}
		$this->removeExistsPlayers($player);
		$this->players[] = $player;
		return true;
	}
	public function removeExistsPlayers(Player $player) {
		foreach ($this->players as $key => $pl) {
			$pl instanceof Player;
			if($player->getName() == $pl->getName()) {
				unset($this->players[$key]);
				break;
			}
		}
		$this->players = array_values($this->players);
	}
}