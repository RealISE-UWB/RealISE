<?
include("inc/settings.inc.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>RealISE <? echo $school["acronym"]; ?></title>
    <? require_once("$base/inc/header.inc.php"); ?>  
  </head>

  <body data-spy="scroll" data-target=".subnav" data-offset="50">


<? require_once("$base/inc/navbar.inc.php"); ?>

    <div class="container">
	
		<!-- Masthead
		================================================== -->
			<div class="hero-unit">
				<div class="progress progress-info progress-striped active">
		        	<div class="bar" style="width: 25%"></div>
		        </div>
		        
		        <h2>Welcome to RealISE UWB's Volunteer Request Form</h2>
			    <p class="lead">We have a series of questions you need to fill out to get started. If you don't have time to finish 11 and beyond, just sign in again with your ID and you can finish them up at your convenience. </p>
		
		    </div><!-- End hero unit -->
			
			<form class="form-horizontal well">
		        <fieldset>
		          <legend>Volunteer Request Form</legend>
		          <div class="control-group">
		            <label class="control-label" for="Fname">First Name</label>
		            <div class="controls">
		              <input type="text" class="input-xlarge" id="Fname" placeholder="Holly">
		            </div>
		          </div>
		          
		          <div class="control-group">
		            <label class="control-label" for="Lname">Last Name</label>
		            <div class="controls">
		              <input type="text" class="input-xlarge" id="Lname" placeholder="Husky">
		            </div>
		          </div>
		          
		          <div class="control-group">
		            <label class="control-label" for="ageVal">Over 25?</label>
		            <div class="controls">
		              <label class="checkbox">
		                <input type="checkbox" id="ageVal" placeholder="ageVal">
		              </label>

		            </div>
		                <p class="help-block span3">Some organizations like to know if you are over 25 because they might have you drive their car whose insurance requires the driver to be over 25 years of age.</p>		          
		          </div>
		          
		          <div class="control-group">
		            <label class="control-label" for="email">Email Address</label>
		            <div class="controls">
		              <input type="text" class="input-xlarge" id="email" placeholder="hhusky@uw.edu">
		            </div>
		          </div>
		          
		          <div class="control-group">
		            <label class="control-label" for="license">Driver's license</label>
		            <div class="controls">
		              <select id="license">
		                <option>No</option>
		                <option>Yes</option>
		              </select>
		            </div>
		          </div>
		          
		          <div class="control-group">
		            <label class="control-label" for="zipcode">Zip Code</label>
		            <div class="controls">
		              <input type="text" class="input-xlarge" id="zipcode" placeholder="98011">
		            </div>
		          </div>
		          
		          <div class="control-group">
		            <label class="control-label" for="datesAvail">Dates Available</label>
		            <div class="controls">
		              <textarea class="input-xlarge" id="datesAvail" rows="3">I would like to request all major holidays off. Also, August 23 - 25. These are reserved for a family vacation.</textarea>
		            </div>
		          </div>
		          
		          <div class="control-group">
		            <label class="control-label" for="timesAvail">Times Available</label>
		            <div class="controls">
		              <textarea class="input-xlarge" id="timesAvail" rows="3">I am available to meet for 2 hours a day in between the hours of 9am to 3pm.</textarea>
		            </div>
		          </div>
		          		          
		          <div class="control-group">
		            <label class="control-label" for="interest">Interest(s)</label>
		            <div class="controls">
		              <input type="text" class="input-xlarge" id="interest1" placeholder="Helping others">
		              <span class="add-on">1</span>
		            </div>
		            <br>
		            <div class="controls">
		               <input type="text" class="input-xlarge" id="interest2" placeholder="Driving">
		               <span class="add-on">2</span>

		            </div>
		            <br>
		            <div class="controls">
		            	
		              <input type="text" class="input-xlarge" id="interest3" placeholder="UW Bothell">
		              <span class="add-on">3</span>
		            </div>		          
		          </div>
		          
		          <hr>
		          
		          <div class="control-group">
		            <label class="control-label" for="interest">Skills</label>
		            <div class="controls">
		              
		              <input type="text" class="input-xlarge" id="interest1" placeholder="Building houses">
		              <span class="add-on">1</span>
		            </div>
		            <br>
		            <div class="controls">
		            	
		               <input type="text" class="input-xlarge" id="interest2" placeholder="Helping others">
		               <span class="add-on">2</span>
		            </div>
		            <br>
		            <div class="controls">
		            	
		              <input type="text" class="input-xlarge" id="interest3" placeholder="Computer setup">
		              <span class="add-on">3</span>
		            </div>		          
		          </div>
		          
		          <div class="control-group">
		            <label class="control-label" for="timesAvail">Volunteer Experience</label>
		            <div class="controls">
		              <textarea class="input-xlarge" id="timesAvail" rows="4">I volunteered in the Boys & Girls Club in Seattle for the past 4 years. Currently, I help feed the homeless down town Seattle every Thursday night from 7-8pm.</textarea>
		            </div>
		          </div>
		          
		          <div class="control-group">
		            <label class="control-label" for="fileInput">Upload your resume</label>
		            <div class="controls">
		              <input class="input-file" id="fileInput" type="file">
		            </div>
		          </div>
		          
				  <div class="form-actions">
		            <button type="submit" href="/orgs.php" class="btn btn-info">Submit</button>
		            <button type="reset" class="btn">Cancel</button>
		          </div>
		          		          		          	          			          		          		          
		        </fieldset>
		      </form>
		    
	    
	</div><!-- /container -->
	
	
	
	    <? require_once("$base/footer.inc.php");?>
