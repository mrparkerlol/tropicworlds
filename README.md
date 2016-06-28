# TropicWorlds source code
Source code for a basic chat application containing code for registration, login and chat.

# Needs work!
This will not run right out of the box!
- Regisration most likely needs work
- The chat portion of the site needs to be re-written
- This project contains really bad practices in general (such as using cURL instead of a direct connection to the mysql server using an internal IP address), and is highly insecure (unless you were to rewrite the majority of it)

If you really want this to work, here is the basic set up:
- Have two servers
- Each running Apache or something with Apache-like .htaccess files

Optional configurations:
- One server with Apache's Virtual Host feature to host both sites (api and website)
- Convert all cURL requests to MySQL queries
- MariaDB was used with Nginx (nginx doesn't like Ubuntu 16.04 that much from testing with my blog)
- You could also use LSWS if you just want to easily use the .htaccess file provided (not really good for high traffic unless you're an IT pro and have used LSWS extensively)
- Node.js was used with Ubuntu 15.04 (better performance than other servers for some reason)
- NPM was also installed as a package manager for Node
- All accounts hosting anything facing the public were hosted on accounts w/o root privileges, for the sake of security (like there was any)
- These servers were hosted on DigitalOcean, but you could use a cheaper host such as OVH if needed (works fine, just if latency/speed bothers you that much they are both good hosts, netowork is something you should look at if you're worried about speed of the website)

The chat server uses Node.js, so you will need to install that. This project supports PHP 7, and is really fast when paired with a good server.

- The chatty server works really well with Ubuntu 15.04 LTS speed wise for some reason (it doesn't perform well with CentOS - and believe me I tried and it sucked)
- The chatty server most likely will work with any stable version of Node

# Prerequisites for Chatty (chat server)
- MySQL module must be installed for it to communicate with MySQL
- socket.io needs to also be installed for sockets

Chatty was in the middle of converting over to cURL requests for everything, so it is best to use it as a template but don't just modify it and run it, you will need a re-write for it to function the way you like it (the code base is such a mess, which is why I recommend only using the one I provided as a sample of what to do).

The re-write should be easy if you understand callbacks and how hellish they can be (that is why I am providing this). This is also a sample of how not to write a project that was supposed to be in production.

# Use of this is at your own risk
I have no responsibilites if you somehow get hacked or something else horrifying because of using this. This was only provided as a sample of how to make a chat application with PHP, Node, and MySQL with a chat filter.
