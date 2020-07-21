<?php

/**
 * Copyright 2020-2021 Pedhot
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace pedhot\RankListPE;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\{Player, Server};
use pocketmine\command\{Command, CommandSender};
use jojoe77777\FormAPI\SimpleForm;

class Main extends PluginBase implements Listener{
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info("[RankListPE] By Pedhot Enabled");
		
		@mkdir($this->getDataFolder());
		@mkdir($this->getDataFolder() . "rank/");
		
		$this->saveResource("rank/one.txt");
		$this->saveResource("rank/two.txt");
		$this->saveResource("rank/three.txt");
		$this->saveResource("rank/four.txt");
		
		$this->saveResource("config.yml");
		$this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML);
	}
	
	public function onDisable(){
		$this->getLogger()->info("[RankListPE] By Pedhot Disabled");
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		switch($cmd->getName()){
			case "ranklist":
				$this->RankList($sender);
				break;
		}
		return true;
	}
	
	public function RankList(Player $sender){
		$form = new SimpleForm(function (Player $sender, $data){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
				$sender->addTitle($this->config->getNested("exit.title"), $this->config->getNested("exit.subtitle"));
				$sender->sendMessage($this->config->getNested("exit.message"));
				break;
				case 1:
				$this->rankSatu($sender);
				break;
				case 2:
				$this->rankDua($sender);
				break;
				case 3:
				$this->rankTiga($sender);
				break;
				case 4:
				$this->rankEmpat($sender);
				break;
			}
		});
		$form->setTitle($this->config->getNested("ranklist.title-form"));
		$form->setContent($this->config->getNested("ranklist.content"));
		$form->addButton($this->config->getNested("exit.button.name"), $this->config->getNested("exit.button.image-type"), $this->config->getNested("exit.button.image-url"));
		$form->addButton($this->config->getNested("rank-one.button-name"), $this->config->getNested("rank-one.image-type"), $this->config->getNested("rank-one.image-url"));
		$form->addButton($this->config->getNested("rank-two.button-name"), $this->config->getNested("rank-two.image-type"), $this->config->getNested("rank-two.image-url"));
		$form->addButton($this->config->getNested("rank-three.button-name"), $this->config->getNested("rank-three.image-type"), $this->config->getNested("rank-three.image-url"));
		$form->addButton($this->config->getNested("rank-four.button-name"), $this->config->getNested("rank-four.image-type"), $this->config->getNested("rank-four.image-url"));
		$form->sendToPlayer($sender);
	}
	
	public function rankSatu(Player $sender){
		$form = new SimpleForm(function (Player $sender, $data){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
				$this->RankList($sender);
				break;
			}
		});
		$form->setTitle($this->config->getNested("rank-one.title-form"));
		$form->setContent(file_get_contents($this->getDataFolder() . "rank/one.txt"));
		$form->addButton($this->config->getNested("back.button-name"), $this->config->getNested("back.image-type"), $this->config->getNested("back.image-url"));
		$form->sendToPlayer($sender);
	}
	
	public function rankDua(Player $sender){
		$form = new SimpleForm(function (Player $sender, $data){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
				$this->RankList($sender);
				break;
			}
		});
		$form->setTitle($this->config->getNested("rank-two.title-form"));
		$form->setContent(file_get_contents($this->getDataFolder() . "rank/two.txt"));
		$form->addButton($this->config->getNested("back.button-name"), $this->config->getNested("back.image-type"), $this->config->getNested("back.image-url"));
		$form->sendToPlayer($sender);
	}
	
	public function rankTiga(Player $sender){
		$form = new SimpleForm(function (Player $sender, $data){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
				$this->RankList($sender);
				break;
			}
		});
		$form->setTitle($this->config->getNested("rank-three.title-form"));
		$form->setContent(file_get_contents($this->getDataFolder() . "rank/three.txt"));
		$form->addButton($this->config->getNested("back.button-name"), $this->config->getNested("back.image-type"), $this->config->getNested("back.image-url"));
		$form->sendToPlayer($sender);
	}
	
	public function rankEmpat(Player $sender){
		$form = new SimpleForm(function (Player $sender, $data){
			$result = $data;
			if($result === null){
				return true;
			}
			switch($result){
				case 0:
				$this->RankList($sender);
				break;
			}
		});
		$form->setTitle($this->config->getNested("rank-four.title-form"));
		$form->setContent(file_get_contents($this->getDataFolder() . "rank/four.txt"));
		$form->addButton($this->config->getNested("back.button-name"), $this->config->getNested("back.image-type"), $this->config->getNested("back.image-url"));
		$form->sendToPlayer($sender);
	}
	
	
	
}