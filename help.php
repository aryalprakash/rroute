<?php
include ('includes/header.php');

require_once(DIR_APP . 'projects.php');
require_once(DIR_APP . 'users.php');

//if (empty($_SESSION['logged_in']))
//    redirect('index.php');
?>

<div class="inner-page-wrapper">

    <div class="project inner-page content">

        <?php include (DIR_INCLUDE . 'left_nav.php'); ?>


        <div class="main-content">

            <div class="content-block">
                <div class="content-title">Help Center</div>
 		
                        <div class="search-form">
                            <form action="help_search.php" method="post">
                                <input type="text" name="search_text" placeholder="Search" style="width: 415px;
    height: 30px;
    border-radius: 10px;
    padding: 0 10px 0 10px;
    border: #d6dbe2 solid 1px;
    font-family: 'museo_sans700';
    font-size: 13px;
    color: #454545;">
                                <input type="submit" name="search" value="" style="width: 14px;    height: 14px;     border: none;    background: url('../images/icons/search.png') no-repeat;    cursor: pointer;    margin-left: -25px;    ">
                            </form>
                        </div>
                        
                        <div class="" style="margin-top: 50px;">
                        <div class="help_title"> A. Process</div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="signup">Signing Up</div></a>
                        	<div class="help_content" id="signupContent" align="justify" style="display: none;">
<p align="justify">•	Browse www.rangeenroute.com and select Sign up </br></br>
•	Fill your name, date of birth and email</br></br>
•	Create a password and click Sign Up</br></br>
Or</br>
•	Click Login with Facebook</br></br>
•	Accept Rangeenroute to access your Facebook credentials</br></br></br>

To create a Rangeenroute account, you need to sign up. First, go to www.rangeenroute.com and click Sign up. A Sign up form will appear.</br></br>

Sign up form: Here you need to enter First name, Last name, Date of birth and Email. Then create a password and click Sign up.
We will send you an email to help you confirm your account.</br></br>

You can also create a Rangeenroute account using your Facebook, Twitter or Linkedin credentials. We import your basic information like name and email address from your Facebook, Twitter or Linkedin account. Click Login with Facebook, Twitter or Linkedin.</br></br>

Login with Facebook: First you must have active Facebook account. Click on “Login with Facebook” and agree to connect your Facebook account credentials with Rangeenroute. </p>
 
</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="login">Logging In/Out</div></a>
                        	<div class="help_content" id="loginContent" align="justify"style="display: none;">
<p align="justify">•	Enter you email and password </br></br>
•	Click Log in </br></br>
Or</br>
•	Click Login with Facebook</br></br>

If you already have a Rangeenroute account, you can easily access your account by entering your email and password at the top of the page.</br></br>

You can log into your Rangeenroute account directly by clicking “Login with Facebook”.</br></br>

To log out, click Settings tab on left side of your Rangeenroute account. Logout button is on top right side. Click Logout.</p>
</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="start">Getting Started</div></a>
                        	<div class="help_content" id="startContent" align="justify" style="display: none;"><p>Once you log into your Rangeenroute account, you can:</br></br>
•	Add or change your profile</br></br>
•	Search and find your friends</br></br>
•	Invite them and add them as Router</br></br>
•	Communicate with them</br></br>
•	Discover their awesome Projects/IdeaThread, support them and fund them</p>
</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="profile">Profiling personal info</div></a>
                        	<div class="help_content" id="profileContent" align="justify"style="display: none;">
<p align="justify">When people see your Project/IdeaThread, they obviously want to know you.</br></br>
•	To view how people see you, click your “Name” on top right part near notification icon.</br></br> 
•	To add or edit your profile information, click “Profile” on left side. </br></br>
•	To add or change profile picture, click “Change photo”. To remove the current profile picture, click “Remove photo”. Note: There exists no storage of previous picture or any gallery. We recommend you to update profile picture with your recent photo regularly.</br></br>
•	To get your profile verified, submit a proper ID by clicking “Get Verified”.</br></br>
•	Don’t forget to write about yourselves. People love to know who you are. Fill “About yourself”.</br></br>
•	Click “Save Changes” after editing or updating any personal information.</p>
</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="upload">Uploading Ideathread and Project</div></a>
                        	<div class="help_content" id="uploadContent" style="display: none;"><p>IdeaThread:</p>
<p>•	Select “IdeaThread” and click “Upload”</br></br>
•	Fill the Title, Description, URL, Thumbnail and Creator</br></br>
•	Click “Submit”</br></br></p>

<p>Project:</strong></br></br>
•	Select “Project” and click “Upload”</br></br>
•	Read the “Project Guidelines” and click “Accept”</br></br>
•	Fill the information as instructed. There are 5 pages: Project Info, Featuring Presentation, Thematic Post, Project details and Project Penetration</br></br>
•	Project Info: You need to give title to your project, category, location and name of friends helping you if any.</br></br>
•	Featuring Presentation: You need to upload a picture that defines your project, a video and a description that tells about your project in brief.</br></br>
•	Thematic Post: You need to select a thumbnail for your project.</br></br>
•	Project Details: You can write about your story, upload picture and video to describe your project in full.</br></br>
•	Project Penetration: You need to define your funding method, rewards for investor, business planning and risks.</br></br>
•	Review all information. Click “Back” to edit and review again.</br></br>
•	Click “Submit” when your project is finalized.</p>


<p align="justify">IdeaThread is the shared string of idea, you saw anywhere and of anyone, you felt awesome about. It must fit under the definition of “Project” in Rangeenroute.

IdeaThread Guidelines:</br></br>
- IdeaThread must be an idea of a “project” seeking early stage funds with at least a prototype, in alpha/beta version or pre-launched stage; however IdeaThread can be an idea of a product recently launched that has yet to initiate a market field and has enough potential for market initiation or competition.</br></br>
- IdeaThread cannot be a vaporware</br></br>
- Multiple posts or updates on same idea are not accepted.</p>

<p align="justify">Note: Comment, Like, Share and Report features are available for all IdeaThreads. Rate, Route and Rank features are available (i.e. data pulled from actual project) for IdeaThreads for which corresponding project is uploaded in Rangeenroute. For all projects uploaded in Rangeenroute, corresponding IdeaThread will be generated automatically.</br></br>

Project is the idea created by you or your team that fits under the definition of “Project” in Rangeenroute.</p>

<p>Project Guidelines:</p>
<p align="justify">All projects must follow two rules.</br></br>

1) Project uploaded by entrepreneurs is defined as "Genuine idea" that can undergo "product development process" for "market - initiation or competition". </br></br>
2) Project must be in accordance with laws. Illegal, hateful or harmful, pornographic or abusive - are strictly prohibited.</p>

<p align ="justify">All users must follow two rules while uploading project.</br></br>

1) User must provide authentic demographic data.</br></br>
2) User (as entrepreneur) who is 13-18 years old - can upload the project if and only if accompanied by parents or guardians or adults (of age at least 18) as team partner. User (as accredited investor) must have submitted the appropriate evidence for approval of accreditation before accepting or funding or uploading any project.</p>
</div>
                      
 </div>
 
 			<div class="help-box">
                        	<a href="#"><div class="help_title" id="connecting">Connecting</div></a>
                        	<div class="help_content" id="connectingContent" align="justify" style="display: none;">
<p align="justify">•	Type your friend’s name on top to search.</br></br>
•	Go to user profile by clicking the name.</br></br>
•	Click “Add router” to follow.</br></br>
•	Click “Router” tab on left side to see your connection.</br></br>
•	Click “Communication” inside “Router” tab to send message to your routers.</br></br>

You can find, invite, add and message people freely with your Rangeenroute account. “Search”, “Add router” and “Router” function thoroughly help you connect with people you care of.</p>

                        	</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="interacting">Interacting</div></a>
                        	<div class="help_content" id="interactingContent" align="justify" style="display: none;">
<p align="justify>•	Click “Recent” to view recent projects</br></br>
•	Click “Trending” to view projects that most people think awesome</br></br>
•	Click “Routed” to view projects uploaded by your routers</br></br>
•	Click  “Suggestions” to view projects routed to you by your routers</br></br>
•	Click “My activities” to view projects in which you’re engaged.</br></br>
•	Click “Fundables” to view projects which are eligible for raising funds</br></br>
•	Click “IdeaThread” to view IdeaThreads</br></br>
•	Click “Like” if you think the Project or IdeaThread is awesome</br></br>
•	Click “Comment” and write anything thoughtful you want to say about that Project or IdeaThread</br></br>
•	Click “Rate” and give rating out of 10 using proper guidelines. See “Rate of a project”</br></br>
•	Suggest any project to your friend by using “Route”. Click “Route” and select your routers to whom you want to suggest the Project or IdeaThread.</br></br>
•	Click “Store” tab on left side to view all the projects on the basis of your search preferences.</br></br>


<p align="justify">To get involved in Projects or IdeaThread, you can Like, Rate, Comment and Route. Projects are filtered using awesome algorithms to ease your preferences.  You can view projects filtered by time, your routers and trending score.</p>

                        	</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="analyzing">Analyzing your account</div></a>
                        	<div class="help_content" id="analyzingContent" align="justify" style="display: none;">
•	Click “Project” tab on left side to view “Seed rating” and “General rating” data for your project. </br></br>
•	Click “Finance” tab on left side to all the financial transaction related to your account. Click “Advertisement” to create or edit your ad campaign.</br></br>
•	Click “Setting” tab to change your display name, to change your password and to logout. Click “Privacy” to set the level of your privacy to maintain what others can see. </br></br>

                        	</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="reporting">Reporting</div></a>
                        	<div class="help_content" id="reportingContent" align="justify" style="display: none;">
                        	Issue on user’s post</br></br>
•	Click “Report” </br></br>
•	Select the option Copyright/Privacy/Legal infringement, Spam/Deceptive, Violent, Abusive, Impersonation or Harassment</br></br>
•	Click “Submit”</br></br>

Issue on functionality</br></br>
•	To report any bug on the system, click “Settings” and select “Report”</br></br>
•	Choose the topic on which you want to report and a box will appear on right side. </br></br>
•	Write about the issue in the box and click “Send”</br></br>

                        	</div>
                        </div>
                        
                        
                        
 
 			<br/><br/>
 			<div class="help_title"> B. Terminology</div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="router">Router</div></a>
                        	<div class="help_content" id="routerContent" align="justify" style="display: none;">
<p align="justify">Router is a connection point. You can call it “Friend” but we consider Friendship precious and keep it safe for real world. “Add router” when clicked changes to "Connecting" and it works just like following. When "Add router" request is accepted, "Connecting" changes to "Routed" and it works just like "Friendship". Double click on "Routed" resets the connection. </p>
                        	</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="routefunction">Route Function</div></a>
                        	<div class="help_content" id="routefunctionContent" align="justify" style="display: none;">
<p align="justify">You can route any Project to your routers. You can call it share or tag but we’re tech-pro and once routed, we hope the project to get re-routed and boosted to many others.</p>
                        	</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="footnote">Footnote</div></a>
                        	<div class="help_content" id="footnoteContent" align="justify" style="display: none;">
<p align="justify">Footnote is 111 characters long (max.) recommendation about user given by any of his routers (which will help investor to analyze user profile). User himself can’t edit footnote. Only person who writes can edit or delete but only after 111 days.</p>
                        	</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="notification">Notifications</div></a>
                        	<div class="help_content" id="notificationContent" align="justify" style="display: none;">
<p align="justify">User will be notified for all activities associated to him/her on top right corner.</p>
                        	</div>
                        </div>
                        
                        
                        
                        <br/><br/>
                        <div class="help_title">C. Methodology</div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="status">Status of a Project</div></a>
                        	<div class="help_content" id="statusContent" align="justify" style="display: none;">
<p align="justify">There are 5 phases of lifeline for any projects and those phases are noted as “status” of the project. Status will be shown inside the “project tab” and on the left side of video along with rating, ranking and analysis.</br></br>

1.	Initiation phase: Once the user click “upload” for a project and completes first page (project title, category, location, developer), he must click at least “save & next” to get “Initiation phase” for his project. Project will remain under initiation phase until it passes initial review for community guidelines. Single letter “I” will denote this status.</br></br>

2.	Published phase: Once the project pass initial review for community guidelines, project goes live to public and the “published phase” starts. In this phase, project will get seed ratings and other user starts to engage with this project. Once the project gets this status, it will never ever get deleted. Single letter “P” will denote this status. </br></br>

3.	Started up phase: The project under “published phase” turns into “Started up phase” if the project becomes eligible for funding and listed in “Fundables” tab. Single letter “S” will denoted this status.</br></br>

4.	Developed phase: The project under “started up” phase can turn into “Developed phase” if the project gets successful funding or if accelerator/incubator/investor accepts the project. Then the project goes into product development. Single letter “D” will denote this status.</br></br>

5.	Launched phase: When the product development gets completed, the project enters into final phase “Launched”. All the data will be preserved and available for view, but no one can get engaged (like, comment or rate, etc.). Single letter “L” will denote this status.</p>

                        	</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="rating">Rating of a Project</div></a>
                        	<div class="help_content" id="ratingContent" align="justify" style="display: none;">
<p align="justify">The ratings assigned to any project, here, are scientifically filtered towards more accuracy. The lifeline of rating value for a project begins with seed ratings and continued by stirring it with the user-generated ratings and ends with “L” status of project.</br></br>

Seed rating: When a project is submitted to our system, it will be processed; to analyze whether it is in terms with our guidelines or not. Once the project is accepted, it will go public and instantly 5 individuals (closely related to that project category) are assigned for seed ratings. Seed ratings are generated from a devised formula as follow.</br></br>

Positives – Higher the score; higher the ratings (scale: 0 to 10)</br></br>
	Feasibility</br></br>
	Uniqueness</br></br>
	Growth Quality</br></br>
	Startup easiness</br></br>
	Process clarity</br></br>

Negatives – Higher the score; lower the ratings (scale: 0 to 10)</br></br>
	Investment risk factor</br></br>
	Time consumption to effect</br></br>
	Redundancy featured</br></br>

Positives/Negatives – Can be positive or negative (scale: 0 to 10)</br></br>
	Impact (of project upon humanity, society and environment)</br></br>
	Profile (of project creators)</br></br>

-The highest seed score that can be achieved is 70 and the highest seed rating that can be achieved is 7 (and it’s out of 10 though).</br></br>


- If the total score comes in negative value, the rating will not be assigned.</br></br>

- While calculating seed ratings, if any one of the 5 seed raters approaches to negative total score, rating will not be assigned.</br></br>

- With all those positive seed ratings, Bayesian statistics is used to calculate the final rating of a project.</br></br>
Rating (R) = ((M × Mn)+(Nr × Mr))/(Mn+Nr)  </br></br>


Where, M = mean rating across database</br></br>
               Mn = Minimum number of ratings required</br></br>
               Nr = Total number of ratings </br></br>
               Mr = Mean of ratings given</br></br>

Note: We recommend all users to consider above-mentioned 10 factors while assigning “Rate” value to any Project.</p>

                        	</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="ranking">Ranking of a Project</div></a>
                        	<div class="help_content" id="rankingContent" align="justify" style="display: none;">
<p align="justify">Ranking of a project is based on ratings. The project with highest rating will rank 1.</p>
                        	</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="trending">Trending of a Project</div></a>
                        	<div class="help_content" id="trendingContent" align="justify" style="display: none;">
<p align="justify">Trending has huge impact on user’s project.  In fact, only those projects are “Fundables” which are trending. </br></br>

The major variables of trending score are:</br></br>
	a) Like b) Rating c) Comment d) Route e) Time period</br></br>

Like + Rating</br></br>
These variables have one to one effect i.e. one user can contribute single like / one user can give single rating (at most). So their effects are similarly calculated as:</br></br>
J = Number of events (like + rating) – 2</br></br>
Negative two is assigned to negate the possible self-events of original user.</br></br>

Comment</br></br>
This variable has multitude effect i.e. one user can contribute multiple comments. </br></br>
K =  (Number of Unique user)/(Number of comments)</br></br>
The most possible value of K is 1. One comment as question is answered by next comment – is taken as ideal comment philosophy.</br></br>

Route</br></br>
This variable has one to one immediate effect but multitude effect in later stage. i.e. one user can route (share) once but to unlimited other users. Here who routes will be unique route but not to whom it is routed.</br></br>
L = (Number of users)/(Number of route)</br></br>

Time period</br></br>
This variable is of two kinds: Functional period and Event period.</br></br>
Functional period (M) = (Project submit time – Constant) seconds</br></br>
Constant is the time when the site is officially launched.</br></br>
Event period (N) = (Present time – Project submit time) seconds</p>

                        	</div>
                        </div>
                        <div class="help-box">
                        	<a href="#"><div class="help_title" id="funding">Funding of a Project</div></a>
                        	<div class="help_content" id="fundingContent" align="justify" style="display: none;">
<p align="justify">•	Go to “Fundables” tab to view all projects eligible for funding.</br></br>
•	Click “Fund” button of the project you decide to fund.</br></br>
•	Input the funding amount and associated reward will be displayed.</br></br>
•	Click “Finalize”. It leads you to payment page.</br></br>
•	Input your card information and click “Pay”.</br></br>

Process</br></br>
•	Once the project trends, it will be eligible for funding. </br></br>
•	User will be notified that his/her project is eligible for funding and he/she must “Allow” for funding.</br></br>
•	Fundable project will be in “Fundables” tab for 32 days. </br></br>
•	If funding did not succeed, “Fund” button will be changed to “Unsuccessful - Exit” and the project will be removed when user clicks “Exit”. </br></br>
•	Removed project if still trending, it will get second and last chance for funding. It will appear in “Fundables” for next 32 days. </br></br>
•	If project failed for second time in funding, it will never be eligible for funding even if it trends. </br></br>
•	If funding succeeds, the “Fund” button will be changed to “Successful – Exit”. </br></br>
•	User clicks “Successful - Exit” and system processes for payment collection if the project is ranked no. 1, 2 and 3 in “Fundable” rank. </br></br>
•	If project is not 1, 2, 3 in “Fundable” rank, 2.5% of excess raised amount must be invested to any one of the other “Fundable” project. </br></br>
•	Finally, system processes for payment collection, which may take a week.</br></br>
•	System sends the list of investor and associated reward to all investor and creator, and shows this list on “Project detail” page at last section.</br></br>
This funding model is named “Excess-Sharing Economy” integrated with Crowd-funding methodology. </br></br>

If equity is reward, only accredited investors are allowed to invest and input of amount will show % of equity based on asked value if project succeed (Raised value < Asked value). </br></br>
If equity is reward, input of amount will show % of equity based on raised value (Raised value > Asked value). </br></br>
If product is reward, input of amount will show reward item if project succeed. </br></br>
Investor won’t be charged anything if funding is unsuccessful. The rule is all in or nothing.</br></br>
Collecting the fund</br></br>
All Rangeenrouter, whose project is successfully funded, are personally invited to nearby Rangeenroute office within a week from the day project exits successfully from “Fundables” tab. Rangeenroute applies 3.55% fees to the raised investment amount and 2.9% + $0.30 per investment transaction as payment processing fee.</br></br>
Note: As of now, only projects based on US location are eligible for funding.
</p>

                        	</div>
                        </div>
                        	
                        
                        </div>

            </div>

        </div>


    </div> <!-- account inner-page content -->

    <?php include (DIR_INCLUDE . 'right_side.php'); ?>

</div> <!-- inner-page-wrapper -->

<?php include (DIR_INCLUDE . 'footer.php'); ?>