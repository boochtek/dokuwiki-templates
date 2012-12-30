<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php /* DokuWiki template by Craig M. Buchek. */ ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>" lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<!--
NOTES:
	I chose a table layout, because I could not find a 3-column CSS layout that met my requirements.
		All 3-column CSS layouts seem to have one problem or another.
			Most have problems keeping the sidebars the same height as the content.
			None seemed to work with the CSS flyout menus I'm using.
				Or any other vertical fly-out menus, most likely.
				Sub-elements of floated elements apparently can't cleanly overlap non-floats.
			Best one I found, that I almost used, was Skidoo Too.
				http://webhost.bridgew.edu/etribou/layouts/skidoo_too/
				It had the same problem with the flyout menus.
		I spent a long time trying to find one that would work.
		I'd probably use an XHTML strict DTD otherwise.
	I used the table trick (http://www.apromotionguide.com/tabletrick.html) to lay out the sidebars.
		This allows the content to come before the sidebars in the HTML source.
			This makes search engines and spiders more find the pertinent bits more easily.
	We have to make sure the insides of everything included are valid and well-formed XHTML.
		DokuWiki should be OK, passing valid well-formed XHTML.
		Or change the DTD at the top, probably to HTML 4.01 Transitional.
		Or use something like tidy to ensure it's XHTML.
-->
 <head>
  <title><?php echo p_get_first_heading($ID); ?> [<?php echo hsc($conf['title'])?>]</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- TODO: These are what tpl_metaheaders() generates. Need to fix up a few of them. -->
  <meta name="generator" content="DokuWiki Release <?php echo getVersion();?>" />
  <link rel="start" href="<?php echo DOKU_BASE . $conf['start'];?>" />
  <link rel="contents" href="<?php echo DOKU_BASE;?>?do=index" title="" />
  <link rel="alternate" type="application/rss+xml" title="Recent Changes" href="<?php echo DOKU_BASE;?>feed.php" />
  <link rel="alternate" type="application/rss+xml" title="Current Namespace" href="<?php echo DOKU_BASE;?>feed.php?mode=list&amp;ns=" />
  <link rel="alternate" type="text/html" title="Plain HTML" href="/home?do=export_xhtml" />
  <link rel="alternate" type="text/plain" title="Wiki Markup" href="/home?do=export_raw" />

  <meta name="date" content="<?php echo date('Y-m-d\TH:i:sO',$INFO['lastmod']);?>" />

<?php /* Determine how to set ROBOTS meta tag. */
  if( ($ACT=='show' || $ACT=='export_xhtml') && !$REV){
    if($INFO['exists']){
      //delay indexing:
      if((time() - $INFO['lastmod']) >= $conf['indexdelay']){
        $robots = "index,follow";
      }else{
        $robots = "noindex,nofollow";
      }
    }else{
      $robots = "noindex,follow";
    }
  }else{
    $robots = "noindex,nofollow";
  }
?>
  <meta name="robots" content="<?php echo $robots;?>" />

<!-- TODO: Need to set edit and write properly. -->
  <script type="text/javascript" charset="utf-8" src="/lib/exe/js.php?edit=1&amp;write=1"></script>



  <link rel="stylesheet" media="screen" type="text/css" href="/lib/exe/css.php" />
  <link rel="stylesheet" media="print" type="text/css" href="/lib/exe/css.php?print=1" />

  <link rel="shortcut icon" href="<?php echo DOKU_TPL?>images/starfish16.ico" />


  <!-- Style sheets. -->
  <link rel="stylesheet" href="<?php echo DOKU_TPL?>layout.css"  type="text/css" />
  <link rel="stylesheet" href="<?php echo DOKU_TPL?>content.css" type="text/css" />
  <link rel="stylesheet" href="<?php echo DOKU_TPL?>blue.css"    type="text/css" />
  <link rel="alternate stylesheet" href="<?php echo DOKU_TPL?>red.css"   type="text/css" />
  <link rel="alternate stylesheet" href="<?php echo DOKU_TPL?>green.css" type="text/css" />

  <!-- OpenID delegation. -->
  <link rel="openid2.provider" href="http://www.myopenid.com/server">
  <link rel="openid2.local_id" href="http://booch.myopenid.com/">
  <link rel="openid.server" href="http://www.myopenid.com/server">
  <link rel="openid.delegate" href="http://booch.myopenid.com/">

  <!-- Physical location info. See http://geotags.com/geo/geotags2.html -->
  <meta name="geo.country"   content="US" />
  <meta name="geo.region"    content="US-MO" /> <!-- Missouri -->
  <meta name="geo.placename" content="St. Louis, MO" />
  <meta name="geo.position"  content="38.7015; -90.4050" /> <!-- http://terraserver.microsoft.com/image.aspx?T=4&S=8&Z=15&X=14512&Y=85736&W=1 -->

  <!-- Allow me to use Google Webmaster Tools. -->
  <meta name="verify-v1" content="0Ec58cH0zTYEwvdrfnkho9fOQIGodFKHwYuIY5vhsdQ=" />

  <!-- Tell IE6 not to add Image Toolbar to images, nor SmartTags. See http://www.microsoft.com/windows/ie/using/howto/customizing/imgtoolbar.mspx -->
  <meta http-equiv="imagetoolbar"        content="false" />
  <meta name="MSSmartTagsPreventParsing" content="true" />

 </head>

 <!-- Provide a CSS signature. (http://archivist.incutio.com/viewlist/css-discuss/13291) TODO: Should use PHP to get this from the URI. -->
 <body id="craigbuchek-com">

  <div id="header">
   <span id="logo">
    <!-- empty -->
   </span>
   <span id="banner">
    <?php tpl_link(wl(),$conf['title'],'name="dokuwiki__top" id="dokuwiki__top" accesskey="h" title="[ALT+H]"')?>
   </span>
  </div>

  <div id="topinfo" style="clear:both;">
   <div id="youarehere"><?php tpl_youarehere()?></div>
   <div id="loggedinas"><!--<?php tpl_userinfo()?>-->&nbsp;</div>
  </div>

  <div id="topmsgarea"><?php html_msgarea()?></div>

  <table id="center" class="layout" cellpadding="0" cellspacing="0">

   <tr>

    <!-- TODO: See if all browsers can handle src="". IE6 and FF1.5 can. -->
    <td id="leftX"><img height="0" width="0" src="transparent-1x1.gif" /></td>

    <td rowspan="2" valign="top" id="content">
     <!-- wikipage start -->
     <?php tpl_content()?>
     <!-- wikipage stop -->
    </td>

    <!-- Need this second hack to cover up the 1px white space above the right sidebar. -->
    <td id="rightX"><img height="0" width="0" src="transparent-1x1.gif" /></td>

   </tr>

   <tr>

    <td id="left" class="sidebar">
<!--
     <div class="nav vnav vertical">
      <h3>Navigation Menu</h3>
      <ul class="menu">
       <li><a href="#">Menu item</a></li>
       </li>
      </ul>
     </div>

     <div>
      <h3>Page Style</h3>
      <form id="stylechooser">
       <select>
        <option value="Red">Red</option>
        <option value="Green">Green</option>
        <option value="Blue">Blue</option>
       </select>
      </form>
     </div>
-->
    </td>

    <td id="right" class="sidebar">
     <!-- empty -->
    </td>

   </tr>

  </table>

  <div class="clearer">&nbsp;</div>

<?php flush(); ?>

  <div id="footer">
   <div id="copyright">
    <span>Copyright &copy; <?php echo date('Y',$INFO['lastmod']);?> by Craig M. Buchek</span>
    <div id="pageinfo">
     <!--<?php tpl_pageinfo()?>-->
     Last modified: <?php echo date($conf['dformat'],$INFO['lastmod']);?>
    </div>
   </div>
   <div id="wiki-controls">
    <div class="bar-left">
     &nbsp;
     <?php tpl_button('edit')?>
     <?php tpl_button('history')?>
     <?php tpl_button('subscription')?>
     <?php tpl_button('backlink')?>
     &nbsp;
    </div>
    <div class="bar-right">
     &nbsp;
     <?php tpl_button('recent')?>
     <?php tpl_button('index')?>
     <?php tpl_button('admin')?>
     <?php tpl_button('profile')?>
     <?php tpl_button('login')?>
     <!-- TODO: Goto Page -->
     <!-- TODO: RSS -->
     <?php tpl_searchform()?>
     &nbsp;
    </div>
   </div>
   <div id="badges">
    <!-- TODO: Badges go here. -->
   </div>
  </div>

  <div class="no"><?php tpl_indexerWebBug()?></div>

 </body>

</html>
