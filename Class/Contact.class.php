<?php



class Contact
{


    #*** attributes ****#

    private $id;
    private $name;
    private $city;
    private $phone;



    /**
     * Contructor
     * 
     */
    public function __construct($name = NULL, $city = NULL, $phone = NULL, $id = NULL)
    {

        if ($name) $this->set_name($name);
        if ($city) $this->set_city($city);
        if ($phone) $this->set_phone($phone);
        if ($id) $this->set_id($id);
    }



    #****************Getter and Setter ***********#

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($value)
    {

        $this->id = cleanString($value);
    }

    public function get_name()
    {
        return $this->name;
    }

    public function set_name($value)
    {

        $this->name = cleanString($value);
    }


    public function get_city()
    {
        return $this->city;
    }

    public function set_city($value)
    {

        $this->city = cleanString($value);
    }

    public function get_phone()
    {
        return $this->phone;
    }

    public function set_phone($value)
    {

        $this->phone = cleanString($value);
    }



    #********* Methods logic *****************#


    public static function fetchAllfromDb(PDO $pdo)
    {

        $sql = "SELECT * FROM contacts ORDER BY id DESC";

        $params = NULL;

        $statement = $pdo->prepare($sql);
        $statement->execute($params);

        $contactsArray = NULL;

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $contactsArray[] = new Contact(

                $row['name'],
                $row['city'],
                $row['phone'],
                $row['id']

            );
        }

        return $contactsArray;
    }


    /**
     * Save contact to Db
     * @param $pdo
     * 
     */

    public function saveToDb(PDO $pdo)
    {

        $sql = "INSERT INTO contacts( name, city, phone,id)  
                VALUES(?,?,?,?)";

        $params = [
            $this->get_name(),
            $this->get_city(),
            $this->get_phone(),
            $this->get_id()
        ];

        $statement = $pdo->prepare($sql);
        $statement->execute($params);

        $rowCount = $statement->rowCount();

        if (!$rowCount) {
            return false;
        } else {
            $newContactId = $pdo->lastInsertId();
            $this->set_id($newContactId);

            return true;
        }
    }

    /**
     * Sort by Name 
     */
    public static function sortByName(PDO $pdo)
    {
        $sql = "SELECT * FROM contacts ORDER BY name ASC";
        $params = NULL;
        $statement = $pdo->prepare($sql);
        $statement->execute($params);

        $nameArray = NULL;

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $nameArray[] = new Contact(
                $row['name'],
                $row['city'],
                $row['phone'],
                $row['id']
            );
        }

        return $nameArray;
    }


    /**
     * Sort by City
     */
    public static function sortByCity(PDO $pdo)
    {
        $sql = "SELECT * FROM contacts ORDER BY city ASC";
        $params = NULL;

        $statement = $pdo->prepare($sql);
        $statement->execute($params);

        $cityArray = NULL;

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $cityArray[] = new Contact(
                $row['name'],
                $row['city'],
                $row['phone'],
                $row['id']
            );
        }

        return $cityArray;
    }


    /**
     * Search by phome number
     */
    public  function searchPhoneNumber(PDO $pdo)
    {
        $sql = "SELECT * FROM contacts WHERE phone LIKE concat('%', ?, '%') ";

        $params = [$this->get_phone()];

        $statement = $pdo->prepare($sql);
        $statement->execute($params);

        $phoneArray = NULL;

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $phoneArray[] = new Contact(
                $row['name'],
                $row['city'],
                $row['phone'],
                $row['id']


            );
        }

        return $phoneArray;
    }

    /**
     * Fetch One row feom db 
     */
    public function fetchFromDb(PDO $pdo)
    {
        $sql = "SELECT * FROM contacts WHERE id = ?";
        $params = [$this->get_id()];
        $statement = $pdo->prepare($sql);
        $statement->execute($params);

        if (!$row = $statement->fetch(PDO::FETCH_ASSOC)) {
            return false;
        } else {
            $this->set_name($row['name']);
            $this->set_city($row['city']);
            $this->set_phone($row['phone']);

            return true;
        }
    }

    /**
     * Update data from db
     */
    public function updateToDb(PDO $pdo)
    {
        $sql = "UPDATE contacts 
                SET 
                name = ?,
                city = ?,
                phone = ?
                WHERE id = ?";

        $params = [
            $this->get_name(),
            $this->get_city(),
            $this->get_phone(),
            $this->get_id()
        ];

        $statement = $pdo->prepare($sql);
        $statement->execute($params);

        $rowCount = $statement->rowCount();

        return $rowCount;
    }

    public function deleteFromDb(PDO $pdo, $id)
    {

        $sql = "DELETE FROM contacts WHERE id = ?";
        $params = [$id];

        $statement = $pdo->prepare($sql);
        $statement->execute($params);
        $rowCount = $statement->rowCount();

        return $rowCount;
    }
}
