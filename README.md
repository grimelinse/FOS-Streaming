### Introduction
------------
**FOS-Streaming** -- Free IPTV panel for streaming video content

#### Installation
------------
- login with a shell client(example putty.exe)
```sh
- wget http://tyfix.nl/fos/install.sh
- chmod 755 install.sh
- ./install.sh
```
- **[DATABASE]** Edit your config.php (Database connection)
- **[DATABASE]** Create database tables
- - Normal install (first install) URL: http://host/install.php?install
- - Fresh install (clean database) URL: http://host/install.php?install=fresh
- **[BACKEND]** Go to the website and login with username: admin and password: admin

#### UPDATE(ONLY FOR EXISTS INSTALLATIONS)
Login with a shell client
```sh
- wget http://tyfix.nl/fos/update1.sh
- chmod 755 ./update1.sh
- ./update1.sh
```
#### UPDATE DATABASE(ONLY FOR EXISTS INSTALLATIONS)
Required to update database without losing data
Go to the next urls: 
- http://host/install.php?install (will add new tables)
- http://host/install.php?update (updates your tables)

#### Commercial rights
------------
- You may charge for installation, support and modification.
- You may Any significant modifications must be sent back to the author (me), under Open Source agreement.
- You may not Rename the plugin.
- You may not sell this plugin to anyone.

#### Contribution
------------
Contribution are always **welcome and recommended**! Here is how:

- Fork the repository ([here is the guide](https://help.github.com/articles/fork-a-repo/)).
- Clone to your machine ```git clone https://github.com/YOUR_USERNAME/FOS-Streaming.git```
- Make your changes
- Create a pull request

##### Contribution Requirements:

- When you contribute, you agree to give a non-exclusive license to Tyfix to use that contribution in any context as we (Tyfix) see appropriate.
- If you use content provided by another party, it must be appropriately licensed using an [open source](http://opensource.org/licenses) license.
- Contributions are only accepted through Github pull requests.

#### License
-------
Fos-Streamining is an open source project by [Tyfix](https://tyfix.nl that is licensed under [MIT](http://opensource.org/licenses/MIT). Tyfix
reserves the right to change the license of future releases.


#### Todo List
---------
-  [NEXT UPDATE] expire date
-  [NEXT UPDATE] Bulk playlist insert (m3u)
-  [NEXT UPDATE] Mag devices
-  [NEXT UPDATE] Watermark
-  [NEXT UPDATE] UBUNTU (Streaming issue by some people) PHP?
- Bandwidth monitoring
- removal panel
- users connected
- GEO ip
- Limit users
- Monitoring
- Settings (restart nginx)

#### Issues
----------
- settings.php (HLS folder)
- UBUNTU (Streaming issue by some people) PHP?


#### Change log
----------
- *28-8-2015
- [UPDATE] [BETA] Transcoding
- [UPDATE] Last ip connected
- [UPDATE] Improved streaming
- [UPDATE] h264_mp4toannexb
- [UPDATE] AUTO INSTALL/UPDATE DATABASE
- [UPDATE] Play stream
- *23-8-2015
- [UPDATE] [installation] auto set web ip
- [UPDATE] Displaying warnings en errors (example: users add(create category first message, users view(no users, shows "add users" message)
- [UPDATE] Settings (port change, change nginx config)
- [UPDATE] install database
- [BUG] getfile (m3u and tv fix)
- [BUG] start stream( restream starts ffmpeg ) fixed
- [BUG] Stream.php (Enigma2) fixed


Donations are **greatly appreciated!**

[![Donate](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif "Tyfix ")](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ATJFKYPFY65W "Donate")


