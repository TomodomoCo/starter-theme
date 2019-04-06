# Starter Theme

A modern starter theme for WordPress, powered by magic.

This repository provides a standalone theme implementation, which is to say that the theme can be bundled into a zip file that functions in isolation and can be uploaded into a WordPress installation without additional work.

If you are building a theme in the context of a "WordPress-as-an-application" environment, this repo is probably not for you.

## Installation

For development:

1. `git clone git@github.com:TomodomoCo/starter-theme.git theme && cd theme`
2. `nvm install && nvm use`
3. `npm install && npm run dev`
4. `composer install`

Building for propduction:

1. `git clone git@github.com:TomodomoCo/starter-theme.git theme && cd theme`
2. `make bundle` (generates zip file for upload to WordPress)
