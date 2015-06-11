# squid3_php_auth

##Install Guide for Ubuntu servers:

Might work for other Debian based distribution as well

###1. Install *squid* and *php*

    sudo apt-get update # optional
    sudo apt-get install squid3 php5-cli

###2. Go to squid3 configuration folder

    cd /etc/squid3/
    
###3. Move all default configuration files to a new server

    mkdir old-files
    mv *.* old-files
###4. Copy all files from this git repository

Sometimes on VPS you get certificate issues, if that's the case add the last parameter *--no-check-certificate*
   
    wget https://raw.githubusercontent.com/Luxian/squid3_php_auth/master/auth.php --no-check-certificate
    wget https://raw.githubusercontent.com/Luxian/squid3_php_auth/master/squid.conf --no-check-certificate
    wget https://raw.githubusercontent.com/Luxian/squid3_php_auth/master/errorpage.css --no-check-certificate

###4. Update username and password

Open auth.php file for editing:

    vi auth.php

Change the username and password value in the following line:

    if ($username == 'proxy' && $password == 'pass') {

###5. Check and squid.conf the port number if needed

    vi squid.conf

Configuration comes with the following settings:
    http port: 3128
    allowed ports: 
      443 (https), 80 (http), 21 (ftp), 
      70 (gopher), 210 (wais), 280 (http-mgmt), 4
      88 (gss-http), 591 (filemaker), 777 (multi-http)
      1025-65535 (most of unregistered ports) - remove this if you don't need them



###6. Restart squid3 server

    sudo service squid3 restart

####_@TODO:_
* improve error message
* load username/password from a list
* customize squid error page css
