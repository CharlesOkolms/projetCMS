<?php



class Meta{

	protected $id;
	protected $title;
	protected $logo = "sitelogo.png"; // nom du fichier
	protected $superadmin;
	protected $homepage = 1;

	public function __construct(){
		$this->load();
	}

	private function load(){
		$sql = 'SELECT	*
		        FROM    meta';

		$values = [];
		$result = DB::getInstance()->query($sql, $values, DB::FETCH_ONE);

		$this->set($result); // modifie cet objet à l'aide de l'objet récupéré en BDD

		return true;
	}

	public function updateDatabase(){
		$sql = 'update meta set title = :title, id_superadmin = :user';
		$res = DB::getInstance()->query($sql, ['title'=>$this->getTitle(), 'user' => $this->getSuperadmin()]);

		return true;
	}

	private function set(array $array) {
		foreach ( $array as $prop => $value ) {
			switch ($prop) {
				case 'id_superadmin':
					$property = 'Superadmin';
				break;
				case 'id_homepage':
					$property = 'Homepage';
				break;
				default:
					$property = ucfirst($prop);
				break;
			}
			$this->{'set' . $property}($value);
		}
	}

	public function getId() {return $this->id;}
	public function setId($id)  {$this->id = $id;}
	public function getTitle() {return $this->title;}
	public function setTitle($title)  {$this->title = $title;}
	public function getLogo() : string {return $this->logo;}
	public function setLogo(string $logo)  {$this->logo = $logo;}
	public function getHomepage() : int {return $this->homepage;}
	public function setHomepage(int $homepage)  {$this->homepage = $homepage;}
	public function getSuperadmin() {return $this->superadmin;}
	public function setSuperadmin($superadmin)  {$this->superadmin = $superadmin;}




}
