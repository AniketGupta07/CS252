#!/bin/bash
wget -o data.html http://stats.espncricinfo.com/ci/engine/records/averages/batting.html\?class\=2\&current\=2\&id\=6\&type\=team
cat batting.html\?class=2\&current=2\&id=6\&type=team >data.txt
rm -rf batting.html\?class=2\&current=2\&id=6\&type=team data.html
grep -i -A 8 "class=\"data-link\"" data.txt > scrape.txt
awk 'NR % 10 == 1' scrape.txt | cut -d '>' -f3  | cut -d '<' -f1 > name.txt
awk 'NR % 10 == 8' scrape.txt | cut -d '>' -f2  | cut -d '<' -f1 > ave.txt
paste name.txt ave.txt > final.txt
sed  -i -e 's/^/India\t/' final.txt
rm -rf scrape.txt name.txt ave.txt data.txt