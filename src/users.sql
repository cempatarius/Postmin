-- Postmin user creation commands. --
CREATE USER 'postmin'@'localhost' IDENTIFIED BY 'chAnGEme';
GRANT INSERT,SELECT,UPDATE,DELETE ON postmin.* TO 'postmin'@'localhost';

-- Spamassassin user creation commands. --
CREATE USER 'spamd'@'localhost' IDENTIFIED BY 'chAnGEme';
GRANT SELECT ON postmin.userpref TO 'spamd'@'localhost';
GRANT INSERT,SELECT,UPDATE,DELETE ON postmin.awl TO 'spamd'@'localhost';
GRANT INSERT,SELECT,UPDATE,DELETE ON postmin.bayes_expire TO 'spamd'@'localhost';
GRANT INSERT,SELECT,UPDATE,DELETE ON postmin.bayes_global_vars TO 'spamd'@'localhost';
GRANT INSERT,SELECT,UPDATE,DELETE ON postmin.bayes_seen TO 'spamd'@'localhost';
GRANT INSERT,SELECT,UPDATE,DELETE ON postmin.bayes_token TO 'spamd'@'localhost';
GRANT INSERT,SELECT,UPDATE,DELETE ON postmin.bayes_vars TO 'spamd'@'localhost';

-- Postfix readonly user creation commands. --
CREATE USER 'postfix_ro'@'localhost' IDENTIFIED BY 'chAnGEme';
GRANT SELECT ON postmin.aliases TO 'postfix_ro'@'localhost';
GRANT SELECT ON postmin.access TO 'postfix_ro'@'localhost';
GRANT SELECT ON postmin.domains TO 'postfix_ro'@'localhost';
GRANT SELECT ON postmin.mailboxes TO 'postfix_ro'@'localhost';
GRANT SELECT ON postmin.smarthosts TO 'postfix_ro'@'localhost';
GRANT SELECT ON postmin.transports TO 'postfix_ro'@'localhost';
GRANT SELECT ON postmin.aliasdomains TO 'postfix_ro'@'localhost';

-- Dovecot user creation commands. --
CREATE USER 'dovecot'@'localhost' IDENTIFIED BY 'chAnGEme';
GRANT INSERT,SELECT,UPDATE,DELETE ON postmin.expires TO 'dovecot'@'localhost';
GRANT INSERT,SELECT,UPDATE,DELETE ON postmin.quota TO 'dovecot'@'localhost';
GRANT SELECT ON postmin.mailboxes TO 'dovecot'@'localhost';

-- opendkim user creation commands. --
CREATE USER 'opendkim'@'localhost' IDENTIFIED BY 'chAnGEme';
GRANT INSERT,SELECT,UPDATE,DELETE ON postmin.opendkim TO 'opendkim'@'localhost';
GRANT SELECT ON postmin.domains TO 'opendkim'@'localhost';
