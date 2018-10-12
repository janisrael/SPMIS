<section class='header container'>
	<h6>Property Management Office</h6>
	<h4>Property Transfer</h4>
  <hr>
</section>

<div class="container">
  <div class="row">
    <div class="col l3">
			<div class="row">
				<div class="col l12">
					<select name="transUser" id="transUser" class="select2 form-control transUser" style="width:100px">
		        <?php if($users): ?>
		          <option disabled selected value="0">From End User</option>
		          <?php foreach($users as $user): ?>
		            <option value="<?php echo $user['personID']; ?>"><?php echo $user['surName'].', '.$user['firstName'].' '.$user['middleName'].' '.$user["suffixName"]; ?></option>
		          <?php endforeach; ?>
		        <?php else: ?>
		          <option value="">No Data</option>
		        <?php endif; ?>
		      </select>
				</div>
			</div>
			<div class="row">
				<div class="col l12">
		      <select name="transYear" class="transYear" required>
		      </select>
		    </div>
		  </div>
			<div class="row">
				<div class="col l12">
		      <select name="transDoc" class="transDoc" required>
		      </select>
		    </div>
		  </div>
		</div>
		<div class="col l9">
			<div class="row">
				<div class="col l12">
					<table class="bordered highlight responsive-table scrollT transFromTable">
	          <thead>
	            <tr>
	              <th width="5%">Qty</th>
	              <th width="5%">Unit</th>
	              <th width="30%">Description</th>
	              <th width="25%">Property Number</th>
	              <th width="10%">Unit Value</th>
								<th width="10%">Total Value</th>
								<th width="10%">Remarks</th>
	              <th width="5%">Control</th>
	            </tr>
	          </thead>
	          <tbody></tbody>
	        </table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col l3">
			<select name="transTo" id="transTo" class="select2 form-control transTo" style="width:100px">
				<?php if($users): ?>
					<option disabled selected value="0">To End User</option>
					<?php foreach($users as $user): ?>
						<option value="<?php echo $user['personID']; ?>"><?php echo $user['surName'].', '.$user['firstName'].' '.$user['middleName'].' '.$user["suffixName"]; ?></option>
					<?php endforeach; ?>
				<?php else: ?>
					<option value="">No Data</option>
				<?php endif; ?>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col l12">
			<table class="bordered highlight responsive-table transToTable" >
				<thead>
					<tr>
						<th>Qty</th>
						<th>Unit</th>
						<th>Description</th>
						<th>Property Number</th>
						<th>Unit Value</th>
						<th>Total Value</th>
						<th>Remarks</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div>
</div>
