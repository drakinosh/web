#!/usr/bin/env python

#usage:
#   python post.py t 12 "shiggy costanza"
import sys, requests

if len(sys.argv) != 4:
    print("Incorrect arguments.")
    sys.exit()


board = sys.argv[1]
reply_to = sys.argv[2]
content = sys.argv[3]

print("Content: ", repr(content))
URL = "https://cyberland2.club/{}/".format(board)
param_dict = { 
        'content' : content,
        'replyTo' : reply_to
        }

resp = requests.post(URL, param_dict)
print("Response: ", resp)
