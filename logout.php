
<?php
session_start();

if(isset($_SESSION['comemail']) && !empty($_SESSION['comemail']))
{
    unset($_SESSION['comemail']); ///deleting the session stored value
    session_destroy();
    
    ?>
        <script>location.assign('login.php')</script>
    <?php
}
else{
    ?>
        <script>location.assign('login.php')</script>
    <?php
}
?>