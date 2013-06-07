Installation
============

These instructions are written for installation on CentOS 6. However other
distributions of Linux will work but instructions may need to be modified.


How to use instructions
-----------------------

For easier readability go to: http://www.8bitnet.com/postmin/docs/install/

If a command starts with a `#` it means to run on the command line as root.
If a command starts with a `$` it means to run on the command line as normal
user.

Any line that starts with 4 spaces is a command or results of a command. All
text to be added to a file is also indented with 4 spaces.

Through out the instructions the need to replace some text will be needed. The
following is a list of words to look for that need replaced with the proper
information.

* yourDomain
* chAnGEme
* timeZone


Generating Needed Passwords
---------------------------

It is recommended that four passwords are generated before starting and noted
somewhere safe for the duration of following these instructions. These
passwords will need to be recalled often throughout the process. Since these
passwords do not need to be entered after the initial setup they should be
complex and lengthy passwords. Create passwords for the following usernames
and keep them associated to each other.

* postmin
* spamd
* postfix_ro
* dovecot
* opendkim


Adding Additional Repos
-----------------------

The default CentOS repos will not have all the packages needed. So the addition
of three more repos are required.

Choose system architecture and run the following commands.

i686
    # rpm -Uhv http://pkgs.repoforge.org/rpmforge-release/rpmforge-release-0.5.3-1.el6.rf.i686.rpm
    # rpm -Uhv http://dl.fedoraproject.org/pub/epel/6/i686/epel-release-6-8.noarch.rpm
    # rpm -Uvh http://downloads.sourceforge.net/milter-manager/centos/milter-manager-release-1.1.0-0.noarch.rpm

x86_64
    # rpm -Uhv http://pkgs.repoforge.org/rpmforge-release/rpmforge-release-0.5.3-1.el6.rf.x86_64.rpm
    # rpm -Uhv http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm
    # rpm -Uvh http://downloads.sourceforge.net/milter-manager/centos/milter-manager-release-1.1.0-0.noarch.rpm


Packages
--------

Install the following packages, these should pull in all other dependencies.

    # yum install postfix spamass-milter clamav-milter milter-greylist milter-manager opendkim \
    mysql mysql-server pyzor dovecot-mysql nginx php-fpm php-cli php-gd php-mysql php-pdo \
    php rrdtool-ruby


SELinux
-------

Postmin is developed on a system that SELinux has been disabled. SELinux will
provide more security but requires configuration that is not covered in these
instructions.


nginx
-----

Postmin uses nginx web server for the control panel and webmail.

The first operation is to create the file `/etc/nginx/conf.d/postmin.conf` and
put the following contents inside. This creates the listening http server on
port 9595 and is used by the administration web interface.

    server {
        listen       9595;
        server_name  _;
        location / {
            root   /var/www/postmin;
            index  index.php index.html index.htm;
        }
        location ~ \.php$ {
            root   /var/www/postmin;
            try_files $uri =404;
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }
        location ~ /\.ht {
            deny all;
        }
    }

Next create the file `/etc/nginx/conf.d/webmail.conf` and put the following
contents inside. This creates the listening http server on port 80 for the
webmail.

    server {
        listen       80;
        server_name  webmail.example.com;
        location / {
           root   /var/www/webmail;
           index  index.php index.html index.htm;
       }
       location ~ \.php$ {
            root   /var/www/webmail;
            try_files $uri =404;
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }
        location ~ /\.ht {
            deny all;
        }
    }

