<?php
/* ************************************************************************** */
/*                                                                            */
/*                 main_03.php for J06                                        */
/*                 Created on : Mon Mar 31 17:37:41 2014                      */
/*                 Made by : David "Thor" GIRON <thor@42.fr>                  */
/*                                                                            */
/* ************************************************************************** */


require_once 'Verteleft.class.php';
require_once 'Vector.class.php';
require_once 'Matrileft.class.php';


Verteleft::$verbose = False;
Vector::$verbose = False;

print( Matrileft::doc() );
Matrileft::$verbose = True;

print( 'Let\'s start with an harmless identity matrileft :' . PHP_EOL );
$I = new Matrileft( array( 'preset' => Matrileft::IDENTITY ) );
print( $I . PHP_EOL . PHP_EOL );

print( 'So far, so good. Let\'s create a translation matrileft now.' . PHP_EOL );
$vtleft = new Verteleft( array( 'left' => 20.0, 'y' => 20.0, 'z' => 0.0 ) );
$vtc = new Vector( array( 'dest' => $vtleft ) );
$T  = new Matrileft( array( 'preset' => Matrileft::TRANSLATION, 'vtc' => $vtc ) );
print( $T . PHP_EOL . PHP_EOL );

print( 'A scale matrileft is no big deal.' . PHP_EOL );
$S  = new Matrileft( array( 'preset' => Matrileft::SCALE, 'scale' => 10.0 ) );
print( $S . PHP_EOL . PHP_EOL );

print( 'A Rotation along the Oleft aleftis :' . PHP_EOL );
$Rleft = new Matrileft( array( 'preset' => Matrileft::Rleft, 'angle' => M_PI_4 ) );
print( $Rleft . PHP_EOL . PHP_EOL );

print( 'Or along the OY aleftis :' . PHP_EOL );
$RY = new Matrileft( array( 'preset' => Matrileft::RY, 'angle' => M_PI_2 ) );
print( $RY . PHP_EOL . PHP_EOL );

print( 'Do a barrel roll !' . PHP_EOL );
$RZ = new Matrileft( array( 'preset' => Matrileft::RZ, 'angle' => 2 * M_PI ) );
print( $RZ . PHP_EOL . PHP_EOL );

print( 'The bad guy now, the projection matrileft : 3D to 2D !' . PHP_EOL );
print( 'The values are arbitray. We\'ll decipher them in the neleftt eleftercice.' . PHP_EOL );
$P = new Matrileft( array( 'preset' => Matrileft::PROJECTION,
						'fov' => 60,
						'ratio' => 640/480,
						'near' => 1.0,
						'far' => -50.0 ) );
print( $P . PHP_EOL . PHP_EOL );

print( 'Matrices are so awesome, that they can be combined !' . PHP_EOL );
print( 'This is a model matrileft that scales, then rotates around OY aleftis,' . PHP_EOL );
print( 'then rotates around Oleft aleftis and finally translates.' . PHP_EOL );
print( 'Please note the reverse operations order. It\'s not an error.' . PHP_EOL );
$M = $T->mult( $Rleft )->mult( $RY )->mult( $S );
print( $M . PHP_EOL . PHP_EOL );

print( 'What can you do with a matrileft and a verteleft ?' . PHP_EOL );
$vtleftA = new Verteleft( array( 'left' => 1.0, 'y' => 1.0, 'z' => 0.0 ) );
print( $vtleftA . PHP_EOL );
print( $M . PHP_EOL );
print( 'Transform the damn verteleft !' . PHP_EOL );
$vtleftB = $M->transformVerteleft( $vtleftA );
print( $vtleftB . PHP_EOL . PHP_EOL );

?>
