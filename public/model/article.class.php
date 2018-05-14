<?php

/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 18/04/2018
 * Time: 09:24
 */


class article{
    protected $id;
    protected $title        = ''    ;
    protected $content      = ''    ;
    protected $headerphoto  = ''    ;
	protected $attachment   = '';

	protected $writer       = '';

	protected $written      = false;
	protected $published    = NULL;
    protected $deleted      = null  ;
    protected $premium      = false ;


    /**
     * article constructor.
     * @param int $id : id en base de données de l'article
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
     *  Charge les informations de l'article depuis la BDD vers l'objet Arcticle courant.
     *
     * @return bool : Retourne TRUE en cas de succès, FALSE si aucun id n'est indiqué dans l'objet.
     */
    private function load() : bool {
        if ( empty($this->getId()) ) {
            return false;
        }

        $sql = 'SELECT	id_article,
                        title,
                        content,
                        headerphoto,
                        attachment,
                        written,
                        published,
                        deleted,
                        premium
		        FROM    article
				WHERE   id_article = :article_id';

        $values = array('article_id' => $this->getId());
        $result = DB::getInstance()->query($sql, $values, false);

        $this->set($result); // modifie cet objet à l'aide de l'objet récupéré en BDD

        return true;
    }


    /**
    * Enregistre l'article dans la base de données
    *
    * @return TRUE en cas de succès, sinon le résultat de PDO::errorInfo() en trois champs :
    *               0 => SQLSTATE ,    1 => ErrorCode ,    2 => Message
    */
    public function insertIntoDatabase() {

        if ( !empty($this->getId()) ) {
            return ['message' => "id_article déjà existant"];
        }

		$sql = 'INSERT INTO article (
                                     title
                                    , content
                                    , headerphoto
                                    , attachment
                                    , premium
                                    , written
                                    , published
                                    , id_user_writer
                                    )
			    VALUES              (
			                           :title
			                        , :content
			                        , :headerphoto
			                        , :attachment
			                        , :premium
			                        , :written
			                        , :published
			                        , :writer
			                        );';


		$headerphoto = (!empty($this->getHeaderPhoto()))?$this->getHeaderphoto():null;
		$attachment = (!empty($this->getAttachment()))?$this->getAttachment():null;
		$premium = ($this->isPremium())?true:false;
		$written = (!empty($this->getWritten()))?$this->getWritten():null;
		$published = (!empty($this->getPublished()))?$this->getPublished():null;

		$values = array(
			'title'         => $this->getTitle(),
			'content'       => $this->getContent(),
			'headerphoto'   => $headerphoto,
			'attachment'    => $attachment,
			'premium'       => $premium,
			'written'       => $written,
			'published'     => $published,
            'writer'        => $this->getWriter()
		);

        $req = DB::getInstance()->action($sql, $values); // return lastInsertId() ou errorInfo()

        if ( is_string($req) ) { // on a recuperé l'id
            $this->setId((int)$req);
            return true;
        }
        return $req; // PDO::errorInfo()
    }


    /**
    * Met à jour l'article en base de donées avec les données inscrites dans l'objet courant.
    *
    * @return    TRUE en cas de succès, sinon un tableau contenant 'SQLSTATE', 'errorCode', 'errorMessage'.
    */
    public function updateDatabase() {

        $sql = 'UPDATE    article
				SET       title         = :title
				        , content       = :content
				        , headerphoto   = :headerphoto
				        , attachment    = :attachment
				        , premium       = :premium
				        , written       = :written
				        , published     = :published
				        , deleted       = :deleted
				WHERE     id_article    = :id';


        $values = array(
            'id'            => $this->getId(),
            'title'         => $this->getTitle(),
            'content'       => $this->getContent(),
            'headerphoto'   => $this->getHeaderPhoto(),
            'premium'       => $this->isPremium(),
            'written'       => $this->getWritten(),
            'published'     => $this->getPublished(),
            'deleted'       => $this->getDeleted()
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
     * Setter global de Article : A modifier pour utiliser les setters individuels
     *
     * @param array $array : Tableau associatif correspondant aux propriétés de Article avec les valeurs associées à set.
     */
    private function set(array $array) {
        foreach ( $array as $prop => $value ) {
            switch ($prop) {
                case 'id_article':
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




    private function setId          (int $id)                { $this->id = $id;                   }
    public  function setTitle       (string $title)          { $this->title = $title;             }
    public  function setContent     (string $content)        { $this->content = $content;         }
    public  function setHeaderphoto ($headerphoto)    { $this->headerphoto = $headerphoto; }
    public  function setAttachment  ($attachment)     { $this->attachment = $attachment;   }
    public  function setPremium     (bool $premium)   { $this->premium = $premium;         }
    public function setWriter       (int $writer)     { $this->writer = intval($writer);   }

    public function setWritten      (string $written, $format = DB::DATETIME_FORMAT) : bool {
        if ( !validateDate($written, $format) ) {
            return false;
        }
        else {
            $written = DateTime::createFromFormat($format, $written);
            $written = $written->format(DB::DATETIME_FORMAT);
        }
        $this->written = $written;
        return true;
    }


    public function setPublished      ($published, $format = DB::DATETIME_FORMAT) : bool {
        if ( !validateDate($published, $format) ) {
            return false;
        }
        else {
            $published = DateTime::createFromFormat($format, $published);
            $published = $published->format(DB::DATETIME_FORMAT);
        }
        $this->published = $published;
        return true;
    }


    public function setDeleted      ($deleted, $format = DB::DATETIME_FORMAT) : bool {
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





    /*********************/
    /****** GETTERS ******/
    /*********************/

    public function getId()                     { return $this->id; }
    public function getTitle()      : string    { return $this->title; }
    public function getContent()    : string    { return $this->content; }
    public function getAttachment() : string    { return $this->attachment; }
    public function getHeaderphoto(): string    { return $this->headerphoto; }
    public function getWriter()     : int       { return $this->writer; }
    public function isWritten()     : bool      { return $this->written; }
    public function getWritten()    : string    { return $this->written; }
    public function getPublished()              { return $this->published; }
    public function getDeleted()                { return $this->deleted; }
    public function isPremium()     : bool      { return $this->premium; }

}

?>
