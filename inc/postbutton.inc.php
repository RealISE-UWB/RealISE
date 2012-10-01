<div class="well">
            <form action="/post" method="POST">
            <? $_SESSION['posttoken'] = uniqid(); echo "<input type=\"hidden\" name=\"token\" value=\"".$_SESSION['posttoken']."\" />\n"; ?>
            <input type="text" class="span3" id="textarea" style="margin: 0 auto;" placeholder="What do you want to amplify?" name="text" data-provide="typeahead" data-items="4" data-source='["#AmplifyUWB","#AmplifyUW","#FreeFood","University of Washington Bothell","University of Washington","Washington","Bothell"]'>
         	<button type="submit" class="btn btn-primary"><i class="icon-edit"></i> Amplify</button>
         	</form>
</div>