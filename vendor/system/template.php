<?php



namespace OULDEVELOPER\LIBRARIES;

trait Template{

	private $patterns = [
			'foreach_english' 	=> 	'#@foreach\((.){2,}\)#',
			'for_english' 		=> 	'#@for\((.){2,}\)#',
			'while_english' 	=> 	'#@while\((.){2,}\)#',
			'if_english' 		=> 	'#@if\((.){2,}\)#',

			/*'foreach_tamazgha' 	=> 	'#@foreach\((.){2,}\)#',
			'for_tamazgha' 		=> 	'#@for\((.){2,}\)#',
			'while_tamazgha' 	=> 	'#@while\((.){2,}\)#',
			'if_tamazgha' 		=> 	'#@if\((.){2,}\)#',

			'foreach_arija' 	=> 	'#@foreach\((.){2,}\)#',
			'for_arija' 		=> 	'#@for\((.){2,}\)#',
			'while_arija' 		=> 	'#@while\((.){2,}\)#',
			'if_arija' 			=> 	'#@ilakan\((.){2,}\)#',*/
		];
	public function getScripts(){
		$_scripts = scandir(SCRIPT_PATH);
		array_shift($_scripts);
		array_shift($_scripts);
		foreach ($_scripts as $script) {
			if(file_exists(SCRIPT_PATH.$script)){				
				echo '<script type="text/javascript" src="/scripts/'.$script.'"></script>';
			}
		}
	}
	public function getStyles(){
		$_styles = scandir(STYLE_PATH.'styles');
		array_shift($_styles);
		array_shift($_styles);
		foreach ($_styles as $style) {
			if(file_exists(STYLE_PATH.$style)){
				echo '<link rel="stylesheet" type="text/css" href="/styles/'.$style.'">';
			}
			
		}
	}
	public function assets($link){
		if(file_exists(PUBLIC_PATH.$link)){
			echo "hello world";
			echo "/".$link;
		}
	}

	public function render($file,$type='view'){
		$code = html_entity_decode(file_get_contents($file));
		foreach ($this->patterns as $key => $pattern) {
			preg_match_all($pattern, $code,$matches);
			$match = array_shift($matches);
			if(is_array($match)){
				foreach($match as $statement){
					$code = str_replace($statement, '<?php '.str_replace('@', '' ,$statement).'{ ?>', $code);
				}
			}
		}
		$code = str_replace(['@end','{{','}}','[[',']]'], ['<?php } ?>','<?= ',' ?>','<?php ',' ?>'], $code);
		switch ($type) {
			case 'view':
				file_put_contents(__CACHE_VIEW__.'view.php', '');
				file_put_contents(__CACHE_VIEW__.'view.php', $code);
				break;
				
			case 'header':
				file_put_contents(__CACHE_VIEW__.'header.php', '');
				file_put_contents(__CACHE_VIEW__.'header.php', $code);
				break;
				
			case 'footer':
				file_put_contents(__CACHE_VIEW__.'footer.php', '');
				file_put_contents(__CACHE_VIEW__.'footer.php', $code);
				break;
				
		}
		
		
	}

	private function replace(){

	}
}