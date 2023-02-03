<html>                        <!-- Start HTML --> 
<head>                        <!-- Start HTML-Kopf --> 
 
<!-- CSS-Formatierung für die Tabelle --> 
<style type="text/css">                    
     table { 
          background-color: #E2E9F6; 
          border-collapse: collapse; 
          border: none; 
     }  
 
     thead { 
          background-color:  #4D79C7; 
          color: #FFFFFF; 
     } 
      
     td, th { 
          text-align: left;  
          padding: 0.5em 1em; 
     } 
</style>                      <!-- Ende CSS-Style --> 
</head>                       <!-- Ende HTML-Kopf --> 
<body>                        <!-- Start HTML-Body -->  
<?php                         //Start PHP 
 
//Parameter holen und ausgeben  
$bnr = $_GET["bnr"]; 
echo "<h1>iBrot-Bestellung</h1>"; 
echo "<h2>Bestellnummer: $bnr </h2>"; 
?>
<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:str-ibrot-dbsrv.database.windows.net,1433; Database = ibrot", "str", "AzUrE2o23@BKR");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "str", "pwd" => "AzUrE2o23@BKR", "Database" => "ibrot", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:str-ibrot-dbsrv.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>

<?php
/* Set up and execute the query. */  
$tsql = "SELECT ArtikelID, Position, Menge FROM Bestellposition where BestellungID =" + $bnr;  
$stmt = sqlsrv_query( $conn, $tsql);  
if( $stmt === false)  
{  
     echo "Error in query preparation/execution.\n";  
     die( print_r( sqlsrv_errors(), true));  
}  
?>
 
/* Daten in einem assoziativen Array definieren*/ 
/*$daten = array ( 
    array("Position"=>1,"ArtikelID"=>"Brötchen","Menge"=>5), 
    array("Position"=>2,"ArtikelID"=>"Croissant","Menge"=>3), 
    array("Position"=>3,"ArtikelID"=>"Brot","Menge"=>1) 
  );*/ 
 
/* Überschriften im Tabellen-Head ausgeben */ 
echo "<table>"; 
echo "<thead>";  
echo "<tr>"; 
echo "<th>Position</th>"; 
echo "<th>Artikel-ID</th>"; 
echo "<th>Menge</th>"; 
echo "</tr>"; 
echo "</thead>";  
 
/* Datensätze im Tabellen-Body ausgeben */ 
echo "<tbody>";  

<?php
/* Retrieve each row as an associative array and display the results.*/  
while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))  
{  
     echo "<tr>"; 
     echo "<td>".$row['Position']."</td>"; 
     echo "<td>".$row['ArtikelID']."</td>"; 
     echo "<td>".$row['Menge']."</td>"; 
     echo "</tr>";
     //echo $row['LastName'].", ".$row['FirstName']."\n";  
}  
  
/* Free statement and connection resources. */  
sqlsrv_free_stmt( $stmt);  
sqlsrv_close( $conn);  
?>  

/*foreach ($daten as $row) { 
    echo "<tr>"; 
    echo "<td>".$row['Position']."</td>"; 
    echo "<td>".$row['ArtikelID']."</td>"; 
    echo "<td>".$row['Menge']."</td>"; 
    echo "</tr>";   
} */
echo "</table>"; 
echo "<tbody>";  
   
//?>                       <!-- Ende PHP--> 
</body>                  <!-- Ende HTML-Body--> 
</html>                  <!-- Ende HTML--> 
