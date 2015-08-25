#!/bin/bash
# Tested on Ubuntu Ubuntu 14.04 and 15.04
# feel free to ask me if you have any question sevan@tyfix.nl 
# git clone https://github.com/zgelici/FOS-Streaming.git
# Install chmod 755 install.sh && ./install.sh

PS3='Please enter your choice: '
options=("Install full 32bit" "Install full 64bit" "Quit")
select system in "${options[@]}"
do
    case $system in
        "Install full 32bit")
	    echo "##Update and upgrade system##"
		apt-get update && apt-get upgrade -y
		echo "done"
		echo "##Installing needed files##"
		apt-get install libxml2-dev libbz2-dev libcurl4-openssl-dev libmcrypt-dev libmhash2 -y
		apt-get install libmhash-dev libpcre3 libpcre3-dev make build-essential libxslt1-dev git -y
		apt-get install libssl-dev -y
		apt-get install git -y
		apt-get install apache2 libapache2-mod-php5 php5 php5-mysql mysql-server phpmyadmin php5-fpm unzip -y
		echo "done"
	    echo "##Installing and configuring nginx and the FOS-Streaming panel##"
		 #**************if you already have nginx remove it from this line**************#
		cd /usr/src/
		git clone https://github.com/arut/nginx-rtmp-module.git
		wget http://nginx.org/download/nginx-1.9.2.tar.gz
		tar -xzf nginx-1.9.2.tar.gz
		cd /usr/src/nginx-1.9.2/
		./configure --add-module=/usr/src/nginx-rtmp-module --with-http_ssl_module --with-http_secure_link_module
		make
		make install
		#cp /usr/src/nginx-rtmp-module/stat.xsl /usr/local/nginx
		 #**************NGINX INSTALL END LINE**************#
		rm -r /usr/local/nginx/conf/nginx.conf
		rm -r /usr/src/FOS-Streaming
		cd /usr/src/
		git clone https://github.com/zgelici/FOS-Streaming.git
		cd /usr/src/FOS-Streaming/
		mv /usr/src/FOS-Streaming/nginx.conf /usr/local/nginx/conf/nginx.conf
		mv /usr/src/FOS-Streaming/* /usr/local/nginx/html/
		cd /usr/src/
		wget https://getcomposer.org/installer
		php installer
		cd /usr/local/nginx/html/
		php /usr/src/composer.phar install
		echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffmpeg' >> /etc/sudoers
		echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffprobe' >> /etc/sudoers	
		sed --in-place '/exit 0/d' /etc/rc.local
		echo "sleep 10" >> /etc/rc.local
		echo "/usr/local/nginx/sbin/nginx" >> /etc/rc.local
		echo "exit 0" >> /etc/rc.local
		mkdir /usr/local/nginx/html/hl
		chmod -R 777 /usr/local/nginx/html/hl
		mkdir /usr/local/nginx/html/cache
		chmod -R 777 /usr/local/nginx/html/cache
		### database import
		/usr/local/nginx/sbin/nginx
		echo "done"
            	echo "##Downloading and configuring ffmpeg 32bit##"
		cd /usr/src/
		wget http://johnvansickle.com/ffmpeg/builds/ffmpeg-git-32bit-static.tar.xz
		tar -xJf ffmpeg-git-32bit-static.tar.xz
		cd ffmpeg*
		cp ffmpeg /usr/local/bin/ffmpeg
		cp ffprobe /usr/local/bin/ffprobe
		chmod 755 /usr/local/bin/ffmpeg
		chmod 755 /usr/local/bin/ffprobe
		cd /usr/src/
		rm -r /usr/src/ffmpeg*
		echo "installation finshed."
		echo "go to http://host/phpmyadmin and upload the database.sql file which is located in /usr/local/nginx/html/"
		echo "configure /usr/local/nginx/html/config.php"
		echo "login: http://host:8000 username: admin - password: admin"
		echo "After login go to settings and change web ip port to your public server ip"
		exit
            ;;
        "Install full 64bit")
		echo "##Update and upgrade system##"
		apt-get update && apt-get upgrade -y
		echo "done"
		echo "##Installing needed files##"
		apt-get install libxml2-dev libbz2-dev libcurl4-openssl-dev libmcrypt-dev libmhash2 -y
		apt-get install libmhash-dev libpcre3 libpcre3-dev make build-essential libxslt1-dev git -y
		apt-get install libssl-dev -y
		apt-get install git -y
		apt-get install apache2 libapache2-mod-php5 php5 php5-mysql mysql-server phpmyadmin php5-fpm unzip -y
		echo "done"
	    echo "##Installing and configuring nginx and the FOS-Streaming panel##"
		#**************if you already have nginx remove it from this line**************#
		cd /usr/src/
		git clone https://github.com/arut/nginx-rtmp-module.git
		wget http://nginx.org/download/nginx-1.9.2.tar.gz
		tar -xzf nginx-1.9.2.tar.gz
		cd /usr/src/nginx-1.9.2/
		./configure --add-module=/usr/src/nginx-rtmp-module --with-http_ssl_module --with-http_secure_link_module
		make
		make install
		#cp /usr/src/nginx-rtmp-module/stat.xsl /usr/local/nginx
		 #**************NGINX INSTALL END LINE**************#
		rm -r /usr/local/nginx/conf/nginx.conf
		cd /usr/src/
		git clone https://github.com/zgelici/FOS-Streaming.git
		cd /usr/src/FOS-Streaming/
		mv /usr/src/FOS-Streaming/nginx.conf /usr/local/nginx/conf/nginx.conf
		mv /usr/src/FOS-Streaming/* /usr/local/nginx/html/
		cd /usr/src/
		wget https://getcomposer.org/installer
		php installer
		cd /usr/local/nginx/html/
		php /usr/src/composer.phar install
		echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffmpeg' >> /etc/sudoers
		echo 'www-data ALL = (root) NOPASSWD: /usr/local/bin/ffprobe' >> /etc/sudoers	
		sed --in-place '/exit 0/d' /etc/rc.local
		echo "sleep 10" >> /etc/rc.local
		echo "/usr/local/nginx/sbin/nginx" >> /etc/rc.local
		echo "exit 0" >> /etc/rc.local
		
		mkdir /usr/local/nginx/html/hl
		chmod -R 777 /usr/local/nginx/html/hl
		mkdir /usr/local/nginx/html/cache
		chmod -R 777 /usr/local/nginx/html/cache
		chown www-data:www-data /usr/local/nginx/conf
		wget https://raw.github.com/JasonGiedymin/nginx-init-ubuntu/master/nginx -O /etc/init.d/nginx
        chmod +x /etc/init.d/nginx
        update-rc.d nginx defaults
		### database import
		/usr/local/nginx/sbin/nginx
		echo "done"
               echo "Downloading and configuring ffmpeg 64bit"
		cd /usr/src/
		wget http://johnvansickle.com/ffmpeg/releases/ffmpeg-release-64bit-static.tar.xz
		tar -xJf ffmpeg-release-64bit-static.tar.xz
		cd ffmpeg*
		cp ffmpeg /usr/local/bin/ffmpeg
		cp ffprobe /usr/local/bin/ffprobe
		chmod 755 /usr/local/bin/ffmpeg
		chmod 755 /usr/local/bin/ffprobe
		cd /usr/src/
		rm -r /usr/src/ffmpeg*
		echo "installation finshed."
		echo "go to http://host/phpmyadmin and upload the database.sql file which is located in /usr/local/nginx/html/"
		echo "configure /usr/local/nginx/html/config.php"
		echo "login: http://host:8000 username: admin - password: admin"
		echo "After login go to settings and change web ip port to your public server ip"
		exit
            ;;
        "Quit")
            break
            ;;
        *) echo invalid option;;
    esac
done
