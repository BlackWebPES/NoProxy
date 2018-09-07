<?php

namespace NoProxy;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\{Config, TextFormat, Utils};
use pocketmine\math\Vector3;
use pocketmine\{Player, Server};
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener{

public function onEnable(){
$this->getServer()->getPluginManager()->registerEvents($this, $this);
$this->saveDefaultConfig();
$this->getLogger()->info("NoProxy enabled successfully");
}

public function onJoin(PlayerJoinEvent $event){
$array = $this->getConfig()->get("isp");
$player = $event->getPlayer();
$name = $player->getName();
$ip = $player->getAddress();
if($player != null){
$get = file_get_contents("http://ip-api.com/php/" . $ip);
if($get != null or $get != "" or $get != 0){
$query = unserialize($get);
/* isp checker */
foreach($array as $isps){
if(strtolower($query["isp"]) == strtolower($isps)){
$player->kick("§c§lProxy Detected", false);
}
}
/* end of isp checker */
}
}
}
}
