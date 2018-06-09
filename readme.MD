## WPInfomate 
*A WordPress Plugin that shows Server and WordPress Configurations*

This Plugin is developed using PSR-4 Autoloader and Composer as PHP  dependencies.
The front-end of this plugin is developed using React.
Since this is developer version you won't be able to see anything once you install this plugin,
You'll have to run following commands in-oder to get the required dependencies.

##### Install Composer,

if you are using composer , navigate in to the root directory of plugin and run 

`composer install`

This will create autoload files inside the plugin.

*if you don't have installed composer , still plugin can run it's own*

#### Load The Admin Page Content

Once you run composer and activate the plugin you'll see a menu item called WPInfo, this the page where all 
the server and WordPress configuration details are. But It won't display any thing at first. You'll have to 
install all the decencies and build the front end using webpack.

##### Install Dependencies

`yarn install` or `npm install`

Once it is success 

##### Build the front-end

`yarn build` or `npm build`

*please note that you'll have to have Node js installed in your pc.

  
 
 
