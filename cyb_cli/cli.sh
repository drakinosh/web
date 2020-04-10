#!/bin/bash

# so as to not pollute bash history

comm="X"

while [[ $comm != "QUIT" ]]
do
    echo "[inp]> "
    read comm a b c

    if [[ $comm == "VIEW" ]]; then
        python view.py "$a" "$b"
        
    
    elif [[ $comm == "POST" ]]; then
        echo $c
        python post.py "$a" "$b" "$c"
    fi
done
