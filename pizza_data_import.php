<?php
$import_attempted = false;
$import_succeeded = false;
$import_error_message = “”;

if($_SERVER[“REQUEST_METHOD”] == “POST”){
    $import_attempted = true;
    $connection = @mysqli_connect(“localhost”, “pizza user”, “pizzapizza”, “pizza_db”);

    if(mysqli_connect_errno()){
        $import_error_message = “Failed to connect to MySQL: ”. mysqli_connect_error();
    }
    else{
        try{
            $contents = file_get_contents($_FILES[“importFile”][“temp_name”]);
            $lines = explode(separator: “\n”, $contents);

            foreach($lines as line){
                $parsed_csv_line = str_getcsv($line);
                //TODO: Do something with the parsed data . Look at the array (skip the first line).
                //UPDATE if a record (key) is already in a database, else INSERT the record into the correct database.
                //For full credit, track how many rows were inserted and updated in each entity, and print them out. 
            }
            $import_succeeded = true;
        }
        catch(Error $exception){
            $import_error_message = $exception->getMessage() . “ at “ . $exception->getFile() . “ (line “ . $exception->getLine() . “)  <br/>”

        }
    }
}
?>

<?php include_once("header.php")?>

    <h1>Pizza Data Import</h1>

    <?php
        if($import_attempted){
        if($import_succeeded){ 
    ?>
    <h1><span class="text-success">Import Succeeded!</span></h1>

    <?php}

    else{?>
        <h1><span sclass="text-danger">Import Failed!</span></h1>
        <span class="text-danger"><?php  echo $import_error_message; ?> span>

    <?php}
    }?>
        <form method = “post” enctype = “multipart/form-data”>
        <div class="input-group mb-3">
           <span class="input-group-text"> File: </span>
           <input class="form-control" type = “file” name = “importFile” />
        </div>
            <input class="btn btn-primary" type = “submit” value = "Upload Data" /> 
        </form>
        
<?php include_once("footer.php")?>

