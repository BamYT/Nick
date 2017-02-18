<?php

namespace KCodeYT;

use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\Player;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Item;


class BamNick extends PluginBase implements Listener {
	
	public $prefix = TextFormat::GRAY . "[" . TextFormat::RED . "Bam" . TextFormat::GOLD . "Nick" . TextFormat::GRAY . "]" . TextFormat::WHITE . " "; 
	
	public function onEnable() {
		
		@mkdir($this->getDataFolder());
		@mkdir($this->getDataFolder() . "/Player/");
		
		$this->getLogger()->info($this->prefix . TextFormat::GREEN . "Aktiviert!");
		
	}
	
	public function getActiveNick($name) {
		$pf = new Config($this->getDataFolder() . "/Players/" . strtolower($name) . ".yml", Config::YAML);
		if(!$pf->exists("nick")) {
			$pf->set("nick", false);
			$pf->save();
			
		}
		
		return $pf->get("nick");
	}
	
	public function setNickActive($name, bool $value) {
		$pf = new Config($this->getDataFolder() . "/Players/" . strtolower($name) . ".yml", Config::YAML);
		if(!$pf->exists("nick")) {
			$pf->set("nick", false);
			$pf->save();
		}
		
		$pf->set("nick", $value);
		$pf->save();
		
	}
	
	public function getNick($name) {
		$pf = new Config($this->getDataFolder() . "/Players/" . strtolower($name) . ".yml", Config::YAML);
		if(!$pf->exists("nick")) {
			$pf->set("nick", false);
			$pf->save();
		}
		
		if($pf->exists("nickname")) {
			return $pf->get("nickname");
		}
		return null;
	}
	
	public function onInteract(PlayerInteractEvent $event){
        $config = new Config($this->getDataFolder()."config.yml", Config::YAML);
        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();
        if($item->getCustomName() == TextFormat::GOLD . "Nick: " . TextFormat::GREEN . "AN"){
            
			$this->getServer()->dispatchCommand($player, "nick");
			
		}
		if($item->getCustomName() == TextFormat::GOLD . "Nick: " . TextFormat::RED . "AUS"){
            
			$this->getServer()->dispatchCommand($player, "nick");
			
		}
		
    }
	
	public function onJoin(PlayerJoinEvent $event) {
		$player = $event->getPlayer();
		$name = $player->getName();
		
		$pf = new Config($this->getDataFolder() . "/Players/" . strtolower($name) . ".yml", Config::YAML);
		
		$inv = $player->getInventory();
		
		$item1 = Item::get(Item::NETHER_STAR);
		if($this->getActiveNick($name)) {
			$n = TextFormat::GREEN . "AN";
		} else {
			$n = TextFormat::RED . "AUS";
		}
        $item1->setCustomName(TextFormat::GOLD . "Nick: " . $n);
		
		$inv->setItem(5, $item1);
		
	}
	
	public function onChat(PlayerChatEvent $event) {
		$player = $event->getPlayer();
		$name = $player->getName();
		
		$msg = $event->getMessage();
		
		$pf = new Config($this->getDataFolder() . "/Players/" . strtolower($name) . ".yml", Config::YAML);
		
		if($pf->exists("nickname")) {
			
			$event->setFormat(TextFormat::GOLD . $pf->get("nickname") . TextFormat::ESCAPE . "8 -> " . TextFormat::GRAY . $msg);
			
		}
		
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		$p = $sender;
		$name = $p->getName();
		$pf = new Config($this->getDataFolder() . "/Players/" . strtolower($name) . ".yml", Config::YAML);
		
		if(strtolower($cmd->getName()) == "nick") {
			
			if($p->hasPermission("nick.set")) {
				
				if(empty($args[0])) {
					
					if($this->getActiveNick($name)) {
						
						$pf->remove("nickname");
						$pf->save();
						$p->sendMessage($this->prefix . TextFormat::RED . "du bist nun nicht mehr genickt");
						
					} else {
					
					$m = $args[0];
					
					$pf->set("nickname", $m);
					$pf->save();
					
					$p->sendMessage($this->prefix . TextFormat::GREEN . "Du bist genickt mit dem nick: " . TextFormat::GOLD . $m);
					}
					
				} else {
					if($this->getActiveNick($name)) {
						
						$pf->remove("nickname");
						$pf->save();
						$p->sendMessage($this->prefix . TextFormat::RED . "du bist nun nicht mehr genickt");
						
					} else {
					
					$nicks = array(
					"OneklickLP",
					"Ungekillt",
					"KillerXD",
					"IchDenkeGradeLP",
					"Ungespielt",
					"LetsPlaymitKev",
					"EricLP",
					"x0_Sopile_0x",
					"Gimander",
					"OnlunduXDLP",
					"SpolierGAME",
					"TIMEtoNOW",
					"Ungeheuer",
					"SpielenderSpieler",
					"GlumanderPoke"
					);
					
					$m = mt_rand(1, count($nicks) - 1);
					
					$pf->set("nickname", $m);
					$pf->save();
					
					}
					$p->sendMessage($this->prefix . TextFormat::GREEN . "Du bist genickt mit dem nick: " . TextFormat::GOLD . $m);
					
				}
				
			} else {
				
				$p->sendMessage($this->prefix . TextFormat::RED . "Du muss YouTuber oder Teammitglied sein");
				
			}
			
		}
		
	}
	
	public function onDisable() {
		
		$this->getLogger()->info($this->prefix . TextFormat::RED . "Deaktiviert!");
		
	}
	
}

?>