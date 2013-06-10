#!/bin/sh
PERCENT=$1
USER=$2
cat << EOF | /usr/lib/dovecot/dovecot-lda -d $USER -o "plugin/quota=dict:user quota::noenforcing:proxy::quotadict"
From: postmaster@your_domain.com
Subject: SYSTEM MESSAGE: Quota warning!

Your mailbox is now $PERCENT% full. If your mailbox reaches 100% full ALL new messages will be rejected back to the sender.
EOF
