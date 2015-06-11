# squid3_php_auth

Configuration setting for squid3 with authentication via php script.
This repository contains:
* squid configuration files
* php script used for squid authentication

Work heavily inspired by:
* [freesoftwaremagazine.com/articles/authentication_with_squid](http://www.freesoftwaremagazine.com/articles/authentication_with_squid)

##Install Guide for Ubuntu servers:

Might work for other Debian based distribution as well

###1. Install *squid* and *php*
```bash
sudo apt-get update # optional
sudo apt-get install squid3 php5-cli
```

###2. Go to squid3 configuration folder
```bash
cd /etc/squid3/
```
    
###3. Move all default configuration files to a new server
```bash
mkdir old-files
mv *.* old-files
```

###4. Copy all files from this git repository

Sometimes on VPS you get certificate errors, if that's the case add the last parameter *--no-check-certificate*

```bash   
wget https://raw.githubusercontent.com/Luxian/squid3_php_auth/master/auth.php --no-check-certificate
wget https://raw.githubusercontent.com/Luxian/squid3_php_auth/master/squid.conf --no-check-certificate
wget https://raw.githubusercontent.com/Luxian/squid3_php_auth/master/errorpage.css --no-check-certificate
```

###4. Update username and password

Open `auth.php` file for editing:

```bash
vi auth.php
```

Change the username and password value in the following line:

```php
if ($username == 'proxy' && $password == 'pass') {
```

###5. Check `squid.conf` and adjust settings if needed

```bash
vi squid.conf
```

Configuration comes with the following settings:
    http port: 3128
    allowed ports: 
      443 (https), 80 (http), 21 (ftp), 
      70 (gopher), 210 (wais), 280 (http-mgmt), 4
      88 (gss-http), 591 (filemaker), 777 (multi-http)
      1025-65535 (most of unregistered ports) - remove this if you don't need them



###6. Restart squid3 server

```bash
sudo service squid3 restart
```

####_@TODO:_
* improve error message
* load username/password from a list
* customize squid error page css
