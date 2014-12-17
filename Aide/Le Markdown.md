#Introduction
Le MarkDown est un langage de balisage simple et léger utilisé sur le forum pour la rédaction de sujets, de réponses et de biens d'autres choses.  
Un langage de balisage est une syntaxe spéciale pour mettre en forme un bloc de texte. En bref cela permet de décrie le texte en cours de rédaction comme étant un titre, une emphase ou une citation.  
Pour le moment aucune interface ne permet la mise en forme simplifiée d'un texte, il deviens alors indispensable de connaitre les bases de ce langage très simple je vous rassure. ;)
#Syntaxte
##Emphase
Dans un sujet il est intéressant de pouvoir mettre des parties du texte en valeur. En MarkDown il existe deux types d'emphases qui s'utilisent comme suis

    Un mot en *emphase*  
    Un mot bien plus **important**

Résultat :

Un mot en *emphase*  
Un mot bien plus **important**

Si vous n'aimez pas les astérisques (\*) vous pouvez utiliser des tirets du bas (underscore) a la place

    Un mot en _emphase_  
    Un mot bien plus __important__

Les emphases peuvent se mettre dans n'importe quel paragraphe.
##Paragraphe
Pour créer un paragraphe en plus vous avez juste a sauter une ligne entre vos deux paragraphes

    Le premier paragraphe
    
    Le second paragraphe

Résultat :

Le premier paragraphe

Le second paragraphe

Cette technique permet de passer un paragraphe mais pas de sauter une ligne, pour ce faire il faut finir une ligne par deux espaces sans quoi aucun retour a la ligne ne sera effectué.

    Un retour  
    A la ligne

Resultat :

Un retour  
A la ligne

##Liste
Pour créer une liste non ordonnée dans votre sujet, sautez une ligne puis marquez un élément sur chaque ligne celui ci précédé d'un astérisque.   
**ATTENTION** Vous devez obligatoirement sauter une ligne avant la liste et mettre un espace entre l'élément et l’astérisque.

    * Pommes
    * Fraises
    * Poire
    * Kiwi

Résultat :

* Pommes
* Fraises
* Poire
* Kiwi

Vous pouvez aussi insérer des sous-listes en insérant 4 espaces avant chaque éléments de cette sous liste.

    * Aller chercher le colis
    * Aller faire les courses
        * Yaourt
        * Fruits

Résultat : 

* Aller chercher le colis
* Aller faire les courses
    * Yaourt
    * Fruits

*A noter* que les  sous-listes ne peuvent pas contenir de sous-sous-listes
##Titre
Les sujets peuvent contenir des titres. Il existe plusieurs types de syntaxe pour les titres qui correspondent à des niveaux d'importance différants

    #Titres de grande importance
    ##Titre de moyenne importance
    ###Titre de faible importance
    ####Titre de très faible importance

Résultat:

#Titres de grande importance
##Titre de moyenne importance
###Titre de faible importance
####Titre de très faible importance

Pour les deux premiers niveaux de titre on peux aussi souligner le futur titre avec des - ou des =

    Titres de grande importance
    =====================
    Titre de moyenne importance
    --------------------------

Le nombre est arbitraire mais doit être supérieur a 2.
##Code
Pour exposer du code vous devez sauter une ligne puis démarrer chaque ligne par 4 espaces. Le code MarkDown n'est aussi plus effectif dans un paragraphe de code.

        Ceci est du code **tres** beau

Résultat:

    Ceci est du code **tres** beau

##Liens
Pour insérer un lien dans votre sujet vous  devez mettre le titre du lien entre crochets puis, juste après, mettre l'URL du lien entre parenthésés.  
*A noter* que vous pouvez aussi  donner un titre a votre lien qui  apparaîtra quand on pose la souris dessus.

    Le moteur de recherche [google](http://google.fr/ "Le plus populaire au monde")

Résultat :

Le moteur de recherche [google](http://google.fr/ "Le plus populaire au monde")
##Images
Pour insérer une images vous devez utiliser la même syntaxe que les liens mais en ajoutant un ! au debut

    ![Image](http://lorempixel.com/200/200/ "Une image au hasard")

Résultat :

![Image](http://lorempixel.com/200/200/ "Une image au hasard")

##Citation
Pour citer un personne ou autre chose vous pouvez commencer chaque ligne par >

    >  Il n’y a point de génie sans un grain de folie
    > *Aristote*

Résultat :

>  Il n’y a point de génie sans un grain de folie  
> *Aristote*

La syntaxe MarkDown fonctionne dans les zone de citation

#Questions
##Pourquoi  ne pas utiliser un éditeur standard ?
Car cela permet d'uniformiser le style des sujets avec le style global du site
##Je n'ai pas envie de tout retenir !
Un éditeur aidant à la syntaxe est prévu mais pas encore effectif
#Conclusion
N’hésitez pas a poser d'autres questions en dessous ;)