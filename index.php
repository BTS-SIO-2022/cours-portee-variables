<?php

// La portée des variables

var_dump($_GET);

var_dump($_POST);

var_dump($_SERVER);

$x = 25;

var_dump($x);

/* Ici j'ai déclaré une variable x qui a une portée GLOBALE, c'est-à-dire qu'elle est disponible par défaut à l'utilisation et à la manipulation dans un contexte global.

A ne pas confondre avec une super-globales qui sont des variables qui sont mis à notre disposition par le langage PHP et qui sont disponibles partout, tout le temps : https://www.php.net/manual/fr/language.variables.superglobals.php

A ne pas confondre non plus avec les constantes. Les constantes sont des variables et qui sont disponibles partout, tout le temps. Sauf que l'idée en plus avec les constantes (comme leur nom l'indique) est que la valeur de ma constante ne change jamais, est immuable.
https://www.php.net/manual/fr/language.constants.magic.php
*/
// Exemple de constantes magiques :
var_dump(__DIR__);

define('GENRE', 'femme' );
define('MON_CHIEN_PREFERE', 'beagle');
define('PERIMETRE', 258);

var_dump(GENRE);

function maFonctionUne(){
    echo 'La valeur de ma variable x est : '.$x;
};

maFonctionUne();
// Ici à l'appel de maFonctionUne x me renvoie une erreur du type undefined variable. En effet dans un contexte local (comme par exemple à l'intérieur d'une fonction), une variable définie au niveau global (comme x ici) n'est pas disponible.

// Du coup si je souhaite utiliser x dans un contexte local (donc dans une fonction), plusieurs options.

// Option 1 : je définis x dans le contexte local. C'est une variable "jettable" car elle est détruite à la fin de l'éxecution de ma fonction. Du coup dès que j'appelle a nouveau ma fonction, elle réinitialise ma variable a la valeur à laquelle elle est défini dans la fonction.

function maFonctionUneBis(){
    $x = 11;
    echo 'La valeur de ma variable x est : '.$x;
    return $x;
}

maFonctionUneBis();
maFonctionUneBis();
maFonctionUneBis();
maFonctionUneBis();

// Je pourrai utiliser ma variable globale x (celle définie ligne 11 dans mon code) à l'intérieur de ma fonction : pour cela, je vais utiliser le préfixe global pour indiquer à php que les variables que j'utilise dans ma fonction sont en fait des variables globales. En terme informatique, on dit que les variables globales ont été importées dans un contexte local de référence. 

function porteeGlobaleExemple(){
    global $x ;
    echo 'La valeur de ma variable x est : '.$x;
}

porteeGlobaleExemple();

// Si à l'inverse, j'ai besoin qu'une variable disponible dans un contexte local, soit disponible aussi dans un contexte global, j'utilise le return afin que ma fonction me renvoie la valeur de ma variable que je vais stocker dans une variable de portée globale.
// Exemple : 
function localToGlobal(){
    $y = 'toto';
    echo $y;
    return $y;
}

$y = localToGlobal();

var_dump($y);

// On sait qu'une variable définie dans un contexte local est DETRUITE à la fin de l'exécution de cette fonction. OR, il arrive que j'ai besoin de CONSERVER ma variable locale afin de pouvoir l'utiliser dans d'autres contextes LOCAUX. Pour faire en sorte que mon contexte local se souvienne de la valeur de ma variable, nous allons utiliser le préfixe static

function compteur(){
    static $foo = 0;
    $foo++;
    echo 'La valeur de foo est '.$foo;
}
// Ici grâce à static, la valeur de ma variable $foo est conservée en mémoire et non pas détruite. Par conséquent, à l'appel de ma fonction, la valeur de foo est différente
// Ici foo = 0 au début de la fonction;
compteur();
// Ici foo = 1 au début de la fonction
compteur();
// Ici foo = 2 au début de la fonction
compteur();


