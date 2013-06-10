#!/bin/bash

if [ ! `id -u` -e '0' ]; then
  echo 'You need to be root'
fi

set -e

PASSWORD="$1"

declare -A SELECT

SELECT[access_client]="query = SELECT action FROM access WHERE access = '%s' AND type = 'client' AND active = '1'"

SELECT[access_recipient]="query = SELECT action FROM access WHERE access = '%s' AND type = 'recipient' AND active = '1'"

SELECT[access_sender]="query = SELECT action FROM access WHERE access = '%s' AND type = 'sender' AND active = '1'"

SELECT[transport]="query = SELECT transport FROM transports WHERE domain = '%s'"

SELECT[relay_domains]="query = SELECT action FROM smarthosts WHERE type = 'domain' AND smarthost = '%s' AND active = '1'"

SELECT[relay_recipients]="query = SELECT action FROM smarthosts WHERE type = 'recipient' AND smarthost = '%s' AND active = '1'"

SELECT[domain_maps]="query = SELECT domain FROM domains WHERE domain = '%s' AND active = '1'"

SELECT[mailbox_maps]="query = SELECT maildir FROM mailboxes WHERE username = '%s' AND active = '1'"

SELECT[alias_domain_mailbox_maps]="query = SELECT maildir FROM mailboxes,aliasdomains WHERE aliasdomains.orig_domain = '%d' AND mailboxes.username = CONCAT('%u', '@', aliasdomains.final_domain) AND mailboxes.active = '1' AND aliasdomains.active = '1'"

SELECT[alias_maps]="query = SELECT final_dest FROM aliases WHERE orig_dest='%s' AND active = '1'"

SELECT[alias_domain_maps]="query = SELECT final_dest FROM aliases,aliasdomains WHERE aliasdomains.orig_domain = '%d' AND aliases.orig_dest = CONCAT('%u', '@', aliasdomains.final_domain) AND aliases.active = '1' AND aliasdomains.active = '1'"

SELECT[alias_domain_catchall_maps]="query = SELECT final_dest FROM aliases,aliasdomains WHERE aliasdomains.orig_domain = '%d' AND aliases.orig_dest = CONCAT('@', aliasdomains.final_domain) AND aliases.active = '1' AND aliasdomains.active = '1'"

if [! -f /etc/postfix/sql ]; then
  mkdir /etc/postfix/sql
fi

for i in "${!SELECT[@]}"
do
  echo -e "user = postfix_ro\npassword = $PASSWORD\nhosts = unix:/var/lib/mysql/mysql.sock\ndbname = postmin\n${SELECT[$i]}" > /etc/postfix/sql/$i.cf
done

chmod 750 /etc/postfix/sql
chmod 640 /etc/postfix/sql/*
chown -R root /etc/postfix/sql
chgrp -R postfix /etc/postfix/sql

exit
