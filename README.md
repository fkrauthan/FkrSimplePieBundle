FkrSimplePieBundle
==================

Integrates [SimplePie](https://github.com/simplepie/simplepie) RSS Parser into Symfony2 and setting up caching to the symfony2 cache folder.

Installation
============

Bring in the vendor libraries
-----------------------------

This can be done in two different ways:

**Method #1**) Use composer

    "require": {
        "fkr/simplepie-bundle": "1.0.*@dev"
    }
    
    
**Method #2**) Use deps file
	
	[SimplePie]
	    git=git://github.com/simplepie/simplepie.git
		target=simplepie
		
	[FkrSimplePieBundle]
	    git=git://github.com/fkrauthan/FkrSimplePieBundle.git
		target=bundles/Fkr/SimplePieBundle


**Method #3**) Use git submodules

    git submodule add git://github.com/simplepie/simplepie.git vendor/simplepie
    git submodule add git://github.com/fkrauthan/FkrSimplePieBundle.git vendor/bundles/Fkr/SimplePieBundle


Register the SimplePie and Fkr namespaces
-----------------------------------------

This is *not* required if you installed using composer.
	
    // app/autoload.php
    $loader->registerNamespaces(array(
        'Fkr'  => __DIR__.'/../vendor/bundles',
        // your other namespaces
    ));
    $loader->registerPrefixes(array(
        'SimplePie'	   => __DIR__.'/../vendor/simplepie/library',
        // your other namespaces
    ));


Add SimplePieBundle to your application kernel
----------------------------------------------
	
	// app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Fkr\SimplePieBundle\FkrSimplePieBundle(),
            // ...
        );
    }


Configuration
=============

    # app/config.yml
    fkr_simple_pie:
        cache_enabled: false
        cache_dir: %kernel.cache_dir%/rss
        cache_duration: 3600
        idna_converter: ~ #default is false


* cache_enabled: [true or false] enables caching for the SimplePie class
* cache_dir: [any dir] setup the caching dir which SimplePie should use
* cache_duration: [secs] setting up caching for number of seconds.
* idna_converter: [true or false] enable the idna converter a [Encoder/Decoder for Internationalized Domain Names](http://dev.simplepie.org/api/class-idna_convert.html)

For more information about SimplePie's caching please visit the [SimplePie wiki](http://simplepie.org/wiki/faq/how_does_simplepie_s_caching_http_conditional_get_system_work).


Usage
=====

To get a configured SimplePie class instance just use the following code

	$this->get('fkr_simple_pie.rss');

The service keeps only one instance of SimplePie. If you want to use multiple feeds over your application you have to `clone` the instance to stop them interfering

	$one = clone $this->get('fkr_simple_pie.rss');
	$two = clone $this->get('fkr_simple_pie.rss');
	
Thats all. For the complete api visit the [SimplePie api doc](http://simplepie.org/wiki/reference/start).


Licence
=======

[Resources/meta/LICENSE](https://github.com/fkrauthan/FkrSimplePieBundle/blob/master/Resources/meta/LICENSE)
