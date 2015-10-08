<!--<script src="/static/js/mailcheck.min.js"></script>-->
<script type="text/javascript">
    $(function () {
        $("[rel='tooltip']").tooltip();
    });
</script>
<form id="registrationform" class="form-horizontal" method="post" action="#">
<fieldset>
<input id="geolocationlat" name="geolocationlat"  value="<?php if($this->geolocationlat == '43.40' || $this->geolocationlat == ''){echo '43.40';}else{echo $this->geolocationlat;}?>" style="display:none">
<input id="geolocationlng" name="geolocationlng" value="<?php if($this->geolocationlng == '-79.24' || $this->geolocationlng == ''){echo '-79.24';}else{echo $this->geolocationlng;}?>" style="display:none">
<?php if($this->geolocationlat == '43.40' || $this->geolocationlat == ''){?>
  <div id="geolocationwarning" class="alert alert-warning"><?php echo $this->translate('SHARE_LOCATION');?></div>
<?php } ?>
<div id="geolocationparis" style="display:none" class="alert alert-warning"><?php echo $this->translate('SHARE_LOCATION');?></div>
<!-- Form Name -->
<legend><?php echo $this->translate('REGISTER_TITLE');?></legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="email"><?php echo $this->translate('REGISTER_EMAIL');?></label>
  <div class="controls">
    <input id="email" name="email" type="email" placeholder="me@email.com" class="input-large" required="" value="<?php if($this->customer) echo $this->customer->getEmail(); else echo $_POST['email']?>" data-title="<?php echo $this->translate('REGISTER_EMAIL_HELP');?>" data-placement="bottom" rel="tooltip">
    <div class="help-block" id="emailSuggestion" style="display:none"></div>
  </div>
</div>


<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="product"><?php echo $this->translate('REGISTER_TAG');?></label>
  <div class="controls">
    <input maxlength="7" id="product" name="product" type="number" placeholder="1234567" class="input-large" required="" value="<?php echo $_POST['product']?>" data-title="<?php echo $this->translate('REGISTER_TAG_HELP');?>" data-placement="bottom" rel="tooltip">
    <!--<p class="help-block"><?php //echo $this->translate('REGISTER_TAG_HELP');?></p>-->
  </div>
</div>

<span id="old-product" <?php if(!$_POST['product'] || strlen($_POST['product']) == 7){echo "style='display:none'";}else{echo "style='display:block'";}?>>
  <!-- Text input-->
  <div class="control-group">
    <label class="control-label" for="tagshape"><?php echo $this->translate('REGISTER_TAGSHAPE');?></label>
    <div class="controls">
      <select id="tagshape" name="tagshape" type="number" class="input-large" data-title="<?php echo $this->translate('REGISTER_TAGSHAPE_HELP');?>" data-placement="bottom" rel="tooltip">
          <option value="0"><?php echo $this->translate('SELECT_TAGSHAPE');?></option>
          <option value="18" <?php if($_POST['tagshape'] == 18){echo "selected";}?>><?php echo $this->translate('OLDTAG No Year');?></option>
          <option value="1" <?php if($_POST['tagshape'] == 1){echo "selected";}?>><?php echo $this->translate('OLDTAG Circle (Before 2004)');?></option>
          <option value="2" <?php if($_POST['tagshape'] == 2){echo "selected";}?>><?php echo $this->translate('OLDTAG Blue Rosette');?></option>
          <option value="3" <?php if($_POST['tagshape'] == 3){echo "selected";}?>><?php echo $this->translate('OLDTAG Red Heart');?></option>
          <option value="4" <?php if($_POST['tagshape'] == 4){echo "selected";}?>><?php echo $this->translate('OLDTAG Orange Oval');?></option>
          <option value="5" <?php if($_POST['tagshape'] == 5){echo "selected";}?>><?php echo $this->translate('OLDTAG Green Bell');?></option>
          <option value="6" <?php if($_POST['tagshape'] == 6){echo "selected";}?>><?php echo $this->translate('OLDTAG Purple Rectangle');?></option>
          <option value="7" <?php if($_POST['tagshape'] == 7){echo "selected";}?>><?php echo $this->translate('OLDTAG Circle Blue');?></option>
          <option value="8" <?php if($_POST['tagshape'] == 8){echo "selected";}?>><?php echo $this->translate('OLDTAG Orange Circle');?></option>
          <option value="9" <?php if($_POST['tagshape'] == 9){echo "selected";}?>><?php echo $this->translate('OLDTAG Green Circle');?></option>
          <option value="10" <?php if($_POST['tagshape'] == 10){echo "selected";}?>><?php echo $this->translate('OLDTAG Red Circle');?></option>
          <option value="11" <?php if($_POST['tagshape'] == 11){echo "selected";}?>><?php echo $this->translate('OLDTAG Orange Rectangle');?></option>
          <option value="12" <?php if($_POST['tagshape'] == 12){echo "selected";}?>><?php echo $this->translate('OLDTAG Green Rectangle');?></option>
          <option value="13" <?php if($_POST['tagshape'] == 13){echo "selected";}?>><?php echo $this->translate('OLDTAG Blue rectangle');?></option>
          <option value="14" <?php if($_POST['tagshape'] == 14){echo "selected";}?>><?php echo $this->translate('OLDTAG Red rectangle');?></option>
          <option value="15" <?php if($_POST['tagshape'] == 15){echo "selected";}?>><?php echo $this->translate('OLDTAG Silver Heart');?></option>
          <option value="16" <?php if($_POST['tagshape'] == 16){echo "selected";}?>><?php echo $this->translate('OLDTAG Silver Rectangle');?></option>
          <option value="17" <?php if($_POST['tagshape'] == 17){echo "selected";}?>><?php echo $this->translate('OLDTAG Red Oval');?></option>
          <option value="19" <?php if($_POST['tagshape'] == 19){echo "selected";}?>><?php echo $this->translate('OLDTAG Blue oval');?></option>
      </select>
    </div>
  </div>

  <!-- Text input-->
  <div class="control-group">
     <label class="control-label" for="code"><?php echo $this->translate('SCANINTRONOSCANOLD_VET_TEL_NR');?></label>
     <div class="controls">
        <table width="200" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="35"><input name="txt_phone_1" type="number" id="txt_phone_1" style="width:100%" maxlength="3" placeholder="XXX" value="<?php echo $_POST['txt_phone_1'];?>"> </td>
          <td width="15">&nbsp;</td>
          <td width="35"><input name="txt_phone_2" type="number" id="txt_phone_2" style="width:100%" maxlength="3" placeholder="XXX" value="<?php echo $_POST['txt_phone_2'];?>"></td>
          <td width="15">&nbsp;</td>
          <td width="45"><input name="txt_phone_3" type="number" id="txt_phone_3" style="width:100%" maxlength="4"  placeholder="XXXX" value="<?php echo $_POST['txt_phone_3'];?>"></td>
        </tr>
        </table>
     </div>
  </div>

  <!-- Text input-->  
  <div class="control-group">
    <label class="control-label" for="clinicname"><?php echo $this->translate('REGISTER_CLINICNAME');?></label>
    <div class="controls">
      <input id="clinicname" name="clinicname" type="text" placeholder="<?php echo $this->translate('REGISTER_CLINICNAME');?>" class="input-xlarge" value="<?php echo $_POST['clinicname']?>" data-title="<?php echo $this->translate('REGISTER_CLINICNAME_HELP');?>" data-placement="bottom" rel="tooltip">
    </div>
  </div>
  <div class="control-group" style="display:none">
    <label class="control-label" for="secondemail"><?php echo $this->translate('LEAVE EMPTY');?> *</label>
    <div class="controls">
      <input type="text" name="secondemail" id="secondemail" placeholder="<?php echo $this->translate('LEAVE EMPTY');?>" value="<?php echo $_POST['secondemail'];?>"/>
    </div>
  </div>

</span>

<span id="new-product"  <?php if(!$_POST['product'] || strlen($_POST['product']) == 7){echo "style='display:block'";}else{echo "style='display:none'";}?>>
  <div class="control-group">
    <label class="control-label" for="secucode"><?php echo $this->translate('REGISTER_SECUCODE');?></label>
    <div class="controls">
      <input maxlength="6" id="secucode" name="secucode" type="number" placeholder="1234" class="input-small" value="<?php echo $_POST['secucode']?>" data-title="<?php echo $this->translate('REGISTER_SECUCODE_HELP');?>" data-placement="bottom" rel="tooltip">
      <p class="help-block"><?php echo $this->translate('REGISTER_SECUCODE_HELP_2');?></p>
    </div>
  </div>
</span>

<!-- Text input-->
<div class="control-group row">
  <span class="span6">
    <label class="control-label" for="tel"><?php echo $this->translate('REGISTER_TEL');?></label>
    <div class="controls">
      <input maxlength="15" id="tel" name="tel" type="tel" placeholder="XXX XXX XXXX" class="input-medium" value="<?php echo $_POST['tel']?>" data-title="<?php echo $this->translate('REGISTER_TEL_HELP');?>" data-placement="bottom" rel="tooltip">
    </div>
  </span>

  <!-- Multiple Checkboxes (inline) -->
  <span class="span3">
    <div class="controls">
      <label class="checkbox inline" for="tel_sms">
        <input type="checkbox" name="tel_sms" id="tel_sms" <?php if($this->tel_sms=="on"){?>checked="checked"<?php }?> data-title="<?php echo $this->translate('REGISTER_CELL_HELP');?>" data-placement="bottom" rel="tooltip">
        <?php echo $this->translate('REGISTER_CELL');?>
      </label>
    </div>
  </span>
</div>

<div class="control-group row" id="addtelquestion">
  <span class="span6">
    <label class="control-label" for="addtel"> </label>
    <div class="controls">
      <span id="addtel" style="cursor:pointer"><?php echo $this->translate('REGISTER_ADDTEL');?></span>
    </div>
  </span>
</div>

<div class="control-group row" id="addtelnr" style="display:none">
  <span class="span6">
    <label class="control-label" for="tel2"><?php echo $this->translate('REGISTER_ALTERNATIVETEL');?></label>
    <div class="controls">
      <input maxlength="15" id="tel2" name="tel2" type="tel" placeholder="XXX XXX XXXX" class="input-medium" value="<?php echo $_POST['tel2']?>">
    </div>
  </span>

  <!-- Multiple Checkboxes (inline) -->
  <span class="span3">  
    <div class="controls">
      <label class="checkbox inline" for="tel_sms2">
        <input type="checkbox" name="tel_sms2" id="tel_sms2" <?php if($this->tel_sms2=="on"){?>checked="checked"<?php }?>>
        <?php echo $this->translate('REGISTER_CELL');?>
      </label>
    </div>
  </span>
</div>


<!-- Text input-->  
<div class="control-group">
  <label class="control-label" for="petname"><?php echo $this->translate('REGISTER_PETNAME');?></label>
  <div class="controls">
    <input id="petname" name="petname" type="text" placeholder="<?php echo $this->translate('REGISTER_PETNAME');?>" class="input-xlarge" value="<?php echo $_POST['petname']?>" data-title="<?php echo $this->translate('REGISTER_PETNAME_HELP');?>" data-placement="bottom" rel="tooltip">
    <!--<p class="help-block"><?php //echo $this->translate('REGISTER_PETNAME_HELP');?></p>-->
  </div>
</div>


<!-- Select Multiple -->
<div class="control-group">
  <label class="control-label" for="animal"><?php echo $this->translate('REGISTER_SELECT');?></label>
  <div class="controls">
        <label class="checkbox">
            <input type="radio" name="animal" value="Dog" id="inlineCheckbox1" <?php if($_POST["animal"]== "Dog") echo "checked";?>> <?php echo $this->translate('REGISTER_DOG');?>
        </label>
        <label class="checkbox">
            <input type="radio" name="animal" value="Cat" id="inlineCheckbox2" <?php if($_POST["animal"]== "Cat") echo "checked";?>> <?php echo $this->translate('REGISTER_CAT');?>
        </label>
        <label class="checkbox">
            <input type="radio" name="animal" value="Ferret" id="inlineCheckbox3" <?php if($_POST["animal"]== "Ferret") echo "checked";?>> <?php echo $this->translate('REGISTER_FERRET');?>
        </label>
        <label class="checkbox">
            <input type="radio" name="animal" value="Other" id="inlineCheckbox4" <?php if($_POST["animal"]== "Other") echo "checked";?>> <?php echo $this->translate('REGISTER_OTHER');?>
        </label> 
  </div> 
</div>

<!-- checkbox -->
<div class="control-group">
  <label class="control-label" for="terms"><?php echo $this->translate('REGISTER_AGREE');?> 
    <a href="#myModal" data-toggle="modal"><?php echo $this->translate('REGISTER_AGREE2');?></a>
  </label>
  <div class="controls">
        <label class="checkbox">
          <input id="terms" required="" name="option[]" value="terms" type="checkbox" <?php if($this->terms=="yes"){?>checked="checked"<?php } ?> >
        </label>
  </div>
</div>
<?php
  require_once(PIMCORE_DOCUMENT_ROOT ."/website/lib/recaptcha/recaptchalib.php");
  $publickey = "6LdBf-wSAAAAAD3Hc-KpCiDqBVrFPnziS2XH0dNQ"; // you got this from the signup page
  echo recaptcha_get_html($publickey);
?>
<br>
<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submit"></label>
  <div class="controls">
    <button id="submit" name="doaction" value="submit" class="btn btn-success"><?php echo $this->translate('ACTIVATE_TAG');?></button>
  </div>
</div>

</fieldset>
</form>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><?php echo $this->translate('terms_title');?></h3>
  </div>
  <div class="modal-body">
    <?php echo $this->translate('terms_page');?>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>
<script type="text/javascript">
//var domains = ['hotmail.com', 'gmail.com', 'aol.com'];
//var topLevelDomains = ["com", "net", "org"];
//$('#email').on('blur', function() {
//  $(this).mailcheck({
//    domains: domains,                       // optional
//    topLevelDomains: topLevelDomains,       // optional
//    suggested: function(element, suggestion) {
//      $('#emailSuggestion').show();
//      $('#emailSuggestion').html("<?php echo $this->translate('did you mean');?> <a href='#' id='suggestion' class='suggestion' style='text-decoration:underline;color:#0000ff'>"+suggestion.full+"</a>?");
//    },
//    empty: function(element) {
//      $('#emailSuggestion').hide();
//      $('#emailSuggestion').html("");
//    }
//  });
//});
//$('.suggestion').on('click', '.domain', function() {
//  $('#email').val( $(".suggestion").text() );
//});
<!--

  //-->
  $(document).ready(function(){
    $('#addtel').click(function(event){
      $('#addtelnr').toggle();
      $('#addtelquestion').toggle();
    });
    $('#product').blur(function(event){
      if($(this).val().length <= 5){
        $('#old-product').show();
        $('#new-product').hide();
      }
      if($(this).val().length >= 6){
        $('#old-product').hide();
        $('#new-product').show();
      }
    });
  });
</script>