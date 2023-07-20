<!-- header -->
<header>
        <!--Menu Responsive-->
        <div class="menu_toggle">
            <span></span>
        </div>
        <!--Menu-->
        <div class="mini-logo">
           <img class=img-logo1 src="image/logo-header.png"></a>
        </div>
        <ul class="menu">
            <li><a href="index.php">Acceuil</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="sale.php">Achats/Ventes</a></li>
            <li><a href="#contact">Contact</a></li>
            <?php
            session_start();
            // Vérifiez si l'administrateur est connecté
            if (isset($_SESSION['admin']) && $_SESSION['admin'] === true){
                echo '<li><a href="admin.php">Admin</a></li>';
            }
            ?>
            <?php
            session_start();
            // Vérifiez si un worker est connecté
            if (isset($_SESSION['worker']) && $_SESSION['worker'] === true){
                echo '<li><a href="workers.php">Avis</a></li>';
            }
            ?>
        </ul>
        <div class=boutons-header>
            <a href="form-works.html">
                <?php
                    session_start();
                    // Vérifiez si l'administrateur est connecté
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] === true){
                        echo '<button class="login_btn"><a href="login/form-works.html" class="deco-worker">INSCRIRE</a></button">';
                    }
                    // Verifie si un enployé est connecter
                    if (isset($_SESSION['worker']) && $_SESSION['worker'] === true) {
                        echo '<button class="login_btn"><a href="login/logout.php">SE DÉCONNECTER</a></button">';
                    }
                ?>
            </a>
            <a href="login/form.php">
                <button>SE CONNECTER</button>
            </a>
        </div>
    </header>