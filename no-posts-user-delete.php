<?php
/*
Plugin Name: Delete Spam Users
Plugin URI: https://www.mcwebdesign.ro/2013/10/05/wordpress-delete-spam-users-plugin/
Description: Remove users that have no published posts AND/OR no published comments (usually spam users). After activating, you can find the plugin under "Users" menu.
Author: MC Web Design
Version: 3.0
Author URI: https://www.mcwebdesign.ro/
*/


$npud_version = '3.0';


function npud_add_options_pages() {
	if (function_exists('add_users_page')) {
		add_users_page("Delete Spam Users", 'Delete Spam Users', 'delete_users', __FILE__, 'npud_options_page');
	}		
}

function npud_options_page() {
	global $wpdb, $npud_version, $user_ID;
	$tp = $wpdb->prefix;
	
?>

	<table width="100%">
	<tbody>
		<tr>
			<td style="vertical-align: top;">
				<h2>Delete Spam Users  v<?php echo $npud_version; ?></h2>
			</td>
			<td>
				<div style="text-align: center;">
					<p>You can support the author for further development by donating a small amount. It helps a lot!</p>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				</div>
			</td>
		</tr>
	</tbody>
	</table>
	
	<p>Visit the <a href="https://www.mcwebdesign.ro/2013/10/05/wordpress-delete-spam-users-plugin/">plugin's homepage</a> for more details.</p>
	<h3>How it works</h3>
	<ol>
		<li>Check the option <strong>User has no posts</strong> AND/OR <strong>User has no comments</strong>.</li>
		<li>Choose the <strong>User role</strong> you want to find.</li>
		<li>Select the <strong>maximum number of results</strong> to display.</li>
		<li>Choose desired <strong>Order by</strong> sort criteria.</li>
		<li>Press the <strong>Search</strong> button.</li>
	</ol>
	<p>The plugin will return all the users with no published posts AND/OR no published comments (usually spam users).</p>

	<form enctype="multipart/form-data" method="POST" action="" id="delete-spam-users-form">
	<input type="hidden" name="op" value="search_users" />
		<table>					
			<tr>
				<td colspan="2">
					<h2 class="section-title"><?=__('Search criteria')?></h2>
					<hr width=90% align="left"/>
					<input id="flag_no_recs" type="checkbox" name="no_recs" value="yes" <?php echo empty($_POST['no_recs']) ? '' : 'checked' ?> />
					<label for="flag_no_recs"><?php echo __('User has <span style="color: #0085ba;"><strong>no posts</strong></span>')?></label>
				</td>
			</tr>			
			<tr>
				<td colspan="2">
					<input id="flag_no_comments" type="checkbox" name="no_comments" value="yes" <?php echo empty($_POST['no_comments']) ? '' : 'checked' ?> />
					<label for="flag_no_comments"><?php echo __('User has <span style="color: #e14d43;"><strong>no comments</strong></span>')?></label>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<label for="user_role"><?php echo __('User role: &nbsp;')?></label>
					<select name="user_role_eq">
						<?php
							$columns = array('Subscriber', 'Administrator', 'Contributor', 'Author', 'Editor');
							foreach($columns as $r) {
								print '<option value="' . $r . '" ' . ($_POST['user_role_eq'] == $r ? 'selected' : '') . '>' . $r . '</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="2">
					<h2 class="section-title"><?=__('Plugin options')?></h2>
					<hr width=90% align="left"/>
					<label for="max_output"><?php echo  __('Max number of results to display: &nbsp;')?></label>
					<select id="max_size_output" name="max_size_output" />
			<?php
				$limit = array('100', '1000', '5000', '10000', 'all');
				foreach($limit as $v) {
					print '<option value="' . $v . '" ' . ($_POST['max_size_output'] == $v ? 'selected' : '') . '>' . $v . '</option>';
				}
			?>
					</select> <br />
					<small><?php echo  __('PHP on this server allows to return'). ' ' . ini_get('max_input_vars') . ' ' . __('results.')?></small><br />
					<small><?php echo  __('Do not select a higher value than PHP allows it. The higher the value, the longer it will take to load the results.')?></small>
				</td>
			</tr>
			<tr>
				<td align="left" colspan="2">
					<label for="sort_order"><?php echo  __('Order by: ')?></label>
					<select id="sort_order" name="sort_order" />
						<?php
							$columns = array(
								'userID' => 'User ID',
								'usrname' => 'Username', 
								'name' => 'Name');
							foreach($columns as $k => $v) {
								print '<option value="' . $k . '" ' . ($_POST['sort_order'] == $k ? 'selected' : '') . '>' . $v . '</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<hr width=90% align="left"/>
					<input class="button-primary" type="submit" size="4" value="<?php echo __('Search')?>" />
				</td>
			</tr>
		</table>

<?php 

    if (!isset($_POST['op'])) $_POST['op'] = 'stand_by';

    switch ($_POST['op']) {
    case 'stand_by':
        break;
    case 'finally_delete':
    case 'delete':
        //delete all selected users
        echo '<hr />';
        if (empty($_POST['f_users'])) {
			echo '<div style="color:#fff; background: #0074A2; border:0px; padding:8px 20px; font-size:10pt; width:650px;">';
			echo '<strong>You didn\'t select any user</strong></div>';
        } else {
            if ( !current_user_can('delete_users') ) __('You don&#8217;t have rights to delete users.');
            else 
            if ($_POST['op'] == 'finally_delete') {
            
                echo "Deleting...<br />";
                $cnt_deleted = 0;
                foreach($_POST['f_users'] as $user_id_to_delete) {
    
                    if ($user_id_to_delete == $user_ID) {
                        echo 'You can\'t delete your profile ! <br />';
                        continue; //don't delete current-user
                    }
					
                    wp_delete_user($user_id_to_delete);
                    $cnt_deleted ++;
                }
                if ($cnt_deleted == 1) echo '<div style="color:#fff; background: #0074A2; border:0px; padding:8px 20px; font-size:10pt; width:650px;">'.$cnt_deleted . ' ' . __('user was deleted').'</div>';
                else echo '<div style="color:#fff; background: #0074A2; border:0px; padding:8px 20px; font-size:10pt; width:650px;">'.$cnt_deleted . ' ' . __('users were deleted').'</div>';
                
            } else {
                if (!is_array($_POST['f_users'])) $_POST['f_users'] = array($_POST['f_users']);
                echo '<span style="background-color: red; padding: 5px; color: white;">Caution !</span><br /><br />
                    <strong>Please be careful, you are going to delete: <span style="color: red;"> ' . count($_POST['f_users']) . ' user(s) </span>. Data will be erased permanently.<br />Proceed?</strong> 
                    <input type="button" class="button-primary" value="Yes" onclick="this.form.op.value=\'finally_delete\'; this.form.submit();"/>&nbsp;
                    <input type="button" class="button-secondary-red" value="No, don\'t do it" onclick="this.form.submit();"/><br /><br />';
            }
        }
    case 'search_users':
	
		$condition = array();
		
		//user role
		switch ($_POST['user_role_eq']) {
		case 'Administrator':
			$condition[] = "(WUM.meta_value >= 8) AND (WUM.meta_value <= 10)";
			break;
		case 'Subscriber':
			$condition[] = "(WUM.meta_value <= 0) OR (WUM.meta_value > 10)";		
			break;
		case 'Contributor':
			$condition[] = "(WUM.meta_value = 1)";			
			break;
		case 'Author':
			$condition[] = "(WUM.meta_value = 2)";
			break;
		case 'Editor':
			$condition[] = "(WUM.meta_value >= 3) AND (WUM.meta_value <= 7)";
			break;
		default:
			$condition[] = "(WUM.meta_value <= 0) OR (WUM.meta_value > 10)";
		}
		
		
		//find users based on user role
		$query = "SELECT 					
			WU.ID, WU.user_login as login, WU.display_name as name				
			FROM {$tp}users WU 				
			LEFT JOIN {$tp}usermeta WUM ON WUM.user_id = WU.ID AND WUM.meta_key = '{$tp}user_level'				
			WHERE " . implode("" , $condition) . "				
			GROUP BY WU.ID, WU.user_login, WU.display_name";	
		
		//sort order
		switch ($_POST['sort_order']) {
		case 'userID':
			$sort_order = 'WU.ID';
			break;
		case 'usrname':
			$sort_order = 'WU.user_login';
			break;
		case 'name':
			$sort_order = 'WU.display_name';
			break;
		default:
			$sort_order = 'WU.ID';
		}
		$query .= " ORDER BY $sort_order";
		
		//limit results 				
		$query .= $_POST['max_size_output'] == 'all' ? ' ' : ' LIMIT ' . ($_POST['max_size_output']);		

        $rows = $wpdb->get_results($query, ARRAY_A);

        $user_list = array();
		
		if (!empty($rows)) 
            foreach($rows as $k => $UR) {
                $UR['recs'] = 0;
				$UR['comments'] = 0;
                $user_list[$UR['ID']] = $UR; 
            }
			
		// find users with published posts and count published posts	
         $query = "SELECT 					
			COUNT(WP.ID) as recs, WU.ID				
			FROM {$tp}users WU 				
			LEFT JOIN {$tp}posts WP ON WP.post_author = WU.ID AND NOT WP.post_type in ('attachment', 'revision') AND post_status = 'publish' 
			GROUP BY WU.ID";
		 
		 $rows = $wpdb->get_results($query, ARRAY_A);                
		 if (!empty($rows))             
			 foreach($rows as $k => $UR) {                
				$id = $UR['ID'];                
				if (isset($user_list[$id])) $user_list[$id]['recs'] = $UR['recs'];                
				if (!empty($_POST['no_recs']) && $UR['recs']) unset($user_list[$id]);            
			}	

		// find users with published commnets and count approved comments
		 $query = "SELECT 
			COUNT(WC.comment_ID) as comments, WU.ID					
			FROM {$tp}users WU 					
			LEFT JOIN {$tp}comments WC ON WC.user_id = WU.ID AND WC.comment_approved = 1 
			GROUP BY WU.ID" ;  
		 
		 $rows = $wpdb->get_results($query, ARRAY_A);                
		 if (!empty($rows))             
			 foreach($rows as $k => $UR) {                
				$id = $UR['ID'];                
				if (isset($user_list[$id])) $user_list[$id]['comments'] = $UR['comments'];                
				if (!empty($_POST['no_comments']) && $UR['comments']) unset($user_list[$id]);            
			}			
		 
		//generate users list
        if (empty($user_list)) {
            echo __('<div style="color:#fff; background: #A3B745; border:0px; padding:8px 20px; font-size:10pt; width:650px;">No users were found.</div>');
        } else {
		
			if (count($user_list) == 1) echo '<div style="color:#fff; background: #A3B745; border:0px; padding:8px 20px; font-size:10pt; width:650px;">' . count($user_list) . ' ' . __('user was found') . '</div>';
            else echo '<div style="color:#fff; background: #A3B745; border:0px; padding:8px 20px; font-size:10pt; width:650px;">' . count($user_list) . ' ' . __('users were found') . '</div>';
				
            echo '<hr><input type="button" value="' . __('Check all') . '" onclick="
                var f_elm = this.form[\'f_users[]\'];
                if (f_elm.length > 0) {
                    for(i=0; i<f_elm.length; i++)
                        f_elm[i].checked = true;
                } else f_elm.checked = true;
            " /> <input type="button" value="' . __('Uncheck all') . '"  onclick="
                f_elm = this.form[\'f_users[]\'];
                if (f_elm.length > 0) {
                    for(i=0; i<f_elm.length; i++)
                        f_elm[i].checked = false;
                } else f_elm.checked = false;
            " /> ' . __('&nbsp;&nbsp;Proceed') . ' : <input type="button" class="button-secondary-red" value="' . __('Delete all selected users') . '" onclick="
                    this.form.op.value=\'delete\';
                    this.form.submit();
            "/>
            <table cellpadding="3"><tr>
				<th>' . __('') . '</th>
				<th class="clickable" width="50" align="left" onclick="jQuery(\'#sort_order\').val(\'userID\'); jQuery(\'#delete-spam-users-form\').submit();" >' . __('ID') . '</th>
				<th class="clickable" width="200" align="left" onclick="jQuery(\'#sort_order\').val(\'usrname\'); jQuery(\'#delete-spam-users-form\').submit();" >' . __('Username') . '</th>
				<th class="clickable" width="200" align="left" onclick="jQuery(\'#sort_order\').val(\'name\'); jQuery(\'#delete-spam-users-form\').submit();" >' . __('Name') . '</th>
				<th width="50" align="left">' . __('Posts') . '</th>
				<th width="50" align="left">' . __('Comments') . '</th></tr>';
            
            $i = 0;
            foreach($user_list as $UR) {
                $i++;
                $color = $i % 2 ? '#DDE9F7' : '#E5E5E5';
                echo "<tr align=\"center\" style=\"background-color:$color\" ><td>";
				if ($UR['ID'] == $user_ID ) {
					echo "-";
				} else {
					echo "<input type=\"checkbox\" name=\"f_users[]\" value=\"$UR[ID]\"/ " 
                . (isset($_POST['f_users']) && in_array($UR['ID'], $_POST['f_users']) ? 'checked' : '') 
                . ">";
				}
				echo "
					</td><td align=\"left\">"
					. ($UR['ID'] ? $UR['ID'] : '-') . "</td><td align=\"left\">"
                    . ($UR['login'] ? $UR['login'] : '-')
                    . "</td><td align=\"left\">$UR[name]</td><td align=\"left\">"
					. ($UR['recs'] ? $UR['recs'] : "<span style=\"color:red;\">0</span>") 
					. "</td><td align=\"left\">"
					. ($UR['comments'] ? $UR['comments'] : "<span style=\"color:red;\">0</span>") 
					. "</td></tr>\n";
				
            }
            ?></table><?php
           
        }
        
        break;
    }

?>
</form>	

<style>
		.clickable {
			cursor: pointer;
		}
		
		.button-secondary-red {
			background: #ba0000;
			border-color: #690000 #690000 #690000;
			-webkit-box-shadow: 0 1px 0 #690000;
			box-shadow: 0 1px 0 #690000;
			color: #fff;
			text-decoration: none;
			text-shadow: 0 -1px 1px #690000, 1px 0 1px #690000, 0 1px 1px #690000, -1px 0 1px #690000;	
			display: inline-block;
			text-decoration: none;
			font-size: 13px;
			line-height: 26px;
			height: 28px;
			margin: 0;
			padding: 0 10px 1px;
			cursor: pointer;
			border-width: 1px;
			border-style: solid;
			-webkit-appearance: none;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			white-space: nowrap;
		}
		
		.button-secondary-red:hover {
			background: #ca0000;
			color: #fff;
		}
		
		.section-title {
			margin: 10px 0;
		}
	</style>

<?php }

add_action('admin_menu', 'npud_add_options_pages');
add_filter('plugin_action_links', 'add_action_links', 10, 2 );
	
	function add_action_links($links, $file) {
		if (strpos($file, 'no-posts-user-delete.php' ) === false ) return $links;
		$mylinks = array(
			'<a href="' . admin_url( 'users.php?page=' . $file ) . '">' . __('Settings') . '</a>',
		);

		return array_merge( $links, $mylinks );		
	}
?>