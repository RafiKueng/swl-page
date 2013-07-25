lenslabs-page
=============

homepage draft for lenslabs

for local dev
-------------

either use xampp: http://www.apachefriends.org/

or in case of php version 5.4: their dev server:  
`$ cd ~/swl-page`  
`$ php -S localhost:80`  

get php5.4 on debian / ubuntu:  
`$ echo 'deb http://packages.dotdeb.org squeeze-php54 all' >> /etc/apt/sources.list`  
`$ echo 'deb-src http://packages.dotdeb.org squeeze-php54 all' >> /etc/apt/sources.list`  
`$ wget http://www.dotdeb.org/dotdeb.gpg`   
`$ cat dotdeb.gpg | apt-key add -`   
`$ apt-get update`   
`$ apt-get install php5`   
