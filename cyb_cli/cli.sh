#!/bin/bash

# so as to not pollute bash history

comm="X"
HISTFILE="hist.txt"
while [[ $comm != "QUIT" ]]
do
    #echo "[inp]> "
    printf "[last: $a]> "
    read comm a b c

    if [[ $comm == "VIEW" ]]; then
        python view.py "$a" "$b"
        
    
    elif [[ $comm == "POST" ]]; then
        echo $c
        python post.py "$a" "$b" "$c"
        echo "$a | $b | $c " >> $HISTFILE
    fi
done
