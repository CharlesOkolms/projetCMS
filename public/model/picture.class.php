<?php
/**
 * Created with PhpStorm.
 * User: Thomas
 * Date: 20/04/2018
 * Time: 15:22
 */

class Picture {

	protected $id;
	protected $title = null;
	protected $description = null;
	protected $extension = null;
	protected $uploaded;
	protected $uploader;
	protected $idGallery;




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
				        	id_picture
				          , title
				          , description
				          , uploaded
				          , id_user_uploader  AS uploador
				FROM
					picture
				WHERE
					id_picture = :picture_id';
        $values = array('picture_id' => $this->getId());
        $result = DB::getInstance()->query($sql, $values, false);

        $this->set($result); // modifie cet objet à l'aide de l'objet récupéré en BDD

        return true;
    }


    /**
     * Enregistre la picture dans la base de données
     *
     * @return mixed TRUE en cas de succès, sinon le résultat de PDO::errorInfo() en trois champs :
     *               0 => SQLSTATE ,    1 => ErrorCode ,    2 => Message
     */
    public function insertIntoDatabase() {

        if ( !empty($this->getId()) ) {
            return ['message' => "id_gallery déjà existant"];
        }

		$sql = 'INSERT INTO picture
                                      (
                                        id_picture
                                      , title
                                      , description
                                      , extension
                                      , uploaded
                                      , id_user_uploader
                                      )
			    VALUES
			                          (
			                            :id
			                          , :title
			                          , :description
			                          , :ext
			                          , :uploaded
			                          , :uploader
			                          )';

		$values = array(
            'id'          => 'DEFAULT',
            'title'       => $this->getTitle(),
            'description' => $this->getDescription(),
            'extension' => $this->getExtension(),
            'uploaded'    => $this->getUploaded(),
            'uploader'    => $this->getUploader()
        );

        $req = DB::getInstance()->action($sql, $values); // return lastInsertId() ou errorInfo()

        if ( is_string($req) ) { // on a recuperé l'id
            $this->setId((int)$req);
            return true;
        }

        return $req; // PDO::errorInfo()
    }


    /**
     * Met à jour la picture en base de donées avec les données inscrites dans l'objet courant.
     *
     * @return  mixed   TRUE en cas de succès, sinon un tableau contenant 'SQLSTATE', 'errorCode', 'errorMessage'.
     */
    public function updateDatabase() {

        $sql = 'UPDATE  picture
                SET     title              = :title
                      , description       = :description
                      , uploaded          = :uploaded
                      , id_user_uploader  = :uploader
				WHERE   id_picture = :id';

        $values = array(
            'id'          => $this->getId(),
            'title'       => $this->getTitle(),
			'uploaded' => $this->getUploaded(),
			'uploader' => $this->getUploader()
		);

		$req = DB::getInstance()->action($sql, $values);

		if ( $req === 1 ) {
            $this->setUploaded(new DateTime());
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
                case 'id_picture':
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


	private function setId			(int $id) 				{ $this->id = $id; }
	public function setTitle		(string $title) 		{ $this->title = $title; }
	public function setDescription	(string $description) 	{ $this->description = $description; }
	public function setExtension	(string $extension) 	{ $this->extension = strval($extension); }

	public function setUploaded(string $uploaded, $format = DB::DATETIME_FORMAT) : bool {
		if ( !validateDate($uploaded, $format) ) {
			return false;
		}
        else {
            $uploaded = DateTime::createFromFormat($format, $uploaded);
            $uploaded = $uploaded->format(DB::DATETIME_FORMAT);
        }
        $this->uploaded = $uploaded;
        return true;
    }

    public function setUploader     (string $uploader, $format = DB::DATETIME_FORMAT) : bool {
        if ( !validateDate($uploader, $format) ) {
            return false;
        }
        else {
            $uploader = DateTime::createFromFormat($format, $uploader);
            $uploader = $uploader->format(DB::DATETIME_FORMAT);
        }
        $this->uploader = $uploader;
        return true;
    }


    /***********************************************************************/
    /******************************* GETTERS *******************************/
    /***********************************************************************/


    public function getId           ()          { return $this->id;				}
    public function getTitle		(): string  { return $this->title;			}
    public function getDescription  (): string  { return $this->description;	}
    public function getUploaded     ()          { return $this->uploaded;		}
    public function getUploader     ()          { return $this->uploader;		}
    public function getIdGallery    ()          { return $this->idGallery;		}
	public function getExtension	() :string  { return $this->extension;		}

	/** Obtiens la liste des images de la galerie.
	 * @return array
	 */
    public static function getAll() : array {
		$liste = DB::getInstance()->query('select id_picture as id, picture.* from picture WHERE deleted IS NULL ;', [], DB::FETCH_ALL);
		return $liste;
	}




}
