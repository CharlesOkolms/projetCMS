<?php

class DB {
	private static $instance;
	private $db;

	/**
	 * @var string Définit le format dans lequel les dates+heures (type DateTime) sont obtenues de la base de données
	 */
	const DATETIME_FORMAT = 'Y-m-d H:i:s';

	/**
	 * @var string Définit le format dans lequel les dates (type Date) sont obtenues de la base de données
	 */
	const DATE_FORMAT = 'Y-m-d';

	/**
	 * DB constructor.
	 */
	private function __construct() {
		try {
			$this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PWD);
		}
		catch (Exception $e) {
			echo 'Erreur connexion DB : ' . $e->getMessage() . '<br />';
			echo 'N° : ' . $e->getCode();
		}
	}

	/**
	 * DB destructor.
	 */
	public function __destruct() {
		self::$instance = null;
	}

	/**
	 * Singleton (une seule et unique instance PDO pour tout le script)
	 *
	 * @return DB : L'instance de la classe DB. (on ne peut instancier qu'une seule fois cette classe)
	 */
	static function getInstance() {
		if ( is_null(self::$instance) ) {
			self::$instance = new DB;
		}
		return self::$instance;
	}


	/**
	 * @var bool Sert à indiquer si l'on souhaite utiliser un fetchAll() sur le résultat de la requete. C'est la valeur
	 *      par défaut du paramètre $fetchAll de DB::query().
	 */
	const FETCH_ALL = true;
	/**
	 * @var bool Sert à indiquer que l'on souhaite utiliser un fetch() sur le résultat de la requête : cela a pour
	 *      conséquence de ne récupérer que la 1ère ligne de résultat.
	 */
	const FETCH_ONE = false;

	/**
	 * Permet de préparer et executer une requete SQL de type SELECT et d'en récupérer directement le résultat sous
	 * forme de tableau associatif. Exemple d'appel : $usersList = DB::getInstance()->query('Select * from user where
	 * id > :id', array(':id'=>12), DB::FETCH_ALL);
	 *
	 * @param string $sql      : Requête SQL (uniquement SELECT) à executer, avec des points d'interrogation "?" ou des
	 *                         variables nommées ":nomvariable" si besoin de variable dans la requête.
	 * @param array  $values   : Contient les valeurs à attribuer aux inconnues de la requête SQL. En cas d'utilisation
	 *                         des "?", le tableau contient simplement les valeurs sans index particulier. En cas
	 *                         d'utilisation de variables nommées comme par exemple ":foo" il faut utiliser un tableau
	 *                         associatif. Exemple : array('foo'=>'bar').
	 * @param bool   $fetchAll : Choix de la fonction fetch à utiliser. DB::FETCH_ALL (valeur par défaut) indique que
	 *                         l'on récupère plusieurs lignes de résultats, DB::FETCH_ONE indique que l'on récupère une
	 *                         seule ligne (la 1ère).
	 * @return array
	 */
	public function query(string $sql, array $values, bool $fetchAll = DB::FETCH_ALL) : array {
		$pdostatement = $this->getDb()->prepare($sql, $values);
		$pdostatement->execute($values);
		$result = ($fetchAll == DB::FETCH_ALL) ? $pdostatement->fetchAll(PDO::FETCH_ASSOC) : $pdostatement->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	/**
	 * Permet de préparer et executer une requete SQL de manipulation de données et, en cas d'erreur, d'en récupérer
	 * les informations.
	 *
	 * @param string $sql    : Requête SQL (autre que SELECT) à executer, avec des points d'interrogation "?" ou des
	 *                       variables nommées ":nomvariable" si besoin de variable dans la requête.
	 * @param array  $values : Contient les valeurs à attribuer aux inconnues de la requête SQL. En cas d'utilisation
	 *                       des "?", le tableau contient simplement les valeurs sans index particulier.
	 * @return mixed         : Retourne les informations de l'erreur dans le cas où une erreur survient, le dernier id
	 *                       inséré pour un INSERT ou le nombre de lignes affectées pour un UPDATE ou encore FALSE si
	 *                       la requete n'est ni un INSERT ni un UPDATE.
	 */
	public function action(string $sql, array $values) : mixed {
		$sql  = trim($sql);
		$type = strtoupper(substr($sql, 0, 6));

		switch ($type) {
			case 'INSERT':
			case 'UPDATE':
			break;
			default: // si ce n'est ni un update ni un insert on annule l'action et on retourne false
				return false;
			break;
		}

		$pdostatement = $this->getDb()->prepare($sql, $values);
		$executed     = $pdostatement->execute($values);

		if ( !$executed ) {
			return $this->getDb()->errorInfo(); // si execute renvoie false, on retourne les erreurs MySQL
		}

		switch ($type) {
			case 'INSERT':
				return DB::getInstance()->lastInsertId(); // si c'était un INSERT, on retourne le dernier id inséré
			break;
			case 'UPDATE':
				return $pdostatement->rowCount(); // si c'était un UPDATE, on retourne le nombre de lignes affectées
			break;
			default:
				return true;
			break;
		}
	}

	/**
	 * @return bool TRUE en cas de succès, FALSE sinon.
	 */
	public function beginTransaction() : bool {
		return $this->getDb()->beginTransaction();
	}

	/**
	 * @return bool TRUE en cas de succès, FALSE sinon.
	 */
	public function commit() : bool {
		return $this->getDb()->commit();
	}

	/**
	 * @return bool TRUE en cas de succès, FALSE sinon.
	 */
	public function rollback() : bool {
		return $this->getDb()->rollback();
	}

	/**
	 * @return PDO : L'objet de connexion PDO
	 */
	public function getDb() {
		return $this->db;
	}

	/**
	 * Retourne le dernier id que l'on a inséré en base de données par le biais de cette connexion.
	 *
	 * @return string : Le dernier id enregistré dans la base de données par cette connexion PDO.
	 */
	public function lastInsertId() : string {
		return $this->getDb()->lastInsertId();
	}
}
