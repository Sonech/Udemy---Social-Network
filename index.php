<?php 
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

if(isset($_POST['post'])) {
	$post = new Post($con, $userLoggedIn);
	$post->submitPost($_POST['post_text'], 'none');
}

 ?>
 		<!-- Add column for profile picture -->
 		<div class="user_details column">
 			<a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['profile_pic'];	?>"> </a>

 			<div class="user_details_left_right">

	 			<a href="<?php echo $userLoggedIn; ?>">
		 			<?php
		 				echo $user['first_name'] . " " . $user['last_name'];
		 			?>
	 			</a><br>

		 		<?php 
		 		echo "Posts: " . $user['num_posts'] . "<br>";
		 		echo "Likes: " . $user['num_likes'];
		 		?>
 			</div>
 		</div>

 		<!-- Adds the main column for newsfeed -->
 		<div class="main_column clolumn">
 
 			<form class="post_form" action="index.php" method="POST">
 				<textarea name="post_text" id="post_text" placeholder="Got something to say?"></textarea>
 				<input type="submit" name="post" id="post_button" value="Post"><hr>
 				
 			</form>



 		<!--	<?php 
			/*	
 			$post = new Post($con, $userLoggedIn);
 			$post->loadPostsFriends();
 			$user_obj = new User($con, $userLoggedIn);
 				echo $user_obj->getFirstAndLastName(); */
 			?> -->

 			<div class='posts_area'></div>
 			<img id='loading' style='size: 10px;' src="assets/images/icons/loading.gif">

 		</div>

 		<script>
 			var userLoggedIn = '<?php echo $userLoggedIn; ?>';
 			$(document).ready(function() {
 				$('#loading').show()

 				//Original ajax request for loading first posts
 				$.ajax({
 					url: "includes/handlers/ajax_load_posts.php", 
 					type: "POST",
 					data: "page=1&userLoggedIn" + userLoggedIn,
 					cache: false,

 					success: function(data) {
 						$('#loading').hide();
 						$('.posts_area').html(data);
 					}
 				});
 				$(window.scroll(function() {
 					var height = $('.post_area').height(); //Div containing post
 					var scroll_top = $(this).scrollTop();
 					var page = $('.posts_area').find('.nextPage').val();
 					var noMorePosts = $('.posts_area').find('.noMorePosts').val();

 					if((document.body.scrollHeight == document.body.scollTop + window.innerHeight) && noMorePosts == 'false') {
 						$('#loading').show();
 						

	 				var ajaxReq = $.ajax({
	 					url: "includes/handlers/ajax_load_posts.php", 
	 					type: "POST",
	 					data: "page=" + page + "&userLoggedIn" + userLoggedIn,
	 					cache: false,

	 					success: function(response) {
	 						$('.posts_area').find('.nextPage').remove(); //Remove current page
	 						$('.posts_area').find('.noMorePosts').remove();

	 						$('#loading').hide();
	 						$('.posts_area').append(repsonse);
	 					}
	 				});

 					} //End if

 					return false;
 				}); //End (window).scroll(function())
 			});
 		</script>

	</div>
</body>
</html>