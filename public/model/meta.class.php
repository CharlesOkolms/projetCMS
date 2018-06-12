<?php



class Meta{

	protected $title;
	protected $logo = "sitelogo.png"; // nom du fichier
	protected $superadmin;
	protected $homepage = 1;

	public function __construct(){

	}



	public function getTitle() {return $this->title;}
	public function setTitle($title) : void {$this->title = $title;}
	public function getLogo() : string {return $this->logo;}
	public function setLogo(string $logo) : void {$this->logo = $logo;}
	public function getHomepage() : int {return $this->homepage;}
	public function setHomepage(int $homepage) : void {$this->homepage = $homepage;}
	public function getSuperadmin() {return $this->superadmin;}
	public function setSuperadmin($superadmin) : void {$this->superadmin = $superadmin;}




}
