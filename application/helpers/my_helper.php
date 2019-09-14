<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class myObject{
    public function __construct(array $arguments = array()) {if (!empty($arguments)) {foreach ($arguments as $property => $argument) {$this->{$property} = $argument;}}}
    public function __call($method, $arguments) {$arguments = array_merge(array("stdObject" => $this), $arguments); /*Note: method argument 0 will always referred to the main class ($this). */if (isset($this->{$method}) && is_callable($this->{$method})) {return call_user_func_array($this->{$method}, $arguments);}else {throw new Exception("Fatal error: Call to undefined method stdObject::{$method}()");}}
}

if ( ! function_exists('clean')){function clean($string = ''){$remove[] = "'";$remove[] = '"';$remove[] = "\\";return str_replace( $remove, "", $string );}}
if ( ! function_exists('set_session')){function set_session($name = '', $value = ''){get_instance()->session->set_userdata($name, $value);}}
if ( ! function_exists('unset_session')){function unset_session($name = ''){get_instance()->session->unset_userdata($name);}}
if ( ! function_exists('get_session')){function get_session($name = ''){return get_instance()->session->userdata($name);}}
if ( ! function_exists('set_flash')){function set_flash($name = '', $value = ''){get_instance()->session->set_flashdata($name, $value);}}
if ( ! function_exists('get_flash')){function get_flash($name = ''){return get_instance()->session->flashdata($name);}}
if ( ! function_exists('get_post')){function get_post($name = ''){return clean(get_instance()->input->post($name));}}
if ( ! function_exists('get_post_text')){function get_post_text($name = ''){return get_instance()->input->post($name);}}
if ( ! function_exists('view')){function view($name = '', $data = []){return get_instance()->load->view($name, $data);}}
if ( ! function_exists('segment')){function segment($number = 1){return get_instance()->uri->segment($number);}}
if ( ! function_exists('set_config_db')){function set_config_db($dbname){return array('dsn' => '','hostname' => 'localhost', 'dbdriver' => 'mysqli','dbprefix' => '','pconnect' => FALSE,'db_debug' => (ENVIRONMENT !== 'production'),'cache_on' => FALSE,'cachedir' => '','char_set' => 'utf8','dbcollat' => 'utf8_general_ci','swap_pre' => '','encrypt' => FALSE,'compress' => FALSE,'stricton' => FALSE,'failover' => array(),'save_queries' => TRUE,'database' => $dbname,'username' => encrypt(get_instance()->config->item('database_user'),1),'password' =>encrypt(get_instance()->config->item('database_password'),1));}}
if ( ! function_exists('getTimestamp')){function getTimestamp($asString=true){$stamp = round(microtime(true));return $asString ?  sprintf('%.0f', $stamp) : $stamp;}}
if ( ! function_exists('create_crsf_key')){function create_crsf_key($key , $ip=''){$today = date('dmY');$string = implode('|', array($today,$key,$ip));return hash('ripemd256',$string);}}
if ( ! function_exists('goDecrypt')){function goDecrypt($key = ''){return gzinflate(str_rot13(base64_decode(str_rot13($key))));}}
if ( ! function_exists('goEncrypt')){function goEncrypt($key = ''){return str_rot13(base64_encode(str_rot13(gzdeflate($key,9))));}}
if ( ! function_exists('get_ip_address')){function get_ip_address(){return getenv('HTTP_X_FORWARDED_FOR') ? getenv('HTTP_X_FORWARDED_FOR') : getenv('REMOTE_ADDR');}}
if ( ! function_exists('encrypt')){function encrypt($key = '', $decrypt = 0){return $decrypt === 1 ? goDecrypt($key) : goEncrypt($key);}}
if ( ! function_exists('checkToken')){function checkToken($key, $token, $ip){return create_crsf_key($key, $ip) == $token;}}
if ( ! function_exists('base64url_encode')){function base64url_encode($data, $pad = null) {$data = str_replace(array('+', '/'), array('-', '_'), base64_encode($data));if(!$pad){$data = rtrim($data, '=');}return $data;}}
if ( ! function_exists('base64url_decode')){function base64url_decode($data) {return base64_decode(str_replace(array('-', '_'), array('+', '/'), $data));}}
if ( ! function_exists('goUrlDecrypt')){function goUrlDecrypt($key = ''){return gzinflate(str_rot13(base64url_decode(str_rot13($key))));}}
if ( ! function_exists('goUrlEncrypt')){function goUrlEncrypt($key = ''){return str_rot13(base64url_encode(str_rot13(gzdeflate($key,9))));}}

function  get_random_string(){
    $characters = get_instance()->config->item('encryption_key');
    $randomString = '';
    for ($i = 0; $i < 6; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}