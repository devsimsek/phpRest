#!/bin/bash
# Copyright devsimsek
# https://github.com/devsimsek/phpRest
latest_zipball=https://api.github.com/repos/devsimsek/phpRest/zipball
installer_log=phpRest_installer.log
defdir=phpRest
version="1.4"
ghdir=devsimsek-phpRest-*
clear
spinner() {
  local pid=$!
  local delay=0.75
  local spinstr='|/-\'
  while [ "$(ps a | awk '{print $1}' | grep $pid)" ]; do
    local temp=${spinstr#?}
    printf "$1 [%c]  " "$spinstr"
    local spinstr=$temp${spinstr%"$temp"}
    sleep $delay
    printf "\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b\b"
  done
  printf "Done...    \b\b\b\b"
}
clear
echo "              __                            __  "
echo "   ____ ___  / /_____  _________ ___  _____/ /__"
echo "  / __ ´__ \/ __/ __ \/ ___/ __ ´__ \/ ___/ //_/"
echo " / / / / / / /_/ / / (__  ) / / / / (__  ) ,<   "
echo "/_/ /_/ /_/\__/_/ /_/____/_/ /_/ /_/____/_/|_|  "
echo "Welcome To the svcs phpRest v"$version" installer"
echo "Warning! Installation Will Be Begin In 5 Seconds"
sleep 5
echo $(date +'%m/%d/%Y:%R') ": ---------------Start Installer Log---------------" >>$installer_log
echo $(date +'%m/%d/%Y:%R') ": Checking" $defdir "Directory" >>$installer_log
if [ ! -d "$defdir" ]; then
  echo $(date +'%m/%d/%Y:%R') ": " $defdir "Directory Not Found. Creating..." >>$installer_log
  mkdir $defdir
  cd $defdir
  echo $(date +'%m/%d/%Y:%R') ": "$defdir "Directory Created. Starting Git Clone Process..." >>$installer_log
  (wget -q -c $latest_zipball -O temp.zip) &
  spinner "Downloading phpRest..."
  (unzip temp.zip && rm temp.zip) &
  spinner "Setting Up Files..."
  cd $ghdir
  mv * ../
  cd ../
  rm -rf $ghdir
  cat >".htaccess" <<-"EOF"
DirectoryIndex index.php

# enable apache rewrite engine
RewriteEngine on

# set your rewrite base
# Edit this in your init method too if you script lives in a subfolder
RewriteBase /

# Deliver the folder or file directly if it exists on the server
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

# Push every request to index.php
RewriteRule ^(.*)$ index.php [QSA]
EOF
  cd ../
  chmod +x $defdir
  echo $(date +'%m/%d/%Y:%R') ": Installation Finished. User Can Start Application With cd $defdir && php -S localhost:6107 in terminal..." >>$installer_log
  echo "\n"
  echo $(date +'%m/%d/%Y:%R') ": Installation Finished. You Can Start Application With cd $defdir && php -S localhost:6107 in terminal..."
else
  echo "Files Exists. Killing Connection..."
fi
