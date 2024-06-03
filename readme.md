# Gate Keeper API 

I build this API to display my knowledge on PHP, Symfony, SOLID, Docker, MySql technologies. The project is basically a game, you register, login, and 
access rest of the pages with JWT Token. You can create Character, upgrade character stas, and start adventuring with your character. Travel to different 
places, encounter enemies and avoid get ambushed, level up, and find items which you can add to your inventory. Bit by bit increase the strength of your 
character. You can have multiple characters.

## Prerequisites
To run project:
- Docker
- Docker Compose

For working with the project:
- PHP 8.2
- Composer
- Symfony v7 (or newer)

## Getting Started
1. Clone the project `git clone [project-git-url] [project-name]`

## Environment Variables
### Authentication
This project requires a JWT passphrase for generating and verifying JWTs. The passphrase is set using the JWT_PASSPHRASE environment variable. It is crucial to keep this passphrase secure, as anyone with access to it could sign their own JWTs.
1. Add JWT_PASSPHRASE to `.env.local` file. Generate a good passphrase (`JWT_PASSPHRASE=come-up-with-your-key`)
2. Generate JWT public and private keys: `php bin/console lexik:jwt:generate-keypair`


## Starting up the project in docker
1. Build docker container `docker-compose build`
2. Spin up docker container `docker-compose up`
3. Install dependencies, run `composer install` inside docker container
4. Get database up to date, run `php bin/console doctrine:migrations:migrate`
4. Visit http://localhost:8001/