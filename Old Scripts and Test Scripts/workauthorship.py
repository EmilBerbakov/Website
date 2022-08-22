#Let's take the House of Lords Official Report as an example:
#"authors": [{"type": {"key": "/type/author_role"}, "author": {"key": "/authors/OL2656742A"}}]

#How this works is, json.get("authors")[i].get('author')['key'].  This gets the ith author
#Let's try this with a harder option, Dangerous Women

import ujson as json

test='{"description": "This volume of warriors, bad girls and dragonriders includes stories by worldwide bestselling authors. This first volume includes an original 35,000 word novella revealing the origins of the civil war in Westeros (before the events in *A Game of Thromes*.)", "covers": [7319594, 8536584, 8538455, 8789944, 9328606, 10317207, 8737286, 9145977, 9391518], "key": "/works/OL17079158W", "authors": [{"author": {"key": "/authors/OL9124970A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL28029A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL2701732A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL5152266A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL2711187A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL19593A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL395837A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL21255A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL1394865A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL221880A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL391079A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL221112A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL835707A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL531502A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL589683A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL21915A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL7481824A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL20965A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL7342959A"}, "type": {"key": "/type/author_role"}}, {"author": {"key": "/authors/OL2801083A"}, "type": {"key": "/type/author_role"}}], "title": "Dangerous Women", "subjects": ["Fantasy", "Fiction", "English Fantasy fiction", "American Fantasy fiction", "Short stories, american", "Short stories, english", "Women", "Fate and fatalism", "General", "Short stories", "FICTION / Fantasy / General", "Fiction, fantasy, general", "American Short stories", "Fiction, fantasy, collections & anthologies", "Fantasy fiction"], "type": {"key": "/type/work"}, "links": [{"title": "Goodreads", "url": "https://www.goodreads.com/book/show/17279560-dangerous-women?from_search=true&from_srp=true&qid=cSagVTakkO&rank=1", "type": {"key": "/type/link"}}], "latest_revision": 21, "revision": 21, "created": {"type": "/type/datetime", "value": "2015-01-05T20:18:54.628732"}, "last_modified": {"type": "/type/datetime", "value": "2022-03-21T09:27:04.651430"}}'

test2=json.loads(test)
try:
    test3=test2.get("authors")
    test6=test2.get('key').split('/')[-1]
except:
    print('dne')
try:
    for i in range(len(test3)):
        test5=test2.get('authors')[i].get('author')['key'].split('/')[-1]
        print(test6,test5)
except:
    print('bad')


