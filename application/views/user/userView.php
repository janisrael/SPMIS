<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <div class="row">
        <div class="col s4 offset-s4 bot" style="margin-top:35px;margin-bottom:15px;border-radius:15px;padding:40px 40px 0px 40px">
          <h2 class="left-align" style="font-size:44px;text-transform: inherit !important;padding:0px;margin:0px">Welcome!</h2>
          <h6 class="left-align">Please Login with your credentials</h6>
          <div class="divider" style="margin-top:15px;margin-bottom:20px"></div>
            <div class="row" style="padding:20px;">
                <?php echo form_open("user/login",'class="col s12"'); ?>
                    <div class="row" style="margin-bottom:5px !important">
                        <div class="input-field col s12" >
                            <div class="fa fa-user-circle prefix"></div>
                            <input id="username" name="username" type="text" required autocomplete="off">
                            <label for="username">Username</label>
                        </div>
                    </div>

<!-- 
                    <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                             <input id="username" type="text" class="form-control" name="username" value="" placeholder="username or email">                                        
                    </div> -->

                    <div class="row">
                        <div class="input-field col s12">
                            <div class="fa fa-lock prefix"></div>
                            <input id="pass" name="password" type="password" required autocomplete="off">
                            <label for="pass">Password</label>
                        </div>
                    </div>
                    <?php if($this->session->flashdata("loginFailed")): ?>
                      <div class="row">
                        <div class="col 12 red-text">
                          <div class="fa fa-warning"></div> <?php echo $this->session->flashdata("loginFailed"); ?>
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php if($this->session->flashdata("logout")): ?>
                      <div class="row">
                        <div class="col 12 green-text">
                          <div class="fa fa-check"></div> <?php echo $this->session->flashdata("logout"); ?>
                        </div>
                      </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col s12">
                            <p class="right-align">
                                <button class="btn btn-large green darken-4 waves-effect waves-light" type="submit" name="action" style="width:100% !important;">Login</button>
                            </p>
                   
                        </div>
                    </div>

                <?php form_close(); ?>

                <?php if($this->session->userdata('sppmo')): ?>
                <div class="col s12" style="text-align: center !important;"><a href="<?php echo base_url('user/register'); ?>">Register</a></div>
            <?php endif; ?>
            </div>
        </div>
    </div>



</div>
