<?php
$id = $_POST['id'];
include "lib/connection.php";
$query = mysqli_query($con, "SELECT * FROM `booking`  WHERE `#`='" . $id . "'");
$info = mysqli_fetch_all($query, MYSQLI_ASSOC);
/*?>
<pre>
    <?php
    print_r($info);
    ?>

</pre>
<?php*/
echo "<h2 style=\"color: blue\">" . $info[0]['Faculty'] . ", " . $info[0]['PrepName'] . ", " . $info[0]['Aim'] . "</h2>";

