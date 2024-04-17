<?php

class Database {
    //Properties
    private $connection, $sqlExec; 
    protected $lastErrMsg, $selectedRows;

    //Constructor Method 
    public function __construct(){
        $this->connectToDBMS();
        $this->connectToDB('kidsGames');
    }

    //Method for customized Messages
    public function messages()
    {
        //Error messages 
        $m['conDBMS'] = "Connection to MySQL failed!";
        $m['creatEntity'] = "Creation of the DB, Table, or View failed!";
        $m['conDB'] = "Connection to the DB failed!";
        $m['insertTAB'] = "Data insertion to the Table failed!";
        $m['selectTAB'] = "Data selection from the Table failed!";
        $m['descTAB'] = "Table structure description failed!";
        $m['updateCOL']= "Table Column Update failed!";
        //Try again messages
        $l['tryAgain'] = "<a href=\"index.php\"><input type=\"submit\" value=\"Try again!\"></a>";
        //Group messages by category 
        $msg['error'] = $m;
        $msg['link'] = $l;
        return $msg;
    }
    
    //Method for DBMS Connection 
    public function connectToDBMS()
    {
        //Attempt to connect to MySQL using MySQLi
        $con = new mysqli(HOST, USER, PASS);
        //If connection to the MySQL failed save the system error message 
        if ($con->connect_error) {
            $this->lastErrMsg = mysqli_connect_error();
            return FALSE;
        } else {
            $this->connection = $con;
            return TRUE;
        }
    }

    //Method for DB Connection 
    public function connectToDB($dbname)
{
    // Attempt to connect to MySQL using MySQLi
    if (!$this->connection) {
        $this->lastErrMsg = "MySQL connection is not established.";
        return FALSE;
    }
    
    // Attempt to check if the database exists
    $result = mysqli_query($this->connection, "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");
    
    if (!$result) {
        // Error checking if the database exists
        $this->lastErrMsg = "Error checking database existence: " . mysqli_error($this->connection);
        return FALSE;
    }

    if (mysqli_num_rows($result) == 0) {
        // Database doesn't exist, create it using the SQL file
        $createDBSQL = "-- @ abc123 Game 
        -- database entity and dummy data
        -- author : Patrick Saint-Louis 
        -- date : 2023
        
        -- 1.Create the Database | Créer la Base de données
        CREATE DATABASE IF NOT EXISTS kidsGames; 
        
        -- 2.Access the Database | Accéder à la Base de données
        USE kidsGames;
        
        -- 3.Create the Tables and Views | Créer les Tables et Vues
        CREATE TABLE IF NOT EXISTS player( 
            fName VARCHAR(50) NOT NULL, 
            lName VARCHAR(50) NOT NULL, 
            userName VARCHAR(20) NOT NULL UNIQUE,
            registrationTime DATETIME NOT NULL,
            id VARCHAR(200) GENERATED ALWAYS AS (CONCAT(UPPER(LEFT(fName,2)),UPPER(LEFT(lName,2)),UPPER(LEFT(userName,3)),CAST(registrationTime AS SIGNED))),
            registrationOrder INTEGER AUTO_INCREMENT,
            PRIMARY KEY (registrationOrder)
        )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 
        
        CREATE TABLE IF NOT EXISTS authenticator(   
            passCode VARCHAR(255) NOT NULL,
            registrationOrder INTEGER, 
            FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
        )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 
        
        CREATE TABLE IF NOT EXISTS score( 
            scoreTime DATETIME NOT NULL, 
            result ENUM('réussite', 'échec', 'incomplet'),
            livesUsed INTEGER NOT NULL,
            registrationOrder INTEGER, 
            FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
        )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; 
        
        CREATE VIEW history AS
        SELECT s.scoreTime, p.id, p.fName, p.lName, s.result, s.livesUsed 
        FROM player p, score s
        WHERE p.registrationOrder = s.registrationOrder;
        
        -- 4.Insert dummy data to the Tables | Insérer des données de test dans les Tables 
        
        -- 4.1.Table player 
        INSERT INTO player(fName, lName, userName, registrationTime)
        VALUES('Patrick','Saint-Louis', 'sonic12345', now()); 
        
        INSERT INTO player(fName, lName, userName, registrationTime)
        VALUES('Marie','Jourdain', 'asterix2023', now());
        
        INSERT INTO player(fName, lName, userName, registrationTime)
        VALUES('Jonathan','David', 'pokemon527', now()); 
         
        -- 4.2.Table authenticator
        -- \$passCode=password_hash('hellomontreal', PASSWORD_DEFAULT);
        INSERT INTO authenticator(passCode, registrationOrder)
        VALUES('$2y$10\$AMyb4cbGSWSvEcQxt91ZVu5r5OV7/3mMZl7tn8wnZrJ1ddidYfVYW', 1);
        
        -- \$passCode=password_hash('helloquebec', PASSWORD_DEFAULT);
        INSERT INTO authenticator(passCode, registrationOrder)
        VALUES('$2y$10\$Lpd3JsgFW9.x2ft6Qo9h..xmtm82lmSuv/vaQKs9xPJ4rhKlMJAF.', 2);
        
        -- \$passCode=password_hash('hellocanada', PASSWORD_DEFAULT);
        INSERT INTO authenticator(passCode, registrationOrder)
        VALUES('$2y$10\$FRAyAIK6.TYEEmbOHF4JfeiBCdWFHcqRTILM7nF/7CPjE3dNEWj3W', 3);
        
        -- 4.3.Table score
        INSERT INTO score(scoreTime, result , livesUsed, registrationOrder)
        VALUES(now(), 'réussite', 4, 1);
        
        INSERT INTO score(scoreTime, result , livesUsed, registrationOrder)
        VALUES(now(), 'échec', 6, 2);
        
        INSERT INTO score(scoreTime, result , livesUsed, registrationOrder)
        VALUES(now(), 'incomplet', 5, 3);";
        if ($this->executeMultiQuery($createDBSQL)) {
            return TRUE; // Database created successfully
        } else {
            $this->lastErrMsg = "Error creating database '$dbname'";
            return FALSE;
        }
    }

    // Database exists, attempt to select it
    if (!mysqli_select_db($this->connection, $dbname)) {
        $this->lastErrMsg = "Error selecting database '$dbname': " . mysqli_error($this->connection);
        return FALSE;
    } else {
        return TRUE;
    }
}



    //Method for multiple SQL Query Execution 
    public function executeMultiQuery($sqlcode)
    {
        //Attempt to execute the query
        $invokeQuery = ($this->connection)->multi_query($sqlcode);
        //If query execution failed save the system error message  
        if ($invokeQuery === FALSE) {
            $this->lastErrMsg = ($this->connection)->error;
            return FALSE;
        } else {
            $this->sqlExec = $invokeQuery;
            return TRUE;
        }
    }   

    //Method for one SQL Query Execution 
    public function executeOneQuery($sqlcode)
    {
        //Attempt to execute the query
        $invokeQuery = ($this->connection)->query($sqlcode);
        //If query execution failed save the system error message  
        if ($invokeQuery === FALSE) {
            $this->lastErrMsg = ($this->connection)->error;
            return FALSE;
        } else {
            $this->sqlExec = $invokeQuery;
            return TRUE;
        }
    } 

    public function getConnection() {
        return $this->connection;
    }

    //Method for Selected Data Recording
    public function saveSelectedData(){
        //Calculate the number of rows available
        $number_of_rows = ($this->sqlExec)->num_rows;
        if ($number_of_rows==0){
            $this->selectedRows=NULL;
        } else {
            //Use a loop to display the rows one by one
            $data=array();
            for ($i = 1; $i <= $number_of_rows; ++$i) {
                //Assign the records of each row to an associative array
                $each_row = $this->sqlExec->fetch_array(MYSQLI_ASSOC);
                //Display each the record corresponding to each column
                //Save all the records to a multidimensional associative array
                foreach ($each_row as $section => $item)
                    $data["row$i"]["$section"]=$item;    
            } 
            $this->selectedRows=$data;  
        }
    }

     //Destructor Method
     public function __destruct()
     {
         //Close automatically the DBMS connection           
         if (($this->connection)->connect_error !== NULL)
             $this->connection->close();
     }
}