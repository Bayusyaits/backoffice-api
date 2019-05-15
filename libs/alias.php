<?php

//aliases
function response_dyn_menu($data = [], $for = '', $object = '',$lang = 'en'){
	$content = [];
	$dm_name 	 = 'dm_content_en';
	if(isset($lang) && $lang == 'id') {
		$dm_name 	 = 'dm_content_id';
	}
	if(isset($data) && !empty($data) && $for == '' && $object == 'get'){
		foreach ($data as $key => $value) {
			# code...
			$content[$key]['menu_id'] = $data[$key]['dm_id'];
			$content[$key]['menu_name'] = $data[$key][$dm_name];
			$content[$key]['menu_url'] = $data[$key]['dm_url'];
			$content[$key]['menu_uri'] = $data[$key]['dm_uri'];
			$content[$key]['menu_initial'] = $data[$key]['dm_initial'];
			$content[$key]['menu_keyword'] = $data[$key]['dm_keyword'];
		}
	}else {
		$content['menu_id'] = '';
		$content['menu_name'] = '';
		$content['menu_url'] = '';
		$content['menu_uri'] = '';
		$content['menu_initial'] = '';
		$content['menu_keyword'] = '';
	}
	return $content;
}

//aliases
function response_mr_media($data = [], $for = '', $object = '',$lang = 'en'){
	$content = [];
	$dm_name 	 = 'dm_content_en';
	$mm_alt 	 = 'mm_alt_en';
	if(isset($lang) && $lang == 'id') {
		$dm_name 	 = 'dm_content_id';
		$mm_alt 	 = 'mm_alt_id';
	}
	if(isset($data) && !empty($data) && $for == 'join|dyn_menu' && $object == 'get'){
		foreach ($data as $key => $value) {
			# code...
			//mr_media
			$content[$key]['media_id'] = $data[$key]['mm_id'];
			$content[$key]['media_alt'] = $data[$key][$mm_alt];
			$content[$key]['media_initial'] = $data[$key]['mm_initial'];
			$content[$key]['media_name'] = $data[$key]['mm_name'];
			$content[$key]['media_parent_id'] = $data[$key]['mm_parent_id'];
			$content[$key]['media_src'] = $data[$key]['mm_src'];		
			$content[$key]['media_url'] = $data[$key]['mm_url'];
			$content[$key]['media_create_at'] = dateToEn($data[$key]['mm_create_at']);
			$content[$key]['media_update_at'] = dateToEn($data[$key]['mm_update_at']);	
			//dyn_menu
			$content[$key]['menu_id'] = $data[$key]['dm_id'];
			$content[$key]['menu_name'] = $data[$key][$dm_name];
			$content[$key]['menu_url'] = $data[$key]['dm_url'];
			$content[$key]['menu_uri'] = $data[$key]['dm_uri'];
			$content[$key]['menu_initial'] = $data[$key]['dm_initial'];
			$content[$key]['menu_keyword'] = $data[$key]['dm_keyword'];
		}
	}if(isset($data) && !empty($data) && $for == 'join|dyn_menu' && $object == 'first'){
		foreach ($data as $key => $value) {
			# code...
			//mr_media
			$content['media_id'] = $data['mm_id'];
			$content['media_alt'] = $data[$mm_alt];
			$content['media_initial'] = $data['mm_initial'];
			$content['media_name'] = $data['mm_name'];
			$content['media_parent_id'] = $data['mm_parent_id'];
			$content['media_src'] = $data['mm_src'];
			$content['media_url'] = $data['mm_url'];
			$content['media_create_at'] = dateToEn($data['mm_create_at']);
			$content['media_update_at'] = dateToEn($data['mm_update_at']);
			//dyn_menu
			$content['menu_id'] = $data['dm_id'];
			$content['menu_name']	= $data[$dm_name];
			$content['menu_caption'] = $data['dm_initial'];
			$content['menu_keyword'] = $data['dm_keyword'];
			$content['menu_url'] = $data['dm_url'];
			$content['menu_uri'] = $data['dm_uri'];
		}
	}else if(isset($data) && !empty($data) && $object == 'get'){
		foreach ($data as $key => $value) {
			# code...
			//mr_media
			$content[$key]['media_id'] = $data[$key]['mm_id'];
			$content[$key]['media_alt'] = $data[$key][$mm_alt];
			$content[$key]['media_initial'] = $data[$key]['mm_initial'];
			$content[$key]['media_name'] = $data[$key]['mm_name'];
			$content[$key]['media_parent_id'] = $data[$key]['mm_parent_id'];
			$content[$key]['media_src'] = $data[$key]['mm_src'];	
			$content[$key]['media_url'] = $data[$key]['mm_url'];	
			$content[$key]['media_create_at'] = dateToEn($data[$key]['mm_create_at']);
			$content[$key]['media_update_at'] = dateToEn($data[$key]['mm_update_at']);	
		}
	}else if(isset($data) && !empty($data) && $object == 'first'){
		foreach ($data as $key => $value) {
			# code...
			//mr_media
			$content['media_id'] = $data['mm_id'];
			$content['media_alt'] = $data[$mm_alt];
			$content['media_initial'] = $data['mm_initial'];
			$content['media_name'] = $data['mm_name'];
			$content['media_parent_id'] = $data['mm_parent_id'];
			$content['media_src'] = $data['mm_src'];
			$content['media_url'] = $data['mm_url'];
			$content['media_create_at'] = dateToEn($data['mm_create_at']);
			$content['media_update_at'] = dateToEn($data['mm_update_at']);	
		}
	}else {
		//mr_media
		$content['media_id'] = '';
		$content['media_alt'] = '';
		$content['media_initial'] = '';
		$content['media_name'] = '';
		$content['media_parent_id'] = '';
		$content['media_src'] = '';	
		$content['media_url'] = '';
		$content['media_create_at'] = '';
		$content['media_update_at'] = '';
		//dyn_menu
		$content['menu_id'] = '';
		$content['menu_name'] = '';
		$content['menu_url'] = '';
		$content['menu_uri'] = '';
		$content['menu_initial'] = '';
		$content['menu_keyword'] = '';

	}
	return $content;
}

function response_mr_categories($data = [], $for = '', $object = '', $lang = 'en'){
	$content = [];
	$fields	 = [];
	$subjects = [];
	$mcl_content = 'mc_content_en';
	$dm_name 	 = 'dm_content_en';
	if(isset($lang) && $lang == 'id') {
		$mcl_content = 'mc_content_id';
		$dm_name 	 = 'dm_content_id';
	}
	if(isset($data) && !empty($data) && $for == 'merge|join|dm_menu' && $object == 'get'){
		foreach ($data as $key => $value) {

			if(isset($data[$key]['mc_id']) && $data[$key]['mc_dm_id'] === 55103) {
				# code...
				$fields[$key]['category_id'] 			= $data[$key]['mc_id'];
				$fields[$key]['category_menu_id'] 		= $data[$key]['mc_dm_id'];
				$fields[$key]['category_type'] 			= $data[$key]['mc_type'];
				$fields[$key]['category_name'] 			= $data[$key][$mcl_content];
				$fields[$key]['category_initial'] 		= $data[$key]['mc_initial'];
				$fields[$key]['category_parent'] 		= $data[$key]['mc_is_parent'];
				$fields[$key]['category_parent_id']		= $data[$key]['mc_parent_id'];
				$fields[$key]['menu_id'] 				= $data[$key]['dm_id'];
				$fields[$key]['menu_name'] 				= $data[$key][$dm_name];
			}

			if(isset($data[$key]['mc_id']) && $data[$key]['mc_dm_id'] === 55105) {
				# code...
				$subjects[$key]['category_id'] 			= $data[$key]['mc_id'];
				$subjects[$key]['category_menu_id'] 	= $data[$key]['mc_dm_id'];
				$subjects[$key]['category_type'] 		= $data[$key]['mc_type'];
				$subjects[$key]['category_name'] 		= $data[$key][$mcl_content];
				$subjects[$key]['category_initial'] 	= $data[$key]['mc_initial'];
				$subjects[$key]['category_parent'] 		= $data[$key]['mc_is_parent'];
				$subjects[$key]['category_parent_id']	= $data[$key]['mc_parent_id'];
				$subjects[$key]['menu_id'] 				= $data[$key]['dm_id'];
				$subjects[$key]['menu_name'] 			= $data[$key][$dm_name];
			}
		}
		
		$content = ['portfolio' => $fields, 'contact' => $subjects];

	}else if(isset($data) && !empty($data) && $for == 'join|dm_menu' && $object == 'get'){
		foreach ($data as $key => $value) {
			# code...
			$content[$key]['category_id'] = $data[$key]['mc_id'];
			$content[$key]['category_menu_id'] = $data[$key]['mc_dm_id'];
			$content[$key]['category_type'] = $data[$key]['mc_type'];
			$content[$key]['category_name'] = $data[$key][$mcl_content];
			$content[$key]['category_initial'] = $data[$key]['mc_initial'];
			$content[$key]['category_parent'] = $data[$key]['mc_is_parent'];
			$content[$key]['category_parent_id']= $data[$key]['mc_parent_id'];
			$content[$key]['menu_id'] 			= $data[$key]['dm_id'];
			$content[$key]['menu_name'] 		= $data[$key][$dm_name];
		}
	}else if(isset($data) && !empty($data)){
		foreach ($data as $key => $value) {
			# code...
			$content[$key]['category_id'] = $data[$key]['mc_id'];
			$content[$key]['category_menu_id'] = $data[$key]['mc_dm_id'];
			$content[$key]['category_type'] = $data[$key]['mc_type'];
			$content[$key]['category_name'] = $data[$key][$mcl_content];
			$content[$key]['category_initial'] = $data[$key]['mc_initial'];
			$content[$key]['category_parent'] = $data[$key]['mc_is_parent'];
			$content[$key]['category_parent_id']= $data[$key]['mc_parent_id'];
		}
	}else {
		$content['category_id'] = '';
		$content['category_menu_id'] = '';
		$content['category_type'] = '';
		$content['category_name'] = '';
		$content['category_initial'] = '';
		$content['category_parent'] = '';
		$content['category_parent_id']= '';
		$content['menu_id'] 			= '';
		$content['menu_name'] 		= '';
	}
	return $content;
}

function response_mr_content_management($data = [], $for = '', $object = '', $parent = [], $related = [], $lang = 'en'){
	$content = [];
	$portfolio = [];
	$media   = [];
	$relate  = [];
	$mtp_caption = 'mtp_caption_en';
	$mtp_content = 'mtp_content_en';
	$mtp_title 	 = 'mtp_title_en';
	$mcl_content = 'mc_content_en';
	$dm_name 	 = 'dm_content_en';
	$ms_body 	 = 'ms_body_en';
	$ms_punch 	 = 'ms_punch_en';
	$mm_alt 	 = 'mm_alt_en';
	$ms_role 	 = 'ms_role_en';
	if(isset($lang) && $lang == 'id') {
		$mtp_caption = 'mtp_caption_id';
		$mtp_content = 'mtp_content_id';
		$mtp_title 	 = 'mtp_title_id';
		$mcl_content = 'mc_content_id';
		$dm_name 	 = 'dm_content_id';
		$ms_body 	 = 'ms_body_id';
		$ms_punch 	 = 'ms_punch_id';
		$mm_alt 	 = 'mm_alt_id';
		$ms_role 	 = 'ms_role_id';
	}
	//mr_media > parent_id
	if(isset($parent) && !empty($parent)) {
		foreach ($parent as $index => $val) {
			$media[$index]['media_parents_id'] = $parent[$index]['mm_id'];
			$media[$index]['media_parents_alt'] = $parent[$index][$mm_alt];
			$media[$index]['media_parents_initial'] = $parent[$index]['mm_initial'];
			$media[$index]['media_parents_name'] = $parent[$index]['mm_name'];
			$media[$index]['media_parents_parent_id'] = $parent[$index]['mm_parent_id'];
			$media[$index]['media_parents_src'] = $parent[$index]['mm_src'];
			$media[$index]['media_parents_url'] = $parent[$index]['mm_url'];
			$media[$index]['media_parents_create_at'] = dateToEn($parent[$index]['mm_create_at']);
			$media[$index]['media_parents_update_at'] = dateToEn($parent[$index]['mm_update_at']);	
		}
		$content['media_parents'] = $media;
	}
	if(isset($related) && !empty($related)) {
		foreach ($related as $key => $value) {
			//mr_content_management
			$relate[$key]['content_id'] = $related[$key]['mcm_id'];
			$relate[$key]['content_menu_id'] = $related[$key]['mcm_dm_id'];
			$relate[$key]['content_category_id'] = $related[$key]['mcm_mc_id'];
			$relate[$key]['content_media_id'] = $related[$key]['mcm_mm_id'];
			$relate[$key]['content_text_id'] = $related[$key]['mcm_mtp_id'];
			$relate[$key]['content_create_at'] = dateToEn($related[$key]['mcm_create_at']);
			$relate[$key]['content_parent_id'] = $related[$key]['mcm_parent_id'];
			//dyn_menu
			$relate[$key]['menu_id'] = $related[$key]['dm_id'];
			$relate[$key]['menu_name'] = $related[$key][$dm_name];
			$relate[$key]['menu_url'] = $related[$key]['dm_url'];
			$relate[$key]['menu_uri'] = $related[$key]['dm_uri'];
			$relate[$key]['menu_initial'] = $related[$key]['dm_initial'];
			$relate[$key]['menu_keyword'] = $related[$key]['dm_keyword'];
			//mr_categories
			$relate[$key]['category_id'] = $related[$key]['mc_id'];
			$relate[$key]['category_type'] = $related[$key]['mc_type'];
			$relate[$key]['category_name'] = $related[$key][$mcl_content];
			$relate[$key]['category_initial'] = $related[$key]['mc_initial'];
			//mr_text_post
			$relate[$key]['text_id'] = $related[$key]['mtp_id'];
			$related[$key]['text_initial'] = $related[$key]['mtp_initial'];
			$relate[$key]['text_keyword'] = $related[$key]['mtp_keyword'];
			$relate[$key]['text_title'] = $related[$key][$mtp_title];
			$relate[$key]['text_tags'] = $related[$key]['mtp_tags'];
			$relate[$key]['text_url'] = $related[$key]['mtp_url'];
			$relate[$key]['text_create_at'] = dateToEn($related[$key]['mtp_create_at']);
			$relate[$key]['text_update_at'] = dateToEn($related[$key]['mtp_update_at']);
			//mr_media
			$relate[$key]['media_id'] = $related[$key]['mm_id'];
			$relate[$key]['media_alt'] = $related[$key][$mm_alt];
			$relate[$key]['media_initial'] = $related[$key]['mm_initial'];
			$relate[$key]['media_name'] = $related[$key]['mm_name'];
			$relate[$key]['media_src'] = $related[$key]['mm_src'];		
			$relate[$key]['media_url'] = $related[$key]['mm_url'];
		}
		$content['related_contents'] = $relate;
	}
	if(isset($data) && !empty($data) && $for == 'join|dm_menu|mr_text_posts|mr_media' && $object == 'first'){
			//mr_content_management
			$content['content_id'] = $data['mcm_id'];
			$content['content_menu_id'] = $data['mcm_dm_id'];
			$content['content_category_id'] = $data['mcm_mc_id'];
			$content['content_media_id'] = $data['mcm_mm_id'];
			$content['content_text_id'] = $data['mcm_mtp_id'];
			$content['content_create_at'] = dateToEn($data['mcm_create_at']);
			$content['content_parent_id'] = $data['mcm_parent_id'];
			//dyn_menu
			$content['menu_id'] = $data['dm_id'];
			$content['menu_name']	= $data[$dm_name];
			$content['menu_caption'] = $data['dm_initial'];
			$content['menu_keyword'] = $data['dm_keyword'];
			$content['menu_url'] = $data['dm_url'];
			$content['menu_uri'] = $data['dm_uri'];
			//mr_text_post
			$content['text_id'] = $data['mtp_id'];
			$content['text_initial'] = $data['mtp_initial'];
			$content['text_keyword'] = $data['mtp_keyword'];
			$content['text_title'] = $data[$mtp_title];
			$content['text_caption'] = nl2br(e($data[$mtp_caption]));
			$content['text_content'] = nl2br(e($data[$mtp_content]));
			$content['text_parent_id'] = $data['mtp_parent_id'];
			$content['text_tags'] = $data['mtp_tags'];
			$content['text_url'] = $data['mtp_url'];
			$content['text_create_at'] = dateToEn($data['mtp_create_at']);
			$content['text_update_at'] = dateToEn($data['mtp_update_at']);
			//mr_media
			$content['media_id'] = $data['mm_id'];
			$content['media_alt'] = $data[$mm_alt];
			$content['media_initial'] = $data['mm_initial'];
			$content['media_name'] = $data['mm_name'];
			$content['media_parent_id'] = $data['mm_parent_id'];
			$content['media_src'] = $data['mm_src'];
			$content['media_url'] = $data['mm_url'];
			$content['media_create_at'] = dateToEn($data['mm_create_at']);
			$content['media_update_at'] = dateToEn($data['mm_update_at']);	

	}else if(isset($data) && !empty($data) && $for == 'join|dm_menu|mr_text_posts|mr_media|mr_categories' && $object == 'first'){
			//mr_content_management
			$content['content_id'] = $data['mcm_id'];
			$content['content_menu_id'] = $data['mcm_dm_id'];
			$content['content_category_id'] = $data['mcm_mc_id'];
			$content['content_media_id'] = $data['mcm_mm_id'];
			$content['content_text_id'] = $data['mcm_mtp_id'];
			$content['content_create_at'] = dateToEn($data['mcm_create_at']);
			$content['content_parent_id'] = $data['mcm_parent_id'];
			//dyn_menu
			$content['menu_id'] = $data['dm_id'];
			$content['menu_name']	= $data[$dm_name];
			$content['menu_caption'] = $data['dm_initial'];
			$content['menu_keyword'] = $data['dm_keyword'];
			$content['menu_url'] = $data['dm_url'];
			$content['menu_uri'] = $data['dm_uri'];
			//mr_categories
			$content['category_id'] = $data['mc_id'];
			$content['category_menu_id'] = $data['mc_dm_id'];
			$content['category_type'] = $data['mc_type'];
			$content['category_name'] = $data[$mcl_content];
			$content['category_initial'] = $data['mc_initial'];	
			//mr_text_post
			$content['text_id'] = $data['mtp_id'];
			$content['text_initial'] = $data['mtp_initial'];
			$content['text_keyword'] = $data['mtp_keyword'];
			$content['text_title'] = $data[$mtp_title];
			$content['text_caption'] = nl2br(e($data[$mtp_caption]));
			$content['text_content'] = nl2br(e($data[$mtp_content]));
			$content['text_parent_id'] = $data['mtp_parent_id'];
			$content['text_tags'] = $data['mtp_tags'];
			$content['text_url'] = $data['mtp_url'];
			$content['text_create_at'] = dateToEn($data['mtp_create_at']);
			$content['text_update_at'] = dateToEn($data['mtp_update_at']);
			//mr_media
			$content['media_id'] = $data['mm_id'];
			$content['media_alt'] = $data[$mm_alt];
			$content['media_initial'] = $data['mm_initial'];
			$content['media_name'] = $data['mm_name'];
			$content['media_parent_id'] = $data['mm_parent_id'];
			$content['media_src'] = $data['mm_src'];
			$content['media_url'] = $data['mm_url'];
			$content['media_create_at'] = dateToEn($data['mm_create_at']);
			$content['media_update_at'] = dateToEn($data['mm_update_at']);
				
	}else if(isset($data) && !empty($data) && $for == 'join|dm_menu|mr_text_posts|mr_media|mr_categories|mr_templates' && $object == 'first'){
			//mr_templates
			$content['template_id'] = $data['mt_id'];
			$content['template_keyword'] = $data['mt_keyword'];
			$content['template_initial'] = $data['mt_initial'];
			//mr_content_management
			$content['content_id'] = $data['mcm_id'];
			$content['content_menu_id'] = $data['mcm_dm_id'];
			$content['content_category_id'] = $data['mcm_mc_id'];
			$content['content_media_id'] = $data['mcm_mm_id'];
			$content['content_text_id'] = $data['mcm_mtp_id'];
			$content['content_create_at'] = dateToEn($data['mcm_create_at']);
			$content['content_parent_id'] = $data['mcm_parent_id'];
			//dyn_menu
			$content['menu_id'] = $data['dm_id'];
			$content['menu_name']	= $data[$dm_name];
			$content['menu_caption'] = $data['dm_initial'];
			$content['menu_keyword'] = $data['dm_keyword'];
			$content['menu_url'] = $data['dm_url'];
			$content['menu_uri'] = $data['dm_uri'];
			//mr_categories
			$content['category_id'] = $data['mc_id'];
			$content['category_menu_id'] = $data['mc_dm_id'];
			$content['category_type'] = $data['mc_type'];
			$content['category_name'] = $data[$mcl_content];
			$content['category_initial'] = $data['mc_initial'];	
			//mr_text_post
			$content['text_id'] = $data['mtp_id'];
			$content['text_initial'] = $data['mtp_initial'];
			$content['text_keyword'] = $data['mtp_keyword'];
			$content['text_title'] = $data[$mtp_title];
			$content['text_caption'] = nl2br(e($data[$mtp_caption]));
			$content['text_content'] = nl2br(e($data[$mtp_content]));
			$content['text_parent_id'] = $data['mtp_parent_id'];
			$content['text_tags'] = $data['mtp_tags'];
			$content['text_url'] = $data['mtp_url'];
			$content['text_create_at'] = dateToEn($data['mtp_create_at']);
			$content['text_update_at'] = dateToEn($data['mtp_update_at']);
			//mr_media
			$content['media_id'] = $data['mm_id'];
			$content['media_alt'] = $data[$mm_alt];
			$content['media_initial'] = $data['mm_initial'];
			$content['media_name'] = $data['mm_name'];
			$content['media_parent_id'] = $data['mm_parent_id'];
			$content['media_src'] = $data['mm_src'];
			$content['media_url'] = $data['mm_url'];
			$content['media_create_at'] = dateToEn($data['mm_create_at']);
			$content['media_update_at'] = dateToEn($data['mm_update_at']);
				
	}else if(isset($data) && !empty($data) && $for == 'join|dm_menu|mr_text_posts|mr_media|mr_categories|mr_templates|mr_stats' && $object == 'first'){
			//mr_stats
			$content['statistic_id'] 	= $data['ms_id'];
			$content['statistic_keyword'] = $data['ms_keyword'];
			$content['statistic_formula'] = $data['ms_formula'];
			$content['statistic_results'] = $data['ms_results'];
			$content['statistic_formula'] = $data['ms_formula'];
			$content['statistic_punch_text'] = $data[$ms_punch];
			$content['statistic_body_text'] = nl2br(e($data[$ms_body]));
			$content['statistic_role'] = $data[$ms_role];
			$content['statistic_product'] = $data['ms_product'];
			if(isset($lang) && $lang == 'id') {
				$content['statistic_start_project']  = dateToId($data['ms_start_date']);
				$content['statistic_finish_project'] = dateToId($data['ms_finish_date']);
			}else {
				$content['statistic_start_project']  = dateToEn($data['ms_start_date']);
				$content['statistic_finish_project'] = dateToEn($data['ms_finish_date']);
			}
			//mr_templates
			$content['template_id'] = $data['mt_id'];
			$content['template_keyword'] = $data['mt_keyword'];
			$content['template_initial'] = $data['mt_initial'];
			//mr_content_management
			$content['content_id'] = $data['mcm_id'];
			$content['content_menu_id'] = $data['mcm_dm_id'];
			$content['content_category_id'] = $data['mcm_mc_id'];
			$content['content_media_id'] = $data['mcm_mm_id'];
			$content['content_text_id'] = $data['mcm_mtp_id'];
			$content['content_create_at'] = dateToEn($data['mcm_create_at']);
			$content['content_parent_id'] = $data['mcm_parent_id'];
			//dyn_menu
			$content['menu_id'] = $data['dm_id'];
			$content['menu_name']	= $data[$dm_name];
			$content['menu_caption'] = $data['dm_initial'];
			$content['menu_keyword'] = $data['dm_keyword'];
			$content['menu_url'] = $data['dm_url'];
			$content['menu_uri'] = $data['dm_uri'];
			//mr_categories
			$content['category_id'] = $data['mc_id'];
			$content['category_menu_id'] = $data['mc_dm_id'];
			$content['category_type'] = $data['mc_type'];
			$content['category_name'] = $data[$mcl_content];
			$content['category_initial'] = $data['mc_initial'];	
			//mr_text_post
			$content['text_id'] = $data['mtp_id'];
			$content['text_initial'] = $data['mtp_initial'];
			$content['text_keyword'] = $data['mtp_keyword'];
			$content['text_title'] = $data[$mtp_title];
			$content['text_caption'] = nl2br(e($data[$mtp_caption]));
			$content['text_content'] = nl2br(e($data[$mtp_content]));
			$content['text_parent_id'] = $data['mtp_parent_id'];
			$content['text_tags'] = $data['mtp_tags'];
			$content['text_url'] = $data['mtp_url'];
			$content['text_create_at'] = dateToEn($data['mtp_create_at']);
			$content['text_update_at'] = dateToEn($data['mtp_update_at']);
			//mr_media
			$content['media_id'] = $data['mm_id'];
			$content['media_alt'] = $data[$mm_alt];
			$content['media_initial'] = $data['mm_initial'];
			$content['media_name'] = $data['mm_name'];
			$content['media_parent_id'] = $data['mm_parent_id'];
			$content['media_src'] = $data['mm_src'];
			$content['media_url'] = $data['mm_url'];
			$content['media_create_at'] = dateToEn($data['mm_create_at']);
			$content['media_update_at'] = dateToEn($data['mm_update_at']);
				
	}else if(isset($data) && !empty($data) && $for == 'merge|join|dm_menu|mr_text_posts|mr_media|mr_categories' && $object == 'get'){
		foreach ($data as $key => $value) {
			//portfolio
			if(isset($data[$key]['mcm_dm_id']) && $data[$key]['mcm_dm_id'] === 55103) {
				//mr_content_management
				$portfolio[$key]['content_id'] = $data[$key]['mcm_id'];
				$portfolio[$key]['content_menu_id'] = $data[$key]['mcm_dm_id'];
				$portfolio[$key]['content_category_id'] = $data[$key]['mcm_mc_id'];
				$portfolio[$key]['content_media_id'] = $data[$key]['mcm_mm_id'];
				$portfolio[$key]['content_text_id'] = $data[$key]['mcm_mtp_id'];
				$portfolio[$key]['content_create_at'] = dateToEn($data[$key]['mcm_create_at']);
				$portfolio[$key]['content_parent_id'] = $data[$key]['mcm_parent_id'];
				//dyn_menu
				$portfolio[$key]['menu_id'] = $data[$key]['dm_id'];
				$portfolio[$key]['menu_name'] = $data[$key][$dm_name];
				$portfolio[$key]['menu_url'] = $data[$key]['dm_url'];
				$portfolio[$key]['menu_uri'] = $data[$key]['dm_uri'];
				$portfolio[$key]['menu_initial'] = $data[$key]['dm_initial'];
				$portfolio[$key]['menu_keyword'] = $data[$key]['dm_keyword'];
				//mr_categories
				$portfolio[$key]['category_id'] = $data[$key]['mc_id'];
				$portfolio[$key]['category_menu_id'] = $data[$key]['mc_dm_id'];
				$portfolio[$key]['category_type'] = $data[$key]['mc_type'];
				$portfolio[$key]['category_name'] = $data[$key][$mcl_content];
				$portfolio[$key]['category_initial'] = $data[$key]['mc_initial'];
				//mr_text_post
				$portfolio[$key]['text_id'] = $data[$key]['mtp_id'];
				$portfolio[$key]['text_initial'] = $data[$key]['mtp_initial'];
				$portfolio[$key]['text_keyword'] = $data[$key]['mtp_keyword'];
				$portfolio[$key]['text_title'] = $data[$key][$mtp_title];
				$portfolio[$key]['text_caption'] = nl2br(e($data[$key][$mtp_caption]));
				$portfolio[$key]['text_content'] = nl2br(e($data[$key][$mtp_content]));
				$portfolio[$key]['text_parent_id'] = $data[$key]['mtp_parent_id'];
				$portfolio[$key]['text_tags'] = $data[$key]['mtp_tags'];
				$portfolio[$key]['text_url'] = $data[$key]['mtp_url'];
				$portfolio[$key]['text_create_at'] = dateToEn($data[$key]['mtp_create_at']);
				$portfolio[$key]['text_update_at'] = dateToEn($data[$key]['mtp_update_at']);
				//mr_media
				$portfolio[$key]['media_id'] = $data[$key]['mm_id'];
				$portfolio[$key]['media_alt'] = $data[$key][$mm_alt];
				$portfolio[$key]['media_initial'] = $data[$key]['mm_initial'];
				$portfolio[$key]['media_name'] = $data[$key]['mm_name'];
				$portfolio[$key]['media_parent_id'] = $data[$key]['mm_parent_id'];
				$portfolio[$key]['media_src'] = $data[$key]['mm_src'];		
				$portfolio[$key]['media_url'] = $data[$key]['mm_url'];
				$portfolio[$key]['media_create_at'] = dateToEn($data[$key]['mm_create_at']);
				$portfolio[$key]['media_update_at'] = dateToEn($data[$key]['mm_update_at']);	
			}
		}
		//add name dm_name base on data content management
		$content = [ 'portfolio' => $portfolio ];
	
	}else if(isset($data) && !empty($data) && $for == 'join|dm_menu|mr_text_posts|mr_media|mr_categories' && $object == 'get'){
		foreach ($data as $key => $value) {
			//mr_content_management
			$content[$key]['content_id'] = $data[$key]['mcm_id'];
			$content[$key]['content_menu_id'] = $data[$key]['mcm_dm_id'];
			$content[$key]['content_category_id'] = $data[$key]['mcm_mc_id'];
			$content[$key]['content_media_id'] = $data[$key]['mcm_mm_id'];
			$content[$key]['content_text_id'] = $data[$key]['mcm_mtp_id'];
			$content[$key]['content_create_at'] = dateToEn($data[$key]['mcm_create_at']);
			$content[$key]['content_parent_id'] = $data[$key]['mcm_parent_id'];
			//dyn_menu
			$content[$key]['menu_id'] = $data[$key]['dm_id'];
			$content[$key]['menu_name'] = $data[$key][$dm_name];
			$content[$key]['menu_url'] = $data[$key]['dm_url'];
			$content[$key]['menu_uri'] = $data[$key]['dm_uri'];
			$content[$key]['menu_initial'] = $data[$key]['dm_initial'];
			$content[$key]['menu_keyword'] = $data[$key]['dm_keyword'];
			//mr_categories
			$content[$key]['category_id'] = $data[$key]['mc_id'];
			$content[$key]['category_menu_id'] = $data[$key]['mc_dm_id'];
			$content[$key]['category_type'] = $data[$key]['mc_type'];
			$content[$key]['category_name'] = $data[$key][$mcl_content];
			$content[$key]['category_initial'] = $data[$key]['mc_initial'];
			//mr_text_post
			$content[$key]['text_id'] = $data[$key]['mtp_id'];
			$content[$key]['text_initial'] = $data[$key]['mtp_initial'];
			$content[$key]['text_keyword'] = $data[$key]['mtp_keyword'];
			$content[$key]['text_title'] = $data[$key][$mtp_title];
			$content[$key]['text_caption'] = nl2br(e($data[$key][$mtp_caption]));
			$content[$key]['text_content'] = nl2br(e($data[$key][$mtp_content]));
			$content[$key]['text_parent_id'] = $data[$key]['mtp_parent_id'];
			$content[$key]['text_tags'] = $data[$key]['mtp_tags'];
			$content[$key]['text_url'] = $data[$key]['mtp_url'];
			$content[$key]['text_create_at'] = dateToEn($data[$key]['mtp_create_at']);
			$content[$key]['text_update_at'] = dateToEn($data[$key]['mtp_update_at']);
			//mr_media
			$content[$key]['media_id'] = $data[$key]['mm_id'];
			$content[$key]['media_alt'] = $data[$key][$mm_alt];
			$content[$key]['media_initial'] = $data[$key]['mm_initial'];
			$content[$key]['media_name'] = $data[$key]['mm_name'];
			$content[$key]['media_parent_id'] = $data[$key]['mm_parent_id'];
			$content[$key]['media_src'] = $data[$key]['mm_src'];		
			$content[$key]['media_url'] = $data[$key]['mm_url'];
			$content[$key]['media_create_at'] = dateToEn($data[$key]['mm_create_at']);
			$content[$key]['media_update_at'] = dateToEn($data[$key]['mm_update_at']);	
		}
	}else if(isset($data) && !empty($data) && $for == 'join|dm_menu|mr_text_posts|mr_media|mr_categories|mr_templates' && $object == 'get'){
		foreach ($data as $key => $value) {
			//mr_templates
			$content[$key]['template_id'] = $data[$key]['mt_id'];
			$content[$key]['template_keyword'] = $data[$key]['mt_keyword'];
			$content[$key]['template_initial'] = $data[$key]['mt_initial'];
			//mr_content_management
			$content[$key]['content_id'] = $data[$key]['mcm_id'];
			$content[$key]['content_menu_id'] = $data[$key]['mcm_dm_id'];
			$content[$key]['content_category_id'] = $data[$key]['mcm_mc_id'];
			$content[$key]['content_media_id'] = $data[$key]['mcm_mm_id'];
			$content[$key]['content_text_id'] = $data[$key]['mcm_mtp_id'];
			$content[$key]['content_create_at'] = dateToEn($data[$key]['mcm_create_at']);
			$content[$key]['content_parent_id'] = $data[$key]['mcm_parent_id'];
			//dyn_menu
			$content[$key]['menu_id'] = $data[$key]['dm_id'];
			$content[$key]['menu_name'] = $data[$key][$dm_name];
			$content[$key]['menu_url'] = $data[$key]['dm_url'];
			$content[$key]['menu_uri'] = $data[$key]['dm_uri'];
			$content[$key]['menu_initial'] = $data[$key]['dm_initial'];
			$content[$key]['menu_keyword'] = $data[$key]['dm_keyword'];
			//mr_categories
			$content[$key]['category_id'] = $data[$key]['mc_id'];
			$content[$key]['category_menu_id'] = $data[$key]['mc_dm_id'];
			$content[$key]['category_type'] = $data[$key]['mc_type'];
			$content[$key]['category_name'] = $data[$key][$mcl_content];
			$content[$key]['category_initial'] = $data[$key]['mc_initial'];
			//mr_text_post
			$content[$key]['text_id'] = $data[$key]['mtp_id'];
			$content[$key]['text_initial'] = $data[$key]['mtp_initial'];
			$content[$key]['text_keyword'] = $data[$key]['mtp_keyword'];
			$content[$key]['text_title'] = $data[$key][$mtp_title];
			$content[$key]['text_caption'] = nl2br(e($data[$key][$mtp_caption]));
			$content[$key]['text_content'] = nl2br(e($data[$key][$mtp_content]));
			$content[$key]['text_parent_id'] = $data[$key]['mtp_parent_id'];
			$content[$key]['text_tags'] = $data[$key]['mtp_tags'];
			$content[$key]['text_url'] = $data[$key]['mtp_url'];
			$content[$key]['text_create_at'] = dateToEn($data[$key]['mtp_create_at']);
			$content[$key]['text_update_at'] = dateToEn($data[$key]['mtp_update_at']);
			//mr_media
			$content[$key]['media_id'] = $data[$key]['mm_id'];
			$content[$key]['media_alt'] = $data[$key][$mm_alt];
			$content[$key]['media_initial'] = $data[$key]['mm_initial'];
			$content[$key]['media_name'] = $data[$key]['mm_name'];
			$content[$key]['media_parent_id'] = $data[$key]['mm_parent_id'];
			$content[$key]['media_src'] = $data[$key]['mm_src'];		
			$content[$key]['media_url'] = $data[$key]['mm_url'];
			$content[$key]['media_create_at'] = dateToEn($data[$key]['mm_create_at']);
			$content[$key]['media_update_at'] = dateToEn($data[$key]['mm_update_at']);	
		}
	}else if(isset($data) && !empty($data) && $for == 'join|dm_menu|mr_text_posts|mr_media|mr_categories|mr_templates|mr_stats' && $object == 'get'){
		foreach ($data as $key => $value) {
			//mr_stats
			$content[$key]['statistic_id'] = $data[$key]['ms_id'];
			$content[$key]['statistic_keyword'] = $data[$key]['ms_keyword'];
			$content[$key]['statistic_formula'] = $data[$key]['ms_formula'];
			$content[$key]['statistic_results'] = $data[$key]['ms_results'];
			$content[$key]['statistic_formula'] = $data[$key]['ms_formula'];
			$content[$key]['statistic_punch_text'] = $data[$key][$ms_punch];
			$content[$key]['statistic_body_text'] = nl2br(e($data[$key][$ms_body]));
			$content[$key]['statistic_role'] = $data[$key][$ms_role];
			$content[$key]['statistic_product'] = $data[$key]['ms_product'];
			if(isset($lang) && $lang == 'id') {
				$content[$key]['statistic_start_project']  = dateToId($data[$key]['ms_start_date']);
				$content[$key]['statistic_finish_project'] = dateToId($data[$key]['ms_finish_date']);
			}else {
				$content[$key]['statistic_start_project']  = dateToEn($data[$key]['ms_start_date']);
				$content[$key]['statistic_finish_project'] = dateToEn($data[$key]['ms_finish_date']);
			}
			//mr_templates
			$content[$key]['template_id'] = $data[$key]['mt_id'];
			$content[$key]['template_keyword'] = $data[$key]['mt_keyword'];
			$content[$key]['template_initial'] = $data[$key]['mt_initial'];
			//mr_content_management
			$content[$key]['content_id'] = $data[$key]['mcm_id'];
			$content[$key]['content_menu_id'] = $data[$key]['mcm_dm_id'];
			$content[$key]['content_category_id'] = $data[$key]['mcm_mc_id'];
			$content[$key]['content_media_id'] = $data[$key]['mcm_mm_id'];
			$content[$key]['content_text_id'] = $data[$key]['mcm_mtp_id'];
			$content[$key]['content_create_at'] = dateToEn($data[$key]['mcm_create_at']);
			$content[$key]['content_parent_id'] = $data[$key]['mcm_parent_id'];
			//dyn_menu
			$content[$key]['menu_id'] = $data[$key]['dm_id'];
			$content[$key]['menu_name'] = $data[$key][$dm_name];
			$content[$key]['menu_url'] = $data[$key]['dm_url'];
			$content[$key]['menu_uri'] = $data[$key]['dm_uri'];
			$content[$key]['menu_initial'] = $data[$key]['dm_initial'];
			$content[$key]['menu_keyword'] = $data[$key]['dm_keyword'];
			//mr_categories
			$content[$key]['category_id'] = $data[$key]['mc_id'];
			$content[$key]['category_menu_id'] = $data[$key]['mc_dm_id'];
			$content[$key]['category_type'] = $data[$key]['mc_type'];
			$content[$key]['category_name'] = $data[$key][$mcl_content];
			$content[$key]['category_initial'] = $data[$key]['mc_initial'];
			//mr_text_post
			$content[$key]['text_id'] = $data[$key]['mtp_id'];
			$content[$key]['text_initial'] = $data[$key]['mtp_initial'];
			$content[$key]['text_keyword'] = $data[$key]['mtp_keyword'];
			$content[$key]['text_title'] = $data[$key][$mtp_title];
			$content[$key]['text_caption'] = nl2br(e($data[$key][$mtp_caption]));
			$content[$key]['text_content'] = nl2br(e($data[$key][$mtp_content]));
			$content[$key]['text_parent_id'] = $data[$key]['mtp_parent_id'];
			$content[$key]['text_tags'] = $data[$key]['mtp_tags'];
			$content[$key]['text_url'] = $data[$key]['mtp_url'];
			$content[$key]['text_create_at'] = dateToEn($data[$key]['mtp_create_at']);
			$content[$key]['text_update_at'] = dateToEn($data[$key]['mtp_update_at']);
			//mr_media
			$content[$key]['media_id'] = $data[$key]['mm_id'];
			$content[$key]['media_alt'] = $data[$key][$mm_alt];
			$content[$key]['media_initial'] = $data[$key]['mm_initial'];
			$content[$key]['media_name'] = $data[$key]['mm_name'];
			$content[$key]['media_parent_id'] = $data[$key]['mm_parent_id'];
			$content[$key]['media_src'] = $data[$key]['mm_src'];		
			$content[$key]['media_url'] = $data[$key]['mm_url'];
			$content[$key]['media_create_at'] = dateToEn($data[$key]['mm_create_at']);
			$content[$key]['media_update_at'] = dateToEn($data[$key]['mm_update_at']);	
		}
	}else if(isset($data) && !empty($data) && $for == 'join|dm_menu|mr_text_posts|mr_media' && $object == 'get'){
		foreach ($data as $key => $value) {
			//mr_content_management
			$content[$key]['content_id'] = $data[$key]['mcm_id'];
			$content[$key]['content_menu_id'] = $data[$key]['mcm_dm_id'];
			$content[$key]['content_category_id'] = $data[$key]['mcm_mc_id'];
			$content[$key]['content_media_id'] = $data[$key]['mcm_mm_id'];
			$content[$key]['content_text_id'] = $data[$key]['mcm_mtp_id'];
			$content[$key]['content_create_at'] = dateToEn($data[$key]['mcm_create_at']);
			$content[$key]['content_parent_id'] = $data[$key]['mcm_parent_id'];
			//dyn_menu
			$content[$key]['menu_id'] = $data[$key]['dm_id'];
			$content[$key]['menu_name'] = $data[$key][$dm_name];
			$content[$key]['menu_url'] = $data[$key]['dm_url'];
			$content[$key]['menu_uri'] = $data[$key]['dm_uri'];
			$content[$key]['menu_initial'] = $data[$key]['dm_initial'];
			$content[$key]['menu_keyword'] = $data[$key]['dm_keyword'];
			//mr_text_post
			$content[$key]['text_id'] = $data[$key]['mtp_id'];
			$content[$key]['text_initial'] = $data[$key]['mtp_initial'];
			$content[$key]['text_keyword'] = $data[$key]['mtp_keyword'];
			$content[$key]['text_title'] = $data[$key][$mtp_title];
			$content[$key]['text_caption'] = nl2br(e($data[$key][$mtp_caption]));
			$content[$key]['text_content'] = nl2br(e($data[$key][$mtp_content]));
			$content[$key]['text_parent_id'] = $data[$key]['mtp_parent_id'];
			$content[$key]['text_tags'] = $data[$key]['mtp_tags'];
			$content[$key]['text_url'] = $data[$key]['mtp_url'];
			$content[$key]['text_create_at'] = dateToEn($data[$key]['mtp_create_at']);
			$content[$key]['text_update_at'] = dateToEn($data[$key]['mtp_update_at']);
			//mr_media
			$content[$key]['media_id'] = $data[$key]['mm_id'];
			$content[$key]['media_alt'] = $data[$key][$mm_alt];
			$content[$key]['media_initial'] = $data[$key]['mm_initial'];
			$content[$key]['media_name'] = $data[$key]['mm_name'];
			$content[$key]['media_parent_id'] = $data[$key]['mm_parent_id'];
			$content[$key]['media_src'] = $data[$key]['mm_src'];	
			$content[$key]['media_url'] = $data[$key]['mm_url'];
			$content[$key]['media_create_at'] = dateToEn($data[$key]['mm_create_at']);
			$content[$key]['media_update_at'] = dateToEn($data[$key]['mm_update_at']);			
		}
	}else if(isset($data) && !empty($data) && $for == 'join|dm_menu' && $object == 'get'){
		foreach ($data as $key => $value) {
			//mr_content_management
			$content[$key]['content_id'] = $data[$key]['mcm_id'];
			$content[$key]['content_menu_id'] = $data[$key]['mcm_dm_id'];
			$content[$key]['content_category_id'] = $data[$key]['mcm_mc_id'];
			$content[$key]['content_media_id'] = $data[$key]['mcm_mm_id'];
			$content[$key]['content_text_id'] = $data[$key]['mcm_mtp_id'];
			$content[$key]['content_create_at'] = dateToEn($data[$key]['mcm_create_at']);
			$content[$key]['content_parent_id'] = $data[$key]['mcm_parent_id'];
			//dyn_menu
			$content[$key]['menu_id'] = $data[$key]['dm_id'];
			$content[$key]['menu_name'] = $data[$key][$dm_name];
			$content[$key]['menu_url'] = $data[$key]['dm_url'];
			$content[$key]['menu_uri'] = $data[$key]['dm_uri'];
			$content[$key]['menu_initial'] = $data[$key]['dm_initial'];
			$content[$key]['menu_keyword'] = $data[$key]['dm_keyword'];
		}
	}else if(isset($data) && !empty($data) && $object == 'get'){
		foreach ($data as $key => $value) {
			//mr_content_management
			$content[$key]['content_id'] = $data[$key]['mcm_id'];
			$content[$key]['content_menu_id'] = $data[$key]['mcm_dm_id'];
			$content[$key]['content_category_id'] = $data[$key]['mcm_mc_id'];
			$content[$key]['content_media_id'] = $data[$key]['mcm_mm_id'];
			$content[$key]['content_text_id'] = $data[$key]['mcm_mtp_id'];
			$content[$key]['content_create_at'] = dateToEn($data[$key]['mcm_create_at']);
			$content[$key]['content_parent_id'] = $data[$key]['mcm_parent_id'];
		}
	}else if(isset($data) && !empty($data)){
		$content['content_id'] = $data['mcm_id'];
		$content['content_menu_id'] = $data['mcm_dm_id'];
		$content['content_category_id'] = $data['mcm_mc_id'];
		$content['content_media_id'] = $data['mcm_mm_id'];
		$content['content_text_id'] = $data['mcm_mtp_id'];
		$content['content_create_at'] = dateToEn($data['mcm_create_at']);
		$content['content_parent_id'] = $data['mcm_parent_id'];
	}else {
			//mr_stats
			$content['statistic_id'] = '';
			$content['statistic_keyword'] = '';
			$content['statistic_formula'] = '';
			$content['statistic_results'] = '';
			$content['statistic_formula'] = '';
			$content['statistic_punch_text'] = '';
			$content['statistic_body_text'] = '';
			$content['statistic_role'] = '';
			$content['statistic_product'] = '';
			$content['statistic_start_project'] = '';
			$content['statistic_finish_project'] = '';
			//mr_templates
			$content['template_id'] = '';
			$content['template_keyword'] = '';
			$content['template_initial'] = '';
			//mr_content_management
			$content['content_id'] = '';
			$content['content_menu_id'] = '';
			$content['content_category_id'] = '';
			$content['content_media_id'] = '';
			$content['content_text_id'] = '';
			$content['content_create_at'] = '';
			$content['content_parent_id'] = '';
			//dyn_menu
			$content['menu_id'] = '';
			$content['menu_name'] = '';
			$content['menu_url'] = '';
			$content['menu_uri'] = '';
			$content['menu_initial'] = '';
			$content['menu_keyword'] = '';
			//mr_categories
			$content['category_id'] = '';
			$content['category_menu_id'] = '';
			$content['category_type'] = '';
			$content['category_name'] = '';
			$content['category_initial'] = '';
			//mr_text_post
			$content['text_id'] = '';
			$content['text_initial'] = '';
			$content['text_keyword'] = '';
			$content['text_title'] = '';
			$content['text_caption'] = '';
			$content['text_content'] = '';
			$content['text_parent_id'] = '';
			$content['text_media_id'] = '';
			$content['text_tags'] = '';
			$content['text_url'] = '';
			$content['text_create_at'] = '';
			$content['text_update_at'] = '';
			//mr_media
			$content['media_id'] = '';
			$content['media_alt'] = '';
			$content['media_initial'] = '';
			$content['media_name'] = '';
			$content['media_parent_id'] = '';
			$content['media_src'] = '';	
			$content['media_url'] = '';
			$content['media_create_at'] = '';
			$content['media_update_at'] = '';

			$content['media_parents'] = '';
			$content['media_parents_id'] = '';
			$content['media_parents_alt'] = '';
			$content['media_parents_initial'] = '';
			$content['media_parents_name'] = '';
			$content['media_parents_parent_id'] = '';
			$content['media_parents_src'] = '';
			$content['media_parents_url'] = '';
			$content['media_parents_create_at'] = '';
			$content['media_parents_update_at'] = '';

			$content['related_contents'] = '';
	}
	return $content;
}