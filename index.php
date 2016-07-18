<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Instagram Data Design</title>
	</head>
	<body>
		<h1><strong>Instagram Data Design</strong></h1>
		<h2><strong>Persona</strong></h2>
		<h3>Madison Green</h3>
		<h3>Age 23</h3>
		<h3>College Student</h3>
		<h3>Technology</h3>
		<p>iPhone 6S with high usage cap 4G data, small PC laptop for at home and on campus use.</p>
		<h3>Attitudes and Behaviors</h3>
		<p>Friendly, outgoing, confident, adventurous, constantly connected to social media through FaceBook, SnapChat, Instagram, etc. Loves going out and to travel, and experience new things with friends and family.</p>
		<h3>Frustrations and Needs</h3>
		<p>Not necessarily frustrated by her user experience with Instagram, she just needs to be able to share with her numerous friends, family and acquaintances photographs of her experiences and update them on her goings-on. She loves to be able to do this in real time, mobile first (usually never on the computer) and upload photos minutes after they are taken.</p>
		<h3>Goals</h3>
		<p>Along with taking photos of her with her friends and of her new experiences, Madison also has the goals of connecting with new acquaintances and friends, and viewing their photographs and shared experiences. As well as with her own photos, she likes to do this in real time and stay up to date with anything new happening with her network of social mediaites. This includes being able to talk with her friends and family by instant messages, comments, and show support for their activities by using the like functionality of the site.</p>
		<h2><strong>Use Case</strong></h2>
		<h3>Who:</h3>
		<p>Madison Green</p>
		<h3>What:</h3>
		<p>Eating at a new restaurant that just opened in the downtown near her school with several of her friends. She has ordered a very aesthetically pleasing dish and wants to photograph it before digging in so she can share her experience with her social media network.</p>
		<h3>When:</h3>
		<p>1:30 PM on a Saturday afternoon.</p>
		<h3>Where:</h3>
		<p>Vicente Cafe</p>
		<h3>Why:</h3>
		<p>Madison is a very social and communicative person, and wants to share her experience and update her friends on her activity in the new restaurant. </p>
		<h3>How:</h3>
		<p>Using her high definition camera built into her iPhone 6S, she opens the Instagram application, taps on the Camera icon in the bottom middle of the screen, frames and takes a picture of her meal. Then, she selects a desirable filter and adds the location (aided by the fact that the Instagram application uses her iPhone’s GPS tracking services to correctly identify that she is at Vicente Cafe), select all of the media aside from Instagram she wants to post to, and finally taps Share. </p>
		<h2><strong>Interaction Flow for Posting a Photo to Instagram</strong></h2>
		<ol>
			<li>Madison opens the Instagram application on her iPhone 6S.</li>
			<li>Taps on the Camera icon in the bottom middle of her screen.</li>
			<li>Frames the object to photograph and taps the circle to take the picture.</li>
			<li>Chooses a filter and lighting if she would like.</li>
			<li>Taps Next.</li>
			<li>Writes a Caption.</li>
			<li>Tags people if needed.</li>
			<li>Adds location.</li>
			<li>Selects other social media networks she would like to post the photograph to if she would like.</li>
			<li>Taps Share.</li>
		</ol>
		<h2><strong>Conceptual Model</strong></h2>
		<h3>Entities and Attributes</h3>
		<h4>User</h4>
		<ul>
			<li>userId</li>
			<li>userHandle</li>
			<li>userName</li>
			<li>userBio</li>
			<li>userEmail</li>
			<li>userPhone</li>
			<li>userGender</li>
		</ul>
		<h4>Picture</h4>
		<ul>
			<li>picture</li>
			<li>picLocation</li>
			<li>picCaption</li>
			<li>picHashtag</li>
			<li>picComment</li>
		</ul>
		<h4>Like</h4>
		<ul>
			<li>likeCount</li>
		</ul>
		<h3>Relationships</h3>
	</body>
</html>