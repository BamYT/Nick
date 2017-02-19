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
		@mkdir($this->getDataFolder() . "Players");
		
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info($this->prefix . TextFormat::GREEN . "Aktiviert!");
		
	}
	
	public function getActiveNick($name) {
		$pf = new Config($this->getDataFolder() . "Players/" . strtolower($name) . ".yml", Config::YAML);
		if(!$pf->exists("nick")) {
			$pf->set("nick", false);
			$pf->save();
			
		}
		
		return $pf->get("nick");
	}
	
	public function setNickActive($name, bool $value) {
		$pf = new Config($this->getDataFolder() . "Players/" . strtolower($name) . ".yml", Config::YAML);
		if(!$pf->exists("nick")) {
			$pf->set("nick", false);
			$pf->save();
		}
		
		$pf->set("nick", $value);
		$pf->save();
		
	}
	
	public function getNick($name) {
		$pf = new Config($this->getDataFolder() . "Players/" . strtolower($name) . ".yml", Config::YAML);
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
        
		if($item->getCustomName() == TextFormat::GRAY . "| " . TextFormat::GOLD . "NICKEN" . TextFormat::GRAY . " |") {
			
			$this->getServer()->dispatchCommand($player, "nick");
			
		}
		
    }
	
	public function onJoin(PlayerJoinEvent $event) {
		$player = $event->getPlayer();
		$name = $player->getName();
		
		$pf = new Config($this->getDataFolder() . "Players/" . strtolower($name) . ".yml", Config::YAML);
		
		if($pf->get("nick") == null) {
			$pf->set("nick", false);
			$pf->save();
		}
		
		$inv = $player->getInventory();
		
		$item1 = Item::get(Item::NETHER_STAR);
        $item1->setCustomName(TextFormat::GRAY . "| " . TextFormat::GOLD . "NICKEN" . TextFormat::GRAY . " |");
		
		$inv->setItem(5, $item1);
		
	}
	
	public function onChat(PlayerChatEvent $event) {
		$player = $event->getPlayer();
		$name = $player->getName();
		
		$msg = $event->getMessage();
		
		$pf = new Config($this->getDataFolder() . "Players/" . strtolower($name) . ".yml", Config::YAML);
		
		if($pf->exists("nickname")) {
			
			$event->setFormat(TextFormat::GOLD . $pf->get("nickname") . TextFormat::ESCAPE . "8 -> " . TextFormat::GRAY . $msg);
			
		}
		
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		$p = $sender;
		$name = $p->getName();
		$pf = new Config($this->getDataFolder() . "Players/" . strtolower($name) . ".yml", Config::YAML);
		
		if(strtolower($cmd->getName()) == "nick") {
			
			if($p->hasPermission("nick.set")) {
					
					if($pf->get("nick") == true) {
						
						$pf->set("nick", false);
						$pf->remove("nickname");
						$pf->save();
						$p->sendMessage($this->prefix . TextFormat::RED . "Du bist nun nicht mehr genickt");
						
						$pc = $this->getServer()->getPluginManager()->getPlugin("PureChat");
						
						$nameTag = $pc->getNametag($p);
						
						$p->setNameTag($nameTag);
						
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
					"GlumanderPoke",
					"Billybobjoepants",
					"BioShock_Rules",
					"Blanzer",
					"Bob-Omb",
					"bosky2102",
					"Brendan170",
					"broswen",
					"Btrpo",
					"bubbyboytoo",
					"DaBomb",
					"Darvince",
					"DaSnipeKid",
					"Dawnofdusk",
					"De_n00bWOLF",
					"DeepDarkSamurai",
					"DefaultAsAwesome",
					"diamondhand146",
					"DirtDog",
					"DivinityV2",
					"DontStealMyBacon",
					"Draconus",
					"Dylanf3",
					"Madisonwilleatu",
					"lexodexode",
					"BluplayzYT",
					"mangadj",
					"marett",
					"Mayahem",
					"Meman5000",
					"MinecraftMasterz",
					"MineMan_620",
					"MisterModerator",
					"Muro45",
					"SavageClown",
					"Schmoople",
					"ScrooLewse",
					"scyp10",
					"Serus Haralain",
					"Traveler",
					"silverboyp",
					"Snerus",
					"lexodexode",
					"BluplayzYT",
					"Space_Walker",
					"SpeedyAstro",
					"Syfaro",
					"Synchrophi",
					"RandomIdoit",
					"Redwild10",
					"Rochambo",
					"roebuck",
					"RtYyU36",
					"runnerman1",
					"SavageClown",
					"Schmoople",
					"ScrooLewse",
					"lexodexode",
					"BluplayzYT",
					"scyp10",
					"Serus Haralain",
					"silverboyp",
					"Snerus",
					"Space_Walker",
					"SpeedyAstro",
					"Syfaro",
					"Synchrophi",
					"CraftNichtKlinik",
					"DeveloperxD",
					"DevxDPlayerxD",
					"Der_nicht_genickte_HD"
					);
					
					$m = mt_rand(1, count($nicks) - 1);
					
					$pf->set("nick", true);
					$pf->set("nickname", $nicks[$m]);
					$pf->save();
					
					$p->sendMessage($this->prefix . TextFormat::GREEN . "Du bist genickt mit dem nick: " . TextFormat::GOLD . $nicks[$m]);
					
					$p->setNameTag(TextFormat::GRAY . "[" . TextFormat::GOLD . "Spieler" . TextFormat::GRAY . "] " . TextFormat::WHITE . $nicks[$m]);
					
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