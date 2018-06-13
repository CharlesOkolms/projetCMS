<?php

/**
 * Created by PhpStorm.
 * User: CharlesOkolms
 * Date: 02/06/2018
 * Time: 14:15
 */

class Template{
	protected $id ;
	protected $name = '';
	protected $creator; // id du createur


	/**
	 * style constructor.
	 * @param int $id : id en base de données du style
	 */
	public function __construct(int $id = -1)
	{
		if( !empty ($id) & $id != -1)
		{
			$this->setId((int)$id);
			$this->load();
		}
	}


	/**
	 *  Charge les informations du style depuis la BDD vers l'objet Style courant.
	 *
	 * @return bool : Retourne TRUE en cas de succès, FALSE si aucun id n'est indiqué dans l'objet.
	 */
	private function load() : bool {
		if ( empty($this->getId()) ) {
			return false;
		}

		$sql = 'SELECT	  id_template
                        , name, id_user_creator as creator
		        FROM      template
				WHERE     id_template = :id';

		$values = array('id' => $this->getId());
		$result = DB::getInstance()->query($sql, $values, false);

		$this->set($result); // modifie cet objet à l'aide de l'objet récupéré en BDD

		return true;
	}


	/**
	 * Enregistre le style dans la base de données
	 *
	 * @return mixed TRUE en cas de succès, sinon le résultat de PDO::errorInfo() en trois champs :
	 *               0 => SQLSTATE ,    1 => ErrorCode ,    2 => Message
	 */
	public function insertIntoDatabase() {

		$sql = 'INSERT INTO template (name, id_user_creator)
			    VALUES  (:name, :user );';

		$values = array ( 'name' => $this->getName(), 'user' => CURRENT_USER_ID);

		$req = DB::getInstance()->action($sql, $values); // return lastInsertId() ou errorInfo()

		if ( is_string($req) ) { // on a recuperé l'id
			$this->setId(intval($req));
			return true;
		}

		return $req; // PDO::errorInfo()
	}


	/**
	 * Met à jour le style en base de donées avec les données inscrites dans l'objet courant.
	 *
	 * @return   mixed  TRUE en cas de succès, sinon un tableau contenant 'SQLSTATE', 'errorCode', 'errorMessage'.
	 */
	public function updateDatabase() {

		$sql = 'UPDATE    template
				SET       name         = :name
				WHERE     id_template     = :id';


		$values = array(
			'id'            => $this->getId(),
			'name'          => $this->getName(),
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




	/*********************/
	/****** SETTERS ******/
	/*********************/

	/**
	 * Setter global de Style : A modifier pour utiliser les setters individuels
	 *
	 * @param array $array : Tableau associatif correspondant aux propriétés de Style avec les valeurs associées à set.
	 */
	private function set(array $array) {
		foreach ( $array as $prop => $value ) {
			switch ($prop) {
				case 'id_template':
					$property = 'Id';
				break;
				default:
					$property = ucfirst($prop);
				break;
			}
			$this->{'set' . $property}($value);
		}
	}



	public function setId       (int $id)          { $this->id = $id;        }
	public function setName    (string $name)    { $this->name = $name;  }

	public function getCreator() : int {return $this->creator;}

	public function setCreator(string $creator) {$this->creator = $creator;}




	/*********************/
	/****** GETTERS ******/
	/*********************/

	private function getId()                { return $this->id; }
	public  function getName(): string     { return $this->name; }


	/** Liste des templates en forme de array associatif
	 * @return array
	 */
	public static function getAll(){
		$liste = DB::getInstance()->query('select * from template', [], DB::FETCH_ALL);
		return $liste;
	}

}

?>
