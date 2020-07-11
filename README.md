# asterisk_scripts

Script region_parser.php pars codes from RU numbers database html files: https://rossvyaz.gov.ru/deyatelnost/resurs-numeracii/vypiska-iz-reestra-sistemy-i-plana-numeracii

Copy script region_parser.php into the same directory and run script

wget -N https://rossvyaz.gov.ru/data/DEF-9xx.html

wget -N https://rossvyaz.gov.ru/data/ABC-8xx.html

wget -N https://rossvyaz.gov.ru/data/ABC-4xx.html

wget -N https://rossvyaz.gov.ru/data/ABC-3xx.html

php region_parser.php

Script works for PHP 7.X version

