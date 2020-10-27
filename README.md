<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/0.png" width="1000"></p>

## General information
this project was created using Vue js,sweet alert , Zoom API , Full Calendar API with Laravel 8 :

- [Vue js](https://vuejs.org/).
- [Sweet Alert](https://sweetalert2.github.io/).
- [Zoom API](https://marketplace.zoom.us/docs/guides).
- [Full Calendar API](https://fullcalendar.io/).
- [Laravel 8](https://laravel.com/).

## Requirement
<h3>Zoom API</h3>
<ul>
<li>This project require one pro zoom account at least , the pro accout owner must be the master to allow all the zoom api to work.</li>
<li>Other user are created under the master account us members , those user by default they will be assigned to a basic zoom meaning:</li>
<ol>
                                        <li>create meeting (with maximum duration of 40 minutes if the meeting is hosted by more then 3 people)</li>
                                        <li>update meeting</li>
                                        <li>delete meeting</li>
                                        <li>join meeting</li>
</ol>
<li>for illimited meeting duration members users need to change from basic to pro account at least like the master . </li>
    <li><a href="https://zoom.us/pricing">please see the zoom billing :</a></li>
</ul>
<h3>Redis and laravel-echo-server</h3>
<ul>
<li>this project does need a setup for redis and laravel-echo-server as mentioned , for setup documentation please refere to this link :</li>
</ul>
<h3>.Env File</h3>
<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/2.png" width="800"></p>

<ul>
<li>this project does need the following env setup , basicly for the redis server and for the zoom api that you will get after setting up your zoom App( i will explain how to get those in the setup section)</li>
</ul>


## Setup Section 
<h3>Creating an Oauth for our zoom App</h3>
<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/3.png" width="400"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/4.png" width="400"></p>

<ul>
    <li>Now there are 2 type for OAuth App , one called Account level app where only admin can install the app and he will be manage the meeting for other users , the second one is user-managed-app each user can install the app and  manage his own meeting and it is the app type that we are using </li>
    <li><a href="https://marketplace.zoom.us/develop/create">link for creation</a></li>
<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/5.png" width="400"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/6.png" width="400"></p>
    <li>we are turning our attention to scopes , scopes are the rules that define our App functionality , our focus is viewing the user information and meeting Api , therefor those scopes will be selected , we can add other scopes later on</li>
    <li>remmember the env file setup ? we get those credentional when we create our APP , the cliend id and client secret is to identify our app , the important thing is the redirect url , that url must be defined in our routes project and it will redirect to if a zoom member has installed our APP </li>
</ul>
<h3>Full Calendar</h3>
<ul>
    <li>now full calendar is the Api responsable for generating the calendar in the view side it uses vue js us third party , the setup require  npm to install full calendar with mentioning each required plugin , after that we need to import those plugin in the view component</li>
</ul>
<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/7.png" width="1000"></p>



