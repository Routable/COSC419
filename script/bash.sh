#!/bin/bash
# Author: Steven Bucholtz, without pride | 300168447
# Completes the installation instructions for COSC419_LAB1 as per https://github.com/MattFritter/COSC419_Lab1/blob/master/README.md,
# although it happens in a somewhat unorthodox manner. 

# Instructions: Copy the script folder into the project directory. Change directory into /script, and
# execute it via sh script.sh. Please make sure that the other two files are present in the folder
# prior to executing this script. I do stop twice to make sure the user acknowledges this, but
# I don't do any proper error checking because I couldn't be bothered - by running this file, 
# you have acknowledged these terms!

# Save directory of script execution for later use. Primarily to move files. 
start=$(pwd) 

echo -e ''
echo -e '  _________ __                                        _____                                             '
echo -e ' /   _____//  |_  _______  __ ____   ____   ______   /  _  \__  _  __ ____   __________   _____   ____  '
echo -e ' \_____  \\   __\/ __ \  \/ // __ \ /    \ /  ___/  /  /_\  \ \/ \/ // __ \ /  ___/  _ \ /     \_/ __ \ '
echo -e ' /        \|  | \  ___/\   /\  ___/|   |  \\___ \  /    |    \     /\  ___/ \___ (  <_> )  Y Y  \  ___/ '
echo -e '/_______  /|__|  \___  >\_/  \___  >___|  /____  > \____|__  /\/\_/  \___  >____  >____/|__|_|  /\___  >'
echo -e '        \/           \/          \/     \/     \/          \/            \/     \/            \/     \/ '
echo -e '__________               .__        _________            .__        __                                  '
echo -e '\______   \_____    _____|  |__    /   _____/ ___________|__|______/  |_                                '
echo -e ' |    |  _/\__  \  /  ___/  |  \   \_____  \_/ ___\_  __ \  \____ \   __\                               '
echo -e ' |    |   \ / __ \_\___ \|   Y  \  /        \  \___|  | \/  |  |_> >  |                                 '
echo -e ' |______  /(____  /____  >___|  / /_______  /\___  >__|  |__|   __/|__|                                 '
echo -e '        \/      \/     \/     \/          \/     \/         |__|  '
echo -e ''

echo "Starting Laravel installation script. Your current directory is $start."
yum update
yum-complete-transaction --cleanup-only
yum install nano git
yum install httpd
systemctl enable httpd.service
systemctl restart httpd.service
yum install https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
yum install http://rpms.remirepo.net/enterprise/remi-release-7.rpm
read -n 1 -s -r -p "Before continuing please make sure the remi-php72.repo file is found inside the script folder. Press any key to continue..."
echo ""
cp remi-php72.repo /etc/yum.repos.d/
yum install php php-common php-xml php-pdo php-zip php-cli php-mbstring
yum install unzip
cd /var/www
curl -s https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
composer create-project --prefer-dist laravel/laravel cosc419
cd cosc419
curl -L https://github.com/MattFritter/COSC419_Lab1/raw/master/cosc419_db.db > storage/cosc419.db
chgrp -R apache storage bootstrap/cache
chmod -R ug+rwx storage bootstrap/cache
read -n 1 -s -r -p "Before continuing please make sure the httpd.confg file is found inside the script folder. Press any key to continue..."
echo ""
rm /etc/httpd/conf/httpd.conf  #Ran into issues with overwriting file, so I just forcefully remove it before we copy it over.
cp $start/httpd.conf "/etc/httpd/conf/"
systemctl restart httpd.service
semanage fcontext -a -t httpd_sys_content_t "/var/www/cosc419(/.*)?"
semanage fcontext -a -t httpd_sys_rw_content_t "/var/www/cosc419/storage(/.*)?"
semanage fcontext -a -t httpd_sys_rw_content_t "/var/www/cosc419/bootstrap/cache(/.*)?"
restorecon -R -v /var/www/cosc419

FILE=".env"
/bin/cat <<EOM >$FILE
APP_NAME="Steven Bucholtz"  #MODIFY AS NEEDED
APP_ENV=local
APP_KEY=base64:TIHPKt9xtyzKIbpoJ5c48K0D+iXpicHLOAJzyisl/Is=
APP_DEBUG=true
APP_URL=138.197.149.0       #MODIFY AS NEEDED

LOG_CHANNEL=stack

DB_CONNECTION=sqlite
DB_DATABASE=/var/www/cosc419/storage/cosc419.db

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
EOM

printf "Completed. Press any key to quit...\n"
