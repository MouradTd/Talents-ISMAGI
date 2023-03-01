<?php
include 'Connect.php';

$sql = mysqli_query($con, "SELECT user_level FROM `users` WHERE id = '" . $_SESSION['id_user'] . "' ");
if (mysqli_num_rows($sql) > 0) {
    foreach ($sql as $res) {
        $userlevel = $res['user_level'];
    }


    if ($userlevel === "1") {
?>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item active ">
                    <a href="home.php" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Acceuil</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="BrowseTalents.php" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Browse Talents</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="OrdersEtudiant.php" class='sidebar-link'>
                        <i class="bi bi-file-earmark-medical-fill"></i>
                        <span>Orders Etudiants</span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Talents</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="Talents.php">Talents</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="AddTalent.php">Add Talents</a>
                        </li>

                    </ul>
                </li>
                <li class="sidebar-item ">
                    <a href="Chat.html" class='sidebar-link'>
                        <i class="bi bi-pentagon-fill"></i>
                        <span>chat</span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Tools</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="#">Notes</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="AddTalent.php">text editor</a>
                        </li>

                    </ul>
                </li>
                

            </ul>
        </div>

    <?php
    } else {
    ?>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item active ">
                    <a href="home.php" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Acceuil</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="BrowseTalents.php" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Browse Talents</span>
                    </a>
                </li>
                <li class="sidebar-item  ">
                    <a href="CustomTalent.php" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Custom Talent</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="OrdersClient.php" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Orders Client</span>
                    </a>
                </li>


                <li class="sidebar-item ">
                    <a href="Chat.html" class='sidebar-link'>
                        <i class="bi bi-pentagon-fill"></i>
                        <span>chat</span>
                    </a>
                </li>

                

            </ul>
        </div>
<?php
    }
}
?>