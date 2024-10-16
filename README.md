# URL Shortener Tool

## Description

This is a simple yet effective tool for creating short URLs using your own domain. It allows you to easily shorten links without the need for subdomains, making it perfect for businesses or personal use. With this tool, you can quickly create clean, memorable links that redirect to any destination of your choice.

## Features

- **Easy to Use**: User-friendly interface for creating links.
- **Custom Folders**: Create unique folder names to generate short URLs.
- **Redirect Links**: Set any URL as the destination for your shortened link.
- **Self-Hosted**: Host the application on your own server or domain.
- **View Created Links**: Displays a list of all created links along with their creation dates.

## How it works

Its a very simple php script which creates a folder with a new index.php file in it.
The index files will look similar to this:
```php
<?php
header('Location: https://github.com/patrikaeberli');
exit();
?>
````

At the bottom of the page it displays all folders (so all "subdomains") you created and at what time. Just in case you want to see when you/your co-workers created a new folder. 

## Live Demo

You can try out the tool here: [Live Demo Website](http://shorturl.great-site.net)
