<?php

/**
 * Created by PhpStorm.
 * User: Thomas
 * Date: 20/04/2018
 * Time: 09:37
 */

class tag{
    protected $id;
    protected $label        = ''    ;


    /**
     * tag constructor.
     * @param int $id : id en base de données du tag
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
     *  Charge les informations du tag depuis la BDD vers l'objet Tag courant.
     *
     * @return bool : Retourne TRUE en cas de succès, FALSE si aucun id n'est indiqué dans l'objet.
     */
    private function load() : bool {
        if ( empty($this->getId()) ) {
            return false;
        }

        $sql = 'SELECT	  id_tag
                        , label
		        FROM      tag
				WHERE     id_tag = :tag_id';

        $values = array('tag_id' => $this->getId());
        $result = DB::getInstance()->query($sql, $values, false);

        $this->set($result); // modifie cet objet à l'aide de l'objet récupéré en BDD

        return true;
    }


    /**
     * Enregistre le tag dans la base de données
     *
     * @return TRUE en cas de succès, sinon le résultat de PDO::errorInfo() en trois champs :
     *               0 => SQLSTATE ,    1 => ErrorCode ,    2 => Message
     */
    public function insertIntoDatabase() {

        if ( !empty($this->getId()) ) {
            return ['message' => "id_tag déjà existant"];
        }

        $sql = 'INSERT INTO tag 
                                    (
                                      id_tag
                                    , label
                                    )
                                    
			    VALUES              (
			                          :id
			                        , :label
			                        );';


        $values = array (
          'id'            => 'DEFAULT'
        , 'label'         => $this->label
        );

        $req = DB::getInstance()->action($sql, $values); // return lastInsertId() ou errorInfo()

        if ( is_string($req) ) { // on a recuperé l'id
            $this->setId((int)$req);
            return true;
        }

        return $req; // PDO::errorInfo()
    }


    /**
     * Met à jour le tag en base de donées avec les données inscrites dans l'objet courant.
     *
     * @return     TRUE en cas de succès, sinon un tableau contenant 'SQLSTATE', 'errorCode', 'errorMessage'.
     */
    public function updateDatabase() {

        $sql = 'UPDATE    tag
				SET       label         = :label
				WHERE     id_tag        = :id';


        $values = array(
            'id'            => $this->getId(),
            'label'         => $this->getLabel(),
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
     * Setter global de Tag : A modifier pour utiliser les setters individuels
     *
     * @param array $array : Tableau associatif correspondant aux propriétés de Tag avec les valeurs associées à set.
     */
    private function set(array $array) {
        foreach ( $array as $prop => $value ) {
            switch ($prop) {
                case 'id_tag':
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


    private function setId          (int $id)                 { $this->id = $id;                   }
    public  function setLabel       (string $label)           { $this->label = $label;             }






    /*********************/
    /****** GETTERS ******/
    /*********************/

    public function getId()                     { return $this->id; }
    public function getLabel()      : string    { return $this->label; }


}

?>