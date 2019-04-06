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

## About Tomodomo

Tomodomo is a creative agency for magazine publishers. We use custom design and technology to speed up your editorial workflow, engage your readers, and build sustainable subscription revenue for your business.

Learn more at [tomodomo.co](https://tomodomo.co) or email us: [hello@tomodomo.co](mailto:hello@tomodomo.co)

## License & Conduct

This project is licensed under the terms of the MIT License, included in `LICENSE.md`.

All open source Tomodomo projects follow a strict code of conduct, included in `CODEOFCONDUCT.md`. We ask that all contributors adhere to the standards and guidelines in that document.

Thank you!
