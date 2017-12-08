=== Shift8 Full Nav ===
Contributors: shift8 
Donate link: https://www.shift8web.ca
Tags: sticky navigation, sticky nav, full width nav, sticky menu, full width menu, modal menu, full screen modal menu, full screen modal navigation, full screen nav, css navigation,responsive sticky nav, responsive sticky navigation, responsive sticky menu, responsive menu, responsive nav,responsive,navigation,menu
Requires at least: 3.0.1
Tested up to: 4.8
Stable tag: 1.40
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

This plugin implements a very simple and clean sticky navigation bar. The navigation is fully responsive and the mobile version of the menu has a full screen modal drop down effect. 

== Description ==

[Shift8](https://www.shift8web.ca) Full Nav is a plugin that allows you to create a full width, sticky and responsive navigation menu. The plugin allows you to define key design options such as menu color, google fonts for menu options, overlay color (for mobile dropdown) and menu/overlay transparency.

There are planned features for future releases such as dropdown effects for second level menu options. This plugin is based on the full screen pop out navigation by [Codyhouse](https://codyhouse.co/gem/full-screen-pop-out-navigation/).

= Want to see the plugin in action? =

You can view two example sites where this plugin is live : 

* Example Site 1 : [Wordpress Hosting](https://www.stackstar.com)
* Example Site 2 : [Web Design](https://www.shift8web.ca)
* Example Site 3 : [Dope mail](https://dopemail.com)

= Features =

* Customizable mobile breakpoint

This means that you can customize when the mobile version of the menu "kicks" in. By default it is set to a screen width of 980px

* Mobile mode for all screen sizes

You can set the plugin to "mobile mode" which means the mobile version of the menu will be always displaying

* Definable font styles everywhere
 
You can define the fonts from a list of all google fonts, or inherit the fonts defined in your theme. You can also adjust font size and color.

* Upload your logo

Upload your logo and it will display seamlessly

* Change colors and opacity

You can change the color and opacity of the menu bar as well as the mobile flyout

* Dropdown functionality out of the box

If you have parent/child menu items, they will be automatically rendered as dropdown for mobile/desktop view of the menu. You can change color and styling of the dropdown for desktop as well

**Remember : Dont forget to set the switch "Enable Full Nav" after installing and activating!**

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/shif8-full-nav` directory, or install the plugin through the WordPress plugins screen directly.
2. Disable any other 3rd party menu plugins you may have installed
3. Activate the plugin through the 'Plugins' screen in WordPress
4. Navigate to the plugin settings page and define your logo, font and design options. Dont forget to enable the plugin in the settings page!
5. The menu should show up by injecting its code into your header

== Frequently Asked Questions ==

= My menu is not showing up? =

Try disabling any other plugins that may be conflicting. Also take a look at inspect element in your browser and confirm if there are any javascript errors in the console. g

= Can I see what it looks like live? =

You can check out our wordpress hosting website to see it in action : https://www.stackstar.com

= How can I style the markup? =

The idea was to make design options available in the administrative interface of the plugin settings. The design options, when chosen, generate inline style markup that applies the styling. There is a stylesheet that imports other common styling elements. You can overwrite anything in your own theme's stylesheet.

= What if I have second level menu options? =

We plan on implementing a built-in dropdown feature for hierarchical menu options (2nd and 3rd level menu options). Currently this functionality is not built in.

= How do I get the dropdown options to work? =

You simply need to add second level (only) options in the Wordpress menu section

= What else have you done? =

We do [web design](https://www.shift8web.ca "Toronto Web Design") , development and [web hosting](https://www.stackstar.com)! :)

== Screenshots ==

1. This is an example of how the menu looks on a desktop
2. This is an example of how the menu looks on mobile with the menu not extended.
3. This is an example of how the menu looks on mobile with the menu extended

== Changelog ==

= 1.0 =
* Stable version created
* Implemented design options and inline style generator

= 1.01 =
* Added google font choices
* Bug fixes

= 1.02 =
* Fixed bug with inherit font logic

= 1.03 = 
* Adjusted breakpoint for mobile menu from 768px to 980px

= 1.04 =
* Fixed header logo linking to site url

= 1.05 =
* Added option to force mobile mode of menu all the time so only the hamburger icon will display

= 1.06 =
* Fixed z-index conflict with shift8-portfolio plugin

= 1.07 =
* Fixed main.js loading error
* Added fully customizable dropdown capability for menu options in non-mobile mode
* Added option to define mobile breakpoint for when the menu switches to mobile mode
* Added option to define font sizes for menu bar, overlay and dropdown

= 1.08 =
* Fixed bug in inherit logic for dropdown font if set to site default
* Set default font size if nothing set in admin options (inherit)
* Set default breakpoint width for mobile if nothing set in admin options (980px)
  
= 1.09 =
* Fixed padding for dropdown menu options

= 1.10 =
* Set default color to inherit if no color is defined to avoid CSS errors

= 1.11 =
* Implemented dropdown logic for mobile overlay menu (triangle for menu options that have sub nav children)

= 1.12 =
* Fixed bug in mobile dropdown logic for triangle direction change

= 1.13 =
* Fixed bug default color for dropdown backgrounds

= 1.14 =
* Fixed is-fixed class which didnt apply in desktop

= 1.15 =
* Fixed fatal error with older versions of PHP 

= 1.16 =
* Fixed bug where primary menu was not being pulled properly and no menu displayed

= 1.17 =
* Adjusted default alignment for desktop menu options to be closer to the right side to allow for more room

= 1.18 =
* Added check for target for each menu option, allowing the ability to open menu links in new tabs

= 1.19 =
* Force social icons on mobile version of menu to open in new tab

= 1.20 = 
* Added function to inject woocommerce shopping cart link + icon if woocommerce is installed

= 1.21 =
* Added logic to inherit any assigned CSS classes to menu items for non-mobile version of the menu

= 1.22 =
* Added logic to inherit any assigned CSS classes to menu items for mobile version of the menu

= 1.23 =
* Added unique identifier for UL container for sub menu items

= 1.24 =
* Improved woocommerce compatability to include auto updating ajax cart count change when items are added to cart

= 1.25 =
* Fixed bug in auto cart updating feature for woocommerce

= 1.26 =
* Added very subtle fade-in pure CSS animation for dropdown hover effect if any sub menu items are present.

= 1.27 =
* Switched from custom nav menu queries to using a walker class with wp_nav_menu function. This allowed for multiple menu hierarchy support (parent -> child -> grandchild). The navigation menu now supports dropdowns for up to 3 layers deep.

= 1.28 =
* Fixed bug with dropdown system on desktop. Created custom walker for desktop.

= 1.29 =
* Fixed minor CSS bug with dropdown

= 1.30 =
* Fixed minor CSS bug

= 1.31 = 
* Fixed CSS typo

= 1.32 =
* Cleaned up nav li classes (too many extra classes were generated)

= 1.33 =
* Re-integrated woocommerce cart icon into nav walker wrapper

= 1.34 =
* Restored ability to assign custom classes from wp admin menu to each menu item

= 1.35 =
* Resolved PHP Warning walker start_el and start_lvl function declaration adherence

= 1.36 =
* Resolved conflicting CSS name

= 1.37 =
* Increased sub menu depth for mobile from 2 to 3

= 1.38 =
* Reversion of change in 1.37 and added admin option to actually specify which menu you want the plugin to use

= 1.39 =
* Fixed location menu nav chooser in admin settings and application of nav location choice on front end

= 1.40 =
* Removed important declaration from padding left for sub menu items
