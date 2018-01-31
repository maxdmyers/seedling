# Seedling
A WordPress starter theme based on the lovely Timber library and Bootstrap 4. (Forked from [Branch](https://github.com/JeyKeu/branch))


Features
---
- Timber Library support
- Bootstrap 4 toolkit
- NPM package management 
- Gulp build system
- Browsersync for synchronised browser testing

Dependencies
---
- [Composer](http://getcomposer.org)
- [Node.js](http://nodejs.org)
- [SASS](http://sass-lang.com/install)
- [Gulp CLI](http://gulpjs.com/)
- [Browsersync](https://browsersync.io/)

Setup
---
- Assuming you have installed WordPress, 

   `cd` into `wp-content/themes`

   `composer create-project maxdmyers/seedling your-theme-name`

- Change to the `your-theme-name` directory
- Open `style.css` and modify theme name, description and author
- Edit `gulpfile.js` and set `devUrl` to your local WordPress URL
- Run `gulp`
