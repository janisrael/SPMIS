<section class='header container'>
	<h6>Property Management Office</h6>
	<h4>IAR/SP</h4>
  <hr>
</section>

<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="section">
        <a class='green darken-4 btn waves-effect waves-light' href='#iarAdd'>New Inspection <div class="fa fa-plus"></div></a>
        <table class="bordered highlight" id='iarTable'>
          <thead>
            <tr>
              <th>IAR No.</th>
              <th>Date Issued</th>
              <th>Inspector</th>
							<th>Supplier</th>
              <th>Office</th>
              <th>Control</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
        </div>
        <br> <!-- section -->
      </div> <!-- section -->
    </div> <!-- row -->
</div> <!-- container -->

<!-- MODAL AREA -->
<div id="iarAdd" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4 class="">New IAR (Inspection &amp; Acceptance Report)</h4>
    <div class="divider"></div>
    <?php echo form_open('supply/newIAR'); ?>
    <div class="content">
      <div class="section">
        <div class="row">
					<div class="col s2">
						<h6 class="right"><b> Supplier:</b></h6>
					</div>
					<div class="col s3">
						<select name="supplierPAR" class="supplierPAR select2" required autocomplete="off">
							<?php if($suppliers): ?>
								<option disabled selected value="0">Choose Supplier</option>
								<?php foreach($suppliers as $supplier): ?>
									<option value="<?php echo $supplier['supplierID']; ?>"><?php echo $supplier['supplier']; ?></option>
								<?php endforeach; ?>
							<?php else: ?>
								<option value="">No Data</option>
							<?php endif; ?>
						</select>
						<a href="#SupplierAdd" class="tooltipped controlIcon" data-position="top" data-delay="1" data-tooltip="Add Supplier">
								<div class="fa fa-plus effectIcon2"></div>
						</a>
					</div>
          <div class="col s2">
            <h6 class="right"><b>Inspector:</b></h6>
          </div>
          <div class="col s3">
            <select name="inspectNew" class='inspectNew select2' required autocomplete="off">
              <?php if($inspectors): ?>
                <option disabled selected>Choose Inspector</option>
                <?php foreach($inspectors as $inspector): ?>
                  <option value="<?php echo $inspector['personID']; ?>"><?php echo $inspector['surName'].', '.$inspector['firstName'].' '.$inspector['middleName'].' '.$inspector['suffixName']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col s2">
            <h6 class="right"><b>Office:</b></h6>
          </div>
          <div class="col s3">
            <select name="officeID" class="officeID select2" required autocomplete="off">
              <?php if($offices): ?>
                <option disabled selected value="0">Choose Office</option>
                <?php foreach($offices as $office): ?>
                  <option value="<?php echo $office['officeID']; ?>"><?php echo "(".$office['officeAcronym'].") ".$office['office']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
          </div>
					<div class="col s2">
            <h6 class="right"><b>Property Head:</b></h6>
          </div>
          <div class="col s3">
            <select name="head" class='head select2' required autocomplete="off">
              <?php if($users): ?>
                <option disabled>Choose Property Head</option>
                <?php foreach($users as $user): ?>
                  <option value="<?php echo $user['personID']; ?>"><?php echo $user['surName'].', '.$user['firstName'].' '.$user['middleName']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
          </div>
        </div>
				<div class="row">
          <div class="col s2">
            <h6 class="right"><b>PR Number:</b></h6>
          </div>
          <div class="col s3">
            <select name="prNew" class="prNew select2" required autocomplete="off">
              <?php if($prs): ?>
                <option disabled selected value="0">Choose PR</option>
                <?php foreach($prs as $pr): ?>
                  <option value="<?php echo $pr['prID']; ?>"><?php echo $pr['prNo']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
						<a href="#PRAdd" class="tooltipped controlIcon" data-position="top" data-delay="1" data-tooltip="Add PR">
								<div class="fa fa-plus effectIcon2"></div>
						</a>
          </div>
					<div class="col s2">
            <h6 class="right"><b>PO Number:</b></h6>
          </div>
          <div class="col s3">
            <select name="poNew" class='poNew select2' required autocomplete="off">
              <?php if($pos): ?>
                <option disabled selected>Choose PO</option>
                <?php foreach($pos as $po): ?>
                  <option value="<?php echo $po['poID']; ?>"><?php echo $po['poNo']; ?></option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="">No Data</option>
              <?php endif; ?>
            </select>
						<a href="#POAdd" class="tooltipped controlIcon" data-position="top" data-delay="1" data-tooltip="Add PO">
								<div class="fa fa-plus effectIcon2"></div>
						</a>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s3 offset-s2">
            <div class="fa fa-file-text-o prefix"></div>
              <input name="codeNew" id="codeNew2" type="text" required autocomplete="off">
              <label for="codeNew2">IAR No:</label>
          </div>
          <div class="input-field col s3 offset-s1">
              <div class="fa fa-calendar prefix"></div>
              <input name="dateNew" id="dateNew2" type="text" class="datepicker" required>
              <label for="dateNew2">Date Issued:</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s3 offset-s2">
              <div class="fa fa-file-text-o prefix"></div>
              <input name="orNew" id="orNew2" type="text" required autocomplete="off">
              <label for="orNew2">Official Receipt (OR):</label>
          </div>
          <div class="input-field col s3 offset-s1">
              <div class="fa fa-calendar prefix"></div>
              <input name="dateGivenOR" id="dateGivenOR2" type="text" class="datepicker" required autocomplete="off">
              <label for="dateGivenOR2">Date OR Given:</label>
          </div>
        </div>
      </div> <!-- section end div -->
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat" type="submit">Add</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Close</button>
  </div>
</div>

<div id="SupplierAdd" class="modal modal-fixed-footer" style="height:500px !important;width:800px !important">
  <div class="modal-content">
    <div class="content">
      <h4 class="">Add Supplier</h4>
      <div class="divider"></div>
      <br>
        <div class="content">
          <div class="section">
            <div class="row">
              <form action="" method="POST" class="newSupplier">
              <div class="input-field col s10 offset-s1">
                  <div class="fa fa-industry prefix"></div>
                  <input name="supp" id="supplier" type="text" required autocomplete="off">
                  <label for="supplier">Supplier:</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s10 offset-s1">
                  <div class="fa fa-address-card-o prefix"></div>
                  <input name="addr" id="addr" type="text" autocomplete="off">
                  <label for="addr">Address:</label>
                </div>
            </div>
            <div class="row">
              <div class="input-field col s4 offset-s1">
                  <div class="fa fa-mobile prefix"></div>
                  <input name="contact" id="contact" type="text" autocomplete="off">
                  <label for="contact">Contact No:</label>
              </div>
            </div>
            </div>
          </div>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat addSupp" type="submit">Add</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>

<div id="PRAdd" class="modal modal-fixed-footer" style="height:300px !important;width:800px !important">
  <div class="modal-content">
    <div class="content">
      <h4 class="">Add PR</h4>
      <div class="divider"></div>
      <br>
        <div class="content">
          <div class="section">
            <div class="row">
              <form action="" method="POST" class="newPr">
              <div class="input-field col s10 offset-s1">
                  <div class="fa fa-file-text-o prefix"></div>
                  <input name="pr" id="pr" type="text" required autocomplete="off">
                  <label for="pr">PR Number:</label>
              </div>
            </div>
          </div>
        </div>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat addSupp" type="submit">Add</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>

<div id="POAdd" class="modal modal-fixed-footer" style="height:300px !important;width:800px !important">
  <div class="modal-content">
    <div class="content">
      <h4 class="">Add PO</h4>
      <div class="divider"></div>
      <br>
        <div class="content">
          <div class="section">
            <div class="row">
              <form action="" method="POST" class="newPo">
              <div class="input-field col s10 offset-s1">
                  <div class="fa fa-file-text-o prefix"></div>
                  <input name="po" id="po" type="text" required autocomplete="off">
                  <label for="po">PO Number:</label>
              </div>
            </div>
          </div>
        </div>
    </div> <!-- content end div -->
  </div> <!-- modal-content end div -->
  <div class="modal-footer">
    <button class="waves-effect waves-green btn-flat addSupp" type="submit">Add</button>
  </form>
    <button class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>
  </div>
</div>
