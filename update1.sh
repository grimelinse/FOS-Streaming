#!/bin/bash
# Tested on Ubuntu Ubuntu 14.04 and 15.04
# feel free to ask me if you have any question sevan@tyfix.nl 
# git clone https://github.com/zgelici/FOS-Streaming.git
# Install chmod 755 update1.sh && ./update1.sh

echo "##UPDATE##"
rm -r /usr/src/FOS-Streaming
cd /usr/local/nginx/html
mv /usr/local/nginx/html/config.php /tmp/
rm -r /usr/local/nginx/html/*
cd /usr/src/
git clone https://github.com/zgelici/FOS-Streaming.git
cd /usr/src/FOS-Streaming/
mv /usr/src/FOS-Streaming/* /usr/local/nginx/html/
mv /tmp/config.php /usr/local/nginx/html
cd /usr/local/nginx/html/
php /usr/src/composer.phar install
mkdir /usr/local/nginx/html/hl
chmod -R 777 /usr/local/nginx/html/hl
mkdir /usr/local/nginx/html/cache
chmod -R 777 /usr/local/nginx/html/cache
echo "Update finshed"
