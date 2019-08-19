#!/bin/bash
echo "Enter player name:"
read name
echo "Enter team name:"
read team
echo "Enter Average:"
read ave
occ=$(grep -ciP "$team\t$name" final.txt)
if [[ $occ -gt 0 ]]; then
	echo "Entry already exits, Do you want to replace it?"
	echo "1) Yes"
	echo "2) No";
	read n
	case $n in
		1)	line=$(grep -niP "$team\t$name" final.txt | cut -f1 -d:)
			sed -i ${line}d final.txt
			echo -e $team'\t'$name'\t'$ave>>final.txt;
			;;
		*) ;;
	esac
else
	echo -e $team'\t'$name'\t'$ave>>final.txt;
fi
