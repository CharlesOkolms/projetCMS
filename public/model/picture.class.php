<?php
/**
 * Created with PhpStorm.
 * User: Thomas
 * Date: 20/04/2018
 * Time: 15:22
 */

class Picture {

    protected $id               ;
    protected $name         = '';
    protected $description  = '';
    protected $uploaded         ;
    protected $uploador         ;
    protected $idGallery        ;




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
				          , name
				          , description
				          , uploaded
				          , id_user_uploader  AS uploador
                          , id_gallery        AS idGallery
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
     * @return  TRUE en cas de succès, sinon le résultat de PDO::errorInfo() en trois champs :
     *               0 => SQLSTATE ,    1 => ErrorCode ,    2 => Message
     */
    public function insertIntoDatabase() {

        if ( !empty($this->getId()) ) {
            return ['message' => "id_gallery déjà existant"];
        }

        $sql = 'INSERT INTO picture
                                      (
                                        id_picture
                                      , name
                                      , description
                                      , uploaded
                                      , id_user_uploader
                                      , id_gallery
                                      )
			    VALUES
			                          (
			                            :id
			                          , :nameP
			                          , :description
			                          , :uploaded
			                          , :uploador
			                          , :gallery
			                          )';

        $values = array(
            'id'          => 'DEFAULT',
            'nameP'       => $this->getName(),
            'description' => $this->getDescription(),
            'uploaded'    => $this->getUploaded(),
            'uploador'    => $this->getUploador(),
            'gallery'     => $this->getGallery()
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
     * @param int $picture_id
     * @return     TRUE en cas de succès, sinon un tableau contenant 'SQLSTATE', 'errorCode', 'errorMessage'.
     */
    public function updateDatabase() {

        $sql = 'UPDATE  picture
                SET     name              = :nameP
                      , description       = :description
                      , uploaded          = :uploaded
                      , id_user_uploader  = :uploador
                      , id_gallery        = :gallery
				WHERE   id_picture = :id';

        $values = array(
            'id'          => $this->getId(),
            'nameP'       => $this->getName(),
            'uploaded'    => $this->getUploaded(),
            'uploador'    => $this->getUploador(),
            'gallery'     => $this->getGallery()
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



    public function setId           (int $id)                 { $this->id = $id;                      }
    public function setName         (string $name)            { $this->name = $name;                  }
    public function setDescription  (string $description)     { $this->description = $description;    }


    public function setUploaded     (string $uploaded, $format = DB::DATETIME_FORMAT) : bool {
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


    public function setUploador     (string $uploador, $format = DB::DATETIME_FORMAT) : bool {
        if ( !validateDate($uploador, $format) ) {
            return false;
        }
        else {
            $uploador = DateTime::createFromFormat($format, $uploador);
            $uploador = $uploador->format(DB::DATETIME_FORMAT);
        }
        $this->uploador = $uploador;
        return true;
    }



    public function setIdGallery     (string $idGallery, $format = DB::DATETIME_FORMAT) : bool {
        if ( !validateDate($idGallery, $format) ) {
            return false;
        }
        else {
            $idGallery = DateTime::createFromFormat($format, $idGallery);
            $idGallery = $idGallery->format(DB::DATETIME_FORMAT);
        }
        $this->idGallery = $idGallery;
        return true;

    }





    /***********************************************************************/
    /******************************* GETTERS *******************************/
    /***********************************************************************/


    public function getId           ()          { return $this->id;              }
    public function getName         (): string  { return $this->name;            }
    public function getDescription  (): string  { return $this->description;     }
    public function getUploaded     ()          { return $this->uploaded;        }
    public function getUploador     ()          { return $this->uploador;        }
    public function getIdGallery    ()          { return $this->idGallery;       }

}
