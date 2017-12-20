<?php


#CMS Made Simple Configuration File
#Please clear the cache (Site Admin->Global Settings in the admin panel)
#after making any changes to path or url related options

#-----------------
#Behaviour Settings
#-----------------

# These settings will effect the overall behaviour of the CMS application, please
# use extreme caution when editing these.  Additionally, some settings may have
# no effect on servers with significantly restricted configurability.

# If you are experiencing propblems with php memory limit errors, then you may
# want to try enabling and/or adjusting this setting.
# Note: Your server may not allow the application to override memory limits.
$config['php_memory_limit'] = '';

# In versions of CMS Made Simple prior to version 1.4, the page template was processed
# in it's entirety.  This behaviour was later changed to process the head portion of the
# page template after the body.  If you are working with a highly configured site that
# relies significantly on the old order of smarty processing, you may want to try
# setting this parameter to false.
$config['process_whole_template'] = false;

# CMSMS Debug Mode?  Turn it on to get a better error when you
# see {nocache} errors, or to allow seeing php notices, warnings, and errors in the html output.
# This setting will also disable browser css caching.
$config['debug'] = false;

# Output compression?
# Turn this on to allow CMS to do output compression
# this is not needed for apache servers that have mod_deflate enabled
# and possibly other servers.  But may provide significant performance
# increases on some sites.  Use caution when using this as there have
# been reports of incompatibilities with some browsers.
$config['output_compression'] = false;

#-----------------
#Database Settings
#-----------------

#This is your database connection information.  Name of the server,
#username, password and a database with proper permissions should
#all be setup before CMS Made Simple is installed.
$config['dbms'] = 'mysql';
$config['db_hostname'] = 'localhost';
$config['db_username'] = 'mf';
$config['db_password'] = 'mataji';
$config['db_name'] = 'd4l';
#Change this param only if you know what you are doing
$config["db_port"] = '';


#If app needs to coexist with other tables in the same db,
#put a prefix here.  e.g. "cms_"
$config['db_prefix'] = 'cms_';

#Use persistent connections?  They're generally faster, but not all hosts
#allow them.
$config['persistent_db_conn'] = false;

#Use ADODB Lite?  This should be true in almost all cases.  Note, slight
#tweaks might have to be made to date handling in a "regular" adodb
#install before it can be used.
$config['use_adodb_lite'] = true;

#-------------
#Path Settings
#-------------

#Document root as seen from the webserver.  No slash at the end
#If page is requested with https use https as root url
#e.g. http://blah.com
$config['root_url'] = 'http://www.deal4loans.com/rnew/cmsmadesimple';
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on')
{
$config['root_url'] = str_replace('http','https',$config['root_url']);
}

#Path to document root. This should be the directory this file is in.
#e.g. /var/www/localhost
$config['root_path'] = '/var/www/vhosts/deal4loans.com/httpdocs/rnew/cmsmadesimple';

#Name of the admin directory
$config['admin_dir'] = 'admin';

#Where do previews get stored temporarily?  It defaults to tmp/cache.
$config['previews_path'] = '/var/www/vhosts/deal4loans.com/httpdocs/rnew/cmsmadesimple/tmp/cache';

#Where are uploaded files put?  This defaults to uploads.
$config['uploads_path'] = '/var/www/vhosts/deal4loans.com/httpdocs/rnew/cmsmadesimple/uploads';

#Where is the url to this uploads directory?
$config['uploads_url'] = $config['root_url'] . '/uploads';


#---------------
#Upload Settings
#---------------

#Maxium upload size (in bytes)?
$config['max_upload_size'] = 2000000;

#Permissions for uploaded files.  This only really needs changing if your
#host has a weird permissions scheme.
$config['default_upload_permission'] = '664';

#------------------
#Usability Settings
#------------------

#Allow smarty {php} tags?  These could be dangerous if you don't trust your users.
$config['use_smarty_php_tags'] = false;

#Automatically assign alias based on page title?
$config['auto_alias_content'] = true;

#------------
#URL Settings
#------------

#Show mod_rewrite URLs in the menu? You must enable 'use_hierarchy' for this to work for modules
$config['assume_mod_rewrite'] = false;

#Extension to use if you're using mod_rewrite for pretty URLs.
$config['page_extension'] = '';

#If you don't use mod_rewrite, then would you like to use the built-in
#pretty url mechanism?  This will not work with IIS and the {metadata} tag
#should be in all of your templates before enabling.
$config['internal_pretty_urls'] = false;

#If you're using the internal pretty url mechanism or mod_rewrite, would you like to
#show urls in their hierarchy?  (ex. http://www.mysite.com/parent/parent/childpage)
$config['use_hierarchy'] = false;

#If using none of the above options, what should we be using for the query string
#variable?  (ex. http://www.mysite.com/index.php?page=somecontent)
$config['query_var'] = 'page';

#--------------
#Image Settings
#--------------

#Which program should be used for handling thumbnails in the image manager.
#See http://wiki.cmsmadesimple.org/index.php/User_Handbook/Admin_Panel/Content/Image_Manager for more
#info on what this all means
$config['image_manipulation_prog'] = 'GD';
$config['image_transform_lib_path'] = '/usr/bin/ImageMagick/';

#Default path and URL for uploaded images in the image manager
$config['image_uploads_path'] = '/var/www/vhosts/deal4loans.com/httpdocs/rnew/cmsmadesimple/uploads/images';
$config['image_uploads_url'] = $config['root_url'] . '/uploads/images'; 


#------------------------
#Locale/Encoding Settings
#------------------------

#Locale to use for various default date handling functions, etc.  Leaving
#this blank will use the server's default.  This might not be good if the
#site is hosted in a different country than it's intended audience.
$config['locale'] = '';

#In almost all cases, default_encoding should be empty (which defaults to utf-8)
#and admin_encoding should be utf-8.  If you'd like this to be different, change
#both.  Keep in mind, however, that the admin interface translations are all in
#utf-8, and will be converted on the fly to match the admin_encoding.  This
#could seriously slow down the admin interfaces for users.
$config['default_encoding'] = 'utf-8';
$config['admin_encoding'] = 'utf-8';

#---------------------------------------------
#Use the old stylesheet logic?  It's much slower, but it works with older
#versions of CMSMS.  You'll also need this set to true if there is a module
#that uses a stylesheet callback.  Leave it as false instead you really
#need it.
$config['old_stylesheet'] = false;

# URL of the Admin Panel section of the User Handbook
$config['wiki_url'] = 'http://wiki.cmsmadesimple.org/index.php/User_Handbook/Admin_Panel';

#Enable backwards compatibility mode?  This basically will allow some
#modules written before 1.0 was released to work.  Keep in mind that this
#will use a lot more memory and isn't guaranteed to fix the problem.
$config['backwards_compatible'] = false;

#Not used anymore... kept around, just in case
$config['disable_htmlarea_translation'] = false;
$config['use_Indite'] = true;
?>