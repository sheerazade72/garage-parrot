Nom de votre Application Web

Installation et Exécution en local

Assurez-vous d'avoir installé la liste des prérequis sur votre système.
Clonez ce dépôt sur votre machine locale :
git clone https://github.com/sheerazade72/garage-parrot.git
Accédez au répertoire du projet :
cd ecf-git
Installez les dépendances du projet :
npm install
Configurez la base de données :
Créez une base de données MySQL avec le nom "projet-garage".
Importez le fichier SQL "projet-garage.sql" qui contient la structure de la base de données.
Lancez l'application : npm start
Accédez à l'application dans votre navigateur à l'adresse http://localhost

Création de l'administrateur

Une fois que l'application est lancée, pour accédez à la page d'inscription en tant qu'administrateur creer vous un compte admninistrateurs via votre base de données. Vous pouvez maintenant accéder au back-office de l'application en vous connectant avec les identifiants de l'administrateur que vous venez de créer.
