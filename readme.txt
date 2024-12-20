=== Creative WP Login Page ===
Contributors: masoudnkh
Donate link: https://zarinp.al/wpirani.ir
Tags: login page, creative login page, login, login page customizer, custom login
Requires at least: 5.1
Tested up to: 6.7.1
Stable tag: 9.2
Requires PHP: 7.2
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html
 
Creative WordPress login page plugin makes your login page more beautiful.

=== Description ===
This plugin helps you to have a more beautiful login page.
Features of the plugin include adding shadows to the login box, using different styles for the login page, changing fonts, and more.
It will also be added to the plugin in the near future

= Current plugin features =
* Choose login page design from 7 designs
* Ability to adding a security code (captcha) to the login page with two different methods
* Ability to set the login page wallpaper by address or upload
* Change the default WordPress logo to your liking
* Change the logo link to the main page of the site
* Add shadows to the input box
* Change the login page font
* Change login page address
* Displays an error message to the user when the login page changes and the user tries to log in with the default addresses
* Select access error screen design
* Display floating social networks with the ability to open and close
* Remove the language switch button on the login page
* Changing the login page labels
* Managing and adding effects on the login page

== Frequently Asked Questions ==
= How to configure the plugin? =
* Plugin settings are simple and easy to do. Just enter the CWLP settings section from the WordPress dashboard, and after changing the available options, click Save Settings.
= Are your plugin features limited? =
* No, some parts are limited, but more features and options will be added in future versions of the plugin.

== Installation ==
= Minimum Requirements =

* WordPress 5.1 or greater
* PHP version 7.2 or greater
* MySQL version 5.0 or greater

= Installation =
1. Install using the WordPress built-in Plugin installer, or Extract the zip file and drop the contents in the `wp-content/plugins/` directory of your WordPress installation.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to CWLP Settings > configure any available options > save settings
4. You can now view the changes made to the login page by going to your site login page

== Screenshots ==
1. **Custom Login Page Preview.** (RTL).
2. **Custom Login Page Preview.** (LTR).
3. **General Settings Tab.** (RTL)
4. **General Settings Tab.** (LTR)
5. **Change Login URL Settings **Change wp-admin Address with Display Message (RTL)
6. **Change Login URL Settings **Change wp-admin Address with Display Message (LTR)
7. **Change Login Form Position**
8. **Login Form Captcha Settings**
9. **Change Login Form Text Settings**

== Changelog ==
= 9.2 - 2024-12-01 =
* Fixed: Interference with REST API and PHP Active Session
* Improving the security of CAPTCHA codes

= 9.1 - 2024-12-01 =
* Fixed: login form size issue when default style and captcha are enabled
* Fixed: Changing the keyboard to numbers when a simple math captcha is enabled and the user is trying to solve the math problem to prevent text entry.
* Fixed: some css problems in social icons and close icon you reported
* Performance improvement: Remove unused icons
* Change: twitter icon with X icon
* UI Improvement: Apply the plugin's default font to some plugin fields
* Minor changes to the settings interface
* CAPTCHA Improvement: Changed the display of simple math captcha when a math subtraction problem is displayed and the user has to calculate with a negative number below 0, such as 5 minus 6 which is -1. (Now only small numbers are subtracted from large numbers)
* Performance improvement: Changed the ability to add simple text as an error message in the "Login Security" section to adding advanced text such as bold text, links, etc.
* Ability to change the "Solve this" text when simple math captcha is enabled

= 9.0 - 2024-11-18 =
* Improved user interface
* Switch between settings tabs without changing the page
* Added the possibility of adding a security code (captcha) to the login page with two different methods
* Optimization of plugin codes
* Remove additional codes from the plugin
* Fix the problems you reported
* Change tab icons
* Improved performance of deleting plugin settings from the database when deleting the plugin
* Compatibility with WP version 6.7

= 8.0 - 2024-01-15 =
* Add: New Login page effect ( Wandering balloon )
* Add: Option to change how to display social icons
* Fix: Square bubble and Circle bubble effect ( CSS )
* Fix: Some small problems you reported
* Improve: Performance and Security
* Optimize: Some PHP and JS codes

= 7.7 - 2023-02-21 =
* Disable redirect to plugin settings after installation
* Remove fontawesome ttf file for reduce plugin size

= 7.6 - 2023-02-15 =
* Fix: some css issues you reported

= 7.5 - 2023-01-28 =
* Add: Option to choose login form position
* Improve : translation
* Improve : some setting style
* Fix: persian font for some element in setting page
* Optimize: Some images and replace with webp format

= 7.4 - 2023-01-11 =
* Fix : PHP warning

= 7.3 - 2023-01-10 =
* Fix style image not show

= 7.2 - 2023-01-10 =
* Fix: PHP Warning Empty needle
* Improve: plugin performance
* Improve: some plugin settings UI
* Add: setting save button to top
* Add: submenu for quickly access to settings

= 7.1 - 2023-01-04 =
* Fixed the problem of white space when the effect is active

= 7.0 - 2023-01-03 =
* Improving the functionality of the plugin and fixing some reported bugs
* Added new style: educational
* Added a new section: changing the login page labels
* Added a new section: managing and adding effects on the login page

= 6.0 - 2022-05-25 =
* Added a login security section to change the admin address to your liking
* Ability to display the message when the user logs in with the default WordPress URLs
* Ability to choose error screen design between 3 designs
* Go to the plugin settings page after activating the plugin
* Improved and added new translations
* Fixed some issues in the social networking widgets section
* Improved plugin performance
* Improved compatibility with WordPress version 6

= 5.1 - 2022-05-20 =
* Added new style : Technology
* Fix some problem in custom background image
* Update plugin translate

= 5.0 - 2022-05-14 =
* Add option to select background image via upload or URL
* Change the appearance of the settings page
* Improved Elementor compatibility
* Compatibility with WordPress version 6
* Fixed some issues and improved plugin performance

= 4.1 - 2022-03-07 =
* Fix eroor with php 7.2 and older

= 4.0 - 2022-01-30 =
* Added an option to remove the language change section found in WordPress version 5.9

= 3.4 - 2022-01-29 =
* More compatibility with wordpress 5.9

= 3.3 - 2022-01-28 =
* Compatibility with wordpress 5.9

= 3.2 - 2022-01-19 =
* Change readme file and tested up to wordpress 5.8.3

= 3.1 - 2021-12-29 =
* Fix Undefined variable $opt on php v8

= 3.0 - 2021-10-08 =
* Fix the link of the settings button below the plugin name in the WordPress plugins section.
* Fix jQuery not defined error in login page.
* New ability: Now you can upload your custom logo to replace with default wordpress logo in login page.
* Optimized CSS plugin settings page
**IMPORTANT** For optimal database, the new version comes with a complete delete option. If you remove the plugin completely from your site, all tables created by the Creative WP login page plugin will also be removed.
 
= 2.0 - 2021-10-04 =
* New plugin setting page design ( add tabbed content )
* New feuture: Floating social toolbar widget
* Update Language strings

= 1.0 - 2021-09-29 =
* First Release


== Upgrade Notice ==
= 9.2 =
* Fixed: Interference with REST API and PHP Active Session
* Improving the security of CAPTCHA codes