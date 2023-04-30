<?php

namespace app\models;
use app\core\Model;
use R;
class Main extends Model {
	public $error;
	public function contactValidate($post) {
		$nameLen = iconv_strlen($post['name']);
		$textLen = iconv_strlen($post['text']);
		if ($nameLen < 3 or $nameLen > 30) {
			$this->error = 'Имя должно содержать от 3 до 30 символов';
			return false;
		}elseif (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error = 'Не верно указан E-mail';
			return false;
		}elseif ($textLen < 10 or $textLen > 1000) {
			$this->error = 'Текст должн содержать от 10 до 1000 символов';
			return false;
		}	
		return true;
	}


}