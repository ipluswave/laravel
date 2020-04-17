<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ChangeLocale;

define('max_product_list_count', 20);
define('max_review_count', 5);
define('str_amazon','amazon');
define('str_prosperent','prosperent');
define('str_shopzilla','shopzilla');
define('str_cnet','cnet');
define('str_bestbuy','bestbuy');

define('str_currentproduct','currentproduct');
define('str_product_item_search','product_item_search');
define('str_product_universial_item_search','product_universial_item_search');

//=====================================category list=================================
//template, prosperent, amazon, shopzilla,
//$category_array_list = array(
//array("computer&tablets","clothing & accessories","computer | laptop","computer | laptop"));

///====================================amazon functions===============================
function getAmazonCurl($region, $category, $keyword) {
 
	$data = array(
		"Operation" => "ItemSearch",
		"IncludeReviewsSummary" => False,
		"ResponseGroup" => "Medium,OfferSummary,Accessories,Images",
	);
	
	if(!empty($keyword))
	{
		$Keywords = $keyword; 
		$data = $data + compact('Keywords');
	}
	else {
		$Keywords = $category; 
		$data = $data + compact('Keywords');
		
	}
	
	$category = 'All';
	
	if(!($category == 'all'))
	{
		$SearchIndex = $category; 
		$data = $data + compact('SearchIndex');
	}
	
	$ch = aws_signed_request($region, $data);	
	
	return $ch;
}

function getAmazonCurlForId($asin) {
 
	$data = array(
		"Operation" => "ItemLookup",
		"ItemId" => $asin,
		"IncludeReviewsSummary" => False,
		"ResponseGroup" => "Medium,OfferSummary,Accessories,Images",
	);
	
	$ch = aws_signed_request('com', $data);	
	
	return $ch;
}
 
function getAmazonCurlComparison($upc) {
 
	$data = array(
		"Operation" => "ItemLookup",
		"ItemId" => $upc,
		"IdType" => "UPC",
		"SearchIndex" => "All",
		"ResponseGroup" => "Medium,OfferSummary,Accessories,Images",
	);
	
	$ch = aws_signed_request('com', $data);	
	
	return $ch;
}
 
function getPage($url) {
 
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL,$url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, 15);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	
	return $curl;
}
 
function aws_signed_request($region, $params) {
 
	$public_key = "AKIAIQNXANCW6XFR55BA";
	$private_key = "Z5unWeON8270VwlmTaROz1XpnQLO/j/IqiTsL36K";
	
	$method = "GET";
	$host = "webservices.amazon." . $region;
	$uri = "/onca/xml";
 
	$params["Service"] = "AWSECommerceService";
	$params["AssociateTag"] = "affiliate-20"; // Put your Affiliate Code here
	$params["AWSAccessKeyId"] = $public_key;
	$params["Timestamp"] = gmdate("Y-m-d\TH:i:s\Z");
	$params["Version"] = "2015-05-26";
 
	ksort($params);
	$canonicalized_query = array();
	foreach ($params as $param => $value) {
		$param = str_replace("%7E", "~", rawurlencode($param));
		$value = str_replace("%7E", "~", rawurlencode($value));
		$canonicalized_query[] = $param . "=" . $value;
	}
	$canonicalized_query = implode("&", $canonicalized_query);
 
	$string_to_sign = $method . "\n" . $host . "\n" . $uri . "\n" . $canonicalized_query;
	$signature = base64_encode(hash_hmac("sha256", $string_to_sign, $private_key, True));
	$signature = str_replace("%7E", "~", rawurlencode($signature));
 
	$request = "http://" . $host . $uri . "?" . $canonicalized_query . "&Signature=" . $signature;
	$ch = getPage($request);
	
	return $ch;
	
}

//====================================prosperent functions===============================
function getProsperentCurl($category, $keyword) {
	$apikey = '274ab56313562fc993a85d25a957ae8e'; 

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, 'http://api.prosperent.com/api/search '); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POST, true); 
	$data = array( 
			'api_key' => $apikey, 
			'imageSize' => '250x250',
			'limit' => '20', 

			
	); 
	
	if($category == str_product_item_search) {
		if(!empty($keyword))
		{
			$filterCatalogId = $keyword; 
			$data = $data + compact('filterCatalogId');
		}	
		else die;
	}
	else if($category == str_product_universial_item_search) {
		if(!empty($keyword))
		{
			$query = $keyword; 
			$data = $data + compact('query');
		}	
		else die;
	}
	else {
		if(!empty($keyword))
		{
			$query = $keyword; 
			$data = $data + compact('query');
		}	
		else if(!($category == 'all'))
		{
			$filterKeyword = $category; 
			$data = $data + compact('filterKeyword');
		}
	}
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
	
	return $ch;
			
}

function getProsperentCurlForId($productId) {
	return getProsperentCurl(str_product_item_search, $productId);			
}

function getProsperentCurlComparison($upc) {
	return getProsperentCurl(str_product_universial_item_search, $upc);			
}

//====================================shopzilla functions===============================
function getShopzillaCurl($category, $keyword) {
	$publisherId = "601730"; 
	$apikey = "36ea984ef3a983337262e15ca5b1a299"; 
	
	$method = "GET";
	$host = "http://catalog.bizrate.com";
	$uri = "/services/catalog/v1/api/product";

	$params["publisherId"] = $publisherId; 
	$params["apiKey"] = $apikey;
	
	if($category == str_product_item_search) {
		if(!empty($keyword))
			$params["productId"] = $keyword;
		else die;
	}
	else if ($category == str_product_universial_item_search) {
		if(!empty($keyword))
		{
			$params["productId"] = $keyword;
			$params['productIdType'] = 'UPC';
			$params["keyword"] = '';

		}
		else die;
	}
	else {
			
		if(!empty($keyword))
			$params["keyword"] = $keyword;
		else if(!($category == 'all'))
			$params["keyword"] = $category;
	}

	$params["format"] = 'json';

	$canonicalized_query = array();
	foreach ($params as $param => $value) {
		$param = str_replace("%7E", "~", rawurlencode($param));
		$value = str_replace("%7E", "~", rawurlencode($value));
		$canonicalized_query[] = $param . "=" . $value;
	}
	
	$canonicalized_query = implode("&", $canonicalized_query);

	$request = $host . $uri . "?" . $canonicalized_query;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$request);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	
	return $ch;
}

function getShopzillaCurlForId($productId) {
	return getShopzillaCurl(str_product_item_search, $productId);
}

function getShopzillaCurlComparison($upc) {
	return getShopzillaCurl(str_product_universial_item_search, $upc);
}
//====================================bestbuy functions=================================
//====================================cnet functions====================================

/*
convert various result to same form
*/
function converttonormal($product_list) {
	$return = array();
	$temp = (object)[];
	
	if(!empty($product_list[str_prosperent]->data))
		$temp->product = $product_list[str_prosperent]->data;
	else $temp->product = array();
	
	if(isset($product_list[str_prosperent]->totalRecordsFound))
		$temp->totalRecords = $product_list[str_prosperent]->totalRecordsFound;
	else $temp->totalRecords = 0;
	
	$return[str_prosperent] = $temp;
	
	//============================================================
	$temp = (object)[];
	
	if(!empty($product_list[str_shopzilla]))
	{
		$ncount = $product_list[str_shopzilla]->products->includedResults;
		$temp->totalRecords = $ncount;
		$temp->product = array();
		if($ncount>0)
		{
			foreach($product_list[str_shopzilla]->products->product as $product) {
				$t = (object)[];
				
				if(!empty($product->brand))
					$t->brand = $product->brand->name;
				else $t->brand = "";
				
				$t->title = $product->title;
				$t->image_url = $product->images->image[3]->value;
				
				if(!empty($product->upc))
					$t->upc = $product->upc;
				else continue; 
					
				if(!empty($product->sku))
					$t->catalogId = $product->sku;
				else if(!empty($product->skus)) $t->catalogId = $product->skus->sku[0];
				else continue;
				$temp->product[] = $t;
			}
		}
		
		$return[str_shopzilla] = $temp;
	}
	else {
		$temp->totalRecords =0;
		$temp->product = array();
		$return[str_shopzilla] = $temp;
	}
	
	//============================================================
	$temp = (object)[];
	
	if(!empty($product_list[str_amazon]))
	{
		$temp->totalRecords = $product_list[str_amazon]->Items->TotalResults;
		$temp->product = array();
		foreach($product_list[str_amazon]->Items->Item as $product) {
			$t = (object)[];
			
			if(!empty($product->ItemAttributes->Brand))
				$t->brand = $product->ItemAttributes->Brand;
			else $t->brand = "";
			
			if(!empty($product->ItemAttributes->UPC ))
				$t->upc = $product->ItemAttributes->UPC;
			else continue;
			
			$t->title = $product->ItemAttributes->Title;
			$t->catalogId = $product->ASIN;
			$t->image_url = $product->LargeImage->URL;
			$temp->product[] = $t;
		}
		
		$return[str_amazon] = $temp;
	
	}
	
	else {
		$temp->totalRecords =0;
		$temp->product = array();
		$return[str_amazon] = $temp;
	}
	
	return $return;
}

//====================================getProductListResult==================================
function getProductListResult($curl) {
	$json_format_list = array(str_prosperent,str_shopzilla);
	
	foreach($curl as $key => $ch) {
		$output[$key]  = curl_multi_getcontent($ch);
	}
	
	$product_list = array();
	
	foreach($json_format_list as $key) {
		$return  = json_decode( $output[$key] ); 
		$product_list[$key] = $return;
	}
	
	$product_list[str_amazon] = @simplexml_load_string($output[str_amazon]);;
	
	$product_list[$key] = $return;
	$return = (object)[];
	$return->totalRecords = 0;
	$return->product = array();
	
	$result = converttonormal($product_list);
	foreach($result as $product_info_key => $products_info)
	{
		foreach($products_info->product as $product)
		{
			if($return->totalRecords >= max_product_list_count)
				break;
			
			if(empty($product->brand))
				continue;
			if(empty($product->upc))
				continue;
			
			if($product_info_key == str_prosperent)
				$product->catalogId = str_prosperent.'/'.$product->catalogId.'/'.$product->upc;
			if($product_info_key == str_shopzilla)
				$product->catalogId = str_shopzilla.'/'.$product->catalogId.'/'.$product->upc;
			if($product_info_key == str_amazon)
				$product->catalogId = str_amazon.'/'.$product->catalogId.'/'.$product->upc;
			
			$return->product[] = $product;
			$return->totalRecords++;
		}
	}
	
	return $return;
}

function converttoproductcomparison($product_list, $site) {
	$return = array();
	$temp = (object)[];
	
	if(!empty($product_list[str_prosperent]->data))
		$temp->product = $product_list[str_prosperent]->data;
	else $temp->product = array();
	
	if(!empty($product_list[str_prosperent]->data->brand))
		$temp->brand = $product_list[str_prosperent]->data->brand;
	else $temp->brand = "";
	
	if(!empty($product_list[str_prosperent]->data[0]->brand))
	{
		$return[str_prosperent] = $product_list[str_prosperent]->data[0];
		$return[str_prosperent]->title = $return[str_prosperent]->brand;
		$return[str_prosperent]->overallrating = 5;
	}
	//============================================================
	$temp = (object)[];
	if(!empty($product_list[str_shopzilla]))
	{
		foreach($product_list[str_shopzilla]->offers->offer as $product) {
			$t = (object)[];
			
			if(!empty($product->brand))
				$t->brand = $product->brand->name;
			else $t->brand = "";
			
			$t->title = $product->title;
			$t->image_url = $product->images->image[3]->value;
			$t->overallrating = min($product->price->integral/5000, 5);
			$t->description = $product->description;
			$t->shipType = $product->shipType;
			$t->price = $product->price;
			$t->tax_price = 0;
			$t->url = $product->url->value;
			$t->dropped_percent = $product->markdownPercent;
			
			if(!empty($product->sku))
				$t->catalogId = $product->sku;
			else if(!empty($product->skus)) $t->catalogId = $product->skus->sku[0];
			else continue;
			
			$temp = $t;
		}

		
		$return[str_shopzilla] = $temp;
	}
	else {
		$temp->totalRecords =0;
		$temp->product = array();
		$return[str_shopzilla] = $temp;
	}
	
	//============================================================
	$temp = (object)[];
	
	if(!empty($product_list[str_amazon]->Items->Item))
	{
		$temp->totalRecords = $product_list[str_amazon]->Items->TotalResults;
		$temp->product = array();
		
		$product = $product_list[str_amazon]->Items->Item;
		
		if(!empty($product->ItemAttributes->Brand))
			$temp->brand = $product->ItemAttributes->Brand;
		else $temp->brand = "";
		
		$temp->title = $product->ItemAttributes->Title;
		$temp->image_url = $product->LargeImage->URL;
		$temp->overallrating = min($product->SalesRank/1000, 5);
		$temp->description = $product->ItemAttributes->Warranty;
		$temp->shipType = "";
		$temp->price = $product->OfferSummary->LowestNewPrice->FormattedPrice;
		$temp->tax_price = 0;
		$temp->url = $product->ItemLinks->ItemLink[3]->URL;
		if(!empty($product->OfferSummary->LowestUsedPrice->Amount))
			$temp->dropped_percent = min(($product->OfferSummary->LowestNewPrice->Amount-$product->OfferSummary->LowestUsedPrice->Amount)/$product->OfferSummary->LowestUsedPrice->Amount*100.00, 100);
		else $temp->dropped_percent = "";
		
		if($temp->dropped_percent < 0)
			$temp->dropped_percent = 0;
		$temp->comment = $product->EditorialReviews->EditorialReview->Content;
		$temp->image_url = $product->LargeImage->URL;
		
		$return[str_amazon] = $temp;
	
	}
	
	else {
		$temp->totalRecords =0;
		$temp->product = array();
		$return[str_amazon] = $temp;
	}
	
	return $return;
}

function getProductListResultComparison($curl, $site) {
	$json_format_list = array(str_prosperent,str_shopzilla);
	
	foreach($curl as $key => $ch) {
		$output[$key]  = curl_multi_getcontent($ch);
	}
	
	$product_list = array();
	
	foreach($json_format_list as $key) {
		$return  = json_decode( $output[$key] ); 
		$product_list[$key] = $return;
	}
	
	$product_list[str_amazon] = @simplexml_load_string($output[str_amazon]);;
	
	$product_list[$key] = $return;
	$return = (object)[];
	$return->totalRecords = 0;
	$return->price_comparison_list = array();
	$return->review_list = array();
	$return->product = (object)[];
	$result = converttoproductcomparison($product_list, $site);
	
	if(!empty($result[$site]->brand))
	{
		
		$return->product->brand = $result[$site]->brand;
		$return->product->title = $result[$site]->title;
		$return->product->overallrating = $result[$site]->overallrating;
		$return->product->image_url = $result[$site]->image_url;
		$return->product->description = $result[$site]->description;
	}
	else die;
	
	foreach($result as $product_info_key => $product)
	{
		if(!empty($product))
		{
			if(empty($product->brand))
				continue;
			
			$return->price_comparison_list[] = $product;
		}
	}
	foreach($result as $product_info_key => $products_info)
	{
		if(!empty($product))
		{
			if(empty($product->brand))
				continue;
			$return->review_list[] = $product;
		}
	}
	
	return $return;
}

class HomeController extends Controller
{

	/**
	 * Display the home page.
	 *
	 * @return Response
	 */
	public function index(Request $request=NULL, $category = NULL)
	{
		if (empty($category)) $category = 'all';
		
		$keyword = NULL;
		
		if(!empty($request))
			$keyword = $request->input('q');
		if (($category == 'all') && (empty($keyword)))
			return view('front.index', compact('category', 'keyword'));
		else {
			
			$curl = array();
			//=============================prosperent============================
			$curl[str_prosperent] = getProsperentCurl($category, $keyword);
			//=============================amazon============================
			$curl[str_amazon] = getAmazonCurl('com', $category, $keyword);
			//=============================shopzilla============================
			$curl[str_shopzilla] = getShopzillaCurl($category, $keyword);
			
			//=============================amazon============================
			//=============================amazon============================
			
			
			$mh = curl_multi_init();

			//add the two handles
			foreach($curl as $ch) {
				curl_multi_add_handle($mh,$ch);
			}
			
			$running=null;
			
			//execute the handles
			do {
				curl_multi_exec($mh,$running);
			} while($running > 0);
			
			
			$return = getProductListResult($curl); 
			
			foreach($curl as $ch) {
				curl_multi_remove_handle($mh, $ch);
				curl_close($ch); 
			}
			
			curl_multi_close($mh);
			
			$product_list = $return->product;
			$totalRecords = $return->totalRecords;
			
			return view('front.product_landing', compact('category', 'keyword', 'product_list', 'totalRecords'));
		}
	}

	/**
	 * Display the home page.
	 *
	 * @return Response
	 */
	 
	public function product($site = NULL, $productId = NULL, $upc)
	{
		if(empty($site))
			return redirect('/');
		if(empty($productId))
			return redirect('/');
		
		$curl = array();
		
		if($site == str_prosperent)
			$curl[str_currentproduct] = getAmazonCurlForId($productId);
		else if($site == str_amazon)
			$curl[str_currentproduct] = getProsperentCurlForId($productId);
		else if($site == str_shopzilla)
			$curl[str_currentproduct] = getShopzillaCurlForId($productId);
		else return redirect('/');	
		
		//=============================prosperent============================
		$curl[str_prosperent] = getProsperentCurlComparison($upc);
		//=============================amazon============================
		$curl[str_amazon] = getAmazonCurlComparison($upc);
		//=============================shopzilla============================
		$curl[str_shopzilla] = getShopzillaCurlComparison($upc);
		
		//=============================amazon============================
		//=============================amazon============================
		
		
		$mh = curl_multi_init();

		//add the two handles
		foreach($curl as $ch) {
			curl_multi_add_handle($mh,$ch);
		}
		
		$running=null;
		
		//execute the handles
		do {
			curl_multi_exec($mh,$running);
		} while($running > 0);
		
		
		$return = getProductListResultComparison($curl, $site); 
		
		foreach($curl as $ch) {
			curl_multi_remove_handle($mh, $ch);
			curl_close($ch); 
		}
		
		curl_multi_close($mh);
		
		$product = $return->product;
		$price_comparison_list = $return->price_comparison_list;
		$review_list = $return->review_list;		
		return view('front.product', compact('product', 'price_comparison', 'review'));
	}
	
	public function product_old($site = NULL, $productId = NULL)
	{
		if(empty($site))
			return redirect('/');
		if(empty($productId))
			return redirect('/');
		
		$apikey = '274ab56313562fc993a85d25a957ae8e'; 

		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, 'http://api.prosperent.com/api/search'); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POST, true); 
		$data = array( 
				'api_key' => $apikey, 
				'filterCatalogId' => $productId,
				'imageSize' => '250x250',
				'limit' => '20', 
		); 
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
		
		//========================================================
		$ch1 = curl_init(); 
		curl_setopt($ch1, CURLOPT_URL, 'http://api.prosperent.com/api/commissions'); 
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch1, CURLOPT_POST, true); 
		$data = array( 
				'api_key' => $apikey, 
				'filterCatalogId' => $productId,
				'limit' => '20', 
		); 
		
		curl_setopt($ch1, CURLOPT_POSTFIELDS, $data); 
		
		$mh = curl_multi_init();

		//add the two handles
		curl_multi_add_handle($mh,$ch);
		curl_multi_add_handle($mh,$ch1);

		$running=null;
		
		//execute the handles
		do {
			curl_multi_exec($mh,$running);
		} while($running > 0);
		
		$output = curl_multi_getcontent($ch);
		$return = json_decode( $output ); 
		$product = $return->data[0];
		
		$output = curl_multi_getcontent($ch1);
		$return = json_decode( $output ); 
		$product_overallrating = 5;
		
				
		curl_multi_remove_handle($mh, $ch);
		curl_multi_remove_handle($mh, $ch1);
		curl_multi_close($mh);
		
		return view('front.product', compact('product','product_overallrating'));
	}
	
	/**
	 * Change language.
	 *
	 * @param  App\Jobs\ChangeLocaleCommand $changeLocale
	 * @param  String $lang
	 * @return Response
	 */
	public function language( $lang,
		ChangeLocale $changeLocale)
	{		
		$lang = in_array($lang, config('app.languages')) ? $lang : config('app.fallback_locale');
		$changeLocale->lang = $lang;
		$this->dispatch($changeLocale);

		return redirect()->back();
	}

}
