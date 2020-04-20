<?php
function strip_zeros_from_date($maked_string="") {
	// first remove the marked zeros
	$no_zeros = str_replace('*0','', $maked_string);
	// then remove any remaining marks
	$cleaned_string = str_replace('*','', $no_zeros);
	return $cleaned_string;	
}

function redirect_to( $location = NULL) {
	if($location != NULL) {
		header("Location: {$location}");
		exit;	
	}
}

function output_message($message="") {
	if(!empty($message)) {
		return "<p class=\"message\">{$message}</p>";	
	} else {
		return "";	
	}
}

function __autoload($class_name) {
	$class_name = strtolower($class_name);
	$path = "LIB_PATH.DS.{$class_name}.php";
	if(file_exists($path)) {
		require_once($path);
	} else {
		die("The file {$class_name}.php could not be found.");	
	}
		
}

function log_action($action, $message="") {
	$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
	$new = file_exists($logfile) ? false : true;
	if($handle = fopen($logfile, 'a')) { // append
		$timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$content = "{$timestamp} | {$action}: {$message} \n";
		fwrite($handle, $content);
		fclose($handle);
		if($new) { chmod($logile, 0755); }
	} else {
		echo "Could not open log file for writing.";
	}
}

function datetime_to_text($datetime="") {
	$unixdatetime = strtotime($datetime);
	return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);	
}

function get_page_name() {
	return basename($_SERVER['PHP_SELF']);	
}

function current_url() {
    $url      = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $validURL = str_replace("&", "&amp", $url);
    return $validURL;
}

function breadcrumb() {  
    $page_name = get_page_name();
	$output = '';    
		if($page_name == 'index.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>';
    $output .= '</li>';
    } else if($page_name == 'new_user.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>';
    $output .= '<a href="new_user.php">Users</a>';
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>New User</li>';
    } else if($page_name == 'user_list.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>';
    $output .= '<a href="new_user.php">Users</a>';
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>User List</li>';
    } else if($page_name == 'user_category.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>';
    $output .= '<a href="new_user.php">Users</a>';
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>User Category</li>';
    } else if($page_name == 'product_category.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>';
    $output .= '<a href="product.php">Product</a>';
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>Product Category</li>';
    } else if($page_name == 'product_sub_category.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>';
    $output .= '<a href="product.php">Product</a>';
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>Product Sub-Category</li>';
    } else if($page_name == 'brand.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>';
    $output .= '<a href="product.php">Product</a>';
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>Product Brand</li>';
    } else if($page_name == 'product.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li> Product </li>';
    } else if($page_name == 'product_list.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>';
    $output .= '<a href="product.php">Product</a>';
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>Products List</li>';
    } else if($page_name == 'shipping.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>';
    $output .= '<a href="product.php">Product</a>';
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>Product Shipment</li>';
    } else if($page_name == 'order_detail.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>';
    $output .= '<a href="orders.php">Orders</a>';
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>Order Detail</li>';
    } else if($page_name == 'orders.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>Orders';
    $output .= '</i>';
    } else if($page_name == 'customer_list.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>Customers List</li>';
    } else if($page_name == 'user_profile.php') {
    $output  = '<li>';
    $output .= '<i class="icon-home"></i>';
    $output .= '<a href="index.php">Home</a>'; 
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>';
    $output .= '<a href="user_list.php">Users</a>';
    $output .= '<i class="icon-angle-right"></i>';
    $output .= '</li>';
    $output .= '<li>User Profile</li>';
    } else {
		// Something else	
	}
	return $output;
}

// Get IP Address of the client
function getIP() {
	$ip = $_SERVER['REMOTE_ADDR'];
	
	if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];	
	} elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];	
	}
	return $ip;
}

function xml2array($url, $get_attributes = 1, $priority = 'tag')
{
    $contents = "";
    if (!function_exists('xml_parser_create'))
    {
        return array ();
    }
    $parser = xml_parser_create('');
    if (!($fp = @ fopen($url, 'rb')))
    {
        return array ();
    }
    while (!feof($fp))
    {
        $contents .= fread($fp, 8192);
    }
    fclose($fp);
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);
    if (!$xml_values)
        return; //Hmm...
    $xml_array = array ();
    $parents = array ();
    $opened_tags = array ();
    $arr = array ();
    $current = & $xml_array;
    $repeated_tag_index = array (); 
    foreach ($xml_values as $data)
    {
        unset ($attributes, $value);
        extract($data);
        $result = array ();
        $attributes_data = array ();
        if (isset ($value))
        {
            if ($priority == 'tag')
                $result = $value;
            else
                $result['value'] = $value;
        }
        if (isset ($attributes) and $get_attributes)
        {
            foreach ($attributes as $attr => $val)
            {
                if ($priority == 'tag')
                    $attributes_data[$attr] = $val;
                else
                    $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
            }
        }
        if ($type == "open")
        { 
            $parent[$level -1] = & $current;
            if (!is_array($current) or (!in_array($tag, array_keys($current))))
            {
                $current[$tag] = $result;
                if ($attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                $current = & $current[$tag];
            }
            else
            {
                if (isset ($current[$tag][0]))
                {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    $repeated_tag_index[$tag . '_' . $level]++;
                }
                else
                { 
                    $current[$tag] = array (
                        $current[$tag],
                        $result
                    ); 
                    $repeated_tag_index[$tag . '_' . $level] = 2;
                    if (isset ($current[$tag . '_attr']))
                    {
                        $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                        unset ($current[$tag . '_attr']);
                    }
                }
                $last_item_index = $repeated_tag_index[$tag . '_' . $level] - 1;
                $current = & $current[$tag][$last_item_index];
            }
        }
        elseif ($type == "complete")
        {
            if (!isset ($current[$tag]))
            {
                $current[$tag] = $result;
                $repeated_tag_index[$tag . '_' . $level] = 1;
                if ($priority == 'tag' and $attributes_data)
                    $current[$tag . '_attr'] = $attributes_data;
            }
            else
            {
                if (isset ($current[$tag][0]) and is_array($current[$tag]))
                {
                    $current[$tag][$repeated_tag_index[$tag . '_' . $level]] = $result;
                    if ($priority == 'tag' and $get_attributes and $attributes_data)
                    {
                        $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                    }
                    $repeated_tag_index[$tag . '_' . $level]++;
                }
                else
                {
                    $current[$tag] = array (
                        $current[$tag],
                        $result
                    ); 
                    $repeated_tag_index[$tag . '_' . $level] = 1;
                    if ($priority == 'tag' and $get_attributes)
                    {
                        if (isset ($current[$tag . '_attr']))
                        { 
                            $current[$tag]['0_attr'] = $current[$tag . '_attr'];
                            unset ($current[$tag . '_attr']);
                        }
                        if ($attributes_data)
                        {
                            $current[$tag][$repeated_tag_index[$tag . '_' . $level] . '_attr'] = $attributes_data;
                        }
                    }
                    $repeated_tag_index[$tag . '_' . $level]++; //0 and 1 index is already taken
                }
            }
        }
        elseif ($type == 'close')
        {
            $current = & $parent[$level -1];
        }
    }
    return ($xml_array);
}

// Alert function takes the status and message from the user then checkes it and call the other functions
function alerts($type, $payload) {
    switch($type) {
        case 'success':
            return success_alert($payload);
        break;
        case 'danger':
            return danger_alert($payload);
        break;
        case 'warning':
            return warning_alert($payload);
        break;
        default:
            return '';
    }
}

// return danger alert box when called
function danger_alert($data) {
    return '<div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Oh Snap!</strong> '.$data.'
            </div>';
}

// return success alert box when called
function success_alert($data) {
    return '<div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Well done!</strong> '.$data.'
            </div>';
}

// return warning alert box when called
function warning_alert($data) {
    return '<div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Warning!</strong> '.$data.'
            </div>';
}

?>