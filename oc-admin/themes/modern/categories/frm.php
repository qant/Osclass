<?php
/*
 *      OSCLass – software for creating and publishing online classified
 *                           advertising platforms
 *
 *                        Copyright (C) 2010 OSCLASS
 *
 *       This program is free software: you can redistribute it and/or
 *     modify it under the terms of the GNU Affero General Public License
 *     as published by the Free Software Foundation, either version 3 of
 *            the License, or (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful, but
 *         WITHOUT ANY WARRANTY; without even the implied warranty of
 *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *             GNU Affero General Public License for more details.
 *
 *      You should have received a copy of the GNU Affero General Public
 * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
?>
<?php defined('APP_PATH') or die( __('Invalid OSClass request.') ); ?>

<?php 

    if(isset($category['pk_i_id'])) {
        //editing...
        $edit = true ;
        $title = "Edit category" ;
        $action_frm = "edit_post" ;
    } else {
        //adding...
        $edit = false ;
        $title = "Add a category" ;
        $action_frm = "add_post" ;
    }

?>

<div id="content">
    
    <div id="separator"></div>

    <?php include_once $absolute_path . '/include/backoffice_menu.php'; ?>

    <div id="right_column">
        <div id="content_header" class="content_header">
                <div style="float: left;"><img src="<?php echo $current_theme; ?>/images/back_office/cat-icon.png" /></div>
                <div id="content_header_arrow">&raquo; <?php echo __($title); ?></div>
                <div style="clear: both;"></div>
        </div>

        <div id="content_separator"></div>
        
        <?php osc_showFlashMessages(); ?>

        <div id="settings_form">
			
			<form action="categories.php" method="post">
				<input type="hidden" name="action" value="<?php echo $action_frm; ?>" />
				<?php if ($edit) {
                    CategoryForm::primary_input_hidden($category) ;
                } ?>
				
				<div class="FormElement">
				    <div class="FormElementName"><?php echo __('Parent category'); ?></div>
					<div class="FormElementInput">
					   <?php CategoryForm::category_select($categories, $category, __("- No parent -"), "fk_i_parent_id") ; ?>
					</div>
				</div>
				<div class="FormElement">
				    <div class="FormElementName"><?php echo __('Expirations days'); ?> <?php echo __('(0 = no expiration)'); ?></div>
					<div class="FormElementInput">
					   <?php CategoryForm::expiration_days_input_text($category); ?>
					</div>
				</div>
				<div class="FormElement">
				    <div class="FormElementName"><?php echo __('Position (order in relation to other categories)'); ?></div>
					<div class="FormElementInput">
					   <?php CategoryForm::position_input_text($category); ?>
                    </div>
				</div>
				
				<div class="FormElement">
				    <div class="FormElementName"></div>
					<div class="FormElementInput">
					   <?php CategoryForm::enabled_input_checkbox($category); ?>&nbsp;<?php echo __('Enabled'); ?>
					</div>
				</div>
				
				<div class="clear20"></div>
				
				<?php 
				    $locales = Locale::newInstance()->listAllEnabled();
                    CategoryForm::multilanguage_name_description($locales, $category) ; 
                ?>
                
                <div class="FormElement">
					<div class="FormElementName"></div>
					<div class="FormElementInput">
						<button class="formButton" type="button" onclick="window.location='categories.php';" ><?php echo __('Cancel'); ?></button>
						<button class="formButton" type="submit"><?php echo __('Save'); ?></button>
					</div>
				</div>
				
			</form>
		</div>       
	</div>
