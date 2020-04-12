#!/usr/bin/env python

# usage
#   python see.py <board> <post id>  <num resp>

import sys, requests
import json

URL = "https://cyberland2.club/{}/?thread={}&num={}"
LIM = "50"

board = sys.argv[1]
pid = sys.argv[2]
if len(sys.argv) < 4:
    num = LIM
else:
    num = sys.argv[3]

def getPostString(post_dict):
    return "ID->{}\nREP->{}\n{}".format(post_dict['id'], post_dict['replyTo'], post_dict['content'])


resp = requests.get(URL.format(board, pid, num))
json_dict = json.loads(resp.text)
sorted_posts = sorted(json_dict, key=lambda d: int(d['id']))

for p in sorted_posts:
    print(getPostString(p))
    print(" ")
