# Secret Republic - Browser Based Hacker Themed Text Game- Alpha V4


![Cover](images/cover.jpg)

<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a>

# Live Demo

Live demo: http://secretrepublic.nenuadrian.com

# Read about the journey

https://medium.com/@adrian.n/secret-republic-open-sourced-hacker-simulation-futuristic-rpg-browser-based-game-php-843d393cb9d7

# Overview

Audio trailer: https://www.youtube.com/watch?v=6thfiGb-b7c

The code for the Secret Republic hacker simulation role playing browser text game.

A lot of work has gone into this but it (and more in its previous version) is not a documented (as of yet) project.

It's been through years of development with this being its 3rd full do-over.

However, the project on stand-by so I've decided to make the source available of nothing else

Read more about the history of the game and the more complete older version in the works for open sourcing @ https://medium.com/@adrian.n/secret-republic-open-sourced-hacker-simulation-futuristic-rpg-browser-based-game-php-843d393cb9d7

# Main Features

1. Audio AI (woman, same as trailer) voice speaks when interacting with the game

2. Futuristic minimalistic Bootstrap-based UI, mobile ready, made to feel like an app

3. Point and click based missions with servers of multiple types (file servers, email and database)

4. In-game Mission designer with BBCode like syntax features

5. Upgradable knowledge & skills

6. Rewards system


# Setting up

You need a webserver (e.g. MAMP/WAMP) able to run PHP (work with 7.3) and an MySQL database (LAMP stack).

1. Import db.sql into a fresh MySQL db.

2. cp fuel/app/config/db.template fuel/app/config/db.php and add your DB details.

3. cp fuel/app/config/config.template fuel/app/config/config.php and configure it if you want.

4. cp fuel/app/config/email.template fuel/app/config/email.php and configure it if you want to setup email sending.

5. Run 'composer install' (you may need to install the composer PHP deppendency management tool).

6. Create an account through the signup form and set your group to 2 in the 'user' DB table in order to become a Cardinal (admin).

# Cron jobs

You may want to setup cron tasks to run the following pages once in a while

your-url/cron/rankings

your-url/cron/emails

e.g.

*/2 * * * * wget -O - http://localhost/cron/emails >/dev/null 2>&1

https://en.wikipedia.org/wiki/Cron

# Screenshots

![Screenshot](images/1.png)

![Screenshot](images/2.png)

## Skills
![Screenshot](images/3.png)

## Knowledge base
![Screenshot](images/4.png)

## Missions (there are email, database and file based servers which can be used to design different puzzles)
![Screenshot](images/5.png)

![Screenshot](images/6.png)

## Simple rankings
![Screenshot](images/7.png)

## Mission designer
![Screenshot](images/8.png)

![Screenshot](images/9.png)

## Rewards
![Screenshot](images/10.png)

## Edit account
![Screenshot](images/11.png)


# Travelling through time - V1

![Screenshot](images/original1.jpg)

![Screenshot](images/original2.png)



# License

<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a>

Please link and contribute back to this repository if using the code or assets :)


# SecretAlpha V3 ( MORE FEATURES! )

I would recommend you try to run both versions or at least throw an eye on both repositories. V3 is much older, less organized and not respecting of any patterns what-so-ever in code, mostly based on a framework written from scratch, but I've refactored some dependency management into it.

Find version 3 here: https://github.com/nenuadrian/Secret-Republic-Hacking-Browser-Game-V3

The repository you are on now, V4, is much more easy to setup.