<?php
if (isset($function) && $function == "Edit Publisher Keywords")
{
	?>
	<h2>Edit Publisher/Developer Keywords</h2>
	<form action="<?= $baseurl; ?>/admincp/?cptab=publishers" method="post">
	Keywords:&nbsp;<input type="text" name="keyword" value="<?= $keyword; ?>"/>
	<input type="hidden" name="publisherid" value="<?= $id; ?>" />
	<input type="submit" name="function" value="Save Keywords" />
	</form>
	<hr />
	<form action="<?= $baseurl; ?>/admincp/?cptab=publishers" method="post" enctype="multipart/form-data">
	<p><input type="file" name="logoimage" />
	<input type="hidden" name="publisherid" value="<?= $id; ?>" /></p>
	<p style="text-align: right;"><input style="margin-left: auto;" type="submit" name="function" value="Upload New Logo" /></p>
	</form>
	<?php
	die();
}
?>
<?php if ($adminuserlevel == 'ADMINISTRATOR') { ?>
<?php if (!isset($cptab)) { $cptab = "userinfo"; } ?>
<div style="text-align: center;">
	<h1 class="arcade">Admin Control Panel:</h1>
</div>

<div id="controlPanelWrapper">
	<div id="controlPanelNav">
		<ul>
			<li<?php if($cptab == "userinfo"){ ?> class="active" <?php } ?>><a href="<?= $baseurl ?>/admincp/?cptab=userinfo">My User Info</a></li>
			<li<?php if($cptab == "sitenews"){ ?> class="active" <?php } ?>><a href="<?= $baseurl ?>/admincp/?cptab=sitenews">Edit Site News</a></li>
			<li<?php if($cptab == "addplatform"){ ?> class="active" <?php } ?>><a href="<?= $baseurl ?>/admincp/?cptab=addplatform">Add New Platform</a></li>
			<li<?php if($cptab == "publishers"){ ?> class="active" <?php } ?>><a href="<?= $baseurl ?>/admincp/?cptab=publishers">Manage Publishers &amp; Developers</a></li>
		</ul>
	</div>
	<div id="controlPanelContent">
		<?php
			switch($cptab)
			{
				case "userinfo":
					?>
					<h2>User Information | <?=$user->username?></h2>
					
					<div style="float:left;">
						<form style="padding: 14px; border: 1px solid #999; background-color: #E6E6E6;" method="post" action="<?= $baseurl; ?>/admincp/" enctype="multipart/form-data">
						<h2>User Image...</h2>
						<?php
						$filename = glob("banners/users/" . $comments->userid . "*.jpg");
						if(file_exists($filename[0]))
						{
						?>
							<p style="text-align: center;"><img src="<?= $baseurl; ?>/<?= $filename[0]; ?>" alt="Current User Image" title="Current User Image" /></p>
						<?php
							$filename = null;
						}
						else
						{
						?>
							<p style="text-align: center;"><img src="<?= $baseurl; ?>/images/common/icons/user-black_64.png" alt="Current User Image" title="Current User Image" /></p>
						<?php
						}
						?>
							<p style="text-align: center;">
							<input type="file" name="userimage" /><br />
							<input type="hidden" name="function" value="Update User Image" />
							<input type="submit" name="submit" value="Upload Image" /></p>
						</form>
					</div>
					
					<form action="<?=$fullurl?>" method="POST" style="float:left; border-left: 1px solid #333; padding-left: 16px; margin-left: 16px;">
						<table cellspacing="2" cellpadding="2" border="0" align="center">
							<tr>
								<td><b>Password</b></td>
								<td><input type="password" name="userpass1"></td>
							</tr>
							<tr>
								<td><b>Re-Enter Password</b></td>
								<td><input type="password" name="userpass2"></td>
							</tr>
							<tr>
								<td><b>Email Address</b></td>
								<td><input type="text" name="email" value="<?=$user->emailaddress?>"></td>
							</tr>
							<tr>
								<td><b>Preferred Language</b></td>
								<td>
									<select name="languageid" size="1">
										<?php
										## Display language selector
										foreach ($languages AS $langid => $langname) {
											## If we have the currently selected language
											if ($user->languageid == $langid) {
												$selected = 'selected';
											}
											## Otherwise
											else {
												$selected = '';
											}
											print "<option value=\"$langid\" $selected>$langname</option>\n";
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td><b>Account Identifier</b></td>
								<td><input type="text" name="form_uniqueid" value="<?=$user->uniqueid?>" readonly></td>
							</tr>

							<tr>
								<td></td>
								<td><input type="submit" name="function" value="Update User Information"></td>
							</tr>
						</table>
					</form>
					<?php
					break;
				
				case "sitenews":
					?>
					<h2>Edit Site News...</h2>
					<form method="post">
					<textarea id="sitenewseditor" name="sitenews">
						<?php include("sitenews.php"); ?>
					</textarea>
					<input type="hidden" name="function" value="Update Site News" />
					<input type="submit" value="Save Site News" />
					</form>
					<script type="text/javascript">
						CKFinder.setupCKEditor( null, '/js/ckfinder/' );
						CKEDITOR.replace( 'sitenewseditor',
						{
							uiColor: '#404040',

							extraPlugins : 'autogrow',
							autoGrow_maxHeight : 800,
							// Remove the resize plugin, as it doesn't make sense to use it in conjunction with the AutoGrow plugin.
							removePlugins : 'resize',
							
							toolbar :
							[
								{ name: 'document', items : [ 'Source'] },
								{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
								{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
								//{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
								{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
								{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
								'/',
								{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
								{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
								'/',
								{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
								{ name: 'colors', items : [ 'TextColor','BGColor' ] },
								{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
							],
							
							/*
							 * Style sheet for the contents
							 */
							contentsCss : 'js/ckeditor/assets/output_xhtml.css',

							/*
							 * Core styles.
							 */
							coreStyles_bold	: { element : 'span', attributes : {'class': 'Bold'} },
							coreStyles_italic	: { element : 'span', attributes : {'class': 'Italic'}},
							coreStyles_underline	: { element : 'span', attributes : {'class': 'Underline'}},
							coreStyles_strike	: { element : 'span', attributes : {'class': 'StrikeThrough'}, overrides : 'strike' },

							coreStyles_subscript : { element : 'span', attributes : {'class': 'Subscript'}, overrides : 'sub' },
							coreStyles_superscript : { element : 'span', attributes : {'class': 'Superscript'}, overrides : 'sup' },

							/*
							 * Font face
							 */
							// List of fonts available in the toolbar combo. Each font definition is
							// separated by a semi-colon (;). We are using class names here, so each font
							// is defined by {Combo Label}/{Class Name}.
							font_names : 'Comic Sans MS/FontComic;Courier New/FontCourier;Times New Roman/FontTimes',

							// Define the way font elements will be applied to the document. The "span"
							// element will be used. When a font is selected, the font name defined in the
							// above list is passed to this definition with the name "Font", being it
							// injected in the "class" attribute.
							// We must also instruct the editor to replace span elements that are used to
							// set the font (Overrides).
							font_style :
							{
									element		: 'span',
									attributes		: { 'class' : '#(family)' }
							},

							/*
							 * Font sizes.
							 */
							fontSize_sizes : 'Smaller/FontSmaller;Larger/FontLarger;8pt/FontSmall;14pt/FontBig;Double Size/FontDouble',
							fontSize_style :
								{
									element		: 'span',
									attributes	: { 'class' : '#(size)' }
								} ,

							/*
							 * Font colors.
							 */
							colorButton_enableMore : false,

							colorButton_colors : 'FontColor1/FF9900,FontColor2/0066CC,FontColor3/F00',
							colorButton_foreStyle :
								{
									element : 'span',
									attributes : { 'class' : '#(color)' }
								},

							colorButton_backStyle :
								{
									element : 'span',
									attributes : { 'class' : '#(color)BG' }
								},

							/*
							 * Indentation.
							 */
							indentClasses : ['Indent1', 'Indent2', 'Indent3'],

							/*
							 * Paragraph justification.
							 */
							justifyClasses : [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull' ],

							/*
							 * Styles combo.
							 */
							stylesSet :
								[
									{ name : 'Strong Emphasis', element : 'strong' },
									{ name : 'Emphasis', element : 'em' },

									{ name : 'Computer Code', element : 'code' },
									{ name : 'Keyboard Phrase', element : 'kbd' },
									{ name : 'Sample Text', element : 'samp' },
									{ name : 'Variable', element : 'var' },

									{ name : 'Deleted Text', element : 'del' },
									{ name : 'Inserted Text', element : 'ins' },

									{ name : 'Cited Work', element : 'cite' },
									{ name : 'Inline Quotation', element : 'q' }
								]
						});
					</script>
					<?php
					break;
				
				case "addplatform":
					?>					
						<form style="padding: 14px; border: 1px solid #999; background-color: #E6E6E6;" method="post" action="<?= $baseurl; ?>/admincp/" enctype="multipart/form-data">
						<h2>Add A Platform...</h2>
							<p style="text-align: center;"><img src="<?= $baseurl; ?>/images/common/consoles/png24/console_atari.png" style="vertical-align: middle;" />&nbsp;To create a new platform, enter it's name below.</p>
							<p style="text-align: center; font-weight: bold;">Platform Name:&nbsp;<input type="text" name="PlatformTitle" size="60" /><br />
							<input type="hidden" name="function" value="Add Platform" />
							<input type="submit" name="submit" value="Add New Platform" /></p>
						</form>
					<?php
					break;
				
				case "publishers":
				?>
					<h2>Manage Platforms &amp; Developers...</h2>
					
					<table id="listtable" style="margin: auto;">
						<tr class="head">
							<th>Keyword</th>
							<th>Logo</th>
							<th>&nbsp;</th>
						</tr>
						<?php
							$pubQuery = mysql_query(" SELECT * FROM publishers ");
							while($pubResult = mysql_fetch_object($pubQuery))
							{
								if ($class == 'odd')  {  $class = 'even';  }  else  {  $class = 'odd';  }
						?>
						<tr class="<?= $class; ?>">
							<td valign="middle" style="text-align: center; font-size: 12px; font-weight: bold;"><?= $pubResult->keyword; ?></td>
							<?php
								if(!file_exists("banners/_admincpcache/publishers/$pubResult->logo"))
								{
									WideImage::load("banners/publishers/$pubResult->logo")->resize(60, 60, 'outside')->saveToFile("banners/_admincpcache/publishers/$pubResult->logo");
								}
							?>
							<td style="text-align: center;"><img src="<?= $baseurl; ?>/banners/_admincpcache/publishers/<?= $pubResult->logo; ?>" title="<?= $pubResult->keyword; ?>" alt="<?= $pubResult->keyword; ?>" /></td>
							<td><a href="<?= $baseurl; ?>/tab_admincp.php?function=Edit+Publisher+Keywords&id=<?= $pubResult->id; ?>&keyword=<?= $pubResult->keyword; ?>" rel="facebox">Edit Keywords &amp; Logo</a></td>
						</tr>
						<?php
							}
						?>
					</table>
				<?php
					break;
				
				default:
					?>
					<p>&nbsp;</p>
					<h2 class="arcade">Please select a section to administrate...</h2>
					<p>&nbsp;</p>
					<?php
					break;
			}
		?>
	</div>
	<div style="clear: both;"></div>
</div>
<?php
}
else {
?>
	<div style="text-align: center;">
		<h2 class="arcade">Sorry...</h2>
		<h2>Only administrators are allowed access to this section.</h2>
	</div>
<?php
}
?>