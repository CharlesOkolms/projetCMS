<?php

class User {

	protected $id;
	protected $nickname = '';
	protected $password;
	protected $firstname = '';
	protected $lastname = '';
	protected $email = '';

	protected $created = '';
	protected $updated = null;
	protected $updater = null; // id de l'utilisateur ayant modifié celui-ci
	protected $deleted = null;

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
	 * Charge les informations de l'utilisateur depuis la BDD vers l'objet User courant.
	 *
	 * @return bool : Retourne TRUE en cas de succès, FALSE si aucun id n'est indiqué dans l'objet.
	 */
	private function load() : bool {
		if ( empty($this->getId()) ) {
			return false;
		}

		$sql = 'SELECT
					id_user, nickname, firstname, lastname, email, created, last_updated, deleted, writer, publisher, admin
				FROM
					user
				WHERE
					id_user = :user_id';

		$values = array('user_id' => $this->getId());
		$result = DB::getInstance()->query($sql, $values, false);

		$this->set($result); // modifie cet objet à l'aide de l'objet récupéré en BDD


		return true;
	}

	/**
	 * Enregistre l'utilisateur dans la base de données
	 *
	 * @return mixed TRUE en cas de succès, sinon le résultat de PDO::errorInfo() en trois champs :
	 *               0 => SQLSTATE ,    1 => ErrorCode ,    2 => Message
	 */
	public function insertIntoDatabase() {

		if ( !empty($this->getId()) ) {
			return ['message' => "id_user déjà existant"];
		}

		$sql = 'INSERT INTO user ( lastname, firstname, password, nickname, email, writer, publisher, admin)
			VALUES( :lastname, :firstname, :password, :nickname, :email, :writer, :publisher, :admin);';

		$values = array(
			'lastname'  => $this->lastname,
			'firstname' => $this->firstname,
			'password'  => $this->password,
			'nickname'  => $this->nickname,
			'email'     => $this->email,
			'writer'    => $this->writer,
			'publisher' => $this->publisher,
			'admin'     => $this->admin
		);

		$req = DB::getInstance()->action($sql, $values); // return lastInsertId() ou errorInfo()

		if ( is_string($req) ) { // on a recuperé l'id
			$this->setId((int)$req);
			return true;
		}

		return $req; // PDO::errorInfo()
	}

	/**
	 * Met à jour l'utilisateur en base de donées avec les données inscrites dans l'objet courant.
	 *
	 * @return   mixed  TRUE en cas de succès, sinon un tableau contenant 'SQLSTATE', 'errorCode', 'errorMessage'.
	 */
	public function updateDatabase() {

		$sql = 'UPDATE user
				SET firstname = :first, lastname = :last, email = :email, writer = :w, publisher = :p, admin = :a
				WHERE id_user = :id AND nickname = :nick';

		$values = array(
			'id'    => $this->getId(),
			'nick'  => $this->getNickname(),
			'first' => $this->getFirstname(),
			'last'  => $this->getLastname(),
			'email' => $this->getEmail(),
			'w'     => $this->isWriter(),
			'p'     => $this->isPublisher(),
			'a'     => $this->isAdmin()
		);

		$req = DB::getInstance()->action($sql, $values);

		if ( $req === 1 ) {
			return true;
		}
		// alors c'est une erreur MySQL
		$error = ['SQLSTATE'     => $req[0],
				  'errorCode'    => $req[1],
				  'errorMessage' => $req[2]];
		return $error;

	}


    /**
     * Met à jour l'utilisateur en base de donées avec les données inscrites dans l'objet courant.
     *
     * @return   mixed  TRUE en cas de succès, sinon un tableau contenant 'SQLSTATE', 'errorCode', 'errorMessage'.
     */
    public function updateDatabasePerso() {

        $sql = 'UPDATE user
				SET nickname = :nick, firstname = :first, lastname = :last, email = :email, password = :pass
				WHERE id_user = :id';

        $values = array(
            'id'    => $this->getId(),
            'nick'  => $this->getNickname(),
            'first' => $this->getFirstname(),
            'last'  => $this->getLastname(),
            'email' => $this->getEmail(),
            'pass'  => $this->getPassword()
        );

        $req = DB::getInstance()->action($sql, $values);

        if ( $req === 1 ) {
            return true;
        }
        // alors c'est une erreur MySQL
        $error = ['SQLSTATE'     => $req[0],
            'errorCode'    => $req[1],
            'errorMessage' => $req[2]];
        return $error;

    }


	/**
	 * Fonction permettant de connecter un utilisateur. Si la connexion est possible, charge les données dans l'objet
	 * courant.
	 *
	 * @param string $email Email de l'utilisateur.
	 * @param string $password Mot de passe (secret) de l'utilisateur.
	 * @return bool|string        TRUE si la connexion a réussi, un message d'erreur sinon.
	 */
	public function login(string $email, string $password) {
		$sql    = 'SELECT id_user, email, password FROM user WHERE LOWER(email) = LOWER(:email);';
		$values = ['email' => $email];
		$user   = DB::getInstance()->query($sql, $values, DB::FETCH_ONE);

		if (!empty($user['password']) && password_verify($password, $user['password']) ) {
			$this->id = $user['id_user'];
			$this->load();
			return true;
		}
		else {
			return false;
		}
	}




	/***********************************************************************/
	/******************************* SETTERS *******************************/
	/***********************************************************************/

	/**
	 * Setter global de User : A modifier pour utiliser les setters individuels
	 *
	 * @param array $array : Tableau associatif correspondant aux propriétés de User avec les valeurs associées à set.
	 */
	private function set(array $array) {
		foreach ( $array as $prop => $value ) {
			switch ($prop) {
				case 'id_user':
					$property = 'Id';
				break;
				case 'id_user_updater':
					$property = 'Updater';
				break;
				case 'last_updated':
					$property = 'Updated';
				break;
				default:
					$property = ucfirst($prop);
				break;
			}
			$this->{'set' . $property}($value);
		}
	}

	private function setId(int $id) { $this->id = $id; }
	public function setNickname(string $nickname) { $this->nickname = $nickname; }
	public function setPassword(string $password) { $this->password = password_hash($password,PASSWORD_DEFAULT); }
	public function setFirstname(string $firstname) { $this->firstname = $firstname; }
	public function setLastname(string $lastname)  { $this->lastname = $lastname; }
	public function setEmail(string $email) { $this->email = $email; }

	public function setCreated(string $created, $format = DB::DATETIME_FORMAT) : bool {
		if ( !validateDate($created, $format) ) {
			return false;
		}
		else {
			$created = DateTime::createFromFormat($format, $created);
			$created = $created->format(DB::DATETIME_FORMAT);
		}
		$this->created = $created;
		return true;
	}

	private function setUpdated($updated = '', $format = DB::DATETIME_FORMAT) : bool {
		if ( !validateDate($updated, $format) ) {
			return false;
		}
		else {
			$updated = DateTime::createFromFormat($format, $updated);
			$updated = $updated->format(DB::DATETIME_FORMAT);
		}
		$this->updated = $updated;
		return true;
	}
	public function setUpdater($updater) { $this->updater = (int)$updater; }

	public function setDeleted($deleted='', $format = DB::DATETIME_FORMAT) : bool {
		if ( !validateDate($deleted, $format) ) {
			return false;
		}
		else {
			$deleted = DateTime::createFromFormat($format, $deleted);
			$deleted = $deleted->format(DB::DATETIME_FORMAT);
		}
		$this->deleted = $deleted;
		return true;
	}

	public function setWriter(bool $writer) 		 	{$this->writer 		= (bool)$writer;}
	public function setPublisher(bool $publisher) 	 	{$this->publisher 	= (bool)$publisher;}
	public function setAdmin(bool $admin) 			 	{$this->admin 		= (bool)$admin;}



	/***********************************************************************/
	/******************************* GETTERS *******************************/
	/***********************************************************************/

	public function getId()                 {return $this->id;}
	public function getNickname() : string 	{return $this->nickname;}
	public function getPassword() : string {return $this->password;}
	public function getFirstname(): string  {return $this->firstname;}
	public function getLastname() : string 	{return $this->lastname;}
	public function getEmail() 	 : string 	{return $this->email;}
	public function getCreated() : string 	{return $this->created;}
	public function getUpdated() : string 	{return $this->updated;}
	public function getDeleted() : string 	{return $this->deleted;}
	public function isWriter()	 : bool 	{return $this->writer;}
	public function isPublisher(): bool 	{return $this->publisher;}
	public function isAdmin() 	 : bool 	{return $this->admin;}

	public function isSuperAdmin() : bool {
		$query = 'SELECT id_superadmin FROM meta';
		$id_superadmin = DB::getInstance()->query($query,[],DB::FETCH_ONE)['id_superadmin'];
		if(intval($id_superadmin) == intval($this->getId())){
			return true;
		}
		return false;
	}

	/** Recherche et retourne la liste des utilisateurs sous forme de tableau d'objets User. On peut préciser un role pour chercher uniquement les auteurs, par exemple.
	 * @param string $right droit des utilisateurs recherchés : $right = 'writer' ou 'publisher' ou 'admin'
	 * @return array
	 */
	public static function getAll($right = '') : array {
		$clause = ' ;';
		if($right !== ''){
			$clause = ' WHERE '.strtolower($right).' = 1 ;';
		}
		$sql = 'SELECT 
						id_user,
						nickname,
						firstname,
						lastname,
						email,
						writer,
						publisher,
						admin,
						created,
						last_updated AS updated,
						id_user_updater AS updater
                FROM user '.$clause;

		$req = DB::getInstance()->query($sql, [], DB::FETCH_ALL);
		$users = [];
		foreach($req as $i => $ligne){
			$users[$ligne['id_user']] = new User();
			$users[$ligne['id_user']]->set($ligne);
		}

		return $users; // liste ou PDO::errorInfo()
	}


}
