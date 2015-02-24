<?php

// -----------------------------------------------------------
// This is how to create a .torrent file from a physical file.
// -----------------------------------------------------------

// Registering autoloader, essential to use the library.
require( dirname(__FILE__).'/lib/PHPTracker/Autoloader.php' );
PHPTracker_Autoloader::register();

// Creating a simple config object. You can replace this with your object
// implementing PHPTracker_Config_Interface.
$config = new PHPTracker_Config_Simple( array(
    // Persistense object implementing PHPTracker_Persistence_Interface.
    // We use MySQL here. The object is initialized with its own config.
    'persistence' => new PHPTracker_Persistence_Mysql(
        new PHPTracker_Config_Simple( array(
            'db_host'       => 'localhost',
            'db_user'       => 'bittracker',
            'db_password'   => 'bitbit',
            'db_name'       => 'bittracker',
        ) )
    ),
    // List of public announce URLs on your server.
    'announce'  => array(
        'http://bt.cubian.org/announce.php',
        'http://bt.cubian.org:8307/announce.php',
        'http://bt-cn.cubian.org/announce.php',
        'http://bt-cn.cubian.org:8307/announce.php',
    ),
) );

// Core class managing creating the file.
$core = new PHPTracker_Core( $config );

// Setting appropiate HTTP header and sending back the .torrrent file.
// This is VERY inefficient to do! SAVE the .torrent file on your server and
// serve the saved copy!
header( 'Content-Type: application/x-bittorrent' );
header( 'Content-Disposition: attachment; filename="Cubian.torrent"' );

// The first parameters is a path (can be absolute) of the file,
// the second is the piece size in bytes.
// echo $core->createTorrent( '/home/ubuntu/share/Cubian-nano-x1-a10-hdmi.img.7z', 524288 );
// echo $core->createTorrent( '/home/ubuntu/share/Cubian-nano+headless-x1-a10.img.7z', 524288 );
//echo $core->createTorrent( '/home/ubuntu/share/Cubian-desktop-x1-a10-hdmi.img.7z', 524288 );
//echo $core->createTorrent( '/home/ubuntu/share/Cubian-nano-x1-a20-hdmi.img.7z', 524288 );
// echo $core->createTorrent( '/home/ubuntu/share/Cubian-nano+headless-x1-a20.img.7z', 524288 );
//echo $core->createTorrent( '/home/ubuntu/share/Cubian-desktop-x1-a20-cubietruck-hdmi.img.7z', 524288 );
// echo $core->createTorrent( '/home/ubuntu/share/Cubian-desktop-x1-a20-cubietruck-vga.img.7z', 524288 );
// echo $core->createTorrent( '/home/ubuntu/share/Cubian-desktop-x1-a20-hdmi.img.7z', 524288 );
// echo $core->createTorrent( '/home/ubuntu/share/Cubian-nano+headless-x1-a20-cubietruck.img.7z', 524288 );
// echo $core->createTorrent( '/home/ubuntu/share/Cubian-nano-x1-a20-cubietruck-hdmi.img.7z', 524288 );
// echo $core->createTorrent( '/home/ubuntu/share/Cubian-nano-x1-a20-cubietruck-vga.img.7z', 524288 );

// You can also specify basename for the file in the torrent (if different from physical):
// echo $core->createTorrent( '../test.avi', 524288, 'puderzucker.avi' );
