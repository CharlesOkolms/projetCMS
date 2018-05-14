<?php
/**
 * Created with PhpStorm.
 * User: CharlesOkolms
 * Date: 16/04/2018
 * Time: 11:54
 */

class Gallery {

	protected $id;
	protected $title = '';
	protected $description = '';
	protected $creator;

	protected $created = '';
	protected $updated = NULL;
	protected $lastUpdator = NULL;
	protected $deleted = NULL; // n'est pas censé etre rempli, on charge pas une donnée supprimée

	/**
	 * gallery constructor.
	 *
	 * @param int $id id facultatif de la galerie à charger. Si id est null, aucune galerie n'est chargée.
	 */
	public function __construct(int $id=-1) {
		if ( !empty($id) & $id != -1 ) {
			$this->setId((int)$id);
			$this->load();
		}
	}

	/**
	 * @return bool
	 */
	private function load() : bool {
		if ( empty($this->getId()) ) {
			return false;
		}

		$sql    = 'SELECT
					id_gallery, title, description, id_user_creator AS creator, created, last_updated, id_user_updator AS lastupdator
				FROM
					gallery
				WHERE
					id_user_creator = :user_id AND deleted IS NULL';
		$values = array('user_id' => $this->getId());
		$result = DB::getInstance()->query($sql, $values, false);

		$this->set($result); // modifie cet objet à l'aide de l'objet récupéré en BDD

		return true;
	}


	/**
	 * Enregistre la galerie dans la base de données
	 *
	 * @return  TRUE en cas de succès, sinon le résultat de PDO::errorInfo() en trois champs :
	 *               0 => SQLSTATE ,    1 => ErrorCode ,    2 => Message
	 */
	public function insertIntoDatabase() {

		if ( !empty($this->getId()) ) {
			return ['message' => "id_gallery déjà existant"];
		}

		$sql = 'INSERT INTO gallery(id_gallery, title, description, id_user_creator)
			VALUES(:id,:title,:description,:creator)';

		$values = array(
			'id'          => 'DEFAULT',
			'title'       => $this->getTitle(),
			'description' => $this->getDescription()
		);

		$req = DB::getInstance()->action($sql, $values); // return lastInsertId() ou errorInfo()

		if ( is_string($req) ) { // on a recuperé l'id
			$this->setId((int)$req);
			return true;
		}

		return $req; // PDO::errorInfo()
	}


	/**
	 * Met à jour la galerie en base de donées avec les données inscrites dans l'objet courant.
	 *
	 * @param int $user_id
	 * @return     TRUE en cas de succès, sinon un tableau contenant 'SQLSTATE', 'errorCode', 'errorMessage'.
	 */
	public function updateDatabase(int $user_id) {

		$sql = 'UPDATE gallery SET title = :title, description = :description, id_user_updator = :updator
				WHERE id_gallery = :id';

		$values = array(
			'id'          => $this->getId(),
			'title'       => $this->getTitle(),
			'updator'     => $user_id,
			'description' => $this->getDescription()
		);

		$req = DB::getInstance()->action($sql, $values);

		if ( $req === 1 ) {
			$this->setUpdated(new DateTime());
			$this->setLastUpdator($user_id);
			return true;
		}
		// alors c'est une erreur MySQL
		$error = ['SQLSTATE'     => $req[0],
				  'errorCode'    => $req[1],
				  'errorMessage' => $req[2]];
		return $error;

	}


	/***********************************************************************/
	/******************************* SETTERS *******************************/
	/***********************************************************************/

	/**
	 * @param array $array associatif contenant les données de l'objet ('propriete' => 'valeur', ...)
	 */
	private function set(array $array) {
		foreach ( $array as $prop => $value ) {
			switch ($prop) {
				case 'id_gallery':
					$property = 'Id';
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


	public function getId() 		: int 		{return (int)$this->id;}
	public function getTitle()		: string 	{return $this->title;}
	public function getDescription(): string 	{return $this->description;}
	public function getCreator() 	: int 		{return $this->creator;}
	public function getCreated() 	: string 	{return $this->created;}
	public function getUpdated() 	: string 	{return $this->updated;}
	public function getLastUpdator(): int 		{return $this->lastUpdator;}
	public function getDeleted()				{return $this->deleted;}



	/***********************************************************************/
	/******************************* GETTERS *******************************/
	/***********************************************************************/

	private function setId($id) 				 	{$this->id = $id;}
	public function setTitle(string $title)  		{$this->title = $title;}
	public function setDescription(string $desc)    {$this->description = $desc;}
	private function setCreator($creator) 	 		{$this->creator = $creator;}
	private function setCreated(string $created)    {$this->created = $created;}
	private function setUpdated($updated) 	 		{$this->updated = $updated;}
	private function setLastUpdator($lastUpdator)   {$this->lastUpdator = $lastUpdator;}
	private function setDeleted($deleted) 	 		{$this->deleted = $deleted;}



}
