<?php
	namespace Fkr\SimplePieBundle\DependencyInjection\Factory;
	
	use Symfony\Component\Filesystem\Filesystem;
	
	
	class SimplePieFactory {
		
		public static function create($cacheEnabled, $cacheDir, $cacheDuration) {
			$feed = new \SimplePie();
			$feed->enable_cache($cacheEnabled);
			$feed->set_cache_duration($cacheDuration);
			$feed->set_cache_location($cacheDir);
			

			// Create dir if not exists
			if($cacheEnabled && !is_dir($cacheDir)) {
				$fileSystem = new Filesystem();
				$fileSystem->mkdir($cacheDir);
			}
			
			
			return $feed;
		}
		
	}
