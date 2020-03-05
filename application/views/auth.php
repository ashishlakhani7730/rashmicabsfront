<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php require_once("header.php"); ?>
<div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Authentication</h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="#">GO TO HOME</a></li>
                   
                </ul>
            </div>
        </div>

     
         <section id="content">
            <div class="container">
                <div id="main">
                   
                    <div class="contact-address row block">
                        <div class="col-md-6">
                            <div class="travelo-box box-full">
                        <div class="contact-form">
                            <h2>Login in your account</h2>
                            <form class="contact-form" action="contact-us-handler.php" method="post" onsubmit="return false;">
                                <div class="alert small-box" style="display: none;"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>EMAIL ID/MOBILE NUMBER</label>
                                            <input type="text" name="name" class="input-text full-width">
                                        </div>
                                        <div class="form-group">
                                            <label>PASSWORD</label>
                                            <input type="PASSWORD" name="subject" class="input-text full-width">
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="col-md-12">
                                    <button type="submit" class="btn-medium full-width">LOGIN</button>
                                </div>

                                </div><br>
                                    <div class="form-group">
                                        <a href="#" class="forgot-password pull-right">Forgot password?</a>
                        
                                    </div>
                               
                            </form>
                        </div>
                    </div>
                        </div>
                        <div class="col-md-6">
                           <div class="travelo-box box-full">
                        <div class="contact-form">
                            <h2>Don't have an account? Signup Here</h2>
                            <form class="contact-form" action="contact-us-handler.php" method="post" onsubmit="return false;">
                                <div class="alert small-box" style="display: none;"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>FIRST NAME</label>
                                            <input type="text" name="name" class="input-text full-width">
                                        </div>
                                         <div class="form-group">
                                            <label>LAST NAME</label>
                                            <input type="text" name="name" class="input-text full-width">
                                        </div>
                                         <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input type="text" name="subject" class="input-text full-width">
                                        </div>
                                        <div class="form-group">
                                            <label>Your Email</label>
                                            <input type="text" name="email" class="input-text full-width">
                                        </div>
                                       
                                          <div class="form-group">
                                            <label>PASSWORD</label>
                                            <input type="PASSWORD" name="subject" class="input-text full-width">
                                        </div>
                                         <div class="form-group">
                                            <label>CONFIRM PASSWORD</label>
                                            <input type="PASSWORD" name="subject" class="input-text full-width">
                                        </div>
                                         
                                    </div>
                                    <div class="col-md-12">
                                    <button type="submit" class="btn-medium full-width">SIGNUP</button>
                                </div>
                                </div>

                               
                            </form>
                        </div>
                    </div>
                        </div>
                       
                    </div>
                   
                </div>
            </div>
        </section>
<?php require_once("footer.php"); ?>