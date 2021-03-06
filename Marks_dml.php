<?php

// Data functions (insert, update, delete, form) for table Marks

// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

function Marks_insert(){
	global $Translation;

	// mm: can member insert record?
	$arrPerm=getTablePermissions('Marks');
	if(!$arrPerm[1]){
		return false;
	}

	$data['name'] = makeSafe($_REQUEST['name']);
		if($data['name'] == empty_lookup_value){ $data['name'] = ''; }
	$data['unit'] = makeSafe($_REQUEST['unit']);
		if($data['unit'] == empty_lookup_value){ $data['unit'] = ''; }
	$data['student'] = makeSafe($_REQUEST['student']);
		if($data['student'] == empty_lookup_value){ $data['student'] = ''; }
	$data['regno'] = makeSafe($_REQUEST['student']);
		if($data['regno'] == empty_lookup_value){ $data['regno'] = ''; }
	$data['year'] = makeSafe($_REQUEST['student']);
		if($data['year'] == empty_lookup_value){ $data['year'] = ''; }
	$data['marks'] = makeSafe($_REQUEST['marks']);
		if($data['marks'] == empty_lookup_value){ $data['marks'] = ''; }
	$data['academicyear'] = makeSafe($_REQUEST['student']);
		if($data['academicyear'] == empty_lookup_value){ $data['academicyear'] = ''; }
	$data['semester'] = makeSafe($_REQUEST['semester']);
		if($data['semester'] == empty_lookup_value){ $data['semester'] = ''; }
	$data['date'] = intval($_REQUEST['dateYear']) . '-' . intval($_REQUEST['dateMonth']) . '-' . intval($_REQUEST['dateDay']);
	$data['date'] = parseMySQLDate($data['date'], '1');

	// hook: Marks_before_insert
	if(function_exists('Marks_before_insert')){
		$args=array();
		if(!Marks_before_insert($data, getMemberInfo(), $args)){ return false; }
	}

	$o = array('silentErrors' => true);
	sql('insert into `Marks` set       `name`=' . (($data['name'] !== '' && $data['name'] !== NULL) ? "'{$data['name']}'" : 'NULL') . ', `unit`=' . (($data['unit'] !== '' && $data['unit'] !== NULL) ? "'{$data['unit']}'" : 'NULL') . ', `student`=' . (($data['student'] !== '' && $data['student'] !== NULL) ? "'{$data['student']}'" : 'NULL') . ', `regno`=' . (($data['regno'] !== '' && $data['regno'] !== NULL) ? "'{$data['regno']}'" : 'NULL') . ', `year`=' . (($data['year'] !== '' && $data['year'] !== NULL) ? "'{$data['year']}'" : 'NULL') . ', `marks`=' . (($data['marks'] !== '' && $data['marks'] !== NULL) ? "'{$data['marks']}'" : 'NULL') . ', `academicyear`=' . (($data['academicyear'] !== '' && $data['academicyear'] !== NULL) ? "'{$data['academicyear']}'" : 'NULL') . ', `semester`=' . (($data['semester'] !== '' && $data['semester'] !== NULL) ? "'{$data['semester']}'" : 'NULL') . ', `date`=' . (($data['date'] !== '' && $data['date'] !== NULL) ? "'{$data['date']}'" : 'NULL'), $o);
	if($o['error']!=''){
		echo $o['error'];
		echo "<a href=\"Marks_view.php?addNew_x=1\">{$Translation['< back']}</a>";
		exit;
	}

	$recID = db_insert_id(db_link());

	// hook: Marks_after_insert
	if(function_exists('Marks_after_insert')){
		$res = sql("select * from `Marks` where `id`='" . makeSafe($recID, false) . "' limit 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = makeSafe($recID, false);
		$args=array();
		if(!Marks_after_insert($data, getMemberInfo(), $args)){ return $recID; }
	}

	// mm: save ownership data
	set_record_owner('Marks', $recID, getLoggedMemberID());

	return $recID;
}

function Marks_delete($selected_id, $AllowDeleteOfParents=false, $skipChecks=false){
	// insure referential integrity ...
	global $Translation;
	$selected_id=makeSafe($selected_id);

	// mm: can member delete record?
	$arrPerm=getTablePermissions('Marks');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='Marks' and pkValue='$selected_id'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='Marks' and pkValue='$selected_id'");
	if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
		// delete allowed, so continue ...
	}else{
		return $Translation['You don\'t have enough permissions to delete this record'];
	}

	// hook: Marks_before_delete
	if(function_exists('Marks_before_delete')){
		$args=array();
		if(!Marks_before_delete($selected_id, $skipChecks, getMemberInfo(), $args))
			return $Translation['Couldn\'t delete this record'];
	}

	sql("delete from `Marks` where `id`='$selected_id'", $eo);

	// hook: Marks_after_delete
	if(function_exists('Marks_after_delete')){
		$args=array();
		Marks_after_delete($selected_id, getMemberInfo(), $args);
	}

	// mm: delete ownership data
	sql("delete from membership_userrecords where tableName='Marks' and pkValue='$selected_id'", $eo);
}

function Marks_update($selected_id){
	global $Translation;

	// mm: can member edit record?
	$arrPerm=getTablePermissions('Marks');
	$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='Marks' and pkValue='".makeSafe($selected_id)."'");
	$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='Marks' and pkValue='".makeSafe($selected_id)."'");
	if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){ // allow update?
		// update allowed, so continue ...
	}else{
		return false;
	}

	$data['name'] = makeSafe($_REQUEST['name']);
		if($data['name'] == empty_lookup_value){ $data['name'] = ''; }
	$data['unit'] = makeSafe($_REQUEST['unit']);
		if($data['unit'] == empty_lookup_value){ $data['unit'] = ''; }
	$data['student'] = makeSafe($_REQUEST['student']);
		if($data['student'] == empty_lookup_value){ $data['student'] = ''; }
	$data['regno'] = makeSafe($_REQUEST['student']);
		if($data['regno'] == empty_lookup_value){ $data['regno'] = ''; }
	$data['year'] = makeSafe($_REQUEST['student']);
		if($data['year'] == empty_lookup_value){ $data['year'] = ''; }
	$data['marks'] = makeSafe($_REQUEST['marks']);
		if($data['marks'] == empty_lookup_value){ $data['marks'] = ''; }
	$data['academicyear'] = makeSafe($_REQUEST['student']);
		if($data['academicyear'] == empty_lookup_value){ $data['academicyear'] = ''; }
	$data['semester'] = makeSafe($_REQUEST['semester']);
		if($data['semester'] == empty_lookup_value){ $data['semester'] = ''; }
	$data['date'] = intval($_REQUEST['dateYear']) . '-' . intval($_REQUEST['dateMonth']) . '-' . intval($_REQUEST['dateDay']);
	$data['date'] = parseMySQLDate($data['date'], '1');
	$data['selectedID']=makeSafe($selected_id);

	// hook: Marks_before_update
	if(function_exists('Marks_before_update')){
		$args=array();
		if(!Marks_before_update($data, getMemberInfo(), $args)){ return false; }
	}

	$o=array('silentErrors' => true);
	sql('update `Marks` set       `name`=' . (($data['name'] !== '' && $data['name'] !== NULL) ? "'{$data['name']}'" : 'NULL') . ', `unit`=' . (($data['unit'] !== '' && $data['unit'] !== NULL) ? "'{$data['unit']}'" : 'NULL') . ', `student`=' . (($data['student'] !== '' && $data['student'] !== NULL) ? "'{$data['student']}'" : 'NULL') . ', `regno`=' . (($data['regno'] !== '' && $data['regno'] !== NULL) ? "'{$data['regno']}'" : 'NULL') . ', `year`=' . (($data['year'] !== '' && $data['year'] !== NULL) ? "'{$data['year']}'" : 'NULL') . ', `marks`=' . (($data['marks'] !== '' && $data['marks'] !== NULL) ? "'{$data['marks']}'" : 'NULL') . ', `academicyear`=' . (($data['academicyear'] !== '' && $data['academicyear'] !== NULL) ? "'{$data['academicyear']}'" : 'NULL') . ', `semester`=' . (($data['semester'] !== '' && $data['semester'] !== NULL) ? "'{$data['semester']}'" : 'NULL') . ', `date`=' . (($data['date'] !== '' && $data['date'] !== NULL) ? "'{$data['date']}'" : 'NULL') . " where `id`='".makeSafe($selected_id)."'", $o);
	if($o['error']!=''){
		echo $o['error'];
		echo '<a href="Marks_view.php?SelectedID='.urlencode($selected_id)."\">{$Translation['< back']}</a>";
		exit;
	}


	// hook: Marks_after_update
	if(function_exists('Marks_after_update')){
		$res = sql("SELECT * FROM `Marks` WHERE `id`='{$data['selectedID']}' LIMIT 1", $eo);
		if($row = db_fetch_assoc($res)){
			$data = array_map('makeSafe', $row);
		}
		$data['selectedID'] = $data['id'];
		$args = array();
		if(!Marks_after_update($data, getMemberInfo(), $args)){ return; }
	}

	// mm: update ownership data
	sql("update membership_userrecords set dateUpdated='".time()."' where tableName='Marks' and pkValue='".makeSafe($selected_id)."'", $eo);

}

function Marks_form($selected_id = '', $AllowUpdate = 1, $AllowInsert = 1, $AllowDelete = 1, $ShowCancel = 0, $TemplateDV = '', $TemplateDVP = ''){
	// function to return an editable form for a table records
	// and fill it with data of record whose ID is $selected_id. If $selected_id
	// is empty, an empty form is shown, with only an 'Add New'
	// button displayed.

	global $Translation;

	// mm: get table permissions
	$arrPerm=getTablePermissions('Marks');
	if(!$arrPerm[1] && $selected_id==''){ return ''; }
	$AllowInsert = ($arrPerm[1] ? true : false);
	// print preview?
	$dvprint = false;
	if($selected_id && $_REQUEST['dvprint_x'] != ''){
		$dvprint = true;
	}

	$filterer_unit = thisOr(undo_magic_quotes($_REQUEST['filterer_unit']), '');
	$filterer_student = thisOr(undo_magic_quotes($_REQUEST['filterer_student']), '');

	// populate filterers, starting from children to grand-parents

	// unique random identifier
	$rnd1 = ($dvprint ? rand(1000000, 9999999) : '');
	// combobox: name
	$combo_name = new Combo;
	$combo_name->ListType = 0;
	$combo_name->MultipleSeparator = ', ';
	$combo_name->ListBoxHeight = 10;
	$combo_name->RadiosPerLine = 1;
	if(is_file(dirname(__FILE__).'/hooks/Marks.name.csv')){
		$name_data = addslashes(implode('', @file(dirname(__FILE__).'/hooks/Marks.name.csv')));
		$combo_name->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions($name_data)));
		$combo_name->ListData = $combo_name->ListItem;
	}else{
		$combo_name->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions("CAT 1;;CAT 2;;EXAM")));
		$combo_name->ListData = $combo_name->ListItem;
	}
	$combo_name->SelectName = 'name';
	// combobox: unit
	$combo_unit = new DataCombo;
	// combobox: student
	$combo_student = new DataCombo;
	// combobox: semester
	$combo_semester = new Combo;
	$combo_semester->ListType = 0;
	$combo_semester->MultipleSeparator = ', ';
	$combo_semester->ListBoxHeight = 10;
	$combo_semester->RadiosPerLine = 1;
	if(is_file(dirname(__FILE__).'/hooks/Marks.semester.csv')){
		$semester_data = addslashes(implode('', @file(dirname(__FILE__).'/hooks/Marks.semester.csv')));
		$combo_semester->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions($semester_data)));
		$combo_semester->ListData = $combo_semester->ListItem;
	}else{
		$combo_semester->ListItem = explode('||', entitiesToUTF8(convertLegacyOptions("1;;2;;3")));
		$combo_semester->ListData = $combo_semester->ListItem;
	}
	$combo_semester->SelectName = 'semester';
	// combobox: date
	$combo_date = new DateCombo;
	$combo_date->DateFormat = "mdy";
	$combo_date->MinYear = 1900;
	$combo_date->MaxYear = 2100;
	$combo_date->DefaultDate = parseMySQLDate('1', '1');
	$combo_date->MonthNames = $Translation['month names'];
	$combo_date->NamePrefix = 'date';

	if($selected_id){
		// mm: check member permissions
		if(!$arrPerm[2]){
			return "";
		}
		// mm: who is the owner?
		$ownerGroupID=sqlValue("select groupID from membership_userrecords where tableName='Marks' and pkValue='".makeSafe($selected_id)."'");
		$ownerMemberID=sqlValue("select lcase(memberID) from membership_userrecords where tableName='Marks' and pkValue='".makeSafe($selected_id)."'");
		if($arrPerm[2]==1 && getLoggedMemberID()!=$ownerMemberID){
			return "";
		}
		if($arrPerm[2]==2 && getLoggedGroupID()!=$ownerGroupID){
			return "";
		}

		// can edit?
		if(($arrPerm[3]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[3]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[3]==3){
			$AllowUpdate=1;
		}else{
			$AllowUpdate=0;
		}

		$res = sql("select * from `Marks` where `id`='".makeSafe($selected_id)."'", $eo);
		if(!($row = db_fetch_array($res))){
			return error_message($Translation['No records found'], 'Marks_view.php', false);
		}
		$urow = $row; /* unsanitized data */
		$hc = new CI_Input();
		$row = $hc->xss_clean($row); /* sanitize data */
		$combo_name->SelectedData = $row['name'];
		$combo_unit->SelectedData = $row['unit'];
		$combo_student->SelectedData = $row['student'];
		$combo_semester->SelectedData = $row['semester'];
		$combo_date->DefaultDate = $row['date'];
	}else{
		$combo_name->SelectedText = ( $_REQUEST['FilterField'][1]=='2' && $_REQUEST['FilterOperator'][1]=='<=>' ? (get_magic_quotes_gpc() ? stripslashes($_REQUEST['FilterValue'][1]) : $_REQUEST['FilterValue'][1]) : "");
		$combo_unit->SelectedData = $filterer_unit;
		$combo_student->SelectedData = $filterer_student;
		$combo_semester->SelectedText = ( $_REQUEST['FilterField'][1]=='10' && $_REQUEST['FilterOperator'][1]=='<=>' ? (get_magic_quotes_gpc() ? stripslashes($_REQUEST['FilterValue'][1]) : $_REQUEST['FilterValue'][1]) : "");
	}
	$combo_name->Render();
	$combo_unit->HTML = '<span id="unit-container' . $rnd1 . '"></span><input type="hidden" name="unit" id="unit' . $rnd1 . '" value="' . html_attr($combo_unit->SelectedData) . '">';
	$combo_unit->MatchText = '<span id="unit-container-readonly' . $rnd1 . '"></span><input type="hidden" name="unit" id="unit' . $rnd1 . '" value="' . html_attr($combo_unit->SelectedData) . '">';
	$combo_student->HTML = '<span id="student-container' . $rnd1 . '"></span><input type="hidden" name="student" id="student' . $rnd1 . '" value="' . html_attr($combo_student->SelectedData) . '">';
	$combo_student->MatchText = '<span id="student-container-readonly' . $rnd1 . '"></span><input type="hidden" name="student" id="student' . $rnd1 . '" value="' . html_attr($combo_student->SelectedData) . '">';
	$combo_semester->Render();

	ob_start();
	?>

	<script>
		// initial lookup values
		AppGini.current_unit__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['unit'] : $filterer_unit); ?>"};
		AppGini.current_student__RAND__ = { text: "", value: "<?php echo addslashes($selected_id ? $urow['student'] : $filterer_student); ?>"};

		jQuery(function() {
			setTimeout(function(){
				if(typeof(unit_reload__RAND__) == 'function') unit_reload__RAND__();
				if(typeof(student_reload__RAND__) == 'function') student_reload__RAND__();
			}, 10); /* we need to slightly delay client-side execution of the above code to allow AppGini.ajaxCache to work */
		});
		function unit_reload__RAND__(){
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint){ ?>

			$j("#unit-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c){
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_unit__RAND__.value, t: 'Marks', f: 'unit' },
						success: function(resp){
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="unit"]').val(resp.results[0].id);
							$j('[id=unit-container-readonly__RAND__]').html('<span id="unit-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=units_view_parent]').hide(); }else{ $j('.btn[id=units_view_parent]').show(); }


							if(typeof(unit_update_autofills__RAND__) == 'function') unit_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term){ return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 10,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page){ return { s: term, p: page, t: 'Marks', f: 'unit' }; },
					results: function(resp, page){ return resp; }
				},
				escapeMarkup: function(str){ return str; }
			}).on('change', function(e){
				AppGini.current_unit__RAND__.value = e.added.id;
				AppGini.current_unit__RAND__.text = e.added.text;
				$j('[name="unit"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=units_view_parent]').hide(); }else{ $j('.btn[id=units_view_parent]').show(); }


				if(typeof(unit_update_autofills__RAND__) == 'function') unit_update_autofills__RAND__();
			});

			if(!$j("#unit-container__RAND__").length){
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_unit__RAND__.value, t: 'Marks', f: 'unit' },
					success: function(resp){
						$j('[name="unit"]').val(resp.results[0].id);
						$j('[id=unit-container-readonly__RAND__]').html('<span id="unit-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=units_view_parent]').hide(); }else{ $j('.btn[id=units_view_parent]').show(); }

						if(typeof(unit_update_autofills__RAND__) == 'function') unit_update_autofills__RAND__();
					}
				});
			}

		<?php }else{ ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_unit__RAND__.value, t: 'Marks', f: 'unit' },
				success: function(resp){
					$j('[id=unit-container__RAND__], [id=unit-container-readonly__RAND__]').html('<span id="unit-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=units_view_parent]').hide(); }else{ $j('.btn[id=units_view_parent]').show(); }

					if(typeof(unit_update_autofills__RAND__) == 'function') unit_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
		function student_reload__RAND__(){
		<?php if(($AllowUpdate || $AllowInsert) && !$dvprint){ ?>

			$j("#student-container__RAND__").select2({
				/* initial default value */
				initSelection: function(e, c){
					$j.ajax({
						url: 'ajax_combo.php',
						dataType: 'json',
						data: { id: AppGini.current_student__RAND__.value, t: 'Marks', f: 'student' },
						success: function(resp){
							c({
								id: resp.results[0].id,
								text: resp.results[0].text
							});
							$j('[name="student"]').val(resp.results[0].id);
							$j('[id=student-container-readonly__RAND__]').html('<span id="student-match-text">' + resp.results[0].text + '</span>');
							if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=students_view_parent]').hide(); }else{ $j('.btn[id=students_view_parent]').show(); }


							if(typeof(student_update_autofills__RAND__) == 'function') student_update_autofills__RAND__();
						}
					});
				},
				width: '100%',
				formatNoMatches: function(term){ return '<?php echo addslashes($Translation['No matches found!']); ?>'; },
				minimumResultsForSearch: 10,
				loadMorePadding: 200,
				ajax: {
					url: 'ajax_combo.php',
					dataType: 'json',
					cache: true,
					data: function(term, page){ return { s: term, p: page, t: 'Marks', f: 'student' }; },
					results: function(resp, page){ return resp; }
				},
				escapeMarkup: function(str){ return str; }
			}).on('change', function(e){
				AppGini.current_student__RAND__.value = e.added.id;
				AppGini.current_student__RAND__.text = e.added.text;
				$j('[name="student"]').val(e.added.id);
				if(e.added.id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=students_view_parent]').hide(); }else{ $j('.btn[id=students_view_parent]').show(); }


				if(typeof(student_update_autofills__RAND__) == 'function') student_update_autofills__RAND__();
			});

			if(!$j("#student-container__RAND__").length){
				$j.ajax({
					url: 'ajax_combo.php',
					dataType: 'json',
					data: { id: AppGini.current_student__RAND__.value, t: 'Marks', f: 'student' },
					success: function(resp){
						$j('[name="student"]').val(resp.results[0].id);
						$j('[id=student-container-readonly__RAND__]').html('<span id="student-match-text">' + resp.results[0].text + '</span>');
						if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=students_view_parent]').hide(); }else{ $j('.btn[id=students_view_parent]').show(); }

						if(typeof(student_update_autofills__RAND__) == 'function') student_update_autofills__RAND__();
					}
				});
			}

		<?php }else{ ?>

			$j.ajax({
				url: 'ajax_combo.php',
				dataType: 'json',
				data: { id: AppGini.current_student__RAND__.value, t: 'Marks', f: 'student' },
				success: function(resp){
					$j('[id=student-container__RAND__], [id=student-container-readonly__RAND__]').html('<span id="student-match-text">' + resp.results[0].text + '</span>');
					if(resp.results[0].id == '<?php echo empty_lookup_value; ?>'){ $j('.btn[id=students_view_parent]').hide(); }else{ $j('.btn[id=students_view_parent]').show(); }

					if(typeof(student_update_autofills__RAND__) == 'function') student_update_autofills__RAND__();
				}
			});
		<?php } ?>

		}
	</script>
	<?php

	$lookups = str_replace('__RAND__', $rnd1, ob_get_contents());
	ob_end_clean();


	// code for template based detail view forms

	// open the detail view template
	if($dvprint){
		$template_file = is_file("./{$TemplateDVP}") ? "./{$TemplateDVP}" : './templates/Marks_templateDVP.html';
		$templateCode = @file_get_contents($template_file);
	}else{
		$template_file = is_file("./{$TemplateDV}") ? "./{$TemplateDV}" : './templates/Marks_templateDV.html';
		$templateCode = @file_get_contents($template_file);
	}

	// process form title
	$templateCode = str_replace('<%%DETAIL_VIEW_TITLE%%>', 'Mark details', $templateCode);
	$templateCode = str_replace('<%%RND1%%>', $rnd1, $templateCode);
	$templateCode = str_replace('<%%EMBEDDED%%>', ($_REQUEST['Embedded'] ? 'Embedded=1' : ''), $templateCode);
	// process buttons
	if($AllowInsert){
		if(!$selected_id) $templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-success" id="insert" name="insert_x" value="1" onclick="return Marks_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save New'] . '</button>', $templateCode);
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="insert" name="insert_x" value="1" onclick="return Marks_validateData();"><i class="glyphicon glyphicon-plus-sign"></i> ' . $Translation['Save As Copy'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%INSERT_BUTTON%%>', '', $templateCode);
	}

	// 'Back' button action
	if($_REQUEST['Embedded']){
		$backAction = 'AppGini.closeParentModal(); return false;';
	}else{
		$backAction = '$j(\'form\').eq(0).attr(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;';
	}

	if($selected_id){
		if(!$_REQUEST['Embedded']) $templateCode = str_replace('<%%DVPRINT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="dvprint" name="dvprint_x" value="1" onclick="$$(\'form\')[0].writeAttribute(\'novalidate\', \'novalidate\'); document.myform.reset(); return true;" title="' . html_attr($Translation['Print Preview']) . '"><i class="glyphicon glyphicon-print"></i> ' . $Translation['Print Preview'] . '</button>', $templateCode);
		if($AllowUpdate){
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '<button type="submit" class="btn btn-success btn-lg" id="update" name="update_x" value="1" onclick="return Marks_validateData();" title="' . html_attr($Translation['Save Changes']) . '"><i class="glyphicon glyphicon-ok"></i> ' . $Translation['Save Changes'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		}
		if(($arrPerm[4]==1 && $ownerMemberID==getLoggedMemberID()) || ($arrPerm[4]==2 && $ownerGroupID==getLoggedGroupID()) || $arrPerm[4]==3){ // allow delete?
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '<button type="submit" class="btn btn-danger" id="delete" name="delete_x" value="1" onclick="return confirm(\'' . $Translation['are you sure?'] . '\');" title="' . html_attr($Translation['Delete']) . '"><i class="glyphicon glyphicon-trash"></i> ' . $Translation['Delete'] . '</button>', $templateCode);
		}else{
			$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		}
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>', $templateCode);
	}else{
		$templateCode = str_replace('<%%UPDATE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DELETE_BUTTON%%>', '', $templateCode);
		$templateCode = str_replace('<%%DESELECT_BUTTON%%>', ($ShowCancel ? '<button type="submit" class="btn btn-default" id="deselect" name="deselect_x" value="1" onclick="' . $backAction . '" title="' . html_attr($Translation['Back']) . '"><i class="glyphicon glyphicon-chevron-left"></i> ' . $Translation['Back'] . '</button>' : ''), $templateCode);
	}

	// set records to read only if user can't insert new records and can't edit current record
	if(($selected_id && !$AllowUpdate && !$AllowInsert) || (!$selected_id && !$AllowInsert)){
		$jsReadOnly .= "\tjQuery('#name').replaceWith('<div class=\"form-control-static\" id=\"name\">' + (jQuery('#name').val() || '') + '</div>'); jQuery('#name-multi-selection-help').hide();\n";
		$jsReadOnly .= "\tjQuery('#unit').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#unit_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#student').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('#student_caption').prop('disabled', true).css({ color: '#555', backgroundColor: 'white' });\n";
		$jsReadOnly .= "\tjQuery('#marks').replaceWith('<div class=\"form-control-static\" id=\"marks\">' + (jQuery('#marks').val() || '') + '</div>');\n";
		$jsReadOnly .= "\tjQuery('#semester').replaceWith('<div class=\"form-control-static\" id=\"semester\">' + (jQuery('#semester').val() || '') + '</div>'); jQuery('#semester-multi-selection-help').hide();\n";
		$jsReadOnly .= "\tjQuery('#date').prop('readonly', true);\n";
		$jsReadOnly .= "\tjQuery('#dateDay, #dateMonth, #dateYear').prop('disabled', true).css({ color: '#555', backgroundColor: '#fff' });\n";
		$jsReadOnly .= "\tjQuery('.select2-container').hide();\n";

		$noUploads = true;
	}elseif($AllowInsert){
		$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', true);"; // temporarily disable form change handler
			$jsEditable .= "\tjQuery('form').eq(0).data('already_changed', false);"; // re-enable form change handler
	}

	// process combos
	$templateCode = str_replace('<%%COMBO(name)%%>', $combo_name->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(name)%%>', $combo_name->SelectedData, $templateCode);
	$templateCode = str_replace('<%%COMBO(unit)%%>', $combo_unit->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(unit)%%>', $combo_unit->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(unit)%%>', urlencode($combo_unit->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(student)%%>', $combo_student->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(student)%%>', $combo_student->MatchText, $templateCode);
	$templateCode = str_replace('<%%URLCOMBOTEXT(student)%%>', urlencode($combo_student->MatchText), $templateCode);
	$templateCode = str_replace('<%%COMBO(semester)%%>', $combo_semester->HTML, $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(semester)%%>', $combo_semester->SelectedData, $templateCode);
	$templateCode = str_replace('<%%COMBO(date)%%>', ($selected_id && !$arrPerm[3] ? '<div class="form-control-static">' . $combo_date->GetHTML(true) . '</div>' : $combo_date->GetHTML()), $templateCode);
	$templateCode = str_replace('<%%COMBOTEXT(date)%%>', $combo_date->GetHTML(true), $templateCode);

	/* lookup fields array: 'lookup field name' => array('parent table name', 'lookup field caption') */
	$lookup_fields = array(  'unit' => array('units', 'Unit'), 'student' => array('students', 'Student'));
	foreach($lookup_fields as $luf => $ptfc){
		$pt_perm = getTablePermissions($ptfc[0]);

		// process foreign key links
		if($pt_perm['view'] || $pt_perm['edit']){
			$templateCode = str_replace("<%%PLINK({$luf})%%>", '<button type="button" class="btn btn-default view_parent hspacer-md" id="' . $ptfc[0] . '_view_parent" title="' . html_attr($Translation['View'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-eye-open"></i></button>', $templateCode);
		}

		// if user has insert permission to parent table of a lookup field, put an add new button
		if($pt_perm['insert'] && !$_REQUEST['Embedded']){
			$templateCode = str_replace("<%%ADDNEW({$ptfc[0]})%%>", '<button type="button" class="btn btn-success add_new_parent hspacer-md" id="' . $ptfc[0] . '_add_new" title="' . html_attr($Translation['Add New'] . ' ' . $ptfc[1]) . '"><i class="glyphicon glyphicon-plus-sign"></i></button>', $templateCode);
		}
	}

	// process images
	$templateCode = str_replace('<%%UPLOADFILE(id)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(name)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(unit)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(student)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(marks)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(grade)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(semester)%%>', '', $templateCode);
	$templateCode = str_replace('<%%UPLOADFILE(date)%%>', '', $templateCode);

	// process values
	if($selected_id){
		if( $dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', safe_html($urow['id']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(id)%%>', html_attr($row['id']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode($urow['id']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(name)%%>', safe_html($urow['name']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(name)%%>', html_attr($row['name']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(name)%%>', urlencode($urow['name']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(unit)%%>', safe_html($urow['unit']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(unit)%%>', html_attr($row['unit']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(unit)%%>', urlencode($urow['unit']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(student)%%>', safe_html($urow['student']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(student)%%>', html_attr($row['student']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(student)%%>', urlencode($urow['student']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(marks)%%>', safe_html($urow['marks']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(marks)%%>', html_attr($row['marks']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(marks)%%>', urlencode($urow['marks']), $templateCode);
		$templateCode = str_replace('<%%VALUE(grade)%%>', safe_html($urow['grade']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(grade)%%>', urlencode($urow['grade']), $templateCode);
		if( $dvprint) $templateCode = str_replace('<%%VALUE(semester)%%>', safe_html($urow['semester']), $templateCode);
		if(!$dvprint) $templateCode = str_replace('<%%VALUE(semester)%%>', html_attr($row['semester']), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(semester)%%>', urlencode($urow['semester']), $templateCode);
		$templateCode = str_replace('<%%VALUE(date)%%>', @date('m/d/Y', @strtotime(html_attr($row['date']))), $templateCode);
		$templateCode = str_replace('<%%URLVALUE(date)%%>', urlencode(@date('m/d/Y', @strtotime(html_attr($urow['date'])))), $templateCode);
	}else{
		$templateCode = str_replace('<%%VALUE(id)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(id)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(name)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(name)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(unit)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(unit)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(student)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(student)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(marks)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(marks)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(grade)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(grade)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(semester)%%>', '', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(semester)%%>', urlencode(''), $templateCode);
		$templateCode = str_replace('<%%VALUE(date)%%>', '1', $templateCode);
		$templateCode = str_replace('<%%URLVALUE(date)%%>', urlencode('1'), $templateCode);
	}

	// process translations
	foreach($Translation as $symbol=>$trans){
		$templateCode = str_replace("<%%TRANSLATION($symbol)%%>", $trans, $templateCode);
	}

	// clear scrap
	$templateCode = str_replace('<%%', '<!-- ', $templateCode);
	$templateCode = str_replace('%%>', ' -->', $templateCode);

	// hide links to inaccessible tables
	if($_REQUEST['dvprint_x'] == ''){
		$templateCode .= "\n\n<script>\$j(function(){\n";
		$arrTables = getTableList();
		foreach($arrTables as $name => $caption){
			$templateCode .= "\t\$j('#{$name}_link').removeClass('hidden');\n";
			$templateCode .= "\t\$j('#xs_{$name}_link').removeClass('hidden');\n";
		}

		$templateCode .= $jsReadOnly;
		$templateCode .= $jsEditable;

		if(!$selected_id){
		}

		$templateCode.="\n});</script>\n";
	}

	// ajaxed auto-fill fields
	$templateCode .= '<script>';
	$templateCode .= '$j(function() {';

	$templateCode .= "\tstudent_update_autofills$rnd1 = function(){\n";
	$templateCode .= "\t\t\$j.ajax({\n";
	if($dvprint){
		$templateCode .= "\t\t\turl: 'Marks_autofill.php?rnd1=$rnd1&mfk=student&id=' + encodeURIComponent('".addslashes($row['student'])."'),\n";
		$templateCode .= "\t\t\tcontentType: 'application/x-www-form-urlencoded; charset=" . datalist_db_encoding . "', type: 'GET'\n";
	}else{
		$templateCode .= "\t\t\turl: 'Marks_autofill.php?rnd1=$rnd1&mfk=student&id=' + encodeURIComponent(AppGini.current_student{$rnd1}.value),\n";
		$templateCode .= "\t\t\tcontentType: 'application/x-www-form-urlencoded; charset=" . datalist_db_encoding . "', type: 'GET', beforeSend: function(){ \$j('#student$rnd1').prop('disabled', true); \$j('#studentLoading').html('<img src=loading.gif align=top>'); }, complete: function(){".(($arrPerm[1] || (($arrPerm[3] == 1 && $ownerMemberID == getLoggedMemberID()) || ($arrPerm[3] == 2 && $ownerGroupID == getLoggedGroupID()) || $arrPerm[3] == 3)) ? "\$j('#student$rnd1').prop('disabled', false); " : "\$j('#student$rnd1').prop('disabled', true); ")."\$j('#studentLoading').html('');}\n";
	}
	$templateCode.="\t\t});\n";
	$templateCode.="\t};\n";
	if(!$dvprint) $templateCode.="\tif(\$j('#student_caption').length) \$j('#student_caption').click(function(){ student_update_autofills$rnd1(); });\n";


	$templateCode.="});";
	$templateCode.="</script>";
	$templateCode .= $lookups;

	// handle enforced parent values for read-only lookup fields

	// don't include blank images in lightbox gallery
	$templateCode = preg_replace('/blank.gif" data-lightbox=".*?"/', 'blank.gif"', $templateCode);

	// don't display empty email links
	$templateCode=preg_replace('/<a .*?href="mailto:".*?<\/a>/', '', $templateCode);

	/* default field values */
	$rdata = $jdata = get_defaults('Marks');
	if($selected_id){
		$jdata = get_joined_record('Marks', $selected_id);
		if($jdata === false) $jdata = get_defaults('Marks');
		$rdata = $row;
	}
	$cache_data = array(
		'rdata' => array_map('nl2br', array_map('addslashes', $rdata)),
		'jdata' => array_map('nl2br', array_map('addslashes', $jdata))
	);
	$templateCode .= loadView('Marks-ajax-cache', $cache_data);

	// hook: Marks_dv
	if(function_exists('Marks_dv')){
		$args=array();
		Marks_dv(($selected_id ? $selected_id : FALSE), getMemberInfo(), $templateCode, $args);
	}

	return $templateCode;
}
?>