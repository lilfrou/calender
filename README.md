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
<h3>.Env File</h3>
<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/env.png" width="800"></p>

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
    <li>Run this command: npm install --save @fullcalendar/vue @fullcalendar/daygrid @fullcalendar/timegrid @fullcalendar/interaction @fullcalendar/list</li>
</ul>
<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/7.png" width="500"></p>
<ul>
    <li>After importing we need to define calendarOption in the data section in our component , make sure to use the imported plugins as well</li>
    <li>the last setup is to call the calendar us a html element make sure to pass the calendarOption to it us an option</li>
</ul>
<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/8.png" width="500"></p>
<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/9.png" width="500"></p>
<ul>
    <li>Now we can add some more feature later on , for that check official site ! https://fullcalendar.io/</li>
</ul>
<h2>User Guide</h2>
<ul> 
    <li>Currently there are 2 type of user , 1 Admin who is the master account and multiple Operator , things can change later on the futur but will stick to those for the moment</li>
</ul>
<h3>Admin</h3>
<ul>
    <li>At first time login Admin have to link his master zoom account <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/10.png" width="400"></p>
</li>
    <li>clicking on the link account button will redirect you to zoom page to login with your master account <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/16.png" width="400"></p></li>
    <li>if it is the first time installing the zoom app Admin have to accept all the App scopes <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/14.png" width="400"></p> </li>
    <li>if accepted the Admin will be redirected to the dashboard page</li>


</ul>
<h3>Operator</h3>

<ul>
    <li>Operator side is a little bit different , an Operator needs to create a sub account under the Admin zoom account , the steps are the following :</li>
    <li>At first time login Operator have to get his sub zoom account <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/11.png" width="400"></p></li>
    <li>A Confirm email will be send to the Operator to complete his account setup <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/13.png" width="400"></p></li>
<li>Mean while the Operator will be redirect to email stand by page <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/12.png" width="400"></p></li>
    <li>Operator can complete his register by facebook or gamil or with password</li>
    <li>after completing the zoom registration the project email blade will redirect it self to log in with you zoom account <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/16.png" width="400"></p></li>
    <li>after accepting the scopes operator will be redirect to dashboard page <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/14.png" width="400"></p></li>
</ul>
<h3>Create ,Update , Delete meeting</h3>
    <ul>
    <li>Now for creating and updating the rules are simple , fill in the blank , there are a few condition that are applyed to the duration , user can not send a 0 hours and 0 minutes at the same time  ,and if the hours is 24 the minutes will be disabled</li>
<li> When a meeting is created an invitation will be generated , you can copy the invitation and send it to any one <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/created.png" width="400"></p>
 </li>
<li>User can find the invitation link and password while clicking on an event</li>
<li>if an error some how occured a warning notification will be shown <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/error.png" width="200"></p>
</li>
</ul>
<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/updated.png" width="200"></p>
<p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/deleted.png" width="200"></p>
<ul>
    <li> user can drag and drop event  by clicking on an event and draging it into a new date , the event will be updated <img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/drag.png" width="600"></p> </li>
</ul>
<h2>Developer Guide</h2>
<ul>
    <li>Now there are a few things to keep in mind , first at all we need to understand the way zoom API works : <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/the_way.png" width="800"></p> </li>
    <li>when user is installing the app for the first while accepting the scopes , he is actually sending an Authorization request, if installed the authorization will be granted and he will get an acces token stored in our tokens tabel , that token is used by each Api to get any ressource from the server , this operation is represeted inside EventController by the get token function and get code function <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/get_code.png" width="800"></p>  </li>
<li> Each of update , create , delete function does excist in the same controller , now a user token is valid for 1 hour , for that case each of those methods are linked with refresh token api to get the new token <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/try_catch.png" width="800"></p> </li>
    <li>there are a few other things to mention , the email verification blade is using an auto refresh function , by that it is using a zomm api to check if the user has confirmed his mail , the function does excist in the homeController   <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/refresh.png" width="800"></p> </li>
    <li> the auto refresh function is pointing to the HomeController index function where it checks for all condition to redirect the user to dashboard page  <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/dashboard.png" width="800"></p></li>
    <li> this function is responsable for checking the email confirmation   <p align="center"><img src="https://github.com/lilfrou/calender/blob/master/public/media/read_me/email.png" width="800"></p></li>

</ul>






