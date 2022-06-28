# Symfony project "note de frais"

### Project requirements:
* Symfony 5.4
* php >=8.0

### Getting started Setup environment:
* Setup BDD in .env file in the project root (DATABASE_URL="mysql://user:password@127.0.0.1:3306/db_name?serverVersion=8.0&charset=utf8mb4")
* Enter maker command:  **_make first-install_**
* Create jwt Secret *pem with cmd: **_php bin/console lexik:jwt:generate-keypair_**
* Open the browser and go to https://localhost:8000/
* Et voilà !

### API tests endpoints
* Get JWT token:  **$ curl -X POST -H "Content-Type: application/json" https://localhost:8000/api/login_check -d '{"username":"user@user.fr","password":"123456"}'**
* Get all URL endpoints (Postman, Insomnia..) with Bearer header
>Access API Documentation at localhost:{my-port}/api
<br>
You can find img with structure of the database at the end of the document
<br>
### Unit test
* To run the unit tests, use the command in the project path **make tests**



### Request project
Lors de ce test technique,
vous créerez une API de gestion de notes de frais.
* Ce test porte UNIQUEMENT sur l’API. Elle pourra être consommée via Postman, Insomnia... La création du code, côté front, n’est pas attendue.
* Vous utiliserez la version de PHP ainsi que le SGBD de votre choix.
* Vous êtes libre d’utiliser un Framework ou non.
* Votre code sera versionné sur un dépôt Git (GitHub, Gitlab , Bitbucket ...)
* Vous documenterez le code et le projet. Entre autres, afin de faciliter l’installation et le lancement du projet.


### Contexte

Un commercial travaillant pour différentes sociétés doit pouvoir se faire rembourser les frais engagés pour son travail.

### Besoins


Vous créez une API de gestion de notes de frais contenant les routes suivantes :

* GET des notes de frais
* GET d'une note de frais
* POST d'une nouvelle note
* PUT d'une note à éditer
* DELETE d'une note

L’API ne sera utilisée que par un seul utilisateur ayant l’ID #1. La gestion des droits et d’authentification n’est pas attendue. Toutefois, vous pouvez détailler dans la documentation du projet le
type d’authentification que vous auriez mis en place.


### Tests

Les classes utilisées par la route POST seront testées unitairement et/ou fonctionnellement.

### Modèle de données
Vous intègrerez à minima les données suivantes. Vous pourrez ajouter à ce modèle les éléments qui vous semblent nécessaires.

* Utilisateur
* Identifiant
* Nom
* Prénom
* Email
* Date de naissance
* Note de frais
* Identifiant
* Date de la note
* Montant de la note
* Type de note (essence, péage, repas, conférence)
* Date d’enregistrement
* Société (à qui l’on demande le remboursement)
* Nom de la société

### Bonus
* Implémentation d’un système d’authentification
* Toutes les routes sont testées


### MCD
![MCD](https://buathieralexandre.dev/img/MCDktb.png "MCD")
