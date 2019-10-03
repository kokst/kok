# Kok (/kɔk/)
[![Build](https://api.travis-ci.com/kokst/kok.svg?branch=master)](https://travis-ci.com/kokst/kok) [![wercker status](https://app.wercker.com/status/447ced6d7708b6f86ef8abd9806cbb17/s/master "wercker status")](https://app.wercker.com/project/byKey/447ced6d7708b6f86ef8abd9806cbb17) [![codecov](https://codecov.io/gh/kokst/kok/branch/master/graph/badge.svg)](https://codecov.io/gh/kokst/kok) [![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fkokst%2Fkok.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fkokst%2Fkok?ref=badge_shield)

### Setup
Create a new Kok project by issuing the following commands in your terminal:
```
composer create-project kokst/kok <folder> <release>
```

```
cd <folder>
```

```
yarn --no-bin-links
```

```
yarn prod
```

### Development

Mac:
```
php vendor/bin/homestead make
```

Also make sure that NFS over UDP [is turned on](https://github.com/laravel/homestead/issues/779#issuecomment-363380402).

---

Windows:
```
vendor\\bin\\homestead make
vagrant plugin install vagrant-vbguest
vagrant plugin install vagrant-winnfsd
```

---

Adjust `Homestead.yaml` if necessary

```
vagrant up
```

```
vagrant ssh
```

```
cd code
```

```
artisan migrate
```

### Xdebug + VS Code

VS Code Extension: [PHP Debug](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug)    
Chrome Extension: [Xdebug helper](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc)    
Firefox Extension: [Xdebug Helper](https://addons.mozilla.org/en-US/firefox/addon/xdebug-helper-for-firefox/)

```
sudo nano /etc/php/7.3/cli/conf.d/20-xdebug.ini
```

```
xdebug.remote_enable = true
xdebug.remote_autostart = true
xdebug.remote_host = 10.0.2.2
xdebug.remote_port = 9000
xdebug.max_nesting_level = 1000
```

```
sudo service php7.3-fpm restart
```

### License
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fkokst%2Fkok.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fkokst%2Fkok?ref=badge_large)
