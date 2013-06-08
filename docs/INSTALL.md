Installation
============

These instructions are written for installation on CentOS 6. However other
distributions of Linux will work but instructions may need to be modified.


How to use instructions
-----------------------

For easier readability go [here](http://www.8bitnet.com/postmin/docs/install/)

If a command starts with a `#` it means to run on the command line as root.
If it starts with a `$` it means to run on the command line as normal user.

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

### i686 ###

    # rpm -Uhv http://pkgs.repoforge.org/rpmforge-release/rpmforge-release-0.5.3-1.el6.rf.i686.rpm
    # rpm -Uhv http://dl.fedoraproject.org/pub/epel/6/i686/epel-release-6-8.noarch.rpm
    # rpm -Uvh http://downloads.sourceforge.net/milter-manager/centos/milter-manager-release-1.1.0-0.noarch.rpm

### x86_64 ###

    # rpm -Uhv http://pkgs.repoforge.org/rpmforge-release/rpmforge-release-0.5.3-1.el6.rf.x86_64.rpm
    # rpm -Uhv http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm
    # rpm -Uvh http://downloads.sourceforge.net/milter-manager/centos/milter-manager-release-1.1.0-0.noarch.rpm


Packages
--------

Install the following packages, these should pull in all other dependencies.

    # yum install postfix spamass-milter clamav-milter milter-greylist milter-manager opendkim \
    > mysql mysql-server pyzor dovecot-mysql nginx php-fpm php-cli php-gd php-mysql php-pdo \
    > php rrdtool-ruby


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

Increase the number of worker processes started by nginx, this is important if
the server will have a large amount of users.

    # sed -i 's/worker_process.*$/worker_processes 5;/' /etc/nginx/nginx.conf

Then enable nginx on startup and start the daemon.

    # /sbin/chkconfig nginx on
    # /sbin/service nginx start

php
---

Revert php back to how it used to handle CGI paths.

    # sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/' /etc/php.ini

It is also a good idea to set a default timezone in PHP, this prevents some
warnings/info messages. Replace `timeZone` with a valid timezone, a list can be
found [here](http://php.net/manual/en/timezones.php). Do not forget to escape
any forward slashes.

    # sed -i 's/;date.timezone.*$/date.timezone = "timeZone"/' /etc/php.ini

Set the max size for POSTS and files. 10M is a good size, anything larger and
it should be transfered with a different technology.

    # sed -i 's/post_max_size = 8M/post_max_size = 15M/' /etc/php.ini
    # sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 10M/' /etc/php.ini

php-fpm
-------

This package defaults to running under the `apache` user, this will need changed
as apache is not being used.

    # sed -i 's/user = apache/user = nginx/' /etc/php-fpm.d/www.conf
    # sed -i 's/group = apache/group = nginx/' /etc/php-fpm.d/www.conf

Enable php-fpm on startup and start the daemon.

    # /sbin/chkconfig php-fpm on
    # /sbin/service php-fpm start

mysql
-----

Enable mysql on startup and start the daemon.

    # /sbin/chkconfig mysqld on
    # /sbin/service mysqld start

Run the secure installation script that comes with mysqld.

    # /usr/bin/mysql_secure_installation

Create the database.

    # mysql -u root -p
    mysql> CREATE DATABASE IF NOT EXISTS
        -> postmin DEFAULT CHARACTER SET = 'utf8'
        -> DEFAULT COLLATE = 'utf8_bin';
    mysql> \q

Use `src/postmin.sql` to import table and default data.

    # mysql -u root -p postmin < postmin.sql

Create the required mysql users and set the permissions. Edit the file
`src/users.sql` and replace `chAnGEme` with the correct passwords.

    # mysql -u root -p < users.sql


pyzor
-----

Run pyzor and set the output "homedir", also change the permissions.

    # pyzor --homedir /etc/mail/spamassassin discover
    # chmod og+r /etc/mail/spamassassins/servers


spamassassin
------------

Overwrite `/etc/mail/spamassassin/local.cf` by running the following.

    # cat << EOF > /etc/mail/spamassassin/local.cf
    > user_scores_dsn DBI:mysql:postmin:localhost
    > user_scores_sql_username spamd
    > user_scores_sql_password chAnGEme
    > user_scores_sql_custom_query SELECT preference, value FROM _TABLE_ WHERE username = _USERNAME_ OR username = '\$GLOBAL' or username = CONCAT('%',_DOMAIN_) ORDER BY username ASC
    > auto_whitelist_factory Mail::SpamAssassin::SQLBasedAddrList
    > user_awl_dsn DBI:mysql:postmin:localhost
    > user_awl_sql_username spamd
    > user_awl_sql_password chAnGEme
    > user_awl_sql_table awl
    > bayes_store_module Mail::SpamAssassin::BayesStore::MySQL
    > bayes_sql_dsn DBI:mysql:postmin:localhost
    > bayes_sql_username spamd
    > bayes_sql_password chAnGEme
    > pyzor_options --homedir /etc/mail/spamassassin
    > pyzor_timeout 10
    > EOF

Spamassassin has startup options that need to be changed.

    # sed -i 's/SPAMD.*$/SPAMDOPTIONS="-d -m 5 -x -q -u spamd -g spamd"/' /etc/sysconfig/spamassassin

The AWL plguin is disabled by default lets enable it.

    # sed -i 's/#loadplugin .*::AWL/loadplugin Mail::SpamAssassin::Plugin::AWL/' /etc/mail/spamassassin/v310.pre

By default the spamd user and group are not created.

    # groupadd spamd
    # useradd -g spamd -d /var/lib/spamassassin -s /sbin/nologin spamd

Change the ownership of the spamd users home directory.

    # chown spamd /var/lib/spamassassin

Enable spamassassin startup and start the daemon.

    # /sbin/chkconfig spamassassin on
    # /sbin/service spamassassin start


spamass-milter
--------------

This package allows milter-manager to communicate with spamassassin.

    # echo 'SOCKET="inet:11120@[127.0.0.1]"' >> /etc/sysconfig/spamass-milter

Extra options need modified.

    # echo 'EXTRA_FLAGS="-m -r 15 -u spamd"' >> /etc/sysconfig/spamass-milter

Enable spamass-milter on startup and start daemon.

    # /sbin/chkconfig spamass-milter on
    # /sbin/service spamass-milter start


clamav-milter
-------------

Need to change the socket permissions so that group can use it.

    # sed -i 's/#MilterSocketMode 660/MilterSocketMode 660/' /etc/clamav-milter.conf

Start clamav.

    # /sbin/service clamd start

Update the virus definitions.

    # /usr/bin/freshclam

Start clamav-milter.

    # /sbin/service clamav-milter start


milter-greylist
---------------

Enable greylist and add "safe" defaults.

    # sed -i 's/racl whitelist default/#racl whitelist default\nsubnetmatch \/24\ngreylist 10m\nautowhite 1w\nracl greylist default/' /etc/mail/greylist.conf

Change socket to `660` mode.

    # sed -i 's/socket "\/var\/milter-greylist\/milter-greylist.sock"$/socket "\/var\/milter-greylist\/milter-greylist.sock" 660/' /etc/mail/greylist.conf

Check to see if the `smmsp` group was created. If not create it.

    # groupadd smmsp
    # useradd -g smmsp -d /var/spool/mqueue -s /sbin/nologin smmsp

Change ownership of the `smmsp` users home directory.

    # chown smmsp:smmsp /var/milter-greylist

Enable milter-greylist on startup and start the daemon.

    # /sbin/chkconfig milter-greylist on
    # /sbin/service milter-greylist start


opendkim
--------


milter-manager
--------------

Add groups to the milter-manager user.

    # usermod -G clam -a milter-manager
    # usermod -G smmsp -a milter-manager

Show the configuration to verify it auto detects all the mitlers

    # /usr/sbin/milter-manager -u milter-manager --show-config

The output should look something like the following.

    ...
    define_milter("milter-greylist") do |milter|
      milter.connection_spec = "inet:11122@[127.0.0.1]"
      ...
      milter.enabled = true
      ...
    end
    ...
    define_milter("clamav-milter") do |milter|
      milter.connection_spec = "unix:/var/clamav/clmilter.socket"
      ...
      milter.enabled = true
      ...
     end
    ...
    define_milter("spamass-milter") do |milter|
      milter.connection_spec = "inet:11120@[127.0.0.1]"
      ...
      milter.enabled = true
      ...
    end
    ...

Once that is verified restart `milter-manager`.

    # /sbin/service milter-manager restart

Testing `milter-manager` to verify that it is working.

    # sudo -u milter-manager milter-test-server -s unix:/var/run/milter-manager/milter-manager.sock



