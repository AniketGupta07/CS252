#!/bin/bash
echo "You want to search by:"
echo "  1)Name"
echo "  2)Team"

read n
case $n in
  1) echo "Enter Player Name:"
  		read name
  		cut -f 2 final.txt >tmp.txt
  		grep -ni "${name}" tmp.txt | cut -f1 -d: > lineno.txt
  		while IFS= read -r line; do
		    sed -n ${line}p final.txt
		done < "lineno.txt"
  		rm -rf tmp.txt ;;
  2) echo "Enter Team Name:"
  		read name
  		cut -f 1 final.txt >tmp.txt
  		grep -ni "${name}" tmp.txt | cut -f1 -d: > lineno.txt
  		while IFS= read -r line; do
		    sed -n ${line}p final.txt
		done < "lineno.txt"
  		rm -rf tmp.txt
  		;;
  *) echo "invalid option";;
esac

echo "Do you want to delete the searched entries:"
echo "	1) Yes"
echo "	2) No"
read del
case $del in
	1)
		let cnt=0
		while IFS= read -r line; do
		    line=$(($line - $cnt))
		    sed -i ${line}d final.txt
		    let cnt++
		done < "lineno.txt"
		;;
	*) ;;
esac
