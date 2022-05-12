

<div class="row">
	<div class="col form-control">
		<form class="col-md-12" action="<?php echo base_url("edit/dashboard/".base64_encode($dashboard->id)) ?>" method="post" />
			<div class="row">
				<div class="col-md-12 col-sm124 col-xs-12 form-group" style=" margin-top: 25px;">
					<h6>Name</h6>
					<input autocomplete="off" value="<?php echo $dashboard->name ?>" required type="text" name="name" class="form-control">
				</div>
				<div class="col-md-12 col-sm124 col-xs-12  form-group">
					<h6>Description</h6>
					<textarea autocomplete="off"  type="text" name="description" class="form-control"><?php echo $dashboard->description; ?></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Update</button>
			</div>
		</form>
		<form class="col-md-12" action="<?php echo base_url("delete/dashboard/".base64_encode($dashboard->id)) ?>" method="post" />
			<div class="row">
				<div class="col-md-12 col-sm124 col-xs-12 form-group">
					<h6>Enter dashboard name </h6>
					<small>with exact spelling</small>
					<p style="color:red">Please note: deleting a dashboard will delete everything configured within it</p>
					<input autocomplete="off" placeholder="<?php echo $dashboard->name ?>" required type="text" name="name" class="form-control">
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-danger">Delete</button>
			</div>
		</form>


	</div>

		<div class="col " style="background-color:#f4f6f8;">
		<h6>Categories/Checklists/Tabs</h6>
		<form action="<?php echo base_url('add/tab/') ?>" method="post">
		<input type="hidden" name="current_selected_period_format" id="current_selected_period_format" value=0></input>
			<input autocomplete="off" required type="text" maxlength="30" name="name" class="form-control"></input>
			<input hidden required type="text" name="dash_id" value="<?php echo $dashboard->id ?>" class="form-control"></input>
			<button style="margin-top: 10px;" class="btn btn-primary ol-md-6 form-control">Add</button>
		</form>
		<hr>
		<h6> Tabs </h6>
		<table class="table">
			<tr>
				<th>Tab Name</th>
				<th>Action</th>
			</tr>
			<?php
				if (isset($tabs)) {
				  foreach ($tabs as $tab) : ?>
			<tr id="<?php echo $tab->id; ?>" >
				<td>
					<?php echo $tab->name; ?>
					<form>
						<input type="hidden" name="tab_id"  value="<?php echo $tab->id; ?>">
					</form>
				</td>
				<td><a><i class="fa fa-trash col-md-12 remove" style="margin-left: 10px;color:red;"></i></a></td>
			</tr>
			<?php endforeach;
				} ?>
		</table>
	</div>


</div>

<script>
	

	$(".remove").click(function() {
	
		var id = $(this).closest('tr').attr('id');
		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't be able to revert this!",
		  icon: 'warning',
		  showCancelButton: true,
	 	  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
		if (result.isConfirmed) {

		 $.ajax({
		     url: '<?php echo base_url()?>delete/tab/'+id,
		     type: 'DELETE',
		     error: function() {
		  
		     },
		     success: function(data) {
		         console.log(data);
		
		          $("#"+JSON.parse(data)).remove();
		  
		     }
		  });
		
		 
		}
		})
	
	});


</script>



	
