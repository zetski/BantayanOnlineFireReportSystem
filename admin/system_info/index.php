<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success');
</script>
<?php endif; ?>

<style>
	img#cimg {
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100%;
	}
	img#cimg2 {
		height: 50vh;
		width: 100%;
		object-fit: contain;
	}
	img#event_image_preview {
		height: 50vh;
		width: 100%;
		object-fit: contain;
	}
</style>

<div class="col-lg-12">
	<div class="card card-outline rounded-0 card-danger">
		<div class="card-header">
			<h5 class="card-title">System Information</h5>
		</div>
		<div class="card-body">
			<form action="" id="system-frm">
				<div id="msg" class="form-group"></div>
				<!-- System Info Fields -->
				<div class="form-group">
					<label for="name" class="control-label">System Name</label>
					<input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $_settings->info('name') ?>">
				</div>
				<div class="form-group">
					<label for="short_name" class="control-label">System Short Name</label>
					<input type="text" class="form-control form-control-sm" name="short_name" id="short_name" value="<?php echo $_settings->info('short_name') ?>">
				</div>
				<div class="form-group">
					<label for="" class="control-label">Welcome Content</label>
					<textarea name="content[welcome]" id="welcome_content" cols="30" rows="2" class="form-control summernote"><?php echo is_file(base_app.'welcome.html') ? file_get_contents(base_app.'welcome.html') : ""; ?></textarea>
				</div>
				<div class="form-group">
					<label for="" class="control-label">About Us</label>
					<textarea name="content[about]" id="about_content" cols="30" rows="2" class="form-control summernote"><?php echo is_file(base_app.'about.html') ? file_get_contents(base_app.'about.html') : ""; ?></textarea>
				</div>
				<!-- Logo Upload Section -->
				<div class="form-group">
					<label for="customFile1" class="control-label">System Logo</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="customFile1" name="img" onchange="displayImg(this)">
						<label class="custom-file-label" for="customFile1">Choose file</label>
					</div>
				</div>
				<div class="form-group d-flex justify-content-center">
					<img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
				</div>
				<!-- Cover Upload Section -->
				<div class="form-group">
					<label for="customFile2" class="control-label">Website Cover</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="customFile2" name="cover" onchange="displayImg2(this)">
						<label class="custom-file-label" for="customFile2">Choose file</label>
					</div>
				</div>
				<div class="form-group d-flex justify-content-center">
					<img src="<?php echo validate_image($_settings->info('cover')) ?>" alt="" id="cimg2" class="img-fluid img-thumbnail">
				</div>
				<!-- Banner Upload Section -->
				<div class="form-group">
					<label for="customFile3" class="control-label">Banner Images</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="customFile3" name="banners[]" multiple accept=".png,.jpg,.jpeg" onchange="displayImg3(this)">
						<label class="custom-file-label" for="customFile3">Choose file</label>
					</div>
					<small><i>Choose to upload new banner images</i></small>
				</div>
				<?php 
				$upload_path = "uploads/banner";
				if(is_dir(base_app.$upload_path)):
				$file = scandir(base_app.$upload_path);
				foreach($file as $img):
					if(in_array($img, ['.', '..'])) continue;
				?>
				<div class="d-flex w-100 align-items-center img-item">
					<span><img src="<?php echo base_url.$upload_path.'/'.$img."?v=".(time()) ?>" width="150px" height="100px" style="object-fit:cover;" class="img-thumbnail" alt=""></span>
					<span class="ml-4"><button class="btn btn-sm btn-default text-danger rem_img" type="button" data-path="<?php echo base_app.$upload_path.'/'.$img ?>"><i class="fa fa-trash"></i></button></span>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>
			</form>
		</div>
		<div class="card-footer">
			<button class="btn btn-sm btn-primary" form="system-frm">Update</button>
		</div>
	</div>

	<!-- Event Management Section -->
	<div class="card card-outline rounded-0 card-success mt-4">
		<div class="card-header">
			<h5 class="card-title">Manage Events</h5>
		</div>
		<div class="card-body">
			<form action="save_event.php" id="event-frm" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="event_name" class="control-label">Event Name</label>
					<input type="text" class="form-control form-control-sm" name="event_name" id="event_name" required>
				</div>
				<div class="form-group">
					<label for="event_description" class="control-label">Event Description</label>
					<textarea name="event_description" id="event_description" cols="30" rows="4" class="form-control form-control-sm" required></textarea>
				</div>
				<div class="form-group">
					<label for="event_date" class="control-label">Event Date</label>
					<input type="date" class="form-control form-control-sm" name="event_date" id="event_date" required>
				</div>
				<div class="form-group">
					<label for="event_location" class="control-label">Event Location</label>
					<input type="text" class="form-control form-control-sm" name="event_location" id="event_location" required>
				</div>
				<div class="form-group">
					<label for="event_image" class="control-label">Event Image</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="customFile4" name="event_image" onchange="displayImg(this)">
						<label class="custom-file-label" for="customFile4">Choose file</label>
					</div>
				</div>
				<div class="form-group d-flex justify-content-center">
					<img src="" alt="" id="event_image_preview" class="img-fluid img-thumbnail">
				</div>
				<div class="form-group">
					<button class="btn btn-sm btn-success" type="submit">Save Event</button>
				</div>
			</form>
		</div>
	</div>

	<!-- Existing Events List -->
	<div class="card card-outline rounded-0 card-warning mt-4">
		<div class="card-header">
			<h5 class="card-title">Existing Events</h5>
		</div>
		<div class="card-body">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Event Name</th>
						<th>Date</th>
						<th>Location</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$events = $conn->query("SELECT * FROM events_list ORDER BY event_date DESC");
					$i = 1;
					while($row = $events->fetch_assoc()): ?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['event_name'] ?></td>
						<td><?php echo $row['event_date'] ?></td>
						<td><?php echo $row['event_location'] ?></td>
						<td>
							<button class="btn btn-sm btn-info">Edit</button>
							<button class="btn btn-sm btn-danger">Delete</button>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	function displayImg(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#event_image_preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$('.rem_img').click(function () {
		_conf("Are you sure to delete this image permanently?", "delete_img", [$(this).attr('data-path')])
	});

	function delete_img($path) {
		start_loader()
		$.ajax({
			url: _base_url_ + 'classes/Master.php?f=delete_img',
			method: 'POST',
			data: { path: $path },
			dataType: 'json',
			error: err => {
				console.log(err)
				alert_toast("An error occurred.", 'error');
				end_loader();
			},
			success: function (resp) {
				if (resp.status == 'success') {
					location.reload();
				} else {
					alert_toast("An error occurred.", 'error');
					end_loader();
				}
			}
		})
	}
</script>
