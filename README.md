# Telegram Bot - Nashenas - Havig
This robot telegram source code is the carrot version. In this version, the sender of the incognito message is fully displayed to you

Features
- Full Information of sender
- Request a number
- Request a location
- write about me

# Installation
for install you need to:
- Web server
- SSL/TLS
- PHP
- Bot Token

first you should make **Telegram Bot** with `@botfather` and get `TOKEN` then edit `core.php` and upload to your server . set **webhook** of your bot on this file like:

```sh
curl https://api.telegram.org/bot<TOKEN>/setWebhook?url=https://YOUR DOMAIN/<PATH>/core.php
```   
or with browser open url like this:
```sh
https://api.telegram.org/bot<TOKEN>/setWebhook?url=https://YOUR DOMAIN/<PATH>/core.php
```
you should finally get like this output:
```sh
{"ok":true,"result":true,"description":"Webhook is already set"}
```

be happy :)
