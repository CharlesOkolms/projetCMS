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

	protected $writer;
	protected $publisher;
	protected $deleter;

	protected $written      = false;
	protected $published    = NULL;
    protected $deleted      = null  ;
    protected $premium      = false ;

    protected $page;


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
    public function load() : bool {
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
        $result = DB::getInstance()->query($sql, $values, DB::FETCH_ONE);

		$this->set($result); // modifie cet objet à l'aide de l'objet récupéré en BDD


		$sql    = 'SELECT id_page FROM page_article WHERE id_article = :id';
		$values = array(
			'id' => $this->getId()
		);
		if(!empty($req)){
			$req    = DB::getInstance()->query($sql, $values, DB::FETCH_ONE);
			$this->setPage($req['id_page']);
			return true;
		}
		return false;
    }


    /**
    * Enregistre l'article dans la base de données
    *
    * @return mixed TRUE en cas de succès, sinon le résultat de PDO::errorInfo() en trois champs :
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
    * @return  mixed  TRUE en cas de succès, sinon un tableau contenant 'SQLSTATE', 'errorCode', 'errorMessage'.
    */
    public function updateDatabase() {

		$sql = 'UPDATE    article
				SET       title         = :title
				        , content       = :content
				        , headerphoto   = :headerphoto
				        , attachment    = :attachment
				        , premium       = :premium
				        , published     = :published
				        , id_user_publisher = :publisher
				        , deleted       = :deleted
				        , id_user_deleter = :deleter
				WHERE     id_article    = :id';


		$values = array(
			'id'          => $this->getId(),
			'title'       => $this->getTitle(),
			'content'     => $this->getContent(),
			'headerphoto' => $this->getHeaderPhoto(),
			'attachment'  => $this->getAttachment(),
			'premium'     => $this->isPremium(),
			'published'   => $this->getPublished(),
			'publisher'   => $this->getPublisher(),
			'deleted'     => $this->getDeleted(),
			'deleter'     => $this->getDeleter()
		);

        $req = DB::getInstance()->action($sql, $values);


		if ( $req !== 1 ) {
			// alors c'est une erreur MySQL
			$error = ['SQLSTATE'     => $req[0],
					  'errorCode'    => $req[1],
					  'errorMessage' => $req[2]];
			return $error;
		}

		$sql = 'INSERT INTO page_article VALUES (:id, :id_page)';

		$values = array(
			'id'      => $this->getId(),
			'id_page' => $this->getPage()
		);

		$req = DB::getInstance()->action($sql, $values);


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
	public function setPublisher	($publisher) : void {$this->publisher = $publisher;}
	public function setDeleter		($deleter) : void	{$this->deleter = $deleter;}
	public function setPage			(int $page) 		{$this->page = $page;}
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
		$deleted = DateTime::createFromFormat($format, $deleted);
		$deleted = $deleted->format(DB::DATETIME_FORMAT);
        $this->deleted = $deleted;
        return true;
    }




    /*********************/
    /****** GETTERS ******/
    /*********************/

    public function getId()                     { return $this->id; }
    public function getTitle()      : string    { return $this->title; }
    public function getContent()    : string    { return $this->content; }
    public function getAttachment()			    { return $this->attachment; }
    public function getHeaderphoto()		    { return $this->headerphoto; }
    public function getWriter()     : int       { return $this->writer; }
	public function getPublisher() 				{ return $this->publisher;}
	public function getDeleter() 				{ return $this->deleter;}
    public function isWritten()     : bool      { return $this->written; }
    public function getWritten()    : string    { return $this->written; }
    public function getPublished()              { return $this->published; }
    public function getDeleted()                { return $this->deleted; }
    public function isPremium()     : bool      { return $this->premium; }
	public function getPage() 					{ return $this->page; }


	/** Renvoie en array la liste des articles sous forme de tableaux associatifs : id_article, title, premium, written, id_user_writer AS writer, published, id_user_publisher AS publisher
	 *
	 * @param bool $page			id de la page contenant les articles à retourner. False par défaut.
	 * @param bool $with_content	booléen définissant si on retourne également le contenu complet des articles ou non. False par défaut.
	 * @return array
	 */
	public static function getAll($page = false, $with_content = false) {
		$val       = [];
		$suppquery = ';';
		$contenu   = '';
		$clause    = ' WHERE article.deleted IS NULL '; // pour les concatenations
		if ( $with_content ) {
			$contenu = ', content, headerphoto, attachment ';
		}
		if ( $page ) {
			$suppquery = " INNER JOIN page_article pa ON pa.id_article = article.id_article AND pa.id_page = :page";
//			$clause    .= ' AND pa.id_page = :page ';
			$val       = ['page' => $page];
		}
		$query = 'SELECT article.id_article, title, premium, written, id_user_writer AS writer, published, id_user_publisher AS publisher '.$contenu.', deleted, id_user_deleter as deleter
        										FROM article '.$suppquery.$clause.' ;';
		$liste = DB::getInstance()->query($query, $val, DB::FETCH_ALL);
		return $liste;
	}

}
