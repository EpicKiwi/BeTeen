#Introduction
Le MarkDown est un langage de balisage simple et l�ger utilis� sur le forum pour la r�daction de sujets, de r�ponses et de biens d'autres choses.  
Un langage de balisage est une syntaxe sp�ciale pour mettre en forme un bloc de texte. En bref cela permet de d�crie le texte en cours de r�daction comme �tant un titre, une emphase ou une citation.  
Pour le moment aucune interface ne permet la mise en forme simplifi�e d'un texte, il deviens alors indispensable de connaitre les bases de ce langage tr�s simple je vous rassure. ;)
#Syntaxte
##Emphase
Dans un sujet il est int�ressant de pouvoir mettre des parties du texte en valeur. En MarkDown il existe deux types d'emphases qui s'utilisent comme suis

    Un mot en *emphase*  
    Un mot bien plus **important**

R�sultat :

Un mot en *emphase*  
Un mot bien plus **important**

Si vous n'aimez pas les ast�risques (\*) vous pouvez utiliser des tirets du bas (underscore) a la place

    Un mot en _emphase_  
    Un mot bien plus __important__

Les emphases peuvent se mettre dans n'importe quel paragraphe.
##Paragraphe
Pour cr�er un paragraphe en plus vous avez juste a sauter une ligne entre vos deux paragraphes

    Le premier paragraphe
    
    Le second paragraphe

R�sultat :

Le premier paragraphe

Le second paragraphe

Cette technique permet de passer un paragraphe mais pas de sauter une ligne, pour ce faire il faut finir une ligne par deux espaces sans quoi aucun retour a la ligne ne sera effectu�.

    Un retour  
    A la ligne

Resultat :

Un retour  
A la ligne

##Liste
Pour cr�er une liste non ordonn�e dans votre sujet, sautez une ligne puis marquez un �l�ment sur chaque ligne celui ci pr�c�d� d'un ast�risque.   
**ATTENTION** Vous devez obligatoirement sauter une ligne avant la liste et mettre un espace entre l'�l�ment et l�ast�risque.

    * Pommes
    * Fraises
    * Poire
    * Kiwi

R�sultat :

* Pommes
* Fraises
* Poire
* Kiwi

Vous pouvez aussi ins�rer des sous-listes en ins�rant 4 espaces avant chaque �l�ments de cette sous liste.

    * Aller chercher le colis
    * Aller faire les courses
        * Yaourt
        * Fruits

R�sultat : 

* Aller chercher le colis
* Aller faire les courses
    * Yaourt
    * Fruits

*A noter* que les  sous-listes ne peuvent pas contenir de sous-sous-listes
##Titre
Les sujets peuvent contenir des titres. Il existe plusieurs types de syntaxe pour les titres qui correspondent � des niveaux d'importance diff�rants

    #Titres de grande importance
    ##Titre de moyenne importance
    ###Titre de faible importance
    ####Titre de tr�s faible importance

R�sultat:

#Titres de grande importance
##Titre de moyenne importance
###Titre de faible importance
####Titre de tr�s faible importance

Pour les deux premiers niveaux de titre on peux aussi souligner le futur titre avec des - ou des =

    Titres de grande importance
    =====================
    Titre de moyenne importance
    --------------------------

Le nombre est arbitraire mais doit �tre sup�rieur a 2.
##Code
Pour exposer du code vous devez sauter une ligne puis d�marrer chaque ligne par 4 espaces. Le code MarkDown n'est aussi plus effectif dans un paragraphe de code.

        Ceci est du code **tres** beau

R�sultat:

    Ceci est du code **tres** beau

##Liens
Pour ins�rer un lien dans votre sujet vous  devez mettre le titre du lien entre crochets puis, juste apr�s, mettre l'URL du lien entre parenth�s�s.  
*A noter* que vous pouvez aussi  donner un titre a votre lien qui  appara�tra quand on pose la souris dessus.

    Le moteur de recherche [google](http://google.fr/ "Le plus populaire au monde")

R�sultat :

Le moteur de recherche [google](http://google.fr/ "Le plus populaire au monde")
##Images
Pour ins�rer une images vous devez utiliser la m�me syntaxe que les liens mais en ajoutant un ! au debut

    ![Image](http://lorempixel.com/200/200/ "Une image au hasard")

R�sultat :

![Image](http://lorempixel.com/200/200/ "Une image au hasard")

##Citation
Pour citer un personne ou autre chose vous pouvez commencer chaque ligne par >

    >  Il n�y a point de g�nie sans un grain de folie
    > *Aristote*

R�sultat :

>  Il n�y a point de g�nie sans un grain de folie  
> *Aristote*

La syntaxe MarkDown fonctionne dans les zone de citation

#Questions
##Pourquoi  ne pas utiliser un �diteur standard ?
Car cela permet d'uniformiser le style des sujets avec le style global du site
##Je n'ai pas envie de tout retenir !
Un �diteur aidant � la syntaxe est pr�vu mais pas encore effectif
#Conclusion
N�h�sitez pas a poser d'autres questions en dessous ;)