<?php
$connection_error = false;
$connection_error_message = "";

$con = @mysqli_connect("localhost", "pizza-user", "pizzapizza", "pizza_db");

if(mysqli_connect_errno()){
    $connection_error = true;
    $connection_error_message = "Failed ot connect to MySQL: ". mysqli_connect_error();
}

function output_error($title, $error){
    echo "<span style='color: red;'>\n";
    echo "<h2>" . $title . "</h2>\n";
    echo "<h4>" . $error . "</h4>\n";
    echo "<span>";
}
?>

<?php include_once("header.php") ?>

        <h1>Pizza Data Report</h1>

        <?php
        if($connection_error){
            output_error("Database connection failure!", $connection_error_message);
        }
        else{
            function output_table_open(){
                echo "<table class = 'table table-striped'>\n";
                echo "<thead><tr class = 'pizzaDataHeaderRow'>\n";
                echo "  <td>Name</td>\n";
                echo "  <td>Age</td>\n";
                echo "  <td>Gender</td>\n";
                echo "</tr></thead>\n";
            }

            function output_table_close(){
                echo "</table>\n";
            }

            function output_person_row($name, $age, $gender){
                echo "<tr class = 'pizzaDataRow'>\n";
                echo "  <td>" . $name   . "</td>\n";
                echo "  <td>" . $age    . "</td>\n";
                echo "  <td>" . $gender . "</td>\n";
                echo "</tr>\n";
            }

            function output_person_detail_row($pizzas, $pizzerias){
                $pizzas_str = "None";
                if(sizeof($pizzas > 0)){
                    $pizzas_str = implode(", ", $pizzas);
                }

                $pizzerias_str = "None";
                if(sizeof($pizzerias > 0)){
                    $pizzerias_str = implode(", ", $pizzerias);
                }

                echo "<tr>\n"
                echo "  <td colspan='3' class = 'pizzaDataDetailsCell'>\n";
                echo "      Pizzas Eaten: " . $pizzas_str . "<br/>\n";
                echo "      Pizzerias Frequented: " . $pizzerias_str . "<br/>\n";
                echo "  </td>\n";
                echo "</tr>\n";
            }

            $query = " SELECT t0.name, t0.age, t0.gender, t1.pizza, t2.pizzeria"
                    ." FROM person t0"
                    ." LEFT OUTER JOIN Eats t1 ON t0.name = t1.name"
                    ." LEFT OUTER JOIN Frequents t2 ON t1.name = t2.name"
                    ." ORDER BY t0.name, t1.pizza, t2.pizzeria";
            $result = mysqli_query($con, $query);

            if(! $result){
                if(mysqli_errno($con)){
                    output_error("Data retrieval failure!", mysqli_error($con))
                }
                else{
                    echo "No pizza data found!";
                }
            }
            else{
                //Open table.
                output_table_open();

                $last_name = null;
                $pizzas = array();
                $pizzerias = array();

                while($row = $result->fetch_array()){
                    if($last_name != $row["name"]){

                        //Output person row.
                        output_person_row($prow["name"], $row["age"], $row["gender"]);

                        $pizzas = array();
                        $pizzerias = array();
                    }

                    if(! in_array($row["pizza"], $pizzas)){
                        $pizzas[] = $row["pizza"];
                    }
                        
                    if(! in_array($row["pizzeria"], $pizzerias)){
                        $pizzerias[] = $row["pizzeria"];
                    }

                    $last_name = $row["name"];
                }
                
                if($last_name != null){
                    //Output person detais row.
                    output_person_detail_row($pizzas, $pizzerias);
                }
                //Close table.
                output_table_close();
            }
        }

        ?>

<?php include_once("footer.php") ?>