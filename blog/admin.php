<html>
	<head>	
		<title>Admin</title>
	</head>
	<body>
		<?php
		session_start();
		require('connection.php');
		require('function.php');

		if(empty($_SESSION['admin'])) {
			echo '<form action="login.php" method="post">';
			echo '<input type="text" name="username" placeholder="Username" required autofocus>';
			echo '<input type="password" name="password" placeholder="Password" required>';
			echo '<input type="submit" value="Login">';
			echo '</form>';
		}else {
			$username = $_SESSION['admin'];

			$cmd = "SELECT * FROM `users` WHERE `username`='$username';";
			$rows = mysqli_query($connect, $cmd);

			if($rows) {
				while($row = mysqli_fetch_array($rows)) {
					$add_post = $row['add_post'];
					$add_user = $row['add_user'];
					$edit_user = $row['edit_user'];
					$delete_user = $row['delete_user'];
					$add_category = $row['add_category'];
					$delete_category = $row['delete_category'];
				}
			}

			if(!empty($_GET['h'])) {
				$edit = 1;
				$headline = $_GET['h'];
				$readonly = " readonly";
				$required = "";

				$cmd = "SELECT * FROM `posts` WHERE `headline`='$headline';";
				$rows = mysqli_query($connect, $cmd);
				$num = mysqli_num_rows($rows);

				if($num > 0) {
					if($rows) {
						while($row = mysqli_fetch_array($rows)) {
							$body = $row['body'];
							$preview = $row['preview'];
							$category = $row['category'];
							$tags = $row['tags'];
							$image = $row['image'];
						}
					}
				}else {
					show_msg('<h1>Post not found</h1>', '<a href="index.php">Go home</a>');
				}
			}else {
				$edit = 0;
				$headline = "";
				$body = "";
				$preview = "";
				$category = "";
				$tags = "";
				$image = "";
				$readonly = "";
				$required = " required";
			}

			if($add_post == 1) {
				echo '<form action="save.php" method="post" enctype="multipart/form-data">';
				echo '<input type="hidden" name="edit" value="'.$edit.'">';
				echo '<label>*</label><input type="text" name="headline" value="'.$headline.'" placeholder="Headline"'.$required.$readonly.' autofocus>';
				echo '<label>*</label><input type="file" name="body"'.$required.'>';
				echo '<input type="text" name="preview" value="'.$preview.'" placeholder="Preview">';
				echo '<label>*</label><select name="category"'.$required.'>';
				echo '<option value="0">Choose category</option>';

				$cmd = "SELECT * FROM `category`;";
				$rows = mysqli_query($connect, $cmd);
				$num = mysqli_num_rows($rows);

				if($rows) {
					while($row = mysqli_fetch_array($rows)) {
						$name = $row['name'];

						if($name == $category) {
							$selected = " selected";
						}else {
							$selected = "";
						}

						echo '<option value="'.$name.'"'.$selected.'>'.$name.'</option>';
					}
				}

				echo '</select>';
				echo '<input type="text" name="tags" value="'.$tags.'" placeholder="Tags(separate with commas)">';
				echo '<input type="file" name="image">';
				echo '<input type="submit" value="Save post">';
				echo '</form>';	
			}else {
				show_msg('<h1>You dont have privilege to add posts</h1>', '');
			}

			if($add_user == 1) {
				if(!empty($_GET['u'])) {
					$edit = 1;
					$user = $_GET['u'];
					$full_name = $row['full_name'];

					$cmd = "SELECT * FROM `users` WHERE `username`='$user'";
					$rows = mysqli_query($connect, $cmd);

					if($rows) {
						while($row = mysqli_fetch_array($rows)) {
							$full_name = $row['full_name'];
							$ap = $row['add_post'];
							$ep = $row['edit_post'];
							$dp = $row['delete_post'];
							$au = $row['add_user'];
							$eu = $row['edit_user'];
							$du = $row['delete_user'];
							$ac = $row['add_category'];
							$dc = $row['delete_category'];

							if($ap == 1) {
								$ap = " checked";
							}

							if($ep == 1) {
								$ep = " checked";
							}

							if($dp == 1) {
								$dp = " checked";
							}

							if($au == 1) {
								$au = " checked";
							}

							if($eu == 1) {
								$eu = " checked";
							}

							if($du == 1) {
								$du = " checked";
							}

							if($ac == 1) {
								$ac = " checked";
							}

							if($dc == 1) {
								$dc = " checked";
							}
						}
					}

					$password = "";
					$readonly = " readonly";
					$required = "";
				}else {
					$edit = 0;
					$user = "";
					$password = "";
					$readonly = "";
					$required = " required";
					$full_name = "";
					$ap = "";
					$ep = "";
					$dp = "";
					$au = "";
					$eu = "";
					$du = "";
					$ac = "";
					$dc = "";
				}

				echo '<form action="register.php" method="post" enctype="multipart/form-data">';
				echo '<input type="hidden" name="edit" value="'.$edit.'">';
				echo '<label>*</label><input type="text" name="username" value="'.$user.'" placeholder="Username"'.$required.$readonly.' autofocus>';
				echo '<label>*</label><input type="password" name="password" placeholder="Password"'.$required.'>';
				echo '<input type="text" name="full_name" value="'.$full_name.'" placeholder="Full name">';
				echo '<input type="file" name="image">';
				echo '<fieldset>';
				echo '<legend>Set privileges</legend>';
				echo '<label><input type="checkbox" name="add_post"'.$ap.'>Add post</label>';
				echo '<label><input type="checkbox" name="edit_post"'.$ep.'>Edit post</label>';
				echo '<label><input type="checkbox" name="delete_post"'.$dp.'>Delete post</label>';
				echo '<label><input type="checkbox" name="add_user"'.$au.'>Add user</label>';
				echo '<label><input type="checkbox" name="edit_user"'.$eu.'>Edit user</label>';
				echo '<label><input type="checkbox" name="delete_user"'.$du.'>Delete user</label>';
				echo '<label><input type="checkbox" name="add_category"'.$ac.'>Add category</label>';
				echo '<label><input type="checkbox" name="delete_category"'.$dc.'>Delete category</label>';
				echo '</fieldset>';
				echo '<input type="submit" value="Save admin">';
				echo '</form>';
			}else {
				show_msg('<h1>You dont have privilege to add admins</h1>', '');
			}

			if($edit_user == 1) {
				echo '<form action="admin.php" method="get">';
				echo '<select name="u" required>';
				echo '<option value="0">Choose user</option>';

				$cmd = "SELECT * FROM `users`;";
				$rows = mysqli_query($connect, $cmd);

				if($rows) {
					while($row = mysqli_fetch_array($rows)) {
						$user = $row['username'];
						echo '<option value="'.$user.'">'.$user.'</option>';
					}
				}

				echo '<input type="submit" value="Change admin">';
				echo '</form>';
			}else {
				show_msg('<h1>You dont have privilege to edit admins</h1>', '');
			}

			if($delete_user == 1) {
				echo '<form action="delete.php?user=true" method="post">';
				echo '<fieldset>';
				echo '<legend>Delete admins</legend>';

				$cmd = "SELECT * FROM `users`;";
				$rows = mysqli_query($connect, $cmd);

				if($rows) {
					while($row = mysqli_fetch_array($rows)) {
						$user = $row['username'];
						echo '<label><input type="checkbox" name="users[]" value="'.$user.'">'.$user.'</label>';
					}
				}

				echo '</fieldset>';
				echo '<input type="submit" value="Delete">';
				echo '</form>';
			}else {
				show_msg('<h1>You dont have privilege to delete admins</h1>', '');
			}

			if($add_category == 1) {
				echo '<form action="category.php?add=true" method="post">';
				echo '<label>*</label><input type="text" name="category" placeholder="Category name" required>';
				echo '<input type="submit" value="Add category">';
				echo '</form>';
			}else {
				show_msg('<h1>You dont have privilege to add categories</h1>', '');
			}

			if($delete_category == 1) {
				echo '<form action="category.php?delete=true" method="post">';
				echo '<fieldset>';
				echo '<legend>Delete categories</legend>';

				$cmd = "SELECT * FROM `category`;";
				$rows = mysqli_query($connect, $cmd);

				if($rows) {
					while($row = mysqli_fetch_array($rows)) {
						$category = $row['name'];
						echo '<label><input type="checkbox" name="categories[]" value="'.$category.'">'.$category.'</label>';
					}
				}

				echo '</fieldset>';
				echo '<input type="submit" value="Delete">';
				echo '</form>';
			}else {
				show_msg('<h1>You dont have privilege to delete categories</h1>', '');
			}

			echo '<a href="logout.php">Logout</a>';

			mysqli_close($connect);
		}
		?>
	</body>
</html>