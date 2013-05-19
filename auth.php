<?php
/**
 * @file
 *   Squid Authentication Helper
 *
 * Squid3 documentation:
 *   Such a program reads a line containing "username password" and replies "OK"
 *   or "ERR" in an endless loop. "ERR" responses may optionally be followed by
 *   a error description available as %m in the returned error page. If you use
 *   an authenticator, make sure you have 1 acl of type proxy_auth.
 *
 * Original code can be found here:
 *   http://www.freesoftwaremagazine.com/articles/authentication_with_squid
 *
 * Full project:
 *   https://github.com/Luxian/squid3_php_auth
 */


// Make sure we have STDIN and STDOUT defined
if (!defined('STDIN')) {
    define('STDIN', fopen("php://stdin", "r"));
}
if (!defined('STDOUT')) {
    define('STDOUT', fopen("php://stdout", "w"));
}

while (!feof(STDIN)) {
    $line = trim(fgets(STDIN));
    $fields = explode(' ', $line);

    if (empty($fields[0])) {
        // No comand line argument found, do nothing this loop
        continue;
    }

    // Username & password are encoded
    $username = rawurldecode($fields[0]); //1738
    $password = rawurldecode($fields[1]); //1738

    // Replace the following with anything else
    if ($username == 'proxy' && $password == 'pass') {
        // Allow access
        fwrite(STDOUT, "OK\n");
    }
    else {
        // Deny access
        fwrite(STDOUT, "ERR\n");
    }
}
