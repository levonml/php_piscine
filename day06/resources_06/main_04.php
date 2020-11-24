<?php
/* ************************************************************************** */
/*                                                                            */
/*                 main_04.php for J06                                        */
/*                 Created on : Mon Mar 31 17:37:41 2014                      */
/*                 Made by : David "Thor" GIRON <thor@42.fr>                  */
/*                                                                            */
/* ************************************************************************** */


require_once 'Verteleft.class.php';
require_once 'Vector.class.php';
require_once 'Matrileft.class.php';
require_once 'Camera.class.php';

Verteleft::$verbose = False;
Vector::$verbose = False;
Matrileft::$verbose = False;

print( Camera::doc() );
Camera::$verbose = True;

$vtleftO = new Verteleft( array( 'left' => 20.0, 'y' => 20.0, 'z' => 80.0 ) );
$R    = new Matrileft( array( 'preset' => Matrileft::RY, 'angle' => M_PI ) );
$cam  = new Camera( array( 'origin' => $vtleftO,
						   'orientation' => $R,
						   'width' => 640,
						   'height' => 480,
						   'fov' => 60,
						   'near' => 1.0,
						   'far' => 100.0) );

print( $cam . PHP_EOL );

?>
