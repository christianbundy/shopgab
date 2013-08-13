<?php

class Model_Product extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'category_id',
		'name',
		'description',
		'price',
		'domain',
		'url',

		'brand',
		'model',
		'serial',
		'warranty',
		'type',
		'dimensions',
		'weight',
		
		'created_at',
		'updated_at',
	);

	protected static $_belongs_to = array(
		'quest' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Quest_Product',
			'key_to' => 'product_id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	protected static $_has_one = array(
		'image' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Product_Image',
			'key_to' => 'product_id',
			'cascade_save' => true,
			'cascade_delete' => false,
		),
		'quest_product' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Quest_Product',
			'key_to' => 'product_id',
			'cascade_save' => true,
			'cascade_delete' => false,
		),
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	protected $image_sizes = array('250' => '220', '50' => '50');


	public function name()
	{
		return $this->name;
	}

	public function description()
	{
		return $this->description;
	}

	public function price()
	{
		return $this->price;
	}

	public function url()
	{
		return '#';
	}

	public function product_url()
	{
		return $this->url;
	}

	public function has_image()
	{
		return is_object($this->image);
	}



	public function add_image($src_url)
	{
		$connection = Service_Cloudfiles::get_connection();

		// make request
		$curl = Request::forge($src_url, 'curl');
		$curl->execute();
		$response   = $curl->response();

		// save paths
		$file_name = md5(uniqid(rand(), true)) . '.png';
		$tmp_dir   = APPPATH . 'tmp/';
		$tmp_path  = $tmp_dir . $file_name;

		// save tmp
		File::create($tmp_dir, $file_name, $response->body());

		// resize thumbs
		foreach ($this->image_sizes as $width => $height)
		{
			$tmp_resize_path = APPPATH . "tmp/{$width}x{$height}_{$file_name}";

			if (! is_dir($tmp_resize_path))
			{
				mkdir($tmp_resize_path, 777, true);
			}

			Image::load($tmp_path)
				->crop_resize($width, $height)
				->save($tmp_resize_path);

			$container = $connection->get_container("products_{$width}x{$height}");
			$image     = $container->create_object($file_name);

			$image->load_from_filename($tmp_resize_path);

			$product_image = new Model_Product_Image;
			$product_image->user_id              = $this->id;
			$product_image->name                 = $image->name;
			$product_image->src_url              = $src_url;
			$product_image->public_uri           = $image->public_uri();
			$product_image->public_ssl_uri       = $image->public_ssl_uri();
			$product_image->public_streaming_uri = $image->public_streaming_uri();
			$product_image->width                = $width;
			$product_image->height               = $height;
			$product_image->content_length       = $image->content_length;
			$product_image->save();

			File::delete($tmp_resize_path);
		}

		$this->set_avatar_type('custom');

		File::delete($tmp_path);

	}



	public function image()
	{
		return $this->has_image() ? $this->image->src() : null;
	}

	public function image_html()
	{
		return Html::img($this->image(), array('alt' => $this->name()));
	}

	public function thumb()
	{
		return $this->has_image() ? $this->image->thumb() : 'http://placehold.it/250x230';
	}

	public function thumb_html()
	{
		return Html::img($this->thumb(), array('alt' => $this->name()));
	}

	public function small()
	{
		return $this->has_image() ? $this->image->small() : 'http://placehold.it/50x50';
	}

	public function small_html()
	{
		return Html::img($this->small(), array('alt' => $this->name()));
	}

	public static function get_index()
	{
		return static::query()->order_by('name', 'asc')->get();
	}
	
	public static function add_product($attr)
	{
		$product = static::forge($attr);
		return $product->save() ? $product : null;
	}

	public static function get_users_products($user_id)
	{
		return static::query()->where('user_id', $user_id)->get();
	}

}