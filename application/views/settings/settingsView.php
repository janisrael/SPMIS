<div class="container">
  <section class='header'>
  	<h6>Property Management Office</h6>
  	<h4>Configuration</h4>
    <hr>
  </section>
  <div class="row">
    <div class="col s3">
      <?php echo form_open("user/changePass",'style="border-radius:15px;border:1px solid #d4d4d4;padding:40px;margin-left:10px"'); ?>
          <div class="row" style="margin-bottom:2px !important">
              <h6 class="left-align"><b>Change Password here</b></h6>
          </div>
          <div class="row" style="margin-bottom:2px !important">
              <div class="input-field col s12" >
                  <input id="oldPass" name="oldPass" type="password" required autocomplete="off">
                  <label for="oldPass">Old Password</label>
              </div>
          </div>
          <div class="row" style="margin-bottom:2px !important">
              <div class="input-field col s12">
                  <input id="newPass" name="newPass" class="validate" type="password" required autocomplete="off">
                  <label for="newPass">New Password</label>
              </div>
          </div>
          <div class="row" style="margin-bottom:2px !important">
              <div class="input-field col s12">
                  <input id="confirmPass" name="confirmPass" type="password" required autocomplete="off">
                  <label for="confirmPass">Confirm Password</label>
              </div>
          </div>
          <?php if($this->session->flashdata("probDetails")): ?>
            <div class="row">
              <div class="col 12 red-text">
                <div class="fa fa-warning"></div> <?php echo $this->session->flashdata("probDetails"); ?>
              </div>
            </div>
          <?php endif; ?>
          <?php if($this->session->flashdata("doneChanged")): ?>
            <div class="row">
              <div class="col 12 green-text">
                <div class="fa fa-check"></div> <?php echo $this->session->flashdata("doneChanged"); ?>
              </div>
            </div>
          <?php endif; ?>
          <div class="row">
              <div class="col s12">
                  <p class="right-align">
                      <button class="btn btn-small green darken-4 waves-effect waves-light" type="submit" name="action">Change Password</button>
                  </p>
              </div>
          </div>
      <?php form_close(); ?>
    </div>
    <div class="col s9" style="border-radius:15px;border:1px solid #d4d4d4;padding:40px" >
        <ul class="tabs">
          <li class="tab col s4"><a class="active" href="#test1">Update Log</a></li>
          <li class="tab col s4"><a href="#test3">Session Log</a></li>
          <li class="tab col s4"><a href="#test4">All Log</a></li>
        </ul>
      <div id="test1" class="col s12" style="height: 305px; overflow-x: hidden;">
        <br>
      <?php if($updatelogs): ?>
        <?php foreach($updatelogs as $updatelog): ?>
        <div class="row" style="margin-bottom:0;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;">
          <div class="col s2">
            <?php echo "<b class='right'>Username:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo $updatelog["username"]; ?>
          </div>
          <div class="col s2">
            <?php echo "<b class='right'>Date:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo date('m/d/y',$updatelog["timestamp"]); ?>
          </div>
        </div>
        <div class="row" style="margin-bottom:0;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;">
          <div class="col s2">
            <?php echo "<b class='right'>Action:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo $updatelog["logType"]; ?>
          </div>
          <div class="col s2">
            <?php echo "<b class='right'>Time:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo date('h:i:s',$updatelog["timestamp"]); ?>
          </div>
        </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
      <div id="test3" class="col s12" style="height: 305px; overflow-x: hidden;">
        <br>
      <?php if($sessionlogs): ?>
        <?php foreach($sessionlogs as $sessionlog): ?>
        <div class="row" style="margin-bottom:0;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;">
          <div class="col s2">
            <?php echo "<b class='right'>Username:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo $sessionlog["username"]; ?>
          </div>
          <div class="col s2">
            <?php echo "<b class='right'>Date:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo date('m/d/y',$sessionlog["timestamp"]); ?>
          </div>
        </div>
        <div class="row" style="margin-bottom:0;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;">
          <div class="col s2">
            <?php echo "<b class='right'>Action:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo $sessionlog["logType"]; ?>
          </div>
          <div class="col s2">
            <?php echo "<b class='right'>Time:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo date('h:i:s',$sessionlog["timestamp"]); ?>
          </div>
        </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
      <div id="test4" class="col s12" style="height: 305px; overflow-x: hidden;">
        <br>
      <?php if($alllogs): ?>
        <?php foreach($alllogs as $alllog): ?>
        <div class="row" style="margin-bottom:0;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;">
          <div class="col s2">
            <?php echo "<b class='right'>Username:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo $alllog["username"]; ?>
          </div>
          <div class="col s2">
            <?php echo "<b class='right'>Date:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo date('m/d/y',$alllog["timestamp"]); ?>
          </div>
        </div>
        <div class="row" style="margin-bottom:0;border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;">
          <div class="col s2">
            <?php echo "<b class='right'>Action:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo $alllog["logType"]; ?>
          </div>
          <div class="col s2">
            <?php echo "<b class='right'>Time:</b> "; ?>
          </div>
          <div class="col s2">
            <?php echo date('h:i:s',$alllog["timestamp"]); ?>
          </div>
        </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
