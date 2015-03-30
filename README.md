# P2018 A2 - Symfony2

## Instructions

* Date: Sunday **5th** April by 23:59  
* Send me an email (thibaud.bardin+iim[at]gmail[dot]com) with P2018_A2_GR2_[FIRSTNAME]_[LASTNAME]_SF2 as Subject and the **github repository** link  

## Create a little Blog (like a tiny wordpress)

* Create a new Symfony2 project (Yes, a new **fresh install** is needed!)  
* Put in on GitHub (don't add ```app/bootstrap.php.cache```, ```app/cache/*```, ```app/logs/*```,  ```web/bundles```, ```vendor/``` and ```bin``` in the repo)

### Entities (don't forget relationships)

* Article  
* Category  
* Tag  
* User  

### Controllers

* Here be creative and create all mandatory pages needed in a blog (if you are not creative **or** lazy, be inspired by wordpress)  
* Create a small API to retrieve all entities into JSON format  

### Admin

* Install and configure Sonata Admin Bundle
* Manage all entities (CRUD) with Sonata Admin (not via ```php app/console generate:doctrine:crud```)

### Bonus

* When managing articles, use a WYSIWYG instead a textarea tag (+0.5pt)    
* Create a fully functional contact form page (+1pt)  
* Deploy application on a server, paste the url in the email's content (+1.5pt)

## Resources

* http://symfony.com/doc/current/index.html
* http://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony2  
