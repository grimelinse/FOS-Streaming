#!/bin/bash
# Tested on Ubuntu Ubuntu 14.04 and 15.04
# feel free to ask me if you have any question sevan@tyfix.nl 
# git clone https://github.com/zgelici/FOS-Streaming.git
# Install chmod 755 update1.sh && ./update1.sh

echo "##UPDATE##"
cd /usr/local/nginx/html
mv /usr/local/nginx/html/config.php /tmp/
git fetch origin
git reset --hard origin/master
rm -r /usr/local/nginx/html/cache/*
mv /tmp/config.php /usr/local/nginx/html
chown www-data:www-data /usr/local/nginx/conf
wget https://raw.github.com/JasonGiedymin/nginx-init-ubuntu/master/nginx -O /etc/init.d/nginx
chmod +x /etc/init.d/nginx
update-rc.d nginx defaults
echo "Update finshed."
