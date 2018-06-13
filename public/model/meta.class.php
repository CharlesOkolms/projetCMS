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
	private function setId($id) : void {$this->id = $id;}
	public function getTitle() {return $this->title;}
	public function setTitle($title) : void {$this->title = $title;}
	public function getLogo() : string {return $this->logo;}
	public function setLogo(string $logo) : void {$this->logo = $logo;}
	public function getHomepage() : int {return $this->homepage;}
	public function setHomepage(int $homepage) : void {$this->homepage = $homepage;}
	public function getSuperadmin() {return $this->superadmin;}
	public function setSuperadmin($superadmin) : void {$this->superadmin = $superadmin;}




}
