<?php
  $msg = '';  
  $success = false;
  if (isset($_GET['undo']) && !isset($_POST['save'])) {    
    if (copy(GSBACKUPSPATH . 'other/' . DY_WEBSITE_CUSTOM_FIELDS_SETTINGS, GSDATAOTHERPATH . DY_WEBSITE_CUSTOM_FIELDS_SETTINGS)) {
      $msg = i18n_r('i18n_customfields/UNDO_SUCCESS');
      $success = true;
    } else {
      $msg = i18n_r('i18n_customfields/UNDO_FAILURE');
    }
  } else if (isset($_POST['save'])) {
    if (dyWebsiteCustomFieldsSaveSettings()) {
      $msg = i18n_r('i18n_customfields/SAVE_SUCCESS');
      $success = true;
      if (is_file(GSBACKUPSPATH . 'other/' . DY_WEBSITE_CUSTOM_FIELDS_SETTINGS)) {
        $msg .= ' <a href="load.php?id=' . DY_WEBSITE_CUSTOM_FIELDS . '&amp;configure&amp;undo">' . i18n_r('UNDO') . '</a>';
      }
    } else {
      $msg = i18n_r('i18n_customfields/SAVE_FAILURE');
    }
  }
  if ($msg) { ?>
 <script>
  $('div.bodycontent').before('<div class="<?php echo $success? 'updated' : 'error'; ?>" style="display:block;">'+<?php echo json_encode($msg); ?>+'</div>');
</script>   
  <?php }
  $defs = dyWebsiteCustomFieldsGetSettings();
?>
<h3 class="floated"><?php i18n(DY_WEBSITE_CUSTOM_FIELDS . '/WEBSITECUSTOMFIELDS_VIEW'); ?></h3>
<div class="edit-nav clearfix">
  <a href="load.php?id=<?php echo DY_WEBSITE_CUSTOM_FIELDS; ?>">
    <?php i18n('EDIT') ?>
  </a>
</div>
<p class="clear"><?php i18n(DY_WEBSITE_CUSTOM_FIELDS . '/CUSTOMFIELDS_DESCR'); ?></p>
<p><?php i18n(DY_WEBSITE_CUSTOM_FIELDS . '/FUNCTIONS_DESCR'); ?></p>
<ul>
  <li><code>get_website_custom_field('myname')</code> <?php i18n(DY_WEBSITE_CUSTOM_FIELDS . '/GET_CUSTOM_FIELD_DESCR'); ?></li>  
  <li><code>return_website_custom_field('myname')</code> <?php i18n(DY_WEBSITE_CUSTOM_FIELDS . '/RETURN_CUSTOM_FIELD_DESCR'); ?></li>
</ul>
<p><?php i18n(DY_WEBSITE_CUSTOM_FIELDS . '/USAGE_DESCR'); ?></p>
<form method="post" id="customfieldsForm">
  <table id="editfields" class="edittable highlight">
    <thead>
      <tr>
        <th><?php i18n('i18n_customfields/NAME'); ?></th>
        <th><?php i18n('i18n_customfields/LABEL'); ?></th>
        <th style="width:100px;"><?php i18n('i18n_customfields/TYPE'); ?></th>
        <th><?php i18n('i18n_customfields/DEFAULT_VALUE'); ?></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
<?php
  $i = 0; 
  if (count($defs) > 0) foreach ($defs as $def) {
    dy_websitecustomfields_confline($i, $def, 'sortable');    
    $i++;
  }
  dy_websitecustomfields_confline($i, [], 'hidden'); 
?> 
      <tr>
        <td colspan="4"><a href="#" class="add"><?php i18n('i18n_customfields/ADD'); ?></a></td>
        <td class="secondarylink"><a href="#" class="add" title="<?php i18n('i18n_customfields/ADD'); ?>">+</a></td>
      </tr>
    </tbody>
  </table>
  <input type="submit" name="save" value="<?php i18n('i18n_customfields/SAVE'); ?>" class="submit"/>
</form>
<script type="text/javascript" src="../plugins/i18n_customfields/js/jquery-ui.sort.min.js"></script>
<script type="text/javascript">
  function renumberCustomFields() {
    $('#customfieldsForm table tbody tr').each(function(i,tr) {
      $(tr).find('input, select, textarea').each(function(k,elem) {
        var name = $(elem).attr('name').replace(/_\d+_/, '_'+(i)+'_');
        $(elem).attr('name', name);
      });
    });
  }
  $(function() {
    $('select[name$=_type]').change(function(e) {
      var val = $(e.target).val();
      var $ta = $(e.target).closest('td').find('textarea');
      if (val == 'dropdown') $ta.css('display','inline'); else $ta.css('display','none');
    });
    $('a.delete').click(function(e) {
      $(e.target).closest('tr').remove();
      renumberCustomFields();
    });
    $('a.add').click(function(e) {
      var $tr = $(e.target).closest('tbody').find('tr.hidden');
      $tr.before($tr.clone(true).removeClass('hidden').addClass('sortable'));
      renumberCustomFields();
    });
    $('#customfieldsForm tbody').sortable({
      items:"tr.sortable", handle:'td',
      update:function(e,ui) { renumberCustomFields(); }
    });
    renumberCustomFields();
  });
</script>
<?php

function dy_websitecustomfields_confline($i, $def, $class='') {
  $isdropdown = @$def['type'] == 'dropdown';
  $indexable = !@$def['type'] || in_array(@$def['type'],['text', 'textfull', 'dropdown', 'textarea', 'checkbox']);
  $options = "\r\n";
  if ($isdropdown && count($def['options']) > 0) {
    foreach ($def['options'] as $option) $options .= $option . "\r\n";
  } 
?>
      <tr class="<?php echo $class; ?>">
        <td><input type="text" class="text" style="width:80px;padding:2px;" name="cf_<?php echo $i; ?>_key" value="<?php echo @$def['key'];?>"/></td>
        <td><input type="text" class="text" style="width:140px;padding:2px;" name="cf_<?php echo $i; ?>_label" value="<?php echo @$def['label'];?>"/></td>
        <td>
          <select name="cf_<?php echo $i; ?>_type" class="text short" style="width:180px;padding:2px;" >
            <option value="text" <?php echo @$def['type']=='text' ? 'selected="selected"' : ''; ?> ><?php i18n('i18n_customfields/TEXT_FIELD'); ?></option>
            <option value="textfull" <?php echo @$def['type']=='textfull' ? 'selected="selected"' : ''; ?> ><?php i18n('i18n_customfields/LONG_TEXT_FIELD'); ?></option>
            <option value="dropdown" <?php echo @$def['type']=='dropdown' ? 'selected="selected"' : ''; ?> ><?php i18n('i18n_customfields/DROPDOWN_BOX'); ?></option>
            <option value="checkbox" <?php echo @$def['type']=='checkbox' ? 'selected="selected"' : ''; ?> ><?php i18n('i18n_customfields/CHECKBOX'); ?></option>
            <option value="textarea" <?php echo @$def['type']=='textarea' ? 'selected="selected"' : ''; ?> ><?php i18n('i18n_customfields/WYSIWYG_EDITOR'); ?></option>
            <option value="image" <?php echo @$def['type']=='image' ? 'selected="selected"' : ''; ?> ><?php i18n('i18n_customfields/IMAGE'); ?></option>
            <option value="file" <?php echo @$def['type']=='file' ? 'selected="selected"' : ''; ?> ><?php i18n('i18n_customfields/FILE'); ?></option>
            <option value="link" <?php echo @$def['type']=='link' ? 'selected="selected"' : ''; ?> ><?php i18n('i18n_customfields/LINK'); ?></option>
          </select>
          <textarea class="text" style="width:170px;height:50px;padding:2px;<?php echo !$isdropdown ? 'display:none' : ''; ?>" name="cf_<?php echo $i; ?>_options"><?php echo $options; ?></textarea> 
        </td>
        <td><input type="text" class="text" style="width:100%;padding:2px;" name="cf_<?php echo $i; ?>_value" value="<?php echo @$def['value'];?>"/></td>
        <td class="delete"><a href="#" class="delete" title="<?php i18n('i18n_customfields/DELETE'); ?>">&times;</a></td>
      </tr>
<?php 
}
