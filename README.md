# short-code-wp
WP short-code allowing website admin to add form 

## Create a Car List Plugin
The plugin create aims to provide the website editor with the ability to enter a shortcode in a page or post, which will display a form where the user can enter the following information:

- First name and last name
- Car brand
- Model
- Color
- Manufacturing year
- License plate number
When the user submits the form, their data should be saved in the database.

***All fields are mandatory.***

Form validation should return a notification message to the user.
The date of addition to the database should also be stored.

## Administration
In the administration area, we want to add a new tab with a submenu.

***Overview:*** displays a list of registered individuals with information about their cars (the brand and model grouped together).
***Recent:*** displays information about the most recently registered car in the database (manufacturing year).
