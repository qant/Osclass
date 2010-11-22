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

class CategoryForm extends Form {
    
    static public function primary_input_hidden($category) {
        parent::generic_input_hidden("id", $category["pk_i_id"]) ;    
    }

    static public function category_select($categories, $category, $default_item = null) {
        echo '<select name="fk_i_parent_id" id="parentId">' ;
            if(isset($default_item)) {
                echo '<option value="">' . $default_item . '</option>' ;
            }
            foreach($categories as $c) {
                echo '<option value="' . $c['pk_i_id'] . '"' . ( ($category["fk_i_parent_id"] == $c['pk_i_id']) ? 'selected="selected"' : '' ) . '>' . $c['s_name'] . '</option>' ;
                if(isset($c['categories']) && is_array($c['categories'])) {
                    CategoryForm::subcategory_select($c['categories'], $category, $default_item, 1);
                }
            }
        echo '</select>' ;
        return true ;
    }

    static public function subcategory_select($categories, $category, $default_item = null, $deep = 0) {
            $deep_string = "";
            for($var = 0;$var<$deep;$var++) {
                $deep_string .= '&nbsp;&nbsp;';
            }
            $deep++;
            foreach($categories as $c) {
                echo '<option value="' . $c['pk_i_id'] . '"' . ( ($category["fk_i_parent_id"] == $c['pk_i_id']) ? 'selected="selected"' : '' ) . '>' . $deep_string.$c['s_name'] . '</option>' ;
                if(isset($c['categories']) && is_array($c['categories'])) {
                    CategoryForm::subcategory_select($c['categories'], $category, $default_item, $deep+1);
                }
            }
    }

    static public function expiration_days_input_text($category = null) {
        parent::generic_input_text("i_expiration_days", (isset($category) && isset($category['i_expiration_days'])) ? $category["i_expiration_days"] : "", 3) ;
        return true ;
    }
    
    static public function position_input_text($category = null) {
        parent::generic_input_text("i_position", (isset($category) && isset($category['i_position'])) ? $category["i_position"] : "", 3) ;
        return true ;
    }

    static public function enabled_input_checkbox($category = null) {
        parent::generic_input_checkbox("b_enabled", "1", (isset($category) && isset($category['b_enabled']) && $category["b_enabled"] == 1) ? true : false) ;
        return true ;
    }
    
    static public function multilanguage_name_description($locales, $category = null) {
        echo '<div class="tabber">';
        foreach($locales as $locale) {
            echo '<div class="tabbertab">';
                echo '<h2>' . $locale['s_name'] . '</h2>';
                echo '<div class="FormElement">';
                    echo '<div class="FormElementName">' . __('Title') . '</div>';
                    echo '<div class="FormElementInput">' ;
                        parent::generic_input_text($locale['pk_c_code'] . '#s_name', (isset($category['locale'][$locale['pk_c_code']])) ? $category['locale'][$locale['pk_c_code']]['s_name'] : "") ;
                    echo '</div>' ;
                echo '</div>';
                echo '<div class="FormElement">';
                    echo '<div class="FormElementName">' . __('Description') . '</div>';
                    echo '<div class="FormElementInput">' ;
                        parent::generic_textarea($locale['pk_c_code'] . '#s_description', (isset($category['locale'][$locale['pk_c_code']])) ? htmlspecialchars($category['locale'][$locale['pk_c_code']]['s_description']) : "") ;
                    echo '</div>' ;
                echo '</div>';
            echo '</div>';
         }
         echo '</div>';
    }
}

?>
