<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI =& get_instance();
$CI->load->spark('sk-hashids/1.0.5');

function encrypt_id($id) {
	$id_encrypt = hashids_encrypt($id, 'c4aeb');
	return hexdec(bin2hex($id_encrypt));
}

function decrypt_id($id) {
	$id_decrypt = pack("H*", (string)dechex($id));
    return hashids_decrypt($id_decrypt, 'c4aeb');    
}

?>