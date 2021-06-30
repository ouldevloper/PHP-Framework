<?php

namespace OULDEVELOPER\Controllers;
use OULDEVELOPER\LIBRARIES\Controller;
use OULDEVELOPER\LIBRARIES\Upload;
use OULDEVELOPER\LIBRARIES\Request;
use OULDEVELOPER\LIBRARIES\Response;
use OULDEVELOPER\Models\OfferModel;
use OULDEVELOPER\Models\ImagesModel;
class OfferController extends Controller{

	public function list(){
		return $this->view();
	}

	public function add(){
		if(Request::isMethod('post')){
			echo $_POST['description'].'<br>';
			pre($_POST);die;
			$offer = new OfferModel();
			$img = new ImagesModel();
			$up = new Upload();
			$files = $up->Upload();

			$offer->id =	"1";
			$offer->title = 	Request::input('title');
			$offer->city = 		Request::input('city');
			$offer->quarty = 	Request::input('quarter');
			$offer->price = 	Request::input('price');
			$offer->distance =	Request::input('distance');
			$offer->description =	Request::input('description');
			if($files !== false){
				$offer->image = $files[0];
			}
			if($offer->save('add')){
				Response::Redirect('/offers');
			}
			else{
				return $this->view();
			}

		}else{
			return $this->view();
		}
	}

}