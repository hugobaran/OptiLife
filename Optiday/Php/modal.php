<!------------------------------------------------------------------->
<!---------------------------Fenêtre aide---------------------------->
<!------------------------------------------------------------------->

<div class="windows" id="pop">
    <div class="win-container win-xl">
        <div data-bg="#3c85d0" class="win-header">
            <div class="win-close">X</div>
            <h1 data-color="white">Comment utiliser l'application ?</h1>
        </div>
        <div class="win-body">
            <h2>Vidéo</h2>
        </div>
    </div>
</div>

<!------------------------------------------------------------------->
<!----------------------Formulaire de connexion---------------------->
<!------------------------------------------------------------------->

<div class="windows" id="login">
    <div class="win-container win-m">
        <form action="Post/connexion_post.php" method="post">
            <div data-bg="#3c85d0" class="win-header">
                <div class="win-close">X</div>
                <h1 data-color="white">Connexion</h1>
            </div>
            <div data-intop="10" data-inbottom="10" class="win-body">
                <div data-outbottom="10" class="width-24">
                    <input type="text" id="mail_connexion" name="mail" placeholder="Email" onchange="connexion('mail_connexion')">
                </div>
                <div data-align="right" class="width-24">
                    <a href="#" id="mdp_forgot" class="forgot linkform" onclick="CloseWindowsOther('login');OpenWindows('password');">Mot de passe oublié ?</a>
                </div>
                <div class="width-24">
                    <input type="password" id="mdp_connexion" name="passe" placeholder="Mot de passe" onkeyup="connexion('mail_connexion')">
                </div>
            </div>
            <div class="win-footer">
                <div data-align="right" class="width-24">
                    <div  class="valider" id="submit_connexion"></div>
                    <div data-outtop="10" data-outbottom="5" class="lien_footer">
                        <a href="#" class="linkform" onclick="CloseWindowsOther('login');OpenWindows('register');">Vous n'avez pas encore de compte ? Enregistrez vous</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!------------------------------------------------------------------->
<!----------------------Formulaire d'inscription--------------------->
<!------------------------------------------------------------------->

<div class="windows" id="register">
    <div class="win-container win-xm">
        <form action="Post/inscription_post.php" method="post">
            <div data-bg="#3c85d0" class="win-header">
                <div class="win-close">X</div>
                <h1 data-color="white">Inscription</h1>
            </div>
            <div data-intop="10" data-inbottom="10" class="win-body">
                <div data-outbottom="10" class="width-11">
                    <input type="text" id="ins_pseudo" name="pseudonyme" placeholder="Pseudonyme"  autofocus="" onkeyup="validation('pseudo')">
                </div>
                <div data-outbottom="10" class="margin-2 width-11">
                    <input type="text" id="ins_mail" name="mail" placeholder="Email" onchange="validation('mail')">
                </div>
                <div class="width-11">
                    <input type="password" id="ins_password" name="password" placeholder="Mot de passe" onkeyup="validation('mdp')">
                </div>
                <div class="margin-2 width-11">
                    <input type="password" id="cf_password" name="cf_password" placeholder="Confirmation mdp" onkeyup="validation('mdp_conf')">
                </div>
            </div>
            <div class="win-footer">
                <div data-align="right" class="width-24">
                    <div class="valider" id="submit"></div>
                    <div data-outtop="10" data-outbottom="5" class="lien_footer">
                        <a href="#" class="linkform" onclick="CloseWindowsOther('register');OpenWindows('login');">Vous avez un compte ? Connectez vous</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!------------------------------------------------------------------------->
<!----------------------Formulaire mot de passe oublié--------------------->
<!------------------------------------------------------------------------->

<div class="windows" id="password">
    <div class="win-container win-m">
        <form action="Post/connexion_post.php" method="post">
            <div data-bg="#3c85d0" class="win-header">
                <div class="win-close">X</div>
                <h1 data-color="white">Mot de passe oublié ?</h1>
            </div>
            <div data-intop="10" data-inbottom="10" class="win-body">
                <div class="width-24">
                    <input type="text" name="mail" placeholder="Email">
                </div>
            </div>
            <div class="win-footer">
                <div data-align="right" class="width-24">
                    <input type="submit" value="Envoyer">
                    <div data-outtop="10" data-outbottom="5" class="lien_footer">
                        <a href="#" class="linkform" onclick="CloseWindowsOther('password');OpenWindows('login');">Mot de passe retrouvé ? Connectez vous</a><br>
                        <a href="#"  class="linkform" onclick="CloseWindowsOther('password');OpenWindows('register');">Vous n'avez pas encore de compte ? Enregistrez vous</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!------------------------------------------------------------------------->
<!----------------------Formulaire insertion tâche------------------------->
<!------------------------------------------------------------------------->

<div class="windows" id="ins_tache">
    <div class="win-container win-m">
        <form action="Post/ajout_tache_post.php" method="post">
            <div data-bg="#3c85d0" class="win-header">
                <div class="win-close">X</div>
                <h1 data-color="white">Ajouter une t&acirc;che</h1>
            </div>
            <div data-intop="10" data-align="center" data-inbottom="10" class="win-body">
                <div class="width-24">
                    <select name="domaine" class="select_input" id="domaine" onchange="filtre_ss_domaine()">
                        <option value='-1'>Domaine</option>
                        <?php
$res = $bdd->query("SELECT DO_LIBELLE, DO_ID FROM DOMAINE ORDER BY DO_LIBELLE");
while($row = $res->fetch()){
    echo "<option value='".$row["DO_ID"]."'>".$row["DO_LIBELLE"]."</option>";}
                        ?>
                    </select>

                    <select name="sous-domaine" class="select_input" id="sous-domaine" onchange="filtre_tache()">
                        <option value='-1'>Sous-domaine</option>
                    </select>

                    <select name="tache" size="1" class="select_input" id="tache" onclick="AjaxTache()">
                        <option value="-1">Tâche</option>
                    </select>

                    <select name="lieu" class="select_input" id="lieu" onchange="AjaxLieu()" disabled>
                        <option value='-1'>Lieu</option>
                        <?php
$lieu = $bdd->query("SELECT LI_LIBELLE, LI_ID FROM LIEU");
while($row = $lieu->fetch()){
    echo "<option value='".$row["LI_ID"]."'>".$row["LI_LIBELLE"]."</option>";}
                        ?>
                    </select>
                    <div data-align="center" data-outtop="18" data-height="40">
                        <div class="width-1" style="line-height:40px">
                            <label class="liste">Le</label>
                        </div>
                        <div class="width-6 margin-1">
                            <input type="text" name="date" value="" id="date" onchange="heureDebut()" disabled>
                        </div>
                        <div class="width-1 margin-1" style="line-height:40px">
                            <label class="liste">De</label>
                        </div>
                        <div class="width-3 margin-1">
                            <input type="text" name="heure_debut" value="" id="heure_debut" onchange="heureFin()" disabled>
                        </div>
                        <div class="width-1 margin-1" style="line-height:40px">
                            <label class="liste">à</label>
                        </div>
                        <div class="width-3 margin-1">
                            <input type="text" name="heure_fin" value="" id="heure_fin" disabled>
                        </div>
                    </div>
                    <div id="jqueryDate">
                        <script>
                            jQuery('#date').datetimepicker({
                                lang:'fr',
                                timepicker:false,
                                format:'Y/m/d',
                                mask:true,
                                closeOnDateSelect:true
                            });
                        </script>
                    </div>
                    <div id="jqueryTache"></div>
                    <div id="jqueryLieu"></div>
                    <div id="jqueryHeureDebut"></div>
                    <div id="jqueryHeureFin"></div>
                </div>
            </div>
            <div class="win-footer">
                <div data-align="right" class="width-24">
                    <input type="submit" value="Ajouter la tâche" id="SubmitTache" disabled>
                </div>
            </div>
        </form>
    </div>
</div>

<!------------------------------------------------------------------------->
<!----------------------Formulaire insertion tâche------------------------->
<!------------------------------------------------------------------------->

<div class="windows" id="method_tache">
    <div class="win-container win-xxl">
        <form action="Php/fonction_optimize.php" method="post">
            <div data-bg="#3c85d0" class="win-header">
                <div class="win-close">X</div>
                <h1 data-color="white">Appliquer les méthodes aux tâches</h1>
            </div>
            <div data-intop="10" data-inbottom="10" class="win-body">
                <div data-font="16" class="width-24" align="center" id="affiche_methode"></div>
            </div>
            <div class="win-footer">
                <div data-align="right" class="width-24">
                    <input type="submit" value="Optimiser" id="SubmitTache">
                </div>
            </div>
        </form>
    </div>
</div>

<!------------------------------------------------------------------->
<!---------------------Fenêtre lien validation----------------------->
<!------------------------------------------------------------------->

<div class="windows" id="lien_validation">
    <div class="win-container win-l">
        <div data-bg="#3c85d0" class="win-header">
            <div class="win-close">X</div>
            <h1 data-color="white">Valider votre compte</h1>
        </div>
        <div data-intop="10" data-inbottom="10" class="win-body">
            <div data-margin="10" data-font="18"><?php echo $_SESSION['lien_validation']; ?></div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------->
<!--------------------Fenêtre message nonvalide---------------------->
<!------------------------------------------------------------------->

<div class="windows" id="message_nonvalide">
    <div class="win-container win-l">
        <div data-bg="#3c85d0" class="win-header">
            <div class="win-close">X</div>
            <h1 data-color="white">Inscription non valide</h1>
        </div>
        <div data-intop="10" data-inbottom="10" class="win-body">
            <div data-margin="10" data-font="18"><?php echo $_SESSION['message_nonvalide']; ?></div>
        </div>
    </div>
</div>

<!------------------------------------------------------------------->
<!--------------------Fenêtre message validation--------------------->
<!------------------------------------------------------------------->

<div class="windows" id="message_validation">
    <div class="win-container win-l">
        <div data-bg="#3c85d0" class="win-header">
            <div class="win-close">X</div>
            <h1 data-color="white">Inscription validée</h1>
        </div>
        <div data-intop="10" data-inbottom="10" class="win-body">
            <div data-margin="10" data-font="18"><?php echo $_SESSION['message_validation']; ?></div>
        </div>
    </div>
</div>

<!-------------------------------------------------------------------------->
<!--------------------------Fenêtre gain de temps--------------------------->
<!-------------------------------------------------------------------------->

<div class="windows" id="gain">
    <div class="win-container win-xm">
        <div data-bg="#3c85d0" class="win-header">
            <div class="win-close">X</div>
            <h1 data-color="white">Votre gain de temps</h1>
        </div>
        <div data-intop="10" data-inbottom="10" data-align="center" class="win-body">
            <div data-font="17" class="width-24">Après optimisation du planning, vous avez gagné :</div><br>
            <h2><?php echo $_SESSION['gain'];?></h2>
        </div>
    </div>
</div>

<!-------------------------------------------------------------------------->
<!--------------------------Fenêtre gain de temps--------------------------->
<!-------------------------------------------------------------------------->

<div class="windows" id="propos">
    <div class="win-container win-xm">
        <div data-bg="#3c85d0" class="win-header">
            <div class="win-close">X</div>
            <h1 data-color="white">À propos d'Optiday</h1>
        </div>
        <div data-intop="10" data-inbottom="10" data-align="center" class="win-body">
            <span data-font="20">Producted by</span><br>
            Aatchi&amp;aatchi<br><br>
            <span data-font="20">Developped by</span><br>
            Vauley Anthony<br>
            Guillemot Thomas<br>
            Rattier Julien<br><br>
            <span data-font="20">Framework</span><br>
            visjs for timeline<br>
            toolDesign for design<br><br>

        </div>
    </div>
</div>

<div id="style_input"></div>
