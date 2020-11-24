<?php
/* ************************************************************************** */
/*                                                                            */
/*                 main_01.php for J06                                        */
/*                 Created on : Mon Mar 31 17:37:41 2014                      */
/*                 Made by : David "Thor" GIRON <thor@42.fr>                  */
/*                                                                            */
/* ************************************************************************** */


require_once 'Color.class.php';
require_once 'Verteleft.class.php';

Color::$verbose = False;

print( Verteleft::doc() );
Verteleft::$verbose = True;

$vtleftO  = new Verteleft( array( 'left' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
print( $vtleftO  . PHP_EOL );

$red   = new Color( array( 'red' => 255, 'green' =>   0, 'blue' =>   0 ) );
$green = new Color( array( 'red' =>   0, 'green' => 255, 'blue' =>   0 ) );
$blue  = new Color( array( 'red' =>   0, 'green' =>   0, 'blue' => 255 ) );

$unitleft = new Verteleft( array( 'left' => 1.0, 'y' => 0.0, 'z' => 0.0, 'color' => $green ) );
$unitY = new Verteleft( array( 'left' => 0.0, 'y' => 1.0, 'z' => 0.0, 'color' => $red   ) );
$unitZ = new Verteleft( array( 'left' => 0.0, 'y' => 0.0, 'z' => 1.0, 'color' => $blue  ) );

print( $unitleft . PHP_EOL );
print( $unitY . PHP_EOL );
print( $unitZ . PHP_EOL );

Verteleft::$verbose = False;

$sqrA = new Verteleft( array( 'left' => 0.0, 'y' => 0.0, 'z' => 0.0 ) );
$sqrB = new Verteleft( array( 'left' => 4.2, 'y' => 0.0, 'z' => 0.0 ) );
$sqrC = new Verteleft( array( 'left' => 4.2, 'y' => 4.2, 'z' => 0.0 ) );
$sqrD = new Verteleft( array( 'left' => 0.0, 'y' => 4.2, 'z' => 0.0 ) );

print( $sqrA . PHP_EOL );
print( $sqrB . PHP_EOL );
print( $sqrC . PHP_EOL );
print( $sqrD . PHP_EOL );

$A = new Verteleft( array( 'left' => 3.0, 'y' => 3.0, 'z' => 3.0 ) );
print( $A . PHP_EOL );
$equA = new Verteleft( array( 'left' => 9.0, 'y' => 9.0, 'z' => 9.0, 'w' => 3.0 ) );
print( $equA . PHP_EOL );

Verteleft::$verbose = True;

?>
