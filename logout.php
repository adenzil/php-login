<?php
session_start();
unset($_SESSION["user_id"]);
unset($_SESSION["user_name"]);
header("Location:index.php");
?>



<tr>
                    <td class="edit"><?php echo $row['id']?></td>
                    <td contenteditable='false' class="u"><?php echo $row['name']?></td>
                    <td class="edit"><button id="edit">EDIT USER</button></td>
                </tr>