<?php

/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 20/04/2018
 * Time: 10:06
 */

class Style{
	protected $id;
	protected $name;


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

        $sql = 'SELECT	  id_style
                        , name
		        FROM      style
				WHERE     id_style = :style_id';

        $values = array('style_id' => $this->getId());
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

        $sql = 'INSERT INTO style (name)
			    VALUES  (:name );';

        $values = array ( 'name' => $this->getName());

        $req = DB::getInstance()->action($sql, $values); // return lastInsertId() ou errorInfo()
        if ( is_string($req) ) { // on a recuperé l'id
            $this->setId((int)$req);
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

        $sql = 'UPDATE    style
				SET       name         = :name
				WHERE     id_style     = :id';


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
                case 'id_style':
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





	/*********************/
    /****** GETTERS ******/
    /*********************/

    public  function getId()                { return $this->id; }
    public  function getName(): string     { return $this->name; }


	/** Liste des styles en forme de array associatif
	 * @return array
	 */
	public static function getAll(){
		$liste = DB::getInstance()->query('select * from style', [], DB::FETCH_ALL);
		return $liste;
	}

}

?>
