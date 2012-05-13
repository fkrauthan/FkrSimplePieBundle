FkrSimplePieBundle
==================

Integrates SimplePie RSS Parser into Symfony2.

Installation
============

Bring in the vendor libraries
-----------------------------

This can be done in two different ways:

**Method #1**) Use deps file

::

	[SimplePie]
	    git=git://github.com/simplepie/simplepie.git
		target=simplepie
		
	[FkrSimplePieBundle]
	    git=git://github.com/fkrauthan/FkrSimplePieBundle.git
		target=bundles/Fkr/SimplePieBundle


**Method #2**) Use git submodules

::

    git submodule add git://github.com/simplepie/simplepie.git vendor/simplepie
    git submodule add git://github.com/fkrauthan/FkrSimplePieBundle.git vendor/bundles/Fkr/SimplePieBundle


Register the SimplePie and Fkr namespaces
-----------------------------------------

::

	// app/autoload.php
	$loader->registerNamespaces(array(
		'Fkr'  => __DIR__.'/../vendor/bundles',
		// your other namespaces
	));
	$loader->registerPrefixes(array(
		'SimplePie_'	   => __DIR__.'/../vendor/simplepie',
		// your other namespaces
	));


Add SimplePieBundle to your application kernel
----------------------------------------------

::

	// app/AppKernel.php
    public function registerBundles()
    {
		return array(
            // ...
            new Fkr\SimplePieBundle\FkrSimplePieBundle(),
            // ...
        );
	}
