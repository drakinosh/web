#!/usr/bin/env python

import requests, sys
import json


if len(sys.argv) != 3:
    print("Incorrect arguments")
    sys.exit()

board = sys.argv[1]
num = sys.argv[2]

DUMP = False 
SPAM_FILTER = False
CHRONO_ = False
LIM = 500000
URL = "https://cyberland.club/{}/?num={}"
DELIM = "-" * 32
SPAM_LIST = [ "4chenz" ]

if num == "CHRONO":
    CHRONO_ = True

if not CHRONO_:
    resp = requests.get(URL.format(board, num)) 
else:
    resp = requests.get(URL.format(board, LIM))

json_dict = json.loads(resp.text)
sorted_posts = sorted(json_dict, key=lambda d: int(d['id']))
printed_posts = []

if DUMP:
    print(json_dict)

def isPostSpam(post_dict):
    return any(word in post_dict['content'] for word in SPAM_LIST)

def getPostString(post_dict):
    return "ID->{}\nREP->{}\n{}".format(post_dict['id'], post_dict['replyTo'], post_dict['content'])

# to be used only by top-level posts
# attempts to create a chain
def getChildrenList(post_id, sorted_post_list):
    if post_id == None:
        return []

    li = [p for p in sorted_post_list if p['replyTo'] == post_id]
    for x in li:
        li.extend(getChildrenList(x['id'], sorted_post_list))
    
    # guarantee uniqueness
    return sorted(li, key=lambda d: int(d['id']))


def isPostParent(post_dict):
    return post_dict['replyTo'] in [None, "0"]


print("[Requested Posts: {}, Received Posts: {}]".format(num, len(sorted_posts)))

# spam filter
if SPAM_FILTER:
    sorted_posts = [p for p in sorted_posts if not isPostSpam(p)]

# if chrono order
if CHRONO_:
    for post in sorted_posts:
        print(getPostString(post))
        print("")

    sys.exit()

parent_posts = [p for p in sorted_posts if isPostParent(p)]

for p_post in parent_posts:
    printed_posts.append(p_post)
    print(DELIM)
    print(getPostString(p_post))
    print(" ")

    for c in getChildrenList(p_post['id'], sorted_posts):

        # somehow getting duplicate children; investigate later
        if c in printed_posts:
            continue
        printed_posts.append(c)
        print(getPostString(c))
        print("")

    print("\n")


print("Rest of the posts: ")
for p in sorted_posts:
    if p not in printed_posts:
        print(getPostString(p))
        print(" ")

