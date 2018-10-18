# RouteCommands

RouteCommands is a laravel library that allows you run configured
laravel commands directly from a route. 

It is particularly useful for situations where laravel is being run on
an environment with little to no ssh access

## Getting started
Install RouteCommands by running: 

```composer require kofoworola/route-commands```

Then run ```php artisan vendor:publish```, this will publish the
```config/commands.php``` file to your project where you can then setup your commands

Once your commands and routes have been setup, simply navigate to your route 
e.g `http://localhost/commands/route_list` and you should be greeted with a screen 
similar to the one below:

![image](https://i.imgur.com/YVWnBWL.png "Image")

To add new commands or block new commands simply update the config file and re-cache your config
by navigating to `/config_cache`.

### this package does nut run commands with ```exec()``` thats just plain unsafe

This library was born out of my frustration with using Laravel on a shared hosting environment.
I hope you find some good use for it.

Enjoy!

