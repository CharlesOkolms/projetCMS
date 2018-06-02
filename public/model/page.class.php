<?php
/**
 * Created with PhpStorm.
 * User: CharlesOkolms
 * Date: 02/06/2018
 * Time: 14:00
 */

class Page {

	protected $id;
	protected $title = '';
	protected $template = ''; // id template
	protected $style = ''; // id style
	protected $creator; // id user

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
					id_page, title, id_template as template, id_style as style, id_user_creator AS creator
				FROM
					page
				WHERE
					id_page = :page_id ';
		$values = array('page_id' => $this->getId());
		$result = DB::getInstance()->query($sql, $values, false);

		$this->set($result); // modifie cet objet à l'aide de l'objet récupéré en BDD

		return true;
	}


	/**
	 * Enregistre la galerie dans la base de données
	 *
	 * @return  mixed  TRUE en cas de succès, sinon le résultat de PDO::errorInfo() en trois champs :
	 *               0 => SQLSTATE ,    1 => ErrorCode ,    2 => Message
	 */
	public function insertIntoDatabase() {

		if ( !empty($this->getId()) ) {
			return ['message' => "id_page déjà existant"];
		}

		$sql = 'INSERT INTO page(id_page, title, id_template, id_style, id_user_creator)
			VALUES(:id,:title,:template,:style,:creator)';

		$values = array(
			'id'          => 'DEFAULT',
			'title'       => $this->getTitle(),
			'template' => $this->getTemplate(),
			'style' => $this->getStyle(),
			'creator' => $this->getCreator()
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
	 * @return   mixed  TRUE en cas de succès, sinon un tableau contenant 'SQLSTATE', 'errorCode', 'errorMessage'.
	 */
	public function updateDatabase(int $user_id) {
		$sql = 'UPDATE page SET title = :title, id_template = :template, id_style = :style
				WHERE id_page = :id';

		$values = array(
			'id'          => $this->getId(),
			'title'       => $this->getTitle(),
			'template' => $this->getTemplate(),
			'style' => $this->getStyle()
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


	/***********************************************************************/
	/******************************* SETTERS *******************************/
	/***********************************************************************/

	/**
	 * @param array $array associatif contenant les données de l'objet ('propriete' => 'valeur', ...)
	 */
	private function set(array $array) {
		foreach ( $array as $prop => $value ) {
			switch ($prop) {
				case 'id_page':
					$property = 'Id';
				break;
				case 'id_style':
					$property = 'Style';
				break;
				case 'id_template':
					$property = 'Template';
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
	public function getStyle()		: int 		{return $this->style;}
	public function getTemplate() 	: int 		{return $this->template;}
	public function getcreator() 	: int 		{return $this->creator;}



	/***********************************************************************/
	/******************************* GETTERS *******************************/
	/***********************************************************************/

	private function setId($id) 				 	{$this->id = $id;}
	public function setTitle(string $title)  		{$this->title = $title;}
	public function setStyle(int $style)    		{$this->style = $style;}
	public function setTemplate(int $template)		{$this->template = $template;}
	public function setCreator(int $creator)		{$this->creator = $creator;}



}
