# RevUp Special Offers Plugin

## Written by: Max Harris 👨🏾‍💻

This plugin is written as part of a coding assesment for RevUp. TItis designed to be a simple plugin that allows for the creation of special offers for products.

### Here's what it does:

- Adds a custom post type called "Special Offers"
- Adds a custom meta box to the editor for the "Special Offers" post type
- Using built-in WordPress functionality for the meta fields (instead of Advanced Custom Fields or similar)
- Adds a shortcode that displays a list of special offers on the front end

## Considerations 🤔

- Demonstrates file/folder structure
- Blocking direct access to PHP files
- Sanatizing and escaping data
- Namespacing functions and classes to prevent conflicts with other plugins/css
- Query filtering for offers that are published and have not expired yet
- Mobile-first responsive design (uses the @container CSS query to allow nesting within containers)
- Deleting shortcode and data on plugin deactivation

## TODO 📋

Here are some things that I would add to this plugin with more time:

- Add a settings page to allow for the configuration of the plugin (including optional data cleanup on deactivation)
- Server side validation of meta fields in the editor (currently relying the "required" attribute)
- Pagination
- Archive page for special offers (depending on requirements)
- Functionality for evergreen offers (i.e. offers that are always available)
- Customization options for the button (classes, text, etc.)
