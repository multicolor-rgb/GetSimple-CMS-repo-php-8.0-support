<?php
/*
Plugin Name: DY Website Custom Fields
Description: Adds website custom fields
Version: 1.0
Author: Dmitry Yakovlev
Author URI: http://dimayakovlev.ru/
*/

# get correct id for plugin
$thisfile = basename(__FILE__, ".php");

define('DY_WEBSITE_CUSTOM_FIELDS', $thisfile);
define('DY_WEBSITE_CUSTOM_FIELDS_SETTINGS', DY_WEBSITE_CUSTOM_FIELDS . 'Settings.xml');
define('DY_WEBSITE_CUSTOM_FIELDS_DATA', DY_WEBSITE_CUSTOM_FIELDS . 'Data.xml');

i18n_merge(DY_WEBSITE_CUSTOM_FIELDS) || i18n_merge(DY_WEBSITE_CUSTOM_FIELDS, 'en_US');

# register plugin
register_plugin(
  DY_WEBSITE_CUSTOM_FIELDS,           # ID of plugin, should be filename minus php
  'DY Website Custom Fields',         # Title of plugin
  '1.0',                              # Version of plugin
  'Dmitry Yakovlev',                  # Author of plugin
  'http://dimayakovlev.ru/',          # Author URL
  i18n_r(DY_WEBSITE_CUSTOM_FIELDS . '/CUSTOMFIELDS_DESCR'),   # Plugin Description
  dyWebsiteCustomFieldsPageType(),    # Page type of plugin
  'dyWebsiteCustomFieldsAdmin'        # Function that displays content
);

# activate filter
add_action('plugins-sidebar', 'createSideMenu', [DY_WEBSITE_CUSTOM_FIELDS, i18n_r(DY_WEBSITE_CUSTOM_FIELDS . '/WEBSITECUSTOMFIELDS_VIEW'), 'configure']);
add_action('pages-sidebar', 'createSideMenu', [DY_WEBSITE_CUSTOM_FIELDS, i18n_r(DY_WEBSITE_CUSTOM_FIELDS . '/WEBSITECUSTOMFIELDS_TITLE')]);

function dyWebsiteCustomFieldsPageType() {
  if (isset($_GET['configure'])) {
    return 'plugins';
  } else {
    return 'settings';
  }
}

function dyWebsiteCustomFieldsAdmin() {
  if (!function_exists('get_custom_field')) {
    echo '<p>' . i18n_r(DY_WEBSITE_CUSTOM_FIELDS . '/NO_CUSTOMFIELDS_PLUGIN') . '</p>';
    return false;
  }
  if (isset($_GET['configure'])) {
    include DY_WEBSITE_CUSTOM_FIELDS . '/views/configure.php';
  } else {
    include DY_WEBSITE_CUSTOM_FIELDS . '/views/edit.php';
  }
}

function dyWebsiteCustomFieldsGetData() {
  if (is_file(GSDATAOTHERPATH . DY_WEBSITE_CUSTOM_FIELDS_DATA)) {
    return getXML(GSDATAOTHERPATH . DY_WEBSITE_CUSTOM_FIELDS_DATA);
  }
}

function dyWebsiteCustomFieldsGetSettings() {
  $settings = [];
  if(is_file(GSDATAOTHERPATH . DY_WEBSITE_CUSTOM_FIELDS_SETTINGS)) {
    $data = getXML(GSDATAOTHERPATH . DY_WEBSITE_CUSTOM_FIELDS_SETTINGS);
    $items = $data->item;
    if (count( $items) > 0) {
      foreach ($items as $item) {
        $cf = [];
        $cf['key'] = (string) $item->desc;
        $cf['label'] = (string) $item->label;
        $cf['type'] = (string) $item->type;
        $cf['value'] = (string) $item->value;
        if ((string) $item->type == 'dropdown') {
          $cf['options'] = [];
          foreach($item->option as $option) $cf['options'][] = (string) $option;
        }
        $settings[] = $cf;
      }
    }
  }
  return $settings;
}

function dyWebsiteCustomFieldsSaveData() {
  $file = GSDATAOTHERPATH . DY_WEBSITE_CUSTOM_FIELDS_DATA;
  // Create backup
  if (is_file($file))
    if (!copy($file, GSBACKUPSPATH . 'other/' . DY_WEBSITE_CUSTOM_FIELDS_DATA)) return false;
  
  $data = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><channel></channel>');
  $defs = dyWebsiteCustomFieldsGetSettings();
  if (count($defs) > 0) {
    foreach ($defs as $def) {
      $key = $def['key'];
      if(isset($_POST['post-'.strtolower($key)])) {
        $data->addChild(strtolower($key))->addCData(stripslashes($_POST['post-'.strtolower($key)]));
      }
    }
  }  
  return XMLsave($data, $file);
}

function dyWebsiteCustomFieldsSaveSettings() {
  $file = GSDATAOTHERPATH . DY_WEBSITE_CUSTOM_FIELDS_SETTINGS;
  // Create backup
  if (is_file($file))
    if (!copy($file, GSBACKUPSPATH . 'other/' . DY_WEBSITE_CUSTOM_FIELDS_SETTINGS)) return false;
  
  $data = new SimpleXMLExtended('<?xml version="1.0" encoding="UTF-8"?><channel></channel>');
  for ($i=0; isset($_POST['cf_'.$i.'_key']); $i++) {
    if ($_POST['cf_'.$i.'_key']) {
      $item = $data->addChild('item');
      $item->addChild('desc')->addCData(htmlspecialchars(stripslashes($_POST['cf_'.$i.'_key']), ENT_QUOTES));
      $item->addChild('label')->addCData(htmlspecialchars(stripslashes($_POST['cf_'.$i.'_label']), ENT_QUOTES));
      $item->addChild('type')->addCData(htmlspecialchars(stripslashes($_POST['cf_'.$i.'_type']), ENT_QUOTES));
      if (@$_POST['cf_'.$i.'_value']) {
        $item->addChild('value')->addCData(htmlspecialchars(stripslashes($_POST['cf_'.$i.'_value']), ENT_QUOTES));
      }
      if (@$_POST['cf_'.$i.'_options']) {
        $options = preg_split("/\r?\n/", rtrim(stripslashes($_POST['cf_'.$i.'_options'])));
        foreach ($options as $option) {
          $item->addChild('option')->addCData(htmlspecialchars($option, ENT_QUOTES));
        } 
      }
    }
  }
  return XMLsave($data, $file);
}

function get_website_custom_field($name, $default = '') {
  $data = dyWebsiteCustomFieldsGetData();
  if (isset($data->$name)) {
    $content = (string) $data->$name;
    $settings = getXML(GSDATAOTHERPATH . DY_WEBSITE_CUSTOM_FIELDS_SETTINGS);
    if ($settings) {
      $type = $settings->xpath("//item[desc='" . $name . "']/type");
      if (isset($type[0]) && (string) $type[0] == 'textarea') {
        $content = exec_filter('content', $content);
      }
    }
    echo $content;
    return true;
  } else {
    echo $default;
    return false;
  }
}

function return_website_custom_field($name, $default = '') {
  $data = dyWebsiteCustomFieldsGetData();
  return isset($data->$name) ? (string) $data->$name : $default;
}

/*
 * Alias for get_website_custom_field function
 */
function getWebsiteCustomField($name, $default = '') {
  return get_website_custom_field($name, $default);
}

/*
 * Alias for return_website_custom_field function
 */
function returnWebsiteCustomField($name, $default = '') {
  return return_website_custom_field($name, $default);
}
