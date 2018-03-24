<?php

class User {

	protected $id;
	protected $nickname = '';
	protected $password = '';
	protected $firstname = '';
	protected $lastname = '';
	protected $email = '';

	protected $created = '';
	protected $updated = '';
	protected $deleted = '';

	protected $writer = false;
	protected $publisher = false;
	protected $admin = false;


	/**
	 * User constructor.
	 *
	 * @param int $id : id en base de données de l'utilisateur
	 */
	public function __construct(int $id = -1) {
		if ( !empty($id) & $id != -1 ) {
			$this->setId((int)$id);
			$this->load();
		}
	}

	/**
	 * @return bool : Retourne TRUE en cas de succès, FALSE sinon.
	 */
	private function load() : bool {
		if ( empty($this->getId()) ) {
			return false;
		}

		$sql = 'SELECT
					id,	nickname, firstname, lastname, email, created, updated, deleted
				FROM
					user
				WHERE
					id = :user_id';

		$values = array('user_id' => $this->getId());
		$result = DB::getInstance()->query($sql, $values, false);

		$this->set($result); // modifie cet objet à l'aide de l'objet récupéré en BDD


		return true;
	}


	public function insertIntoDatabase() {
		$sql = 'INSERT INTO user (id, lastname, firstname, password, nickname, email, writer, publisher, admin)
			VALUES(:id, :lastname, :firstname, :password, :nickname, :email, :writer, :publisher, :admin);';

		$values = array(
			'id'        => 'DEFAULT',
			'lastname'  => $this->lastname,
			'firstname' => $this->firstname,
			'password'  => $this->password,
			'nickname'  => $this->nickname,
			'email'     => $this->email,
			'writer'    => $this->writer,
			'publisher' => $this->publisher,
			'admin'     => $this->admin,
		);

		$req = DB::getInstance()->action($sql, $values);

		return $req; // TRUE ou PDO::errorInfo()
	}

	/**
	 * Met à jour l'utilisateur en base de donées avec les données inscrites dans l'objet
	 *
	 * @return bool
	 */
	public function updateDatabase() : bool {
		// à faire, bien sûr
		return false;
	}


	/**
	 * Fonction permettant de connecter un utilisateur. Si la connexion est possible, charge les données dans l'objet
	 * courant.
	 *
	 * @param string $nickname	Pseudonyme de l'utilisateur.
	 * @param string $password	Mot de passe (secret) de l'utilisateur.
	 * @return bool|string		TRUE si la connexion a réussi, un message d'erreur sinon.
	 */
	public function login(string $nickname, string $password) : mixed {
		$sql    = 'SELECT id, nickname, password FROM user WHERE LOWER(nickname) = LOWER(:nickname);';
		$values = ['nickname' => $nickname];
		$user   = DB::getInstance()->query($sql, $values, DB::FETCH_ONE);

		if ( password_verify($password, $user['password']) ) {
			$this->id = $user['id'];
			$this->load();
			return true;
		}
		else {
			return 'identifiants invalides';
		}
	}




	/*********************/
	/****** SETTERS ******/
	/*********************/

	/**
	 * Setter global de User : A modifier pour utiliser les setters individuels
	 *
	 * @param array $array : Tableau associatif correspondant aux propriétés de User avec les valeurs associées à set.
	 */
	private function set(array $array) {
		foreach ( $array as $prop => $value ) {
			$this->$prop = $value;
		}
	}

	private function setId(int $id) : void {$this->id = $id;}

	public function setNickname(string $nickname) 	: void 	{$this->nickname 	= $nickname;}
	public function setPassword(string $password) 	: void 	{$this->password 	= $password;}
	public function setFirstname(string $firstname) : void 	{$this->firstname 	= $firstname;}
	public function setLastname(string $lastname) 	: void 	{$this->lastname 	= $lastname;}
	public function setEmail(string $email) 		: void 	{$this->email 		= $email;}
	public function setCreated(string $created) 	: void 	{$this->created 	= $created;}
	public function setUpdated(string $updated) 	: void 	{$this->updated 	= $updated;}
	public function setDeleted(string $deleted) 	: void 	{$this->deleted 	= $deleted;}
	public function setWriter(bool $writer) 		: void 	{$this->writer 		= $writer;}
	public function setPublisher(bool $publisher) 	: void 	{$this->publisher 	= $publisher;}
	public function setAdmin(bool $admin) 			: void 	{$this->admin 		= $admin;}


	/*********************/
	/****** GETTERS ******/
	/*********************/
	public function getId() {return $this->id;}
	public function getNickname() : string 	{return $this->nickname;}
	public function getPassword() : string 	{return $this->password;}
	public function getFirstname() : string {return $this->firstname;}
	public function getLastname() : string 	{return $this->lastname;}
	public function getEmail() 	 : string 	{return $this->email;}
	public function getCreated() : string 	{return $this->created;}
	public function getUpdated() : string 	{return $this->updated;}
	public function getDeleted() : string 	{return $this->deleted;}
	public function isWriter()	 : bool 	{return $this->writer;}
	public function isPublisher(): bool 	{return $this->publisher;}
	public function isAdmin() 	 : bool 	{return $this->admin;}

}
