#!/bin/bash
echo "Select Action:"
echo "1) Scrape"
echo "2) Add"
echo "3) Search/Remove"

read n
case $n in
	1)./scrape.sh
		;;
	2) ./add.sh;;
	3) ./search.sh ;;
	*) echo "Invalid function";;
esac