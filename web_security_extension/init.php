<?php

/*
Plugin Name: websecurityscan
Description:
Version: 0.1
Author: M. El Kawakibi
 */

define('WSS_EXTESION', __FILE__);

define('WSS_EXTESION_DIR', untrailingslashit( dirname(WSS_EXTESION) ));

require_once WSS_EXTESION_DIR . '/WebSecurity.php';