<?php
namespace app\controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Exception\NotFoundException;

// All the routes here can be seen if logged in or out, doesnt matter
class AllController
{
    public function home($app)
    {
        $app->get('/', function ($request, $response, $args) {
            return $this->view->render(
                $response,
                'home.php',
                ['router'=>$this->router, 'on_home' => true,
                'posts'=>\PostQuery::create()->orderByLibraryIndex()->find(),
                'all_libraries'=>\LibraryQuery::create()->find(),
                'user'=>\User::current()]
            );
        })->setName('home');
    }

    public function library($app)
    {
        // the "library" groups posts together (useful for tutorials that need
        // more than one post to explain well)
        $app->get('/lib/{name}', function ($request, $response, $args) {
            $lib = \LibraryQuery::create()->findOneByName($args['name']);

            if ($lib == null) {
                // invalid library, throw 404
                throw new \Slim\Exception\NotFoundException($request, $response);
            }

            return $this->view->render(
              $response,
              'post-list.php',
              ['router'=>$this->router,
              'posts'=>\PostQuery::create()->  orderByLibraryIndex()->findByLibrary($lib),
              'title'=>'Library: '.$lib->getName()]
          );
        })->setName('library');
    }

    public function search($app)
    {
        $app->get('/search', function ($request, $response, $args) {
            $get = $request->getQueryParams();
            $text = isset($get['text'])?$get['text']:'';

            return $this->view->render(
              $response,
                'search.php',
                ['router'=>$this->router, 'text'=>$text]
            );
        })->setName('search');

        // trying to search for a term
        $app->post('/search', function ($request, $response, $args) {
            $params = $request->getParsedBody();

            $array = array();
            if (isset($_POST['text'])) {
                $posts = \PostQuery::create()->search($_POST['text']);
                $array = $posts->find()->toArray();
            }

            // dont show info not needed in front end
            foreach (array_keys($array) as $key) {
                unset($array[$key]['Id']);
                unset($array[$key]['LibraryId']);
                unset($array[$key]['LibraryIndex']);
                unset($array[$key]['PostedByUserId']);
                $array[$key]['Text'] = strip_tags($array[$key]['Text']);

                // send back the actual link to the post
                $link = $array[$key]['Hyperlink'];
                $link = $this->router->pathFor('view-post', ['hyperlink'=>$link]);
                $array[$key]['Hyperlink'] = $link;

                $date = new \DateTime($array[$key]['PostedDate']);
                $array[$key]['PostedDate'] = $date->format('F d, Y');
            }
            return $response->withJson($array);
        });
    }

    public function contactUs($app)
    {
        $app->get('/contact', function ($request, $response, $args) {
            return $this->view->render(
              $response,
                'contact.php',
                ['router'=>$this->router]
            );
        })->setName('contact-us');

        // trying to send an email to us
        $app->post('/contact', function ($request, $response, $args) {
            $params = $request->getParsedBody();

            if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL) ||
                  $params['message'] == "" || $params['message'] == null) {
                return $response->withJson(['success'=>false, 'msg'=>'Invalid data']);
            }

            $arr = \app\utils\Mail::contactUs($params['email'], $params['message']);
            return $response->withJson($arr);
        });
    }

    public function aboutUs($app)
    {
        $app->get('/about-us', function ($request, $response, $args) {
            return $this->view->render(
              $response,
                'about-us.php',
                ['router'=>$this->router]
            );
        })->setName('about-us');
    }

    public function faq($app)
    {
        $app->get('/faq', function ($request, $response, $args) {
            return $this->view->render(
              $response,
                'faq.php',
                ['router'=>$this->router]
            );
        })->setName('faq');
    }

    public function appPost($app)
    {
        $app->get('/app', function ($request, $response, $args) {
            return $this->view->render(
              $response,
                'home-app.php',
                ['router'=>$this->router]
            );
        })->setName('app');
    }

    public function allPages($app)
    {
        $app->get('/all-pages', function ($request, $response, $args) {
            return $this->view->render(
              $response,
                'all-pages.php',
                ['router'=>$this->router, 'user'=>\User::current()]
            );
        })->setName('all-pages');
    }

    public function viewPost($app)
    {
        $app->get('/post/{hyperlink}', function ($request, $response, $args) {
            $query = \PostQuery::create();
            $post = (clone $query)->findOneByHyperlink($args['hyperlink']);

            if ($post == null) {
                // invalid post, throw 404
                throw new \Slim\Exception\NotFoundException($request, $response);
            }

            // find previous and next post
            $lib = $post->getLibrary();
            $query = (clone $query)->filterByLibrary($lib);
            $prev = (clone $query)->findOneByLibraryIndex($post->getLibraryIndex()-1);
            $next = (clone $query)->findOneByLibraryIndex($post->getLibraryIndex()+1);

            // show comments for post (newest ones first)
            $comments = \CommentQuery::create()->
              filterByPost($post)->orderByPostedTime('desc');

            return $this->view->render(
                $response,
                'view-post.php',
                ['router'=>$this->router, 'post'=>$post, 'comments'=>$comments,
                'user'=>\User::current(), 'all_libraries'=>\LibraryQuery::create(),
                'lib_name'=>$lib->getName(), 'prev'=>$prev, 'next'=>$next]
            );
        })->setName('view-post');
    }

    public function profile($app)
    {
        // when visiting someones profile
        $app->get('/profile/{username}', function ($request, $response, $args) {
            $user = \UserQuery::create()->findOneByUsername($args['username']);

            if ($user == null) {
                throw new \Slim\Exception\NotFoundException($request, $response);
            }

            $current = \User::current();
            $visiting = true;
            if ($current != null && $current->getId() == $user->getId()) {
                $visiting = false;
            }

            $posts = \PostQuery::create()->orderByPostedDate()->findByPostedByUser($user);
            $comments = \CommentQuery::create()->findByUser($user);

            // get the number of times this users posts have been favorited
            $post_ids = array_column($posts->toArray(), 'Id');
            $favorites = \UserFavoriteQuery::create()->findByPostId($post_ids);

            return $this->view->render(
              $response,
                'profile.php',
              ['router'=>$this->router, 'user'=>$user, 'visiting'=>$visiting,
              'posts'=>$posts, 'comments'=>$comments, 'favorites'=>$favorites]
          );
        })->setName('user-profile');
    }

    public function confirmAccount($app)
    {
        // route to confirm email
        $app->get('/confirm-account/{email}/{key}', function ($request, $response, $args) {
            $user = \UserQuery::create()->findOneByEmail($args['email']);
            if ($user == null) {
                // non existent user
                return $response->withRedirect($this->router->pathFor('home'));
            } elseif ($user->getConfirmationKey() != $args['key']) {
                // wrong key. For safety, assign a new key
                $user->setRandomConfirmKey();
                $user->save();
                return $response->withRedirect($this->router->pathFor('home'));
            } else {
                // everything good. Just confirm user and redirect them to their profile
                $user->confirm();
                $user->login();
                $profile = $this->router->pathFor('user-profile', ['username'=>$user->getUsername()]);
                return $response->withRedirect($profile);
            }
        })->setName('confirm-account');
    }

    public function resetPassword($app)
    {
        // route to reset password (when coming back from email)
        $app->get('/reset-password-email/{email}/{key}', function ($request, $response, $args) {
            $user = \UserQuery::create()->findOneByEmail($args['email']);
            if ($user == null) {
                // non existent user
                return $response->withRedirect($this->router->pathFor('home'));
            } elseif ($user->getResetKey() != $args['key']) {
                // wrong key. For safety, assign a new key
                $user->setRandomResetKey();
                $user->save();
                return $response->withRedirect($this->router->pathFor('home'));
            } else {
                // everything good. Login and redirect to reset password view
                $user->login();
                return $response->withRedirect($this->router->pathFor('reset-password'));
            }
        })->setName('reset-password-email');
    }

    public static function setUpRouting($app)
    {
        $controller = new AllController();
        $controller->home($app);
        $controller->library($app);
        $controller->search($app);
        $controller->contactUs($app);
        $controller->aboutUs($app);
        $controller->faq($app);
        $controller->appPost($app);
        $controller->allPages($app);

        $controller->viewPost($app);
        $controller->profile($app);

        $controller->confirmAccount($app);
        $controller->resetPassword($app);
    }
}
