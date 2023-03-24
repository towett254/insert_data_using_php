<?php
try{
   
        $host = 'localhost'; // $this->db->hostname;
    $dbname = 'alone_test'; // $this->db->database;
    $user = 'root'; // $this->db->username;
    $password = ''; //= $this->db->password;
    $pdo = new PDO(
        "mysql:host=" . $host . ";dbname=" . $dbname,
        $user,
        $password
    );


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
 
$tableName = 'test_table';

try{
    // Prepare an insert statement
    $sql = "INSERT INTO ".$tableName." (field_1, field_2) VALUES (:field_1, :field_2)";
    $stmt = $pdo->prepare($sql);
   
    // Bind parameters to statement
    $stmt->bindParam(':field_1', $field_1, PDO::PARAM_STR);
    $stmt->bindParam(':field_2', $field_2, PDO::PARAM_STR);
   
    /* Set the parameters values and execute
    the statement again to insert another row */
    $field_1 = "Rest";
    $field_2 = "Doe";

    $stmt->execute();
   
   $response = [
"status"=>"200",
"description"=>"Records inserted successfully."
   ];
   
   echo json_encode($response);
    
} catch(PDOException $e){
    $err = $sql.' '. $e->getMessage();

    $response = [
"status"=>"400",
"description"=>$err
   ];
   
   echo json_encode($response);
    

}
 
// Close statement
unset($stmt);
 
// Close connection
unset($pdo);
?>