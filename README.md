# Kok (/kɔk/)
[![Build](https://api.travis-ci.com/kokst/kok.svg?branch=master)](https://travis-ci.com/kokst/kok) [![wercker status](https://app.wercker.com/status/447ced6d7708b6f86ef8abd9806cbb17/s/master "wercker status")](https://app.wercker.com/project/byKey/447ced6d7708b6f86ef8abd9806cbb17) [![codecov](https://codecov.io/gh/kokst/kok/branch/master/graph/badge.svg)](https://codecov.io/gh/kokst/kok) [![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fkokst%2Fkok.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2Fkokst%2Fkok?ref=badge_shield)

### Setup
Create a new Kok project by issuing the following commands in your terminal:
```
composer create-project --prefer-dist kokst/kok admin --stability dev
```

```
cd admin
```

```
yarn --no-bin-links
```

```
yarn prod
```


### Development

Mac / Linux:
```
php vendor/bin/homestead make
```

Windows:
```
vendor\\bin\\homestead make
```

Adjust `Homestead.yaml` if necessary

```
vagrant box add laravel/homestead
```

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
php artisan migrate
```

### Xdebug + VS Code

VS Code Extension: [PHP Debug](https://marketplace.visualstudio.com/items?itemName=felixfbecker.php-debug)

```
sudo nano /etc/php/7.3/cli/conf.d/10-opcache.ini
```

```
xdebug.remote_enable = true
xdebug.remote_autostart = true
xdebug.remote_host = 10.0.2.2
xdebug.remote_port = 9000
xdebug.remote_log = /var/log/xdebug.log
xdebug.max_nesting_level = 1000
```

```
sudo service php7.3-fpm restart
```

### License
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2Fkokst%2Fkok.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2Fkokst%2Fkok?ref=badge_large)
