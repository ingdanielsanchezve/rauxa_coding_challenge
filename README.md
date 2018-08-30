# Raxua Frontend Coding Challenge Solution

#### Raxua Frontend Coding Challenge Solution

![screenshot](https://github.com/ingdanielsanchezve/rauxa_coding_challenge/tree/master/public/images/screenshots/Screenshot_frontend.png)

## Description of the problem.
Create a service that allows for a user to search for a GitHub username. On a successful search return, display the user's GitHub handle, follower count, and a list of the user's followers, Additionally for users with many followers Create a "load more" button that, when clicked, fetches the next payload of followers. 

## Solution
For the solution of this coding challenge, the laravel framework for the backend was used since it is a very popular php framework that could also be used to manage the routes of the API endpoints and to create tests to test the application.

As for the connection with GitHub, a controller was created which makes requests to the API using authentication by means of the user name and the token that must be established in the ```.env``` file of the application.

The frontend view is rendered using a HTML file, it was modified the laravel config view file to look for the views in the ```public/views``` directory instead of the ```resource/view``` default laravel directory.

On Page load a request to the ```/user``` endpoint is made to get the authenticated user data and show user avatar, name, username and url link to the ser GitHub profile page.

The search of the user is done from the application by means of an asynchronous request to the ```/search/:user``` endpoint with the AngularJs ```$http.get```  which performs the search in 2 phases. First the information of the corresponding user is obtained and later the user's followers.

While the searching of users or followers are perfomed the user is notified with alerts in the UI, after the search is done, the alerts are hidden.

Depending on the number of followers of the user proceeds to perform the pager that is displayed in the front site because the GitHub's API returns maximum 30 followers in each request.

In case the user has more than 300 followers, a button is added at the end of the pager to show the additional followers since in this way the interface is maintained.

For each GitHub user their avatar, name, username, bio, location and url are displayed.

Each followers is shown on a contact card where you can see your username, avatar and 2 buttons, one to perform the search of that user within the application and another to see the profile on the site.

## Solution URL
* Link to the hosted application. [Url](https://rauxa.ml)

## Pagination

For Users with more than 30 followers a paginator is displayed in the front site, this is because GitHub's API returns maximum 30 followers in each request.

To calculate how many Pages are required to show all followers is required to divide the user followers count returned with the user data by 30 whic is the number of the followers returned by each request, in case the result have decimals and additional page is returned to show the rest ones.

For Users with more than 30 followers the paginator will show by default 10 pages and a load more button to show the additional followers.

Each Paginator item is created with an ```ng-repeat``` directive to show each page number, when user click each number an asynchronous request is done to the ```/followers/:user/:page``` endpoint with the username and the page number, after the followers are returned they are displayed each one with a card info.


#### Pagination for users with more than 30 followers
 ![screenshot](https://github.com/ingdanielsanchezve/rauxa_coding_challenge/tree/master/public/images/screenshots/Screenshot_followers_pagination.png)

 #### Pagination for users with more than 300 followers with button to search more
 ![screenshot](https://github.com/ingdanielsanchezve/rauxa_coding_challenge/tree/master/public/images/screenshots/Screenshot_massive-followers.png)

## Requirements
* Laravel Framework for Backend
* AngularJs 1.7.3 for Frontend
* GitHub Users and Followers API endpoints consuming
* Based on Gentellela Alela Admin Dashboard

## Usage
1. Clone the repo in your local system
2. Install [Laravel Framework ](https://laravel.com/docs/5.6/installation)
3. Create local .env file in your project root with ```GITHUB_USER``` and ```GITHUB_TOKEN``` variable [Create GitHub Tokens](https://github.com/settings/tokens)
3. Server Up with command ```php artisan serve```
4. Type username in search input box

## Testing

Tests created using PHPUnit in Laravel to test this:

1. WebSite front is working
2. GitHub User authenticated data
3. GitHub user search
4. GitHub user search user not found
5. GitHub user followers search
6. GitHub user not have followers

## History
2018-08-30 - First public version

## Credits
- Developed by: Daniel Sánchez

## License
The MIT License (MIT)