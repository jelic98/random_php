<?php
	class Main {	
		private $map = [];
	
		private function fetch($row) {
			$e = new Entry($row['id'], $row['name']);
			$parent = $row['parent'];

			if(is_null($parent)) {
		 		$this->map[] = $e;
			}else {
				$this->getParent($parent, $this->map)->addChild($e);
			}
		}

		private function getParent($id, $map) {
			foreach($map as $e) {
				if($e->getId() == $id) {
					return $e;
				}else {
					$parent = $this->getParent($id, $e->getChilds());

					if(!is_null($parent)) {
						return $parent;		
					}
				}
			}
		}

		private function output($map, $lvl = 0) {
			$s = '';
			$sep = '<br/>';	
			
			for($i = 0; $i < $lvl; $i++) {
				$sep .= '.....';
			}

			foreach($map as $e) {	
				$s .= $sep . $e->getName() . ' ' . $this->output($e->getChilds(), $lvl + 1);
			}

			return $s;
		}

		public function start() {
			$connect = mysqli_connect('localhost', 'root', 'root'); 
			mysqli_select_db($connect, 'category');  

			$cmd = 'SELECT * FROM categories;';
			$result = mysqli_query($connect, $cmd);

			while($row = mysqli_fetch_array($result)) {
				$this->fetch($row);
			}

			mysqli_close($connect);
	
			echo $this->output($this->map);
		}		
	}

	class Entry {	
		private $id = null;
		private $name = null;
		private $childs = [];

		public function __construct($id, $name) {
			$this->id = $id;
			$this->name = $name;
		}
	
		public function addChild(Entry $e) {
			$this->childs[] = $e;
		}

		public function getId() {
			return $this->id;	
		}

		public function getName() {
			return $this->name;
		}
		
		public function getChilds() {
			return $this->childs;
		}
	}

	$program = new Main();
	$program->start();
?>
