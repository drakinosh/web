#!/bin/bash

# so as to not pollute bash history

# example POST o 72 "What the \nHell?"
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
        python post.py "$a" "$b" "$c"
        echo "$a | $b | $c " >> $HISTFILE

    elif [[ $comm == "CLEAR" ]]; then
        clear
        clear
        clear
        clear
        clear
    fi
done
