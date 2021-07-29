# Full Score Events

Full Score Events is a WordPress plugin that allow band programs schedule events for their performances, meetings, rehearsals, and more with unique features tailored for the activities of an athletic or concert ensemble:

## Schedules

Create beatifully formatted, single or multi-day schedules that clearly communicate when certain parts of an event, performance, game, or trip are to take place. A PDF version of the schedule can be uploaded by an editor and downloaded by a viewer with a button at the bottom of the schedule.

Schedule items can be written with basic formatting and contain bulleted/numbered lists in case additional details or materials need to be listed out. 

Callouts with "info", "success", "warning", and "error" formats can also be added to the schedule for more visible notices, such as an event cancellation or important reminder.

## Concert Programs

Full-fledged digital concert programs can be added to any event, post, or page on your website. Multiple ensembles can be put on a program for joint concerts, along with director, conductor, and guest conductor information. Pieces can be added under each program heading with a title, composer, arranger, and a featured or guest conductor/soloist/etc.

## Staff Members

Staff members can be added to your site for:

1. Full profile viewing (individual staff member view)
2. Faculty/staff page listings
3. An event's primary contact

Each staff member can have a photo, position, phone number, email address, and bio with full-fledged block editor contents.

## Events

Full Score Events has all of the standard event date/time/location features, but is especially capable for band programs because:

1. Event times can be set to "TBA" or have their end time not displayed in case certain events don't have a probable finish, such as a football game.
2. A ticket or registration link can be added to the event's header and can be linked either internally or externally, and optionally display a unit price.
3. Event description editing is done with the full block editor, allowing the addition of concert programs, schedules, staff members, and the other media/text blocks available on your site.
4. Events can be flagged as "featured" and stay at the top of the events listing page
5. Ensembles can be added to the site and have events assigned to them. "Events" blocks are available in the editor and can be filtered down to one or more ensembles.
6. Events can be assigned a "primary contact" staff member and have their contact contact information and photo displayed in the event's sidebar.
7. Events can be limited to views specifically filtered down to the ensembles added to the event. This is helpful for events that shouldn't be in the main listing, but should be in an upcoming events block for a specific ensemble.
8. The Event archive/listing page colors and header background can be adjusted in the customizer.

## Seasons

Seasons can be added to the website, which are given a title and start date to help "break down" your main event listing into groups of time, such as semesters. This allows headings to be added to the events listing for "Spring 2021", "Summer 2021", "Fall 2022", etc to be added.

-----

# Contributing

1. Install NPM dependencies: `npm install`
1. Install untracked composer dependencies: `composer install`
1. Install PHPCS languages: `composer run-script install-codestandards`
1. Configure PHPCS linting in your editor so you don't have to rely only on the `phpcs` composer script

## VS Code

To get PHP code linting, install the [phpcs extension](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs). You may already have this for `wprig`-based development. After that, `./vscode/settings.json` should automatically get VS Code linting your PHP files, checking them with WordPress coding standards. You may need to restart VS Code for this to work properly, especially if you had to change a configuration setting or activate a new extension.

For JavaScript code linting, install the [ESLint extension](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint). It should see the rules configured by `.eslintrc`'s and lint your JS.

## Other Editors

PHP_CodeSniffer (PHPCS) and ESLint are extremely common utlities that should have compatibility or extensions for all the major editors. As long as the instructions are there (`.eslintrc`, `.eslintignore`, `phpcs.xml.dist`, etc), any major editor should be able to do inline code linting.

## Building

1. Build your plugin functionality
1. Run `composer run-script phpcs` to make sure your PHP code is up to WordPress standards. This is expecially important if you don't have linting built in to your editor.
