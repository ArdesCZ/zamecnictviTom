<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
        $router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:foto');
        $router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:onas');
		$router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:onas');
        $router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:sluzby');
        $router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:kontakt');
        $router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:prihlasit');
        $router->addRoute('<presenter>/<action>[/<id>]', 'AdminSekce:default');

		return $router;
	}
}
